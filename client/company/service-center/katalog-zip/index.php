<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Каталог ЗИП");
$APPLICATION->SetPageProperty("keywords", "Каталог ЗИП");
$APPLICATION->SetPageProperty("description", "Каталог ЗИП");
$APPLICATION->SetTitle("Каталог ЗИП");
?>
<div id="content">
	<ul>
		<li><a href="/client/company/service-center/" >Новости</a></li>
		<li><a href="/client/company/service-center/remontnaya-dokumentaciya/" >Ремонтная документация</a></li>
		<li><a href="/client/company/service-center/blanki-po-remontu-i-zayavki-na-popolnenie-zip/" >Бланки по ремонту и заявки на пополнение ЗИП</a></li>
		<li><a href="/client/company/service-center/garant/">Гарантийные обязательства PERCo</a></li>
		<li><a href="/client/company/service-center/normativ/">Нормативы проведения ремонтных работ</a></li>
		<li><a href="/client/company/service-center/parametry/">Параметры сервисного обслуживания, согласуемые между СЦ и PERCo</a></li>
		<li><a href="/client/company/service-center/katalog-zip/" >Каталог ЗИП</a></li>
		<li><a href="/client/company/service-center/zadat-vopros/" >Задать вопрос</a></li>
		<li><a href="/client/company/service-center/kontakty/">Контакты</a></li>
	</ul>
	<h1>
    <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
 
	<div>
		<h3></a>Каталог запчастей к оборудованию PERCo</h3>
		<div class="catalog-section-list">
			<ul>
				<li><a onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/katalog-zapchastej-PERCo.pdf'});" target="_blank" href="/download/documentation/rus/katalog-zapchastej-PERCo.pdf" download>Иллюстрированный каталог запчастей к оборудованию PERCo</a> <span class="color">(<?=printFileInfo("/download/documentation/rus/katalog-zapchastej-PERCo.pdf", "size");?>) — <?$stat = stat("/download/documentation/rus/katalog-zapchastej-PERCo.pdf"); echo " ".date("d.m.Y", $stat["mtime"]);?></span></li>
				<li><a onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/service/katalog-zip-dlya-sc.zip'});" target="_blank" href="/download/service/katalog-zip-dlya-sc.zip" download>Прайс запчастей к оборудованию PERCo</a> <span class="color">(<?=printFileInfo("/download/service/katalog-zip-dlya-sc.zip", "size");?>) — <?$stat = stat("/download/service/katalog-zip-dlya-sc.zip"); echo " ".date("d.m.Y", $stat["mtime"]);?> (Действует с 11.04.2014)</span></li>
			</ul>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>