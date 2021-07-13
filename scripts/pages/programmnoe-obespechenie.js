$(function(){
	$("#horizontal_scroll > #scrollGallery").lightSlider({
		item: 1,
		pager: false,
		loop: false,
		adaptiveHeight:true,
		arrowsGray: true
	});
	
});


function showBlock(state) {
		document.getElementById(state).checked = true;
}