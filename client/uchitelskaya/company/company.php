<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Профиль компании");
$APPLICATION->SetPageProperty("keywords", "Профиль компании");
$APPLICATION->SetPageProperty("description", "Профиль компании");
$APPLICATION->SetTitle("Профиль компании");
?>
<div id="textBlcok">
	<h1>
    <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
$COMPANY_ID = strip_tags(trim($_GET["COMPANY_ID"]));
$rsCompany = CUser::GetByID($COMPANY_ID);
$arCompany = $rsCompany->Fetch();

if (in_array(18,$arCompany["UF_TIP_SERT"]) && in_array(19,$arCompany["UF_TIP_SERT"]))
	$partners = "АИ, СТП";
elseif (in_array(18,$arCompany["UF_TIP_SERT"]))
	$partners = "АИ";
elseif (in_array(19,$arCompany["UF_TIP_SERT"]))
	$partners = "СТП";
elseif (in_array(21,$arCompany["UF_TIP_SERT"]))
	$partners = "АС";
if ($arCompany["UF_SCAN_ZAPROS"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS"]);
	$scanZapros = '<a href="'.$arFile["SRC"].' "  target="_blank" download>Скачать</a>';
	$scanZapros_ok = $arFile["DESCRIPTION"];
}
if ($arCompany["UF_SCAN_ZAPROS_TP"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS_TP"]);
	$scanZaprosTP = '<a href="'.$arFile["SRC"].' "  target="_blank" download>Скачать</a>';
	$scanZaprosTP_ok = $arFile["DESCRIPTION"];
}
if ($arCompany["UF_SCHET"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SCHET"]);
	$schet='<a href="'.$arFile["SRC"].' "  target="_blank" download>Скачать</a>';
	$schet_ok = $arFile["DESCRIPTION"];
}
if ($arCompany["UF_ZAKUPKA"])
	$zakupki = "PERCo";
else
{
	$zakupki = "Другое";
	if ($arCompany["UF_F_ZAKUPOK"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_F_ZAKUPOK"]);
		$fzakupok ='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать</a>';
		$fzakupok_ok = $arFile["DESCRIPTION"];
	}
}
if ($arCompany["UF_NAL_OBORUD_PERCO"])
{
	$rsGender = CUserFieldEnum::GetList(array(), array("ID" => $arCompany["UF_NAL_OBORUD_PERCO"]));
	if($arGender = $rsGender->Fetch())
		$oborudovanie=$arGender["VALUE"];
}
if ($arCompany["UF_SERT_D"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SERT_D"]);
	$arSertAI='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать</a>';
}
if ($arCompany["UF_SERT_TP"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SERT_TP"]);
	$arSertTP='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать</a>';
}
if ($arCompany["UF_SERT_SC"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SERT_SC"]);
	$arSertSC='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать</a>';
}
echo '
	<p><a href="/client/uchitelskaya/company/">Вернуться к выбору компании</a></p>';
	if ($arCompany["UF_SC"])
		echo '<p style="margin-top: 20px;">Сертификат сгенерируется при условии выполнения всех требований компанией</p>';
		echo '<ul><li>Авторизированный инсталятор: <a href="/createpdf/check_sc.php?ID='.$arCompany["ID"].'&CERT=D">Сгенерировать</a>.</li>';
		echo '<li>Торговый партнер: <a href="/createpdf/check_sc.php?ID='.$arCompany["ID"].'&CERT=TP">Сгенерировать</a>.</li>';
		echo '<li>Сервисный центр: <a href="/createpdf/check_sc.php?ID='.$arCompany["ID"].'&CERT=SC">Сгенерировать</a>.</li></ul>';
echo '
	<table width="100%" border="1" cellspacing="0" cellpadding="4">
		<thead>
			<tr><td width="240">Поле</td><td colspan="2">Значение</td></tr>
		</thead>
		<tr><td>Фамилия Имя Отчество</td><td colspan="2">'.$arCompany["LAST_NAME"].' '.$arCompany["NAME"].' '.$arCompany["SECOND_NAME"].'</td></tr>
		<tr><td>E-mail</td><td colspan="2">'.$arCompany["EMAIL"].'</td></tr>
		<tr><td>Последняя авторизация</td><td colspan="2">'.$arCompany["LAST_LOGIN"].'</td></tr>
		<tr><td>Дата регистрации</td><td colspan="2">'.$arCompany["DATE_REGISTER"].'</td></tr>
		<tr><td>Компания</td><td colspan="2">'.$arCompany["WORK_COMPANY"].'</td></tr>
		<tr><td>Направления деятельности</td><td colspan="2">'.$arCompany["WORK_PROFILE"].'</td></tr>
		<tr><td>Web-сайт</td><td>'.$arCompany["WORK_WWW"].'</td><td width="250px" align="center">';
		if ($arCompany["WORK_WWW"])
		{
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&sait=1">Подтвердить</a> | ';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&sait=2">Отменить</a>';
			switch($_GET["sait"])
			{
				case 1:
					$user = new CUser;
					$user->Update($arCompany["ID"], array("PERSONAL_WWW" => "Подтверждено"));
					echo '<span style="margin-left: 10px;">(Подтверждено)</span>';
					break;
				case 2:
					$user = new CUser;
					$user->Update($arCompany["ID"], array("PERSONAL_WWW" => "Отменено"));
					echo '<span style="margin-left: 10px;">(Отменено)</span>';
					break;
				default:
					if ($arCompany["PERSONAL_WWW"])
						echo '<span style="margin-left: 10px;">('.$arCompany["PERSONAL_WWW"].')</span>';
					break;
			}
		}
		echo '</td></tr>';
		echo '<tr><td>Телефон</td><td colspan="2">'.$arCompany["WORK_PHONE"].'</td></tr>
		<tr><td>Факс</td><td colspan="2">'.$arCompany["WORK_FAX"].'</td></tr>
		<tr><td>Улица, дом</td><td colspan="2">'.$arCompany["WORK_STREET"].'</td></tr>
		<tr><td>Город</td><td colspan="2">'.$arCompany["WORK_CITY"].'</td></tr>
		<tr><td>Почтовый индекс</td><td colspan="2">'.$arCompany["WORK_ZIP"].'</td></tr>
		<tr><td>Страна</td><td colspan="2">'.$arCompany["WORK_COUNTRY"].'</td></tr>
		<tr><td>Файл с официальным запросом АИ</td><td>'.$scanZapros.'</td><td align="center">';
		if ($scanZapros)
		{
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&scanZapros=1">Подтвердить</a> | ';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&scanZapros=2">Отменить</a>';
			switch($_GET["scanZapros"])
			{
				case 1:
					CFile::UpdateDesc($arCompany["UF_SCAN_ZAPROS"], "Подтверждено");
					echo '<span style="margin-left: 10px;">(Подтверждено)</span>';
					break;
				case 2:
					CFile::UpdateDesc($arCompany["UF_SCAN_ZAPROS"], "Удалено");
						echo '<span style="margin-left: 10px;">(Отменено)</span>';
					break;
				default:
					if ($scanZapros_ok)
						echo '<span style="margin-left: 10px;">('.$scanZapros_ok.')</span>';
					break;
			}
		}
		echo '</td></tr>';
		if ($scanZaprosTP)
		{
			echo '<tr><td>Файл с официальным запросом СТП</td><td>'.$scanZaprosTP.'</td><td align="center">';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&scanZaprosTP=1">Подтвердить</a> | ';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&scanZaprosTP=2">Отменить</a>';
			switch($_GET['scanZaprosTP'])
			{
				case 1:
					CFile::UpdateDesc($arCompany["UF_SCAN_ZAPROS_TP"], "Подтверждено");
						echo '<span style="margin-left: 10px;">(Подтверждено)</span>';
					break;
				case 2:
					CFile::UpdateDesc($arCompany["UF_SCAN_ZAPROS_TP"], "Удалено");
						echo '<span style="margin-left: 10px;">(Отменено)</span>';
					break;
				default:
					if ($scanZaprosTP_ok)
						echo '<span style="margin-left: 10px;">('.$scanZaprosTP_ok.')</span>';
					break;
			}
			echo '</td></tr>';
		}
		echo '<tr><td>ИНН</td><td colspan="2">'.$arCompany["UF_INN"].'</td></tr>
		<tr><td>Тип партнерства</td><td colspan="2">'.$partners.'</td></tr>
		<tr><td>КИТ</td><td colspan="2">'.$oborudovanie.'</td></tr>';
		if ($partners != "АС")
			echo '<tr><td>Поставщик</td><td colspan="2">'.$zakupki.'</td></tr>';
		if (!$arCompany["UF_ZAKUPKA"] && strpos($partners, "СТП") !== false)
		{
			echo '<tr><td>Подтверждение закупок (руб)</td><td colspan="2">'.$arCompany["UF_ZAKUPKI"].'</td></tr>';
			echo '<tr><td>Файл с объемом закупок</td><td>'.$fzakupok.'</td><td align="center">';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&fzakupok=1">Подтвердить</a> | ';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&fzakupok=2">Отменить</a>';
			if ($fzakupok)
			{
				switch($_GET["fzakupok"])
				{
					case 1:
						CFile::UpdateDesc($arCompany["UF_F_ZAKUPOK"], "Подтверждено");
						echo '<span style="margin-left: 10px;">(Подтверждено)</span>';
						break;
					case 2:
						CFile::UpdateDesc($arCompany["UF_F_ZAKUPOK"], "Удалено");
						echo '<span style="margin-left: 10px;">(Отменено)</span>';
						break;
					default:
						if ($fzakupok_ok)
							echo '<span style="margin-left: 10px;">('.$fzakupok_ok.')</span>';
						break;
				}
			}
			echo '</td></tr>';
		}
		if ($schet)
		{
			echo '<tr><td>Счет на оплату</td><td>'.$schet.'</td><td align="center">';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&schet=1">Подтвердить</a> | ';
			echo '<a href="?COMPANY_ID='.$arCompany["ID"].'&schet=2">Отменить</a>';
			switch($_GET["schet"])
			{
				case 1:
					CFile::UpdateDesc($arCompany["UF_SCHET"], "Подтверждено");
					echo '<span style="margin-left: 10px;">(Подтверждено)</span>';
					break;
				case 2:
					CFile::UpdateDesc($arCompany["UF_SCHET"], "");
					break;
				default:
					if ($schet_ok)
						echo '<span style="margin-left: 10px;">('.$schet_ok.')</span>';
					break;
			}
			echo '</td></tr>';
		}
		if ($arSertAI || $arCompany["UF_SERT_DATE"])
			echo '<tr><td>Сертификат АИ</td><td>'.$arSertAI.'</td><td>'.$arCompany["UF_SERT_DATE"].'</td></tr>';
		if ($arSertTP || $arCompany["UF_SERT_DATE_TP"])
			echo '<tr><td>Сертификат СТП</td><td>'.$arSertTP.'</td><td>'.$arCompany["UF_SERT_DATE_TP"].'</td></tr>';
		if ($arSertSC || $arCompany["UF_SERT_DATE_SC"])
			echo '<tr><td>Сертификат СЦ / АДСЦ</td><td>'.$arSertSC.'</td><td>'.$arCompany["UF_SERT_DATE_SC"].'</td></tr>';
	echo '</table>';
?>
	</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>