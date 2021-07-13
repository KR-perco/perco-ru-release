<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Торговое представительство");
$APPLICATION->SetPageProperty("title", "Торговое представительство | PERCo");
$APPLICATION->SetPageProperty("description", "Компания PERCo приглашает торговых представителей к сотрудничеству");
$APPLICATION->SetPageProperty("keywords", "международное сотрудничество, представительство, представительство российских компаний, работа представительством");
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">
<head>
	<meta charset="<?=LANG_CHARSET;?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="robots" content="noyaca"/>
	<title><?$APPLICATION->ShowTitle()?></title>
<?$APPLICATION->ShowMeta("keywords");?>
<?$APPLICATION->ShowMeta("description");?>
<?$APPLICATION->ShowCSS();?>
<? if (defined("LANGUAGE_ID")) echo '<script type="text/javascript"> var LANGUAGE_ID="'.LANGUAGE_ID.'";</script>';?>
<? echo '<script type="text/javascript"> var device="'.$device.'";</script>';?>
<script type="text/javascript" src="/scripts/jquery.min.js"></script>
<script type="text/javascript" src="/scripts/url.min.js"></script>
<script type="text/javascript" src="/scripts/pages/partners.js "></script>

<link type="text/css" href="/scripts/lightgallery/css/lightgallery.min.css" rel="stylesheet">
<script type="text/javascript" src="/scripts/lightgallery/js/lightgallery.min.js"></script>
<link type="text/css" href="/scripts/lightslider/css/lightslider.min.css" rel="stylesheet"/>
<script type="text/javascript" src="/scripts/lightslider/js/lightslider.min.js"></script>
<script type="text/javascript" src="/scripts/lightgallery/js/lg-zoom.min.js"></script>

<?$APPLICATION->ShowHeadStrings();?>
<?$APPLICATION->ShowHeadScripts();?>

<script type="text/javascript" src="/scripts/perco-scripts.js"></script>
<?include_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/templates/analytics.php");?>
<?
if (LANGUAGE_ID == "en")
	echo '<script type="text/javascript" src="https://secure.leadforensics.com/js/66184.js" ></script>';
?>
</head>
<?$APPLICATION->SetAdditionalCSS("/css/cooperation.css");?>

