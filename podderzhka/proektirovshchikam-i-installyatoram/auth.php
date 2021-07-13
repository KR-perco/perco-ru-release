<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Авторизация", "");
$APPLICATION->SetPageProperty("title", "Авторизация | PERCo");
$APPLICATION->SetPageProperty("description", "Для удобства проектировщиков и инсталляторов PERCo предлагает полный комплект инструментов: библиотека моделей ArchiCAD, библиотека моделей AutoCAD, схемы подключения оборудования и программа 3D-визуализации проходных");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Авторизация");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/proektirovshchikam-i-installyatoram.js"); // подключение скриптов

$APPLICATION->SetAdditionalCSS("/scripts/lightgallery/css/lightgallery.min.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lightgallery.min.js"); // подключение скриптов
$APPLICATION->SetAdditionalCSS("/scripts/lightslider/css/lightslider.min.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.min.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-zoom.min.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Проектировщикам и инсталляторам" src="/images/icons/lichniy-kabinet.svg" />
	</div>

	<style>
		table{
			width: 94%;
			margin: 0 3%;
		}
		#authorized input, #authorized button {
			width: 100%;
		}
		.h2{
			margin-left: 2%;
		}
	</style>

	<div id="authorized">
		<?
		$APPLICATION->IncludeComponent(
			"bitrix:system.auth.form",
			"authorized",
			Array(
				"REGISTER_URL" => "/client/registration/",
				"FORGOT_PASSWORD_URL" => "/client/",
				"PROFILE_URL" => "",
				"SHOW_ERRORS" => "Y"
			),
		false
		);
		echo '<div id="forgot_password" style="display: none;">';
		$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd","",Array());
		echo '</div>';
		?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>