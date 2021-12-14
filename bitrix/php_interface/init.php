<?
/*
You can place here your functions and event handlers

AddEventHandler("module", "EventName", "FunctionName");
function FunctionName(params)
{
	//code
}
*/
$host = explode(".", $_SERVER['HTTP_HOST']);
define("HOSTNAME", $host[count($host)-2]);

// Для нового сайта ->
AddEventHandler("main", "OnEpilog", "_Check404Error", 1);
function _Check404Error()
{
	//if(CHTTP::GetLastStatus() == "404 Not Found")
	if (defined("ERROR_404") && ERROR_404=="Y")
	{
		CHTTP::SetStatus("404 Not Found");
		global $APPLICATION;
		$APPLICATION->RestartBuffer();
		require($_SERVER["DOCUMENT_ROOT"]."/404.php");
	}
}
// обработка If-Modified-Since
AddEventHandler("main", "OnEpilog", array("CBDPEpilogHooks", "CheckIfModifiedSince"));
class CBDPEpilogHooks
{
	function CheckIfModifiedSince()
	{
		global $lastModified;
		global $APPLICATION;
		if (!$lastModified)
			$lastModified = filemtime($_SERVER["SCRIPT_FILENAME"]); // время последнего изменения страницы
			/* $arr = apache_request_headers();
			foreach ($arr as $header => $value)
			{
				if ($header == 'If-Modified-Since')
				{
					$ifModifiedSince = strtotime($value);
					if ($ifModifiedSince > $lastModified)
					{
						$GLOBALS['APPLICATION']->RestartBuffer();
						CHTTP::SetStatus('304 Not Modified');
					}
				}
			} */
		if (isset($_SERVER["HTTP_IF_MODIFIED_SINCE"]))
			$IfModifiedSince = strtotime(substr($_SERVER["HTTP_IF_MODIFIED_SINCE"], 5));
		header('Last-Modified: '.gmdate('D, d M Y H:i:s \G\M\T', $lastModified));
		if ($IfModifiedSince >= $lastModified)
		{
			$APPLICATION->RestartBuffer();
			CHTTP::SetStatus('304 Not Modified');
		}
	}
}

// создание amp страницы для новостей
/*AddEventHandler('iblock', 'OnAfterIBlockElementAdd', ['AmpPageCreator', 'IBlockElementAddHandler']);
class AmpPageCreator
{
	public static function Create($path, $str)
	{
		$fd = fopen('../../'.$path, 'w') or die("Ошибка записи в файл.");
		fwrite($fd, $str);
		fclose($fd);
	}
	
	public static function IBlockElementAddHandler($ib)
	{
		switch ($ib['IBLOCK_ID']) {
		case 3:
			$ch = curl_init('https://www.perco.ru/novosti/'.$ib['CODE'].'.php');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($ch);
			curl_close($ch);
			self::Create('amptest.html', $ib['DETAIL_PAGE_URL']);
			break;
		}
	}
}*/

function SetUserField ($entity_id, $value_id, $uf_id, $uf_value) //запись значения
{
	return $GLOBALS["USER_FIELD_MANAGER"]->Update ($entity_id, $value_id, Array ($uf_id => $uf_value));
}

