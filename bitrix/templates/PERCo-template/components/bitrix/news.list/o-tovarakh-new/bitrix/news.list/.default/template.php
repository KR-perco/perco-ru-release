<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
?>

<div id="news-list">
	<?
	$arResult["TIMESTAMP_X"] = $arResult["ITEMS"][0]["TIMESTAMP_X"];
	foreach($arResult["ITEMS"] as $arItem)
	{
	?>
	<div class="news_item-box">
		<div class="news_item">
	<?	if ($arItem["PROPERTIES"]["ANONS_IMG"]["VALUE"]) { ?>
				<div class="image_preview test">
					<img alt="<?=$arItem["NAME"];?>" src="<?=$arItem["PROPERTIES"]["ANONS_IMG"]["VALUE"];?>" />
				</div>
	<?	}?>
				<div class="news_preview">
					<div class="date"><?=$arItem["DISPLAY_ACTIVE_FROM"];?></div>
					<div class="name"><?=$arItem["NAME"];?></div>
					<div class="text"><?=$arItem["PREVIEW_TEXT"];?></div>
				</div>
			</div>
			<div class="text"><?=$arItem["DETAIL_TEXT"];?></div>
			</div>
	<?
	}
	if($arParams["DISPLAY_TOP_PAGER"])
		echo $arResult["NAV_STRING"];
	?>
</div>