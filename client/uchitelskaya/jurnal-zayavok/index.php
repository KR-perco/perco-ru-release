<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Журнал заявок на очное обучение");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Журнал заявок на очное обучение");
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
$APPLICATION->IncludeComponent("bitrix:news.list", "jurnal-zayavok", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "54",	// Код информационного блока
	"NEWS_COUNT" => CIBlock::GetElementCount(54),
	"PARENT_SECTION" => "",	// ID раздела
	"SORT_BY1" => "DATE_ACTIVE_TO",	// Поле для первой сортировки
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки
	"SORT_BY2" => "SORT",	// Поле для второй сортировки
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки
	"FILTER_NAME" => "",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "PATRONYMIC_NAME",
		1 => "NAME",
		2 => "PATRONYMIC_NAME",
		3 => "WORK_POSITION",
		4 => "EMAIL",
		5 => "COMPANY",
		6 => "CITY",
		8 => "SEMINAR",
		9 => "SEMINAR_DATE",
		10 => "APPLICANT",
		10 => "CONFIRM_TRAINING",
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