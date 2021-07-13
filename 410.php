<?
define("LANGUAGE_ID", "ru");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->SetAdditionalCSS("/css/404.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/nashi-klienty.js"); // подключение скриптов
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/404.css">
	<script type="text/javascript" src="https://rentafont.com/javascripts/webfonts.js"></script>
	<script type="text/javascript">
	WebFontConfig = {
		id: 'MzIxMG9yZGVyMjIw',
		fonts: [/*'Futura PT Book'*/'648', /*'Futura PT Demi'*/'649'],
		by_style: 1
	};
	</script>
</head>
<body>
	<div id="container">
		<div id="top-block">
			<h1>СТРАНИЦА УДАЛЕНА</h1>
			<p>Приносим свои извинения, но страница с таким адресом удалена.</p>
		</div>
		<div id="line"></div>
		<div>
			<div class="main_block">
				<div>
					<p><b>Пожалуйста, воспользуйтесь одним из вариантов</b></p>
					<ul>
						<li>Перейти на <a href="/">Главную</a> страницу.</li>
						<li>Воспользуйтесь поиском:
							<div id="search">
<? $APPLICATION->IncludeComponent("bitrix:search.form", "perco_search", array(
	"PAGE" => "/search.php",
	"USE_SUGGEST" => "N"
	),
	false);
?>
							</div>
						</li>
						<li>Откройте <a href="/karta-sayta.php">Карту сайта</a> и выберите нужную Вам страницу.</li>
					</ul>
				</div>
				<div class="qr-code_contacts">

<?

$file = file_get_contents('contacts.json'); // Открыть файл
$contacts = json_decode($file, true); // Декодировать в массив
unset($file); // Очистить переменную $file
?>

<?//$APPLICATION->IncludeComponent("altasib:qrcode", ".default", array(
	// "QR_TYPE_INF" => "VCARD",
	// "QR_VC_FNAME" => "PERCo Системы безопасности",
	// "QR_VC_LNAME" => "",
	// "QR_VC_TEL" => "8-800-333-52-53",
	// "QR_VC_EMAIL" => "market@perco.ru",
	// "QR_VC_COMPANY" => "",
	// "QR_VC_TITLE" => "",
	// "QR_VC_ADR" => "",
	// "QR_VC_URL" => "https://www.perco.ru/",
	// "QR_VC_NOTE" => "Системы безопасности, электромеханические турникеты и замки, электронные проходные",
	// "QR_SIZE_VAL" => "2",
	// "QR_ERROR_CORECT" => "L",
	// "QR_SQUARE" => "2",
	// "QR_COLOR" => "00225B",
	// "QR_COLORBG" => "FFFFFF",
	// "QR_MINI" => "",
	// "QR_COPY" => "N",
	// "QR_TEXT" => "",
	// "QR_DEL_CHACHE" => "Y",
	// "CACHE_TYPE" => "A",
	// "CACHE_TIME" => "2592000"
	// ),
	// false
	// );
?>
					<div id="contacts">
						<p><b>Tel</b><span>: 8-800-333-52-53</span></p>
						<p><b>e-mail</b><span>: <a href="mailto:mail@perco.ru>">mail@perco.ru</a></span></p>
						<!-- <p><b>Tel</b><span>: <?echo $contacts[phone]?></span></p>
						<p><b>e-mail</b><span>: <a href="mailto:<?echo $contacts[email]?>"><?echo $contacts[email]?></a></span></p> -->
					</div>
				</div>
			</div>
			<div class="first_block">
				<div class="product_item">
					<img src="/images/icons/turnstile.svg" alt="Турникеты, калитки, ограждения">
					<div class="item_name">
						<a href="/products/turnikety-kalitki-ograzhdeniya/">Турникеты, калитки, ограждения</a>
					</div>
				</div>
				<div class="product_item">
					<img src="/images/icons/ip-stiles.svg" alt="Электронные проходные">
					<div class="item_name">
						<a href="/products/elektronnye-prokhodnye/">Электронные проходные</a>
					</div>
				</div>
				<div class="product_item">
					<img src="/images/icons/locks.svg" alt="Электромеханические замки">
					<div class="item_name">
						<a href="/products/elektromekhanicheskie-zamki/">Электромеханические замки</a>
					</div>
				</div>
				<div class="product_item">
					<img src="/images/icons/kontrollery.svg" alt="Контроллеры и считыватели">
					<div class="item_name">
						<a href="/products/kontrollery-schityvateli/">Контроллеры и считыватели</a>
					</div>
				</div>
				<div class="product_item">
					<img src="/images/icons/ksb-s-20.svg" alt="Комплексная система безопасности PERCo-S-20">
					<div class="item_name ">
						<a href="/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/">Комплексная система безопасности PERCo-S-20</a>
					</div>
				</div>
				<div class="product_item">
					<img src="/images/icons/skd-web.svg" alt="Система контроля доступа PERCo-Web">
					<div class="item_name ">
						<a href="/products/sistema-kontrolya-dostupa-perco-web/">Система контроля доступа PERCo-Web</a>
					</div>
				</div>
			</div>
			<div class="two_block">
				<a href="/resheniya/">Решения</a>
				<a href="/novosti/">Новости</a>
				<a href="/gde-kupit/">Купить</a>
				<a href="/obuchenie/">Обучение</a>
				<a href="/podderzhka/">Поддержка</a>
				<a href="/o-kompanii/">О компании</a>
			</div>
		</div>
	</div>
</body>