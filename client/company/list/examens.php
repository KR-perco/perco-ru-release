<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
?>
<div id="textBlcok">
	<h1>
<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
$rsUser = CUser::GetByID($USER_ID);
$arUser = $rsUser->Fetch();
echo '<p>Сотрудник: '.$arUser["LAST_NAME"].' '.$arUser["NAME"].' '.$arUser["SECOND_NAME"].'</p>';
	echo '<p><a href="/client/company/">Вернуться в профиль</a> | <a href="about-user.php?USER_ID='.$USER_ID.'">Вернуться к выбору Экзамена</a></p>';
if (CModule::IncludeModule("learning"))
{
	$res = CTestAttempt::GetList(
		Array("DATE_END" => "DESC"), 
		Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => $TEST_ID, "STUDENT_ID" => $USER_ID)
	);
?>
	<table class="learn-gradebook-table data-table">
		<tr><th>Дата</th><th>Результат</th></tr>
<?
	while ($arAttempt = $res->GetNext())
	{
		$status = "";
		$name = $arAttempt["TEST_NAME"];
		$data = $arAttempt["DATE_END"];
		switch($arAttempt["COMPLETED"])		// проверка на правильность теста
		{
			case "Y":
				$status = "Сдан";
				break;
			case "N":
				$status = "Не сдан";
				break;
		}
?>
		<tr>
			<td><?=$data;?></td>
			<td><?=$status;?></td>
		</tr>
<?
	} 
	$APPLICATION->AddChainItem($name, "");
	$APPLICATION->SetPageProperty("title", $name);
	$APPLICATION->SetTitle($name);
?>
	</table>
<? } ?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>