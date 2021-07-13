window.addEventListener('load', () => {
	document.querySelectorAll('.storages__tab').forEach(tab => {
		tab.addEventListener('click', function () {
			document.querySelector('.storages__tab_active').classList.remove('storages__tab_active');
			this.classList.add('storages__tab_active');
			document.querySelectorAll(`.storages__item`).forEach(item => {
				item.classList.remove('storages__item_active');
			});
			document.querySelector(`.${this.dataset.target}`).classList.add('storages__item_active');
			//alert(`.${this.dataset.target}`);
		});
	});
});

/* <![CDATA[ */
var google_conversion_id = 988809681;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "4KZTCP-RogUQ0ZPA1wM";
var google_conversion_value = 0;
/* ]]> */
$(function(){
	$(".map").lightGallery({
		selector: "a",
		zoom: false,
		download: false,
		iframeMaxWidth: "80%"
	});
});