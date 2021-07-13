<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001624001553';
$dateexpire = '001626593553';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1311:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr><td>Название организации</td><td align="right"><?=$FORM->ShowInput(\'company_name\')?></td></tr>
   
    <tr><td>Контактное лицо</td><td align="right"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td>Телефон/факс</td><td align="right"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td>E-mail</td><td align="right"><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td colspan="2">Содержание вопроса</td></tr>
   
    <tr><td align="right" colspan="2"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td>Ваш вопрос касается</td><td align="right"><?=$FORM->ShowInput(\'product\')?></td></tr>
   
    <tr><td colspan="2">введите код с картинки:
        <br />
      </td></tr>
   
    <tr><td valign="top"><?=$FORM->ShowCaptchaField()?></td><td align="right"><?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2"><?=$FORM->ShowSubmitButton("отправить","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>