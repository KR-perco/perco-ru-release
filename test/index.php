<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Контактная информация для связи с нашими специалистами | PERCo");
$APPLICATION->SetPageProperty("description", "Наши специалисты с удовольствием ответят на интересующие Вас вопросы про турникеты, калитки, ограждения, системы безопасности и СКУД PERCo");
$APPLICATION->SetPageProperty("keywords", "турникеты, калитки, ограждения, системы безопасности, системы контроля доступа, скуд");
$APPLICATION->SetTitle("Контакты");

$APPLICATION->SetAdditionalCSS("/css/kontakty.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/kontakty.js"); // подключение скриптов
//$APPLICATION->AddHeadString('<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js"></script>'); // подключение скриптов
?>
<?
$file = file_get_contents('../contacts.json'); // Открыть файл
$contacts = json_decode($file, true); // Декодировать в массив
unset($file); // Очистить переменную $file
?>

<div id="content">
	<h1>
		<?$APPLICATION->ShowTitle(false, false)?>
	</h1>
	<div class="contacts">
		<div class="line">
			<div class="col-2">
				<div class="box-before">
					<h2 id="products">Выбор и приобретение продукции</h2>
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
						<dd class="addres">194021, Россия, Санкт-Петербург,<br> Политехническая ул., д. 4, корпус 2<br>
							9:00–18:00 (мск), по рабочим дням</dd>
					</dl>
					<p style="padding-left: 40px; margin-top:30px;">
						<a href="https://www.youtube.com/percoru" rel="nofollow" target="_blank"><img alt="youtube"
								src="/images/icons/you.svg" width="30px" height="30px" /></a>

						<a href="https://www.instagram.com/perco_com/" style="margin-right: 10px;" rel="nofollow"
							target="_blank"><img alt="twitter" src="/images/icons/inst.svg" width="30px"
								height="30px" /></a>
					</p>
				</div>
				<div class="box-before">
					<h2 id="techsupport">Техническая поддержка</h2>
					<dl>
						<dd class="telephone"><span>8-800-775-37-05<br>+7 (812) 247-04-55</span></dd>
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
					<dl>
						<dd class="viber"><a href="viber://pa?chatURI=percospb">Viber</a></dd>
					</dl>
					<dl>
						<dd class="time">9:00–18:00 (мск), по рабочим дням</dd>
					</dl>

					<dl>
						<dd class="car">
							<span>
								Курьерская доставка: <span itemprop="postalCode">194021</span>, 
								<span itemprop="addressLocality">Россия, <br>Санкт-Петербург,</span>
								<span itemprop="streetAddress">Политехническая ул., <br>д. 4, корпус 2</span><br>
								ООО «ПЭРКо», ИНН 7806437448<br>
								<span itemprop="telephone">+7 (812) 247-04-54</span><br>
								с 9:00 до 17:30 по рабочим дням
							</span>
						</dd>
					</dl>
				</div>
			</div>
			<?
				$checkTabs = "checked='checked'";
				if (false)  $spb = $checkTabs;
				else if (false) $pskov = $checkTabs;
				else $msk = $checkTabs;
			?>

			<div class="col-2">
				<div class="box-before">
					<h2 id="storage">Склады</h2>

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
										<span itemprop="telephone">+7 (962) 966-34-87</span>
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
									<a data-src="/kontakty/moscow.php?iframe=true&map=yandex" _map="yandex"
										title="Яндекс" data-iframe="true"><img src="/images/kontakty/yandex.svg"></a>
									<a data-src="/kontakty/moscow.php?iframe=true&map=google" _map="google"
										title="Google" data-iframe="true"><img
											src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
								</dd>
							</dl>
							<div class="pdf-box">
								<img width="20" height="16" src="/images/icons/pdf.svg">
								<a href="/download/other/proezd-k-skladu-v-moskve.pdf" target="_blank"
									onclick="ga('send', 'event', {'eventCategory': 'Контакты', 'eventAction': 'download', 'eventLabel': 'Проезд до склада в Москве'});"
									download="">Как добраться общественным транспортом</a>
							</div>


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
												1</span>.</span></dd>
								</dl>
								<dl>
									<dd class="map">
										<a data-src="/kontakty/spb.php?iframe=true&map=yandex" _map="yandex"
											title="Яндекс" data-iframe="true"><img
												src="/images/kontakty/yandex.svg"></a></a>
										<a data-src="/kontakty/spb.php?iframe=true&map=google" _map="google"
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
										<a data-src="/kontakty/pskov.php?iframe=true&map=yandex" _map="yandex"
											title="Яндекс" data-iframe="true"><img
												src="/images/kontakty/yandex.svg"></a>
										<a data-src="/kontakty/pskov.php?iframe=true&map=google" _map="google"
											title="Google" data-iframe="true"><img
												src="/images/kontakty/google-maps-seeklogo.com.svg"></a>
									</dd>
								</dl>
							</div>
						</div>
					</div>
					<p><a href="/kontakty/samovyvoz.php">Правила получения оплаченного оборудования на условиях
							самовывоза</a></p>
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
				<div class="box-before">
					<h2 id="personal">Служба персонала</h2>
					<dl>
						<dd class="telephone">+7 (812) 247-04-51 (Санкт-Петербург)<br>
							+7 (8112) 79-47-01 (Псков)<br>
							+7 (8112) 79-47-04 (Псков)<br>
					</dl>
					<dl>
						<dd class="mail"><a href="mailto:ok@perco.ru">ok@perco.ru</a></dd>
					</dl>
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
<script src="https://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">
	$(document).ready(function () {
		ymaps.ready(function () {
			var geolocation = ymaps.geolocation;
			if (geolocation.city == 'Санкт-Петербург') {
				$("#spb").attr("checked", "checked");
			}
			else if (geolocation.city == 'Псков') {
				$("#pskov").attr("checked", "checked");
			}
			else $("#moscow").attr("checked", "checked");

		});
	});
</script>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>