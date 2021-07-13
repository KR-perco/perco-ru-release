<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Идивидуальные интернет-семинары", "");
$APPLICATION->SetPageProperty("title", "Идивидуальные интернет-семинары");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "");
$APPLICATION->SetTitle("Идивидуальные интернет-семинары");
if (stripos($_SERVER["HTTP_REFERER"], "/obuchenie/polzovateley/individualnye-vebinary.php") !== false)
{
?>
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p>Ваша заявка отправлена. В течение двух дней с вами свяжется наш сотрудник для уточнения деталей.</p>
	<p>Затем, на e-mail, указанный при регистрации будет отправлена ссылка на интернет-семинар. В выбранное время нужно перейти по ссылке, подключиться к интернет-семинару и получить консультацию по необходимым аспектам работы с системой PERCo-S-20.</p>
	<p>Вернуться в раздел <a href="/obuchenie/polzovateley/">«Обучение»</a>.</p>
</div>
<?
}
else
	header('Location: /obuchenie/polzovateley/vebinary-po-zaprosu.php');
?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>