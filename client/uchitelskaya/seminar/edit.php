<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Редактирование семинара", "");
$APPLICATION->SetPageProperty("title", "Редактирование семинара");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Редактирование семинара");

if (stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/seminar/") === false)
	Header("Location: /client/uchitelskaya/seminar/", true, 301);
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p><a href="./">Вернуться к списку семинаров</a></p>
<?
$IBLOCK_ID = 62;
if (isset($_POST) && count($_POST) > 0 && $ID > 0)
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
			"FOR_US_U" =>$_POST["FOR_US_U"],
			"TYPE_SEMINAR" => array("VALUE" => $_POST["TYPE_SEMINAR"]),
		)
	);
	$oElement = new CIBlockElement();
	if ($idElement = $oElement->Update($ID, $arFields))
		echo '<p style="color: green;">Семинар обновлен</p>';
}
?>
	<form name="seminar_form" method="post" action="<?=$_SERVER["REQUEST_URI"];?>">
		<table>
<?
$arFilter = array("ID"=>$ID);
$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_*");
$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
$ar_res = $res->GetNextElement();
$arFields = $ar_res->GetFields();
$arProps = $ar_res->GetProperties();
foreach($arProps as $arValue)
{
	echo "<tr>";
	echo '<td width="170" valign="top">'.$arValue["NAME"]."</td>";
	if ($arValue["PROPERTY_TYPE"] == "L")
	{
		$property_enums = CIBlockPropertyEnum::GetList(Array("DEF"=>"DESC", "SORT"=>"ASC"), Array("IBLOCK_ID"=>$IBLOCK_ID, "CODE"=>$arValue["CODE"]));
		echo '<td><select name="'.$arValue["CODE"];
		if ($arValue["MULTIPLE"] == "Y")
			echo '[]" multiple size="'.intval($property_enums->SelectedRowsCount());
		echo '">';
		while($enum_fields = $property_enums->GetNext())
		{
			if (in_array($enum_fields["ID"], $arValue["VALUE_ENUM_ID"]) || $enum_fields["ID"] == $arValue["VALUE_ENUM_ID"])
				$selected = 'selected="selected"';
			else
				$selected = "";
			echo '<option value="'.$enum_fields["ID"].'" '.$selected.'>'.$enum_fields["VALUE"]."</option>";
		}
		echo "</select></td>";
	}
	else
		echo '<td><input type="text" name="'.$arValue["CODE"].'" value="'.$arValue["VALUE"].'" /></td>';
}
?>
			<tr>
				<td valign="top">Краткое описание (html)</td><td><textarea name="PREVIEW_TEXT" style="width: 650px; height: 100px;"><?=$arFields["PREVIEW_TEXT"];?></textarea></td>
			</tr>
			<tr>
				<td valign="top">План семинара (html)</td><td><textarea name="DETAIL_TEXT" style="width: 650px; height: 350px;"><?=$arFields["DETAIL_TEXT"];?></textarea></td>
			</tr>
		</table>
		<input type="submit" value="Сохранить" name="save">
	</form>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>