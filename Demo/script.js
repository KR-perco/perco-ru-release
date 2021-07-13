window.News = function (newsType, title)
{
	this.newsType = newsType;
	this.title = title;
	this.newsCacheBase = this.cacheDataBase = new BX.dataBase({
		name: "NewsCache",
		displayName: "NewsCache",
		capacity: 1024 * 1024 * 4,
		version: "1.2"
	});

	this.tableParams =
	{
		tableName: "newslist",
		fields: [
			"id",
			"content",
			"title"
		]
	};
	this.newsCacheBase.createTable(this.tableParams);
};



News.prototype.load = function ()
{
	BX.ajax.get("http://export.perco.ru/mobile/data/data_download.json", {}, BX.proxy(function (data)
	{
		BXMobileApp.UI.Page.PopupLoader.hide();
		BXMPage.getTitle().setText(this.title);
		BXMPage.getTitle().show();


        var newsList = JSON.parse(data);
        alert(data);

		BX.proxy(function ()
		{
			this.updateCache(data, this.title);

		}, this)();


		this.drawNewList(newsList);

	}, this));
};

News.prototype.updateCache = function (content, title)
{
	this.newsCacheBase.getRows(
		{
			tableName: this.tableParams.tableName,
			filter: {id: this.newsType},
			success: BX.proxy(function (res)
			{
				if (res.items.length > 0)
				{
					this.newsCacheBase.updateRows(
						{
							tableName: this.tableParams.tableName,
							updateFields: {
								content: content,
								title: title
							},
							filter: {
								id: this.newsType
							},
							fail: function (e)
							{
								//console.error("Update cache error: ", e);
							}

						}
					)
				}
				else
				{
					this.cacheDataBase.addRow(
						{
							tableName: this.tableParams.tableName,
							insertFields: {
								id: this.newsType,
								content: content
							}
						}
					);
				}
			}, this)
		}
	)
};


/*var db  = new BX.dataBase({
    name: "MyDatabase",
    displayName: "MyDatabase",
    capacity: 1024 * 1024 * 4,
    version: "1.2"
});

var createTableParams = {
    tableName: "mytable",
    fields: [
       {name: "id", unique: true},
       "name",
       "data"
    ],
    success: function (res)
    {
       alert("success");
 
    },
    fail: function (e)
    {
       alert("some error");
       alert(e);
    }
 };
 */
