<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-thumbnail.js");
$APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.js");
CModule::IncludeModule('iblock');


?>
<script type="text/javascript">
  	app.setPageTitle({
         title: "Видео"
      });
	  
	var params = { //отключение обновления на странице
        enabled: false
    };
	BXMobileApp.UI.Page.Refresh.setParams(params);
</script>


<?$APPLICATION->IncludeComponent("perco:ib", "video", [
	'IB_ID' => '1', //id инфоблока
	'SECT_ID' => '1', //id раздела инфоблока
	'FIELDS' => ['NAME', 'CODE'], //список возвращаемых полей
	'PROPERTIES' => ['Youtube'], //список возвращаемых своств
]);?>

<div id="content" class="youtube-video">
	<?
	$iblocks = GetIBlockList("video", "video_files");
	if($arIBlock = $iblocks->Fetch())
		$block_id = $arIBlock["ID"];
	$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "video-youtube", Array(
		"IBLOCK_TYPE" => "video",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "video",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => "",	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false);
	?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
