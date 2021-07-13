<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001624213861';
$dateexpire = '001626805861';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:9373:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<p><?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?></p>
 
<p><strong>Реквизиты покупателя для выставления счета на оплату</strong></p>
 
<table> 
  <tbody> 
    <tr><td width="160" style="border-image: initial;">Полное наименование <?=$FORM->ShowRequired()?>&nbsp;</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'company\')?></td></tr>
   
    <tr><td style="border-image: initial;">ИНН / КПП <?=$FORM->ShowRequired()?>&nbsp;</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'INN\')?></td></tr>
   
    <tr><td style="border-image: initial;">Юридический адрес&nbsp;</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'address01\')?></td></tr>
   
    <tr><td style="border-image: initial;">Фактический адрес</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'address02\')?></td></tr>
   
    <tr><td style="border-image: initial;">Банковские реквизиты (необязательное поле для бесплатного ПО PERCo-WB «Базовый пакет ПО»)  <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'req\')?></td></tr>
   
    <tr><td style="border-image: initial;">Контактное лицо</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">Тел. / Факс</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td style="border-image: initial;">Выставить счет? <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'schet\')?></td></tr>
   </tbody>
 </table>
 
<p><strong>Организация-конечный пользователь системы безопасности</strong></p>
 
<table> 
  <tbody> 
    <tr><td width="160" style="border-image: initial;">Полное наименование</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'company_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">ИНН / КПП</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'INN_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">Почтовый адрес</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'address01_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">Контактное лицо</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'person_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">Тел. / Факс</td><td style="border-image: initial;"> <?=$FORM->ShowInput(\'phone_enduser\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email_enduser\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Адрес объекта, оборудованного системой PERCo-Web 
        <br />
       (в случае отличия от адреса организации-конечного пользователя)</td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"> <?=$FORM->ShowInput(\'address02_enduser\')?></td></tr>
   </tbody>
 </table>
 
<p><strong>MAC-адрес контроллера СКУД, используемого в качестве электронного ключа защиты</strong></p>
 
<p><?=$FORM->ShowInput(\'MAC\')?></p>
 
<p>(В качестве электронного ключа защиты может выступать любой контроллер системы безопасности. Выполнение функции аппаратного контроля лицензий на программное обеспечение не влияет на остальные функциональные возможности контроллера СКУД).</p>
 
<p><strong>Перечень программного обеспечения PERCo-Web</strong></p>
 
<table class="form-table"> 
  <tbody> 
    <tr><td style="border-image: initial;"><strong>Модули программного обеспечения</strong></td><td align="center" style="border-image: initial;"><strong>Количество</strong></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WB «Базовый пакет ПО», бесплатно</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WB\')?></td></tr>
   
    <tr> <td style="border-image: initial;">PERCo-WBE «Базовый пакет ПО» (для встроенного ПО), бесплатно</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WBE\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WS «Стандартный пакет ПО»</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WS\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WSE «Стандартный пакет ПО» (для встроенного ПО)</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WSE\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM01 «Учет рабочего времени», необходимо приобретение лицензии на PERCo-WS</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM01\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WME01 «Учет рабочего времени» (для встроенного ПО), необходимо приобретение лицензии на PERCo-WSE</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WME01\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM02 «Верификация», необходимо приобретение лицензии на PERCo-WS</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM02\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WME02 «Верификация» (для встроенного ПО), необходимо приобретение лицензии на PERCo-WSE</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WME02\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM03 «Интеграция с 1С», необходимо приобретение лицензии на PERCo-WS (PERCo-WSE) и PERCo-WM01 (PERCo-WME01)</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM03\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM04 «Интеграция с внешними системами», бесплатно, необходимо приобретение лицензии на PERCo-WS</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM04\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM05 «Мониторинг», необходимо приобретение лицензии на PERCo-WS</td><td align="center" style="border-image: initial;"> <?=$FORM->ShowInput(\'WM05\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WME05 «Мониторинг», необходимо приобретение лицензии на PERCo-WSE</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WME05\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM06 «Модуль интеграции с видеоподсистемой Trassir», необходимо приобретение лицензии на PERCo-WS</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM06\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WM07 «Модуль интеграции с ИСО &quot;Opион&quot;», необходимо приобретение лицензии на PERCo-WS</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WM07\')?></td></tr>
   
    <tr><td style="border-image: initial;">PERCo-WME07 «Модуль интеграции с ИСО &quot;Opион&quot;», необходимо приобретение лицензии на PERCo-WSE</td><td align="center" style="border-image: initial;"><?=$FORM->ShowInput(\'WME07\')?></td></tr>
   </tbody>
 </table>
 
<br />
 
<table> 
  <tbody> 
    <tr><td style="border-image: initial;">введите кодовое слово: 
        <br />
       <?=$FORM->ShowCaptchaField()?> 
        <br />
       <?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowInput(\'politika\')?></td></tr>
   
    <tr><td style="border-image: initial;"><?=$FORM->ShowSubmitButton("отправить","")?></td><td style="border-image: initial;"><?=$FORM->ShowResetButton("очистить форму","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>