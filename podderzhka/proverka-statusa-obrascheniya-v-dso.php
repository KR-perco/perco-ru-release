<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Проверка статуса обращения в ДСО", "");
$APPLICATION->SetTitle("Проверка статуса обращения в ДСО");
$APPLICATION->SetPageProperty("title", "Проверка статуса обращения в ДСО | PERCo");
$APPLICATION->SetPageProperty("description", "Проверка статуса обращения в ДСО");
$APPLICATION->SetPageProperty("keywords", "");

$APPLICATION->SetAdditionalCSS("/css/proverka-statusa-obrascheniya-v-dso.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/podderzhka.js"); // подключение скриптов
?>
<div id="content">
	<h1> <?$APPLICATION->ShowTitle(false, false)?> </h1>
	<div id="status_dso">
		<p>Введите номер обращения в ДСО</p>
		<form name="search_status" action="status-dso.php" method="POST">
			<input name="number" type="text" value=""/>
			<input type="submit" value="Проверить">
		</form>
	</div>
	<div id="form_back"></div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>