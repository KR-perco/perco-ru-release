<? 
$site = $_GET['site'];
$hash = $_GET['hash'];
$key = "zdT,\BfO>N";
if (isset($site) && isset($hash))
{
	$computed_hash = hash_hmac('md5', $site, $key, false);
	if (!strcmp($computed_hash, $hash))
	{
		header('Location: ' . $site);
		exit();
	}
}
?>