<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$params = array(
	'pw' => 'bae42d7d01c78bf32db83aadd036e2ca574203da',
    'name' => '0',
    'email' => '1',
	'number' => '2',
	'message' => '3'
);
$url = 'https://perco.ru/php/speedgate-form.php?' . http_build_query($params);
console_log($url);
$context = stream_context_create(array(
    'http' => array(
        'method'  => 'GET',
    )
));
file_get_contents($url, false, $context);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>