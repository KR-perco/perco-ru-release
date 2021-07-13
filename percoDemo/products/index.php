<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$page = $APPLICATION->GetCurUri();
?>
<script>
	app.setPageTitle({
         title: "Производитель оборудования безопасности"
      });
</script>
<script>
	/*$.getJSON('../offline/data_catalog.json', (json) => {
		console.log(json);
	});*/
</script>
<?php
//данный код выгружает весь каталог товаров в json в переменную dataCatalog в localStorage
//эта json выгрузка используется в offline файле catalog-section.html для формирования товаров в разделе
$charsCache = [];

function setAdditional ($sections) { //добавляем дополнительные разделы вручную
	$addCat = include('additional-catalog.php');
	$sections['koren-dopolnitelnoe-oborudovanie'] = $addCat['koren-dopolnitelnoe-oborudovanie'];
	return $sections;
}

function getImgLink ($link) { //трансформируем ссылку на изображение для офлайн файла
	$matches = [];
	preg_match('/\/[^\/]*\.(webp|png|jpg|svg)$/', $link, $matches);
	$link = preg_replace('/\//', '', $matches[0]);
	$link = preg_replace('/\.webp$/', '.png', $link);
	$link = preg_replace('/\.jpg$/', '.png', $link);
	$link = preg_replace('/\.svg$/', '.png', $link);
	$link = preg_replace('/_full/', '', $link);
	return $link;
}

function getDocLink ($link) { //трансформируем ссылку на документ для офлайн файла
	$matches = [];
	if (!preg_match('/\/[^\/]*\.(zip|rar|pdf|dwg)$/', $link, $matches)) {
		return false;
	}
	$link = preg_replace('/\//', '', $matches[0]);
	return $link;
}

function getImgsLinksByIds ($ids) { //получаем ссылки картинок из инфоблоков по их id
	$links = [];
	foreach ($ids as $id) {
		$id = trim($id);
		if (preg_match('/\//', $id) == 0) {
			$dbElement = CIBlockElement::GetByID($id);
			if($element = $dbElement->GetNextElement()) {
				$arFields = $element->GetFields();
				$arProp = $element->GetProperty('FULL');
				//загружает изображение по ссылке и конвертирует в png в mime type на лету
				/*$ch = curl_init();
				curl_setopt($ch, CURLOPT_POST, 0);
				curl_setopt($ch, CURLOPT_URL, 'https://perco.ru'.$arProp['VALUE']);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$respond = curl_exec($ch);
				curl_close($ch);
				$binary = imagecreatefromstring($respond);
				ob_start();
				imagepng($binary);
				$png = ob_get_clean();
				$pngBase64 = 'data:image\/png;base64,' . base64_encode($png);
				var_dump('https://perco.ru'.$arProp['VALUE'].'<br>');
				$links[]['PREVIEW'] = $pngBase64;
				continue;
				}*/
				//конец загрузки изображения
				if (count($ids) != 1) {
					$links[]['PREVIEW'] = getImgLink($arProp['VALUE']);
				} else {
					$links = getImgLink($arProp['VALUE']);
				}
			}
		} else {
			if (count($ids) != 1) {
				$links[]['PREVIEW'] = getImgLink($id);
			} else {
				$links = getImgLink($id);
			}
		}
	}
	return $links;
}

function getValueByLanguage ($language, $arValues, $arLanguages) { //получаем значение для соответсвующего языка
	$i = array_search($language, $arLanguages);
	if ($i === false) {
		return false;
	}
	return $arValues[$i];
}

function getDownload ($sectionId) { //получаем файлы для скачивания
	$files = [];
	$dbElements = CIBlockElement::GetList(
		[
			'LEFT_MARGIN' => 'ASC'
		],
		[
			'IBLOCK_ID' => 21,
			'SECTION_ID' => $sectionId,
			'ACTIVE' => 'Y',
			'GLOBAL_ACTIVE' => 'Y'
		],
		false,
		false,
		[
			'ID',
			'IBLOCK_ID',
			'CODE',
			'NAME',
			"PROPERTY_*"
		]
	);
	while($arElement = $dbElements->GetNextElement()) {
		$arFields = $arElement->GetFields();
		$arProps = $arElement->GetProperties();
		$value = getValueByLanguage('ru', $arProps['FILE']['VALUE'], $arProps['FILE']['DESCRIPTION']);
		$name = getValueByLanguage('ru', $arProps['NAME']['VALUE'], $arProps['NAME']['DESCRIPTION']);
		$value = getDocLink($value);
		if ($value === false || $name === false) {
			continue;
		}
		$files[] = [
			'VALUE' => $value,
			'NAME' => $name
		];
	}
	return $files;
}

function getChars ($ids) { //получаем характеристики товара
	global $charsCache;
	$chars = [];
	foreach ($ids as $id) {
		$id = trim($id);
		if (!empty($charsCache[$id])) {
			$chars[] = $charsCache[$id];
			continue;
		}
		$dbElement = CIBlockElement::GetByID($id);
		if($element = $dbElement->GetNextElement()) {
			$arProps = $element->GetProperties();
			$val = [
				'VALUE' => $arProps['ru']['VALUE'],
				'DESCRIPTION' => $arProps['ru']['DESCRIPTION']
			];
			$chars[] = $val;
			$charsCache[$id] = $val;
		}
	}
	return $chars;
}

