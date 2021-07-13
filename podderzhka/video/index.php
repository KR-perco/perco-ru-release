<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Системы безопасности и контроля доступа PERCo - Видеоинструкции по монтажу и настройке");
$APPLICATION->SetPageProperty("keywords", "монтаж электронной проходной, система безопасности, контроль доступа, турникеты");
$APPLICATION->SetPageProperty("description", "Настройка комплексной системы безопасности PERCo, монтаж турникетов и электронных проходных.");
$APPLICATION->SetTitle("Видеоинструкции");

$APPLICATION->AddHeadString('<link href="https://'.$_SERVER["SERVER_NAME"].'/o-kompanii/video/" rel="canonical" />');

$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-thumbnail.min.js");
$APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.js");

// $APPLICATION->SetAdditionalCSS("/css/video.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/video.js"); // подключение скриптов
?>

<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Видеоинструкции" src="/images/icons/video-instruction.svg" />
	</div>
	<?
	global $arrFilter;
	$arrFilter = array('UF_SECTION' => 'support');

	$iblocks = GetIBlockList("video", "video_files");
	if($arIBlock = $iblocks->Fetch())
		$block_id = $arIBlock["ID"];
	$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "video-youtube", Array(
		"IBLOCK_TYPE" => "video",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "Y",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => "",	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"USE_FILTER" => "Y",
		"FILTER_NAME" => "arrFilter"
	),
	false);
	?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
