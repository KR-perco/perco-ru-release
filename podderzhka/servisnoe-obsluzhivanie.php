<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->AddChainItem("Сервисное обслуживание", "");
$APPLICATION->SetPageProperty("title", "Сервисные центры PERCo в России, Украине, Белоруссии, Казахстане");
$APPLICATION->SetPageProperty("description", "Сервисное обслуживание продукции PERCo в России, Белоруссии и Украине");
$APPLICATION->SetPageProperty("keywords", "системы безопасности, скуд, контроль доступа");
$APPLICATION->SetTitle("Сервисное обслуживание");

$APPLICATION->SetAdditionalCSS("/css/servisnoe-obsluzhivanie.css"); // подключение стилей
$APPLICATION->AddHeadScript("/scripts/pages/servisnoe-obsluzhivanie.js"); // подключение скриптов
?>

<?
$file = file_get_contents('../contacts.json'); // Открыть файл
$contacts = json_decode($file, true); // Декодировать в массив
unset($file); // Очистить переменную $file

	// "emailServiceSystem": "system@perco.ru",
    // "emailServiceTurniket": "turniket@perco.ru",
    // "emailServiceSoft": "soft@perco.ru",
    // "emailServiceLocks": "locks@perco.ru",
    // "emailServiceService": "service@perco.ru",

?>

