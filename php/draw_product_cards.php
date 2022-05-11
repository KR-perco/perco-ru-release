<?
$date = ' € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.Y").')</span>';
$elemetsList = ""; 
// if ($arResult["NAME"] == "Терминалы распознавания лиц") {
// 	$hidePriceClass = "hide";
// }

foreach ($products as $product){
	if ($price_res){
		$rubls = number_format(round($product['price'] * $price_res, 2), 0, '.', ' '); 
		if ($rubls != 0) {
			$rus_price = '<p>Цена <span class="price_rub">'.$rubls.' &#8381;</span> со склада в Москве и Санкт-Петербурге</p>';  
			// $rus_price = '<p class="'.$hidePriceClass.'">Цена <span class="price_rub">'.$rubls.' &#8381;</span> со склада в Москве и Санкт-Петербурге</p>'; 
		} else {
			
			$rus_price = ' '; 
		}
	}
	$elemetsList .= ' 
					<div class="secel_item">
						<a class="nohover">
							<div class="image_icon">
								<img alt="'.$product['name'].'" src="'.$product['image'].'">
							</div>
							<div class="text_item">
								<span style="text-decoration: none;">'.$product['name'].'</span>
								<div class="price">
									'.$rus_price.'
									<p class="price_eur">'.$product['price'].$date.'</p>
									<p>'.$product['description'].'</p>
									<p>'.$product['info'].'</p>
								</div>
							</div>
						</a>
					</div>';

}

$php_result1 = '<div id="secel_list">'.$elemetsList.'</div>';
echo $php_result1;

?>