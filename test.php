<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("amp", "Y");
$APPLICATION->SetTitle("Системы безопасности PERCo");
$APPLICATION->SetPageProperty("title", "Системы безопасности – цены, купить комплексные системы безопасности, производство систем безопасности");
$APPLICATION->SetPageProperty("description", "PERCo – крупнейший российский производитель оборудования и систем безопасности (СКУД - системы контроля доступа, видеонаблюдение, турникеты, считыватели, электромеханические замки)");
$APPLICATION->SetPageProperty("keywords", "системы безопасности, контроль доступа, системы контроля доступа, скуд, скд, турникеты, охранно пожарная сигнализация, пожарная безопасность, видеонаблюдение, системы видеонаблюдения, учет рабочего времени");

$APPLICATION->AddHeadScript("/scripts/pages/main.js"); // подключение скриптов
$APPLICATION->SetAdditionalCSS("/css/glavnaya.css"); // подключение стилей
if (!$USER->IsAdmin()) {
	CHTTP::SetStatus("404 Not Found");
	@define("ERROR_404","Y");
}
?>
<div id="main_banner">
	<ul id="slider">
		<li>
			<a href="/resheniya/dlya-biznes-tsentrov/">
				<div class="text_banner">
					<span>Для бизнес-центров</span>
				</div>
				<div class="banner_image" style="background-image: url(/images/banners/solution-bc.jpg);"></div>
			</a>
		</li>
		<li>
			<a href="/resheniya/dlya-predpriyatiy/">
				<div class="text_banner">
					<span>Для предприятий</span>
				</div>
				<div class="banner_image" style="background-image: url(/images/banners/solution-company.jpg);"></div>
			</a>
		</li>
		<li>
			<a href="/resheniya/dlya-ofisov/">
				<div class="text_banner">
					<span>Для офисов</span>
				</div>
				<div class="banner_image" style="background-image: url(/images/banners/solution-office.jpg);"></div>
			</a>
		</li>
		<li>
			<a href="/resheniya/dlya-uchebnykh-zavedeniy/">
				<div class="text_banner">
					<span>Для учебных заведений</span>
				</div>
				<div class="banner_image" style="background-image: url(/images/banners/solution-e-institute.jpg);"></div>
			</a>
		</li>
		<li>
			<a href="/resheniya/dlya-gosudarstvennykh-uchrezhdeniy/">
				<div class="text_banner">
					<span>Для государственных учреждений</span>
				</div>
				<div class="banner_image" style="background-image: url(/images/banners/solution-institute.jpg);"></div>
			</a>
		</li>
		<li>
			<a href="/resheniya/dlya-sportivno-razvlekatelnykh-obektov/">
				<div class="text_banner">
					<span>Для спортивно-развлекательных объектов</span>
				</div>
				<div class="banner_image" style="background-image: url(/images/banners/solution-sport.jpg);"></div>
			</a>
		</li>
	</ul>
</div>
<div id="state_banner">
	<a class="b_items" href="/o-kompanii/">
		<div class="b_item">
			<div class="fon_img">
				<img alt="Продажи в <?=$country_company;?> странах мира" src="/images/icons/map.svg" />
				<span class="text_on_map"><?=$country_company;?></span>
			</div>
			<p>Продажи в <?=$country_company;?><br />странах мира</p>
		</div>
		<div class="b_item">
				<img alt="Современный завод систем безопасности" src="/images/icons/zavod.svg" />
			<p>Современный завод<br />систем безопасности</p>
		</div>
		<div class="b_item">
			<div class="fon_img">
				<img alt="<?=$year_company;?> работы на рынке" src="/images/icons/years.svg" />
				<span class="years"><?$year = explode(" ", $year_company); echo $year[0];?></span>
			</div>
			<p><?=$year_company;?><br />работы на рынке</p>
		</div>
	</a>
</div>
<div id="main_catalog_list">
	<h1><?$APPLICATION->ShowTitle(false, false);?></h1>
<?
$iblocks = GetIBlockList("structure", "products");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "section_icons", Array(
		"IBLOCK_TYPE" => "structure",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "1",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => "",	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "Y",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);
?>
</div>
<div id="picture_banner">
	<h2>Актуально</h2>
	<div id="banners" <?if($device!="desktop") echo 'class="bmob"';?>>
		<div class="banner_item" style="position: relative">
			<div style="position: relative">
				<a href="/products/sistema-kontrolya-dostupa-perco-web/" style="position: relative">
					<img alt="PERCo-Web – система контроля доступа с web-интерфейсом" src="/images/banners/banner-percoweb-v2.jpg">
					<div>PERCo-Web – система контроля доступа</div>
				</a>
			</div>
		</div>
		<div class="banner_item">
			<a href="/products/biometricheskie-kontrollery-i-schityvateli/">
				<img alt="Биометрия в системах PERCo" src="/images/banners/banner-bio.jpg">
				<div>Биометрия в системах PERCo</div>
			</a>
		</div>
		<div class="banner_item">
			<a href="/products/smartfony-s-nfc-modulem.php">
				<img alt="Идентификация по смартфону" src="/images/banners/banner-dostup.jpg">
				<div>Идентификация по смартфону</div>
			</a>
		</div>
		<div class="banner_item" style="display:none;">
			<a href="/products/sistema-bezopasnosti-perco-s-20-shkola/">
				<img alt="Система безопасности для школ" src="/images/banners/banner-school.jpg">
				<div>Система безопасности для школ</div>
			</a>
		</div>
		<div class="banner_item" style="display:none;">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/konkurs.php">
				<img alt="Конкурс «Лучшее видео»" src="/images/banners/banner-konkurs-video.jpg">
				<div>Конкурс «Лучшее видео»</div>
			</a>
		</div>
		<div class="banner_item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/">
				<img alt="Проектировщикам и инсталляторам" src="/images/banners/banner-install.jpg">
				<div>Проектировщикам и инсталляторам</div>
			</a>
		</div>
		<div class="banner_item">
			<a href="/obuchenie/">
				<img alt="Обучение партнеров и сертификация" src="/images/banners/banner-obuchenie.jpg">
				<div>Обучение в Учебном центре PERCo</div>
			</a>
		</div>
		<div class="banner_item">
			<a href="https://www.youtube.com/channel/UChZJeHXWSHQuRvXokuGPBFw">
				<img alt="Канал PERCo на YouTube" src="/images/banners/banner-youtube.jpg">
				<div>Канал PERCo на YouTube</div>
			</a>
		</div>

	</div>
