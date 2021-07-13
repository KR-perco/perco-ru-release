<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Попытки", "");
$APPLICATION->SetPageProperty("title", "Попытки");
$APPLICATION->SetPageProperty("keywords", "Попытки");
$APPLICATION->SetPageProperty("description", "Попытки");
$APPLICATION->SetTitle("Попытки");
?>
<div id="textBlcok">
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
	$ctestclass = new CTest;
	$plan = new CTestResult;
	$testattempt = new CTestAttempt;
	$gradebook = new CGradebook;
	$PORITKA_ID=$_GET[PORITKA_ID];
	$res = CTestAttempt::GetByID($POPITKA_ID);
    if ($arAttempt = $res->GetNext())
    {
		echo '<p><a href="./">Вернуться к выбору Экзамена</a> | <a href="popytki.php?TEST_ID='.$arAttempt["TEST_ID"].'">Вернуться к выбору попытки</a></p>';
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

					}
				} else {
				echo '
				<table width="100%" border="1" cellspacing="0" cellpadding="4">
							<thead style="color:#000;">
								<tr><td>ID Вопроса</td><td>Правильно отвечен</td><td>Название вопроса</td><td>Вопрос</td><td>Правильный ответ</td><td>Ответ учащегося</td></tr>
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
				<button onclick="fade()">Отобразить правильные ответы</button> <button onclick="fadeoff()">Скрыть правильные ответы</button>';
    		}
	}
}?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>