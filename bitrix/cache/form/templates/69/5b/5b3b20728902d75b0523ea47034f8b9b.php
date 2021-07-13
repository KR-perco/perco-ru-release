<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001624027861';
$dateexpire = '001626619861';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2035:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?=$FORM->ShowFormErrors()?><?=$FORM->ShowFormNote()?> 
<table cellspacing="0" cellpadding="3" border="0" class="form-table"> 
  <tbody> 
    <tr><td colspan="2" style="border-image: initial;">Bitte füllen Sie alle mit einem Stern (*) gekennzeichneten Felder aus.</td><td style="border-image: initial;">Nachricht:</td><td style="border-image: initial;"> 
        <br />
       </td></tr>
   
    <tr><td style="border-image: initial;">Firmen Name*</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_company_7301\')?></td><td rowspan="4" style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_text_19472\')?></td></tr>
   
    <tr><td style="border-image: initial;">Kontaktperson*</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_person_53563\')?></td></tr>
   
    <tr><td style="border-image: initial;">Stadt</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_city_51583\')?></td></tr>
   
    <tr><td style="border-image: initial;">Telefon</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_number_65587\')?></td></tr>
   
    <tr><td style="border-image: initial;">E-mail<span class="starrequired">*</span></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_email_1114\')?></td><td style="border-image: initial;"><span style="font-size: 16px;">Inserisca il codice dall’immagine:</span></td></tr>
   
    <tr class="site" style="vertical-align: baseline;"><td style="border-image: initial;">www</td><td style="border-image: initial;"><?=$FORM->ShowInput(\'new_field_web_84983\')?></td><td valign="top" style="border-image: initial;"><?=$FORM->ShowCaptchaField()?> <?=$FORM->ShowCaptchaImage()?></td></tr>
   
    <tr><td colspan="2" style="border-image: initial;"></td><td style="border-image: initial;"><?=$FORM->ShowSubmitButton("Abschicken","")?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>