function GetUserField ($entity_id, $value_id, $uf_id) //считывание значения
{
	$arUF = $GLOBALS["USER_FIELD_MANAGER"]->GetUserFields ($entity_id, $value_id);
	return $arUF[$uf_id]["VALUE"];
}
// $entity_id - имя объекта (у нас "BLOG_COMMENT")
// $value_id - идентификатор элемента (вероятно, ID элемента, свойство которого мы сохраняем или получаем. в нашем случае, это ID комментария)
// $uf_id - имя пользовательского свойства (в нашем случае UF_RATING)
// $uf_value - значение, которое сохраняем
function GetDownloadFile($code, $image="")
{
	if (!is_array($code))
		$code = array(1 => $code);
	$arFilter = Array("IBLOCK_CODE"=>"files", "CODE" => $code[1]);
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_PRICE");
	$resFile = CIBlockElement::GetList(array(), $arFilter);
	if (intval($resFile->SelectedRowsCount()) > 0)
	{
		$obFile = $resFile->GetNextElement();
		$arFileFields = $obFile->GetFields();
		$arFileProps = $obFile->GetProperties();
		$keyFile = array_search(LANGUAGE_ID, $arFileProps["FILE"]["DESCRIPTION"]);
		if($keyFile == NULL)
			$keyFile = 0;
		$file = $arFileProps["FILE"]["VALUE"][$keyFile];
		$keyName = array_search(LANGUAGE_ID, $arFileProps["NAME"]["DESCRIPTION"]);
		$name = $arFileProps["NAME"]["VALUE"][$keyName];
		$keyImage = array_search(LANGUAGE_ID, $arFileProps["IMAGE"]["DESCRIPTION"]);
		$imageSource = $arFileProps["IMAGE"]["VALUE"][$keyImage];
		switch($arFileProps["ICON"]["VALUE"])
		{
			case "pdf":
				$ico = "/images/icons/pdf.svg";
				break;
			case "dwf":
				$AutoCadtitle = 'для просмотра должна быть установлена программа Autodesk DWF Viewer<br />';
				$ico = "/images/icons/dwf.svg";
				break;
			case "dwg":
				$ico = "/images/icons/dwg.svg";
				break;
			default:
				$ico = "/images/icons/download.svg";
				break;
		}
		$fSize = '('.printFileInfo($file, "size").')&nbsp;';
		$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
		if ($arFileProps["INSTAL_TIME"]["VALUE"])
			$datezbor = $arFileProps["INSTAL_TIME"]["VALUE"];
		else
			$datezbor = printFileInfo($file, "date"); 
		if (preg_match('/(.*percoMobile\/.*|.*percoDemo\/.*|.*percoMobileMVP\/.*)/', $_SERVER['REQUEST_URI'])) { 
			$file = preg_replace('/^\/.*\//', 'https://www.perco.ru/', $file);
		}
		if ($image == "Y")
			$string .= '<div class="download_item_img"><a href="'.$file.'" target="_blank" '.$google.' download><div><img alt="'.$name.'" src="'.$imageSource.'"></div><span>'.$name.'</span></a><div class="color">'.$fSize.' — '.$datezbor.'</div>';
		else
			$string .= '<div class="download_item"><div class="icon"><img alt="Иконка" src="'.$ico.'" /></div><div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.'</a> <span class="color">'.$AutoCadtitle.$fSize.' — '.$datezbor.'</span></div>';
		$string .= '</div>';
		return $string;
	}
}
function GetDownloadFileImg($code)
{
	return GetDownloadFile($code, "Y");
}
function GetRate()
{
	GLOBAL $APPLICATION;
	global $price_res;
	$APPLICATION->IncludeComponent(
		"bitrix:currency.rates",
		"price",
		Array(
			"arrCURRENCY_FROM" => array("EUR"),
			"CURRENCY_BASE" => "RUB",
			"RATE_DAY" => "",
			"SHOW_CB" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "86400",
		),
		false
	);
}
function GetPrice($code)
{
	global $price_res;
	$rsPrice = CIBlockElement::GetList(array(), array("IBLOCK_CODE"=>"product_info", "CODE" => $code[1]), false, false, array("ID", "PROPERTY_PRICE"));	// перечень полей необходимых в результате выборки
	if (intval($rsPrice->SelectedRowsCount()) > 0)
	{
		$arPrice = $rsPrice->Fetch();
		if ($arPrice["PROPERTY_PRICE_VALUE"] >= 1)
			$drob = 0;
		else
			$drob = 2;
		if ($price_res == 0)
			return number_format($arPrice["PROPERTY_PRICE_VALUE"], $drob, ",", " ") . " €";
		else
			return number_format($arPrice["PROPERTY_PRICE_VALUE"]*$price_res, 0, ",", " ") . " &#8381;";
	}
}

function is_device()
{
	$tablet_browser = 0;
	$mobile_browser = 0;
	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
		$tablet_browser++;
	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|iphone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
		$mobile_browser++;
	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']))))
		$mobile_browser++;
	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
	$mobile_agents = array(
		'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
		'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
		'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
		'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
		'newt','noki','palm','pana','pant','phil','play','port','prox',
		'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
		'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
		'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
		'wapr','webc','winw','winw','xda ','xda-');
	if (in_array($mobile_ua,$mobile_agents))
		$mobile_browser++;
	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0)
	{
		$mobile_browser++;
		//Check for tablets on opera mini alternative headers
		$stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
		if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua))
			$tablet_browser++;
	}

	if ($tablet_browser > 0)
		return "tablet";
	elseif ($mobile_browser > 0)
		return "mobile";
	else
		return "desktop";
}

//вывод информации о файле (размер файла, дата загрузки)
//********************************************************
function printFileInfo($file, $param)
{
	$file = $_SERVER["DOCUMENT_ROOT"].$file;
	switch($param)
	{
		case "size":
			$size = filesize($file);
			if($size > 1024)
			{
				$size = $size/1024;
				if($size > 1024)
				{
					$size = $size/1024;
					$size = sprintf("%.2f&nbsp;MB", $size);
				}
				else $size = sprintf("%.0f&nbsp;kB", $size);
			}
			return $size;
			break;
		case "date":
			return date("d.m.Y", filemtime($file));
			break;
	}
}
//********************************************************
// <- Для нового сайта

function browser()
{
	$agent = $_SERVER['HTTP_USER_AGENT'];
	preg_match("/(MSIE|Opera|Firefox|Chrome|Version)(?:\/| )([0-9.]+)/", $agent, $browser_info);
	list(,$browser,$version) = $browser_info;
	$result = array("type" => $browser, "version" => $version);
	return $result;
}

