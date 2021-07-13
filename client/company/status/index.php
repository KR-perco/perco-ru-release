<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Этапы получения статуса партнера");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Этапы получения статуса партнера");

$APPLICATION->SetAdditionalCSS("/css/status.css"); // подключение стилей

$PAI = "";
$PTP = "";
$zayavka_AI = "";
$zayavka_STP = "";
$fzapros_AI = "";
$fzapros_STP = "";
$trebovaniya_AI = "";
$trebovaniya_STP = "";
$site = "";
$usersok = "";
$obuch_schet = "";
$obuch_message = 'Наличие <a href="/client/company/zayavka/">очно обучившихся</a> или <a id="download-schet" href="javascript:void();" onclick="warning_schet();">оплаты</a>';
$stud_ok = 0;
$examens = "";
$sertifikat = "";
$count_si = 0;
$message_SC = "";
$rsCompany = CUser::GetByID($USER->GetID());
$arCompany = $rsCompany->Fetch();
if ($arCompany["UF_PAI"] != "")
	$zayavka_AI = "complete";
if ($arCompany["UF_PAI"] == "Подтверждено")
	$PAI = "complete";
if ($arCompany["UF_PTP"] != "")
	$zayavka_STP = "complete";
if ($arCompany["UF_PTP"] == "Подтверждено")
	$PTP = "complete";
if ($arCompany["PERSONAL_WWW"] == "Подтверждено")
	$site = "complete";
elseif ($arCompany["PERSONAL_WWW"] != "")
	$site = "error";