function getSpecifications ($id) { //получаем спецификации товара
	$specifications = [];
	$id = trim($id);
	$dbElement = CIBlockElement::GetByID($id);
	if($element = $dbElement->GetNextElement()) {
		$arProps = $element->GetProperties();
		$specifications['SHEMA'] = getImgLink($arProps['SHEMA']['VALUE']);
		$specifications['PRICE'] = $arProps['PRICE']['VALUE'];
		$specifications['DOWNLOAD'] = getDownload($arProps['DOWNLOADS']['VALUE']);
		$specifications['CHARACTERISTICS'] = getChars($arProps['SPECIFICATIONS']['VALUE']);
	}
	return $specifications;
}

function getJsonCatalog ($sections) { //преобразуем каталог в json
	foreach ($sections as $secId => $sec) {
		$sections[$sec['CODE']] = $sec;
		unset($sections[$sec['CODE']]['CODE']);
		unset($sections[$secId]);
		foreach ($sec['CHILDREN'] as $idChild => $child) {
			$sections[$sec['CODE']][$child['CODE']] = $child;
			$sections[$sec['CODE']][$child['CODE']]['ID'] = $idChild;
			foreach ($child['ELEMENTS'] as $idElem => $elem) {
				$sections[$sec['CODE']][$child['CODE']]['ELEMENTS'][$elem['CODE']] = $elem;
				$sections[$sec['CODE']][$child['CODE']]['ELEMENTS'][$elem['CODE']]['ID'] = $idElem;
				unset($sections[$sec['CODE']][$child['CODE']]['ELEMENTS'][$idElem]);
			}
		}
		foreach ($sec['ELEMENTS'] as $idElem => $elem) {
			$sections[$sec['CODE']][$elem['CODE']] = $elem;
			$sections[$sec['CODE']][$elem['CODE']]['ID'] = $idElem;
		}
		unset($sections[$sec['CODE']]['CHILDREN']);
		unset($sections[$sec['CODE']]['ELEMENTS']);
	}
	$sections = setAdditional($sections);
	return json_encode($sections, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}

function getElementsOfSection ($sectionId) { //получаем элементы по id раздела
	$elements = [];
	$dbElements = CIBlockElement::GetList(
		[
			//'LEFT_MARGIN' => 'ASC'
			'SORT' => 'ASC'
		],
		[
			'IBLOCK_ID' => 60,
			'SECTION_ID' => $sectionId,
			'ACTIVE' => 'Y',
			'GLOBAL_ACTIVE' => 'Y'
		],
		false,
		false,
		[
			'ID',
			'IBLOCK_ID',
			'CODE',
			'NAME',
			'PREVIEW_TEXT',
			'DETAIL_TEXT',
			"PROPERTY_*"
		]
	);
	while($arElement = $dbElements->GetNextElement()) {
		$arFields = $arElement->GetFields();
		$arProps = $arElement->GetProperties();
		$elements[$arFields['ID']]['NAME'] = $arFields['NAME'];
		$elements[$arFields['ID']]['CODE'] = $arFields['CODE'];
		$elements[$arFields['ID']]['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'];
		$elements[$arFields['ID']]['DETAIL_TEXT'] = $arFields['DETAIL_TEXT'];
		$elements[$arFields['ID']]['DOP_NAME'] = $arProps['DOP_NAME']['VALUE'];
		$elements[$arFields['ID']]['IMAGE_PREVIEW'] = getImgLink($arProps['IMAGE_PREVIEW']['VALUE']);
		$elements[$arFields['ID']]['PROPERTY_IMAGE_VALUE'] = getImgsLinksByIds($arProps['IMAGE']['VALUE']);
		$elements[$arFields['ID']]['SPECIFICATIONS'] = getSpecifications($arProps['SPECIFICATIONS']['VALUE']);
		$elements[$arFields['ID']]['PROPERTY_TEXT_VALUE'] = $arProps['TEXT']['VALUE'];
		$elements[$arFields['ID']]['PROPERTY_TEXT_DESCRIPTION'] = $arProps['TEXT']['DESCRIPTION'];
	}
	return $elements;
}

$sections = []; //весь каталог
$dbSections = CIBlockSection::GetList( //выбираем все разделы из каталога
	[
		'LEFT_MARGIN' => 'ASC'
	],
	[
		'IBLOCK_ID' => 60,
		'ACTIVE' => 'Y',
		'GLOBAL_ACTIVE' => 'Y'
	],
	false,
	[
		'ID',
		'IBLOCK_SECTION_ID',
		'CODE',
		'NAME'
	]
);
while ($arSection = $dbSections->GetNext()) {
	if ($arSection['IBLOCK_SECTION_ID'] == null) {
		$sections[$arSection['ID']]['CODE'] = $arSection['CODE'];
		$sections[$arSection['ID']]['ELEMENTS'] = getElementsOfSection((int) $arSection['ID']);
	} else {
		$sections[$arSection['IBLOCK_SECTION_ID']]['CHILDREN'][$arSection['ID']]['IBLOCK_SECTION_ID'] = $arSection['IBLOCK_SECTION_ID'];
		$sections[$arSection['IBLOCK_SECTION_ID']]['CHILDREN'][$arSection['ID']]['NAME'] = $arSection['NAME'];
		$sections[$arSection['IBLOCK_SECTION_ID']]['CHILDREN'][$arSection['ID']]['CODE'] = $arSection['CODE'];
		$sections[$arSection['IBLOCK_SECTION_ID']]['CHILDREN'][$arSection['ID']]['ELEMENTS'] = getElementsOfSection((int) $arSection['ID']);
	}
}
$charsCache = [];
//$sections = str_replace('\\', '\\\\', getJsonCatalog($sections));
//дамп до преобразования в json
?><pre style=""><?var_dump($sections);?></pre><?
?>
<script>
	//localStorage.removeItem('dataCatalog');
	//localStorage.setItem('dataCatalog', `<?= str_replace('\\', '\\\\', getJsonCatalog($sections)); ?>`);
</script>
<? //конец выгрузки ?>
<div>
<?
$managerBlock = '<div class="workers-block">
                  <a style="display: none;" href="solution/">
                    <div class="">
                      <img src="bxlocal://section-reshenia.png" alt="solution">
                      <p>Решения</p>
                    </div>
                  </a>
                  <a href="/percoDemo/offline/gallery.html">
                    <div class="">
                      <img src="bxlocal://section-galery.png" alt="photogallery">
                      <p>Фотогалерея</p>
                    </div>
                  </a>
                  <a href="/percoDemo/offline/booklets.html">
                    <div class="">
                      <img src="bxlocal://section-booklets.png" alt="booklets">
                      <p>Каталоги и буклеты</p>
                    </div>
                  </a>
                  <a href="/percoDemo/video/?worker=manager">
                    <div class="">
                      <img src="bxlocal://section-video.png" alt="video">
                      <p>Видео</p>
                    </div>
                  </a>		
                </div>';

$installerBlock = '<div class="workers-block">
                <a href="/percoDemo/new/">
                  <div class="">
                    <img src="bxlocal://section-new.png" alt="new" />
                    <p>Новое</p>
                  </div>
                </a>
                <a href="/percoDemo/video/?worker=installer">
                  <div class="">
                    <img src="bxlocal://section-video.png" alt="video" />
                    <p>Видео</p>
                  </div>
                </a>
                <a href="/percoDemo/offline/faq.html">
                  <div class="">
                    <img src="bxlocal://section-faq.png" alt="faq" />
                    <p>FAQ</p>
                  </div>
                </a>
                <a href="/percoDemo/documentation/">
                  <div class="">
                    <img src="bxlocal://section-documentation.png" alt="documentation" />
                    <p>Документация</p>
                  </div>
                </a>			
              </div>';

$url = parse_url($page);

switch ($url["query"]){
  case "manager":
    echo $managerBlock;
    break;

  case "installer":
    echo $installerBlock;
    break;
}

?>
  <div class="catalog">
    <h2>Каталог</h2>
<?
$iblock_code = "products";
$iblocks = GetIBlockList("structure", $iblock_code);
if($arIBlock = $iblocks->Fetch())
  $block_id = $arIBlock["ID"];
$current_group = "";
$count = 0;
$group_first = true;
$arSort = Array("UF_GROUP_PRODUCTS"=>"asc", "sort"=>"asc");

$arFilter = Array("IBLOCK_ID"=>$block_id, "GLOBAL_ACTIVE"=>"Y", "<=DEPTH_LEVEL"=>1);
$rsSections = CIBlockSection::GetList($arSort, $arFilter, false, array("UF_GROUP_PRODUCTS"));
while($arSection = $rsSections->GetNext())
{
  $count++;
  if ($current_group != $arSection["UF_GROUP_PRODUCTS"])
  {
    $group_first = true;
    $current_group = $arSection["UF_GROUP_PRODUCTS"];
  }

  $img = substr($arSection["DESCRIPTION"], 14, -3);
?>
    <div class="item">
      <a href="/percoDemo/products/<?=$arSection["CODE"];?>/?<?=$url["query"]?>">
        <?if ($img != 'dop-oborudovanie.'):?><img alt="<?=$arSection["NAME"];?>" src="bxlocal://catalog-<?=$img?>png" /><?else:?><img alt="<?=$arSection["NAME"];?>" src="/percoDemo/img/catalog-dop-oborudovanie.png" /><?endif;?>
        <p class="item_name"><?echo ($arSection["NAME"] == "Турникеты") ? $arSection["NAME"].", калитки, ограждения" : $arSection["NAME"];?></p>
      </a>
    </div>
<?
  if ($count == intval($rsSections->SelectedRowsCount()))
    echo "</div>";
}
?>  
  </div>

</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?> 