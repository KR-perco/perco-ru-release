<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623717375';
$dateexpire = '001626309375';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1614:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table" style="border-collapse: collapse;"> 
  <tbody> 
    <tr><td style="border-image: initial;"><span class="starrequired">Nom*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;">Pays</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'country\')?></td></tr>
   
    <tr><td style="border-image: initial;">Téléphone</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Commentaire ou question:</td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;">Veuillez saisir les caractères affichés dans la fenêtre ci-dessous: </td></tr>
   
    <tr><td valign="top" style="border-image: initial;" colspan="2"><?=$FORM->ShowCaptchaField()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"><?=$FORM->ShowSubmitButton("Envoyer","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>