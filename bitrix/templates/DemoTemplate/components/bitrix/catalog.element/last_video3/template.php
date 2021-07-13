<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?

$current_path = dirname($_SERVER["REQUEST_URI"]);
$real_path = dirname($_SERVER["REAL_FILE_PATH"]);
if($current_path != $real_path)
	$APPLICATION->AddHeadString('<link href="https://'.$_SERVER["SERVER_NAME"].str_replace($current_path, $real_path, $_SERVER["REQUEST_URI"]).'" rel="canonical" />');


$keyName = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["NAME"]["DESCRIPTION"]);
$keyDescription = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["DESCRIPTION"]["DESCRIPTION"]);
$keyFile = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["FILE"]["DESCRIPTION"]);
$keyImg = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["IMAGE"]["DESCRIPTION"]);
$video_file = pathinfo($arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile]);
$name = $arResult["PROPERTIES"]["NAME"]["VALUE"][$keyName];
$file = $arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile];
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

if (($name == 'Как выбрать турникет') || 
	($name == 'Электронная проходная KT02') ||
	($name == 'Турникет-трипод TTR-07') ||
	($name == 'Автоматическая калитка WMD-05') ||
	($name == 'Автоматическая калитка WMD-06')) { $autoplay = 'false'; } else { $autoplay = 'autoplay'; }

?>
<style>
@media screen and (max-width: 700px) {
	#video_element{
		width: 60% !important;
		margin: 0 20%;
		padding: 0 !important;
	}
}
</style>
<div>
	<div id="video_element">
		<video id="<?=$arResult["ID"];?>" controls="controls" <?=$autoplay;?> poster="<?=$poster;?>">
			<source src="<?=$video_file["dirname"]."/".$video_file["filename"];?>.mp4" type="video/mp4" />
			<source src="<?=$video_file["dirname"]."/".$video_file["filename"];?>.webm" type='video/webm; codecs="vp8, vorbis"' />
		</video>
		<div class="v_el">
			<h2><?php echo $name; ?></h2>
			<div class="description"><?if($keyDescription !== false) echo html_entity_decode($arResult["PROPERTIES"]["DESCRIPTION"]["VALUE"][$keyDescription]["TEXT"]);?></div>
			<div style="padding-left: 15px"><a href="<?=$file;?>" title="<?=$name;?>" <?=$google;?> download><?=GetMessage("DOWNLOAD")?></a> <?=$fSize;?></div>
		</div>
	</div>
</div>