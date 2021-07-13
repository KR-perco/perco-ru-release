<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/company_sert.php");	// создание сертификата

if (!isset($_SERVER["HTTP_REFERER"]) || stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/company/") === false || !isset($_GET["ID"]))
	header('Location: /client/uchitelskaya/company/');

$ID = strip_tags(trim($_GET["ID"]));
$CERT = strip_tags(trim($_GET["CERT"]));
$rsCompany = CUser::GetByID($ID); // выбираем компании
$arCompany = $rsCompany->Fetch();
$countAI = 0;
$countSTP = 0;
$countSC = 0;
$sert = "";
$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));

$txt = $arCompany["WORK_COMPANY"] . "\n" . '(' . $arCompany["WORK_CITY"] . ')';
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
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE"] && $endSertDate > $today)
		$countAI++;
	// считаем пользователей компании с пройденными тестами ТП
	$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_TP"] && $endSertDate > $today)
		$countSTP++;
	// считаем пользователей компании с пройденными тестами СЦ
	$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_SC"] && $endSertDate > $today)
		$countSC++;
}
// Сертификат для СЦ
if($CERT == "SC"){
	if ($arCompany["UF_SERT_DATE_SC"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompany["UF_SERT_DATE_SC"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";

	$getSertDate = strtotime($arCompany["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	/*?><pre style="display: none;"><?var_dump([
		'countAI' => $countAI,
		'countSTP' => $countSTP,
		'countSC' => $countSC,
		'arCompany["UF_PAI"]' => $arCompany["UF_PAI"],
		'arCompany["UF_PTP"]' => $arCompany["UF_PTP"],
		'arCompany["PERSONAL_WWW"]' => $arCompany["PERSONAL_WWW"],
		'arCompany["UF_TIP_SERT"]' => $arCompany["UF_TIP_SERT"],
		'arCompany["UF_SC"]' => $arCompany["UF_SC"],
		'endSertDate' => date('d.m.Y', $endSertDate),
		'today' => date('d.m.Y', $today),
		'arCompany["UF_SERT_DATE_SC"]' => $arCompany["UF_SERT_DATE_SC"],
		'arCompany["UF_SERT_SC"]' => $arCompany["UF_SERT_SC"],
	]);?></pre><?*/
	if ($countAI >= 2 && 
		$countSTP >= 2 && 
		$countSC >= 2 && 
		$arCompany["UF_PAI"] == "Подтверждено" &&
		$arCompany["UF_PTP"] == "Подтверждено" && 
		$arCompany["PERSONAL_WWW"] == "Подтверждено" &&
		in_array(18, $arCompany["UF_TIP_SERT"]) &&
		in_array(19, $arCompany["UF_TIP_SERT"]) &&
		$arCompany["UF_SC"] && 
		($endSertDate <= $today || $arCompany["UF_SERT_DATE_SC"] == "" || !$arCompany["UF_SERT_SC"]))
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
	elseif ($countAI >= 2 && 
			$countSC >= 2 && 
			$arCompany["UF_PAI"] == "Подтверждено" && 
			$arCompany["PERSONAL_WWW"] == "Подтверждено" && 
			in_array(18, $arCompany["UF_TIP_SERT"]) && 
			!in_array(19, $arCompany["UF_TIP_SERT"]) && 
			$arCompany["UF_SC"] && 
			($endSertDate <= $today || $arCompany["UF_SERT_DATE_SC"] == "" || !$arCompany["UF_SERT_SC"])) // сертификат СЦ
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
} elseif($CERT == "TP"){
	// Сертификат для ТП
	if ($arCompany["UF_SERT_DATE_TP"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompany["UF_SERT_DATE_TP"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";

	$getSertDate = strtotime($arCompany["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	
	if (($countSTP >= 3 || ($countSTP >= 2 && $arCompany["UF_SC"])) && $arCompany["UF_PTP"] == "Подтверждено" && $arCompany["PERSONAL_WWW"] == "Подтверждено")
		$trebovaniyaTP = true;
	
	if ($arCompany["UF_SERT_TP"] && ($endSertDate <= $today || !$trebovaniyaTP))
	{
		CFile::Delete($arCompany["UF_SERT_TP"]);
		SetUserField ("USER", $arCompany["ID"], "UF_SERT_TP", "");
	}

	if ($trebovaniyaTP && ($endSertDate <= $today || $arCompany["UF_SERT_DATE_TP"] == "" || !$arCompany["UF_SERT_TP"]))
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
} elseif($CERT == "D"){
	// Сертификат для АИ

	if ($arCompany["UF_SERT_DATE"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompany["UF_SERT_DATE"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";

	$getSertDate = strtotime($arCompany["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);

	if ($countAI >= 2 && $arCompany["UF_PAI"] == "Подтверждено" && $arCompany["PERSONAL_WWW"] == "Подтверждено")
		$trebovaniyaAI = true;

	if ($arCompany["UF_SERT_D"] && ($endSertDate <= $today || !$trebovaniyaAI))
	{
		CFile::Delete($arCompany["UF_SERT_D"]);
		SetUserField ("USER", $arCompany["ID"], "UF_SERT_D", "");
	}

	if ($trebovaniyaAI && ($endSertDate <= $today || $arCompany["UF_SERT_DATE"] == "" || !$arCompany["UF_SERT_D"]))
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
header('Location: /client/uchitelskaya/company/company.php?COMPANY_ID='.$ID);
?>