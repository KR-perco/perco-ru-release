<?
GetRate();
global $price_res;

$wm01_price = "1 379 €";
$wm017_price = "1 405 €";
$sp13_price = "1 476 €";
$ss01_price = "1 502 €";

if ($price_res != 0)
{
	$wm01_price_rub = 'Цена <span class="price_rub">'. number_format(1379*$price_res, 0, ",", " ") .' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
	$wm017_price_rub = 'Цена <span class="price_rub">'. number_format(1405*$price_res, 0, ",", " ") . ' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
    $sp13_price_rub = 'Цена <span class="price_rub">'. number_format(1476*$price_res, 0, ",", " ") . ' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
	$ss01_price_rub = 'Цена <span class="price_rub">'. number_format(1502*$price_res, 0, ",", " ") . ' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
}



$php_result = '	<ul>
		<li>Электронная проходная KT02.3 (EMM/HID) с ПО WM01 (PERCo-Web) – система контроля доступа с учетом рабочего времени и контролем трудовой дисциплины за '.$wm01_price.'.</li>
		<li>Электронная проходная KT02.7M (MIFARE) с ПО WM01(PERCo-Web) – система контроля доступа с учетом рабочего времени и контролем трудовой дисциплины за '.$wm017_price.'.</li>
        <li>Электронная проходная KT02.3 (EMM/HID) с ПО SP13 (PERCo-S-20) – система контроля доступа с учетом рабочего времени и контролем трудовой дисциплины за '.$sp13_price.'.</li>
		<li>Электронная проходная KT02.7M (MIFARE) с ПО SS01 – система контроля доступа для школ с сервисом отправки SMS родителям и контролем посещаемости за '.$ss01_price.'.</li>
	</ul>';
if ($price_res == 0)
	$php_result .= "<p>*в рублях по курсу ЦБ РФ</p>";
else
	$php_result .= "<p>*Расчет произведен по курсу ЦБ РФ на " . date("d.m.Y") . "</p>";
	
$wm01 = $wm01_price_rub.'<p>'.$wm01_price.' (по курсу ЦБ РФ на '.date("d.m.Y").') </p>';
$wm017 = $wm017_price_rub.'<p>'.$wm017_price.' (по курсу ЦБ РФ на '.date("d.m.Y").')</p>';
$sp13 = $sp13_price_rub.'<p>'.$sp13_price.' (по курсу ЦБ РФ на '.date("d.m.Y").')</p>';
$ss01 = $ss01_price_rub.'<p>'.$ss01_price.' (по курсу ЦБ РФ на '.date("d.m.Y").')</p>';

$php_result = '<div id="secel_list">
				<div class="secel_item">
					<a>
						<div class="image_icon">
								<img alt="Система контроля доступа и учета рабочего времени работающая с картами EMM/HID" src="/images/products/box-tripod-turnstiles/ep-web.jpg">
											</div>
							<div class="text_item"><span style="text-decoration: none;">Система контроля доступа и учета рабочего времени работающая с картами EMM/HID</span><div class="price">'.$wm01.'</div></div>
					</a>
					</div>
				<div class="secel_item">
					<a>
							<div class="image_icon">
								<img alt="Система контроля доступа и учета рабочего времени работающая с картами MIFARE/EMM/HID" src="/images/products/box-tripod-turnstiles/ep-mifare+web.jpg">
											</div>
							<div class="text_item"><span style="text-decoration: none;">Система контроля доступа и учета рабочего времени работающая с картами MIFARE/EMM/HID</span><div class="price">'.$wm017.'</div></div>
					</div>
					</a>
				</div>
				<p><a href="/products/lokalnoe-programmnoe-obespechenie-perco-sl01.php">Бесплатное ПО PERCo-S-20</a> позволяет создать локальную систему контроля доступа с одной электронной проходной и одним рабочем местом, на котором установлены ПО и база данных.</p>
				<p>Для расширения функционала системы, например, для создания нескольких автоматизированных мест, нескольких точек прохода, организации выдачи постоянных и временных пропусков, верификации, учета рабочего времени необходимо приобрести один из комплектов либо отдельные модули программного обеспечения комплексной системы безопасности <a href="/products/kompleksnaya-sistema-bezopasnosti-perco-s-20/">PERCo-S-20</a>.</p>
				<p>Экономически выгодным решением станут Электронные проходные в комплекте с активированным программным обеспечением по специальным ценам:</p>
				<div id="secel_list">
				<div class="secel_item">
					<a>
						<div class="image_icon">
								<img alt="Система контроля доступа и учета рабочего времени с ПО SP13" src="/images/products/box-tripod-turnstiles/ep-s20.jpg">
											</div>
							<div class="text_item"><span style="text-decoration: none;">Система контроля доступа и учета рабочего времени с ПО SP13</span><div class="price">'.$sp13.'</div></div>
					</div>
					</a>
				<div class="secel_item">
					<a>
							<div class="image_icon">
								<img alt="Система контроля доступа для школ с сервисом отправки SMS родителям и контролем посещаемости" src="/images/products/box-tripod-turnstiles/ep-school.jpg">
											</div>
							<div class="text_item"><span style="text-decoration: none;">Система контроля доступа для школ с сервисом отправки SMS родителям и контролем посещаемости </span><div class="price">'.$ss01.'</div></div>
					</div>
					</a>
				</div>';


?> 