<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контактная информация для связи с нашими специалистами | PERCo");
$APPLICATION->SetPageProperty("description", "Наши специалисты с удовольствием ответят на интересующие Вас вопросы про турникеты, калитки, ограждения, системы безопасности и СКУД PERCo");
$APPLICATION->SetPageProperty("keywords", "турникеты, калитки, ограждения, системы безопасности, системы контроля доступа, скуд");
$APPLICATION->SetTitle("Контакты");

$APPLICATION->SetAdditionalCSS("/css/setka-12.css");  
$APPLICATION->SetAdditionalCSS("/css/kontakty.css");  
$APPLICATION->AddHeadScript("/scripts/pages/kontakty.js"); // подключение скриптов  
?>
<?
$file = file_get_contents('../contacts.json'); // Открыть файл 
$contacts = json_decode($file, true); // Декодировать в массив
unset($file); // Очистить переменную $file 
 
$checkTabs = "checked='checked'";
if (false)  $spb = $checkTabs;
else if (false) $pskov = $checkTabs;
else $msk = $checkTabs; 
?>

<div class="container">
	<div class="contacts">
		<div class="row">
			<div class="cell-6 push-1-m cell-10-m push-0-sm cell-12-sm"> 
				<h1>
					<?$APPLICATION->ShowTitle(false, false)?>
				</h1>
				<div class="accordion">
					<div class="box-before plus hide show-m">  
						<input id="hide_adress" type="checkbox"> 
						<label for="hide_adress"><h2 id="adress">Адрес</h2></label>
						<div>
							<div class="tabs">
								<input type="radio" checked id="adress__spb" name="vyborAdress">
								<label for="adress__spb"><span class="dashed">Санкт‑Петербург</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization"> 
									<dl>
										<dd class="addres">194021, Россия, Санкт-Петербург,<br> Политехническая ул., д. 4, корпус 2, строение 1<br> </dd>
									</dl>
									<dl>
										<dd class="map">
											<a class="map-link" data-src="/kontakty/spb.php?iframe=true&amp;map=yandex&amp;type=offise" _map="yandex" title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
											<a class="map-link" data-src="/kontakty/spb.php?iframe=true&amp;map=google&amp;type=offise" _map="google" title="Google" data-iframe="true"><img src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
										</dd>
									</dl>
								</div>
								<input type="radio" id="adress__pskov" name="vyborAdress">
								<label for="adress__pskov"><span class="dashed">Псков</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization"> 
									<dl>
										<dd class="addres"><span><span itemprop="postalCode">180600</span>, <span
													itemprop="addressLocality">Россия, Псков</span><br>
												<span itemprop="streetAddress"> ул. Леона Поземского 123В</span></span>
										</dd>
									</dl>
									<dl>
										<dd class="map">
											<a class="map-link" data-src="/kontakty/pskov-zavod.php?iframe=true&map=yandex" _map="yandex"
												title="Яндекс" data-iframe="true"><img
													src="/images/kontakty/yandex.svg"></a>
											<a class="map-link" data-src="/kontakty/pskov-zavod.php?iframe=true&map=google" _map="google"
												title="Google" data-iframe="true"><img
													src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
										</dd>
									</dl>
								</div>
							</div>
						</div>
					</div>
					<div class="box-before plus">
						<input id="hide_products" type="checkbox"> 
						<label for="hide_products"><h2 id="products">Выбор и приобретение продукции</h2></label> 
						<div>
							<div class="tabs">
								<input type="radio" checked id="russia" name="vyborProd">
								<label for="russia"><span class="dashed">Россия</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization">
									<dl>
										<dd class="telephone"><span><span itemprop="telephone">
													<?echo $contacts[phone]?></span><br>
												<span itemprop="telephone">+7 (812) 247-04-57</span></span></dd>
									</dl>
									<dl>
										<dd class="mail"><a href="mailto:<?echo $contacts[email]?>"><span itemprop="email">
													<?echo $contacts[email]?></span></a>
										</dd>
									</dl>
									<dl>
										<dd class="addres">194021, Россия, Санкт-Петербург,<br> Политехническая ул., д. 4, корпус 2, строение 1<br>
											9:00–18:00 (мск), по рабочим дням</dd>
									</dl>
									<p style="padding-left: 10px; margin: 30px 50px 15px 40px;">
										<!--<a href="https://www.youtube.com/percoru" rel="nofollow" target="_blank"><img alt="youtube"
												src="/images/icons/you.svg" width="30px" height="30px" /></a>-->
										<a href="https://t.me/perco_com" rel="nofollow" target="_blank"><img alt="telegram"
												src="/images/icons/telegram-app.png" width="30px" height="30px" /></a>
										<a href="https://zen.yandex.ru/id/5dd3ece3f5a25e6c5ca78bf8" rel="nofollow" target="_blank"><img alt="zen"
												src="/images/icons/yandex-zen.png" width="30px" height="30px" /></a>
										<!-- <a href="https://www.instagram.com/perco_com/" style="margin-right: 10px;" rel="nofollow"
											target="_blank"><img alt="instagram" src="/images/icons/inst.svg" width="30px"
												height="30px" /></a> -->
									</p>
								</div>
								<input type="radio" id="uae" name="vyborProd">
								<label for="uae"><span class="dashed">ОАЭ</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization">
									<dl>
										<dd class="telephone"><span><span itemprop="telephone">+971 04 249 8603</span></span></dd>
									</dl>
									<dl>
										<dd class="wa"><span><span itemprop="telephone">+971 55 377 3539</span></span></dd>
									</dl>
									<dl>
										<dd class="mail"><a href="mailto:sales@perco.ae"><span itemprop="email">sales@perco.ae</span></a>
										</dd>
									</dl>
									<dl>
										<dd class="addres">Burlington Tower, Business Bay, Dubai, UAE<br>8:00 – 17:00, Воскресенье – Четверг</dd>
									</dl>
									<p style="padding-left: 10px; margin: 30px 50px 15px 40px;">
										<!-- <a href="https://www.youtube.com/percoru" rel="nofollow" target="_blank"><img alt="youtube"
												src="/images/icons/you.svg" width="30px" height="30px" /></a> -->
										<a href="https://t.me/perco_com" rel="nofollow" target="_blank"><img alt="telegram"
												src="/images/icons/telegram-app.png" width="30px" height="30px" /></a>
										<a href="https://zen.yandex.ru/id/5dd3ece3f5a25e6c5ca78bf8" rel="nofollow" target="_blank"><img alt="zen"
												src="/images/icons/yandex-zen.png" width="30px" height="30px" /></a>

										<!-- <a href="https://www.instagram.com/perco_com/" style="margin-right: 10px;" rel="nofollow"
											target="_blank"><img alt="instagram" src="/images/icons/inst.svg" width="30px"
												height="30px" /></a> -->
									</p>
								</div>
							</div>
						</div>
					</div>
					<div class="box-before plus">
						
						<input id="hide_techsupport" type="checkbox"> 
						<label for="hide_techsupport"><h2 id="techsupport">Техническая поддержка</h2></label> 
						<div>
							
							<dl>
								<dd class="telephone"><span>8-800-775-37-05<br>+7 (812) 247-04-55</span></dd>
							</dl>
							<dl>
								<dd class="telegram"><a href="https://t.me/PERCo_Service_Bot" target="_blank">@PERCo_Service_Bot</a></dd>
							</dl>
							<dl>
								<dd class="mail"></dd>
								<div class="mail-group">
									<?
									// echo'<pre>';
									// print_r($contacts);
									// echo'</pre>';
									// echo'<pre>1';
									// echo $contacts[emailservicesystem];
									// echo'</pre>';

									?>
									<dd id="techsupport-mail-1"><a href="mailto:<?echo $contacts[emailServiceSystem]?>">
											<?echo $contacts[emailServiceSystem]?></a></dd>
									<dd id="techsupport-mail-2"><a href="mailto:<?echo $contacts[emailServiceTurniket]?>">
											<?echo $contacts[emailServiceTurniket]?></a></dd>
									<dd id="techsupport-mail-3"><a href="mailto:<?echo $contacts[emailServiceSoft]?>">
											<?echo $contacts[emailServiceSoft]?></a></dd>
									<dd id="techsupport-mail-4"><a href="mailto:<?echo $contacts[emailServiceLocks]?>">
											<?echo $contacts[emailServiceLocks]?></a></dd>
									<dd id="techsupport-mail-5"><a href="mailto:<?echo $contacts[emailServiceService]?>">
											<?echo $contacts[emailServiceService]?></a></dd>
								</div>
							</dl>
							<?/*<dl>
								<dd class="viber"><a href="viber://pa?chatURI=percospb">Viber</a></dd>
							</dl>*/?>
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
										<span itemprop="streetAddress">Политехническая ул., д. 4,<br>корпус 2, строение 1</span><br>
										ООО «ПЭРКО», ИНН 7806437448<br>
										<span itemprop="telephone">+7 (812) 247-04-54</span><br>
										с 9:00 до 17:30 по рабочим дням
									</span>
								</dd>
							</dl>
						</div>
					</div> 
					
					<div class="box-before plus">
						<input id="hide_zip" type="checkbox"> 
						<label for="hide_zip"><h2 id="zip">Приобретение ЗИП</h2></label> 
						<div>
							<dl>
								<dd class="telephone">
									<span>8-800-775-37-05<br>+7 (812) 247-04-55
									</span>
								</dd>
							</dl>
							<dl>
								<dd class="mail">
									<a href="mailto:spare_parts@perco.ru">spare_parts@perco.ru</a>
								</dd>
							</dl> 
						</div>
					</div>
					<div class="box-before plus">
						<input id="hide_storage" type="checkbox"> 
						<label for="hide_storage"><h2 id="storage">Склады</h2></label> 
						<div>
							<div class="tabs">
								<input type="radio" id="moscow" name="vkladki">
								<label for="moscow"><span class="dashed">Москва</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization">
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
											<a class="map-link" data-src="/kontakty/moscow.php?iframe=true&map=yandex" _map="yandex"
												title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
											<a class="map-link" data-src="/kontakty/moscow.php?iframe=true&map=google" _map="google"
												title="Google" data-iframe="true"><img
													src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
										</dd>
									</dl>
									<dl>
										<dd> 
											<div class="pdf-box">
												<img width="20" height="16" src="/images/icons/pdf.svg">
												<a href="/download/other/proezd-k-skladu-v-moskve.pdf" target="_blank"
													onclick="ga('send', 'event', {'eventCategory': 'Контакты', 'eventAction': 'download', 'eventLabel': 'Проезд до склада в Москве'});"
													download="">Как добраться общественным транспортом</a>
											</div>
										</dd>
									</dl>


								</div>
								<input type="radio" id="spb" <? echo $spb; ?> name="vkladki">
								<label for="spb"><span class="dashed">Санкт-Петербург</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization">
									<span style="display: none;" itemprop="name">PERCo – производство турникетов, систем
										безопасности и
										контроля доступа (СКУД)</span>
									<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">

										<dl>
											<dd class="telephone"><span itemprop="telephone">+7 (812) 247-04-54</span></dd>
										</dl>
										<dl>
											<dd class="mail"><a href="mailto:dl@perco.ru"><span
														itemprop="email">dl@perco.ru</span></a></dd>
										</dl>
										<dl>
											<dd class="time">9:00–17:30 (мск), по рабочим дням</dd>
										</dl>
										<dl>
											<dd class="addres"><span><span itemprop="postalCode">194021</span>, <span
														itemprop="addressLocality">Россия,
														Санкт-Петербург</span><br><span itemprop="streetAddress">Политехническая
														ул., д. 4, корпус 2, строение
														1</span></span></dd>
										</dl>
										<dl>
											<dd class="map">
												<a class="map-link" data-src="/kontakty/spb.php?iframe=true&map=yandex" _map="yandex"
													title="Яндекс" data-iframe="true"><img
														src="/images/kontakty/yandex.svg"></a></a>
												<a class="map-link" data-src="/kontakty/spb.php?iframe=true&map=google" _map="google"
													title="Google" data-iframe="true"><img
														src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
											</dd>
										</dl>
									</div>
								</div>
								<input type="radio" id="pskov" <? echo $pskov; ?> name="vkladki">
								<label for="pskov"><span class="dashed">Псков</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization">
									<span style="display: none;" itemprop="name">PERCo – производство турникетов, систем
										безопасности и
										контроля доступа (СКУД)</span>
									<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">


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
											<dd class="addres"><span><span itemprop="postalCode">180006</span>, <span
														itemprop="addressLocality">Россия, Псков</span><br>
													<span itemprop="streetAddress"> ул. Леона Поземского, д. 110д, лит. В, пом.
														1001</span></span>
											</dd>
										</dl>
										<dl>
											<dd class="map">
												<a class="map-link" data-src="/kontakty/pskov-sklad.php?iframe=true&map=yandex" _map="yandex"
													title="Яндекс" data-iframe="true"><img
														src="/images/kontakty/yandex.svg"></a>
												<a class="map-link" data-src="/kontakty/pskov-sklad.php?iframe=true&map=google" _map="google"
													title="Google" data-iframe="true"><img
														src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
											</dd>
										</dl>
									</div>
								</div>
								<input type="radio" id="tal" name="vkladki">
								<label for="tal"><span class="dashed">Таллинн</span></label>
								<div class="item" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
									<dl>
										<dd class="time">8:00 - 16:00, по рабочим дням</dd>
									</dl>
									<dl>
										<dd class="addres"><span><span
													itemprop="addressLocality">Эстония, Таллинн</span><br>
												<span itemprop="streetAddress">45 Akadeemia str.</span></span>
										</dd>
									</dl>
									<dl>
										<dd class="map">
											<a class="map-link" data-src="/kontakty/tallin.php?iframe=true&map=yandex" _map="yandex"
												title="Яндекс" data-iframe="true"><img
													src="/images/kontakty/yandex.svg"></a>
											<a class="map-link" data-src="/kontakty/tallin.php?iframe=true&map=google" _map="google"
												title="Google" data-iframe="true"><img
													src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
										</dd>
									</dl>
								</div>
								<input type="radio" id="rot" name="vkladki">
								<label for="rot"><span class="dashed">Дубай</span></label>
								<div class="item" itemscope itemtype="http://schema.org/Organization">
									<dl> 
										<dd class="time">8:00 - 18:00, по рабочим дням</dd>
									</dl>
									<dl>
										<dd class="addres">
											<span>
												<span itemprop="addressLocality">
													ОАЭ, Дубай
												</span><br>
												<span itemprop="streetAddress">
													1766 Jebel Ali Free Zone South 
												</span>
											</span>
										</dd>
									</dl>
									<dl>
										<dd class="map">
											<a class="map-link" data-src="/kontakty/dubai.php?iframe=true&map=yandex" _map="yandex"
												title="Яндекс" data-iframe="true"><img
													src="/images/kontakty/yandex.svg"></a>
											<a class="map-link" data-src="/kontakty/dubai.php?iframe=true&map=google" _map="google"
												title="Google" data-iframe="true"><img
													src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
										</dd>
									</dl>
								</div>
							</div>
							<div class="pickup-rules">
								<a href="/kontakty/samovyvoz.php">Правила получения оплаченного оборудования на условиях
								самовывоза</a>
							</div>
						</div>
					</div>					
					<div class="box-before plus"> 
						<input id="hide_lerning" type="checkbox"> 
						<label for="hide_lerning"><h2 id="lerning">Сотрудничество и обучение</h2></label> 
						<div> 
							<dl>
								<dd class="telephone">+7 (812) 247-04-59</dd>
							</dl>
							<dl>
								<dd class="mail"><a href="mailto:seminar@perco.ru">seminar@perco.ru</a></dd>
							</dl>
						</div>
					</div> 
					<div class="box-before plus">
						<input id="hide_personal" type="checkbox"> 
						<label for="hide_personal"><h2 id="personal">Служба персонала</h2></label> 
						<div>
							<dl>
								<dd class="telephone">
									+7 (812) 247-04-51 (Санкт-Петербург)<br>
									+7 (8112) 79-47-01 (Псков)<br>
									+7 (8112) 79-47-04 (Псков)<br>
							</dl>
							<dl>
								<dd class="mail"><a href="mailto:ok@perco.ru">ok@perco.ru</a></dd>
							</dl>
						</div>
					</div>
					<div class="box-before plus">
						<input id="hide_requisites" type="checkbox"> 
						<label for="hide_requisites"><h2 id="requisites">Реквизиты компании</h2></label> 
						<div> 
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
									ОГРН 1107847252611<br>
									ИНН 7806437448 КПП 780201001<br>
									р/с 40702810970000001142<br>
									в ПАО «Банк «Санкт-Петербург»<br>г. Санкт-Петербург<br>
									БИК 044030790 к/с 30101810900000000790
								</dd>
							</dl>
							<dl>
								<dd>
									ОКПО 67455649<br>
									ОКАТО 40265562000.<br>
									ОКТМО 40315000<br>
									ОКВЭД 26.11, 25.61, 46.52.2, 68.2
								</dd>
							</dl>
							<dl>
								<dd class="telephone"><span itemprop="telephone">(812) 247-04-52, 247-04-50</span></dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
			<div class="cell-6 contacts_rigth-col hide-m">
				<div class="row">
					<div class="push-2 cell-8 post-2 map_left-margin">
						<span class="map_title">Главный офис в Санкт-Петербурге</span> 
						<div class="map_container map">
							<a class="map-link" data-src="/kontakty/spb.php?iframe=true&map=yandex&type=offise" _map="yandex" title="Яндекс" data-iframe="true">
								<div class="frame"></div> 
								<span class="custum-hint custum-hint__1">  194021, Россия, Санкт-Петербург, Политехническая ул., д. 4, корпус 2, строение 1</span> 
								
								<div class="map_image"> <img src="/images/kontakty/map-spb.jpg" alt=""> </div>
							</a>
						</div>
						<span class="map_title">Завод в Пскове</span>
						<div class="map_container map">
							<a class="map-link" data-src="/kontakty/pskov-zavod.php?iframe=true&map=yandex" _map="yandex" title="Яндекс" data-iframe="true">
								<div class="frame"></div> 
								<span class="custum-hint custum-hint__2">180600, Россия, Псков, ул. Леона Поземского 123В</span> 
								
								<div class="map_image"> <img src="/images/kontakty/map-pskov.jpg" alt=""> </div>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>
