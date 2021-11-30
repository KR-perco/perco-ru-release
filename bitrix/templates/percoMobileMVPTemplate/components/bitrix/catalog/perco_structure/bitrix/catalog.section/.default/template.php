<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<div style="display: none;"><?echo 'cur template: "NewMobileTemplate > catalog > perco_structure > bitrix > catalog.section"'?></div>
<?
$this->setFrameMode(true);
$this->addExternalJS("/scripts/lightgallery/js/lightgallery.min.js");
$this->addExternalJS("/scripts/lightslider/js/lightslider.min.js");
$this->addExternalJS("/scripts/lightgallery/js/lg-zoom.min.js");
$this->addExternalCss("/scripts/lightgallery/css/lightgallery.min.css");
$this->addExternalCss("/scripts/lightslider/css/lightslider.min.css");

$page = $APPLICATION->GetCurUri();
$url = parse_url($page);

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
	/*if ($arFields["PREVIEW_TEXT"] && ($url['path'] == '/percoMobile/products/po-kompleksnoy-sistemy-bezopasnosti-perco-s-20/' || $url['path'] == '/percoDemo/products/po-kompleksnoy-sistemy-bezopasnosti-perco-s-20/'))
		$content .= '<div class="preview_text">'.$arFields["PREVIEW_TEXT"].'</div>';*/
	if (($arFields["DETAIL_TEXT"]) && ($url['query'] != "installer"))
	//if ($arFields["DETAIL_TEXT"])
		$content .= '<div>'.$arFields["DETAIL_TEXT"].'</div>';
	if (count($arProps["TEXT"]["VALUE"]) > 1)
	{
		for($i=0; $i < count($arProps["TEXT"]["VALUE"]); $i++)
		{
			$name = $arProps["TEXT"]["DESCRIPTION"][$i];
			if (    (($name == "Технические характеристики" || $name == "Скачать") && ($url['query'] == "installer")) or (($name != "Скачать") && ($url['query'] == "manager")) or ($url['query'] == "")    ) 
			{
				$vkladka_content .= '<input name="vkladki" type="checkbox"';
				$vkladka_content .= ' id="'.translitIt(strtolower($name)).'"><label for="'.translitIt(strtolower($name)).'"><span class="dashed">'.$name.'</span></label>';
				$vkladka_content .= '<div><div class="text_items">'.html_entity_decode($arProps["TEXT"]["VALUE"][$i]["TEXT"]).'</div>';
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
		}
		$content .= '<div class="tabs">'.$vkladka_content.'</div>';
	}
	$content = preg_replace_callback("/\[download:(.+)\]/", "GetDownloadFile", $content);
	$content = preg_replace_callback("/\[downloadImg:(.+)\]/", "GetDownloadFileImg", $content);
	$content = preg_replace_callback("/\[price:(.+)\]/", "GetPrice", $content);
	if ($arProps["PHP"]["VALUE"]){
		for($i=0; $i < count($arProps["PHP"]["VALUE"]); $i++)
		{
			if (!preg_match('/(.*percoDemo\/products\/turnikety.*|.*percoMobile\/products\/turnikety.*|.*percoDemo\/products\/elektromekhanicheskie-zamki.*|.*percoMobile\/products\/elektromekhanicheskie-zamki.*|.*percoDemo\/products\/sistema-kontrolya-dostupa-perco-web.*|.*percoMobile\/products\/sistema-kontrolya-dostupa-perco-web.*|.*percoDemo\/products\/po-sistemy-kontrolya-dostupa-perco-web.*|.*percoMobile\/products\/po-sistemy-kontrolya-dostupa-perco-web.*)/', $_SERVER['REQUEST_URI'])) {
				include($_SERVER["DOCUMENT_ROOT"].$arProps["PHP"]["VALUE"][$i]);
			}
			$content .= '<div class="include-part">';
			$content = str_ireplace($arProps["PHP"]["DESCRIPTION"][$i], $php_result, $content);
			$content .= '</div>';
		}
	}	

	?>
		<div class="section-information">
			<div class="include-part">
			<? 
			if ($arProps["PHP"]["VALUE"]){
				for($i=0; $i < count($arProps["PHP"]["VALUE"]); $i++){
					include($_SERVER["DOCUMENT_ROOT"].$arProps["PHP"]["VALUE"][$i]);
				}
			}
			/*if($arResult["CODE"] == "karty-dostupa"){
				$elemets = '<div class="section">';
				foreach ($products as $product){
					$elemets .= '<div class="element">
									<a>
										<img alt="'.$product['name'].'" src="/images/products/identifiers/'.$product['image'].'">
										<h3>'.$product['name'].'</h3>
										<p>'.$product['description'].'</p>
										<p>'.$product['info'].'</p>
									</a>
								</div>';
				}
				$elemets .= '</div>';
				echo $elemets;
			}*/
			?>
			</div>
			<?echo $content;?>
		</div>
</div>
<?
if ($url['path'] == '/percoMobile/products/sistema-dlya-bankomatov-perco-s-800/' || $url['path'] == '/percoDemo/products/sistema-dlya-bankomatov-perco-s-800/') {
$linkPrefix = (preg_match('/\/percoDemo\//', $url['path']) == 1) ? '/percoDemo/' : '/percoMobile/';
?>
<div id="secel_list">
	<div class="secel_item test3" style="margin: 0 2%; inline-size: 29%;">
		<a href="<?= $linkPrefix ?>products/kontroller-upravleniya-dostupom-sc-820.php">
			<div class="image_icon">
				<img alt="Контроллер управления доступом SC-820" src="/images/products/atm-system/sc-820.jpg">
			</div>
			<div class="text_item">
				<span>Контроллер управления доступом SC-820</span>
				<div class="price">
					<p style="">SC-820. Цена <span class="price_rub">10 747 ₽</span> со склада в Москве и Санкт-Петербурге</p>
					<p>137 € (по курсу ЦБ РФ на 25.05.20)</p>
				</div>
			</div>
		</a>
	</div>
	<div class="secel_item test3" style="margin: 0 2%; inline-size: 29%;">
		<a href="<?= $linkPrefix ?>products/schityvatel-bankovskikh-kart-rmc01.php">
			<div class="image_icon">
				<img alt="Считыватель банковских карт RMC01" src="/images/products/atm-system/rmc01.jpg">
			</div>
			<div class="text_item">
				<span>Считыватель банковских карт RMC01</span>
				<div class="price">
					<p style="">RMC01. Цена <span class="price_rub">13 571 ₽</span> со склада в Москве и Санкт-Петербурге</p>
					<p>173 € (по курсу ЦБ РФ на 25.05.20)</p>
				</div>
			</div>
		</a>
	</div>
	<div class="secel_item test3" style="margin: 0 2%; inline-size: 29%;">
		<a href="<?= $linkPrefix ?>products/schityvatel-bankovskikh-kart-promix-rr-mc-02.php">
			<div class="image_icon">
				<img alt="Считыватель банковских карт Promix-RR.MC.02" src="/images/products/atm-system/schityvatel-bankovskikh-kart-promix-rr-mc-02_page.jpg">
			</div>
			<div class="text_item">
				<span>Считыватель банковских карт Promix-RR.MC.02</span>
				<div class="price">
					<p style="">Promix-RR.MC.02. Цена <span class="price_rub">7 374 ₽</span> со склада в Москве и Санкт-Петербурге</p>
					<p>94 € (по курсу ЦБ РФ на 25.05.20)</p>
				</div>
			</div>
		</a>
	</div>
</div>
<? } ?>
<? if ($arProps["SCROLL"]["VALUE"]) { ?>
	<div style="display: none;" class="scroll" id="horizontal_scroll">
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