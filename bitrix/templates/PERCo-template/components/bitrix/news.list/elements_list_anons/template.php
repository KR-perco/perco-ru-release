<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="elements_list">
<?
$arResult["TIMESTAMP_X"] = $arResult["ITEMS"][0]["TIMESTAMP_X"];
foreach($arResult["ITEMS"] as $arItem)
{
?>
	<div class="element_item">
		<a href="<?if ($arItem[ID] == "21112") {echo "/resheniya/gibkiy-grafik/";} else { echo $arItem["DETAIL_PAGE_URL"];}?>">
			<div class="image_icon">
				<img alt="<?=$arItem["PROPERTIES"]["NAME"]["VALUE"];?>" src="<?=$arItem["PROPERTIES"]["IMAGE"]["VALUE"];?>" />
			</div>
			<div class="text_item">
				<div class="item_name <?//bottom_border?>"><?=$arItem["PROPERTIES"]["NAME"]["VALUE"];?></div>
				<!--<p><?=$arItem["PREVIEW_TEXT"];?></p>-->
			</div>
			<!--<div class="more">
				<span>подробнее</span>
				<span class="arrow"><?include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></span>
			</div>-->
		</a>
	</div>
<?}?>
</div>