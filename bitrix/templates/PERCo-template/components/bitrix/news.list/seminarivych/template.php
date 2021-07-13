<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
if (!empty($arResult["ITEMS"]))
{
	$kto = "";
	if (stripos($_SERVER['REQUEST_URI'], '/polzovateley/')!== false || SITE_ID == "s3")
	{
		$kto = "пользователи";
		$tema = "администратор";
		$kto_let = "U";
	}
	if (stripos($_SERVER['REQUEST_URI'], '/installyatorov/')!== false)
	{
		$kto = "инсталляторы";
		$tema = "инсталлятор";
		$kto_let = "P";
	}
	$inum = 1;
	$inum_pskov = 1;
	$line = "";
	$line_pskov = "";
	foreach($arResult["ITEMS"] as $arItem)
	{
		if ($arItem["IBLOCK_SECTION_ID"] != "1532"){
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
			if ($kto)
			{
				$auditory = "";
				$datetime = $arItem["ACTIVE_TO"];
				$format = "DD.MM.YYYY HH:MI";
				$arr = ParseDateTime($datetime, $format);
				$sBegin = $arr["DD"];
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
				$sData = $sBegin.' '.$arr["MM"].' '.$arr["YYYY"];
				if (($arProp["CITY"]["VALUE"] == "Санкт-Петербург") and ($arProp["TOPIC"]["VALUE"] != NULL)) {
					$line .= "<tr><td>".$inum."</td><td>".str_ireplace("#kto#", $tema, $arProp["TOPIC"]["VALUE"])."</td><td>";
					$arPreview = explode("###", $arFields["PREVIEW_TEXT"]);
					if ($kto && count($arPreview) > 1)
					{
						switch($kto)
						{
							case "инсталляторы":
								$preview = $arPreview[0];
								break;
							case "пользователи":
								$preview = $arPreview[1];
								break;
						}
					}
					else
						$preview = $arFields["PREVIEW_TEXT"];
					if ($arProp["FOR_US_".$kto_let]["VALUE"])
					{
						$i=1;
						$num = count($arProp["FOR_US_".$kto_let]["VALUE"]);
						foreach($arProp["FOR_US_".$kto_let]["VALUE"] as $value)
						{
							$auditory .= $value;
							if ($num > $i) $auditory .= ", ";
								$i++;
						}
					}
					$line .= $auditory . '</td><td><span style="white-space: nowrap; ">'.$sData.'</span></td><td align="center">'.$arProp["DURATION"]["VALUE"] .' мин.</td></tr>';
					if ($inum < 5)
					{
						$dop_info .= '<h2><a name="'.$inum.'"></a>'.str_replace("PERCo", 'PERC<span style="text-transform:lowercase;">o</span>', str_ireplace("#kto#", $tema, $arProp["TOPIC"]["VALUE"])).'</h2>'
						.$preview.
						'<p>
							<img width="11" height="11" src="/images/icons/plus.png" alt="" onclick="plusminus(\'img'.$inum.'\', \'block'.$inum.'\');" id="img'.$inum.'">
							<a class="seminars-plan-link" href="javascript:void(0);" onclick="plusminus(\'img'.$inum.'\', \'block'.$inum.'\');">План семинара</a>
						</p>
						<div id="block'.$inum.'" style="display: none;" align="center">'.$arFields["DETAIL_TEXT"].'</div>';
					}
					$inum++;
				}
			}
		}
	}
?>

<div>
	<h2>График семинаров</h2>
	<table>
		<thead>
			<tr>
				<th>№</th> <th>Тема семинара</th> <th>Аудитория</th> <th>Дата</th> <th>Продолжительность</th>
			</tr>
		</thead>
		<tbody>
		<?=$line;?>
		</tbody>
	</table>
	<?=$dop_info;?>
	<?require($_SERVER["DOCUMENT_ROOT"]."/obuchenie/dop_info_spb.php");?>
</div>
<? } ?>