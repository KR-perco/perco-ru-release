<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<table class="uchitelskaya_jurnal" width="100%" border="0" cellspacing="0" cellpadding="0">
	<thead>
		<tr>
			<td id="jurnal_zayavok_td_1" valign="top">Название компании</td>
			<td id="jurnal_zayavok_td_2" valign="top" style="width: 90px;">Вид доставки</td>
			<td id="jurnal_zayavok_td_3" valign="top">Дата</td>
			<td id="jurnal_zayavok_td_4" valign="top">Наименование заказа и количество</td>
			<td id="jurnal_zayavok_td_5" valign="top">Подтверждение</td>
		</tr>
	</thead>
	<tbody>
<?
foreach($arResult["ITEMS"] as $arValue)
{
	if ($_GET['confirm'] == 1 && $_GET['id'] == $arValue["ID"])
	{
		CIBlockElement::SetPropertyValueCode($_GET['id'], "CONFIRM", array("VALUE_ENUM_ID"=>86));
		$confirm = "Отправлено";
	}
	elseif (!$arValue["PROPERTIES"]["CONFIRM"]["VALUE"])
		$confirm = '<a href="?id='.$arValue["ID"].'&confirm=1">Подтвердить отправку</a>';
?>
		<tr>
			<td><a href="order.php?ORDER_ID=<?=$arValue["ID"];?>"><?=$arValue["PROPERTIES"]["COMPANY"]["VALUE"];?></a></td>
			<td><?=$arValue["PROPERTIES"]["SHIPMENT"]["VALUE"];?></td>
			<td><?=$arValue["PROPERTIES"]["DATA"]["VALUE"];?></td>
			<td>
<?
		for($i=0; $i<count($arValue["PROPERTIES"]["ZAKAZ"]["VALUE"]); $i++)
		{
			echo $arValue["PROPERTIES"]["ZAKAZ"]["VALUE"][$i] . " - " . $arValue["PROPERTIES"]["ZAKAZ"]["DESCRIPTION"][$i] . "<br />";
		}
?>
			</td>
			<td><?=$confirm;?></td>
		</tr>
<?
}
?>
	</tbody>
</table>