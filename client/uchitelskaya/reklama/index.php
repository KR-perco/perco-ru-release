<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Рекламная продукция");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Рекламная продукция");
?>
<div class="dop_menu">
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_dop_menu", 
	array(
		"ROOT_MENU_TYPE" => "podmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
$arrFilter["!PROPERTY_CONFIRM_VALUE"] = "Да";
$APPLICATION->IncludeComponent("bitrix:news.list", "jurnal-reklama", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "56",	// Код информационного блока
	"NEWS_COUNT" => CIBlock::GetElementCount(56),
	"PARENT_SECTION" => "",	// ID раздела
	"SORT_BY1" => "DATE_ACTIVE_TO",	// Поле для первой сортировки
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки
	"SORT_BY2" => "SORT",	// Поле для второй сортировки
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "arrFilter",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "COMPANY",
		1 => "DATA",
		2 => "ZAKAZ",
		3 => "CONFIRM",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "43200",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"SET_TITLE" => "N",
	),
	false
);
?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>