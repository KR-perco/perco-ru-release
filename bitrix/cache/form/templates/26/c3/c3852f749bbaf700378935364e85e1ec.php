<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001626046137';
$dateexpire = '001628638137';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1148:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?> 
<p><?=$FORM->ShowFormNote()?><?=$FORM->ShowFormErrors()?></p>
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr> <td>Company Name 
        <br />
       <?=$FORM->ShowInput(\'firm\')?></td> </tr>
   
    <tr> <td>Mailing address for free catalogue delivery 
        <br />
       <?=$FORM->ShowInput(\'adress\')?></td> </tr>
   
    <tr> <td>E-mail for communication 
        <br />
       <?=$FORM->ShowInput(\'email\')?></td> </tr>
   
    <tr> <td>Name of contact person 
        <br />
       <?=$FORM->ShowInput(\'name\')?></td> </tr>
   
    <tr> <td>Number of copies <?=$FORM->ShowInput(\'count\')?></td> </tr>
   
    <tr> <td>Enter Verification Code: 
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