<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Промокод - заявки PERCo");
$APPLICATION->SetPageProperty("title", "Системы безопасности – цены, купить комплексные системы безопасности, производство систем безопасности");
$APPLICATION->SetPageProperty("description", "PERCo – крупнейший российский производитель оборудования и систем безопасности (СКУД - системы контроля доступа, видеонаблюдение, охранно-пожарная сигнализация, турникеты, считыватели, электромеханические замки)");
$APPLICATION->SetPageProperty("keywords", "системы безопасности, контроль доступа, системы контроля доступа, скуд, скд, турникеты, охранно пожарная сигнализация, пожарная безопасность, видеонаблюдение, системы видеонаблюдения, учет рабочего времени");

$APPLICATION->AddHeadScript("/scripts/pages/main.js"); // подключение скриптов
$APPLICATION->SetAdditionalCSS("/css/form.css"); // подключение стилей
$APPLICATION->SetAdditionalCSS("/css/statistics.css"); // подключение стилей

if($USER->IsAuthorized()) {



require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/company_sert.php");	// создание сертификата

// if (!isset($_SERVER["HTTP_REFERER"]) || stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/company/") === false || !isset($_GET["ID"]))
// 	header('Location: /client/uchitelskaya/company/');

$ID = strip_tags(trim($_GET["ID"]));
$CERT = strip_tags(trim($_GET["CERT"]));
echo 'выбираем компании по ID';
$rsCompany = CUser::GetByID($ID); 
$arCompany = $rsCompany->Fetch();
// echo'<pre>';
// print_r($rsCompany);
// echo'</pre>';
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
	echo'<br><br>считаем пользователей компании с пройденными тестами АИ';
	$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE"] && $endSertDate > $today){
		$countAI++;
        echo $countAI;
    }
	echo'<br>считаем пользователей компании с пройденными тестами ТП';
	$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_TP"] && $endSertDate > $today){
		$countSTP++;
        echo $countSTP;
    }
	echo'<br>считаем пользователей компании с пройденными тестами СЦ';
	$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_SC"] && $endSertDate > $today){
		$countSC++;
        echo $countSC;
    }
}
echo'<br>Сертификат для СЦ';
if($CERT == "SC"){
	if ($arCompany["UF_SERT_DATE_SC"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompany["UF_SERT_DATE_SC"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";
	echo '<br>';
	echo $datecomp;

	$getSertDate = strtotime($arCompany["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	
	if (true)
	{
		$sert = "adsc";
		$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-adsc-shablon.jpg";
		$textColour = array( 155, 97, 0 );
		$sert_pole = "UF_SERT_SC";
		if ($arCompany["UF_SERT_SC"])
			CFile::Delete($arCompany["UF_SERT_SC"]);
		SetUserField ("USER", $ID, "UF_SERT_DATE_SC", date("d.m.Y G:i:s"));
		createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		echo '<br>Сертификат СЦ создан';
	}
	
} elseif($CERT == "TP"){
	echo'<br>Сертификат для ТП';
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
		echo '<br>удаление';
	}

	if (true)
	{
		$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-stp-shablon.jpg";
		$textColour = array( 123, 121, 119 );
		$sert_pole = "UF_SERT_TP";
		$sert = "stp";
		if ($arCompany["UF_SERT_TP"])
			CFile::Delete($arCompany["UF_SERT_TP"]);
		SetUserField ("USER", $ID, "UF_SERT_DATE_TP", date("d.m.Y G:i:s"));
		createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
		echo '<br>Сертификат ТП создан';
	}
} elseif($CERT == "D"){
	echo'<br	>Сертификат для АИ';

	if ($arCompany["UF_SERT_DATE"] == ""){
		$datestr = $today;
	}else{
		$datestr = strtotime($arCompany["UF_SERT_DATE"]);
	}
	$datecomp = "Сертификат действителен до " . date("d.m.Y", mktime(0, 0, 0, date("m", $datestr), date("d", $datestr), date("Y", $datestr)+1)) . " года";

	$getSertDate = strtotime($arCompany["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
	
	if (true){
		$trebovaniyaAI = true;
		
	}
	
	if ($arCompany["UF_SERT_D"] && ($endSertDate <= $today || !$trebovaniyaAI))
	{
        
		CFile::Delete($arCompany["UF_SERT_D"]);
        SetUserField ("USER", $arCompany["ID"], "UF_SERT_D", "");
        echo '<br>удаление';

	}
    
	if (true)
	{
		$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-ai-shablon.jpg";
		$textColour = array( 0, 102, 110 );
		$sert_pole = "UF_SERT_D";
		$sert = "ai";
		if ($arCompany["UF_SERT_D"])
			CFile::Delete($arCompany["UF_SERT_D"]);
		SetUserField ("USER", $ID, "UF_SERT_DATE", date("d.m.Y G:i:s"));
        createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата
        echo '<br>Сертификат АИ создан';
	}
}
// http://www.perco.local/createpdf/check_sc.php?ID=3931&CERT=D
echo'<pre>';

// print_r($arCompany);
echo'</pre>';
// header('Location: /client/uchitelskaya/company/company.php?COMPANY_ID='.$ID);
}

else echo'<h1>У вас нет доступа</h1>';


require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>
