<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001626059466';
$dateexpire = '001628651466';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1199:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?> 
<p><?=$FORM->ShowFormNote()?><?=$FORM->ShowFormErrors()?></p>
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr> <td>Name des Unternehmens 
        <br />
       <?=$FORM->ShowInput(\'firm\')?></td> </tr>
   
    <tr> <td>Postanschrift f&uuml;r die kostenlose Einsendung des Katalogs 
        <br />
       <?=$FORM->ShowInput(\'adress\')?></td> </tr>
   
    <tr> <td>Email f&uuml;r die Kommunikation 
        <br />
       <?=$FORM->ShowInput(\'email\')?></td> </tr>
   
    <tr> <td>Name des Ansprechpartners 
        <br />
       <?=$FORM->ShowInput(\'name\')?></td> </tr>
   
    <tr> <td>Anzahl der Kopien <?=$FORM->ShowInput(\'count\')?></td> </tr>
   
    <tr> <td>Bitte Best&auml;tigungscode eingeben 
        <br />
       <?=$FORM->ShowCaptchaImage()?> 
        <br />
       
        <br />
       <?=$FORM->ShowCaptchaField()?></td> </tr>
   
    <tr> <td><?=$FORM->ShowSubmitButton("Submit","")?></td> </tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>