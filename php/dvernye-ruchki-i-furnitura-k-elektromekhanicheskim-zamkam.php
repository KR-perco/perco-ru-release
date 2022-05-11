<?
$price_res = getCurrency(CURRENCY_SWITCH);

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

include 'draw_product_cards.php'; 
?>