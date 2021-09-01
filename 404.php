<?
define("LANGUAGE_ID", "ru");
$sapi_type = php_sapi_name();
if ($sapi_type=="cgi")
	header("Status: 404");
else
	header("HTTP/1.1 404 Not Found");
@define("ERROR_404","Y");
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
$APPLICATION->SetTitle("404 - Страница не найдена");

$APPLICATION->SetAdditionalCSS("/css/404.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/nashi-klienty.js"); // подключение скриптов
?>
<?
$file = file_get_contents('./contacts.json'); // Открыть файл
$contacts = json_decode($file, true); // Декодировать в массив
unset($file); // Очистить переменную $file
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="/css/404.css">
</head>
<body>
	<div id="container">
		<div id="top-block">
			<h1>СТРАНИЦА НЕ НАЙДЕНА</h1>
			<p>Приносим свои извинения, но страница с таким адресом не найдена.<br />Возможно, она временно недоступна, удалена или её адрес был изменен.</p>
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



				
<?//$APPLICATION->IncludeComponent("altasib:qrcode", ".default", array(
	// "QR_TYPE_INF" => "VCARD",
	// "QR_VC_FNAME" => "PERCo Системы безопасности",
	// "QR_VC_LNAME" => "",
	// "QR_VC_TEL" => "$contacts[phone]",
	// "QR_VC_EMAIL" => "$contacts[email]",
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
					<a href="/products/turnikety/">
						<img src="/images/icons/turnstile.svg" alt="Турникеты">
						<div class="item_name">Турникеты
						</div>
					</a>
				</div>
				<div class="product_item">
					<a href="/products/elektronnye-prokhodnye/">
						<img src="/images/icons/ip-stiles.svg" alt="Электронные проходные">
						<div class="item_name">Электронные проходные
						</div>
					</a>
				</div>
				<div class="product_item">
					<a href="/products/elektromekhanicheskie-zamki/">
						<img src="/images/icons/locks.svg" alt="Электромеханические замки">
						<div class="item_name">Электромеханические замки
						</div>
					</a>
				</div>
				<div class="product_item">
					<a href="/products/kontrollery-schityvateli/">
						<img src="/images/icons/kontrollery.svg" alt="Контроллеры и считыватели">
						<div class="item_name">Контроллеры и считыватели
						</div>
					</a>
				</div>
				<div class="product_item">
					<a href="/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/">
						<img src="/images/icons/ksb-s-20.svg" alt="Комплексная система безопасности PERCo-S-20">
						<div class="item_name ">Комплексная система безопасности PERCo-S-20
						</div>
					</a>
				</div>
				<div class="product_item">
					<a href="/products/sistema-kontrolya-dostupa-perco-web/">
						<img src="/images/icons/skd-web.svg" alt="Система контроля доступа PERCo-Web">
						<div class="item_name ">Система контроля доступа PERCo-Web
						</div>
					</a>
				</div>
			</div>
			<div class="two_block">
				<a href="/resheniya/">Решения</a>
				<a href="/novosti/">Новости</a>
				<a href="/gde-kupit/">Купить</a>
				<a href="/obuchenie/">Подготовка специалистов</a>
				<a href="/podderzhka/">Поддержка</a>
				<a href="/o-kompanii/">О компании</a>
			</div>
		</div>
	</div>
</body>
