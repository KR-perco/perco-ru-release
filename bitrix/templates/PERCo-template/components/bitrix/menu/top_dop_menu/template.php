<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult))
{
?>
<ul id="horizontal-dop-menu">
<?
	foreach($arResult as $arItem)
	{
?>
	<li><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]){?>root-item-selected<?} else {?>root-item<?}?>"><?=$arItem["TEXT"]?></a></li>
<?
	}
?>
</ul>
<?}?>