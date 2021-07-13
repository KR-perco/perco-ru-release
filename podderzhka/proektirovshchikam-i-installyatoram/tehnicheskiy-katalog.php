<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Каталоги оборудования и запчастей", "");
$APPLICATION->SetPageProperty("title", "Каталоги оборудования и запчастей | PERCo");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Каталоги оборудования и запчастей");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/proektirovshchikam-i-installyatoram.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Технический каталог" src="/images/icons/tech-katalog.svg" />
	</div>
	<div style="margin-bottom: 30px;">
		<p>Технический каталог поможет разработать проект установки системы безопасности, подобрать необходимое оборудование, осуществить его установку и внедрение.</p>
		<p>В каталоге приведены подробные технические сведения об оборудовании и программном обеспечении PERCo - технические характеристики, структурные и электрические схемы подключения, габаритные чертежи, описание функционала модулей ПО. Кроме того, в каталоге можно посмотреть типовые решения построения систем безопасности на оборудовании PERCo.</p>
		<a href="/podderzhka/zakaz-kataloga.php">Заказ технического каталога</a>
	</div>
	
<p>Каталог запчастей к оборудованию</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "katalog-zapchastey-k-oborudovaniyu",	// Код раздела
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
<p>Технический каталог оборудования</p>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
	"IBLOCK_TYPE" => "download",	// Тип инфоблока
	"IBLOCK_ID" => $block_id,	// Инфоблок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => "tekhnicheskiy-katalog-oborudovaniya",	// Код раздела
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
	<div class="tech-imges"><img src="/images/news/2017/zakaz.jpg" alt="Online заказ технического каталога "></div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>