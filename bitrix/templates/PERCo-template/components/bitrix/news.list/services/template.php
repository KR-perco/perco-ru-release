<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
foreach($arResult["ITEMS"] as $arItem)
{
	echo '<p class="news-item"><span class="news-date-time">'.$arItem["DISPLAY_ACTIVE_FROM"].'</span> '.$arItem["NAME"].'</p>';
}
if($arParams["DISPLAY_BOTTOM_PAGER"])
	echo $arResult["NAV_STRING"];
?>