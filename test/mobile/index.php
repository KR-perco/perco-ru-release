<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Выгрузка информации о товарах PERCo");
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
	<meta charset="<?=LANG_CHARSET;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noyaca"/>
	<title><?$APPLICATION->ShowTitle();?></title>

<?$APPLICATION->ShowCSS();?>

<?$APPLICATION->ShowHeadStrings();?>
<?$APPLICATION->ShowHeadScripts();?>

</head>
<link rel="stylesheet" href="/css/export.css">

	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/download.js"></script>

<div id="breadcrumbs">
	<ul class="breadcrumb-navigation">
		<li><a href="https://www.perco.ru/" title="Главная" class="navlink">Главная</a></li>
		<li>&nbsp;<img alt="Стрелка" src="/images/icons/arrow_mini.svg" width="2" height="4">&nbsp;</li>
		<li><a href="https://www.perco.ru/podderzhka/" title="Поддержка покупателей" class="navlink">Поддержка покупателей</a></li>
		<li>&nbsp;<img alt="Стрелка" src="/images/icons/arrow_mini.svg" width="2" height="4">&nbsp;</li>
		<li><a href="https://www.perco.ru/podderzhka/proektirovshchikam-i-installyatoram/" title="Проектировщикам и инсталяторам" class="navlink">Проектировщикам и инсталяторам</a></li>
		<li>&nbsp;<img alt="Стрелка" src="/images/icons/arrow_mini.svg" width="2" height="4">&nbsp;</li>
		<li class="navlink">Для сайтов партнеров</li>
	</ul>		
</div>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Проектировщикам и инсталляторам" src="/images/icons/partneram.svg" />
	</div>
	<div>
		<?
			$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree", array(
				"IBLOCK_TYPE" => "products",
				"IBLOCK_ID" => "60",
				"SECTION_ID" => "0",
				"COUNT_ELEMENTS" => "Y",
				"TOP_DEPTH" => "2",
				"SECTION_URL" => "/products/",
				"CACHE_TIME" => "36000000",
				"CACHE_GROUPS" => "Y",
				"DISPLAY_PANEL" => "N",
				"SECTION_USER_FIELDS" => $arParams["SECTION_USER_FIELDS"],
				),
				$component
			);
		?>
	</div>
</div>