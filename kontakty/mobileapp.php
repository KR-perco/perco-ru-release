<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контактная информация для связи с нашими специалистами | PERCo");
$APPLICATION->SetPageProperty("description", "Наши специалисты с удовольствием ответят на интересующие Вас вопросы про турникеты, калитки, ограждения, системы безопасности и СКУД PERCo");
$APPLICATION->SetPageProperty("keywords", "турникеты, калитки, ограждения, системы безопасности, системы контроля доступа, скуд");
$APPLICATION->SetTitle("Поддержка мобильного приложения");

$APPLICATION->SetAdditionalCSS("/css/kontakty.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/kontakty.js"); // подключение скриптов
//$APPLICATION->AddHeadString('<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>'); // подключение скриптов
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<div id="contacts">
		<div>
			<div id="feedback">
<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "form", array(
	"WEB_FORM_ID" => "52",
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
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>