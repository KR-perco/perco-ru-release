<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$rs = CIBlockElement::GetList(
	array(), 
	array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"SECTION_CODE" => $arParams["SECTION_CODE"]	// пользовательское свойство, фильтр
	)
);
while($ar = $rs->GetNext())
{
	$arResult["ELEMENTS"][] = $ar;
}

//sort
foreach($arResult['SECTIONS'] as $k => $v){
    $subArr[$k] = $v["SORT"];
}
natsort($subArr);
$subArrTmp = $arResult['SECTIONS'];
unset($arResult['SECTIONS']);
foreach($subArr as $k => $v) {
    $arResult['SECTIONS'][$k] = $subArrTmp[$k];
}

?>