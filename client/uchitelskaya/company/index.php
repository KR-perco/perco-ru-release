<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Компании");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Компании");
?>
<style type="text/css">
.list_spec
{
	background: #e5f5fe none repeat scroll 0 0;
	border: 1px solid #1593DB;
	color: black;
	display: none;
	padding: 5px;
	position: absolute;
	text-align: left;
	top: -45px;
	width: 180px !important;
}
.td_spec
{
	cursor: pointer;
	position: relative;
	text-decoration: underline;
	color: #0971FF;
}
.uchitelskaya_jurnal a:hover { color: green; }
</style>
<script type="text/javascript" src="/scripts/learning/sortview.js"></script>
<script type="text/javascript" src="/scripts/where-to-buy/view.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
<?
if (!isset($_COOKIE["ai"]) && !isset($_COOKIE["stp"]) && !isset($_COOKIE["sc"]) && !isset($_COOKIE["as"]))
{
	$ai = 'checked="checked"';
	$stp = 'checked="checked"';
	$as = 'checked="checked"';
	$sc = 'checked="checked"';
	echo 'setCookie("ai", 1, 1);'."\n";
	echo 'setCookie("stp", 1, 1);'."\n";
	echo 'setCookie("as", 1, 1);'."\n";
	echo 'setCookie("sc", 1, 1);'."\n";
}
else
{
	echo 'Sort("ai",0);'."\n";
	echo 'Sort("stp",0);'."\n";
	echo 'Sort("as",0);'."\n";
	echo 'Sort("sc",0);'."\n";
	if (isset($_COOKIE["ai"]) && $_COOKIE["ai"] == 1)
	{
		$ai = 'checked="checked"';
		echo 'Sort("ai",1);'."\n";
	}
	if (isset($_COOKIE["stp"]) && $_COOKIE["stp"] == 1)
	{
		$stp = 'checked="checked"';
		echo 'Sort("stp",1);'."\n";
	}
	if (isset($_COOKIE["as"]) && $_COOKIE["as"] == 1)
	{
		$as = 'checked="checked"';
		echo 'Sort("as",1);'."\n";
	}
	if (isset($_COOKIE["sc"]) && $_COOKIE["sc"] == 1)
	{
		$sc = 'checked="checked"';
		echo 'Sort("sc",1);'."\n";
	}
}
?>
		$("#ai").change(function(){
			if (this.checked)
			{
				Sort("ai",1);
				ai = 1;
			}
			else
			{
				Sort("ai",0);
				ai = 0;
			}
			if (document.getElementById('stp').checked)
				Sort("stp",1);
			if (document.getElementById('sc').checked)
				Sort("sc",1);
			if (document.getElementById('as').checked)
				Sort("as",1);
			setCookie("ai", ai, 1);
		});
		$("#stp").change(function(){
			if (this.checked)
			{
				Sort("stp",1);
				stp = 1;
			}
			else
			{
				Sort("stp",0);
				stp = 0;
			}
			if (document.getElementById('ai').checked)
				Sort("ai",1);
			if (document.getElementById('sc').checked)
				Sort("sc",1);
			if (document.getElementById('as').checked)
				Sort("as",1);
			setCookie("stp", stp, 1);
		});
		$("#as").change(function(){
			if (this.checked)
			{
				Sort("as",1);
				as = 1;
			}
			else
			{
				Sort("as",0);
				as = 0;
			}
			if (document.getElementById('ai').checked)
				Sort("ai",1);
			if (document.getElementById('stp').checked)
				Sort("stp",1);
			if (document.getElementById('sc').checked)
				Sort("sc",1);
			setCookie("as", as, 1);
		});
		$("#sc").change(function(){
			if (this.checked)
			{
				Sort("sc",1);
				sc = 1;
			}
			else
			{
				Sort("sc",0);
				sc = 0;
			}
			if (document.getElementById('ai').checked)
				Sort("ai",1);
			if (document.getElementById('stp').checked)
				Sort("stp",1);
			if (document.getElementById('as').checked)
				Sort("as",1);
			setCookie("sc", sc, 1);
		});
	});
