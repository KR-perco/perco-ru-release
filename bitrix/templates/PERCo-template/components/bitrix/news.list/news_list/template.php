<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
console_log(LANGUAGE_ID);


if (LANGUAGE_ID == "ru") {
	$lang["page"] = "страница";
} elseif (LANGUAGE_ID == "en") {
	$lang["page"] = "page";
} elseif (LANGUAGE_ID == "de") {
	$lang["page"] = "seite";
} elseif (LANGUAGE_ID == "it") { 
	$lang["page"] = "pagina ";
} elseif (LANGUAGE_ID == "fr") {
	$lang["page"] = "page ";
} elseif (LANGUAGE_ID == "es") {
	$lang["page"] = "página";
}
	
	if (!empty($_GET['PAGEN_1'])) {
	if ($_GET['PAGEN_1'] != '1') {
		if (strpos($APPLICATION->GetPageProperty('title'), '|')) {
			$APPLICATION->SetPageProperty("title", str_replace(' |', ', '.$lang["page"].' '.$_GET['PAGEN_1'].' |', $APPLICATION->GetPageProperty('title')));
		} else {
			$APPLICATION->SetPageProperty("title", $APPLICATION->GetPageProperty('title').', page '.$_GET['PAGEN_1']);
		}
	}
}
?> 
<div id="news">
<?
$arResult["TIMESTAMP_X"] = $arResult["ITEMS"][0]["TIMESTAMP_X"];
foreach($arResult["ITEMS"] as $arItem)
{
?>
	<div class="news_item">
		<a href="<?=$arItem["DETAIL_PAGE_URL"];?>">
<?	if ($arItem["PROPERTIES"]["ANONS_IMG"]["VALUE"]) { ?>
			<div class="image_preview">
				<img alt="<?=$arItem["NAME"];?>" src="<?=$arItem["PROPERTIES"]["ANONS_IMG"]["VALUE"];?>" />
			</div>
<?	}?>
			<div class="news_preview">
				
				<div class="name">
					<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
					<?=$arItem["NAME"];?></div>
				<div class="text"><?=$arItem["PREVIEW_TEXT"];?></div>
				<div class="more">
					<div><?=GetMessage("MORE");?></div>
					<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
				</div>
			</div>
		</a>
	</div>
<?
}
if($arParams["DISPLAY_BOTTOM_PAGER"])
	echo $arResult["NAV_STRING"];
?>
</div>