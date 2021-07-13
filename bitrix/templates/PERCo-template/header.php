<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
header("X-Content-Type-Options: nosniff");
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/PERCo-template/header.php");
?>
<?
if (date("m") >= 1)
	$year_company = (date("Y")-1988);
else
	$year_company = (date("Y")-1-1988);
switch(LANGUAGE_ID)
{
	case "ru":
		switch (true) {
			case (date("Y")-1988)%10 == 1 && (date("Y")-1988) != 11:
				$year_company .= " год";
				break;
			case (date("Y")-1988)%10 > 1 && (date("Y")-1988)%10 < 5 && ((date("Y")-1988) < 12 || (date("Y")-1988) > 14):
				$year_company .= " года";
				break;
			default:
				$year_company .= " лет";
		}
		break;
	case "fr":
			$year_company .= " ans";
		break;
	default:
		$year_company .= GetMessage("YEARS");
		break;
}
$country_company = "92";
$device = is_device();
?>
<?
if (SITE_ID == "s3")
{
	$rsSite = CSite::GetList($by="sort", $order="asc", array("ID" => "s1"));
	$arSite = $rsSite->Fetch();
	if (stripos($_SERVER["SERVER_NAME"], "local") !== false)
		$server = "//".$arSite["SERVER_NAME"];
	else
		$server = "http://".$arSite["SERVER_NAME"];
}
?>

<!doctype html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
	<meta charset="<?=LANG_CHARSET;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noyaca"/>
	<!--meta http-equiv="expires" content="Fri, 16 Feb 2018 11:30:00 GMT"-->
	<title><? $APPLICATION->ShowTitle()?></title>
	<script type="application/ld+json">
		{
			"@context": "https://schema.org",
			"@type": "Organization",
			"url": "https://www.perco.ru/",
			"logo": "https://www.perco.ru/images/logo.png"
		}
	</script>
	<meta property="og:title" content="<? $APPLICATION->ShowTitle(); ?>">
	<meta property="og:description" content="<?=$APPLICATION->ShowProperty("description");?>">
	<meta property="og:url" content="<?='https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>">
	<meta property="og:site_name" content="PERCo - системы безопасности">
	<?$APPLICATION->ShowMeta("keywords");?>
	<?$APPLICATION->ShowMeta("description");?>
	<?$APPLICATION->ShowCSS();?>
	<? if (defined("LANGUAGE_ID")) echo '<script> var LANGUAGE_ID="'.LANGUAGE_ID.'";</script>';?>
	<? echo '<script> var device="'.$device.'";</script>';?>
	<script src="/scripts/jquery.min.js"></script>
	<script src="/scripts/url.min.js"></script>
	<link rel="preconnect" href="https://bitrix.info">
	<link type="text/css" href="/scripts/lightgallery/css/lightgallery.min.css" rel="stylesheet">
	<script src="/scripts/lightgallery/js/lightgallery.min.js"></script>
	<link type="text/css" href="/scripts/lightslider/css/lightslider.min.css" rel="stylesheet"/>
	<script src="/scripts/lightslider/js/lightslider.min.js"></script>
	<script src="/scripts/lightgallery/js/lg-zoom.min.js"></script>
	<?$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.min.js");?>
	<?$APPLICATION->ShowHeadStrings();?>
	<?$APPLICATION->ShowHeadScripts();?>

	<script src="/scripts/perco-scripts-01.js"></script>
	<?include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/analytics.php");?>
	<?
	if (LANGUAGE_ID == "en")
		echo '<script src="https://secure.leadforensics.com/js/66184.js" ></script>';
	?>
</head>
<body <?=($device!="desktop")?'class="mobile"':"";?> itemscope itemtype="https://schema.org/<?=$APPLICATION->ShowProperty('bodyItemtype', 'WebPage');?>">
<!--
These webfonts were purchased at www.ParaType.com
You can purchase them too. Please don't steal them.

