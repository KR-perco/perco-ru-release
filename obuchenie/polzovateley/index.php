<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if ($_REQUEST["month"] == date("m") && $_REQUEST["year"] == date("Y"))
	$APPLICATION->AddHeadString('<link href="//'.$_SERVER["HTTP_HOST"].'/obuchenie/polzovateley/" rel="canonical" />',true);
$APPLICATION->SetPageProperty("title", "Обучающие семинары для пользователей системы PERCo-S-20");
$APPLICATION->SetPageProperty("description", "Для эффективного использования систем и оборудования PERCo компания проводит регулярные обучающие семинары для пользователей системы S-20");
$APPLICATION->SetPageProperty("keywords", "обучение пользователей");
$APPLICATION->SetTitle("Обучение пользователей");

$APPLICATION->SetAdditionalCSS("/css/vebinary.css"); // подключение стилей
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
<div id="content">
	<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
	<p>Для эффективного использования систем и оборудования PERCo компания проводит регулярные обучающие семинары для пользователей: очные семинары в Учебном центре в Санкт-Петербурге и интернет-семинары (вебинары).</p>
<?$APPLICATION->IncludeComponent("perco:learning.calendar","learning",Array(
	"AJAX_MODE" => "N",
	"IBLOCK_TYPE" => "edu",
	"IBLOCK_ID" => "46",
	"MONTH_VAR_NAME" => "month",
	"YEAR_VAR_NAME" => "year",
	"WEEK_START" => "1",
	"DATE_FIELD" => "DATE_ACTIVE_TO",
	"TYPE" => "EVENTS",
	"PROPERTY_CODE" => array(
		0 => "TEMA",
	),
	"SHOW_YEAR" => "Y",
	"SHOW_TIME" => "Y",
	"TITLE_LEN" => "0",
	"SET_TITLE" => "N",
	"SHOW_CURRENT_DATE" => "Y",
	"SHOW_MONTH_LIST" => "Y",
	"NEWS_COUNT" => "0",
	"DETAIL_URL" => "",
	"CACHE_TYPE" => "A",
	"CACHE_TIME" => "3600",
	"AJAX_OPTION_SHADOW" => "Y",
	"AJAX_OPTION_JUMP" => "N",
	"AJAX_OPTION_STYLE" => "Y",
	"AJAX_OPTION_HISTORY" => "N",
	"AJAX_OPTION_ADDITIONAL" => ""
	)
);?>
	<p>Программы обучения предназначены для различных групп пользователей:</p>
	<ul>
		<li>администратор системы</li>
		<li>сотрудник Службы безопасности</li>
		<li>сотрудник Отдела кадров</li>
		<li>сотрудник Бухгалтерии</li>
		<li>сотрудник Бюро пропусков.</li>
	</ul>
	<p>Программы обучения позволяют получить необходимые для каждой группы работников знания по функциональным возможностям систем PERCo и в дальнейшем закрепить эти знания выполнением теоретических и практических заданий.</p>
	<p>PERCo предлагает потенциальным покупателям наглядно ознакомиться с возможностями систем безопасности PERCo на объекте покупателя c помощью демонстрационного КИТ-набора.</p>
	<p>Для принятия взвешенного решения по выбору системы безопасности потенциальные покупатели могут обратиться к Авторизованным дилерам и Сервис-центрам, которые готовы выехать на объект и продемонстрировать оборудование и возможности систем безопасности PERCo с помощью KIT-набора.</p>
	<p>Для более тщательного изучения системы демонстрационный KIT-набор может быть предоставлен покупателю на время для самостоятельного тестирования возможностей системы.</p>
	<p>KIT-набор представляет из себя кейс с мини-стендом внутри, на котором установлено оборудование системы и размещена схема его подключения. Использование KIT-набора вместе с ПО, которое можно скачать в разделе Программное обеспечение, дает возможность попробовать поработать с системами PERCo, изучить ее возможности и принять осознанное решение о приобретении системы.</p>
	<div class="link_img_center"><a href="/images/support/marketing3.jpg" title="Демонстрационный набор оборудования PERCo" data-sub-html="Демонстрационный набор оборудования PERCo" ><img src="/images/support/marketing3.jpg" alt="KIT-набор оборудования PERCo" class="center" /></a></div>
	<p>В комплект KIT входят: контроллер PERCo-CT/L-04, считыватели PERCo-IR03 и PERCo-IR04, датчик прохода, индикатор открытия исполнительного устройства, блок питания 12 В, розетка Ethernet для подключения ПК, информационная схема подключения оборудования.</p>
	<p>Для получения консультаций и демонстрационного KIT-набора обращайтесь к нашим партнерам в <a href="/gde-kupit/rossiya/?kit=Y#begin">России</a> и <a href="/gde-kupit/UA/">Украине</a>.</p>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>