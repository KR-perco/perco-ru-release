<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->ShowHead();
$APPLICATION->SetPageProperty("title", "Склад-офис в Санкт-Петербурге");
$APPLICATION->SetPageProperty("description", "Склад-офис в Санкт-Петербурге");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->ShowTitle(false, false);

include 'secret.php'; 
?>
<style type="text/css">
.bx-yandex-view-map {
	display: flex;
	justify-content: center;
}
.bx-core body {
	justify-content: center;
}
</style>
<?
if ($_REQUEST["map"] == "yandex")
{
	$apiKey = $yandexMapAPI;
	$lat = 51.8848441;
	$lon = 4.615007;
	$map = "MAP";
	$controls = array("ZOOM", "TYPECONTROL", "SCALELINE");
	$options = array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING");
}
elseif ($_REQUEST["map"] == "google")
{ 
	$apiKey = $google;
	$lat = 51.8848441;
	$lon = 4.615007;
	$map = "ROADMAP";
	$controls = array(
		0 => "SMALL_ZOOM_CONTROL",
		1 => "TYPECONTROL",
		2 => "SCALELINE",
	);
	$options = array(
		0 => "ENABLE_SCROLL_ZOOM",
		1 => "ENABLE_DBLCLICK_ZOOM",
		2 => "ENABLE_DRAGGING",
	);
}
$text_placemark = '<b>Склад в Роттердаме</b><br />Ringdijk 374 - 378, 2983 GS Ridderkerk';
$arMap[] = array('TEXT' => $text_placemark,
	'LON' => $lon,
	'LAT' => $lat,
	'MARK' => "/images/icons/perco-logo.png",
	'MARK_WIDTH' => 75,
	'MARK_HEIGHT' => 59,
	'OFFSET_WIDTH' => -24,
	'OFFSET_HEIGHT' => -58
);
switch($device)
{
	case "tablet":
		$max_width = "600";
		$max_height = "400";
		break;
	case "mobile":
		$max_width = "300";
		$max_height = "200";
		break;
	default:
		$max_width = "900";
		$max_height = "600";
		break;
}
$APPLICATION->IncludeComponent(
	"bitrix:map.".$_REQUEST["map"].".view",
	"",
	Array(
		"API_KEY" => $apiKey,
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => serialize(array(
				$_REQUEST["map"].'_lat' => $lat,
				$_REQUEST["map"].'_lon' => $lon,
				$_REQUEST["map"].'_scale' => 15,
				'PLACEMARKS' => $arMap,
			)
		),
		"MAP_WIDTH" => $max_width,
		"MAP_HEIGHT" => $max_height,
		"CONTROLS" => $controls,
		"OPTIONS" => $options,
		"MAP_ID" => ""
	),
false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>