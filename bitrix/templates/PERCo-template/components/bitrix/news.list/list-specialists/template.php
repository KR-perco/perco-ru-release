<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
global $USER;
$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
$rsUserCompany = CUser::GetByID($USER->GetID());
$arUserCompany = $rsUserCompany->Fetch();
if (in_array(18,$arUserCompany["UF_TIP_SERT"]) && in_array(19,$arUserCompany["UF_TIP_SERT"]))
	$col = 6;
elseif (in_array(18,$arUserCompany["UF_TIP_SERT"]))
	$col = 3;
elseif (in_array(19,$arUserCompany["UF_TIP_SERT"]))
	$col = 3;
if ($arUserCompany["UF_SC"])
	$col += 3;
if (!in_array(21,$arUserCompany["UF_TIP_SERT"]))
	$row = 3;
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $arUserCompany["ID"],
    "WORK_COMPANY_EXACT_MATCH" => "Y"
);
$select = array(
	"SELECT" => array("UF_SERT_D", "UF_SERT_DATE", "UF_SERT_TP", "UF_SERT_DATE_TP", "UF_SERT_SC", "UF_SERT_DATE_SC")
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей
if (intval($rsUsers->SelectedRowsCount()) > 0)
{
?>
<table  class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead align="center">
		<tr>
			<td rowspan="<?=$row;?>">ФИО</td><td rowspan="<?=$row;?>">Дата последнего очного обучения</td><?if(!in_array(21,$arUserCompany["UF_TIP_SERT"]) && $arUserCompany["UF_TIP_SERT"]) {?><td colspan="<?=$col;?>">Сертификация по программе</td><?} elseif ($arUserCompany["UF_TIP_SERT"]) { ?><td>Дата окончания свидетельства</td><td>Переаттестация</td><td>Свидетельство</td><?}?><td rowspan="<?=$row;?>"></td>
		</tr>
<?	if (!in_array(21,$arUserCompany["UF_TIP_SERT"])) {?>
		<tr>
			<?if(in_array(18,$arUserCompany["UF_TIP_SERT"])) {?><td colspan="3">Авторизованный инсталлятор</td><?}?>
			<?if(in_array(19,$arUserCompany["UF_TIP_SERT"])) {?><td colspan="3">Торговый партнер</td><?}?>
			<?if($arUserCompany["UF_SC"]) {?><td colspan="3">Сервис и ремонт</td><?}?>
		</tr>
		<tr>
			<?if(in_array(18,$arUserCompany["UF_TIP_SERT"])) {?><td>Дата окончания свидетельства</td><td>Переаттестация</td><td>Свидетельство</td><?}?>
			<?if(in_array(19,$arUserCompany["UF_TIP_SERT"])) {?><td>Дата окончания свидетельства</td><td>Переаттестация</td><td>Свидетельство</td><?}?>
			<?if($arUserCompany["UF_SC"]) {?><td>Дата окончания свидетельства</td><td>Переаттестация</td><td>Свидетельство</td><?}?>
		</tr>
<?	 } ?>
	</thead>
	<tbody>
<?
	while($arUser = $rsUsers->GetNext())
	{
		$dataAI = "";
		$sertAI = "";
		$attestAI = "";
		$dataTP = "";
		$sertTP = "";
		$attestTP = "";
		$dataSC = "";
		$attestSC = "";
		$sertSC = "";
		$dataObuch = "";
		if ($arUser["UF_SERT_DATE"])
		{
			$getSertificat = strtotime($arUser["UF_SERT_DATE"]);
			$dataAI = date("d.m.Y", mktime(0, 0, 0, date("m", $getSertificat), date("d", $getSertificat), date("Y", $getSertificat)+1));
			if ($arUser["UF_SERT_D"])
			{
				$arFile = CFile::GetFileArray($arUser["UF_SERT_D"]);
				$sertAI='<a href="'.$arFile["SRC"].'"  target="_blank">Скачать</a>';
			}
			else
				$attestAI = "требуется переаттестация";
		}
		if ($arUser["UF_SERT_DATE_TP"])
		{
			$getSertificat = strtotime($arUser["UF_SERT_DATE_TP"]);
			$dataTP = date("d.m.Y", mktime(0, 0, 0, date("m", $getSertificat), date("d", $getSertificat), date("Y", $getSertificat)+1));
			if ($arUser["UF_SERT_TP"])
			{
				$arFile = CFile::GetFileArray($arUser["UF_SERT_TP"]);
				$sertTP='<a href="'.$arFile["SRC"].'"  target="_blank">Скачать</a>';
			}
			else
				$attestTP = "требуется переаттестация";
		}
		if ($arUser["UF_SERT_DATE_SC"])
		{
			$getSertificat = strtotime($arUser["UF_SERT_DATE_SC"]);
			$dataSC = date("d.m.Y", mktime(0, 0, 0, date("m", $getSertificat), date("d", $getSertificat), date("Y", $getSertificat)+1));
			if ($arUser["UF_SERT_SC"])
			{
				$arFile = CFile::GetFileArray($arUser["UF_SERT_SC"]);
				$sertSC='<a href="'.$arFile["SRC"].'"  target="_blank">Скачать</a>';
			}
			else
				$attestSC = "требуется переаттестация";
		}
		$arFilterSpisok = Array("IBLOCK_ID"=>54, "ACTIVE"=>"Y", "PROPERTY_UID"=>$arUser["ID"],"PROPERTY_CONFIRM_TRAINING_VALUE"=>"Да");
		$arSelectSpisok = Array("ID", "PROPERTY_SEMINAR_DATE");
		$resSpisok = CIBlockElement::GetList(Array("PROPERTY_SEMINAR_DATE"=>"DESC"), $arFilterSpisok, false, Array(), $arSelectSpisok);
		if ($arSpisok = $resSpisok->Fetch())
			$dataObuch = $arSpisok["PROPERTY_SEMINAR_DATE_VALUE"];
?>
		<tr>
			<td><a href="/client/company/list/about-user.php?USER_ID=<?=$arUser["ID"]?>"><?echo $arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"]?></a></td>
			<td><?=$dataObuch;?></td>
<?
		if (in_array(18,$arUserCompany["UF_TIP_SERT"]) || in_array(21,$arUserCompany["UF_TIP_SERT"]))
		{
?>
			<td><?=$dataAI;?></td>
			<td><?=$attestAI;?></td>
			<td><?=$sertAI;?></td>
<?
		}
		if (in_array(19,$arUserCompany["UF_TIP_SERT"]))
		{
?>
			<td><?=$dataTP;?></td>
			<td><?=$attestTP;?></td>
			<td><?=$sertTP;?></td>
<?
		}
		if($arUserCompany["UF_SC"])
		{
?>
			<td><?=$dataSC;?></td>
			<td><?=$attestSC;?></td>
			<td><?=$sertSC;?></td>
<?		}?>
			<td><a href="/client/company/list/edit.php?USER_ID=<?=$arUser["ID"]?>">Редактировать</a><br /><br /><a href="/client/company/list/del.php?USER_ID=<?=$arUser["ID"];?>">Удалить</a></td>
		</tr>
<?	} ?>
	</tbody>
</table>
<? } ?>