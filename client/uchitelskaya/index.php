<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Статус экзаменов");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Статус экзаменов");
?>
<style>
.border-r { border-right: 1px solid #000 !important; }
</style>
<script type="text/javascript" src="/scripts/learning/sortview.js"></script>
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
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<?
if (isset($_COOKIE["program"]) && isset($_COOKIE["students"]))
{
	switch($_COOKIE["program"])
	{
		case 1:
		$program_1 = 'selected="selected"';
			break;
		case 2:
		$program_2 = 'selected="selected"';
			break;
		case 3:
		$program_3 = 'selected="selected"';
			break;
	}
	switch($_COOKIE["students"])
	{
		case 1:
			$students_1 = 'selected="selected"';
			break;
		case 2:
			$students_2 = 'selected="selected"';
			break;
		case 3:
			$students_3 = 'selected="selected"';
			break;
		case 4:
			$students_4 = 'selected="selected"';
			break;
	}
}
?>
<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		var program = $('[name = type-program] :selected').val();
		var students = $('[name = students] :selected').val();
		SortStudents($('[name = type-program] :selected').val(), $('[name = students] :selected').val());
		document.getElementById('program').value = $('[name = type-program] :selected').val();
		document.getElementById('students').value = $('[name = students] :selected').val();
		setCookie("program", program, 1);
		setCookie("students", students, 1);
		$("[name = type-program]").change(function(){
			SortStudents($('[name = type-program] :selected').val(), $('[name = students] :selected').val());
			setCookie("program", $('[name = type-program] :selected').val(), 1);
			setCookie("students", $('[name = students] :selected').val(), 1);
			document.getElementById('program').value = $('[name = type-program] :selected').val();
			document.getElementById('students').value = $('[name = students] :selected').val();
		});
		$("[name = students]").change(function(){
			SortStudents($('[name = type-program] :selected').val(), $('[name = students] :selected').val());
			setCookie("program", $('[name = type-program] :selected').val(), 1);
			setCookie("students", $('[name = students] :selected').val(), 1);
			document.getElementById('program').value = $('[name = type-program] :selected').val();
			document.getElementById('students').value = $('[name = students] :selected').val();
		});
	});
</script>
<div id="uchitelskaya_form">
	<span style="float:left;">Фильтр:</span><br />
	<form action="#" name="checkform" method="get" enctype="multiple/form-data">
		<select name="type-program">
			<option value="1" <?=$program_1;?>>АИ</option>
			<option value="2" <?=$program_2;?>>СТП</option>
			<option value="3" <?=$program_3;?>>АС</option>
		</select>
		<select name="students">
			<option value="1" <?=$students_1;?>>Студенты</option>
			<option value="2" <?=$students_2;?>>Студенты с сертификатом</option>
			<option value="3" <?=$students_3;?>>Неактивные студенты</option>
			<option value="4" <?=$students_4;?>>Переаттестация</option>
		</select>
	</form>
	<br />
	<div>
		<span><img width="14" heigth="14" src="/bitrix/images/support/green.gif" alt="Yes" /> Сдан</span>
		<span><img width="14" heigth="14" src="/bitrix/images/support/red.gif" alt="No" /> Не сдан</span>
		<span><img width="14" heigth="14" src="/bitrix/images/support/grey.gif" alt="Check" /> На проверке</span>
	</div>
