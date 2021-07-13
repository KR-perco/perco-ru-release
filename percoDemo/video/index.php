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
</script>

<?/*$APPLICATION->IncludeComponent("perco:ib", "video", [
	'IB_ID' => 35, //id инфоблока
	//'SECT_ID' => 2053, //id раздела инфоблока
	'SECT_FIELDS' => ['NAME', 'CODE'], //список возвращаемых полей раздела
	'ELEM_FIELDS' => ['NAME'], //список возвращаемых полей элементов
	'ELEM_PROPS' => ['YOUTUBE'], //список возвращаемых своств
	'PROP_FIELDS' => ['VALUE', 'DESCRIPTION'], //список возвращаемых полей свойств
	'GET_TREE' => 'Y', //если установлено Y, тогда компонент построит дерево из элеменов и разделов инфоблока в массиве $arResult['TREE']
]);*/?>

<!--div id="content" class="youtube-video"-->
<?
switch ($_GET['worker']) {
	case 'installer':
		$sectCode = 'videoinstruktsii';
		break;
	default:
		$sectCode = 'video';
		break;
}

$iblocks = GetIBlockList("video", "video_files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "video", Array(
	"IBLOCK_TYPE" => "video",	// Тип инфоблока
	"IBLOCK_ID" => $block_id,	// Инфоблок
	"SECTION_ID" => "",	// ID раздела
	"SECTION_CODE" => $sectCode,	// Код раздела
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

switch ($_GET['worker']) {
	case 'installer':
		$sectCode = 'videoinstruktsii';
		break;
	default:
		$sectCode = 'o-kompanii';
		break;
}

$APPLICATION->IncludeComponent("bitrix:catalog.section", "video", Array(
"IBLOCK_TYPE" => "video",	// Тип инфоблока
"IBLOCK_ID" => $block_id,	// Инфоблок
//"SECTION_ID" => "",	// ID раздела
"SECTION_CODE" => $sectCode,	// Код раздела
"PROPERTY_CODE" => ["YOUTUBE", "FILE", "DESCRIPTION", "IMAGE"],
"AJAX_QUERY" => "N" //если установлено возвращается только массив с обнавляемой информацией
),
false);
?>
<!--/div-->
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
