<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001625645243';
$dateexpire = '001628237243';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2225:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
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
    <tr><td width="30%" style="border-image: initial;">Название организации<font color="#ff0000">*</font></td><td width="70%" style="border-image: initial;"><span class="input"><?=$FORM->ShowInput(\'new_field_83252\')?></span></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">Контактное лицо<font color="#ff0000">*</font></td><td width="70%" style="border-image: initial;"><span class="input"><?=$FORM->ShowInput(\'new_field_17781\')?></span></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">E-mail<font color="#ff0000">*</font></td><td width="70%" style="border-image: initial;"><span class="input"><?=$FORM->ShowInput(\'new_field_46200\')?></span></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">Телефон</td><td width="70%" style="border-image: initial;"><span class="input"><?=$FORM->ShowInput(\'new_field_50470\')?></span></td></tr>
   
    <tr><td width="30%" style="border-image: initial;">Введите код с картинки<font color="#ff0000">*</font></td><td width="70%" style="border-image: initial;"></td></tr>
   
    <tr><td width="30%" style="border-image: initial;"><?=$FORM->ShowCaptchaImage()?></td><td width="70%" style="border-image: initial;"><span class="input"><?=$FORM->ShowCaptchaField()?></span></td></tr>
   
    <tr><td width="30%" style="border-image: initial;"><?=$FORM->ShowSubmitButton("Отправить","")?></td><td width="70%" style="border-image: initial;"></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>