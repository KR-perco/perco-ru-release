var Menu = function (menucontainer)
{
	this.menuBlock = menucontainer;

};
Menu.prototype.init = function ()
{
	BitrixMobile.fastClick.bindDelegate(this.menuBlock, {className: "item-menu"}, BX.proxy(this.click, this));

};
Menu.prototype.click = function (e)
{

	var id = e.target.getAttribute("data-news-id");
	var title = e.target.getAttribute("data-title");
	var dataurl = e.target.getAttribute("data-url");

	var params = {
		title: title,
		cache: false,
		url: dataurl,
		data: {
			dataurl: dataurl,
			id: id
		}
	};

	BXMobileApp.PageManager.loadPageStart(params);
   
};







var MenuCatalog = function (menucontainer)
{
	this.menuCatalogBlock = menucontainer;
};

MenuCatalog.prototype.init = function ()
{
	BitrixMobile.fastClick.bindDelegate(this.menuCatalogBlock, {className: "button"}, BX.proxy(this.click, this));
};

MenuCatalog.prototype.click = function (e)
{
	var title = e.target.getAttribute("data-title");
	var dataurl = e.target.getAttribute("data-url");
	var section = e.target.getAttribute("data-section");
	var worker = e.target.getAttribute("data-worker");
	var type = e.target.getAttribute("data-type");
	var product = e.target.getAttribute("data-element");

	var url = ((worker == null) || (type == "tosection")) ? "bxlocal://catalog-section.html" : "bxlocal://catalog.html";

	var params = {
		title: "Каталог",
		cache: false,
		url: url,
		data: {
			dataurl: dataurl,
			worker: worker,
			section: section,
			product: product
		}
	};

	/*if (section == "shlagbaum") {
		var params = {
			title: "Каталог",
			cache: false,
			url: "bxlocal://catalog-element.html",
			data: {
				worker: worker,
				section: section,
				product: product
			}
		};
	};*/

	BXMobileApp.PageManager.loadPageBlank(params);

};

var MenuElement = function (menucontainer)
{
	this.menuElementBlock = menucontainer;

};
MenuElement.prototype.init = function ()
{
	BitrixMobile.fastClick.bindDelegate(this.menuElementBlock, {className: "button"}, BX.proxy(this.click, this));

};
MenuElement.prototype.click = function (e)
{
	var exist = e.target.getAttribute("data-exist");
	var section = e.target.getAttribute("data-section");
	var product = e.target.getAttribute("data-element");
	var worker = e.target.getAttribute("data-worker");
	var url = "bxlocal://catalog-element.html";
	var params = {
		title: "Каталог",
		cache: false,
		url: url,
		data: {
			worker: worker,
			section: section,
			product: product
		}
	};

	if (exist != "false") {
		BXMobileApp.PageManager.loadPageBlank(params);
	}

};

var MenuPO = function (menucontainer)
{
	this.menuPOBlock = menucontainer;

};
MenuPO.prototype.init = function ()
{
	BitrixMobile.fastClick.bindDelegate(this.menuPOBlock, {className: "button-po"}, BX.proxy(this.click, this));

};
MenuPO.prototype.click = function (e)
{

	var title = e.target.getAttribute("data-title");
	var dataurl = e.target.getAttribute("data-url");
	var section = e.target.getAttribute("data-section");
	var worker = e.target.getAttribute("data-worker");
	var url = "bxlocal://catalog-section.html";

	var params = {
		title: title,
		cache: false,
		url: url,
		data: {
			dataurl: dataurl,
			worker: worker,
			section: section
		}
	};

	BXMobileApp.PageManager.loadPageBlank(params);

};

$(document).ready(function () {
	var paragraphs = document.querySelectorAll('.preview_text p');

	if (paragraphs.length > 1){
		$('.preview_text p:not(:first-child)').css("display","none");
		$('.preview_text').append('<div class="more">Подробнее</div>');
		$('.preview_text').append('<div class="less">Скрыть</div>');
		$('.less').css("display","none");
	}    

	$( ".description .more" ).click(function() {
		$('.description .more').css("display","none");
		$('.less').css("display","block");
		$('.preview_text p:not(:first-child)').fadeIn();
	});

	$( ".description .less" ).click(function() {
		$('.description .less').css("display","none");
		$('.description .more').css("display","block"); 
		$('.preview_text p:not(:first-child)').fadeOut();
	});
});


function checkCurrency() {
	var networkState = navigator.connection.type;
	if (networkState == 'none'){
		/*alert('Для скачивания материалов следует подключиться к сети!');*/
	} else {
		$.getJSON('https://www.perco.ru/percoMobile/offline/currency.json', function(json){
			let cur = json.curr.RATE;
			localStorage.setItem("CURRENCY", cur, 10000);
		});
	}
}