<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Студент");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Студент");

$ID = htmlspecialcharsbx(strip_tags(trim($_GET["ID"])));
$block_id = htmlspecialcharsbx(strip_tags(trim($_GET["block_id"])));
$obuch = htmlspecialcharsbx(strip_tags(trim($_GET['obuchenie'])));
$arFilterSpisok = Array("IBLOCK_ID"=>54, "ACTIVE"=>"Y", "PROPERTY_UID"=>$ID);
$arSelectSpisok = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_SEMINAR", "PROPERTY_SEMINAR_DATE","PROPERTY_CONFIRM_TRAINING");
?>
<div id="textBlcok">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p><a href="/client/uchitelskaya/jurnal-zayavok/">Вернуться к списку журнала</a></p>
<?
$resSpisok = CIBlockElement::GetList(Array("PROPERTY_SEMINAR_DATE"=>"ASC"), $arFilterSpisok, false, Array(), $arSelectSpisok);
if (intval($resSpisok->SelectedRowsCount()) > 0)
	echo '<h3>'.$arSpisok["NAME"].'</h3>';
?>
	<table  class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
				<td id="jurnal_zayavok_td_1" valign="top">Название семинара</td>
				<td id="jurnal_zayavok_td_2" valign="top">Дата семинара</td>
				<td id="jurnal_zayavok_td_3" valign="top">Отметка преподавателя</td>
				<td id="jurnal_zayavok_td_4" valign="top">Аванс на тест СЦ</td>
			</tr>
		</thead>
		<tbody>
<?
while($arSpisok = $resSpisok->GetNext())
{
	if ($obuch == 1 && $block_id == $arSpisok["ID"])
	{
		CIBlockElement::SetPropertyValueCode($block_id, "CONFIRM_TRAINING", array("VALUE_ENUM_ID"=>85));
		$obuchenie = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=0">Отменить</a>';
		$obuchenie_avans = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=2">Подтвердить</a>';
	}
	elseif ($obuch == 2 && $block_id == $arSpisok["ID"])
	{
		CIBlockElement::SetPropertyValueCode($block_id, "CONFIRM_TRAINING", array("VALUE_ENUM_ID"=>101));
		$obuchenie = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=1">Подтвердить</a>';
		$obuchenie_avans = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=0">Отменить</a>';
	}
	elseif ($obuch == 0 && $block_id == $arSpisok["ID"])
	{
		CIBlockElement::SetPropertyValueCode($block_id, "CONFIRM_TRAINING", array("VALUE_ENUM_ID"=>" "));
		$obuchenie = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=1">Подтвердить</a>';
		$obuchenie_avans = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=2">Подтвердить</a>';
	}
	elseif ($arSpisok["PROPERTY_CONFIRM_TRAINING_VALUE"] == "Да")
	{
		$obuchenie = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=0">Отменить</a>';
		$obuchenie_avans = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=2">Подтвердить</a>';
	}
	elseif ($arSpisok["PROPERTY_CONFIRM_TRAINING_VALUE"] == "Да (аванс)")
	{
		$obuchenie = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=1">Подтвердить</a>';
		$obuchenie_avans = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=0">Отменить</a>';
	}
	else
	{
		$obuchenie = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=1">Подтвердить</a>';
		$obuchenie_avans = '<a href="?ID='.$ID.'&block_id='.$arSpisok["ID"].'&obuchenie=2">Подтвердить</a>';
	}
?>
			<tr>
				<td><?=$arSpisok["PROPERTY_SEMINAR_VALUE"];?></td>
				<td><?=date("Y.m.d",strtotime($arSpisok["PROPERTY_SEMINAR_DATE_VALUE"]));?></td>
				<td><?=$obuchenie;?></td>
				<td><?=$obuchenie_avans;?></td>
			</tr>
<?}?>
		</tbody>
	</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>