<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<div class="scroll-menu">
	<?
		foreach($arResult["SECTIONS"] as $section){
			if ($section["RIGHT_MARGIN"] - $section["LEFT_MARGIN"] <= 1){
				$name = $section["NAME"];
				$code = $section["CODE"];
				$url = '/images/icons/video-'.$code.'.svg';
				if(GetMessage($code)){
					?>
						<a class="scroll-btn" data-section="<?=$code;?>" href="?section=<?=$code;?>"><img src="<?=$url;?>"><?=GetMessage($code);?></a>
					<?
				}
			}
		}
	?>
</div>

<?
if ($_GET['section']){
	$_REQUEST["section"] = $_GET['section'];
} else {
	$_REQUEST["section"] = $arResult["SECTIONS"][0]["CODE"];
}

if(CModule::IncludeModule("iblock"))
{
	$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "video_tree_youtube", Array(
			"IBLOCK_TYPE" => "video",	// Тип инфоблока
			"IBLOCK_ID" => 35,	// Инфоблок
			"SECTION_ID" => "",	// ID раздела
			"SECTION_CODE" => $_REQUEST["section"],	// Код раздела
			"USE_FILTER" => "N",
			"FILTER_NAME" => "",
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"TOP_DEPTH" => "3",	// Максимальная отображаемая глубина разделов
			"SECTION_FIELDS" => "",	// Поля разделов
			"SECTION_USER_FIELDS" => "",	// Свойства разделов
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		),
		false
	);
}
?>
