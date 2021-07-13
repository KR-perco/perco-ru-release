<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001625969064';
$dateexpire = '001628561064';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1350:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?> 
<p><?=$FORM->ShowFormNote()?><?=$FORM->ShowFormErrors()?></p>
 
<table cellspacing="0" cellpadding="3" border="0"> 
  <tbody> 
    <tr> <td>Название компании 
        <br />
       <?=$FORM->ShowInput(\'firm\')?></td> </tr>
   
    <tr> <td>Почтовый адрес для бесплатной доставки каталога 
        <br />
       <?=$FORM->ShowInput(\'adress\')?></td> </tr>
   
    <tr> <td>E-mail 
        <br />
       <?=$FORM->ShowInput(\'email\')?></td> </tr>
   
    <tr> <td>Телефон 
        <br />
       <?=$FORM->ShowInput(\'phone\')?></td> </tr>
   
    <tr> <td>Контактное лицо 
        <br />
       <?=$FORM->ShowInput(\'name\')?></td> </tr>
   
    <tr> <td>Количество копий <?=$FORM->ShowInput(\'count\')?></td> </tr>
   
    <tr> <td>Введите код с картинки: 
        <br />
       <?=$FORM->ShowCaptchaImage()?> 
        <br />
       
        <br />
       <?=$FORM->ShowCaptchaField()?></td> </tr>
   
    <tr> <td><?=$FORM->ShowSubmitButton("Отправить","")?></td> </tr>
   </tbody>
 </table>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>