<div id="container">
	<div class="width_all">
		<div class="banner_image"></div>
		<div class="banner_text">
			<div class="bleft">Главный офис PERCo</div>
			<div class="bright">Завод PERCo</div>
		</div>
	</div>
	<div id="content">
		<h1>Компания PERCo приглашает торговых представителей к сотрудничеству</h1>
		<p>Мы ищем торговых представителей, готовых продвигать оборудование PERCo за рубежом. Наша цель – расширение географии продаж.</p>

		<div class="blocks">
			<div class="left-block">
				<h2>Почему выбирают PERCo</h2>
				<p><a href="https://www.perco.ru/o-kompanii/">PERCo</a> — ведущий российский производитель систем и оборудования безопасности.</p>
				<ul>
					<li>30-летний опыт работы</li>
					<li>Продажи в 88 странах мира</li>
					<li>Современный завод</li>
					<li>Разветвленная дилерская сеть</li>
					<li>Бесплатное обучение партнеров и пользователей</li>
					<li>Склады готовой продукции в России и в ЕС (Голландия и Эстония)</li>
				</ul>
				
				<div style="margin: 25px 0;">
					<a target="_blank" style="background-color: #214288; border-radius: 2px; height: 32px; padding: 8px 20px; cursor: pointer; color: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); font-size: 19px;" href="https://www.perco.ru/">www.perco.ru</a>
				</div>

				<h2>Задачи торгового представителя</h2>
				<p>В задачи торгового представителя PERCo входит поиск потенциальных клиентов, презентация оборудования и компании, осуществление сделок и ведение отчетности.</p>
				<p>Мы ищем энергичных, вежливых, убедительных и ответственных специалистов. </p>

				<h2>Наше предложение</h2>
				<p>В свою очередь мы предлагаем интересную работу, обучение в офисе компании, общение со специалистами из разных областей, маркетинговую поддержку, участие в профильных выставках, командировки и постоянное развитие профессиональных навыков.</p>

				<div style="padding: 30px 0 0 0;">
					<h2>Продукция</h2>
					<p>Основной продукцией PERCo являются системы и оборудование контроля доступа:</p>
					<ul style="list-style-type:none; list-style-image: none; padding: 0px;" class="column">
						<li style="list-style-image:none; padding-left: 0px;">
							<span style="display: inline-block; margin-right: 10px; width:20px; background-image: none; height: 20px; vertical-align: middle;">
								<img src="/images/icons/menu/turnikety-menu.svg" alt="">
							</span>
							турникеты и калитки
						</li>
						<li style="list-style-image:none; padding-left: 0px;">
							<span style="display: inline-block; margin-right: 10px; width:20px; background-image: none; height: 20px; vertical-align: middle;">
								<img src="/images/icons/menu/ip-menu.svg" alt="">
							</span>
							электронные проходные
						</li>
						<li style="list-style-image:none; padding-left: 0px;">
							<span style="display: inline-block; margin-right: 10px; width:20px; background-image: none; height: 20px; vertical-align: middle;">
								<img src="/images/icons/menu/locks-menu.svg" alt="">
							</span>
							электромеханические замки
						</li>
						<li style="list-style-image:none; padding-left: 0px;">
							<span style="display: inline-block; margin-right: 10px; width:20px; background-image: none; height: 20px; vertical-align: middle;">
								<img src="/images/icons/menu/control-menu.svg" alt="">					
							</span>
							считыватели бесконтактных карт и картоприемники
						</li>
					</ul>
				</div>
			</div>
			<div class="right-block">		
				<div class="form-block">
					<h2>Как с нами связаться</h2>
					<p>Если Вас заинтересовало наше предложение, заполните краткую форму</p>
					<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "form", array(
						"WEB_FORM_ID" => "48",
						"IGNORE_CUSTOM_TEMPLATE" => "N",
						"USE_EXTENDED_ERRORS" => "N",
						"SEF_MODE" => "N",
						"SEF_FOLDER" => "",
						"CACHE_TYPE" => "A",
						"CACHE_TIME" => "3600",
						"LIST_URL" => "",
						"EDIT_URL" => "",
						"SUCCESS_URL" => "",
						"CHAIN_ITEM_TEXT" => "",
						"CHAIN_ITEM_LINK" => "",
						"VARIABLE_ALIASES" => array(
							"WEB_FORM_ID" => "WEB_FORM_ID",
							"RESULT_ID" => "RESULT_ID",
						)
						),
						false
					);?>
					<p>или присылайте резюме нам на почту <a href="mailto:export@perco.com">export@perco.com</a>, и мы с Вами свяжемся!</p>
				</div>

				<div id="horizontal_scroll">
					<ul id="scrollGallery">
						<li> <img  alt="Презентация" src="/images/products/tripod-turnstiles/ttr-08_page.jpg"> </li>
						<li> <img alt="Скоростные ворота" src="/images/products/speed-gate/slider-product/st-01_06_page.jpg"> </li>
						<li> <img alt="Просмотр учетных данных сотрудника" src="/images/products/full-height-solutions/slider-product/rtd-16s_01_page.jpg"> </li>
						<li> <img alt="Калитка автоматическая WMD-05S со створкой AG-650 для помещений" src="/images/products/kalitki/wmd-05_02_page.jpg"> </li>
						<li> <img alt="Врезной электромеханический замок LBP85.1" src="/images/products/electronic-locks/lbp85.1_page.jpg"> </li>
						<li> <img alt="Бесконтактный считыватель IR04" src="/images/products/readers/ir04_page.jpg"> </li>
						<li> <img alt="Выдача карты доступа сотруднику" src="/images/products/railings-systems/product-slider/bh06_01.jpg"> </li>
					</ul>
				</div>

			</div>
		</div>
	</div>
</div>