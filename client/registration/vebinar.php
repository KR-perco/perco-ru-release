<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Регистрация на вебинар", "");
$APPLICATION->SetPageProperty("title", "Регистрация на вебинар | PERCo");
$APPLICATION->SetPageProperty("description", "Форма для регистрации на вебинар");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Регистрация на вебинар");

if (!isset($_SERVER["HTTP_REFERER"]) || !$ID)
	Header("Location: /obuchenie/", true, 301);
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p><a href="/obuchenie/installyatorov/vebinary.php">Вернуться к списку семинаров</a></p>
<?
if (stripos($_SERVER["HTTP_REFERER"], "/registration/") !== false)
	$add = false;
$email = "";
$last_name = "";
$name = "";
$company = "";
$IBLOCK_ID = 63;
$res = CIBlockElement::GetByID($ID);
$arRes = $res->Fetch();
$seminar_date = $arRes["DATE_ACTIVE_TO"];
$db_iblock = CIBlockElement::GetProperty(46, $ID, array("sort" => "asc"), Array("CODE"=>"SEMINAR"));
$youtube_iblock = CIBlockElement::GetProperty(46, $ID, array("sort" => "asc"), Array("CODE"=>"YOUTUBE"));
$arRes = $db_iblock->Fetch();
$youtube = $youtube_iblock->Fetch();
$youtubeUrl = $youtube["VALUE"];
//$url = "https://youtu.be/".$youtubeUrl;
$url = $youtubeUrl;
$seminar = $arRes["VALUE"];
$arFilter = array("ID"=>$seminar, "IBLOCK_ID"=>62);
$arSelect = array("ID", "IBLOCK_ID", "PROPERTY_TOPIC");
$db_iblock = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
$arRes = $db_iblock->Fetch();
$seminar_name = $arRes["PROPERTY_TOPIC_VALUE"];
$db_iblock = CIBlockElement::GetProperty(46, $ID, array("sort" => "asc"), Array("CODE"=>"ID_EXT"));
$arRes = $db_iblock->Fetch();
$id_ext = $arRes["VALUE"];
if ($USER->IsAuthorized() && $ID > 0)
{
	$add = true;
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	$email = $arUser["EMAIL"];
	$last_name = $arUser["LAST_NAME"];
	$name = $arUser["NAME"];
	$city = $arUser["WORK_CITY"];
	if (is_numeric($arUser["WORK_COMPANY"]))
	{
		$rsCompany = CUser::GetByID($arUser["WORK_COMPANY"]);
		$arCompany = $rsCompany->Fetch();
		$company = $arCompany["WORK_COMPANY"];
	}
	else
		$company = $arUser["WORK_COMPANY"];
}
else
{
	if (isset($_POST) && count($_POST) > 0 && $ID > 0)
	{
		if ($_POST["EMAIL"] != "" && $_POST["LAST_NAME"] != "" && $_POST["NAME"] != "" && $_POST["COMPANY"] != "" && $_POST["CITY"] != "")
			$add = true;
		else
			echo '<p style="color: red;">Вы заполнили не все поля</p>';
		$email = htmlspecialcharsbx($_POST["EMAIL"]);
		$last_name = htmlspecialcharsbx($_POST["LAST_NAME"]);
		$name = htmlspecialcharsbx($_POST["NAME"]);
		$company = htmlspecialcharsbx($_POST["COMPANY"]);
		$city = htmlspecialcharsbx($_POST["CITY"]);
	}
}
if ($add)
{
	// Проверка от дурака, чтобы не подавали заявку 2й раз на эту же дату, проверка по e-mail
	$rs = CIBlockElement::GetList(
		array(), 
		array(
		"IBLOCK_ID" => $IBLOCK_ID,
		"PROPERTY_EMAIL" => $email,
		"PROPERTY_SEMINAR" => $seminar,
		"PROPERTY_SEMINAR_DATE" => date("Y-m-d H:i:s", strtotime($seminar_date))
		),
		false, 
		false,
		array("ID", "PROPERTY_SEMINAR_URL")
	);
	if (intval($rs->SelectedRowsCount()) == 0)
	{
		$arFields = array(
			"ACTIVE" => "Y", 
			"IBLOCK_ID" => $IBLOCK_ID,
			"NAME" => $last_name." ".$name,
			"PROPERTY_VALUES" => array(
				"SEMINAR" => $seminar,
				"LAST_NAME" => $last_name,
				"NAME" => $name,
				"EMAIL" => $email,
				"COMPANY" => $company,
				"CITY" => $city,
				"SEMINAR_DATE" => $seminar_date,
				"SEMINAR_URL" => $url
			)
		);
		$oElement = new CIBlockElement();
		if ($idElement = $oElement->Add($arFields))
		{
			echo '<p style="color: green;">Заявка на семинар '.$seminar_name.' подана</p><p>Для посещения семинара, Вам будет необходимо пройти по <a target="_blank" href="'.$url.'">ссылке</a>, ссылка также будет отправлена на Ваш Email</p>';
			$arEventFields = array(
				"SEMINAR" => $seminar_name,
				"EMAIL_TO" => $email,
				"LINK" => $url,
				"DATE" => $seminar_date
				);
			CEvent::Send("NOTICE_SEMINAR", 's1', $arEventFields);
		}
	}
	else
	{
		$ar_res = $rs->Fetch();
		echo '<p style="color: red;">Заявка на семинар "'.$seminar_name.'" уже была подана</p><p>Для посещения семинара, Вам будет необходимо пройти по <a target="_blank" href="'.$url.'">ссылке</a></p>';
	}
}
else
{
?>
	<form name="seminar_form" method="post" action="<?=$_SERVER["REQUEST_URI"];?>">
		<table>
			<tr>
				<td>E-mail</td><td><input type="email" name="EMAIL" value="<?=$email;?>"></td>
			</tr>
			<tr>
				<td>Фамилия</td><td><input type="text" name="LAST_NAME" value="<?=$last_name;?>"></td>
			</tr>
			<tr>
				<td>Имя</td><td><input type="text" name="NAME" value="<?=$name;?>"></td>
			</tr>
			<tr>
				<td>Компания</td><td><input type="text" name="COMPANY" value="<?=$company;?>"></td>
			</tr>
			<tr>
				<td>Город</td><td><input type="text" name="CITY" value="<?=$city;?>"></td>
			</tr>
		</table>
		<p>Все поля обязательны для заполнения</p>
		<input type="submit" value="Сохранить" name="save">
	</form>
<? }?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>