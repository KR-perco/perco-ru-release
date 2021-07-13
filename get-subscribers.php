<?php
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if (!$USER->IsAdmin()) {
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
}
/*if(CModule::IncludeModule('subscribe')) {
	$letterId = 750;
	$post = CPosting::GetByID($letterId);
	if(($post_arr = $post->Fetch()))
		$aEmails = CPosting::GetEmails($post_arr);
	echo '<table>';
	$i = 0;
	foreach ($aEmails as $email) {
		$i++;
		//if ($i > 30000) continue;
		echo '<tr>';
		echo '<td>' . $i . '</td>';
		echo '<td>' . $email . '</td>';
		echo '</tr>';
		
	}
	echo '</table>';
} else {
	echo 'Модуль не подключён';
}*/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");