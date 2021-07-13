<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Бланк рекламации", "");
$APPLICATION->SetPageProperty("title", "Бланк рекламации");
$APPLICATION->SetPageProperty("keywords", "Бланк рекламации");
$APPLICATION->SetPageProperty("description", "Бланк рекламации");
$APPLICATION->SetTitle("Бланк рекламации");
?>

<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
    <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"form",
	Array(
		"WEB_FORM_ID" => "5",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "Y",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => Array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID"
		)
	)
);?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
