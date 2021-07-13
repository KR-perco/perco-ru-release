$(function(){
	$("#country > div").lightGallery({
		selector: "a"
	});
	//var id = "#" + $(".country_name.active").attr("data-id");
	//$(id).show();
	$(".country_name").click(function(){
		var id = "#" + $(this).attr("data-id");
		$(".country_name").removeClass("active");
		$("#country > div").hide();
		$(id).show();
		$(this).addClass("active");
		if (device != "desktop")
			$("html, body").animate({ scrollTop: $(id).offset().top }, 500);
	});
});