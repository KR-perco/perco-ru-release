function unselect(id)
{
	window.param = $(id).prev().val();
	if (window.param == undefined && id == "#section")
	{
		$("button").css("background", "#BDBEC0");
		$("button").css("border-bottom", "2px solid grey");
		$("button").unbind("click");
	}
	if ($("select").is(id + "+ select"))
	{
		$("select").last().remove();
		return unselect(id);
	}
}
$(function(){
	var archive = "";
	var param;
	if (url("filename") == "archive")
		archive = "Y";
	var worker = url("?worker");
	if (worker == "manager"){
		$.get("select-manager.php", {"section": "video", "archive": archive, "worker": worker}, function(data){
			$("#section").html(data);
		});
	}else if(worker == "installer"){
		$.get("select-installer.php", {"section": "video", "archive": archive, "worker": worker}, function(data){
			$("#section").html(data);
		});
	}else{
		$.get("select.php", {"section": "video", "archive": archive, "worker": worker}, function(data){
			$("#section").html(data);
		});
	}

	/*if ((url("?section") != undefined) || (url("?worker") != undefined))
	{
		window.param = url("?section");
		var jqxhr = $.get("select.php", {"section": window.param, "archive": archive, "worker": worker}, function(data){
			$("#section").after(data);
			$("#section + select").css("display", "block");
		});
		jqxhr.complete(function(){
			$("#section option[value="+window.param+"]").prop("selected", true);
		});
		$("#download_items").load("select_products.php", {"section": window.param, "archive": archive, "worker": worker});
	}*/
	$(document).on("change", "#select_documents select", function(){
		$("#download_items").html("");
		window.param = $(this).val();
		id = "#" + $(this).attr("id");
		if (window.param == "")
			unselect(id);
		else
		{
			if (id == "#section" && $("select").is(id + "+ select"))
				$("select").last().remove();
			$("button").css("background", "#214288");
			$("button").css("border-bottom", "2px solid #00295B");
			$("button").bind("click", function(){
				$("#download_items").html('<img src="/images/icons/loading.gif" />');
				$("#download_items").load("select_products.php", {"section": window.param, "archive": archive, "worker": worker});
			});
			$.get("select.php", {"section": window.param, "archive": archive, "worker": worker}, function(data){
				$(id + "+ select").remove();
				$(id).after(data);
				$(id + "+ select").css("display", "block");
				var tmp;
			});
		}
	});
});