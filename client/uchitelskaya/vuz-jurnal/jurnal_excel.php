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
$arrayactive = unserialize(base64_decode($_POST['userActive']));	// массив с id пользователей, которые активны
$arraynoactive = unserialize(base64_decode($_POST['userNoActive']));	// массив с id пользователей, которые активны
$arrTemp = $arrayall;
$studSert = $_POST['students'];	// флаг выбранного или нет элемента для отображения
$arResult = array();
$arResultTmp = array();
$countTd = 0;
$i = 0;
if ($studSert == 1)
{
	foreach($arrayactive as $indexValue)
	{
		while(true)
		{
			if (($tmpValue = array_pop($arrTemp)) == NULL)	// поочередно выдергиваем элементы из промежуточного массива с данными
				break;
			if (in_array($indexValue, $tmpValue))	// смотрим, есть ли в массиве с данными пользователь с сертификатом, если есть - заполняем в промежуточный массив
				$arResultTmp[] = $tmpValue;
		}
		$arrTemp = $arrayall;	// заполняем промежуточный массив всеми данными
	}
	$arResult = array_merge($arResult, $arResultTmp);	// массив с результатами для вывода в таблицу
}
$arResultTmp = array();
if ($studSert == 2)
{
	foreach($arraynoactive as $indexValue)
	{
		while(true)
		{
			if (($tmpValue = array_pop($arrTemp)) == NULL)
				break;
			if (in_array($indexValue, $tmpValue))
				$arResultTmp[] = $tmpValue;
		}
		$arrTemp = $arrayall;
	}
	$arResult = array_merge($arResult, $arResultTmp);
}
$arResultTmp = array();
//echo"<pre>";print_r($arResult);echo"</pre>";
?>
<table class="uchitelskaya_jurnal" width="100%" border="1" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<th id="uchitelskaya_jurnal_td_1" valign="top">Учащийся</th>
			<th id="uchitelskaya_jurnal_td_2" valign="top">ВУЗ</th>
			<th id="uchitelskaya_jurnal_td_4" valign="top">Допуск</th>
			<th id="uchitelskaya_jurnal_td_5" valign="top">Теоретический экзамен</th>
			<th id="uchitelskaya_jurnal_td_6" valign="top">Настройка оборудования</th>
			<th id="uchitelskaya_jurnal_td_7" valign="top">Настройка базы данных</th>
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