Please don't remove this notice. Thanks.
-->	
<div class="scrollup"><img width="26" height="26" alt="scroll up" src="/images/icons/arrow-up.svg" /></div>
<?
global $USER;
if ($USER->IsAdmin())
{
?>
	<div id="panel">
	<?$APPLICATION->ShowPanel();?>
	</div>
<? } ?>
	<header itemscope itemtype="https://schema.org/WPHeader">
		<div>
			<div id="first_head">
				<div>
					<div id="main_logo"><a href="/"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/logo.svg");?></a></div>
					<div id="text_logo" itemprop="description"><?if (SITE_ID == "s3") echo "Система S-20 «Школа»"; else echo GetMessage("TEXT_LOGO");?></div>
				</div>
				<div id="phone_head">
					<input id="phone_icon" type="checkbox"><label for="phone_icon"><img alt="<?GetMessage("PHONE_TEXT");?>" src="/images/icons/phone.svg" width="20" height="20"/></label>
					<div>
						<?if((SITE_ID == "s3")||(SITE_ID == "s1")){?><p><a href="tel:<?=str_replace('-', '', str_replace(')', '', str_replace('(', '', str_replace(' ', '', GetMessage("PHONE2")))));?>" class="head-tel2"><?=GetMessage("PHONE2");?></a></p><?}?>
						<?if((SITE_ID != "s1")){?><p><a href="tel:<?=str_replace('-', '', str_replace(')', '', str_replace('(', '', str_replace(' ', '', GetMessage("PHONEDZP")))));?>"  class="head-teldzp"><?=GetMessage("PHONEDZP");?></a></p><?}?>	
						<p><a href="tel:<?=str_replace('-', '', str_replace(')', '', str_replace('(', '', str_replace(' ', '', GetMessage("PHONE")))));?>"  class="head-tel"><?=GetMessage("PHONE");?></a></p>
					</div>
				</div>
				<div>
					<div id="change_lang">
<?
$APPLICATION->IncludeComponent("bitrix:news.list", "muiNav", array(
	"IBLOCK_TYPE" => "raznoe",
	"IBLOCK_ID" => "33",
	"NEWS_COUNT" => "1000",
	"SORT_BY1" => "ID",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "SORT",
	"SORT_ORDER2" => "ASC",
	"FILTER_NAME" => "",
	"FIELD_CODE" => array(
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "RUS_LINK",
		1 => "ENG_LINK",
		2 => "DEU_LINK",
		3 => "FRA_LINK",
		4 => "ESP_LINK",
		5 => "ITA_LINK",
		6 => "",
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "N",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "N",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "Y",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "N",
	"PAGER_TITLE" => "",
	"PAGER_SHOW_ALWAYS" => "N",
	"PAGER_TEMPLATE" => "",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "N",
	"DISPLAY_DATE" => "N",
	"DISPLAY_NAME" => "N",
	"DISPLAY_PICTURE" => "N",
	"DISPLAY_PREVIEW_TEXT" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	),
	false
);?>
					</div>
					<div id="search">
<?
$APPLICATION->IncludeComponent("bitrix:search.form", "perco_search", array(
	"PAGE" => "/".translitIt(strtolower(GetMessage("SEARCH"))).".php",
	"USE_SUGGEST" => "N"
	),
false);
?>
					</div>
				</div>
			</div>
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu", 
	array(
		"ROOT_MENU_TYPE" => "top",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "2",
		"CHILD_MENU_TYPE" => "podmenu",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
		</div>
<?if (GetDirPath($_SERVER["PHP_SELF"]) != "/") {?>
		<div id="breadcrumbs">
<? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "perco_breadcrumb", array(
	"START_FROM" => "0",
	"PATH" => "",
	"SITE_ID" => "-"
	),
	false
);?>
		</div>
<? }?>
	</header>
	<main id="container" itemprop="mainContentOfPage">