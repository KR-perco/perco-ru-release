<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001597753553';
$dateexpire = '001600345553';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1895:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?=$FORM->ShowFormErrors()?>
<br />
 <?=$FORM->ShowFormNote()?> 
<div class="sem-form"> <label class="sem-form__label"> 
    <div class="sem-form__elem sem-form__title">Компания</div>
   
    <div class="sem-form__elem sem-form__input"><?=$FORM->ShowInput(\'company\')?></div>
   </label> <label class="sem-form__label"> 
    <div class="sem-form__elem sem-form__title">Город</div>
   
    <div class="sem-form__elem sem-form__input"><?=$FORM->ShowInput(\'city\')?></div>
   </label> <label class="sem-form__label"> 
    <div class="sem-form__elem sem-form__title">Контактное лицо</div>
   
    <div class="sem-form__elem sem-form__input"><?=$FORM->ShowInput(\'person\')?></div>
   </label> <label class="sem-form__label"> 
    <div class="sem-form__elem sem-form__title">Должность</div>
   
    <div class="sem-form__elem sem-form__input"><?=$FORM->ShowInput(\'position\')?></div>
   </label> <label class="sem-form__label"> 
    <div class="sem-form__elem sem-form__title">Email</div>
   
    <div class="sem-form__elem sem-form__input"><?=$FORM->ShowInput(\'email\')?></div>
   </label> <label class="sem-form__label"> 
    <div class="sem-form__elem sem-form__title">Номер телефона</div>
   
    <div class="sem-form__elem sem-form__input"><?=$FORM->ShowInput(\'number\')?></div>
   </label> <label class="sem-form__captcha"> 
    <div class="sem-form__captcha-title">Введите текст с картинки: <span style="color: red;">*</span></div>
   
    <div class="sem-form__captcha-img"><?=$FORM->ShowCaptchaImage()?></div>
   
    <div class="sem-form__captcha-input"><?=$FORM->ShowCaptchaField()?></div>
   </label> <?=$FORM->ShowSubmitButton("Отправить","")?></div>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>