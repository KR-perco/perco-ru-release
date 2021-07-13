$(document).ready(function() {
	$(".komplekt").click(function(){
		id = $(this).attr("data-id");
		if ($(id).css("display") == "none")
			$(id).show();
		else
			$(id).hide();
	});
});