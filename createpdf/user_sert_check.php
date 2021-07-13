<?
require($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/user_sert.php");	// создание сертификата

function reСertification($user_id, $pole, $lid, $email, $name, $last_name, $company, $data, $days="30")	// $user_id - ID пользователя, $pole - название поля с сертификатом
{
	switch($pole)
	{
		case "UF_SERT_D":
			$title = "Авторизованного инсталлятора";
			$serviceIRemont = '';
			break;
		case "UF_SERT_TP":
			$title = "Сертифицированного торгового партнера";
			$serviceIRemont = '';
			break;
		case "UF_SERT_SC":
			$title = "Сервисного центра";
			$serviceIRemont = "\r\n\r\n* Для активации теста по программе «Сервис и ремонт» сотруднику необходимо пройти ежегодное очное обучение в учебном центре в Санкт-Петербурге или иметь подтвержденный опыт работы не менее 3 лет.";
			break;
	}
	$arEventFields = array(
		"USER_ID" => $user_id,
		"USER_NAME" => $name,
		"USER_LAST_NAME" => $last_name,
		"COMPANY" => $company,
		"TITLE" => $title,
		"MESSAGE" => $data,
		"SERVICEIREMONT" => $serviceIRemont,
		"EMAIL_TO" => $email,
		"DAYS" => $days
	);
	CEvent::Send("REQUIRES_RE_CERTIFICATION", $lid, $arEventFields);
}

if (CModule::IncludeModule("learning"))
{
	$arUsers = CGroup::GetGroupUser(10); //выбираем всех пользователей группы "студенты"
	for($cnt=0; $cnt < count($arUsers); $cnt++)
	{
		$ID = $arUsers[$cnt];
		$rsUser= CUser::GetByID($ID); //выбираем пользователя по id 
		$arUser = $rsUser->Fetch();
		if (!is_numeric($arUser["WORK_COMPANY"]))	// Проверка на привязку к компании, должна быть цифра ID-компании
			continue;
		$compl = 0;									// Количество пройденных тестов для АИ
		$testPereattAI = false;						// Тест теоретический - «Переаттестация» АИ
		$testSTP = false;							// Теоретический экзамен СТП
		$testSC = false;							// Теоретический экзамен СЦ
		$testComplete = array();					// Массив с журналом тестов для удаления
		$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y")); //unix time, начало сегодняшнего дня
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
		$rsCompany = CUser::GetByID($arUser["WORK_COMPANY"]); //выбираем компанию по id
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
		// Блок АИ
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]); //получаем unix time - "Дата сертификата АИ" (дата генерации сертификата)
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1); //получаем unix time - "Дата сертификата АИ" + 1 год (дата окончания срока действия сертификата)
		if ($arUser["UF_SERT_D"] && $endSertDate <= $today) //если "Сертификат АИ" присутствует и сегодняшняя дата уже больше, чем срок окончания действия сертификата
		{
			CFile::Delete($arUser["UF_SERT_D"]); //удаляем файл из табл. зарегестрированных файлов и с сервера
			SetUserField ("USER", $arUser["ID"], "UF_SERT_D", ""); //обнуляем значение "Сертификат АИ"
			//reСertification($arUser["ID"], "UF_SERT_D", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate); закомментил
		}
		elseif ((($compl == 4 && $arUser["UF_SERT_DATE"] == "") || ($testComplete[6] && $endSertDate <= $today)) && (in_array(18, $arCompany["UF_TIP_SERT"]) || in_array(21, $arCompany["UF_TIP_SERT"]))) // UF_TIP_SERT - Тип партнерства, 18 - Авторизованный инсталлятор, торговый партнер, 21 - Пользователи систем
		{
			if (in_array(18, $arCompany["UF_TIP_SERT"]))		// Авторизованный инсталлятор (Авторизованный инсталлятор, торговый партнер)
			{
				$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-install-shablon.jpg";
				$textColour = array( 0, 102, 110 );
				$sert_pole = "UF_SERT_D";
				$sert_data = "UF_SERT_DATE";
			}
			elseif (in_array(21, $arCompany["UF_TIP_SERT"]))	// Администратор систем (Пользователи систем)
			{
				$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-administrator-shablon.jpg";
				$textColour = array( 95, 79, 124 );
				$sert_pole = "UF_SERT_D";
				$sert_data = "UF_SERT_DATE";
			}
			if ($arUser["UF_SERT_D"])
				CFile::Delete($arUser["UF_SERT_D"]);
			createSert($ID, $txt, $datecomp, $sert_pole, $sert_data, $logoFile, $textColour);
		}
		// Уведомление за 1 месяц о переаттестации
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);  //получаем unix time - "Дата сертификата АИ" + 1 год - 1 месяц (дата за месяц до окончания срока действия сертификата)
		if ($endSertDate == $today){
			if ($testComplete[6])
			{
				$resTest = CTestAttempt::GetList(
					Array("DATE_END" => "DESC"), 
					Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => 6, "STUDENT_ID" => $ID)
				);
				while ($arTest = $resTest->GetNext())
				{
					CTestAttempt::Delete($arTest["ID"]);
				}
				CGradebook::Delete($testComplete[6]);
			}
			reСertification($arUser["ID"], "UF_SERT_D", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate, "30");

		}
		// Уведомление за 10 дней о переатестации
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate)-10, date("Y", $getSertDate)+1);  //получаем unix time - "Дата сертификата АИ" + 1 год - 10 дней (дата за 10 дней до окончания срока действия сертификата)
		if ($endSertDate == $today){
			if (empty($testComplete[6])) {
				reСertification($arUser["ID"], "UF_SERT_D", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate, "10");
			}
		}
		//******************************************************

		// Блок СТП
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_TP"] && $endSertDate <= $today)
		{
			CFile::Delete($arUser["UF_SERT_TP"]);
			SetUserField ("USER", $arUser["ID"], "UF_SERT_TP", "");
			//reСertification($arUser["ID"], "UF_SERT_TP", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate); закомментил
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
		// Уведомление за 1 месяц о переаттестации
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($endSertDate == $today){
			if ($testComplete[7])
			{
				$resTest = CTestAttempt::GetList(
					Array("DATE_END" => "DESC"), 
					Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => 7, "STUDENT_ID" => $ID)
				);
				while ($arTest = $resTest->GetNext())
				{
					CTestAttempt::Delete($arTest["ID"]);
				}
				CGradebook::Delete($testComplete[7]);
			}
			reСertification($arUser["ID"], "UF_SERT_TP", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate, "30");
		}
		// Уведомление за 10 дней о переатестации
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate)-10, date("Y", $getSertDate)+1);
		if ($endSertDate == $today){
			if (empty($testComplete[7])) {
				reСertification($arUser["ID"], "UF_SERT_TP", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate, "10");
			}
		}
		//******************************************************

		// Блок СЦ
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_SC"] && $endSertDate <= $today)
		{
			CFile::Delete($arUser["UF_SERT_SC"]);
			SetUserField ("USER", $arUser["ID"], "UF_SERT_SC", "");
			//reСertification($arUser["ID"], "UF_SERT_SC", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate); закомментил
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
		// Уведомление за 1 месяц о переаттестации
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($endSertDate == $today){
			if ($testComplete[8])
			{
				$resTest = CTestAttempt::GetList(
					Array("DATE_END" => "DESC"), 
					Array("CHECK_PERMISSIONS" => "N", "TEST_ID" => 8, "STUDENT_ID" => $ID)
				);
				while ($arTest = $resTest->GetNext())
				{
					CTestAttempt::Delete($arTest["ID"]);
				}
				CGradebook::Delete($testComplete[8]);
			}
			reСertification($arUser["ID"], "UF_SERT_SC", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate, "30");			
		}
		// Уведомление за 10 дней о переатестации
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate)-10, date("Y", $getSertDate)+1);
		if ($endSertDate == $today){
			if (empty($testComplete[8])) {
				reСertification($arUser["ID"], "UF_SERT_SC", $arUser["LID"], ($arUser["EMAIL"].", ".$arCompany["EMAIL"]), $arUser["NAME"], $arUser["LAST_NAME"], $company, $getSertDate, "10");	
			}
		}

		//******************************************************
	}
}
?>