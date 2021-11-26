<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');

$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lightgallery.min.js");
$APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-zoom.min.js");
$APPLICATION->SetAdditionalCSS("/scripts/lightgallery/css/lightgallery.min.css");
$APPLICATION->SetAdditionalCSS("/scripts/lightslider/css/lightslider.min.css");

?> 
<script>
	app.setPageTitle({
         title: "О компании"
	  });
	  
	$(function(){
		$("#kachestvo").lightGallery({
			selector: "this",
			download: false,
			iframeMaxWidth: "80%"
		});
	});
</script>
<div>
	<img src="bxlocal://banner_buildings.png" width="100%" alt="banner" />
</div>
<div id="state_banner">
	<div class="text_item">
		<span class="blue">PERCo в цифрах:</span>
		<ul>
			<li>30 работы на рынке безопасности</li>
			<li>Продажи продукции PERCo в 88 странах мира</li>
			<li>Торговая марка PERCo зарегистрирована в 20 странах мира</li>
			<li>Более 20 000 000 человек каждый день проходят через турникеты и электронные проходные PERCo</li>
			<li>23 000 м<sup>2</sup> производственных и офисных площадей</li>
			<li>Более 500 квалифицированных специалистов</li>
			<li>5-летний гарантийный срок на оборудование PERCo</li>
			<li>Склады готовой продукции в Москве, Санкт-Петербурге, Пскове и ЕС (Роттердам, Голландия и Таллинн, Эстония)</li>
			<li>Изучение систем безопасности PERCo включено в обязательную программу обучения в 12 ВУЗах России и СНГ</li>
		</ul>
	</div>
