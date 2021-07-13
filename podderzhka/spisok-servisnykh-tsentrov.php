<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
$APPLICATION->SetAdditionalCSS("/css/spisok-servisnykh-tsentrov.css"); // подключение стилей
$APPLICATION->SetAdditionalCSS("/css/gde-kupit-details.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/spisok-servisnykh-tsentrov.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/pages/gde-kupit-details.js"); // подключение скриптов

if (!$_REQUEST["country"])
	$_REQUEST["country"] = "rossiya";
$arCountries = array("rossiya"=>"Россия", "BY" => "Беларусь", "KZ" => "Казахстан", "UA" => "Украина");
foreach($arCountries as $key => $val)
{
	if ($_REQUEST["country"] == $key)
	{
		$countries .= '<div class="region_name active" data-id="'.$key.'">'.$val.'</div>';
		$countrie_title = " — ".$val;
	}
	else
	{
		if ($key == "rossiya")
			$countries .= '<div class="region_name" data-id="'.$key.'"><a href="/podderzhka/spisok-servisnykh-tsentrov.php">'.$val.'</a></div>';
		else
			$countries .= '<div class="region_name" data-id="'.$key.'"><a href="/podderzhka/spisok-servisnykh-tsentrov.php?country='.$key.'">'.$val.'</a></div>';
	}
}
$CountryID = "";
$CityID = "";
// Получаем данные о стране ->
CModule::IncludeModule("iblock");
$resCountry = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "CODE" => $_REQUEST["country"]), array("ID", "IBLOCK_ID", "CODE", "PROPERTY_NAME"));
while($arCountry = $resCountry->GetNextElement())
{
	$arFields = $arCountry->GetFields();
	$CountryID = $arFields["ID"];
	$arProps = $arCountry->GetProperties();
	$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
	$name = $arProps["NAME"]["VALUE"][$keyName];
	break;
}
// <- Получаем данные о стране
// Блок с фильтрами ->
if (isset($_REQUEST["city"]))
{
	$resFilterCity = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "CODE" => $_REQUEST["city"]), array("ID", "IBLOCK_ID", "CODE", "NAME"));
	if ($arFilterCity = $resFilterCity->Fetch())
	{
		$CityID = $arFilterCity["ID"];
		$city_region = $arFilterCity["NAME"];
		$city_title = ", ".$arFilterCity["NAME"];
	}
}
if ($_REQUEST["city"])
	$clear = '<div id="clear_filter"><div id="cl_city_region"><a href="'.$_SERVER["PHP_SELF"].'">'.$city_region.'<img alt="Очистить" src="/images/icons/cross.svg" /></a></div></div>';
// <- Блок с фильтрами
$APPLICATION->AddChainItem("Список сервисных центров", "");
$APPLICATION->SetPageProperty("title", "Список сервисных центров".$countrie_title.$city_title);
$APPLICATION->SetPageProperty("keywords", "сервисные центры");
$APPLICATION->SetPageProperty("description", "В сервис-центрах PERCo".$countrie_title.$city_title." работают квалифицированные специалисты, имеется необходимое диагностическое оборудование и запчасти");
$APPLICATION->SetTitle("Список сервисных центров".$countrie_title.$city_title);

