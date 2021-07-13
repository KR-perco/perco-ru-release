<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Localization\Loc;

if(empty($arResult['ITEMS']))
{
	return;
}

?>
<?
foreach($arResult["ITEMS"] as $item) { ?>
<div style="padding-left:20px; padding-right:20px;">
	<h1 style="font-size:16px; margin-top:10px;"><?=$item["NAME"];?></h1>
	<p style="margin-bottom:7px; margin-top:7px; text-align:center"><?=$item["DETAIL_TEXT"];?></p>
	<p style="margin-bottom:7px; margin-top:7px; text-align:center">
<?
foreach($item["DISPLAY_PROPERTIES"]["PREVIEW"]["VALUE"] as $img)
{
	$arFilterImg = Array("IBLOCK_ID"=>$item["DISPLAY_PROPERTIES"]["PREVIEW"]["LINK_IBLOCK_ID"], "ID" => $img);
	$arSelectImg = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
	$resImg = CIBlockElement::GetList(array(), $arFilterImg, false, Array(), $arSelectImg);
	$obImg = $resImg->GetNextElement();
	$arPropsImg = $obImg->GetProperties();
	$keyPreviewImg = array_search(LANGUAGE_ID, $arPropsImg["PREVIEW_OPIS"]["DESCRIPTION"]);
	$text_preview = $arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg];
	echo '<img src="'.$arPropsImg["PREVIEW"]["VALUE"].'" alt="'.$text_preview.'" />&nbsp';
}
?>
	</p>
<!-- line -->
	<p style="text-align:center; margin-left:-20px;"><img src="/images/subscribe/line.png" width="827" height="4" /></p>
<!-- line -->
</div>
<? }?>