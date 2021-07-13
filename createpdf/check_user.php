<?
require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/user_sert.php");	// создание сертификата

$ID = strip_tags(trim($_GET["ID"]));
$CERT = strip_tags(trim($_GET["CERT"]));

if (!isset($_SERVER["HTTP_REFERER"]) || stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/company/") === false || !isset($_GET["ID"])){
	$header = 'Location: /client/uchitelskaya/jurnal/kursi.php?STUDENT_ID='.$ID;
	header($header);
}
	



if (CModule::IncludeModule("learning"))
{
	$rsUser= CUser::GetByID($ID);
	$arUser = $rsUser->Fetch();

	$compl = 0;									// Количество пройденных тестов для АИ
	$testPereattAI = false;						// Тест теоретический - «Переаттестация» АИ
	$testSTP = false;							// Теоретический экзамен СТП
	$testSC = false;							// Теоретический экзамен СЦ
	$testComplete = array();					// Массив с журналом тестов для удаления
	$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
	// Выбираем пройденные тесты у студентов
	$res = CGradebook::GetList(Array("TEST_ID" => "ASC"), Array("CHECK_PERMISSIONS" => "N", "COMPLETED" => "Y", "STUDENT_ID" => $arUser["ID"]));
	while($arGradebookRes = $res->GetNext())
	{
		CCertification::Certificate($arUser["ID"], $arGradebookRes["COURSE_ID"]);
		switch($arGradebookRes["TEST_ID"])
		{
			case 2:								// Допуск на теоретический экзамен
			case 3:								// Теоретический экзамен АИ
			case 4:								// Практический тест на оборудовании
			case 5:								// Практический тест - настройка базы данных без оборудования
				$compl++;
				break;
			case 6:								// Тест теоретический - «Переаттестация»
			case 7:								// Теоретический экзамен СТП
			case 8:								// Теоретический экзамен СЦ (Тест для сервис-инженеров)
				$testComplete[$arGradebookRes["TEST_ID"]] = $arGradebookRes["ID"];
				break;
		}
	}
	$rsCompany = CUser::GetByID($arUser["WORK_COMPANY"]);
	$arCompany = $rsCompany->Fetch();
	// 18 - Авторизованный инсталлятор, торговый партнер (также студенты ВУЗов)
	// 19 - Сертифицированный торговый партнер
	// 21 - Пользователи систем
	if(in_array(26, CUser::GetUserGroup($arCompany["ID"])))
	{
		$rsGender = CUserFieldEnum::GetList(array(), array("ID" => $arUser["UF_VUZ"]));
		$arGender = $rsGender->Fetch();
		$company = $arGender["VALUE"];
	}
	else
		$company = $arCompany["WORK_COMPANY"] . ", " . $arCompany["WORK_CITY"];
	$txt = $company . "\n" . $arUser["LAST_NAME"] . " " . $arUser["NAME"] . " " . $arUser["SECOND_NAME"];
	//Делаем замену казахских символов на русские и английские
	$txt = str_replace(['Ә', 'ә', 'Ғ', 'ғ', 'Қ', 'қ', 'Ң', 'ң', 'Ө', 'ө', 'Ұ', 'ұ', 'Ү', 'ү', 'Һ', 'һ', 'І', 'і'], ['А', 'а', 'F', 'f', 'К', 'к', 'Н', 'н', 'О', 'о', 'У', 'у', 'У', 'у', 'H', 'h', 'I', 'i'], $txt);
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
	$datecomp = "Свидетельство действительно до " . date("d") . " " . $month . " " . (date("Y")+1) . " года";
	
	if ($CERT == "AI"){

		// Блок АИ
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_D"] && $endSertDate <= $today)
		{
			CFile::Delete($arUser["UF_SERT_D"]);
			SetUserField ("USER", $arUser["ID"], "UF_SERT_D", "");
			//reСertification($arUser["ID"], "UF_SERT_D", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate);
		}
		elseif ((($compl == 4 && $arUser["UF_SERT_DATE"] == "") || ($testComplete[6] && $endSertDate <= $today)) && (in_array(18, $arCompany["UF_TIP_SERT"]) || in_array(21, $arCompany["UF_TIP_SERT"])))
		{
			if (in_array(18, $arCompany["UF_TIP_SERT"]))		// Авторизованный инсталлятор
			{
				$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-install-shablon.jpg";
				$textColour = array( 0, 102, 110 );
				$sert_pole = "UF_SERT_D";
				$sert_data = "UF_SERT_DATE";
			}
			elseif (in_array(21, $arCompany["UF_TIP_SERT"]))	// Администратор систем
			{
				$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-administrator-shablon.jpg";
				$textColour = array( 95, 79, 124 );
				$sert_pole = "UF_SERT_D";
				$sert_data = "UF_SERT_DATE";
			}
			if ($arUser["UF_SERT_D"])
				CFile::Delete($arUser["UF_SERT_D"]);
			?><pre><?var_dump($ID); var_dump($txt); var_dump($datecomp); var_dump($sert_pole); var_dump($sert_data); var_dump($logoFile); var_dump($textColour);?></pre><?
			createSert($ID, $txt, $datecomp, $sert_pole, $sert_data, $logoFile, $textColour);
		}
	} elseif ($CERT == "TP"){

		// Блок СТП
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_TP"] && $endSertDate <= $today)
		{
			CFile::Delete($arUser["UF_SERT_TP"]);
			SetUserField ("USER", $arUser["ID"], "UF_SERT_TP", "");
			//reСertification($arUser["ID"], "UF_SERT_TP", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate);
		}
		// Менеджер по продажам
		elseif ($testComplete[7] && ($arUser["UF_SERT_DATE_TP"] == "" || $endSertDate <= $today) && in_array(19, $arCompany["UF_TIP_SERT"]))
		{
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-menedzher-shablon.jpg";
			$textColour = array( 123, 121, 119 );
			$sert_pole = "UF_SERT_TP";
			$sert_data = "UF_SERT_DATE_TP";
			if ($arUser["UF_SERT_TP"])
				CFile::Delete($arUser["UF_SERT_TP"]);
			createSert($ID, $txt, $datecomp, $sert_pole, $sert_data, $logoFile, $textColour);
		}
	} elseif ($CERT == "SC"){

		// Блок СЦ
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_SC"] && $endSertDate <= $today)
		{
			CFile::Delete($arUser["UF_SERT_SC"]);
			SetUserField ("USER", $arUser["ID"], "UF_SERT_SC", "");
			//reСertification($arUser["ID"], "UF_SERT_SC", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate);
		}
		elseif ($testComplete[8] && ($arUser["UF_SERT_DATE_SC"] == "" || $endSertDate <= $today) && $arCompany["UF_SC"])
		{
			$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-specialist-shablon.jpg";
			$textColour = array( 39, 87, 164 );
			$sert_pole = "UF_SERT_SC";
			$sert_data = "UF_SERT_DATE_SC";
			if ($arUser["UF_SERT_SC"])
				CFile::Delete($arUser["UF_SERT_SC"]);
			createSert($ID, $txt, $datecomp, $sert_pole, $sert_data, $logoFile, $textColour);
		}
	}
	//******************************************************
}
?>