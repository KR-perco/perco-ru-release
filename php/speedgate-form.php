<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET['pw'] != 'bae42d7d01c78bf32db83aadd036e2ca574203da') {
	exit;
}
if (CModule::IncludeModule('form')) {
	$FORM_ID = 73;
	// console_log($_GET);
	$arValues = array(
		'form_text_900' => htmlspecialchars($_GET['name']),
		'form_email_901' => htmlspecialchars($_GET['email']),
		'form_text_902' => htmlspecialchars($_GET['number']),
		'form_textarea_903' => htmlspecialchars($_GET['message']),
		'form_date_904' => date('d.m.Y')
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