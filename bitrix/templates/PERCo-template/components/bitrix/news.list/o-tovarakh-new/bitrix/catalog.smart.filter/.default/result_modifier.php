<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
// sort


// {{{ Сквозная пересортировка свойств каталога и свойст SKU на основе поля SORT
 
	$arItemsProps = array();
	foreach($arResult["ITEMS"] as $prop){
		if(!isset($arItemsProps[$prop['IBLOCK_ID']])) $arItemsProps[$prop['IBLOCK_ID']] = array();
		if(!empty($prop['VALUES'])){
			$arItemsProps[$prop['IBLOCK_ID']][] = $prop['ID'];
		}
	}
	 
	$arIblockProps = array();
	 
	foreach($arItemsProps as $arItemsPropIblockId => $arItemsPropIds){
	 
		$propsIds = array_flip($arItemsPropIds);
	 
		$res = CIBlock::GetProperties($arItemsPropIblockId, Array(), Array());
		while($arRes = $res->Fetch()){
			if(isset($propsIds[$arRes['ID']])){
				$arIblockProps[$arRes['ID']] = $arRes['SORT'];
			}
		}
	 
	}
	 
	if(!empty($arIblockProps)){
	 
		asort($arIblockProps);
	 
		usort($arResult["ITEMS"], function($a, $b) use ($arIblockProps) {
	 
			if($arIblockProps[$a['ID']] == $arIblockProps[$b['ID']]){
				return 0;
			}
	 
			return ($arIblockProps[$a['ID']] < $arIblockProps[$b['ID']]) ? -1 : 1;
		});
	 
	}
	 
	// }}}

// if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
// {
// 	$arAvailableThemes = array();
// 	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
// 	if (is_dir($dir) && $directory = opendir($dir))
// 	{
// 		while (($file = readdir($directory)) !== false)
// 		{
// 			if ($file != "." && $file != ".." && is_dir($dir.$file))
// 				$arAvailableThemes[] = $file;
// 		}
// 		closedir($directory);
// 	}

// 	if ($arParams["TEMPLATE_THEME"] == "site")
// 	{
// 		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
// 		if ($solution == "eshop")
// 		{
// 			$templateId = COption::GetOptionString("main", "wizard_template_id", "eshop_bootstrap", SITE_ID);
// 			$templateId = (preg_match("/^eshop_adapt/", $templateId)) ? "eshop_adapt" : $templateId;
// 			$theme = COption::GetOptionString("main", "wizard_".$templateId."_theme_id", "blue", SITE_ID);
// 			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
// 		}
// 	}
// 	else
// 	{
// 		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
// 	}
// }
// else
// {
// 	$arParams["TEMPLATE_THEME"] = "blue";
// }

// $arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
// $arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

