$(function(){
	$("#feed > ul").lightSlider({
		item: 4,
		slideMargin: 10,
		pager: false,
		adaptiveHeight: true,
		responsive : [
			{
				breakpoint: 1150,
				settings: {
					item: 3,
				}
			},
			{
				breakpoint: 950,
				settings: {
					item: 2,
				}
			},
			{
				breakpoint: 720,
				settings: {
					item: 1,
				}
			}
		]
	});
});