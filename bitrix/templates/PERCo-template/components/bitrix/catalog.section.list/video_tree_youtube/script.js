$(function(){
	
	var section = getQueryVariable("section");
	var btns = document.getElementsByClassName("scroll-btn");

	for (var i = 0; i < btns.length; i++) {
		if ( section == $(btns[i]).attr('data-section') ){
			$(btns[i]).addClass("active");
			
		}else if( section == '' ){
			$(btns[0]).addClass("active");
		}
	}
    


	var videos = [];

	$('#lightSlider').lightSlider({
		//LAZY LOADING
		onBeforeStart: function($el) {
			var src_iframe = $el.find('li iframe').first().attr('data-src');
			var iframe = $el.find('li iframe').first();
			videos.push(src_iframe);
			iframe.attr('src', src_iframe);
			iframe.css('display', 'initial');

			var src_description = $el.find('li .description');
			var description = $el.find('li .description').first();
			$(description).innerHTML = src_description;
					
		},
		onSliderLoad: function($el) {
			$('.lSPrev').hide();
	
		},
		onAfterSlide: function($el, scene) {
			$('.video iframe').each(function(){
				this.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*')
			});
			$('html, body').animate({
				scrollTop: $("#video-gallery").offset().top
			}, 300);
			var iframe = $el.find('iframe').eq($el.getCurrentSlideCount() - 1);
			var iframe_src = iframe.attr('data-src');

			if (!find(videos, iframe_src)){	
				videos.push(iframe_src);
				iframe.attr('src', iframe_src);
				iframe.css('display', 'initial');
				if ($el.getCurrentSlideCount() == 1) {
					$('.lSPrev').hide();
				} else if ($el.getCurrentSlideCount() == $el.find('li').length) {
					$('.lSNext').hide();
				} else {
					$('.lSPrev').show();
					$('.lSNext').show();
				}
			}
		},
		gallery: true,
		item: 1,
		loop: false,
		slideMargin: 0,
		keyPress: true,
		speed: 0,
		controls: false,
		enableDrag: false
	});
});

function find(array, value) {

	for (var i = 0; i < array.length; i++) {
		if (array[i] == value) return true;
	}

	return false;
}

function getQueryVariable(variable) {
	var query = window.location.search.substring(1);
	var vars = query.split('&');
	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split('=');
		if (decodeURIComponent(pair[0]) == variable) {
			return decodeURIComponent(pair[1]);
		}
	}
	console.log('Query variable %s not found', variable);
	return '';
}
