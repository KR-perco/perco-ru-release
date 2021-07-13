<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "CollectionPage");
$APPLICATION->AddChainItem("Каталоги и буклеты", "");
$APPLICATION->SetPageProperty("title", "Каталоги и буклеты PERCo");
$APPLICATION->SetPageProperty("description", "Каталоги и буклеты о системах безопасности, СКУД, турникетах, электронных проходных, электрозамках, электронных кабинетах, ограждениях PERCo");
$APPLICATION->SetPageProperty("keywords", "системы контроля доступа, системы безопасности, скуд");
$APPLICATION->SetTitle("Каталоги и буклеты");

$APPLICATION->SetAdditionalCSS("/css/reklamnye-materialy.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/reklamnye-materialy.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Каталоги и буклеты" src="/images/icons/reclame.svg" />
	</div>
	<p>В данном разделе представлены презентационные материалы о продукции PERCo (комплексные системы безопасности, системы контроля доступа (СКУД) и повышения эффективности, электронные проходные, турникеты, калитки и ограждения, электромеханические замки) и деятельности компании. Кроме того, в разделе собраны технические каталоги, в которых представлена подробная техническая информация обо всем оборудовании, выпускаемом PERCo.</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "reklamnye-materialy",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"WITH_IMAGE" => "Y"
	),
	false
);?>
	<div id="free_catalog">
		<a href="/podderzhka/zakaz-kataloga.php">
			<div class="icon">
				<img src="/images/icons/catalog.svg" alt="Технический каталог"><span class="icon_text">Заказать технический каталог</span>
			</div>
		</a>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
