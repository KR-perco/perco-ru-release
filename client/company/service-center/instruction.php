<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Видеоинструкции", "");
$APPLICATION->SetPageProperty("title", "Видеоинструкции");
$APPLICATION->SetPageProperty("keywords", "Видеоинструкции");
$APPLICATION->SetPageProperty("description", "Видеоинструкции");
$APPLICATION->SetTitle("Видеоинструкции");
?>
<div id="content">
  <?require($_SERVER["DOCUMENT_ROOT"]."/client/company/service-center/menu.php");?>
	<h1>Видеоинструкции по порядку разборки турникетов и электронных проходных</h1>
<?

$iblocks2 = GetIBlockList("", "video_files");

if($arIBlock = $iblocks2->Fetch())
  $block_id2 = $arIBlock["ID"];
  $autoplay = '1';
?>
<div>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video2", array(
  "IBLOCK_ID" => $block_id2,
  "ELEMENT_ID" => "20825",
  "AUTOSTART" => "N",
  ),
  false
);
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video2", array(
  "IBLOCK_ID" => $block_id2,
  "ELEMENT_ID" => "20826",
  "AUTOSTART" => "N",
  ),
  false
);
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video2", array(
  "IBLOCK_ID" => $block_id2,
  "ELEMENT_ID" => "20827",
  "AUTOSTART" => "N",
  ),
  false
);
?>
<?
$APPLICATION->IncludeComponent("bitrix:catalog.element", "last_video2", array(
  "IBLOCK_ID" => $block_id2,
  "ELEMENT_ID" => "20828",
  "AUTOSTART" => "N",
  ),
  false
);
?>
</div>
<?

/*$iblocks = GetIBlockList("video", "video_files");
if($arIBlock = $iblocks->Fetch())
  $block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "video_tree_sc", Array(
  "IBLOCK_TYPE" => "video", // Тип инфоблока
  "IBLOCK_ID" => $block_id, // Инфоблок
  "SECTION_ID" => "", // ID раздела
  "SECTION_CODE" => "v-zakrytyy-razdel",  // Код раздела
  "SECTION_URL" => "",  // URL, ведущий на страницу с содержимым раздела
  "COUNT_ELEMENTS" => "N",  // Показывать количество элементов в разделе
  "TOP_DEPTH" => "5", // Максимальная отображаемая глубина разделов
  "SECTION_FIELDS" => "", // Поля разделов
  "SECTION_USER_FIELDS" => "",  // Свойства разделов
  "ADD_SECTIONS_CHAIN" => "N",  // Включать раздел в цепочку навигации
  "CACHE_TYPE" => "A",  // Тип кеширования
  "CACHE_TIME" => "36000000", // Время кеширования (сек.)
  "CACHE_GROUPS" => "Y",  // Учитывать права доступа
),
false);*/

?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>