</div>
<?
$arStudRes = array();
$arUnic=array();
$arActiveUsersAI=array();		// Активные студенты АИ
$arNoActiveUsersAI=array();		// Неактивные студенты АИ
$arUserSertAI=array();			// Есть сертификат АИ
$arUserPereattAI=array();		// Нужна переаттестация АИ
$arActiveUsersSTP=array();		// Активные студенты СТП
$arNoActiveUsersSTP=array();	// Неактивные студенты СТП
$arUserSertSTP=array();			// Есть сертификат СТП
$arUserPereattSTP=array();		// Нужна переаттестация СТП
$arActiveUsersAS=array();		// Активные студенты АС
$arNoActiveUsersAIS=array();	// Неактивные студенты АС
$arUserSertAS=array();			// Есть сертификат АС
$arUserPereattAS=array();		// Нужна переаттестация АС
$arAllUserFields=array();
if (CModule::IncludeModule("learning"))
{
    $res = CGradebook::GetList(
        Array("TEST_ID" => "ASC")
    );
	$qury = CTest::GetList(Array("SORT"=>"ASC"),Array("ACTIVE"=>"Y", "CHECK_PERMISSIONS"=>"N"));	// получаем список с тестами

    while ($arGradebook = $res->GetNext())
    {
		$arUnic[]=$arGradebook["USER_ID"];
		$arUnicTest[$arGradebook["USER_ID"]][]=$arGradebook;
	}
	while ($arTest = $qury->GetNext())
	{
		$arTestApproved[$arTest['ID']] = $arTest['APPROVED'];	// выбираем в тестах значение автопроверки
	}
}
$cnt = count($arUnicTest);	// определяем количество записей с пользователями начавшими хотя бы один тест
$arUnicTest = array_values($arUnicTest);	// преобразуем ключи массива в индексы по порядку
echo '<table class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead>
			<tr>
			<td id="uchitelskaya_jurnal_td_1" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Учащийся</td>
			<td id="uchitelskaya_jurnal_td_2" valign="top" width="200px"><img src="/bitrix/images/icons/up_down.gif" /><br />Компания</td>
			<td id="uchitelskaya_jurnal_td_3" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Дата окончания сертификата</td>
			<td id="uchitelskaya_jurnal_td_4" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ Д</td>
			<td id="uchitelskaya_jurnal_td_5" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ ТЭ</td>
			<td id="uchitelskaya_jurnal_td_6" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ НО</td>
			<td id="uchitelskaya_jurnal_td_7" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ НБД</td>
			<td id="uchitelskaya_jurnal_td_8" valign="top" class="border-r"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ п/а</td>
			<td id="uchitelskaya_jurnal_td_9" valign="top" class="border-r"><img src="/bitrix/images/icons/up_down.gif" /><br />ТП ТЭ</td>
			<td id="uchitelskaya_jurnal_td_11" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />СР</td>
			</tr>
		</thead><tbody>';
