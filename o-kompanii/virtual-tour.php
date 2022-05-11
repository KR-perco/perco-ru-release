<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Виртуальный тур", "");
$APPLICATION->SetPageProperty("title", "Виртуальный тур по головному офису компании PERCo");
$APPLICATION->SetPageProperty("description", "Виртуальный тур по головному офису компании PERCo");
$APPLICATION->SetPageProperty("keywords", "Виртуальный, тур, офис");
$APPLICATION->SetTitle("Виртуальный тур");
$APPLICATION->SetPageProperty("bodyItemtype", "AboutPage"); 

$APPLICATION->SetAdditionalCSS("/css/o-kompanii.css"); // подключение стилей 
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.min.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/virtual-tour/pano2vr_player.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/virtual-tour/skin.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/virtual-tour/pano2vrgyro.js"); // подключение скриптов
?> 
<script>    
pano = new pano2vrPlayer("virtual-tour");
			// add the skin object
			skin = new pano2vrSkin(pano);
			// load the configuration
			window.addEventListener("load", function() {
			    pano.readConfigUrlAsync("../scripts/virtual-tour/pano.xml", function() { /* gyro=new pano2vrGyro(pano,"container"); */ });
			});
			</script>
<div id="container">
	<div id="content">
		<h1> Виртуальный тур </h1>
		<div id="virtual-tour-block">
			<div id="virtual-tour"><img alt="Загрузка" src="/images/icons/loading.gif" /></div>
			<div id="virtual_text"><img alt="Виртуальный тур" src="/images/icons/virtual-tour.svg" />Виртуальный тур по главному офису PERCo</div>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>