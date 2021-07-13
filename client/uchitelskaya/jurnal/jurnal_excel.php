<?
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: application/vnd.ms-excel;charset:UTF-8");
header("Content-Disposition: attachment; filename=students.xls"); 
print "\n"; // Add a line, unless excel error..
$arrayall = unserialize(base64_decode($_POST['alldata']));	// массив со всеми данными
$arraysertAI = unserialize(base64_decode($_POST['setificatOkAI']));	// массив с id пользователей получившими сертификат (прошедшими обучение)
$arrayactiveAI = unserialize(base64_decode($_POST['userActiveAI']));	// массив с id пользователей, которые активны
$arraynoactiveAI = unserialize(base64_decode($_POST['userNoActiveAI']));	// массив с id пользователей, которые неактивны
$arraypereattAI = unserialize(base64_decode($_POST['userPereattAI']));	// массив с id пользователей, которым нужна переаттестация
$arraysertSTP = unserialize(base64_decode($_POST['setificatOkSTP']));	// массив с id пользователей получившими сертификат (прошедшими обучение)
$arrayactiveSTP = unserialize(base64_decode($_POST['userActiveSTP']));	// массив с id пользователей, которые активны
$arraynoactiveSTP = unserialize(base64_decode($_POST['userNoActiveSTP']));	// массив с id пользователей, которые неактивны
$arraypereattSTP = unserialize(base64_decode($_POST['userPereattSTP']));	// массив с id пользователей, которым нужна переаттестация
$arraysertAS = unserialize(base64_decode($_POST['setificatOkAS']));	// массив с id пользователей получившими сертификат (прошедшими обучение)
$arrayactiveAS= unserialize(base64_decode($_POST['userActiveAS']));	// массив с id пользователей, которые активны
$arraynoactiveAS = unserialize(base64_decode($_POST['userNoActiveAS']));	// массив с id пользователей, которые неактивны
$arraypereattAS = unserialize(base64_decode($_POST['userPereattAS']));	// массив с id пользователей, которым нужна переаттестация
$arrTemp = $arrayall;
$program = $_POST['program'];	// Флаг программы
$students = $_POST['students'];	// Флаг студентов
$arResult = array();
$arResultTmp = array();
$countTd = 0;
$i = 0;
if ($program == 1)
{
	switch($students)
	{
		case 1:
			$Massive = $arrayactiveAI;
			break;
		case 2:
			$Massive = $arraysertAI;
			break;
		case 3:
			$Massive = $arraynoactiveAI;
			break;
		case 4:
			$Massive = $arraypereattAI;
			break;
	}
}
if ($program == 2)
{
	switch($students)
	{
		case 1:
			$Massive = $arrayactiveSTP;
			break;
		case 2:
			$Massive = $arraysertSTP;
			break;
		case 3:
			$Massive = $arraynoactiveSTP;
			break;
		case 4:
			$Massive = $arraypereattSTP;
			break;
	}
}
if ($program == 3)
{
	switch($students)
	{
		case 1:
			$Massive = $arrayactiveAS;
			break;
		case 2:
			$Massive = $arraysertAS;
			break;
		case 3:
			$Massive = $arraynoactiveAS;
			break;
		case 4:
			$Massive = $arraypereattAS;
			break;
	}
}
foreach($Massive as $indexValue)
{
	while(true)
	{
		if (($tmpValue = array_pop($arrTemp)) == NULL)	// поочередно выдергиваем элементы из промежуточного массива с данными
		{
			break;
		}
		if (in_array($indexValue, $tmpValue))	// смотрим, есть ли в массиве с данными пользователь с сертификатом, если есть - заполняем в промежуточный массив
		{
			$arResultTmp[] = $tmpValue;
		}
	}
	$arrTemp = $arrayall;	// заполняем промежуточный массив всеми данными
}
$arResult = array_merge($arResult, $arResultTmp);	// массив с результатами для вывода в таблицу
$arResultTmp = array();
//echo"<pre>";print_r($arResult);echo"</pre>";
?>
<table class="uchitelskaya_jurnal" width="100%" border="1" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th id="uchitelskaya_jurnal_td_1" valign="top">Учащийся</th>
			<th id="uchitelskaya_jurnal_td_2" valign="top">Компания</th>
			<th id="uchitelskaya_jurnal_td_3" valign="top">Дата окончания сертификата</th>
			<th id="uchitelskaya_jurnal_td_4" valign="top">Допуск АИ</th>
			<th id="uchitelskaya_jurnal_td_5" valign="top">Теоретический экзамен АИ</th>
			<th id="uchitelskaya_jurnal_td_6" valign="top">Настройка оборудования АИ</th>
			<th id="uchitelskaya_jurnal_td_7" valign="top">Настройка базы данных АИ</th>
			<th id="uchitelskaya_jurnal_td_8" valign="top">Переаттестация АИ</th>
			<th id="uchitelskaya_jurnal_td_9" valign="top">Теоретический экзамен ТП</th>
			<th id="uchitelskaya_jurnal_td_11" valign="top">Тест для сервис-инженеров</th>
		</tr>
	</thead>
	<tbody>
<?
// Формируем ячейки таблицы
foreach($arResult as $arTr)
{
	foreach($arTr as $arTd)
	{
		if ($i == 0)
		{
?>
		<tr id="<?=$arTd?>">
<?
			$i = 1;
		}
		else
		{
?>
			<td valign="top" <?if ($countTd<3) { ?>align="left" <? } else { ?>align="center" <? } ?>><?=$arTd?></td>
<?		}
		$countTd++;
	}
	$i = 0;
	$countTd = 0;
?>
		</tr>
<? } ?>
	</tbody>
</table>