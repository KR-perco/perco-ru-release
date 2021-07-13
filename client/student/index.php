<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Экзамены");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Экзамены");
?>
<div class="dop_menu">
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_dop_menu", 
	array(
		"ROOT_MENU_TYPE" => "podmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>
<div id="content"> 
	<h1> <?$APPLICATION->ShowTitle(false, false)?></h1>
<?
$STUDENT_ID = intval($USER->GetID());
if ($_POST && $_POST["soglasen"] == 1)
	SetUserField ("USER", $STUDENT_ID, "UF_SOGLASIE", "1");
if (GetUserField("USER", $STUDENT_ID, "UF_SOGLASIE"))
{
	$rsUser = CUser::GetByID($STUDENT_ID);
	$arUser = $rsUser->Fetch();
	if (CModule::IncludeModule("learning"))
	{
		global $USER;
		$testBlockOk = 0;
		$dopuskPer_AI = false;
		$dopusk_SC = false;
		$obuchenie = "";
		$vuz = false;
		$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-3, date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($endSertDate <= $today)
			$dopuskPer_AI = true;
		if ($arUser["UF_SERT_D"] || $arUser["UF_SERT_TP"])
		{
			// Сертификат инсталлятора/администратора
			if ($arUser["UF_SERT_D"])
			{
				$arFile = CFile::GetFileArray($arUser["UF_SERT_D"]);
				$arSET = $arFile["SRC"];
				$fSize='('.printFileInfo($_SERVER['DOCUMENT_ROOT'].$arFile["SRC"], 'size').')&nbsp;';
			}
			//***********************
			// Сертификат менеджера
			if ($arUser["UF_SERT_TP"])
			{
				$arFile = CFile::GetFileArray($arUser["UF_SERT_TP"]);
				$arSETM = $arFile["SRC"];
				$fSizeM='('.printFileInfo($_SERVER['DOCUMENT_ROOT'].$arFile["SRC"], 'size').')&nbsp;';
			}
			//***********************
?>
	<p>Вы успешно прошли курс обучения.</p>
<?if ($arUser["UF_SERT_D"]) {?>
	<p><a target="_blank" href="<?=$arSET;?>"><img width="20" align="top" height="16" class="png" alt="PDF" src="/images/icons/pdf.png"></a> <a target="_blank" href="<?=$arSET;?>">Скачать сертификат</a> <span class="docinfo"><?=$fSize;?></span></p>
<?}?>
<?if ($arUser["UF_SERT_TP"]) {?>
	<p><a target="_blank" href="<?=$arSETM;?>"><img width="20" align="top" height="16" class="png" alt="PDF" src="/images/icons/pdf.png"></a> <a target="_blank" href="<?=$arSETM;?>">Скачать сертификат Менеджера</a> <span class="docinfo"><?=$fSizeM;?></span></p>
<?}?>
<?
		}
		else
			echo '<p>Свидетельство будет доступно для скачивания через 24 часа после успешного прохождения последнего экзамена.</p>';
		$arFilterSpisok = Array("IBLOCK_ID"=>54, "ACTIVE"=>"Y", "PROPERTY_UID"=>$arUser["ID"],"?PROPERTY_CONFIRM_TRAINING_VALUE"=>"Да","PROPERTY_SEMINAR"=>"Сервис и ремонт");
		$arSelectSpisok = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM","PROPERTY_SEMINAR_DATE");
		$resSpisok = CIBlockElement::GetList(Array("PROPERTY_SEMINAR_DATE"=>"ASC"), $arFilterSpisok, false, Array(), $arSelectSpisok);
		$count_seminar = intval($resSpisok->SelectedRowsCount());
		while($arSpisok = $resSpisok->GetNext())
		{
			$data = strtotime($arSpisok["PROPERTY_SEMINAR_DATE_VALUE"]);
			$data = mktime(0, 0, 0, date("m", $data), date("d", $data), date("Y", $data)+1);
			if ($data >= $today)
			{
				$dopusk_SC = true;
				break;
			}
		}
		$rsUserCompany = CUser::GetByID($arUser["WORK_COMPANY"]);
		$arUserCompany = $rsUserCompany->Fetch();
		$arGroups = CUser::GetUserGroup($arUserCompany["ID"]);
		if ($arUserCompany["UF_PAI"] == "Подтверждено" || $arUserCompany["UF_PAS"] == "Подтверждено")
			$obuchenie = "Полное";
		elseif ($arUserCompany["UF_PAI"] != "" || $arUserCompany["UF_PAS"] != "")
			$obuchenie = "Начальное";
		if (in_array(26, $arGroups))
		{
			$obuchenie = "Полное";
			$vuz = true;
		}
?>
	<table class="learn-gradebook-table data-table">
		<tr>
			<th>Курс</th>
			<th>Название</th>
			<th style="width:90px">Действия</th>
		</tr>
<?
		$resTest = CTest::GetList(Array("SORT"=>"ASC"),Array("ACTIVE"=>"Y", "CHECK_PERMISSIONS"=>"N"));
		while ($arTest = $resTest->GetNext())
		{
			$test_visible = false;
			$status = "Начать";
			$message = "";
			$name = "";
			$TEST_ID = $arTest["ID"];
			$resCGradebook = CGradebook::GetList(Array("ID" => "DESC"),  Array("TEST_ID" =>$TEST_ID, "STUDENT_ID" => $STUDENT_ID));
			if (intval($resCGradebook->SelectedRowsCount()) > 0)
				$name = '<a href="/client/student/popytki.php?TEST_ID='.$arTest["ID"].'">'.$arTest["NAME"].'</a>';
			else
				$name = $arTest["NAME"];
			if ($arGradebook = $resCGradebook->Fetch())
			{
				if ($arGradebook["COMPLETED"] == "Y")
				{
					$status = "Сдан";
					if ($TEST_ID >= 2 && $TEST_ID <= 5)
						$testBlockOk++;
				}
				else
				{
					$resCTestAttempt = CTestAttempt::GetList(Array("ID"=>"DESC"), Array("TEST_ID" => $TEST_ID, "STUDENT_ID" => $STUDENT_ID));
					$arCTestAttempt = $resCTestAttempt->Fetch();
					if ($arTest["TIME_LIMIT"] > 0 && $arTest["TIME_LIMIT"]*60 < time()-MakeTimeStamp($arCTestAttempt["DATE_START"]) && $arCTestAttempt["STATUS"] == "B")
					{
						$oTestAttempt = new CTestAttempt;
						$oTestAttempt->AttemptFinished($arCTestAttempt["ID"]);
						$status = "Начать заново";
						$message = "<br /><em>Предыдущая попытка не завершена вовремя<em>";
					}
					elseif ($arCTestAttempt["STATUS"] == "B")
						$status = "Продолжить";
					elseif ($arCTestAttempt["STATUS"] == "F" && $arTest["APPROVED"]=='N' && GetUserField("LEARN_ATTEMPT", $arCTestAttempt["ID"], "UF_CORANS") != 1)
						$status = "На проверке";
				}
			}
			switch($TEST_ID)
			{
				case 2:
				case 4:
					if ((in_array(18,$arUserCompany["UF_TIP_SERT"]) || in_array(21,$arUserCompany["UF_TIP_SERT"])) && $obuchenie == "Начальное")
						$test_visible = true;
				case 3:
				case 5:
					if ((in_array(18,$arUserCompany["UF_TIP_SERT"]) || in_array(21,$arUserCompany["UF_TIP_SERT"])) && $obuchenie == "Полное")
						$test_visible = true;
					if ($vuz)
						$test_visible = true;
				case 6:
					$kurs = "Авторизованный инсталлятор / Администратор систем";
					if ($testBlockOk == 4 && $dopuskPer_AI)
						$test_visible = true;
					if ($vuz)
						continue;
					break;
				case 7:
					$kurs = "Сертифицированный торговый партнер";
					if ($arUserCompany["UF_PTP"] == "Подтверждено" && in_array(19,$arUserCompany["UF_TIP_SERT"]))
						$test_visible = true;
					break;
				case 8:
					$kurs = "Сервисный центр";
					//if ($arUserCompany["UF_SC"] && ($dopusk_SC || $count_seminar >= 1))
					if ($arUserCompany["UF_SC"] && $count_seminar >= 1)
						$test_visible = true;
					break;
			}
			if ($test_visible)
			{
				if ($status != "На проверке" && $status != "Сдан")
					$status = '<a href="/client/student/ekzamens.php?COURSE_ID='.$arTest["COURSE_ID"].'&TEST_ID='.$TEST_ID.'">'.$status.'</a>';
?>
		<tr>
			<td><?=$kurs;?></td>
			<td><?=$name;?><?=$message;?></td>
			<td><?=$status;?></td>
		</tr>
<?
			}
		}
?>
		</table>
<?
	}
}
else
{
?>
	<h2>СОГЛАСИЕ <span style="text-transform: lowercase;">на обработку персональных данных</span></h2>
	<p>Я, <?=$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"];?>, в соответствии с п. 4 ст. 9 Федерального закона от 27.07.2006 №152-ФЗ "О персональных данных" даю согласие ООО «ПЭРКО», ОРГН 1107847252611, находящемуся по адресу: 194021, г. Санкт-Петербург, ул. Политехническая, д. 4, корпус 2, строение 1, на обработку моих персональных данных, а именно: размещение в общем доступе на сайте perco.ru моих персональных данных: фамилия, имя, отчество, телефон, e-mail, место работы, должность, то есть на совершение   действий, предусмотренных п. 3 ст. 3 Федерального закона от 27.07.2006 №152-ФЗ "О персональных данных", в целях предоставления возможности  для пользователей выбрать  специалиста  в своем регионе для  работы с системами PERCo.<br />Настоящее согласие действует со дня прочтения и подтверждения.</p>
	<form enctype="multipart/form-data" method="POST" action="<?$_SERVER["PHP_SELF"]?>" name="soglasie">
		<input type="hidden" value="1" name="soglasen">
		<input type="submit" value="Согласен">
	</form>
<? }?>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>