<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$arParams = array(
	"MENU_FILE_PATH" => SITE_DIR . "/percoMobile/.mobile_menu.php",
);
CMobile::getInstance()->setLargeScreenSupport(false);
CMobile::getInstance()->setScreenCategory("NORMAL");
?>
<div class="menu-header">
	<img src="bxlocal://logo.png" alt="logo" />
</div>
<?
$APPLICATION->IncludeComponent(
	'bitrix:mobileapp.menu',
	'mobile',
	$arParams,
	false,
	Array('HIDE_ICONS' => 'N'));
?>

 <script type="text/javascript">
      app.enableSliderMenu(true);
   </script>

<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php") ?>