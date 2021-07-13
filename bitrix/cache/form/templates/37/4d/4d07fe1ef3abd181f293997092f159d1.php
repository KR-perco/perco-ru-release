<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001607272557';
$dateexpire = '001609864557';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:1571:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<p>Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</p>
 <?if($FORM->isFormErrors())
{ 
 echo \'<a name="error" id="error"></a>\';
 echo $FORM->ShowFormErrors();
}
?> 
<div class="inputs"> 
  <br />
 
  <table cellspacing="1" cellpadding="1" border="0"> 
    <tbody> 
      <tr> <td>Фамилия <?=$FORM->ShowRequired()?></td><td><?=$FORM->ShowInput(\'family_name\')?></td></tr>
     
      <tr> <td>Имя <?=$FORM->ShowRequired()?></td><td><?=$FORM->ShowInput(\'name\')?></td></tr>
     
      <tr> <td>Отчество <?=$FORM->ShowRequired()?></td><td><?=$FORM->ShowInput(\'patronymic_name\')?></td></tr>
     
      <tr> <td>№ группы<?=$FORM->ShowRequired()?></td><td><?=$FORM->ShowInput(\'n_group\')?></td></tr>
     
      <tr> <td>E-mail <?=$FORM->ShowRequired()?></td><td><?=$FORM->ShowInput(\'email\')?></td></tr>
     </tbody>
   </table>
 <?=$FORM->ShowInput(\'password\')?> <?=$FORM->ShowInput(\'company_email\')?> 
  <table cellspacing="1" cellpadding="1" border="0"> 
    <tbody> 
      <tr> <td colspan="2">введите код с картинки: 
          <br />
         </td> </tr>
     
      <tr> <td valign="top"><?=$FORM->ShowCaptchaField()?></td> <td><?=$FORM->ShowCaptchaImage()?></td> </tr>
     
      <tr> <td colspan="2"><?=$FORM->ShowSubmitButton("","")?></td> </tr>
     </tbody>
   </table>
 </div>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>