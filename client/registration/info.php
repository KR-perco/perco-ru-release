<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Уведомление", "");
$APPLICATION->SetPageProperty("title", "Уведомление");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Уведомление");

if (stripos($_SERVER["HTTP_REFERER"], "/registration/") !== false)
{
?>
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p>Данные о Вашей компании отправлены на проверку ответственному 
	сотруднику. В течении 3 рабочих дней на указанный e-mail Вы получите подтверждение регистрации Вашей компании и доступ в рабочий кабинет партнера.<p>
</div>
<?
}
else
	header('Location: /client/company/');
?>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>