<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("bodyItemtype", "AboutPage");
$APPLICATION->SetTitle("О компании");
$APPLICATION->SetPageProperty("title", "Производство систем контроля доступа, производитель СКУД");
$APPLICATION->SetPageProperty("description", "PERCo - ведущий российский производитель оборудования и систем безопасности");
$APPLICATION->SetPageProperty("keywords", "perco, пэрко, системы безопасности");

$APPLICATION->SetAdditionalCSS("/css/o-kompanii.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/o-kompanii.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-video.min.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/virtual-tour/pano2vr_player.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/virtual-tour/skin.js"); // подключение скриптов
$APPLICATION->AddHeadScript("/scripts/virtual-tour/pano2vrgyro.js"); // подключение скриптов
?> 
<div class="dop_menu">
<? $APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_dop_menu", 
	array(
		"ROOT_MENU_TYPE" => "podmenu",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "N",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "Y",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N"
	),
	false
);?>
</div>
<div class="width_all">
	<div class="banner_image"></div>
	<div class="banner_text">
		<div class="bleft">Главный офис PERCo</div>
		<div class="bright">Завод PERCo</div>
	</div>
</div>
<div id="content">
	<div id="state_banner">
		<div class="text_item">
			<span class="blue">PERCo в цифрах:</span>
			<ul>
				<li><?=$year_company;?> работы на рынке безопасности</li>
				<li>Продажи продукции PERCo в <?=$country_company;?> странах мира</li>
				<li>Торговая марка PERCo зарегистрирована в 20 странах мира</li>
				<li>Более 50 000 000 человек каждый день проходят через турникеты и электронные проходные PERCo</li>
				<li>23 000 м<sup>2</sup> производственных и офисных площадей</li>
				<li>Более 500 квалифицированных специалистов</li>
				<li>5-летний гарантийный срок на оборудование PERCo</li>
				<li>Склады готовой продукции в Москве, Санкт-Петербурге, Пскове и ЕС (Роттердам, Голландия и Таллин, Эстония)</li>
				<li>Изучение систем безопасности PERCo включено в обязательную программу обучения в 12 ВУЗах России и СНГ</li>
			</ul>
		</div>
		<div class="image_items">
			<!--<div class="left_item">-->
				<div class="b_item">
					<div class="fon_img">
						<img alt="Продажи в <?=$country_company;?> странах мира" src="/images/icons/map.svg" />
						<span class="text_on_map"><?=$country_company;?></span>
					</div>
					<p>Продажи<br />в <?=$country_company;?> странах мира</p>
				</div>
				<div class="b_item">
					<div class="fon_img">
						<img alt="<?=$year_company;?> работы на рынке" src="/images/icons/years.svg" />
						<span class="years"><?$year = explode(" ", $year_company); echo $year[0];?></span>
					</div>
					<p><?=$year_company;?> работы на рынке</p>
				</div>
				<div class="b_item">
					<img alt="Современный завод по производству оборудования безопасности" src="/images/icons/zavod.svg" />
					<p>Современный завод по производству оборудования безопасности</p>
				</div>
				<div class="b_item">
					<img alt="400 дилеров и 45 сервисных центров" src="/images/icons/services.svg" />
					<p style="margin-top: -5px;">400 дилеров<br />и 45 сервисных центров</p>
				</div>
				
				<div class="b_item">
					<img alt="Стандарты качества ISO" src="/images/icons/5-guaranty.svg" />
					<p>Гарантийный срок <br />на оборудование PERCo - 5 лет</p>
				</div>
				<div class="b_item">
					<img alt="Техподдержка и обучение" src="/images/icons/support.svg" />
					<p>Техподдержка<br />и обучение</p>
				</div>
				<div class="b_item" style="display: none">
					<img alt="Стандарты качества ISO" src="/images/icons/iso.svg" />
					<p style="margin-top: -5px">Система менеджмента качества PERCo соответствует<br />международным стандартам</p>
				</div>
				
			<!--</div>
			<div class="right_item">-->
				
			<!--</div>-->
		</div>
	</div>

	<h1> <?$APPLICATION->ShowTitle(false, false)?> </h1>
	<div id="preview_content">
		<div class="left">
			<p>Компания PERCo — ведущий российский производитель систем и оборудования безопасности. Входит в пятерку мировых производителей.</p>
			<p class="h2">Система менеджмента качества PERCo имеет сертификаты, удостоверяющие соответствие международным стандартам<br />ISO 9001:2015</p>
