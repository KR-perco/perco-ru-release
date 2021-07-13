<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="countries">
<?
foreach($arResult["ITEMS"] as $arValue)
{
	if (!in_array($arValue["PROPERTIES"]["COUNTRY"]["VALUE"], $idCountry))
		$idCountry[] = $arValue["PROPERTIES"]["COUNTRY"]["VALUE"];
	if (!in_array($arValue["PROPERTIES"]["INDUSTRY"]["VALUE"], $idIndustry))
		$idIndustry[] = $arValue["PROPERTIES"]["INDUSTRY"]["VALUE"];
}
$idCountry = array_unique($idCountry);
$idIndustry = array_unique($idIndustry);
$column = ceil(count($idCountry) / 4);
$count = 0;
// Получаем список стран ->
$resCountry = CIBlockElement::GetList(Array("NAME"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "ID" => $idCountry), array("ID", "IBLOCK_ID", "CODE"));
$all_countries = intval($resCountry->SelectedRowsCount());
while($arCountry = $resCountry->GetNextElement())
{
	$arFields = $arCountry->GetFields();
	$arProps = $arCountry->GetProperties();
	$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
	if (!in_array($arFields["CODE"], $codeCountry))
		$codeCountry[] = array("code" => $arFields["CODE"], "name" => $arProps["NAME"]["VALUE"][$keyName]);
	$arCountryMass[$arProps["NAME"]["VALUE"][$keyName]] = array("name"=>$arProps["NAME"]["VALUE"][$keyName], "code"=>$arFields["CODE"]);
}
ksort($arCountryMass);
reset($arCountryMass);
foreach($arCountryMass as $country)
{
?>
	<div class="country_name <?if ($country["code"] == "rossiya") echo "active";?>" data-id="<?=$country["code"];?>">
		<img width="25" height="15" alt="" src="/images/flags/iso/<?=$country["code"];?>.gif">
		<span><?=$country["name"];?></span>
	</div>
<?
}
$arCountries = array_combine($idCountry, $codeCountry);
// <- Получаем список стран

// Получаем список индустрий ->
$resIndustry = CIBlockElement::GetList(Array("NAME"=>"ASC"), array("IBLOCK_CODE" => "industry", "ACTIVE"=>"Y", "ID" => $idIndustry), array("ID", "IBLOCK_ID", "CODE"));
while($arIndustry = $resIndustry->GetNextElement())
{
	$arFields = $arIndustry->GetFields();
	$arProps = $arIndustry->GetProperties();
	$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
	if (!in_array($arFields["CODE"], $arIndustries))
		$arIndustries[$arFields["ID"]] = $arProps["NAME"]["VALUE"][$keyName];
}
// <- Получаем список индустрий
?>
</div>
<div id="country">
<?
$start = 0;
$count = count($arResult["ITEMS"]);
foreach($arResult["ITEMS"] as $arValue)
{
	$keyNameVal = array_search(LANGUAGE_ID, $arValue["PROPERTIES"]["NAME"]["DESCRIPTION"]);
	if ($start == 0)
	{
		$country = current($arCountries);
		$industry = $arValue["PROPERTIES"]["INDUSTRY"]["VALUE"];
		echo '<div id="'.$country["code"].'">';
		echo "<h2>".$country["name"]."</h2>";
		echo "<strong>".$arIndustries[$industry]."</strong>";
		echo "<ul>";
	}
	$start++;
	if ($keyNameVal === false)
		continue;
	if (key($arCountries) != $arValue["PROPERTIES"]["COUNTRY"]["VALUE"])
	{
		echo "</ul></div>";
		$country = next($arCountries);
		echo '<div id="'.$country["code"].'">';
		echo "<h2>".$country["name"]."</h2>";
		$industry = $arValue["PROPERTIES"]["INDUSTRY"]["VALUE"];
		echo "<strong>".$arIndustries[$industry]."</strong>";
		echo "<ul>";
	}
	if ($industry != $arValue["PROPERTIES"]["INDUSTRY"]["VALUE"])
	{
		echo "</ul>";
		$industry = $arValue["PROPERTIES"]["INDUSTRY"]["VALUE"];
		echo "<strong>".$arIndustries[$industry]."</strong>";
		echo "<ul>";
	}
	if ($arValue["PROPERTIES"]["IMAGE"]["VALUE"])
	{
		$arFilter = Array("IBLOCK_ID"=>$arProps["IMAGE"]["LINK_IBLOCK_ID"], "ID" => $arValue["PROPERTIES"]["IMAGE"]["VALUE"]);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_*");
		$resElement = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
		$obElement = $resElement->GetNextElement();
		// $arElementFields = $obIBlock->GetFields();
		$arPropsImg = $obElement->GetProperties();
		$keyFullImg = array_search(LANGUAGE_ID, $arPropsImg["FULL_OPIS"]["DESCRIPTION"]);
		echo '<li><a href="'.$arPropsImg["FULL"]["VALUE"].'" data-sub-html="'.$arPropsImg["FULL_OPIS"]["VALUE"][$keyFullImg].'" title="'.$arPropsImg["FULL_OPIS"]["VALUE"][$keyFullImg].'">'.$arValue["PROPERTIES"]["NAME"]["VALUE"][$keyNameVal].'</a></li>';
	}
	else
		echo "<li>".$arValue["PROPERTIES"]["NAME"]["VALUE"][$keyNameVal]."</li>";
	if ($start == $count)
		echo "</ul></div>";
}
?>
</div>