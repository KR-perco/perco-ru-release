<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CMain::IncludeFile("lang/".LANGUAGE_ID."/news.php");

$APPLICATION->SetTitle(GetMessage("SETTITLE"));
$APPLICATION->SetPageProperty("title", GetMessage("TITLE"));
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));
$APPLICATION->SetPageProperty("description", GetMessage("DESCRIPTION"));
$APPLICATION->SetAdditionalCSS("/css/novosti.css"); // подключение стилей
?>
<div class="filsub">
	<div class="content">
		<div class="tab publication" id="publication">
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "articles_list", array(
				"IBLOCK_TYPE" => "news",
				"IBLOCK_ID" => "61",
				"NEWS_COUNT" => "9",
				"SORT_BY1" => "ACTIVE_FROM",
				"SORT_ORDER1" => "DESC",
				"SORT_BY2" => "SORT",
				"SORT_ORDER2" => "ASC",
				"USE_FILTER" => "Y",
				"FILTER_NAME" => "arrFilterYear",
				"FIELD_CODE" => array(
					0 => "",
					1 => "",
				),
				"PROPERTY_CODE" => array(
					0 => "",
					1 => "PREVIEW",
					2 => "FOTOS",
					3 => "",
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
				"SET_TITLE" => "Y",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"DISPLAY_TOP_PAGER" => "N",
				"DISPLAY_BOTTOM_PAGER" => "Y",
				"PAGER_TITLE" => "N",
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
			);?>
		</div>
		<div class="tab galery" id="galery">
		</div>
	</div>
	<div class="sidebar">
		<div class="news-menu">
			<ul>
				<a href="/novosti/" id="nov"><li class="sidebar-item">Новости</li></a>
				<a href="/novosti/articles/" id="pub"><li class="sidebar-item active">Публикации</li></a>
			</ul>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>