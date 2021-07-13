$(function(){
	$(".prod_first .product_item").hover(
		function(){
			$(this).find(".hide").show();
		},
		function(){
			$(this).find(".hide").hide();
		}
	);
});