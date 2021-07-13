function changestatus(id)
{
	$(".changestatus").fadeOut('slow');
	switch(id)
	{
		case "AI":
			if ($("#schet").is("#schet") || $("#obuch_schet").is("#obuch_schet"))
			{
				if ($("#schet").is("#schet"))
					$("#schet").fadeIn('slow');
				if ($("#obuch_schet").is("#obuch_schet"))
					$("#obuch_schet").fadeIn('slow');
			}
			$("#dialog-form").html('<p style="text-transform:uppercase; text-align:center; font-size: 14px;"><strong>Требования к Авторизованным инсталляторам</strong></p><ol style="font-size: 12px;"><li>Ваша компания занимается монтажом систем безопасности</li></ol>');
			$("#zapros_a a").attr("href", "/download/examples/zapros_AI.pdf");
			$("[name=STATUS]").val("AI");
			$("[name=UF_ZAKUPKI]").val("auto");
			if ($('[name=UF_NAL_OBORUD_PERCO]:selected').val() != 2)  
				$("#kit_dogovor").css("display", "none");
			if ($("#tpstatus").is("#tpstatus"))
				$("#tpstatus").fadeOut('slow');
			if ($("#aistatus").is("#aistatus"))
			{
				$("#aistatus").fadeIn('slow');
				if ($("#aistatus").attr("value") != "")
				{
					$("[name=STATUS]").val("FS");
					$("[name=save]").val("Сохранить");
					$("#status-form").fadeIn('slow');
					$("#UF_SCAN_ZAPROS_TP").css("display", "none");
					$("#UF_INN").css("display", "none");
					$("#UF_NAL_OBORUD_PERCO").css("display", "none");
					$("#UF_ZAKUPKA").css("display", "none");
					$("#UF_F_ZAKUPOK").css("display", "none");
					$("#UF_ZAKUPKI").css("display", "none");
					$("#NAKLADNAYA").css("display", "none");
				}
			}
			else
			{
				$("#status-form").fadeIn('slow');
				$("#UF_NAL_OBORUD_PERCO").fadeIn('slow');
				$("#UF_SCAN_ZAPROS_TP").css("display", "none");
				$("#UF_ZAKUPKA").css("display", "none");
				$("#UF_F_ZAKUPOK").css("display", "none");
				$("#UF_ZAKUPKI").css("display", "none");
				$("#NAKLADNAYA").css("display", "none");
			}
			$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
			$("#sogbut").css("color", "#0000EE");
			break;
		case "TP":
			$("#dialog-form").html('<p style="text-transform:uppercase; text-align:center; font-size: 14px;"><strong>Требования к сертифицированным торговым партнерам</strong></p><ol style="font-size: 12px;"><li>У вашей компании имеется опыт работы с оборудованием PERCo не менее 1 года</li><li>В штате вашей компании не менее 4-х менеджеров по продажам</li><li>Население города не менее 700 000 человек</li><li>Объем закупок оборудования PERCo на сумму:<ul><li>не менее 200 тысяч рублей для города с населением до 500 000 человек;</li><li>не менее 1 млн. рублей для города с населением от 500 000 до 1 млн. человек;</li><li>не менее 2 млн. рублей для города с населением от 1 миллиона человек;</li><li>не менее 5 миллионов рублей для Санкт-Петербурга;</li><li>не менее 10 миллионов рублей для Москвы;</li></ul></li></ol>');
			$("[name=STATUS]").val("TP");
			if ($("[name=UF_ZAKUPKI]").val() == "auto")
				$("[name=UF_ZAKUPKI]").val("");
			if ($("[name=UF_ZAKUPKA][value=20]").prop("checked"))
			{
				$("#UF_F_ZAKUPOK").fadeOut('slow');
				$("#NAKLADNAYA").fadeOut('slow');
				$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
				$("#sogbut").css("color", "#0000EE");
			}
			else
			{
				$("#sogbut").removeAttr("onclick");
				$("#sogbut").css("color", "#CCC");
				$(":submit").attr("disabled", "disabled"); 
			}
			if ($("#aistatus").is("#aistatus"))
				$("#aistatus").fadeOut('slow');
			if ($("#tpstatus").is("#tpstatus"))
			{
				$("#tpstatus").fadeIn('slow');
				if ($("#tpstatus").attr("value") != "")
				{
					switch($("#tpstatus").attr("value"))
					{
						case "1":
						case "2":
							$("#UF_F_ZAKUPOK").css("display", "none");
							break;
						case "z1":
						case "z2":
							$("#UF_SCAN_ZAPROS_TP").css("display", "none");
							break;
					}
					$("[name=STATUS]").val("TPF");
					$("[name=save]").val("Сохранить");
					$("#status-form").fadeIn('slow');
					$("#UF_SCAN_ZAPROS").css("display", "none");
					$("#UF_INN").css("display", "none");
					$("#UF_NAL_OBORUD_PERCO").css("display", "none");
					$("#UF_ZAKUPKA").css("display", "none");
					//$("#UF_ZAKUPKI").css("display", "none");
					$("#NAKLADNAYA").css("display", "none");
					$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
					$("#sogbut").css("color", "#0000EE");
				}
			}
			else
			{
				$("#status-form").fadeIn('slow');
				$("#UF_SCAN_ZAPROS").css("display", "none");
				$("#UF_NAL_OBORUD_PERCO").css("display", "none");
				$("#UF_F_ZAKUPOK").css("display", "none");
			}
			break;
	}
}
$(document).ready(function(){
	if ($(".notetext").is(".notetext"))
	{
		$(".changestatus").css("display", "none");
		$("#tpstatus").css("display", "none");
		$("#aistatus").css("display", "none");
		$("#status-form").css("display", "none");
	}
	if ($(".errortext").is(".errortext"))
	{
		switch($("[name=STATUS]").val())
		{
			case "AI":
			case "TP":
				changestatus($("[name=STATUS]").val());
				break;
		}
	}
	if (!$(".changestatus").is(".changestatus"))
	{
		$("[name=STATUS]").val("AS");
		$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
		$("#sogbut").css("color", "#0000EE");
		if ($("#asstatus").is("#asstatus") && $("#asstatus").attr("value") != "")
		{
			$("[name=STATUS]").val("FS");
			$("[name=save]").val("Сохранить");
			$("#status-form").fadeIn('slow');
			$("#UF_SCAN_ZAPROS").fadeIn('slow');
			$("#UF_INN").css("display", "none");
		}
		if (($("#aistatus").is("#aistatus") && $("#tpstatus").is("#tpstatus") && !$("#aistatus").attr("value") && !$("#tpstatus").attr("value")) || ($("#asstatus").is("#asstatus") && !$("#asstatus").attr("value")))
			$("#status-form").css("display", "none");
	}
	// 18 - Авторизованный инсталлятор
	// 19 - Торговый партнер
	$(".changestatus input").click(function(){
		changestatus($(this).attr("id"));
	});
	$("[name=UF_ZAKUPKA]").change(function(){
		if ($("[name=UF_ZAKUPKA][value=20]").prop("checked"))
		{
			$('[name=NAKLADNAYA][value=""]').prop("checked", true);
			$("#NAKLADNAYA").fadeOut('slow');
			$("#UF_F_ZAKUPOK").fadeOut('slow');
			$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
			$("#sogbut").css("color", "#0000EE");
		}
		else
		{
			$("[name=NAKLADNAYA]").prop("checked", false);
			$("#NAKLADNAYA").fadeIn('slow');
			$("#sogbut").removeAttr("onclick");
			$("#sogbut").css("color", "#CCC");
			$(":submit").attr("disabled", "disabled"); 
		}
	}); 
	$("[name=NAKLADNAYA]").change(function(){
		switch($(this).val())
		{
			case "1":
				$("#UF_F_ZAKUPOK").fadeIn('slow');
				$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
				$("#sogbut").css("color", "#0000EE");
				break;
			case "2":
				$("#UF_F_ZAKUPOK").fadeOut('slow');
				$("#sogbut").attr("onclick", "$('#dialog-form').dialog('open')");
				$("#sogbut").css("color", "#0000EE");
				break;
		}
	}); 
	$("[name=UF_NAL_OBORUD_PERCO]").change(function(){
		if ($(this).val() == 2)
			$("#kit_dogovor").fadeIn('slow');
		else
			$("#kit_dogovor").fadeOut('slow');
	});
});
$(function() {
	$("#dialog:ui-dialog").dialog("destroy");
	$("#dialog-form").dialog({
		autoOpen: false,
		height: "auto",
		width: 550,
		modal: true,
		dialogClass: "no-close",
		buttons: {
			"Согласен": function() {
				$(":submit").removeAttr("disabled");
				$(this).dialog("close");
			},
			"Не согласен": function() {
				$(":submit").attr("disabled", "disabled"); 
				$(this).dialog("close");
			}
		},
	});
});