$scl = true;
$statusSC = array("Авторизованный дилер и сервисный центр", "Сервисный центр");
$resCounter = CIBlockElement::GetList(Array(), Array("IBLOCK_CODE" => "our_partners", "ACTIVE" => "Y", "PROPERTY_COUNTRY" => $CountryID, "PROPERTY_CITY" => $CityID, "PROPERTY_STATUS_VALUE" => $statusSC), false, array("nPageSize"=>10));
// $counter = intval($resCounter->SelectedRowsCount()); // Высчитываем количество элементов для прерывания цикличного обращения
if ($_REQUEST["country"] == "rossiya")
{
	// Выборка по российским городам, чтобы не было городов без компаний ->
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CITY");
	$arFilter = Array(
		"IBLOCK_CODE" => "our_partners",
		"ACTIVE"=>"Y",
		"PROPERTY_STATUS_VALUE" => $statusSC,
		"!PROPERTY_CITY" => false
	);
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, $arSelect);
	while($ar_fields = $res->GetNext())
	{
		if (!in_array($ar_fields["PROPERTY_CITY_VALUE"], $idCity) && is_numeric($ar_fields["PROPERTY_CITY_VALUE"]))
			$idCity[] = $ar_fields["PROPERTY_CITY_VALUE"];
	}
	// <- Выборка по российским городам
	// Отображаем блок с городами ->
	$resCity = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "ID" => $idCity), array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "SECTION_CODE", "CODE", "PROPERTY_NAME"));
	$all_cities = intval($resCity->SelectedRowsCount());
	$column = ceil(count($idCity)/5);
	$city = "";
	$arCityScript = array();
	$arRegionScript = array();
	while($arCity = $resCity->Fetch())
	{
		$arCityScript[$arCity["CODE"]] = array("url"=>$arCity["CODE"], "name"=>$arCity["PROPERTY_NAME_VALUE"]);
		$city .= '<div class="city_name" data-id="'.$arCity["CODE"].'">';
		if ($_REQUEST["city"] != $arCity["CODE"])
			$city .= '<a href="'.$_SERVER["REDIRECT_URL"]."?city=".$arCity["CODE"].'">'.$arCity["PROPERTY_NAME_VALUE"].'</a>';
		else
			$city .= $clear;
		$city .= '</div>';
	}
	// <- Отображаем блок с городами
?>
<script type="text/javascript">
massCities = new Object();
massCities = <?=json_encode($arCityScript);?>;
</script>
<? } ?>
<div id="mapBlock"><? include($_SERVER["DOCUMENT_ROOT"]."/images/where-to-buy/map-sng.svg");?></div>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Список сервисных центров" src="/images/icons/services-list.svg" />
	</div>
	<p>К Вашим услугам – разветвленная сеть региональных сервис-центров, куда Вы можете обратиться для выполнения гарантийного или негарантийного ремонта. В сервис-центрах PERCo работают квалифицированные специалисты, имеется необходимое диагностическое оборудование и запчасти.</p>
	<p>Услуги, предоставляемые сервис-центрами PERCo:</p>
	<ul>
		<li>продажа оборудования и запчастей;</li>
		<li>гарантийный и послегарантийный ремонт оборудования;</li>
		<li>технические консультации;</li>
		<li>обучение пользователей;</li>
		<li>монтаж и пусконаладка оборудования, инсталляция и настройка ПО.</li>
	</ul>
	<p>Преимущества обращения за приобретением и монтажом оборудования PERCo к Авторизованному дилеру или Сервисному центру PERCo:</p>
	<ul>
		<li>бесплатный выезд специалиста этой компании для гарантийного ремонта на объекте</li>
		<li>продление срока гарантии – он исчисляется с момента сдачи оборудования в эксплуатацию, а не с даты продажи</li>
	</ul>
	<p>Сервис-центры обслуживают всех покупателей продукции PERCo: бизнес-партнеров, монтажно-строительные организации и конечных пользователей. По вопросам, связанным с работой сервис-центров компании, пожалуйста, обращайтесь в <a href="/podderzhka/servisnoe-obsluzhivanie.php">Департамент сервисного обслуживания PERCo</a>.</p>
	<div id="countries"><?=$countries;?></div>
<? if ($_REQUEST["country"] == "rossiya") { ?>
	<input id="allcity" type="checkbox" />
	<label for="allcity">Выбрать другой город</label>
	<div id="cities"><?=$city;?></div>
<? } ?>
	<span id="counter" data-count="<?=$resCounter->NavPageCount;?>"></span>
	<div id="companies">
<?$APPLICATION->IncludeFile("/gde-kupit/company_list.php");?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>