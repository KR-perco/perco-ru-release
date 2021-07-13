<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CMain::IncludeFile("lang/".LANGUAGE_ID."/about.php");
$APPLICATION->SetPageProperty("title", GetMessage("TITLE"));
$APPLICATION->SetPageProperty("keywords", GetMessage("KEYWORDS"));
$APPLICATION->SetPageProperty("description", GetMessage("DESCRIPTION"));
$APPLICATION->SetTitle(GetMessage("SETTITLE"));

$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-thumbnail.min.js");
// $APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.js");
?>


<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
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
