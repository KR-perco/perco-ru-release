<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Карта сайта", "");
$APPLICATION->SetPageProperty("title", "Карта сайта PERCo");
$APPLICATION->SetPageProperty("description", "Карта сайта PERCo");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Карта сайта");
?>
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?$APPLICATION->IncludeComponent("bitrix:main.map", "sitemap", Array(
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "3600",	// Время кеширования (сек.)
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	"LEVEL" => "5",	// Максимальный уровень вложенности (0 - без вложенности)
	"COL_NUM" => "1",	// Количество колонок
	"SHOW_DESCRIPTION" => "N",	// Показывать описания
	),
	false
);?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>