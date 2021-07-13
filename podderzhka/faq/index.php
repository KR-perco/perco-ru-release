<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "FAQPage");
$APPLICATION->SetTitle("Часто задаваемые вопросы");
$APPLICATION->SetAdditionalCSS("/css/faq.css");
?>
<div class="page-faq" id="content">
	<a href="/podderzhka/faq/" style="text-decoration: none;">
		<div class="header-block">
				<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
				<img alt="Часто задаваемые вопросы" src="/images/icons/FAQ.svg">
		</div>
	</a>
<?$APPLICATION->IncludeComponent(
	"bitrix:support.faq", 
	".default", 
	array(
		"IBLOCK_TYPE" => "raznoe",
		"IBLOCK_ID" => "83",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_GROUPS" => "Y",
		"AJAX_MODE" => "N",
		"SECTION" => "",
		"EXPAND_LIST" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"ADD_ELEMENT_CHAIN" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/podderzhka/faq/",
		"SHOW_RATING" => "N",
		"RATING_TYPE" => "like_graphic",
		"PATH_TO_USER" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"AJAX_OPTION_ADDITIONAL" => "",
		"SEF_URL_TEMPLATES" => array(
			"faq" => "",
			"section" => "#SECTION_ID#/",
			"detail" => "#SECTION_ID#/#DETAIL_ID#",
		)
	),
	false
);?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>