// Преобразование символов других языков к английским буквам
//********************************************************
function translitIt($str)
{
	$trans = array(
		"à"=>"a","ä"=>"a","á"=>"a","è"=>"e","é"=>"e",
		"í"=>"i","ï"=>"i","ö"=>"o","ô"=>"o","ó"=>"o",
		"ü"=>"u","ú"=>"u","ß"=>"b","ñ"=>"n"," "=>"-",
		"а" => "a", "б" => "b", "в" => "v",
		"г" => "g", "д" => "d", "е" => "e",
		"ё" => "e", "ж" => "zh",  "з" => "z",
		"и" => "i", "й" => "y", "к" => "k",
		"л" => "l", "м" => "m", "н" => "n",
		"о" => "o", "п" => "p", "р" => "r",
		"с" => "s", "т" => "t", "у" => "u",
		"ф" => "f", "х" => "h", "ц" => "c",
		"ч" => "ch",  "ш" => "sh",  "щ" => "sch",
		"ь" => "",  "ы" => "y", "ъ" => "",
		"э" => "e", "ю" => "yu",  "я" => "ya",
		"," => "", ":" => "", "/" => "", "«" => "", "»" => "", "—" => "", '"' => "", "'" => "", "’" => "", "!" => ""
	);
	return strtr($str,$trans);
}
//********************************************************

// Проверка регистрируемой компании на наличие в базе
//********************************************************
AddEventHandler("main", "OnBeforeUserAdd", Array("CompanyCheck", "OnBeforeUserAddHandler"));
class CompanyCheck
{
	// создаем обработчик события "OnBeforeUserAdd"
	function OnBeforeUserAddHandler(&$arFields)
	{
		$error = 0;
		global $APPLICATION;
		global $USER;
		if (count($arFields["UF_TIP_SERT"]) <= 1 && in_array(32, $arFields["GROUP_ID"]))
		{
			$error_text .= "Поле \"Указание статуса компании\" обязательно для заполнения<br />";
			$error++;
		}
		if (!in_array(21, $arFields["UF_TIP_SERT"]))
			$arFields["UF_TIP_SERT"] = array();
		$filter = Array
		(
			"GROUPS_ID" => array(32),
			"UF_INN" => $arFields["UF_INN"],
			"UF_INN_EXACT_MATCH" => "Y"
		);
		$select = array("SELECT" => array("UF_INN"));
		$rsUsers = CUser::GetList($by="ID", $order="desc", $filter, $select); // выбираем пользователей
		while($arUser = $rsUsers->Fetch())
		{
			$arGroups = CUser::GetUserGroup($arUser["ID"]);
			if (stripos($_SERVER['REQUEST_URI'], "/client/company/list/") === false && stripos($_SERVER['REQUEST_URI'], "/client/prepodavatelskaya/list/") === false)
			{
				if (in_array(32, $arGroups) && $arUser["UF_INN"] == $arFields["UF_INN"])
				{
					$error_text .= "Компания с таким ИНН уже зарегистрирована<br />";
					$error++;
					break;
				}
			}
		}
		if($error>0)
		{
			$APPLICATION->throwException($error_text);
			return false;
		}
	}
}
//********************************************************

// Перехват изменения данных пользователя, для проверки заполненности объема закупок
//********************************************************
AddEventHandler("main", "OnBeforeUserUpdate", Array("CheckZakupki", "OnBeforeUserUpdateHandler"));
class CheckZakupki
{
	// создаем обработчик события "OnBeforeUserUpdate"
	function OnBeforeUserUpdateHandler(&$arFields)
	{
		if(is_set($arFields, "UF_ZAKUPKI") && strlen($arFields["UF_ZAKUPKI"])<=0 && stripos($_SERVER['REQUEST_URI'], "/bitrix/admin/") === false)
		{
			global $APPLICATION;
			$APPLICATION->throwException('Поле "Подтверждение закупок" обязательно для заполнения');
			return false;
		}
	}
}
//********************************************************

// Генерация пароля
//********************************************************
function gen_pasw()
{
	$chars="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ,.<>/?;:\'\"[]{}\|`~!@#$%^&*()-_+=";
	$size=strlen($chars)-1;
	$UserPass = null;
	$max=10; // 10 - кол-во символов в пароле
	while($max--)
		$UserPass.=$chars[rand(0,$size)];
	return $UserPass;
}
//********************************************************

