<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?

$current_path = dirname($_SERVER["REQUEST_URI"]);
$real_path = dirname($_SERVER["REAL_FILE_PATH"]);
if($current_path != $real_path)
	$APPLICATION->AddHeadString('<link href="https://'.$_SERVER["SERVER_NAME"].str_replace($current_path, $real_path, $_SERVER["REQUEST_URI"]).'" rel="canonical" />');


$keyName = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["NAME"]["DESCRIPTION"]);
$keyDescription = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["DESCRIPTION"]["DESCRIPTION"]);
$keyFile = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["FILE"]["DESCRIPTION"]);
$keyYoutube = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["YOUTUBE"]["DESCRIPTION"]);
$keyImg = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["IMAGE"]["DESCRIPTION"]);
$video_file = pathinfo($arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile]);
$name = $arResult["PROPERTIES"]["NAME"]["VALUE"][$keyName];
$file = $arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile];
$youtube = $arResult["PROPERTIES"]["YOUTUBE"]["VALUE"][$keyYoutube];
$fSize = '('.printFileInfo($file, "size").')';
if ($arResult["PROPERTIES"]["DATA"]["VALUE"])
	$date = $arResult["PROPERTIES"]["DATA"]["VALUE"];
else
	$date = printFileInfo($file, "date");
if ($arResult["PROPERTIES"]["POSTER"]["DESCRIPTION"])
{
	$keyPoster = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["POSTER"]["DESCRIPTION"]);
	$poster = $arResult["PROPERTIES"]["POSTER"]["VALUE"][$keyPoster];
}
else
	$poster = "/images/video/poster.jpg";
$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Видео', 'eventAction': 'Загрузки', 'eventLabel': '".$name."'});\"";

if ($arResult["PROPERTIES"]["TYPE"]["VALUE"] && $arResult["PROPERTIES"]["TYPE"]["VALUE"] != "Видеоинструкция по установке")
{
	$type_name = translitIt($arResult["PROPERTIES"]["TYPE"]["VALUE"]);
	$dop_name = GetMessage("OF").GetMessage($type_name).GetMessage($type_name."-title");
}
?>
<div class="video-block">
	<div class="iframe">
		<iframe src="https://www.youtube.com/embed/<?=$youtube?>?rel=0" frameborder="0" allowfullscreen></iframe>
	</div>
	<div class="description">
		<h2><?=$name?></h2>
		<?if($keyDescription !== false) echo html_entity_decode($arResult["PROPERTIES"]["DESCRIPTION"]["VALUE"][$keyDescription]["TEXT"]);?>
		<?if (!empty($file)) {?>
			<p><a href="<?=$file;?>" title="<?=$name;?>" <?=$google;?> download><?=GetMessage("DOWNLOAD")?></a> <?=$fSize;?> — <?=$date;?></p>
		<? } ?>
	</div>
</div>