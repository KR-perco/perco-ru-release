<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Прайс-лист на турникеты, калитки, ограждения | PERCo");
$APPLICATION->SetPageProperty("keywords", "цены на системы безопасности, прайс-лист на системы безопасности");
$APPLICATION->SetPageProperty("description", "Цены на системы безопасности и оборудование PERCo указаны на условиях поставки со складов в Пскове, Санкт-Петербурге и Москве");
$APPLICATION->SetTitle("Прайс-лист");

$APPLICATION->SetAdditionalCSS("/css/price.css"); // подключение стилей
?>
<div class="width_all">
	<div class="banner_image"></div>
</div>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?=GetDownloadFile("prays-list");?>
	<p>Цены указаны в евро с учетом НДС на условиях поставки EXW (франко-завод) со складов в Пскове, Санкт-Петербурге и Москве и не включают затраты на транспортировку.</p>
	<p>Оплата осуществляется в рублях по курсу ЦБ РФ на день оплаты счета.</p>
	<div id="main_catalog_list">
<?
$iblocks = GetIBlockList("structure", "products");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "section_icons", Array(
		"IBLOCK_TYPE" => "structure",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => "",	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);
?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
