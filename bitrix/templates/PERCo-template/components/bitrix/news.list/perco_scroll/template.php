<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if (stripos($_SERVER["PHP_SELF"], "novosti") === false)
	shuffle($arResult["ITEMS"]);
array_splice($arResult["ITEMS"], 50);
if (LANGUAGE_ID != "ru")
{
	for($i=0;$i<count($arResult["ITEMS"]);$i++)
	{
		if ($arResult["ITEMS"][$i]["PROPERTIES"]["DISABLE_COM"]["VALUE"] == "Y")
			$arDel[] = $i;
	}
	for($i=0;$i<count($arDel);$i++)
	{
		unset($arResult["ITEMS"][$arDel[$i]]);
	}
}
?>
<ul id="scrollGallery">
<?
foreach($arResult["ITEMS"] as $arElement)
{
	if (empty($arElement["PROPERTIES"]["SCROLL"]["VALUE"])) continue;
	$keyFullPreview = array_search(LANGUAGE_ID, $arElement["PROPERTIES"]["FULL_OPIS"]["DESCRIPTION"]);
	$keyScrollOpis = array_search(LANGUAGE_ID, $arElement["PROPERTIES"]["SCROLL_OPIS"]["DESCRIPTION"]);
	if ($keyScrollOpis === false)
		continue;
	if ($arParams["SCROLL_NEWS"] && $arElement["ACTIVE_FROM"])
		$add_scroll = " (".date("m.Y", strtotime($arElement["ACTIVE_FROM"])).")";
	list($width_orig, $height_orig) = getimagesize($_SERVER['DOCUMENT_ROOT'].$arElement["PROPERTIES"]["SCROLL"]["VALUE"]);
?>
	<li data-src="<?=$arElement["PROPERTIES"]["FULL"]["VALUE"];?>" data-sub-html="<?=$arElement["PROPERTIES"]["FULL_OPIS"]["VALUE"][$keyFullPreview];?>">
		<div>
			<div class="anons_img">
				<img src="<?=$arElement["PROPERTIES"]["SCROLL"]["VALUE"];?>" width="<?=$width_orig;?>" height="<?=$height_orig;?>" alt="<?=$arElement["PROPERTIES"]["SCROLL_OPIS"]["VALUE"][$keyScrollOpis];?>" />
				<div class="frame"></div>
			</div>
			<div class="podpis"><?=$arElement["PROPERTIES"]["SCROLL_OPIS"]["VALUE"][$keyScrollOpis] . $add_scroll;?></div>
		</div>
	</li>
<? }?>
</ul>