<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->
<!-- lightgallery plugins -->
<!-- <script src="/scripts/lightgallery/js/lg-thumbnail.min.js"></script>
<script src="/scripts/lightgallery/js/lg-fullscreen.min.js"></script> -->
<?
if ($_GET["tab"] != '') $checkedId = $_GET["tab"];
$checked = 'checked="checked"';

switch ($checkedId){
	case "preimuschestva":
	$checkedFirst = $checked;
	break;
	case "klyuchevye-vozmozhnosti":
	$checkedSecond = $checked;
	break;
	case "vybor-po":
	$checkedThree = $checked;
	break;
	case "skachat":
	$checkedFour = $checked;
	break;
	default:
	$checkedFirst = $checked;
}
?>
<div class="demo-button">
    <div class="banner-link" id="video-gallery">
        <a href="https://www.youtube.com/watch?v=iSaqzXq6qc4" data-download-url="/video/PERCo-Web.mp4">
            <div class="banner-link-inter">
                <p>смотреть видео</p>
                <img src="/images/sistema-kontrolya-dostupa-perco-web/video.svg">
            </div>
        </a>
    </div>
</div>
<div style="clear: both"></div>
<div class="box">
    <div class="col-3 hide" id="video-gallery-two">
        <a href="https://www.youtube.com/watch?v=iSaqzXq6qc4" data-download-url="/video/PERCo-Web.mp4">
            <img src="/images/sistema-kontrolya-dostupa-perco-web/video.svg">
            <span class="head-emulate">Cмотреть видео</span>
            <!-- <span class="try">Попробовать&nbsp;</span> -->
        </a>
    </div>
    <div class="col-3">
        <a href="http://percoweb.com/">
            <img src="/images/sistema-kontrolya-dostupa-perco-web/po-demo-mounting-area.svg">
            <span class="head-emulate">Online демоверсия</span>
            <span class="try">Попробовать&nbsp;</span>
        </a>
    </div>
    <div class="col-3">
        <a href="/products/po-sistemy-kontrolya-dostupa-perco-web/">
            <img src="/images/sistema-kontrolya-dostupa-perco-web/po-mounting-area.svg">
            <span class="head-emulate">Программное обеспечение</span>
            <span class="try">Перейти&nbsp;</span>
        </a>
    </div>
    <div class="col-3">
        <a href="/products/kontrollery-schityvateli/">
            <img src="/images/sistema-kontrolya-dostupa-perco-web/reader-mounting-area.svg">
            <span class="head-emulate">Оборудование</span>
            <span class="try">Перейти&nbsp;</span>
        </a>
    </div>
</div>
<div class="preview-block">
	<div style="margin-right: 32px; margin-left: 4px; width: 40%;">
		<iframe style="width: 460px; height: 257px; border: 1px solid rgb(230, 230, 230);" src="https://www.youtube.com/embed/krK_t2QV-8Q?showinfo=0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	</div>
	<p style="width: 60%;">Система контроля доступа PERCo-Web - это удобный инструмент для эффективного управления предприятием.
    Система предназначена для усиления безопасности и повышения дисциплины труда персонала. PERCo-Web позволяет
    организовать защиту от доступа посторонних, разграничение прав доступа сотрудников и посетителей и учет рабочего
    времени сотрудников. В качестве идентификаторов в системе используются биометрические данные, карты доступа с
    защитой от копирования и смартфоны с NFC-модулем.</p>
</div>

