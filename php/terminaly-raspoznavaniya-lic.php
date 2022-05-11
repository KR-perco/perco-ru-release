<?
$price_res = getCurrency(CURRENCY_SWITCH);

$products = array( 
	"ZKTeco ProFace X ID/MF/P" => array(
		"name" => "ZKTeco ProFace X[ID/MF/P]",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/zkteco-profacex.jpg",
		"description" => "",
		"price" => "1317"
    ),  
	// новый
	"ZKTeco SpeedFace-V5L" => array(
		"name" => "ZKTeco SpeedFace-V5L-RFID[TI]",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/zkteco-speedface-v5l-td.jpg",
		"description" => "",
		"price" => "1617"
    ), 
	"Suprema FACELite" => array(
		"name" => "Suprema FACELite",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/suprema-facelite.jpg",
		"description" => "",
		"price" => "708"
	),
	"Suprema Face Station 2" => array(
		"name" => "Suprema Face Station 2",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/suprema-facestation-2.jpg",
		"description" => "",
		"price" => "960"
	),
	// новый
	"Suprema Face Station F2" => array(
		"name" => "Suprema Face Station F2",
		"image" => "/images/products/terminaly-raspoznavaniya-lits/suprema-facestation-f2.jpg",
		"description" => "",
		"price" => "1477"
	),
);
include 'draw_product_cards.php'; 
?>

<div class="scrollbar">
<p>Терминалы распознавания лиц ZKTeco и Suprema работают в системе контроля доступа PERCo-Web под управлением программного обеспечения PERCo-WS «Стандартный пакет ПО».</p>
<p>Терминалы подключаются к системе PERCo-Web по сети Ethernet. Интерфейс системы позволяет заносить и сохранять фотографии сотрудников и посетителей для идентификации, а также производить конфигурацию устройств и управлять ими в режиме онлайн. Все события проходов через терминалы сохраняются в системе PERCo-Web.</p>
<div style="text-align: center;">
	<div style="display: inline-flex; flex-direction: column; align-items: center; margin: 64px 16px; max-inline-size: 400px;">
		<img src="/images/products/speed-gates/slider-product/st-01_26_page.jpg" style="margin: 0 8px; max-height: 352px;">
		<div style="margin-block-start: 32px;">Скоростной проход PERCo-ST-01 с кронштейном для установки терминала распознавания лиц Suprema Face Station 2</div>
	</div>
	<div style="display: inline-flex; flex-direction: column; align-items: center; margin: 64px 16px;">
		<img src="/images/products/perco-web/slides/6.jpg" style="margin: 0 8px; max-height: 352px;">
		<div style="margin-block-start: 32px;">Распознавание лиц в системе PERCo-Web</div>
	</div>
