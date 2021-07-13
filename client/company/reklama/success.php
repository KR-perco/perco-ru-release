<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Заявка на рекламную продукцию");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Заявка на рекламную продукцию");
if (stripos($_SERVER["HTTP_REFERER"], "/client/company/reklama/") !== false)
{
?>
<div id="textBlcok">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p>Ваша заявка принята к рассмотрению.</p>
</div>
<?
}
else
	header('Location: /client/company/reklama/');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>