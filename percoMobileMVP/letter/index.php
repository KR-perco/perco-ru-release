<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');

$APPLICATION->SetAdditionalCSS("/css/kontakty.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/kontakty.js"); // подключение скриптов
//$APPLICATION->AddHeadString('<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>'); // подключение скриптов
?>
<script>
	app.setPageTitle({
         title: "Написать"
      });
</script>
<style>
	textarea{
		width: 100%;
	}
	#contacts {
		justify-content: center;
	}
</style>
<div id="content">
	<div id="contacts">
		<div>
			<!--div id="feedback"-->
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "form", array(
	"WEB_FORM_ID" => "60",
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
			<!--/div-->
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>