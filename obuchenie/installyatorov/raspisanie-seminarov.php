<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

$APPLICATION->AddChainItem("Расписание всех семинаров", "");
$APPLICATION->SetPageProperty("title", "Расписание семинаров PERCo");
$APPLICATION->SetPageProperty("description", "Для эффективного использования систем безопасности и оборудования PERCo организованы регулярные обучающие семинары для инсталляторов S-20");
$APPLICATION->SetPageProperty("keywords", "обучение, обучающие семинары безопасности, обучение специалистов по безопасности");
$APPLICATION->SetTitle("Расписание всех семинаров");

$APPLICATION->SetAdditionalCSS("/css/schedule.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/schedule.js"); // подключение скриптов
?>
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p>Для эффективного использования систем и оборудования PERCo на предприятии или в учреждении компания проводит регулярные обучающие семинары для пользователей систем PERCo.</p>
<?
$iblocks = GetIBlockList("edu", "seminars");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("perco:learning.calendar","learning",Array(
		"AJAX_MODE" => "N",
		"IBLOCK_TYPE" => "edu",
		"IBLOCK_ID" => $block_id,
		"MONTH_VAR_NAME" => "month",
		"YEAR_VAR_NAME" => "year",
		"WEEK_START" => "1",
		"DATE_FIELD" => "DATE_ACTIVE_TO",
		"TYPE" => "EVENTS",
		"SHOW_YEAR" => "Y",
		"SHOW_TIME" => "Y",
		"TITLE_LEN" => "0",
		"SET_TITLE" => "N",
		"SHOW_CURRENT_DATE" => "Y",
		"SHOW_MONTH_LIST" => "Y",
		"NEWS_COUNT" => "0",
		"DETAIL_URL" => "",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "schedule", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => $block_id,	// Код информационного блока
	"NEWS_COUNT" => "50",	// Количество новостей на странице
	"SORT_BY1" => "DATE_ACTIVE_TO",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "DATE_ACTIVE_TO",
		1 => "ACTIVE_TO",
		2 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "DATE_END",
		1 => "TIME",
		2 => "TEMA",
		3 => "CITY",
		4 => "TEMA_LINK",
		5 => "LINK",
		6 => "RESOURCE",
		7 => "FOR_US",
		8 => "KTO",
		9 => "NUMDAY",
		10 => "LINK_COMDY",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "0",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "Y",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Семинары",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "0",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/obuchenie/vebinar_info.php");?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>