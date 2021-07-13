<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Связь с PERCo");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Связь с PERC<span style='text-transform:lowercase;'>o</span>");
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
<?$APPLICATION->IncludeComponent("bitrix:support.ticket", "", Array(
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"SEF_FOLDER" => "/client/student/svyaz-s-perco/",
	"TICKETS_PER_PAGE" => "50",	// Количество обращений на одной странице
	"MESSAGES_PER_PAGE" => "20",	// Количество сообщений на одной странице
	"MESSAGE_MAX_LENGTH" => "70",	// Максимальная длина неразрывной строки
	"MESSAGE_SORT_ORDER" => "asc",	// Направление для сортировки сообщений в обращении
	"SET_PAGE_TITLE" => "N",	// Устанавливать заголовок страницы
	"SHOW_COUPON_FIELD" => "N",	// Показывать поле ввода купона
	"VARIABLE_ALIASES" => array(
		"ID" => "ID",
	)
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>