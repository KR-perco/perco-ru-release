<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
?>
<?
$rsCompany = CUser::GetByID($USER->GetID()); //выбираем компанию по id из базы
$arCompany = $rsCompany->Fetch(); //получаем экземпляр компании
?>
<style type="text/css">
<?
if (!in_array(21, $arCompany["UF_TIP_SERT"])) //если "Тип партнерства" содержит "Пользователи систем"
	echo '#infozayvka form, #UF_PAI, #UF_PTP { display: none; }';
else
{
	echo '#UF_PAS { display: none; }';
	if ($arCompany["UF_PAS"]) //если "Условие для сертификации Администратора систем" не пустое
		echo '#infozayvka form { display: none; }';
}
?>
</style>
<div class="dop_menu">
<? $APPLICATION->IncludeComponent( //подключаем меню
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
<?
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $USER->GetID(),
	"WORK_COMPANY_EXACT_MATCH" => "Y"
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем всех пользователей нашей компании
if (intval($rsUsers->SelectedRowsCount()) == 0)
	echo '<p style="color: red;">Для оформления заявки вы должны <a href="/client/company/">добавить сотрудников</a>.</p>';
else
{
	$aias = false;
	$tp = false;
	$fz = false;
	if ($arCompany["UF_SCAN_ZAPROS"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS"]);
		if ($arFile["DESCRIPTION"] == "Удалено")
			$aias = true;
	}
	if ($arCompany["UF_SCAN_ZAPROS_TP"])
	{
		$arFileTP = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS_TP"]);
		if ($arFileTP["DESCRIPTION"] == "Удалено")
			$tp = true;
	}
	if ($arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"])
	{
		$arFileZ = CFile::GetFileArray($arCompany["UF_F_ZAKUPOK"]);
		if ($arFileZ["DESCRIPTION"] == "Удалено")
			$fz = true;
	}
	if (!in_array(21, $arCompany["UF_TIP_SERT"]) && ((!$arCompany["UF_PAI"] || !$arCompany["UF_SCAN_ZAPROS"] || $aias) || (!$arCompany["UF_PTP"] || (!$arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]) || !$arCompany["UF_SCAN_ZAPROS_TP"] || $tp || $fz)))
	{
?>
	<div class="changestatus">
<?
		if (!$arCompany["UF_PAI"] || !$arCompany["UF_SCAN_ZAPROS"] || ($arCompany["UF_PAI"] && $aias))
			echo '<input id="AI" type="button" value="Авторизованный инсталлятор"/> ';
		if (!$arCompany["UF_PTP"] || (!$arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]) || !$arCompany["UF_SCAN_ZAPROS_TP"] || $tp || $fz)
			echo '<input id="TP" type="button" value="Сертифицированный торговый партнер"/>';
?>
	</div>
<? } ?>
	<div id="infozayvka">
<?
	if (in_array(21, $arCompany["UF_TIP_SERT"]))
	{
		$APPLICATION->SetPageProperty("title", "Заявка на подтверждение квалификации сотрудника");
		$APPLICATION->SetTitle("Заявка на подтверждение квалификации сотрудника");
		$user_prop = array("UF_SCAN_ZAPROS", "UF_INN");
		if ($arCompany["UF_PAS"] && $arCompany["UF_SCAN_ZAPROS"])
		{
			if ($arFile["DESCRIPTION"] == "Удалено")
				echo '<p id="asstatus" style="color: red;" value="2">В Вашей заявке на подтверждение квалификации сотрудника был загружен не правильный файл с официальным запросом, перезагрузите файл.</p>';
			else
				echo '<p id="asstatus">Ваша заявка на подтверждение квалификации '.$arCompany["UF_PAS"].'.</p>';
		}
		elseif ($arCompany["UF_PAS"] && !$arCompany["UF_SCAN_ZAPROS"])
			echo '<p id="asstatus" style="color: red;" value="1">Ваша заявка на подтверждение квалификации сотрудника не будет рассмотрена, пока Вы не загрузите файл с официальным запросом.</p>';
	}
	else
	{
		$APPLICATION->SetPageProperty("title", "Заявка на получение статуса партнера");
		$APPLICATION->SetTitle("Заявка на получение статуса партнера");
		$user_prop = array("UF_SCAN_ZAPROS", "UF_SCAN_ZAPROS_TP", "UF_INN", "UF_NAL_OBORUD_PERCO", "UF_ZAKUPKI", "UF_ZAKUPKA", "UF_F_ZAKUPOK");
		if ($arCompany["UF_PAI"] && $arCompany["UF_SCAN_ZAPROS"])
		{
			if ($arFile["DESCRIPTION"] == "Удалено")
				echo '<p id="aistatus" style="color: red;" value="2">В Вашей заявке на статус Авторизованного инсталлятора был загружен не правильный файл с официальным запросом, перезагрузите файл.</p>';
			else
				echo '<p id="aistatus">Ваша заявка на статус Авторизованного инсталлятора '.$arCompany["UF_PAI"].'.</p>';
		}
		elseif ($arCompany["UF_PAI"] && !$arCompany["UF_SCAN_ZAPROS"])
			echo '<p id="aistatus" style="color: red;" value="1">Ваша заявка на статус Авторизованного инсталлятора не будет рассмотрена, пока Вы не загрузите файл с официальным запросом.</p>';
		if ($arCompany["UF_PTP"] && (($arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]) || $arCompany["UF_ZAKUPKA"]) && $arCompany["UF_SCAN_ZAPROS_TP"])
		{
			if ($arFileTP["DESCRIPTION"] == "Удалено" && ($arFileZ["DESCRIPTION"] == "Удалено" && !$arCompany["UF_ZAKUPKA"]))
				echo '<p id="tpstatus" style="color: red;" value="3">В Вашей заявке на статус Сертифицированного торгового партнера был загружен не правильный файл с официальным запросом и файл подтверждающий объемы закупок (накладная), перезагрузите файлы.</p>';
			elseif ($arFileTP["DESCRIPTION"] == "Удалено")
				echo '<p id="tpstatus" style="color: red;" value="2">В Вашей заявке на статус Сертифицированного торгового партнера был загружен не правильный файл с официальным запросом, перезагрузите файл.</p>';
			elseif ($arFileZ["DESCRIPTION"] == "Удалено" && !$arCompany["UF_ZAKUPKA"])
				echo '<p id="tpstatus" style="color: red;" value="z2">В Вашей заявке на статус Сертифицированного торгового партнера был загружен не правильный файл подтверждающий объемы закупок (накладную), перезагрузите файл.</p>';
			if ($arFileTP["DESCRIPTION"] != "Удалено" && (($arFileZ["DESCRIPTION"] != "Удалено" && !$arCompany["UF_ZAKUPKA"]) || $arCompany["UF_ZAKUPKA"]))
				echo '<p id="tpstatus">Ваша заявка на статус Сертифицированного торгового партнера '.$arCompany["UF_PTP"].'.</p>';
		}
		elseif ($arCompany["UF_PTP"] && (((!$arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]) || $arCompany["UF_ZAKUPKA"]) || !$arCompany["UF_SCAN_ZAPROS_TP"]))
		{
			if (!$arCompany["UF_SCAN_ZAPROS_TP"] && (!$arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]))
				echo '<p id="tpstatus" style="color: red;" value="3">Ваша заявка на статус Сертифицированного торгового партнера не будет рассмотрена, пока Вы не загрузите файл с официальным запросом и файл подтверждающий объемы закупок (накладную).</p>';
			elseif (!$arCompany["UF_SCAN_ZAPROS_TP"])
				echo '<p id="tpstatus" style="color: red;" value="1">Ваша заявка на статус Сертифицированного торгового партнера не будет рассмотрена, пока Вы не загрузите файл с официальным запросом.</p>';
			elseif (!$arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"])
				echo '<p id="tpstatus" style="color: red;" value="z1">Ваша заявка на статус Сертифицированного торгового партнера не будет рассмотрена, пока Вы не загрузите файл подтверждающий объемы закупок (накладную).</p>';
		}
		$obuch_schet = "";
		if ($arCompany["UF_SCHET"])
		{
			$arFile = CFile::GetFileArray($arCompany["UF_SERT_TP"]);
			if ($arFile["DESCRIPTION"] == "Оплачено")
				$obuch_schet = "schetoplacheno";
			elseif ($arFile["DESCRIPTION"])
				$obuch_schet = "schetozhidanie";
		}
		if (!$obuch_schet)
		{
			while($arUser = $rsUsers->Fetch())
			{
				$rs = CIBlockElement::GetList(
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
				//intval($rs->SelectedRowsCount()) > 0
				while($ar = $rs->GetNext())
				{
					if ($ar["PROPERTY_CONFIRM_TRAINING_VALUE"] == "Да")
					{
						$obuch_schet = "obuchda";
						break;
					}
					else
					{
						$getObuch = strtotime($ar["PROPERTY_SEMINAR_DATE_VALUE"]);
						$dateObuch = mktime(0, 0, 0, date("m", $getObuch), date("d", $getObuch), date("Y", $getObuch));	// дата
						$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
						if ($dateObuch > $today)
						{
							$obuch_schet = "obuchozhidanie";
							break;
						}
					}
				}
				if ($obuch_schet)
					break;
			}
		}
		switch($obuch_schet)
		{
			case "schetoplacheno":
			case "obuchda":
				break;
			case "schetozhidanie":
				echo '<p id="obuch_schet">Проверяется оплата счета, если Вы потеряли счет, тогда можете <a id="download-schet" href="javascript:void();" onclick="warning_schet();">получить новый</a>.</p>';
				break;
			case "obuchozhidanie":
				echo '<p id="obuch_schet">Вы подали заявку на очное обучение, но пока ни один из сотрудников его не прошел.</p>';
				break;
			default:
				echo '<p id="schet">Для того, чтобы Ваша заявка была рассмотрена в Вашей компании должен быть сотрудник, прошедший очное обучение (<a href="/client/company/zayavka/">подать заявку на обучение</a>), или оплачена сертификация (стоимость 10 000 рубл. <a id="download-schet" href="javascript:void();" onclick="warning_schet();">Скачать счет</a>)</p>';
				break;
		}
	}
	$APPLICATION->IncludeComponent("bitrix:main.profile", "company-dop-info", array(
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"SET_TITLE" => "N",
		"USER_PROPERTY" => $user_prop,
		"SEND_INFO" => "N",
		"CHECK_RIGHTS" => "N",
		"USER_PROPERTY_NAME" => "",
		"AJAX_OPTION_ADDITIONAL" => ""
		),
		false
	);
?>
	</div>
<? } ?>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>