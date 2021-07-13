<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$this->setFrameMode(true);
global $device;

// $APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.min.js"); // подключение скриптов
// $APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-zoom.min.js"); // подключение скриптов
// $APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-fullscreen.min.js"); // подключение скриптов
$APPLICATION->SetPageProperty("bodyItemtype", "ItemPage");

if ($arResult["PROPERTIES"]["JS"]["VALUE"])
	$APPLICATION->AddHeadScript($arResult["PROPERTIES"]["JS"]["VALUE"]); // подключение скриптов
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

console_log("element cataloga");
console_log($arResult);
?>
<div id="main_block">
<!-- <script src="/scripts/lightgallery/js/lg-thumbnail.min.js"></script>
<script src="/scripts/lightgallery/js/lg-fullscreen.min.js"></script> -->
<?
if ($arResult["PREVIEW_TEXT"])
	$content = '<div class="preview_text" itemprop="description">'.$arResult["PREVIEW_TEXT"].'</div>';
if ($arResult["DETAIL_TEXT"])
	$content .= '<div>'.$arResult["DETAIL_TEXT"].'</div>';
// баннеры на английском языке ->	
if (LANGUAGE_ID == "en"){
	switch ($arResult["SECTION"]["NAME"]){
		case 'IP-based entrance control systems':
			$content .= '<div class="banner_perco-web">
				<a href="/products/perco-web-access-control-system/">
					<img alt="banner_perco-web" src="/images/banners/PERCo-Web.png">
				</a>
			</div>';
			break;
		case 'Compact Tripod Turnstiles':
		case 'Box Tripod Turnstiles':
		case 'Speed Gates':
		case 'Waist-high Rotor Turnstiles':
		case 'Full Height Rotor Turnstiles and Security Gates':
		case 'Swing Gates':
		case 'Railing Systems':
			$content .= '<div class="banner_perco-web">
				<a href="/products/perco-web-access-control-system/">
					<img alt="banner_perco-web" src="/images/banners/Turnikets.png">
				</a>
			</div>';
			break;
	}
}
// Основные вкладки ->
for($i=0; $i < count($arResult["PROPERTIES"]["TEXT"]["VALUE"]); $i++)
{
	$vkladka_menu = "";
	$name = $arResult["PROPERTIES"]["TEXT"]["DESCRIPTION"][$i];
	$vkladka_menu = '<input name="vkladki" type="radio"';
	if ($i == 0)
		$vkladka_menu .= ' checked="checked"';
	$vkladka_menu .= ' id="'.translitIt(strtolower($name)).'"><label for="'.translitIt(strtolower($name)).'"><span class="dashed">'.$name.'</span></label>';
	$vkladka_content .= $vkladka_menu.'<div><div class="text_items">'.html_entity_decode($arResult["PROPERTIES"]["TEXT"]["VALUE"][$i]["TEXT"]).'</div>';
	if (in_array($name, $arResult["PROPERTIES"]["IMAGES_TEXT"]["DESCRIPTION"]))
	{
		$vkladka_content .= '<div class="img_items"'.(($arResult['PROPERTIES']['IMAGES_DIR']['VALUE'] == 'только колонкой') ? ' style="flex-basis: 254px;"' : '').'>';
		foreach(array_keys($arResult["PROPERTIES"]["IMAGES_TEXT"]["DESCRIPTION"], $name) as $keyValue)
		{
			$arFilter = Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGES"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGES_TEXT"]["VALUE"][$keyValue]);
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
				$vkladka_content .= '<img src="'.$arPropsImg["PREVIEW"]["VALUE"].'" alt="'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'">
					<div class="frame"></div>';
				if ($arPropsImg["FULL"]["VALUE"])
					$vkladka_content .= "</a>";
				$vkladka_content .= '<div>'.$arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg].'</div></div>';
			}
		}
		$vkladka_content .= '</div>';
	}
	$vkladka_content .= '</div>';
}
// <- Основные вкладки
if ($arResult["PROPERTIES"]["SPECIFICATIONS"]["VALUE"])
{
	$arFilter = Array("IBLOCK_CODE"=>"product_info", "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["SPECIFICATIONS"]["VALUE"]);
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PRICE", "PROPERTY_PICTOGRAM", "PROPERTY_VIDEO", "PROPERTY_REVIEW", "PROPERTY_DOWNLOADS");
	$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
	$ob = $res->GetNextElement();
	$arFields = $ob->GetFields();
	$arProps = $ob->GetProperties();
	$APPLICATION->AddHeadString('<script type="text/javascript">var model="'.$arFields["NAME"].'";</script>', true);

// Чертеж ->
	if ($arProps["SHEMA"]["VALUE"])
	{
		$shema = '<div id="shema">
					<a href="'.$arProps["SHEMA"]["VALUE"].'" title="'.GetMessage("SCHEME").'">
						<img alt="'.GetMessage("SCHEME").'" src="/images/icons/shema.svg" />
						<div><span class="dashed">'.GetMessage("SCHEME").'</span></div>
					</a>
				</div>';
	}
// <- Чертеж
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
				$keyYoutube = array_search(LANGUAGE_ID, $arIBlockProps["YOUTUBE"]["DESCRIPTION"]);
				?><pre style="display: none;" data-youtube="123"><?=var_dump($arIBlockProps["YOUTUBE"]["DESCRIPTION"]);?></pre><?
				?><pre style="display: none;" data-youtube-key="123"><?=var_dump($arIBlockProps["YOUTUBE"]["VALUE"][$keyYoutube]);?></pre><?
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
						$videoInstr = '<div class="download_item"><div class="icon"><img alt="'.GetMessage("DOWNLOAD").'" src="/images/icons/video-instruction.svg" /></div><div><a href="'.$arIBlockProps["FILE"]["VALUE"][$keyFile].'" target="_blank" onclick="ga(\'send\', \'event\', {\'eventCategory\': \'Видео\', \'eventAction\': \'Загрузки\', \'eventLabel\': \''.$arIBlockProps["NAME"]["VALUE"][$keyName].'\'});" download>'.$arIBlockProps["NAME"]["VALUE"][$keyName].$video_dop_name.'</a><span class="color"><br />'.$fSize.' — '.$datezbor.'</span></div></div>';
						continue 2;
						break;
					default:
						$type = "";
						$text = "";
						break;
				}
				$video .= '<div class="video">
								<div class="itemVideo" href="https://www.youtube.com/watch?v='.$arIBlockProps["YOUTUBE"]["VALUE"][$keyYoutube].'" data-download-url="'.$arIBlockProps["FILE"]["VALUE"][$keyFile].'" onclick="ga(\'send\', \'event\', {\'eventCategory\': \'Видео\', \'eventAction\': \'Просмотр\', \'eventLabel\': \''.$arIBlockProps["NAME"]["VALUE"][$keyName].'\'});">'.$type.$text.'</div>
							</div>';
			}
		}
	}