// Перехват формы для регистрации специалистов компании
//********************************************************
function form_result($WEB_FORM_ID, $arFields, $arValues)
{
	if ($WEB_FORM_ID == 34)
	{
		if ($arValues["form_radio_obuchenie"] == 551)
			$arValues["form_radio_obuchenie"] = "Да";
		else
			$arValues["form_radio_obuchenie"] = "Нет";
		global $USER;
		global $APPLICATION;
		// Получаем данные компании
		$rsUserCompany = CUser::GetByID($USER->GetID());
		$arUserCompany = $rsUserCompany->Fetch();
		//создаем массив для передачи сертификата
		$arFile = CFile::MakeFileArray($arUserCompany["UF_SCAN_ZAPROS"]);
		// Передаем e-mail компании
		$arValues["form_hidden_570"] = $arUserCompany["EMAIL"];
		// Ищем пользователя по e-mail из группы студентов
		$filter = Array
		(
			"ACTIVE" => "Y",
			"EMAIL" => $arValues["form_email_532"],
			"GROUPS_ID" => Array(10)
		);
		$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем пользователей
		$arUser = $rsUsers->Fetch();
		$user = new CUser;
		// Если такой студент есть и у него нет компании
		if($arUser && !is_numeric($arUser["WORK_COMPANY"]))
		{
			$fields = Array(
				"PERSONAL_NOTES" => $arValues["form_radio_obuchenie"],
				"WORK_POSITION" => $arValues["form_text_533"],
				"WORK_COMPANY" => $arUserCompany["ID"],
				"UF_DATA_OBUCH" => $arValues["form_date_537"],
				"UF_SCAN_ZAPROS" => $arFile,
				//"UF_SCAN_ZAPROS" => $arUserCompany["UF_SCAN_ZAPROS"],
				"UF_INN" => $arUserCompany["UF_INN"],
				"UF_TIP_SERT" => $arUserCompany["UF_TIP_SERT"],
			);
			$user->Update($arUser["ID"], $fields);
			$arEventFields = array(
				"family_name" => trim($arValues["form_text_534"]),
				"name" => trim($arValues["form_text_535"]),
				"patronymic_name" => trim($arValues["form_text_536"]),
				"MESSAGE" => 'Сотрудник с таким e-mail уже был зарегистрирован на сайте, логин и пароль остались без изменения.',
				"company_email" => $arUserCompany["EMAIL"]
				);
			CEvent::Send("FORM_FILLING_REGISTRACIYA_SPECIALISTA", $arUser["LID"], $arEventFields);
		}
		else
		{
			$pasw = gen_pasw();
			$arValues["form_hidden_561"] = $pasw;
			$fields = Array(
				"NAME" => trim($arValues["form_text_535"]),
				"LAST_NAME" => trim($arValues["form_text_534"]),
				"SECOND_NAME" => trim($arValues["form_text_536"]),
				"EMAIL" => $arValues["form_email_532"],
				"WORK_POSITION" => $arValues["form_text_533"],
				"LOGIN" => $arValues["form_email_532"],
				"PERSONAL_NOTES" => $arValues["form_radio_obuchenie"],
				"LID" => "s1",
				"ACTIVE" => "Y",
				"GROUP_ID" => array(10),
				"PASSWORD" => $pasw,
				"CONFIRM_PASSWORD" => $pasw,
				"UF_DATA_OBUCH" => $arValues["form_date_537"],
				"WORK_COMPANY" => $arUserCompany["ID"],
				"UF_SCAN_ZAPROS" => $arFile,
				//"UF_SCAN_ZAPROS" => $arUserCompany["UF_SCAN_ZAPROS"],
				"UF_INN" => $arUserCompany["UF_INN"],
				"UF_TIP_SERT" => $arUserCompany["UF_TIP_SERT"],
			);
			$ID = $user->Add($fields);
			if (intval($ID) == 0)
			{
				$APPLICATION->ThrowException($user->LAST_ERROR);
				return false;
			}
			else
			{
				$arEventFields = array(
					"family_name" => $arValues["form_text_534"],
					"name" => $arValues["form_text_535"],
					"patronymic_name" => $arValues["form_text_536"],
					"MESSAGE" => "Логин: ".$arValues["form_email_532"]."\n"."Пароль: ".$pasw,
					"company_email" => $arUserCompany["EMAIL"]
					);
				CEvent::Send("FORM_FILLING_REGISTRACIYA_SPECIALISTA", "s1", $arEventFields);
				$arEventFields = array(
					"LAST_NAME" => $arValues["form_text_534"],
					"NAME" => $arValues["form_text_535"],
					"SECOND_NAME" => $arValues["form_text_536"],
					"LOGIN" => $arValues["form_email_532"],
					"EMAIL_TO" => $arValues["form_email_532"],
					"WORK_COMPANY" => $arUserCompany["WORK_COMPANY"],
					"PASSWORD" => $pasw
					);
				CEvent::Send("ADD_USER_INFO", "s1", $arEventFields);
			}
		}
	}
	if ($WEB_FORM_ID == 35)
	{
		global $APPLICATION;
		$fio_ok = array(); // собираем ФИО сотрудников, которые уже зарегистрированы на данный семинар
		$error_text = "";
		$arSpecialists = explode(";", $arValues["form_hidden_560"]);
		array_pop($arSpecialists);
		foreach($arSpecialists as $key => $specialist)
		{
			$arData = array();
			$tema = array();
			$stud_id = explode(",", $specialist);
			$full_fio = $stud_id[0];
			$fio = explode(" ", $stud_id[0]);
			$date_seminar = explode("|", $stud_id[2]);
			array_pop($date_seminar);
			$stud_id = $stud_id[1];
			$rsUser = CUser::GetByID($stud_id);
			$arUser = $rsUser->Fetch();
			$rsUserCompany = CUser::GetByID($arUser["WORK_COMPANY"]);
			$arUserCompany = $rsUserCompany->Fetch();
			// преобразование даты в числовой вид
			//**********
			foreach($date_seminar as $dateval)
			{
				$date_s = explode("-", $dateval);
				$arData[] = $date_s[0];
				$tema[$date_s[0]] = $date_s[1];
			}
			//**********
			// Проверка от дурака, чтобы не подавали заявку 2й раз на эту же дату, проверка по e-mail
			$rs = CIBlockElement::GetList(
				array(),
				array(
				"IBLOCK_ID" => 54,
				"PROPERTY_EMAIL" => $arUser["EMAIL"]
				),
				false,
				false,
				array("ID", "PROPERTY_UID", "PROPERTY_SEMINAR_DATE")
			);
			$seminar = false;
			while($ar = $rs->GetNext())
			{
				if ($ar["PROPERTY_UID_VALUE"] == $arUser["ID"] && in_array($ar["PROPERTY_SEMINAR_DATE_VALUE"], $arData))
				{
					$seminar = true;
					break;
				}
			}
			if ($seminar)
				$fio_ok[] = $full_fio;
		}
		$fio_ok = array_unique($fio_ok);
		$fio_ok = implode(", ", $fio_ok);
		if (count($arData) == 0)
			$error_text .= "Не выбрана дата посещения семинара.<br />";
		if ($fio_ok != "")
			$error_text .= "На сотрудника(ов) ".$fio_ok." Вы уже подавали заявку на выбранную дату.<br />";
		if ($error_text)
		{
			$APPLICATION->throwException($error_text);
			return false;
		}
		else
		{
			foreach($arData as $sem)
			{
				$masFields = array(
					"ACTIVE" => "Y",
					"IBLOCK_ID" => 54,
					"NAME" => $full_fio,
					"PROPERTY_VALUES" => array(
						"UID" => $arUser["ID"],
						"LAST_NAME" => $fio[0],
						"NAME" => $fio[1],
						"PATRONYMIC_NAME" => $fio[2],
						"WORK_POSITION" => $arUser["WORK_POSITION"],
						"EMAIL" => $arUser["EMAIL"],
						"COMPANY" => $arUserCompany["WORK_COMPANY"],
						"CITY" => $arUserCompany["WORK_CITY"],
						"SEMINAR" => $tema[$sem],
						"SEMINAR_DATE" => $sem,
						"APPLICANT" => "Партнер",
					)
				);
				$oElement = new CIBlockElement();
				$idElement = $oElement->Add($masFields);
			}
		}
	}
	if ($WEB_FORM_ID == 37)
	{
		global $USER;
		global $APPLICATION;
		// Получаем данные компании
		$rsUserPrepod = CUser::GetByID($USER->GetID());
		$arUserPrepod = $rsUserPrepod->Fetch();
		//создаем массив для передачи сертификата
		$arFile = CFile::MakeFileArray($arUserPrepod["UF_SCAN_ZAPROS"]);
		// Передаем e-mail компании
		$arValues["form_hidden_587"] = $arUserPrepod["EMAIL"];
		// Ищем пользователя по e-mail из группы студентов
		$filter = Array
		(
			"ACTIVE" => "Y",
			"EMAIL" => $arValues["form_email_578"],
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
				"UF_N_GROUP" => $arValues["form_text_579"],
				//"UF_SCAN_ZAPROS" => $arUserPrepod["UF_SCAN_ZAPROS"],
				"UF_SCAN_ZAPROS" => $arFile,
				"UF_VUZ" => $arUserPrepod["UF_VUZ"],
				"UF_INN" => $arUserPrepod["UF_INN"],
				"UF_TIP_SERT" => $arUserPrepod["UF_TIP_SERT"],
			);
			$user->Update($arUser["ID"], $fields);
			$arEventFields = array(
				"family_name" => $arValues["form_text_580"],
				"name" => $arValues["form_text_581"],
				"patronymic_name" => $arValues["form_text_582"],
				"MESSAGE" => 'Студент с таким e-mail уже был зарегистрирован на сайте, логин и пароль остались без изменения.',
				"company_email" => $arUserPrepod["EMAIL"]
				);
			CEvent::Send("FORM_FILLING_REGISTRACIYA_STUDENTA", $arUser["LID"], $arEventFields);
		}
		else
		{
			$pasw = gen_pasw();
			$arValues["form_hidden_586"] = $pasw;
			$fields = Array(
				"NAME" => $arValues["form_text_581"],
				"LAST_NAME" => $arValues["form_text_580"],
				"SECOND_NAME" => $arValues["form_text_582"],
				"EMAIL" => $arValues["form_email_578"],
				"LOGIN" => $arValues["form_email_578"],
				"LID" => "s1",
				"ACTIVE" => "Y",
				"GROUP_ID" => array(10),
				"PASSWORD" => $pasw,
				"CONFIRM_PASSWORD" => $pasw,
				"WORK_COMPANY" => $arUserPrepod["ID"],
				"UF_N_GROUP" => $arValues["form_text_579"],
				"UF_VUZ" => $arUserPrepod["UF_VUZ"],
				//"UF_SCAN_ZAPROS" => $arUserPrepod["UF_SCAN_ZAPROS"],
				"UF_SCAN_ZAPROS" => $arFile,
				"UF_INN" => $arUserPrepod["UF_INN"],
				"UF_TIP_SERT" => $arUserPrepod["UF_TIP_SERT"],
			);
			$ID = $user->Add($fields);
			if (intval($ID) == 0)
			{
				$APPLICATION->ThrowException($user->LAST_ERROR);
				return false;
			}
			else
			{
				$arEventFields = array(
					"family_name" => $arValues["form_text_580"],
					"name" => $arValues["form_text_581"],
					"patronymic_name" => $arValues["form_text_582"],
					"MESSAGE" => "Логин: ".$arValues["form_email_578"]."\n"."Пароль: ".$pasw,
					"company_email" => $arUserPrepod["EMAIL"]
				);
				CEvent::Send("FORM_FILLING_REGISTRACIYA_STUDENTA", "s1", $arEventFields);
			}
		}
	}
	if ($WEB_FORM_ID == 38)
	{
		global $USER;
		// Получаем данные компании
		$rsCompany = CUser::GetByID($USER->GetID());
		$arCompany = $rsCompany->Fetch();
		$products = explode(";", $arValues["form_hidden_588"]);
		$number = explode(";", $arValues["form_hidden_589"]);
		$zakaz = array();
		for($i = 0; $i < count($products)-1; $i++)
		{
			$message .= $products[$i] . " - " . $number[$i] . " шт." . "\n";
			$zakaz[] = array("VALUE"=>$products[$i], "DESCRIPTION"=>$number[$i]);
		}
		$arEventFields = array(
			"MESSAGE" => $message,
		);
		switch($arValues["form_dropdown_list"])
		{
			case 590:
				$shipmentID = 120;
				break;
			case 591:
				$shipmentID = 121;
				break;
			case 592:
				$shipmentID = 122;
				break;
			case 606:
				$shipmentID = 123;
				break;
		}
		$masFields = array(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => 56,
			"NAME" => $arCompany["WORK_COMPANY"],
			"PROPERTY_VALUES" => array(
				"CID" => $arCompany["ID"],
				"COMPANY" => $arCompany["WORK_COMPANY"],
				"DATA" => $arValues["form_date_593"],
				"ZAKAZ" => $zakaz,
				"SHIPMENT" => array("VALUE" => $shipmentID)
			)
		);
		$oElement = new CIBlockElement();
		$idElement = $oElement->Add($masFields);
		CEvent::Send("FORM_FILLING_ZAYAVKA_NA_REKLAMU", "s1", $arEventFields);
	}
}
AddEventHandler('form', 'onBeforeResultAdd', 'form_result');
//********************************************************
// Перехват отправки письма, для добавления ссылки на отписку
AddEventHandler("subscribe", "BeforePostingSendMail", Array("SendEmail", "BeforePostingSendMailHandler"));
class SendEmail
{
	// создаем обработчик события "BeforePostingSendMail"
	function BeforePostingSendMailHandler($arFields)
	{
		$ID = "ID";
		$CONFIRM_CODE = "CODE";
		//Попробуем найти подписчика.
		$rs = CSubscription::GetByEmail($arFields["EMAIL"]);
		if($ar = $rs->Fetch())
		{
			if(intval($ar["ID"]) > 0)
			{
				$ID = $ar["ID"];
				$CONFIRM_CODE = $ar["CONFIRM_CODE"];
			}
		}
		
		// Подставим так же имя и компанию, если рассылка именная
		
		// $file = file_get_contents('../../sendmail-imennaya-2.json'); // Открыть файл
		// $maillist = json_decode($file, true); // Декодировать в массив
		// unset($file); // Очистить переменную $file
		
		// $NAME_RECIPIENT = "NAME_RECIPIENT";
		// $COMPANY_RECIPIENT = "вашу компанию";

		// foreach ($maillist['maillist'] as $recipient) { 
		// 	if ($recipient["mail"] == $arFields["EMAIL"]) { 
		// 		$NAME_RECIPIENT = $recipient['fio'];
		// 		$COMPANY_RECIPIENT = $recipient['company'];
		// 	}
		//   } 
		$arFields["BODY"] = str_replace("#ID#", $ID, $arFields["BODY"]);
		$arFields["BODY"] = str_replace("#CONFIRM_CODE#", $CONFIRM_CODE, $arFields["BODY"]);
		// $arFields["BODY"] = str_replace("#NAMERECIPIENT#", $NAME_RECIPIENT, $arFields["BODY"]);
		// $arFields["BODY"] = str_replace("#COMPANYRECIPIENT#", $COMPANY_RECIPIENT, $arFields["BODY"]);
		return $arFields;
	}
}


