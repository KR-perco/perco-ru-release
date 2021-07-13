<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
 
global $APPLICATION;
switch(LANGUAGE_ID)
{
	case "ru":
		$iblock_code = "products";
		break;
	case "en":
		$iblock_code = "products_com";
		break;
	case "de":
		$iblock_code = "produkte";
		break;
	case "fr":
		$iblock_code = "produits";
		break;
	case "it":
		$iblock_code = "prodotti";
		break;
	case "es":
		$iblock_code = "productos";
		break;
}
$iblocks = GetIBlockList("structure", $iblock_code);
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"perco:menu.sections.elements",
	"",
	Array(
	"IS_SEF" => "N",
	"IBLOCK_TYPE" => "structure", // Введите сюда символьный код или ИД типа ИБ, в котором лежит инфоблок каталога
	"IBLOCK_ID" => $block_id, // Укажите тут реальный ID инфоблока, с которым вы связываете меню, то бишь, каталога
	"SECTION_URL" => "/products/#SECTION_CODE#/", //Обратите внимание на то, что если у вас чпу направлены на код, то ставьте SECTION_CODE
	"DEPTH_LEVEL" => "1", // Сколько надо уровней меню, такую цифру и пишите
	"CACHE_TYPE" => "N", // Кэш. Надо или не надо? Думайте сами, решайте сами!
	"CACHE_TIME" => "36000000" // Сколько секунд будет жить кэш. В данном случае немногим меньше, чем полтора года
	),
	false
);
if (LANGUAGE_ID == "ru")
{
	$aMenuLinksExt[] = array(
		"Прайс-лист", 
		"/products/prays-list.php", 
		Array(), 
		Array(),
	);
	$aMenuLinksExt[] = array(
		"Видео", 
		"/products/video/", 
		Array(), 
		Array(),
	);
	$aMenuLinksExt[] = array(
		"Каталоги и буклеты", 
		"/podderzhka/katalogi-i-buklety.php", 
		Array(), 
		Array(),
	);
}
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);

/*
#добавление пункта шлагбаума
if (LANGUAGE_ID == "ru") {
	foreach($aMenuLinks as $i => $item) {
		if ($item[0] == 'Шлагбаум GS04') {
			array_splice($aMenuLinks, $i, 1);
		}
	}
	
	$aMenuLinksPrev = $aMenuLinks;
	$ii = 0;
	foreach($aMenuLinks as $i => $item) {
		$aMenuLinks[$ii] = $aMenuLinksPrev[$i];
		if ($i == 1) {
			$ii++;
			$aMenuLinks[$ii] = [
				"Шлагбаум", 
				"/products/shlagbaum-gs04.php", 
				Array(), 
				Array(),
			];
		}
		$ii++;
	}
}

if (LANGUAGE_ID == "en") {
	foreach($aMenuLinks as $i => $item) {
		if ($item[0] == 'GS04 Boom barrier') {
			array_splice($aMenuLinks, $i, 1);
		}
	}
	
	$aMenuLinksPrev = $aMenuLinks;
	$ii = 0;
	foreach($aMenuLinks as $i => $item) {
		$aMenuLinks[$ii] = $aMenuLinksPrev[$i];
		if ($i == 1) {
			$ii++;
			$aMenuLinks[$ii] = [
				"Boom barrier", 
				"/products/gs04-boom-barrier.php", 
				Array(), 
				Array(),
			];
		}
		$ii++;
	}
}

if (LANGUAGE_ID == "fr") {
	foreach($aMenuLinks as $i => $item) {
		if ($item[0] == 'Barrière levante GS04') {
			array_splice($aMenuLinks, $i, 1);
		}
	}
	
	$aMenuLinksPrev = $aMenuLinks;
	$ii = 0;
	foreach($aMenuLinks as $i => $item) {
		$aMenuLinks[$ii] = $aMenuLinksPrev[$i];
		if ($i == 1) {
			$ii++;
			$aMenuLinks[$ii] = [
				"Barrière levante", 
				"/produits/barri-re-levante-gs04.php", 
				Array(), 
				Array(),
			];
		}
		$ii++;
	}
}

if (LANGUAGE_ID == "it") {
	foreach($aMenuLinks as $i => $item) {
		if ($item[0] == 'GS04 Sbarra del passaggio a livello') {
			array_splice($aMenuLinks, $i, 1);
		}
	}
	
	$aMenuLinksPrev = $aMenuLinks;
	$ii = 0;
	foreach($aMenuLinks as $i => $item) {
		$aMenuLinks[$ii] = $aMenuLinksPrev[$i];
		if ($i == 1) {
			$ii++;
			$aMenuLinks[$ii] = [
				"Sbarra del passaggio a livello", 
				"/prodotti/gs04-sbarra-del-passaggio-a-livello.php", 
				Array(), 
				Array(),
			];
		}
		$ii++;
	}
}

if (LANGUAGE_ID == "es") {
	foreach($aMenuLinks as $i => $item) {
		if ($item[0] == 'Barrera vehicular GS04') {
			array_splice($aMenuLinks, $i, 1);
		}
	}
	
	$aMenuLinksPrev = $aMenuLinks;
	$ii = 0;
	foreach($aMenuLinks as $i => $item) {
		$aMenuLinks[$ii] = $aMenuLinksPrev[$i];
		if ($i == 1) {
			$ii++;
			$aMenuLinks[$ii] = [
				"Barrera vehicular", 
				"/productos/barrera-vehicular-gs04.php", 
				Array(), 
				Array(),
			];
		}
		$ii++;
	}
}*/
?> 