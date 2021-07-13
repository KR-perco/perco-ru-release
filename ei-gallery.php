<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

/*
\Bitrix\Iblock\TypeTable::getList(); // типы инфоблоков
\Bitrix\Iblock\IblockTable::getList(); // инфоблоки
\Bitrix\Iblock\PropertyTable::getList(); // свойства инфоблоков
\Bitrix\Iblock\PropertyEnumerationTable::getList(); // значения свойств, например списков
\Bitrix\Iblock\SectionTable::getList(); // Разделы инфоблоков
\Bitrix\Iblock\ElementTable::getList(); // Элементы инфоблоков 
\Bitrix\Iblock\InheritedPropertyTable::getList(); // Наследуемые свойства (seo шаблоны)
DATE_CREATE - дата создания элемента инфоблока
'ID', 'IBLOCK_ID' - лучше всегда указывать в select во избежание багов
*/

/*if (!$USER->IsAdmin()) {
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
}*/

$ibId = 18;
$sId = 1777;
$i = 0;

if (!CModule::includeModule('iblock')) {
	echo '<div style="color: red;">Ошибка подключения модуля инфоблоков.</div>';
}

function getByCountry ($value, $langs, $lang) {
	$i = array_search($lang, $langs);
	if ($i !== false) {
		return $value[$i];
	}
	return '';
}

$dbItems = CIBlockElement::GetList(
	['DATE_CREATE' => 'ASC'],
	['IBLOCK_ID' => $ibId, 'SECTION_ID' => $sId, 'ACTIVE' => 'Y'],
	false,
	false,
	['IBLOCK_ID', 'ID', 'SECTION_ID', 'NAME', 'CODE']
);

echo '<div style="font-size: 16px;">';
echo '<div style="color: darkgreen; font-size: 24px;">Всего элементов: <b>' . $dbItems->SelectedRowsCount() . '</b>.</div><br>';

echo '<table>';

while($item = $dbItems->GetNextElement()) {
	$i++;
	
	$fields = $item->GetFields();
	$props = $item->GetProperties();
	
	/*echo '<div style="color: grey;">' . $i . '. id: <b>' . $fields['ID'] . '</b>.</div>';
	echo '<div>Название (NAME): <b>' . $fields['NAME'] . '</b>.</div>';
	echo '<div>Код (CODE): <b>' . $fields['CODE'] . '</b>.</div>';
	echo '<div>Страна (COUNTRY): <b>' . $props['COUNTRY']['VALUE'] . '</b>.</div>';*/
	echo '<tr>';
	echo '<td>RU</td>';
	echo '<td>' . getByCountry($props['SCROLL_OPIS']['VALUE'], $props['SCROLL_OPIS']['DESCRIPTION'], 'ru') . '</td>';
	echo '</tr><tr>';
	echo '<td>EN</td>';
	echo '<td>' . getByCountry($props['SCROLL_OPIS']['VALUE'], $props['SCROLL_OPIS']['DESCRIPTION'], 'en') . '</td>';
	echo '</tr><tr>';
	echo '<td>DE</td>';
	echo '<td>' . getByCountry($props['SCROLL_OPIS']['VALUE'], $props['SCROLL_OPIS']['DESCRIPTION'], 'de') . '</td>';
	echo '</tr><tr>';
	echo '<td>FR</td>';
	echo '<td>' . getByCountry($props['SCROLL_OPIS']['VALUE'], $props['SCROLL_OPIS']['DESCRIPTION'], 'fr') . '</td>';
	echo '</tr><tr>';
	echo '<td>IT</td>';
	echo '<td>' . getByCountry($props['SCROLL_OPIS']['VALUE'], $props['SCROLL_OPIS']['DESCRIPTION'], 'it') . '</td>';
	echo '</tr><tr>';
	echo '<td>ES</td>';
	echo '<td>' . getByCountry($props['SCROLL_OPIS']['VALUE'], $props['SCROLL_OPIS']['DESCRIPTION'], 'es') . '</td>';
	echo '</tr>';
	echo '<tr><td></td><td></td></tr>';
	echo '<td>RU</td>';
	echo '<td>' . getByCountry($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'ru') . '</td>';
	echo '</tr><tr>';
	echo '<td>EN</td>';
	echo '<td>' . getByCountry($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'en') . '</td>';
	echo '</tr><tr>';
	echo '<td>DE</td>';
	echo '<td>' . getByCountry($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'de') . '</td>';
	echo '</tr><tr>';
	echo '<td>FR</td>';
	echo '<td>' . getByCountry($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'fr') . '</td>';
	echo '</tr><tr>';
	echo '<td>IT</td>';
	echo '<td>' . getByCountry($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'it') . '</td>';
	echo '</tr><tr>';
	echo '<td>ES</td>';
	echo '<td>' . getByCountry($props['FULL_OPIS']['VALUE'], $props['FULL_OPIS']['DESCRIPTION'], 'es') . '</td>';
	echo '</tr>';
	echo '<tr><td></td><td></td></tr><tr><td></td><td></td></tr>';
}

echo '</table>';

echo '</div>';

require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");