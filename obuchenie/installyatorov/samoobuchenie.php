<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Самостоятельное обучение", "");
$APPLICATION->SetPageProperty("title", "Самостоятельное обучение");
$APPLICATION->SetPageProperty("description", "Для более эффективной эксплуатации систем и оборудования PERCo с помощью видеоинструкций можно самостоятельно ознакомиться с принципами работы");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetTitle("Самостоятельное обучение");

$APPLICATION->SetAdditionalCSS("/css/samoobuchenie.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/samoobuchenie.js"); // подключение скриптов
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Для более эффективной эксплуатации систем и оборудования PERCo мы предлагаем самостоятельно ознакомиться с принципами настройки систем безопасности и работы оборудования.</p>
	<p>На сайте в разделе «Поддержка» размещен полный комплекс информации для самостоятельного изучения системы  PERCо-S-20 и PERCo-Web, а также  турникетов и электронных проходных:</p>
	<div id="elements_list">
		<div class="element_item small-text">
			<a href="/podderzhka/dokumentatsiya.php">
				<img src="/images/icons/documents.svg">
				<p>Документация</p>
			</a>
		</div>
		<div class="element_item small-text">
			<a href="/podderzhka/video/">
				<img src="/images/icons/video-instruction.svg">
				<p>Видеоинструкции</p>
			</a>
		</div>
		<div class="element_item small-text">
			<a href="/podderzhka/programmnoe-obespechenie.php">
				<img src="/images/icons/soft.svg">
				<p>Программное обеспечение</p>
			</a>
		</div>
		<div class="element_item small-text">
			<a href="/podderzhka/katalogi-i-buklety.php">
				<img src="/images/icons/reclame.svg">
				<p>Каталоги и буклеты</p>
			</a>
		</div>
	</div>
	<p>Общее представление о продукции PERCo дают и рекламные материалы, которые  будут интересны и полезны, в первую очередь,  менеджерам по продажам. В подборке собраны каталоги, буклеты, альбомы, в которых представлена презентационная информация обо всем оборудовании, выпускаемом PERCo.</p>
	<h2>Самостоятельное изучение систем PERC<span style="text-transform:lowercase;">о</span>-S-20 и PERC<span style="text-transform:lowercase;">о</span>-Web</h2>
	<ol>
		<li>Для изучения программного обеспечения
			<ul>
				<li>Презентационные файлы описывают возможности систем. Они будут полезны руководителям, сотрудникам служб безопасности и отдела персонала:
					<p>PERCo-Web</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "prezentatsiya-vozmozhnostey-perco-web",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"PARENT_NAME" => "N"
	),
	false
);?>
					<p>PERCo-S-20</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "prezentatsiya-vozmozhnostey-perco-s-20",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"PARENT_NAME" => "N"
	),
	false
);?>
				</li>
				<li>Дистрибутив ПО PERCo-S-20, PERCo-S-20 «Школа» и PERCo-Web. Всё ПО PERCo-S-20 может работать в ознакомительном режиме в течение 30 дней, PERCo-Web - 60 дней. За это время вы можете в общих чертах ознакомиться с работой системы, узнать преимущества и возможности при внедрении системы на предприятии.</li>
				<li>Документация в виде пошаговых инструкций детально описывает работу и возможности программного обеспечения систем PERCo-S-20 и PERCo-Web.</li>
				<li>Видеоинструкции - наглядные руководства по настройке программного обеспечения - позволяют оперативно ознакомиться с возможностями и функционалом систем PERCo-S-20 и PERCo-Web и изучить этапы инсталляции и настройки компонентов систем.</li>
				<li>«Изменения в последних версиях ПО» позволяют своевременно узнавать обо всех обновлениях, новых возможностях и функционале систем.</li>
			</ul>
		</li>
		<li>Для изучения контроллеров
			<ul>
				<li><a href="/obuchenie/installyatorov/kit.php">KIT-набор</a> - компактный переносной стенд, на котором установлено необходимое оборудование и нанесена схема подключения. Комплект KIT предоставляется по договору ответственного хранения на один месяц без оплаты.</li>
				В комплект KIT входит:
				<ul>
					<li>Контроллер PERCo-CT/L-04.2</li>
					<li>Считыватели PERCo-MR07</li>
				</ul>
				Вы оплачиваете только стоимость доставки комплекта со склада производителя и обратно. Для получения комплекта KIT необходимо зарегистрироваться на сайте. После регистрации можно заказать набор с указанием способа получения в «Кабинете клиента».
				<li>Документация представлена в виде руководств по эксплуатации и инструкций по монтажу контроллеров и другого оборудования.</li>
				<!--<li><a href="/video/interactiv/catalog-sistem.swf?referrer=<?=$_SERVER["REQUEST_URI"];?>">Интерактивный каталог «Системы безопасности»</a> включает в себя описания, принципы работы, возможности и характеристики систем PERCo-S-20 и PERCo-Web. В первую очередь каталог будет полезен менеджерам по продажам.</li>-->
			</ul>
		</li>
	</ol>
	<h2>Самостоятельное изучение замков, турникетов и электронных проходных PERC<span style="text-transform:lowercase;">о</span></h2>
	<ul>
		<li>Документация представлена в виде руководств по эксплуатации и инструкций по монтажу замков, турникетов, калиток и электронных проходных.</li>
		<li>Видеоинструкции позволяют получить исчерпывающую информацию по монтажу и вводу в эксплуатацию оборудования.</li>
		<!--<li><a href="/video/interactiv/catalog.swf?referrer=<?=$_SERVER["REQUEST_URI"];?>">Интерактивный каталог «Замки, турникеты и электронные проходные»</a> включает в себя описания, принципы работы, возможности и характеристики электромеханических замков, турникетов, калиток, электронных проходных, примеры 3D макетов. В первую очередь каталог будет полезен менеджерам по продажам.</li>-->
	</ul>
	<p>Актуальную информацию об обновлении продуктовой линейки PERCo можно получить в разделе <a href="/podderzhka/proektirovshchikam-i-installyatoram/novoe.php">Новое в товарах</a></p>
	<!--<p>На странице ниже размещена информация об обновлениях продуктовой линейки PERCo. Все изменения представлены в хронологическом порядке и разделены на годы изменения и выпуска. Эта информация, несомненно, будет полезна всем пользователям системы.</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "izmeneniya-v-oborudovanii",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => "",	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "N",	// Учитывать права доступа
	),
	false
);
?>-->
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>