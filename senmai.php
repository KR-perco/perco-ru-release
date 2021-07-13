<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
/*function reСertification($user_id, $pole, $lid, $email, $name, $last_name, $company, $data, $days="30")	// $user_id - ID пользователя, $pole - название поля с сертификатом
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
reСertification('1', "UF_SERT_SC", 's1', 'makeev@perco.ru', 'имя', 'фамилия', 'компания', '', "30");*/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>