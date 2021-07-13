<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623660741';
$dateexpire = '001626252741';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2349:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?if($FORM->isFormErrors()):?> 
<a name="error" id="error"></a>
 
<script type="text/javascript">location.hash=\'error\'</script>
 <?=$FORM->ShowFormErrors()?> <?=$FORM->ShowFormNote()?> <?endif?> 
<br />
 
<table cellspacing="1" cellpadding="1" border="0" class="form-table"> 
  <tbody> 
    <tr><td width="217">Компания</td><td><?=$FORM->ShowInput(\'company\')?></td></tr>
   
    <tr><td>Город</td><td><?=$FORM->ShowInput(\'city\')?></td></tr>
   
    <tr><td>Ответственный, ФИО</td><td><?=$FORM->ShowInput(\'fio\')?></td></tr>
   
    <tr><td>Телефон</td><td><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td>E-mail</td><td><?=$FORM->ShowInput(\'email\')?></td></tr>
   </tbody>
 </table>
 
<br />
 
<table cellspacing="1" cellpadding="1" border="0" class="form-table"> 
  <tbody> 
    <tr><td width="217">MAC-адрес контроллера с лицензией</td><td><?=$FORM->ShowInput(\'mac\')?></td></tr>
   
    <tr><td>Аудитория, сотрудники 
        <br />
       </td><td><?=$FORM->ShowInput(\'auditoriya\')?></td></tr>
   </tbody>
 </table>
 
<br />
 
<table cellspacing="1" cellpadding="1" border="0" class="form-table"> 
  <tbody> 
    <tr><td width="217" valign="top" align="left">Основные темы, которые требуется осветить на вебинаре</td><td><?=$FORM->ShowInput(\'user_subject\')?></td></tr>
   </tbody>
 </table>
 
<br />
 
<table cellspacing="1" cellpadding="1" border="0" class="form-table"> 
  <tbody> 
    <tr><td width="217" valign="top" align="left">Желаемая дата вебинара</td><td><?=$FORM->ShowInput(\'date_begin\')?></td></tr>
   </tbody>
 </table>
 
<br />
 
<table cellspacing="1" cellpadding="1" border="0" class="form-table"> 
  <tbody> 
    <tr> <td width="" height="" colspan="2">введите код с картинки: 
        <br />
       </td> </tr>
   
    <tr> <td width="217" valign="top"><?=$FORM->ShowCaptchaField()?></td> <td><?=$FORM->ShowCaptchaImage()?></td> </tr>
   
    <tr> <td colspan="2"><?=$FORM->ShowSubmitButton("Отправить","")?></td> </tr>
   </tbody>
 </table>
 
<br />
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>