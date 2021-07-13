<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (!$USER->IsAdmin()) {
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
}

if (!CModule::IncludeModule("learning")) {
	echo '<div style="color: red;">Ошибка подключения модуля обучения.</div>';
}
$arPraktikTest = [4, 5];
$accumulator = 0;
$i = 0;

//$res = CTestAttempt::GetByID(20009);
$res = CTestAttempt::GetList(
	['ID' => 'ASC'],
	['<DATE_END' => '01.01.2018']
	//['COMPLETED' => 'N']
);

echo '<div>Не пройденные тесты:</div><br>';

while ($arAttempt = $res->GetNext()) {
	$ATTEMPT_ID = $arAttempt["ID"];
	$resitem = CTestResult::GetList(
		Array("CORRECT" => "DECS"),
		Array("ATTEMPT_ID" => $ATTEMPT_ID)
	);
	if (in_array($arAttempt["TEST_ID"], $arPraktikTest)) {
		while ($arQuestionPlan = $resitem->GetNext()) {
			//echo html_entity_decode($arQuestionPlan['RESPONSE']);
			$rsFileBD = CFile::GetFileArray(GetUserField("LEARN_ATTEMPT", $arQuestionPlan["ATTEMPT_ID"], "UF_DB_ADD"));
			if (!empty($rsFileBD['SUBDIR']) || !empty($rsFileBD['FILE_NAME'])) {
				$size = filesize('/home/d/dc178435/public_html/upload/'.$rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME']) / 1024 / 1024;
				if ($size != 0) {
					/*if (unlink('/home/d/dc178435/public_html/upload/' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'])) {
						$fileDelete = '<span style="color: green;">Был успешно удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
					} else {
						$fileDelete = '<span style="color: red;">Возникла ошибка при удалении файла: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
					} - не раскоменчивай */
					$qury = CTest::GetByID($arAttempt["TEST_ID"]);	// получаем данные по тесту
					$arTest = $qury->Fetch();
					switch($status = $arAttempt["STATUS"])
					{
					case "F":
						if ($arTest["APPROVED"] == "N")	// смотрим у теста автопроверку
						{
							if (GetUserField("LEARN_ATTEMPT", $arAttempt["ID"], "UF_CORANS") == 1)	// смотрим флаг того сдан тест или нет - после проверки преподавателем
							{
								$i++;
								$accumulator += (float) $size;
								/*if (unlink('/home/d/dc178435/public_html/upload/' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'])) {
									$fileDelete = '<span style="color: green;">Был успешно удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
								} else {
									$fileDelete = '<span style="color: red;">Возникла ошибка при удалении файла: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
								}*/
								$fileDelete = '<span style="color: green;">Будет удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
							}
							else
							{
								//$i++;
								//$accumulator += (float) $size;
								//$fileDelete = '<span style="color: green;">Будет удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
								$fileDelete = '<span style="color: red;">Тест ещё на проверке.</span>';
							}
						}
						else
						{
							$i++;
							$accumulator += (float) $size;
							/*if (unlink('/home/d/dc178435/public_html/upload/' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'])) {
								$fileDelete = '<span style="color: green;">Был успешно удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
							} else {
								$fileDelete = '<span style="color: red;">Возникла ошибка при удалении файла: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
							}*/
							$fileDelete = '<span style="color: green;">Будет удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
						}
						break;
					case "B":
						$i++;
						$accumulator += (float) $size;
						/*if (unlink('/home/d/dc178435/public_html/upload/' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'])) {
							$fileDelete = '<span style="color: green;">Был успешно удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
						} else {
							$fileDelete = '<span style="color: red;">Возникла ошибка при удалении файла: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
						}*/
						$fileDelete = '<span style="color: green;">Будет удалён файл: ' . $rsFileBD['SUBDIR'].'/'.$rsFileBD['FILE_NAME'] . '</span>';
						break;
					}
				} else {
					$fileDelete = '<span style="color: grey;">Файл не найден.</span>';
				}
			} else {
				$fileDelete = '<span style="color: grey;">Нет загруженного файла.</span>';
			}
			echo '<div><span style="color: black;">ID попытки <b>' . $arAttempt['ID'] . '</b><br>Дата окончания попытки: <b>' . $arAttempt['DATE_END'] . '</b><br>Студент: <b>' . $arAttempt['USER_NAME'] . '</b><br>Название теста: <b>' . $arAttempt['TEST_NAME'] . '</b></span><br>' . $fileDelete . '</div><br>';

		}
	} else {
		echo '<div style="display: none; color: red;">Не практический тест.</div>';
	}
}
echo '<div style="font-size: 32px; color: green;">Будет удалено: <b>' . $accumulator / 1024 . ' гб</b></div>';
echo '<div style="font-size: 32px; color: green;">Будет удалено: <b>' . $i . ' файлов</b></div>';
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");