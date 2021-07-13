<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Очные семинары в Учебном центре", "");
$APPLICATION->SetPageProperty("title", "Очные семинары в Учебном центре PERCo для пользователей");
$APPLICATION->SetPageProperty("description", "Цель семинара – ознакомление слушателей с принципами построения единой системы безопасности PERCo-S-20, ее потребительскими свойствами");
$APPLICATION->SetPageProperty("keywords", "семинары безопасности, обучающие системам безопасности");
$APPLICATION->SetTitle("Очные семинары в Учебном центре Санкт-Петербурга");

$APPLICATION->SetAdditionalCSS("/css/seminary-v-uchebnom-centre.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/seminary-v-uchebnom-centre.js"); // подключение скриптов
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>

	<div class="imagesSupport img_items">
		<div class="item">
			<a href="/images/gallery/raznoe/education/training-center-spb.jpg" title="Учебный центр в Санкт-Петербурге" data-sub-html="Учебный центр в Санкт-Петербурге">
				<img src="/images/gallery/raznoe/education/training-center-spb-small.jpg" alt="Учебный центр в Санкт-Петербурге">
				<div class="podpis_t">Учебный центр в Санкт-Петербурге</div>
			</a>
		</div>
		<div class="item">
			<a href="/images/gallery/raznoe/education/exhibition-hall-spb.jpg" title="Выставочный зал в Санкт-Петербурге" data-sub-html="Выставочный зал в Санкт-Петербурге">
				<img src="/images/gallery/raznoe/education/exhibition-hall-spb-small.jpg" alt="Выставочный зал в Санкт-Петербурге">
				<div class="podpis_t">Выставочный зал в Санкт-Петербурге</div>
			</a>
		</div>
	</div>
	<div style="padding-top: 15px">
		<p>Очные обучающие семинары проводятся на базе Учебного центра в главном офисе PERCo в Санкт-Петербурге. С графиком проведения семинаров и с программами обучения можно ознакомиться в разделе ниже. </p>
	</div>

	
<?
$iblocks = GetIBlockList("edu", "seminars");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$GLOBALS['myAddFilter'] = array("PROPERTY_SEMINARS_CITY" => "Санкт-Петербург");
$APPLICATION->IncludeComponent("bitrix:news.list", "seminarivych", array(
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => $block_id,
	"NEWS_COUNT" => "20",
	"SORT_BY1" => "DATE_ACTIVE_TO",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "SEMINAR",
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
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "Новости",
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

</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>