if ($arCompany["UF_SCAN_ZAPROS"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS"]);
	if ($arFile["DESCRIPTION"] == "Подтверждено")
		$fzapros_AI = "complete";
	elseif ($arFile["DESCRIPTION"])
		$fzapros_AI = "error";
	else
		$fzapros_AI = "wait";
}
if ($arCompany["UF_SCAN_ZAPROS_TP"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS_TP"]);
	if ($arFile["DESCRIPTION"] == "Подтверждено")
		$fzapros_STP = "complete";
	elseif ($arFile["DESCRIPTION"])
		$fzapros_STP = "error";
	else
		$fzapros_STP = "wait";
}
if ($arCompany["UF_SCHET"])
{
	$obuch_message = "Наличие оплаты";
	$arFile = CFile::GetFileArray($arCompany["UF_SCHET"]);
	if ($arFile["DESCRIPTION"] == "Подтверждено")
		$obuch_schet = "complete";
	else
	{
		$obuch_schet = "wait";
		$obuch_message = '<a id="download-schet" href="javascript:void();" onclick="warning_schet();">Наличие оплаты</a>';
	}
}
if (!$arCompany["UF_ZAKUPKA"] && $arCompany["UF_F_ZAKUPOK"])
{
	$arFile = CFile::GetFileArray($arCompany["UF_F_ZAKUPOK"]);
	if ($arFile["DESCRIPTION"] == "Подтверждено")
		$fzakupok = "complete";
	elseif ($arFile["DESCRIPTION"])
		$fzakupok = "error";
	else
		$fzakupok = "wait";
}
elseif ($arCompany["UF_ZAKUPKA"])
	$fzakupok = "complete";
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $arCompany["ID"],
	"WORK_COMPANY_EXACT_MATCH" => "Y"
);
$select = array(
	"SELECT" => array("UF_SERT_D", "UF_SERT_TP", "UF_SERT_SC")
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей
if (intval($rsUsers->SelectedRowsCount()) > 0)
	$usersok = "complete";
$today = mktime(0, 0, 0, date("m"), date("d"), date("Y"));
while($arUser = $rsUsers->Fetch())
{
	if (!$obuch_schet || $obuch_schet == "wait")
	{
		$rsObuch = CIBlockElement::GetList(
			array(),
			array(
			"IBLOCK_ID" => 54,
			"ACTIVE" => "Y",
			"PROPERTY_UID" => $arUser["ID"]
			),
			false,
			false,
			array("ID", "PROPERTY_UID", "PROPERTY_CONFIRM_TRAINING", "PROPERTY_SEMINAR_DATE")
		);
		if (intval($rsObuch->SelectedRowsCount()) > 0)
			$obuch_message = "Наличие очно обучившихся";
		while($arObuch = $rsObuch->GetNext())
		{
			if ($arObuch["PROPERTY_CONFIRM_TRAINING_VALUE"] == "Да")
			{
				$obuch_schet = "complete";
				break;
			}
			else
			{
				$getObuch = strtotime($arObuch["PROPERTY_SEMINAR_DATE_VALUE"]);
				$dateObuch = mktime(0, 0, 0, date("m", $getObuch), date("d", $getObuch), date("Y", $getObuch));	// дата
				if ($dateObuch > $today)
				{
					$obuch_schet = "wait";
					break;
				}
				else
					$obuch_schet = "";
			}
		}
	}
	// считаем пользователей компании с пройденными тестами АИ
	if ($arUser["UF_SERT_D"])
		$countAI++;
	// считаем пользователей компании с пройденными тестами СТП
	if ($arUser["UF_SERT_TP"])
		$countSTP++;
	// считаем пользователей компании с пройденными тестами СЦ
	if ($arUser["UF_SERT_SC"])
		$countSC++;
}
if ($countAI >= 2)
	$examens_AI = "complete";
if ($countSTP >= 3 || ($countSTP >= 2 && $arCompany["UF_SC"]))
	$examens_STP = "complete";
if ($countSC >= 2)
	$examens_SC = "complete";
if ($PAI == "complete" && $usersok == "complete" && $fzapros_AI == "complete" && $obuch_schet)
	$trebovaniya_AI = "complete";
if ($trebovaniya_AI == "complete" && $site == "complete" && $examens_AI == "complete")
{
	$sertifikat_AI = "complete";
	if ($arCompany["UF_SERT_D"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SERT_D"]);
		$download_sert_AI='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать сертификат</a>';
	}
	else
		$download_sert_AI = "Скачать сертификат";
}
else
	$download_sert_AI ="Скачать сертификат";
if ($PTP == "complete" && $usersok == "complete" && $fzapros_STP == "complete" && $fzakupok == "complete")
	$trebovaniya_STP = "complete";
if ($trebovaniya_STP == "complete" && $site == "complete" && $examens_STP == "complete")
{
	$sertifikat_STP = "complete";
	if ($arCompany["UF_SERT_TP"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SERT_TP"]);
		$download_sert_STP='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать сертификат</a>';
	}
	else
		$download_sert_STP = "Скачать сертификат";
}
else
	$download_sert_STP = "Скачать сертификат";
if ($trebovaniya_AI == "complete" && $trebovaniya_STP == "complete" && $site == "complete" && $examens_AI == "complete" && $examens_STP == "complete" && $examens_SC == "complete" && in_array(18, $arCompany["UF_TIP_SERT"]) && in_array(19, $arCompany["UF_TIP_SERT"]))
{
	$sertifikat_SC = "complete";
	if ($arCompany["UF_SERT_SC"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SERT_SC"]);
		$download_sert_SC='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать сертификат</a>';
	}
	else
		$download_sert_SC = "Скачать сертификат";
}
elseif ($trebovaniya_AI == "complete" && $site == "complete" && $examens_AI == "complete" && $examens_SC == "complete" && in_array(18, $arCompany["UF_TIP_SERT"]) && !in_array(19, $arCompany["UF_TIP_SERT"]))
{
	$sertifikat_SC = "complete";
	if ($arCompany["UF_SERT_SC"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SERT_SC"]);
		$download_sert_SC='<a href="'.$arFile["SRC"].'"  target="_blank" download>Скачать сертификат</a>';
	}
	else
		$download_sert_SC = "Скачать сертификат";
}
else
	$download_sert_SC ="Скачать сертификат";
?>
<div class="dop_menu">
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_dop_menu", 
	array(
		"ROOT_MENU_TYPE" => "podmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<div id="status_info">
		<div class="complete" >Принято</div>
		<div class="wait">Ожидает</div>
		<div class="error">Отклонено</div>
	</div>
<?
if (count($arCompany["UF_TIP_SERT"]) > 1)
{
	$first = 'class="first"';
	$second = 'class="second"';
}
elseif (count($arCompany["UF_TIP_SERT"]) == 0)
{
?>
	<div id="to_status">
		<div class="box complete">Регистрация на сайте www.perco.ru</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$usersok;?>"><?if ($usersok) echo "Наличие сотрудников"; else echo '<a href="/client/company/">Наличие сотрудников</a>';?></div>
		<div class="strelka-down-1"></div>
		<div class="box"><a href="/client/company/sertifikaciya/">Наличие заявки на получение статуса</a></div>
	</div>
<?
}
if ($arCompany["UF_SC"])
{
?>
	<div id="SC">
		<h3><?if (in_array(19, $arCompany["UF_TIP_SERT"])) echo "Авторизованный дилер и Сервисный центр (АДСЦ)"; else echo "Сервисный центр (СЦ)";?></h3>
		<div class="box complete">Регистрация на сайте www.perco.ru</div>
		<div class="strelka-down-1"></div>
		<div class="case">
			<div class="box <?=$site;?>">Наличие на сайте <a href="/products/">информации о продукции PERCo</a></div>
			<div class="box <?=$examens_SC;?>">Наличие сданных экзаменов по программе «Сервисный инженер» у 2-х сотрудников</div>
			<div>
				<div class="box <?=$examens_AI;?>">Наличие свидетельства АИ PERCo у 2-х сотрудников</div>
				<div class="strelka-down-1"></div>
				<div class="box <?=$sertifikat_AI;?>"><?=$download_sert_AI;?></div>
			</div>
<?	if (in_array(19, $arCompany["UF_TIP_SERT"])) {?>
			<div>
				<div class="box <?=$examens_STP;?>">Наличие свидетельства менеджера по продажам PERCo у 2-х сотрудников</div>
				<div class="strelka-down-1"></div>
				<div class="box <?=$sertifikat_STP;?>"><?=$download_sert_STP;?></div>
			</div>
<?	}?>
		</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$sertifikat_SC;?>"><?=$download_sert_SC;?></div>
	</div>
	<?=$message_SC;?>
<?
}
else
{
	if (in_array(18, $arCompany["UF_TIP_SERT"]))
	{
?>
	<div id="AI" <?=$first;?>>
		<h3>Авторизованный инсталлятор (АИ)</h3>
		<div class="box complete">Регистрация на сайте www.perco.ru</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$usersok;?>">Наличие сотрудников</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$zayavka_AI;?>">Наличие заявки на получение статуса</div>
		<div class="strelka-down-1"></div>
		<div class="case">
			<div class="box <?=$fzapros_AI;?>"><?if (!$fzapros_AI || $fzapros_AI == "error") echo '<a href="/client/company/sertifikaciya/">Наличие файла с запросом</a>'; else echo "Наличие файла с запросом"?></div>
			<div class="box <?=$obuch_schet;?>"><?=$obuch_message;?></div>
		</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$trebovaniya_AI;?>">Подтверждение заявки</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$examens_AI;?>">Наличие свидетельства АИ PERCo у 2-х сотрудников</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$site;?>">Наличие на сайте <a href="/products/">информации о продукции PERCo</a></div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$sertifikat_AI;?>"><?=$download_sert_AI;?></div>
	</div>
<?
	}
	if (in_array(19, $arCompany["UF_TIP_SERT"]))
	{
?>
	<div id="STP" <?=$second;?>>
		<h3>Сертифицированный Торговый Партнер (СТП)</h3>
		<div class="box complete">Регистрация на сайте www.perco.ru</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$usersok;?>">Наличие сотрудников</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$zayavka_STP;?>">Наличие заявки на получение статуса</div>
		<div class="strelka-down-1"></div>
		<div class="case">
			<div class="box <?=$fzapros_STP;?>"><?if (!$fzapros_STP || $fzapros_STP == "error") echo '<a href="/client/company/sertifikaciya/">Наличие файла с запросом</a>'; else echo "Наличие файла с запросом"?></div>
			<?if (!$arCompany["UF_ZAKUPKA"]) { ?><div class="box <?=$fzakupok;?>"><?if (!$fzakupok || $fzakupok == "error") echo '<a href="/client/company/sertifikaciya/">Наличие файла с объемом закупок</a>'; else echo "Наличие файла с объемом закупок"?></div><? } ?>
		</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$trebovaniya_STP;?>">Подтверждение заявки</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$examens_STP;?>">Наличие свидетельства менеджера по продажам PERCo у 3-х сотрудников</div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$site;?>">Наличие на сайте <a href="/products/">информации о продукции PERCo</a></div>
		<div class="strelka-down-1"></div>
		<div class="box <?=$sertifikat_STP;?>"><?=$download_sert_STP;?></div>
	</div>
<?
	}
}
?>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>