// backup //********************************************************
// // Перехват отправки письма, для добавления ссылки на отписку
// AddEventHandler("subscribe", "BeforePostingSendMail", Array("SendEmail", "BeforePostingSendMailHandler"));
// class SendEmail
// {
// 	// создаем обработчик события "BeforePostingSendMail"
// 	function BeforePostingSendMailHandler($arFields)
// 	{
// 		$ID = "ID";
// 		$CONFIRM_CODE = "CODE";
// 		//Попробуем найти подписчика.
// 		$rs = CSubscription::GetByEmail($arFields["EMAIL"]);
// 		if($ar = $rs->Fetch())
// 		{
// 			if(intval($ar["ID"]) > 0)
// 			{
// 				$ID = $ar["ID"];
// 				$CONFIRM_CODE = $ar["CONFIRM_CODE"];
// 			}
// 		}
// 		$arFields["BODY"] = str_replace("#ID#", $ID, $arFields["BODY"]);
// 		$arFields["BODY"] = str_replace("#CONFIRM_CODE#", $CONFIRM_CODE, $arFields["BODY"]);
// 		return $arFields;
// 	}
// }

// Определение региона по IP
function occurrence($ip = "", $to = "utf-8")
{
	$ip = ($ip) ? $ip : $_SERVER["REMOTE_ADDR"] ;
	$xml =  simplexml_load_file('http://ipgeobase.ru:7020/geo?ip='.$ip);
	if ($xml->ip->message)
	{
		if ($to == "utf-8")
			return $xml->ip->message;
		else
		{
			if (function_exists("iconv"))
				return iconv( "UTF-8", $to . "//IGNORE",$xml->ip->message);
			else
				return "The library iconv is not supported by your server";
		}
	}
	else
	{
		if ($to == "utf-8")
			return $xml->ip->region;
		else
		{
			if (function_exists("iconv"))
				return iconv( "UTF-8", $to . "//IGNORE",$xml->ip->region);
			else
				return "The library iconv is not supported by your server";
		}
	}
}
// Подпись с ценой о товаре в разделах
function get_price_podpis($id, $model)
{
	global $APPLICATION;
	global $price_res;
	$APPLICATION->IncludeComponent(
		"bitrix:currency.rates",
		"price",
		Array(
			"arrCURRENCY_FROM" => array("EUR"),
			"CURRENCY_BASE" => "RUB",
			"RATE_DAY" => "",
			"SHOW_CB" => "Y",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "86400",
		),
	false
	);
	$rsPrice = CIBlockElement::GetProperty(
		19,
		$id,
		array("sort" => "asc"),
		array("CODE" => "PRICE")	// перечень полей необходимых в результате выборки
	);
	$arPrice = $rsPrice->Fetch();
	$drob = 0;
	if ($arPrice["VALUE"] < 1)
		$drob = 2;
	if ($price_res != 0)
	{
		echo '<div class="price">';
		echo '<p>'.$model.'. Цена <span class="price_rub">'.number_format($arPrice["VALUE"]*$price_res, 0, ",", "&nbsp;").' руб.</span> со склада в Пскове</p>';
		echo '<p>'.number_format($arPrice["VALUE"], $drob, ",", "&nbsp;").' € (по курсу ЦБ РФ на '.date("d.m.y").')</p>';
		if ($arPrice["DESCRIPTION"])
			echo "<p>".$arPrice["DESCRIPTION"]."</p>";
		echo '</div>';
	}
}


