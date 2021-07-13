<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET)
{
	$code = addslashes(strip_tags(trim($_GET['code'])));

	$query = "SELECT ID FROM b_iblock_element WHERE CODE='$code'";
	$result = mysql_query($query) or die("Query failed : " . mysql_error());
	$tmp = mysql_fetch_assoc($result);
	$id=$tmp['ID'];
	$query_ver = "SELECT VALUE FROM b_iblock_element_property WHERE IBLOCK_PROPERTY_ID='252' AND IBLOCK_ELEMENT_ID='$id'";
	$result = mysql_query($query_ver) or die("Query failed : " . mysql_error());
	$version = mysql_fetch_assoc($result);
	echo $version['VALUE'];
}
?>