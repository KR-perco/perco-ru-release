<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("История обучения сотрудника", "");
$APPLICATION->SetPageProperty("title", "История обучения сотрудника");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("История обучения сотрудника");
?>
<div id="textBlcok"> 
	<h1> <?$APPLICATION->ShowTitle(false, false)?></h1>
<?

if (CModule::IncludeModule("learning"))
{
	$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	$USER_ID = htmlentities(strip_tags(trim($USER_ID)));
	$rsUser = CUser::GetByID($USER_ID);
	$arUser = $rsUser->Fetch();
	echo '<p>Сотрудник: '.$arUser["LAST_NAME"].' '.$arUser["NAME"].' '.$arUser["SECOND_NAME"].'</p>';
	echo '<p><a href="/client/company/">Вернуться в профиль</a></p>';
	$arFilterSpisok = Array("IBLOCK_ID"=>54, "ACTIVE"=>"Y", "PROPERTY_UID"=>$arUser["ID"]);
	$arSelectSpisok = Array("ID", "PROPERTY_SEMINAR","PROPERTY_SEMINAR_DATE", "PROPERTY_CONFIRM_TRAINING");
	$resSpisok = CIBlockElement::GetList(Array("PROPERTY_SEMINAR_DATE"=>"DESC"), $arFilterSpisok, false, Array(), $arSelectSpisok);
	if (intval($resSpisok->SelectedRowsCount()) > 0)
	{
?>
	<h2>Очное обучение</h2>
	<table class="learn-gradebook-table data-table">
		<tr>
			<th>Название семинара</th>
			<th>Дата семинара</th>
			<th style="width:90px">Посещение</th>
		</tr>
<?
		while($arSpisok = $resSpisok->GetNext())
		{
?>
		<tr>
			<td><?=$arSpisok["PROPERTY_SEMINAR_VALUE"];?></td>
			<td><?=$arSpisok["PROPERTY_SEMINAR_DATE_VALUE"];?></td>
			<td><?=$arSpisok["PROPERTY_CONFIRM_TRAINING_VALUE"];?></td>
		</tr>
<?		} ?>
	</table><br />
<?	} ?>
	<h2>Тестирование</h2>
	<table class="learn-gradebook-table data-table">
		<tr>
			<th>Курс</th>
			<th>Название</th>
			<th style="width:90px">Результат</th>
		</tr>
<?
	$resTest = CTest::GetList(Array("SORT"=>"ASC"),Array("ACTIVE"=>"Y", "CHECK_PERMISSIONS"=>"N"));
	while ($arTest = $resTest->GetNext())
	{
		$link = "";
		$status = "";
		$kurs = "";
		$TEST_ID = $arTest["ID"];
		if ($TEST_ID >= 2 && $TEST_ID <= 6)
			$kurs = "Авторизованный инсталлятор";
		elseif ($TEST_ID == 7)
			$kurs = "Сертифицированный торговый партнер";
		elseif ($TEST_ID == 8)
			$kurs = "Сервисный центр";
		$resCGradebook = CGradebook::GetList(Array("ID" => "DESC"),  Array("TEST_ID" =>$TEST_ID, "STUDENT_ID" => $USER_ID));
		while($arGradebook = $resCGradebook->GetNext())
		{
			if ($arGradebook["COMPLETED"] == "Y")
			{
				$status = "Сдан";
				break;
			}
			elseif ($arGradebook["COMPLETED"] == "N")
				$status = "Не сдан";
		}
		if ($status)
		{
			$link = '<a href="/client/company/list/examens.php?USER_ID='.$USER_ID.'&TEST_ID='.$arTest["ID"].'">'.$arTest["NAME"].'</a>';
?>
		<tr>
			<td><?=$kurs;?></td>
			<td><?=$link;?></td>
			<td><?=$status;?></td>
		</tr>
<?
		}
	}
?>
	</table>
<? } ?>
</div>
 <? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>