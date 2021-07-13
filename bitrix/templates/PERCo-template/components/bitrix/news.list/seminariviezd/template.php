<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? 
if (!empty($arResult["ITEMS"])){
if (SITE_ID=="s1") {
	$siteStyle="margin-top: 0pt; margin-right: 0pt; margin-bottom: 0pt; margin-left: 10px; width: 980px;"; 
	}
	else 
	{
	$siteStyle="width: 100%;";
	}
echo '<h3>График ближайших семинаров</h3>
		 <table class="data-table" style="'.$siteStyle.' border-style: none;"> 
		<thead>
		  <tr>
			<td>Город</td>
			<td>Тема семинара</td>
			<td>Дата</td>
			<td>Продолжительность</td>
			<td>Организатор</td>
		  </tr>
		</thead><tbody>';
foreach($arResult["ITEMS"] as $arItem):
$datetime = $arItem["ACTIVE_TO"];
$format = "DD.MM.YYYY HH:MI";
$arr = ParseDateTime($datetime, $format);
switch ($arr["MM"]) {
	case "01" : $arr["MM"]="Января"; break;
	case "02" : $arr["MM"]="Февраля"; break;
	case "03" : $arr["MM"]="Марта"; break;
	case "04" : $arr["MM"]="Апреля";  break;
	case "05" : $arr["MM"]="Мая"; break;
	case "06" : $arr["MM"]="Июня"; break;
	case "07" : $arr["MM"]="Июля"; break;
	case "08" : $arr["MM"]="Августа"; break;
	case "09" : $arr["MM"]="Сентября"; break;
	case "10" : $arr["MM"]="Октября"; break;
	case "11" : $arr["MM"]="Ноября"; break;
	case "12" : $arr["MM"]="Декабря"; break;
}
$dayZer=$arr["DD"]+0;
$sData=$dayZer.' '.$arr["MM"].' '.$arr["YYYY"];
if ($arItem["PROPERTIES"]["ORG"]["VALUE"] == "PERCo")
{
?>
<tr>
    <td class="city"><?=$arItem["PROPERTIES"]["CITY"]["VALUE"]; ?></td>
    <td><?=$arItem["PROPERTIES"]["TEMA"]["VALUE"]; ?></td>
    <!--<td><? /* if ($arItem["PROPERTIES"]["KTO"]["VALUE"]){
			$i=1;
			$numK=1;
			$numK=count($arItem["PROPERTIES"]["KTO"]["VALUE"]);
			foreach($arItem["PROPERTIES"]["KTO"]["VALUE"] as $arKto): 
				echo $arKto; 
				if ($numK>$i) echo ", ";
				$i++;
			endforeach;
			} */?></td>-->
    <td><span "no-wrap"><?=$sData ?></span></td>
    <td><span "no-wrap"><?=$arItem["PROPERTIES"]["DURATION"]["VALUE"]; ?></span></td>
    <td><span "no-wrap"><?=$arItem["PROPERTIES"]["ORG"]["VALUE"]; ?></span></td>
</tr>
<? 
}
else
{
	$arOrgOther[] = $arItem;
}
endforeach;
	if ($arOrgOther)
	{
	echo '<tr><td colspan="6" style="border-style: none;"><h3 style="margin-left: -16px;">Семинары, организованные совместно с партнерами</h3></td></tr>
			<thead>
			  <tr>
				<td>Город</td>
				<td>Тема семинара</td>
				<td>Дата</td>
				<td>Продолжительность</td>
				<td>Организатор</td>
			  </tr>
			</thead>';
		foreach($arOrgOther as $arItem):
			$datetime = $arItem["ACTIVE_TO"];
			$format = "DD.MM.YYYY HH:MI";
			$arr = ParseDateTime($datetime, $format);
			switch ($arr["MM"])
			{
				case "01" : $arr["MM"]="Января"; break;
				case "02" : $arr["MM"]="Февраля"; break;
				case "03" : $arr["MM"]="Марта"; break;
				case "04" : $arr["MM"]="Апреля";  break;
				case "05" : $arr["MM"]="Мая"; break;
				case "06" : $arr["MM"]="Июня"; break;
				case "07" : $arr["MM"]="Июля"; break;
				case "08" : $arr["MM"]="Августа"; break;
				case "09" : $arr["MM"]="Сентября"; break;
				case "10" : $arr["MM"]="Октября"; break;
				case "11" : $arr["MM"]="Ноября"; break;
				case "12" : $arr["MM"]="Декабря"; break;
			}
			$dayZer=$arr["DD"]+0;
			$sData=$dayZer.' '.$arr["MM"].' '.$arr["YYYY"];
?>
<tr>
    <td class="city"><?=$arItem["PROPERTIES"]["CITY"]["VALUE"]; ?></td>
    <td><?=$arItem["PROPERTIES"]["TEMA"]["VALUE"]; ?></td>
    <!--<td><? /* if ($arItem["PROPERTIES"]["KTO"]["VALUE"]){
			$i=1;
			$numK=1;
			$numK=count($arItem["PROPERTIES"]["KTO"]["VALUE"]);
			foreach($arItem["PROPERTIES"]["KTO"]["VALUE"] as $arKto): 
				echo $arKto; 
				if ($numK>$i) echo ", ";
				$i++;
			endforeach;
			} */?></td>-->
    <td><span "no-wrap"><?=$sData ?></span></td>
    <td><span "no-wrap"><?=$arItem["PROPERTIES"]["DURATION"]["VALUE"]; ?></span></td>
    <td><span "no-wrap"><?=$arItem["PROPERTIES"]["ORG"]["VALUE"]; ?></span></td>
</tr>
<?
		endforeach;
	}
	echo '</tbody>
	</table>';
}
?>