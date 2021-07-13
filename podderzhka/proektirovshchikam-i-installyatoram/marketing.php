<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Маркетинговая поддержка партнеров", "");
$APPLICATION->SetPageProperty("title", "Маркетинговая поддержка партнеров | PERCo");
$APPLICATION->SetPageProperty("description", "Для удобства проектировщиков и инсталляторов PERCo предлагает полный комплект инструментов: библиотека моделей ArchiCAD, библиотека моделей AutoCAD, схемы подключения оборудования и программа 3D-визуализации проходных");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Маркетинговая поддержка партнеров");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей

?>
<div class="marketing" id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Маркетинговая поддержка партнеров" src="/images/icons/marketing.svg" />
	</div>

	<div class="description">
		<p>Компания PERCo осуществляет маркетинговую поддержку партнеров – предоставляет <a href="#katalogi-i-buklety">комплекты рекламных материалов</a>, <a href="#plakaty">плакаты</a>, <a href="#presentacii">презентации</a>, <a href="#logo">логотип</a>, <a href="#foto">фотографии высокого разрешения</a>, <a href="#obuchenie">организует обучение</a>.</p>
	</div>

	<!--div class="two_blocks" id="vystavka">
		<div class="image">
			<img src="/images/support/marketing0.jpg" alt="">
		</div>
		<div class="right">
			<h3>Мобильное приложение PERCo</h3>
			<p>Мобильное приложение представляет собой интерактивный каталог оборудования, доступный как в online так и в offline режимах.</p>
			<div style="display: flex;">
				<div class="download_item" style="margin-right: 20px;">
					<div class="icon"><img alt="Иконка" src="/images/icons/apple.svg"></div>
					<div><a href="https://itunes.apple.com/us/app/perco-%D0%BA%D0%B0%D1%82%D0%B0%D0%BB%D0%BE%D0%B3-%D0%BF%D1%80%D0%BE%D0%B4%D1%83%D0%BA%D1%86%D0%B8%D0%B8/id1455947707?mt=8" target="_blank" >Скачать</a></div>
				</div>
				<div class="download_item">
					<div class="icon"><img alt="Иконка" src="/images/icons/android.svg"></div>
					<div><a href="https://play.google.com/store/apps/details?id=ru.perco.app" target="_blank">Скачать</a></div>
				</div>
			</div>
		</div>
	</div-->
	<div class="two_blocks" id="katalogi-i-buklety">
		<div class="left">
			<h3>Каталоги и буклеты</h3>
			<p>По запросу партнеров предоставляется необходимое количество каталогов, буклетов. Подробнее ознакомиться с ассортиментом и содержанием печатной продукции можно в разделе <a href="/podderzhka/katalogi-i-buklety.php">Каталоги и буклеты</a>.</p>
			<a href="#feedback"><input style="text-decoration: none;" type="submit" name="web_form_submit" value="отправить заявку"></a>
		</div>
		<div class="image">
			<img src="/images/support/marketing4.jpg" alt="">
		</div>
	</div>
	<div class="two_blocks" id="presentacii">
		<div class="image">
			<img src="/images/support/marketing6.jpg" alt="">
		</div>
		<div class="right">
			<h3>Презентации</h3>
			<p>Для удобства демонстрации возможностей продукции PERCo и предоставления информации о производителе можно скачать презентации в формате pdf:</p>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="/images/icons/pdf.svg"></div>
				<div>
					<a href="/download/presentation/oborudovanie-i-sistemi-bezopasnosti.pdf" target="_blank" download>Оборудование и системы безопасности</a>
					<span class="color"><br>(<?=round(filesize('/home/d/dc178435/public_html/download/presentation/oborudovanie-i-sistemi-bezopasnosti.pdf') / 1048576, 2);?>&nbsp;MB)&nbsp; — <?= date('d.m.Y', filemtime('/home/d/dc178435/public_html/download/presentation/oborudovanie-i-sistemi-bezopasnosti.pdf')) ?></span>
				</div>
			</div>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="/images/icons/pdf.svg"></div>
				<div>
					<a href="/download/presentation/kak-vibrat-turniket.pdf" target="_blank" download>Как выбрать турникет</a>
					<span class="color"><br>(<?=round(filesize('/home/d/dc178435/public_html/download/presentation/kak-vibrat-turniket.pdf') / 1048576, 2);?>&nbsp;MB)&nbsp; — <?= date('d.m.Y', filemtime('/home/d/dc178435/public_html/download/presentation/kak-vibrat-turniket.pdf')) ?></span>
				</div>
			</div>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="/images/icons/pdf.svg"></div>
				<div>
					<a href="/download/presentation/dlya-proektirovshikov.pdf" target="_blank" download>Проектирование на основе оборудования PERCo</a>
					<span class="color"><br>(<?=round(filesize('/home/d/dc178435/public_html/download/presentation/dlya-proektirovshikov.pdf') / 1048576, 2);?>&nbsp;MB)&nbsp; — <?= date('d.m.Y', filemtime('/home/d/dc178435/public_html/download/presentation/dlya-proektirovshikov.pdf')) ?></span>
				</div>
			</div> 
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="/images/icons/pdf.svg"></div>
				<div><a href="/download/presentation/new-products.pdf" target="_blank" download>Новые товары</a>
					<span class="color"><br>(<?=round(filesize('/home/d/dc178435/public_html/download/presentation/new-products.pdf') / 1048576, 2);?>&nbsp;MB)&nbsp; — <?= date('d.m.Y', filemtime('/home/d/dc178435/public_html/download/presentation/new-products.pdf')) ?></span></div>
			</div>
		</div>
	</div>
	<div class="two_blocks" id="plakaty">
		<div class="left">
			<h3>Плакаты</h3>
			<p>Партнеры могут заказать готовые плакаты с продукцией PERCo для оформления офисов и выставочных стендов.</p>
			<p>Заказать можно два вида плакатов:</p>
			<ul>
				<li>Системы безопасности</li>
				<li>Турникеты и электронные проходные.</li>
			</ul>
			<p>Каждый вид имеет два размера:</p>
			<ul>
				<li>170*120</li>
				<li>130*90.</li>
			</ul>
			<a href="#feedback"><input style="text-decoration: none;" type="submit" name="web_form_submit" value="отправить заявку"></a>
		</div>
		<div class="image">
			<img src="/images/support/marketing5.jpg" alt="">
		</div>
	</div>
	<div class="two_blocks">
		<div class="image">
			<img src="/images/support/marketing7.jpg" alt="Логотип">
		</div>
		<div class="right">
			<h3>Материалы для сайта</h3>
			<p>Для размещения или актуализации описания продукции PERCo на сайте воспользуйтесь сервисом <a href="http://export.perco.ru/">выгрузки информации о товарах PERCo</a>.</p>
		</div>
	</div>
	<div class="two_blocks" id="obuchenie">
		<div class="left">
			<h3>Выездные семинары</h3>
			<p>Специалисты Учебного центра PERCo наряду с семинарами, проходящими на регулярной основе в учебном классе Санкт-Петербурга и вебинарами по запросу проведут выездной обучающий семинар для партнеров, пользователей и проектировщиков.</p>
			<a href="#feedback"><input style="text-decoration: none;" type="submit" name="web_form_submit" value="отправить заявку"></a>
		</div>	
		<div class="image">
			<img src="/images/support/marketing2.jpg" alt="">
		</div>	
	</div>
	<div class="two_blocks">
		<div class="image">
			<img src="/images/support/marketing3.jpg" alt="">
		</div>
		<div class="right">
			<h3>Мини-стенд с оборудованием</h3>
			<p>Для наглядной демонстрации работы системы партнерам предоставляются мини-стенды с контроллером и считывателями PERCo.</p>
			<a href="#feedback"><input style="text-decoration: none;" type="submit" name="web_form_submit" value="отправить заявку"></a>
		</div>
	</div>
	<div class="two_blocks" id="vystavka">
		<div class="left">
			<h3>Участие в выставках</h3>
			<p>По согласованию партнерам может быть предоставлено выставочное оборудование, комплект рекламных материалов, графические материалы для оформления стенда.</p>
			<a href="#feedback"><input style="text-decoration: none;" type="submit" name="web_form_submit" value="отправить заявку"></a>
		</div>
		<div class="image">
			<img src="/images/support/marketing1.jpg" alt="">
		</div>
	</div>
	<div class="two_blocks" id="logo">
		<div class="image">
			<img class="logo" src="/images/support/marketing-logo.jpg" alt="Логотип">
		</div>
		<div class="right">
			<h3>Логотип PERCo</h3>
			<p>Ссылка на векторный формат:</p>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="/images/icons/il.svg"></div>
				<div><a href="/images/support/Logo_PERCo.ai" target="_blank" download>Logo_PERCo.ai</a><span class="color"><br>(60.8&nbsp;KB)&nbsp; — 29.05.2019</span></div>
			</div>
			<div class="download_item">
				<div class="icon"><img alt="Иконка" src="/images/icons/cdr.svg"></div>
				<div><a href="/images/support/Logo_PERCo.cdr" target="_blank" download>Logo_PERCo.cdr</a><span class="color"><br>(25.0&nbsp;KB)&nbsp; — 29.05.2019</span></div>
			</div>
		</div>
	</div>
	<div class="with-back" id="foto">
		<div>
			<h3>Фото высокого разрешения</h3>
			<p>Для создания собственных рекламных материалов можно скачать фотографии продукции и готовых установок на объектах.</p>
			<ul>				
				<li><a href="https://www.perco.ru/download/photo/PERCo-Turnikety.rar">Турникеты и Электронные проходные</a></li>
				<li><a href="https://www.perco.ru/download/photo/PERCo-Ograzhdeniya.rar">Ограждения</a></li>
				<li><a href="https://www.perco.ru/download/photo/PERCo-Kalitki.rar">Калитки</a></li>
				<li><a href="https://www.perco.ru/download/photo/PERCo-Kontrollery-schityvateli.rar">Контроллеры и считыватели</a></li>
				<li><a href="https://www.perco.ru/download/photo/PERCo-Elektromekhanicheskie-zamki.rar">Замки</a></li>
				<li><a href="https://www.perco.ru/download/photo/PERCo-Ustanovki.rar">Установки на объектах</a></li>	
			</ul>
		</div>
	</div>
	<div>	
		<p style="margin-bottom: 20px; font-size: 20px;">Обратитесь за поддержкой или задайте вопрос заполнив форму обратной связи:</p>
		<div id="feedback">
			<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "konkurs", array(
				"WEB_FORM_ID" => "56",
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
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>