<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Задать вопрос", "");
$APPLICATION->SetPageProperty("title", "Задать вопрос");
$APPLICATION->SetPageProperty("keywords", "Задать вопрос");
$APPLICATION->SetPageProperty("description", "Задать вопрос");
$APPLICATION->SetTitle("Задать вопрос");
?>

<div id="content">
	<?require($_SERVER["DOCUMENT_ROOT"]."/client/company/service-center/menu.php");?>
	<h1>
    <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "form", array(
	"WEB_FORM_ID" => "8",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "Y",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "/support/servisnye-centry/zadat-vopros/",
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
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
