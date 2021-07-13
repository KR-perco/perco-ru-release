$(function(){
	if (device == "desktop")
	{
		$("#horizontal-multilevel-menu li").hover(
			function(){
				var left = ($(this).find(".podmenu").width()-20)/2+"px";
				$(this).find(".podmenu").before('<style type="text/css">.corner::before, .corner::after { content: ""; position: absolute; left: '+left+'; top: -16px; border: 8px solid transparent; border-bottom: 8px solid #003C8E; } .corner::after { border-bottom: 8px solid white; top: -15px; }</style>');
				$(this).find(".podmenu ul").addClass("corner");
				$(this).find(".podlozhka").css("width", $(this).width()+"px");
			},
			function(){
				$(this).find("style").remove();
				$(this).find(".podmenu ul").removeClass("corner");
			}
		);
	}
});