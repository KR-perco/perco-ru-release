<?
global $price_res;
$rsPrice = CIBlockElement::GetList(array(), array("IBLOCK_CODE"=>"product_info", "CODE" => "cr01"), false, false, array("ID", "PROPERTY_PRICE"));	// перечень полей необходимых в результате выборки
if (intval($rsPrice->SelectedRowsCount()) > 0)
{
	$arPrice = $rsPrice->Fetch();
	if ($price_res == 0)
	{
		$cr_price = $arPrice["PROPERTY_PRICE_VALUE"] . " €";
		$sp09_price = "265 €";
		$montazh = $arPrice["PROPERTY_PRICE_VALUE"]*0.2 . " €";
		$summa = $arPrice["PROPERTY_PRICE_VALUE"] + 265 + $arPrice["PROPERTY_PRICE_VALUE"]*0.2 . " €";
	}
	else
	{
		$cr_price = number_format($arPrice["PROPERTY_PRICE_VALUE"]*$price_res, 0, ",", " ") . " &#8381;";
		$sp09_price = number_format(265*$price_res, 0, ",", " ") . " &#8381;";
		$montazh = number_format($arPrice["PROPERTY_PRICE_VALUE"]*0.2*$price_res, 0, ",", " ") . " &#8381;";
		$summa = number_format(($arPrice["PROPERTY_PRICE_VALUE"] + 265 + $arPrice["PROPERTY_PRICE_VALUE"]*0.2)*$price_res, 0, ",", " ") . " &#8381;";
	}
}
$php_result = '<p>Стоимость комплекта оборудования для организации учета рабочего времени для приведенной в пример компании составляет ориентировочно '.$summa.':</p>
	<ul>
		<li>'.$cr_price.' – стоимость контроллера CR01</li>
		<li>'.$sp09_price.' – стоимость специального комплекта ПО PERCo-SP09, обслуживающего все установленные на предприятии терминалы LICON</li>
		<li>'.$montazh.' - ориентировочная стоимость монтажа (20% от стоимости оборудования)</li>
	</ul>';
if ($price_res == 0)
	$php_result .= "<p>*в рублях по курсу ЦБ РФ</p>";
else
	$php_result .= "<p>*Расчет произведен по курсу ЦБ РФ на " . date("d.m.Y") . "</p>";
?>