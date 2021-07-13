<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Регистрация студентов", "");
$APPLICATION->SetPageProperty("title", "Регистрация студентов");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Регистрация студентов");

if (isset($students))
{
	$error = 0;
	$error_text = "";
	$message = "";
	$family = "";
	$name = "";
	$sername = "";
	$n_group = "";
	$email = "";
	$handle = fopen($students, "r");
	$first = true;
	// Получаем данные компании
	$rsUserPrepod = CUser::GetByID($USER->GetID());
	$arUserPrepod = $rsUserPrepod->Fetch();

	while (!feof($handle))
	{
		$buffer = fgets($handle);
		$buffer = mb_convert_encoding($buffer, "utf-8", "cp1251");
		if ($first)
		{
			$first = false;
			continue;
		}
		$mas = explode(";", $buffer);
		// Передаем e-mail компании
		$family = strip_tags(trim($mas[0]));
		$name = strip_tags(trim($mas[1]));
		$sername = strip_tags(trim($mas[2]));
		$email = strip_tags(trim($mas[3]));
		$n_group = strip_tags(trim($mas[4]));
		if ($family != "" && $name != ""&& $sername != "" && $n_group != ""&& $email != "")
		{
			// Ищем пользователя по e-mail из группы студентов
			$filter = Array
			(
				"ACTIVE" => "Y",
				"EMAIL" => $email,
				"GROUPS_ID" => Array(10)
			);
			$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем пользователей
			$arUser = $rsUsers->Fetch();
			$user = new CUser;
			// Если такой студент есть и у него нет компании
			if($arUser && !is_numeric($arUser["WORK_COMPANY"]))
			{
				$fields = Array(
					"WORK_COMPANY" => $arUserPrepod["ID"],
					"UF_N_GROUP" => $n_group,
					"UF_VUZ" => $arUserPrepod["UF_VUZ"],
					"UF_DATA_OBUCH" => $data,
					"UF_SCAN_ZAPROS" => $arUserPrepod["UF_SCAN_ZAPROS"],
					"UF_INN" => $arUserPrepod["UF_INN"],
					"UF_TIP_SERT" => $arUserPrepod["UF_TIP_SERT"],
				);
				$user->Update($arUser["ID"], $fields);
			}
			else
			{
				$pasw = gen_pasw();
				$fields = Array(
					"NAME" => $name,
					"LAST_NAME" => $family,
					"SECOND_NAME" => $sername,
					"EMAIL" => $email,
					"LOGIN" => $email,
					"LID" => "s1",
					"ACTIVE" => "Y",
					"GROUP_ID" => array(10),
					"PASSWORD" => $pasw,
					"CONFIRM_PASSWORD" => $pasw,
					"WORK_COMPANY" => $arUserPrepod["ID"],
					"UF_N_GROUP" => $n_group,
					"UF_VUZ" => $arUserPrepod["UF_VUZ"],
					"UF_SCAN_ZAPROS" => $arUserPrepod["UF_SCAN_ZAPROS"],
					"UF_INN" => $arUserPrepod["UF_INN"],
					"UF_TIP_SERT" => $arUserPrepod["UF_TIP_SERT"],
				);
				$ID = $user->Add($fields);
				if (intval($ID) == 0)
				{
					$error_text .= "Ошибка при добавлении ".$family." ".$name." - ".$user->LAST_ERROR."<br />";
					$error++;
				}
				else
					$message .= $family." ".$name." ".$sername."\n"."Логин: ".$email."\n"."Пароль: ".$pasw."\n"."\n";
			}
		}
	}
	if ($message != "")
	{
		$arEventFields = array(
			"family_name" => "перечень",
			"name" => "добавленных",
			"patronymic_name" => "студентов",
			"MESSAGE" => $message,
			"company_email" => $arUserPrepod["EMAIL"]
			);
		CEvent::Send("FORM_FILLING_REGISTRACIYA_STUDENTA", "s1", $arEventFields);
	}
}
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p><a href="/client/prepodavatelskaya/list/">Вернуться к списку студентов</a></p>
<?
if (isset($students))
{
	if($error>0)
		echo '<p>Студенты добавлены, кроме указанных ниже.</p><span style="color: red;">'.$error_text."</span>";
	else
		echo '<span style="color: green;">Все студенты добавлены!</span>';
}
?>
	<p>Перед тем как загружать файл со студентами, скачайте и заполните необходимые поля в <a href="/download/other/students.csv">этом файле</a>, после чего выберите его для загрузки!</p>
	<form enctype="multipart/form-data" method="post">
		<p><input type="file" name="students"></p>
		<p><input type="submit" value="Отправить"></p>
	</form>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>