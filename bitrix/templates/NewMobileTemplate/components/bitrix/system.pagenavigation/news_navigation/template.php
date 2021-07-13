<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
if ($arResult["NavPageCount"] > 1)
{
	$first_string = GetMessage("NAVIG_START"). $arResult["NavFirstRecordShow"]." ".GetMessage("NAVIG_TO")." ".$arResult["NavLastRecordShow"]." ".GetMessage("NAVIG_OF")." ".$arResult["NavRecordCount"]."<br />";

	parse_str($_SERVER["QUERY_STRING"], $output);
	if ($output["year"])
		$year = "?year=".$output["year"];
	unset($output["bxajaxid"]);
	unset($output["PAGEN_".$arResult["NavNum"]]);

	if ($arResult["NavPageNomer"] > 1)
	{
		$last_string = '<a href="'.$arResult["sUrlPath"].$year.'">'.GetMessage("NAVIG_BEGIN").'</a> | ';
		if ($arResult["NavPageNomer"] > 2)
			$output["PAGEN_".$arResult["NavNum"]] = $arResult["NavPageNomer"]-1;
		if ($output)
			$new_url = "?".http_build_query($output);
		if (!$output["year"])
			$APPLICATION->AddHeadString('<link rel="prev" href="'.$arResult["sUrlPath"].$new_url.'" />');
		$last_string .= '<a href="'.$arResult["sUrlPath"].$new_url.'">'.GetMessage("NAVIG_PREV").'</a> | ';
	}
	else
		$last_string .= GetMessage("NAVIG_BEGIN"). " | " . GetMessage("NAVIG_PREV") . " | ";
	while($arResult["nStartPage"] <= $arResult["nEndPage"])
	{
		unset($output["PAGEN_".$arResult["NavNum"]]);
		$new_url = "";
		if ($arResult["nStartPage"] == $arResult["NavPageNomer"])
			$last_string .= "<b>".$arResult["nStartPage"]."</b> ";
		elseif($arResult["nStartPage"] == 1)
		{
			if ($output)
				$new_url = "?".http_build_query($output);
			$last_string .= '<a href="'.$arResult["sUrlPath"].$new_url.'">'.$arResult["nStartPage"].'</a> ';
		}
		else
		{
			$output["PAGEN_".$arResult["NavNum"]] = $arResult["nStartPage"];
			$new_url = $arResult["sUrlPath"]."?".http_build_query($output);
			$last_string .= '<a href="'.$new_url.'">'.$arResult["nStartPage"].'</a> ';
		}
		$arResult["nStartPage"]++;
	}
	if($arResult["NavPageNomer"] < $arResult["NavPageCount"])
	{
		$output["PAGEN_".$arResult["NavNum"]] = $arResult["NavPageNomer"]+1;
		$last_string .= '<a href="'.$arResult["sUrlPath"]."?".http_build_query($output).'">'.GetMessage("NAVIG_NEXT").'</a> | ';
		if (!$output["year"])
			$APPLICATION->AddHeadString('<link rel="next" href="'.$arResult["sUrlPath"]."?".http_build_query($output).'" />');
		$output["PAGEN_".$arResult["NavNum"]] = $arResult["NavPageCount"];
		$last_string .= '<a href="'.$arResult["sUrlPath"]."?".http_build_query($output).'">'.GetMessage("NAVIG_END").'</a>';
	}
	else
		$last_string .= GetMessage("NAVIG_NEXT")." | ".GetMessage("NAVIG_END");
	echo $first_string.$last_string;
}
?>