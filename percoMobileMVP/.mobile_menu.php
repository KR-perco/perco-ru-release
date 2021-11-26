<?
use \Bitrix\Main\Localization\Loc;
Loc::loadLanguageFile(__FILE__);
$appDir = "/percoMobileMVP/";
$items = array(
	array(
		"text" => "ТЕСТ3",
		"data-url" => SITE_DIR."percoMobileMVP/test",
		"id" => "test", 
	),
	array(
		"text" => "Каталог",
		"data-url" => SITE_DIR."percoMobileMVP/products/",
		"id" => "products",
		"image"=>"img/menu-catalog.png",
	),
	array(
		"text" => "Видео",
		"data-url" => SITE_DIR."percoMobileMVP/video/",
		"id"=>"video",
		"image"=>"img/menu-video.png",
	),
	array(
		"text" => "Скачать",
		//"data-url" => SITE_DIR."percoMobileMVP/offline/documentation.html",
		"data-url" => SITE_DIR."percoMobileMVP/documentation/",
		"id"=>"documentation",
		//"id"=>"offline/documentation.html",
		"image"=>"img/menu-download.png",
	),
	array(
		"text" => "Контакты",
		"data-url" => SITE_DIR."percoMobileMVP/offline/contacts.html",
		"id"=>"offline/contacts.html",
		"image"=>"img/menu-contacts.png",
	),
	array(
		"text" => "Написать",
		"data-url" => SITE_DIR."percoMobileMVP/letter/",
		"id"=>"letter",
		"image"=>"img/menu-letter.png",
	),
	array(
		"text" => "О компании",
		"data-url" => SITE_DIR."percoMobileMVP/about/",
		"id"=>"about",
		"image"=>"img/menu-about.png",
	),
	array(
		"text" => "О приложении",
		"data-url" => SITE_DIR."percoMobileMVP/offline/app.html",
		"id"=>"offline/app.html",
		"image"=>"img/menu-app.png",
	),
);


$arMobileMenuItems = array(
	array(
		"type" => "section",
		"text" => "Главная",
		"sort" => "100",
		"items" =>	array(
			array(
				"text" => "Главная",
				"data-url" => $appDir."index.php",
				"class" => "menu-item",
				"id" => "main",
				"image" => "img/menu-home.png"
			),
		)
	)
);


foreach ($items as $item)
{
	$arMobileMenuItems[0]["items"][] = array(
		"text" => $item["text"],
		"data-url" => $appDir."/".$item["id"],
		"class" => "menu-item",
		"id" => "main",
		"image" => $item["image"],
	);
}
?>