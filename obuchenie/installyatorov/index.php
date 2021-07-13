<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
if ($_REQUEST["month"] == date("m") && $_REQUEST["year"] == date("Y"))
	$APPLICATION->AddHeadString('<link href="//'.$_SERVER["HTTP_HOST"].'/obuchenie/installyatorov/" rel="canonical" />',true);
$APPLICATION->SetPageProperty("title","Обучение партнеров | PERCo");
$APPLICATION->SetPageProperty("description","PERCo разработала и проводит цикл обучающих семинаров для торговых и монтажных компаний");
$APPLICATION->SetPageProperty("keywords","обучение, обучающие семинары безопасности, обучение специалистов по безопасности");
$APPLICATION->SetTitle("Обучение партнеров");

$APPLICATION->SetAdditionalCSS("/css/instal.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/instal.js"); // подключение скриптов
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
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
<?
	$APPLICATION->IncludeComponent("perco:learning.calendar","learning",Array(
		"AJAX_MODE" => "N", 
		"IBLOCK_TYPE" => "edu", 
		"IBLOCK_ID" => "46", 
		"MONTH_VAR_NAME" => "month", 
		"YEAR_VAR_NAME" => "year", 
		"WEEK_START" => "1", 
		"DATE_FIELD" => "DATE_ACTIVE_TO", 
		"TYPE" => "EVENTS", 
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
	);
?>
	<p>Компания PERCo заинтересована в предоставлении качественного сервиса своими торговыми и монтажными партнерами, поэтому серьезное внимание уделяется обучению специалистов этих компаний. В рамках комплексной программы PERCo проводит ряд обучающих семинаров, как для торговых, так и для монтажных компаний.</p>
	<h2>Программа для инсталляторов</h2>
	<p>Курс обучения «Инсталлятор систем PERCo» позволяет получить углубленные знания для работы с системами безопасности PERCo и закрепить их выполнением теоретических и практических заданий.</p>
	<p>Цель курса - познакомить слушателей с основными этапами построения систем безопасности на основе систем PERCo и дать практические навыки по настройке систем и работе с ними.</p>
	<p>Существует возможность самостоятельно изучать системы безопасности PERCo с помощью видеоинструкций и технической документации, которые находятся в разделе сайта Самостоятельное обучение.</p>
	<h2>Программа для торговых партнеров</h2>
	<p>Курс обучения «Торговый партнер PERCo» позволяет получить необходимые знания для квалифицированной консультации клиентов по всему перечню продукции PERCo.</p>
	<p>Цель курса - познакомить слушателей с основными товарными группами PERCo, дать возможность корректно подбирать необходимое оборудование под требования клиента и предоставить общее представление о комплексных системах PERCo.</p>
	<h2>Сертификация</h2>
	<p>По окончании программы курсов можно пройти необходимые тесты и при успешном выполнении получить именное свидетельство сертифицированного партнера PERCo».</p>
	<p>В дальнейшем компания, которая занимается установкой систем безопасности PERCo, имеющей в штате двух специалистов с именным свидетельством «Авторизованный инсталлятор PERCo» может быть предоставлен статус «Авторизованный инсталлятор PERCo» и выдан сертификат, подтверждающий этот статус.</p>
	<p>Торговым компаниям, удовлетворяющим требованиям статуса Сертифицированный торговый партнер также будет предоставлен соответствующий статус.</p>
	<p>Для специалистов, уже обладающих необходимыми знаниями по системам безопасности PERCo, есть возможность пройти тестирование экстерном.</p>
	<p>Координаты авторизованных инсталляторов и сертифицированных торговых партнеров  будут размещены в разделе сайта «Где купить», как компаний, рекомендованных PERCo.</p>
	<p><img class="icon" src="/images/icons/pdf.svg"><a target="_blank" href="/download/e-learning/learning_system_authorized_installers.pdf" onclick="ga('send', 'event', {'eventCategory': 'Информация', 'eventAction': 'download', 'eventLabel': '/download/e-learning/learning_system_authorized_installers.pdf'});" download>Программа обучения и сертификации «Авторизованный инсталлятор PERCo»</a> <span class="color">(<?=printFileInfo("/download/e-learning/learning_system_authorized_installers.pdf", "size");?>) &mdash; <?=printFileInfo("/download/e-learning/learning_system_authorized_installers.pdf", "date");?></span></p>
	<h2>Система обучения  для инсталляторов</h2>
	<div id="sistema-instal">
		<div>
			<div class="box">Получение базовых знаний<br />
			  <a href="/obuchenie/installyatorov/vebinary.php" >Ознакомительные интернет-семинары</a></div>
			<div class="box">Получение углубленных знаний<br />
			  Программа инсталлятор PERCo-S-20 </div>
		</div>
		<div class="obuch-strelka2"></div>
		<div>
			<div class="box">– <a href="/obuchenie/installyatorov/ochnye-seminary.php" >Очные семинары в учебном центре</a><br />
			  – <a href="/obuchenie/installyatorov/vyezdnye-seminary.php" >Выездные семинары</a></div>
			<div class="box"><a href="/obuchenie/installyatorov/vebinary.php" >Интернет-семинары с углубленным изучением</a></div>
		</div>
		<div class="obuch-strelka1"></div>
		<div class="box">Сертификация <br /><a href="/obuchenie/installyatorov/sertifikatsiya.php" >Этапы и примеры</a></div>
		<div class="obuch-strelka3"></div>
		<div>
			<div class="box lightgallery"><a href="/images/e-learning/ekzam1.png" data-sub-html="Допуск на теоретический экзамен" title="Допуск на теоретический экзамен" >Пример теоретического экзамена</a></div>
			<div class="box lightgallery"><a href="/images/e-learning/ekzam2.png" data-sub-html="Практический тест - настройка базы данных" title="Практический тест - настройка базы данных" >Пример практического экзамена</a></div>
		</div>
		<div class="obuch-strelka1"></div>
		<div class="box"><a href="/download/e-learning/sertificat_example.pdf" target="_blank" title="Свидетельство авторизованного инсталлятора" onclick="ga('send', 'event', {'eventCategory': 'Информация', 'eventAction': 'download', 'eventLabel': '/download/e-learning/sertificat_example.pdf'});" download>Свидетельство<br />«Авторизованный инсталлятор PERCo»</a></div>
	</div>
	
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".lightgallery").lightGallery({
            zoom: true,
            download: false,
        }

        );
    });
</script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>