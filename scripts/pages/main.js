$(function(){
	$("#slider").lightSlider({
		item: 1,
		mode: "fade",
		auto: true,
		loop: true,
		pause: 3000,
		speed: 3000,
	});
	$("#banners.bmob").lightSlider({
		item: 6,
		adaptiveHeight: true,
		slideMargin: 10,
		pager: false,
		controls: true,
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
// Перехват события addClass, не меняя его действия - добавляем свое событие на него
	var origFn = $.fn.addClass;
	$.fn.addClass = function(){
		if ($("li.active").parent().attr("id") == "slider")
		{
			$(".resheniya_links div").removeClass();
			var ahref = $("#slider li.active > a").attr("href");
			$(".resheniya_links a[href='"+ahref+"']").parent().attr("class", "active");
		}
		return origFn.apply(this, arguments);
	}
	
	if (LANGUAGE_ID == `ru`) {
		document.querySelector(`.head-tel`).addEventListener(`click`, function (e) {
			ga('send', 'event', {'eventCategory': 'number', 'eventAction': 'click', 'eventLabel': '8 (800) 333-52-53'});
		});

		document.querySelector(`.head-tel2`).addEventListener(`click`, function (e) {
			ga('send', 'event', {'eventCategory': 'number', 'eventAction': 'click', 'eventLabel': '8 (812) 247-04-57'});
		});
		
		document.querySelector(`.footer-tel`).addEventListener(`click`, function (e) {
			ga('send', 'event', {'eventCategory': 'number', 'eventAction': 'click', 'eventLabel': '8 (800) 333-52-53 footer'});
		});
	}

	/*document.querySelector(`.head-teldzp`).addEventListener(`click`, function (e) {
		//console.log(this);
	});*/
});