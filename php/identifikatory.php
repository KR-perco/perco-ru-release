<?
$APPLICATION->SetPageProperty("description", 'Бесконтактные карты используются в системах контроля доступа для идентификации. В системах PERCo применяются бесконтактные карты доступа форматов EMM, HID (HID ProxCard II, ISO prox II; EM-Marin IL-05ELR, ЕМ4100) и MIFARE.');
$price_res = getCurrency("EUR");

$products = array(
    "beskontaktnyy-brelok-plastik-abs-em-marin" => array(
		"name" => "Бесконтактный брелок (пластик ABS) EM-Marin",
		"image" => "11_card_small.jpg",
		"description" => "Рабочая частота: 125 КГц",
		"price" => "0.27"
	),
	"beskontaktnyy-brelok-plastik-abs-mifare-classic-1k" => array(
		"name" => "Бесконтактный брелок (пластик ABS) Mifare Classic 1K",
		"image" => "9_card_small.jpg",
		"description" => "Рабочая частота: 13,56 МГц",
		"price" => "0.27"
	),
	"beskontaktnyy-brelok-kozha-em-marin" => array(
		"name" => "Бесконтактный брелок (кожа) EM-Marin",
		"image" => "10_card_small.jpg",
		"description" => "Рабочая частота: 125 КГц",
		"price" => "1"
		// "info" => "*только для использования на дверных контроллерах"
	),
	"beskontaktnyy-brelok-kozha-mifare-classic-1k" => array(
		"name" => "Бесконтактный брелок (кожа) Mifare Classic 1K ",
		"image" => "10_card_small.jpg",
		"description" => "Рабочая частота: 13,56 МГц ",
		"price" => "1.2",
		"info" => "*только для использования на дверных контроллерах"
	),
	"beskontaktnaya-karta-dostupa-em-marin-slim" => array(
		"name" => "Бесконтактная карта доступа EM-Marin Slim",
		"image" => "3_card_small.jpg",
		"description" => "Рабочая частота: 125 КГц",
		"price" => "0.21"
	),
	"beskontaktnaya-karta-dostupa-mifare-classic-1k-slim" => array(
		"name" => "Бесконтактная карта доступа Mifare Classic 1K Slim",
		"image" => "2_card_small.jpg",
		"description" => "Рабочая частота: 13,56 МГц",
		"price" => "0.28"
	),
	"beskontaktnaya-karta-dostupa-mifare-plus-x-4k-slim" => array(
		"name" => "Бесконтактная карта доступа Mifare Plus X 4K Slim",
		"image" => "1_card_small.jpg",
		"description" => "Рабочая частота: 13,56 МГц",
		"price" => "1"
	),
	"beskontaktnaya-karta-dostupa-em-marin" => array(
		"name" => "Бесконтактная карта доступа EM-Marin",
		"image" => "5_card_small.jpg",
		"description" => "Рабочая частота: 125 КГц",
		"price" => "0.18"
	),
	"beskontaktnaya-karta-dostupa-mifare-classic-1k" => array(
		"name" => "Бесконтактная карта доступа Mifare Classic 1K",
		"image" => "4_card_small.jpg",
		"description" => "Рабочая частота: 13,56 МГц ",
		"price" => "0.25"
	),
	"radiochastotnaya-metka-iso18000-860-960mgts-saat-t821l-bumaga" => array(
		"name" => "Радиочастотная метка ISO18000 (860-960МГЦ) SAAT-T821l (бумага)",
		"image" => "7_card_small.jpg",
		"description" => "Дальность считывания до 8 м",
		"price" => "1"
	),
	"radiochastotnaya-metka-iso18000-860-960mgts-saat-822-plastikovaya-karta" => array(
		"name" => "Радиочастотная метка ISO18000 (860-960МГЦ) SAAT-T822 (пластиковая карта)",
		"image" => "6_card_small.jpg",
		"description" => "Дальность считывания до 8 м",
		"price" => "1.54"
	),
	"radiochastotnaya-metka-iso18000-860-960mgts-saat-824l-plastikovyy-korpus" => array(
		"name" => "Радиочастотная метка ISO18000 (860-960МГЦ) SAAT-T824L (пластиковый корпус)",
		"image" => "8_card_small.jpg",
		"description" => "Дальность считывания до 8 м",
		"price" => "4.73"
	),
	"nekleiki-dlya-pechati-dlya-oformlyniya-kart-dostupa" => array(
		"name" => "Наклейки для печати для оформления карт доступа",
		"image" => "12_card_small.png",
		"description" => "",
		"price" => "0.1"
	)
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
								<img alt="'.$product['name'].'" src="/images/products/identifiers/'.$product['image'].'">
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