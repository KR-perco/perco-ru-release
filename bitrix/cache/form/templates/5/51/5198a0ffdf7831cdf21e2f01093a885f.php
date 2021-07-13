<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001626049362';
$dateexpire = '001628641362';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:5227:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<p>Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</p>
 <?=$FORM->ShowFormErrors()?> <?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="2" border="0"> 
  <tbody> 
    <tr><td colspan="2"><strong>Данные клиента:</strong></td></tr>
   
    <tr><td width="230" height="">Наименование компании&nbsp;<span class="starrequired">*</span></td><td><?=$FORM->ShowInput(\'company_name\')?></td></tr>
   
    <tr><td>Почтовый адрес</td><td><?=$FORM->ShowInput(\'post_address\')?></td></tr>
   
    <tr><td>Юридический адрес</td><td><?=$FORM->ShowInput(\'legal_address\')?></td></tr>
   
    <tr><td>Индекс</td><td><?=$FORM->ShowInput(\'index\')?></td></tr>
   
    <tr><td>Страна</td><td><?=$FORM->ShowInput(\'country\')?></td></tr>
   
    <tr><td>Контактные телефоны&nbsp;<span class="starrequired">*</span></td><td><?=$FORM->ShowInput(\'phones\')?></td></tr>
   
    <tr><td>E-mail&nbsp;<span class="starrequired">*</span></td><td><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td>Контактное лицо&nbsp;<span class="starrequired">*</span></td><td><?=$FORM->ShowInput(\'person\')?></td></tr>
   </tbody>
 </table>
 
<br />
 
<br />
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr><td colspan="2"><strong>Описание продукции:</strong></td></tr>
   
    <tr><td width="230" height="">Изделие&nbsp;<span class="starrequired">*</span></td><td><?=$FORM->ShowInput(\'product\')?></td></tr>
   
    <tr><td>Модель&nbsp;<span class="starrequired">*</span></td><td><?=$FORM->ShowInput(\'model\')?></td></tr>
   
    <tr><td>Неисправный компонент</td><td><?=$FORM->ShowInput(\'component\')?></td></tr>
   
    <tr><td>Серийный номер</td><td><?=$FORM->ShowInput(\'serial_number\')?></td></tr>
   
    <tr><td>Конечный покупатель</td><td><?=$FORM->ShowInput(\'enduser\')?></td></tr>
   
    <tr><td>Дата выпуска изделия</td><td><?=$FORM->ShowInput(\'date1\')?></td></tr>
   
    <tr><td>Дата покупки</td><td><?=$FORM->ShowInput(\'date2\')?></td></tr>
   
    <tr><td>Дата установки</td><td><?=$FORM->ShowInput(\'date3\')?></td></tr>
   
    <tr><td>Дата возникновения неисправности</td><td><?=$FORM->ShowInput(\'date4\')?></td></tr>
   </tbody>
 </table>
 
<p>Изделия в ремонт необходимо отправлять только <strong>вместе с ключами разблокировки ! ! !</strong> Иначе, время ремонта может увеличиться на время пересылки этих ключей. Если ключи потеряны, то напишите о необходимости замены замков.</p>
 
<p><strong>Состав оборудования</strong> 
  <br />
 Опишите состав оборудования, совместно используемый с условно неисправным изделием (наименование контроллеров, схему размещения, наличие поблизости источников электромагнитных помех, характеристики источников питания, удлинялись ли кабели (если да, то какие) и т.д.). 
  <br />
 <?=$FORM->ShowInput(\'text1\')?> </p>
 
<p> <strong>Описание неисправностей</strong> 
  <br />
 Опишите проблему (характер неисправности, частота проявления, дата первого проявления неисправности, события, предшествующие неисправности (природные явления, перепады напряжения питания и др.) 
  <br />
 <?=$FORM->ShowInput(\'text2\')?> </p>
 
<p> <strong>Предпринятые действия</strong> 
  <br />
 Опишите ваши действия по определению и устранению неисправности 
  <br />
 <?=$FORM->ShowInput(\'text3\')?> </p>
 
<p> <strong>Укажите порядок отгрузки отремонтированного изделия и порядок оплаты</strong> 
  <br />
 Укажите название перевозчика и форму оплаты (наличный или безналичный) 
  <br />
 <?=$FORM->ShowInput(\'text4\')?> </p>
 
<br />
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr><td colspan="2">введите код с картинки:
        <br />
      </td></tr>
   
    <tr><td valign="top"><?=$FORM->ShowCaptchaField()?></td><td valign="top"><?=$FORM->ShowCaptchaImage()?></td></tr>
   </tbody>
 </table>
 &nbsp;&nbsp; &nbsp; 
<br />
 
<p><?=$FORM->ShowSubmitButton("отправить бланк","")?> </p>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>