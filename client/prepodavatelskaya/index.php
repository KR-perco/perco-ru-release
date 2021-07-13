<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Журнал");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Журнал");

if (isset($_COOKIE["students"]))
{
	switch($_COOKIE["students"])
	{
		case 1:
			$students_1 = 'selected="selected"';
			break;
		case 2:
			$students_2 = 'selected="selected"';
			break;
	}
}
?>
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

<script language="javascript" type="text/javascript">
	$(document).ready(function(){
		var students = $('[name=students] :selected').val();
		SortVuz(students);
		document.getElementById('students').value = $('[name=students] :selected').val();
		setCookie("students", students, 1);
		$("[name = students]").change(function(){
			SortVuz($('[name=students] :selected').val());
			setCookie("students", $('[name=students] :selected').val(), 1);
			document.getElementById('students').value = $('[name=students] :selected').val();
		});
	});
</script>
<div id="uchitelskaya_form">
	<form action="#" name="checkform" method="get" enctype="multiple/form-data">
		<select name="students">
			<option value="1" <?=$students_1;?>>Студенты</option>
			<option value="2" <?=$students_2;?>>Неактивные студенты</option>
		</select>
    </form>
	<span><img width="14" heigth="14" src="/bitrix/images/support/green.gif" alt="Yes" /> Сдан</span>
	<span><img width="14" heigth="14" src="/bitrix/images/support/red.gif" alt="No" /> Не сдан</span>
	<span><img width="14" heigth="14" src="/bitrix/images/support/grey.gif" alt="Check" /> На проверке</span>
