<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/company_sert.php");	// создание сертификата

// if (!isset($_SERVER["HTTP_REFERER"]) || stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/company/") === false || !isset($_GET["ID"]))
// 	header('Location: /client/uchitelskaya/company/');

$ID = strip_tags(trim($_GET["ID"]));
$CERT = strip_tags(trim($_GET["CERT"]));
echo 'выбираем компании по ID';
$rsCompany = CUser::GetByID($ID); 
$arCompanyAndUser = $rsCompany->Fetch();
// echo'<pre>';
// print_r($rsCompany);
// echo'</pre>';
$countAI = 0;
$countSTP = 0;
$countSC = 0;
$sert = "";
$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));

$txt = $arCompanyAndUser["WORK_COMPANY"] . "\n" . '(' . $arCompanyAndUser["WORK_CITY"] . ')';
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $arCompanyAndUser["ID"],
	"WORK_COMPANY_EXACT_MATCH" => "Y"
);
$select = array(
	"SELECT" => array("UF_SERT_DATE", "UF_SERT_DATE_TP", "UF_SERT_DATE_SC")
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей
while($arUser = $rsUsers->Fetch())
{
	echo'<br><br>считаем пользователей компании с пройденными тестами АИ';
	$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE"] && $endSertDate > $today)
		$countAI++;
		echo $countAI;
	echo'<br>считаем пользователей компании с пройденными тестами ТП';
	$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_TP"] && $endSertDate > $today)
		$countSTP++;
		echo $countSTP;
	echo'<br>считаем пользователей компании с пройденными тестами СЦ';
	$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_SC"] && $endSertDate > $today)
		$countSC++;
		echo $countSC;
}
echo'<br>Сертификат для СЦ';
if($CERT == "SC"){
	if ($arCompanyAndUser["UF_SERT_DATE_SC"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompanyAndUser["UF_SERT_DATE_SC"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";
	echo '<br>';
	echo $datecomp;

	$getSertDate = strtotime($arCompanyAndUser["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	echo '
	'.$countAI.' >= 2 && 
		'.$countSTP.' >= 2 && 
		'.$countSC.' >= 2 && 
		'.$arCompanyAndUser["UF_PAI"].' == "Подтверждено" &&
		'.$arCompanyAndUser["UF_PTP"].' == "Подтверждено" && 
		'.$arCompanyAndUser["PERSONAL_WWW"].' == "Подтверждено" &&
		in_array(18, '.$arCompanyAndUser["UF_TIP_SERT"].') &&
		in_array(19, '.$arCompanyAndUser["UF_TIP_SERT"].') &&
		'.$arCompanyAndUser["UF_SC"].' && 
		('.$endSertDate.' <= $today || '.$arCompanyAndUser["UF_SERT_DATE_SC"].' == "" || '.!$arCompanyAndUser["UF_SERT_SC"].')
	';
	if ($countAI >= 2 && 
		$countSTP >= 2 && 
		$countSC >= 2 && 
		$arCompanyAndUser["UF_PAI"] == "Подтверждено" &&
		$arCompanyAndUser["UF_PTP"] == "Подтверждено" && 
		$arCompanyAndUser["PERSONAL_WWW"] == "Подтверждено" &&
		in_array(18, $arCompanyAndUser["UF_TIP_SERT"]) &&
		in_array(19, $arCompanyAndUser["UF_TIP_SERT"]) &&
		$arCompanyAndUser["UF_SC"] && 
		($endSertDate <= $today || $arCompanyAndUser["UF_SERT_DATE_SC"] == "" || !$arCompanyAndUser["UF_SERT_SC"]))
	{
		// $sert = "adsc";
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-adsc-shablon.jpg";
		// $textColour = array( 155, 97, 0 );
		// $sert_pole = "UF_SERT_SC";
		// if ($arCompanyAndUser["UF_SERT_SC"])
		// 	CFile::Delete($arCompanyAndUser["UF_SERT_SC"]);
		// SetUserField ("USER", $ID, "UF_SERT_DATE_SC", date("d.m.Y G:i:s"));
		// createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		echo '<br>создание сертификата';
	}
	elseif ($countAI >= 2 && 
			$countSC >= 2 && 
			$arCompanyAndUser["UF_PAI"] == "Подтверждено" && 
			$arCompanyAndUser["PERSONAL_WWW"] == "Подтверждено" && 
			in_array(18, $arCompanyAndUser["UF_TIP_SERT"]) && 
			!in_array(19, $arCompanyAndUser["UF_TIP_SERT"]) && 
			$arCompanyAndUser["UF_SC"] && 
			($endSertDate <= $today || $arCompanyAndUser["UF_SERT_DATE_SC"] == "" || !$arCompanyAndUser["UF_SERT_SC"])) // сертификат СЦ
			{
				// $sert = "sc";
				// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-sc-shablon.jpg";
				// $textColour = array( 39, 87, 164 );
				// $sert_pole = "UF_SERT_SC";
				// if ($arCompanyAndUser["UF_SERT_SC"])
				// 	CFile::Delete($arCompanyAndUser["UF_SERT_SC"]);
				// SetUserField ("USER", $ID, "UF_SERT_DATE_SC", date("d.m.Y G:i:s"));
				// createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
				echo '<br>создание сертификата';
			}
} elseif($CERT == "TP"){
	echo'<br>Сертификат для ТП';
	if ($arCompanyAndUser["UF_SERT_DATE_TP"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompanyAndUser["UF_SERT_DATE_TP"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";

	$getSertDate = strtotime($arCompanyAndUser["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	
	if (($countSTP >= 3 || ($countSTP >= 2 && $arCompanyAndUser["UF_SC"])) && $arCompanyAndUser["UF_PTP"] == "Подтверждено" && $arCompanyAndUser["PERSONAL_WWW"] == "Подтверждено")
		$trebovaniyaTP = true;
	
	if ($arCompanyAndUser["UF_SERT_TP"] && ($endSertDate <= $today || !$trebovaniyaTP))
	{
		// CFile::Delete($arCompanyAndUser["UF_SERT_TP"]);
		// SetUserField ("USER", $arCompanyAndUser["ID"], "UF_SERT_TP", "");
		echo '<br>удаление';
	}

	if ($trebovaniyaTP && ($endSertDate <= $today || $arCompanyAndUser["UF_SERT_DATE_TP"] == "" || !$arCompanyAndUser["UF_SERT_TP"]))
	{
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-stp-shablon.jpg";
		// $textColour = array( 123, 121, 119 );
		// $sert_pole = "UF_SERT_TP";
		// $sert = "stp";
		// if ($arCompanyAndUser["UF_SERT_TP"])
		// 	CFile::Delete($arCompanyAndUser["UF_SERT_TP"]);
		// SetUserField ("USER", $ID, "UF_SERT_DATE_TP", date("d.m.Y G:i:s"));
		// createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		echo '<br>создание сертификата';
	}
} elseif($CERT == "D"){
	echo'<br	>Сертификат для АИ';

	if ($arCompanyAndUser["UF_SERT_DATE"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompanyAndUser["UF_SERT_DATE"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";

	$getSertDate = strtotime($arCompanyAndUser["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	echo'<br><br>******debag**********';
	echo'<pre>';
    echo '$countAI: ';
    echo $countAI;
    echo ' - должно быть бельше либо равно двух, меняем';
    $countAI = 2;
    echo '<br>$arCompanyAndUser["UF_PAI"]: ';
    echo $arCompanyAndUser["UF_PAI"];
    echo '<br>$arCompanyAndUser["PERSONAL_WWW"]: ';
    echo $arCompanyAndUser["PERSONAL_WWW"];
	echo'</pre>';
	if ($countAI >= 2 && $arCompanyAndUser["UF_PAI"] == "Подтверждено" && $arCompanyAndUser["PERSONAL_WWW"] == "Подтверждено"){
		$trebovaniyaAI = true;
		echo'<pre>';
        echo '$trebovaniyaAI = true <br>';
        echo '$arCompanyAndUser["UF_SERT_D"]: ';
		echo $arCompanyAndUser["UF_SERT_D"];
		
		echo '<br>$endSertDate: ';
		echo $endSertDate;
		echo ' - будет перезаписано тестом';
		$endSertDate = 1608936810;
		echo'</pre>';
	}
	echo 'если $arCompanyAndUser["UF_SERT_D"] - не пустой и ($endSertDate <= $today или !$trebovaniyaAI) - будет удалён!';
	if ($arCompanyAndUser["UF_SERT_D"] && ($endSertDate <= $today || !$trebovaniyaAI))
	{
        echo'<br>!!!!!!!!!!!!!!Delete';
		// CFile::Delete($arCompanyAndUser["UF_SERT_D"]);
		// SetUserField ("USER", $arCompanyAndUser["ID"], "UF_SERT_D", "");
	}
    echo'<pre>';
    echo '$endSertDate: ';
    echo $endSertDate;
	echo ' - будет перезаписано тестом';
	$endSertDate = 1408936810;
    echo '<br>$today: ';
    echo $today;
    echo '<br>$arCompanyAndUser["UF_SERT_DATE"]: ';
    echo $arCompanyAndUser["UF_SERT_DATE"];
	echo ' - будет перезаписано тестом';
    $arCompanyAndUser["UF_SERT_DATE"] = "";
	
	// $trebovaniyaAI = true;

    echo'</pre>';
    echo'<pre>';
	echo'если $trebovaniyaAI и ($endSertDate <= $today или $arCompanyAndUser["UF_SERT_DATE"] == пустой или !$arCompanyAndUser["UF_SERT_D"])) - будет создан!';
    echo'</pre>';
	if ($trebovaniyaAI && ($endSertDate <= $today || $arCompanyAndUser["UF_SERT_DATE"] == "" || !$arCompanyAndUser["UF_SERT_D"]))
	{
        echo'!!!!!!!!!!!!!!create';
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-ai-shablon.jpg";
		// $textColour = array( 0, 102, 110 );
		// $sert_pole = "UF_SERT_D";
		// $sert = "ai";
		// if ($arCompanyAndUser["UF_SERT_D"])
		// 	CFile::Delete($arCompanyAndUser["UF_SERT_D"]);
		// SetUserField ("USER", $ID, "UF_SERT_DATE", date("d.m.Y G:i:s"));
		// createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
	}
}
// http://www.perco.local/createpdf/check_sc.php?ID=3931&CERT=D
echo'<pre>';

print_r($arCompanyAndUser);
echo'</pre>';
// header('Location: /client/uchitelskaya/company/company.php?COMPANY_ID='.$ID);
?>
