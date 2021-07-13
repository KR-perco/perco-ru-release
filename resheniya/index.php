<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "CollectionPage");
$APPLICATION->SetTitle("Решения");
$APPLICATION->SetPageProperty("title", "Готовые решения PERCo для повышения уровня безопасности объектов");
$APPLICATION->SetPageProperty("description", "Готовые решения PERCo позволяют повысить уровень безопасности таких объектов, как промышленные предприятия, бизнес-центры, офисы, государственные учреждения, школы, спортивные и развлекательные учреждения");
$APPLICATION->SetPageProperty("keywords", "готовые решения, решения, повышение безопасности объектов");

$APPLICATION->SetAdditionalCSS("/css/resheniya.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/resheniya.js"); // подключение скриптов

$iblocks = GetIBlockList("structure", "resheniya");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
?>
<div id="content">
	<h1> <?$APPLICATION->ShowTitle(false, false)?> </h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"resheniya",
	Array(
		"IBLOCK_TYPE" => "structure",
		"IBLOCK_ID" => $block_id,
		"NEWS_COUNT" => "",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"ICON",1=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>