// <- Видео

// Схема СКУД ->
	if ($arProps["SHEMASKUD"]["VALUE"] && LANGUAGE_ID == "ru")
	{
		// $shemaskud = '<div id="sheme_skud">
		// 			<a title="Схема системы" href="/images/shema/shema.svg">
		// 				<img alt="Схема системы" src="/images/icons/shema-skud.svg" />
		// 				<div><span class="dashed">схема системы</span></div>
		// 			</a>
		// 		</div>';
		$shemaskud = '<div id="sheme_skud">
					<a title="Схема системы" data-iframe="true" data-src="/images/shema/shema.svg">
						<img alt="Схема системы" src="/images/icons/shema-skud.svg" />
						<div><span class="dashed">схема системы</span></div>
					</a>
				</div>';
	}
// <- Схема СКУД

// Видеообзор ->
if ($arProps["REVIEW"]["VALUE"])
{	
	$icon = '<img class="iconReview" alt="videoplayer" src="/images/icons/videoplayer.svg" />';
	$text = '<p style="font-size:12px;"><span class="dashed">'.GetMessage("REVIEW").'</span></p>';
	$review = '<div class="review">';
	foreach($arProps["REVIEW"]["VALUE"] as $val)
	{
		$arrFilter = Array("IBLOCK_ID"=>"35", "ID" => $val, "ACTIVE" => "Y");
		$arrSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE", "PROPERTY_*");
		$ressIBlock = CIBlockElement::GetList(array(), $arrFilter, false, Array(), $arrSelect);
		if (intval($ressIBlock->SelectedRowsCount()) > 0)
		{
			$obbIBlock = $ressIBlock->GetNextElement();
			$arrIBlockFields = $obbIBlock->GetFields();
			$arrIBlockProps = $obbIBlock->GetProperties();
			
			$keyyFile = array_search(LANGUAGE_ID, $arrIBlockProps["FILE"]["DESCRIPTION"]);
			$vfile = pathinfo($arrIBlockProps["FILE"]["VALUE"][$keyyFile]);
			$keyName = array_search(LANGUAGE_ID, $arrIBlockProps["NAME"]["DESCRIPTION"]);
			$keyImage = array_search(LANGUAGE_ID, $arrIBlockProps["IMAGE"]["DESCRIPTION"]);
			$keyPoster = array_search(LANGUAGE_ID, $arrIBlockProps["IMAGE"]["DESCRIPTION"]);
			$keyYoutube = array_search(LANGUAGE_ID, $arrIBlockProps["YOUTUBE"]["DESCRIPTION"]);
			if ($arrIBlockProps["FILE"]["VALUE"][$keyyFile] == '/video/PERCo-dostup.mp4') {
				// $icon = '';
				$type = '<img alt="'.GetMessage("VIDEO").'" src="/images/icons/android.svg" style="width:18px; float:left; margin-right:5px; margin-top:12px;"/>';
			}
			else if  ($arrIBlockProps["FILE"]["VALUE"][$keyyFile] == '/video/dostup-po-smartfonam-apple.mp4') {
				// $icon = '';
				$type = '<img alt="'.GetMessage("VIDEO").'" src="/images/icons/apple.svg" style="width:18px; float:left; margin-right:5px; margin-top:12px;"/>';
			}
			else $type = '';
			/*else {
				$type = '<img alt="'.GetMessage("VIDEO").'" src="'.$arrIBlockProps["IMAGE"]["VALUE"][$keyImage].'" />';
			}*/
			// $type = '<img alt="'.GetMessage("VIDEO").'" src="'.$arrIBlockProps["IMAGE"]["VALUE"][$keyImage].'" />';
			
			if ($arrIBlockProps["POSTER"]["DESCRIPTION"])
			{
				$keyPoster = array_search(LANGUAGE_ID, $arrIBlockProps["POSTER"]["DESCRIPTION"]);
				$poster = $arrIBlockProps["POSTER"]["VALUE"][$keyPoster];
			} else { $poster = "/images/video/poster.jpg"; }

			if ($arResult["CODE"] == "smartfony-s-nfc-modulem")
			{
				// $text = '<p style="font-size:15px;"><span class="dashed">'.$arrIBlockProps["NAME"]["VALUE"][$keyName].'</span></p>';
				$text = '<p style="font-size:12px;"><span class="dashed">видео</span></p>';
			}

			$review .= '<div style="cursor:pointer;" href="https://www.youtube.com/watch?v='.$arrIBlockProps["YOUTUBE"]["VALUE"][$keyYoutube].'" 
						   data-download-url="'.$arrIBlockProps["FILE"]["VALUE"][$keyyFile].'" 
						   onclick="ga(\'send\', \'event\', {\'eventCategory\': \'Видео\', \'eventAction\': \'Просмотр\', \'eventLabel\': \''.$arrIBlockProps["NAME"]["VALUE"]
							[$keyName].'\'});
							
							">'.$icon.'<img alt="видео" src="'.$poster.'" style="width:220px; margin-bottom:-10px;"><br>'.$type.$text.'</div>';
		}
	}
	$review .= '</div>';
}
// <- Видеообзор

	if ($arProps["SHEMA"]["VALUE"] || $arProps["VIDEO"]["VALUE"] || $arProps["SHEMASKUD"]["VALUE"])
		$shema_video = '<div class="shema_video">'.$shema.$video.$shemaskud.'</div>';

