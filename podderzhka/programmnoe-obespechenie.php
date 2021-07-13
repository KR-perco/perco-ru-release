<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Программное обеспечение", "");
$APPLICATION->SetPageProperty("title", "Программное обеспечение системы безопасности S-20 | PERCo");
$APPLICATION->SetPageProperty("description", "Программное обеспечение Единой системы PERCo-S-20: обновления, поддержка, презентации, демонстрационные версии, порядок получения лицензии");
$APPLICATION->SetPageProperty("keywords", "системы контроля доступа, комплексная система безопасности, скуд");
$APPLICATION->SetTitle("Программное обеспечение");

$APPLICATION->SetAdditionalCSS("/css/programmnoe-obespechenie.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/programmnoe-obespechenie.js"); // подключение скриптов
?>

<?
if ($_GET["checked"] != '') $checkedId = $_GET["checked"];
$checked = 'checked="checked"';

switch ($checkedId){
	case "first":
	$checkedFirst = $checked;
	break;
	case "second":
	$checkedSecond = $checked;
	break;
	case "three":
	$checkedThree = $checked;
	break;
	case "four":
	$checkedFour = $checked;
	break;
	case "five":
	$checkedFive = $checked;
	break;
	case "six":
	$checkedSix = $checked;
	break;
	case "seven":
	$checkedSeven = $checked;
	break;
	case "eight":
	$checkedEight = $checked;
	break;
	default:
	$checkedFirst = $checked;
}
?>
<div id="content">
	<div id="himg">
		<h1>
			<?$APPLICATION->ShowTitle(false, false)?>
		</h1>
		<img alt="Программное обеспечение" src="/images/icons/soft.svg" />
	</div>
	<p>В этом разделе можно скачать программное обеспечение PERCo. После установки ПО действует бесплатный
		ознакомительный период, в течение которого можно полноценно работать с программным обеспечением. Ознакомительный
		период позволяет определить, какой именно комплект ПО и какие модули будут Вам необходимы для работы. По
		истечении ознакомительного периода необходимо приобрести лицензию на право пользования комплектом и модулями ПО.
		При покупке лицензии вся внесенная в ознакомительный период информация сохраняется.</p>

	<div class="tabs">
		<style>
			.block-btn p {
				margin-top: 5px;
			}

			.btn .download-icon {
				width: 28px;
				height: 28px;
				margin-top: 4px;
			}

			a.btn {
				margin: 0;
				padding: 4px 15px;
			}
		</style>
		<input type="radio" id="<?=translitIt(strtolower("ПО PERCo-Web"));?>" <? echo $checkedFirst ?> name="vkladki">
		<label for="<?=translitIt(strtolower("ПО PERCo-Web"));?>"><span class="dashed">ПО PERCo-Web</span></label>
		<div>
			<?
			$iblocks = GetIBlockList("download", "files");
			if($arIBlock = $iblocks->Fetch())
				$block_id = $arIBlock["ID"];
		?>
			<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "po-perco-web", Array(
					"IBLOCK_TYPE" => "download",	// Тип инфоблока
					"IBLOCK_ID" => $block_id,	// Инфоблок
					"SECTION_ID" => "2066",	// ID раздела
					"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
					"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
					"SECTION_FIELDS" => "",	// Поля разделов
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"CACHE_TYPE" => "A",	// Тип кеширования
					"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);?>
			<?/*<div class="box-for-buttons">
				<div class="block-btn block-btn-po">
					<a class="btn" href="/download/soft/rus/SetupPERCoWeb.zip"
						onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/SetupPERCoWeb.zip-ga'});"><i
							class="download-icon"
							style="background-image: url(/images/icons/windows-04-01-01.svg);"></i>СКАЧАТЬ ПО
						Windows</a>
					<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (297,04&nbsp;MB)&nbsp; —
							03.02.2020</span></p>
				</div>
				<div class="block-btn block-btn-po">
					<a class="btn" href="/download/soft/rus/debian_packages.zip"
						onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/debian_packages.zip-ga'});">
						<i class="download-icon"
							style="background-image: url(/images/icons/Logo-ubuntu_cof-orange-hex.svg);"></i>СКАЧАТЬ ПО
						Debian linux</a>
					<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (313,6&nbsp;MB)&nbsp; —
							03.02.2020</span></p>
				</div>
				<div class="block-btn block-btn-po">
					<a class="btn" href="/download/soft/rus/fedora_packages.zip"
						onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/fedora_packages.zip-ga'});"><i
							class="download-icon"
							style="background-image: url(/images/icons/Fedora-logo_20x20-01.svg);"></i>СКАЧАТЬ ПО Fedora
						linux</a>
					<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (359,92&nbsp;MB)&nbsp; —
							03.02.2020</span></p>
				</div>
				<div class="block-btn block-btn-po">
					<a class="btn" href="/download/soft/rus/altlinux_packages.zip"
						onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/altlinux_packages.zip-ga'});"><i
							class="download-icon"
							style="background-image: url(/images/icons/alt_linux-01_20x20.svg);"></i>СКАЧАТЬ ПО Alt
						linux</a>
					<p><span class="color" style="font-size:15px;">версия 2.0.1.15 (318,37&nbsp;MB)&nbsp; —
							03.02.2020</span></p>
				</div>
			</div>*/?>
			<p><strong>ВАЖНО:</strong> Для ОС ROSA при использовании MariaDB нужна версия MariaDB 10.2 или выше.</p>

			<p>Для установки версии ПО PERCo-Web для ОС Linux необходимо открыть диск, скопировать установочный файл
				формата *.deb, *.rpm, и установить ПО PERCo-Web согласно инструкции.</p>

			<p>Для удобства ознакомления в течение <b>60 дней</b> вы можете использовать программное обеспечение
				<b>бесплатно</b>. Во время ознакомительного периода доступен полный функционал всех модулей.
				Ознакомительный период позволяет определить, какие модули вам необходимы. </p>
			<p>По истечении этого срока необходимо получить свидетельство на право использования и ввести указанные в
				нем коды активации. Доступ к данным, внесенным в систему во время тестового периода, будет восстановлен
				сразу после введения кодов активации.</p>
			<p>Работу с Базовым пакетом ПО вы можете продолжить бесплатно, но получение свидетельства на право
				пользования также необходимо.</p>

			<div class="block-btn"><a class="btn" href="/podderzhka/priobretenie-licenzii-perco-web.php">ПОЛУЧИТЬ ПРАВО
					ИСПОЛЬЗОВАНИЯ</a></div>

			<p><strong>ВАЖНО: </strong> Для перехода с версии 1.X.X.X на версию 2.X.X.X необходимо скачать версию 2.0,
				запустить "Утилиту миграции базы данных из PERCo-Web версии 1.X.X.X" и провести миграцию базы данных
				согласно Руководству Администратора. Для работы с контроллерами CT/L14, CL15, CR11, IR18, CT13
				необходимо скачать и установить PERCo-Web 2.X.X.X. Наиболее полное использование всех возможностей
				контроллеров PERCo-CT/L04.2 в системе PERCo-Web доступно после обновления ПО до версии 1.2.0.26, а <a
					style="cursor: pointer;" onclick="showBlock('vnutrennee-po-kontrollerov');">внутреннего ПО</a>
				контроллера до версии
				<?php
				$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
					"MODE"      => "html",
					"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
				));
				?>.</p>
			<a target="_blank" href="/download/soft/rus/perco-web-current-version.pdf" download="">Изменения в последних версиях ПО</a>
			<?php
			$APPLICATION->IncludeFile("/include/trebovaniya-dlya-po.php", Array(), Array(
				"MODE"      => "html",
				"NAME"      => "Редактировать требования для ПО"
			));
			?>
			<p>SMS-провайдеры:</p>
			<span class="boldZag">Россия</span>
			<ul>
				<li>
					<noindex>WebSMS (<a href="http://www.websms.ru" target="_blank" rel="nofollow">www.websms.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>СМС Трафик (<a href="http://www.smstraffic.ru" target="_blank"
							rel="nofollow">www.smstraffic.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Мир СМС (<a href="http://www.mirsms.ru" target="_blank" rel="nofollow">www.mirsms.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>SMSЦентр (<a href="http://www.smsc.ru" target="_blank" rel="nofollow">www.smsc.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>GSM-Информ (<a href="http://www.gsm-inform.ru" target="_blank"
							rel="nofollow">www.gsm-inform.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Билайн (<a href="http://www.beeline.ru" target="_blank" rel="nofollow">www.beeline.ru</a>).
						Контактное лицо: +7 (968) 970-70-07 (Зудиленков
						Вадим) <a href="mailto:vzudilenkov@beeline.ru">VZudilenkov@beeline.ru</a></noindex>
				</li>
				<li>
					<noindex>SigmaSMS (<a href="https://www.sigmasms.ru" target="_blank"
							rel="nofollow">www.sigmasms.ru</a>). Отправка SMS, Viber, ВКонтакте, чат-боты. Работа в странах СНГ. Контактное лицо: +7 (965) 000-55-66 (Сергеев
						Алексей) <a href="mailto:gd@sigmasms.ru">gd@sigmasms.ru</a></noindex>
				</li>
				<li>
					<noindex>Интеллин (<a href="http://www.intellin.ru" target="_blank"
							rel="nofollow">www.intellin.ru</a>). Контактное лицо: +7 (905) 722-44-79 (Смирнов
						Алексей) <a href="mailto:a.smirnov@intellin.ru">a.smirnov@intellin.ru</a></noindex>
				</li>
				<li>
					<noindex>МТС Коммуникатор (<a href="http://www.mcommunicator.ru" target="_blank"
							rel="nofollow">www.mcommunicator.ru</a>). Контактное лицо: +7 (913) 611-57-39
						(Шайкина Марина) <a href="mailto:mashajki@mts.ru">mashajki@mts.ru</a>, техническая
						поддержка: +7 (913) 155-35-21 (Крупко Пётр) <a
							href="mailto:pakrupko@omsk.mts.ru">pakrupko@omsk.mts.ru</a></noindex>
				</li>
				<li>
					<noindex>TELE2 Бизнес SMS (<a href="http://www.bsms.tele2.ru" target="_blank"
							rel="nofollow">www.bsms.tele2.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Сервис бесплатных уведомлений (<a href="http://www.shkolainfo.ru" target="_blank"
						rel="nofollow">www.shkolainfo.ru</a>) Контактное лицо: 8-800-333-16-50 (Марченко Кристина), <a href="mailto:support@shkolainfo.ru"
						rel="nofollow">support@shkolainfo.ru</a></noindex>
				</li>
			</ul>
			<span class="boldZag">Беларусь</span>
			<ul>
				<li>
					<noindex>SMS-Ассистент BY (<a href="http://www.sms-assistent.by" target="_blank"
							rel="nofollow">www.sms-assistent.by</a>)</noindex>
				</li>
			</ul>
			<span class="boldZag">Казахстан</span>
			<ul>
				<li>
					<noindex>QuickTelecom KZ (<a href="http://www.sms1.kz" target="_blank"
							rel="nofollow">www.sms1.kz</a>)</noindex>
				</li>
				<li>
					<noindex>КазИнфоТех АЦП (<a href="http://kazinfoteh.kz" target="_blank"
							rel="nofollow">kazinfoteh.kz</a>). Контактное лицо: +7 (777) 007-93-83 (Ковалева
						Юлия) <a href="mailto:k.yliya@kazinfoteh.kz">k.yliya@kazinfoteh.kz</a>, техническая
						поддержка: +7 (777) 022-98-31 (Назаров Дмитрий) <a
							href="mailto:support@kazinfoteh.kz">support@kazinfoteh.kz</a></noindex>
				</li>
				<li>
					<noindex>SigmaSMS.kz (<a href="http://www.sigmasms.kz" target="_blank"
						rel="nofollow">www.sigmasms.kz</a>) Служба поддержки: +7 (727) 310-10-21, <a href="mailto:support@shkolainfo.ru"
						rel="nofollow">info@sigmasms.ru</a></noindex>
				</li>
			</ul>
			<span class="boldZag">Украина</span>
			<ul>
				<li>
					<noindex>TurboSMS (<a href="http://www.turbosms.ua" target="_blank"
							rel="nofollow">www.turbosms.ua</a>)</noindex>
				</li>

				<li>
					<noindex>АльфаSMS (<a href="http://www.alphasms.com.ua" target="_blank"
							rel="nofollow">www.alphasms.com.ua</a>)</noindex>
				</li>

				<li>
					<noindex>SpeedSMS (<a href="http://www.speedsms.com.ua" target="_blank"
							rel="nofollow">www.speedsms.com.ua</a>)</noindex>
				</li>
			</ul>
		</div>

		<input type="radio" id="<?=translitIt(strtolower("ПО PERCo-S-20"));?>" <? echo $checkedSecond ?>name="vkladki">
		<label for="<?=translitIt(strtolower("ПО PERCo-S-20"));?>"><span class="dashed">ПО PERCo-S-20</span></label>
		<div>
			<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "setevoe-programmnoe-obespechenie-s-20",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);
?>
			<p><a href="/podderzhka/priobretenie-licenzii-perco-s-20.php">Порядок получения права использования ПО
					PERCo-S-20 и PERCo-S-20 Школа</a></p>
			<p>
				<strong>ВАЖНО: </strong>
				В системе PERCo-S-20 предусмотрена возможность обновления интеграции систем PERCo-S-20 и ABBYY PassportReader SDK, в частности, переход на версию ABBYY PassportReader SDK 1.5.2. Подробнее про обновление можно ознакомиться в инструкции, вложенной в архив с набором файлов поддержки ABBYY PassportReader SDK 1.5.2.
			</p>
			<div class="catalog-section-list">
				<ul>
					<li>
						<a href="/download/soft/rus/ABBYY_v1.5.2_for_S-20.zip" target="_blank" onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/SetupCommon.zip'});" download="">
							Обновление ПО ABBYY PassportReader SDK до версии 1.5.2
						</a>
						<span class="color">
							(1.83&nbsp;MB)&nbsp; — 29.01.2021
						</span>
					</li>
				</ul>
			</div>
			<p><strong>ВАЖНО: </strong>наиболее полное использование всех возможностей контроллеров PERCo-CT/L04.2 в
				системе PERCo-S-20 доступно после обновления ПО до версии 3.9.6.5, а внутреннего ПО ("прошивки")
				контроллера - до версии 
				<?php
				$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
					"MODE"      => "html",
					"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
				));
				?>.</p>
			<!--p>При обновлении версий ПО, предшествующих версиям 3.6.2.2 PERCo-S-20, обновление прошивок контроллеров
				CT/L04 и встроенных контроллеров электронных проходных требуется только для версий прошивок х.х.х.16 и
				более ранних. Для версий прошивок х.х.0.17 - х.х.1.19 обновление не требуется.</p-->
			<p>При обновлении версий ПО PERCo-S-20, предшествующих версиям 3.6.2.2, для корректной работы необходимо обновление прошивок контроллеров CT/L04 и встроенных контроллеров электронных проходных х.х.х.16 и более ранних.</p>
			<p>Отличия в прошивках:</p>
			<!--ul>
				<li>Версия х.х.1.19 отличается от версий х.х.0.17 - х.х.0.18 наличием нового варианта индикации режимов
					контроля доступа и упрощенным алгоритмом постановки/снятия с охраны</li>
				<li>Версия х.х.0.20 отличается от х.х.1.19 наличием возможности подключения к контроллеру внешних
					верифицирующих устройств (например, алкотестера)</li>
			</ul-->
			<ul>
				<li>Версия х.х.8.19 отличается от версий х.х.0.17 - х.х.0.18 наличием нового варианта индикации режимов контроля доступа и упрощенным алгоритмом постановки/снятия с охраны.</li>
				<li>Версия х.х.8.20 отличается от х.х.8.19 наличием возможности подключения к контроллеру внешних верифицирующих устройств (например, алкотестера). Для получения прошивки х.х.8.20 необходимо отправить запрос в техподдержку – на электронный адрес <a href="mailto:system@perco.ru">system@perco.ru</a> или <a href="mailto:soft@perco.ru">soft@perco.ru</a>.</li>				
			</ul>
			<p><strong>ВАЖНО:</strong> контроллеры с версией прошивки х.х.8.20 не поддерживаются в PERCo-Web.</p>
			<?
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "programmnoe-obespechenie-dlya-smeny-proshivok-v-kontrollerakh-sistemy-s-20",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);
?>
			<table style="width: auto; border: none; margin-left: 20px; margin-top: -10px;">
				<tr>
					<td style="border: none; vertical-align: top;">Версии прошивок:</td>
					<td style="border: none;">
						<p>CT/L04.2, CT03.2, CL05.2, CR01.2 - <span class="color">
							<?php
							$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
								"MODE"      => "html",
								"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
							));
							?>
						</span></p>
						<p>CT/L04, CT03, CL05, CL05.1, CR01 - <span class="color">x.x.8.19</span></p>
						<p>CS01, PU01 - <span class="color">x.x.x.8</span></p>
						<p>CT01, CT02, CL01, CL02, CL03 - <span class="color">x.x.x.30</span></p>
						<p>SC-820 - <span class="color">1.0.0.5</span></p>
					</td>
				</tr>
			</table>
			<?
			$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
					"IBLOCK_TYPE" => "download",	// Тип инфоблока
					"IBLOCK_ID" => $block_id,	// Инфоблок
					"SECTION_ID" => "",	// ID раздела
					"SECTION_CODE" => "vnutrennee-po-kontrollerov",	// Код раздела
					"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
					"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
					"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
					"SECTION_FIELDS" => "",	// Поля разделов
					"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"CACHE_TYPE" => "A",	// Тип кеширования
					"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);
			?>
			<?/*
$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "drayvera",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
	),
	false
);
*/?>
			<p>Программное обеспечение PERCo-S-20 поддерживается следующими ОС:</p>
			<ul>
				<li>Windows Server 2003 SP1</li>
				<!--li>Windows XP SP3</li-->
				<!--li>Windows Vista SP2</li-->
				<li>Windows 7 PRO</li>
				<li>Windows Server 2008</li>
				<li>Windows Server 2008 R2</li>
				<!--li>Windows 8.x</li-->
				<li>Windows 10</li>
				<li>Windows Server 2012</li>
				<li>Windows Server 2012 R2</li>
				<li>Windows Server 2016</li>
			</ul>
			<p>После установки программного обеспечения на компьютер пользователя имеется возможность ознакомительной
				эксплуатации со всеми работающими приложениями в течение 30 дней. Для продолжения эксплуатации
				программного обеспечения необходимо приобрести требуемый вам комплект ПО, получить лицензию на право
				использования ПО системы безопасности (базового ПО и необходимых вам модулей) и внести в ПО коды
				активации, указанные в лицензии. По истечении 30-ти дневного срока, без внесенных в ПО кодов активации
				запуск ПО системы безопасности будет невозможен.</p>
			<? $APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "prezentatsiya-vozmozhnostey-perco-s-20",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
		"WITH_IMAGE" => "Y"
	),
	false
);?>
			<p><a target="_blank" href="/download/soft/rus/s-20-current-version.pdf"
					onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/s-20-current-version.pdf'});"
					download>Изменения в последних версиях ПО</a> <span
					class="color">(<?=printFileInfo("/download/soft/rus/s-20-current-version.pdf", "size");?>) &mdash;
					<?=printFileInfo("/download/soft/rus/s-20-current-version.pdf", "date");?></span></p>
			<p>При установке новой версии ПО необходимо удалить штатным деинсталлятором старую версию.</p>
			<p>Cистема S-20 осуществляет полноценную поддержку видеокамер, работающих по протоколу ONVIF, включая
				конфигурацию, задание параметров работы, обработку тревожных событий, зум и управление.
			</p>
			<!--a href="https://www.perco.ru/download/documentation/rus/PERCo-S-20_Links.pdf">Список видеокамер, прошедших
				тестирование.</a>
			<p>Правила монтажа и другие требования, предъявляемые к подключению конкретной IP-камеры или
				IP–видеосервера, описаны в сопроводительной документации к этим изделиям.</p-->
			<?/*
			$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
					"IBLOCK_TYPE" => "download",	// Тип инфоблока
					"IBLOCK_ID" => $block_id,	// Инфоблок
					"SECTION_ID" => "",	// ID раздела
					"SECTION_CODE" => "programmnye-moduli-dlya-raboty-s-videokamerami",	// Код раздела
					"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
					"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
					"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
					"SECTION_FIELDS" => "",	// Поля разделов
					"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"CACHE_TYPE" => "A",	// Тип кеширования
					"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);
			*/?>
			<p>SMS-провайдеры:</p>
			<span class="boldZag">Россия</span>
			<ul>
				<li>
					<noindex>WebSMS (<a href="http://www.websms.ru" target="_blank" rel="nofollow">www.websms.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>СМС Трафик (<a href="http://www.smstraffic.ru" target="_blank"
							rel="nofollow">www.smstraffic.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Мир СМС (<a href="http://www.mirsms.ru" target="_blank" rel="nofollow">www.mirsms.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>SMSЦентр (<a href="http://www.smsc.ru" target="_blank" rel="nofollow">www.smsc.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>GSM-Информ (<a href="http://www.gsm-inform.ru" target="_blank"
							rel="nofollow">www.gsm-inform.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Билайн (<a href="http://www.beeline.ru" target="_blank" rel="nofollow">www.beeline.ru</a>).
						Контактное лицо: +7 (968) 970-70-07 (Зудиленков
						Вадим) <a href="mailto:vzudilenkov@beeline.ru">VZudilenkov@beeline.ru</a></noindex>
				</li>
				<li>
					<noindex>SigmaSMS (<a href="https://www.sigmasms.ru" target="_blank"
							rel="nofollow">www.sigmasms.ru</a>). Отправка SMS, Viber, ВКонтакте, чат-боты. Работа в странах СНГ. Контактное лицо: +7 (965) 000-55-66 (Сергеев
						Алексей) <a href="mailto:gd@sigmasms.ru">gd@sigmasms.ru</a></noindex>
				</li>
				<li>
					<noindex>Интеллин (<a href="http://www.intellin.ru" target="_blank"
							rel="nofollow">www.intellin.ru</a>). Контактное лицо: +7 (905) 722-44-79 (Смирнов
						Алексей) <a href="mailto:a.smirnov@intellin.ru">a.smirnov@intellin.ru</a></noindex>
				</li>
				<li>
					<noindex>МТС Коммуникатор (<a href="http://www.mcommunicator.ru" target="_blank"
							rel="nofollow">www.mcommunicator.ru</a>). Контактное лицо: +7 (913) 611-57-39
						(Шайкина Марина) <a href="mailto:mashajki@mts.ru">mashajki@mts.ru</a>, техническая
						поддержка: +7 (913) 155-35-21 (Крупко Пётр) <a
							href="mailto:pakrupko@omsk.mts.ru">pakrupko@omsk.mts.ru</a></noindex>
				</li>
				<li>
					<noindex>TELE2 Бизнес SMS (<a href="http://www.bsms.tele2.ru" target="_blank"
							rel="nofollow">www.bsms.tele2.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Сервис бесплатных уведомлений (<a href="http://www.shkolainfo.ru" target="_blank"
						rel="nofollow">www.shkolainfo.ru</a>) Контактное лицо: 8-800-333-16-50 (Марченко Кристина), <a href="mailto:support@shkolainfo.ru"
						rel="nofollow">support@shkolainfo.ru</a></noindex>
				</li>
			</ul>
			<span class="boldZag">Беларусь</span>
			<ul>
				<li>
					<noindex>SMS-Ассистент BY (<a href="http://www.sms-assistent.by" target="_blank"
							rel="nofollow">www.sms-assistent.by</a>)</noindex>
				</li>
			</ul>
			<span class="boldZag">Казахстан</span>
			<ul>
				<li>
					<noindex>QuickTelecom KZ (<a href="http://www.sms1.kz" target="_blank"
							rel="nofollow">www.sms1.kz</a>)</noindex>
				</li>
				<li>
					<noindex>КазИнфоТех АЦП (<a href="http://kazinfoteh.kz" target="_blank"
							rel="nofollow">kazinfoteh.kz</a>). Контактное лицо: +7 (777) 007-93-83 (Ковалева
						Юлия) <a href="mailto:k.yliya@kazinfoteh.kz">k.yliya@kazinfoteh.kz</a>, техническая
						поддержка: +7 (777) 022-98-31 (Назаров Дмитрий) <a
							href="mailto:support@kazinfoteh.kz">support@kazinfoteh.kz</a></noindex>
				</li>
				<li>
					<noindex>SigmaSMS.kz (<a href="http://www.sigmasms.kz" target="_blank"
						rel="nofollow">www.sigmasms.kz</a>) Служба поддержки: +7 (727) 310-10-21, <a href="mailto:support@shkolainfo.ru"
						rel="nofollow">info@sigmasms.ru</a></noindex>
				</li>
			</ul>
			<span class="boldZag">Украина</span>
			<ul>
				<li>
					<noindex>TurboSMS (<a href="http://www.turbosms.ua" target="_blank"
							rel="nofollow">www.turbosms.ua</a>)</noindex>
				</li>

				<li>
					<noindex>АльфаSMS (<a href="http://www.alphasms.com.ua" target="_blank"
							rel="nofollow">www.alphasms.com.ua</a>)</noindex>
				</li>

				<li>
					<noindex>SpeedSMS (<a href="http://www.speedsms.com.ua" target="_blank"
							rel="nofollow">www.speedsms.com.ua</a>)</noindex>
				</li>
			</ul>
		</div>
		<input type="radio" id="<?=translitIt(strtolower("ПО S-20 Школа"));?>" <? echo $checkedThree ?> name="vkladki">
		<label for="<?=translitIt(strtolower("ПО S-20 Школа"));?>"><span class="dashed">ПО S-20 Школа</span></label>
		<div>
			<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
			"IBLOCK_TYPE" => "download",	// Тип инфоблока
			"IBLOCK_ID" => $block_id,	// Инфоблок
			"SECTION_ID" => "",	// ID раздела
			"SECTION_CODE" => "perco-s-20-shkola",	// Код раздела
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
			"SECTION_FIELDS" => "",	// Поля разделов
			"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);
			?>
			<p><a href="/podderzhka/priobretenie-licenzii-perco-s-20.php">Порядок получения права использования ПО
					PERCo-S-20 и PERCo-S-20 Школа</a></p>
			<p><strong>ВАЖНО: </strong>наиболее полное использование всех возможностей контроллеров PERCo-CT/L04.2 в
				системе PERCo-S-20 Школа доступно после обновления ПО до версии 2.9.6.5, а внутреннего ПО ("прошивки")
				контроллера - до версии 
				<?php
				$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
					"MODE"      => "html",
					"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
				));
				?>.</p>
			<!--p> При обновлении версий ПО, предшествующих версиям 2.6.2.2 PERCo-S-20 «Школа», обновление прошивок
				контроллеров CT/L04 и встроенных контроллеров электронных проходных требуется только для версий прошивок
				х.х.х.16 и более ранних. Для версий прошивок х.х.0.17 - х.х.1.19 обновление не требуется.</p-->
			<p>При обновлении версий ПО PERCo-S-20, предшествующих версиям 3.6.2.2, для корректной работы необходимо обновление прошивок контроллеров CT/L04 и встроенных контроллеров электронных проходных х.х.х.16 и более ранних.</p>
			<p>Отличия в прошивках:</p>
			<!--ul>
				<li>Версия х.х.1.19 отличается от версий х.х.0.17 - х.х.0.18 наличием нового варианта индикации режимов
					контроля доступа и упрощенным алгоритмом постановки/снятия с охраны</li>
				<li>Версия х.х.0.20 отличается от х.х.1.19 наличием возможности подключения к контроллеру внешних
					верифицирующих устройств (например, алкотестера)</li>
			</ul-->
			<ul>
				<li>Версия х.х.8.19 отличается от версий х.х.0.17 - х.х.0.18 наличием нового варианта индикации режимов контроля доступа и упрощенным алгоритмом постановки/снятия с охраны.</li>
				<li>Версия х.х.8.20 отличается от х.х.8.19 наличием возможности подключения к контроллеру внешних верифицирующих устройств (например, алкотестера). Для получения прошивки х.х.8.20 необходимо отправить запрос в техподдержку – на электронный адрес <a href="mailto:system@perco.ru">system@perco.ru</a> или <a href="mailto:soft@perco.ru">soft@perco.ru</a>.</li>				
			</ul>
			<p><strong>ВАЖНО:</strong> контроллеры с версией прошивки х.х.8.20 не поддерживаются в PERCo-Web.</p>
			<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
			"IBLOCK_TYPE" => "download",	// Тип инфоблока
			"IBLOCK_ID" => $block_id,	// Инфоблок
			"SECTION_ID" => "",	// ID раздела
			"SECTION_CODE" => "programmnoe-obespechenie-dlya-smeny-proshivok-v-kontrollerakh-sistemy-s-20",	// Код раздела
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
			"SECTION_FIELDS" => "",	// Поля разделов
			"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);?>
			<table style="width: auto; border: none; margin-left: 20px; margin-top: -10px;">
				<tr>
					<td style="border: none; vertical-align: top;">Версии прошивок:</td>
					<td style="border: none;">
						<p>CT/L04.2, CT03.2, CL05.2, CR01.2 - <span class="color">
							<?php
							$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
								"MODE"      => "html",
								"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
							));
							?>
						</span></p>
						<p>CT/L04, CT03, CL05, CL05.1, CR01 - <span class="color">x.x.8.19</span></p>
						<p>CS01, PU01 - <span class="color">x.x.x.8</span></p>
						<p>CT01, CT02, CL01, CL02, CL03 - <span class="color">x.x.x.30</span></p>
						<p>SC-820 - <span class="color">1.0.0.5</span></p>
					</td>
				</tr>
			</table>
			<p>Программное обеспечение PERCo-S-20 «Школа» поддерживается следующими ОС:</p>
			<ul>
				<li>Windows Server 2003 SP1</li>
				<!--li>Windows XP SP3</li-->
				<!--li>Windows Vista SP2</li-->
				<li>Windows 7 PRO</li>
				<li>Windows Server 2008</li>
				<li>Windows Server 2008 R2</li>
				<!--li>Windows 8.x</li-->
				<li>Windows 10</li>
				<li>Windows Server 2012</li>
				<li>Windows Server 2012 R2</li>
				<li>Windows Server 2016</li>
			</ul>
			<p>После установки программного обеспечения на компьютер пользователя имеется возможность ознакомительной
				эксплуатации со всеми работающими приложениями в течение 30 дней. Для продолжения эксплуатации
				программного обеспечения необходимо приобрести требуемое вам ПО (базовое или расширенное), получить
				лицензию на право использования ПО системы PERCo-S-20 «Школа» и внести в ПО коды активации, указанные в
				лицензии. По истечении 30-ти дневного срока, без внесенных кодов активации запуск ПО системы «Школа»
				будет невозможен.</p>
			<p><a target="_blank" href="/download/soft/rus/s-20-current-version.pdf"
					onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/soft/rus/s-20-current-version.pdf'});"
					download>Изменения в последних версиях ПО</a> <span
					class="color">(<?=printFileInfo("/download/soft/rus/s-20-current-version.pdf", "size");?>) &mdash;
					<?=printFileInfo("/download/soft/rus/s-20-current-version.pdf", "date");?></span></p>
			<p>При установке новой версии ПО необходимо удалить штатным деинсталлятором старую версию.</p>
			<p>SMS-провайдеры:</p>
			<span class="boldZag">Россия</span>
			<ul>
				<li>
					<noindex>WebSMS (<a href="http://www.websms.ru" target="_blank" rel="nofollow">www.websms.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>СМС Трафик (<a href="http://www.smstraffic.ru" target="_blank"
							rel="nofollow">www.smstraffic.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Мир СМС (<a href="http://www.mirsms.ru" target="_blank" rel="nofollow">www.mirsms.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>SMSЦентр (<a href="http://www.smsc.ru" target="_blank" rel="nofollow">www.smsc.ru</a>)
					</noindex>
				</li>
				<li>
					<noindex>GSM-Информ (<a href="http://www.gsm-inform.ru" target="_blank"
							rel="nofollow">www.gsm-inform.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Билайн (<a href="http://www.beeline.ru" target="_blank" rel="nofollow">www.beeline.ru</a>).
						Контактное лицо: +7 (968) 970-70-07 (Зудиленков
						Вадим) <a href="mailto:vzudilenkov@beeline.ru">VZudilenkov@beeline.ru</a></noindex>
				</li>
				<li>
					<noindex>SigmaSMS (<a href="https://www.sigmasms.ru" target="_blank"
							rel="nofollow">www.sigmasms.ru</a>). Отправка SMS, Viber, ВКонтакте, чат-боты. Работа в странах СНГ. Контактное лицо: +7 (965) 000-55-66 (Сергеев
						Алексей) <a href="mailto:gd@sigmasms.ru">gd@sigmasms.ru</a></noindex>
				</li>
				<li>
					<noindex>Интеллин (<a href="http://www.intellin.ru" target="_blank"
							rel="nofollow">www.intellin.ru</a>). Контактное лицо: +7 (905) 722-44-79 (Смирнов
						Алексей) <a href="mailto:a.smirnov@intellin.ru">a.smirnov@intellin.ru</a></noindex>
				</li>
				<li>
					<noindex>МТС Коммуникатор (<a href="http://www.mcommunicator.ru" target="_blank"
							rel="nofollow">www.mcommunicator.ru</a>). Контактное лицо: +7 (913) 611-57-39
						(Шайкина Марина) <a href="mailto:mashajki@mts.ru">mashajki@mts.ru</a>, техническая
						поддержка: +7 (913) 155-35-21 (Крупко Пётр) <a
							href="mailto:pakrupko@omsk.mts.ru">pakrupko@omsk.mts.ru</a></noindex>
				</li>
				<li>
					<noindex>TELE2 Бизнес SMS (<a href="http://www.bsms.tele2.ru" target="_blank"
							rel="nofollow">www.bsms.tele2.ru</a>)</noindex>
				</li>
				<li>
					<noindex>Сервис бесплатных уведомлений (<a href="http://www.shkolainfo.ru" target="_blank"
						rel="nofollow">www.shkolainfo.ru</a>) Контактное лицо: 8-800-333-16-50 (Марченко Кристина), <a href="mailto:support@shkolainfo.ru"
						rel="nofollow">support@shkolainfo.ru</a></noindex>
				</li>
			</ul>
			<span class="boldZag">Беларусь</span>
			<ul>
				<li>
					<noindex>SMS-Ассистент BY (<a href="http://www.sms-assistent.by" target="_blank"
							rel="nofollow">www.sms-assistent.by</a>)</noindex>
				</li>
			</ul>
			<span class="boldZag">Казахстан</span>
			<ul>
				<li>
					<noindex>QuickTelecom KZ (<a href="http://www.sms1.kz" target="_blank"
							rel="nofollow">www.sms1.kz</a>)</noindex>
				</li>
				<li>
					<noindex>КазИнфоТех АЦП (<a href="http://kazinfoteh.kz" target="_blank"
							rel="nofollow">kazinfoteh.kz</a>). Контактное лицо: +7 (777) 007-93-83 (Ковалева
						Юлия) <a href="mailto:k.yliya@kazinfoteh.kz">k.yliya@kazinfoteh.kz</a>, техническая
						поддержка: +7 (777) 022-98-31 (Назаров Дмитрий) <a
							href="mailto:support@kazinfoteh.kz">support@kazinfoteh.kz</a></noindex>
				</li>
				<li>
					<noindex>SigmaSMS.kz (<a href="http://www.sigmasms.kz" target="_blank"
						rel="nofollow">www.sigmasms.kz</a>) Служба поддержки: +7 (727) 310-10-21, <a href="mailto:support@shkolainfo.ru"
						rel="nofollow">info@sigmasms.ru</a></noindex>
				</li>
			</ul>
			<span class="boldZag">Украина</span>
			<ul>
				<li>
					<noindex>TurboSMS (<a href="http://www.turbosms.ua" target="_blank"
							rel="nofollow">www.turbosms.ua</a>)</noindex>
				</li>

				<li>
					<noindex>АльфаSMS (<a href="http://www.alphasms.com.ua" target="_blank"
							rel="nofollow">www.alphasms.com.ua</a>)</noindex>
				</li>

				<li>
					<noindex>SpeedSMS (<a href="http://www.speedsms.com.ua" target="_blank"
							rel="nofollow">www.speedsms.com.ua</a>)</noindex>
				</li>
			</ul>
		</div>

		<input type="radio" id="<?=translitIt(strtolower("Внутреннее ПО контроллеров"));?>" <? echo $checkedFour ?>
		name="vkladki">
		<label for="<?=translitIt(strtolower("Внутреннее ПО контроллеров"));?>"><span class="dashed">Внутреннее ПО
				контроллеров</span></label>
		<div>
			<p>Обновить встроенное ПО PERCo-Web контроллеров CL15, CR11, СT13 и CT/L14 можно только с помощью WEB-интерфейса.</p>
			<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
			"IBLOCK_TYPE" => "download",	// Тип инфоблока
			"IBLOCK_ID" => $block_id,	// Инфоблок
			"SECTION_ID" => "",	// ID раздела
			"SECTION_CODE" => "programmnoe-obespechenie-dlya-smeny-proshivok-v-kontrollerakh-cr11-cl15-ct-l13-ct-l14-sistemy-s-20",	// Код раздела
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
			"SECTION_FIELDS" => "",	// Поля разделов
			"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);
			?>
			<table style="width: auto; border: none; margin-left: 20px; margin-top: -10px;">
				<tr>
					<td style="border: none;">Версия прошивки:</td>
					<td style="border: none;">
						<p>CR11, CL15, CT13, CT/L14 - <span class="color">2.2.0.36</span></p>
					</td>
				</tr>
			</table>
			<p>Обновить внутреннее ПО всех остальных контроллеров PERCo можно при помощи программы "Прошиватель", а также при помощи Web-интерфейса (у контроллеров с поддержкой Web-интерфейса).</p>
			<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
			"IBLOCK_TYPE" => "download",	// Тип инфоблока
			"IBLOCK_ID" => $block_id,	// Инфоблок
			"SECTION_ID" => "",	// ID раздела
			"SECTION_CODE" => "programmnoe-obespechenie-dlya-smeny-proshivok-v-kontrollerakh-sistemy-s-20",	// Код раздела
			"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
			"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
			"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
			"SECTION_FIELDS" => "",	// Поля разделов
			"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
			"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
			"CACHE_TYPE" => "A",	// Тип кеширования
			"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
			"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);
			?>
			<table style="width: auto; border: none; margin-left: 20px; margin-top: -10px;">
				<tr>
					<td style="border: none; vertical-align: top;">Версии прошивок:</td>
					<td style="border: none;">
						<p>CT/L04.2, CT03.2, CL05.2, CR01.2 - <span class="color">
							<?php
							$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
								"MODE"      => "html",
								"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
							));
							?>
						</span></p>
						<p>CT/L04, CT03, CL05, CL05.1, CR01 - <span class="color">x.x.8.19</span></p>
						<p>CS01, PU01 - <span class="color">x.x.x.8</span></p>
						<p>CT01, CT02, CL01, CL02, CL03 - <span class="color">x.x.x.30</span></p>
						<p>SC-820 - <span class="color">1.0.0.5</span></p>
					</td>
				</tr>
			</table>
			<p>Программа "Прошиватель" входит в комплект скачиваемого ПО.</p>
			<p>Программа "Прошиватель" не работает с контроллерами CL15, CR11, СT13 и CT/L14.</p>
			<?
			$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
					"IBLOCK_TYPE" => "download",	// Тип инфоблока
					"IBLOCK_ID" => $block_id,	// Инфоблок
					"SECTION_ID" => "",	// ID раздела
					"SECTION_CODE" => "vnutrennee-po-kontrollerov",	// Код раздела
					"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
					"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
					"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
					"SECTION_FIELDS" => "",	// Поля разделов
					"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
					"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
					"CACHE_TYPE" => "A",	// Тип кеширования
					"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
					"CACHE_GROUPS" => "Y",	// Учитывать права доступа
				),
				false
			);
			?>
			<p>Для контроллеров PERCo-CT/L04.2:</p>
			<p>Чтобы поддерживались все возможности контроллеров с прошивкой 
				<?php
				$APPLICATION->IncludeFile("/include/vnutrennee-po-kontrollerov-versiya-proshivki.php", Array(), Array(
					"MODE"      => "html",
					"NAME"      => "Редактировать версию прошивки внутреннего по контроллеров"
				));
				?>, необходимо обновить используемое
				в системе сетевое ПО: PERCo-Web до версии 1.2.0.23, PERCo-S-20(S-20 Школа) - до версии x.9.6.5.</p>
			<p>Для контроллеров PERCo-CT/L04:</p>
			<!--p>При обновлении версий ПО PERCo-S-20, предшествующих версиям 3.6.2.2, обновление прошивок контроллеров
				CT/L04 и встроенных контроллеров электронных проходных требуется только для версий прошивок х.х.х.16 и
				более ранних. Для версий прошивок х.х.0.17 - х.х.1.19 обновление не требуется.</p-->
			<p>При обновлении версий ПО PERCo-S-20, предшествующих версиям 3.6.2.2, для корректной работы необходимо обновление прошивок контроллеров CT/L04 и встроенных контроллеров электронных проходных х.х.х.16 и более ранних.</p>
			<p>Отличия в прошивках:</p>
			<!--ul>
				<li>Версия х.х.1.19 отличается от версий х.х.0.17 - х.х.0.18 наличием нового варианта индикации режимов
					контроля доступа и упрощенным алгоритмом постановки/снятия с охраны</li>
				<li>Версия х.х.0.20 отличается от х.х.1.19 наличием возможности подключения к контроллеру внешних
					верифицирующих устройств (например, алкотестера)</li>
			</ul-->
			<ul>
				<li>Версия х.х.8.19 отличается от версий х.х.0.17 - х.х.0.18 наличием нового варианта индикации режимов контроля доступа и упрощенным алгоритмом постановки/снятия с охраны.</li>
				<li>Версия х.х.8.20 отличается от х.х.8.19 наличием возможности подключения к контроллеру внешних верифицирующих устройств (например, алкотестера). Для получения прошивки х.х.8.20 необходимо отправить запрос в техподдержку – на электронный адрес <a href="mailto:system@perco.ru">system@perco.ru</a> или <a href="mailto:soft@perco.ru">soft@perco.ru</a>.</li>				
			</ul>
			<p><strong>ВАЖНО:</strong> контроллеры с версией прошивки х.х.8.20 не поддерживаются в PERCo-Web.</p>
		</div>

		<input type="radio" id="<?=translitIt(strtolower("Web-интерфейс"));?>" <? echo $checkedFive ?> name="vkladki">
		<label for="<?=translitIt(strtolower("Web-интерфейс"));?>"><span class="dashed">Web-интерфейс</span></label>
		<div>
			<p>Конфигурацию контроллеров новой линейки: выбор исполнительных устройств
				(турникеты, замки, шлагбаумы), их
				количества и режимов работы необходимо производить через Web-интерфейс контроллеров.</p>
			<p>К новой линейке контроллеров относятся CL15, CR11, CT/L14 и CT13 (входит в состав электронной проходной KT02.9B). </p>
			<p>Кроме того, встроенный Web-интерфейс новой линейки контроллеров без установки дополнительного ПО
				позволяет:</p>
			<ul>
				<li>Назначать права доступа сотрудникам и посетителям</li>
				<li>Использовать режимы &laquo;Охрана&raquo; и &laquo;Комиссионирование&raquo;</li>
				<li>Добавлять в систему неограниченное количество идентификаторов</li>
				<li>Создавать встроенные реакции в контроллере</li>
				<li>Назначать временные зоны для создания графиков доступа</li>
				<li>Работать с протоколом https</li>
				<li>Производить диагностику контроллера и обновление встроенного ПО</li>
				<li>Просматривать и сохранять в файл события журнала регистрации</li>
			</ul>

			<div id="horizontal_scroll">
				<ul id="scrollGallery">
					<li>
						<h3></h3>
						<img src="/images/products/web-interface/slides/1.jpg" alt="Вход в систему">
						<div class="text-scroll-gallery">
							<p class="lead">Настройка шаблонов контроллера</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/2.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Настройка параметров «Дата» и «Время»</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/3.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Список событий</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/4.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Управление исполнительными устройствами</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/5.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Выбор шаблона исполнительного устройства</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/6.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Добавление/ удаление исполнительного устройства</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/7.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Создание встроенных реакций в контроллере</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/8.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Добавление/Удаление/Редактирование учетных данных Сотрудников и Посетителей,
								назначение прав доступа</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/9.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Ввод отпечатков пальцев</p>
						</div>
					</li>
					<li>
						<h3></h3>
						<img alt="" src="/images/products/web-interface/slides/10.jpg">
						<div class="text-scroll-gallery">
							<p class="lead">Обновление встроенного ПО и сертификата HTTPS</p>
						</div>
					</li>

				</ul>
			</div>

			<div class="col-table smaller">
				<h2>Сравнение программного обеспечения</h2>
				<table class="col-table-i">

					<tbody>
						<tr>
							<td>
								<p></p>
							</td>
							<td data-id=".info-01">
								<p>ПО PERCo-Web</p>
								<div class="inf_img">
									<img alt="Информация" src="/images/icons/inform-blue.svg">
									<div class="info info-01">Программное обеспечение PERCo-Web, разворачиваемое на
										сервере
										системы, установленном на ПК.</div>
								</div>
							</td>
							<td data-id=".info-02">
								<p>Встроенное ПО PERCo-Web</p>
								<div class="inf_img">
									<img alt="Информация" src="/images/icons/inform-blue.svg">
									<div class="info info-02">Встроенное ПО – программное обеспечение PERCo-Web,
										предустановленное в памяти контроллеров CL15, CT/L14 и терминала учета рабочего
										времени
										CR11. </div>
								</div>
							</td>
							<td data-id=".info-03">
								<p>Web-интерфейс</p>
								<div class="inf_img">
									<img alt="Информация" src="/images/icons/inform-blue.svg">
									<div class="info info-03">Web-интерфейс контроллеров CL15, CT/L14 и терминала
										учета рабочего времени CR11.</div>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<p>Сервер системы</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>встроен</p>
							</td>
							<td>
								<p>не требуется</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Количество контроллеров</p>
							</td>
							<td>
								<p>1000</p>
							</td>
							<td>
								<p>10</p>
							</td>
							<td>
								<p>1</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Количество сотрудников</p>
							</td>
							<td>
								<p>200000</p>
							</td>
							<td>
								<p>500</p>
							</td>
							<td>
								<p>не ограничено</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Количество посетителей</p>
							</td>
							<td>
								<p>200000</p>
							</td>
							<td>
								<p>500</p>
							</td>
							<td>
								<p>не ограничено</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Количество рабочих мест</p>
							</td>
							<td style="border-right:0;">
								<p></p>
							</td>
							<td style="border-right:0; border-left:0;">
								<p>не ограничено</p>
							</td>
							<td style="border-left:0;">
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Установка ПО на рабочие места</p>
							</td>
							<td style="border-right:0;">
								<p></p>
							</td>
							<td style="border-right:0; border-left:0;">
								<p>не требуется</p>
							</td>
							<td style="border-left:0;">
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Кроссплатформенность</p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p>+</p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Работа с различными ОС</p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p>+</p>
							</td>
						</tr>
						<tr>
							<td style="background: none; border-right:0;">
								<p></p>
							</td>
							<td style="border-right:0; border-left:0;">
								<p></p>
							</td>
							<td style="border-right:0; border-left:0;">
								<h4>Функциональные возможности</h4>
							</td>
							<td style="border-left:0;">
								<p></p>
							</td>

						</tr>




						<tr>
							<td>
								<p>Контроль доступа</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Биометрическая идентификация</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Идентификация по смартфону</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Защита от копирования карт</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Разграничение прав операторов</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Учетные данные сотрудников</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Структура подразделений и должностей</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Автозамена учетных данных</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Автозамена шаблонов доступа</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Дизайнер пропусков</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Заказ пропусков</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Отчет по посетителям</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Отчет по событиям</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Отчет о проходах</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Отчет о правах доступа</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Отчет о местонахождении</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Управление устройствами</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Мобильный терминал регистрации</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Верификация</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Глобальный &laquo;Antipassback&raquo;</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Контроль дисциплины</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Учет рабочего времени</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>Интеграция с 1С</p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p>+</p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
						<tr>
							<td>
								<p>API-интерфейс</p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p><strong>+</strong></p>
							</td>
							<td>
								<p></p>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<p id="newcontrollers">Контроллеры PERCo предыдущей линейки имеют встроенный Web-интерфейс с упрощенным
				функционалом, позволяющий:</p>
			<ul>
				<li>Проводить тестирование и настройку контроллеров</li>
				<li>Загружать, просматривать и редактировать список карт сотрудников с указанием ФИО</li>
				<li>Просматривать и сохранять в файл событий журнала регистрации.</li>
			</ul>
		</div>

		<input type="radio" id="<?=translitIt(strtolower("Локальное ПО"));?>" <? echo $checkedSeven ?> name="vkladki">
		<label for="<?=translitIt(strtolower("Локальное ПО"));?>"><span class="dashed">Локальное ПО</span></label>
		<div>
		<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "lokalnoe-programmnoe-obespechenie-s-20",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			),
			false
		);
		?>
			<p>Локальное ПО PERCo-SL01; PERCo-SL02, версий 5.3.1.1. поддерживает работу с контроллерами: CTL04.2;
				CL05.2; CL201.1; CR01.2.</p>
			<p>Для работы с контроллерами новой линейки: CL15, CR11, CT/L14 используется встроенное программное
				обеспечение PERCo-Web.</p>
			<p>Локальное программное обеспечение поддерживается следующими ОС:</p>
			<ul>
				<li>Windows Server 2003 SP1</li>
				<!--li>Windows XP SP3</li-->
				<!--li>Windows Vista SP2</li-->
				<li>Windows 7 PRO</li>
				<li>Windows Server 2008</li>
				<li>Windows Server 2008 R2</li>
				<!--li>Windows 8.x</li-->
				<li>Windows 10</li>
				<li>Windows Server 2012</li>
				<li>Windows Server 2012 R2</li>
				<li>Windows Server 2016</li>
			</ul>
			<p>После установки Локального программного обеспечения с верификацией PERCo-SL02 на компьютер пользователя
				имеется возможность ознакомительной эксплуатации в течение 30 дней. Для продолжения эксплуатации
				программного обеспечения необходимо его приобрести, получить лицензию на право использования и внести в
				ПО код активации, указанный в лицензии. По истечении 30-ти дневного срока, без внесенного кода активации
				запуск ПО будет невозможен. Для бесплатного Локального программного обеспечения PERCo-SL01
				лицензирование не требуется.</p>
		</div>
		<input type="radio" id="<?=translitIt(strtolower("Архив ПО"));?>" <? echo $checkedEight ?> name="vkladki">
		<label for="<?=translitIt(strtolower("Архив ПО"));?>"><span class="dashed">Архив ПО</span></label>
		<div>



			<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "files_tree", Array(
		"IBLOCK_TYPE" => "download",	// Тип инфоблока
		"IBLOCK_ID" => $block_id,	// Инфоблок
		"SECTION_ID" => "",	// ID раздела
		"SECTION_CODE" => "sistemy-kontrolya-dostupa",	// Код раздела
		"SECTION_URL" => "",	// URL, ведущий на страницу с содержимым раздела
		"COUNT_ELEMENTS" => "N",	// Показывать количество элементов в разделе
		"TOP_DEPTH" => "2",	// Максимальная отображаемая глубина разделов
		"SECTION_FIELDS" => "",	// Поля разделов
		"SECTION_USER_FIELDS" => array("UF_ARCHIVE"),	// Свойства разделов
		"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
		"CACHE_TYPE" => "A",	// Тип кеширования
		"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
		"CACHE_GROUPS" => "Y",	// Учитывать права доступа
			),
			false
		);
		?>
		</div>
	</div>
</div>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>