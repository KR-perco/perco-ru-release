<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
// CMain::IncludeFile("lang/".LANGUAGE_ID."/where-to-buy.php");
include($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/PERCo-template/lang/".LANGUAGE_ID."/where-to-buy.php");
$APPLICATION->SetAdditionalCSS("/css/gde-kupit-details.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/gde-kupit-details.js"); // подключение скриптов
?>
<div id="content">
<?
$CountryID = "";
$CityID;
// Получаем данные о стране ->
CModule::IncludeModule("iblock");
$resCountry = CIBlockElement::GetList(Array("SORT"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "CODE" => $_REQUEST["country"]), array("ID", "IBLOCK_ID", "CODE", "PROPERTY_NAME"));
if (!intval($resCountry->SelectedRowsCount()))
{
	header("HTTP/1.1 404 Not Found");
	@define("ERROR_404","Y");
}
else
{
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
			$city_title = ", ".$city_region;
		}
	}
	elseif (isset($_REQUEST["region"]))
	{
		// Выбираем города, если в фильтре указан регион ->
		$resFilterRegion = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "SECTION_CODE" => $_REQUEST["region"]), array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "CODE", "NAME"));
		while($arFilterRegion = $resFilterRegion->GetNext())
		{
			if (!$sectionID)
				$sectionID = $arFilterRegion["IBLOCK_SECTION_ID"];
			$CityID[] = $arFilterRegion["ID"];
		}
		$res = CIBlockSection::GetByID($sectionID);
		if($ar_res = $res->GetNext())
		{
			$city_region = $ar_res["NAME"];
			$city_title = ", ".$city_region;
		}
		// <- Выбираем города
	}
	$resStatus = CIBlockPropertyEnum::GetList(Array("SORT"=>"ASC"), Array("IBLOCK_CODE"=>"our_partners", "CODE"=>"STATUS"));
	$status = "";
	while ($arStatus = $resStatus->GetNext())
	{
		switch($arStatus["VALUE"])
		{
			case "Авторизованный дилер и сервисный центр":
				$statusID = "adsc";
				$inform = "рекомендованные партнеры по продажам, установке, гарантийному и сервисному обслуживанию систем и оборудования PERCo";
				break;
			case "Сервисный центр":
				$statusID = "sci";
				$inform = "рекомендованные партнеры по гарантийному, сервисному обслуживанию и установке систем и оборудования PERCo, осуществляют продажу всего спектра продукции PERCo";
				break;
			case "Авторизованный инсталлятор":
				$statusID = "ai";
				$inform = "рекомендованные партнеры по установке систем и оборудования PERCo";
				$arStatus["VALUE"] = $arStatus["VALUE"] . ", торговый партнер";
				break;
			case "Сертифицированный торговый партнер":
				$statusID = "stp";
				$inform = "компании, осуществляющие продажу товаров PERCo";
				break;
		}
		$status .= '<div class="status_element '.$active.'" data-id="'.$statusID.'">
				<img alt="'.$arStatus["VALUE"].'" src="/images/icons/'.$statusID.'.svg" />
				<div>
					<div class="status_name"><input id="'.$statusID.'" type="checkbox" /><label for="'.$statusID.'">'.$arStatus["VALUE"].'</label><div class="info_img">
						<img alt="Информация" src="/images/icons/inform.svg" />
						<div id="'.$statusID.'" class="inform">'.$inform.'</div></div>
					</div>
				</div>
			</div>';
	}
	if ($_REQUEST["city"] || $_REQUEST["region"])
	{
		$clear = '<div id="clear_filter"><div id="cl_city_region"><a href="'.$_SERVER["REDIRECT_URL"].'">'.$city_region.'<img src="/images/icons/cross.svg" /></a></div></div>';
	}
	// <- Блок с фильтрами
	$APPLICATION->AddChainItem($name, "");
	$APPLICATION->SetPageProperty("title", GetMessage("WTBTITLE") . " - " . $name);
	$APPLICATION->SetPageProperty("keywords", GetMessage("WTBKEYWORDS"));
	$APPLICATION->SetPageProperty("description", GetMessage("WTBDESCRIPTION") . " - " . $name);
	$APPLICATION->SetTitle($name.$city_title);

	if ($_REQUEST["sc"] == "Y")
	{
		$scl = true;
		$statusSC = array("Авторизованный дилер и сервисный центр", "Сервисный центр");
	}
	if ($_REQUEST["kit"] == "Y")
		$kit = false;
	$resCounter = CIBlockElement::GetList(Array(), Array("IBLOCK_CODE" => "our_partners", "ACTIVE" => "Y", "PROPERTY_COUNTRY" => $CountryID, "PROPERTY_CITY" => $CityID, "PROPERTY_STATUS_VALUE" => $statusSC, "!PROPERTY_STEND" => $kit), false, array("nPageSize"=>10));
	// $counter = intval($resCounter->SelectedRowsCount()); // Высчитываем количество элементов для прерывания цикличного обращения
	if ($_REQUEST["country"] == "rossiya")
	{
		// Выборка по российским городам, чтобы не было городов без компаний ->
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_CITY");
		$arFilter = Array(
			"IBLOCK_CODE" => "our_partners",
			"ACTIVE"=>"Y", 
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
		$all_cities = intval($resCity->SelectedRowsCount()) - 2;
		$city = "";
		$arCityScript = array();
		$arRegionScript = array();
		while($arCity = $resCity->Fetch())
		{
			$arCityScript[$arCity["CODE"]] = array("url"=>$arCity["CODE"], "name"=>$arCity["PROPERTY_NAME_VALUE"]);
			if (count($idRegion) < 2)
			{
				$regionCity .= '<div class="city_name" data-id="'.$arCity["CODE"].'">';
				if ($_REQUEST["city"] != $arCity["CODE"])
					$regionCity .= '<a href="'.$_SERVER["REDIRECT_URL"]."?city=".$arCity["CODE"].'">'.$arCity["PROPERTY_NAME_VALUE"].'</a>';
				else
					$regionCity .= $clear;
				$regionCity .= '</div>';
				$idRegion[] = $arCity["IBLOCK_SECTION_ID"];
				continue;
			}
			$idRegion[] = $arCity["IBLOCK_SECTION_ID"];
			$city .= '<div class="city_name" data-id="'.$arCity["CODE"].'">';
			if ($_REQUEST["city"] != $arCity["CODE"])
				$city .= '<a href="'.$_SERVER["REDIRECT_URL"]."?city=".$arCity["CODE"].'">'.$arCity["PROPERTY_NAME_VALUE"].'</a>';
			else
				$city .= $clear;
			$city .= '</div>';
		}
		// <- Отображаем блок с городами
		// Отображаем блок с регионами ->
		$idRegion = array_unique($idRegion);
		$resRegion = CIBlockSection::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), array("IBLOCK_CODE" => "cities", "ACTIVE"=>"Y", "ID" => $idRegion), array("ID", "IBLOCK_ID", "CODE", "NAME"));
		$all_regions = intval($resRegion->SelectedRowsCount());
		$column = ceil((count($idRegion)+2) / 5);
		$count = 0;
		$addCityToRegion = false;
		$region = "";
		while($arRegion = $resRegion->Fetch())
		{
			$arRegionScript[$arRegion["CODE"]] = array("url"=>$arRegion["CODE"], "name"=>$arRegion["NAME"]);
			$count++;
			if ($count == 1)
				$region .= '<div class="region_block">';
			if (!$addCityToRegion)
			{
				$region .= $regionCity;
				$addCityToRegion = true;
				if ($column == 2)
					$region .= '</div><div class="region_block">';
			}
			$region .= '<div class="region_name" data-id="'.$arRegion["CODE"].'">';
			if ($_REQUEST["region"] != $arRegion["CODE"])
				$region .= '<a href="'.$_SERVER["REDIRECT_URL"]."?region=".$arRegion["CODE"].'">'.$arRegion["NAME"].'</a>';
			else
				$region .= $clear;
			$region .= '</div>';
			if ($count == $column || $all_regions == 1)
			{
				$region .=  '</div>';
				$count = 0;
			}
			$all_regions--;
		}
		// <- Отображаем блок с регионами
?>
<script type="text/javascript">
massCities = new Object();
massCities = <?=json_encode($arCityScript);?>;
massRegions = new Object();
massRegions = <?=json_encode($arRegionScript);?>;
</script>
<? if (!$scl) { ?>
<div id="mapBlock"><? include($_SERVER["DOCUMENT_ROOT"]."/images/where-to-buy/map-russia.svg");?></div>
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<div id="regions"><?=$region;?></div>
	<input id="allcity" type="checkbox" />
	<label for="allcity">Выбрать другой город</label>
	<div id="cities"><?=$city;?></div>
	<div id="status"><a name="begin"></a><?=$status;?></div>
<?
		}
	}
	if ($_REQUEST["country"] != "rossiya" && !$scl)
	{
		echo "<h1>";
		$APPLICATION->ShowTitle(false, false);
		echo "</h1>";
	}
?>
	<span id="counter" data-count="<?=$resCounter->NavPageCount;?>"></span>
	<div id="companies">
<?$APPLICATION->IncludeFile(GetMessage("FOLDER")."company_list.php");?>
	</div>
<? } ?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>