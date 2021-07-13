<?
header("Content-Type: application/x-javascript");
$hash = "bx_random_hash";
$config = array("appmap" =>
	array("main" => "Demo",
		"left" => "/Demo/left.php",
		"right" => "/Demo/right.php",
		"settings" => "/Demo/settings.php",
		"hash" => substr($hash, rand(1, strlen($hash)))
	)
);
echo json_encode($config);
?>