<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("История компании", "");
$APPLICATION->SetPageProperty("title", "История компании - производителя систем безопасности и оборудования");
$APPLICATION->SetPageProperty("description", "Производство оборудования и систем безопасности - неизменный профиль деятельности PERCo с момента основания компании");
$APPLICATION->SetPageProperty("keywords", "история PERCo, системы безопасности");
$APPLICATION->SetTitle("История компании");

$APPLICATION->SetAdditionalCSS("/css/istoriya-kompanii.css"); // подключение стилей
// $APPLICATION->AddHeadScript("/scripts/pages/istoriya-kompanii.js"); // подключение скриптов 
?>
 
<div id="content">
	<h1>
	<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<p>Начиная с момента основания в 1988 году, профиль деятельности PERCo остается неизменным — производство оборудования и систем  безопасности.</p>
	<p>За три десятилетия успешной работы PERCo во многом определила направление и темпы развития российского рынка безопасности — многие популярные на этом рынке товары были впервые разработаны и произведены именно PERCo.</p>
	<div class="years"> 
		<div class="year">
			<input id="hide-4" type="checkbox" checked="checked"><label for="hide-4"><div>2021 — 2013</div><span></span></label>
			<div class="year_content img_items">
				<p> 
					<b>2021 год.</b> Развитие системы PERCo-Web: распределенные серверы, многоуровневая верификация, распознавание номеров автомобилей, интеграция с ОПС «Болид».<br />
					Начало серийного выпуска моторизованных турникетов для установки дополнительного оборудования и компактных скоростных проходов.<br />
					Создание мобильных приложений для управления и конфигурации шлагбаумом.<br />
					Оборудование PERCo поставляется в 92 страны.
				</p> 
				<p><b>2020 год.</b> Начало серийного выпуска шлагбаумов.<br>Премия «Экспортер года в сфере высоких технологий».<br>Развитие системы PERCo-Web: идентификация по распознаванию лиц и штрихкоду, контроль температуры, интеграция с системой видеонаблюдения.</p> 
				<p><b>2019 год.</b> Начало серийного выпуска биометрических контроллеров нового поколения.<br>Открытие зарубежного офиса в Дубае.</p>
				<div>
					<a href="/images/about/DUB-big.jpg" title="Офис в Дубае" data-sub-html="Офис в Дубае"><img src="/images/about/DUB-small.jpg" alt="Офис в Дубае"></a>
					<a href="/images/about/ON-big.jpg" title="Биометрический контроллер" data-sub-html="Биометрический контроллер"><img src="/images/about/ON-small.jpg" alt="Биометрический контроллер"></a>
					<a href="/images/about/LICON-big.jpg" title="Биометрический терминал рабочего времени" data-sub-html="Биометрический терминал рабочего времени"><img src="/images/about/LICON-small.jpg" alt="Биометрический терминал рабочего времени"></a>
				</div>
				<p><b>2018 год.</b> PERCo отметила 30-летний юбилей. Полноростовые турникеты PERCo успешно справились с потоками болельщиков на ЧМ-2018. Партнеры из 11 стран прошли обучение в Учебном центре PERCo. Оборудование PERCo продается в 90 странах мира.</p>
				<p><b>2017 год.</b> Увеличение гарантийного срока на оборудование PERCo до 5 лет.<br />Расширение Учебного центра PERCo - открыт учебный класс в Санкт-Петербурге.<br />Открытие склада продукции PERCo в Голландии.</p>
				<p><b>2016 год.</b> Начало серийного выпуска скоростных проходов.<br />PERCo выпускает первую на рынке систему контроля доступа и учета рабочего времени с web-интерфейсом</p>
				<div>
					<a href="/images/about/guaranty_big.jpg" title="Гарантия" data-sub-html="Гарантия"><img src="/images/about/guaranty_mini.jpg" alt="Гарантия"></a>
					<a href="/images/about/study_big.jpg" title="Учебный центр" data-sub-html="Учебный центр"><img src="/images/about/study_mini.jpg" alt="Учебный центр"></a>
					<a href="/images/about/sklad-Gol_big.jpg" title="Склад в Голландии" data-sub-html="Склад в Голландии"><img src="/images/about/sklad-Gol_mini.jpg" alt="Склад в Голландии"></a>
				</div>
				<p><b>2015 год.</b> Начало серийного выпуска всепогодных турникетов из нержавеющей стали с функцией автоматической «Антипаники».<br />Оборудование и системы безопасности PERCo продаются более чем в 80 странах мира.</p>
				<div>
					<a href="/images/about/st-01_big.jpg" title="Скоростной проход ST-01" data-sub-html="Скоростной проход ST-01"><img src="/images/about/st-01_mini.jpg" alt="Скоростной проход ST-01"></a>
					<a href="/images/about/skd-perco-web_big.jpg" title="Система контроля доступа PERCo-Web" data-sub-html="Система контроля доступа PERCo-Web"><img src="/images/about/skd-perco-web_mini.jpg" alt="Система контроля доступа PERCo-Web"></a>
					<a href="/images/about/build-office-perco_big.jpg" title="Новое здание штаб-квартиры PERCo в Санкт-Петербурге" data-sub-html="Новое здание штаб-квартиры PERCo в Санкт-Петербурге"><img src="/images/about/build-office-perco_mini.jpg" alt="Новое здание штаб-квартиры PERCo в Санкт-Петербурге"></a>
				</div>
				<p><b>2014 год.</b> Новый терминал аэропорта Пулково оборудован автоматическими калитками PERCo. 80% московских школ оснащены электронными проходными PERCo.<br />
				Выпущен первый на рынке электромеханический замок с питанием через засов.<br />
				Начата серия вебинаров по обучению зарубежных партнеров PERCo. В Эстонии открылся первый сервисный центр PERCo по обслуживанию партнеров из стран Евросоюза.</p>
				<p><b>2013 год.</b> PERCo отметила 25-летний юбилей работы на рынке систем безопасности.<br />
				Создание сети региональных складов PERCo.<br />
				Начало серийного выпуска турникетов с функцией автоматической «Антипаники».<br />
				Система безопасности PERCo S-20 принята за стандарт и ее изучение включено в учебную программу в 10 ведущих вузах России и СНГ.</p>
				<div>
					<a href="/images/about/25-year-company_big.jpg" title="25 лет компании PERCo" data-sub-html="25 лет компании PERCo"><img src="/images/about/25-year-company_mini.jpg" alt="25 лет компании PERCo"></a>
					<a href="/images/about/region-stock_big.jpg" title="Региональные склады PERCo" data-sub-html="Региональные склады PERCo"><img src="/images/about/region-stock_mini.jpg" alt="Региональные склады PERCo"></a>
					<a href="/images/about/swing-gates-pulkovo_big.jpg" title="Автоматические калитки PERCo в международном аэропорту Пулково-2, Санкт-Петербург" data-sub-html="Автоматические калитки PERCo в международном аэропорту Пулково-2, Санкт-Петербург"><img src="/images/about/swing-gates-pulkovo_mini.jpg" alt="Автоматические калитки PERCo в международном аэропорту Пулково-2, Санкт-Петербург"></a>
				</div>
			</div>
		</div>  
		<div class="year">
			<input id="hide-3" type="checkbox" <?echo ($device=="desktop") ? ' ' : '';?>><label for="hide-3"><div>2012 — 2007</div><span></span></label>
			<div class="year_content img_items">
				<p><b>2012 год.</b> Введение системы обучения и сертификации для партнеров «Авторизованный инсталлятор PERCo». Изучение оборудования и систем безопасности PERCo включено в обязательную программу обучения в двух высших учебных заведениях: Воронежском институте МВД и Белорусском Государственном Университете Информатики и Радиоэлектроники.<br />
				Начало серийного выпуска терминалов учета рабочего времени LICON, турникетов со встроенными считывателями бесконтактных карт и картоприемником, роторных электронных проходных.</p>
				<p><b>2011 год.</b> PERCo выпускает специализированную систему безопасности для учебных заведений PERCo-S-20 «Школа» на Ethernet-технологиях. Система обеспечивает безопасность учащихся и контроль посещаемости со стороны родителей и учителей. За год система безопасности для школ успешно применена в сотнях школ от Владивостока до Минска.<br />
				Учебный Центр PERCo внедрил новый интерактивный формат обучения — проведение семинаров (вебинаров) через Интернет. В 2011 году на 130 вебинарах прошли обучение 1512 специалистов.</p>
				<div>
					<a href="/images/about/ip-ksb-school_big.jpg" title="IP-система безопасности для школ S-20 «Школа», 2011 год" data-sub-html="IP-система безопасности для школ S-20 «Школа», 2011 год"><img src="/images/about/ip-ksb-school_mini.jpg" alt="IP-система безопасности для школ S-20 «Школа», 2011 год"></a>
					<a href="/images/about/open-educational-center_big.jpg" title="Открытие постоянно действующего учебного центра в Пскове, 2011 год" data-sub-html="Открытие постоянно действующего учебного центра в Пскове, 2011 год"><img src="/images/about/open-educational-center_mini.jpg" alt="Открытие постоянно действующего учебного центра в Пскове, 2011 год"></a>
					<a href="/images/about/start-programm-sertificated_big.jpg" title="2012 год — начало масштабной программы подготовки и сертификации Авторизованных инсталляторов" data-sub-html="2012 год — начало масштабной программы подготовки и сертификации Авторизованных инсталляторов"><img src="/images/about/start-programm-sertificated_mini.jpg" alt="2012 год — начало масштабной программы подготовки и сертификации Авторизованных инсталляторов"></a>
				</div>
				<p><b>2010 год.</b> Официальная церемония открытия завода PERCo в Пскове. <br />
				Система менеджмента качества PERCo сертифицирована на соответствие международным стандартам ISO9001:2008. <br />
				Оборудование и системы безопасности PERCo продаются в 73 странах мира.</p>
				<div>
					<a href="/images/about/official-open-plant_big.jpg" title="Официальное открытие завода PERCo, 2010 год" data-sub-html="Официальное открытие завода PERCo, 2010 год"><img src="/images/about/official-open-plant_mini.jpg" alt="Официальное открытие завода PERCo, 2010 год"></a>
					<a href="/images/about/ribbon-cutting_big.jpg" title="Разрезание ленточки" data-sub-html="Разрезание ленточки"><img src="/images/about/ribbon-cutting_mini.jpg" alt="Разрезание ленточки"></a>
					<a href="/images/about/plant-certificate_big.jpg" title="Вручение заводу PERCo сертификата ISO 9001:2008, 2010 год" data-sub-html="Вручение заводу PERCo сертификата ISO 9001:2008, 2010 год"><img src="/images/about/plant-certificate_mini.jpg" alt="Вручение заводу PERCo сертификата ISO 9001:2008, 2010 год"></a>
				</div> 
				<p><b>2009 год.</b> Пуск первой очереди завода в Пскове.</p>
				<p><b>2008 год.</b> Начало выпуска Электронных проходных.</p>
				<div>
					<a href="/images/about/first-ip-ksb-s-20_big.jpg" title="Первая в России IP-система безопасности и повышения эффективности S-20, 2007 год" data-sub-html="Первая в России IP-система безопасности и повышения эффективности S-20, 2007 год"><img src="/images/about/first-ip-ksb-s-20_mini.jpg" alt="Первая в России IP-система безопасности и повышения эффективности S-20, 2007 год"></a>
					<a href="/images/about/first-ip-stile_big.jpg" title="Строительство завода, 2008 год" data-sub-html="Строительство завода, 2008 год"><img src="/images/about/first-ip-stile_mini.jpg" alt="Строительство завода, 2008 год"></a>
					<a href="/images/about/plant-construction_big.jpg" title="Первая в России электронная проходная — синтез электроники, механики и ПО, 2008 год" data-sub-html="Первая в России электронная проходная — синтез электроники, механики и ПО, 2008 год"><img src="/images/about/plant-construction_mini.jpg" alt="Первая в России электронная проходная — синтез электроники, механики и ПО, 2008 год"></a>
				</div>
				<p><b>2007 год.</b> PERCo выпускает первую в России Единую систему безопасности и эффективного управления предприятием на Ethernet-технологиях, совмещающую функции контроля доступа, охранной и пожарной сигнализации, видеонаблюдения, повышения эффективности управления.<br />
				Начало строительства завода PERCo в Пскове.</p>
			</div>
		</div> 
		<div class="year">
			<input id="hide-2" type="checkbox" <?echo ($device=="desktop") ? ' ' : '';?>><label for="hide-2"><div>2006 — 2001</div><span></span></label>
			<div class="year_content img_items">
				<p><b>2006 год.</b> Открытие первого выставочного зала PERCo за рубежом (Глазго, Великобритания). Продукция компании поставляется в 51 страну мира.</p>
				<p><b>2004-2005 год.</b> Создание сети региональных сервис-центров PERCo. Открытие склада продукции PERCo на территории ЕС (Таллинн, Эстония). Первое участие в ведущих зарубежных выставках по безопасности в ОАЭ, Германии, США, Великобритании.</p>
				<div>
					<a href="/images/about/isc-west-2005_big.jpg" title="PERCo на выставке ISC West 2005, Лас-Вегас, США" data-sub-html="PERCo на выставке ISC West 2005, Лас-Вегас, США"><img src="/images/about/isc-west-2005_mini.jpg" alt="PERCo на выставке ISC West 2005, Лас-Вегас, США"></a>
					<a href="/images/about/security-2004_big.jpg" title="PERCo на выставке Security-2004, Эссен, Германия" data-sub-html="PERCo на выставке Security-2004, Эссен, Германия"><img src="/images/about/security-2004_mini.jpg" alt="PERCo на выставке Security-2004, Эссен, Германия"></a>
					<a href="/images/about/expoprotection-2006_big.jpg" title="PERCo на выставке ExpoProtection-2006, Париж, Франция" data-sub-html="PERCo на выставке ExpoProtection-2006, Париж, Франция"><img src="/images/about/expoprotection-2006_mini.jpg" alt="PERCo на выставке ExpoProtection-2006, Париж, Франция"></a>
				</div>
				<p><b>2003 год.</b> Продукция PERCo поставляется в 45 стран мира.</p>
				<p><b>2002 год.</b> Расширение географии зарубежных продаж. Первые продажи в Японию, Великобританию, Францию.</p>
				<div>
					<a href="/images/about/first-instal-island_big.jpg" title="Первая установка в дальнем зарубежье, Исландия, 2001 год" data-sub-html="Первая установка в дальнем зарубежье, Исландия, 2001 год"><img src="/images/about/first-instal-island_mini.jpg" alt="Первая установка в дальнем зарубежье, Исландия, 2001 год"></a>
					<a href="/images/about/rally-turnstile_big.jpg" title="Розыгрыш 5000-го турникета, 2003 год" data-sub-html="Розыгрыш 5000-го турникета, 2003 год"><img src="/images/about/rally-turnstile_mini.jpg" alt="Розыгрыш 5000-го турникета, 2003 год"></a>
					<a href="/images/about/stock-perco_big.jpg" title="Склад PERCo в Европе, Таллинн, 2004 год" data-sub-html="Склад PERCo в Европе, Таллинн, 2004 год"><img src="/images/about/stock-perco_mini.jpg" alt="Склад PERCo в Европе, Таллинн, 2004 год"></a>
				</div>
				<p><b>2001 год.</b> Первая установка турникетов PERCo в дальнем зарубежье (Рейкьявик, Исландия).</p>
			</div>
		</div>
		<div class="year">
			<input id="hide-1" type="checkbox" <?echo ($device=="desktop") ? ' ' : '';?>><label for="hide-1"><div>2000 — 1988</div><span></span></label>
			<div class="year_content img_items">
				<p><b>2000 год.</b> Открытие сети выставочных залов у региональных дилеров PERCo. Создание обучающего центра PERCo.</p>
				<p><b>1999 год.</b> PERCo начинает серийное производство полуростовых и полноростовых электромеханических роторных турникетов.</p>
				<p><b>1995-1996 год.</b> В PERCo начато производство первых отечественных считывателей бесконтактных карт доступа, положивших начало широкому распространению технологий бесконтактной идентификации в России.</p>
				<div>
					<a href="/images/about/first-card-reader_big.jpg" title="Первый в России считыватель, 1992 год" data-sub-html="Первый в России считыватель, 1992 год"><img src="/images/about/first-card-reader_mini.jpg" alt="Первый в России считыватель, 1992 год"></a>
					<a href="/images/about/first-movie-turnikets_big.jpg" title="Первый фильм «Турникеты и электронные проходные», 1996 год" data-sub-html="Первый фильм «Турникеты и электронные проходные», 1996 год"><img src="/images/about/first-movie-turnikets_mini.jpg" alt="Первая фильм «Турникеты и электронные проходные», 1996 год"></a>
					<a href="/images/about/first-exhibition-msk_big.jpg" title="PERCo на первой выставке в Москве «Банк и офис», 1996 год" data-sub-html="PERCo на первой выставке в Москве «Банк и офис», 1996 год"><img src="/images/about/first-exhibition-msk_mini.jpg" alt="PERCo на первой выставке в Москве «Банк и офис», 1996 год"></a>
				</div>
				<p><b>1994 год.</b> Начало развития дилерской сети PERCo.</p>
				<p><b>1993 год.</b> В PERCo создан первый отечественный электромеханический замок для кабинетов, PERCo приступает к выпуску первой в России сетевой системы контроля доступа на бесконтактных картах.</p>
				<div>
					<a href="/images/about/first-tripod_big.jpg" title="Первый в России турникет-трипод, 1992 год" data-sub-html="Первый в России турникет-трипод, 1992 год"><img src="/images/about/first-tripod_mini.jpg" alt="Первый в России турникет-трипод, 1992 год"></a>
					<a href="/images/about/first-system-on-card_big.jpg" title="Первая в России система на бесконтактных смарт-картах, 1992 год" data-sub-html="Первая в России система на бесконтактных смарт-картах, 1992 год"><img src="/images/about/first-system-on-card_mini.jpg" alt="Первая в России система на бесконтактных смарт-картах, 1992 год"></a>
					<a href="/images/about/first-proximity-cards_big.jpg" title="Первые в России Proximity-карты доступа, 1992 год" data-sub-html="Первые в России Proximity-карты доступа, 1992 год"><img src="/images/about/first-proximity-cards_mini.jpg" alt="Первые в России Proximity-карты доступа, 1992 год"></a>
				</div>
				<p><b>1991 год.</b> PERCo выпускает первый в России турникет-трипод.</p>
				<p><b>1988 год.</b> Создание PERCo. Начало разработки и производства систем безопасности под заказ.</p>
			</div>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>