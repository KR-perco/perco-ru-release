<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Регистрация компании | PERCo");
$APPLICATION->SetPageProperty("description", "Форма для регистрации компании на сайте PERCo");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Регистрация компании");
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?$APPLICATION->IncludeComponent("bitrix:main.register", "reg-company", array(
	"SHOW_FIELDS" => array(
		0 => "WORK_COMPANY",
		1 => "WORK_WWW",
		2 => "WORK_CITY",
		3 => "PERSONAL_PHONE",
		4 => "LAST_NAME",
		5 => "NAME",
		6 => "SECOND_NAME",
	),
	"REQUIRED_FIELDS" => array(
		0 => "WORK_COMPANY",
		1 => "WORK_WWW",
		2 => "WORK_CITY",
		3 => "PERSONAL_PHONE",
		4 => "NAME",
		5 => "LAST_NAME",
		6 => "SECOND_NAME",
	),
	"AUTH" => "Y",
	"USE_BACKURL" => "Y",
	"SUCCESS_PAGE" => "/client/company/",
	"SET_TITLE" => "N",
	"USER_PROPERTY" => array(
	),
	"USER_PROPERTY_NAME" => ""
	),
	false
);?>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>