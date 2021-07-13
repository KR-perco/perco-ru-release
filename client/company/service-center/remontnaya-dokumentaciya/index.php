<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Ремонтная документация");
$APPLICATION->SetPageProperty("keywords", "Ремонтная документация");
$APPLICATION->SetPageProperty("description", "Ремонтная документация");
$APPLICATION->SetTitle("Ремонтная документация");
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
<?
$iblocks = GetIBlockList("download", "files_sc");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "deystvuyushchaya",	// Код раздела
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
<br />
<h1>Архив</h1>
<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "arkhiv",	// Код раздела
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
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
