<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Выгрузка тестов");
$APPLICATION->SetPageProperty("keywords", "Выгрузка тестов");
$APPLICATION->SetPageProperty("description", "Выгрузка тестов");
$APPLICATION->SetTitle("Выгрузка тестов");
?><div id="textBlcok">
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<script type="text/javascript">
function fade(){
	$('#coransw').fadeIn(1000);
}
function fadeoff(){
	$('#coransw').fadeOut(1000);
}
</script>
<?
if (CModule::IncludeModule("learning")){ 
		$COURSE_ID = 24;
		$res = CTest::GetList(
			Array("SORT"=>"ASC"), 
			Array("ACTIVE" => "Y")
		);
		while ($arTest = $res->GetNext())
		{
			console_log($arTest);
			echo "Test name: ".$arTest["NAME"]."<br>";
		} 
}?>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>