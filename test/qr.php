<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("QR контакты", "");
$APPLICATION->SetPageProperty("title", "QR-контакты | PERCo");
$APPLICATION->SetPageProperty("description", "Изображение содержит QR-код с контактной информацией для быстрого ее распознавания с помощью камеры на мобильном телефоне или другом устройстве");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("QR-контакты");
?>
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<table width="100%" border="0" cellpadding="0"  cellspacing="0">
		<tr>
			<td  style="width:135px">
				<img alt="qr-ru" width="200px" src="/images/qr-code/qrcode.svg"/>
			</td>
			<td><p>Изображение содержит  <a href="http://ru.wikipedia.org/wiki/QR-%D0%BA%D0%BE%D0%B4" rel="nofollow" target="_blank">QR  код</a> с контактной информацией для быстрого ее распознавания с помощью камеры на мобильном телефоне или другом устройстве. Отсканировав QR код, вы сможете быстро ввести в телефон информацию о нашей компании: номер телефона, e-mail и адрес веб-сайта.</p><p>Использование QR контактов:</p>
				<ul>
					<li>Возьмите мобильный телефон с камерой;</li>
					<li>Запустите программу для сканирования кода;</li>
					<li>Наведите объектив камеры на код;</li>
					<li>Получите информацию;</li>
					<li>Добавьте ее в существующий или новый контакт.</li>
				</ul>
			</td>
		</tr>
	</table>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>