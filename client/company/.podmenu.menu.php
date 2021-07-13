<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>
<?
$aMenuLinks = array(
	Array(
		"Профиль компании", 
		"/client/company/", 
		Array(), 
		Array("INFOIMG"=>"manufacturing-plant-perco.jpg"), 
		"CSite::InGroup(array(1,32))" 
	),
);
$arGroups = CUser::GetUserGroup($USER->GetID());
if (in_array(32,$arGroups) || in_array(1,$arGroups))
{
	$rsUser = CUser::GetByID($USER->GetID());
	$arUser = $rsUser->Fetch();
	if (!in_array(21, $arUser["UF_TIP_SERT"]))
	{
		$aMenuLinks[] = Array(
			"Этапы получения статуса партнера", 
			"/client/company/status/",
			Array(), 
			Array("INFOIMG"=>"manufacturing-plant-perco.jpg"), 
			"CSite::InGroup(array(1,32))" 
		);
		$zayavka_name = "Заявка на получение статуса партнера";
	}
	else
		$zayavka_name = "Заявка на подтверждение квалификации сотрудника";
}
array_push($aMenuLinks,
	Array(
		$zayavka_name, 
		"/client/company/sertifikaciya/", 
		Array(), 
		Array("INFOIMG"=>"manufacturing-plant-perco.jpg"), 
		"CSite::InGroup(array(1,32))" 
	),
	Array(
		"Заявка на очное обучение", 
		"/client/company/zayavka/", 
		Array(), 
		Array("INFOIMG"=>"manufacturing-plant-perco.jpg"), 
		"CSite::InGroup(array(1,32))" 
	),
	/* Array(
		"Вебинары", 
		"/client/company/vebinars/", 
		Array(), 
		Array("INFOIMG"=>"manufacturing-plant-perco.jpg"), 
		"CSite::InGroup(array(1,32))" 
	), */
	Array(
		"Заявка на рекламную продукцию", 
		"/client/company/reklama/", 
		Array(), 
		Array("INFOIMG"=>"manufacturing-plant-perco.jpg"), 
		"CSite::InGroup(array(1,32))" 
	)
);
if ($arUser["UF_SC"])
{
	$sc = "SC";
	$aMenuLinks[] = Array(
		"Поддержка сервисных центров", 
		"/client/company/service-center/", 
		Array(), 
		Array("INFOIMG"=>"manufacturing-plant-perco.jpg", "COMPANY" => $sc), 
		"CSite::InGroup(array(1,32))" 
	);
}
/*array_push($aMenuLinks,
	Array(
		"Форум", 
		"/forum/", 
	)
);*/
?>