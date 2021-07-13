<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

parse_str($_SERVER["QUERY_STRING"]);
$arGroups = CUser::GetUserGroup($USER->GetID());
if ($USER_ID > 0 && in_array(32,$arGroups))
{
	$rsUser = CUser::GetByID($USER_ID);
	$arUser = $rsUser->Fetch();
	if ($arUser["WORK_COMPANY"] == $USER->GetID())
	{
		$user = new CUser;
		$user->Update($USER_ID, array("WORK_COMPANY" => ""));
	}
}
Header("Location: /client/company/", true, 301);
?>