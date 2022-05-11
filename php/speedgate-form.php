<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET['pw'] != 'bae42d7d01c78bf32db83aadd036e2ca574203da') {
	exit;
}
if (CModule::IncludeModule('form')) {
	$FORM_ID = 73; 
	$arValues = array(
		'form_text_1061' => htmlspecialchars($_GET['name']),
		'form_text_1072' => htmlspecialchars($_GET['company']),
		'form_email_1062' => htmlspecialchars($_GET['email']),
		'form_text_1063' => htmlspecialchars($_GET['number']),
		'form_textarea_1064' => htmlspecialchars($_GET['message']),
		'form_date_1065' => date('d.m.Y')
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