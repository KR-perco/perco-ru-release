<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Наши клиенты", "");
$APPLICATION->SetPageProperty("title", "Оборудование PERCo установлено в 80 странах мира");
$APPLICATION->SetPageProperty("description", "Правительственные и коммерческие организации в 80 странах мира сделали свой выбор в пользу систем безопасности и оборудования PERCo");
$APPLICATION->SetPageProperty("keywords", "партнеры perco, системы безопасности");
$APPLICATION->SetTitle("Наши клиенты");

if (!$USER->IsAdmin()) {
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
}

$APPLICATION->SetAdditionalCSS("/css/nashi-klienty.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/nashi-klienty.js"); // подключение скриптов

if ($device!="desktop")
	echo '<style type="text/css">body #container { flex-direction: column; }#horizontal_scroll { margin: 20px 0 0 0 !important; }</style>';
?>
<div <?echo ($device=="desktop") ? 'id="scroll"' : 'id="horizontal_scroll" style="order: 1;"';?>>
<script type="text/javascript" src="/scripts/pages/o-kompanii-clients.js"></script>
<?
global $arrFilter;
$arrFilter["PROPERTY_TYPE_PRODUCT.CODE"] = "";
$APPLICATION->IncludeComponent("bitrix:news.list", "perco_scroll", array(
	"IBLOCK_TYPE" => "images",
	"IBLOCK_ID" => "18",
	"PARENT_SECTION" => "1777",
	"PARENT_SECTION_CODE" => "",
	"NEWS_COUNT" => "1000",
	"SORT_BY1" => "ID",
	"SORT_ORDER1" => "DESC",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER2" => "ASC",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "TYPE_PRODUCT"
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
	"PAGER_TEMPLATE" => "",
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
</div>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Партнеры PERCo в <?=$country_company;?> странах мира – это компании, занимающиеся продажами, монтажом и обслуживанием оборудования и систем безопасности PERCo. Среди клиентов PERCo – коммерческие и государственные организации, промышленные предприятия, банки, бизнес-центры, аэропорты, морские порты, транспортные терминалы, выставочные центры, университеты, музеи, горнолыжные курорты, супермаркеты, спортивно-развлекательные заведения и другие учреждения. Ниже приведены география продаж и список некоторых из многих тысяч объектов, где установлено и успешно работает оборудование PERCo – турникеты, электронные проходные, электромеханические замки, системы контроля доступа, комплексные системы безопасности.</p>
<?
$iblocks = GetIBlockList("partners", "our_clients");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:news.list", "our_clients", array(
	"IBLOCK_TYPE" => "partners",
	"IBLOCK_ID" => $block_id,
	"NEWS_COUNT" => "1000",
	"SORT_BY1" => "PROPERTY_COUNTRY.NAME",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "PROPERTY_INDUSTRY.SORT",
	"SORT_ORDER2" => "ASC",
	"USE_FILTER" => "N",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "",
		1 => "COUNTRY",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "Y",
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
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Новости",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>