</div>
<h4>Защита от эмуляции</h4>
<p>Все терминалы, работающие в системе PERCo-Web, имеют защиту от эмуляции лица.</p>
<p>Для защиты от предъявления фотографии в терминалах применяется детектирование живого лица, основанное на инфракрасной подсветке, а также детектирование и фотографирование лиц посетителей в момент прохода с сохранением фото высокого качества в журнале событий.</p>
<h4>Режимы идентификации</h4>
<p>Система PERCo-Web поддерживает все режимы идентификации терминалов Suprema и ZKTeco: распознавание лиц совместно с идентификацией по карте доступа, смартфону или отпечатку пальца. Терминалы Suprema FaceLite и FaceStation 2 отличает наличие встроенного считывателя бесконтактных карт доступа, к терминалам ZKTeco считыватель подключается дополнительно. Под заказ возможна поставка терминалов ZKTeco со встроенными считывателями.</p>
<h4>Режим видеоидентификации </h4>
<p>Работа терминала распознавания лиц ZKTeco SpeedFace V5L поддерживается в режиме верификации. После распознавания лица терминалом оператор подтверждает проход, без подтверждения проход будет невозможен.  Терминал также может работать в режиме индикации для визуального контроля оператором проходящих сотрудников в режиме верификации. Оба режима доступны опционально.</p>
<h4>Реакции на события</h4>
<p>Система PERCo-Web позволяет назначать алгоритм реакций на события, полученных с терминалов ZKTeco и Suprema. Например, при проходе сотрудника с распознаванием по лицу можно сформировать уведомляющее событие, которое будет отправляться на Viber оператора системы.</p>
<h4>Измерение температуры</h4>
<p>Терминал ZKTeco SpeedFace V5L (TD) имеет температурный датчик и позволяет определить человека с повышенной температурой (значение можно выставить в интерфейсе PERCo-Web). Также терминал способен определить наличие на лице маски.</p>
<p>Для регистрируемых терминалом событий типа "Проход с повышенной температурой" и "Проход без маски" в системе PERCo-Web можно назначить соответствующие реакции исполнительных устройств. Например, запрет прохода на предприятие, блокировка в шлюзе и т.д. Все данные о таких событиях сохраняются в системе PERCo-Web.</p>
<h4>Добавление пользователей</h4>
<p>При работе с терминалами Suprema при добавлении новых пользователей для терминалов Suprema Face Station 2 и Suprema FaceLite достаточно добавить новых сотрудников/посетителей в систему PERCo-Web.</p>
<p>При работе с терминалами ZKTeco, помимо добавления новых пользователей в системе PERCo-Web, их также необходимо добавить непосредственно в терминалах. </p>
<h4>Русскоязычный интерфейс</h4>
<p>Русскоязычный интерфейс доступен в терминалах ZKTeco ProFace X и ZKTeco SpeedFace V5L. В терминале Suprema Face Station 2 русскоязычная прошивка предоставляется по запросу.</p>
<h4>Сравнительная таблица технических характеристик терминалов распознавания лиц производства ZKTeco и Suprema</h4>
<table style="margin-block-start: 32px; text-align: center;">
	<tr>
		<td rowspan="2"><b>Терминалы распознавания лиц</b></td>
		<td colspan="2"><b>ZKTeco</b></td>
		<td colspan="3"><b>Suprema</b></td>
	</tr>
	<tr>
		<td><b>ProFace X</b></td>
		<td><b>SpeedFace-V5L[TI]</b></td>
		<td><b>FACELite</b></td>
		<td><b>Face Station 2</b></td>
		<td><b>Face Station F2</b></td> 
	</tr>
	<tr>
		<td>
			<b>Дисплей</b>
		</td>
		<td>
			8" IPS (400 люкс) <br> с тачскрином	 
		</td>
		<td>
			5" TFT <br> сенсорный 	
		</td>
		<td>
			2" TFT (320х240) <br> цветной <br> сенсорный	
		</td>
		<td>
			4" TFT (800х480) <br> цветной <br> сенсорный	
		</td>
		<td>
			7" IPS (800х1280) <br> цветной <br> сенсорный
		</td> 
	</tr>
	<tr>
		<td>
			<b>RFID-считыватели</b>
		</td>
		<td>
			EMM, Mifare (опция)	
		</td>
		<td>
			EMM, Mifare (опция)	
		</td>
		<td>
			EMM, Mifare, NFC	
		</td>
		<td>
			EMM, Mifare, NFC	
		</td>
		<td>
			EMM, Mifare, NFC, BLE
		</td> 
	</tr>
	<tr>
		<td>
			<b>Кол-во пользователей</b>
		</td>
		<td>
			30 000 
		</td>
		<td>
			6 000	
		</td>
		<td>
			30 000 (1:1) <br>
			3 000 (1:N)	
		</td>
		<td>
			30 000 (1:1) <br>
			3 000 (1:N)	
		</td>
		<td>
			100 000 (1:1) <br>
			50 000 (лицо)
		</td> 
	</tr>
	<tr>
		<td>
			<b>Кол-во шаблонов лиц</b>
		</td>
		<td>
			30 000 (1:N) / <br>
			50 000 (опция)	
		</td>
		<td>
			6 000 <br>
			(ладоней – 3 000)	
		</td>
		<td>
			900 000 (1:1) <br>
			90 000 (1:N)	
		</td>
		<td>
			900 000 (1:1) <br>
			90 000 (1:N)	
		</td>
		<td>
			900 000 (1:1) <br>
			90 000 (1:N) 
		</td> 
	</tr>
	<tr>
		<td>
			<b>Температура</b>
		</td>
		<td>
			-30°C ~ 60°C	
		</td>
		<td>
			-10°C ~ 50°C	
		</td>
		<td>
			-20°C ~ 50°C	
		</td>
		<td>
			-20°C ~ 50°C	
		</td>
		<td>
			-20°C ~ 50°C
		</td> 
	</tr>
	<tr>
		<td>
			<b>Процессор</b>
		</td>
		<td>
			900 MГц <br>
			(два ядра)	
		</td>
		<td>
			900 MГц <br>
			(два ядра)	
		</td>
		<td>
			1,2 ГГц <br>
			(четыре ядра)	
		</td>
		<td>
			1,4 ГГц <br> 
			(четыре ядра)	
		</td>
		<td>
			1,8 ГГц (2 ядра) <br>
			1,4 ГГЦ (4 ядра) 
		</td> 
	</tr>
	<tr>
		<td>
			<b>Память</b>
		</td>
		<td> 
			512 MБ RAM / <br>
			8ГБ флеш	 
		</td>
		<td>
			512 MБ RAM / <br>
			8ГБ флеш	
		</td>
		<td>
			1GB RAM + 8GB Flash	
		</td>
		<td>
			1GB RAM + 8GB Flash	
		</td>
		<td>
			2GB RAM + 16GB Flash
		</td> 
	</tr>
	<tr>
		<td>
			<b>Камера</b>
		</td>
		<td>
			2MP WDR Low Light	
		</td>
		<td>
			2MP WDR Low Light	
		</td>
		<td>
			CMOS 720x480, оптическая + ИК	
		</td>
		<td>
			CMOS 720x480, оптическая + ИК	
		</td>
		<td>
			CMOS 720x480, оптическая + ИК
		</td> 
	</tr>
	<tr>
		<td>
			<b>Измерение температуры</b>
		</td>
		<td>
			нет	
		</td>
		<td>
			да	
		</td>
		<td>
			нет	
		</td>
		<td>
			да (опция)	
		</td>
		<td>
			да (опция)
		</td> 
	</tr>
	<tr>
		<td>
			<b>Определение наличия/отсутствия маски</b>
		</td>
		<td>
			нет	
		</td>
		<td>
			да	
		</td>
		<td>
			нет	
		</td>
		<td>
			нет	
		</td>
		<td>
			да (опция)
		</td> 
	</tr>
	<tr>
		<td>
			<b>Отпечаток пальца</b>
		</td>
		<td>
			нет	
		</td>
		<td>
			да	
		</td>
		<td>
			нет	
		</td>
		<td>
			нет	
		</td>
		<td>
			да (опция)
		</td> 
	</tr>
	<tr>
		<td>
			<b>Рисунок вен ладони</b>
		</td>
		<td>
			нет	
		</td>
		<td>
			да	
		</td>
		<td>
			нет	
		</td>
		<td>
			нет	
		</td>
		<td>
			нет
		</td> 
	</tr>
	<tr>
		<td>
			<b>Связь</b>
		</td>
		<td>
			TCP/IP, <br>
			Wi-Fi (опция), <br> 
			RS-232, <br>
			RS-485, <br>
			Wiegand (вход/выход), <br>
			реле, <br>
			AUX вход	 
		</td>
		<td>
			TCP/IP, <br>
			Wi-Fi (опция), <br>
			RS-485, <br>
			Wiegand (вход/выход),<br>
			реле, <br>
			AUX вход	
		</td>
		<td>
			TCP/IP, <br>
			USB 2.0, <br>
			Wi-Fi, <br>
			RS-485, <br>
			2 TTL входа, <br>
			Wiegand (вход/выход), <br>
			реле	
		</td>
		<td>
			TCP/IP, <br>
			USB 2.0, <br>
			Wi-Fi, <br>
			RS-485, <br>
			2 TTL входа, <br>
			Wiegand (вход/выход), <br>
			реле	
		</td>
		<td>
			TCP/IP, <br>
			USB 2.0, <br> 
			RS-485, <br>
			2 TTL входа, <br>
			Wiegand (вход/выход), <br>
			реле
		</td> 
	</tr>
	<tr>
		<td>
			<b>Подключение внешних устройств</b>
		</td> 
		<td>
			Дверной замок, <br>
			датчик двери, <br>
			кнопка выхода, <br>
			тревога	
		</td>
		<td>
			Дверной замок, <br>
			датчик двери, <br>
			кнопка выхода, <br>
			тревога	
		</td>
		<td>
			Дверной замок, <br>
			датчик двери, <br>
			кнопка выхода	
		</td>
		<td>
			Дверной замок, <br>
			датчик двери, <br>
			кнопка выхода	
		</td> 
		<td>
			Дверной замок, <br>
			датчик двери, <br>
			кнопка выхода	
		</td> 
	</tr>
	<tr>
		<td>
			<b>Аудио</b>
		</td> 
		<td>
			Динамик, микрофон	
		</td>
		<td>
			Динамик, микрофон	
		</td>
		<td>
			Динамик	
		</td>
		<td>
			Динамик, микрофон	
		</td>
		<td>
			Динамик, микрофон
		</td> 
	</tr>
	<tr>
		<td>
			<b>Объем журнала событий</b>
		</td> 
		<td>
			1 000 000	
		</td>
		<td>
			200 000	
		</td>
		<td>
			5 000 000	
		</td>
		<td>
			5 000 000 (текст), <br>
			50 000 (фото)	
		</td>
		<td>
			1 000 000 (текст), <br>
			50 000 (фото) 
		</td> 
	</tr>
	<tr>
		<td>
			<b>Питание</b>
		</td>
		<td> 
			DC 12V 2A	 
		</td>
		<td>
			DC 12V 2A	
		</td>
		<td>
			DC 24V 2,5А	
		</td>
		<td>
			DC 24V 2,5А	
		</td>
		<td>
			DC 12V / DC 24V 2,5А
		</td> 
	</tr>
	<tr>
		<td>
			<b>Влажность</b>
		</td>
		<td>
			93%	
		</td>
		<td>
			90%	
		</td>
		<td>
			80%	
		</td>
		<td>
			80%	
		</td>
		<td>
			80%
		</td> 
	</tr>
	<tr>
		<td>
			<b>Габариты</b>
		</td>
		<td>
			227х143х26 мм	
		</td>
		<td>
			92х262х24 мм	
		</td>
		<td>
			80x161x72 мм	
		</td>
		<td>
			141x164x125 мм	
		</td>
		<td>
			120x223x50 мм
		</td> 
	</tr>
	<tr>
		<td>
			<b>Вес</b>
		</td>
		<td>
			1,1 кг	
		</td>
		<td>
			1 кг	
		</td>
		<td>
			0,4 кг	
		</td>
		<td>
			0,7 кг	
		</td>
		<td>
			0,7 кг
		</td> 
	</tr>
	<tr>
		<td>
			<b>Язык интерфейса</b>
		</td> 
		<td>
			русский, <br>
			английский	
		</td>
		<td>
			русский, <br>
			английский	 
		</td>
		<td>
			английский	
		</td>
		<td>
			английский, <br>
			корейский	
		</td>
		<td>
			английский, <br>
			корейский
		</td> 
	</tr>
</table>
</div>
<div class="space"></div>