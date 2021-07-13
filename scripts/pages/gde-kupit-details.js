var path = url("path");
if (url("file") == undefined)
	path += "/";
function regionHover(id, fill, action)
{
	if (action == "mouseenter")
	{
		$("g#"+id+" > path").css("fill", "#1875C9");
		$("#"+id).find(".allregion").children().show();
	}
	else
	{
		$("g#"+id+" > path").css("fill", fill);
		$("#"+id).find(".allregion").children().hide();
	}
}
$(function(){
	//путь к файлу с компонентом. Указываем параметр
	if(url("?") != undefined)
	{
		var objUrl = url("?");
		for (key in objUrl)
		{
			$("html, body").animate({ scrollTop: $("#counter").offset().top }, 500);
			break;
		}
	}
	pathAjax = "/gde-kupit/company_list.php";
	if (url("1") != "gde-kupit" && LANGUAGE_ID == "ru")
		var dataAjax = {ajax: "Y", country: service, sc: "Y"};
	else
		var dataAjax = {ajax: "Y", country: url("2")};
	idRegion = url("?region");
	if (idRegion)
	{
		$("g#"+idRegion+" > path").css("fill", "#1875C9");
		dataAjax["region"] = idRegion;
	}
	idCity = url("?city");
	if (window.idCity)
	{
		$("#"+idCity+" > circle").attr("r", "7");
		dataAjax["city"] = idCity;
	}
	kit = url("?kit");
	if (window.kit)
		dataAjax["kit"] = kit;
	if (window.sc_id)
		sc_id = "label[for = "+window.sc_id+"] + div #content ";
	else
		sc_id = "";
	//счетчик страниц
	var currentPage = 1;
	var count = $(sc_id+"#counter").data("count");
	var marker = true;
	if(currentPage == count)
		$(".show-more").remove();
	$(window).scroll(function(){
		var scrHW = $(window).height();
		var scrTop = $(this).scrollTop();
		var scrHCont = $("#container").height();
		var bottomH = scrHCont - (scrHW + scrTop);
		if (bottomH < 200 && currentPage < count && marker)
		{
			marker = false;
			dataAjax["PAGEN_1"] = ++currentPage;
			// делаем ajax запрос и сразу инкремент номера страницы
			$.get(pathAjax, dataAjax, function(data){
				// добавим новости к списку
				$(sc_id+"#companies").append(data);
				marker = true;
			});
		}
		$(".show-more").remove();
	});
	$(".inform").each(function(indx){
		var informHeight = 2 - $(this).height() / 2;
		$(this).css("top", informHeight);
	});
	if (window.massCities)
	{
		for(key in massCities)
		{
			$("g#"+key+" > circle").show();
		}
	}
		// выделение при наведении мыши
	if (device == "desktop")
	{
		$(".city_name").hover(
			function(){
				if ($(this).attr("data-id"))
					id = $(this).attr("data-id");
				else
					id = $(this).parent().attr("id");
				radius = $("#"+id).children("circle").attr("r");
				$("#"+id).children("circle").attr("r", "7");
				$("#"+id).children().not("circle").show();
			},
			function(){
				$("#"+id).children("circle").attr("r", radius);
				$("#"+id).children().not("circle").hide();
			}
		);
		$("circle").hover(
			function(){
				if ($(this).attr("data-id"))
					id = $(this).attr("data-id");
				else
					id = $(this).parent().attr("id");
				radius = $("#"+id).children("circle").attr("r");
				$("#"+id).children("circle").attr("r", "7");
			},
			function(){
				$("#"+id).children("circle").attr("r", radius);
			}
		);
		$(".region_name").hover(
			function(){
				id = $(this).attr("data-id");
				fill = $("g#"+id+" > path").css("fill");
				regionHover(id, fill, "mouseenter");
			},
			function(){
				regionHover(id, fill, "mouseleave");
			}
		);
	}
	// клик по стране
	$("g").click(function(e){
		id = $(this).attr("id");
		region = massRegions[id];
		if (window.region)
		{
			if (window.sc)
			{
				if (massRegions[id]["url"] == "")
					document.location.href = path;
				else
					document.location.href = path+"?country="+massRegions[id]["url"];
			}
			else
				document.location.href = path+"?region="+massRegions[id]["url"];
		}
		cities = massCities[id];
		if (window.cities && massCities[id]["url"] != undefined)
			document.location.href = path+"?city="+massCities[id]["url"];
		e.stopPropagation();
	});
});