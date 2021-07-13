function SlowHide()
{
	$(document.getElementById('foottip')).fadeOut("slow");
	$(document.getElementById('loadlist')).fadeIn("slow");
}
function SlowView()
{
	$(document.getElementById('loadlist')).fadeOut("slow");
	$(document.getElementById('foottip')).fadeIn("slow");
}

function ViewCompany()
{
	if (kaz == true)
	{
		var dealer_1;
		var dealer_2;
		var dealer_4;
		dealer_1 = document.getElementById("dealer_1");	// Aвторизованные дилеры и сервисные центры
		dealer_2 = document.getElementById("dealer_2");	// Сервисный центр
		dealer_4 = document.getElementById("dealer_4");	// Торговый партнер
		document.getElementById('foottip').style.display= 'none';
		// ->Aвторизованные дилеры и сервисные центры
		if (dealer_1.checked || dealer_2.checked)
		{
			if (document.getElementById('authorized_dealers'))
			{
				document.getElementById('authorized_dealers').style.display= 'block';
			}
		}
		else
		{
			if (document.getElementById('authorized_dealers'))
			{
				document.getElementById('authorized_dealers').style.display= 'none';
			}
		}
		// <-Aвторизованные дилеры и сервисные центры
		// ->Сервисный центр
		if (dealer_2.checked)
		{
			if (document.getElementById('service_centers'))
			{
				document.getElementById('service_centers').style.display= 'block';
			}
		}
		else
		{
			if (document.getElementById('service_centers'))
			{
				document.getElementById('service_centers').style.display= 'none';
			}
		}
		// <-Сервисный центр
		// ->Торговый партнер
		if (dealer_4.checked)
		{
			if (document.getElementById('trading_partners'))
			{
				document.getElementById('trading_partners').style.display= 'block';
			}
		}
		else
		{
			if (document.getElementById('trading_partners'))
			{
				document.getElementById('trading_partners').style.display= 'none';
			}
		}
		// <-Торговый партнер
	}
	else
	{
		var dealer_1;
		var dealer_2;
		var dealer_3;
		var dealer_4;
		dealer_1 = document.getElementById("dealer_1");	// Авторизованный дилер и сервисный центр
		dealer_2 = document.getElementById("dealer_2");	// Сервисный центр
		dealer_3 = document.getElementById("dealer_3");	// Авторизованный инсталлятор
		dealer_4 = document.getElementById("dealer_4");	// Торговый партнер
		document.getElementById('foottip').style.display= 'none';
		// ->Авторизованный дилер и сервисный центр
		if (dealer_1.checked || dealer_2.checked)
		{
			if (document.getElementById('authorized_dealers'))
			{
				document.getElementById('authorized_dealers').style.display= 'block';
			}
		}
		else
		{
			if (document.getElementById('authorized_dealers'))
			{
				document.getElementById('authorized_dealers').style.display= 'none';
			}
		}
		
		// <-Авторизованный дилер и сервисный центр
		// ->Сервисный центр, авторизованный инсталлятор
		if (dealer_3)
		{
			if (dealer_2.checked || dealer_3.checked)
			{
				if (document.getElementById('service_installers'))
				{
					document.getElementById('service_installers').style.display= 'block';
				}
			}
			else
			{
				if (document.getElementById('service_installers'))
				{
					document.getElementById('service_installers').style.display= 'none';
				}
			}
		}
		else
		{
			if (dealer_2.checked)
			{
				if (document.getElementById('service_installers'))
				{
					document.getElementById('service_installers').style.display= 'block';
				}
			}
			else
			{
				if (document.getElementById('service_installers'))
				{
					document.getElementById('service_installers').style.display= 'none';
				}
			}
		}
		// <-Сервисный центр, авторизованный инсталлятор
		// ->Сервисный центр
		if (dealer_2.checked)
		{
			if (document.getElementById('service_centers'))
			{
				document.getElementById('service_centers').style.display= 'block';
			}
		}
		else
		{
			if (document.getElementById('service_centers'))
			{
				document.getElementById('service_centers').style.display= 'none';
			}
		}
		// <-Сервисный центр
		// ->Авторизованный инсталлятор
		if (dealer_3)
		{
			if (dealer_3.checked)
			{
				if (document.getElementById('authorized_installers'))
				{
					document.getElementById('authorized_installers').style.display= 'block';
				}
			}
			else
			{
				if (document.getElementById('authorized_installers'))
				{
					document.getElementById('authorized_installers').style.display= 'none';
				}
			}
		}
		// <-Авторизованный инсталлятор
		// ->Авторизованный инсталлятор, торговый партнер
		if (dealer_3)
		{
			if (dealer_3.checked)
			{
				if (document.getElementById('authorized_partners'))
				{
					document.getElementById('authorized_partners').style.display= 'block';
				}
			}
			else
			{
				if (document.getElementById('authorized_partners'))
				{
					document.getElementById('authorized_partners').style.display= 'none';
				}
			}
		}
		else
		{
			if (dealer_4.checked)
			{
				if (document.getElementById('authorized_partners'))
				{
					document.getElementById('authorized_partners').style.display= 'block';
				}
			}
			else
			{
				if (document.getElementById('authorized_partners'))
				{
					document.getElementById('authorized_partners').style.display= 'none';
				}
			}
		}
		// <-Авторизованный инсталлятор, торговый партнер
		// ->Торговый партнер
		if (dealer_4.checked)
		{
			if (document.getElementById('trading_partners'))
			{
				document.getElementById('trading_partners').style.display= 'block';
			}
		}
		else
		{
			if (document.getElementById('trading_partners'))
			{
				document.getElementById('trading_partners').style.display= 'none';
			}
		}
		// <-Торговый партнер
	}
	document.getElementById('foottip').style.display= 'block';
	return false;
}
function specialistsView(footnoteid)
{
	document.getElementById(footnoteid).style.display = "block";
}
function specialistsHide(footnoteid)
{
	document.getElementById(footnoteid).style.display = "none";
}