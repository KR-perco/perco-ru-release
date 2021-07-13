<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if (isset($_POST) && count($_POST) > 0)
{
	foreach($_POST as $key => $value)
	{
		if ($key == "ID" || $key == "IBLOCK_ID")
			continue;
		$PROPERTY_VALUE[] = array(
			"VALUE" => str_replace("_", " ", $key),
			"DESCRIPTION" => strip_tags(trim($value)),
		);
	}
	CIBlockElement::SetPropertyValues($ORDER_ID, strip_tags(trim($_POST["IBLOCK_ID"])), $PROPERTY_VALUE, strip_tags(trim($_POST["ID"])));
}
$zakaz = array();
$arFilter = array("ID"=>$ORDER_ID);
$arSelect = array("ID", "IBLOCK_ID", "NAME","PROPERTY_*");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
$ar_res = $res->GetNextElement();
$arFields = $ar_res->GetProperties();
$APPLICATION->SetPageProperty("title", $arFields["COMPANY"]["VALUE"]);
$APPLICATION->SetTitle($arFields["COMPANY"]["VALUE"]);
?>
<div id="textBlcok">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
for($i=0; $i < count($arFields["ZAKAZ"]["VALUE"]); $i++)
{
	$zakaz[$arFields["ZAKAZ"]["PROPERTY_VALUE_ID"][$i]] = array($arFields["ZAKAZ"]["VALUE"][$i], $arFields["ZAKAZ"]["DESCRIPTION"][$i]);
}
?>
<p><a href="./">Вернуться к списку заказов</a></p>
<? if (isset($_POST) && count($_POST) > 0) echo '<p style="color: green;">Данные обновлены</p>'; ?>
	<form name="order_form" method="post" action="<?=$_SERVER["REQUEST_URI"];?>">
		<input type="hidden" name="ID" value="<?=$arFields["ZAKAZ"]["ID"];?>" />
		<input type="hidden" name="IBLOCK_ID" value="<?=$arFields["ZAKAZ"]["IBLOCK_ID"];?>" />
		<table>
<?
foreach($zakaz as $key => $value)
{
	echo "<tr>";
	echo '<td width="400">'.$value[0].'</td>';
	echo '<td><input type="text" name="'.$value[0].'" value="'.$value[1].'" size="5" /></td>';
	echo "</tr>";
}
?>
		</table>
		<input type="submit" value="Сохранить" />
	</form>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>