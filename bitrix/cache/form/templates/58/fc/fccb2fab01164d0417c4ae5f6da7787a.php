<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001625645243';
$dateexpire = '001628237243';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2135:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<style>
.form-free-testing-table {
    margin-top: 32px;
}
.form-free-testing-table .input input {
    width: 512px;
}
.form-free-testing-table textarea {
    width: 512px;
    resize: vertical;
    vertical-align: middle;
}
@media (max-width: 768px) {
	.form-free-testing-table .input input {
		width: 100%;
	}
    .form-free-testing-table textarea{
         width: 100%;
    }
}
</style>
 <?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table border="0" cellpadding="0" cellspacing="0" class="form-free-testing-table form-table"> 
  <tbody> 
    <tr><td width="30%" style="border-image: initial;">Какие устройства подключали к контроллеру?</td><td width="70%" style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_73303\')?></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">Что рекомендуете улучшить в характеристиках контроллера?</td><td width="70%" style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_1410\')?></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">На каких объектах и для решения каких задач планируете использовать контроллер?</td><td width="70%" style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_48651\')?></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">Введите код с картинки<font color="#ff0000">*</font></td><td width="70%" style="border-image: initial;"></td></tr>
   
    <tr><td width="30%" style="border-image: initial;"><?=$FORM->ShowCaptchaImage()?></td><td width="70%" style="border-image: initial;"><span class="input"><?=$FORM->ShowCaptchaField()?></span></td></tr>
   
    <tr><td width="30%" style="border-image: initial;"><?=$FORM->ShowSubmitButton("Отправить","")?></td><td width="70%" style="border-image: initial;"></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>