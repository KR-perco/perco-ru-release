<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Заявка на очное обучение");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Заявка на очное обучение");
if (stripos($_SERVER["HTTP_REFERER"], "/client/company/zayavka/") !== false)
{
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p>Ваша заявка принята.</p>
</div>
<?
}
else
	header('Location: /client/company/zayavka/');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>