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
		$list_files = "";
		while($ar = $rs->GetNextElement())
		{
			$arFields = $ar->GetFields();
			$arProps = $ar->GetProperties();
			if (is_array($arProps["FILE"]["DESCRIPTION"]))
			{
				$keyName = array_search(LANGUAGE_ID, $arProps["NAME"]["DESCRIPTION"]);
				$keyFile = array_search(LANGUAGE_ID, $arProps["FILE"]["DESCRIPTION"]);
				$name = $arProps["NAME"]["VALUE"][$keyName];
				$file = $arProps["FILE"]["VALUE"][$keyFile];
				if ($keyFile === false)
					continue;
			}
			else
			{
				$name = $arProps["NAME"]["VALUE"];
				$file = $arProps["FILE"]["VALUE"];
			}
			$fSize = '('.printFileInfo($file, "size").')&nbsp;';
			if ($arPropDown["INSTAL_TIME"]["VALUE"])
				$date = $arPropDown["INSTAL_TIME"]["VALUE"];
			else
				$date = printFileInfo($file, "date");
			if ($arProps["INSTAL_VERSION"]["VALUE"] && LANGUAGE_ID == "ru")
				$version = ", версия ".$arProps["INSTAL_VERSION"]["VALUE"];
			$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
			if ($with_image == "Y")
				$list_files .= '<div class="element_item"><div><img alt="'.$name.'" src="'.$arProps["IMAGE"]["VALUE"].'"></div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.'</a><div class="color">'.$fSize.' — '.$date.'</div></div>';
			else
				$list_files .= '<li><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.$version.'</a> <span class="color">'.$fSize.' — '.$date.'</span></li>';
		}
		if ($with_image == "Y")
			echo '<div class="elements_list">'.$list_files.'</div>';
		else
			echo "<ul>".$list_files."</ul>";
	}
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
