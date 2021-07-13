<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Курсы");
$APPLICATION->SetPageProperty("keywords", "Курсы");
$APPLICATION->SetPageProperty("description", "Курсы");
$APPLICATION->SetTitle("Курсы");
?><div id="textBlcok">
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<?
function cmp_c($a, $b)
{
return strcmp($a["DATE_END"], $b["DATE_END"]);
}
$STUDENT_ID = $_GET[STUDENT_ID];
$rsUser = CUser::GetByID($STUDENT_ID);
$arUser = $rsUser->Fetch();
echo '<p><a href="/client/uchitelskaya/">Вернуться к выбору Учащегося</a></p>';
echo '<div';
echo '<p style="margin-top: 20px;">Свидетельсвто сгенерируется при условии выполнения всех требований</p>';
echo '<ul><li>Авторизованный инсталлятор: <a href="/createpdf/check_user.php?ID='.$STUDENT_ID.'&CERT=AI">Сгенерировать</a>.</li>';
echo '<li>Менеджер по продажам: <a href="/createpdf/check_user.php?ID='.$STUDENT_ID.'&CERT=TP">Сгенерировать</a>.</li>';
echo '<li>Специалист сервисного центра: <a href="/createpdf/check_user.php?ID='.$STUDENT_ID.'&CERT=SC">Сгенерировать</a>.</li></ul>';
echo '</div>';
echo '<p>Учащийся: '.$arUser["LAST_NAME"].' '.$arUser["NAME"].' '.$arUser["SECOND_NAME"].'</p>';
$resTest=array();
$finmas=array();
if (CModule::IncludeModule("learning"))
{
    $res = CTestAttempt::GetList(
        Array("DATE_END" => "DESC"), 
        Array("CHECK_PERMISSIONS" => "N", "STUDENT_ID" => $STUDENT_ID)
    );
	while ($arAttempt = $res->GetNext())
    {		
		$resTest[]=array('TEST_ID' => $arAttempt["TEST_ID"], 'USER_ID' => $arAttempt["USER_ID"], 'TEST_NAME' => $arAttempt["TEST_NAME"]);
	}
}
foreach($resTest as $arRes):
	if (!in_array($arRes, $finmas)) {
		$finmas[]=$arRes;
	}
endforeach;
echo '<table width="100%" border="1" cellspacing="0" cellpadding="4">
		<thead>
			<tr><td>Курс</td><td>Название теста</td><td>Дата последнего теста</td><td>Количество тестов</td></tr>
		</thead>';
		foreach($finmas as $arRes)
		{
			$res = CTestAttempt::GetList(
				Array("DATE_END" => "DESC"), 
				Array("CHECK_PERMISSIONS" => "N", "STUDENT_ID" => $STUDENT_ID, "TEST_ID" => $arRes["TEST_ID"])
			);
			while ($arAttempt = $res->GetNext())
			{
				$resMass[]=$arAttempt;
			}
			$counPop=count($resMass);
			if ($arRes["TEST_ID"] >= 2 && $arRes["TEST_ID"] <= 6)
				$kurs = "АИ";
			elseif ($arRes["TEST_ID"] == 7)
				$kurs = "СТП";
			echo '<tr><td>'.$kurs.'</td><td><a href="popytki-uchawegosya.php?TEST_ID='.$arRes["TEST_ID"].'&STUDENT_ID='.$arRes["USER_ID"].'">'.$arRes["TEST_NAME"].'</a></td><td><a href="testattempt.php?POPITKA_ID='.$resMass[0]["ID"].'">'.$resMass[0]["DATE_END"].'</a></td><td>'.$counPop.'</td></tr>';
			$resMass=array();
			$kurs = "";
		}
echo '</table>';?>
	</div>
	<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>