</div>
<div id="news_feed">
<?
$iblocks = GetIBlockList("news", "company_news");
if($arIBlock = $iblocks->Fetch())
	$block_id = $arIBlock["ID"];
$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"news_list_main",
	Array(
		"IBLOCK_TYPE" => "news",
		"IBLOCK_ID" => $block_id,
		"NEWS_COUNT" => "6",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"FILTER_NAME" => "",
		"FIELD_CODE" => array(0=>"",1=>"",),
		"PROPERTY_CODE" => array(0=>"ANONS_IMG",1=>"",),
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"PREVIEW_TRUNCATE_LEN" => "",
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"SET_TITLE" => "N",
		"SET_STATUS_404" => "N",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => "",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
</div>
<div id="main_about_block">
	<div class="about_content">
		<h2>О компании</h2>
		<div class="tabs">
			<input type="radio" id="main_about" checked="checked" name="vkladki">
			<label for="main_about"><span class="dashed">Компания PERCo</span></label>
			<div>
				<p>PERCo специализируется на серийном производстве оборудования и систем безопасности собственной разработки с 1988 года.</p>
				<p>Высокое качество обеспечило продукции PERCo признание как в России, так и за рубежом – товары PERCo экспортируются в <?=$country_company;?> стран мира.</p>
				<p>Сегодня PERCo – лидер в производстве систем и оборудования безопасности.</p>
				<p>Система менеджмента качества PERCo сертифицирована на соответствие международным стандартам ISO 9001:2015.</p>
				<p>Все оборудование систем безопасности PERCo проходит необходимые ресурсные испытания. Такие испытания гарантируют безотказную работу оборудования безопасности на объектах у покупателей.</p>
				<p>Собственное производство систем безопасности PERCo оснащено современным высокоточным и высокотехнологичным оборудованием ведущих мировых производителей.</p>
				<p>Это позволяет разрабатывать, выпускать и успешно представлять на рынке широкий ассортимент товаров, отвечающих мировым стандартам в области оборудования и систем безопасности.</p>
				<p>Производство осуществляется на собственном заводе PERCo, построенном в 2010 году в Пскове.</p>
			</div>
			<input type="radio" id="main_mission" name="vkladki">
			<label for="main_mission"><span class="dashed">Миссия</span></label>
			<div>
				<p>Удовлетворение потребностей наших клиентов в качественном оборудовании для решения задач безопасности и эффективного управления бизнесом.</p>
			</div>
			<input type="radio" id="main_tovgroup" name="vkladki">
			<label for="main_tovgroup"><span class="dashed">Основные товарные группы</span></label>
			<div>
				<ul>
					<li>Комплексные системы безопасности</li>
					<li>Системы контроля доступа</li>
					<li>Системы учета рабочего времени</li>
					<li>Электронные проходные – готовые системы контроля доступа</li>
					<li>Турникеты, калитки и ограждения</li>
					<li>Электромеханические замки</li>
				</ul>
				<p>Комплексные системы безопасности представлены системой PERCo-S-20  предназначенной для обеспечения безопасности и повышения эффективности работы предприятия. S-20 построена на Ethernet-технологиях.</p>
				<p>Архитектура S-20 включает в себя системы охранно-пожарной сигнализации, видеонаблюдения, контроля доступа и учета рабочего времени.</p>
				<p>Системы контроля доступа PERCo представляют собой широкий спектр решений для предприятий, учреждений, образовательных организаций, спорткомплексов и т.п.</p>
				<p>СКУД PERCo построены на Ethernet-технологиях, что позволяет использовать стандартное сетевое оборудование.</p>
				<p>Помимо задач контроля доступа системы PERCo позволяют на базе того же оборудования организовать учет рабочего времени и контроль трудовой дисциплины.</p>
				<p>PERCo-Web – система контроля доступа и учета рабочего времени с Web-интерфейсом. Сервер системы устанавливается на одном компьютере, подключенном к сети Ethernet, установка ПО на рабочие места пользователей не требуется. Подключение к системе аналогично входу на сайт.</p>
				<p>Электронные проходные – это полностью готовые к работе СКУД, построенные на IP-технологиях.</p>
				<p>Турникеты PERCo – самая продаваемая в России и ближнем зарубежье марка турникетов и одна из самых продаваемых в мире. Модельный ряд турникетов включает триподы, тумбовые турникеты, полуростовые и полноростовые роторные турникеты, калитки и скоростные проходы.</p>
				<p>Электромеханические замки PERCo разработаны специально для использования в системах безопасности. Инновационная разработка компании – замки с подводом питания через засов. Установка таких замков позволяет сохранить целостность дверного полотна, гарантировать защиту от удара засова по косяку двери и обеспечить работу с контроллерами PERCo без датчика положения двери.</p>
			</div>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>