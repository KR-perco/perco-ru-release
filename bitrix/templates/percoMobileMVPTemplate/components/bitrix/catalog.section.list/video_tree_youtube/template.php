<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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
			$description = "";
			$youtube = "";
			$keyYoutube = "";
			$keyDescription = "";
			$arFields = $ar->GetFields();
			$arProps = $ar->GetProperties();

			if ($getTimeStamp < strtotime($arFields["TIMESTAMP_X"]))
				$getTimeStamp = $arFields["TIMESTAMP_X"];
			if (array_search(LANGUAGE_ID, $arProps["YOUTUBE"]["DESCRIPTION"]) === false)
				continue;
			$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
			$keyImg = array_search(LANGUAGE_ID, $arProps["IMAGE"]["DESCRIPTION"]);
			$keyDescription = array_search(LANGUAGE_ID, $arProps["DESCRIPTION"]["DESCRIPTION"]);
			$keyFile = array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]);
			$keyYoutube = array_search(LANGUAGE_ID, $arProps["YOUTUBE"]["DESCRIPTION"]);
			
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

			$name = '<h3>'.$arProps["NAME"]["VALUE"][$keyName].'</h3>';
			$meta = '<p><a href="'.$file.'" download>'.GetMessage("DOWNLOAD").'</a> '.$fSize.' — '.$date.'</p>';
			if($keyDescription !== false){
				$description = html_entity_decode($arProps["DESCRIPTION"]["VALUE"][$keyDescription]["TEXT"]);
			} else { $description = ""; }
			$mini = '"><img src="'.$arProps["IMAGE"]["VALUE"][$keyImg].'"><p>'.$arProps["NAME"]["VALUE"][$keyName].'</p><img src="';
			if ($youtube){
				$video_element .= '
					<li class="video" id="'.$keyDescription.'" data-thumb="'.$arProps["IMAGE"]["VALUE"][$keyImg].'" data-thumb-descr="'.$arProps["NAME"]["VALUE"][$keyName].'">
						<div class="video-block">
							<div class="iframe"><iframe data-src="https://www.youtube.com/embed/'.$youtube.'?rel=0&enablejsapi=1" frameborder="0" allowfullscreen></iframe></div>
							<div class="description">'.$name.$description.$meta.'</div>
						</div>
					</li>
				';
			}
		}
		if ($video_element != "")
		{
			if ($section_name != "")
				echo "<h2>".GetMessage($section_name)."</h2>";
			echo '<div class="slider"><ul id="lightSlider">'.$video_element."</ul></div>";
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