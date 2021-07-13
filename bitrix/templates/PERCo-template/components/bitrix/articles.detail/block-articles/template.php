<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="news">
		<h1><?=$arResult["NAME"]?></h1>
<?
$content = $arResult["DETAIL_TEXT"];
if ($arResult["PROPERTIES"]["LINKS"]["VALUE"])		// Устанавливаем ссылки на фразы
{
	for($i=0; $i < count($arResult["PROPERTIES"]["LINKS"]["VALUE"]); $i++)
	{
		$url = $arResult["PROPERTIES"]["LINKS"]["VALUE"][$i];
		$trans = $arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"][$i];
		$content = preg_replace("/(?<![\"\'\«]{1})$trans/", "<a href='$url'>\\0</a>", $content, 1);
	}
}
?>
		<div class="news-content"><?=$content;?></div>
<?
if($arResult["PROPERTIES"]["PREVIEW"]["VALUE"])
{
	echo '<div class="news-imges">';
	foreach($arResult["PROPERTIES"]["PREVIEW"]["VALUE"] as $arItem)
	{
		$arFilter = Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IBLOCK_ID"], "ID" => $arItem);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
		$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
		$ob = $res->GetNextElement();
		$arProps = $ob->GetProperties();
		$keyFullImg = array_search(LANGUAGE_ID, $arProps["FULL_OPIS"]["DESCRIPTION"]);
		$keyPreviewImg = array_search(LANGUAGE_ID, $arProps["PREVIEW_OPIS"]["DESCRIPTION"]);
		if ($keyFullImg !== false)
			$text_full = $arProps["FULL_OPIS"]["VALUE"][$keyFullImg];
		if ($keyPreviewImg !== false)
			$text_preview = $arProps["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg];
		if ($arProps["FULL"]["VALUE"])
			echo '<a href="'.$arProps["FULL"]["VALUE"].'" title="'.$text_full.'" data-sub-html="'.$text_full.'"><img src="'.$arProps["PREVIEW"]["VALUE"].'" alt="'.$text_preview.'" /></a>';
		else
			echo '<img src="'.$arProps["PREVIEW"]["VALUE"].'" alt="'.$text_preview.'" />';
	}
	echo '</div>';
}
?>
<?
$imgs = $arResult['PROPERTIES']['SCHEMAORG_IMAGES']['VALUE'];
end($imgs);
$lastImgI = key($imgs);
?>
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Article",
		"mainEntityOfPage": {
			"@type": "WebPage",
			"@id": "https://<?= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] ?>"
		},
		"headline": "<?= $arResult['NAME'] ?>",
		"description": "<?= $arResult['PROPERTIES']['SCHEMAORG_DESCRIPTION']['VALUE'] ?>",
		"image": [<? foreach ($imgs as $i => $img) {
			echo '"https://perco.ru' . $img  . '"' . (($i != $lastImgI) ? ', ' : '');
		} ?>],
		"datePublished": "<?= str_replace(' ', 'T', str_replace('.', '/', $arResult['ACTIVE_FROM'])) . '+03:00' ?>",
		"dateModified": "<?= str_replace(' ', 'T', str_replace('.', '/', $arResult['TIMESTAMP_X'])) . '+03:00' ?>",
		<?= ($arResult['PROPERTIES']['SOURCE_URL']['VALUE'] != '') ? '"sameAs": "' . $arResult['PROPERTIES']['SOURCE_URL']['VALUE'] . '",' : '' ?>
		"author": {
			"@type": "Organization",
			"name": "PERCo",
			"logo": {
				"@type": "ImageObject",
				"url": "https://perco.ru/images/icons/logo.svg"
			}
		},
		"publisher": {
			"@type": "Organization",
			"name": "PERCo",
			"logo": {
				"@type": "ImageObject",
				"url": "https://perco.ru/images/icons/logo.svg"
			}
		}
	}
</script>
</div>