<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET['pw'] != 'fqcpmKDtSobtKDzUT982DkmF2yWoL2I8lfN9D4t0yHy3BYSGmM') {
	exit;
}
if (CModule::IncludeModule('form')) {
	$FORM_ID = 75; 
	$arValues = array(
		'form_text_1073' => htmlspecialchars($_GET['name']),
		'form_text_1074' => htmlspecialchars($_GET['company']),
		'form_email_1075' => htmlspecialchars($_GET['email']),
		'form_text_1076' => htmlspecialchars($_GET['number']),
		'form_textarea_1077' => htmlspecialchars($_GET['message']),
		'form_date_1078' => date('d.m.Y')
	); 
	if ($RESULT_ID = CFormResult::Add($FORM_ID, $arValues))
	{
		exit;
	}
	else
	{
		exit;
	}
} else {
	exit;
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");?>