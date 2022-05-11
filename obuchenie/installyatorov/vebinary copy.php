<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Интернет-семинары", "");
$APPLICATION->SetPageProperty("title", "Интернет-семинары (вебинары) для пользователей | PERCo");
$APPLICATION->SetPageProperty("description", "Расписание проведения интернет-семинаров (вебинаров) специалистами компании PERCo");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Интернет-семинары (вебинары)");

$APPLICATION->SetAdditionalCSS("/css/vebinary.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/vebinary.js"); // подключение скриптов
?>
<div id="content">
	<h1>
    <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Для записи на семинар необходимо перейди по приведённой ссылке и зарегистрироваться. На указанный при регистрации e-mail Вам будет выслана индивидуальная ссылка, по который в назначенное время Вы сможете зайти на семинар.</p>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "internet_seminar", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "46",
	"NEWS_COUNT" => "50",
	"SORT_BY1" => "DATE_ACTIVE_TO",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "DATE_ACTIVE_TO",
		1 => "ACTIVE_TO",
		2 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "TIME",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "43200",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "j F Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "1532",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Семинары",
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
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/obuchenie/vebinar_info.php");?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>