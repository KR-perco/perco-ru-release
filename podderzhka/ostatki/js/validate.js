function send()
{
	if($("div").hasClass("progress"))
	{
		$('button.btn-warning').remove();
		$("div.progress").text("Загружается...");
	return true;
	}
	else
		return false;
}

function validate()
{
	if(!$("tr").hasClass("download"))
	{
		alert("Нет загруженных файлов!");
		return false;
	}
	else
	{
		if($("tr.download").hasClass("error"))
		{
			alert("Удалите ошибочные файлы и повторно нажмите \"Получить ссылки\"!");
			return false;
		}
	}
}