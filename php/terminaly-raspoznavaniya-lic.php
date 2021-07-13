<?
$price_res = getCurrency("EUR");

console_log("element php");
console_log($arResult);
$products = array(
    "ZKTeco FaceDepot-7B" => array(
		"name" => "ZKTeco FaceDepot-7B",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/zkteco-facedepot-7b.jpg",
		"description" => "",
		"price" => "550"
    ),
	"ZKTeco FaceDepot-7A" => array(
		"name" => "ZKTeco FaceDepot-7A",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/zkteco-facedepot-7a.jpg",
		"description" => "",
		"price" => "626"
	),
	"ZKTeco ProFace X" => array(
		"name" => "ZKTeco ProFace X",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/zkteco-profacex.jpg",
		"description" => "",
		"price" => "815"
    ),
	"ZKTeco SpeedFace V5L [TD]" => array(
		"name" => "ZKTeco SpeedFace V5L [TD]",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/zkteco-speedface-v5l-td.jpg",
		"description" => "",
		"price" => "964"
    ),
	"Suprema Face Station 2" => array(
		"name" => "Suprema Face Station 2",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/suprema-facestation-2.jpg",
		"description" => "",
		"price" => "798"
	),
	"Suprema FACELite" => array(
		"name" => "Suprema FACELite",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/suprema-facelite.jpg",
		"description" => "",
		"price" => "556"
	),
);

$date = ' € (по курсу ЦБ РФ на '.date("d.m.Y").')';
$elemetsList = "";

foreach ($products as $product){
	 
	if ($price_res){
		$rubls = round($product['price'] * $price_res, 2);
		$rus_price = '<p>Цена <span class="price_rub">'.number_format($rubls, 0, '.', ' ').' &#8381;</span> со склада в Москве и Санкт-Петербурге</p>';
	}
	$elemetsList .= '
					<style>
						a.nohover:hover, .text_item span:hover{
							cursor:auto !important;
						}
					</style>

					<div class="secel_item">
						<a class="nohover">
							<div class="image_icon">
								<img alt="'.$product['name'].'" src="'.$product['image'].'">
							</div>
							<div class="text_item">
								<span style="text-decoration: none;">'.$product['name'].'</span>
								<div class="price">
									'.$rus_price.'
									<p>'.$product['price'].$date.'</p>
									<p>'.$product['description'].'</p>
									<p>'.$product['info'].'</p>
								</div>
							</div>
						</a>
					</div>';
					 

}

$php_result = '<div id="secel_list">'.$elemetsList.'</div>';
?>