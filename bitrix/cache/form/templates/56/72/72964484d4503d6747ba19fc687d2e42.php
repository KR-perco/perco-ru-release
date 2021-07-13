<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001626030973';
$dateexpire = '001628622973';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2140:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table"> 
  <tbody> 
    <tr><td colspan="2" style="border-image: initial;">Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</td><td style="border-image: initial;">Содержание запроса:</td><td style="border-image: initial;">&nbsp; 
        <br />
       </td></tr>
   
    <tr><td style="border-image: initial;">Название организации<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'company_name\')?></td><td rowspan="4" style="border-image: initial;"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td style="border-image: initial;">Контактное лицо<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">Город</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'city\')?></td></tr>
   
    <tr><td style="border-image: initial;">Телефон</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td><td style="border-image: initial;">введите код с картинки: 
        <br />
       </td></tr>
   
    <tr class="site" style="vertical-align: baseline;"><td style="border-image: initial;">Сайт</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'www\')?></td><td valign="top" style="border-image: initial;"><?=$FORM->ShowCaptchaField()?> <?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"></td><td style="border-image: initial;"><?=$FORM->ShowSubmitButton("отправить","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>