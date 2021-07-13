<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Обучение | PERCo");
$APPLICATION->SetPageProperty("keywords", "обучение специалистов по безопасности, скуд, контроль доступа, системы безопасности, обучающие семинары по безопасности");
$APPLICATION->SetPageProperty("description", "PERCo проводит обучающие семинары для пользователей и партнеров ");
$APPLICATION->SetTitle("Обучение");

$APPLICATION->SetAdditionalCSS("/css/obuchenie.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/obuchenie.js"); // подключение скриптов
?>
<div class="width_all">
	<div class="banner_image"></div>
</div>
<div id="content">
	<h1> <?$APPLICATION->ShowTitle(false, false)?> </h1>
	<div id="obuchenie">
		<div class="about_obuchenie">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"page_menu",
	Array(
		 "ROOT_MENU_TYPE" => "podmenu", 
		 "MAX_LEVEL" => "1", 
		 "CHILD_MENU_TYPE" => "", 
		 "USE_EXT" => "Y" 
	 )
);?>

			<p>Учебный центр PERCo организует на регулярной основе бесплатные семинары для пользователей систем, проектных организаций и партнеров компании.</p> 
			<p>Обучение проводится в оборудованном учебном классе Санкт-Петербурга, а также в формате интернет-семинаров.</p>
			<p>Индивидуальные стенды в учебных классах позволяют участникам семинара моделировать различные ситуации работы оборудования. Программное обеспечение выводится с компьютера преподавателя на экран и дублируется на мониторах участников.</p>
			<p>Программы обучения рассчитаны на пользователей систем:</p>
			<ul>
				<li>IT-специалистов</li>
				<li>Специалистов инженерных и эксплуатационных служб</li>
				<li>Руководителей и сотрудников службы безопасности</li>
				<li>Сотрудников отдела персонала и бухгалтерии</li>
			</ul>
			<p>Для партнеров PERCo разработаны специальные программы обучения и сертификации:</p>
			<ul>
				<li>Инсталлятор систем PERCo</li>
				<li>Торговый партнер PERCo</li>
			</ul>
			<p>По итогам обучения есть возможность пройти серию тестов и получить именное свидетельство, подтверждающее квалификацию инсталлятора или администратора систем безопасности PERCo.</p>
			<p>Также возможна организация выездных семинаров в регионах.</p>
			<p>Для самостоятельного изучения систем безопасности PERCo созданы видеоинструкции.</p>
			<p>Приглашаем всех желающих пройти обучение. Для записи на семинары обращайтесь в учебный центр PERCo <a href="mailto:seminar@perco.ru">seminar@perco.ru</a>.</p>

		</div>

		<div id="authorized">
<?
$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"authorized",
	Array(
		"REGISTER_URL" => "/client/registration/",
		"FORGOT_PASSWORD_URL" => "/client/",
		"PROFILE_URL" => "",
		"SHOW_ERRORS" => "Y"
	),
false
);
echo '<div id="forgot_password" style="display: none;">';
$APPLICATION->IncludeComponent("bitrix:system.auth.forgotpasswd","",Array());
echo '</div>';
?>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>