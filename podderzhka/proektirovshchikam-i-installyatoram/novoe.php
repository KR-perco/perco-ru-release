<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Новое в товарах", "");
$APPLICATION->SetPageProperty("title", "Новое в товарах | PERCo");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Новое в товарах");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript('/scripts/proektirovshchikam-i-installyatoram.js');

?>

<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Новое в товарах" src="/images/icons/novoe.svg" />
	</div>
	<div class="description">
		<p>Чтобы товары PERCo отвечали текущим потребностям рынка специалисты компании постоянно работают над их усовершенствованием. В этом разделе можно узнать о последних изменениях потребительских свойств товаров PERCo.</p>
	</div>
	<div class="filsub">
		<div>
			<div id="subscribe">
				<?$APPLICATION->IncludeComponent(
					"bitrix:subscribe.edit", 
					"perco.subscribe", 
					array(
						"SHOW_HIDDEN" => "N",
						"AJAX_MODE" => "Y",
						"AJAX_OPTION_SHADOW" => "Y",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"ALLOW_ANONYMOUS" => "Y",
						"SHOW_AUTH_LINKS" => "N",
						"SET_TITLE" => "N",
						"AJAX_OPTION_ADDITIONAL" => ""
					),
					false
				);?>
			</div>
			<?/*<div id="subscribe">
				<?$APPLICATION->IncludeComponent(
					"bitrix:sender.subscribe",
					"",
					Array(
						"COMPONENT_TEMPLATE" => ".default",
						"USE_PERSONALIZATION" => "Y",
						"CONFIRMATION" => "Y",
						"HIDE_MAILINGS" => "Y",
						"SHOW_HIDDEN" => "Y",
						"AJAX_MODE" => "Y",
						"AJAX_OPTION_JUMP" => "Y",
						"AJAX_OPTION_STYLE" => "Y",
						"AJAX_OPTION_HISTORY" => "N",
						"CACHE_TYPE" => "N",
						"CACHE_TIME" => "",
						"SET_TITLE" => "Y"
					)
				);?>
			</div>*/?>
			<?
			$APPLICATION->IncludeComponent("bitrix:news.list", "o-tovarakh", array(
				"IBLOCK_TYPE" => "novoe-o-tovarah",
				"IBLOCK_ID" => "55",
				"NEWS_COUNT" => "10",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"USE_FILTER" => "Y",
				"FILTER_NAME" => "arrFilter",
				"FILTER_FIELD_CODE" => Array(),
				"FILTER_PROPERTY_CODE" => Array("SECTION"),
				"PROPERTY_CODE" => Array("ANONS_IMG"),
				"CHECK_DATES" => "Y",
				"DETAIL_URL" => "",
				"AJAX_MODE" => "Y",
				"AJAX_OPTION_JUMP" => "N",
				"AJAX_OPTION_STYLE" => "Y",
				"AJAX_OPTION_HISTORY" => "N",
				"CACHE_TYPE" => "N",
				"CACHE_TIME" => "3600",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"PREVIEW_TRUNCATE_LEN" => "",
				"ACTIVE_DATE_FORMAT" => "d.m.Y",
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"DISPLAY_TOP_PAGER" => "Y",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "",
				"PAGER_SHOW_ALWAYS" => "Y",
				"PAGER_TEMPLATE" => "news_navigation",
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
			);
			?>
		</div>
	</div>
</div>
<div class="popupWrapper">
	<div class="popup">
		<button class="popup-clsBtn">×</button>
		<div class="popup-txt">Подписка отменена</div>
		<button class="popup-okBtn">ок</button>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>