<?php
ob_start();
?>
<style>
	span.title {
		margin-bottom: 5px;
		font-size: 25px;
	}
</style>
<span class="title">Для заказа контроллера заполните форму:</span>
<?php
$APPLICATION->IncludeComponent("bitrix:form.result.new", "konkurs", array(
	"WEB_FORM_ID" => "57",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "",
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
);
?>
<span class="title">По результатам тестирования контроллера просьба ответить на следующие вопросы:</span>
<?php
$APPLICATION->IncludeComponent("bitrix:form.result.new", "konkurs", array(
	"WEB_FORM_ID" => "58",
	"IGNORE_CUSTOM_TEMPLATE" => "N",
	"USE_EXTENDED_ERRORS" => "N",
	"SEF_MODE" => "N",
	"SEF_FOLDER" => "",
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
);
$php_result = ob_get_contents(); 
ob_end_clean();