</div>
<div id="content">
	<div id="preview_content">
		<div class="left text_item">
			<p>Компания PERCo — ведущий российский производитель систем и оборудования безопасности. Входит в пятерку мировых производителей.</p>
			<p class="headline">Система менеджмента качества PERCo имеет сертификаты, удостоверяющие соответствие международным стандартам<br />ISO 9001:2015</p>
			<p>Все товары имеют подтверждение соответствия требованиям безопасности российских и общеевропейских ЕС стандартов, предъявляемым к оборудованию, предназначенному для организации безопасности на предприятиях, в организациях и т.п.</p>
			<p>Производимое PERCo оборудование и системы безопасности разрабатываются специалистами самой компании. Дивизион НИОКР PERCo включает в себя конструкторское бюро, департаменты аппаратных средств и программного обеспечения. Все новые товары проходят необходимые ресурсные и климатические испытания, испытания на электробезопасность, электромагнитную совместимость, пожарную безопасность.</p>
			<p class="headline">PERCo уделяет особое внимание эффективной эксплуатации продаваемых изделий:</p>
			<ul>
				<li>Компания неукоснительно выполняет гарантийные и постгарантийные обязательства производителя в течение всего жизненного срока товара</li>
				<li>Департамент сервисного обслуживания оказывает технические консультации, послепродажное обслуживание продукции, осуществляет гарантийный ремонт</li>
				<li>Сертифицированные сервисные центры PERCo помогают бизнес-партнерам, в том числе монтажным организациям, осуществлять сервис, что обеспечивает эффективное обслуживание конечных покупателей продукции PERCo</li>
			</ul>
		</div>
	</div>
	<div class="turnikets-video" style="max-width: 600px; margin: 0 auto;">
	<?
		$APPLICATION->IncludeComponent("bitrix:catalog.element", "mobile_video", array(
			"IBLOCK_ID" => "35",
			"ELEMENT_ID" => "22328",
			"AUTOSTART" => "N",
			),
			false
		);
	?>
	</div>
	<div class="tabs">
		<input type="checkbox" id="proizvodstvo" name="vkladki">
		<label for="proizvodstvo"><span class="dashed">Производство</span></label>
		<div class="text_item">
			<div>
				<img src="bxlocal://proizvodstvo_banner.png" width="100%" alt="banner" />
			</div>
			<p class="headline">PERCo — это высокотехнологичное производство, оснащенное по последнему слову техники оборудованием ведущих мировых производителей:</p>
			<ul>
				<li>установка лазерного раскроя металла LaserCut, производитель МСА, Россия</li>
				<li>прецизионный электроэрозионный станок Арта, производитель НПК Дельта-Тест, Россия</li>
				<li>координатно-вырубные прессы с ЧПУ (производители AMADA, Япония и TRUMPF, Германия)</li>
				<li>листогибочные прессы с ЧПУ (AMADA, Япония)</li>
				<li>вертикально-обрабатывающие центры с ЧПУ (MATSUURA, Япония, и DAHLIH, Тайвань)</li>
				<li>токарно-обрабатывающие центры с ЧПУ (GOODWAY и ACCUWAY MACHINERY, Тайвань)</li>
				<li>центр SMT-монтажа электронных плат (YAMAHA MOTOR GROUP, Япония)</li>
				<li>линия подготовки поверхности (WIGAL, Henkel, Германия)</li>
				<li>универсальные токарные и фрезерные станки (ARSENAL, Болгария)</li>
				<li>шлифовальные станки (LOESER, Германия)</li>
				<li>автоматизированный рольганг (TEHTONI CRISTIAN, Италия)</li>
				<li>автоматический ленточнопильный станок (EVERISING, Тайвань)</li>
				<li>отрезной дисковый станок (SCOOTCHMAN, США)</li>
				<li>ленточно-шлифовальные станки Peltzmeyer и Kuhlmeyer (Германия), Gecam (Италия)</li>
				<li>трубогибочные станки (ERCOLINA, Италия)</li>
				<li>покрасочная линия (GEMA, Швейцария)</li>
				<li>полуавтоматическая трубосверлильная машина hebö Maschinenfabrik GmbH (Германия)</li>
				<li>форматно-раскроечный станок Bala Makina (Турция)</li>
			</ul>
			<p>Многоступенчатая система качества предприятия позволяет тщательно осуществлять контроль на всех этапах производства и предпродажной подготовки товаров.</p>
		</div>
		<input type="checkbox" id="osnovnye_tovarnye_gruppy" name="vkladki">
		<label for="osnovnye_tovarnye_gruppy"><span class="dashed">Основные товарные группы</span></label>
		<div class="text_item">
			<div>
				<img src="bxlocal://gruppi_tovarov_banner.png" width="100%" alt="banner" />
			</div>
			<p class="headline">Продукция PERCo</p>
			<ul>
				<li>Комплексные системы безопасности (КСБ)</li>
				<li>Системы контроля доступа (СКУД) и повышения эффективности</li>
				<li>Электронные проходные (готовая система контроля доступа)</li>
				<li>Турникеты, калитки и ограждения</li>
				<li>Электромеханические замки</li>
				<li>Считыватели бесконтактных карт и картоприемники</li>
			</ul>
		</div>
		<input type="checkbox" id="kontrol_kachestva" name="vkladki">
		<label for="kontrol_kachestva"><span class="dashed">Контроль качества</span></label>
		<div class="text_item">
			<div>
				<img src="bxlocal://kachestvo_banner.png" width="100%" alt="banner" />
			</div>
			<p class="headline">Многоступенчатая система качества компании позволяет тщательно контролировать все этапы производства и предпродажной подготовки товаров</p>
			<p>Все товары имеют подтверждение соответствия требованиям безопасности российских и общеевропейских ЕС стандартов, предъявляемым к такому оборудованию.</p>
			<p class="headline">Политика PERCo в области качества</p>
			<p>Политика PERCo в области качества &ndash; достижение высокого качества, надежности и безопасности выпускаемой продукции, достижение и поддержание лидирующих позиций в области производства систем безопасности, обеспечение на внутреннем и внешнем рынках высокой репутации предприятия.</p>
			<p class="headline">Цели PERC<span style="text-transform:lowercase;">o</span> в области качества</h2>
			<ul>
				<li>производство конкурентоспособных изделий, удовлетворяющих потребности покупателей: турникетов, калиток, электромеханических замков, электронных проходных, систем контроля доступа, комплексных систем безопасности</li>
				<li>обеспечение стабильности качества продукции</li>
				<li>ежегодное определение объективных показателей, сопровождающих процесс улучшения качества продукции</li>
				<li>систематический анализ эффективности Системы Менеджмента Качества на основе информации о несоответствиях, выявленных при контроле, испытаниях и эксплуатации продукции</li>
				<li>постоянное переоснащение парка технологического, контрольно-измерительного и испытательного оборудования, компьютерной техники и программного обеспечения</li>
				<li>формирование деловой репутации надёжного партнёра в бизнес-сообществе, снижение рисков для потребителей при выполнении договорных обязательств, оперативное предупреждение возможных и устранение выявленных несоответствий продукции</li>
				<li>обеспечение компетентности персонала, формирование сознательного понимания того, что важнейшим фактором высокой репутации предприятия и финансового благополучия каждого сотрудника является качество</li>
			</ul>
		</div>
		<input type="checkbox" id="obuchenie" name="vkladki">
		<label for="obuchenie"><span class="dashed">Обучение</span></label>
		<div>
			<div>
				<img src="bxlocal://obuchenie_banner.png" width="100%" alt="banner" />
			</div>
			<p class="headline">Учебный центр PERCo на постоянной основе проводит для пользователей и инсталляторов обучающие семинары, посвященные изучению и внедрению системы безопасности PERCo</p>
			<p>Учебный Центр оснащен компьютерами и стендами с действующим оборудованием. Изучение производимой PERCo продукции для обеспечения безопасности включено в обязательную программу обучения в 12 высших учебных заведениях России и стран СНГ.</p>
			<p>Вузы имеют лаборатории с оборудованием системы безопасности PERCo и демонстрационными стендами.</p>
		</div>
	</div>
	<div class="scroll" id="horizontal_scroll">
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