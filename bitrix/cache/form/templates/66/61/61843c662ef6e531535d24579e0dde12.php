<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001624031092';
$dateexpire = '001626623092';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:904:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<div class="stupid-bitrix"><?=$FORM->ShowFormDescription("")?><?=$FORM->ShowFormNote()?></div>
 <?=$FORM->ShowFormErrors()?> <label class="training-feedback-form__label"> Name <span style="color: red;">*</span> 
  <br />
 <?=$FORM->ShowInput(\'name\')?></label> <label class="training-feedback-form__label"> Company 
  <br />
 <?=$FORM->ShowInput(\'company\')?> 
  <br />
 </label> <label class="training-feedback-form__label"> E-mail <span style="color: red;">*</span> 
  <br />
 <?=$FORM->ShowInput(\'email\')?></label> <label class="training-feedback-form__label training-feedback-form__label_captcha"><?=$FORM->ShowCaptchaImage()?><span class=" training-feedback-form__input_captcha"><?=$FORM->ShowCaptchaField()?></span> </label><?=$FORM->ShowSubmitButton("","")?><?=$FORM->ShowFormFooter();?>";}}';
return true;
?>