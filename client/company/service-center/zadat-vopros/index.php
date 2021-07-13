<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Задать вопрос");
$APPLICATION->SetPageProperty("keywords", "Задать вопрос");
$APPLICATION->SetPageProperty("description", "Задать вопрос");
$APPLICATION->SetTitle("Задать вопрос");
?>

<div id="textBlcok">
	<ul>
		<li><a href="/client/company/service-center/" >Новости</a></li>
		<li><a href="/client/company/service-center/remontnaya-dokumentaciya/" >Ремонтная документация</a></li>
		<li><a href="/client/company/service-center/blanki-po-remontu-i-zayavki-na-popolnenie-zip/" >Бланки по ремонту и заявки на пополнение ЗИП</a></li>
		<li><a href="/client/company/service-center/garant/">Гарантийные обязательства PERCo</a></li>
		<li><a href="/client/company/service-center/normativ/">Нормативы проведения ремонтных работ</a></li>
		<li><a href="/client/company/service-center/parametry/">Параметры сервисного обслуживания, согласуемые между СЦ и PERCo</a></li>
		<li><a href="/client/company/service-center/katalog-zip/" >Каталог ЗИП</a></li>
		<li><a href="/client/company/service-center/zadat-vopros/" >Задать вопрос</a></li>
		<li><a href="/client/company/service-center/kontakty/">Контакты</a></li>
	</ul>
  <br />
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
  <?$APPLICATION->IncludeComponent("bitrix:form.result.new", ".default", array(
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