</script>
<?
if ($_GET["date_active"] == "Y")
{
	$date_active = "LAST_LOGIN_2";
	$date_name = '<a href="/client/uchitelskaya/company/">1</a> | 2';
}
else
{
	$date_active = "LAST_LOGIN_1";
	$date_name = '1 | <a href="?date_active=Y">2</a>';
}
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
	<h1>
    <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p><a href="/client/company/service-center/">Поддержка сервисных центров</a></p>
	<div id="uchitelskaya_form">
		<form action="#" name="checkform" method="get" enctype="multiple/form-data">
			<label for="ai"><input type="checkbox" name="ai" id="ai" <?=$ai;?>/>АИ</label> 
			<label for="stp"><input type="checkbox" name="stp" id="stp" <?=$stp;?>/>СТП</label> 
			<label for="sc"><input type="checkbox" name="sc" id="sc" <?=$sc;?>/>СЦ</label> 
			<label for="as"><input type="checkbox" name="as" id="as" <?=$as;?>/>АС</label>
		</form>
		<span style="display: block; float: right;"><?=$date_name;?></span>
	</div>
	<table class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
		<thead style="text-align:center;">
			<tr>
				<td id="uchitelskaya_company_td_1" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Компания</td>
				<td id="uchitelskaya_company_td_2" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Сотрудники</td>
				<td id="uchitelskaya_company_td_3" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />УЦ</td>
				<td id="uchitelskaya_company_td_4" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />Оплата</td>
				<td id="uchitelskaya_company_td_5" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ</td>
				<td id="uchitelskaya_company_td_6" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АИ К</td>
				<td id="uchitelskaya_company_td_7" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />СТП</td>
				<td id="uchitelskaya_company_td_8" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />СТП К</td>
				<td id="uchitelskaya_company_td_9" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АС</td>
				<td id="uchitelskaya_company_td_10" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />СЦ</td>
				<td id="uchitelskaya_company_td_11" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />СЦ К</td>
				<td id="uchitelskaya_company_td_12" valign="top"><img src="/bitrix/images/icons/up_down.gif" /><br />АДСЦ</td>
			</tr>
		</thead>
		<tbody>
