<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET)
{
	if ($route = strip_tags(trim($_GET['route'])))
	{
		Header("Location: /" . str_replace("DD.MM.YYYY", "", $route));
	}
}
CModule::IncludeModule("iblock");

$arSelect = Array("ID", "IBLOCK_ID", "NAME", "CODE");
$arFilter = Array(
	"IBLOCK_CODE" => "company_news",
	"ACTIVE"=>"Y",
	"ID"=>$ID
);
$res = CIBlockElement::GetList(Array(), $arFilter, $arSelect);
if ($ar_fields = $res->Fetch())
	Header("Location: /novosti/".$ar_fields["CODE"].".php");
?>