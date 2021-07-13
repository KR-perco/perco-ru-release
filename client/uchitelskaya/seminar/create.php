<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Создание семинара", "");
$APPLICATION->SetPageProperty("title", "Создание семинара");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Создание семинара");

if (stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/seminar/") === false)
	Header("Location: /client/uchitelskaya/seminar/", true, 301);
?>
<div id="textBlcok">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p><a href="./">Вернуться к списку семинаров</a></p>
<?
$IBLOCK_ID = 62;
if (isset($_POST) && count($_POST) > 0)
{
	$arFields = array(
		"ACTIVE" => "Y", 
		"IBLOCK_ID" => $IBLOCK_ID,
		"NAME" => $_POST["TOPIC"],
		"PREVIEW_TEXT_TYPE" => "html",
		"PREVIEW_TEXT" => $_POST["PREVIEW_TEXT"],
		"DETAIL_TEXT_TYPE" => "html",
		"DETAIL_TEXT" => $_POST["DETAIL_TEXT"],
		"PROPERTY_VALUES" => array(
			"TIME" => array("VALUE" => $_POST["TIME"]),
			"DURATION" => $_POST["DURATION"],
			"TOPIC" => $_POST["TOPIC"],
			"CITY" => $_POST["CITY"],
			"FOR_US_P" => $_POST["FOR_US_P"],
			"FOR_US_U" => $_POST["FOR_US_U"],
			"TYPE_SEMINAR" => array("VALUE" => $_POST["TYPE_SEMINAR"]),
		)
	);
	$oElement = new CIBlockElement();
	if ($idElement = $oElement->Add($arFields))
		echo '<p style="color: green;">Семинар добавлен</p>';
}
?>
	<form name="seminar_form" method="post" action="<?=$_SERVER["REQUEST_URI"];?>">
		<table>
<?
$properties = CIBlockProperty::GetList(Array("sort"=>"asc"), Array("ACTIVE"=>"Y", "IBLOCK_ID"=>$IBLOCK_ID));
while ($prop_fields = $properties->GetNext())
{
	echo "<tr>";
	echo '<td width="170" valign="top">'.$prop_fields["NAME"]."</td>";
	if ($prop_fields["PROPERTY_TYPE"] == "L")
	{
		$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>$prop_fields["CODE"]));
		echo '<td><select name="'.$prop_fields["CODE"];
		if ($prop_fields["MULTIPLE"] == "Y")
		{
			echo '[]" multiple size="'.(intval($property_enums->SelectedRowsCount())+1).'">';
			echo '<option value="" selected="selected">(не установлено)</option>';
		}
		else
			echo '">';
		while($enum_fields = $property_enums->GetNext())
		{
			echo '<option value="'.$enum_fields["ID"].'">'.$enum_fields["VALUE"]."</option>";
		}
		echo "</select></td>";
	}
	else
		echo '<td><input type="text" name="'.$prop_fields["CODE"].'" /></td>';
}
?>
			<tr>
				<td valign="top">Краткое описание (html)</td><td><textarea name="PREVIEW_TEXT" style="width: 650px; height: 100px;"></textarea></td>
			</tr>
			<tr>
				<td valign="top">План семинара (html)</td><td><textarea name="DETAIL_TEXT" style="width: 650px; height: 350px;"></textarea></td>
			</tr>
		</table>
		<input type="submit" value="Сохранить" name="save">
	</form>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>