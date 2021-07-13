<p>Подать заявку для участия в семинаре может только авторизованная компания. В отсутствии учетной записи компании – Вам необходимо зарегистрировать компанию и сотрудников: <a href="/client/company/zayavka/">Регистрация</a>. Если компания была зарегистрирована ранее, Вы можете <a href="/client/company/zayavka/">подать заявку</a>. Для пользователя, авторизованного как «сотрудник», подача заявки невозможна – только Ваша компания может это сделать.</p>
<p>Адрес офиса PERCo: Санкт-Петербург, ул. Политехническая д.4 к.2. Телефон для справки: +7 (812) 247-04-54.</p>
<center>
<?
$lat = 59.992142;
$lon = 30.353670;
$text_placemark = 'Санкт-Петербург, ул. Политехническая д.4 к.2<br />Телефон: +7 (812) 247-04-54';
$arMap[] = array('TEXT' => $text_placemark,
	'LON' => $lon,
	'LAT' => $lat,
	'MARK' => "/images/icons/perco-logo.png",
	'MARK_WIDTH' => 75,
	'MARK_HEIGHT' => 59,
	'OFFSET_WIDTH' => -32,
	'OFFSET_HEIGHT' => -66
);
$controls = array("ZOOM", "TYPECONTROL", "SCALELINE");
$options = array("ENABLE_SCROLL_ZOOM", "ENABLE_DBLCLICK_ZOOM", "ENABLE_DRAGGING");
switch($device)
{
	case "mobile":
		$max_width = "300";
		$max_height = "200";
		break;
	default:
		$max_width = "600";
		$max_height = "353";
		break;
}
$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view",
	"",
	Array(
		"INIT_MAP_TYPE" => $map,
		"MAP_DATA" => serialize(array(
				'yandex_lat' => $lat,
				'yandex_lon' => $lon,
				'yandex_scale' => 14,
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
</center>
<p>Для участников семинара организованы бесплатные кофе-брейки и горячие обеды.</p>
<p>Участники семинара получают комплект технической документации и рекламной продукции.</p>
<p>Будем рады видеть Вас на наших семинарах.</p>