<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Проектировщикам и инсталляторам | PERCo");
$APPLICATION->SetPageProperty("description", "Для удобства проектировщиков и инсталляторов PERCo предлагает полный комплект инструментов: библиотека моделей ArchiCAD, библиотека моделей AutoCAD, схемы подключения оборудования и программа 3D-визуализации проходных");
$APPLICATION->SetPageProperty("keywords", "проектировщики, инсталляторы");
$APPLICATION->SetTitle("Проектировщикам и инсталляторам");

$APPLICATION->SetAdditionalCSS("/css/proektirovshchikam-i-installyatoram.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/proektirovshchikam-i-installyatoram.js"); // подключение скриптов
?>
<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Проектировщикам и инсталляторам" src="/images/icons/designers-installers.svg" />
	</div>
	<div id="proekt_block">
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/novoe.php">
				<div>
					<img src="/images/support/novoe-v-tovarah.jpg" alt="Новое в товарах" >
					<div class="name">Новое в товарах</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/biblioteka-modelei.php">
				<div>
					<img src="/images/support/biblioteka-modelei.jpg" alt="Библиотека моделей" >
					<div class="name">Библиотека моделей</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/tehnicheskiy-katalog.php">
				<div>
					<img src="/images/support/tehnicheskiy-katalog.jpg" alt="Технический каталог" >
					<div class="name">Каталоги оборудования и запчастей</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/programma-vizualizacii.php">
				<div>
					<img src="/images/support/programma-vizualizacii.jpg" alt="Программа визуализации" >
					<div class="name">Программа визуализации</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		
		<div class="proekt-item">
			<a href="http://export.perco.ru/">
				<div>
					<img src="/images/support/dlya-saitov-partnerov.jpg" alt="Для сайтов партнеров" >
					<div class="name">Для сайтов партнеров</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/marketing.php">
				<div>
					<img src="/images/support/marketing.jpg" alt="Маркетинг" >
					<div class="name">Маркетинговая поддержка партнеров</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item" style="display: none;">
			<a href="/podderzhka/katalogi-i-buklety.php">
				<div>
					<img src="/images/support/pomosh-v-provedenii-seminarov.jpg" alt="Помощь в проведении выставок и семинаров" >
					<div class="name">Помощь в проведении выставок и семинаров</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/partner.php">
				<div>
					<img src="/images/support/partner.jpg" alt="Как стать партнером" >
					<div class="name">Как стать партнером</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/uniform.php">
				<div>
					<img src="/images/support/uniform.jpg" alt="Спецодежда" >
					<div class="name">Спецодежда</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
		<div class="proekt-item">
			<a href="/podderzhka/proektirovshchikam-i-installyatoram/auth.php">
				<div>
					<img src="/images/support/vhod-v-lichniy-kabinet.jpg" alt="Вход в личный кабинет" >
					<div class="name">Вход в личный кабинет</div>
					<div class="more">
						<div>подробнее</div>
						<div class="arrow"><? include($_SERVER["DOCUMENT_ROOT"]."/images/icons/arrow_mini.svg");?></div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>