<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if (!empty($arResult))
{
?>
<div id="video">
<?
	$keyFile = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["FILE"]["DESCRIPTION"]);
	$vfile = pathinfo($arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile]);
	$keyName = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["NAME"]["DESCRIPTION"]);
	$keyImg = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["IMAGE"]["DESCRIPTION"]);
	$keyPoster = array_search(LANGUAGE_ID, $arResult["PROPERTIES"]["POSTER"]["DESCRIPTION"]);
?>
	<div style="display:none;" id="<?=$arResult["CODE"];?>">
		<video class="lg-video-object lg-html5" controls="controls" preload="none">
			<source src="<?=$vfile["dirname"]."/".$vfile["filename"];?>.mp4" type="video/mp4" />
			<source src="<?=$vfile["dirname"]."/".$vfile["filename"];?>.webm" type='video/webm; codecs="vp8, vorbis"' />
		</video>
	</div>
	<div id="html5-videos">
		<p data-poster="<?=$arResult["PROPERTIES"]["POSTER"]["VALUE"][$keyPoster];?>" data-sub-html="<?=$arResult["PROPERTIES"]["NAME"]["VALUE"][$keyName];?>" data-html="#<?=$arResult["CODE"];?>" data-download-url="<?=$arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile];?>" onclick="ga('send', 'event', {'eventCategory': 'Видео', 'eventAction': 'Просмотр', 'eventLabel': '<?=$arResult["PROPERTIES"]["FILE"]["VALUE"][$keyFile];?>'});"><img alt="<?=$arResult["PROPERTIES"]["NAME"]["VALUE"][$keyName];?>" src="<?=$arResult["PROPERTIES"]["IMAGE"]["VALUE"][$keyImg];?>" /><br /><?=$arResult["PROPERTIES"]["NAME"]["VALUE"][$keyName];?></p>
	</div>
</div>
<?}?>