<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?$APPLICATION->SetPageProperty("bodyItemtype", "ItemPage")?>
<div class="news">
	<div class="news-date"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></div>
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
$previewLinks = [];
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
		$previewLinks[] = (!empty($arProps["FULL"]["VALUE"])) ? $arProps["FULL"]["VALUE"] : $arProps["PREVIEW"]["VALUE"];
	}
	echo '</div>';
}
?>
</div>
<?
$APPLICATION->AddHeadString('<meta property="og:image" content="https://'.$_SERVER['HTTP_HOST'].$previewLinks[0].'">');
$createdDate = implode('-', array_reverse(explode('.', $arResult["DISPLAY_ACTIVE_FROM"])));
$modifyDate = implode('-', array_reverse(explode('.', explode(' ', $arResult["TIMESTAMP_X"])[0])));
?>
<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "NewsArticle",
		"mainEntityOfPage": {
		"@type": "WebPage",
		"@id": "<?='https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"
		},
		"headline": "<?=$arResult["NAME"]?>",
		"image": [<?foreach($previewLinks as $link) {echo '"https://'.$_SERVER['HTTP_HOST'].$link.'"'.(($link != end($previewLinks)) ? ', ' : '');}?>],
		"datePublished": "<?=$createdDate?>",
		"dateModified": "<?=$modifyDate?>",
		"author": {
			"@type": "Organization",
			"name": "PERCo"
		},
		"publisher": {
		"@type": "Organization",
		"name": "PERCo",
		"url": "https://www.perco.ru",
		"logo": {
			"@type": "ImageObject",
			"url": "https://perco.ru/images/articles/logo-perco.jpg"
		}
		},
		"description": "<?=$arResult["IPROPERTY_VALUES"]["ELEMENT_META_DESCRIPTION"]?>"
	}
</script>