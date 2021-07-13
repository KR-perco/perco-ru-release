<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Порядок приобретения ПО PERCo-Web", "");
$APPLICATION->SetPageProperty("title", "Порядок получения ПО PERCo-Web | PERCo");
$APPLICATION->SetPageProperty("description", "Форма online-заявки на получение программного обеспечения PERCo-Web");
$APPLICATION->SetPageProperty("keywords", "комплексные системы безопасности, турникеты, калитки, ограждения, пэрко, perco");
$APPLICATION->SetTitle("Порядок получения права  использования PERCo-Web ");

$APPLICATION->SetAdditionalCSS("/css/priobretenie-licenzii.css"); // подключение стилей
?>

<div id="content">
	<h1>
	  <?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Программное обеспечение системы PERCo-Web (далее - ПО) можно использовать в ознакомительном режиме в течение 60 дней. Для продолжения эксплуатации:</p>
	<ul>
		<li>приобретите требуемый вам комплект ПО (за исключением бесплатного ПО «Базовый пакет ПО»)</li>
		<li>получите свидетельство на право использования</li>
		<li>внесите коды активации, указанные в свидетельстве</li>
	</ul>
	<p>По истечении 60-ти дневного срока, без внесенных кодов активации запуск ПО будет невозможен.</p>
	<p>Для получения кода активации необходимо сделать следующее:</p>
	<ol>
		<li>Определить необходимый комплект модулей ПО</li>
		<li>Оплатить счет на необходимый комплект модулей ПО (кроме бесплатного ПО PERCo-WB «Базовый пакет ПО»)</li>
		<li>Определить МАС – адрес контроллера СКУД, который будет выполнять функцию электронного ключа защиты – это может быть любой из установленных контроллеров системы</li>
		<li>Заполнить бланк заявки на получение свидетельства (бланк заявки входит также в состав дистрибутива ПО PERCo-Web)</li>
		<li>Отправить заполненный бланк в отдел продаж PERCo</li>
		<li>По e-mail в ваш адрес будет отправлен файл свидетельства, содержащий коды активации. </li>
		<li>Коды активации, указанные в свидетельстве , необходимо внести во вкладку «Лицензии» в разделе «Администрирование»</li>
	</ol>
	<p>Более подробная информация о порядке внесения кодов активации в программное обеспечение PERCo-Web приведена в руководстве администратора.</p>
	<h2>Заявка на получение права на использование программмного обеспечения PERCo-Web</h2>
	<div class="otstupForm">
<?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"",
	Array(
		"WEB_FORM_ID" => "70",
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