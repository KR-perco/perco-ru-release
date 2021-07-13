<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<div id="seminars-list">
<?
$kto = "";
$seminar_id ="";
if (stripos($_SERVER['REQUEST_URI'], '/polzovateley/')!== false)
{
	$kto = "пользователи";
	$tema = "администратор";
	$kto_let = "U";
}
elseif (stripos($_SERVER['REQUEST_URI'], '/installyatorov/')!== false)
{
	$kto = "инсталляторы";
	$tema = "инсталлятор";
	$kto_let = "P";
}
$tmpURL = parse_url($_SERVER['REQUEST_URI']);
parse_str($tmpURL["query"], $parMonth);
if ($parMonth["month"] == NULL)
{
	$parMonth["month"] = date("m");
	$parMonth["year"] = date("Y");
}
if (!empty($arResult["ITEMS"]))
{
	foreach($arResult["ITEMS"] as $arItem)
	{
		$reg_link = array();
		if (!$arItem["PROPERTIES"]["SEMINAR"]["VALUE"])
			continue;
		$arFilter = array("IBLOCK_CODE"=>"list_seminars", "ID"=>$arItem["PROPERTIES"]["SEMINAR"]["VALUE"]);
		$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_TIME", "PROPERTY_DURATION", "PROPERTY_TOPIC", "PROPERTY_CITY", "PROPERTY_FOR_US_P", "PROPERTY_FOR_US_U", "PROPERTY_TYPE_SEMINAR");
		$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
		$arRes = $res->Fetch();
		if (!$arRes["PROPERTY_FOR_US_".$kto_let."_VALUE"])
			continue;
		$datetime = $arItem["DATE_ACTIVE_TO"];
		$format = "DD.MM.YYYY HH:MI";
		$arr = ParseDateTime($datetime, $format);
		if ($arr["MM"] == $parMonth["month"] && $arr["YYYY"] == $parMonth["year"])
		{
			switch ($arr["MM"])
			{
				case "01": $arr["MM"]="Января"; break;
				case "02": $arr["MM"]="Февраля"; break;
				case "03": $arr["MM"]="Марта"; break;
				case "04": $arr["MM"]="Апреля"; break;
				case "05": $arr["MM"]="Мая"; break;
				case "06": $arr["MM"]="Июня"; break;
				case "07": $arr["MM"]="Июля"; break;
				case "08": $arr["MM"]="Августа"; break;
				case "09": $arr["MM"]="Сентября"; break;
				case "10": $arr["MM"]="Октября"; break;
				case "11": $arr["MM"]="Ноября"; break;
				case "12": $arr["MM"]="Декабря"; break;
			}
			$sData = $arr["DD"] . ' ' . $arr["MM"];
			$sTime = $arr["HH"] . ':' . $arr["MI"];

			$date_end_tmp = strtotime($arItem["DATE_ACTIVE_TO"]);
			$datetime = mktime(date("H", $date_end_tmp), date("i", $date_end_tmp)+$arRes["PROPERTY_DURATION_VALUE"], 0, date("m", $date_end_tmp), date("d", $date_end_tmp), date("Y",$date_end_tmp));
			$datetime = date("d.m.Y H:i:s", $datetime);
			$format = "DD.MM.YYYY HH:MI";
			$arr = ParseDateTime($datetime, $format);
			switch ($arr["MM"])
			{
				case "01": $arr["MM"] = "Января"; break;
				case "02": $arr["MM"] = "Февраля"; break;
				case "03": $arr["MM"] = "Марта"; break;
				case "04": $arr["MM"] = "Апреля"; break;
				case "05": $arr["MM"] = "Мая"; break;
				case "06": $arr["MM"] = "Июня"; break;
				case "07": $arr["MM"] = "Июля"; break;
				case "08": $arr["MM"] = "Августа"; break;
				case "09": $arr["MM"] = "Сентября"; break;
				case "10": $arr["MM"] = "Октября"; break;
				case "11": $arr["MM"] = "Ноября"; break;
				case "12": $arr["MM"] = "Декабря"; break;
			}
			$eData = $arr["DD"] . ' ' . $arr["MM"];
			$eTime = $arr["HH"] . ':' . $arr["MI"];
			switch ($arItem["IBLOCK_SECTION_ID"])
			{
				case "1532":
					//$seminarName[0]  = "ИНТЕРНЕТ-СЕМИНАР";
					$seminarName[0]  = "ВЕБИНАР";
					$seminarName[1] = 'class="internet_seminar"';
					$seminar_id = "vebinar";
					$seminar_class = "veb";
					$reg_link[0] = "Записаться";
					$reg_link[1] = "/client/registration/vebinar.php?ID=".$arItem["ID"];
					break;
				case "1533":
					//$seminarName[0] = "ОЧНЫЙ СЕМИНАР В УЧЕБНОМ ЦЕНТРЕ САНКТ-ПЕТЕРБУРГА";
					$seminarName[0] = "СЕМИНАР В ОНЛАЙН ФОРМАТЕ";
					$seminarName[1] = 'class="ochnyi"';
					$seminar_id = "seminarvucentre";
					$seminar_class = "pskov";
					$reg_link[0] = "Подать заявку";
					$reg_link[1] = "/client/company/zayavka/";
					//$reg_link[2] = "<br />(возможно только для авторизованных компаний)";
					break;
			}
			if ($kto)
			{
				if (($arItem["PROPERTIES"]["ADDITIONAL"]["VALUE"] != 'true') and ($arItem["PROPERTIES"]["SEMINARS_COMBINED"]["VALUE"] == NULL )){
?>
<div class="block_sem <?=$seminar_class;?>" id="<?=$seminar_id;?>_id<?=$arItem["ID"];?>">
<div class="name" <?=$seminarName[1];?>><?=$seminarName[0];?></div>
<div class="seminar_info_block">
	<a name="<?=$arItem["ID"];?>"></a>
	<div class="seminar_about_block">
		
		<p><strong>
		<?
				if ($arRes["PROPERTY_CITY_VALUE"])
				{
					echo $arRes["PROPERTY_CITY_VALUE"] . '<br />';
				}
				if ($sData == $eData)
				{
					echo $sData . ' ' . $sTime . ' - ' . $eTime;
				}
				else
				{
					echo $sData . ' ' . $sTime . ' - ' . $eData . ' ' . $eTime;
				}
		 ?>
		</strong><br />
		(время <?=$arRes["PROPERTY_TIME_VALUE"];?>)
		</p>
		<p><a href="<?=$reg_link[1];?>"><?=$reg_link[0];?></a><?=$reg_link[2];?></p>
	</div>
	<div class="seminar_content_block">
		<span class="head_p"><?=str_ireplace("#kto#", $tema, $arRes["PROPERTY_TOPIC_VALUE"]);?></span>
<?
				if ($arRes["PREVIEW_TEXT"])
				{
					$arPreview = explode("###", $arRes["PREVIEW_TEXT"]);
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
						$preview = $arRes["PREVIEW_TEXT"];
					echo $preview;
				}
				if (stripos($_SERVER['REQUEST_URI'], '/polzovateley/')=== false && stripos($_SERVER['REQUEST_URI'], '/installyatorov/')=== false)
				{
					echo "<p>Для кого проводится: ";
					if ($arRes["PROPERTY_FOR_US_P_VALUE"])
						$kto_text[] = "инсталляторы";
					if ($arRes["PROPERTY_FOR_US_U_VALUE"])
						$kto_text[] = "пользователи";
					echo implode(", ", $kto_text);
					echo "</p>";
				}
				if ($arRes["DETAIL_TEXT"])
				{
		?>
		<p>
			<img id="img<?=$arItem["ID"];?>" width="11" height="11" onclick="plusminus('img<?=$arItem["ID"];?>', 'seminars<?=$arItem["ID"];?>');" alt="" src="/images/e-learning/plus.png"><a class="seminars-plan-link" onclick="plusminus('img<?=$arItem["ID"];?>', 'seminars<?=$arItem["ID"];?>');" href="javascript:void(0);">План семинара</a>
		</p>
		<div id="seminars<?=$arItem["ID"];?>" class="seminars-plan" style="display: none;">
			<?=$arRes["DETAIL_TEXT"];?>
		</div>
<?
				}
?>
	</div>
	<!--<div class="seminar_note_block">
	</div>-->
</div>
</div>
<?
				}elseif($arItem["PROPERTIES"]["SEMINARS_COMBINED"]["VALUE"] != NULL){

?>
<div class="block_sem <?=$seminar_class;?>" id="<?=$seminar_id;?>_id<?=$arItem["ID"];?>">
	<div class="name" <?=$seminarName[1];?>><?=$seminarName[0];?></div>
<div class="seminar_info_block event-info">
	<a name="<?=$arItem["ID"];?>"></a>
	<div class="seminar_about_block">
		<p><strong>
		<?
				if ($sData == $eData)
				{
					echo $sData . ' ' . $sTime . ' - ' . $eTime;
				}
				else
				{
					echo $sData . ' ' . $sTime . ' - ' . $eData . ' ' . $eTime;
				}
		 ?>
		</strong><br />
		(время <?=$arRes["PROPERTY_TIME_VALUE"];?>)
		</p>
	</div>
	<div class="seminar_content_block">
		<span class="head_p"><?=str_ireplace("#kto#", $tema, $arRes["PROPERTY_TOPIC_VALUE"]);?></span>
<?
				if ($arRes["PREVIEW_TEXT"])
				{
					$arPreview = explode("###", $arRes["PREVIEW_TEXT"]);
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
						$preview = $arRes["PREVIEW_TEXT"];
					echo $preview;
				}
				if (stripos($_SERVER['REQUEST_URI'], '/polzovateley/')=== false && stripos($_SERVER['REQUEST_URI'], '/installyatorov/')=== false)
				{
					echo "<p>Для кого проводится: ";
					if ($arRes["PROPERTY_FOR_US_P_VALUE"])
						$kto_text[] = "инсталляторы";
					if ($arRes["PROPERTY_FOR_US_U_VALUE"])
						$kto_text[] = "пользователи";
					echo implode(", ", $kto_text);
					echo "</p>";
				}
				if ($arRes["DETAIL_TEXT"])
				{
		?>
		<p>
			<img id="img<?=$arItem["ID"];?>" width="11" height="11" onclick="plusminus('img<?=$arItem["ID"];?>', 'seminars<?=$arItem["ID"];?>');" alt="" src="/images/e-learning/plus.png"><a class="seminars-plan-link" onclick="plusminus('img<?=$arItem["ID"];?>', 'seminars<?=$arItem["ID"];?>');" href="javascript:void(0);">План семинара</a>
		</p>
		<div id="seminars<?=$arItem["ID"];?>" class="seminars-plan" style="display: none;">
			<?=$arRes["DETAIL_TEXT"];?>
		</div>
<?
				}
?>
	</div>
	<!--<div class="seminar_note_block">
	</div>-->
</div>
<?
	foreach ($arItem["PROPERTIES"]["SEMINARS_COMBINED"]["VALUE"] as $value) {
		?>
		<div class="seminar_info_block" style="border: none">
			
			<? 
				foreach($arResult["ITEMS"] as $arItem)
				{	
					if ($arItem["ID"] == $value){
						if (!$arItem["PROPERTIES"]["SEMINAR"]["VALUE"])
							continue;
						$arFilter = array("IBLOCK_CODE"=>"list_seminars", "ID"=>$arItem["PROPERTIES"]["SEMINAR"]["VALUE"]);
						$arSelect = array("ID", "IBLOCK_ID", "NAME", "PREVIEW_TEXT", "DETAIL_TEXT", "PROPERTY_TIME", "PROPERTY_DURATION", "PROPERTY_TOPIC", "PROPERTY_CITY", "PROPERTY_FOR_US_P", "PROPERTY_FOR_US_U", "PROPERTY_TYPE_SEMINAR");
						$res = CIBlockElement::GetList(array(), $arFilter, false, false, $arSelect);
						$arRes = $res->Fetch();
						if (!$arRes["PROPERTY_FOR_US_".$kto_let."_VALUE"])
							continue;
						$datetime = $arItem["DATE_ACTIVE_TO"];
						$format = "DD.MM.YYYY HH:MI";
						$arr = ParseDateTime($datetime, $format);
										if ($arr["MM"] == $parMonth["month"] && $arr["YYYY"] == $parMonth["year"])
						{
							switch ($arr["MM"])
							{
								case "01": $arr["MM"]="Января"; break;
								case "02": $arr["MM"]="Февраля"; break;
								case "03": $arr["MM"]="Марта"; break;
								case "04": $arr["MM"]="Апреля"; break;
								case "05": $arr["MM"]="Мая"; break;
								case "06": $arr["MM"]="Июня"; break;
								case "07": $arr["MM"]="Июля"; break;
								case "08": $arr["MM"]="Августа"; break;
								case "09": $arr["MM"]="Сентября"; break;
								case "10": $arr["MM"]="Октября"; break;
								case "11": $arr["MM"]="Ноября"; break;
								case "12": $arr["MM"]="Декабря"; break;
							}
							$sData = $arr["DD"] . ' ' . $arr["MM"];
							$sTime = $arr["HH"] . ':' . $arr["MI"];

							$date_end_tmp = strtotime($arItem["DATE_ACTIVE_TO"]);
							$datetime = mktime(date("H", $date_end_tmp), date("i", $date_end_tmp)+$arRes["PROPERTY_DURATION_VALUE"], 0, date("m", $date_end_tmp), date("d", $date_end_tmp), date("Y",$date_end_tmp));
							$datetime = date("d.m.Y H:i:s", $datetime);
							$format = "DD.MM.YYYY HH:MI";
							$arr = ParseDateTime($datetime, $format);
							switch ($arr["MM"])
							{
								case "01": $arr["MM"] = "Января"; break;
								case "02": $arr["MM"] = "Февраля"; break;
								case "03": $arr["MM"] = "Марта"; break;
								case "04": $arr["MM"] = "Апреля"; break;
								case "05": $arr["MM"] = "Мая"; break;
								case "06": $arr["MM"] = "Июня"; break;
								case "07": $arr["MM"] = "Июля"; break;
								case "08": $arr["MM"] = "Августа"; break;
								case "09": $arr["MM"] = "Сентября"; break;
								case "10": $arr["MM"] = "Октября"; break;
								case "11": $arr["MM"] = "Ноября"; break;
								case "12": $arr["MM"] = "Декабря"; break;
							}
							$eData = $arr["DD"] . ' ' . $arr["MM"];
							$eTime = $arr["HH"] . ':' . $arr["MI"];
										?>





<div class="seminar_info_block" id="<?=$seminar_id;?>_id<?=$arItem["ID"];?>" style="border: none">
	<a name="<?=$arItem["ID"];?>"></a>
	<div class="seminar_about_block">
		<p><strong>
		<?
				if ($sData == $eData)
				{
					echo $sData . ' ' . $sTime . ' - ' . $eTime;
				}
				else
				{
					echo $sData . ' ' . $sTime . ' - ' . $eData . ' ' . $eTime;
				}
		 ?>
		</strong><br />
		(время <?=$arRes["PROPERTY_TIME_VALUE"];?>)
		</p>
	</div>
	<div class="seminar_content_block">
		<span class="head_p"><?=str_ireplace("#kto#", $tema, $arRes["PROPERTY_TOPIC_VALUE"]);?></span>
<?
				if ($arRes["PREVIEW_TEXT"])
				{
					$arPreview = explode("###", $arRes["PREVIEW_TEXT"]);
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
						$preview = $arRes["PREVIEW_TEXT"];
					echo $preview;
				}
				if (stripos($_SERVER['REQUEST_URI'], '/polzovateley/')=== false && stripos($_SERVER['REQUEST_URI'], '/installyatorov/')=== false)
				{
					echo "<p>Для кого проводится: ";
					if ($arRes["PROPERTY_FOR_US_P_VALUE"])
						$kto_text[] = "инсталляторы";
					if ($arRes["PROPERTY_FOR_US_U_VALUE"])
						$kto_text[] = "пользователи";
					echo implode(", ", $kto_text);
					echo "</p>";
				}
				if ($arRes["DETAIL_TEXT"])
				{
		?>
		<p>
			<img id="img<?=$arItem["ID"];?>" width="11" height="11" onclick="plusminus('img<?=$arItem["ID"];?>', 'seminars<?=$arItem["ID"];?>');" alt="" src="/images/e-learning/plus.png"><a class="seminars-plan-link" onclick="plusminus('img<?=$arItem["ID"];?>', 'seminars<?=$arItem["ID"];?>');" href="javascript:void(0);">План семинара</a>
		</p>
		<div id="seminars<?=$arItem["ID"];?>" class="seminars-plan" style="display: none;">
			<?=$arRes["DETAIL_TEXT"];?>
		</div>
<?
				}
?>
	</div>
</div>















					<?}
					}
				}
			?>
		</div>
		<?
	}
?>
<p><a href="<?=$reg_link[1];?>"><?=$reg_link[0];?></a><?=$reg_link[2];?></p>
</div>
<?



				}
			}
		}
	}
}
?>
</div>