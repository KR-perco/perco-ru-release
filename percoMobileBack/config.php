<?
header("Content-Type: application/x-javascript");
$hash = "bx_random_hash";
$config = array("appmap" =>
	array(
		"main" => "percoMobileBack",
		"left" => "/percoMobileBack/left.php",
		"settings" => "/percoMobileBack/settings.php",
		"hash" => substr($hash, rand(1, strlen($hash))),
	)
);
echo json_encode($config);
?>