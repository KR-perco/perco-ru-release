<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "ImageGallery");
CMain::IncludeFile("lang/".LANGUAGE_ID."/gallery.php");
$APPLICATION->SetPageProperty("title", GetMessage("TITLE"));
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));
$APPLICATION->SetPageProperty("description", GetMessage("DESCRIPTION"));
$APPLICATION->SetTitle(GetMessage("SETTITLE"));
//\Bitrix\Main\UI\Extension::load("ui.vue");
//$APPLICATION->SetAdditionalCSS("/css/fotogalereya.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/fotogalereya.js"); // подключение скриптов
?>

<h1><?$APPLICATION->ShowTitle(false, false)?></h1>

<?
$APPLICATION->IncludeComponent("bitrix:news.list", "gallery-list", array(
	"IBLOCK_TYPE" => "images",
	"IBLOCK_ID" => 18,
	"PARENT_SECTION" => 1777,
	"PARENT_SECTION_CODE" => "",
	"NEWS_COUNT" => "1000",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER2" => "ASC",
	"USE_FILTER" => "N",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "TYPE_OBJECT"
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "gallery",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	),
	false
);?>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>