<?
$iblocks = GetIBlockList("download", "files");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "sertifikaty-sistemy-kachestva-perco",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);?>
			<p>Все товары имеют подтверждение соответствия требованиям безопасности российских и общеевропейских ЕС стандартов, предъявляемым к оборудованию, предназначенному для организации безопасности на предприятиях, в организациях и т.п.</p>
			<p>Производимое PERCo оборудование и системы безопасности разрабатываются специалистами самой компании. Дивизион НИОКР PERCo включает в себя конструкторское бюро, департаменты аппаратных средств и программного обеспечения. Все новые товары проходят необходимые ресурсные и климатические испытания, испытания на электробезопасность, электромагнитную совместимость, пожарную безопасность.</p>
			<p class="h2">PERCo уделяет особое внимание эффективной эксплуатации продаваемых изделий:</p>
			<ul>
				<li>Компания неукоснительно выполняет гарантийные и постгарантийные обязательства производителя в течение всего жизненного срока товара</li>
				<li>Департамент сервисного обслуживания оказывает технические консультации, послепродажное обслуживание продукции, осуществляет гарантийный ремонт</li>
				<li>Сертифицированные сервисные центры PERCo помогают бизнес-партнерам, в том числе монтажным организациям, осуществлять сервис, что обеспечивает эффективное обслуживание конечных покупателей продукции PERCo</li>
			</ul>
		</div>
		<div class="right">
			<div class="border">
				<span>
					<div class="video-gallery">
					<a href="https://www.youtube.com/watch?v=KyKehb9KQIU">
						<img src="/images/banners/video_o-kompanii.png" />
					</a>
					</div>
				</span>
				<div class="video_item">
					<div class="video_text">
						<p>Фильм о компании</p>
						<p class="grey">
							<span class="dashed">
								<span class="video-gallery"><a href="https://www.youtube.com/watch?v=KyKehb9KQIU">Посмотреть</a></span>
							</span>&nbsp;(00:04:36) /&nbsp;
							<a class="dashed" href="/video/film-about-company.mp4" onclick="ga('send', 'event', {'eventCategory': 'Видео', 'eventAction': 'Загрузки', 'eventLabel': 'Фильм о PERCo'});" download>Скачать</a>&nbsp;(<?=printFileInfo("/video/film-about-company.mp4", "size");?>)
						</p>
					</div>
				</div>
			</div>
			<div style="display: flex; flex-direction: column; align-items: center; margin-top: 32px;">
				<a href="https://lk.ecp.spb.ru/user/declaration-organization/?inn=7806437448&category=5" target="_blank"><img src="/images/qr-code/qr-covid-info.gif"></a>
				<div>Информация о соблюдении стандартов ведения безопасной деятельности</div>
			</div>
			<div id="virtual-tour-block">
				<div id="virtual-tour"><img alt="Загрузка" src="/images/icons/loading.gif" /></div>
				<div id="virtual_text"><img alt="Виртуальный тур" src="/images/icons/virtual-tour.svg" />Виртуальный тур по главному офису PERCo</div>
			</div>
		</div>
	</div>
	<div class="tabs">
		<input type="radio" id="proizvodstvo" checked="checked" name="vkladki">
		<label for="proizvodstvo"><span class="dashed">Производство</span></label>
		<div>
			<div id="proizvodstvo_banner" class="vkladka_banner"><div class="border"></div></div>
			<p class="h2">PERCo — это высокотехнологичное производство, оснащенное по последнему слову техники оборудованием ведущих мировых производителей:</p>
			<ul>
				<li>установка лазерного раскроя металла LaserCut (МСА, Россия)</li>
				<li>прецизионный электроэрозионный станок Арта (НПК Дельта-Тест, Россия)</li>
				<li>координатно-вырубные прессы с ЧПУ (AMADA, Япония и TRUMPF, Германия)</li>
				<li>листогибочные прессы с ЧПУ (AMADA, Япония)</li>
				<li>вертикально-обрабатывающие центры с ЧПУ (MATSUURA, Япония, и Akira Seiki, Тайвань)</li>
				<li>токарно-обрабатывающие центры с ЧПУ (GOODWAY, ACCUWAY MACHINERY, TAKISAWA, Тайвань)</li>
				<li>центр SMT-монтажа электронных плат (YAMAHA MOTOR GROUP, Япония)</li>
				<li>линия подготовки поверхности (WIGAL, Henkel, Германия)</li>
				<li>универсальные токарные и фрезерные станки (KNUTH, Германия)</li>
				<li>шлифовальные станки (LOESER, Германия)</li>
				<li>автоматизированный рольганг (TEHTONI CRISTIAN, Италия)</li>
				<li>автоматический ленточнопильный станок (EVERISING, Тайвань)</li>
				<li>отрезной дисковый станок (SCOOTCHMAN, США)</li>
				<li>ленточно-шлифовальные станки (Peltzmeyer, Германия, Gecam, Италия)</li>
				<li>трубогибочные станки (ERCOLINA, Италия)</li>
				<li>покрасочная линия (GEMA, Швейцария)</li>
				<li>полуавтоматическая трубосверлильная машина hebö Maschinenfabrik GmbH (Германия)</li>
				<li>форматно-раскроечный станок Bala Makina (Турция)</li>
			</ul>
			<p>Многоступенчатая система качества предприятия позволяет тщательно осуществлять контроль на всех этапах производства и предпродажной подготовки товаров.</p>
		</div>
		<input type="radio" id="osnovnye_tovarnye_gruppy" name="vkladki">
		<label for="osnovnye_tovarnye_gruppy"><span class="dashed">Основные товарные группы</span></label>
		<div>
			<div id="gruppi_tovarov_banner" class="vkladka_banner"><div class="border"></div></div>
			<p class="h2">Продукция PERCo</p>
			<ul>
				<li>Комплексные системы безопасности (КСБ)</li>
				<li>Системы контроля доступа (СКУД) и повышения эффективности</li>
				<li>Электронные проходные (готовая система контроля доступа)</li>
				<li>Турникеты, калитки и ограждения</li>
				<li>Электромеханические замки</li>
				<li>Считыватели бесконтактных карт и картоприемники</li>
			</ul>
			<p>КСБ представлены Единой системой безопасности PERCo-S-20, построенной на Ethernet-технологиях. Архитектура S-20 включает в себя системы охранно-пожарной сигнализации, видеонаблюдения, СКУД,  контроля дисциплины труда.</p>
			<p>Возможности системы позволяют осуществлять интеграцию оборудования, выпущенного другими производителями.</p>
			<p>СКУД (системы контроля и управления доступом) PERCo представляют собой широкий спектр решений для предприятий, учреждений, вузов и школ, спортивных объектов, портов и аэропортов и т.п.</p>
			<p>Так, для помещений разработана система контроля доступа (СКУД ) «Электронный кабинет», которая позволяет руководителям и специалистам, ведущим прием, дистанционно управлять доступом посетителей в кабинет и упорядочить процесс приема посетителей.</p>
			<p>СКУД «Автотранспортная проходная» обеспечивает контроль проезда на территорию предприятия служебных, личных транспортных средств, а также автомобилей посетителей.</p>
			<p>Для обеспечения безопасности в учебных заведениях производитель СКУД разработал систему «Школа».</p>
			<p>PERCo была одной из первых, кто начал производство систем контроля доступа (СКУД) в России.</p>
			<p>Электронные проходные – это готовая СКУД, построенная на IP-технологиях. Электронные проходные позволяют эффективно контролировать проходы через преграждающие устройства.</p>
			<p>Турникеты, калитки, ограждения PERCo – одна из самых продаваемых марок оборудования в мире. Модельный ряд турникетов включает триподы, тумбовые, полуростовые и полноростовые роторные турникеты, скоростные проходы, автоматические и полуавтоматические калитки.</p>
			<p>Считыватели бесконтактных карт и картоприемники PERCo предназначены для работы в системах ограничения доступа (СКУД)в качестве считывающих устройств. Кроме того, картоприемники применяются  в СКУД  (системы контроля и управления доступом) для организации автоматического сбора карт посетителей, что значительно упрощает работу операторов и службы охраны. Пока посетитель не опустит карту в картоприемник, он не сможет покинуть контролируемую территорию.</p>
		</div>
		<input type="radio" id="kontrol_kachestva" name="vkladki">
		<label for="kontrol_kachestva"><span class="dashed">Контроль качества</span></label>
		<div>
			<div id="kachestvo_banner" class="vkladka_banner"><div class="border"></div></div>
			<p class="h2">Многоступенчатая система качества компании позволяет тщательно контролировать все этапы производства и предпродажной подготовки товаров</p>
			<p>Все товары имеют подтверждение соответствия требованиям безопасности российских и общеевропейских ЕС стандартов, предъявляемым к такому оборудованию.</p>
			<p style="display: none;">Система менеджмента качества PERCo имеет сертификаты IQNet и ACCREDIA/Test-St.-Petersburg, удостоверяющие соответствие международным стандартам ISO 9001:2015, а также сертификат, удостоверяющий соответствие российскому ГОСТ ИСО 9001-2015.</p>
			<p class="h2">Политика PERCo в области качества</p>
			<p>Политика PERCo в области качества &ndash; достижение высокого качества, надежности и безопасности выпускаемой продукции, достижение и поддержание лидирующих позиций в области производства систем безопасности, обеспечение на внутреннем и внешнем рынках высокой репутации предприятия.</p>
			<p class="h2">Цели PERC<span style="text-transform:lowercase;">o</span> в области качества</h2>
			<ul>
				<li>производство конкурентоспособных изделий, удовлетворяющих потребности покупателей: турникетов, калиток, электромеханических замков, электронных проходных, систем контроля доступа, комплексных систем безопасности</li>
				<li>обеспечение стабильности качества продукции</li>
				<li>ежегодное определение объективных показателей, сопровождающих процесс улучшения качества продукции</li>
				<li>систематический анализ эффективности Системы Менеджмента Качества на основе информации о несоответствиях, выявленных при контроле, испытаниях и эксплуатации продукции</li>
				<li>постоянное переоснащение парка технологического, контрольно-измерительного и испытательного оборудования, компьютерной техники и программного обеспечения</li>
				<li>формирование деловой репутации надёжного партнёра в бизнес-сообществе, снижение рисков для потребителей при выполнении договорных обязательств, оперативное предупреждение возможных и устранение выявленных несоответствий продукции</li>
				<li>обеспечение компетентности персонала, формирование сознательного понимания того, что важнейшим фактором высокой репутации предприятия и финансового благополучия каждого сотрудника является качество</li>
			</ul>
			<div class="dop_block">
