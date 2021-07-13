<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$this->setFrameMode(true);
global $device;
$APPLICATION->SetAdditionalCSS("/css/resheniya.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/resheniya.js"); // подключение скриптов
$APPLICATION->SetPageProperty("bodyItemtype", "ItemPage");
?>

<?
function getByCountry ($value, $langs) {
	$i = array_search(LANGUAGE_ID, $langs);
	if ($i !== false) {
		return $value[$i];
	}
	return $value[0];
}

function getPrimeryTitle () {
	switch (LANGUAGE_ID) {
	case 'ru':
		return 'Примеры реализованных проектов';
	case 'en':
		return 'Case studies';
	case 'de':
		return 'Case studies';
	case 'fr':
		return 'Case studies';
	case 'it':
		return 'Case studies';
	case 'es':
		return 'Los ejemplos de los proyectos realizados';
	}
}
?>


<?	if ($arResult["DETAIL_TEXT"])
		echo $arResult["DETAIL_TEXT"];?>

	<div id="content">
		<h1><?=$arResult["PROPERTIES"]["NAME"]["VALUE"];?></h1>
<?
	if ($arResult["PREVIEW_TEXT"])
		echo '<div class="preview_text">'.$arResult["PREVIEW_TEXT"].'</div>';
	if (count($arResult["PROPERTIES"]["TEXT"]["DESCRIPTION"]) > 1)
	{
		echo '<div class="tabs" id="tabs">';
		$i = 0;
		for($i=0; $i < count($arResult["PROPERTIES"]["TEXT"]["DESCRIPTION"]); $i++)
		{
			$name = $arResult["PROPERTIES"]["TEXT"]["DESCRIPTION"][$i];
			echo '<input type="radio"';
			if ($i == 0)
				echo ' checked="checked"';
			echo ' id="'.translitIt(strtolower($name)).'" name="vkladki"><label for="'.translitIt(strtolower($name)).'"><span class="dashed">'.$name.'</span></label>';
			echo '<div><div class="text_items">'.html_entity_decode($arResult["PROPERTIES"]["TEXT"]["VALUE"][$i]["TEXT"]).'</div></div>';
		}
		if ($arResult['PROPERTIES']['PRIMERY']['VALUE'] != false && CModule::includeModule('iblock')) {
			echo '<input type="radio"';
			echo ' id="primery" name="vkladki"><label for="primery"><span class="dashed">' . getPrimeryTitle() . '</span></label>';
			echo '<div><div class="text_items"><div style="display: flex; flex-wrap: wrap;">';
			foreach (array_reverse($arResult['PROPERTIES']['PRIMERY']['VALUE']) as $id) {
				$dbItem = CIBlockElement::GetByID($id);
				if ($item = $dbItem->GetNextElement()) {
					$fields = $item->GetFields();
					$props = $item->GetProperties('NAME', 'IMAGE', 'FILE');
			?>
				<div class="element_item" style="margin: 0 10px 10px 0; width: 210px;">
					<div>
						<img alt="<?= $props['NAME'] ?>" src="<?= getByCountry($props['IMAGE']['VALUE'], $props['IMAGE']['DESCRIPTION']) ?>">
					</div>
					<a href="<?= getByCountry($props['FILE']['VALUE'], $props['FILE']['DESCRIPTION']) ?>" target="_blank" download=""><?= getByCountry($props['NAME']['VALUE'], $props['NAME']['DESCRIPTION']) ?></a>
					<div class="color"><?= printFileInfo(getByCountry($props['FILE']['VALUE'], $props['FILE']['DESCRIPTION']), "size") ?>  — <?= printFileInfo(getByCountry($props['FILE']['VALUE'], $props['FILE']['DESCRIPTION']), "date") ?></div>
				</div>
			<?
				}
			}
			echo '</div></div></div>';
		}
		echo '</div>';
	}




if ($arResult["PROPERTIES"]["SCROLL"]["VALUE"]){	
?>
<div id="horizontal_scroll">
<?
global $arrFilter;
$arrFilter["PROPERTY_TYPE_OBJECT_VALUE"] = $arResult["PROPERTIES"]["SCROLL"]["VALUE"];
$APPLICATION->IncludeComponent("bitrix:news.list", "perco_scroll", array(
	"IBLOCK_TYPE" => "images",
	"IBLOCK_ID" => "18",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"NEWS_COUNT" => "1000",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER2" => "ASC",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "TYPE_PRODUCT"
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "gallery",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	),
	false
);?>
</div>
<?}?>
	</div>
</div>
<?
$APPLICATION->AddHeadString('<meta property="og:image" content="https://www.perco.ru/images/resheniya/'.$arResult['CODE'].'/1.jpg">');
$createdDate = implode('-', array_reverse(explode('.', $arResult["DISPLAY_ACTIVE_FROM"])));
$modifyDate = implode('-', array_reverse(explode('.', explode(' ', $arResult["TIMESTAMP_X"])[0])));
?>
<script type="application/ld+json">
{
	"@context": "https://schema.org",
	"@type": "Article",
	"mainEntityOfPage": {
		"@type": "WebPage",
		"@id": "<?=$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>"
	},
	"headline": "<?=$arResult["PROPERTIES"]["NAME"]["VALUE"];?>",
	"image": [
		"https://www.perco.ru/images/resheniya/<?=$arResult['CODE']?>/1.jpg"
	],
	"datePublished": "<?=$modifyDate?>",
	"dateModified": "<?=$modifyDate?>",
	"author": {
		"@type": "Organization",
		"name": "PERCo"
	},
	"publisher": {
		"@type": "Organization",
		"name": "PERCo",
		"logo": {
			"@type": "ImageObject",
			"url": "https://perco.ru/images/articles/logo-perco.jpg"
		}
	},
	"description": "<?=strip_tags($arResult["PREVIEW_TEXT"])?>"
}
</script>