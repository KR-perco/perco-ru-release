<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

\Bitrix\Main\Loader::includeModule('iblock');

$cItems = [];

$component = $this->__component;

$component->setResultCacheKeys(array("CITEMS"));

switch (LANGUAGE_ID) {
case 'ru':
	$GLOBALS['iblockIdSolutions'] = 69;
	$GLOBALS['pathSolutions'] = '/resheniya/';
	break;
case 'en':
	$GLOBALS['iblockIdSolutions'] = 91;
	$GLOBALS['pathSolutions'] = '/solutions/';
	break;
case 'fr':
	$GLOBALS['iblockIdSolutions'] = 95;
	$GLOBALS['pathSolutions'] = '/solutions/';
	break;
case 'es':
	$GLOBALS['iblockIdSolutions'] = 92;
	$GLOBALS['pathSolutions'] = '/soluciones/';
	break;
}

function addElemOfSection($sort, $elemId, $data)
{
	$GLOBALS['CITEMS'][$data[1][$data[0]]['NAME']][$data[2][$elemId]['NAME']]['ICON_SRC'] = $data[2][$elemId]['ICON_SRC'];
	$GLOBALS['CITEMS'][$data[1][$data[0]]['NAME']][$data[2][$elemId]['NAME']]['URL'] = $data[2][$elemId]['URL'];
}

function addElemsOfSection($sort, $sectId, $sections)
{
	$res = \Bitrix\Iblock\ElementTable::getList([
		'filter' => [
			'IBLOCK_ID' => $GLOBALS['iblockIdSolutions'],
			'IBLOCK_SECTION_ID' => $sectId,
		],
		'select' => [
			'ID', 'NAME', 'CODE', 'iblock_id', 'SORT'
		],
	]);
	$elemSorts = [];
	$elems = [];
	while ($elem = $res->Fetch()) {
		$elems[$elem['ID']]['NAME'] = $elem['NAME'];
		$elems[$elem['ID']]['URL'] = $GLOBALS['pathSolutions'].$elem['CODE'].'/';
		$elemSorts[$elem['ID']] = $elem['SORT'];
		$db_props = CIBlockElement::GetProperty($GLOBALS['iblockIdSolutions'], $elem['ID'], ["sort" => "asc"], Array("CODE"=>"IMAGE"));
		if($ar_props = $db_props->Fetch()) {
			$elems[$elem['ID']]['ICON_SRC'] = $ar_props['VALUE'];
		}
	}
	
	asort($elemSorts);
	array_walk($elemSorts, 'addElemOfSection', [$sectId, $sections, $elems]);
}

$res = \Bitrix\Iblock\SectionTable::getList([
	'filter' => [
		'IBLOCK_ID' => $GLOBALS['iblockIdSolutions'],
	],
	'select' => [
		'ID', 'NAME', 'SORT',
	],
]);
$sections = [];
$sectionSorts = [];
while ($section = $res->Fetch()) {
	$sections[$section['ID']]['NAME'] = $section['NAME'];
	$sectionSorts[$section['ID']] = $section['SORT'];
}

asort($sectionSorts);
array_walk($sectionSorts, 'addElemsOfSection', $sections);

$arResult['CITEMS'] = $GLOBALS['CITEMS'];