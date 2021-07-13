<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
$rs = CIBlockElement::GetList(
	array("SORT"=>"ASC"), 
	array(
		"ACTIVE" => "Y",
		"IBLOCK_ID" => $arResult["SECTION"]["IBLOCK_ID"],
		"SECTION_ID" => $arResult["SECTION"]["ID"],
		$archive => false
	)
);


if (intval($rs->SelectedRowsCount()) > 0)
{
	$version = "";
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
			if($arProps["IMAGE"]["VALUE"][0] != ''){
				$icon = $arProps["IMAGE"]["VALUE"][0];
			}
			
			$fSize = '('.printFileInfo($file, "size").')&nbsp;';

			if ($arPropDown["INSTAL_TIME"]["VALUE"])
				$date = $arPropDown["INSTAL_TIME"]["VALUE"];
			else
				$date = printFileInfo($file, "date");

			if ($arProps["INSTAL_VERSION"]["VALUE"] && LANGUAGE_ID == "ru")
			$version = "версия ".$arProps["INSTAL_VERSION"]["VALUE"];
			
			echo ('<div class="block-btn"><a class="btn" href="'.$file.'"><i class="download-icon" style="background-image: url('.$icon.');"></i>СКАЧАТЬ '.$name.'</a><p><span class="color" style="font-size:15px;">'.$version.', '.$fSize.' — '.$date.'</span></p></div>');
			
		}
	}
}