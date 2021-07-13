<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поддержка покупателей");
$APPLICATION->SetPageProperty("title", "Поддержка покупателей | PERCo");
$APPLICATION->SetPageProperty("description", "Компания PERCo обеспечивает поддержку своим клиентам на протяжении всего срока эксплуатации оборудования комплексных систем безопасности");
$APPLICATION->SetPageProperty("keywords", "комплексные системы безопасности");

$APPLICATION->SetAdditionalCSS("/css/podderzhka.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/podderzhka.js"); // подключение скриптов
?>
<div class="width_all">
	<div class="banner_image"></div>
</div>
<div id="content">
	<h1> <?$APPLICATION->ShowTitle(false, false)?> </h1>
	<div id="status_dso">
		<p>Статус обращения в ДСО</p>
		<form name="search_status" action="status-dso.php" method="POST">
			<input name="number" type="text" value=""/>
			<input type="submit" value="Проверить">
		</form>
	</div>
	<div id="form_back"></div>
	<div id="support_list">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"page_menu",
	Array(
		 "ROOT_MENU_TYPE" => "podmenu", 
		 "MAX_LEVEL" => "1", 
		 "CHILD_MENU_TYPE" => "", 
		 "USE_EXT" => "Y" 
	 )
);?>
	</div>
	<div id="price">
		<div class="price_text">
			<a href="/podderzhka/zakaz-kataloga.php">
				<div class="icon">
					<img src="/images/icons/konvert.svg" alt="Технический каталог"><span class="icon_text">Заказать технический каталог</span>
				</div>
			</a>
			<a href="/download/documentation/rus/katalog-zapchastej-PERCo.pdf" onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/katalog-zapchastej-PERCo.pdf'});">
				<div class="icon">
					<img src="/images/icons/catalog-zip.svg" alt="Технический каталог"><span class="icon_text">Иллюстрированный каталог запчастей к оборудованию PERCo</span>
				</div>
			</a>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>