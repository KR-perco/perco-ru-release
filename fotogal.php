<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
/*if (CModule::IncludeModule('iblock')) {
	function getCaptionByLang ($values, $langs, $lang) {
		$key = array_search($lang, $langs);
		if ($key === false) {
			return '';
		}
		return $values[$key];
	}
	$rsDb = CIBlockElement::GetList(
		['ID' => 'DESC'],
		['ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => '1777'],
		false,
		false,
		['ID', 'IBLOCK_ID', 'NAME']
	);
	echo '<table>';
	echo '<tr><th rowspan="2">Тип объекта</th><th colspan="6">Подпись</th></tr>';
	echo '<tr><th>ru</th><th>en</th><th>de</th><th>fr</th><th>it</th><th>es</th></tr>';
	$i = 0;
	while ($foto = $rsDb->GetNextElement()) {
		$fields = $foto->GetFields();
		$props = $foto->GetProperties();
		if (empty($props['TYPE_OBJECT']['VALUE'])) continue;
		echo '<tr>';
		//echo '<td>' . $fields['ID'] . '</td>';
		echo '<td>' . $props['TYPE_OBJECT']['VALUE'] . '</td>';
		echo '<td>' . getCaptionByLang($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'ru') . '</td>';
		echo '<td>' . getCaptionByLang($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'en') . '</td>';
		echo '<td>' . getCaptionByLang($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'de') . '</td>';
		echo '<td>' . getCaptionByLang($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'fr') . '</td>';
		echo '<td>' . getCaptionByLang($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'it') . '</td>';
		echo '<td>' . getCaptionByLang($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'es') . '</td>';
		echo '</tr>';
		$i++;
	}
	echo '</table>';
	echo 'всего фотографий: ' . $i;
} else {
	echo 'Ошибка подключения модуля';
}*/
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>