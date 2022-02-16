<?php require_once($_SERVER['DOCUMENT_ROOT'] . "/bitrix/modules/main/include/prolog_before.php");
if ('application/json' == $_SERVER['CONTENT_TYPE'] && 'POST' == $_SERVER['REQUEST_METHOD']) {
    $reqData = json_decode(file_get_contents('php://input'), true);
}
CModule::IncludeModule('iblock');
$iblocks = GetIBlockList("video", "video_files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section", "video", Array(
"IBLOCK_TYPE" => "video",	// Тип инфоблока
"IBLOCK_ID" => $block_id,	// Инфоблок
"SECTION_CODE" => $reqData['section'],	// Код раздела
"PROPERTY_CODE" => ["YOUTUBE", "FILE", "DESCRIPTION", "IMAGE"],
"AJAX_QUERY" => "Y",
),
false);