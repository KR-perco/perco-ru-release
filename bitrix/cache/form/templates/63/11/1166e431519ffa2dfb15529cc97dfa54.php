<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623737017';
$dateexpire = '001626329017';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2135:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table"> 
  <tbody> 
    <tr><td colspan="2" style="border-image: initial;"><span style="font-size: 16px;">I campi marcati da * sono obbligatori per compilare:</span></td><td style="border-image: initial;">Il contenuto della richiesta:</td><td style="border-image: initial;"> 
        <br />
       </td></tr>
   
    <tr><td style="border-image: initial;"><span style="font-size: 16px;">Nome della compagnia*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'company_name\')?></td><td rowspan="4" style="border-image: initial;"><?=$FORM->ShowInput(\'text\')?></td></tr>
   
    <tr><td style="border-image: initial;"><span style="font-size: 16px;">Persona da contattare*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'person\')?></td></tr>
   
    <tr><td style="border-image: initial;"><span style="font-size: 16px;">Città</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'city\')?></td></tr>
   
    <tr><td style="border-image: initial;"><span style="font-size: 16px;">Telefono</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'phone\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td><td style="border-image: initial;"><span style="font-size: 16px;">Inserisca il codice dall’immagine:</span></td></tr>
   
    <tr class="site" style="vertical-align: baseline;"><td style="border-image: initial;">www</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'www\')?></td><td valign="top" style="border-image: initial;"><?=$FORM->ShowCaptchaField()?> <?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"></td><td style="border-image: initial;"><?=$FORM->ShowSubmitButton("Mandare","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>