<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$kto = "";
if (stripos($_SERVER["REQUEST_URI"], "/polzovateley/")!== false || SITE_ID=="s3")
{
	$kto = "пользователи";
	$kto_let = "U";
}
if (stripos($_SERVER["REQUEST_URI"], "/installyatorov/")!== false)
{
	$kto = "инсталляторы";
	$kto_let = "P";
}
if (!empty($arResult["ITEMS"]))
{
	echo '<table class="data-table">
		<tbody>';
	foreach($arResult["ITEMS"] as $arItem)
	{
		if (!$arItem["PROPERTIES"]["SEMINAR"]["VALUE"])
			continue;
		$arFilter = array("IBLOCK_CODE"=>"list_seminars", "ID"=>$arItem["PROPERTIES"]["SEMINAR"]["VALUE"]);
		$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_TIME", "PROPERTY_DURATION", "PROPERTY_TOPIC", "PROPERTY_CITY", "PROPERTY_FOR_US_P", "PROPERTY_FOR_US_U", "PROPERTY_TYPE_SEMINAR");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		$arRes = $res->GetNextElement();
		$arFields = $arRes->GetFields(); 
		$arProp = $arRes->GetProperties();
		if (!$arProp["FOR_US_".$kto_let]["VALUE"])
			continue;
		$datetime = $arItem["DATE_ACTIVE_TO"];
		$format = "DD.MM.YYYY HH:MI";
		$arr = ParseDateTime($datetime, $format);
		switch ($arr["MM"])
		{
			case "01" : $arr["MM"]="Января"; break;
			case "02" : $arr["MM"]="Февраля"; break;
			case "03" : $arr["MM"]="Марта"; break;
			case "04" : $arr["MM"]="Апреля"; break;
			case "05" : $arr["MM"]="Мая"; break;
			case "06" : $arr["MM"]="Июня"; break;
			case "07" : $arr["MM"]="Июля"; break;
			case "08" : $arr["MM"]="Августа"; break;
			case "09" : $arr["MM"]="Сентября"; break;
			case "10" : $arr["MM"]="Октября"; break;
			case "11" : $arr["MM"]="Ноября"; break;
			case "12" : $arr["MM"]="Декабря"; break;
		}
		$sDataTime=$arr["DD"]." ".$arr["MM"]." ".$arr["HH"].":".$arr["MI"];
		$sData=$arr["DD"]." ".$arr["MM"]." ".$arr["YYYY"];
?>
		<tr>
			<td>
				<strong style="white-space: nowrap;"><?=$sDataTime; ?></strong><br />
				(время <?=$arProp["TIME"]["VALUE"];?>)
			</td>
			<td>
				<a name="<?=$arItem["ID"]?>"></a>
<?
		if ($arProp["TOPIC"]["VALUE"])
			echo "<p>Тема семинара: <strong>".$arProp["TOPIC"]["VALUE"]."</strong></p>";
		if ($arFields["PREVIEW_TEXT"] && SITE_ID != "s3")
			echo $arFields["PREVIEW_TEXT"];
		$auditory = "";
		if ($arProp["FOR_US_".$kto_let]["VALUE"])
		{
			echo "<p>Для кого проводится: ";
			$i=1;
			$num = count($arProp["FOR_US_".$kto_let]["VALUE"]);
			foreach($arProp["FOR_US_".$kto_let]["VALUE"] as $value)
			{
				$auditory .= $value;
				if ($num > $i) $auditory .= ", ";
					$i++;
			}
			echo $auditory . ".</p>";
		}
		if ( $arProp["DURATION"]["VALUE"] && SITE_ID != "s3")
			echo "<p>Продолжительность семинара: ".$arProp["DURATION"]["VALUE"]."мин.</p>";
		if ( $arFields["DETAIL_TEXT"] && SITE_ID != "s3")
			echo "<p>План семинара:</p>".$arFields["DETAIL_TEXT"];
?>
				<p><a href="/client/registration/vebinar.php?ID=<?=$arItem["ID"];?>" rel="nofollow" target="_blank">Регистрация</a> на семинар <?=$sData; ?></p>
			</td>
		</tr>
<?
	}
	echo "</tbody>
	</table>";
}
?>