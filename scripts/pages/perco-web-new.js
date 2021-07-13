$(function(){
	$("#horizontal_scroll > #scrollGallery").lightSlider({
		item: 1,
		pager: false,
		loop: false,
		adaptiveHeight:true,
		arrowsGray: true
	});
	$('#video-gallery').lightGallery({
		zoom: true,
		youtubePlayerParams: {
			modestbranding: 0,
			showinfo: 0,
			rel: 0,
			controls: 1
		}
	}); 
	$('#video-gallery-two').lightGallery({
		zoom: true,
		youtubePlayerParams: {
			modestbranding: 0,
			showinfo: 0,
			rel: 0,
			controls: 1
		}
	}); 
});


// $('div.col-table').click(function () {
// 	$('div.col-table').toggleClass('smaller', 200);
// 	$('div.col-table').toggleClass('col-table-rotate');
// });


function showjpg(state) {
	document.getElementById('bio_img').style.display = state;
}