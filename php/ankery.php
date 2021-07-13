<?
$price_res = getCurrency("EUR");

$products = array(
    "anker-pfg-ir-m16x25-s-boltom-din912-tsink-vnutrenniy-shestigrannik" => array(
		"name" => "Анкер PFG IR M16x25 (с болтом DIN912 цинк, внутренний шестигранник)",
		"image" => "/images/products/anchors/pfg-ir-m16x25.png",
		"description" => "",
		"price" => "3.5"
    ),
	"anker-pfg-ih-m-10-s-boltom-din-7984-nerzh-a2-vnutrenniy-shestigrannik" => array(
		"name" => "Анкер PFG IH M 10 с болтом DIN 7984 нерж. A2, внутренний шестигранник",
		"image" => "/images/products/anchors/pfg-ih-m10.png",
		"description" => "",
		"price" => "1.9"
    ),
	"anker-pfg-ih-m-8-15-s-boltom-m8x50-din-7984-nerzh-a2-vnutrenniy-shestigrannik" => array(
		"name" => "Анкер PFG IH M 8 - 15 с болтом M8x50 DIN 7984 нерж. A2, внутренний шестигранник",
		"image" => "/images/products/anchors/pfg-ih-m8-15.png",
		"description" => "",
		"price" => "1.5"
    ),
	"anker-fwb-6-fisher-s-vintom-m-6-x-40-din-965-tsink-potay" => array(
		"name" => "Анкер FWB 6 Fisher (с винтом M 6 x 40 DIN 965 (цинк, потай)",
		"image" => "/images/products/anchors/fwb-6-fischer.png",
		"description" => "",
		"price" => "0.7"
    ),
	"anker-pfg-ir-m-10-15" => array(
		"name" => "Анкер PFG IR M 10 - 15",
		"image" => "/images/products/anchors/pfg-ir-m10-15.png",
		"description" => "",
		"price" => "1.7"
    ),
	"anker-pfg-ir-m-8-25" => array(
		"name" => "Анкер PFG IR M 8 - 25",
		"image" => "/images/products/anchors/pfg-ir-m8-25.png",
		"description" => "",
		"price" => "1.6"
    ),
	"klinovyy-anker-sormat-s-ka-16-95-so-shpilkoy" => array(
		"name" => "Клиновый анкер «SORMAT» S-KA 16/95 (со шпилькой)",
		"image" => "/images/products/anchors/sormat-s-ka-16-95.png",
		"description" => "",
		"price" => "3.4"
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