function GetRateFromCBR($CURRENCY) 
{
	global $DB; 
	global $APPLICATION; 

	CModule::IncludeModule('currency');
	if(!CCurrency::GetByID($CURRENCY))
	//такой валюты нет на сайте, агент в этом случае удаляется
	return false;
	
	$DATE_RATE=date("d.m.Y");//сегодня 
	$QUERY_STR = "date_req=".$DB->FormatDate($DATE_RATE, CLang::GetDateFormat("SHORT", $lang), "D.M.Y"); 

	//делаем запрос к www.cbr.ru с просьбой отдать курс на нынешнюю дату          
	$strQueryText = QueryGetData("www.cbr.ru", 80, "/scripts/XML_daily.asp", $QUERY_STR, $errno, $errstr); 
	
	//получаем XML и конвертируем в кодировку сайта          
	$charset = "utf-8"; 
		if (preg_match("/<"."\?XML[^>]{1,}encoding=[\"']([^>\"']{1,})[\"'][^>]{0,}\?".">/i", $strQueryText, $matches)) 
		{ 
			$charset = Trim($matches[1]); 
		}
	
	//$strQueryText = preg_replace("<!DOCTYPE[^>]{1,}>", "", $strQueryText); 
	//$strQueryText = preg_replace("<"."\?XML[^>]{1,}\?".">", "", $strQueryText); 
	$strQueryText = $APPLICATION->ConvertCharset($strQueryText, $charset, SITE_CHARSET); 

	//var_dump($strQueryText);	

	require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/classes/general/xml.php");

	//парсим XML 
	$objXML = new CDataXML(); 
	$res = $objXML->LoadString($strQueryText); 
	if($res !== false) 
			$arData = $objXML->GetArray(); 
		else 
			$arData = false; 
	
	$NEW_RATE=Array(); 
	
	//получаем курс нужной валюты $CURRENCY 
	if (is_array($arData) && count($arData["ValCurs"]["#"]["Valute"])>0) 
		{ 

			for ($j1 = 0; $j1<count($arData["ValCurs"]["#"]["Valute"]); $j1++) 
			{ 
				if ($arData["ValCurs"]["#"]["Valute"][$j1]["#"]["CharCode"][0]["#"]==$CURRENCY) 
				{ 
				$NEW_RATE['CURRENCY']=$CURRENCY; 
				$NEW_RATE['RATE_CNT'] = IntVal($arData["ValCurs"]["#"]["Valute"][$j1]["#"]["Nominal"][0]["#"]); 
				$NEW_RATE['RATE'] = DoubleVal(str_replace(",", ".", $arData["ValCurs"]["#"]["Valute"][$j1]["#"]["Value"][0]["#"])); 
				$NEW_RATE['DATE_RATE']=$DATE_RATE; 
				
				break; 
				} 
			} 
		} 
		
	if ((isset($NEW_RATE['RATE']))&&(isset($NEW_RATE['RATE_CNT']))) 
	{ 
	echo $NEW_RATE['CURRENCY'];
	//курс получили, возможно, курс на нынешнюю дату уже есть на сайте, проверяем 
		CModule::IncludeModule('currency'); 
		$arFilter = array( 
					"CURRENCY" => $NEW_RATE['CURRENCY'], 
					"DATE_RATE"=>$NEW_RATE['DATE_RATE'] 
						); 
				$by = "date"; 
				$order = "desc"; 

				$db_rate = CCurrencyRates::GetList($by, $order, $arFilter); 
				if(!$ar_rate = $db_rate->Fetch()) 
		//такого курса нет, создаём курс на нынешнюю дату 
					CCurrencyRates::Add($NEW_RATE); 
		
	} 
		
	//возвращаем код вызова функции, чтобы агент не "убился" 
	return 'GetRateFromCBR("'.$CURRENCY.'");'; 
}

