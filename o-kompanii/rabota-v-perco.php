<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Работа в PERCo", "");
$APPLICATION->SetPageProperty("title", "Работа в компании PERCo");
$APPLICATION->SetPageProperty("description", "Свою карьеру Вы сможете развивать в Санкт-Петербурге, где находится штаб-квартира компании, или в Пскове, где действует завод PERCo - одно из самых современных предприятий Северо-Запада");
$APPLICATION->SetPageProperty("keywords", "вакансии, работа, пэрко");
$APPLICATION->SetTitle("Работа в PERCo");

$APPLICATION->SetAdditionalCSS("/css/rabota-v-perco.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/sotrudnichestvo.js"); // подключение скриптов
?>
<div class="width_all">
	<div class="banner_image"></div>
	<div class="banner_text">
		<div class="bleft">Главный офис PERCo</div>
		<div class="bright">Завод PERCo</div>
	</div>
</div>
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Компания PERCo – лидер российского рынка безопасности. Наша команда состоит из высококвалифицированных специалистов, работающих в различных сферах деятельности: разработках программного обеспечения, электроники, конструировании, опытном и серийном производстве, продажах, логистике, рекламе, маркетинговых исследованиях, обучении, экономике производства. Количество сотрудников PERCo превышает 500 человек.</p>
	<p>Мы активно развиваемся и нацелены на привлечение в нашу команду высокопрофессиональных и талантливых людей. Мы предлагаем интересную работу, конкурентоспособную заработную плату, стабильность и комфортные условия труда. Мы стремимся к тому, чтобы наши сотрудники гордились тем, что они работают в одной из лучших российских компаний.</p>
	<p>Свою карьеру Вы сможете развивать в Санкт-Петербурге, где находится штаб-квартира компании, или в Пскове, где действует завод PERCo – одно из самых современных предприятий Северо-Запада.</p>
	<h2>Компания приглашает на работу</h2>
	<div id="vacancies">
		<div>
			<p><strong> в Санкт-Петербурге:</strong></p>
			<ul>
				<li>Программистов микроконтроллеров С/С++</li>  
				<li>Android Разработчиков</li>
				<li>Frontend Разработчиков</li>
				<li>Инженеров по тестированию ПО</li> 
				<li>Инженеров по технической поддержке</li>
			</ul>
		</div>
		<div>
			<p><strong>в Пскове:</strong></p>
			<ul>
				<li>Диспетчеров производства</li>
				<li>Инженеров по нормированию труда</li>
				<li>Инженеров-технологов</li> 
				<li>Кладовщиков-комплектовщиков</li> 
				<li>Контролеров службы технического контроля</li> 
				<li>Менеджеров по планированию</li> 
				<li>Регулировщиков РЭАиП</li> 
				<li>Слесарей-ремонтников</li> 
				<li>Слесарей-сборщиков</li> 
				<li>Шлифовщиков</li> 
				<li>Экономистов по труду</li> 
			</ul>
		</div>
	</div>
	<p>Если вы готовы ставить перед собой серьезные цели и добиваться результатов, цените в людях профессионализм и ответственность, мы будем рады рассмотреть Вашу кандидатуру. Присылайте свое резюме или портфолио по адресу: <a href="mailto:ok@perco.ru">ok@perco.ru</a> или обращайтесь по телефону +7 (812) 247-04-51.</p>
	<p><a href="svodnye-dannye-o-rezultatakh-provedeniya-spetsialnoy-otsenki-usloviy-truda.php" rel="nofollow" class="link">Сводные данные</a> о результатах проведения специальной оценки условий труда.</p>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
