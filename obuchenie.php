<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (!$USER->IsAdmin()) {
	CHTTP::SetStatus('404 Not Found');
	@define('ERROR_404', 'Y');
}
if (CModule::IncludeModule('learning')) {
	$filter = [
		"ACTIVE" => "Y",
		"WORK_COMPANY" => $USER->GetID(),
		"WORK_COMPANY_EXACT_MATCH" => "Y"
	];
	$rsUsers = CUser::GetList(($by="id"), ($order="desc"), $filter); // выбираем всех пользователей нашей компании
	if (intval($rsUsers->SelectedRowsCount()) == 0)
		echo '<p style="color: red;">Для оформления заявки вы должны <a href="/client/company/">добавить сотрудников</a>.</p>';
	while($arUser = $rsUsers->Fetch()) {
		echo $arUser['ID'] . '<br>';
		//echo '<pre>'; var_dump($arUser); echo '</pre>';
	}
} else {
	echo 'Модуль не удалось подключить.';
}
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>