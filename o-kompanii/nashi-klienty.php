<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Наши клиенты", ""); //$country_company
$APPLICATION->SetPageProperty("title", "Оборудование PERCo установлено в " . $country_company . " стране мира");
$APPLICATION->SetPageProperty("description", "Правительственные и коммерческие организации в 80 странах мира сделали свой выбор в пользу систем безопасности и оборудования PERCo");
$APPLICATION->SetPageProperty("keywords", "партнеры perco, системы безопасности");
$APPLICATION->SetTitle("Наши клиенты");

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
	<?//новые клиенты
	include('/home/d/dc178435/perco.ru/public_html/upload/clients.php');
	//конец новых клиентов?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>