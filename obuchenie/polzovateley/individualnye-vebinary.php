<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Идивидуальные интернет-семинары", "");
$APPLICATION->SetPageProperty("title", "Индивидуальные интернет-семинары для пользователей S-20| PERCo");
$APPLICATION->SetPageProperty("description", "Индивидуальные интернет-семинары проводятся по заявкам компаний, у которых возникли вопросы в процессе эксплуатации системы PERCo-S-20.");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Идивидуальные интернет-семинары");

// $APPLICATION->SetAdditionalCSS("/css/vebinary-po-zaprosu.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/vebinary-po-zaprosu.js"); // подключение скриптов
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>

	<p>Индивидуальные интернет-семинары проводятся по заявкам компаний, у которых возникли конкретные вопросы в процессе эксплуатации систем безопасности PERCo.</p>
	<p>Для участия в индивидуальных интернет-семинарах необходимо заполнить форму регистрации (все поля обязательны для заполнения). По указанным контактным данным сотрудник учебного центра свяжется с вами для окончательного согласования проведения интернет-семинара.</p>
	<div style="margin:0 0 0 10px;">
<?
$APPLICATION->IncludeComponent("bitrix:form.result.new", "form", Array(
	"WEB_FORM_ID" => "33",	// ID веб-формы
	"IGNORE_CUSTOM_TEMPLATE" => "N",	// Игнорировать свой шаблон
	"USE_EXTENDED_ERRORS" => "N",	// Использовать расширенный вывод сообщений об ошибках
	"SEF_MODE" => "N",	// Включить поддержку ЧПУ
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"LIST_URL" => "",	// Страница со списком результатов
	"EDIT_URL" => "",	// Страница редактирования результата
	"SUCCESS_URL" => "/obuchenie/polzovateley/success.php",	// Страница с сообщением об успешной отправке
	"CHAIN_ITEM_TEXT" => "",	// Название дополнительного пункта в навигационной цепочке
	"CHAIN_ITEM_LINK" => "",	// Ссылка на дополнительном пункте в навигационной цепочке
	"VARIABLE_ALIASES" => array(
		"WEB_FORM_ID" => "WEB_FORM_ID",
		"RESULT_ID" => "RESULT_ID",
	)
	),
	false
);
?>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>