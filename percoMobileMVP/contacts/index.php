<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');

$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lightgallery.min.js");
$APPLICATION->AddHeadScript("/scripts/lightslider/js/lightslider.min.js");
$APPLICATION->AddHeadScript("/scripts/lightgallery/js/lg-zoom.min.js");
$APPLICATION->SetAdditionalCSS("/scripts/lightgallery/css/lightgallery.min.css");
$APPLICATION->SetAdditionalCSS("/scripts/lightslider/css/lightslider.min.css");

?> 
<script>
	app.setPageTitle({
         title: "Контакты"
	  }); 
</script>
<style> 
        
        #contacts,
        #change_products,
        #qrcode {
            display: flex;
        }
        
        div#content>div:last-child {
            margin-top: -60px;
        }
        
        #contacts>div {
            width: 50%;
        }
        
        #contacts>div:first-child {
            margin-right: 30px;
        }
        
        #contacts>div:first-child>div {
            border-bottom: 1px solid #BDBEC0;
            padding-bottom: 20px;
        }
        
        #change_products {
            justify-content: space-between;
        }
        
        #qrcode {
            flex-direction: column;
            margin-right: 20px;
            margin-top: 70px;
            text-align: center;
        }
        
        #content>div:last-child {
            margin-top: 30px;
        }
        
        #feedback {
            margin-top: 20px;
        }
        
        dl {
            padding-left: 10px;
            padding-right: 5px;
        }
        
        dd {
            /*padding-left: 25px;*/
        }
        
        dt {
            font-weight: bold;
        }
        
        .map a {
            cursor: pointer;
            text-decoration: underline;
        }
        
        iframe.lg-object {
            box-shadow: none !important;
        }
        
        div.line {
            width: calc(100% - 20px);
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        
        div.line div.col-2 {
            width: calc(50% - 80px);
            min-width: 320px;
        }
        
        div.box-before div.space {
            height: 20px;
        }
        
        div.box-before>p {
            margin: 15px 50px;
            margin-top: 0;
        }
        
        div.box-before {
            border: 1px solid #BCBEC0;
            padding: 10px;
            width: calc(100% - 40px);
            min-width: 280px;
            min-height: 154px;
            margin: 20px;
            margin-bottom: 30px;
            margin-top: 100px;
        }
        
        div.head-box-before {
            width: 100%;
        }
        
        dd {
            display: flex;
            min-height: 30px;
        }
        
        .box-before dd::before {
            content: " ";
            font-size: 0;
            display: block;
            margin-right: -20px;
            position: relative;
            top: 0px;
            left: -30px;
            width: 25px;
            min-height: 30px;
            background-repeat: no-repeat;
            background-size: contain;
        }
        
        .box-before dl div.mail-group dd::before {
            top: 3px;
            width: 15px;
        }
        
        dd.telephone::before {
            background-image: url(../img/k-telefon.png);
        }
        
        dd.telegram::before {
            background-image: url(../img/k-telegram.png);
        }
        
        dd.mail::before {
            background-image: url(../img/k-konvert.png);
        }
        
        dd.addres::before {
            background-image: url(../img/k-geotag.png);
        }
        
        dd.time::before {
            background-image: url(../img/k-chasy.png);
        }
        
        dd.viber::before {
            background-image: url(../img/k-viber.png);
        }
        
        dd.car::before {
            background-image: url(../img/k-avto.png);
        }
        
        div.mail-group dd {
            margin-left: 45px;
        }
        
        div.mail-group {
            margin-left: 30px;
            margin-top: -31px;
        }
        
        div.box-before h2::before {
            content: "";
            font-size: 0;
            display: block;
            margin-right: -20px;
            position: relative;
            top: -10px;
            left: -30px;
            width: 50px;
            height: 80px;
            background-color: white;
            background-repeat: no-repeat;
        }
        
        h2#adress::before {
            background-image: url(../img/contacts/1-adress.jpg);
            background-size: contain;
        } 
        h2#storage::before {
            background-image: url(../img/contacts/2-storage.jpg);
            background-size: contain;
        }
        
        h2#products::before {
            background-image: url(../img/contacts/3-products.jpg);
            background-size: contain;
        }
        
        h2#requisites::before {
            background-image: url(../img/contacts/4-requisites.jpg);
            background-size: contain;
        }
        
        h2#techsupport::before {
            background-image: url(../img/contacts/5-techsupport.jpg);
            background-size: contain;
        }
        
        h2#personal::before {
            background-image: url(../img/contacts/6-personal.jpg);
            background-size: contain;
        }
        h2#lerning::before {
            background-image: url(../img/contacts/7-lerning.jpg);
            background-size: contain;
        }
        
        div.contacts h2 {
            display: flex;
            justify-content: flex-start;
            height: 50px;
            width: max-content;
            margin: 0;
            padding: 0;
            padding-left: 10px;
            padding-right: 10px;
            margin-bottom: -26px;
            position: relative;
            top: -27px;
            background-color: white;
            font-size: 25px;
        }
        
        div.tabs {
            margin: 0;
            padding: 0;
        }
        
        div.tabs>input:checked+label,
        div.tabs>input:not(:checked)+label,
        div.tabs>input:not(:checked)+label:hover {
            background: none;
            border: 0;
            color: #003C8E;
            /* text-decoration: underline; */
        }
        
        div.tabs>input:checked+label {
            text-decoration: underline;
        }
        
        div.tabs>input:checked+label+div {
            margin-top: 5px;
        }
        
        div.tabs span {
            border: 0;
        }
        
        p img {
            margin-right: 10px;
        }
        
        dd.map img {
            margin-right: 40px;
            margin-top: 0;
            width: 100px;
        }
        
        dd.map,
        div.pdf-box {
            display: flex;
            justify-content: flex-start;
            align-items: center;
        }
        
        div.pdf-box img {
            margin-right: 10px;
        }
        
        div.pdf-box {
            margin-left: 81px;
            margin-bottom: 20px;
        }
        
        body #container,
        body #container p {
            font-size: 17px;
        }
        
        @media screen and (max-width: 1280px) {
            div.line div.col-2 {
                width: calc(50% - 20px);
            }
        }
        
        @media screen and (max-width: 1017px) {
            div.contacts h2 {
                font-size: 20px;
            }
        }
        
        @media screen and (max-width: 900px) {
            #contacts {
                flex-direction: column;
                margin-top: 0;
            }
            #contacts>div:first-child {
                margin-right: 0;
            }
            #contacts>div {
                width: auto;
            }
            #qrcode {
                display: none;
            }
        }
        
        @media screen and (max-width: 840px) {
            div.line {
                display: block;
            }
            div.line div.col-2 {
                width: calc(100% - 20px);
            }
        }
        
        @media screen and (max-width: 500px) {
            dd {
                padding-left: 0;
            }
        }
        
        @media screen and (max-width: 390px) {
            div.box-before h2 {
                font-size: 17px;
                width: auto;
            }
        }
    </style>

    <div class="contacts">
        <div class="line">
            <div class="col-2">
                <div class="box-before">
                    <h2 id="adress">Адрес</h2>
                    <div class="tabs">
                        <input type="radio" checked="" id="adress__spb" name="vyborAdress">
                        <label for="adress__spb"><span class="dashed">Санкт-Петербург</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <dl>
                                <dd class="addres">194021, Россия, Санкт-Петербург,<br> Политехническая ул., д. 4, корпус 2, строение 1<br> </dd>
                            </dl>
                            <dl>
                                <dd class="map">
                                    <a data-src="/kontakty/spb.php?iframe=true&amp;map=yandex&amp;type=offise" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                    <a data-src="/kontakty/spb.php?iframe=true&amp;map=google&amp;type=offise" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                </dd>
                            </dl>
                        </div>
                        <input type="radio" id="adress__pskov" name="vyborAdress">
                        <label for="adress__pskov"><span class="dashed">Псков</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <dl>
                                <dd class="addres"><span><span itemprop="postalCode">180600</span>, <span itemprop="addressLocality">Россия, Псков</span><br>
                                    <span itemprop="streetAddress"> ул. Леона Поземского 123В</span></span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="map">
                                    <a data-src="/kontakty/pskov-zavod.php?iframe=true&amp;map=yandex" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                    <a data-src="/kontakty/pskov-zavod.php?iframe=true&amp;map=google" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                </div>
                <div class="box-before">
                    <h2 id="products">Выбор и приобретение продукции</h2>
                    <div class="tabs">
                        <input type="radio" checked="" id="russia" name="vyborProd">
                        <label for="russia"><span class="dashed">Россия</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <dl>
                                <dd class="telephone"><span><span itemprop="telephone">
									
									
                                    <span itemprop="telephone">+7 (812) 247-04-57</span></span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="mail"><a href="mailto:mail@perco.ru"><span itemprop="email">
										mail@perco.ru</span></a>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="addres">194021, Россия, Санкт-Петербург,<br> Политехническая ул., д. 4, корпус 2, строение 1<br> 9:00–18:00 (мск), по рабочим дням</dd>
                            </dl>
                            <p style="padding-left: 40px; margin: 30px 50px 15px 40px;">
                                <a href="https://www.youtube.com/percoru" rel="nofollow" target="_blank"><img alt="youtube" src="/images/icons/you.svg" width="30px" height="30px"></a>

                                <a href="https://www.instagram.com/perco_com/" style="margin-right: 10px;" rel="nofollow" target="_blank"><img alt="twitter" src="/images/icons/inst.svg" width="30px" height="30px"></a>
                            </p>
                        </div>
                        <input type="radio" id="uae" name="vyborProd">
                        <label for="uae"><span class="dashed">ОАЭ</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <dl>
                                <dd class="telephone"><span><span itemprop="telephone">+971 04 249 8603</span></span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="wa"><span><span itemprop="telephone">+971 55 377 3539</span></span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="mail"><a href="mailto:sales@perco.ae"><span itemprop="email">sales@perco.ae</span></a>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="addres">Burlington Tower, Business Bay, Dubai, UAE<br>8:00 – 17:00, Воскресенье – Четверг</dd>
                            </dl>
                            <p style="padding-left: 40px; margin: 30px 50px 15px 40px;">
                                <a href="https://www.youtube.com/percoru" rel="nofollow" target="_blank"><img alt="youtube" src="/images/icons/you.svg" width="30px" height="30px"></a>

                                <a href="https://www.instagram.com/perco_com/" style="margin-right: 10px;" rel="nofollow" target="_blank"><img alt="twitter" src="/images/icons/inst.svg" width="30px" height="30px"></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="box-before">
                    <h2 id="techsupport">Техническая поддержка</h2>
                    <dl>
                        <dd class="telephone"><span>8-800-775-37-05<br>+7 (812) 247-04-55</span></dd>
                    </dl>
                    <dl>
                        <dd class="telegram"><a href="https://t.me/PERCo_Service_Bot" target="_blank">@PERCo_Service_Bot</a></dd>
                    </dl>
                    <dl>
                        <dd class="mail"></dd>
                        <div class="mail-group">
                            <dd id="techsupport-mail-1"><a href="mailto:system@perco.ru">
								system@perco.ru</a></dd>
                            <dd id="techsupport-mail-2"><a href="mailto:turniket@perco.ru">
								turniket@perco.ru</a></dd>
                            <dd id="techsupport-mail-3"><a href="mailto:soft@perco.ru">
								soft@perco.ru</a></dd>
                            <dd id="techsupport-mail-4"><a href="mailto:locks@perco.ru">
								locks@perco.ru</a></dd>
                            <dd id="techsupport-mail-5"><a href="mailto:service@perco.ru">
								service@perco.ru</a></dd>
                        </div>
                    </dl>
                    <dl>
                        <dd class="time">9:00–17:45 (мск), по рабочим дням</dd>
                        <!--dd class="time">
						специалисты по турникетам и контроллерам<br>
						9:00–17:45 (мск), по рабочим дням,<br>
						специалист по ПО<br>
						9:00–17:45 (мск), по рабочим дням
					</dd-->
                    </dl>

                    <dl>
                        <dd class="car">
                            <span>
							Курьерская доставка: <span itemprop="postalCode">194021</span>,
                            <span itemprop="addressLocality">Россия, <br>Санкт-Петербург,</span>
                            <span itemprop="streetAddress">Политехническая ул., д. 4,<br>корпус 2, строение 1</span><br> ООО «ПЭРКО», ИНН 7806437448<br>
                            <span itemprop="telephone">+7 (812) 247-04-54</span><br> с 9:00 до 17:30 по рабочим дням
                            </span>
                        </dd>
                    </dl>
                </div>
                <div class="box-before">
                    <h2 id="lerning">Сотрудничество и обучение</h2>
                    <dl>
                        <dd class="telephone">+7 (812) 247-04-59</dd>
                    </dl>
                    <dl>
                        <dd class="mail"><a href="mailto:seminar@perco.ru">seminar@perco.ru</a></dd>
                    </dl>
                </div>
            </div>

            <div class="col-2">
                <div class="box-before">
                    <h2 id="storage">Склады</h2>

                    <div class="tabs">
                        <input type="radio" id="moscow" name="vkladki">
                        <label for="moscow"><span class="dashed">Москва</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <span style="display: none;" itemprop="name">PERCo – производство турникетов, систем
							безопасности и
							контроля доступа (СКУД)</span>
                            <dl>
                                <dd class="telephone">
                                    <span>
									<span itemprop="telephone">+7 (495) 786-96-72</span><br>
                                    <!--span itemprop="telephone">+7 (962) 966-34-87</span-->
                                    </span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="mail">
                                    <a href="mailto:moscow@perco.ru">
                                        <span itemprop="email">moscow@perco.ru</span>
                                    </a>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="time">
                                    <span>9:00–17:30 (мск), по рабочим дням</span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="addres">
                                    <span>
									<span itemprop="postalCode">143400</span>,
                                    <span itemprop="addressLocality">Россия, Московская обл,<br> Красногорский р-он</span>,
                                    <span itemprop="streetAddress">Гольево, <br>ул. Центральная, стр.6 "Б"</span>.
                                    </span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="map">
                                    <a data-src="/kontakty/moscow.php?iframe=true&amp;map=yandex" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                    <a data-src="/kontakty/moscow.php?iframe=true&amp;map=google" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                </dd>
                            </dl>
                            <div class="pdf-box">
                                <img width="20" height="16" src="/images/icons/pdf.svg">
                                <a href="/download/other/proezd-k-skladu-v-moskve.pdf" target="_blank" onclick="ga('send', 'event', {'eventCategory': 'Контакты', 'eventAction': 'download', 'eventLabel': 'Проезд до склада в Москве'});" download="">Как добраться общественным транспортом</a>
                            </div>


                        </div>
                        <input type="radio" id="spb" name="vkladki" checked="checked">
                        <label for="spb"><span class="dashed">Санкт-Петербург</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <span style="display: none;" itemprop="name">PERCo – производство турникетов, систем
							безопасности и
							контроля доступа (СКУД)</span>
                            <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">

                                <dl>
                                    <dd class="telephone"><span itemprop="telephone">+7 (812) 247-04-54</span></dd>
                                </dl>
                                <dl>
                                    <dd class="mail"><a href="mailto:dl@perco.ru"><span itemprop="email">dl@perco.ru</span></a></dd>
                                </dl>
                                <dl>
                                    <dd class="time">9:00–17:30 (мск), по рабочим дням</dd>
                                </dl>
                                <dl>
                                    <dd class="addres"><span><span itemprop="postalCode">194021</span>, <span itemprop="addressLocality">Россия,
											Санкт-Петербург</span><br><span itemprop="streetAddress">Политехническая
											ул., д. 4, корпус 2, строение
											1</span></span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dd class="map">
                                        <a data-src="/kontakty/spb.php?iframe=true&amp;map=yandex" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                        <a data-src="/kontakty/spb.php?iframe=true&amp;map=google" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <input type="radio" id="pskov" name="vkladki">
                        <label for="pskov"><span class="dashed">Псков</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <span style="display: none;" itemprop="name">PERCo – производство турникетов, систем
							безопасности и
							контроля доступа (СКУД)</span>
                            <div itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">


                                <dl>
                                    <dd class="telephone"><span itemprop="telephone">+7 (8112) 23-07-40</span></dd>
                                </dl>
                                <dl>

                                    <dd class="mail">
                                        <a href="mailto:warehouse@perco.ru">
                                            <span itemprop="email">warehouse@perco.ru</span>
                                        </a>
                                    </dd>
                                </dl>
                                <dl>

                                    <dd class="time">8:00–16:30 (мск), по рабочим дням</dd>
                                </dl>
                                <dl>
                                    <dd class="addres"><span><span itemprop="postalCode">180006</span>, <span itemprop="addressLocality">Россия, Псков</span><br>
                                        <span itemprop="streetAddress"> ул. Леона Поземского, д. 110д, лит. В, пом.
											1001</span></span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dd class="map">
                                        <a data-src="/kontakty/pskov.php?iframe=true&amp;map=yandex" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                        <a data-src="/kontakty/pskov.php?iframe=true&amp;map=google" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                    </dd>
                                </dl>
                            </div>
                        </div>
                        <input type="radio" id="tal" name="vkladki">
                        <label for="tal"><span class="dashed">Таллинн</span></label>
                        <div class="item" itemprop="address" itemscope="" itemtype="http://schema.org/PostalAddress">
                            <dl>
                                <dd class="time">8:00 - 16:00, по рабочим дням</dd>
                            </dl>
                            <dl>
                                <dd class="addres"><span><span itemprop="addressLocality">Эстония, Таллинн</span><br>
                                    <span itemprop="streetAddress">45 Akadeemia str.</span></span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="map">
                                    <a data-src="/kontakty/tallin.php?iframe=true&amp;map=yandex" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                    <a data-src="/kontakty/tallin.php?iframe=true&amp;map=google" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                </dd>
                            </dl>
                        </div>
                        <input type="radio" id="rot" name="vkladki">
                        <label for="rot"><span class="dashed">Роттердам</span></label>
                        <div class="item" itemscope="" itemtype="http://schema.org/Organization">
                            <dl>
                                <dd class="time">7:30 - 15:30, по рабочим дням</dd>
                            </dl>
                            <dl>
                                <dd class="addres"><span><span itemprop="addressLocality">Нидерланды, Роттердам</span><br>
                                    <span itemprop="streetAddress">Ringdijk 374 - 378, 2983 GS Ridderkerk</span></span>
                                </dd>
                            </dl>
                            <dl>
                                <dd class="map">
                                    <a data-src="/kontakty/rotterdam.php?iframe=true&amp;map=yandex" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
                                    <a data-src="/kontakty/rotterdam.php?iframe=true&amp;map=google" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
                                </dd>
                            </dl>
                        </div>
                    </div>
                    <p><a href="/kontakty/samovyvoz.php">Правила получения оплаченного оборудования на условиях
						самовывоза</a></p>
                </div>
                <div class="box-before">
                    <h2 id="requisites">Реквизиты компании</h2>
                    <dl>
                        <dd>Общество с ограниченной ответственностью «ПЭРКО»</dd>
                    </dl>
                    <dl>
                        <dd class="mail"><a href="mailto:info@perco.ru">info@perco.ru</a>&nbsp;для официальных обращений</dd>
                    </dl>
                    <dl>
                        <dd class="addres">Юридический адрес: 194021, Санкт-Петербург,<br>ул. Политехническая, дом 4, корпус 2, строение 1</dd>
                        <dd>Фактический адрес: 194021, Санкт-Петербург,<br>ул. Политехническая, дом 4, корпус 2, строение 1</dd>
                    </dl>
                    <dl>
                        <dd class="bank-details">
                            ОГРН 1107847252611<br> ИНН 7806437448 КПП 780201001<br> р/сч 40702810880000006399<br> Филиал Удельный Банка ВТБ (ПАО)<br>в Санкт-Петербурге г. Санкт-Петербург<br> БИК 044030704 к/сч 30101810200000000704
                        </dd>
                    </dl>
                    <dl>
                        <dd>
                            ОКПО 67455649<br> ОКАТО 40265562000.<br> ОКТМО 40315000<br> ОКВЭД 26.11, 25.61, 46.52.2, 68.2
                        </dd>
                    </dl>
                    <dl>
                        <dd class="telephone"><span itemprop="telephone">(812) 247-04-52, 247-04-50</span></dd>
                    </dl>
                </div>
                <div class="box-before">
                    <h2 id="personal">Служба персонала</h2>
                    <dl>
                        <dd class="telephone">+7 (812) 247-04-51 (Санкт-Петербург)<br> +7 (8112) 79-47-01 (Псков)<br> +7 (8112) 79-47-04 (Псков)<br>
                        </dd>
                    </dl>
                    <dl>
                        <dd class="mail"><a href="mailto:ok@perco.ru">ok@perco.ru</a></dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>