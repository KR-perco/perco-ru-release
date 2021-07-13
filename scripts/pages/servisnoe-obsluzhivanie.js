var service = "";
var sc_id = "";
$(function(){
	$(".tabs label").click(function(){
		sc_id = $(this).attr("for");
		clickcnt = Number($(this).attr("data-click")) + 1;
		$(this).attr("data-click", clickcnt);
		switch(sc_id)
		{
			case "sc-rossii":
				dataAjax = {ajax: "Y", country: "rossiya", sc: "Y", PAGEN_1: "1"};
				service = "rossiya";
				break;
			case "sc-belarusi":
				dataAjax = {ajax: "Y", country: "BY", sc: "Y", PAGEN_1: "1"};
				service = "BY";
				break;
			case "sc-kazahstana":
				dataAjax = {ajax: "Y", country: "KZ", sc: "Y", PAGEN_1: "1"};
				service = "KZ";
				break;
			case "sc-ukrainy":
				dataAjax = {ajax: "Y", country: "UA", sc: "Y", PAGEN_1: "1"};
				service = "UA";
				break;
		}
		if ($(this).attr("data-click") < 2)
		{
			$.get("/gde-kupit/details-withoutheader.php", dataAjax, function(data){
				//добавим новости к списку
				$("label[for = "+sc_id+"] + div").html(data);
			});
		}
	});
});