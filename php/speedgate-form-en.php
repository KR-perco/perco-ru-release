<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if ($_GET['pw'] != '8fQP4rL42bk9hsYugMobg1FUZf3kLF05T5H9quvZR6Hnj') {
	exit;
}
if (CModule::IncludeModule('form')) {
	$FORM_ID = 74; 
	$arValues = array(
		'form_text_1066' => htmlspecialchars($_GET['name']),
		'form_text_1071' => htmlspecialchars($_GET['company']),
		'form_email_1067' => htmlspecialchars($_GET['email']),
		'form_text_1068' => htmlspecialchars($_GET['number']),
		'form_textarea_1069' => htmlspecialchars($_GET['message']),
		'form_date_1070' => date('d.m.Y')
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