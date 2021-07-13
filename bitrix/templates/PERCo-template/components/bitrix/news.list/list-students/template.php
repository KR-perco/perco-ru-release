<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
global $USER;
$rsUserPrepod= CUser::GetByID($USER->GetID());
$arUserPrepod = $rsUserPrepod->Fetch();
?>
<table  class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead align="center">
		<tr>
			<td>ФИО</td><td>E-mail</td><td>№ группы</td><td>Дата регистрации</td><td></td>
		</tr>
	</thead>
	<tbody>
<?
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $arUserPrepod["ID"],
    "WORK_COMPANY_EXACT_MATCH" => "Y"
);
$select = array(
	"SELECT" => array("UF_N_GROUP")
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей
while($arUser = $rsUsers->Fetch())
{
?>
		<tr>
			<td><a href="edit.php?USER_ID=<?=$arUser["ID"]?>"><?echo $arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]?></a></td>
			<td><?=$arUser["EMAIL"]?></td>
			<td><?=$arUser["UF_N_GROUP"];?></td>
			<td valign="top"><?=date("Y.m.d", strtotime($arUser['DATE_REGISTER']))?></td>
			<td><a href="/client/prepodavatelskaya/list/del.php?USER_ID=<?=$arUser["ID"];?>">Удалить</a></td>
		</tr>
<?}?>
	</tbody>
</table>