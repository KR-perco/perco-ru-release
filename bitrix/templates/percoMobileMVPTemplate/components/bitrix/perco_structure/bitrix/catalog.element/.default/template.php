<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
CJSCore::Init(array("jquery"));

$this->addExternalJS("/scripts/mobil/catalog.js");
$this->addExternalJS("/scripts/lightgallery/js/lightgallery.min.js");
$this->addExternalJS("/scripts/lightslider/js/lightslider.min.js");
$this->addExternalJS("/scripts/lightgallery/js/lg-zoom.min.js");
$this->addExternalCss("/scripts/lightgallery/css/lightgallery.min.css");
$this->addExternalCss("/scripts/lightslider/css/lightslider.min.css");

global $device;
$page = $APPLICATION->GetCurUri();
$url = parse_url($page);

if ($arResult["PROPERTIES"]["CSS"]["VALUE"])
	$APPLICATION->SetAdditionalCSS($arResult["PROPERTIES"]["CSS"]["VALUE"]); // подключение стилей

function addkey($key, $sort)			// функция для сортировки тех. характеристик
{
	if(array_key_exists($key, $sort))
	{
		$key++;
		return addkey($key, $sort);
	}
	else
		return $key;
}

// Основные вкладки ->
for($i=0; $i < count($arResult["PROPERTIES"]["TEXT"]["VALUE"]); $i++)
{
	$vkladka_menu = "";
	$name = $arResult["PROPERTIES"]["TEXT"]["DESCRIPTION"][$i];
	$vkladka_menu = '<input name="vkladki" type="checkbox"';
	$vkladka_menu .= ' id="'.translitIt(strtolower($name)).'"><label for="'.translitIt(strtolower($name)).'"><span class="dashed">'.$name.'</span></label>';
	$vkladka_content .= $vkladka_menu.'<div><div class="text_items">'.html_entity_decode($arResult["PROPERTIES"]["TEXT"]["VALUE"][$i]["TEXT"]).'</div>';
	if (in_array($name, $arResult["PROPERTIES"]["IMAGES_TEXT"]["DESCRIPTION"]))
	{
		$vkladka_content .= '<div class="scroll horizontal_scroll"><ul style="max-height: 270px;" id="img_items'.$i.'">';
		foreach(array_keys($arResult["PROPERTIES"]["IMAGES_TEXT"]["DESCRIPTION"], $name) as $keyValue)
		{
			$arFilter = Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGES"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGES_TEXT"]["VALUE"][$keyValue]);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
			$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			if ($ob = $res->GetNextElement())
			{
				$arPropsImg = $ob->GetProperties();
				$vkladka_content .= '<li class="img_item';
				if (!$arPropsImg["FULL"]["VALUE"])
					$vkladka_content .= " anons_img";
				$vkladka_content .= '">';
				$keyFullImg = array_search(LANGUAGE_ID, $arPropsImg["FULL_OPIS"]["DESCRIPTION"]);
				$keyPreviewImg = array_search(LANGUAGE_ID, $arPropsImg["PREVIEW_OPIS"]["DESCRIPTION"]);
				
				if($arPropsImg["FULL"]["VALUE"]){
					$vkladka_content .='<img src="'.$arPropsImg["FULL"]["VALUE"].'" alt="'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'"/>
										<div class="caption">'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'</div>';
				}else{
					$vkladka_content .='<img src="'.$arPropsImg["PREVIEW"]["VALUE"].'" alt="'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'"/>
					<div class="caption">'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'</div>';
				}
				$vkladka_content .= '</li>';
			}
		}
		$vkladka_content .= '</ul></div>';
	}
	$vkladka_content .= '</div>';
}
// <- Основные вкладки

