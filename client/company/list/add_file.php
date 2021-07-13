<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Добавление сотрудников", "");
$APPLICATION->SetPageProperty("title", "Добавление сотрудников");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Добавление сотрудников");

if (isset($specialists))
{
	$error = 0;
	$error_text = "";
	$message = "";
	$family = "";
	$name = "";
	$sername = "";
	$post = "";
	$email = "";
	$obuchenie = "";
	$data = "";
	$handle = fopen($specialists, "r");
	$first = true;
	// Получаем данные компании
	$rsUserCompany = CUser::GetByID($USER->GetID());
	$arUserCompany = $rsUserCompany->Fetch();

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
		$post = strip_tags(trim($mas[3]));
		$email = strip_tags(trim($mas[4]));
		$obuchenie = strip_tags(trim($mas[5]));
		$data = strip_tags(trim($mas[6]));
		if ($family != "" && $name != ""&& $sername != "" && $post != ""&& $email != "")
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
					"PERSONAL_NOTES" => $obuchenie,
					"WORK_POSITION" => $post,
					"WORK_COMPANY" => $arUserCompany["ID"],
					"UF_DATA_OBUCH" => $data,
					"UF_SCAN_ZAPROS" => $arUserCompany["UF_SCAN_ZAPROS"],
					"UF_INN" => $arUserCompany["UF_INN"],
					"UF_TIP_SERT" => $arUserCompany["UF_TIP_SERT"],
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
					"WORK_POSITION" => $post,
					"LOGIN" => $email,
					"PERSONAL_NOTES" => $obuchenie,
					"LID" => "s1",
					"ACTIVE" => "Y",
					"GROUP_ID" => array(10),
					"PASSWORD" => $pasw,
					"CONFIRM_PASSWORD" => $pasw,
					"UF_DATA_OBUCH" => $data,
					"WORK_COMPANY" => $arUserCompany["ID"],
					"UF_SCAN_ZAPROS" => $arUserCompany["UF_SCAN_ZAPROS"],
					"UF_INN" => $arUserCompany["UF_INN"],
					"UF_TIP_SERT" => $arUserCompany["UF_TIP_SERT"],
				);
				$ID = $user->Add($fields);
				if (intval($ID) == 0)
				{
					$error_text .= "Ошибка при добавлении ".$family." ".$name." - ".$user->LAST_ERROR."<br />";
					$error++;
				}
				else
				{
					$message .= $family." ".$name." ".$sername."\n"."Логин: ".$email."\n"."Пароль: ".$pasw."\n"."\n";
					$arEventFields = array(
						"LAST_NAME" => $family,
						"NAME" => $name,
						"SECOND_NAME" => $sername,
						"LOGIN" => $email,
						"EMAIL_TO" => $email,
						"WORK_COMPANY" => $arUserCompany["WORK_COMPANY"],
						"PASSWORD" => $pasw
						);
					CEvent::Send("ADD_USER_INFO", "s1", $arEventFields);
				}
			}
		}
	}
	if ($message != "")
	{
		$arEventFields = array(
			"family_name" => "перечень",
			"name" => "добавленных",
			"patronymic_name" => "сотрудников",
			"MESSAGE" => $message,
			"company_email" => $arUserCompany["EMAIL"]
			);
		CEvent::Send("FORM_FILLING_REGISTRACIYA_SPECIALISTA", "s1", $arEventFields);
	}
}
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
<?
if (isset($specialists))
{
	if($error>0)
		echo '<p>Сотрудники добавлены, кроме указанных ниже.</p><span style="color: red;">'.$error_text."</span>";
	else
		echo '<span style="color: green;">Все сотрудники добавлены!</span>';
}
?>
	<p><a href="/client/company/">Вернуться в профиль</a></p>
	<p>Для загрузки списка сотрудников:</p>
	<ol>
		<li>Скачайте файл (<a href="/download/other/specialists.csv" download="download">specialists.csv</a>)</li>
		<li>Откройте его с помощью текстового редактора, например программы Блокнот</li>
		<li>Первую строчку оставьте без изменений</li>
		<li>На новой строчке напишите данные о сотруднике через точку с запятой и без пробелов (каждый новый сотрудник на новой строчке)</li>
		<li>Сохраните файл с названием specialists.csv</li>
		<li>Загрузите файл</li>
	</ol>
	<p>Пример содержимого заполненного файла:</p>
	<pre>Фамилия;Имя;Отчество;Должность;Email;Обучение (Да/Нет);Дата обучения
Иванов;Иван;Иванович;Инженер;ivano@perco.ru;Да;21.10.2015
Петров;Петр;Петрович;Инженер;petrov@perco.ru;Нет;17.06.2015</pre>
	<form enctype="multipart/form-data" method="post">
		<p><input type="file" name="specialists"></p>
		<p><input type="submit" value="Отправить"></p>
	</form>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>