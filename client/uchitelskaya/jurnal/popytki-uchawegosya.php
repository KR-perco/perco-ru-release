<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Попытки Учащегося");
$APPLICATION->SetPageProperty("keywords", "Попытки Учащегося");
$APPLICATION->SetPageProperty("description", "Попытки Учащегося");
$APPLICATION->SetTitle("Попытки Учащегося");
?><div id="textBlcok">
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<?
$TEST_ID = htmlentities(strip_tags(trim($_GET['TEST_ID'])));
$STUDENT_ID = htmlentities(strip_tags(trim($_GET['STUDENT_ID'])));
$rsUser = CUser::GetByID($STUDENT_ID);
$arUser = $rsUser->Fetch();
echo '<p><a href="/client/uchitelskaya/">Вернуться к выбору Учащегося</a> | <a href="kursi.php?STUDENT_ID='.$STUDENT_ID.'">Вернуться к выбору Экзамена</a></p>';

echo '<p>Учащийся: '.$arUser["LAST_NAME"].' '.$arUser["NAME"].' '.$arUser["SECOND_NAME"].'</p>';

if (CModule::IncludeModule("learning"))
{
    $res = CTestAttempt::GetList(
        Array("DATE_END" => "DESC"), 
        Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => $TEST_ID, "STUDENT_ID" => $STUDENT_ID)
    );
?>
<table width="100%" border="1" cellspacing="0" cellpadding="4">
			<thead>
				<tr><td>Название теста</td><td>Дата попытки</td><td>Тест пройден</td></tr>
			</thead>
<?
			while ($arAttempt = $res->GetNext())
			{
				$qury = CTest::GetByID($arAttempt["TEST_ID"]);	// получаем данные по тесту
				$arTest = $qury->Fetch();
				if ($arAttempt["COMPLETED"] == 'Y')		// проверка на правильность теста
				{
					$comptest = 'да';
				}
				else
				{
					switch($status = $arAttempt["STATUS"])
					{
						case "F":
							if ($arTest["APPROVED"] == "N")	// смотрим у теста автопроверку
							{
								if (GetUserField("LEARN_ATTEMPT", $arAttempt["ID"], "UF_CORANS") == 1)	// смотрим флаг того сдан тест или нет - после проверки преподавателем
								{
									$comptest = 'нет';
								}
								else
								{
									$comptest = 'На проверке';
								}
							}
							else
							{
								$comptest = 'нет';
							}
							break;
						case "B":
							$comptest = 'нет';
							break;
					}
				}
			
			
			
			
			
	//			if ($arAttempt["COMPLETED"]=="Y") $comptest="да"; else $comptest="нет";
				?>
<? if ($arAttempt["STATUS"]=="F"):?>
<tr><td><a href="testattempt.php?POPITKA_ID=<?=$arAttempt["ID"]?>"><?=$arAttempt["TEST_NAME"]?></a></td><td><?=$arAttempt["DATE_START"]?></td><td><?=$comptest?></td></tr>
<? else:?>
<tr><td><?=$arAttempt["TEST_NAME"]?></a></td><td>Попытка не завершена</td><td><?=$comptest?></td></tr>
<? endif;?>
			<? } ?>
</table>
<? } ?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>