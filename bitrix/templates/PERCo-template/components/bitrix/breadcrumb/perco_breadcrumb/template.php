<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
//delayed function must return a string
switch(LANGUAGE_ID)
{
	case "ru": $LANG="RUS"; break;
	case "en": $LANG="ENG"; break;
	case "de": $LANG="DEU"; break;
	case "fr": $LANG="FRA"; break;
	case "es": $LANG="ESP"; break;
	case "it": $LANG="ITA"; break;
}
if(empty($arResult))
	return "";
$strReturn = '<ul itemscope itemtype="http://schema.org/BreadcrumbList" class="breadcrumb-navigation">';
for($index = 0, $itemSize = count($arResult); $index < $itemSize-1; $index++)
{
	if (($arResult[$index]["TITLE"]!="Азия")&&($arResult[$index]["TITLE"]!="Европа")&&($arResult[$index]["TITLE"]!="Америка, Африка")&&($arResult[$index]["TITLE"]!="Океания"))
	{
		$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
		if (LANGUAGE_ID == "en")
			$arResult[$index]["LINK"] = str_replace("_com", "", $arResult[$index]["LINK"]);
		if($arResult[$index]["LINK"] <> "")
		{
			if ($index > 0)
				$strReturn .= '<li>&nbsp;<img alt="Стрелка" src="/images/icons/arrow_mini.svg" width="2" height="4"/>&nbsp;</li>';
			$strReturn .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'"  itemprop="item"  class="navlink"><span itemprop="name">'.$title.'</span><meta itemprop="position" content="'.$index.'"></a></li>';
		}
		/*else
			$strReturn .= '<li>'.$title.'</li>';*/
	}
}
if ($index == 0)
	$strReturn .= '<li class="navlink">'.$arResult[$index]["TITLE"].'</li>';
else
{
	if ($LANG!="RUS")
	{
		$sectionResult = CIBlockSection::GetList(array("SORT" => "ASC"), array("IBLOCK_ID" => "23", "NAME" => $arResult[$index]["TITLE"]), false, $arSelect = array("UF_NAME_".$LANG));
		while ($sectionProp = $sectionResult -> GetNext())
		{
			$arResult[$index]["TITLE"]=$sectionProp["UF_NAME_".$LANG];
		}
	}
	$strReturn .= '<li>&nbsp;<img alt="Стрелка" src="/images/icons/arrow_mini.svg" width="2" height="4"/>&nbsp;</li><li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem" class="navlink"><a href="'.$_SERVER['REQUEST_URI'].'" itemprop="item" class="last-link" onclick="return false;"><span itemprop="name">'.$arResult[$index]["TITLE"].'</span><meta itemprop="position" content="'.$index.'"></a></li>';
}
$strReturn .= '</ul>';
return $strReturn;
?>