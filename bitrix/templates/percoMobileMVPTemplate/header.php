<? define("NOT_CHECK_FILE_PERMISSIONS", true); ?>
<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
{
	die();
}

//mobile init
if (!CModule::IncludeModule("mobileapp"))
{
	die();
}
CMobile::Init();
?>
<!DOCTYPE html >
<html class="<?= CMobile::$platform; ?>">
<head>
	<? $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH . "/script.js"); ?>
	<? $APPLICATION->ShowHead(); ?>

	<meta http-equiv="Content-Type" content="text/html;charset=<?= SITE_CHARSET ?>"/>
	<meta name="format-detection" content="telephone=no">
</head>
<body>
	
<?

$APPLICATION->AddHeadScript("/scripts/jquery.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lightgallery.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lightgallery.min.js");
$APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-zoom.min.js");
$APPLICATION->SetAdditionalCSS("/scripts/lightgallery/css/lightgallery.min.css");
$APPLICATION->SetAdditionalCSS("/scripts/lightslider/css/lightslider.min.css");

?>

<script type="text/javascript">
	app.pullDown({
		enable: true,
		callback: function ()
		{
			document.location.reload();
		},
		downtext: "<?=GetMessage("MB_PULLDOWN_DOWN")?>",
		pulltext: "<?=GetMessage("MB_PULLDOWN_PULL")?>",
		loadtext: "<?=GetMessage("MB_PULLDOWN_LOADING")?>"
	});
</script>
