<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$rs = CIBlockElement::GetList(
	array("SORT"=>"ASC", "ID"=>"DESC"), 
	array(
	"IBLOCK_ID" => $arParams["IBLOCK_ID"],
	"ACTIVE" => "Y",
	"SECTION_CODE" => $arParams["SECTION_CODE"]	// пользовательское свойство, фильтр
	)
);
while($ar = $rs->GetNext())
{
	$arResult["ELEMENTS"][] = $ar;
}
?>