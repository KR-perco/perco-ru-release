<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Программа визуализации", "");
$APPLICATION->SetPageProperty("title", "Программа визуализации | PERCo");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Программа визуализации");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/proektirovshchikam-i-installyatoram.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Программа 3D-визуализации" src="/images/icons/vizualization.svg" />
	</div>
	<p>Программа 3D-визуализации проходных позволяет создавать трехмерные изображения помещений с оборудованием PERCo в разных интерьерах: холлах бизнес-центров, проходных предприятий и учреждений, вестибюлях учебных заведений, на открытом воздухе.</p>
	<p>Эти изображения в электронном и печатном виде помогут с максимальной наглядностью продемонстрировать проект заказчикам. В программу загружены библиотеки моделей оборудования и ограждений PERCo. С помощью программы турникеты, калитки и ограждения можно расставить на плане проходной.</p>
	<div class="img_viz">
		<a href="/images/support/visualization-project_1_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_1_mini.jpg"></a>
		<a href="/images/support/visualization-project_2_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_2_mini.jpg"></a>
		<a href="/images/support/visualization-project_3_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_3_mini.jpg"></a>
		<a href="/images/support/visualization-project_4_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_4_mini.jpg"></a>
		<a href="/images/support/visualization-project_5_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_5_mini.jpg"></a>
		<a href="/images/support/visualization-project_6_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_6_mini.jpg"></a>
		<a href="/images/support/visualization-project_7_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_7_mini.jpg"></a>
		<a href="/images/support/visualization-project_8_big.jpg" title="Визуализация проекта проходной" data-sub-html="Визуализация проекта проходной"><img alt="Визуализация проекта проходной" src="/images/support/visualization-project_8_mini.jpg"></a>
	</div>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "programma-vizualizatsii-prokhodnykh-perco",	// Код раздела
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
);;?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>