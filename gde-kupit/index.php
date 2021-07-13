<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
CMain::IncludeFile("lang/".LANGUAGE_ID."/where-to-buy.php");

$APPLICATION->SetTitle(GetMessage("SETTITLE"));
$APPLICATION->SetPageProperty("title", GetMessage("WTBTITLE"));
$APPLICATION->SetPageProperty("keywords", GetMessage("WTBKEYWORDS"));
$APPLICATION->SetPageProperty("description", GetMessage("WTBDESCRIPTION"));

$APPLICATION->SetAdditionalCSS("/css/gde-kupit.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/gde-kupit.js"); // подключение скриптов
?>
<div id="mapBlock">
<? include($_SERVER["DOCUMENT_ROOT"]."/images/where-to-buy/world-map.svg");?>
</div>
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<div id="countries">
<?
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_COUNTRY");
$arFilter = Array(
	"IBLOCK_CODE" => "our_partners",
	"ACTIVE"=>"Y", 
	"!PROPERTY_COUNTRY" => false
);
$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, $arSelect);
while($ar_fields = $res->GetNext())
{
	if (!in_array($ar_fields["PROPERTY_COUNTRY_VALUE"], $idCountry))
		$idCountry[] = $ar_fields["PROPERTY_COUNTRY_VALUE"];
}
$idCountry = array_unique($idCountry);
$column = ceil(count($idCountry) / 8);
$count = 0;
$resCountry = CIBlockElement::GetList(Array("SORT"=>"ASC", "NAME"=>"ASC"), array("IBLOCK_CODE" => "countries", "ACTIVE"=>"Y", "ID" => $idCountry), array("ID", "IBLOCK_ID", "CODE"));
$all_countries = intval($resCountry->SelectedRowsCount());
while($arCountry = $resCountry->GetNextElement())
{
	$arFields = $arCountry->GetFields();
	$arProps = $arCountry->GetProperties();
	$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
	if (LANGUAGE_ID != "ru" && in_array("Россия", $arProps["NAME"]["VALUE"]))
	{
		$url = GetMessage("RUSSIA");
		$url_full = '<a href="'.GetMessage("RUSSIA").'"><img alt="'.$arProps["NAME"]["VALUE"][$keyName].'" src="/images/flags/iso/'.$arFields["CODE"].'.gif" />'.$arProps["NAME"]["VALUE"][$keyName].'</a>';
	}
	else
	{
		$url = $arFields["CODE"];
		$url_full = '<a href="'.$_SERVER["REQUEST_URI"].$arFields["CODE"].'/"><img alt="'.$arProps["NAME"]["VALUE"][$keyName].'" src="/images/flags/iso/'.$arFields["CODE"].'.gif" />'.$arProps["NAME"]["VALUE"][$keyName].'</a>';
	}
	$arCountryScript[$arFields["CODE"]] = array("url"=>$url, "name"=>$arProps["NAME"]["VALUE"][$keyName]);
	$arCountryMass[$arProps["NAME"]["VALUE"][$keyName]] = array("url"=>$url_full, "code"=>$arFields["CODE"]);
}
if (LANGUAGE_ID != "ru")
{
	ksort($arCountryMass);
	reset($arCountryMass);
}
foreach($arCountryMass as $country)
	echo '<div class="country_name" data-id="'.$country["code"].'">'.$country["url"].'</div>';
if (LANGUAGE_ID == "en")
	echo '<div class="dop_text_wtb"><p>If you would like to become PERCo sales partner please fill-out and submit the registration <a href="/contacts.php">form</a> or <a href="mailto:export@perco.ru">email</a> us and we will contact you shortly.</p>
		<p>To find more information about PERCo partnership benefits, please visit <a href="/about/become-a-sales-partner.php">Become a sales partner</a>.</p>
		<p>Please be advised that your privacy is very important to us. PERCo will not distribute your e-mail address to anyone else and will use it for the sole purpose of keeping you current on products, services, and technical updates.</p></div>';
?>
	</div>
</div>
<script type="text/javascript">
massCountries = new Object();
massCountries = <?=json_encode($arCountryScript);?>;
</script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>