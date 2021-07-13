<?
$arHTMLPagesOptions = array(
	"~INCLUDE_MASK" => array(
		"0" => "'^.*?\\.php\$'",
		"1" => "'^.*?/\$'",
		"2" => "'^.*?\\.xml\$'",
	),
	"~EXCLUDE_MASK" => array(
		"0" => "'^/bitrix/.*?\$'",
		"1" => "'^/404\\.php\$'",
	),
	"~FILE_QUOTA" => "524288000",
	"COMPRESS" => "1",
	"STORE_PASSWORD" => "Y",
	"COOKIE_LOGIN" => "BITRIX_SM_LOGIN",
	"COOKIE_PASS" => "BITRIX_SM_UIDH",
	"INCLUDE_MASK" => "*.php;*/; *.xml;",
	"EXCLUDE_MASK" => "/bitrix/*;/404.php",
	"FILE_QUOTA" => "500",
);
?>
