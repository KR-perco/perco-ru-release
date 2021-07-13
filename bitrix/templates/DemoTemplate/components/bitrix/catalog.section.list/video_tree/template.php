<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
switch(LANGUAGE_ID)
{
	case "en":
		$alt_lang = "_ENG";
		break;
	case "de":
		$alt_lang = "_DEU";
		break;
	case "fr":
		$alt_lang = "_FRA";
		break;
	case "it":
		$alt_lang = "_ITA";
		break;
	case "es":
		$alt_lang = "_ESP";
		break;
}
function getElements($iblock_id, $section_id, $archive, $with_image)
{
	if ($archive)
		$archive = "!PROPERTY_ARCHIVE";
	else
		$archive = "PROPERTY_ARCHIVE";
	$rs = CIBlockElement::GetList(
		array("SORT"=>"ASC"), 
		array(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => $iblock_id,
			"SECTION_ID" => $section_id,
			$archive => false
		)
	);
	if (intval($rs->SelectedRowsCount()) > 0)
	{
		$version = "";
		$video_files = "";
		
		while($ar = $rs->GetNextElement())
		{
			$video_element = "";
			$arFields = $ar->GetFields();
			$arProps = $ar->GetProperties();
			$keyFile = array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]);
			$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
			$keyImg = array_search(LANGUAGE_ID, $arProps["IMAGE"]["DESCRIPTION"]);

			if ($keyName !== false){
				$video_element .= '<div id="video_element">
					<video controls="controls" poster="'.$arProps["IMAGE"]["VALUE"][$keyImg].'">
						<source src="'.$arProps["FILE"]["VALUE"][$keyFile].'" type="video/mp4" />
					</video>
					<div class="v_el">
						<h4>'.$arProps["NAME"]["VALUE"][$keyName].'</h4>
					</div>
				</div>';
			}
			$video_files .= $video_element;				
		}
	}
	echo $video_files;
}
?>
<div class="catalog-section-list">
<?
$archive = $_REQUEST["archive"];
if ($arResult["SECTIONS_COUNT"] > 0)
{
	$TOP_DEPTH = $arResult["SECTION"]["DEPTH_LEVEL"];
	$CURRENT_DEPTH = $TOP_DEPTH;
	foreach($arResult["SECTIONS"] as $arSection)
	{
		if (LANGUAGE_ID == "ru")
			$name = $arSection["NAME"];
		else
			$name = $arSection["UF_LANG".$alt_lang];
		if ((!$arSection["UF_ARCHIVE"] && !$archive) || ($arSection["UF_ARCHIVE"] && $archive))
		{
			if ($arParams["WITH_IMAGE"] == "Y")
				echo "<h2>".$name."</h2>";
			else
			{
				if($CURRENT_DEPTH < $arSection["DEPTH_LEVEL"])
					echo "<dl>";
				elseif($CURRENT_DEPTH == $arSection["DEPTH_LEVEL"])
					echo "</dt>";
				else
				{
					while($CURRENT_DEPTH > $arSection["DEPTH_LEVEL"])
					{
						echo "</dt>";
						echo "</dl>";
						$CURRENT_DEPTH--;
					}
					echo "</dt>";
				}
				echo "<dt>".$name;
			}
			getElements($arSection["IBLOCK_ID"], $arSection["ID"], $archive, $arParams["WITH_IMAGE"]);
			$CURRENT_DEPTH = $arSection["DEPTH_LEVEL"];
		}
	}
	while($CURRENT_DEPTH > $TOP_DEPTH)
	{
		echo "</dt></dl>";
		$CURRENT_DEPTH--;
	}
}
elseif ($arResult["SECTION"]["ID"] != 0)
{
	if (LANGUAGE_ID == "ru")
		$name = $arSection["SECTION"]["NAME"];
	else
		$name = $arResult["SECTION"]["UF_LANG".$alt_lang];
	if ($arParams["PARENT_NAME"] != "N")
	{
		if ($arParams["WITH_IMAGE"] == "Y")
			echo "<h2>".$name."</h2>";
		else
			echo $name;
	}
	getElements($arResult["SECTION"]["IBLOCK_ID"], $arResult["SECTION"]["ID"], $archive, $arParams["WITH_IMAGE"]);
}
?>
</div>
