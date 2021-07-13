<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$APPLICATION->AddHeadScript("/scripts/url.min.js");
$APPLICATION->AddHeadScript("/scripts/pages/dokumentatsiya.js");
?>
<script>
	app.setPageTitle({
         title: "Документация: Архив"
	  });
	  
</script> 
<style>
#select_documents {
	display: flex;
	flex-direction: column;
}
select {
	font-family: inherit;
	font-size: inherit;
	border: 1px solid #BDBEC0;
	width: 400px;
	padding: 10px;
	margin: 15px 0;
	text-align: right
}
select:not(:first-child) { display: none; }
#select_documents button {
	background: #BDBEC0 !important;
	border-bottom: 2px solid grey !important;
	width: 200px;
}
#download_items { margin: 50px 0; }
@media screen and (max-width: 900px) {
	select { width: 340px; }
	#download_items { margin: 20px 0; }
}
</style>
<div id="content">
	<h2>Выбор документации по товарам</h2>
	<div id="select_documents" >
		<select id="section" name="section"></select>
		<button type="submit" value="Найти">Найти</button>
	</div>
	<div id="download_items"></div>
		<p><a href="/percoMobile/documentation/dokumentatsiya.php">Действующая документация</a></p>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>