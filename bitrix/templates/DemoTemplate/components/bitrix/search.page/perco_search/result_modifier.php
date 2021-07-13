<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

CModule::IncludeModule("iblock");
foreach ($arResult["SEARCH"] as $nItem => $arItem)
{
	if ($arItem["MODULE_ID"] == "iblock")
	{
		$rsElement = CIBlockElement::GetByID($arItem["ITEM_ID"]);
		if($arElement = $rsElement->GetNext())
		{
			$rsNav = CIBlockSection::GetNavChain($arElement["IBLOCK_ID"], $arElement["IBLOCK_SECTION_ID"]);

			while ($arSectionPath = $rsNav->GetNext())
				$arItem["CHAIN_PATH"] .= ' / <a href="'.$arSectionPath["SECTION_PAGE_URL"].'">'.$arSectionPath["NAME"].'</a>';

			$arResult["SEARCH"][$nItem] = $arItem;
		}
	}
}
?>