<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET['pw'] != 'qYYnSdtaUsf62BvytHQBNXMACY3g7EGEfDEaKtajAxXs6sPHdpeZm8hRq') {
	exit;
}
if (CModule::IncludeModule('form')) {
	$FORM_ID = 76; 
	$arValues = array(
		'form_text_1079' => htmlspecialchars($_GET['name']),
		'form_text_1080' => htmlspecialchars($_GET['company']),
		'form_email_1081' => htmlspecialchars($_GET['email']),
		'form_text_1082' => htmlspecialchars($_GET['number']),
		'form_textarea_1083' => htmlspecialchars($_GET['message']),
		'form_date_1084' => date('d.m.Y')
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