<div id="content">
	<div id="himg">
		<h1><?$APPLICATION->ShowTitle(false, false)?></h1>
		<img alt="Сервисное обслуживание" src="/images/icons/services.svg" />
	</div>
	<p>Компания PERCo благодарит Вас за приобретение продукции нашего производства.</p>
	<p>Наша компания делает все необходимое, чтобы эта продукция была качественной и прослужила Вам долго.</p>
	<p>Если по какой-то причине приобретенное Вами оборудование будет нуждаться в ремонте, мы сделаем все возможное, чтобы ремонт был произведен как можно быстрее и с меньшими неудобствами для Вас.</p>
	<p>К Вашим услугам — разветвленная сеть Авторизованных дилеров и Сервисных центров (СЦ) PERCo, куда Вы можете обратиться для выполнения гарантийного или негарантийного ремонта. В компаниях Авторизованных дилеров и Сервис-центрах PERCo работают квалифицированные специалисты, прошедшие обучение в PERCo, имеется необходимое диагностическое оборудование и запчасти.</p>
	<p>Преимущества обращения за приобретением и монтажом оборудования PERCo к Авторизованному дилеру или Сервисному центру PERCo:</p>
	<ul>
		<li>бесплатный выезд специалиста этой компании для гарантийного ремонта на объекте. При этом проведение монтажа и внедрения оборудования квалифицированными специалистами, прошедшими обучение в PERCo, само по себе сокращает риски отказа оборудования.</li>
		<li>продление гарантийного периода. Срок начала гарантии на оборудование PERCo будет устанавливаться с момента сдачи оборудования Авторизованным дилером или Сервисным центром PERCo в эксплуатацию, а не с даты его продажи.</li>
	</ul>
	<p>В других случаях выезд специалиста СЦ как при послегарантийном ремонте, так и при гарантийном ремонте платный. Гарантийный ремонт в СЦ или на заводе-изготовителе производится бесплатно. </p>
	<p>Если по какой-либо причине Вы предпочитаете обратиться к производителю, компания PERCo готова обеспечить ремонт товара в Санкт-Петербурге или на заводе в Пскове на следующих условиях:</p>
	<ul>
		<li>Расходы по транспортировке изделия к месту ремонта и обратно несет Покупатель, если иное не оговорено в договоре на поставку товара. В течение гарантийного срока расходы по отправке потребителю отремонтированных малогабаритных изделий массой не более 5 кг по России в пределах простого тарифа почты России несет Изготовитель.</li>
		<li>Изготовитель оставляет за собой право не принимать в ремонт товар у Покупателя, не приславшего заполненный бланк рекламации.</li>
		<li>Срок ремонта определяется Изготовителем при сдаче товара в ремонт.</li>
		<li>В случае негарантийного ремонта гарантийный срок на заменённые детали и узлы серийно выпускаемого изделия составляет 5 лет и исчисляется с даты отправки изделия (отремонтированного или из ремонтного фонда) в адрес Покупателя.</li>
		<li>Гарантийный срок на поставляемый ЗИП для выпускаемых серийно изделий составляет 5 лет и исчисляется с даты отправки ЗИП в адрес Покупателя (Заказчика).</li>
	</ul>
	<p>Гарантийный срок на заменённые детали, узлы и поставляемый ЗИП:</p>
	<table style="width: 70%;">
		<tr><td colspan="2">Выпускаемые серийно изделия</td><td>5 лет</td></tr>
		<tr><td rowspan="2">Снятые с производства изделия</td><td>Срок службы менее 8 лет</td><td>1 год</td></tr>
		<tr><td>Cрок службы более 8 лет</td><td>3 месяца</td></tr>
	</table>
	<p>Для регистрации обращения просим Вас заполнить <a href="/podderzhka/blanki-reklamacii.php" >бланк рекламации</a> и отправить его нам. Специалисты Департамента сервисного обслуживания (ДСО) свяжутся с Вами для консультации и организации ремонта.</p>
	<a href="/download/documentation/rus/katalog-dlya-kp.zip">Прайс запчастей к оборудованию PERCo</a>
	<div class="tabs">
		<input type="radio" id="dso" checked="checked" name="vkladki">
		<label for="dso"><span class="dashed">ДСО</span></label>
		<div>
			<div class="text_items">
				<p>Время работы 9:00–18:00 (мск), по рабочим дням</p>
				<p>Call-центр: 8-800-775-37-05</p>
				<p>Телефон / Факс: +7 (812) 247-04-55</p>
				<p>Адрес курьерской доставки: 194021, Россия, Санкт-Петербург, Политехническая ул., д. 4, корпус 2, строение 1, ООО «ПЭРКО», ИНН 7806437448 (для ДСО)</p>
				<p>Телефон курьерской доставки: +7 (812) 247-04-54</p>
				<p>Прием курьера с 9:00 до 17:30 по рабочим дням</p>

				
				<p><a href="mailto:<?echo $contacts[emailServiceSystem]?>" ><?echo $contacts[emailServiceSystem]?></a> (по вопросам обслуживания систем безопасности)</p>
				<p><a href="mailto:<?echo $contacts[emailServiceTurniket]?>" ><?echo $contacts[emailServiceTurniket]?></a> (по вопросам обслуживания турникетов, калиток, ограждений)</p>
				<p><a href="mailto:<?echo $contacts[emailServiceSoft]?>" ><?echo $contacts[emailServiceSoft]?></a> (по вопросам технической поддержки программного обеспечения)</p>
				<p><a href="mailto:<?echo $contacts[emailServiceService]?>" ><?echo $contacts[emailServiceService]?></a> (по вопросам, связанным с работой сервис-центров компании)</p>
				<p><a href="mailto:<?echo $contacts[emailServiceLocks]?>" ><?echo $contacts[emailServiceLocks]?></a> (по вопросам обслуживания замков)</p>
			</div>
			<div class="img_items"><img alt="ДСО" src="/images/services/services.jpg"></div>
		</div>
		<input type="radio" id="<?=translitIt(strtolower("СЦ России"));?>" name="vkladki">
		<label for="<?=translitIt(strtolower("СЦ России"));?>" data-click="0" data-next-page="2"><span class="dashed">СЦ России</span></label>
		<div><span style="color: #214288;">Данные загружаются...</span></div>
		<input type="radio" id="<?=translitIt(strtolower("СЦ Беларуси"));?>" name="vkladki">
		<label for="<?=translitIt(strtolower("СЦ Беларуси"));?>" data-click="0" data-next-page="2"><span class="dashed">СЦ Беларуси</span></label>
		<div><span style="color: #214288;">Данные загружаются...</span></div>
		<input type="radio" id="<?=translitIt(strtolower("СЦ Казахстана"));?>" name="vkladki">
		<label for="<?=translitIt(strtolower("СЦ Казахстана"));?>" data-click="0" data-next-page="2"><span class="dashed">СЦ Казахстана</span></label>
		<div><span style="color: #214288;">Данные загружаются...</span></div>
		<input type="radio" id="<?=translitIt(strtolower("СЦ Украины"));?>" name="vkladki">
		<label for="<?=translitIt(strtolower("СЦ Украины"));?>" data-click="0" data-next-page="2"><span class="dashed">СЦ Украины</span></label>
		<div><span style="color: #214288;">Данные загружаются...</span></div>
	</div>
</div>
<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>