<?
$filter = Array
(
	"GROUPS_ID" => 32,
	$date_active => date("d.m.Y", mktime(0,0,0, date("m")-3, date("d"), date("Y")))
);
$arParameters = Array
(
	"SELECT" => array("UF_TIP_SERT", "UF_PAI", "UF_PTP", "UF_SC", "UF_PAS", "UF_SCHET", "UF_SCAN_ZAPROS", "UF_SCAN_ZAPROS_TP", "UF_ZAKUPKA", "UF_F_ZAKUPOK")
);
$rsCompany = CUser::GetList($by="id", $order="desc", $filter, $arParameters); // выбираем пользователей
while($arCompany = $rsCompany->GetNext())
{
	$scanZapros = "";
	$scanZaprosTP = false;
	$schet_ok = false;
	$fzakupok_ok = false;
	$podtverzhdenieAI = false;
	$podtverzhdenieTP = false;
	$podtverzhdenieAS = false;
	$uf_pai = "";
	$uf_ptp = "";
	$uf_pas = "";
	$uf_sc = "";
	$adsc = "";
	$pskov = "";
	$schet = "";
	$countSertAI = 0;
	$arSpecAI = array();
	$countSertTP = 0;
	$arSpecTP = array();
	$countSertSC = 0;
	$arSpecSC = array();
	if ($arCompany["UF_SCAN_ZAPROS"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS"]);
		$scanZapros = $arFile["DESCRIPTION"];
	}
	if ($arCompany["UF_SCAN_ZAPROS_TP"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SCAN_ZAPROS"]);
		$scanZaprosTP = $arFile["DESCRIPTION"];
	}
	if ($arCompany["UF_SCHET"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_SCHET"]);
		$schet ='<a href="'.$arFile["SRC"].'"  target="_blank">Скачать</a>';
		if ($arFile["DESCRIPTION"] == "Подтверждено")
			$schet_ok = true;
	}
	if (!$arCompany["UF_ZAKUPKA"] && $arCompany["UF_F_ZAKUPOK"])
	{
		$arFile = CFile::GetFileArray($arCompany["UF_F_ZAKUPOK"]);
		if ($arFile["DESCRIPTION"] == "Подтверждено")
			$fzakupok_ok = true;
	}
	$filterUser = Array
	(
		"ACTIVE" => "Y",
		"WORK_COMPANY" => $arCompany["ID"],
		"WORK_COMPANY_EXACT_MATCH" => "Y"
	);
	$paramUser = Array
	(
		"SELECT" => array("UF_SERT_DATE", "UF_SERT_DATE_TP", "UF_SERT_DATE_SC")
	);
	$Users = CUser::GetList($by="id", $order="desc", $filterUser, $paramUser); // выбираем пользователей
	if (intval($Users->SelectedRowsCount()) > 0)
		$sotrudniki = '<a href="/client/uchitelskaya/company/sotrudniki.php?COMPANY_ID='.$arCompany["ID"].'">Сотрудники</a>';
	else
		$sotrudniki = "";
	echo '<tr id="'.$arCompany["ID"].'"><td><a href="/client/uchitelskaya/company/company.php?COMPANY_ID='.$arCompany["ID"].'">'.$arCompany["WORK_COMPANY"].'</a></td><td>'.$sotrudniki.'</td>';
	while($arUser = $Users->Fetch())
	{
		$arFilterSpisok = Array("IBLOCK_ID"=>54, "ACTIVE"=>"Y", "PROPERTY_UID"=>$arUser["ID"],"PROPERTY_CONFIRM_TRAINING_VALUE"=>"Да");
		$arSelectSpisok = Array("ID");
		$resSpisok = CIBlockElement::GetList(Array("ORDER"=>"ASC"), $arFilterSpisok, false, Array(), $arSelectSpisok);
		if ($arSpisok = $resSpisok->Fetch())
			$pskov = "да";
		// считаем пользователей компании с пройденными тестами АИ
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-3, date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_DATE"] && $endSertDate > $today)
		{
			$countSertAI++;
			$arSpecAI[] = $arUser["LAST_NAME"] . " " . date("d.m.Y", $endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1));
		}
		// считаем пользователей компании с пройденными тестами СТП
		$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-3, date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_DATE_TP"] && $endSertDate > $today)
		{
			$countSertTP++;
			$arSpecTP[] = $arUser["LAST_NAME"] . " " . date("d.m.Y", mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1));
		}
		// считаем пользователей компании с пройденными тестами СЦ
		$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-3, date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_DATE_SC"] && $endSertDate > $today)
		{
			$countSertSC++;
			$arSpecSC[] = $arUser["LAST_NAME"] . " " . date("d.m.Y", mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1));
		}
	}
	echo "<td>".$pskov."</td>";
	echo "<td>".$schet."</td>";
	if (in_array(18, $arCompany["UF_TIP_SERT"]))	// Если авторизованный инсталлятор
	{
		if (!$arCompany["UF_SC"])
			$arAI[] = $arCompany["ID"];
		if ($scanZapros == "Подтверждено" && ($pskov || $schet_ok))
			$podtverzhdenieAI = "активно";
		elseif (($pskov || $schet_ok) && ($scanZapros == "Удалено" || !$arCompany["UF_SCAN_ZAPROS"]))
			$podtverzhdenieAI = "ожидание";
		elseif ((!$scanZapros && $arCompany["UF_SCAN_ZAPROS"]) || (!$pskov && $schet && !$schet_ok))
			$podtverzhdenieAI = "участие";
		if ($arCompany["UF_PAI"] == "Подтверждено" && $podtverzhdenieAI == "активно")
			$uf_pai = "Подтверждено";
		elseif ($arCompany["UF_PAI"] != "" && $podtverzhdenieAI == "активно")
			$uf_pai = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_PAI=1">Подтвердить</a>';
		elseif ($arCompany["UF_PAI"] != "" && $podtverzhdenieAI == "участие")
			$uf_pai = "Проверить";
		elseif ($arCompany["UF_PAI"] != "" && $podtverzhdenieAI == "ожидание")
			$uf_pai = "Ожидание";
		else
			$uf_pai = "";
		if ($_GET["COMPANY_ID"] == $arCompany["ID"] && $_GET["UF_PAI"] == 1)
		{
			SetUserField("USER", $arCompany["ID"], "UF_PAI", "Подтверждено");
			$uf_pai = "Подтверждено";
		}
	}
	echo "<td>".$uf_pai."</td>";
	if ($countSertAI == 0)
		echo '<td align="center"><span style="display:none">0</span></td>';
	else
	{
		sort($arSpecAI);
		echo '<td align="center" class="td_spec" onmouseout="specialistsHide(\'spec_ai'.$arCompany["ID"].'\');" onmouseover="specialistsView(\'spec_ai'.$arCompany["ID"].'\');">'.$countSertAI.'<div id="spec_ai'.$arCompany["ID"].'" class="list_spec">'.implode("<br />", $arSpecAI).'</div></td>';
	}
	if (in_array(19, $arCompany["UF_TIP_SERT"]))	// Если торговый партнер
	{
		if (!$arCompany["UF_SC"])
			$arSTP[] = $arCompany["ID"];
		if ($scanZaprosTP == "Подтверждено" && ($fzakupok_ok || $arCompany["UF_ZAKUPKA"]))
			$podtverzhdenieTP = "активно";
		elseif (((!$arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]) || ($scanZaprosTP == "Удалено" || !$arCompany["UF_SCAN_ZAPROS_TP"])))
			$podtverzhdenieTP = "ожидание";
		elseif ((!$scanZaprosTP && $arCompany["UF_SCAN_ZAPROS_TP"]) || (!$fzakupok_ok && $arCompany["UF_F_ZAKUPOK"] && !$arCompany["UF_ZAKUPKA"]))
			$podtverzhdenieTP = "участие";
		if ($arCompany["UF_PTP"] == "Подтверждено" && $podtverzhdenieTP == "активно")
			$uf_ptp = "Подтверждено";
		elseif ($arCompany["UF_PTP"] != "" && $podtverzhdenieTP == "активно")
			$uf_ptp = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_PTP=1">Подтвердить</a>';
		elseif ($arCompany["UF_PTP"] != "" && $podtverzhdenieTP == "участие")
			$uf_ptp = "Проверить";
		elseif ($arCompany["UF_PTP"] != "" && $podtverzhdenieTP == "ожидание")
			$uf_ptp = "Ожидание";
		else
			$uf_ptp = "";
		if ($_GET["COMPANY_ID"] == $arCompany["ID"] && $_GET["UF_PTP"] == 1)
		{
			SetUserField("USER", $arCompany["ID"], "UF_PTP", "Подтверждено");
			$uf_ptp = "Подтверждено";
		}
	}
	echo "<td>".$uf_ptp."</td>";
	if ($countSertTP == 0)
		echo '<td align="center"><span style="display:none">0</span></td>';
	else
	{
		sort($arSpecTP);
		echo '<td align="center" class="td_spec" onmouseout="specialistsHide(\'spec_tp'.$arCompany["ID"].'\');" onmouseover="specialistsView(\'spec_tp'.$arCompany["ID"].'\');">'.$countSertTP.'<div id="spec_tp'.$arCompany["ID"].'" class="list_spec">'.implode("<br />", $arSpecTP).'</div></td>';
	}
	if (in_array(21, $arCompany["UF_TIP_SERT"]))	// Если администратор систем
	{
		if (!$arCompany["UF_SC"])
			$arAS[] = $arCompany["ID"];
		if ($scanZapros == "Подтверждено")
			$podtverzhdenieAS = "активно";
		elseif ($scanZapros == "Удалено" || !$arCompany["UF_SCAN_ZAPROS"])
			$podtverzhdenieAS = "ожидание";
		elseif (!$scanZapros && $arCompany["UF_SCAN_ZAPROS"])
			$podtverzhdenieAS = "участие";
		if ($arCompany["UF_PAS"] == "Подтверждено" && $podtverzhdenieAS == "активно")
			$uf_pas = "Подтверждено";
		elseif ($arCompany["UF_PAS"] != "" && $podtverzhdenieAS == "активно")
			$uf_pas = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_PAS=1">Подтвердить</a>';
		elseif ($arCompany["UF_PAS"] != "" && $podtverzhdenieAS == "участие")
			$uf_pas = 'Проверить';
		elseif ($arCompany["UF_PAS"] != "" && $podtverzhdenieAS == "ожидание")
			$uf_pas = 'Ожидание';
		else
			$uf_pas = "";
		if ($_GET["COMPANY_ID"] == $arCompany["ID"] && $_GET["UF_PAS"] == 1)
		{
			SetUserField("USER", $arCompany["ID"], "UF_PAS", "Подтверждено");
			$uf_pas = "Подтверждено";
		}
	}
	echo "<td>".$uf_pas."</td>";
	// Блок СЦ
	if($_GET["UF_SC"] == 1 && $_GET["COMPANY_ID"] == $arCompany["ID"])
	{
		SetUserField("USER", $arCompany["ID"], "UF_SC", "1");
		$uf_sc = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_SC=2">Отменить</a>';
	}
	elseif ($_GET["UF_SC"] == 2 && $_GET["COMPANY_ID"] == $arCompany["ID"])
	{
		SetUserField("USER", $arCompany["ID"], "UF_SC", "0");
		$uf_sc = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_SC=1">Подтвердить</a>';
	}
	elseif ($arCompany["UF_SC"])
	{
		$arSC[] = $arCompany["ID"];
		$uf_sc = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_SC=2">Отменить</a>';
	}
	elseif (!in_array(21, $arCompany["UF_TIP_SERT"]))
		$uf_sc = '<a href="?COMPANY_ID='.$arCompany["ID"].'&UF_SC=1">Подтвердить</a>';
	echo "<td>".$uf_sc."</td>";
	if ($countSertSC == 0)
		echo '<td align="center"><span style="display:none">0</span></td>';
	else
	{
		sort($arSpecSC);
		echo '<td align="center" class="td_spec" onmouseout="specialistsHide(\'spec_sc'.$arCompany["ID"].'\');" onmouseover="specialistsView(\'spec_sc'.$arCompany["ID"].'\');">'.$countSertSC.'<div id="spec_sc'.$arCompany["ID"].'" class="list_spec">'.implode("<br />", $arSpecSC).'</div></td>';
	}
	if($_GET["ADSC"] == 1 && $_GET["COMPANY_ID"] == $arCompany["ID"])
	{
		$user = new CUser;
		$fields = Array(
			"UF_PTP" => "",
			"UF_TIP_SERT" => array(18),
		); 
		$user->Update($arCompany["ID"], $fields);
	}
	elseif ($arCompany["UF_SC"] && in_array(19, $arCompany["UF_TIP_SERT"]))
		$adsc = '<a href="?COMPANY_ID='.$arCompany["ID"].'&ADSC=1">Отменить</a>';
	echo "<td>".$adsc."</td>";
}
?>
		</tbody>
	</table>
</div>
<script language="javascript" type="text/javascript">
	arAI = [];
	arAI = [<?php echo implode(",", $arAI); ?>];
	arSTP = [];
	arSTP = [<?php echo implode(",", $arSTP); ?>];
	arSC = [];
	arSC = [<?php echo implode(",", $arSC); ?>];
	arAS = [];
	arAS = [<?php echo implode(",", $arAS); ?>];
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>