<? 
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тестовая запись в файл");
$APPLICATION->AddChainItem('Тестовая запись в файл');
?>
<div style=" width: 100%;">
	<? 
		// $arSelect = Array("ID", "NAME", "SECTION_ID", "IBLOCK_TYPE", "SECTION_CODE", "SECTION_ID");
		// $arFilter = array("IBLOCK_CODE" => "products", "ACTIVE"=>"Y"); 
		// $res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
		// while($ob = $res->GetNextElement())
		// {
		// 	$arFields = $ob->GetFields();
		// 	console_log($arFields);
		// }
	?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>