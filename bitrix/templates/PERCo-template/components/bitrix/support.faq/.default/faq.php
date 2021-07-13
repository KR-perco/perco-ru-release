<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:support.faq.section.list",
	"",
	Array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CACHE_TYPE" => $arParams["CACHE_TYPE"],
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
		"SECTION" => $arParams["SECTION"],
		"EXPAND_LIST" => $arParams["EXPAND_LIST"],
		"AJAX_MODE"	=> $arParams["AJAX_MODE"],
		"AJAX_OPTION_SHADOW"	=>	$arParams["AJAX_OPTION_SHADOW"],
		"AJAX_OPTION_JUMP"	=>	$arParams["AJAX_OPTION_JUMP"],
		"AJAX_OPTION_STYLE"	=>	$arParams["AJAX_OPTION_STYLE"],
		"AJAX_OPTION_HISTORY"	=>	$arParams["AJAX_OPTION_HISTORY"],
		"SHOW_RATING" => $arParams["SHOW_RATING"],
		"RATING_TYPE" => $arParams["RATING_TYPE"],
		"PATH_TO_USER" => $arParams["PATH_TO_USER"],		
		"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
	),
	$component
);?>