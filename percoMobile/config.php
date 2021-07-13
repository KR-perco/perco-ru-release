<?
header("Content-Type: application/x-javascript");
$hash = "bx_random_hash";
$config = array("appmap" =>
	array(
		"main" => "percoMobile",
		"left" => "/percoMobile/left.php",
		"settings" => "/percoMobile/settings.php",
		"hash" => substr($hash, rand(1, strlen($hash))),
	)
);
echo json_encode($config);
?>