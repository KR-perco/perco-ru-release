<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Проверка знаний", "");
$APPLICATION->SetPageProperty("title", "Программа проверки знаний «Администратор системы PERCo»");
$APPLICATION->SetPageProperty("keywords", "");
$APPLICATION->SetPageProperty("description", "Программа проверки знаний «Администратор системы PERCo»");
$APPLICATION->SetTitle("Программа проверки знаний «Администратор системы PERC<span style='text-transform:lowercase;'>o</span>»");

$APPLICATION->SetAdditionalCSS("/css/proverka-znaniy.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/proverka-znaniy.js"); // подключение скриптов
?>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<h2>Описание программы</h2>
	<div class="right"><a href="/download/e-learning/sertificat_as.pdf" title="Пример свидетельства" target="_blank" onclick="ga('send', 'event', {'eventCategory': 'Информация', 'eventAction': 'download', 'eventLabel': '/download/e-learning/sertificat_as.pdf'});" download><img src="/images/e-learning/sertificat_as.jpg" /></a><br />Пример свидетельства</div>
	<p>Программа адресована компаниям, использующим системы и оборудование PERCo для целей безопасности и учета рабочего времени сотрудников собственного предприятия. Программа проверки знаний «Администратор систем PERCo» позволяет получить углубленные знания для работы с системами PERCo и закрепить их выполнением теоретических и практических заданий. По окончании программы обучения в случае успешного выполнения заданий сотрудник получит именное свидетельство «Администратор систем PERCo».</p>
	<h2>Этапы прохождения программы</h2>
	<p><b class="head_b">Регистрация компании и сотрудника</b></p>
	<p>Программа проверки знаний администраторов систем PERCo – это online сервис сайта PERCo. Для получения доступа к программе, необходимо зарегистрировать компанию и сотрудника.</p>
	<p><b class="head_b">Тестирование в режиме online</b></p>
	<ul>
		<li><b>Теоретическая часть.</b> Теоретические экзамены представляют собой тесты. Один из них содержит варианты ответов, другой предполагает самостоятельные ответы в свободной форме. В каждом задании 10 вопросов.</li>
		<li><b>Практическая часть.</b> Для выполнения первого практического задания необходимо оборудование систем безопасности S-20 (контроллер СКУД PERCo-CT/L04 со считывателями). Тест насчитывает 30 заданий по изменению настроек оборудования, работы с данными сотрудников и т.д.<br />Работа со вторым практическим заданием подразумевает перенастройку уже существующей базы данных ПО PERCo-S-20 по заданным параметрам, не требует оборудования. Тест содержит 15 заданий.</li>
	</ul>
	<p><b class="head_b">Получение свидетельства</b><p>
	<p>Именное свидетельство доступно для скачивания через 24 часа после успешного прохождения всех тестов.</p>
	<p><img class="icon" src="/images/icons/pdf.svg"><a href="/download/e-learning/instuction_as.pdf" title="Инструкция по регистрации в программе" target="_blank" download>Инструкция по регистрации в программе</a> <span class="color">(<?=printFileInfo("/download/e-learning/instuction_as.pdf", "size");?>) &mdash; <?=printFileInfo("/download/e-learning/instuction_as.pdf", "date");?></span></p>
	<p><a class="auth" href="/client/"><button>Начать тестирование</button></a></p>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
