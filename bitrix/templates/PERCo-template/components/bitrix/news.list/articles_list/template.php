<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div id="publication">
<?
$arResult["TIMESTAMP_X"] = $arResult["ITEMS"][0]["TIMESTAMP_X"];

foreach($arResult["ITEMS"] as $arItem)
{
	$url = $arItem["PROPERTIES"]["SOURCE_URL"]["VALUE"];
	$dataUrl = parse_url($url);
	$source = $dataUrl['host'];
?>
	<div class="publication_item">
		<a class="articles_link" href="<?=$arItem["DETAIL_PAGE_URL"];?>"></a>
		<div class="item">
			<img alt="<?=$arItem["NAME"];?>" src="<?=$arItem["PROPERTIES"]["ANOUNS_IMG"]["VALUE"];?>" />
			<div class="name"><?=$arItem["NAME"];?></div>
			<div class="text"><?=$arItem["PREVIEW_TEXT"];?></div>
		</div>
		<div class="more">
			<div><?=GetMessage("MORE");?></div>
			<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
		</div>
		<div class="source">
			<a href="<?=$url?>" target="_blank"><?=$source?></a>
		</div>
	</div>
<?
}
?>
</div>
<div>
<?
if($arParams["DISPLAY_BOTTOM_PAGER"])
	echo $arResult["NAV_STRING"];
?>
</div>
