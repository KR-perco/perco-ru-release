<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule('iblock');

$APPLICATION->AddHeadScript("/percoMobileMVP/video/video-filter.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/url.min.js");
?>
<script type="text/javascript">
  	app.setPageTitle({
         title: "Видео"
      });
</script> 
<div id="content">
	<h2>Выбор раздела</h2>
	<div id="select_documents">
		<select id="section" name="section"></select>
		<button type="submit" value="Найти">Найти</button>
	</div>
	<div id="download_items"></div>
</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?> 