if ($arResult["PROPERTIES"]["SPECIFICATIONS"]["VALUE"])
{
	$arFilter = Array("IBLOCK_CODE"=>"product_info", "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["SPECIFICATIONS"]["VALUE"]);
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PRICE", "PROPERTY_PICTOGRAM", "PROPERTY_VIDEO", "PROPERTY_DOWNLOADS");
	$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
	$ob = $res->GetNextElement();
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	$APPLICATION->AddHeadString('<script type="text/javascript">var model="'.$arFields["NAME"].'";</script>', true);

// Видео ->
	if ($arProps["VIDEO"]["VALUE"])
	{
		foreach($arProps["VIDEO"]["VALUE"] as $val)
		{
			$video_dop_name = "";
			$arFilter = Array("IBLOCK_ID"=>$arProps["VIDEO"]["LINK_IBLOCK_ID"], "ID" => $val, "ACTIVE" => "Y");
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_*");
			$resIBlock = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			if (intval($resIBlock->SelectedRowsCount()) > 0)
			{
				$obIBlock = $resIBlock->GetNextElement();
				$arIBlockFields = $obIBlock->GetFields();
				$arIBlockProps = $obIBlock->GetProperties();
				// $arIBlock = GetIBlockElement($val);
				$keyFile = array_search(LANGUAGE_ID, $arIBlockProps["FILE"]["DESCRIPTION"]);
				if ($keyFile === false)
					continue;
				$vfile = pathinfo($arIBlockProps["FILE"]["VALUE"][$keyFile]);
				$keyName = array_search(LANGUAGE_ID, $arIBlockProps["NAME"]["DESCRIPTION"]);
				if ($arIBlockProps["POSTER"]["DESCRIPTION"])
				{
					$keyPoster = array_search(LANGUAGE_ID, $arIBlockProps["POSTER"]["DESCRIPTION"]);
					$poster = $arIBlockProps["POSTER"]["VALUE"][$keyPoster];
				}
				else
					$poster = "/images/video/poster.jpg";
				switch($arIBlockProps["TYPE"]["VALUE"])
				{
					case "видео-презентация":
						$type = '<img alt="'.GetMessage("VIDEO").'" src="/images/icons/video.svg" />';
						$text = '<div><span class="dashed">'.GetMessage("VIDEO").'</span></div>';
						break;
					case "3D-модель":
						$type = '<img alt="'.GetMessage("3D_PRESENTATION").'" src="/images/icons/3d-video.svg" />';
						$text = '<div><span class="dashed">'.GetMessage("3D_PRESENTATION").'</span></div>';
						break;
					case "Видеоинструкция по установке":
						$fSize = '('.printFileInfo($arIBlockProps["FILE"]["VALUE"][$keyFile], "size").')&nbsp;';
						$datezbor = printFileInfo($file, "date");
						if (LANGUAGE_ID == "ru")
							$video_dop_name = ". ".$arIBlockProps["TYPE"]["VALUE"];
						$videoInstr = '<div class="download_item"><div class="icon"><img alt="'.GetMessage("DOWNLOAD").'" src="/images/icons/download.svg" /></div><div><a href="'.$arIBlockProps["FILE"]["VALUE"][$keyFile].'" download>'.$arIBlockProps["NAME"]["VALUE"][$keyName].$video_dop_name.'</a><p class="color">'.$fSize.' — '.$datezbor.'</p></div></div>';
						continue 2;
						break;
					default:
						$type = "";
						$text = "";
						break;
				}
				$video .= '<div class="video">
						<div id="'.$arIBlockFields["CODE"].'">
							<p>'.$arIBlockProps["TYPE"]["VALUE"].':</p>
							<video class="lg-video-object lg-html5" controls="controls" poster="'.$arIBlockProps["IMAGE"]["VALUE"][0].'">
								<source src="'.$vfile["dirname"]."/".$vfile["filename"].'.mp4" type="video/mp4" />
								<source src="'.$vfile["dirname"]."/".$vfile["filename"].'.webm" type=\'video/webm; codecs="vp8, vorbis"\' />
							</video>
						</div>
						</div>';
			}
		}
	}
// <- Видео
// Схема СКУД ->
	if ($arProps["SHEMASKUD"]["VALUE"] && LANGUAGE_ID == "ru")
	{
		$shemaskud = '<div id="sheme_skud">
					<a title="Схема системы" data-iframe="true" data-src="/shema/skud.php?iframe=true">
						<img alt="Схема системы" src="/images/icons/shema-skud.svg" />
						<div><span class="dashed">схема системы</span></div>
					</a>
				</div>';
	}
// <- Схема СКУД
	if ($arProps["SHEMA"]["VALUE"] || $arProps["VIDEO"]["VALUE"] || $arProps["SHEMASKUD"]["VALUE"])
		$shema_video = '<div class="shema_video">'.$video.$shemaskud.'</div>';
// Цена ->
	if ($arProps["PRICE"]["VALUE"] && LANGUAGE_ID == "ru")
	{
		GetRate();
		global $price_res;
		$price = $price_res * $arProps["PRICE"]["VALUE"];
		if ($arProps["PRICE"]["VALUE"] >= 1)
			$drob = 0;
		else
			$drob = 2;
		if (stripos($arResult["PROPERTIES"]["IMAGE_PREVIEW"]["VALUE"], "/po/") === false)
			$price_text = "со склада в Москве и Санкт-Петербурге";
		$price_result = '<div id="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
				<p>Цена '.$price_text.' <meta itemprop="priceCurrency" content="EUR" /><span itemprop="price" content="'.$arProps["PRICE"]["VALUE"].'">'.number_format($arProps["PRICE"]["VALUE"], $drob, ".", " ").'</span> €</p>';
		if ($price == 0)
			$price_result .= "<p>в рублях по курсу ЦБ РФ</p>";
		else
			$price_result .= '<p><span class="price_rub">'.number_format($price, 0, ",", " ").'</span> &#8381;</span> (по ЦБ РФ на '.date("d.m.y").')</p>';
		$price_result .= '</div>';
	}
// <- Цена
	if($arProps["PICTOGRAM"]["VALUE"])
	{
		$pictogram = '<div id="pictogram">
						<div id="pictogram_items">';
		$sort = array();
		foreach($arProps["PICTOGRAM"]["VALUE"] as $val)
		{
			$resSort = CIBlockElement::GetByID($val);
			$arSort = $resSort->Fetch();
			if(array_key_exists($key, $sort))
				$key = addkey($arSort["SORT"], $sort);
			else
				$key = $arSort["SORT"];
			$sort[$key] = $arSort["ID"];
		}
		ksort($sort);
		$arProps["PICTOGRAM"]["VALUE"] = $sort;
		foreach($arProps["PICTOGRAM"]["VALUE"] as $val)
		{
			$arFilter = Array("IBLOCK_ID"=>$arProps["PICTOGRAM"]["LINK_IBLOCK_ID"], "ID" => $val);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_*");
			$resIBlock = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			$obIBlock = $resIBlock->GetNextElement();
			// $arIBlockFields = $obIBlock->GetFields();
			$arIBlockProps = $obIBlock->GetProperties();
			// $arIBlock = GetIBlockElement($val);
			$key = array_search(LANGUAGE_ID, $arIBlockProps["IMAGE_DESCRIPTION"]["DESCRIPTION"]);
			if ($key !== false)
			{
				$pictogram .= '<div class="pictogram_item">
							<img src="'.$arIBlockProps["IMAGE"]["VALUE"].'" alt="'.$arIBlockProps["IMAGE_DESCRIPTION"]["VALUE"][$key].'" />
							<p>'.$arIBlockProps["IMAGE_DESCRIPTION"]["VALUE"][$key].'</p>
						</div>';
			}
		}
		$pictogram .= '</div></div>';
	}
	if ($arProps["SPECIFICATIONS"]["VALUE"])
	{
		$vkladka_menu = '<input name="vkladki" type="checkbox" id="teh_info"><label for="teh_info"><span class="dashed">'.GetMessage("SPECIFICATIONS").'</span></label>';
		$sort = array();
		$vkladka_content .= $vkladka_menu.'<div>';
		foreach($arProps["SPECIFICATIONS"]["VALUE"] as $val)
		{
			$resSort = CIBlockElement::GetByID($val);
			$arSort = $resSort->Fetch();
			if(array_key_exists($key, $sort))
				$key = addkey($arSort["SORT"], $sort);
			else
				$key = $arSort["SORT"];
			$sort[$key] = $arSort["ID"];
		}
		ksort($sort);
		$arProps["SPECIFICATIONS"]["VALUE"] = $sort;
		foreach($arProps["SPECIFICATIONS"]["VALUE"] as $val)
		{
			$rsIBlock = CIBlockElement::GetProperty($arProps["SPECIFICATIONS"]["LINK_IBLOCK_ID"], $val, array("sort" => "asc"), Array("CODE"=>LANGUAGE_ID));
			$arIBlock = $rsIBlock->Fetch();
			// $arIBlock = GetIBlockElement($val);
			$vkladka_content .= '<div class="teh_item"><div class="teh_name">'.$arIBlock["VALUE"].'</div><div class="teh_value">'.$arIBlock["DESCRIPTION"].'</div></div>';
		}
// Отображаем цвет с подписями ->
		$vkladka_content .= '<div class="color_block">';
if($_GET["F"])
$vkladka_content .= '<p>Варианты исполнения:</p>';
		$pattern = "/\[".LANGUAGE_ID."\]/";
		$arDesc = preg_grep($pattern, $arProps["COLOR_DESCRIPTION"]["DESCRIPTION"]);
		foreach($arProps["COLOR"]["VALUE"] as $val)
		{
			$arFilter = Array("IBLOCK_ID"=>$arProps["COLOR"]["LINK_IBLOCK_ID"], "ID" => $val);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_*");
			$resIBlock = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			$obIBlock = $resIBlock->GetNextElement();
			$arIBlockFields = $obIBlock->GetFields();
			$arIBlockProps = $obIBlock->GetProperties();
			// $arIBlock = GetIBlockElement($arProps["COLOR"]["VALUE"][$i]);
			$key = array_search(LANGUAGE_ID, $arIBlockProps["IMAGE_DESCRIPTION"]["DESCRIPTION"]);
			foreach($arDesc as $descKey => $value)
			{
				if (stripos($value, $arIBlockFields["NAME"]))
				{
$arDetail = explode(",", $arProps["COLOR_DESCRIPTION"]["VALUE"][$descKey]);
foreach($arDetail as $val)
	$details[trim($val)][] = array("src"=> $arIBlockProps["IMAGE"]["VALUE"], "text" => $arIBlockProps["IMAGE_DESCRIPTION"]["VALUE"][$key]);
if(!$_GET["F"])
					$vkladka_content .="<p>".$arProps["COLOR_DESCRIPTION"]["VALUE"][$descKey]."</p>";
				}
			}
if(!$_GET["F"])
$vkladka_content .= '<div class="color"><img src="'.$arIBlockProps["IMAGE"]["VALUE"].'" alt="'.$arIBlockProps["IMAGE_DESCRIPTION"]["VALUE"][$key].'" /><br>'.$arIBlockProps["IMAGE_DESCRIPTION"]["VALUE"][$key].'</div>';
		}
if($_GET["F"])
foreach($details as $key => $detail)
{$vkladka_content .= '<div class="color newcolor"><div class="text_detail">'.$key.'</div><div class="clr_new">';
	foreach($detail as $val)
		$vkladka_content .= '<img class="imgbox" src="'.$val["src"].'" alt="'.$val["text"].'"/><br>'.$val["text"];
	$vkladka_content .= '</div></div>';
}
		$vkladka_content .= '</div>';
// <- Отображаем цвет с подписями
// Отображаем Исполенине ->
if(!$_GET["F"])
		foreach(array_keys($arProps["ISPOLNENIE"]["DESCRIPTION"], LANGUAGE_ID) as $keyValue)
		{
			$vkladka_content .= '<p>'.$arProps["ISPOLNENIE"]["VALUE"][$keyValue].'</p>';
		}
// <- Отображаем Исполенине
// Отображаем Гарантийный срок ->
		foreach(array_keys($arProps["WARRANTY"]["DESCRIPTION"], LANGUAGE_ID) as $keyValue)
		{
			$vkladka_content .= '<p class="warranty">'.$arProps["WARRANTY"]["VALUE"][$keyValue].'</p>';
		}
		$vkladka_content .= '</div>';
// <- Отображаем Гарантийный срок
}
// Загружаемые файлы ->
	if (($arProps["DOWNLOADS"]["VALUE"]) && ($url["query"] != "manager"))
	{
		echo($url["query"]);
		$download = "";
		$arFilter = Array("IBLOCK_ID"=>$arProps["DOWNLOADS"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID" => $arProps["DOWNLOADS"]["VALUE"]);
		$res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter);
		while($ob = $res->GetNextElement())
		{
			$ico = "";
			$AutoCadtitle = "";
			$arPropDown = $ob->GetProperties();
			$keyFile = array_search(LANGUAGE_ID, $arPropDown["FILE"]["DESCRIPTION"]);
			if($keyFile === false)
				continue;
			$file = $arPropDown["FILE"]["VALUE"][$keyFile];
			$keyName = array_search(LANGUAGE_ID, $arPropDown["NAME"]["DESCRIPTION"]);
			$name = $arPropDown["NAME"]["VALUE"][$keyName];
			if($arPropDown["ICON"]["VALUE"] == "pdf"){
				$download .= '<div class="download_item">';
				$fSize = '('.printFileInfo($file, "size").')&nbsp;';
				$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
				if ($arPropDown["INSTAL_TIME"]["VALUE"])
					$datezbor = $arPropDown["INSTAL_TIME"]["VALUE"];
				else
					$datezbor = printFileInfo($file, "date");
				$download .= '<div class="icon"><img alt="Иконка" src="/images/icons/pdf.svg" /></div><div><a href="https://www.perco.ru'.$file.'">'.$name.'</a><p class="color">'.$AutoCadtitle.$fSize.' — '.$datezbor.'</p>';
				$download .= '</div></div>';
			}
		}
		if ($download)
		{
			$vkladka_menu = '<input name="vkladki" type="checkbox" id="download_info"><label for="download_info" id="label_download"><span class="dashed">'.GetMessage("DOWNLOAD").'</span></label>';
			$vkladka_content .= $vkladka_menu.'<div>'.$download.$videoInstr.'</div>';
		}
	}
// <- Загружаемые файлы

// Добавление видео во вкладку ->
	if ($video)
	{
		$vkladka_menu = '<input name="vkladki" type="checkbox" id="video_info"><label id="label_video" for="video_info"><span class="dashed">Видео</span></label>';
		$vkladka_content .= $vkladka_menu.'<div>'.$video.'</div>';
	}
// <- Добавление видео во вкладку
}
if (substr_count($vkladka_content, "vkladki") > 1)
	$content .= '<div class="tabs product-tabs">'.$vkladka_content.'</div>';
else
	$content .= str_ireplace($vkladka_menu, "", $vkladka_content);
$content = preg_replace_callback("/\[download:(.+)\]/", "GetDownloadFile", $content);
$content = preg_replace_callback("/\[downloadImg:(.+)\]/", "GetDownloadFileImg", $content);
if ($arResult["PROPERTIES"]["PHP"]["VALUE"])		// Делаем вставки php
{
	for($i=0; $i < count($arResult["PROPERTIES"]["PHP"]["VALUE"]); $i++)
	{
		include($_SERVER["DOCUMENT_ROOT"].$arResult["PROPERTIES"]["PHP"]["VALUE"][$i]);
		$content = str_ireplace($arResult["PROPERTIES"]["PHP"]["DESCRIPTION"][$i], $php_result, $content);
	}
}
if ($arResult["PROPERTIES"]["LINKS"]["VALUE"])		// Устанавливаем ссылки на фразы
{
	for($i=0; $i < count($arResult["PROPERTIES"]["LINKS"]["VALUE"]); $i++)
	{
		$url = '/percoMobile'.$arResult["PROPERTIES"]["LINKS"]["VALUE"][$i].'';
		$trans = str_replace("/", "\/", $arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"][$i]);
		$content = preg_replace("/(?<![\"\'\«]{1})$trans/", "<a href='$url'>\\0</a>", $content, 1);
	}
}
?>

<div id="content">
	<h2><?=$arResult["NAME"]?> <?if ($arResult["PROPERTIES"]["DOP_NAME"]["VALUE"]) echo $arResult["PROPERTIES"]["DOP_NAME"]["VALUE"];?></h2>
	<?if (count($arResult["PROPERTIES"]["IMAGE"]["VALUE"]) > 1){ ?>
		<div class="main-picture">
			<ul id="main-slider">
				<?
				$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
				$img_val = $resImg->Fetch();
				foreach($arResult["PROPERTIES"]["IMAGE"]["VALUE"] as $val)
				{
					$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $val), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
					$img_val = $resImg->Fetch();
					?>
					<li data-thumb="<?=$img_val["PROPERTY_PREVIEW_VALUE"]?>" data-src="<?=$img_val["PROPERTY_FULL_VALUE"]?>"><img alt="<?=$arResult["NAME"]?>" src="<?=$img_val["PROPERTY_PREVIEW_VALUE"]?>"></li>
					<?
				}
				if ($arProps["SHEMA"]["VALUE"]){
					?>
						<li data-thumb="<?=$arProps["SHEMA"]["VALUE"]?>" data-src="<?=$arProps["SHEMA"]["VALUE"]?>"><img class="sheme" alt="sheme" src="<?=$arProps["SHEMA"]["VALUE"]?>"/></li>
					<?
				}

				?>
			</ul>
		</div>
	<?}else{
		?><div class="main-picture"><img alt="<?=$arResult["NAME"]?>" src="<?=$arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]?>"></div><?
	}			
	?>
	
	<div class="price" id="price">
		<?=$price_result?>
	</div>
	<div class="description">
		<div class="preview_text">
			<?=$arResult["PREVIEW_TEXT"]?>
		</div>
		<?if($arResult["DETAIL_TEXT"]){?>
		<div class="detail_text">
			<?=$arResult["DETAIL_TEXT"]?>
		</div>
		<?}?>
	</div>

	<?
	if (substr_count($vkladka_content, "vkladki") > 1)
		$tabs .= '<div class="tabs product-tabs">'.$vkladka_content.'</div>';
	else
		$tabs .= str_ireplace($vkladka_menu, "", $vkladka_content);
	$tabs = preg_replace_callback("/\[download:(.+)\]/", "GetDownloadFile", $content);
	$tabs = preg_replace_callback("/\[downloadImg:(.+)\]/", "GetDownloadFileImg", $content);
	if ($arResult["PROPERTIES"]["PHP"]["VALUE"])		// Делаем вставки php
	{
		for($i=0; $i < count($arResult["PROPERTIES"]["PHP"]["VALUE"]); $i++)
		{
			include($_SERVER["DOCUMENT_ROOT"].$arResult["PROPERTIES"]["PHP"]["VALUE"][$i]);
			$tabs = str_ireplace($arResult["PROPERTIES"]["PHP"]["DESCRIPTION"][$i], $php_result, $content);
		}
	}
	echo $tabs;
	?>


<?
if ($arResult["PROPERTIES"]["SCROLL"]["VALUE"])
{
?>
	<div class="scroll" id="horizontal_scroll">
<?
global $arrFilter;
$arrFilter["PROPERTY_TYPE_PRODUCT"] = $arResult["PROPERTIES"]["SCROLL"]["VALUE"];
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
	"PAGER_TITLE" => "Фотографии",
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
);
?>
	</div>
<? } ?>
</div>
<script>
var href = window.location.href;
worker = href.substring(href.indexOf('#')+1);
if (worker == 'manager') {
	document.getElementById('label_download').style.display = "none";
} else if (worker == 'installer') {
	document.getElementById('price').style.display = "none";
	document.getElementById('horizontal_scroll').style.display = "none";
	document.getElementById('label_video').style.display = "none";
}
</script> 