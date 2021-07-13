<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Попытки");
$APPLICATION->SetPageProperty("keywords", "Попытки");
$APPLICATION->SetPageProperty("description", "Попытки");
$APPLICATION->SetTitle("Попытки");
?><div id="textBlcok">
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<script type="text/javascript">
function fade(){
	$('#coransw').fadeIn(1000);
}
function fadeoff(){
	$('#coransw').fadeOut(1000);
}
</script>
<?
if (CModule::IncludeModule("learning"))
{
	$arPraktikTest=array(4, 5);
	$arrIDpoit=array();
	$res=array();
	$corans="0";
	$plan = new CTestResult;
	$testattempt = new CTestAttempt;
	$gradebook = new CGradebook;
	$res = CTestAttempt::GetByID($POPITKA_ID);
	if ($arAttempt = $res->GetNext())
	{
		echo '<p><a href="/client/uchitelskaya/vuz-jurnal/">Вернуться к выбору Учащегося</a> | <a href="kursi.php?STUDENT_ID='.$arAttempt["STUDENT_ID"].'">Вернуться к выбору Экзамена</a> | <a href="popytki-uchawegosya.php?TEST_ID='.$arAttempt["TEST_ID"].'&STUDENT_ID='.$arAttempt["STUDENT_ID"].'">Вернуться к выбору попытки</a></p>';
		echo "<p><b>Номер попытки:</b>".$arAttempt["ID"]."; <b>Дата попытки</b>: ".$arAttempt["DATE_START"]."; <b>Название теста</b>: ".$arAttempt["TEST_NAME"]."</p>";
		$ATTEMPT_ID = $arAttempt["ID"];
		$resitem = CTestResult::GetList(
			Array("CORRECT" => "DECS"),
			Array("ATTEMPT_ID" => $ATTEMPT_ID)
		);

		if (in_array($arAttempt["TEST_ID"], $arPraktikTest)) {
			while ($arQuestionPlan = $resitem->GetNext())
			{
				echo html_entity_decode($arQuestionPlan['RESPONSE']);
				$rsFileBD = CFile::GetFileArray(GetUserField("LEARN_ATTEMPT", $arQuestionPlan["ATTEMPT_ID"], "UF_DB_ADD"));

				echo '<p><a href="/upload/'.$rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'].'">Скачать базу</a></p>';
				echo '<form method="POST" name="FEEDBACK_CONTACT" >';
				echo '<input type="submit" name="corecttesty" value="Тест пройден" /> <input type="submit" name="corecttestn" value="Тест не пройден" />';
				echo '</form>';
			}
		}
		else
		{
			echo '
			<form method="POST" name="FEEDBACK_CONTACT" >
			<table width="100%" border="1" cellspacing="0" cellpadding="4">
				<thead style="color:#000;">
					<tr><td>ID Вопроса</td><td>Правильно отвечен</td><td>Подтвердить правильность ответа</td><td>Название вопроса</td><td>Вопрос</td><td>Правильный ответ</td><td>Ответ учащегося</td></tr>
				</thead>';
			echo '<tbody id="coransw" style="display:none;">';
			while ($arQuestionPlan = $resitem->GetNext())
			{
				$arrIDpoit[]=array(ID => $arQuestionPlan["ID"], POINT => $arQuestionPlan["POINT"], CORRECT => $arQuestionPlan["CORRECT"]);
				if ($arQuestionPlan["CORRECT"]=="Y") {
					$color="#dff1d8";
				} elseif($arQuestionPlan["QUESTION_TYPE"]=="T") {
					$color="#b1c2ef";
				} else {
					$color="#eab5b5";
				}
				if (($arQuestionPlan["CORRECT"]=="N")&&($corans=="0")) {echo '</tbody><tbody id="incoransw">'; $corans="1";}
				echo '<tr style="background:'.$color.'"><td>'.$arQuestionPlan["QUESTION_ID"].'</td><td>'.$arQuestionPlan["CORRECT"].'</td>';
				if ($arQuestionPlan["CORRECT"]=="Y") $chekboxY='checked="checked"'; else $chekboxY="";
				echo '<td><input type="checkbox" name="chek'.$arQuestionPlan["ID"].'" '.$chekboxY.' /></td>';
				$chekboxY="";
				echo'<td>'.$arQuestionPlan["QUESTION_NAME"].'</td>';
				$resQ = CLQuestion::GetByID($arQuestionPlan["QUESTION_ID"]);
				if ($arQuestion = $resQ->GetNext())
				{
					echo "<td>".$arQuestion["DESCRIPTION"]."</td>";
				}
				$resAns = CLAnswer::GetList(
					Array("SORT"=>"ASC"),
					Array("QUESTION_ID" => $arQuestionPlan["QUESTION_ID"], "CORRECT" => "Y")
				);
				echo "<td>";
				while ($arAnswer = $resAns->GetNext())
				{
					echo $arAnswer["ANSWER"]."<br>";
				}
				echo "</td>";
				echo "<td>";
					$resTRID = CTestResult::GetByID($arQuestionPlan["ID"]);
					if ($arResultTRID = $resTRID->GetNext())
					{
						if ($arResultTRID["QUESTION_TYPE"]=="T"){
							echo $arResultTRID["RESPONSE"];
						} else {
							$resCLANS = CLAnswer::GetByID($arResultTRID["RESPONSE"]);
							if ($arAnswerCL = $resCLANS->GetNext())
							{
								echo $arAnswerCL["ANSWER"];
							}
						}
					}
				echo "</td>";
				echo '</tr>';
			}
			echo '</tbody>
				</table>
				<br />
				<input type="submit" name="addnav" value="Сохранить" /> <input type="submit" name="delnav" value="Сбросить" /> <input type="submit" name="corecttesty" value="Тест пройден" /> <input type="submit" name="corecttestn" value="Тест не пройден" />
				</form>
				<button onclick="fade()">Отобразить правильные ответы</button> <button onclick="fadeoff()">Скрыть правильные ответы</button>';
		}
	}


	if (isset($_POST['delnav'])) {
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
	if (isset($_POST['addnav'])) {
		for ($i=0; $i<=(count($arrIDpoit)-1); $i++) {
			if($_POST['chek'.$arrIDpoit[$i]["ID"]]=="on")
			{
					$arFields = Array(
						"CORRECT" => "Y",
						"POINT" => 10
					);
					$plan->Update($arrIDpoit[$i]["ID"], $arFields);
			}
			else
			{
					$arFields = Array(
						"CORRECT" => "N",
						"POINT" => 0
					);
					$plan->Update($arrIDpoit[$i]["ID"], $arFields);
			}
		}
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
	if (isset($_POST['corecttesty'])) {
		$arFields = Array(
			"COMPLETED" => "Y"
		);
		$testattempt->Update($arAttempt["ID"], $arFields);
		$JurTest = CGradebook::GetList(
			Array("ID" => "ASC"),
			Array("TEST_ID" => $arAttempt["TEST_ID"],"STUDENT_ID" => $arAttempt["USER_ID"])
		);
		$arJurTest = $JurTest->GetNext();
		$gradebook->Update($arJurTest["ID"], $arFields);
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
	if (isset($_POST['corecttestn'])) {
		$arFields = Array(
			"COMPLETED" => "N"
		);
		$testattempt->Update($arAttempt["ID"], $arFields);
		$JurTest = CGradebook::GetList(
			Array("ID" => "ASC"),
			Array("TEST_ID" => $arAttempt["TEST_ID"],"STUDENT_ID" => $arAttempt["USER_ID"])
		);
		$arJurTest = $JurTest->GetNext();
		$gradebook->Update($arJurTest["ID"], $arFields);
		SetUserField ("LEARN_ATTEMPT", $arAttempt["ID"], "UF_CORANS", "1");
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
}?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>