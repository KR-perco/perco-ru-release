<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Заявка на обучение | PERCo");
$APPLICATION->SetPageProperty("keywords", "обучение специалистов по безопасности, скуд, контроль доступа, системы безопасности, обучающие семинары по безопасности");
$APPLICATION->SetPageProperty("description", "PERCo проводит обучающие семинары для пользователей и партнеров ");
$APPLICATION->SetTitle("Заявка на обучение");

$APPLICATION->SetAdditionalCSS("/css/obuchenie.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/obuchenie.js"); // подключение скриптов
?>
<div id="content">
	<h1> <?$APPLICATION->ShowTitle(false, false)?> </h1>
	<div id="obuchenie">
		<div id="feedback">
			<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "form", array(
				"WEB_FORM_ID" => "54",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"USE_EXTENDED_ERRORS" => "N",
				"SEF_MODE" => "N",
				"SEF_FOLDER" => "/kontakty/",
				"CACHE_TYPE" => "A",
				"CACHE_TIME" => "3600",
				"LIST_URL" => "",
				"EDIT_URL" => "",
				"SUCCESS_URL" => "",
				"CHAIN_ITEM_TEXT" => "",
				"CHAIN_ITEM_LINK" => "",
				"VARIABLE_ALIASES" => array(
					"WEB_FORM_ID" => "WEB_FORM_ID",
					"RESULT_ID" => "RESULT_ID",
				)
				),
				false
			);?>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>