<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$this->setFrameMode(true);
global $device;
$arFilter = Array("IBLOCK_CODE"=>"pages_".LANGUAGE_ID, "ACTIVE"=>"Y", "CODE" => $arResult["CODE"]);
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "TIMESTAMP_X", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_*");
$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
if (intval($res->SelectedRowsCount()) > 0)
{
	$ob = $res->GetNextElement();
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	$arResult["TIMESTAMP_X"] = $arFields["TIMESTAMP_X"];
	if ($arProps["JS"]["VALUE"])
		$APPLICATION->AddHeadScript($arProps["JS"]["VALUE"]); // подключение скриптов
	if ($arProps["CSS"]["VALUE"])
		$APPLICATION->SetAdditionalCSS($arProps["CSS"]["VALUE"]); // подключение стилей
	if ($arFields["PREVIEW_TEXT"])
		$content .= '<div class="preview_text">'.$arFields["PREVIEW_TEXT"].'</div>';
	if ($arFields["DETAIL_TEXT"])
		$content .= '<div>'.$arFields["DETAIL_TEXT"].'</div>';
	if (count($arProps["TEXT"]["VALUE"]) > 1)
	{
		for($i=0; $i < count($arProps["TEXT"]["VALUE"]); $i++)
		{
			$name = $arProps["TEXT"]["DESCRIPTION"][$i];
			$vkladka_content .= '<input name="vkladki" type="radio"';
			if ($i == 0)
				$vkladka_content .= ' checked="checked"';
			$vkladka_content .= ' id="'.translitIt(strtolower($name)).'"><label for="'.translitIt(strtolower($name)).'"><span class="dashed">'.$name.'</span></label>';
			$vkladka_content .= '<div class="text_items">'.html_entity_decode($arProps["TEXT"]["VALUE"][$i]["TEXT"]).'';
			if (in_array($name, $arProps["IMAGES_TEXT"]["DESCRIPTION"]))
			{
				$vkladka_content .= '<div class="img_items">';
				foreach(array_keys($arProps["IMAGES_TEXT"]["DESCRIPTION"], $name) as $keyValue)
				{
					$arFilter = Array("IBLOCK_ID"=>$arProps["IMAGES"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arProps["IMAGES_TEXT"]["VALUE"][$keyValue]);
					$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
					$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
					if ($ob = $res->GetNextElement())
					{
						$arPropsImg = $ob->GetProperties();
						$vkladka_content .= '<div class="img_item';
						if (!$arPropsImg["FULL"]["VALUE"])
							$vkladka_content .= " anons_img";
						$vkladka_content .= '">';
						$keyFullImg = array_search(LANGUAGE_ID, $arPropsImg["FULL_OPIS"]["DESCRIPTION"]);
						$keyPreviewImg = array_search(LANGUAGE_ID, $arPropsImg["PREVIEW_OPIS"]["DESCRIPTION"]);
						if ($arPropsImg["FULL"]["VALUE"])
							$vkladka_content .= '<a class="anons_img" href="'.$arPropsImg["FULL"]["VALUE"].'" data-sub-html="'.$arPropsImg["FULL_OPIS"]["VALUE"][$keyFullImg].'" title="'.$arPropsImg["FULL_OPIS"]["VALUE"][$keyFullImg].'">';
						$vkladka_content .= '<img src="'.$arPropsImg["PREVIEW"]["VALUE"].'" alt="'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'">';
						if ($arPropsImg["FULL"]["VALUE"])
							$vkladka_content .= "</a>";
						$vkladka_content .= '<div>'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'</div></div>';
					}
				}
				$vkladka_content .= '</div>';
			}
			$vkladka_content .= '</div>';
		}
		$content .= '<div class="tabs">'.$vkladka_content.'</div>';
	}
	$content = preg_replace_callback("/\[download:(.+)\]/", "GetDownloadFile", $content);
	$content = preg_replace_callback("/\[downloadImg:(.+)\]/", "GetDownloadFileImg", $content);
	$content = preg_replace_callback("/\[price:(.+)\]/", "GetPrice", $content);
	if ($arProps["PHP"]["VALUE"])		// Делаем вставки php
	{
		for($i=0; $i < count($arProps["PHP"]["VALUE"]); $i++)
		{
			include($_SERVER["DOCUMENT_ROOT"].$arProps["PHP"]["VALUE"][$i]);
			$content = str_ireplace($arProps["PHP"]["DESCRIPTION"][$i], $php_result, $content);
		}
	}
	if ($arProps["LINKS"]["VALUE"])		// Устанавливаем ссылки на фразы
	{
		for($i=0; $i < count($arProps["LINKS"]["VALUE"]); $i++)
		{
			$url = $arProps["LINKS"]["VALUE"][$i];
			$trans = str_replace("/", "\/", $arProps["LINKS"]["DESCRIPTION"][$i]);
			$content = preg_replace("/(?<![\"\'\«]{1})$trans/", "<a href='$url'>\\0</a>", $content, 1); // ?<! - не соответствует следующему выражению [\"\'\«]{1}
		}
	}
?>
	<?=$content;?>
</div>
<? if ($arProps["SCROLL"]["VALUE"]) {
	if ($device!="desktop")
		echo '<style type="text/css">body #main_block { flex-direction: column; }#horizontal_scroll { margin: 20px 0 0 0 !important; }</style>';
?>
	<div <?echo ($device=="desktop") ? 'id="scroll"' : 'id="horizontal_scroll" style="order: 1;"';?>>
<?
global $arrFilter;
$arrFilter["PROPERTY_TYPE_PRODUCT"] = $arProps["SCROLL"]["VALUE"];
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
<?
	}
	echo "</div>";
}
else
	echo "</div></div>";
?>