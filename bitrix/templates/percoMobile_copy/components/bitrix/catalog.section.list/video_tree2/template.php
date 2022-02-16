<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$getTimeStamp = strtotime($arResult["TIMESTAMP_X"]);
function getElements($iblock_id, $section_id, $section_name="")
{
	global $getTimeStamp;
	$check = '';
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
			$arFields = $ar->GetFields();
			$arProps = $ar->GetProperties();
			if ($getTimeStamp < strtotime($arFields["TIMESTAMP_X"]))
				$getTimeStamp = $arFields["TIMESTAMP_X"];
			if (array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]) === false)
				continue;
			$keyFile = array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]);
			$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
			$keyImg = array_search(LANGUAGE_ID, $arProps["IMAGE"]["DESCRIPTION"]);
			$new_files = "";
			if ($arFields["DATE_ACTIVE_FROM"])
			{
				$dateActive = new DateTime(date("Y-m-d", strtotime($arFields["DATE_ACTIVE_FROM"])));
				$today = new DateTime(date("Y-m-d"));
				$interval = $dateActive->diff($today);
				if ($interval->format("%a") < 32)
					$new_files = '<span class="new_files">NEW!</span>';
				if ($dateActive > $today)
					continue;
			}
			if ($keyName !== false)
				/*$video_element .= '<div class="video">
					<a href="'.$real_path["path"].$arFields["CODE"].".php".'">'.$arProps["FILE"]["VALUE"][$keyFile].'<img alt="'.$arProps["NAME"]["VALUE"][$keyName].'" src="'.$arProps["IMAGE"]["VALUE"][$keyImg].'"></a>
					<div>'.$new_files.$arProps["NAME"]["VALUE"][$keyName].'</div>
				</div>';*/

				$video_element .= '<div id="video_element" style="max-width: 250px; margin-right: 10px;">
					<video style="width:100%" id="" controls="controls" poster="'.$arProps["IMAGE"]["VALUE"][$keyImg].'">
						<source src="'.$arProps["FILE"]["VALUE"][$keyFile].'" type="video/mp4" />
					</video>
					<div class="v_el">
						<h3>'.$arProps["NAME"]["VALUE"][$keyName].'</h3>
					</div>
				</div>';
		}
		if ($video_element != "")
		{
			$name = GetMessage($section_name);
			if ($name == "О компании"){$check = ' checked="checked"';}
			if ($section_name != "" && $real_path["path"] != GetMessage("URL"))
				echo '<input type="checkbox" id='.GetMessage($section_name).$check.' name="vkladki"><label for='.GetMessage($section_name).'><span class="dashed">'.GetMessage($section_name).'</span></label>';
			echo '<div class="elements_list">'.$video_element."</div>";
		}
	}
}
?>
<div class="catalog-section-list tabs">
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
