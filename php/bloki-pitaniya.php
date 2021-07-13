<?
//$APPLICATION->SetPageProperty("description", '');
$price_res = getCurrency("EUR");

$products = array(
    "Poliservis BRP-24-9-TI" => array(
		"name" => "Полисервис БРП-24-9-ТИ",
		"image" => "/images/products/bloki-pitaniya/Poliservis-BRP-24-9-TI.jpg",
		"description" => "",
		"price" => "106"
    ),
	"K-Inzhenering BIRP-24-6-0" => array(
		"name" => "К-Инженеринг БИРП 24/6",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-24-6-0.jpg",
		"description" => "",
		"price" => "86"
	),
	"K-Inzhenering BIRP-24-2-5" => array(
		"name" => "К-Инженеринг БИРП 24/2,5",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-24-2-5.jpg",
		"description" => "",
		"price" => "58"
    ),
	"K-Inzhenering BIRP-12-2-5" => array(
		"name" => "К-Инженеринг БИРП 12-2,5/7",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-12-2-5.jpg",
		"description" => "",
		"price" => "30"
	),
	"K-Inzhenering BIRP-12-10-0" => array(
		"name" => "К-Инженеринг БИРП 12/10",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-12-10-0.jpg",
		"description" => "",
		"price" => "66"
	),
	"LRS-150-24 Blok pitaniya" => array(
		"name" => "LRS-150-24 Блок питания",
		"image" => "/images/products/bloki-pitaniya/LS-100-24.jpg",
		"description" => "",
		"price" => "15"
	),
	"LRS-100-12 Blok pitaniya" => array(
		"name" => "LRS-100-12 Блок питания",
		"image" => "/images/products/bloki-pitaniya/LS-100-12.jpg",
		"description" => "",
		"price" => "14"
	),
	"BP-ZA Blok pitaniya" => array(
		"name" => "БП-3А Блок питания",
		"image" => "/images/products/bloki-pitaniya/BP-ZA.jpg",
		"description" => "",
		"price" => "12"
	),
	"BP-1A Blok pitaniya" => array(
		"name" => "БП-1А Блок питания",
		"image" => "/images/products/bloki-pitaniya/BP-1AM.jpg",
		"description" => "",
		"price" => "8"
	),"BP-24 Blok pitaniya" => array(
		"name" => "БП-24 Блок питания",
		"image" => "/images/products/bloki-pitaniya/BP-24-5.jpg",
		"description" => "",
		"price" => "21"
	),
	"akkumulyatornaya batareya 12v 7ac" => array(
		"name" => "Аккумуляторная батарея 12 В 7А*ч",
		"image" => "/images/products/bloki-pitaniya/akkumulyatornaya-batareya-12v-7ac.png",
		"description" => "",
		"price" => "15"
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