<? $APPLICATION->IncludeComponent("bitrix:catalog.element", "video", array(
	"IBLOCK_TYPE" => "video",
	"IBLOCK_ID" => "35",
	"ELEMENT_CODE" => "resursnye-ispytaniya-oborudovaniya",
	"SECTION_ID" => "",
	"SECTION_CODE" => "",
	"PROPERTY_CODE" => array(
		0 => "FILE",
		1 => "NAME",
		2 => "",
	),
	"SECTION_URL" => "",
	"DETAIL_URL" => "",
	"BASKET_URL" => "/personal/basket.php",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_GROUPS" => "Y",
	"META_KEYWORDS" => "-",
	"META_DESCRIPTION" => "-",
	"BROWSER_TITLE" => "-",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"PRICE_CODE" => array(
	),
	"USE_PRICE_COUNT" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"PRODUCT_PROPERTIES" => array(
	),
	"USE_PRODUCT_QUANTITY" => "N",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_IBLOCK_ID" => "",
	"LINK_PROPERTY_SID" => "",
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#"
	),
	false
);?>
				<div id="kachestvo" data-iframe="true" data-src="/o-kompanii/stal.php" ><img width="272px" height="155px" src="/images/stal_mini.jpg" alt="Применение высококачественной нержавеющей стали" /><br />Испытание материалов</div>
			</div>
		</div>
		<input type="radio" id="obuchenie" name="vkladki">
		<label for="obuchenie"><span class="dashed">Обучение</span></label>
		<div>
			<div id="obuchenie_banner" class="vkladka_banner"><div class="border"></div></div>
			<p class="h2">Учебный центр PERCo на постоянной основе проводит для пользователей и инсталляторов обучающие семинары, посвященные изучению и внедрению системы безопасности PERCo</p>
			<p>Учебный Центр оснащен компьютерами и стендами с действующим оборудованием. Изучение производимой PERCo продукции для обеспечения безопасности включено в обязательную программу обучения в 12 высших учебных заведениях России и стран СНГ:</p>
			<ul>
				<li>МГТУ им. Баумана г. Москва</li>
				<li>СПб ГУТ им. Бонч-Бруевича г. Санкт-Петербург</li>
				<li>Университет ГПС МЧС РФ г. Санкт-Петербург</li>
				<li>Московский Университет МВД им. В. Я. Кикотя</li>
				<li>Воронежский Институт МВД</li>
				<li>Омский ГТУ</li>
				<li>Уральский Федеральный Университет г. Екатеринбург</li>
				<li>Новосибирский ГТУ</li>
				<li>БГУИР г. Минск</li>
				<li>Казахский Национальный Универсистет г. Алмата</li>
				<li>Suleyman Demirel University г. Алмата</li>
				<li>Санкт-Петербургский Университет МВД</li>
				<li>Вологодский колледж связи и информационных технологий (ВКСИТ), Вологда</li>
			</ul>
			<p>Вузы имеют лаборатории с оборудованием системы безопасности PERCo и демонстрационными стендами.</p>
		</div>
	</div>
	<div id="horizontal_scroll">
