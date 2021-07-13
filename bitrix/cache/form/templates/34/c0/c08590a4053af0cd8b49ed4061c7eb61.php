<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001624861283';
$dateexpire = '001627453283';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2312:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> 
<p>Поля, отмеченные <span class="starrequired">*</span>, обязательны для заполнения.</p>
 <?if($FORM->isFormErrors())
{ 
 echo \'<a name="error" id="error"></a>\';
 echo $FORM->ShowFormErrors();
}
?> 
<script type="text/javascript">
$(document).ready(function() {
	if ($("#form_checkbox_obuchenie_550").prop("checked"))
		$("#data_obuch").css("display", "none");
	$("[name=form_radio_obuchenie]").change(function() {
	if ($("#form_checkbox_obuchenie_551").prop("checked"))
		$("#data_obuch").fadeIn(\'slow\');
	else
		$("#data_obuch").fadeOut(\'slow\');
	});
});
</script>
 
<div class="inputs"> 
  <br />
 
  <table cellspacing="1" cellpadding="1" border="0"> 
    <tbody> 
      <tr> <td style="border-image: initial;">Фамилия <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'family_name\')?></td></tr>
     
      <tr> <td style="border-image: initial;">Имя <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'name\')?></td></tr>
     
      <tr> <td style="border-image: initial;">Отчество <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'patronymic_name\')?></td></tr>
     
      <tr> <td style="border-image: initial;">Должность <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'post\')?></td></tr>
     
      <tr> <td style="border-image: initial;">E-mail <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'email\')?></td></tr>
     
      <tr> <td style="border-image: initial;">Проходил очное обучение в учебном центре PERCo <?=$FORM->ShowRequired()?></td><td style="border-image: initial;"><?=$FORM->ShowInput(\'obuchenie\')?></td></tr>
     
      <tr id="data_obuch"> <td style="border-image: initial;">Дата обучения </td><td style="border-image: initial;"><?=$FORM->ShowInput(\'date0\')?></td></tr>
     </tbody>
   </table>
 <?=$FORM->ShowInput(\'password\')?> <?=$FORM->ShowInput(\'company_email\')?> <?=$FORM->ShowSubmitButton("","")?> </div>
 <?=$FORM->ShowFormFooter();?>";}}';
return true;
?>