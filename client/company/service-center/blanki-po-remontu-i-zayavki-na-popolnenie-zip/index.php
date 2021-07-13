<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Бланки по ремонту и заявки на пополнение ЗИП");
$APPLICATION->SetPageProperty("keywords", "бланки по ремонту и заявки на пополнение ЗИП");
$APPLICATION->SetPageProperty("description", "Бланки по ремонту и заявки на пополнение ЗИП");
$APPLICATION->SetTitle("Бланки по ремонту и заявки на пополнение ЗИП");
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
  <p>Бланки по ремонту и заявки на пополнение ЗИП, пожалуйста,  по электронной почте <a href="mailto:service@perco.ru" >service@perco.ru</a> (контактное лицо &mdash; Василий Коснырев).</p>
  <p><strong>Скачать бланки отчетов и заявок:</strong></p>
<?
$iblocks = GetIBlockList("download", "blanks");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "blanki",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);?>
  <h3>Бланк рекламации</h3>
  <div style="margin: 0pt 0pt 0pt 10px;">
    <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	".default",
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
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