<?
global $arrFilter;
$arrFilter["PROPERTY_TYPE_PRODUCT"] = 16475;
$APPLICATION->IncludeComponent("bitrix:news.list", "perco_scroll", array(
	"IBLOCK_TYPE" => "images",
	"IBLOCK_ID" => "18",
	"PARENT_SECTION" => "",
	"PARENT_SECTION_CODE" => "",
	"NEWS_COUNT" => "1000",
	"SORT_BY1" => "SORT",
	"SORT_ORDER1" => "ASC",
	"SORT_BY2" => "ACTIVE_FROM",
	"SORT_ORDER2" => "ASC",
	"USE_FILTER" => "Y",
	"FILTER_NAME" => "arrFilter",
	"FIELD_CODE" => array(
		0 => "",
	),
	"PROPERTY_CODE" => array(
		0 => "TYPE_PRODUCT"
	),
	"CHECK_DATES" => "Y",
	"DETAIL_URL" => "",
	"AJAX_MODE" => "N",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "36000000",
	"CACHE_FILTER" => "N",
	"CACHE_GROUPS" => "Y",
	"PREVIEW_TRUNCATE_LEN" => "",
	"ACTIVE_DATE_FORMAT" => "d.m.Y",
	"SET_TITLE" => "N",
	"SET_STATUS_404" => "N",
	"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
	"ADD_SECTIONS_CHAIN" => "N",
	"HIDE_LINK_WHEN_NO_DETAIL" => "N",
	"DISPLAY_TOP_PAGER" => "N",
	"DISPLAY_BOTTOM_PAGER" => "Y",
	"PAGER_TITLE" => "Фотографии",
	"PAGER_SHOW_ALWAYS" => "Y",
	"PAGER_TEMPLATE" => "gallery",
	"PAGER_DESC_NUMBERING" => "N",
	"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
	"PAGER_SHOW_ALL" => "Y",
	"DISPLAY_DATE" => "Y",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PICTURE" => "Y",
	"DISPLAY_PREVIEW_TEXT" => "Y",
	"AJAX_OPTION_ADDITIONAL" => "",
	),
	false
);?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>