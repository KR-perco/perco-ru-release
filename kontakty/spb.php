<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->ShowHead();
$APPLICATION->SetPageProperty("title", "Склад-офис в Санкт-Петербурге");
$APPLICATION->SetPageProperty("description", "Склад-офис в Санкт-Петербурге");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->ShowTitle(false, false);
?>
<style type="text/css">
.bx-yandex-view-map {
	display: flex;
	justify-content: center;
}
</style>
<?
if ($_REQUEST["map"] == "yandex")
{
	$lat = 59.992191;
	$lon = 30.35357;
	$map = "MAP";
	$controls = array("ZOOM", "TYPECONTROL", "SCALELINE");
	$options = array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING");
}
elseif ($_REQUEST["map"] == "google")
{
	$google = "AIzaSyCFHN1XhrSfBpHfr9CEhLLUNSUqr3_aIf8";
	$lat = 59.992168;
	$lon = 30.353522;
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

if ($_REQUEST["type"] == "offise") { 
	$text_placemark = '<b>Главный офис в Санкт-Петербурге</b><br />Санкт-Петербург, Политехническая ул., д. 4, корпус 2,<br />Телефон: +7 (812) 247-04-54';
} else { 
	$text_placemark = '<b>Склад-офис в Санкт-Петербурге</b><br />Санкт-Петербург, Политехническая ул., д. 4, корпус 2,<br />Телефон: +7 (812) 247-04-54';
}
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
		"API_KEY" => $google,
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