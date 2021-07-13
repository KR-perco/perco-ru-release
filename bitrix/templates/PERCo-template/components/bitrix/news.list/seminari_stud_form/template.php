<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<? 
$rsSeminar = CIBlockElement::GetList(array(), array("ACTIVE"=>"Y", "ACTIVE_DATE" =>"Y", "IBLOCK_ID" => 53), false, false, array());
$arSeminar = $rsSeminar->Fetch();

if ((!empty($arResult["ITEMS"])) || (!empty($arSeminar)))
//if (!empty($arResult["ITEMS"]))
{
	$rsCompany = CUser::GetByID($USER->GetID());
	$arCompany = $rsCompany->Fetch();
	$first = false;
	$speclAll .= '<div class="program" id="program">Заявка на обучение по программе <select id="seminars" name="seminars"><option value="0" selected="selected">Не выбрано</option><option value="1">Для руководителей</option>';
	if (in_array(21, $arCompany["UF_TIP_SERT"]))
	{
		$kto = "администраторов";
		$speclAll .= '<option value="2">Для пользователей</option>';
	}
	else
		$kto = "инсталляторов";
	$speclAll .= '<option value="3">Для '.$kto.'</option>';
	if ($arCompany["UF_SC"])
		$speclAll .= '<option value="4">Для сервисных инженеров</option>';
	$speclAll .= '</select></div>';
	foreach($arResult["ITEMS"] as $arItem)
	{
		$rsSeminar = CIBlockElement::GetList(array(), array("ID" => $arItem["PROPERTIES"]["SEMINAR"]["VALUE"], "IBLOCK_ID" => 62), false, false, array("ID", "PROPERTY_TOPIC"));
		$arSeminar = $rsSeminar->Fetch();
		if (in_array(21, $arCompany["UF_TIP_SERT"]))
			$arSeminar["PROPERTY_TOPIC_VALUE"] = str_ireplace("#kto#", "администратор", $arSeminar["PROPERTY_TOPIC_VALUE"]);
		else
			$arSeminar["PROPERTY_TOPIC_VALUE"] = str_ireplace("#kto#", "инсталлятор", $arSeminar["PROPERTY_TOPIC_VALUE"]);
		switch($arSeminar["PROPERTY_TOPIC_VALUE"])
		{
			case "Обзор систем и оборудования PERCo":	// 1 день
				$first = true;
				$arValues[0] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				$arSemainars[] = '<p class="obzor"><label><input type="checkbox" name="LIST_DATE" value="'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'-'.$arSeminar["PROPERTY_TOPIC_VALUE"].'">'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'</label></p>';
				break;
			case "Практические навыки по работе в системах PERCo":	// 2 день
				$arValues[1] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				break;
			case "Получение практических навыков в работе с системой PERCo-Web.":	// 3 день
				$arValues[2] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				$arSemainars[] = '<p class="praktika"><label><input type="checkbox" name="LIST_DATE" value="'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'-'.$arSeminar["PROPERTY_TOPIC_VALUE"].'">'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'</label></p>';
				break;
			case "Сертификация «Авторизованный ".$kto."":	// 1 день
				$arValues[3] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				$arSemainars[] = '<p class="obzor"><label><input type="checkbox" name="LIST_DATE" value="'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'-'.$arSeminar["PROPERTY_TOPIC_VALUE"].'">'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'</label></p>';
				break;
			case "Обзор систем и оборудования PERCo Санкт-Петербург":	// 1 день
				$arValues[4] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				$arSemainars[] = '<p class="obzor"><label><input type="checkbox" name="LIST_DATE" value="'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'-'.$arSeminar["PROPERTY_TOPIC_VALUE"].'">'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'</label></p>';
				break;
			case "Получение практических навыков в работе с системой PERCo-Web СПб":	// 2 день
				$arValues[5] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				break;
			case "Сертификация «Авторизованный ".$kto." Санкт Петербург":	// 3 день
				$arValues[6] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
				$arSemainars[] = '<p class="praktika"><label><input type="checkbox" name="LIST_DATE" value="'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'-'.$arSeminar["PROPERTY_TOPIC_VALUE"].'">'.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'</label></p>';
				break;
			default:
				if ($first)
				{
					$first = false;
					$temp_date = strtotime($arItem["ACTIVE_TO"]);
					$datetime = mktime(0, 0, 0, date("m", $temp_date), date("d", $temp_date)-3, date("Y", $temp_date));
					$arValues[3] = date("d.m.Y", strtotime($arItem["ACTIVE_TO"])) . '-' . $arSeminar["PROPERTY_TOPIC_VALUE"];
					$arSemainars[] = '<p class="allsem"><label><input type="checkbox" name="LIST_DATE" value="'.implode("|", $arValues).'">'.date("d.m.Y", $datetime).' - '.date("d.m.Y", strtotime($arItem["ACTIVE_TO"])).'</label></p>';
				}
				break;
		}
	}
	if ($arCompany["UF_SC"])
	{
		$rsSC = CIBlockElement::GetList(
			array("date_active_to" => "asc"), 
			array(
			"ACTIVE" => "Y",
			"IBLOCK_ID" => 53,
			"ACTIVE_DATE" => "Y"
			),
			false, 
			false,
			array("ID", "ACTIVE_TO", "PROPERTY_TEMA")	// перечень полей необходимых в результате выборки
		);
		while($arSC = $rsSC->GetNext())
		{
			$arSemainars[] = '<p class="service"><label><input type="checkbox" name="LIST_DATE" value="'.date("d.m.Y", strtotime($arSC["ACTIVE_TO"])).'-'.$arSC["PROPERTY_TEMA_VALUE"].'">'.date("d.m.Y", strtotime($arSC["ACTIVE_TO"])).'</label></p>';
		}
	}
	$speclAll .= '<div id="datesem">'.implode("", $arSemainars).'</div>';
	$speclAll .= '<div id="specialists"><p>Перечень зарегистрированных сотрудников </p>';
	$filter = Array
	(
		"ACTIVE" => "Y",
		"WORK_COMPANY" => $USER->GetID(),
		"WORK_COMPANY_EXACT_MATCH" => "Y"
	);
	$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем пользователей
	while($arUser = $rsUsers->Fetch())
	{
		$speclAll .= '<p><label><input type="checkbox" id="'.$arUser["ID"].'" name="LIST_SPEC" value="'.$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"].",".$arUser["ID"].'" />'.$arUser["LAST_NAME"]." ".$arUser["NAME"]." ".$arUser["SECOND_NAME"].'</label></p>';
	}
	$speclAll .= '</div>';
	if (intval($rsUsers->SelectedRowsCount()) == 0)
		$speclAll = "";
	$firstDayI = array_unique($firstDayI);
	if (!$speclAll)
		echo '<p style="color: red;">Для оформления заявки на обучение вы должны <a href="/client/company/">добавить сотрудников</a>.</p>';
}
else
	echo '<p style="color: red;">Данные временно не доступны, повторите попытку позже.</p>';
?>
<script type="text/javascript">
speclAll = '<?=$speclAll;?>';
</script>