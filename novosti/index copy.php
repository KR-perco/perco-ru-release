<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "CollectionPage");
CMain::IncludeFile("lang/".LANGUAGE_ID."/news.php");

$APPLICATION->SetTitle(GetMessage("SETTITLE"));
$APPLICATION->SetPageProperty("title", GetMessage("TITLE"));
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));
$APPLICATION->SetPageProperty("description", GetMessage("DESCRIPTION"));
$APPLICATION->AddHeadScript('/scripts/novosti.js');

$APPLICATION->SetAdditionalCSS("/css/novosti.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/novosti.js"); // подключение скриптов
if($_GET["year"] && is_numeric($_GET["year"]))
{
	$cur_year = $_GET["year"];
	$dateStart = "01.01.".$_GET["year"];	// дата начала
	$dateEnd = "01.01.".($_GET["year"]+1);	// дата конца
}

$cur_year_active = false;
$arSelect = Array("IBLOCK_ID", "ID", "NAME", "DATE_ACTIVE_FROM");
$arFilter = Array("IBLOCK_CODE"=>GetMessage("IBLOCK_CODE"), "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
//if(empty($_GET["type"])){
	while($ob = $res->GetNextElement())
	{
		$arFields = $ob->GetFields();
		$news_id = $arFields["IBLOCK_ID"];
		$year = date("Y", strtotime($arFields["DATE_ACTIVE_FROM"]));
		if ($cur_year == $year)
		{
			$arDate[$year] = "<b>".$year."</b>";
			if (!$cur_year_active)
			{
				$real_path = parse_url($_SERVER["REQUEST_URI"]);
				$APPLICATION->SetTitle(GetMessage("SETTITLE")." ".$year);
				$APPLICATION->SetPageProperty("title", GetMessage("TITLE")." ".$year." | PERCo");
				$APPLICATION->AddHeadString('<link href="https://'.$_SERVER["SERVER_NAME"].$real_path["path"].'" rel="canonical" />');
				$cur_year_active = true;
			}
		}
		else
			$arDate[$year] = '<a href="?year='.$year.'">'.$year.'</a>';
	}
//}
krsort($arDate);
reset($arDate);
global $arrFilterYear;
$arrFilterYear = array (
		array(
		"LOGIC" => "AND",
		array(">=DATE_ACTIVE_FROM" => $dateStart),
		array("<=DATE_ACTIVE_FROM" => $dateEnd),
	),
);

if($_GET["type"] == "new_product"){
	?><style>.filter {
		margin-bottom: 0px;
	}</style><?
	$arrFilterYear = array(
		"PROPERTY_TYPE_NEWS"  => "21665", // это для свойства типа список
	  ); 
}

?>
<h1 style="display: none"> <?$APPLICATION->ShowTitle(false, false)?></h1>
<div class="filsub" style="margin-top: 40px;">
	<? if (LANGUAGE_ID == "ru") {?>
	<div class="news-menu news-menu_mobile">
		<ul>
			<a href="/novosti/" id="nov"><li class="sidebar-item active">Новости</li></a>
			<a href="/novosti/articles/" id="pub"><li class="sidebar-item">Публикации</li></a>
		</ul>
	</div>
	<?}?>
	<div class="content">
		<div class="tab novosti" id="novosti">
			<?if(empty($_GET["type"])){?><div class="filter"><?=implode(" | ", $arDate);?></div><?}?>
			<?$APPLICATION->IncludeComponent("bitrix:news.list", "news_list", array(
				"IBLOCK_TYPE" => "news",
				"IBLOCK_ID" => $news_id,
				"NEWS_COUNT" => "10",
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
				"SET_TITLE" => "N",
				"SET_STATUS_404" => "N",
				"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
				"ADD_SECTIONS_CHAIN" => "N",
				"HIDE_LINK_WHEN_NO_DETAIL" => "N",
				"PARENT_SECTION" => "",
				"PARENT_SECTION_CODE" => "",
				"DISPLAY_TOP_PAGER" => "N",
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
			);?>
		</div>
	</div>
	<div class="sidebar">
		<? if (LANGUAGE_ID == "ru") {?>
		<div class="news-menu">
			<ul>
				<a href="/novosti/" id="nov"><li class="sidebar-item active">Новости</li></a>
				<a href="/novosti/articles/" id="pub"><li class="sidebar-item">Публикации</li></a>
			</ul>
		</div>
		<?}?>
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
	</div>
</div>
<div class="popupWrapper">
	<div class="popup">
		<button class="popup-clsBtn">×</button>
		<div class="popup-txt">
			<?switch (LANGUAGE_ID) {
			case 'ru':
				echo 'Подписка отменена';
				break;
			default:
				echo 'Unsubscribed';
			}?>
		</div>
		<button class="popup-okBtn">ок</button>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>