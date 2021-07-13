<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Архив документации", "");
$APPLICATION->SetPageProperty("title", "Архив документации | PERCo");
$APPLICATION->SetPageProperty("description", "Архив документации в формате PDF на системы и оборудование PERCo");
$APPLICATION->SetPageProperty("keywords", "архив документации perco, скуд, системы безопасности, системы контроля и управления доступом");
$APPLICATION->SetTitle("Архив документации");

$APPLICATION->SetAdditionalCSS("/css/dokumentatsiya.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/dokumentatsiya.js"); // подключение скриптов
?>
<div id="himg">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<img src="/images/icons/documents.svg" />
</div>
<div id="content">
	<h2>Выбор документации по товарам</h2>
	<div id="select_documents" >
		<select id="section" name="section"></select>
		<button type="submit" value="Найти">Найти</button>
	</div>
	<div id="download_items"></div>
	<p><a href="/podderzhka/dokumentatsiya.php">Действующая документация</a></p>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>