// Цена ->
	if ($arProps["PRICE"]["VALUE"] && LANGUAGE_ID == "ru")
	{
		//GetRate();
		//global $price_res;
		$price_res = getCurrency("EUR");
		$price = $price_res * $arProps["PRICE"]["VALUE"];
		if ($arProps["PRICE"]["VALUE"] >= 10)
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
		if ($arProps["PRICE"]["DESCRIPTION"])
			$price_result .= "<p>".$arProps["PRICE"]["DESCRIPTION"]."</p>";
		$price_result .= '<meta itemprop="availability" content="https://schema.org/InStock"><meta itemprop="url" content="https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'">';
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
		$vkladka_menu = '<input name="vkladki" type="radio" id="teh_info"><label for="teh_info"><span class="dashed" >'.GetMessage("SPECIFICATIONS").'</span></label>';
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
// Отображаем Исполнение ->
if($_GET["F"])
{
	$vkladka_content .= '<div class="ispolnenie">';
	foreach(array_keys($arProps["ISPOLNENIE"]["DESCRIPTION"], LANGUAGE_ID) as $keyValue)
	{
		$vkladka_content .= '<p>'.$arProps["ISPOLNENIE"]["VALUE"][$keyValue].'</p>';
	}
	$vkladka_content .= "</div>";
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
	if ($arProps["DOWNLOADS"]["VALUE"])
	{
		$download = "";
		$arFilter = Array("IBLOCK_ID"=>$arProps["DOWNLOADS"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "SECTION_ID" => $arProps["DOWNLOADS"]["VALUE"]);
		$res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter);
		while($ob = $res->GetNextElement())
		{
			$ico = "";
			$AutoCadtitle = "";
			$arPropDown = $ob->GetProperties();
			$fileLang = 'ru'; //часть кода для возвращения только английской версии файла на всех зарубежных сайтах, начало
			if (LANGUAGE_ID !== 'ru') {
				$fileLang = 'en';
			} //конец
			$keyFile = array_search($fileLang, $arPropDown["FILE"]["DESCRIPTION"]);
			if($keyFile === false)
				continue;
			$file = $arPropDown["FILE"]["VALUE"][$keyFile];
			$keyName = array_search($fileLang, $arPropDown["NAME"]["DESCRIPTION"]);
			$name = $arPropDown["NAME"]["VALUE"][$keyName];
			$download .= '<div class="download_item">';
			switch($arPropDown["ICON"]["VALUE"])
			{
				case "pdf":
					$ico = "/images/icons/pdf.svg";
					break;
				case "dwf":
					if (LANGUAGE_ID == "ru")
						$AutoCadtitle = 'для просмотра должна быть установлена программа Autodesk DWF Viewer<br />';
					$ico = "/images/icons/dwf.svg";
					break;
				case "dwg":
					$ico = "/images/icons/dwg.svg";
					break;
				default:
					$ico = "/images/icons/download.svg";
					break;
			}
			$fSize = '('.printFileInfo($file, "size").')&nbsp;';
			$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
			if ($arPropDown["INSTAL_TIME"]["VALUE"])
				$datezbor = $arPropDown["INSTAL_TIME"]["VALUE"];
			else
				$datezbor = printFileInfo($file, "date");
			$download .= '<div class="icon"><img alt="Иконка" src="'.$ico.'" /></div><div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.'</a><span class="color"><br />'.$AutoCadtitle.$fSize.' — '.$datezbor.'</span>';
			$download .= '</div></div>';
		}
		if ($download)
		{
			$vkladka_menu = '<input name="vkladki" type="radio" id="download_info"><label for="download_info"><span class="dashed">'.GetMessage("DOWNLOAD").'</span></label>';
			$vkladka_content .= $vkladka_menu.'<div>'.$download.$videoInstr.'</div>';
		}
	}
// <- Загружаемые файлы
}
if (substr_count($vkladka_content, "vkladki") > 1)
	$content .= '<div class="tabs">'.$vkladka_content.'</div>';
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
		$url = $arResult["PROPERTIES"]["LINKS"]["VALUE"][$i];
		$trans = str_replace("/", "\/", $arResult["PROPERTIES"]["LINKS"]["DESCRIPTION"][$i]);
		$content = preg_replace("/(?<![\"\'\«]{1})$trans/", "<a href='$url'>\\0</a>", $content, 1);
	}
}
if (count($arResult["PROPERTIES"]["IMAGE"]["VALUE"]) > 1)
{
	$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
	$img_val = $resImg->Fetch();
	$main_image = '<img alt="'.$arResult["NAME"].'" itemprop="image" src="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" />';
	$main_image = '<div id="list_img"><ul id="main_image_list">';
	$first_image = 'itemprop="image"';
	foreach($arResult["PROPERTIES"]["IMAGE"]["VALUE"] as $val)
	{
		$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $val), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
		$img_val = $resImg->Fetch();
		$main_image .= '<li data-thumb="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" data-src="'.$img_val["PROPERTY_FULL_VALUE"].'"><img alt="'.$arResult["NAME"].'" '.$first_image.' src="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" /></li>';
		if ($first_image != "") {
			$first_image = "";
			$APPLICATION->AddHeadString('<meta property="og:image" content="'.$img_val["PROPERTY_FULL_VALUE"].'">');
		}
	}
	$main_image .= '</ul></div>'; 
}
elseif(is_array($arResult["PROPERTIES"]["IMAGE"]["VALUE"]) && is_numeric($arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]))
{
	$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
	$img_val = $resImg->Fetch();
	$main_image = '<img alt="'.$arResult["NAME"].'" itemprop="image" src="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" />';
}
elseif (is_array($arResult["PROPERTIES"]["IMAGE"]["VALUE"]))
if (is_array($arResult["PROPERTIES"]["IMAGE"]["VALUE"]))
	$main_image = '<img alt="'.$arResult["NAME"].'" itemprop="image" src="'.$arResult["PROPERTIES"]["IMAGE"]["VALUE"][0].'" />';
