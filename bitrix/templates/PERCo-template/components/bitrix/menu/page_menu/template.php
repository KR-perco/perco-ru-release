<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult))
{
	echo '<div id="elements_list">';
	foreach($arResult as $arItem)
	{
		echo '<div class="element_item"><a href="'.$arItem["LINK"].'"><img alt="'.$arItem["TEXT"].'" src="'.$arItem["PARAMS"]["IMAGE"].'"><p>'.$arItem["TEXT"].'</p></a></div>';
	}
	echo '</div>';
}
?>