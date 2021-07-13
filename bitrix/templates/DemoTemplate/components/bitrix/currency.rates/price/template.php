<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $price_res;
if (is_array($arResult["CURRENCY_CBRF"]) && $arParams["SHOW_CB"] == "Y")
{
	foreach ($arResult["CURRENCY_CBRF"] as $arCurrency)
	{
		$price = explode(" ", $arCurrency["BASE"]);
	}
	$price_res = $price[0];
}
else
{
	$price_res = 0;
}
?>