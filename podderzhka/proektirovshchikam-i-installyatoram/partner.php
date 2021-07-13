<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Как стать партнером PERCo", "");
$APPLICATION->SetPageProperty("title", "Как стать партнером PERCo | PERCo");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetPageProperty("keywords", ", ");
$APPLICATION->SetTitle("Как стать партнером PERCo");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/proektirovshchikam-i-installyatoram.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Как стать партнером PERCo" src="/images/icons/partner.svg" />
	</div>
	<div class="partner-status">
		<div class="status_element">
			<img alt="Сертифицированный торговый партнер" src="/images/icons/stp.svg">
			<div>
				<h5>Сертифицированный торговый партнер</h5>
				<p>Рекомендованный партнёр по продаже систем и оборудования PERCo</p>
			</div>
		</div>
		<div class="status_element">
			<img alt="Авторизованный инсталлятор, торговый партнер" src="/images/icons/ai.svg">
			<div>
				<h5>Авторизованный инсталлятор, торговый партнер</h5>
				<p>Рекомендованный партнёр по установке систем и оборудования PERCo. Осуществляет продажи систем и оборудования PERCo</p>
			</div>
		</div>
		<div class="status_element">
			<img alt="Сервисный центр" src="/images/icons/sci.svg">
			<div>
				<h5>Сервисный центр</h5>
				<p>Рекомендованный партнёр по установке, гарантийному и сервисному обслуживанию систем и оборудования PERCo. Осуществляет продажи систем и оборудования PERCo</p>
			</div>
		</div>
		<div class="status_element">
			<img alt="Авторизованный дилер и сервисный центр" src="/images/icons/adsc.svg">
			<div>
				<h5>Авторизованный дилер и сервисный центр</h5>
				<p>Рекомендованный партнёр по продажам, установке, гарантийному и сервисному обслуживанию систем и оборудования PERCo</p>
			</div>
		</div>
	</div>
	<div>
		<?include($_SERVER["DOCUMENT_ROOT"]."/images/support/partner.svg");?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>