<div class="tabs">
    <input name="vkladki" type="radio" <?= $checkedFirst ?> id="preimuschestva"><label for="preimuschestva"><span
            class="dashed">Преимущества</span></label>
    <div class="text_items">
        <div style="flex-direction: column;">
            <div class="two_blocks">
                <div class="left_text">
                    <h2>Удобство использования</h2>
                    <p>
                        <strong>Сервер системы устанавливается на одном компьютере, подключенном к сети Ethernet.
                            Установка
                            программного обеспечения на рабочие места пользователей не требуется. Пользователи работают
                            с
                            системой в привычных им Web-браузерах.</strong>
                        <p>
                            Сервер системы может быть установлен на компьютеры с различными операционными системами:
                            Windows,
                            Linux. Система PERCo-Web работает с системой управления базами данных MySQL и имеет
                            возможность подключения к уже имеющейся базе.
                        </p>

                    </p>


                </div>
                <div class="into_img">
                    <img alt="Web-технологии" src="/images/products/perco-web/web-technology.jpg">
                </div>
            </div>
            <div class="two_blocks">
                <div class="into_img">
                    <img alt="Удобство и простота использования"
                        src="/images/products/perco-web/perco-web-usability.jpg">
                </div>
                <div class="text">
                    <h2>Различные способы идентификации</h2>
                    <p>
                        <strong>Система позволяет применять различные способы идентификации.</strong>
                        <ul>
                            <li class="plus">
                                <input id="hide_two-1" type="checkbox"> <label for="hide_two-1"><strong>Биометрия.</strong></label>  
                                <div> Для организации контроля доступа при помощи биометрических данных применяется идентификация по отпечаткам пальцев, рисунку ладони и <a href="/products/terminaly-raspoznavaniya-lits/">распознавание лиц</a>.  
                                </div>
							</li>
                            
                            <li class="plus">
                                <input id="hide_two-2" type="checkbox"> <label for="hide_two-2"><strong>Карты доступа.</strong></label>  
                                <div> Могут использоваться карты доступа формата EMM/HID (125 кГц), Mifare (13,56 МГц) в том числе с защитой от копирования.  
                                </div>
							</li> 
                            
                            <li class="plus">
                                <input id="hide_two-3" type="checkbox"> <label for="hide_two-3"><strong>Мобильный доступ.</strong></label>  
                                <div>Смартфон c NFC-модулем может использоваться как в качестве идентификатора, так и в качестве регистрирующего устройства. На смартфон необходимо установить бесплатное приложение PERCo Доступ или PERCo Регистрация.
                                </div>
							</li> 
                            
                            <li class="plus">
                                <input id="hide_two-4" type="checkbox"> <label for="hide_two-4"><strong>Банковские карты.</strong></label>  
                                <div> В качестве идентификаторов могут использоваться банковские карты с технологией Paypass.
                                </div>
							</li> 
                            
                            <li class="plus">
                                <input id="hide_two-5" type="checkbox"> <label for="hide_two-5"><strong>Штрих-код.</strong></label>  
                                <div> Штрих-код может применяться в качестве гостевого идентификатора и для контроля прохода на объекты массового пребывания людей, в том числе в составе систем платного доступа.
                                </div>
							</li> 
                            
                            <li class="plus">
                                <input id="hide_two-6" type="checkbox"> <label for="hide_two-6"><strong>Распознавание номеров.</strong></label>  
                                <div> В качестве идентификаторов на автотранспортной проходной могут применять регистрационные номера транспортных средств. Для распознавания регистрационных номеров автомобилей необходимо наличие модуля “Интеграция с TRASSIR".  
                                </div>
							</li> 
                        </ul>
                        <h4></h4>
                        <p></p>
                        <p></p>
                    </p> 
                </div>
            </div>
            <div class="two_blocks"> 
                <div class="left_text">
                    <h2>Простота интеграции</h2>
                    <p>
                        <strong>За счет поддержки API-интерфейса система легко интегрируется со сторонними приложениями,
                            в том
                            числе
                            с системами управления предприятием – CRM- и ERP-системами.</strong>
                        <p>
                            Система имеет модуль интеграции с 1С, что позволяет сократить трудозатраты отдела кадров и
                            бухгалтерии, автоматизировав табельный учет.</p>
                    </p> 
                </div>
                <div class="into_img">
                    <img alt="Удобство и простота использования"
                        src="/images/products/perco-web/perco-web-usability-2.jpg">
                </div>
            </div>
            <div class="two_blocks  revers bio" style="position:relative">
                <div class="into_img" id="bio_img" style="right: -11px;position:relative">
                    <img alt="Биометрическая идентификация" src="/images/products/perco-web/perco-web-usability-1.jpg">
                </div>
                <div class="text">
                    <h2>Бесплатное программное обеспечение</h2>
                    <p>
                        <strong>Бесплатный модуль PERCo-WB «Базовый пакет ПО» позволяет организовать контроль доступа на
                            предприятии со штатом до 100 сотрудников без возможности заказывать гостевые пропуска,
                            создавать графики работы, формировать отчеты о проходах и доступе в помещения.</strong>
                    </p>
                    <p>Для расширения функционала системы необходимо приобрести лицензии на полную версию ПО. Для
                        ознакомления с
                        возможностями полной версии ПО действует 60-дневный бесплатный период. Лицензия не имеет
                        ограничений по
                        числу рабочих мест, количеству контроллеров и карт в системе.</p>

                </div>
            </div>
            <div class="two_blocks">
                <div class="left_text">
                    <h2>Система без выделенного сервера</h2>

                    <p>Контроллеры PERCo нового поколения имеют встроенную память с предустановленным программным
                        обеспечением PERCo-Web и позволяют создать систему без выделенного сервера. В таком режиме в
                        разворачивании сервера на ПК нет необходимости, это позволяет снизить трудозатраты на
                        обслуживание сервера и запуск системы в целом.</p>
                </div>

                <div class="into_img">
                    <img src="/images/products/perco-web/dedicated-server-system.jpg"
                        alt="Система без выделенного сервера">
                </div>
            </div>
            <div class="two_blocks">
                <div class="into_img">
                    <img src="/images/products/perco-web/scalability.jpg" alt="Масштабируемость">
                </div>
                <div class="text">
                    <h2>Масштабируемость</h2>
                    <p>
                        <strong>Универсальная архитектура системы позволяет применять ее как в небольших офисах, так и
                            на
                            крупных предприятиях. При необходимости расширения системы достаточно просто включить новое
                            оборудование в сеть Ethernet.</strong>
                    </p>
                    <p>При организации новых рабочих мест достаточно добавить в систему нового пользователя и выдать ему
                        соответствующие полномочия для работы.</p>
                </div>

            </div>
			<div class="two_blocks">
                <div class="left_text">
                    <h2>Мониторинг</h2>

                    <p>
						<strong>На мониторах сотрудников службы безопасности отображается графический план объекта с указанием технических средств защиты.</strong><br>
						При возникновении тревожной ситуации дежурный сотрудник получает сигнал и принимает необходимые меры. Например, в случае пожара открывает двери, в случае проникновения посторонних устанавливает режим «Закрыто».
					</p>
                </div>

                <div class="into_img">
                    <img src="/images/products/perco-web/monitoring.jpg" alt="Мониторинг">
                </div>
            </div>
			<div class="two_blocks">
                <div class="into_img">
                    <img src="/images/products/perco-web/cctv.jpg" alt="Видеонаблюдение">
                </div>
                <div class="text">
                    <h2>Видеонаблюдение</h2>
                    <p>Модуль интеграции с видеоподсистемой Trassir позволяет реализовать такие возможности как вывод изображений с камер Trassir и управление камерами в онлайн-режиме, использование системы Trassir Face Recognition и камер Trassir при организации точек верификации доступа. Запись видео событий доступа на основании заданных алгоритмов реакций на события.</p>
				</div>
            </div>
			<div class="two_blocks">
                <div class="left_text">
                    <h2>Охранно-пожарная сигнализация</h2>

                    <p>
						Интеграция системы PERCo-Web с ИСО «Орион» позволяет организовать мониторинг и управление  устройствами ОПС в интерфейсе СКУД, задавать реакции на события и реализовать визуальное отображение охранных и пожарных зон, разделов, реле на плане помещений.
					</p>
                </div>

                <div class="into_img">
                    <img src="/images/products/po/wm-07_page.jpg" alt="Охранно-пожарная сигнализация">
                </div>
            </div> 
            <div class="two_blocks two-blocks_new-layout">
                <div class="into_img">
                    <img alt=" " src="/images/products/perco-web/perco-transport-idetify.jpg">
                </div>
                <div class="text">
                    <h2>Учет транспортных средств</h2> 
                    <p>Для учета транспортных средств предусмотрены отчеты о проездах, местоположении и выданных идентификаторах. В учетные данные каждого из сотрудников и посетителей можно добавить до трех транспортных средств. </p> 
                </div>
            </div>
            <div class="two_blocks teaching">
                <div>
                    <h2>Обучение и техподдержка</h2>
                    <p>
                        <strong>Для пользователей системы организованы бесплатные очные семинары в Учебном центре PERCo
                            и
                            заочные интернет-семинары.</strong>
                    </p>
                    <p>Расписание семинаров можно посмотреть в разделе <a href="/obuchenie/">«Обучение»</a>. Кроме того,
                        по всем разделам ПО
                        созданы пошаговые <a
                            href="/o-kompanii/video/?section=videoinstruktsii-po-rabote-s-po-perco-web">видеоинструкции</a>,
                        которые находятся в разделе <a href="/podderzhka/">«Поддержка»</a>.</p>
                    <p>Мы проводим обучение и аттестацию наших партнеров в регионах, чтобы они могли квалифицированно
                        обслуживать наших покупателей. Сертифицированные партнеры PERCo рассчитают необходимую
                        комплектацию
                        системы и оборудования, произведут поставку, установку и внедрение системы на Вашем предприятии.
                        Список этих партнеров можно посмотреть в разделе <a href="/gde-kupit/">«Где купить»</a>.</p>
                </div>
            </div>

        </div>

    </div>
    <input name="vkladki" type="radio" <?= $checkedSecond ?> id="klyuchevye-vozmozhnosti"><label for="klyuchevye-vozmozhnosti"><span
            class="dashed">Ключевые возможности</span></label>
    <div class="text_items">
        <div class="two_blocks">
            <div>
                <h2>Возможности системы</h2>
                <div class="left">
                    <div class="plus">
                        <img src="/css/../images/icons/1-plus.svg"><input id="hide-1" type="checkbox"> <label
                            for="hide-1">Защита от несанкционированного проникновения</label>
                        <div>
                            Вход на предприятие оборудуется турникетами, контроллерами и считывателями. В качестве идентификаторов могут выступать карты доступа, в том числе с защитой от копирования, биометрические данные, смартфоны, штрихкоды.<br>
                            Сотрудники получают постоянные идентификаторы, доступ посетителей осуществляется по временным картам или штрихкодам. Для усиления контроля доступа можно использовать несколько способов идентификации: например, карту доступа и распознавание лиц.<br>
                            Внутренние помещения оборудуются замками, контроллерами и считывателями. Сотрудники и посетители используют идентификаторы с назначенными правами доступа — в соответствии с полномочиями и графиком работы. Усилить контроль доступа в особо важные помещения, например, серверную, можно с помощью режима «Охрана» – попасть внутрь можно будет только в присутствии ответственного лица.
                        </div>
                    </div>
                    <div class="plus">
                        <img src="/css/../images/icons/3-plus.svg"><input id="hide-3" type="checkbox"> <label
                            for="hide-3">Верификация прохода сотрудников и посетителей</label>
                        <div>
                            Для защиты от прохода по чужому пропуску проводится верификация. На мониторе сотрудника службы безопасности  выводится фото владельца пропуска из базы данных системы, и при несовпадении охранник запрещает доступ. При наличии камер видеонаблюдения верификация может проводиться удаленно. При использовании модуля интеграции с TRASSIR подтверждение происходит автоматически c помощью системы распознавания лиц.<br>
                            В целях противодействия распространению инфекции доступ сотрудников и посетителей может осуществляться с подтверждением от пирометра. Предотвратить доступ нетрезвых сотрудников на предприятие можно за счет подтверждения от алкотестера. Система контроля доступа PERCo имеет возможность в онлайн режиме оповещать службы безопасности о положительных результатах на алкоголь, что позволяет оперативно реагировать на инциденты и вовремя проводить освидетельствование. Оператор также имеет возможность формировать отчёты по результатам алкотестирования для получения информации о нарушителях режима.
                        </div>
                    </div>
					<div class="plus">
                        <img src="/css/../images/icons/4-plus.svg"><input id="hide-4" type="checkbox"> <label
                            for="hide-4">Автоматизация учета рабочего времени</label>
                        <div>
                            Оборудование контроля доступа используется  в том числе и для учета рабочего времени. Предъявляя идентификатор при входе и выходе сотрудники одновременно отмечают время прихода на работу и ухода с нее. Система поддерживает сменные и скользящие графики работы сотрудников и может быть интегрирована с программой 1С для начисления заработной платы исходя из реально отработанного времени. Табель строится по стандартным формам Т-13, система позволяет создавать и редактировать оправдательные документы, объясняющие отсутствие сотрудника на рабочем месте. Автоматизация учета рабочего времени позволяет сократить трудозатраты сотрудников бухгалтерии на составление табеля и исключить влияние человеческого фактора.
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="plus">
                        <img src="/css/../images/icons/5-plus.svg"><input id="hide-5" type="checkbox"> <label
                            for="hide-5">Контроль нарушений трудовой дисциплины</label>
                        <div>
                            На основании данных о входах и выходах сотрудников система формирует отчеты о трудовой дисциплине: об опоздавших, ушедших раньше времени, отсутствующих. Получать отчеты о дисциплине руководитель может не только на рабочем месте, но и дома, в автомобиле, в командировке. Достаточно подключиться к сети интернет, ввести пароль и войти в систему. Если рабочее место сотрудника удалено от проходной, целесообразно использовать терминалы учета рабочего времени. Их можно устанавливать непосредственно в цехах и административных помещениях. Удобным инструментом учета является гибкий график, позволяющий сотрудникам распоряжаться своим рабочим временем. В графике работы сотрудника указываются допустимые отклонения, не являющиеся нарушением трудовой дисциплины. Время, потраченное на приходы позже, уходы раньше и перерывы, сотрудник может отработать. Учет рабочего времени по алгоритму гибкого графика позволяет повысить уровень дисциплины и сохранить в коллективе комфортный климат.
                        </div>
                    </div>
                    <div class="plus">
                        <img src="/css/../images/icons/6-plus.svg"><input id="hide-6" type="checkbox"> <label
                            for="hide-6">Автоматизация выдачи и сбора гостевых пропусков</label>
                        <div>
                            Система позволяет автоматизировать выдачу и сбор пропусков. Оператор вводит личные данные посетителя и задает определенные права доступа. Пропуск можно оформить в момент прихода или заранее: в системе есть возможность предварительного заказа пропусков. При оформлении гостевого пропуска на месте данные могут быть введены в систему вручную или получены автоматически — в результате распознавания документов.<br>
                            Для сбора временных пропусков на выходе устанавливается картоприемник: пока посетитель не опустит в него пропуск, покинуть здание он не сможет. При использовании в качестве идентификаторов смартфонов с NFC-модулем временные пропуска посетителям выдаются, активируются и деактивируются дистанционно. Доступ посетителей также может осуществляться по штрихкодам.
                        </div>
                    </div>
					<div class="plus">
                        <img src="/css/../images/icons/7-plus.svg" style="width: 32px;"><input id="hide-2" type="checkbox"><label
                            for="hide-2">Мониторинг, интеграция с системами видеонаблюдения и ОПС</label>
                        <div>
                            Система контроля доступа PERCo-Web позволяет осуществлять мониторинг ситуации на объекте в режиме онлайн и управлять устройствами на графическом плане.  Интеграция системы контроля доступа с системами видеонаблюдения и охранной-пожарной сигнализации позволяет реализовать управление всеми устройствами системы на графическом плане в интерфейсе программного обеспечения СКУД.<br>
                            В системе реализована возможность создания и редактирования плана помещений и размещения на нем устройств систем безопасности, в том числе видеонаблюдения и охранно-пожарной сигнализации. Сотрудники службы безопасности могут оперативно получать информацию о тревожных событиях и дистанционно оценивать ситуацию на экране монитора, не тратя время на проверку события на месте. Например, при срабатывании пожарного извещателя данные от ближайшей видеокамеры автоматически выводятся на монитор. Сотрудник может оценить, действительно ли имеет место возгорание, или это ложная тревога.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <h3>Узнать больше о PERCo-Web</h3>
            <div class="elements_list">
            [downloadImg:dlya-sluzhby-bezopasnosti-web]
            [downloadImg:dlya-bukhgalterii]
            [downloadImg:dlya-rukovoditeley]
            [downloadImg:dlya-administratorov]

            </div> -->
        <div class="elements_list">
            <div class="download_item_img">
                <a href="/download/documentation/rus/perco-web-for-security.pdf" target="_blank"
                    onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/perco-web-for-security.pdf'});"
                    download="">
                    <div class="icon"><img class="mb-2" alt="Иконка" src="/images/icons/pdf.svg"></div>
                    <span>Для службы безопасности</span>
                    <img alt="Для службы безопасности"
                        src="/images/products/perco-web/for-security-service_530x230.jpg">
                </a>
                <div class="color">(2.03&nbsp;MB)&nbsp; — 10.11.2020</div>
            </div>

            <div class="download_item_img">
                <a href="/download/documentation/rus/perco-web-for-accounting.pdf" target="_blank"
                    onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/perco-web-for-accounting.pdf'});"
                    download="">
                    <div class="icon"><img class="mb-2" alt="Иконка" src="/images/icons/pdf.svg"></div>
                    <span>Для бухгалтерии и отдела персонала</span>
                    <img alt="Для бухгалтерии и отдела персонала"
                        src="/images/products/perco-web/for-accounting_530x230.jpg">
                </a>
                <div class="color">(3.66&nbsp;MB)&nbsp; — 12.09.2019</div>
            </div>
            <div class="download_item_img">
                <a href="/download/documentation/rus/perco-web-for-leaders.pdf" target="_blank"
                    onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/perco-web-for-leaders.pdf'});"
                    download="">
                    <div class="icon"><img class="mb-2" alt="Иконка" src="/images/icons/pdf.svg"></div>
                    <span>Для руководителей</span>
                    <img alt="Для руководителей" src="/images/products/perco-web/for-leaders_530x230.jpg">
                </a>
                <div class="color">(2.53&nbsp;MB)&nbsp; — 12.11.2019</div>
            </div>
            <div class="download_item_img">
                <a href="/download/documentation/rus/perco-web-for-admin.pdf" target="_blank"
                    onclick="ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '/download/documentation/rus/perco-web-for-admin.pdf'});"
                    download="">
                    <div class="icon"><img class="mb-2" alt="Иконка" src="/images/icons/pdf.svg"></div>
                    <span>Для админиcтраторов</span>
                    <img alt="Для админимтраторов" src="/images/products/perco-web/for-admin_530x230.jpg">
                </a>
                <div class="color">(3.64&nbsp;MB)&nbsp; — 16.09.2019</div>
            </div>

        </div>
        <h2>Структура системы</h2>

        <div id="sheme_skud-percoweb">
            <a href="/images/shema/shema-perco-web.svg" data-iframe="true" style="display: flex; justify-content: center;">
                <img src="/images/shema/shema-perco-web.svg" style="width:100%; max-width:1000px;" />
            </a>
            
        </div>
        <!-- <div id="sheme_skud">
            <a title="Схема системы" data-iframe="true" data-src="/images/shema/shema.svg" style="display: flex; justify-content: center;">
                <img alt="Схема системы" src="/images/icons/shema-skud.svg" style="width:100%; max-width:1000px;"/>
                <div><span class="dashed">схема системы</span></div>
            </a>
        </div> -->
        <h2>Возможности программного обеспечения</h2>

        <div id="horizontal_scroll">
            <ul id="scrollGallery">
                <li>
                    <h3>Вход в систему</h3>
                    <img src="/images/products/perco-web/slides/1.jpg" alt="Вход в систему">
                    <div class="text-scroll-gallery">
                        <p class="lead">Установка программного обеспечения на рабочие места пользователей не требуется.
                            Вход в систему
                            аналогичен входу на сайт. В адресную строку браузера пользователь вводит IP-адрес сервера и
                            входит в
                            систему по своему паролю.</p>
                    </div>
                </li>
                <li>
                    <h3>Создание учетных данных</h3>
                    <img alt="Создание учетных данных" src="/images/products/perco-web/slides/2.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Данные о сотрудниках заносятся в систему, создаются графики работы и шаблон
                            доступа. Как правило, эти
                            обязанности выполняет менеджер по персоналу или секретарь. </p>
                    </div>
                </li>
                <li>
                    <h3>Просмотр учетных данных</h3>
                    <img alt="Просмотр учетных данных" src="/images/products/perco-web/slides/3.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">В разделе «Персонал» можно просматривать учетные данные сотрудников, делая
                            выборку по подразделению,
                            должности, графику работы и другим фильтрам.</p>
                    </div>
                </li>
                <li>
                    <h3>Выдача карт доступа и мобильных идентификаторов</h3>
                    <img alt="Выдача карта доступа" src="/images/products/perco-web/slides/4.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">
							Карту доступа сотруднику можно выдать в разделах «Бюро пропусков» или «Персонал». Карта будет иметь право доступа в соответствии с заданным шаблоном. Карта выдается либо ручным вводом номера, либо с помощью контрольного считывателя. Аналогичным образом происходит выдача мобильных идентификаторов.<br>
							При идентификации по смартфону для предоставления права доступа в систему передается сгенерированный идентификатор, который проверяется при поднесении смартфона к считывателю.
						</p>
                    </div>
                </li>
                <li>
                    <h3>Занесение отпечатков пальцев</h3>
                    <img alt="Занесение отпечатков пальцев" src="/images/products/perco-web/slides/5.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">В качестве идентификаторов могут использоваться и отпечатки пальцев, которые
                            заносятся в систему с
                            помощью считывающих устройств. Возможны следующим схемы идентификации: отпечаток пальца,
                            отпечаток
                            пальца и карта, опечаток пальца или карта, считывание отпечатка из встроенной памяти карты в
                            защищенном режиме.</p>
                    </div>
                </li>
				<li>
                    <h3>Распознавание лиц</h3>
                    <img alt="Занесение отпечатков пальцев" src="/images/products/perco-web/slides/6.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">
							Одна из возможностей идентификации – доступ по распознаванию лиц. Данные пользователей заносятся в систему в качестве основного или дополнительного идентификатора.<br>
							Для усиления контроля доступа можно применять сразу нескольких способов идентификации, например, распознавание лиц с подтверждением картой доступа.
						</p>
                    </div>
                </li>
				<li>
                    <h3>Идентификация по штрихкоду</h3>
                    <img alt="Занесение отпечатков пальцев" src="/images/products/perco-web/slides/20.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">
							Штрихкод может применяться в качестве гостевого идентификатора и для контроля прохода на объекты массового пребывания людей, в том числе в составе систем платного доступа.
						</p>
                    </div>
                </li>
                <li>
                    <h3>Дизайн пропусков</h3>
                    <img alt="Дизайн пропусков" src="/images/products/perco-web/slides/7.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Карты доступа можно оформить в виде пропусков или бейджей. Для создания дизайн
                            пропуска можно
                            пользоваться стандартными элементами или добавлять дополнительные текстовые и графические
                            элементы,
                            например, логотип компании. </p>
                    </div>
                </li>
                <li>
                    <h3>Печать пропусков</h3>
                    <img alt="Печать пропусков" src="/images/products/perco-web/slides/8.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Пропуск выбранного дизайна можно получить, напечатав наклейки для карт доступа
                            или использовать
                            специальный принтер для печати на пластиковых картах.</p>
                    </div>
                </li>
                <li>
                    <h3>Заказ пропуска</h3>
                    <img alt="Заказ пропуска" src="/images/products/perco-web/slides/9.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Предварительный заказа пропусков упрощает выдачу пропусков посетителям. Пропуск
                            посетителю можно
                            заказать заранее, например, в бизнес-центрах, арендаторы вносят в систему данные посетителя
                            и когда
                            посетитель обращается в бюро пропусков, оператор только проверяет его документы и выдает уже
                            готовый
                            пропуск. </p>
                    </div>
                </li>
                <li>
                    <h3>Верификация</h3>
                    <img alt="Верификация" src="/images/products/perco-web/slides/10.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Для защиты от прохода по чужой карте используется режим верификации. При
                            предъявлении карты
                            считывателю на экран выводятся изображение с камеры и фото владельца карты из базы данных.
                            Если эти
                            изображения не совпадают, сотрудник службы охраны запрещает доступ.</p>
                    </div>
                </li>
                <li>
                    <h3>Отчет о проходах</h3>
                    <img alt="Отчет о доходах" src="/images/products/perco-web/slides/11.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Отчет о проходах позволяет выяснить кто, когда и в какое помещение входил, такая
                            информация особенно
                            важна в случае нештатных ситуаций. </p>
                    </div>
                </li>
                <li>
                    <h3>Отчет о местонахождении</h3>
                    <img alt="Отчет о местонахождении" src="/images/products/perco-web/slides/12.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Отчет о местонахождении позволяет определить где в данный момент находится
                            сотрудник или где он
                            находился в интересующий период времени.</p>
                    </div>
                </li>
				<li>
                    <h3>Выданные идентификаторы</h3>
                    <img alt="Выданные идентификаторы" src="/images/products/perco-web/slides/22.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Отчет позволяет получить информацию обо всех идентификаторах, выданных за определенный период. Эти данные могут использоваться в ходе служебных расследований, для отслеживания и удаления неиспользуемых идентификаторов, а также для дифференцированного начисления платы арендаторам помещений в бизнес-центрах, исходя из количества посетителей.</p>
                    </div>
                </li>
                <li>
                    <h3>Задание реакции на события</h3>
                    <img alt="Контроль дисциплины" src="/images/products/perco-web/slides/13.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Возможна настройка отправки уведомлений и отчетов посредством Viber, E-mail, SMS, а также всплывающих окон на ПК операторов системы, настройка последовательности команд управления устройствами, выполняемых сервером системы.</p>
                    </div>
                </li>
				<li>
                    <h3>Видеонаблюдение</h3>
                    <img alt="Контроль дисциплины" src="/images/products/perco-web/slides/19.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Интеграция системы PERCo-Web с видеоподсистемой TRASSIR дает возможность использовать оборудование TRASSIR для видеонаблюдения и распознавания лиц.</p>
                    </div>
                </li>
				<li>
                    <h3>Мониторинг</h3>
                    <img alt="Контроль дисциплины" src="/images/products/perco-web/slides/18.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">На мониторах сотрудников службы безопасности отображается графический план объекта с указанием технических средств защиты. При возникновении тревожной ситуации дежурный сотрудник получает сигнал и принимает необходимые меры. Например, в случае пожара открывает двери, в случае проникновения посторонних устанавливает режим «Закрыто».</p>
                    </div>
                </li>
				<li>
                    <h3>Охранно-пожарная сигнализация</h3>
                    <img alt="Охранно-пожарная сигнализация" src="/images/products/perco-web/slides/21.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Интеграция системы PERCo-Web с ИСО «Орион» позволяет организовать мониторинг и управление  устройствами ОПС в интерфейсе СКУД, задавать реакции на события и реализовать визуальное отображение охранных и пожарных зон, разделов, реле на плане помещений.</p>
                    </div>
                </li>
				<li>
                    <h3>Отправка отчетов</h3>
                    <img alt="Контроль дисциплины" src="/images/products/perco-web/slides/14.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Сотрудники службы безопасности могут оперативно получать информацию о событиях системы.  Руководители - отчеты о дисциплине за определенный период. Возможна настройка времени отправки отчетов.</p>
                    </div>
                </li>
				<li>
                    <h3>Контроль дисциплины</h3>
                    <img alt="Контроль дисциплины" src="/images/products/perco-web/slides/15.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Для построения отчетов по дисциплине задается интересующий период времени и
                            выбирается подразделение.
                            Сводный отчет включает все виды нарушений: опоздания, уходы раньше, прогулы.</p>
                    </div>
                </li>
                <li>
                    <h3>Журнал отработанного времени</h3>
                    <img alt="Журнал отработанного времени" src="/images/products/perco-web/slides/16.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Журнал отработанного времени позволяет получить информацию о времени присутствия
                            и отсутствия
                            сотрудников, об отработанном в рамках графика времени, переработках, балансе. Баланс
                            показывает
                            разницу между нормой рабочего времени по графику и отработанным сотрудником временем.</p>
                    </div>
                </li>
                <li>
                    <h3>Табель учета рабочего времени</h3>
                    <img alt="Табель учета рабочего времени" src="/images/products/perco-web/slides/17.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">На основании данных об отработанном сотрудником времени можно сформировать
                            табель по форме Т13
                            за отчетный период и сохранить его в формате Excel.</p>
                    </div>
                </li>
				<li>
                    <h3>Время присутствия</h3>
                    <img alt="Время присутствия" src="/images/products/perco-web/slides/23.jpg">
                    <div class="text-scroll-gallery">
                        <p class="lead">Отчет позволяет определить время нахождения сотрудника на рабочем месте в заданный период. Данные применяются для контроля дисциплины и устранения человеческого фактора. Отчет “Выданные документы” позволяет установить лицо, выдавшее сотруднику те или иные, в том числе оправдательные, документы. </p>
                    </div>
                </li>
            </ul>
        </div>

    </div>
    <input name="vkladki" type="radio" <?= $checkedThree ?> id="uznat-bolshe"><label for="uznat-bolshe"><span class="dashed">Выбор
            ПО</span></label>
    <div class="text_items">
        <div class="col-table smaller">
            <h2>Сравнение программного обеспечения</h2>
            <table class="col-table-i">
                <tbody>
                    <tr>
                        <td>&nbsp;</td>
                        <td data-id=".info-01">
                            <p>ПО PERCo-Web</p>
                            <div class="inf_img"><img src="/images/icons/inform-blue.svg" alt="Информация" />
                                <div class="info info-01">Программное обеспечение PERCo-Web, разворачиваемое на сервере
                                    системы, установленном на ПК.</div>
                            </div>
                        </td>
                        <td data-id=".info-02">
                            <p>Встроенное ПО PERCo-Web</p>
                            <div class="inf_img"><img src="/images/icons/inform-blue.svg" alt="Информация" />
                                <div class="info info-02">Встроенное ПО &ndash; программное обеспечение PERCo-Web,
                                    предустановленное в памяти контроллеров CL15, CT/L14 и терминала учета рабочего
                                    времени CR11.</div>
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
                    </tr>
                    <tr>
                        <td>
                            <p>Контроллеры</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>10</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Сотрудники</p>
                        </td>
                        <td>
                            <p>200 000</p>
                        </td>
                        <td>
                            <p>500</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Посетители</p>
                        </td>
                        <td>
                            <p>200 000</p>
                        </td>
                        <td>
                            <p>500</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Подразделения</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Шаблоны доступа (назначается группе сотрудников с одинаковыми правами доступа)</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>10</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Графики работы</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Типы оправдательных документов</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>10</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Шаблоны верификации (настройка верификации для одного помещения)</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>10</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Точки верификации</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>10</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Контролируемые помещения</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Операторы</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Шаблоны полномочий операторов (ролей)</p>
                        </td>
                        <td>
                            <p>1000</p>
                        </td>
                        <td>
                            <p>100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>События регистрации</p>
                        </td>
                        <td>
                            <p>не ограничено</p>
                        </td>
                        <td>
                            <p>1 000 000</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Должности</p>
                        </td>
                        <td colspan="2">
                            <p>5000</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Дополнительные текстовые/графические поля в учетной карточке</p>
                        </td>
                        <td colspan="2">
                            <p>16/10</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Шаблоны дизайна пропусков</p>
                        </td>
                        <td colspan="2">
                            <p>1000</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Задания по расписанию</p>
                        </td>
                        <td colspan="2">
                            <p>100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Установка ПО на рабочие места операторов</p>
                        </td>
                        <td colspan="2">
                            <p>не требуется</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Стандарт интерфейса связи</p>
                        </td>
                        <td colspan="2">
                            <p>Ethernet (IEEE 802.3)</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Скорости передачи данных Ethernet, Мбит/с</p>
                        </td>
                        <td colspan="2">
                            <p>10/100</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Критерии доступа по времени:</p>
                            <br />
                            <p>временная зона (до 4-х временных интервалов)</p>
                            <br />
                            <p>недельный график</p>
                            <br />
                            <p>скользящий посуточный график</p>
                            <br />
                            <p>скользящих понедельных графиков</p>
                        </td>
                        <td colspan="2">
                            <p></p>
                            <br />
                            <p>255</p>
                            <br />
                            <p>255</p>
                            <br />
                            <p>255</p>
                            <br />
                            <p>255</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Кроссплатформенность</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Работа с различными ОС</p>
                        </td>
                       <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Идентификация</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Биометрическая идентификация</p>
                        </td>
                        <td colspan="2">
                            <p><strong>+</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Идентификация по смартфону</p>
                        </td>
                        <td colspan="2">
                            <p><strong>+</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Идентификация по штрихкоду</p>
                        </td>
                        <td colspan="2">
                            <p><strong>+</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Защита от копирования карт</p>
                        </td>
                        <td colspan="2">
                            <p><strong>+</strong></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Формат карт доступа</p>
                        </td>
                        <td colspan="2" width="595">
                            <p>HID, EM-Marin, MIFARE</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Интеграция</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Биометрические контроллеры ZKTeco</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
                        <td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Биометрические контроллеры Suprema</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
                        <td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Видеокамеры и видеосервера</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
                        <td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>API-интерфейс</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Trassir</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
                        <td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Контроль доступа</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Разграничение доступа по помещениям/времени/статусу</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Верификация</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Глобальный «Antipassback»</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Комиссионирование (подтверждение картой охранника)</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Учетные данные</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Учетные данные сотрудников</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Структура подразделений и должностей</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Дизайнер пропусков</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Заказ пропусков</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Импорт данных</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Отчеты</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Посетители</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>События</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Проходы</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Права доступа</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Местонахождение</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Учет рабочего времени</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Контроль дисциплины</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Учет рабочего времени</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Интеграция с 1С</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Мобильный терминал регистрации</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Мониторинг и управление</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Задание реакций на события</p>
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
                            <p>Запись видео в реакциях на события и верификации</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Мониторинг</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Автоматическое создание резервных копий базы данных</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Уведомления по Viber</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Уведомления по SMS</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p><strong>-</strong></p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Уведомление по E-mail</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Управление устройствами</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Видеонаблюдение</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Интеграция с системой видеонаблюдения TRASSIR</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p>-</p>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Видеокамеры и видеосервера</p>
                        </td>
                        <td>
                            <p>+</p>
                        </td>
						<td>
                            <p>-</p>
                        </td>
                    </tr>
					<tr>
                        <td style="background: none; text-align: center;" colspan="3">
                            <h4>Операторы</h4>
                        </td>
                    </tr>
					<tr>
                        <td>
                            <p>Разграничение прав операторов</p>
                        </td>
                        <td colspan="2">
                            <p>+</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <input name="vkladki" type="radio" <?= $checkedFour ?> id="download"><label for="download"><span
            class="dashed">Скачать</span></label>
    <div class="text_items">
        <!-- <script>
            $(function(){
                $(".link").click(function() {
                    //действия
                    $('.change').toggleClass('twoblocks')
                });
            });
        </script> -->
        <!-- <a class="link" href="#content">click me</a> -->
        <div class="twoblocks change">
            <?
        $rsFiles = CIBlockElement::GetList(array("SORT"=>"asc"), array( "IBLOCK_CODE"=>"files", "SECTION_CODE" => "sistema-kontrolya-dostupa-perco-web"));	// перечень полей необходимых в результате выборки
        if (intval($rsFiles->SelectedRowsCount()) > 0)
        {
            $version = "";
            $list_files = "";
            while($arFiles = $rsFiles->GetNextElement())
            {
                $ico = "";
                $arPropsFile = $arFiles->GetProperties();
                $keyName = array_search(LANGUAGE_ID, $arPropsFile["NAME"]["DESCRIPTION"]);
                $keyFile = array_search(LANGUAGE_ID, $arPropsFile["FILE"]["DESCRIPTION"]);
                $name = $arPropsFile["NAME"]["VALUE"][$keyName];
                $file = $arPropsFile["FILE"]["VALUE"][$keyFile];
                $fSize = '('.printFileInfo($file, "size").')&nbsp;';
                $date = printFileInfo($file, "date");

                switch($arPropsFile["ICON"]["VALUE"])
                    {
                        case "pdf":
                            $ico = "/images/icons/pdf.svg";
                            break;
                        case "dwf":
                            if (LANGUAGE_ID == "ru")
                                $AutoCadtitle = 'для просмотра должна быть установлена программа Autodesk DWF Viewer<br />';
                            $ico = "/images/icons/dwf.svg";
                            break;
                        case "dwg":
                            $ico = "/images/icons/dwg.svg";
                            break;
                        default:
                            $ico = "/images/icons/download.svg";
                            break;
                    }
                if ($arPropsFile["INSTAL_VERSION"]["VALUE"])
                    $version = ", версия ".$arPropsFile["INSTAL_VERSION"]["VALUE"];
                $google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
                $list_files .= '<div class="list_files"><div class="icon"><img alt="Иконка" src="'.$ico.'" /></div><div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.$version.'</a><br><span class="color">'.$fSize.' — '.$date.'</span></div></div>';
            }

        }

        echo "<div><h2>Документация</h2>".$list_files."</div>";
    ?>

            <?
        $rsFiles = CIBlockElement::GetList(array("SORT"=>"asc"), array( "IBLOCK_CODE"=>"files", "SECTION_CODE" => "standartnyy-paket-po-i-dopolnitelnye-moduli"));	// перечень полей необходимых в результате выборки
        if (intval($rsFiles->SelectedRowsCount()) > 0)
        {
            $version = "";
            $list_files = "";
            while($arFiles = $rsFiles->GetNextElement())
            {
                $ico = "";
                $arPropsFile = $arFiles->GetProperties();
                $keyName = array_search(LANGUAGE_ID, $arPropsFile["NAME"]["DESCRIPTION"]);
                $keyFile = array_search(LANGUAGE_ID, $arPropsFile["FILE"]["DESCRIPTION"]);
                $name = $arPropsFile["NAME"]["VALUE"][$keyName];
                $file = $arPropsFile["FILE"]["VALUE"][$keyFile];
                $fSize = '('.printFileInfo($file, "size").')&nbsp;';
                $date = printFileInfo($file, "date");

                // $ico = "/images/icons/download.svg";
                $ico = $arPropsFile["IMAGE"]["VALUE"][0];

                if ($arPropsFile["INSTAL_VERSION"]["VALUE"])
                    $version = ", версия ".$arPropsFile["INSTAL_VERSION"]["VALUE"];
                $google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
                $list_files .= '<div class="list_files"><div class="icon"><img alt="Иконка" src="'.$ico.'" /></div><div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.$version.'</a><br><span class="color">'.$fSize.' — '.$date.'</span></div></div>';
            }
        }
        echo "<div><h2>Программное обеспечение</h2>".$list_files."</div>";
    ?>
        </div>
        <!-- <table class="data-table">
            <thead>

                <tr>
                    <td>

                    </td>
                    <td>
                        <p><strong>Система PERCo-Web</strong></p>
                    </td>
                    <td>
                        <p><strong>Система со встроенным <br>в контроллер ПО PERCo-Web</strong></p>
                    </td>
                    <td>
                        <p><strong>Web-интерфейс контроллеров</strong></p>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>Стандарт интерфейса связи</p>
                    </td>
                    <td colspan="3">
                        <p>Ethernet (IEEE 802.3)</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Скорости передачи данных Ethernet, Мбит/с</p>
                    </td>
                    <td colspan="3">
                        <p>10/100</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Количество контроллеров СКУД</p>
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
                        <p>Способы идентификации</p>
                    </td>
                    <td colspan="3">
                        <p>Отпечатки пальцев, смартфоны с NFC, карты доступа</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Формат карт доступа</p>
                    </td>
                    <td colspan="3">
                        <p>HID, EM-Marin, Mifare</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Общее число карт доступа:<br /> сотрудников<br /> посетителей</p>
                    </td>
                    <td>
                        <br />
                        <p>200000<br /> 200000</p>
                    </td>
                    <td>
                        <br />
                        <p>500</p>
                        <p>500</p>
                    </td>
                    <td>
                        <br>
                        <p>не ограничено</p>
                        <p>не ограничено</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Число событий регистрации<br /> </p>
                    </td>
                    <td>
                        <p>не ограничено<br /> </p>
                    </td>
                    <td>
                        <p>1000000</p>
                    </td>
                    <td>
                        <p>не ограничено<br /> </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Количество пространственных зон контроля</p>
                    </td>
                    <td colspan="3">
                        <p>1024</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Количество критериев доступа по времени типа<br /> временная зона (до 4-х временных
                            интервалов)<br />
                            недельный график<br /> скользящий посуточный график<br /> скользящих понедельных графиков
                        </p>
                    </td>
                    <td colspan="3">
                        <p>255<br /> 255<br /> 255<br /> 255</p>
                        <p>255</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Количество дней с особым статусом, праздников (до 8 типов)</p>
                    </td>
                    <td colspan="3">
                        <p>365</p>
                    </td>
                </tr>
            </tbody>
        </table> -->


    </div>
</div>

<!-- <div class="pw-video-button" id="video-gallery">
    <a href="https://www.youtube.com/watch?v=iSaqzXq6qc4" data-download-url="/video/PERCo-Web.mp4 ">
        <img src="/images/icons/pw-video.png" alt="Видео PERCo-Web">
    </a>
</div> -->


<script>
    // select the element that will be replaced
    var el = document.querySelector('h1');

    // <a href="/javascript/manipulation/creating-a-dom-element-51/">create a new element</a> that will take the place of "el"
    var newEl = document.createElement('h1');
    newEl.innerHTML = 'Система контроля доступа<br><b>PERCo-Web</b>';

    // replace el with newEL
    el.parentNode.replaceChild(newEl, el);
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#lightgallery").lightGallery({
            zoom: true,
            download: false,
        });
        $("#sheme_skud-percoweb").lightGallery({
            selector: "a",
            zoom: true,
            download: true,
            height: "100%",
            width: "100%",
            iframeMaxWidth: "100%"
        });
        // $("#sheme_skud").lightGallery({
        //     zoom: true,
        //     download: false,
        // });
    });
</script>