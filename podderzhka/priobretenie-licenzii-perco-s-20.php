<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Порядок получения права использования PERCo-S-20 и PERCo-S-20 Школа", "");
$APPLICATION->SetPageProperty("title", "Порядок получения ПО системы безопасности S-20 | PERCo");
$APPLICATION->SetPageProperty("description", "Форма online-заявки на получение права использования программного обеспечения системы безопасности S-20");
$APPLICATION->SetPageProperty("keywords", "комплексные системы безопасности, турникеты, калитки, ограждения, пэрко, perco");
$APPLICATION->SetTitle("Порядок получения права использования PERC<span style='text-transform:lowercase;'>o</span>-S-20 и PERC<span style='text-transform:lowercase;'>o</span>-S-20 Школа");

$APPLICATION->SetAdditionalCSS("/css/priobretenie-licenzii.css"); // подключение стилей
?>

<div id="content">
	<h1>
	  <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>После установки программного обеспечения системы безопасности PERCo-S-20 (далее – ПО) на компьютер пользователя, ПО можно использовать в ознакомительном режиме в течение 30 дней. Для продолжения эксплуатации программного обеспечения необходимо приобрести требуемый вам комплект ПО, получить свидетельство на право использования ПО системы безопасности (базового ПО и необходимых вам модулей) и внести в ПО коды активации. По истечении 30-ти дневного срока, без внесенных в ПО кодов активации запуск ПО системы безопасности будет невозможен.</p>
	<p>Для получения свидетельства необходимо сделать следующее:</p>
	<ol>
		<li>Определить необходимый комплект модулей ПО для организации контроля доступа (Помощь в выборе комплектов программного обеспечения системы безопасности S-20).</li>
		<li>Оплатить счет на необходимый комплект модулей ПО</li>
		<li>Определить МАС – адрес контроллера СКУД, который будет выполнять функцию электронного ключа защиты ПО – это может быть любой из установленных контроллеров комплексной системы безопасности.</li>
		<li>Заполнить бланк заявки на получение свидетельства (бланк заявки входит также в состав дистрибутива ПО PERCo-S-20).</li>
		<li>Отправить заполненный бланк в отдел продаж PERCo. </li>
		<li>По e-mail в ваш адрес будет отправлен файл свидетельства, содержащий коды активации ПО.</li>
		<li>Коды активации, указанные в свидетельстве, необходимо внести во вкладку «Управление лицензиями» в разделе «Центр управления PERCo-S-20», входящем в состав PERCo-SN01 «Базовое ПО».</li>
	</ol>
	<p>Более подробная информация о порядке внесения кодов активации в программное обеспечение системы безопасности PERCo-S-20 приведена в Руководстве администратора Базового ПО PERCo-SN01.</p>
	<h2>Заявка на получение права на использование программного обеспечения системы безопасности PERCo-S-20</h2>
	<div class="otstupForm">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"",
	Array(
		"WEB_FORM_ID" => "4",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"USE_EXTENDED_ERRORS" => "N",
		"SEF_MODE" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"LIST_URL" => "",
		"EDIT_URL" => "",
		"SUCCESS_URL" => "",
		"CHAIN_ITEM_TEXT" => "",
		"CHAIN_ITEM_LINK" => "",
		"VARIABLE_ALIASES" => Array(
			"WEB_FORM_ID" => "WEB_FORM_ID",
			"RESULT_ID" => "RESULT_ID"
		)
	)
);?>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>