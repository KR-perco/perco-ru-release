<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623826010';
$dateexpire = '001626418010';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:2367:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?> <?if($FORM->isFormErrors())
{ 
 echo \'<a name="error" id="error"></a>\';
 echo $FORM->ShowFormErrors();
}
?> 
<style type="text/css">
.inputs table tr td:last-child { text-align: center; }
</style>
 
<script type="text/javascript">
$(document).ready(function() {
	$("[name=LIST_NUMBER]").change(function() {
		var number= Number($(this).val());
		if (isNaN(number))
		{
			number = 0;
			$(this).val("");
		}
		var name = $(this).attr("val_");
		var full_weight = 0;
		var weight = $(this).attr("weight_");
		if (number != "" && number != 0)
		{
			full_weight = Number($("#weight").text()) + number*weight;
			if ($("#row"+$(this).attr("id")).is($("#row"+$(this).attr("id"))))
				$("#row"+$(this).attr("id")).remove();
			$(".inputs table tbody").append("<tr id=\'row"+$(this).attr("id")+"\'><td>"+name+"</td><td>"+number+"</td></tr>");
		}
		else
		{
			$("#row"+$(this).attr("id")).remove();
			var c = 0;
			x = $("[name=LIST_NUMBER]");
			$.each(x, function (n, v) {
				c += Number(v.value)*weight;
			});
			full_weight = c;
		}
		$("#weight").text(full_weight.toFixed(3));
	});
});
$("form").submit(function()
{
	var t ="";
	var r="", d = $("[name=LIST_NUMBER]");
	$.each(d, function (n, v) {
		if (v.value != "" && v.value != 0)
		{
			r += v.value + ";";
			t += $(this).attr("val_") + ";";
		}
	});
	if (r != "" && t != "") 
	{
		$("[name = form_hidden_588]").val(t);
		$("[name = form_hidden_589]").val(r);
	}
	return true;
});
</script>
 
<div class="inputs"> <?=$FORM->ShowInput(\'products\')?><?=$FORM->ShowInput(\'number\')?> 
  <table cellspacing="1" cellpadding="1" border="1"> 
    <tbody> 
      <tr> <td>Наименование продукции</td><td>Количество, шт.</td></tr>
     </tbody>
   </table>
 
  <p>Ориентировочный вес: <span id="weight"></span> кг</p>
 </div>
 
<table cellspacing="1" cellpadding="1" border="1"> 
  <tbody> 
    <tr> <td>Вид доставки</td><td><?=$FORM->ShowInput(\'list\')?></td></tr>
   
    <tr> <td>Желаемая дата доставки</td><td><?=$FORM->ShowInput(\'data\')?></td></tr>
   </tbody>
 </table>
 <?=$FORM->ShowSubmitButton("Отправить","")?><?=$FORM->ShowFormFooter();?>";}}';
return true;
?>