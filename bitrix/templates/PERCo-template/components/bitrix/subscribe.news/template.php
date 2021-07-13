<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
foreach($arResult["IBLOCKS"] as $arIBlock)
{
	if(count($arIBlock["ITEMS"]) > 0)
	{
		foreach($arIBlock["ITEMS"] as $arItem)
		{
			echo '<div style="margin-bottom: 45px; background-image: url(https://perco.ru'.$arPropsImg["HEADER_IMG"]["VALUE"].');background-repeat:no-repeat;background-position:50% -10px;-webkit-background-size:cover;background-size:cover;border-radius:6px"><h1 style="font-size:16px; margin-top:10px;">'.$arItem["NAME"].'</h1>';
			$arFilter = Array("IBLOCK_ID"=>$arItem["IBLOCK_ID"], "ID" => $arItem["ID"]);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*");
			$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			$ob = $res->GetNextElement();
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();
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
				echo '<p style="margin-bottom:7px; margin-top:7px; text-align:center">';
				foreach($arProps["PREVIEW"]["VALUE"] as $val)
				{
					$arFilterImg = Array("IBLOCK_ID"=>$arProps["PREVIEW"]["LINK_IBLOCK_ID"], "ID" => $val);
					$arSelectImg = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
					$resImg = CIBlockElement::GetList(array(), $arFilterImg, false, Array(), $arSelectImg);
					$obImg = $resImg->GetNextElement();
					$arPropsImg = $obImg->GetProperties();
					$keyPreviewImg = array_search(LANGUAGE_ID, $arPropsImg["PREVIEW_OPIS"]["DESCRIPTION"]);
					$text_preview = $arPropsImg["PREVIEW_OPIS"]["VALUE"][$keyPreviewImg];
					echo '<img style="margin: 5px;" src="https://perco.ru'.$arPropsImg["PREVIEW"]["VALUE"].'" alt="'.$text_preview.'" />';
				}
				echo '</p></div>';
			}
		}
	}
}
?>