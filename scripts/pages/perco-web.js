$(function(){
	$("#horizontal_scroll > #scrollGallery").lightSlider({
		item: 1,
		pager: false,
		loop: false,
		adaptiveHeight:true,
	});
	$('#video-gallery').lightGallery({
		zoom: false,
		youtubePlayerParams: {
			modestbranding: 0,
			showinfo: 0,
			rel: 0,
			controls: 1
		}
	}); 
});


function showjpg(state) {
	document.getElementById('bio_img').style.display = state;
}