<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<script type="text/javascript" src="/scripts/learning/sortview.js"></script>
<div id="uchitelskaya_form">
	<span style="float:left;">Фильтр:</span><br />
	<form action="#" name="checkform" method="get" enctype="multiple/form-data">
		<select name="type-active">
			<option value="future" selected="selected">Предстоящие</option>
			<option value="past" >Прошедшие</option>
			<option value="old" >Другие</option>
		</select>
	</form>
</div>
<table  class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<td id="jurnal_zayavok_td_1" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />ФИО</td>
			<td id="jurnal_zayavok_td_2" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Дата</td>
			<td id="jurnal_zayavok_td_3" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />E-mail</td>
			<td id="jurnal_zayavok_td_4" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Компания</td>
			<td id="jurnal_zayavok_td_5" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Должность</td>
			<td id="jurnal_zayavok_td_6" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Город</td>
		</tr>
	</thead>
	<tbody>
<?
$arFuture = array(); // Предстоящие семинары, список записавшихся
$arPast = array(); // Прошедшие семинары, список записавшихся
$arOld = array(); // Список записавшихся и их нет в системе
$auto_id = 1;
foreach($arResult["ITEMS"] as $arValue)
{
	if ($arValue["PROPERTIES"]["UID"]["VALUE"] == "")
	{
		$arValue["PROPERTIES"]["UID"]["VALUE"] = "a".$auto_id;
		$auto_id++;
	}
	$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["fio"] = $arValue["PROPERTIES"]["LAST_NAME"]["VALUE"]." ".$arValue["PROPERTIES"]["NAME"]["VALUE"]." ".$arValue["PROPERTIES"]["PATRONYMIC_NAME"]["VALUE"];
	$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["email"] = $arValue["PROPERTIES"]["EMAIL"]["VALUE"];
	$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["company"] = $arValue["PROPERTIES"]["COMPANY"]["VALUE"];
	$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["work_position"] = $arValue["PROPERTIES"]["WORK_POSITION"]["VALUE"];
	$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["city"] = $arValue["PROPERTIES"]["CITY"]["VALUE"];
	// Для фильтра
	// ************************************************
	$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));	// сегодняшняя дата
	$temp_date = strtotime($arValue["PROPERTIES"]["SEMINAR_DATE"]["VALUE"]);
	$DateFetch = mktime(0, 0, 0, date("m", $temp_date), date("d", $temp_date), date("Y", $temp_date));
	$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["date"] = date("Y.m.d", $DateFetch);
	if ($DateFetch>=$today)
		$arStudents[$arValue["PROPERTIES"]["UID"]["VALUE"]]["new"] = "Y";
}
	// ************************************************
foreach($arStudents as $id => $arValue)
{
	if(isset($arValue["new"]))
	{
		$block = "";
		$arFuture[] = $id;
	}
	elseif(is_numeric($id))
	{
		$block = 'style="display: none;"';
		$arPast[] = $id;
	}
	else
		$arOld[] = $id;
?>
		<tr id="<?=$id;?>" <?=$block;?>>
			<td><?if(is_numeric($id)) {?><a href="/client/uchitelskaya/jurnal-zayavok/student.php?ID=<?=$id;?>"><?=$arValue["fio"];?></a><?} else echo $arValue["fio"];?></td>
			<td><?=$arValue["date"];?></td>
			<td><?=$arValue["email"];?></td>
			<td><?=$arValue["company"];?></td>
			<td><?=$arValue["work_position"];?></td>
			<td><?=$arValue["city"];?></td>
		</tr>
<?}?>
	</tbody>
</table>
<script language="javascript" type="text/javascript">
	arFuture = [];
	arFuture = [<?php echo implode(",", $arFuture); ?>];
	arPast = [];
	arPast = [<?php echo implode(",", $arPast); ?>];
	arOld = [];
	arOld = [<?php echo implode(",", $arOld); ?>];
</script>