<div style="display:none">
	<h2>Представительства PERC<span style="text-transform:lowercase;">o</span> в регионах</h2>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Москва</span></dt>
			<dd><span itemprop="postalCode">108811</span>, <span itemprop="streetAddress">22-ой км Киевского шоссе,
					домовладение 4</span></dd>
			<dd><span itemprop="telephone">+7 (499) 703-21-39</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Волгоград</span></dt>
			<dd><span itemprop="postalCode">400005</span>, <span itemprop="streetAddress">ул. 13-й Гвардейской,
					д.13а</span></dd>
			<dd><span itemprop="telephone">+7 (844) 278-03-11</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Воронеж</span></dt>
			<dd><span itemprop="postalCode">394026</span>, <span itemprop="streetAddress">ул. Текстильщиков
					2А</span></dd>
			<dd><span itemprop="telephone">+7 (473) 204-54-00</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Екатеринбург</span></dt>
			<dd><span itemprop="postalCode">620026</span>, <span itemprop="streetAddress">ул. Малышева, д.51</span>
			</dd>
			<dd><span itemprop="telephone">+7 (343) 318-24-88</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Казань</span></dt>
			<dd><span itemprop="postalCode">420124</span>, <span itemprop="streetAddress">ул. Мусина, д.29</span>
			</dd>
			<dd><span itemprop="telephone">+7 (843) 206-04-35</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Красноярск</span></dt>
			<dd><span itemprop="postalCode">660049</span>, <span itemprop="streetAddress">пр. Мира, д.10</span></dd>
			<dd><span itemprop="telephone">+7 (391) 204-62-45</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Нижний Новгород</span></dt>
			<dd><span itemprop="postalCode">603002</span>, <span itemprop="streetAddress">ул. Советская, д.3</span>
			</dd>
			<dd><span itemprop="telephone">+7 (831) 429-13-26</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Новосибирск</span></dt>
			<dd><span itemprop="postalCode">630032</span>, <span itemprop="streetAddress">Горский микрорайон,
					д.84</span></dd>
			<dd><span itemprop="telephone">+7 (383) 280-42-50</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Омск</span></dt>
			<dd><span itemprop="postalCode">644074</span>, <span itemprop="streetAddress">ул. 70 лет Октября, 13,
					корп.3</span></dd>
			<dd><span itemprop="telephone">+7 (381) 297-23-01</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Пермь</span></dt>
			<dd><span itemprop="postalCode">614007</span>, <span itemprop="streetAddress">ул. 25 Октября,
					д.72</span></dd>
			<dd><span itemprop="telephone">+7 (342) 205-83-25</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Ростов-на-Дону</span></dt>
			<dd><span itemprop="postalCode">344019</span>, <span itemprop="streetAddress">ул. Мясникова, д.54</span>
			</dd>
			<dd><span itemprop="telephone">+7 (863) 303-64-08</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Самара</span></dt>
			<dd><span itemprop="postalCode">443086</span>, <span itemprop="streetAddress">ул. Ерошевского,
					д.3А</span></dd>
			<dd><span itemprop="telephone">+7 (846) 206-05-14</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Уфа</span></dt>
			<dd><span itemprop="postalCode">450026</span>, <span itemprop="streetAddress">ул. Трамвайная 2</span>
			</dd>
			<dd><span itemprop="telephone">+7 (347) 214-90-26</span></dd>
		</dl>
	</div>
	<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
		<dl>
			<dt><span itemprop="addressLocality">Челябинск</span></dt>
			<dd><span itemprop="postalCode">454036</span>, <span itemprop="streetAddress">ул. Каслинская,
					д.30</span></dd>
			<dd><span itemprop="telephone">+7 (351) 202-03-56</span></dd>
		</dl>
	</div>
</div>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=08aed732-1f02-4c7c-b16d-b59fd791a607" type="text/javascript"></script> 
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>