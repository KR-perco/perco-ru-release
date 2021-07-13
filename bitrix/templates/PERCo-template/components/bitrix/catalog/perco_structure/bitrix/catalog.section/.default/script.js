$(function(){
	if ($("div").is("#sheme_skud"))
	{
		$("#sheme_skud").lightGallery({
			selector: "a",
			zoom: true,
			download: true
		});
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
	}
});