else
	$main_image = '<img alt="'.$arResult["NAME"].'" itemprop="image" src="'.$arResult["PROPERTIES"]["IMAGE"]["VALUE"].'" />';

if (count($arResult["PROPERTIES"]["IMAGE"]["VALUE"]) == 1 && is_numeric($arResult["PROPERTIES"]["IMAGE"]["VALUE"][0])) { //делаем кликабельным изображение когда оно одно
	$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
	$img_val = $resImg->Fetch();
	$main_image = '<img alt="'.$arResult["NAME"].'" itemprop="image" src="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" />';
	$main_image = '<div id="list_img"><ul id="main_image_list">';
	$first_image = 'itemprop="image"';
	foreach($arResult["PROPERTIES"]["IMAGE"]["VALUE"] as $val)
	{
		$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $val), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
		$img_val = $resImg->Fetch();
		$main_image .= '<li data-thumb="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" data-src="'.$img_val["PROPERTY_FULL_VALUE"].'"><img alt="'.$arResult["NAME"].'" '.$first_image.' src="'.$img_val["PROPERTY_PREVIEW_VALUE"].'" /></li>';
		if ($first_image != "") {
			$first_image = "";
			$APPLICATION->AddHeadString('<meta property="og:image" content="'.$img_val["PROPERTY_FULL_VALUE"].'">');
		}
	}
	$main_image .= '</ul></div>'; 
}

