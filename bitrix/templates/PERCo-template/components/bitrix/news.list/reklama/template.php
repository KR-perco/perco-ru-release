<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div class="advert-list">
<?
foreach($arResult["ITEMS"] as $arItem)
{
?>
	<div>
		<img src="<?=$arItem["PROPERTIES"]["IMAGE"]["VALUE"][0];?>" alt="<?=$arItem["PROPERTIES"]["NAME"]["VALUE"][0];?>" style="max-width: 210px;" border="0" />
<?	if ($arParams["CHECK_FORM"] == "Y") { ?>
		<p class="zakaz"><input type="number" id="<?=$arItem["ID"];?>" name="LIST_NUMBER" placeholder="0" val_="<?if ($arItem["PROPERTIES"]["NAME"]["VALUE"][0] !="") echo $arItem["PROPERTIES"]["NAME"]["VALUE"][0]; else echo $arItem["NAME"];?>" weight_="<?=$arItem["PROPERTIES"]["IMAGE_PODPIS"]["DESCRIPTION"];?>"> шт.</p>
<?
	}
	if($arItem["PROPERTIES"]["FILE"]["VALUE"][0] != "" && $arItem["NAME"] != "")
	{
?>
		<p><a href="<?=$arItem["PROPERTIES"]["FILE"]["VALUE"][0]; ?>" target="_blank" onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '<?=$arItem["PROPERTIES"]["FILE"]["VALUE"][0]; ?>'});" download>
<?
		if ($arItem["PROPERTIES"]["NAME"]["VALUE"][0] != "")
			echo $arItem["PROPERTIES"]["NAME"]["VALUE"][0];
		else
			echo $arItem["NAME"];
?>
		</a><br />(<?=printFileInfo($arItem["PROPERTIES"]["FILE"]["VALUE"][0], "size");?>)
<?
		echo "&mdash; ";
		if($arItem["PROPERTIES"]["INSTAL_TIME"]["VALUE"]!="")
			echo $arItem["PROPERTIES"]["INSTAL_TIME"]["VALUE"];
		else
		{
			$stat = stat($_SERVER["DOCUMENT_ROOT"].$arItem["PROPERTIES"]["FILE"]["VALUE"][0]);
			echo date("d.m.Y", $stat["mtime"]);
		}
?>
		</p>
<?
	}
	elseif ($arItem["PROPERTIES"]["IMAGE_PODPIS"]["VALUE"] != "")
	{
		if ($arItem["PREVIEW_TEXT"] != "")
			echo '<p class="komplekt" data-id="#info_'.$arItem["ID"].'">'.$arItem["PROPERTIES"]["IMAGE_PODPIS"]["VALUE"]."</p>";
		else
			echo "<p>".$arItem["PROPERTIES"]["IMAGE_PODPIS"]["VALUE"]."</p>";
	}
	if ($arItem["PREVIEW_TEXT"] != "")
		echo '<div id="info_'.$arItem["ID"].'" style="display: none;">'.$arItem["PREVIEW_TEXT"].'</div>';
?>
	</div>
<? } ?>
</div>