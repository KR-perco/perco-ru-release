<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
CMain::IncludeFile("lang/".LANGUAGE_ID."/news.php");
if(CModule::IncludeModule("iblock"))
{
	$iblocks = GetIBlockList("news", GetMessage("IBLOCK_CODE"));
	if($arIBlock = $iblocks->Fetch())
		$block_id = $arIBlock["ID"];
	$APPLICATION->IncludeComponent("bitrix:rss.out","",Array(
			"IBLOCK_TYPE" => "news",
			"IBLOCK_ID" => $block_id,
			"SECTION_ID" => "",
			"NUM_NEWS" => "10",
			"NUM_DAYS" => "",
			"RSS_TTL" => "1440",
			"YANDEX" => "Y",
			"SORT_BY1" => "ACTIVE_FROM",
			"SORT_ORDER1" => "DESC",
			"SORT_BY2" => "SORT",
			"SORT_ORDER2" => "ASC",
			"FILTER_NAME" => "",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"CACHE_GROUPS" => "Y",
			"CACHE_FILTER" => "N",
		)
	);
}
?>