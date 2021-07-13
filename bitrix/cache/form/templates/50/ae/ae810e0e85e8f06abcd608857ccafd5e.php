<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623681411';
$dateexpire = '001626273411';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1670:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table" style="border-collapse: collapse;"> 
  <tbody> 
    <tr><td style="border-image: initial;">Name<span class="starrequired"><font color="#ee1d24">*</font></span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">Country</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'country\')?></td></tr>
   
    <tr><td style="border-image: initial;">Phone</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired"><font color="#ee1d24">*</font></span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Comments or Query:</td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Please type in the symbols shown in the image below: 
        <br />
       </td></tr>
   
    <tr><td valign="top" style="border-image: initial;" colspan="2"><?=$FORM->ShowCaptchaField()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowSubmitButton("Submit","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>