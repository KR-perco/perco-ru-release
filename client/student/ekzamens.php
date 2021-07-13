<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Экзаменационный журнал", "");
$APPLICATION->SetPageProperty("title", "Экзаменационный журнал");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Экзаменационный журнал");
?>
<div id="textBlcok">
  <h1>
    <?$APPLICATION->ShowTitle(false, false)?>
  </h1>
<?
if (isset($_REQUEST['COURSE_ID']) && isset($_REQUEST['TEST_ID']))
{
	if ($_REQUEST["TEST_ID"] == 4 || $_REQUEST["TEST_ID"] == 5)
	{
		$comp = "perco:learning.test";
		$templ = "e-learning-test-praktika"; //e-learning-test-praktika
	}
	else
	{
		$comp = "bitrix:learning.test";
		$templ = "e-learning-test";
	}
	$APPLICATION->IncludeComponent(
		$comp,
		$templ,
		Array(
			"COURSE_ID" => $_REQUEST["COURSE_ID"],
			"TEST_ID" => $_REQUEST["TEST_ID"],
			"PAGE_NUMBER_VARIABLE" => "PAGE",
			"GRADEBOOK_TEMPLATE" => "?ATTEMPTS=Y&TEST_ID=".$_REQUEST["TEST_ID"]."&COURSE_ID=".$_REQUEST["COURSE_ID"],
			"PAGE_WINDOW" => "10",
			"SHOW_TIME_LIMIT" => "Y",
			"SET_TITLE" => "Y"
		),
	false
	);
}
?>

</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>