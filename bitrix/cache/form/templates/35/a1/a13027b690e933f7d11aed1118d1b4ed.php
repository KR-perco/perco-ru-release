<?
if($INCLUDE_FROM_CACHE!='Y')return false;
$datecreate = '001623657842';
$dateexpire = '001626249842';
$ser_content = 'a:2:{s:7:"CONTENT";s:0:"";s:4:"VARS";a:1:{s:13:"FORM_TEMPLATE";s:4296:"<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?=$FORM->ShowFormHeader();?><?if($FORM->isFormErrors()) { ?> 
<a name="error" id="error"></a>
 
<script type="text/javascript" ript="">location.hash=\'error\'</script>
 <?=$FORM->ShowFormErrors()?> <?=$FORM->ShowFormNote()?> <? } ?> 
<div style="display: none;"> <?=$FORM->ShowInput(\'date0\')?> </div>
 
<script type="text/javascript" ript="">
$(document).ready(function(){
	$(":submit").attr("disabled", "disabled");
	if (speclAll == "")
		$("#zayavka").css("display", "none");
	$(".list_spec").html(speclAll);
	if ($("#form_checkbox_hotel_552").prop("checked"))
	{
		$("#info").css("display", "none");
		$("#data_zaezda").css("display", "none");
		$("#data_viezda").css("display", "none");
		$("#vid_nomera").css("display", "none");
	}
	$("[name=form_radio_hotel]").change(function() {
		if ($("#form_checkbox_hotel_553").prop("checked"))
		{
			$("#info").fadeIn(\'slow\');
			$("#data_zaezda").fadeIn(\'slow\');
			$("#data_viezda").fadeIn(\'slow\');
			$("#vid_nomera").fadeIn(\'slow\');
		}
		else
		{
			$("#info").fadeOut(\'slow\');
			$("#data_zaezda").fadeOut(\'slow\');
			$("#data_viezda").fadeOut(\'slow\');
			$("#vid_nomera").fadeOut(\'slow\');
		}
	});
	$("#seminars").change(function(){
		$("#datesem > p").fadeOut(\'slow\');
		$("[name=LIST_DATE]").prop("checked", false);
		var sel = $("#seminars").val();
		if (sel != "0")
		{
			$("#specialists").fadeIn(\'slow\');
			$("#hotel").fadeIn(\'slow\');
			switch(sel)
			{
				case "1":	// Для руководителей
					$(".obzor").fadeIn(\'slow\');
					break;
				case "2":	// Для пользователей
					$(".praktika").fadeIn(\'slow\');
					break;
				case "3":	// Для инсталляторов/администраторов
					$(".allsem").fadeIn(\'slow\');
					break;
				case "4":	// Для инсталляторов/администраторов
					$(".service").fadeIn(\'slow\');
					break;
			}
			if ($("#datesem").attr("sem") != "0")
				$(":submit").removeAttr("disabled");
			else
				$("#datesem > p").fadeIn(\'slow\');
		}
		else
		{
			$("#specialists").fadeOut(\'slow\');
			$("#hotel").fadeOut(\'slow\');
			$(":submit").attr("disabled", "disabled");
		}
	});
});
$("form").submit(function() {
	var result="", name="", user = $("[name=LIST_SPEC]:checked");
	$.each(user, function (n, v) {
		var i = 0;
		var datares="", datas = $("#datesem [name=LIST_DATE]:checked")
		$.each(datas, function (m, z) {
			if (i == 0)
				datares = "," + z.value + "|";
			else
				datares += z.value + "|";
			i++;
		})
		result += v.value + datares + ";";
	});
	if (result != "")
		$("[name = form_hidden_560]").val(result);
	return true;
});
</script>
 <?=$FORM->ShowInput(\'kto\')?> 
<div class="list_spec" style="float: left;"></div>
 <?
global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?> 
<div style="float: right;"> 	 
  <p>Программы семинаров:</p>
 	 
  <ul> 		 
    <li><a rel="prettyPhoto" title="Для руководителей" href="/client/company/zayavka/chief.php?iframe=true&slideshow=false&width=75%&height=65%" >Для руководителей</a></li>
   <?
	if (in_array(21, $arUser["UF_TIP_SERT"]))
	{
		echo \'<li><a id="bxid_188361" rel="prettyPhoto" title="Для пользователей системы" href="/client/company/zayavka/user.php?iframe=true&slideshow=false&width=75%&height=45%" >Для пользователей системы</a></li>\';
		$kto = "администраторов";
	}
	else
		$kto = "инсталляторов";
	echo \'<li><a id="bxid_423394" rel="prettyPhoto" title="Для \'.$kto.\'" href="/client/company/zayavka/installyator.php?iframe=true&slideshow=false&width=75%&height=100%" >Для \'.$kto.\'</a></li>\';
	if ($arUser["UF_SC"])
		echo \'<li><a id="bxid_443891" rel="prettyPhoto" title="Для сервисных инженеров" href="/client/company/zayavka/servisnyi-inzhener.php?iframe=true&slideshow=false&width=75%&height=50%" >Для сервисных инженеров</a></li>\';
?> 		</ul>
 </div>
 
<div class="clear" style="clear: left;"></div>
 <?=$FORM->ShowSubmitButton("","")?><?=$FORM->ShowFormFooter();?>";}}';
return true;
?>