</div>
<?
$arStudRes = array();
$arActiveUsers=array();
$arNoActiveUsers=array();
$arUserSertID=array();
$arAllUserFields=array();
if (CModule::IncludeModule("learning"))
{
	$res = CGradebook::GetList(Array("TEST_ID" => "ASC"), Array("<TEST_ID" => 6));
	$qury = CTest::GetList(Array("SORT"=>"ASC"),Array("ACTIVE"=>"Y", "CHECK_PERMISSIONS"=>"N"));	// получаем список с тестами

	while ($arGradebook = $res->GetNext())
	{
		$arUnicTest[$arGradebook["USER_ID"]][]=$arGradebook;
	}
	while ($arTest = $qury->GetNext())
	{
		$arTestApproved[$arTest['ID']] = $arTest['APPROVED'];	// выбираем в тестах значение автопроверки
	}
}
$cnt = count($arUnicTest);	// определяем количество записей с пользователями начавшими хотя бы один тест
$arNumTest = array(2 => '<td></td>', 3 => '<td></td>', 4 => '<td></td>', 5 => '<td></td>');	// для формирования ячеек таблицы с тестами
$arUnicTest = array_values($arUnicTest);	// преобразуем ключи массива в индексы по порядку
$Prepod_ID = intval($USER->GetID());
echo '<table class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead>
			<td id="uchitelskaya_jurnal_td_1" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Учащийся</td>
			<td id="uchitelskaya_jurnal_td_2" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />№ группы</td>
			<td id="uchitelskaya_jurnal_td_4" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Допуск</td>
			<td id="uchitelskaya_jurnal_td_5" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Теоретический экзамен</td>
			<td id="uchitelskaya_jurnal_td_6" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Настройка оборудования</td>
			<td id="uchitelskaya_jurnal_td_7" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Настройка базы данных</td></tr>
		</thead><tbody>';
	for ($i=0; $i < $cnt; $i++)
	{
		$rsUsers= CUser::GetByID($arUnicTest[$i][0]["USER_ID"]);
		$arUser = $rsUsers->Fetch();
		if ($arUser["WORK_COMPANY"] == $Prepod_ID)
		{
			$LastHit = strtotime($arUser["LAST_LOGIN"]);	// дата последнего хита
			$lastday = mktime(0, 0, 0, date("m", $LastHit)+6, date("d", $LastHit), date("Y", $LastHit));	// последняя срок активности (срок 9 дней после последней авторизации)
			$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));	// сегодняшняя дата
			if ($lastday >= $today)						// проверяем, что срок активности не истек по сравнению с текущей датой
				$arActiveUsers[] = $arUser["ID"];		// Активные студенты
			elseif ($lastday < $today)					// проверяем, что срок активности истек по сравнению с текущей датой
				$arNoActiveUsers[] = $arUser["ID"];		// Неактивные студенты
			echo '<tr id="' . $arUnicTest[$i][0]["USER_ID"] . '"';
			echo '><td valign="top"><a href="./jurnal/kursi.php?STUDENT_ID='. $arUnicTest[$i][0]["USER_ID"].'">'.$arUser["LAST_NAME"].' '.$arUser["NAME"].' '.$arUser["SECOND_NAME"].'</a></td><td>'.$arUser["UF_N_GROUP"].'</td>';
			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $arUnicTest[$i][0]["USER_ID"];
			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $arUser["LAST_NAME"] . ' ' .$arUser["NAME"] .' ' . $arUser["SECOND_NAME"];
			$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $arUser["UF_N_GROUP"];
			foreach($arUnicTest[$i] as $arValue)	// просматриваем по каждому пользователю данные о его тестах
			{
				$resultStr = " ";
				$resultStrForExcel = " ";
				$resCTestAttempt = CTestAttempt::GetList(Array("DATE_END" => "DESC"), Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => $arValue["TEST_ID"], "STUDENT_ID" => $arUnicTest[$i][0]["USER_ID"]));	// выбираем по каждому пользователю попытки прохождения тестов (для просмотра статуса)

				$arAttempt = $resCTestAttempt->GetNext();

				if ($arValue["COMPLETED"] == 'Y')		// проверка на правильность теста
				{
					$resultStr = '<span style="display: none;">0</span><div><img width="14" heigth="14" src="/bitrix/images/support/green.gif" alt="Yes" /></div>';
					$resultStrForExcel = "Сдан";
				}
				else
				{
					switch($arAttempt["STATUS"])
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
							$resultStr = " ";
							$resultStrForExcel = " ";
							break;
					}
				}
				$resMassTest[$arValue["TEST_ID"]] = $resultStr;
				$resMassTestForExcel[$arValue["TEST_ID"]] = $resultStrForExcel;
				$arTmp[] = $arValue["TEST_ID"];
				$arValue = array();
			}
			ksort($arTmp);
			reset($arTmp);
			for ($j=0;  $j < 4; $j++)
			{
				$ids = $j+2;
				if (in_array($ids, $arTmp))
				{
					$resTbl[$ids] = '<td valign="top">' . $resMassTest[$ids] . '</td>';
					$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = $resMassTestForExcel[$ids];
				}
				else
				{
					$resTbl[$ids] = "<td></td>";
					$arAllUserFields[$arUnicTest[$i][0]["USER_ID"]][] = " ";
				}

			}
			echo implode($resTbl);
			$resMassTest = array();
			$resMassTestForExcel = array();
			$arTmp = array();
			$resTbl = "";
			echo '</tr>';
		}
	}
//}
echo '</tbody></table>';
$sendArrayAll = base64_encode(serialize($arAllUserFields));
$sendArrayUserActive = base64_encode(serialize($arActiveUsers));
$sendArrayUserNoActive = base64_encode(serialize($arNoActiveUsers));
?>
<!-- Получение и загрузка файла с данными -->
	<div id="form_excel" style="position: absolute; top: 565px; left: 300px;">
		<form action="jurnal/jurnal_excel.php" name="getexcel" method="post" enctype="multiple/form-data" target="_blank">
			<input type="hidden" name="alldata" value="<? echo $sendArrayAll; ?>" />
			<input type="hidden" name="userActive" value="<? echo $sendArrayUserActive;?>" />
			<input type="hidden" name="userNoActive" value="<? echo $sendArrayUserNoActive;?>" />
			<input type="hidden" name="students" id="students" value="" />
			<input type="submit" value="Получить excel файл" />
		</form>
	</div>

<script language="javascript" type="text/javascript">
	arUserActive = [];
	arUserActive = [<?php echo implode(",", $arActiveUsers); ?>];
	arUserNoActive = [];
	arUserNoActive = [<?php echo implode(",", $arNoActiveUsers); ?>];
</script>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>