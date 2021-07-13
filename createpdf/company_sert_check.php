<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/company_sert.php");	// создание сертификата
$filter = Array
(
	"ACTIVE" => "Y",
	"GROUPS_ID" => 32
);
$select = array(
	"SELECT" => array("UF_SERT_D", "UF_SERT_DATE", "UF_SERT_TP", "UF_SERT_DATE_TP", "UF_SERT_SC", "UF_SERT_DATE_SC", "UF_PAI", "UF_PTP", "UF_SC", "UF_PAS", "UF_TIP_SERT")
);
$rsCompany = CUser::GetList(($by="id"), ($order="asc"), $filter, $select); // выбираем компании
while($arCompany = $rsCompany->Fetch())
{
	$countAI = 0;
	$countSTP = 0;
	$countSC = 0;
	$sert = "";
	$trebovaniyaAI = false;
	$trebovaniyaTP = false;
	$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	switch(date("n"))
	{
		case 1:
			$month = "января";
			break;
		case 2:
			$month = "февраля";
			break;
		case 3:
			$month = "марта";
			break;
		case 4:
			$month = "апреля";
			break;
		case 5:
			$month = "мая";
			break;
		case 6:
			$month = "июня";
			break;
		case 7:
			$month = "июля";
			break;
		case 8:
			$month = "августа";
			break;
		case 9:
			$month = "сентября";
			break;
		case 10:
			$month = "октября";
			break;
		case 11:
			$month = "ноября";
			break;
		case 12:
			$month = "декабря";
			break;
	}
	$datecomp = "Сертификат действителен до " . date("d") . " " . $month . " " . (date("Y")+1) . " года";
	$txt = $arCompany["WORK_COMPANY"] . "\n" . "(" . $arCompany["WORK_CITY"] . ")";
	$ID = $arCompany["ID"];
	$filter = Array
	(
		"ACTIVE" => "Y",
		"WORK_COMPANY" => $arCompany["ID"],
		"WORK_COMPANY_EXACT_MATCH" => "Y"
	);
	$select = array(
		"SELECT" => array("UF_SERT_DATE", "UF_SERT_DATE_TP", "UF_SERT_DATE_SC")
	);
	$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей
	while($arUser = $rsUsers->Fetch())
	{
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

	// Проверяем и удаляем сертификат АИ, если у компании не выполнены все условия
	//*****************************************************************************
	$getSertDate = strtotime($arCompany["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	if (in_array(18, $arCompany["UF_TIP_SERT"]))
	{
		if ($countAI >= 2 && $arCompany["UF_PAI"] == "Подтверждено" && $arCompany["PERSONAL_WWW"] == "Подтверждено")
			$trebovaniyaAI = true;
		if ($arCompany["UF_SERT_D"] && ($endSertDate <= $today || !$trebovaniyaAI))
		{
			CFile::Delete($arCompany["UF_SERT_D"]);
			SetUserField ("USER", $arCompany["ID"], "UF_SERT_D", "");
		}
		// Сертификат для АИ
		if ($trebovaniyaAI && ($endSertDate <= $today || $arCompany["UF_SERT_DATE"] == ""))
		{
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-ai-shablon.jpg";
			$textColour = array( 0, 102, 110 );
			$sert_pole = "UF_SERT_D";
			$sert = "ai";
			if ($arCompany["UF_SERT_D"])
				CFile::Delete($arCompany["UF_SERT_D"]);
			SetUserField ("USER", $ID, "UF_SERT_DATE", date("d.m.Y G:i:s"));
			createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		}
	}
	//*****************************************************************************
	
	// Проверяем и удаляем просроченный сертификат СТП, если у компании не выполнены все условия
	//*****************************************************************************
	if (in_array(19, $arCompany["UF_TIP_SERT"]))
	{
		if (($countSTP >= 3 || ($countSTP >= 2 && $arCompany["UF_SC"])) && $arCompany["UF_PTP"] == "Подтверждено" && $arCompany["PERSONAL_WWW"] == "Подтверждено")
			$trebovaniyaTP = true;
		$getSertDate = strtotime($arCompany["UF_SERT_DATE_TP"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arCompany["UF_SERT_TP"] && ($endSertDate <= $today || !$trebovaniyaTP))
		{
			CFile::Delete($arCompany["UF_SERT_TP"]);
			SetUserField ("USER", $arCompany["ID"], "UF_SERT_TP", "");
		}
		// Сертификат для СТП
		if ($trebovaniyaTP && ($endSertDate <= $today || $arCompany["UF_SERT_DATE_TP"] == ""))
		{
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-stp-shablon.jpg";
			$textColour = array( 123, 121, 119 );
			$sert_pole = "UF_SERT_TP";
			$sert = "stp";
			if ($arCompany["UF_SERT_TP"])
				CFile::Delete($arCompany["UF_SERT_TP"]);
			SetUserField ("USER", $ID, "UF_SERT_DATE_TP", date("d.m.Y G:i:s"));
			createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		}
	}
	//*****************************************************************************
	
	// Проверяем и удаляем просроченный сертификат СЦ/АДСЦ
	//*****************************************************************************
	if ($arCompany["UF_SC"])
	{
		$getSertDate = strtotime($arCompany["UF_SERT_DATE_SC"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arCompany["UF_SERT_SC"] && ($endSertDate <= $today || !$trebovaniyaAI || $countSC < 2 || (!$trebovaniyaTP && in_array(19, $arCompany["UF_TIP_SERT"]))))
		{
			CFile::Delete($arCompany["UF_SERT_SC"]);
			SetUserField ("USER", $arCompany["ID"], "UF_SERT_SC", "");
		}
		// Сертификат для СЦ/АДСЦ
		if (($endSertDate <= $today || $arCompany["UF_SERT_DATE_SC"] == "") && $countSC >= 2 && $trebovaniyaAI && $trebovaniyaTP) // сертификат АДСЦ
		{
			$sert = "adsc";
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-adsc-shablon.jpg";
			$textColour = array( 155, 97, 0 );
			$sert_pole = "UF_SERT_SC";
			if ($arCompany["UF_SERT_SC"])
				CFile::Delete($arCompany["UF_SERT_SC"]);
			SetUserField ("USER", $ID, "UF_SERT_DATE_SC", date("d.m.Y G:i:s"));
			createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		}
		elseif (($endSertDate <= $today || $arCompany["UF_SERT_DATE_SC"] == "") && $countSC >= 2 && $trebovaniyaAI && !in_array(19, $arCompany["UF_TIP_SERT"])) // сертификат СЦ
		{
			$sert = "sc";
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-sc-shablon.jpg";
			$textColour = array( 39, 87, 164 );
			$sert_pole = "UF_SERT_SC";
			if ($arCompany["UF_SERT_SC"])
				CFile::Delete($arCompany["UF_SERT_SC"]);
			SetUserField ("USER", $ID, "UF_SERT_DATE_SC", date("d.m.Y G:i:s"));
			createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		}
	}
}
?>