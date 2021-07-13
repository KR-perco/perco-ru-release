<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
CMain::IncludeFile("lang/".LANGUAGE_ID."/products.php");
$folder = explode("/", $_SERVER["REQUEST_URI"]);
if (LANGUAGE_ID == "en")
	$folder[1] .= "_com";
$iblocks = GetIBlockList("structure", $folder[1]);
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
if ($_GET["utm_source"] != "") {
    $utm_source = $_GET["utm_source"];
    $utm_campaign = $_GET["utm_campaign"];
    $dateNaw = date('l jS \of F Y h:i:s A');
    if (!empty($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    if (!empty($_SERVER['HTTP_USER_AGENT'])) {
        $brouser = $_SERVER['HTTP_USER_AGENT'];
    }

    $posts[] = array('ip' => $ip, 'brouser' => $brouser, 'date' => $dateNaw, 'utm_source' => $utm_source, 'utm_campaign' => $utm_campaign, 'count' => $count);

    $file = file_get_contents('../results-session.json'); // Открыть файл data.json
    $taskList = json_decode($file, true); // Декодировать в массив
    unset($file); // Очистить переменную $file

    $taskList[] = array('session' => $posts); // Представить новую переменную как элемент массива, в формате 'ключ'=>'имя переменной'
    file_put_contents('../results-session.json', json_encode($taskList)); // Перекодировать в формат и записать в файл.
    unset($taskList);

}

$APPLICATION->IncludeComponent(
	"bitrix:catalog", 
	"perco_structure", 
	array(
		"IBLOCK_TYPE" => "structure",
		"IBLOCK_ID" => $block_id,
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "N",
		"SET_TITLE" => "Y",
		"SET_STATUS_404" => "Y",
		"ADD_ELEMENT_CHAIN" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"USE_FILTER" => "N",
		"USE_REVIEW" => "N",
		"USE_COMPARE" => "N",
		"PRICE_CODE" => array(
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"SHOW_TOP_ELEMENTS" => "N",
		"PAGE_ELEMENT_COUNT" => "1000",
		"LINE_ELEMENT_COUNT" => "3",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"LIST_PROPERTY_CODE" => array(
			0 => "",
		),
		"INCLUDE_SUBSECTIONS" => "A",
		"LIST_META_KEYWORDS" => "-",
		"LIST_META_DESCRIPTION" => "-",
		"LIST_BROWSER_TITLE" => "-",
		"DETAIL_PROPERTY_CODE" => array(
			0 => "DOP_NAME",
			1 => "IMAGE_PREVIEW",
			2 => "IMAGE",
			3 => "SPECIFICATIONS",
			4 => "SCROLL",
			5 => "LINKS",
			6 => "CSS",
			7 => "JS",
			8 => "PHP",
			9 => "TEXT",
			10 => "IMAGES",
			11 => "IMAGES_TEXT",
		),
		"DETAIL_META_KEYWORDS" => "-",
		"DETAIL_META_DESCRIPTION" => "-",
		"DETAIL_BROWSER_TITLE" => "-",
		"LINK_IBLOCK_TYPE" => "",
		"LINK_IBLOCK_ID" => "",
		"LINK_PROPERTY_SID" => "",
		"LINK_ELEMENTS_URL" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "Y",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"USE_ELEMENT_COUNTER" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"ADD_PROPERTIES_TO_BASKET" => "N",
		"SECTION_COUNT_ELEMENTS" => "N",
		"SECTION_TOP_DEPTH" => "1",
		"ELEMENT_SORT_FIELD2" => "id",
		"ELEMENT_SORT_ORDER2" => "desc",
		"DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
		"USE_STORE" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"SEF_URL_TEMPLATES" => array(
			"sections" => "",
			"section" => "#IBLOCK_CODE#/#SECTION_CODE#/",
			"element" => "#IBLOCK_CODE#/#ELEMENT_CODE#.php",
			"compare" => "",
		)
	),
	false
);?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
