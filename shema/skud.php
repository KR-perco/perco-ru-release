<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Схема системы контроля доступа скуд");
$APPLICATION->SetPageProperty("keywords", "система безопасности, обучение безопасности");
$APPLICATION->SetPageProperty("description", "Схема системы контроля доступа скуд");

$APPLICATION->SetAdditionalCSS("/shema/skud.css"); // подключение стилей
$APPLICATION->AddHeadScript("/shema/skud.js"); // подключение скриптов
?>
<div id="svgShema">
<?include("shema.svg");?>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>