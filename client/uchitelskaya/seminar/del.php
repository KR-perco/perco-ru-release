<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (stripos($_SERVER["HTTP_REFERER"], "/client/uchitelskaya/seminar/") === false)
	Header("Location: /client/uchitelskaya/seminar/", true, 301);

CModule::IncludeModule('iblock');
$arGroups = CUser::GetUserGroup($USER->GetID());
if (in_array(11,$arGroups))
	CIBlockElement::Delete($ID);
Header("Location: /client/uchitelskaya/seminar/", true, 301);
?>