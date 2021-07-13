<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Этапы получения статуса партнера");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Этапы получения статуса партнера");
?>
<style>
.box
{
	background-color: #F5F5F5;
	border: 1px solid #CCCCCC;
	border-radius: 8px 8px 8px 8px;
	font-family: Arial,Helvetica,sans-serif;
	font-size: 12px;
	line-height: 16px;
	height: 35px;
	padding: 10px;
	position: relative;
	text-align: center;
	width: 120px;
}
.complete
{
	background-color: #5EB95E;
}
.strelka-down-1
{
	background: url("/images/e-learning/arrow-down-1.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	height:30px;
	position: relative;
	width: 3px;
}
.strelka-down-1-2
{
	background: url("/images/e-learning/arrow-down-1-2.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	height: 30px;
	position: relative;
	width: 251px;
}
.strelka-down-2-1
{
	background: url("/images/e-learning/arrow-down-2-1.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	height: 30px;
	position: relative;
	width: 251px;
}
.strelka-down-2-1-2
{
	background: url("/images/e-learning/arrow-down-2-1.2.png") no-repeat scroll 0 0 rgba(0, 0, 0, 0);
	height: 156px;
	position: relative;
	width: 251px;
}
#STP, #AI
{
	margin-right: 10px;
	height: 350px;
	width: 450px;
}
#SC { height: 550px; }
.first { float: left; }
.second { float: right; }
#block_tp
{
	border: 1px dashed black;
	left: 272px;
	padding-bottom: 10px;
	padding-left: 10px;
	padding-right: 10px;
	position: relative;
	top: -387px;
	width: 261px;
}
</style>
<?
$rsCompany = CUser::GetByID($USER->GetID());
$arCompany = $rsCompany->Fetch();
$trebovaniya_STP = "";
$trebovaniya_AI = "";
$site = "";
$stud_ok = 0;
$examens = "";
$sertifikat = "";
$count_si = 0;
$message_SC = "";
if ($arCompany["UF_PAI"] == "Подтверждено")
	$trebovaniya_AI = "complete";
if ($arCompany["UF_PTP"] == "Подтверждено")
	$trebovaniya_STP = "complete";
if ($arCompany["PERSONAL_WWW"] == "Подтверждено")
	$site = "complete";
$filter = Array
(
	"ACTIVE" => "Y",
	"WORK_COMPANY" => $arCompany["ID"],
	"WORK_COMPANY_EXACT_MATCH" => "Y"
);
$select = array(
	"SELECT" => array("UF_SERT_DATE", "UF_SERT_DATE_TP", "UF_SERT_DATE_SC")
);
$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter, $select); // выбираем пользователей
while($arUser = $rsUsers->Fetch())
{
	// считаем пользователей компании с пройденными тестами АИ
	$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE"] && $endSertDate > $today)
		$countAI++;
	// считаем пользователей компании с пройденными тестами СТП
	$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_TP"] && $endSertDate > $today)
		$countSTP++;
	// считаем пользователей компании с пройденными тестами СЦ
	$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
	$endSertDate = mktime(0, 0, 0, date("m", $getSertDate)-1, date("d", $getSertDate), date("Y", $getSertDate)+1);
	if ($arUser["UF_SERT_DATE_SC"] && $endSertDate > $today)
		$countSC++;
}
if ($countAI >= 2)
	$examens_AI = "complete";
if ($countSTP >= 3 || ($countSTP >= 2 && $arCompany["UF_SC"]))
	$examens_STP = "complete";
if ($countSC >= 2)
	$examens_SC = "complete";

if ($trebovaniya_AI == "complete" && $site == "complete" && $examens_AI == "complete")
{
	$sertifikat_AI = "complete";
	if ($arCompany["UF_SERT_D"])
	{
		$rsFile = CFile::GetByID($arCompany["UF_SERT_D"]);
		$arFile = $rsFile->Fetch();
		$download_sert_AI = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		$download_sert_AI='<a href="'.$download_sert_AI.'"  target="_blank">Скачать сертификат</a>';
	}
	else
		$download_sert_AI = "Скачать сертификат";
}
else
	$download_sert_AI ="Скачать сертификат";
if ($trebovaniya_STP == "complete" && $site == "complete" && $examens_STP == "complete")
{
	$sertifikat_STP = "complete";
	if ($arCompany["UF_SERT_TP"])
	{
		$rsFile = CFile::GetByID($arCompany["UF_SERT_TP"]);
		$arFile = $rsFile->Fetch();
		$download_sert_STP = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		$download_sert_STP='<a href="'.$download_sert_STP.'"  target="_blank">Скачать сертификат</a>';
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
		$rsFile = CFile::GetByID($arCompany["UF_SERT_SC"]);
		$arFile = $rsFile->Fetch();
		$download_sert_SC = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		$download_sert_SC='<a href="'.$download_sert_SC.'"  target="_blank">Скачать сертификат</a>';
	}
	else
		$download_sert_SC = "Скачать сертификат";
}
elseif ($trebovaniya_AI == "complete" && $site == "complete" && $examens_AI == "complete" && $examens_SC == "complete" && in_array(18, $arCompany["UF_TIP_SERT"]) && !in_array(19, $arCompany["UF_TIP_SERT"]))
{
	$sertifikat_SC = "complete";
	if ($arCompany["UF_SERT_SC"])
	{
		$rsFile = CFile::GetByID($arCompany["UF_SERT_SC"]);
		$arFile = $rsFile->Fetch();
		$download_sert_SC = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
		$download_sert_SC='<a href="'.$download_sert_SC.'"  target="_blank">Скачать сертификат</a>';
	}
	else
		$download_sert_SC = "Скачать сертификат";
}
else
{
	$download_sert_SC ="Скачать сертификат";
	$message_SC = "<p>Сертификат авторизованного партнера на следующий год будет доступен для скачивания 20 декабря текущего года при выполнении всех необходимых условий сотрудничества</p>";
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
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
<?
if (count($arCompany["UF_TIP_SERT"]) > 1)
{
	$first = 'class="first"';
	$second = 'class="second"';
}
if ($arCompany["UF_SC"])
{
?>
	<div id="SC">
		<div style="left: 185px;" class="box complete">Регистрация на сайте www.perco.ru</div>
		<div style="left: 132px;" class="strelka-down-1-2"></div>
		<div style="width: 241px;" class="box <?=$trebovaniya_AI;?>">Компания отвечает требованиям Авторизованного инсталлятора</div>
		<div style="left: 131px;" class="strelka-down-1"></div>
		<div style="left: 28px; width: 191px;" class="box <?=$site;?>">На сайте компании размещена информация о продукции PERCo</div>
		<div style="left: 131px;" class="strelka-down-1"></div>
		<div style="left: 47px; width: 151px;" class="box <?=$examens_AI;?>">2 специалиста получили свидетельство АИ PERCo</div>
		<div style="left: 131px;" class="strelka-down-1"></div>
		<div  style="left: 62px; height: 16px;" class="box <?=$sertifikat_AI;?>"><?=$download_sert_AI;?></div>
		<div style="left: 131px;" class="strelka-down-1"></div>
		<div style="left: 23px; width: 195px;" class="box <?=$examens_SC;?>">2 специалиста сдали экзамен по программе "Сервисный инженер"</div>
		<div id="block_tp">
			<p>Дополнительные условия для АДСЦ</p>
			<div style="width: 241px;" class="box <?=$trebovaniya_STP;?>">Компания отвечает требованиям Сертифицированного Торгового Партнера</div>
			<div style="left: 131px;" class="strelka-down-1"></div>
			<div style="left: 50px; width: 151px;" class="box <?=$examens_STP;?>">2 менеджера сдали экзамен по оборудованию</div>
			<div style="left: 131px;" class="strelka-down-1"></div>
			<div  style="left: 65px; height: 16px;" class="box <?=$sertifikat_STP;?>"><?=$download_sert_STP;?></div>
		</div>
		<div style="left: 132px; top: -388px; z-index: -10;" class="strelka-down-2-1-2"></div>
		<div  style="left: 186px; top: -390px; height: 16px;" class="box <?=$sertifikat_SC;?>"><?=$download_sert_SC;?></div>
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
		<h3 style="text-align: center; padding-left: 0; padding-right: 0;">Авторизованный инсталлятор (АИ)</h3>
		<div style="left: 151px;" class="box complete">Регистрация на сайте www.perco.ru</div>
		<div style="left: 222px;" class="strelka-down-1"></div>
		<div style="left: 93px; width: 241px;" class="box <?=$trebovaniya_AI;?>">Компания отвечает требованиям Авторизованного инсталлятора</div>
		<div style="left: 97px;" class="strelka-down-1-2"></div>
		<div style="left: 11px; width: 151px;" class="box <?=$examens_AI;?>">2 специалиста получили свидетельство АИ PERCo</div>
		<div style="left: 97px;" class="strelka-down-2-1"></div>
		<div  style="left: 151px; height: 16px;" class="box <?=$sertifikat_AI;?>"><?=$download_sert_AI;?></div>
		<div style="left: 240px; top: -125px; width: 191px;" class="box <?=$site;?>">На сайте компании размещена информация о продукции PERCo</div>
	</div>
<?
	}
	if (in_array(19, $arCompany["UF_TIP_SERT"]))
	{
?>
	<div id="STP" <?=$second;?>>
		<h3 style="text-align: center; padding-left: 0; padding-right: 0;">Сертифицированный Торговый Партнер (СТП)</h3>
		<div style="left: 151px;" class="box complete">Регистрация на сайте www.perco.ru</div>
		<div style="left: 222px;" class="strelka-down-1"></div>
		<div style="left: 93px; width: 241px;" class="box <?=$trebovaniya_STP;?>">Компания отвечает требованиям Сертифицированного Торгового Партнера</div>
		<div style="left: 97px;" class="strelka-down-1-2"></div>
		<div style="left: 11px; width: 151px;" class="box <?=$examens_STP;?>">3 менеджера сдали экзамен по оборудованию</div>
		<div style="left: 97px;" class="strelka-down-2-1"></div>
		<div  style="left: 151px; height: 16px;" class="box <?=$sertifikat_STP;?>"><?=$download_sert_STP;?></div>
		<div style="left: 240px; top: -125px; width: 191px;" class="box <?=$site;?>">На сайте компании размещена информация о продукции PERCo</div>
	</div>
<?
	}
}
?>
</div>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>