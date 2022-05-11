<?
//$APPLICATION->SetPageProperty("description", '');
$price_res = getCurrency(CURRENCY_SWITCH);

$products = array(
    "Poliservis BRP-24-9-TI" => array(
		"name" => "Полисервис БРП-24-9-ТИ",
		"image" => "/images/products/bloki-pitaniya/Poliservis-BRP-24-9-TI.jpg",
		"description" => "",
		"price" => "170"
    ),
	"K-Inzhenering BIRP-24-6-0" => array(
		"name" => "К-Инженеринг БИРП 24/6",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-24-6-0.jpg",
		"description" => "",
		"price" => "96"
	),
	"K-Inzhenering BIRP-24-2-5" => array(
		"name" => "К-Инженеринг БИРП 24/2,5",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-24-2-5.jpg",
		"description" => "",
		"price" => "76"
    ),
	"K-Inzhenering BIRP-12-2-5" => array(
		"name" => "К-Инженеринг БИРП 12-2,5/7",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-12-2-5.jpg",
		"description" => "",
		"price" => "34"
	),
	"K-Inzhenering BIRP-12-10-0" => array(
		"name" => "К-Инженеринг БИРП 12/10",
		"image" => "/images/products/bloki-pitaniya/K-Inzhenering-BIRP-12-10-0.jpg",
		"description" => "",
		"price" => "95"
	),
    "Blok pitaniya HRP-300-24" => array(
		"name" => "HRP-300-24 Блок питания",
		"image" => "/images/products/bloki-pitaniya/00_HRP-300-24_catalog.jpg",
		"description" => "",
		"price" => "95"
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
		"price" => "15"
	),
	"BP-1A Blok pitaniya" => array(
		"name" => "БП-1А Блок питания",
		"image" => "/images/products/bloki-pitaniya/BP-1AM.jpg",
		"description" => "",
		"price" => "12"
	),"BP-24 Blok pitaniya" => array(
		"name" => "БП-24-5 Блок питания",
		"image" => "/images/products/bloki-pitaniya/BP-24-5.jpg",
		"description" => "",
		"price" => "26"
	),
	"akkumulyatornaya batareya 12v 7ac" => array(
		"name" => "Аккумуляторная батарея 12 В 7А*ч",
		"image" => "/images/products/bloki-pitaniya/akkumulyatornaya-batareya-12v-7ac.png",
		"description" => "",
		"price" => "15"
	),
);
include 'draw_product_cards.php'; 
?>