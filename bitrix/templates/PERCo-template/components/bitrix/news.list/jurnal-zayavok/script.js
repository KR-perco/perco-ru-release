$(document).ready(function(){
	$("[name = type-active]").change(function(){
		var type = $('[name = type-active] :selected').val();
		SortZayavki(type);
	});
});

function SortZayavki(type)
{
	$(".uchitelskaya_jurnal tbody tr").css("display", "none");
	if (type == "future")
		for (i=0; i < arFuture.length; i++)
			document.getElementById(arFuture[i]).style.display = 'table-row';
	else
	{
		if (type == "past")
			for (i=0; i < arPast.length; i++)
				document.getElementById(arPast[i]).style.display = 'table-row';
		else
			for (i=0; i < arPast.length; i++)
				$(arOld[i]).css("display", "table-row");
	}
}