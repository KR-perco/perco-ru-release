<p>Подать заявку для участия в семинаре может только авторизованная компания. В отсутствии учетной записи компании – Вам необходимо зарегистрировать компанию и сотрудников: <a href="/client/company/zayavka/">Регистрация</a>. Если компания была зарегистрирована ранее, Вы можете <a href="/client/company/zayavka/">подать заявку</a>. Для пользователя, авторизованного как «сотрудник», подача заявки невозможна – только Ваша компания может это сделать.</p>
<p>Адрес завода PERCo: Псков, ул. Леона Поземского, 123в. Телефон для справки: +7 (800) 333-52-53.</p>
<center>
<?
$lat = 57.843911695199786;
$lon = 28.304833763113688;
$text_placemark = '<b>Завод в Пскове</b><br />Псков, ул. Леона Поземского 123в<br />Телефон: +7 (8112) 79-47-00';
$arMap[] = array('TEXT' => $text_placemark,
	'LON' => $lon,
	'LAT' => $lat,
	'MARK' => "/images/icons/perco-logo-zavod.png",
	'MARK_WIDTH' => 97,
	'MARK_HEIGHT' => 67,
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
<p>Мы поможем Вам забронировать гостиницу и организуем доставку из гостиницы в Учебный центр PERCo. Для участников семинара организованы бесплатные кофе-брейки и горячие обеды.</p>
<p>Участники семинара получают комплект технической документации и рекламной продукции.</p>
<p>Будем рады видеть Вас на наших семинарах.</p>