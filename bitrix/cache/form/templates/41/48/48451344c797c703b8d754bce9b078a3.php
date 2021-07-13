<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001625972196';
$dateexpire = '001628564196';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1190:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?> 
<p><?=$FORM->ShowFormNote()?><?=$FORM->ShowFormErrors()?></p>
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr> <td>Nome dell\'azienda 
        <br />
       <?=$FORM->ShowInput(\'firm\')?></td> </tr>
   
    <tr> <td>Indirizzo mail per la consegna gratuita del catalogo 
        <br />
       <?=$FORM->ShowInput(\'adress\')?></td> </tr>
   
    <tr> <td>Indirizzo mail per communicazione 
        <br />
       <?=$FORM->ShowInput(\'email\')?></td> </tr>
   
    <tr> <td>Nome della persona di contatto 
        <br />
       <?=$FORM->ShowInput(\'name\')?></td> </tr>
   
    <tr> <td>Numero di copie <?=$FORM->ShowInput(\'count\')?></td> </tr>
   
    <tr> <td>Inserite il codice di verifica: 
        <br />
       <?=$FORM->ShowCaptchaImage()?> 
        <br />
       
        <br />
       <?=$FORM->ShowCaptchaField()?></td> </tr>
   
    <tr> <td><?=$FORM->ShowSubmitButton("Sottoscrivi","")?></td> </tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>