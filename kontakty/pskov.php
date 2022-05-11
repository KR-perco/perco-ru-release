<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->ShowHead();
$APPLICATION->SetPageProperty("title", "Склад и завод в Пскове");
$APPLICATION->SetPageProperty("description", "Склад и завод в Пскове");
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
	$lat = 57.834232;
	$lon = 28.304282;
	$map = "MAP";
	$controls = array("ZOOM", "TYPECONTROL", "SCALELINE");
	$options = array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING");
}
elseif ($_REQUEST["map"] == "google")
{ 
	$apiKey = $google;
	$lat = 57.8350352;
	$lon = 28.3037491;
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
$text_placemark = '<b>Склад в Пскове</b><br />ул. Леона Поземского, д. 110д, лит. В, пом. 1001<br />Телефон: +7 (8112) 23-07-40';
$arMap[] = array('TEXT' => $text_placemark,
	'LON' => $lon,
	'LAT' => $lat,
	'MARK' => $geoPointer,
	'MARK_WIDTH' => 97,
	'MARK_HEIGHT' => 67,
	'OFFSET_WIDTH' => -32,
	'OFFSET_HEIGHT' => -66
);
$lat_c = ($lat + 57.84386601371021)/2;
$lon_c = ($lon + 28.30501230544183)/2;
if ($_REQUEST["map"] == "yandex")
{
	$lat = 57.843911695199786;
	$lon = 28.304833763113688;
}
elseif ($_REQUEST["map"] == "google")
{
	$lat = 57.84435682077121;
	$lon = 28.304274808938974;
}
$text_placemark = '<b>Завод в Пскове</b><br />Псков, ул. Леона Поземского 123в<br />Телефон: +7 (8112) 79-47-00';
$arMap[] = array('TEXT' => $text_placemark,
	'LON' => $lon,
	'LAT' => $lat,
	'MARK' => $geoPointer,
	'MARK_WIDTH' => 97,
	'MARK_HEIGHT' => 67,
	'OFFSET_WIDTH' => -32,
	'OFFSET_HEIGHT' => -66
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
	"fullWindow",
	Array(
		"API_KEY" => $apiKey,
		"INIT_MAP_TYPE" => $map,
		"MAP_DATA" => serialize(array(
				$_REQUEST["map"].'_lat' => $lat_c,
				$_REQUEST["map"].'_lon' => $lon_c,
				$_REQUEST["map"].'_scale' => 15,
				// $_REQUEST["map"].'_scale' => 14, if mobile
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