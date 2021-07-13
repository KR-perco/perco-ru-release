$(function(){
	$("#kachestvo").lightGallery({
		selector: "this",
		download: false,
		iframeMaxWidth: "80%"
	});
	$(".play_video").lightGallery();
// create the panorama player with the container
	pano=new pano2vrPlayer("virtual-tour");
// add the skin object
	skin=new pano2vrSkin(pano);
// load the configuration
	window.addEventListener("load", function() {
		pano.readConfigUrlAsync("/scripts/virtual-tour/pano.xml",function() {  /* gyro=new pano2vrGyro(pano,"container"); */});
	});
	$('.video-gallery').lightGallery({
		youtubePlayerParams: {
			modestbranding: 1,
			showinfo: 0,
			rel: 0,
			youtubeThumbSize: 'default'
		}
	}); 
});