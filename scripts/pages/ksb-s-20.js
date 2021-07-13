$(function(){
	window.addEventListener('load', () => {
		$("#horizontal_scroll > #scrollGallery1").lightSlider({
			item: 1,
			pager: false,
			loop: true,
			adaptiveHeight:true,
		});
		if (window.location.pathname.search('percoMobile') != -1) {
			document.querySelector('#elements_list .element_item:nth-child(1) a').href = '/percoMobile/products/po-kompleksnoy-sistemy-bezopasnosti-perco-s-20/';
			document.querySelector('#elements_list .element_item:nth-child(2) a').href = '/percoMobile/products/kontrollery-schityvateli/';
			document.querySelector('#elements_list .element_item:nth-child(3) a').href = 'bxlocal://buklet_skd.pdf';
			document.querySelector('#elements_list .element_item:nth-child(4) a').href = '/percoMobile/video/?worker=installer';
			document.querySelector('#elements_list .element_item:nth-child(5) a').href = '/percoMobile/documentation/?section=kompleksnaya-sistema-bezopasnosti-perco-s-20';
		} else if (window.location.pathname.search('percoDemo') != -1) {
			document.querySelector('#elements_list .element_item:nth-child(1) a').href = '/percoDemo/products/po-kompleksnoy-sistemy-bezopasnosti-perco-s-20/';
			document.querySelector('#elements_list .element_item:nth-child(2) a').href = '/percoDemo/products/kontrollery-schityvateli/';
			document.querySelector('#elements_list .element_item:nth-child(3) a').href = 'bxlocal://buklet_skd.pdf';
			document.querySelector('#elements_list .element_item:nth-child(4) a').href = '/percoDemo/video/?worker=installer';
			document.querySelector('#elements_list .element_item:nth-child(5) a').href = '/percoDemo/documentation/?section=kompleksnaya-sistema-bezopasnosti-perco-s-20';
		}
	});
});