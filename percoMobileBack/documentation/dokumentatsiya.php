<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$APPLICATION->AddHeadScript("/scripts/url.min.js");
$APPLICATION->AddHeadScript("/scripts/pages/dokumentatsiya.js");
?>
<script>
	app.setPageTitle({
         title: "Документация"
	  });
	  
</script> 
<style>
#select_documents {
	display: flex;
	flex-direction: column;
}
select {
	font-family: inherit;
	font-size: inherit;
	border: 1px solid #BDBEC0;
	width: 400px;
	padding: 10px;
	margin: 15px 0;
	text-align: right
}
select:not(:first-child) { display: none; }
#select_documents button {
	background: #BDBEC0 !important;
	border-bottom: 2px solid grey !important;
	width: 200px;
}
#download_items { margin: 50px 0; }
@media screen and (max-width: 900px) {
	select { width: 340px; }
	#download_items { margin: 20px 0; }
}
</style>
<div id="content">
<div class="catalog-section-list">
			<h2>Каталог запчастей к оборудованию</h2>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="bxlocal://pdf.png"></div>
				<div><a href="bxlocal://katalog-zapchastej-PERCo.pdf">Иллюстрированный каталог запчастей к оборудованию PERCo</a></div>
			</div>
			<div class="download_item" style="display: none;">
				<div class="icon"><img alt="Иконка" src="bxlocal://pdf.png"></div>
				<div><a href="bxlocal://katalog-dlya-kp.pdf">Прайс запчастей к оборудованию PERCo</a></div>
			</div>
			<h2>Сертификаты системы качества PERCo</h2>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="bxlocal://pdf.png"></div>
				<div><a href="bxlocal://Certificates_IQNet.pdf">Сертификат IQNet</a></div>
			</div>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="bxlocal://pdf.png"></div>
				<div><a href="bxlocal://Certificates_ACCREDIA.pdf">Сертификат ACCREDIA/ТЕСТ-С</a></div>
			</div>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="bxlocal://pdf.png"></div>
				<div><a href="bxlocal://gost-iso-9001-2015.pdf">Сертификат ГОСТ ISO9001-2015 (ISO9001:2015)</a></div>
			</div>
			<h2 style="display: none;">Технический каталог оборудования</h2>
			<div class="download_item" style="display: none;">
				<div class="icon"><img alt="Иконка" src="bxlocal://pdf.png"></div>
				<div><a href="bxlocal://technical-catalog-perco.pdf">Технический каталог А4</a></div>
			</div>
		</div>
	<div>
	<div style="display: none;">
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "mobile_files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "dokumentatsiya-obshchaya",	// Код раздела
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
	<h2>Выбор документации по товарам</h2>
	<div id="select_documents" >
		<select id="section" name="section"></select>
		<button type="submit" value="Найти">Найти</button>
	</div>
	<div id="download_items"></div>
	<p><a href="/percoMobileBack/documentation/archive.php">Архив документации</a></p>
</div>
  

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>