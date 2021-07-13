<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;
$iblocks = GetIBlockList("structure", "resheniya");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$aMenuLinksExt = $APPLICATION->IncludeComponent(
	"perco:menu.sections.elementswithoutsections",
	"",
	Array(
	"IS_SEF" => "N",
	"IBLOCK_TYPE" => "structure", // Введите сюда символьный код или ИД типа ИБ, в котором лежит инфоблок каталога
	"IBLOCK_ID" => $block_id, // Укажите тут реальный ID инфоблока, с которым вы связываете меню, то бишь, каталога
	"SECTION_URL" => "/resheniya/#SECTION_CODE#/", //Обратите внимание на то, что если у вас чпу направлены на код, то ставьте SECTION_CODE
	"DEPTH_LEVEL" => "1", // Сколько надо уровней меню, такую цифру и пишите
	"CACHE_TYPE" => "N", // Кэш. Надо или не надо? Думайте сами, решайте сами!
	"CACHE_TIME" => "36000000" // Сколько секунд будет жить кэш. В данном случае немногим меньше, чем полтора года
	),
	false
);
$aMenuLinks = array_merge($aMenuLinks, $aMenuLinksExt);
?> 