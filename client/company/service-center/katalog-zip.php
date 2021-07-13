<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Каталог ЗИП", "");
$APPLICATION->SetPageProperty("title", "Каталог ЗИП");
$APPLICATION->SetPageProperty("keywords", "Каталог ЗИП");
$APPLICATION->SetPageProperty("description", "Каталог ЗИП");
$APPLICATION->SetTitle("Каталог ЗИП");
?>
<div id="content">
	<?require($_SERVER["DOCUMENT_ROOT"]."/client/company/service-center/menu.php");?>
	<h1>
    <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
 
	<div>
		<h3></a>Каталог запчастей к оборудованию PERCo</h3>
		<div class="catalog-section-list">
			<ul>
				<li><a onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/katalog-zapchastej-PERCo.pdf'});" target="_blank" href="/download/documentation/rus/katalog-zapchastej-PERCo.pdf" download>Иллюстрированный каталог запчастей к оборудованию PERCo</a> <span class="color">(<?=printFileInfo("/download/documentation/rus/katalog-zapchastej-PERCo.pdf", "size");?>) — <?$stat = stat($_SERVER["DOCUMENT_ROOT"]."/download/documentation/rus/katalog-zapchastej-PERCo.pdf"); echo " ".date("d.m.Y", $stat["mtime"]);?></span></li>
				<li><a onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/service/katalog-dlya-sc.zip'});" target="_blank" href="/download/service/katalog-dlya-sc.zip" download>Прайс запчастей к оборудованию PERCo</a> <span class="color">(<?=printFileInfo("/download/service/katalog-dlya-sc.zip", "size");?>) — <?$stat = stat($_SERVER["DOCUMENT_ROOT"]."/download/service/katalog-dlya-sc.zip"); echo " ".date("d.m.Y", $stat["mtime"]);?></span></li>
			</ul>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>