for ($i=0; $i < $cnt; $i++)
{
	$rsUser = CUser::GetByID($arUnicTest[$i][0]["USER_ID"]);
	$arUser = $rsUser->Fetch();
	if (!$arUser["UF_VUZ"])
	{
		$rsUserCompany = CUser::GetByID($arUser["WORK_COMPANY"]);
		$arUserCompany = $rsUserCompany->Fetch();
		if ($arUser["ACTIVE"] == "Y")
		{
			$LastHit = strtotime($arUser["LAST_LOGIN"]);	// дата последнего хита
			$lastday = mktime(0, 0, 0, date("m", $LastHit), date("d", $LastHit)+14, date("Y", $LastHit));	// последняя срок активности (срок 9 дней после последней авторизации)
			$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));	// сегодняшняя дата
			if (in_array(18, $arUserCompany["UF_TIP_SERT"]))	// В программе АИ
			{
				if (!$arUser['UF_SERT_D'])
				{
					if ($lastday >= $today)						// проверяем, что срок активности не истек по сравнению с текущей датой
						$arActiveUsersAI[] = $arUser["ID"];		// Активные студенты
					if ($lastday < $today)						// проверяем, что срок активности истек по сравнению с текущей датой
						$arNoActiveUsersAI[] = $arUser["ID"];	// Неактивные студенты
				}
				if ($arUser['UF_SERT_D'])
				{
					$arUserSertAI[] = $arUser["ID"];			// Студенты с сертификатом
					$tmpDate = strtotime($arUser["UF_SERT_DATE"]);
					$endDateSert = mktime(0, 0, 0, date("m", $tmpDate)-1, date("d", $tmpDate), date("Y", $tmpDate)+1);
					$dateSert = date("Y.m.d", $endDateSert);
					if ($endDateSert <= $today)					// Проверяем, что получен сертификат 11 месяцев назад
						$arUserPereattAI[] = $arUser["ID"];		// Студенты с сертификатом
				}
			}
			if (in_array(19, $arUserCompany["UF_TIP_SERT"]))			// В программе СТП
			{
				if (!$arUser['UF_SERT_DATE_TP'])
				{
					if ($lastday >= $today)						// проверяем, что срок активности не истек по сравнению с текущей датой
						$arActiveUsersSTP[] = $arUser["ID"];	// Активные студенты
					if ($lastday < $today)						// проверяем, что срок активности истек по сравнению с текущей датой
						$arNoActiveUsersSTP[] = $arUser["ID"];	// Неактивные студенты
				}
				if ($arUser['UF_SERT_DATE_TP'])
				{
					$arUserSertSTP[] = $arUser["ID"];			// Студенты прошедшие программу
					$tmpDate = strtotime($arUser["UF_SERT_DATE_TP"]);
					$endDateSert = mktime(0, 0, 0, date("m", $tmpDate)-1, date("d", $tmpDate), date("Y", $tmpDate)+1);
					$dateSert = date("Y.m.d", $endDateSert);
					if ($endDateSert <= $today)					// Проверяем, что получен сертификат 11 месяцев назад
						$arUserPereattSTP[] = $arUser["ID"];		// Студенты с сертификатом
				}
			}
			if (in_array(21, $arUserCompany["UF_TIP_SERT"]))	// В программе АС
			{
				if (!$arUser['UF_SERT_D'])
				{
					if ($lastday >= $today)						// проверяем, что срок активности не истек по сравнению с текущей датой
						$arActiveUsersAS[] = $arUser["ID"];		// Активные студенты
					if ($lastday < $today)						// проверяем, что срок активности истек по сравнению с текущей датой
						$arNoActiveUsersAS[] = $arUser["ID"];	// Неактивные студенты
				}
				if ($arUser['UF_SERT_D'])
				{
					$arUserSertAS[] = $arUser["ID"];			// Студенты с сертификатом
					$tmpDate = strtotime($arUser["UF_SERT_DATE"]);
					$endDateSert = mktime(0, 0, 0, date("m", $tmpDate)-1, date("d", $tmpDate), date("Y", $tmpDate)+1);
					$dateSert = date("Y.m.d", $endDateSert);
					if ($endDateSert <= $today)					// Проверяем, что получен сертификат 11 месяцев назад
						$arUserPereattAS[] = $arUser["ID"];		// Студенты с сертификатом
				}
			}
			$rsCompany = CUser::GetByID($arUser["WORK_COMPANY"]);
			$arCompany = $rsCompany->Fetch();
			if ($arUser["UF_SERT_DATE"])
			{
				$tmpDate = strtotime($arUser["UF_SERT_DATE"]);
				$endDateSert = mktime(0, 0, 0, date("m", $tmpDate), date("d", $tmpDate), date("Y", $tmpDate)+1);
				$dateSert = date("Y.m.d", $endDateSert);
			}
			else
				$dateSert = "";
			echo '<tr id="' . $arUnicTest[$i][0]["USER_ID"] . '"';
			echo '><td valign="top"><a href="./jurnal/kursi.php?STUDENT_ID='. $arUnicTest[$i][0]["USER_ID"].'">'.$arUser["LAST_NAME"].' '.$arUser["NAME"].' '.$arUser["SECOND_NAME"].'</a></td><td>'.$arCompany["WORK_COMPANY"].'</td><td>'.$dateSert.'</td>';

			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $arUnicTest[$i][0]["USER_ID"];
			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $arUser["LAST_NAME"] . ' ' .$arUser["NAME"] .' ' . $arUser["SECOND_NAME"];
			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $arCompany["WORK_COMPANY"];
			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $dateSert;

			foreach($arUnicTest[$i] as $arValue)	// просматриваем по каждому пользователю данные о его тестах
			{
				$resCTestAttempt = CTestAttempt::GetList(Array("DATE_END" => "DESC"), Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => $arValue["TEST_ID"], "STUDENT_ID" => $arUnicTest[$i][0]["USER_ID"]));	// выбираем по каждому пользователю попытки прохождения тестов (для просмотра статуса)
				$arAttempt = $resCTestAttempt->GetNext();
				if ($arValue["COMPLETED"] == 'Y')		// проверка на правильность теста
				{
					$resultStr = '<span style="display: none;">0</span><div><img width="14" heigth="14" src="/bitrix/images/support/green.gif" alt="Yes" /></div>';
					$resultStrForExcel = "Сдан";
				}
				else
				{
					switch($status = $arAttempt["STATUS"])
					{
						case "F":
							if ($arTestApproved[$arValue["TEST_ID"]] == "N")	// смотрим у теста автопроверку
							{
								if (GetUserField("LEARN_ATTEMPT", $arAttempt["ID"], "UF_CORANS") == 1)	// смотрим флаг того сдан тест или нет - после проверки преподавателем
								{
									$resultStr = '<span style="display: none;">2</span><div><img width="14" heigth="14"  src="/bitrix/images/support/red.gif" alt="No" /></div>';
									$resultStrForExcel = "Не сдан";
								}
								else
								{
									$resultStr = '<span style="display: none;">1</span><div><img width="14" heigth="14"  src="/bitrix/images/support/grey.gif" alt="Check" /></div>';
									$resultStrForExcel = "На проверке";
								}
							}
							else
							{
								$resultStr = '<span style="display: none;">2</span><div><img width="14" heigth="14"  src="/bitrix/images/support/red.gif" alt="No" /></div>';
								$resultStrForExcel = "Не сдан";
							}
							break;
						case "B":
							$resultStr = ' ';
							$resultStrForExcel = ' ';
							break;
					}
				}
				$resMassTest[$arValue["TEST_ID"]] = $resultStr;
				$resMassTestForExcel[$arValue["TEST_ID"]] = $resultStrForExcel;
				$arTmp[] = $arValue["TEST_ID"];
				$arValue = array();
			}
			for ($j=0;  $j < 7; $j++)
			{
				//$tst_id = array_shift($arTmp);
				$ids = $j+2;
				if ($j == 4 || $j == 5)
					$styleCl = 'class="border-r"';
				else
					$styleCl = "";
				if (in_array($ids, $arTmp))
					echo '<td valign="top"' . $styleCl . '>' . $resMassTest[$ids] . '</td>';
				else
					echo '<td ' . $styleCl . '><span style="display: none;">3</span></td>';
				$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $resMassTestForExcel[$ids];
			}
			$resMassTest = array();
			$resMassTestForExcel = array();
			$arTmp = array();
			$resTbl = '';
			echo '</tr>';
		}
	}
}
echo '</tbody></table>';
$sendArrayAll = base64_encode(serialize($arAllUserFields));
// Блок для АИ в exel
$sendArraySertAI = base64_encode(serialize($arUserSertAI));
$sendArrayUserActiveAI = base64_encode(serialize($arActiveUsersAI));
$sendArrayUserNoActiveAI = base64_encode(serialize($arNoActiveUsersAI));
$sendArrayUserPereattAI = base64_encode(serialize($arUserPereattAI));
// Блок для СТП в exel
$sendArraySertSTP = base64_encode(serialize($arUserSertSTP));
$sendArrayUserActiveSTP = base64_encode(serialize($arActiveUsersSTP));
$sendArrayUserNoActiveSTP = base64_encode(serialize($arNoActiveUsersSTP));
$sendArrayUserPereattSTP = base64_encode(serialize($arUserPereattSTP));
// Блок для АС в exel
$sendArraySertAS = base64_encode(serialize($arUserSertAS));
$sendArrayUserActiveAS = base64_encode(serialize($arActiveUsersAS));
$sendArrayUserNoActiveAS = base64_encode(serialize($arNoActiveUsersAS));
$sendArrayUserPereattAS = base64_encode(serialize($arUserPereattAS));
?>
<!-- Получение и загрузка файла с данными -->
	<div id="form_excel">
		<form action="jurnal_excel.php" name="getexcel" method="post" enctype="multiple/form-data" target="_blank">
			<input type="hidden" name="alldata" value="<? echo $sendArrayAll; ?>" />
			<input type="hidden" name="setificatOkAI" value="<? echo $sendArraySertAI;?>" />
			<input type="hidden" name="userActiveAI" value="<? echo $sendArrayUserActiveAI;?>" />
			<input type="hidden" name="userNoActiveAI" value="<? echo $sendArrayUserNoActiveAI;?>" />
			<input type="hidden" name="userPereattAI" value="<? echo $sendArrayUserPereattAI;?>" />
			<input type="hidden" name="setificatOkSTP" value="<? echo $sendArraySertSTP;?>" />
			<input type="hidden" name="userActiveSTP" value="<? echo $sendArrayUserActiveSTP;?>" />
			<input type="hidden" name="userNoActiveSTP" value="<? echo $sendArrayUserNoActiveSTP;?>" />
			<input type="hidden" name="userPereattSTP" value="<? echo $sendArrayUserPereattSTP;?>" />
			<input type="hidden" name="setificatOkAS" value="<? echo $sendArraySertAS;?>" />
			<input type="hidden" name="userActiveAS" value="<? echo $sendArrayUserActiveAS;?>" />
			<input type="hidden" name="userNoActiveAS" value="<? echo $sendArrayUserNoActiveAS;?>" />
			<input type="hidden" name="userPereattAS" value="<? echo $sendArrayUserPereattAS;?>" />
			<input type="hidden" name="program" id="program" value="" />
			<input type="hidden" name="students" id="students" value="" />
			<input type="submit" value="Получить excel файл" />
		</form>
	</div>

