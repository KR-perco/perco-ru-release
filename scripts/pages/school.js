$(function(){
	$("#horizontal_scroll > #scrollGallery").lightSlider({
		item: 3,
		pager: false,
		loop: true,
		responsive : [
			{
				breakpoint: 1120,
				settings: {
					item: 2,
				}
			},
			{
				breakpoint: 790,
				settings: {
					item: 1,
				}
			}
		]
	});
});