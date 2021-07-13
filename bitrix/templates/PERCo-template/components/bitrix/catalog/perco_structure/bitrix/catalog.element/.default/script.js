$(function(){
	$(".newcolor").lightGallery({
		selector: "a"
	});
	$("#shema").lightGallery({
		selector: "a"
	});
	$("#sheme_skud").lightGallery({
		selector: "a",
		zoom: true,
		download: true
	});
	$(".video").lightGallery({
		selector: ".itemVideo",
		zoom: true,
		download: true,
		youtubePlayerParams: {
			modestbranding: 0,
			showinfo: 0,
			rel: 0,
			controls: 1
		}
	});
	$('.review').lightGallery({
		selector: "div",
		zoom: false,
		download: true,
		youtubePlayerParams: {
			modestbranding: 0,
			showinfo: 0,
			rel: 0,
			controls: 1
		}		
	});
	$("#main_image_list").lightSlider({
		gallery: true,
		item: 1,
		thumbItem: 6,
		slideMargin: 0,
		controls: false,
		enableDrag: false,
		mode: "fade",
		onSliderLoad: function(el) {
			el.lightGallery({
				selector: "#main_image_list .lslide"
			});
		}
	});

	if (document.querySelectorAll(`.lSPager.lSGallery li`).length == 1) {
		document.querySelector(`.lSPager.lSGallery`).remove();
	}
	
	if (location.hash == '#shema') {
		console.log(document.querySelector('#shema'));
		document.querySelector('#shema>a').dispatchEvent(new Event('click'));
	}

	// $("#sheme_skud > a").on("click", function(){				// Правим размеры для корректного отображения Схемы СКУД на разных экранах
		// if ($(".lg-video-cont").hasClass("lg-has-html5") == false)
		// {
			// $(".lg-video-cont").css("max-width", "100%");
			// var iframe = document.getElementsByTagName("iframe")[0];
			// iframe.onload = function() {
				// var iframeDoc = iframe.contentWindow.document;
				// var height = window.innerHeight;
				// var width = window.innerWidth;
				// var heightB = iframeDoc.getElementById("svgShema").clientHeight;
				// $(".lg-video").css("height", heightB);
				// var widthB = iframeDoc.getElementById("svgShema").clientWidth;
				// var rateProp = widthB / heightB;
				// if (width > widthB && height < heightB)
					// width = height*rateProp;
				// else
					// width = heightB*rateProp;
				// iframeDoc.getElementById("svgShema").style.width = width + "px";
			// }
		// }
	// });
});