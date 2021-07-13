<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET['pw'] != 'bae42d7d01c78bf32db83aadd036e2ca574203da') {
	exit;
}
if (CModule::IncludeModule('form')) {
	$FORM_ID = 68;
	
	$arValues = array(
		'form_text_959' => htmlspecialchars($_GET['name']),
		'form_email_960' => htmlspecialchars($_GET['email']),
		'form_text_961' => htmlspecialchars($_GET['number']),
		'form_textarea_962' => htmlspecialchars($_GET['message']),
		'form_date_963' => date('d.m.Y')
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