function validate()
{
	var x;
	x = document.forms["form1"]["NAME"].value;
	if (x.length==0)
	{
		alert("Поле 'Имя' обязательно для заполнения");
		return false;
	}
	x = document.forms["form1"]["LAST_NAME"].value;
	if (x.length==0)
	{
		alert("Поле 'Фамилия' обязательно для заполнения");
		return false;
	}
	x = document.forms["form1"]["SECOND_NAME"].value;
	if (x.length==0)
	{
		alert("Поле 'Отчество' обязательно для заполнения");
		return false;
	}
	x = document.forms["form1"]["EMAIL"].value;
	if (x.length==0)
	{
		alert("Поле 'E-Mail' обязательно для заполнения");
		return false;
	}
	x = document.forms["form1"]["LOGIN"].value;
	if (x.length==0)
	{
		alert("Поле 'Логин' обязательно для заполнения");
		return false;
	}
	x = document.forms["form1"]["WORK_COMPANY"].value;
	if (x.length==0)
	{
		alert("Поле 'Наименование компании' обязательно для заполнения");
		return false;
	}
}