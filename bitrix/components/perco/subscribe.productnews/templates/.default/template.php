<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
$i = 0;
foreach($arResult["IBLOCKS"] as $arIBlock)
{
	if(count($arIBlock["ITEMS"]) > 0)
	{
		foreach($arIBlock["ITEMS"] as $arItem)
		{			
			if($i){
				echo '<hr>';
			}
			$i++;

			$arFilter = Array("IBLOCK_ID"=>$arItem["IBLOCK_ID"], "ID" => $arItem["ID"]);
			$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "PROPERTY_*");
			$res = CIBlockElement::GetList(array(), $arFilter, false, Array(), $arSelect);
			$ob = $res->GetNextElement();
			$arFields = $ob->GetFields();
			$arProps = $ob->GetProperties();
			echo '<div style="display: flex; align-items: center; padding: 20px 0;">
				  <div>
				  <h3 style="color: #214288;">'.$arItem["NAME"].'</h3>
				  <p>'.$arItem["PREVIEW_TEXT"].'</p> 
				  </div>
				  <div>
				  <img style="padding: 0 0 0 10px" src="https://perco.ru'.$arProps["ANONS_IMG"]["VALUE"].'">
				  </div>
				  </div>';
		}
	}
}
?>