<?
Header("Location: /client/company/", true, 301);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Список сотрудников");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Список сотрудников");
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
	<p><a href="/client/company/list/add.php">Добавить сотрудника</a></p><p>Если у Вас много сотрудников, Вы можете добавить их путем загрузки Excel-файла сохраненного в формате "CSV (разделители - запятые)(*.csv)".<br /><a href="/client/company/list/add_file.php">Перейти к выгрузке файла</a>.</p>
<?$APPLICATION->IncludeComponent("bitrix:news.list", "list-specialists", Array(
	"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
	"USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"LIST_URL" => "",	// Страница со списком результатов
	"EDIT_URL" => "",	// Страница редактирования результата
	"SUCCESS_URL" => "",	// Страница с сообщением об успешной отправке
	"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"SET_TITLE" => "N",
	),
	false
);?>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>