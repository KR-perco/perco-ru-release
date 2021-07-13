<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Заявка на очное обучение");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Заявка на очное обучение");
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
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
<?
$APPLICATION->IncludeComponent("bitrix:news.list", "seminari_stud_form", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => "46",	// Код информационного блока
	"PARENT_SECTION" => "1533",	// ID раздела
	"SORT_BY1" => "DATE_ACTIVE_TO",	// Поле для первой сортировки
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки
	"SORT_BY2" => "SORT",	// Поле для второй сортировки
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки
	"FILTER_NAME" => "",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
		2 => "ACTIVE_TO"
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "SEMINAR",
		1 => "ID_EXT",
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
	<div id="zayavka">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", ".default", Array(
	"WEB_FORM_ID" => "35",	// ID веб-формы
	"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
	"USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"LIST_URL" => "",	// Страница со списком результатов
	"EDIT_URL" => "",	// Страница редактирования результата
	"SUCCESS_URL" => "/client/company/zayavka/success.php",	// Страница с сообщением об успешной отправке
	"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
	"VARIABLE_ALIASES" => array(
		"WEB_FORM_ID" => "WEB_FORM_ID",
		"RESULT_ID" => "RESULT_ID",
	)
	),
	false
);?>
	</div>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>