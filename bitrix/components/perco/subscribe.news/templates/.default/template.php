<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult["IBLOCKS"] as $arIBlock)
{
	if(count($arIBlock["ITEMS"]) > 0)
	{
		foreach($arIBlock["ITEMS"] as $arItem)
		{			
			$arFilter = Array("IBLOCK_ID"=>$arItem["IBLOCK_ID"], "ID" => $arItem["ID"]);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*");
			$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			$ob = $res->GetNextElement();
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();
			echo '<div style="margin: 10px 0;"><a style="text-decoration: none;" href="'.$arProps["PRODUCT_LINK"]["VALUE"].'"><img src="https://perco.ru'.$arProps["HEADER_IMG"]["VALUE"].'" width="100%"></a><div style="padding:20px; font-size:15px;">';

			$content = $arFields["DETAIL_TEXT"];
			if ($arProps["LINKS"]["VALUE"])		// Устанавливаем ссылки на фразы
			{
				for($i=0; $i < count($arProps["LINKS"]["VALUE"]); $i++)
				{
					$url = $arProps["LINKS"]["VALUE"][$i];
					$trans = $arProps["LINKS"]["DESCRIPTION"][$i];
					$content = preg_replace("/(?<![\"\'\«]{1})$trans/", "<a href='$url'>\\0</a>", $content, 1);
				}
			}
			echo $content;
			if (count($arProps["PREVIEW"]["VALUE"]) > 0)
			{
				echo '<p style="margin: 30px 0 0 0; text-align:center">';
				foreach($arProps["PREVIEW"]["VALUE"] as $val)
				{
					$arFilterImg = Array("IBLOCK_ID"=>$arProps["PREVIEW"]["LINK_IBLOCK_ID"], "ID" => $val);
					$arSelectImg = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
					$resImg = CIBlockElement::GetList(array(), $arFilterImg, false, Array(), $arSelectImg);
					$obImg = $resImg->GetNextElement();
					$arPropsImg = $obImg->GetProperties();
					$keyPreviewImg = array_search(LANGUAGE_ID, $arPropsImg["PREVIEW_OPIS"]["DESCRIPTION"]);
					$text_preview = $arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg];
					echo '<img style="margin: 10px" src="https://perco.ru'.$arPropsImg["PREVIEW"]["VALUE"].'" alt="'.$text_preview.'" />';
				}
				echo '</p></div></div>';
			}
		}
	}
}
?>