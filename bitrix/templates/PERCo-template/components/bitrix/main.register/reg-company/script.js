$(function() {
	if ($(window).width() > 720)
		width = 550;
	else
		width = "auto"
	$( "#dialog:ui-dialog" ).dialog( "destroy" );
	$( "#dialog-form" ).dialog({
		autoOpen: false,
		height: "auto",
		width: width,
		modal: true,
		dialogClass: "no-close",
		buttons: {
			"Закрыть": function() {
				$( this ).dialog( "close" );
			}
		},
	});
});

function chekfio () 
{
	if ($('input[name="REGISTER[NAME]"]').val() && $('input[name="REGISTER[SECOND_NAME]"]').val() &&  $('input[name="REGISTER[LAST_NAME]"]').val())
	{
		$("#sogbut").attr("onclick", "$( '#dialog-form' ).dialog( 'open' )"); 
		$("#sogbut").css("color", "#0000ee");
		$("#fio").text($('input[name="REGISTER[LAST_NAME]"]').val()+' '+$('input[name="REGISTER[NAME]"]').val()+' '+ $('input[name="REGISTER[SECOND_NAME]"]').val());
		$("#soglasie").attr("disabled", false);
	}
	else
	{
			$(":submit").removeAttr('onclick');
			$("#sogbut").css("color", "#ccc");
			$("#soglasie").attr("disabled", true);
	}
}

$(document).ready(function(){
	chekfio();
	$('input[name="REGISTER[NAME]"]').change(function(){
		chekfio ();
	});
	$('input[name="REGISTER[SECOND_NAME]"]').change(function(){
		chekfio ();
	});
	$('input[name="REGISTER[LAST_NAME]"]').change(function(){
		chekfio ();
	});
	$('input[name="REGISTER[EMAIL]"]').change(function(){
		$('input[name="REGISTER[LOGIN]"]').val($(this).val());
	});
	$('input[name="soglasie"]').change(function(){
		if ($(this).prop("checked"))
			$(":submit").removeAttr('disabled');
		else
			$(":submit").attr("disabled", "disabled"); 
	});
	$('input[type=checkbox][name = UF_TIP_SERT\\[\\]]').change(function(){
		if ($(this).prop("checked") && $(this).val() == 21)
			$('input[type=checkbox][name = UF_TIP_SERT\\[\\]][value != 21]').attr("checked", false);
		else
			$('input[type=checkbox][name = UF_TIP_SERT\\[\\]][value = 21]').attr("checked", false);
	});
});