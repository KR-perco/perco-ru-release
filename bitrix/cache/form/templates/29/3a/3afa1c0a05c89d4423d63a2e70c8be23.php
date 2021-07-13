<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623650161';
$dateexpire = '001626242161';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1171:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?> 
<p> <?=$FORM->ShowFormNote()?> <?=$FORM->ShowFormErrors()?> </p>
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr> <td>Nom de la soci&eacute;t&eacute; 
        <br />
       <?=$FORM->ShowInput(\'firm\')?></td> </tr>
   
    <tr> <td>Adresse postale pour commander le catalogue 
        <br />
       <?=$FORM->ShowInput(\'adress\')?></td> </tr>
   
    <tr> <td>Adresse &eacute;lectronique 
        <br />
       <?=$FORM->ShowInput(\'email\')?></td> </tr>
   
    <tr> <td>Contact 
        <br />
       <?=$FORM->ShowInput(\'name\')?></td> </tr>
   
    <tr> <td>Nombre d&rsquo;exemplaires <?=$FORM->ShowInput(\'count\')?></td> </tr>
   
    <tr> <td>Merci de confirmer le code 
        <br />
       <?=$FORM->ShowCaptchaImage()?> 
        <br />
       
        <br />
       <?=$FORM->ShowCaptchaField()?></td> </tr>
   
    <tr> <td><?=$FORM->ShowSubmitButton("Envoyer","")?></td> </tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>