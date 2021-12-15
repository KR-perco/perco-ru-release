<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');

// $APPLICATION->AddHeadScript("/scripts/lightgallery/js/lightgallery.min.js");
// $APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.min.js");
// $APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-zoom.min.js");
// $APPLICATION->SetAdditionalCSS("/scripts/lightgallery/css/lightgallery.min.css");
// $APPLICATION->SetAdditionalCSS("/scripts/lightslider/css/lightslider.min.css");

?> 
<script>
	app.setPageTitle({
         title: "О компании"
	  }); 
</script>
<style> 
 
		.cell-6 {
			max-width: 50%;
			-ms-flex-preferred-size: 50%;
			flex-basis: 50%;
		}
		.icon__signature {
			display: flex;
			justify-content: center;
			align-items: center; 
			padding-right: 35px;
		}
		.icon__item {
			display: flex;
			padding-bottom: 60px;
		}
		.icon__item figure {
			height: 43px;
			width: 90px;
			-webkit-box-flex: 0;
			-ms-flex: 0 0 90px;
			flex: 0 0 90px;
    		margin: 0 15px;
			padding-top: 26px;
		}
		.icon-about-1 { 
			line-height: 31px;
    		font-size: 31px;
			text-align: center;
			display: block;
			color: #214584;
			font-weight: bold;
			background: url(https://www.perco.ru/images/icons/years.svg) no-repeat center center transparent;  
		}
		.icon-about-2 {
			background: url(https://www.perco.ru/images/icons/map.svg) no-repeat center center transparent;
		}
		.icon-about-3 {
			background: url(https://www.perco.ru/images/icons/zavod.svg) no-repeat center center transparent; 
		}
		.icon-about-4 {
			background: url(https://www.perco.ru/images/icons/services.svg) no-repeat center center transparent; 
		}
		.icon-about-5 {
			background: url(https://www.perco.ru/images/icons/5-guaranty.svg) no-repeat center center transparent; 
		}
		.icon-about-6 {
			background: url(https://www.perco.ru/images/icons/support.svg) no-repeat center center transparent; 
		}
        .about-content {
			background-color: white; 
        }  
		.about-content__header {
			font-weight: bold;
			margin: 0;
			text-align: center;
    		line-height: 120px;
			font-size: 34px;
		}
		#content.about-content {
			margin: 0;
		} 
		.header__text_white {
			font-size: 48px;
		}
		.about__text, .about__text_icons {
			font-size: 18px;
			width: 70%;
			margin: 25px auto;
			line-height: 1.3em;
		}
		.row {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-flex: 1;
			-ms-flex: 1 1 auto;
			flex: 1 1 auto;
			-webkit-box-orient: horizontal;
			-webkit-box-direction: normal;
			-ms-flex-direction: row;
			flex-direction: row;
			-ms-flex-wrap: wrap;
			flex-wrap: wrap;
			margin-left: -15px;
			margin-right: -15px;
		}
		.about__text ul {
			flex: 1 1 100%;
		}
		.about__text li {
    		list-style-image: url(https://www.perco.ru/images/icons/list-disc.svg);
		}
		.about-title { 
			-webkit-font-smoothing: antialiased;
			text-rendering: optimizeLegibility;
			text-size-adjust: 100%;
			-webkit-tap-highlight-color: transparent;
			-webkit-box-direction: normal;
			visibility: visible;
			box-sizing: inherit;
			margin: 0;
			padding: 0;
			vertical-align: baseline;
			position: absolute;
			font-weight: 300;
			line-height: 1.1em;
			color: #FFFFFF;
			z-index: 5;
			text-align: right;
			width: 106px;
			font-size: 7px;
			top: 127px;
			right: calc(50% + 16px);
		}
		.about-title + .about-title { 
			right: 17px; 
		}
		.years, .text_on_map {
			color: #fff;
			position: absolute;
			text-shadow: -1px -1px 0 #a1b2cb, 1px -1px 0 #a1b2cb, -1px 1px 0 #a1b2cb, 1px 1px 0 #02316b;
		}
		.about-content .icon {
			position: relative;
		}
		.text_on_map { 
			font-size: 28px;
			left: 49px;
			top: 5px;
		}
		.years { 
			font-size: 28px;
			left: auto;
			top: 1px;
			position: relative;
		}
		@media (max-width: 1092px) {
			.cell-12-sm {
				max-width: 100%;
				-ms-flex-preferred-size: 100%;
				flex-basis: 100%;
			}
			.about__text, .about__text_icons {
				font-size: 16px; 
			}
			.icon__item figure {
				height: 50x;
				width: 90px;
				-webkit-box-flex: 0;
				-ms-flex: 0 0 90px;
				flex: 0 0 90px;
    			padding-top: 22px;
			}
			.icon-about-1 {
				line-height: 30px;
				font-size: 27px;
			}
			.icon__item {
				padding-bottom: 35px;
			}
		} 
</style> 
<div class="about-content">
	<h1 class="about-content__header"> Почему PERCo</h1>  
	<div class="img-holder"> 
		<div class="about-title about-title-1">Главный офис PERCo</div>
		<div class="about-title about-title-2">Завод PERCo</div>
		<img width="100%" class="about__image" src="https://www.perco.ru/percoMobileMVP/img/about/about_photos.png" />  
	</div>
	<div id="content_flat"> 
		<div class="about__text"> 
			<div class="row">
				PERCo - ведущий российский производитель систем и оборудования безопасности.<br>
				PERCo разрабатывает и выпускает:  
				<ul>
					<li>шлагбаумы</li>
					<li>турникеты</li>
					<li>замки</li>
					<li>контроллеры и считыватели</li>
					<li>системы контроля доступа </li>
				</ul>
			</div> 
		</div> 
		<div class="about__text_icons">
			<div class="row">
				<div class="icon__item cell-6 cell-12-sm">
					<figure class="icon icon-about-2"><span class="text_on_map">92</span></figure><span class="icon__signature"><p>Продажив 92 странах мира</p></span>
				</div>
				<div class="icon__item cell-6 cell-12-sm">
					<figure class="icon icon-about-1"> <span class="years">33</span> </figure><span class="icon__signature">33 года работы на рынке</span>
				</div>
				<div class="icon__item cell-6 cell-12-sm">
					<figure class="icon icon-about-3"></figure><span class="icon__signature">Современный завод по производству оборудования безопасности</span>
				</div>
				<div class="icon__item cell-6 cell-12-sm">
					<figure class="icon icon-about-4"></figure><span class="icon__signature">400 дилерови 45 сервисных центров</span>
				</div>
				<div class="icon__item cell-6 cell-12-sm">
					<figure class="icon icon-about-5"></figure><span class="icon__signature">Гарантийный срок на оборудование PERCo - 5 лет</span>
				</div>
				<div class="icon__item cell-6 cell-12-sm">
					<figure class="icon icon-about-6"></figure><span class="icon__signature">Техподдержкаи обучение</span>
				</div>
			</div> 
		</div> 
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>