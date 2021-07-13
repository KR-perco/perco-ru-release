<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$getTimeStamp = strtotime($arResult["TIMESTAMP_X"]);
function getElements($iblock_id, $section_id, $section_name="")
{
	global $getTimeStamp;
	$real_path = parse_url($_SERVER["REQUEST_URI"]);
	$rs = CIBlockElement::GetList(
		array("SORT"=>"ASC", "CREATED_DATE" => "DESC"), 
		array(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => $iblock_id,
			"SECTION_ID" => $section_id
		)
	);
	if (intval($rs->SelectedRowsCount()) > 0)
	{
		$video_element = "";
		
		while($ar = $rs->GetNextElement())
		{
			$meta = "";
			$arFields = $ar->GetFields();
			$arProps = $ar->GetProperties();

			if ($getTimeStamp < strtotime($arFields["TIMESTAMP_X"]))
				$getTimeStamp = $arFields["TIMESTAMP_X"];
			if (array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]) === false)
				continue;
			$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
			$keyImg = array_search(LANGUAGE_ID, $arProps["IMAGE"]["DESCRIPTION"]);
			$keyDescription = array_search(LANGUAGE_ID, $arProps["DESCRIPTION"]["DESCRIPTION"]);
			$keyFile = array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]);
			$keyYoutube = array_search(LANGUAGE_ID, $arProps["YOUTUBE"]["DESCRIPTION"]);
			$description = $arProps["DESCRIPTION"]["VALUE"][$keyDescription]["TEXT"];
			$file = $arProps["FILE"]["VALUE"][$keyFile];
			$youtube = $arProps["YOUTUBE"]["VALUE"][$keyYoutube];
			$fSize = '('.printFileInfo($file, "size").')';

			if ($arResult["PROPERTIES"]["DATA"]["VALUE"])
				$date = $arResult["PROPERTIES"]["DATA"]["VALUE"];
			else
				$date = printFileInfo($file, "date");
			$new_files = "";
			if ($arFields["DATE_ACTIVE_FROM"])
			{
				$dateActive = new DateTime(date("Y-m-d", strtotime($arFields["DATE_ACTIVE_FROM"])));
				$today = new DateTime(date("Y-m-d"));
				$interval = $dateActive->diff($today);
				if ($interval->format("%a") < 15)
					$new_files = '<span class="new_files">NEW!</span>';
				if ($dateActive > $today)
					continue;
			}
			/*if ($keyName !== false)
				$description = "<p>".$description."</p>";
				$meta = "<p><a href='".$file."' download>Скачать</a> ".$fSize.' — '.$date."</p>";
				$video_element .= '
					<a class="video" href="https://www.youtube.com/watch?v='.$youtube.'?rel=0&showinfo=0&end=5" data-sub-html="'.$arProps["NAME"]["VALUE"][$keyName].$meta.$description.'">
					<img class="icon-youtube" src="/images/icons/video-youtube.svg">
					<img alt="'.$arProps["NAME"]["VALUE"][$keyName].'" src="'.$arProps["IMAGE"]["VALUE"][$keyImg].'">
					<div>'.$new_files.$arProps["NAME"]["VALUE"][$keyName].'</div></a>
				';*/
			/*if ($keyName !== false)
				$description = "<p>".$description."</p>";
				$meta = "<p><a href='".$file."' download>Скачать</a> ".$fSize.' — '.$date."</p>";
				$video_element .= '
					<div vlass="video">
						<iframe width="100%" src="https://www.youtube.com/embed/'.$youtube.'?rel=0" frameborder="0" allowfullscreen></iframe>
					</div>
				';
			*/
			if ($keyName !== false)
				$description = "<p>".$description."</p>";
				$meta = "<p><a href='".$file."' download>Скачать</a> ".$fSize.' — '.$date."</p>";
				$video_element .= '
					<li class="video" data-thumb="'.$arProps["IMAGE"]["VALUE"][$keyImg].'">
						<iframe width="100%" data-src="https://www.youtube.com/embed/'.$youtube.'?rel=0&enablejsapi=1" frameborder="0" allowfullscreen></iframe>
					</li>
				';
		}
		if ($video_element != "")
		{
			if ($section_name != "" && $real_path["path"] != GetMessage("URL"))
				echo "<h2>".GetMessage($section_name)."</h2>";
			//echo '<div class="elements_list demo" id="'.$section_name.'"><ul id="lightSlider">'.$video_element."</ul></div>";
			echo '<div class="demo" id="'.$section_name.'"><ul id="lightSlider">'.$video_element."</ul></div>";
		}
	}
}
?>