function getCurrency($curName)
{
	$priceAr = CCurrency::GetByID($curName);
	$price_res = $priceAr['CURRENT_BASE_RATE'];
	return $price_res;
}

/*function sendReminderMail() {
	mail('mailingperco@gmail.com', 'Агент', 'Письмо');
	if(CModule::IncludeModule('subscribe')) {
		mail('mailingperco@gmail.com', 'Агент новый', 'подключен модуль subscribe.');
	}
	return "sendReminderMail();";
}*/

/*function sendReminderMail() {
	if(CModule::IncludeModule('subscribe')) {
		$letterId = 734;
		$cPosting = new CPosting;
		$post = CPosting::GetByID($letterId);
		if(($post_arr = $post->Fetch()))
			$aEmail = CPosting::GetEmails($post_arr);
		var_dump($aEmail);
		$cPosting->ChangeStatus($letterId, "P");
		$cPosting->SendMessage($letterId, 16);
	}
	return "sendReminderMail();";
}*/

/*function sendReminderMail($event) {
	if ($event->provTest) {
		
	} else if () {

}
}*/

function sendReminderMailPercoIntroduction() {
	if(CModule::IncludeModule('subscribe')) {
		$response = '';
		$letterId = 734;
		$cPosting = new CPosting;
		$post = CPosting::GetByID($letterId);
		if(($post_arr = $post->Fetch()))
			$aEmail = CPosting::GetEmails($post_arr);
		$response = var_export($aEmail, true);
		$cPosting->ChangeStatus($letterId, "P");
		$response .= var_export($cPosting->SendMessage($letterId, 16), true);
		mail('mailingperco@gmail.com', 'Агент отправки рассылки по семинару PERCo introduction', $response);
	}
	return 'sendReminderMailPercoIntroduction();';
}
function sendReminderMailHowToChooseATurnstile() {
	if(CModule::IncludeModule('subscribe')) {
		$response = '';
		$letterId = 737;
		$cPosting = new CPosting;
		$post = CPosting::GetByID($letterId);
		if(($post_arr = $post->Fetch()))
			$aEmail = CPosting::GetEmails($post_arr);
		$response = var_export($aEmail, true);
		$cPosting->ChangeStatus($letterId, "P");
		$response .= var_export($cPosting->SendMessage($letterId, 16), true);
		mail('mailingperco@gmail.com', 'Агент отправки рассылки по семинару How to choose a turnstile', $response);
	}
	return 'sendReminderMailHowToChooseATurnstile();';
}
function sendReminderMailPercoNewProducts() {
	if(CModule::IncludeModule('subscribe')) {
		$response = '';
		$letterId = 738;
		$cPosting = new CPosting;
		$post = CPosting::GetByID($letterId);
		if(($post_arr = $post->Fetch()))
			$aEmail = CPosting::GetEmails($post_arr);
		$response = var_export($aEmail, true);
		$cPosting->ChangeStatus($letterId, "P");
		$response .= var_export($cPosting->SendMessage($letterId, 16), true);
		mail('mailingperco@gmail.com', 'Агент отправки рассылки по семинару PERCo new products', $response);
	}
	return 'sendReminderMailPercoNewProducts();';
}

function console_log($data)
{
  echo '<script>';
  echo 'console.log(' . json_encode($data) . ')';
  echo '</script>';
}
?>