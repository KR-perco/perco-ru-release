<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "CollectionPage");
$APPLICATION->AddChainItem("Каталоги и буклеты", "");
$APPLICATION->SetPageProperty("title", "Каталоги и буклеты PERCo");
$APPLICATION->SetPageProperty("description", "Каталоги и буклеты о системах безопасности, СКУД, турникетах, электронных проходных, электрозамках, электронных кабинетах, ограждениях PERCo");
$APPLICATION->SetPageProperty("keywords", "системы контроля доступа, системы безопасности, скуд");
$APPLICATION->SetTitle("Каталоги и буклеты");

$APPLICATION->SetAdditionalCSS("/css/reklamnye-materialy.css"); // подключение стилей

// Стили для fancybox (всплывающего окна с формой)
$APPLICATION->SetAdditionalCSS("/css/libs/fancybox.css"); 


?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Каталоги и буклеты" src="/images/icons/reclame.svg" />
	</div>
	<p>В данном разделе представлены презентационные материалы о продукции PERCo (комплексные системы безопасности, системы контроля доступа (СКУД) и повышения эффективности, электронные проходные, турникеты, калитки и ограждения, электромеханические замки) и деятельности компании. Кроме того, в разделе собраны технические каталоги, в которых представлена подробная техническая информация обо всем оборудовании, выпускаемом PERCo.</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree_catalogs-and-booklets", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "reklamnye-materialy",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"WITH_IMAGE" => "Y"
	),
	false
);?>
<div id="dialog-content" style="display:none;" class="" role="dialog">
	<div id="free_catalog"> 
		<div class="icon">
			<span class="booklets-header">Заказать</span>
		</div> 
	</div> 
	<div class="booklets-popup__window">
		<div class="booklets-feedback">
			<? $APPLICATION->IncludeComponent(
					"bitrix:form.result.new",
					"zakaz-bokletov-i-katalogov",
				array(
					"WEB_FORM_ID" => "72", 
					"USE_EXTENDED_ERRORS" => "N",
					"SEF_MODE" => "N",
					"SEF_FOLDER" => "",
					//"CACHE_TYPE" => "A",
					//"CACHE_TIME" => "3600",
					"CACHE_TYPE" => "N",
					"CACHE_TIME" => "0",
					"LIST_URL" => "",
					"EDIT_URL" => "",
					"SUCCESS_URL" => "", 
					"CHAIN_ITEM_TEXT" => "",
					"CHAIN_ITEM_LINK" => "",
					"AJAX_MODE" => "Y",
					"VARIABLE_ALIASES" => array(
						"WEB_FORM_ID" => "WEB_FORM_ID",
						"RESULT_ID" => "RESULT_ID",
					)
				),
				false
			); ?> 
		</div>
	</div> 

</div>


</div>


<!-- // скрипты для подключения всплывающего окна с формой -->
<script src="/scripts/libs/fancybox/fancybox.umd.js"></script>
<script src="/scripts/catalogs-and-booklets.js"></script> 



<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
