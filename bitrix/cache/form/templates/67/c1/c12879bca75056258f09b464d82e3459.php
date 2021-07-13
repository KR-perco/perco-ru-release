<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001618389241';
$dateexpire = '001620981241';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1316:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?=$FORM->ShowFormDescription("")?><?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> <label class="training-feedback-form__label"> 	E-mail <span style="color: red;">*</span>  
  <br />
 	<?=$FORM->ShowInput(\'email\')?> </label> <label class="training-feedback-form__label"> 	Surname <span style="color: red;">*</span> 
  <br />
 	 <?=$FORM->ShowInput(\'surname\')?> </label> <label class="training-feedback-form__label"> 	Name <span style="color: red;">*</span>  
  <br />
 	 <?=$FORM->ShowInput(\'name\')?> </label> <label class="training-feedback-form__label"> 	Company <span style="color: red;">*</span> 
  <br />
 	 <?=$FORM->ShowInput(\'company\')?> </label> <label class="training-feedback-form__label"> 	Country <span style="color: red;">*</span>  
  <br />
 	 <?=$FORM->ShowInput(\'country\')?><?=$FORM->ShowInput(\'seminar\')?> </label> 
<div class="training-feedback__mandatory">All the fields are mandatory</div>
 <label class="training-feedback-form__label training-feedback-form__label_captcha"> 	<?=$FORM->ShowCaptchaImage()?> 	<span class=" training-feedback-form__input_captcha"><?=$FORM->ShowCaptchaField()?> </span></label> <?=$FORM->ShowSubmitButton("","")?><?=$FORM->ShowFormFooter();?>";}}';
return true;
?>