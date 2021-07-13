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
	"DEPTH_LEVEL" => "5", // Сколько надо уровней меню, такую цифру и пишите
	"CACHE_TYPE" => "N", // Кэш. Надо или не надо? Думайте сами, решайте сами!
	"CACHE_TIME" => "36000000", // Сколько секунд будет жить кэш. В данном случае немногим меньше, чем полтора года
	"ADD_ELEMENTS" => "Y"
	),
	false
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?> 