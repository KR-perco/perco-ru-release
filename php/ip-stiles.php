<?
GetRate();
global $price_res; 

$wm01_price = 1379;
$wm017_price = 1214;
$sp13_price = 1311;
$ss01_price = 1311;
 
if ($price_res != 0)
{
	$wm01_price_rub = 'Цена <span class="price_rub">'. number_format($wm01_price*$price_res, 0, ",", " ") .' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
	$wm017_price_rub = 'Цена <span class="price_rub">'. number_format($wm017_price*$price_res, 0, ",", " ") . ' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
    $sp13_price_rub = 'Цена <span class="price_rub">'. number_format($sp13_price*$price_res, 0, ",", " ") . ' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
	$ss01_price_rub = 'Цена <span class="price_rub">'. number_format($ss01_price*$price_res, 0, ",", " ") . ' &#8381; </span> со склада в Москве и Санкт-Петербурге.';
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
	
$wm01 = $wm01_price_rub.'<p>'.number_format($wm01_price, 0, ',', ' ').' (по курсу ЦБ РФ на '.date("d.m.Y").') </p>';
$wm017 = $wm017_price_rub.'<p>'.number_format($wm017_price, 0, ',', ' ').' (по курсу ЦБ РФ на '.date("d.m.Y").')</p>';
$sp13 = $sp13_price_rub.'<p>'.number_format($sp13_price, 0, ',', ' ').' (по курсу ЦБ РФ на '.date("d.m.Y").')</p>';
$ss01 = $ss01_price_rub.'<p>'.number_format($ss01_price, 0, ',', ' ').' (по курсу ЦБ РФ на '.date("d.m.Y").')</p>';

$php_result = '<div id="secel_list">
					<div class="secel_item">
						<a>
							<div class="image_icon">
									<img alt="Система контроля доступа и учета рабочего времени работающая с картами EMM/HID" src="/images/products/box-tripod-turnstiles/ep-web.jpg">
							</div>
							<div class="text_item"><span style="text-decoration: none;">Система контроля доступа и учета рабочего времени работающая с картами MIFARE/EMM/HID</span><div class="price">'.$wm017.'</div></div>
								
						</a>
					</div> 
					<div class="secel_item">
						<a>
								<div class="image_icon">
									<img alt="Система контроля доступа для школ с сервисом отправки SMS родителям и контролем посещаемости" src="/images/products/box-tripod-turnstiles/ep-school.jpg">
												</div>
								<div class="text_item"><span style="text-decoration: none;">Система контроля доступа для школ с сервисом отправки SMS родителям и контролем посещаемости </span><div class="price">'.$ss01.'</div></div>
						</div>
						</a>
					</div>
				</div> ';


?>  