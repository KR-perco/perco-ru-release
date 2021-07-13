<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CMain::IncludeFile("lang/".LANGUAGE_ID."/about.php");

// $APPLICATION->SetAdditionalCSS("/css/video_details.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/video_details.js"); // подключение скриптов
?> 
<div id="content">
<?
$iblocks = GetIBlockList("video", "video_files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.element", "video_play", array(
	"IBLOCK_TYPE" => "video",
	"IBLOCK_ID" => $block_id,
	"ELEMENT_ID" => "",
	"ELEMENT_CODE" => $_REQUEST["CODE"],
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"PROPERTY_CODE" => array(
		0 => "VFILE",
		1 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "",
	"META_DESCRIPTION" => "",
	"BROWSER_TITLE" => "",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#"
	),
	false
);?>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>