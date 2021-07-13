<?
$price_res = getCurrency("EUR");

$products = array(
	"dvernye-ruchki" => array(
		"name" => "Дверные ручки",
		"image" => "/images/products/dvernye-ruchki-i-furnitura-k-elektromekhanicheskim-zamkam/all.png",
		"description" => "",
		"price" => "5"
    ),
    "datchik-kontrolya-zony-prokhoda" => array(
		"name" => "Цилиндр замковый с фиксатором 60 мм, хром",
		"image" => "/images/products/dvernye-ruchki-i-furnitura-k-elektromekhanicheskim-zamkam/DSC_4201.png",
		"description" => "",
		"price" => "3.5"
    ),
	"sirena" => array(
		"name" => "Декоративные накладки для цилиндра замка, хром",
		"image" => "/images/products/dvernye-ruchki-i-furnitura-k-elektromekhanicheskim-zamkam/DSC_4087.png",
		"description" => "",
		"price" => "2"
    ),
);

$date = ' € (по курсу ЦБ РФ на '.date("d.m.Y").')';
$elemetsList = "";

foreach ($products as $product){
	if ($price_res){
		$rubls = round($product['price'] * $price_res, 2);
		$rus_price = '<p>Цена <span class="price_rub">'.$rubls.' &#8381;</span> со склада в Москве и Санкт-Петербурге</p>';
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