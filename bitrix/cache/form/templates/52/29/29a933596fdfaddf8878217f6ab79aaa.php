<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001625611810';
$dateexpire = '001628203810';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1801:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<p style="padding-left: 0px;">Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</p>
 <?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table"> 
  <tbody>   
    <tr><td style="border-image: initial;">Контактное лицо<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">Телефон</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowInput(\'politika\')?></td></tr>
   
    <tr><td style="border-image: initial;">Содержание запроса:</td><td style="border-image: initial;">&nbsp; 
        <br />
       </td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">введите код с картинки: 
        <br />
       </td></tr>
   
    <tr><td valign="top" style="border-image: initial;"><?=$FORM->ShowCaptchaField()?></td><td style="border-image: initial;"><?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td style="border-image: initial;"></td><td style="border-image: initial;"><?=$FORM->ShowSubmitButton("отправить","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>