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

			<p>Для удобства пользователей систем, проектных организаций и партнеров Учебный центр PERCo* организует бесплатное обучение.</p> 
			<p>Обучение подразумевает возможность ознакомиться с характеристиками, возможностями, порядком монтажа, конфигурации и пусконаладки систем и оборудования PERCo, а также получить консультацию специалистов компании.</p>
			<p>Обучение проходит в очной и дистанционной формах. Получить практические навыки во время очного обучения позволяют демонстрационные стенды с установленным оборудованием и программным обеспечением.</p>
			<p>На сайте размещен полный комплекс материалов для самостоятельного изучения: подробные видеоинструкции, демоверсии программного обеспечения, документация, раздел «Часто задаваемые вопросы». Доступны консультации специалистов в том числе и в формате вебинаров.</p>
			<p>Проверить степень освоения материала можно с помощью тестов для администраторов систем, инсталляторов, специалистов сервисных центров и менеджеров по продажам.<br>По результатам тестирования можно получить сертификат.</p>
			
			<p>Обучение будет полезно:</p>
			<ul>
				<li>IT-специалистам</li>
				<li>Специалистам инженерных и эксплуатационных служб</li>
				<li>Руководителям и сотрудникам службы безопасности</li>
				<li>Сотрудникам отдела персонала и бухгалтерии</li>
				<li>Менеджерам по продажам</li>
				<li>Инсталляторам</li> 
			</ul> 
			<p>Возможна организация выездного обучения в регионах.</p> 
			<p>Приглашаем всех желающих, для записи обращайтесь в Учебный центр PERCo <a href="mailto:seminar@perco.ru">seminar@perco.ru</a>.</p>
			<p>*Учебный центр не является образовательным учреждением.</p> 

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