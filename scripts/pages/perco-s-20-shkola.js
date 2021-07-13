window.addEventListener('load', () => {
	if (window.location.pathname.search('percoMobile') != -1 || window.location.pathname.search('percoDemo') != -1) {
		$(".img_items").lightGallery({
			selector: "a"
		});
		document.querySelector('#elements_list .element_item:nth-child(1) a').href = '/percoDemo/products/po-sistemy-bezopasnosti-dlya-shkol-perco-s-20-shkola/';
		document.querySelector('#elements_list .element_item:nth-child(2) a').href = '/percoDemo/products/kontrollery-schityvateli/';
		document.querySelector('#elements_list .element_item:nth-child(3) a').href = 'bxlocal://buklet-shkola-perco.pdf';
		document.querySelector('#elements_list .element_item:nth-child(4) a').href = '/percoDemo/documentation/?section=sistema-bezopasnosti-perco-s-20-shkola';
	}
});