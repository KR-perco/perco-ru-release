<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Библиотека моделей", "");
$APPLICATION->SetPageProperty("title", "Библиотека моделей | PERCo");
$APPLICATION->SetPageProperty("description", "Для удобства проектировщиков и инсталляторов PERCo предлагает полный комплект инструментов: библиотека моделей ArchiCAD, библиотека моделей AutoCAD, схемы подключения оборудования и программа 3D-визуализации проходных");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Библиотека моделей");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/proektirovshchikam-i-installyatoram.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="библиотека моделей" src="/images/icons/biblioteka-modelei.svg" />
	</div>
	<p>Пользуясь библиотекой, моделей турникетов, электронных проходных, калиток и ограждений PERCo в программе ArchiCAD можно быстро и просто создавать любые конфигурации проходных для архитектурно-строительных проектов.</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "biblioteki-modeley-oburodovaniya",	// Код раздела
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
);
?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>