<script language="javascript" type="text/javascript">
	arSertOkAI = [];
	arSertOkAI = [<?php echo implode(",", $arUserSertAI); ?>];
	arUserActiveAI = [];
	arUserActiveAI = [<?php echo implode(",", $arActiveUsersAI); ?>];
	arUserNoActiveAI = [];
	arUserNoActiveAI = [<?php echo implode(",", $arNoActiveUsersAI); ?>];
	arUserPereattAI = [];
	arUserPereattAI = [<?php echo implode(",", $arUserPereattAI); ?>];
	arSertOkSTP = [];
	arSertOkSTP = [<?php echo implode(",", $arUserSertSTP); ?>];
	arUserActiveSTP = [];
	arUserActiveSTP = [<?php echo implode(",", $arActiveUsersSTP); ?>];
	arUserNoActiveSTP = [];
	arUserNoActiveSTP = [<?php echo implode(",", $arNoActiveUsersSTP); ?>];
	arUserPereattSTP = [];
	arUserPereattSTP = [<?php echo implode(",", $arUserPereattSTP); ?>];
	arSertOkAS = [];
	arSertOkAS = [<?php echo implode(",", $arUserSertAS); ?>];
	arUserActiveAS = [];
	arUserActiveAS = [<?php echo implode(",", $arActiveUsersAS); ?>];
	arUserNoActiveAS = [];
	arUserNoActiveAS = [<?php echo implode(",", $arNoActiveUsersAS); ?>];
	arUserPereattAS = [];
	arUserPereattAS = [<?php echo implode(",", $arUserPereattAS); ?>];
</script>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>