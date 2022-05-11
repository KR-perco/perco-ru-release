<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$arFilter = Array("IBLOCK_CODE"=>"pages_".LANGUAGE_ID, "ACTIVE"=>"Y", "CODE" => $arResult["SECTION"]["CODE"]);
$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_BANNER");
$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
$ar_props = $res->Fetch();
if ($ar_props["PROPERTY_BANNER_VALUE"])
	echo '<div class="width_all">
			<div class="banner_image" style="background-image: url('.$ar_props["PROPERTY_BANNER_VALUE"].');"></div>
		</div>';
?>

<div id="main_block">
	<div id="content">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
<?
 
function getPriceRubFromEuro($priceEuro) {
	if ($priceEuro >= 10)
		$drob = 0;
	else
		$drob = 2;
	$price_res = getCurrency(CURRENCY_SWITCH);
	$price = $price_res * $priceEuro;
	$priceRub = number_format($price, $drob, ",", " ");

	return $priceRub;
}

//GetRate();
function getPriceProduct($iblockID, $elementID, $imgSrc = "")
{
	global $APPLICATION;
	//global $price_res;
	$price_res = getCurrency(CURRENCY_SWITCH);
	$priceText = "";
	$price_text = "";
	$rsPrice = CIBlockElement::GetProperty($iblockID, $elementID, array("sort" => "asc"), Array("CODE"=>"SPECIFICATIONS"));
	$arPrice = $rsPrice->Fetch();
	if (intval($rsPrice->SelectedRowsCount()) > 0 && $arPrice["VALUE"])
	{
		$arFilter = Array("IBLOCK_CODE"=>"product_info", "ID" => $arPrice["VALUE"]);
		$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_PRICE");
		$resPrice = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
		$obPrice = $resPrice->GetNextElement();
		$arFieldsPrice = $obPrice->GetFields();
		$arPropsPrice = $obPrice->GetProperties();
		if ($arPropsPrice["PRICE"]["VALUE"])
		{
			$price = $price_res * $arPropsPrice["PRICE"]["VALUE"];
			if ($arPropsPrice["PRICE"]["VALUE"] >= 10)
				$drob = 0;
			else
				$drob = 2;
			if ($price != 0)
			{
				if (stripos($imgSrc, "/po/") === false)
					$price_text = "со склада в Москве и Санкт-Петербурге";
				//<p style="">'.$arFieldsPrice["NAME"].'. Цена <span class="price_rub">'.number_format($price, 0, ",", " ").' &#8381;</span> '.$price_text.'</p>
				$priceText = '<div class="price">
						<p style="">Цена <span class="price_rub">'.number_format($price, 0, ",", " ").' &#8381;</span> '.$price_text.'</p>
						<p class="price_eur">'.number_format($arPropsPrice["PRICE"]["VALUE"], $drob, ".", " ").' € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>';
				if ($arPropsPrice["PRICE"]["DESCRIPTION"])
					$priceText .= "<p>".$arPropsPrice["PRICE"]["DESCRIPTION"]."</p>";
				$priceText .= '</div>';
			}

		}
	}
	return $priceText;
}
if (count($arResult["SECTIONS"]) > 0)
{
	echo '<div id="secel_list">';
	if ($arResult["SECTION"]["CODE"] != "po-sistemy-kontrolya-dostupa-perco-web") {
		foreach($arResult["SECTIONS"] as $section)
		{
			$rsSection = CIBlockElement::GetList(
				array(),
				array(
				"IBLOCK_CODE" => "pages_".LANGUAGE_ID,
				"ACTIVE" => "Y",
				"CODE" => $section["CODE"]
				),
				false,
				false,
				array("IBLOCK_ID", "ID", "PROPERTY_IMAGE")
			);
			$arSection = $rsSection->Fetch();
			?>
			<div class="secel_item secel_item_1">
				<a href="<?=str_ireplace("_com", "", $section["SECTION_PAGE_URL"]);?>">
					<div class="image_icon">
						<img alt="<?=$section["NAME"];?>" src="<?=$arSection["PROPERTY_IMAGE_VALUE"];?>" />
					</div>
					<div class="text_item"><span><?=$section["NAME"];?></span>
					<?
					if (LANGUAGE_ID == "ru") echo getPriceProduct($arSection["IBLOCK_ID"], $arSection["ID"]);
					// echo '<!--<pre>';
					// print_r($arSection["IBLOCK_ID"]);
					// echo '</pre>';
					// echo '<pre>';
					// print_r($arSection["ID"]);
					// echo '</pre>-->';
					/*if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 24177) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(0.39).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p>0.39 € <span class="po_cb">(по курсу ЦБ РФ на 22.10.2019)</span></p>
						<p>Бесконтактная карта доступа EM-Marin</p>
						<!--<p>Рабочая частота: 125 КГц</p>-->
					</div>';
					}
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 24176) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(37).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p>37 € <span class="po_cb">(по курсу ЦБ РФ на 22.10.2019)</span></p>
						<p>К-Инженеринг БИРП 12-2,5/7</p>
					</div>';
					}*/
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 24177) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(0.18).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p class="price_eur">0.18 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>
						<p>Бесконтактная карта доступа EM-Marin</p>
						<!--<p>Рабочая частота: 125 КГц</p>-->
					</div>';
					}//22.10.2019
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 24176) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(34).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p class="price_eur">34 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>
						<p>К-Инженеринг БИРП 12-2,5/7</p>
					</div>';
					}//22.10.2019
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 27022) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(761).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p class="price_eur">761 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>
						<p>ZKTeco FaceDepot-7B</p>
					</div>';
					}
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 28202) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(5).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p class="price_eur">5 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>
						<p>Дверные ручки</p>
					</div>';
					}
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 28203) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(0.7).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p class="price_eur">0.7 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>
						<p>Анкер FWB 6 Fisher (с винтом M 6 x 40 DIN 965 (цинк, потай)</p>
					</div>';
					}
					if ($arSection["IBLOCK_ID"] == 64 && $arSection["ID"] == 28755) {
						echo '<div class="price">
						<p>Цена <span class="price_rub">'.getPriceRubFromEuro(128).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
						<p class="price_eur">128 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</span></p>
						<p>Стойка BSP2</p>
					</div>';
					}
					?>

					</div>
				</a>
			</div>
			<?
		} 
	}
	if ($arParams['SECTION_CODE'] == 'turnikety') {?>
		<div class="secel_item secel_item_t1">
			<a href="/products/kronshteyny/">
				<div class="image_icon">
					<img alt="Кронштейны" src="/images/products/kronshteiny/all.jpg" />
				</div>
				<div class="text_item"><span>Кронштейны</span>
				<?
				echo '<div class="price">
					<p>Цена <span class="price_rub">'.getPriceRubFromEuro(128).' ₽</span> со склада в Москве и Санкт-Петербурге</p>
					<p>128 € <span class="po_cb">(по курсу ЦБ РФ на '.date("d.m.y").')</p>
					<p>Стойка BSP2</p>
				</div>';
				?>
				</div>
			</a>
		</div>
	<?}
	if (count($arResult["ELEMENTS"]) > 0)
	{
		foreach($arResult["ELEMENTS"] as $element)
		{
			$rsImage = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
			$arImage = $rsImage->Fetch();
			$rsDopname = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"DOP_NAME"));
			$arDopname = $rsDopname->Fetch();
			$dopname = "";
			$new_product = "";
			if ($element["DATE_ACTIVE_FROM"])
			{
				$dateActive = new DateTime(date("Y-m-d", strtotime($element["DATE_ACTIVE_FROM"])));
				$today = new DateTime(date("Y-m-d"));
				$interval = $dateActive->diff($today);
				if ($interval->format("%a") < 92)
					$new_product = '<div class="new_product">'.GetMessage("NEW").'</div>';
				if ($dateActive > $today)
					continue;
			}
			if ($arDopname["VALUE"])
				$dopname = '<p class="dop_name">'.$arDopname["VALUE"].'</p>'; 
				
				$free = ''; 
				if ($element["NAME"] == "PERCo-WB «Базовый пакет ПО»" || $element["NAME"] == "PERCo-WM-04 Интеграция с внешними системами" || $element["NAME"] == "PERCo-WBE «Базовый пакет встроенного ПО»"){
					$free = '<p class="free">БЕСПЛАТНО</p>';
				}
	?>
		<div class="secel_item secel_item_2">
			<a href="<?=str_ireplace("_com", "", $element["DETAIL_PAGE_URL"]);?>">
				<div class="image_icon">
					<img alt="<?=$element["NAME"];?>" src="<?=$arImage["VALUE"];?>" />
					<?=$new_product;?>
				</div>
				<div class="text_item"><span><?=$element["NAME"];?></span><?=$dopname;?><?=$free;?><?if (LANGUAGE_ID == "ru") echo getPriceProduct($element["IBLOCK_ID"], $element["ID"], $arImage["VALUE"]);?></div>
			</a>
		</div>
	<?
		}
	}
	
	echo "</div>";
	
	if ($arResult["SECTION"]["CODE"] == "po-sistemy-kontrolya-dostupa-perco-web") { ?>
		
		<?
		foreach($arResult["SECTIONS"] as $section)
		{?>
			<h2><?=$arResult["SECTIONS"][0]["NAME"]?></h2> 
			<div id='secel_list'> 
			<?
			$arFilter = Array("SECTION_ID"=>$arResult["SECTIONS"][0]["ID"], "ACTIVE"=>"Y");
			$arSelect = Array("DETAIL_PAGE_URL","NAME", "IMAGE_PREVIEW", "IBLOCK_ID", "ID");
			$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, Array(), $arSelect); 
			while($ob = $res->GetNextElement())
			{
				$arFields = $ob->GetFields(); 
			
				$new_product = "";
				if ($arFields["DATE_ACTIVE_FROM"])
				{
					$dateActive = new DateTime(date("Y-m-d", strtotime($arFields["DATE_ACTIVE_FROM"])));
					$today = new DateTime(date("Y-m-d"));
					$interval = $dateActive->diff($today);
					if ($interval->format("%a") < 92)
						$new_product = '<div class="new_product">'.GetMessage("NEW").'</div>';
					if ($dateActive > $today)
						continue;
				}

				$rsImage = CIBlockElement::GetProperty($arFields["IBLOCK_ID"], $arFields["ID"], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
				$arImage = $rsImage->Fetch(); 

				$free = ''; 
				if ($arFields["NAME"] == "PERCo-WB «Базовый пакет ПО»" || $arFields["NAME"] == "PERCo-WM-04 Интеграция с внешними системами" || $arFields["NAME"] == "PERCo-WBE «Базовый пакет встроенного ПО»"){
					$free = '<p class="free">БЕСПЛАТНО</p>';
				}

				// console_log($arFields["ID"]); 
				// $res = CIBlockElement::GetByID(24546);
				// if($ar_res = $res->GetNext())
				// 	console_log($ar_res);
				?> 
				<div class="secel_item secel_item_5">
					<a href="<?=str_ireplace("_com", "", $arFields["DETAIL_PAGE_URL"]);?>">
						<div class="image_icon">
							<img alt="<?=$arFields["NAME"];?>" src="<?=$arImage["VALUE"];?>" />
							<?=$new_product;?>
						</div>
						<div class="text_item"><span><?=$arFields["NAME"];?></span><?=$dopname;?><?=$free;?><?if (LANGUAGE_ID == "ru") echo getPriceProduct($arFields["IBLOCK_ID"], $arFields["ID"], $arImage["VALUE"]);?></div>
					</a>
				</div> 
				<?
			} 
			?>
			</div>
			<?
		} 
	}
}
else
{
	echo '<div id="secel_list">';  
	if ($arResult["SECTION"]["CODE"] != "karty-dostupa") {
		foreach($arResult["ELEMENTS"] as $element)
		{
			$rsImage = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
			$arImage = $rsImage->Fetch();
			$rsDopname = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"DOP_NAME"));
			$arDopname = $rsDopname->Fetch();
			$dopname = "";
			$new_product = "";
			if ($element["DATE_ACTIVE_FROM"])
			{
				$dateActive = new DateTime(date("Y-m-d", strtotime($element["DATE_ACTIVE_FROM"])));
				$today = new DateTime(date("Y-m-d"));
				$interval = $dateActive->diff($today);
				if ($interval->format("%a") < 92)
					$new_product = '<div class="new_product">'.GetMessage("NEW").'</div>';
				if ($dateActive > $today)
					continue;
			}
			if ($arDopname["VALUE"])
				$dopname = '<p class="dop_name">'.$arDopname["VALUE"].'</p>';
			$free = '';
			if ($element["NAME"] == "PERCo-WB «Базовый пакет ПО»" || $element["NAME"] == "PERCo-WM-04 Интеграция с внешними системами" || $element["NAME"] == "PERCo-WBE «Базовый пакет встроенного ПО»"){
				$free = '<p class="free">БЕСПЛАТНО</p>';
			}
	?>
		<div class="secel_item secel_item_3">
			<a href="<?=str_ireplace("_com", "", $element["DETAIL_PAGE_URL"]);?>">
				<div class="image_icon">
					<img alt="<?=$element["NAME"];?>" src="<?=$arImage["VALUE"];?>" />
					<?=$new_product;?>
				</div>
				<div class="text_item"><span><?=$element["NAME"];?></span><?=$dopname;?><?=$free;?><?if (LANGUAGE_ID == "ru") echo getPriceProduct($element["IBLOCK_ID"], $element["ID"], $arImage["VALUE"]);?></div>
			</a>
		</div>
	<?
		}
	} else { // если $arResult["SECTION"]["CODE"] == "karty-dostupa"
		// вывод только для секции "Карты доступа"/"Карты. Брелоки. Метки."
		foreach($arResult["ELEMENTS"] as $element)
		{
			$rsImage = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"IMAGE_PREVIEW"));
			$arImage = $rsImage->Fetch();
			
			$rsDopname = CIBlockElement::GetProperty($element["IBLOCK_ID"], $element["ID"], array("sort" => "asc"), Array("CODE"=>"DOP_NAME"));
			$arDopname = $rsDopname->Fetch();
			$dopname = "";
			
			if ($arDopname["VALUE"])
				$dopname = '<p class="dop_name">'.$arDopname["VALUE"].'</p>'; 
	?>
		<div class="secel_item secel_item_4">
			<div><!-- // некликабельные элементы  -->
				<div class="image_icon">
					<img alt="<?=$element["NAME"];?>" src="<?=$arImage["VALUE"];?>" /> 
				</div>
				<div class="text_item">
					<span>
						<?=$element["NAME"];?>
					</span>
					<?if (LANGUAGE_ID == "ru") echo getPriceProduct($element["IBLOCK_ID"], $element["ID"], $arImage["VALUE"]);?>
					<div class="price"><?=$dopname;?></div> <!-- // только здесь так выводим вторую допстрочку  -->
				</div>
				
		</div>
		</div>
	<?
		}
	}
	// console_log($arParams['SECTION_CODE']);
	
	// if ($arParams['SECTION_CODE'] == 'po-sistemy-kontrolya-dostupa-perco-web') {
		?>  
	<?
	// }  
	if ($arParams['SECTION_CODE'] == 'biometricheskie-kontrollery-i-schityvateli') {?> 
		<div class="secel_item secel_item_b3">
			<a href="/products/terminaly-raspoznavaniya-lits/">
				<div class="image_icon">
					<img alt="Терминалы распознавания лиц" src="/images/products/terminaly-raspoznavaniya-lits/v-page.jpg">
								</div>
				<div class="text_item"><span>Терминалы распознавания лиц</span></div>
			</a>
		</div> 
	<?}
	echo "</div>";
	
}
?>