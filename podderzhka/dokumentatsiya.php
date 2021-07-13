<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Документация", "");
$APPLICATION->SetPageProperty("title", "Документация | PERCo");
$APPLICATION->SetPageProperty("description", "Документация в формате PDF на системы и оборудование PERCo");
$APPLICATION->SetPageProperty("keywords", "документация perco, скуд, системы безопасности, системы контроля и управления доступом");
$APPLICATION->SetTitle("Документация");

$APPLICATION->SetAdditionalCSS("/css/dokumentatsiya.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/dokumentatsiya.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Документация" src="/images/icons/documents.svg" />
	</div>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "dokumentatsiya-obshchaya",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);?>
	<h2>Выбор документации по товарам</h2>
	<div id="select_documents" >
		<select id="section" name="section"></select>
		<button type="submit" value="Найти">Найти</button>
	</div>
	<div id="download_items"></div>
	<p><a href="/podderzhka/archive.php">Архив документации</a></p>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>