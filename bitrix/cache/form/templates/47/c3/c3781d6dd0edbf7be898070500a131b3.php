<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001613428467';
$dateexpire = '001616020467';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1607:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table" style="border-collapse: collapse;"> 
  <tbody> 
    <tr><td style="border-image: initial;">Kontaktperson<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">Land</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'country\')?></td></tr>
   
    <tr><td style="border-image: initial;">Telefon</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Arbetslivserfarenhet:</td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">sl&aring; en kod som ses på bilden: 
        <br />
       </td></tr>
   
    <tr><td valign="top" style="border-image: initial;" colspan="2"><?=$FORM->ShowCaptchaField()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowSubmitButton("skicka","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>