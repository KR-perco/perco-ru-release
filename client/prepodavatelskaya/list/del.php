<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

parse_str($_SERVER["QUERY_STRING"]);
$arGroups = CUser::GetUserGroup($USER->GetID());
if ($USER_ID>0 && in_array(26,$arGroups))
{
	$rsUser = CUser::GetByID($USER_ID);
	$arUser = $rsUser->Fetch();
	if ($arUser["WORK_COMPANY"] == $USER->GetID())
	{
		$user = new CUser;
		$user->Update($USER_ID, array("WORK_COMPANY" => "", "UF_VUZ" => "", "UF_N_GROUP" => ""));
	}
}
Header("Location: /client/prepodavatelskaya/list/", true, 301);
?>