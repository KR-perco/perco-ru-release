<?
$folder = $_SERVER["DOCUMENT_ROOT"]."/info_dso/";
$files = scandir($folder);
$filename = "ServiceDepartment_".trim($_REQUEST["number"]).".xml";
if (in_array($filename, $files) && is_numeric(trim($_REQUEST["number"])))
{
	$dso = simplexml_load_file($folder.$filename);
	echo '<div id="form_result"><div class="row"><div>Дата поступления в ремонт</div><div>';
	if ($dso->InfoDSO->PostuplenieVRemont->Data)
		echo date("d.m.Y", strtotime($dso->InfoDSO->PostuplenieVRemont->Data));
	echo '</div></div>';
	$count_zakl = 1;
	$place = "";
	foreach($dso->InfoDSO->ZakluchenieExperta as $result)
	{
		echo '<div class="result">';
		echo '<div class="row"><div>'.$count_zakl.'-е Заключение</div><div>';
		if ($result->Data)
			echo date("d.m.Y", strtotime($result->Data));
		echo '</div></div>';
		echo '<div class="row"><div>Изделие</div><div>'.$result->Product.'</div></div>';
		echo '<div class="row"><div>Статус</div><div>'.$result->Status.'</div></div>';
		echo '<div class="row"><div>Тип</div><div>'.$result->Type.'</div></div>';
		echo '</div>';
		if ($result->Status == "В работе")
			$place = "Ремонтный участок ДСО";
		$count_zakl++;
	}
	echo '<div class="row"><div>Счет за ремонт</div><div>'.$dso->InfoDSO->Schet->Status.'</div></div>';
	echo '<div class="row"><div>Место нахождения</div><div>';
	if ($dso->InfoDSO->Mestonahozhdenie->Status)
		echo $dso->InfoDSO->Mestonahozhdenie->Status.' ';
	else
		echo $place;
	if ($dso->InfoDSO->Mestonahozhdenie->Data)
		echo date("d.m.Y", strtotime($dso->InfoDSO->Mestonahozhdenie->Data));
	echo '</div></div>';
	echo '<div class="row"><div>Отгрузка</div><div>';
	if ($dso->InfoDSO->Otgruzka->Data)
		echo date("d.m.Y", strtotime($dso->InfoDSO->Otgruzka->Data));
	else
		echo "Не произведена";
	echo '</div></div></div>';
}
else
	echo '<div id="form_result">Обращение не найдено</div>';
?>