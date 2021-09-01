<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

echo '<table>';
echo '<tr>';
echo '<th style="position: sticky; top: 0; background: grey;">ID</th>';
echo '<th style="position: sticky; top: 0; background: grey;">NAME</th>';
echo '<th style="position: sticky; top: 0; background: grey;">Кол-во с Сертификатом АИ</th>';
echo '<th style="position: sticky; top: 0; background: grey;">Кол-во с Сертификатом ТП</th>';
echo '<th style="position: sticky; top: 0; background: grey;">Кол-во с Сертификатом СЦ</th>';
echo '<th style="position: sticky; top: 0; background: grey;">действие АИ</th>';
echo '<th style="position: sticky; top: 0; background: grey;">условия АИ</th>';
echo '</tr>';

$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y")); //unix time для начала сегодняшнего дня

$filter = [
	"ID" => "5276", // только тестовая компания
	"ACTIVE" => "Y",
	"GROUPS_ID" => 32 //пользователи из группы "Компании"
];
$select = [
	"SELECT" => ['ID', 'NAME', "UF_SERT_D", "UF_SERT_DATE", "UF_SERT_TP", "UF_SERT_DATE_TP", "UF_SERT_SC", "UF_SERT_DATE_SC", "UF_PAI", "UF_PTP", "UF_SC", "UF_PAS", "UF_TIP_SERT"]
];
$rsCompany = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем компании
 
$i = 0;
while($arCompany = $rsCompany->Fetch()) {
	$i++;
	$countAI = 0;
	$countSTP = 0;
	$countSC = 0;
	$trebovaniyaAI = false;
	$trebovaniyaTP = false;
	echo '<tr>';
	echo '<td>' . $arCompany['ID'] . '</td>';
	echo '<td>' . $arCompany['NAME'] . '</td>';

	// console_log($arCompany);
	
	$filter = [
		"ACTIVE" => "Y",
		"WORK_COMPANY" => $arCompany["ID"],
		"WORK_COMPANY_EXACT_MATCH" => "Y"
	];
	$select = [
		"SELECT" => ["UF_SERT_DATE", "UF_SERT_DATE_TP", "UF_SERT_DATE_SC"]
	];
	$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей, которые принадлежат данной компании
	while ($arUser = $rsUsers->Fetch()) {
		console_log($arUser);  
		// считаем пользователей компании с пройденными тестами АИ
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_DATE"] && $endSertDate > $today)
			$countAI++;
		// считаем пользователей компании с пройденными тестами СТП
		$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_DATE_TP"] && $endSertDate > $today)
			$countSTP++;
		// считаем пользователей компании с пройденными тестами СЦ
		$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_DATE_SC"] && $endSertDate > $today)
			$countSC++;
	}
	echo '<td>' . $countAI . '</td>';
	echo '<td>' . $countSTP . '</td>';
	echo '<td>' . $countSC . '</td>';
	
	// Проверяем и удаляем сертификат АИ, если у компании не выполнены все условия
	//*****************************************************************************
	$getSertDate = strtotime($arCompany["UF_SERT_DATE"]); //unix time время генерации сертификата АИ у пользователя
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1); //unix time время окончания действия сертификата АИ у пользователя
	if (in_array(18, $arCompany["UF_TIP_SERT"])) //если пользователь является "Авторизованный инсталлятор, торговый партнер"
	{
		// Тестируем условия для выпуска сертификата
		// Было "($countAI >= 2 && $arCompany["UF_PAI"] == "Подтверждено" && $arCompany["PERSONAL_WWW"] == "Подтверждено")" 
		if ($countAI >= 1 && $arCompany["UF_PAI"] == "Подтверждено" && $arCompany["PERSONAL_WWW"] == "Подтверждено") //если больше двух человек сдали тест аи в компании и "Условия для сертификации Авторизованного инсталлятора" "Подтверждено" и "WWW-страница" "Подтверждено"
			$trebovaniyaAI = true;

		if ($arCompany["UF_SERT_D"] && ($endSertDate <= $today || !$trebovaniyaAI))
		{
			echo '<td>Удаляем сертификат</td>';
			//CFile::Delete($arCompany["UF_SERT_D"]);
			//SetUserField ("USER", $arCompany["ID"], "UF_SERT_D", "");
		}
		// Сертификат для АИ
		if ($trebovaniyaAI && ($endSertDate <= $today || $arCompany["UF_SERT_DATE"] == ""))
		{
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-ai-shablon.jpg";
			$textColour = array( 0, 102, 110 );
			$sert_pole = "UF_SERT_D";
			$sert = "ai";
			//if ($arCompany["UF_SERT_D"])
			//	echo '<td>Удаляем сертификат</td>';
			echo '<td>Генерируем сертификат</td>';
			//SetUserField ("USER", $ID, "UF_SERT_DATE", date("d.m.Y G:i:s"));
			//createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		}
	}
	echo '<td>' . intval($trebovaniyaAI) . '</td>';
	//*****************************************************************************
	
	echo '</tr>';
}
echo '</table>';
echo 'Всего компаний: ' . $i;

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>