<div class="catalog-section-list" id="video-gallery">
<?
if ($arResult["SECTIONS_COUNT"] > 0)
{
	foreach($arResult["SECTIONS"] as $arSection)
	{
		getElements($arSection["IBLOCK_ID"], $arSection["ID"], $arSection["CODE"]);
	}
}
elseif ($arResult["SECTION"]["NAME"])
{
	echo "<h2>".GetMessage($arResult["SECTION"]["CODE"])."</h2>";
	getElements($arResult["SECTION"]["IBLOCK_ID"], $arResult["SECTION"]["ID"]);
}
$arResult["TIMESTAMP_X"] = $getTimeStamp;
?>
</div>

<script>
/*$('.elements_list').lightGallery({
	youtubePlayerParams: {
        modestbranding: 1,
        showinfo: 0,
        rel: 0,
        controls: 1,
		enablejsapi: 1
	},
	thumbnail: false,
	zoom: false
}); */

</script>


<script>

/*$('#lightSlider').lightSlider({
    gallery: true,
    item: 1,
    loop: true,
	slideMargin: 0,
	verticalHeight: 1000,
	thumbItem: 9,
	controls: false
});


$('#lightSlider').lightSlider({
	//LAZY LOADING
	onBeforeStart: function ($el) {
		var src_iframe = $el.find('li iframe').first().attr('data-src');
		$el.find('li iframe').first().attr('src', src_iframe);
	},
	onSliderLoad: function ($el) {
		$('.lSPrev').hide();
	},
	onAfterSlide: function ($el, scene) {
		var $iframe = $el.find('iframe').eq( $el.getCurrentSlideCount()-1 );
		var $iframe_src = $iframe.attr('data-src');
		$iframe.attr('src', $iframe_src);

		if ($el.getCurrentSlideCount() == 1)
		{
			$('.lSPrev').hide();
		}
		else if ($el.getCurrentSlideCount() == $el.find('li').length)
		{
			$('.lSNext').hide();
		}
		else
		{
			$('.lSPrev').show();
			$('.lSNext').show();
		}
	},

	gallery: true,
	item: 1,
	loop: false,
	slideMargin: 0,
	keyPress: true,
	controls: false
});*/

var videos = [];

$('#lightSlider').lightSlider({
    //LAZY LOADING
    onBeforeStart: function($el) {
		var src_iframe = $el.find('li iframe').first().attr('data-src');
		videos.push(src_iframe);
		var $iframe = $el.find('li iframe').first();
		$iframe.attr('src', src_iframe);
		$iframe.css('display', 'initial');
    },
    onSliderLoad: function($el) {
        $('.lSPrev').hide();
    },
    onAfterSlide: function($el, scene) {
		$('.video iframe').each(function(){
			this.contentWindow.postMessage('{"event":"command","func":"stopVideo","args":""}', '*')
		});
		var $iframe = $el.find('iframe').eq($el.getCurrentSlideCount() - 1);
		var $iframe_src = $iframe.attr('data-src');

		if (!find(videos, $iframe_src)){	
			videos.push($iframe_src);
			$iframe.attr('src', $iframe_src);
			$iframe.css('display', 'initial');
			if ($el.getCurrentSlideCount() == 1) {
				$('.lSPrev').hide();
			} else if ($el.getCurrentSlideCount() == $el.find('li').length) {
				$('.lSNext').hide();
			} else {
				$('.lSPrev').show();
				$('.lSNext').show();
			}
		}
    },
    gallery: true,
    item: 1,
    loop: false,
    slideMargin: 0,
	keyPress: true,
	controls: false
});

function find(array, value) {

	for (var i = 0; i < array.length; i++) {
		if (array[i] == value) return true;
	}

	return false;
}

	</script>

	<style>
.catalog-section-list{
	margin-bottom: 40px;
}

.demo .lSSlideWrapper{
	width: 565px;
	min-height: 300px;
}

.demo .lSGallery{
	width: 100% !important;
	overflow: none;
	transform: none !important;
}

.demo .lSGallery li{
	min-width: 150px;
	margin: 4px 8px 4px 0 !important;
}

.video iframe{
	height: 100%;
}

#container ul li {
    margin: 0;
    padding-left: 0px;
}

ul#lightSlider{
	height: 300px !important;
}

ul#lightSlider li{
	height: 100%;
}

ul {
    list-style: none outside none;
    padding-left: 0 !important;
    margin-bottom:0;
}
li {
    display: block;
    float: left;
    margin-right: 6px;
    cursor:pointer;
}
img {
    display: block;
    height: auto;
    max-width: 100%;
}</style>