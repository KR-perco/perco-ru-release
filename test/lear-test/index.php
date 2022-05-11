<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
/*if (CModule::IncludeModule("learning")) {
	$arUsers = CGroup::GetGroupUser(10); //выбираем всех пользователей из группы "студенты"
	for($cnt=0; $cnt < count($arUsers); $cnt++) {
		$ID = $arUsers[$cnt];
		$rsUser= CUser::GetByID($ID);
		$arUser = $rsUser->Fetch();
		$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		$endSertDateMonthlyTest = mktime(0, 0, 0, 2, 24, 2021);
		echo 'ID: ' . $ID . '<br>';
		echo 'UF_SERT_D: ' . $arUser["UF_SERT_D"] . '<br>';
		echo 'UF_SERT_DATE: ' . $arUser["UF_SERT_DATE"] . '<br>';
		echo '$today: ' . $today . ' (' . date('Y-m-d H:i:s', $today) . ')<br>';
		echo '$endSertDate: ' . $endSertDate . ' (' . date('Y-m-d H:i:s', $endSertDate) . ')<br>';
		echo '$endSertDate <= $today: ' . var_export($endSertDate <= $today, true) . '<br>';
		echo '$endSertDateMonthly: ' . $endSertDateMonthlyTest . ' (' . date('Y-m-d H:i:s', $endSertDateMonthlyTest) . ')<br>';
		echo '$endSertDateMonthlyTest == $today: ' . var_export($endSertDateMonthlyTest == $today, true) . '<br>';
		echo '<hr>';
	}
} else {
	echo 'Модуль обучения не подключен.';
}*/

/*
if (CModule::IncludeModule("learning")) {
	$arUsers = CGroup::GetGroupUser(10); //выбираем всех пользователей из группы "студенты"
	for($cnt=0; $cnt < count($arUsers); $cnt++) {
		$ID = $arUsers[$cnt];
		$rsUser= CUser::GetByID($ID);
		$arUser = $rsUser->Fetch();
		$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		$endSertDateMonthlyTest = mktime(0, 0, 0, 2, 24, 2021);
		echo 'ID: ' . $ID . '<br>';
		echo 'UF_SERT_D: ' . $arUser["UF_SERT_D"] . '<br>';
		echo 'UF_SERT_DATE: ' . $arUser["UF_SERT_DATE"] . '<br>';
		echo '$today: ' . $today . ' (' . date('Y-m-d H:i:s', $today) . ')<br>';
		echo '$endSertDate: ' . $endSertDate . ' (' . date('Y-m-d H:i:s', $endSertDate) . ')<br>';
		echo '$endSertDate <= $today: ' . var_export($endSertDate <= $today, true) . '<br>';
		echo '$endSertDateMonthly: ' . $endSertDateMonthlyTest . ' (' . date('Y-m-d H:i:s', $endSertDateMonthlyTest) . ')<br>';
		echo '$endSertDateMonthlyTest == $today: ' . var_export($endSertDateMonthlyTest == $today, true) . '<br>';
		echo '<hr>';
	}
} else {
	echo 'Модуль обучения не подключен.';
}
*/
/*if (CModule::IncludeModule("learning")) { вывод компаний
	$filter = [
		"ACTIVE" => "Y",
		"GROUPS_ID" => 32
	];
	$select = [
		"SELECT" => array("UF_SERT_D", "UF_SERT_DATE", "UF_SERT_TP", "UF_SERT_DATE_TP", "UF_SERT_SC", "UF_SERT_DATE_SC", "UF_PAI", "UF_PTP", "UF_SC", "UF_PAS", "UF_TIP_SERT")
	];
	$rsCompany = CUser::GetList(($by="id"), ($order="asc"), $filter, $select); // выбираем компании
	while($arCompany = $rsCompany->Fetch()) {
		var_dump($arCompany['NAME']);
		echo '<hr>';
	}
} else {
	echo 'Модуль обучения не подключен.';
}*/
/*if (CModule::IncludeModule("learning")) { //показываем кому отправляются письма сегодня
	$arUsers = CGroup::GetGroupUser(10); //выбираем всех пользователей из группы "студенты"
	for($cnt=0; $cnt < count($arUsers); $cnt++) {
		$ID = $arUsers[$cnt];
		$rsUser = CUser::GetByID($ID);
		$arUser = $rsUser->Fetch();
		$today =  mktime(0, 0, 0, date("m"), date("d"), date("Y"));
		echo 'ID: ' . $ID . '<br>';
		// Блок АИ
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_D"] && $endSertDate <= $today) {
			echo 'блок аи<br>';
		}
		// Блок СТП
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE_TP"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_TP"] && $endSertDate <= $today) {
			echo 'блок стп<br>';
		}
		// Блок СЦ
		//******************************************************
		$getSertDate = strtotime($arUser["UF_SERT_DATE_SC"]);
		$endSertDate = mktime(0, 0, 0, date("m", $getSertDate), date("d", $getSertDate), date("Y", $getSertDate)+1);
		if ($arUser["UF_SERT_SC"] && $endSertDate <= $today) {
			echo 'блок сц<br>';
		}
		echo '<hr>';
	}
} else {
	echo 'learning not include';
}*/
?>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>