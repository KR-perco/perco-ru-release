<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
CModule::IncludeModule('iblock');

$APPLICATION->AddHeadScript("/percoMobile/video/dokumentatsiya.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/url.min.js");
?>
<script type="text/javascript">
  	app.setPageTitle({
         title: "Видеофильмы"
      });
</script>
<style>
#video_element video{
	width: 100%;
	height: 140px;
}
</style>
<div id="content">
	<h2>Выбор раздела</h2>
	<div id="select_documents" >
		<select id="section" name="section"></select>
		<button type="submit" value="Найти">Найти</button>
	</div>
	<div id="download_items"></div>
</div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?> 