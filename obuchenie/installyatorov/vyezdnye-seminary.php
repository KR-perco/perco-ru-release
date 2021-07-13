<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Выездные семинары", "");
$APPLICATION->SetPageProperty("title", "Выездные семинары по системам и оборудованию безопасности PERCo");
$APPLICATION->SetPageProperty("description", "Цель семинара – познакомить с системой безопасности PERCo-S-20, потребительскими свойствами, техническими возможностями оборудования и ПО");
$APPLICATION->SetPageProperty("keywords", "семинары безопасности, обучающие системам безопасности, выездные семинары");
$APPLICATION->SetTitle("Выездные семинары");
?>

<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Специалисты Учебного центра PERCo проводят на постоянной основе выездные семинары для региональных партнеров.</p>
<?
$iblocks = GetIBlockList("edu", "seminars");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:news.list", "seminariviezd", Array(
	"IBLOCK_TYPE" => "edu",	// Тип информационного блока (используется только для проверки)
	"IBLOCK_ID" => $block_id,	// Код информационного блока
	"NEWS_COUNT" => "20",	// Количество новостей на странице
	"SORT_BY1" => "DATE_ACTIVE_TO",	// Поле для первой сортировки новостей
	"SORT_ORDER1" => "ASC",	// Направление для первой сортировки новостей
	"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
	"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
	"FILTER_NAME" => "",	// Фильтр
	"FIELD_CODE" => array(	// Поля
		0 => "",
		1 => "",
	),
	"PROPERTY_CODE" => array(	// Свойства
		0 => "DATE_END",
		1 => "TIME",
		2 => "DURATION",
		3 => "TEMA",
		4 => "CITY",
		5 => "TEMA_LINK",
		6 => "LINK",
		7 => "RESOURCE",
		8 => "FOR_US",
		9 => "KTO",
		10 => "NUMDAY",
		11 => "LINK_COMDY",
		12 => "TYPE",
	),
	"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
	"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
	"AJAX_MODE" => "N",	// Включить режим AJAX
	"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
	"AJAX_OPTION_STYLE" => "Y",	// Включить подгрузку стилей
	"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
	"CACHE_TYPE" => "A",	// Тип кеширования
	"CACHE_TIME" => "43200",	// Время кеширования (сек.)
	"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
	"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
	"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
	"SET_TITLE" => "N",	// Устанавливать заголовок страницы
	"SET_STATUS_404" => "Y",	// Устанавливать статус 404, если не найдены элемент или раздел
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
	"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
	"PARENT_SECTION" => "1531",	// ID раздела
	"PARENT_SECTION_CODE" => "",	// Код раздела
	"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
	"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
	"PAGER_TITLE" => "Новости",	// Название категорий
	"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
	"PAGER_TEMPLATE" => "",	// Название шаблона
	"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
	"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
	"DISPLAY_DATE" => "Y",	// Выводить дату элемента
	"DISPLAY_NAME" => "Y",	// Выводить название элемента
	"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
	"DISPLAY_PREVIEW_TEXT" => "Y",	// Выводить текст анонса
	"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
	),
	false
);?>
	<h2>Программа семинара &laquo;Системы безопасности PERCo&raquo;</h2>
	<p>Продолжительность: 5 часов</p>
	<p>Цель семинара &ndash; познакомить слушателей с принципами построения систем безопасности PERCo, потребительскими свойствами, техническими возможностями и характеристиками аппаратуры и программного обеспечения для дальнейшего продвижения продукции компании PERCo в своем регионе, проинформировать об условиях сотрудничества с PERCo.</p>
	<table>
		<thead>
			<tr>
				<th>Тема</th>
				<th>Продолжительность</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><strong>Вступительная часть</strong></td>
				<td>5 минут.</td>
			</tr>
			<tr>
				<td><strong>Информация о PERCo </strong></td>
				<td>10 минут</td>
			</tr>
			<tr>
				<td><strong>Особенности и преимущества построения систем безопасности на основе оборудования PERCo</strong></td>
				<td>20 минут</td>
			</tr>
			<tr>
				<td><strong>Что дает система (функционал)</strong></td>
				<td rowspan="3">30 минут</td>
			</tr>
			<tr>
				<td style="padding-left:25px">
					Безопасность
				</td>
			</tr>
			<tr>
				<td style="padding-left:25px">
					Повышение эффективности
				</td>
			</tr>
			<tr>
				<td>Перерыв</td>
				<td>10 минут</td>
			</tr>
			<tr>
				<td><strong>Состав оборудования</strong> (контроллеры, считыватели, картоприемники, приемно-контрольные панели)</td>
				<td>50 минут</td>
			</tr>
			<tr>
				<td>Перерыв</td>
				<td>10 минут</td>
			</tr>
			<tr>
				<td><strong>Состав оборудования</strong> (электронные проходные, турникеты, замки)</td>
				<td>50 минут</td>
			</tr>
			<tr>
				<td>Кофе-брейк</td>
				<td>20 минут</td>
			</tr>
			<tr>
				<td><strong>Возможности программного комплекса PERCo-Web</strong></td>
				<td rowspan="5">50 минут</td>
			</tr>
			<tr>
				<td style="padding-left:25px">
				  Безопасность объекта
				</td>
			</tr>
			<tr>
				<td style="padding-left:25px">
				  Повышение эффективности предприятия
				</td>
			</tr>
			<tr>
				<td style="padding-left:25px">
				  Автоматизированный учет рабочего времени
				</td>
			</tr>
			<tr>
				<td style="padding-left:25px">
				  Экономическая эффективность (окупаемость) системы безопасности
				</td>
			</tr>
			<tr>
				<td><strong>Преимущества выбора систем безопасности на IP-технологиях</strong></td>
				<td>20 минут</td>
			</tr>
			<tr>
				<td>Перерыв</td>
				<td>10 минут</td>
			</tr>
			<tr>
				<td><strong>Обсуждение вопросов сотрудничества и совместного продвижения на региональном рынке</strong></td>
				<td>30 минут</td>
			</tr>
			<tr>
				<td>Ответы на вопросы</td>
				<td>10 минут</td>
			</tr>
		</tbody>
	</table>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
