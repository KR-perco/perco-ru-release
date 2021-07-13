$(function(){
	$(".newcolor").lightGallery({
		selector: "a"
	});
	$("#shema").lightGallery({
		selector: "a"
	});
	$("#sheme_skud").lightGallery({
		selector: "a",
		zoom: false,
		download: false
	});
	$(".video").lightGallery({
		selector: ".play",
		zoom: false,
	});
	$("#main_image_list").lightSlider({
		gallery: true,
		item: 1,
		thumbItem: 6,
		slideMargin: 0,
		controls: false,
		enableDrag: false,
		adaptiveHeight:true,
		mode: "fade",
		// onSliderLoad: function() {
			// $("#main_image_list").removeClass("cS-hidden");
		// }
		onSliderLoad: function(el) {
			el.lightGallery({
				selector: "#main_image_list .lslide"
			});
		}
	});
	$("#sheme_skud > a").on("click", function(){				// Правим размеры для корректного отображения Схемы СКУД на разных экранах
		if ($(".lg-video-cont").hasClass("lg-has-html5") == false)
		{
			$(".lg-video-cont").css("max-width", "100%");
			var iframe = document.getElementsByTagName("iframe")[0];
			iframe.onload = function() {
				var iframeDoc = iframe.contentWindow.document;
				var height = window.innerHeight;
				var width = window.innerWidth;
				var heightB = iframeDoc.getElementById("svgShema").clientHeight;
				$(".lg-video").css("height", heightB);
				var widthB = iframeDoc.getElementById("svgShema").clientWidth;
				var rateProp = widthB / heightB;
				if (width > widthB && height < heightB)
					width = height*rateProp;
				else
					width = heightB*rateProp;
				iframeDoc.getElementById("svgShema").style.width = width + "px";
			}
		}
	});
});