$resImg = CIBlockElement::GetList(array("SORT"=>"ASC"), Array("IBLOCK_ID"=>$arResult["PROPERTIES"]["IMAGE"]["LINK_IBLOCK_ID"], "ACTIVE"=>"Y", "ID" => $arResult["PROPERTIES"]["IMAGE"]["VALUE"][0]), false, false, array("ID", "NAME", "PROPERTY_PREVIEW", "PROPERTY_FULL"));
	$img_val = $resImg->Fetch();
$product_name = '<div id="pruduct_name"><h1 itemprop="name">'.$arResult["NAME"];
if($arResult["NAME"] == 'PERCo-WB «Базовый пакет ПО»' || $arResult["NAME"] == 'PERCo-WM-04 Интеграция с внешними системами' || $arResult["NAME"] == 'PERCo-WBE «Базовый пакет встроенного ПО»')
	$free = '<p class="free">БЕСПЛАТНО</p>';
if ($arResult["PROPERTIES"]["DOP_NAME"]["VALUE"])
	$product_name .= " " . $arResult["PROPERTIES"]["DOP_NAME"]["VALUE"];
$product_name .= '</h1>'.$price_result.''.$free.'</div>';
$other = '';
if ($arResult['IBLOCK_SECTION_ID'] == 2357) {
	ob_start();
	?><div class="turnikets-video" id="video"><?
	$iblocks2 = GetIBlockList("video", "video_files");
	if($arIBlock = $iblocks2->Fetch())
		$block_id2 = $arIBlock["ID"];
		$autoplay = 0;
	$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video_youtube", array(
		"IBLOCK_ID" => $block_id2,
		"ELEMENT_ID" => "26956",
		"AUTOSTART" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		),
		false
	);
	?></div><?
	$other = ob_get_contents();
	ob_end_clean();
}
?>
	<div id="content" itemscope itemtype="http://schema.org/Product">
		<div id="first_info">
			<div id="main_image">
<?
if ($device=="mobile")
	echo $product_name;
?>
				<?=$main_image;?>
			</div>
			<div id="product_info">
<?
if ($device!="mobile")
	echo $product_name;
?>
				<?=$pictogram;?>
				<?=$shema_video;?>
				<?=$review;?>
			</div>
		</div>
		<div>
			<?=$content;?>
			<?=$other;?>
		</div>
		<span itemprop="brand" itemtype="https://schema.org/Organization" itemscope><meta itemprop="name" content="PERCo"/></span>
	</div>
<?
if ($arResult["PROPERTIES"]["SCROLL"]["VALUE"])
{
	if ($device!="desktop")
		echo '<style type="text/css">body #main_block { flex-direction: column; }#horizontal_scroll { margin: 20px 0 0 0 !important; }</style>';
?>
	<div <?echo ($device=="desktop") ? 'id="scroll"' : 'id="horizontal_scroll" style="order: 1;"';?>>
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