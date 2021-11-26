<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); ?>
<?
if(CModule::IncludeModule("iblock"))
{
	$iblocks = GetIBlockList("download", "files");
	if($arIBlock = $iblocks->Fetch())
		$block_id = $arIBlock["ID"];
	// global $arrFilter;
	// $arrFilter["UF_ARCHIVE"] = false;
	$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "mobile_files_tree", Array(
			"IBLOCK_TYPE" => "download",	// Тип инфоблока
			"IBLOCK_ID" => $block_id,	// Инфоблок
			"SECTION_ID" => "",	// ID раздела
			"SECTION_CODE" => $_REQUEST["section"],	// Код раздела
			// "USE_FILTER" => "Y",
			// "FILTER_NAME" => "arrFilter",
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
			"SECTION_FIELDS" => "",	// Поля разделов
			"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
			"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		),
		false
	);
}
?>