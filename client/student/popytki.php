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
<?
$TEST_ID = htmlentities(strip_tags(trim($_GET['TEST_ID'])));
$STUDENT_ID = intval($USER->GetID());
echo '<p><a href="./">Вернуться к выбору Экзамена</a></p>';

if (CModule::IncludeModule("learning"))
{
    $resAttempt = CTestAttempt::GetList(
        Array("DATE_END" => "DESC"), 
        Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => $TEST_ID, "STUDENT_ID" => $STUDENT_ID)
    );
?>
	<table class="learn-gradebook-table data-table">
		<thead>
			<tr><th>Название теста</th><th>Дата попытки</th><th>Тест пройден</th></tr>
		</thead>
<?
			while ($arAttempt = $resAttempt->GetNext())
			{
				$name = '<a href="testattempt.php?POPITKA_ID='.$arAttempt["ID"].'">'.$arAttempt["TEST_NAME"].'</a>';
				$data = $arAttempt["DATE_END"];
				if ($arAttempt["COMPLETED"] == "Y")		// проверка на правильность теста
					$comptest = "да";
				else
				{
					switch($arAttempt["STATUS"])
					{
						case "F":
							$qury = CTest::GetByID($arAttempt["TEST_ID"]);	// получаем данные по тесту
							$arTest = $qury->Fetch();
							if ($arTest["APPROVED"] == "N")	// смотрим у теста автопроверку
							{
								if (GetUserField("LEARN_ATTEMPT", $arAttempt["ID"], "UF_CORANS") == 1)	// смотрим флаг того сдан тест или нет - после проверки преподавателем
									$comptest = "нет";
								else
									$comptest = "На проверке";
							}
							else
								$comptest = "нет";
							break;
						case "B":
							$data = "Попытка не завершена";
							$comptest = "нет";
							break;
					}
				}
?>
		<tr>
			<td><?=$name;?></td>
			<td><?=$data;?></td>
			<td><?=$comptest;?></td></tr>
<? 			} ?>
	</table>
<? } ?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>