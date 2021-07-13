var mapclass="maparus";
divclass=".select-okrug";
function setclass(a)
{
	var city = new Array;
	city = $("#"+a+"_div>span");
	for (i=0; i<city.length; i++)
	{
		if (city[i].id != "vladivostok")
			$(city[i]).addClass("select-okrug");
	}
	document.getElementById('wheretobuy').className = a;
}
function setclassdiv(a)
{
	if (a == "delete")
	{
		$(divclass).removeClass();
	}
	else
	{
		var currentclass = "";
		var divid = a.split("-");
		for(i=0; i<divid.length; i++)
		{
			if (divid[i] == "krymskij")
			{
				$("#yuzhnyj-okrug").addClass("select-okrug");
				$("#severo-kavkazskij-okrug").addClass("select-okrug");
				break;
			}
			if (divid[i] != "federalnyj")
			{
				if (currentclass != "")
					currentclass = currentclass + "-" + divid[i];
				else
					currentclass = divid[i];
			}
			if (divid[i] == "yuzhnyj" || divid[i] == "krymskij")
			{
				$("#yuzhnyj-okrug").addClass("select-okrug");
				$("#severo-kavkazskij-okrug").addClass("select-okrug");
			}
		}
		$("#"+currentclass).addClass("select-okrug");
	}
}
function descView(a)
{
	$("#"+a+">div").css("display","block");
}
function setclasssng(a)
{
	var city = new Array;
	if (a == "delete")
	{
		$(divclass).removeClass();
		current = "maparus";
		$("div.descrip").css("display", "none");
	}
	else
	{
		a = "#" + a;
		current = $(a).parent()[0].id;
		if (current == "map_description")
		{
			current = a;
		}
		city = $(current+">span");
		current = current.replace("_div","");
		current = current.replace("#","");
		for (i=0; i<city.length; i++)
		{
			if (city[i].id != "vladivostok")
				$(city[i]).addClass("select-okrug");
		}
	}
	document.getElementById('wheretobuy').className = current;
}

var massCountrys = new Array("AL", "AT", "AU", "BY", "BEN", "BG", "CN", "CO", "HR", "CZ", "EE", "FI", "FR", "DE", "GR", "HU", "IS", "IN", "IE", "IT", "KZ", "KR", "LV", "LY", "LT", "MT", "MX", "NZ", "NG", "PH", "PL", "PT", "RO", "rossiya", "SA", "SK", "TM", "ES", "SE", "CH", "SY", "AE", "UA", "UK", "DK", "RS");
var massCountryUrl = {
	AL: "AL",
	AT: "AT",
	AU: "AU",
	BY: "BY",
	BEN: "BEN",
	BG: "BG",
	CN: "CN",
	CO: "CO",
	HR: "HR",
	CZ: "CZ",
	EE: "EE",
	FI: "FI",
	FR: "FR",
	DE: "DE",
	GR: "GR",
	HU: "HU",
	IS: "IS",
	IN: "IN",
	IE: "IE",
	IT: "IT",
	KZ: "KZ",
	KR: "KR",
	LV: "LV",
	LY: "LY",
	LT: "LT",
	MT: "MT",
	MX: "MX",
	NZ: "NZ",
	NG: "NG",
	PH: "PH",
	PL: "PL",
	PT: "PT",
	RO: "RO",
	rossiya: "RUS",
	SA: "SA",
	SK: "SK",
	TM: "TM",
	ES: "ES",
	SE: "SE",
	CH: "CH",
	SY: "SY",
	AE: "AE",
	UA: "UA",
	UK: "UK",
	DK: "DK",
	RS: "RS",
};
switch(LANGUAGE_ID)
{
	case "ru":
		var massCountryName = {
			AL: "Албания",
			AT: "Австрия",
			AU: "Австралия",
			BY: "Беларусь",
			BEN: "Бенелюкс",
			BG: "Болгария",
			CN: "Китай",
			CO: "Колумбия",
			HR: "Хорватия",
			CZ: "Чехия",
			EE: "Эстония",
			FI: "Финляндия",
			FR: "Франция",
			DE: "Германия",
			GR: "Греция",
			HU: "Венгрия",
			IS: "Исландия",
			IN: "Индия",
			IE: "Ирландия",
			IT: "Италия",
			KZ: "Казахстан",
			KR: "Корея",
			LV: "Латвия",
			LY: "Ливия",
			LT: "Литва",
			MT: "Мальта",
			MX: "Мексика",
			NZ: "Новая Зеландия",
			NG: "Нигерия",
			PH: "Филиппины",
			PL: "Польша",
			PT: "Португалия",
			RO: "Румыния",
			rossiya: "Россия",
			SA: "Саудовская Аравия",
			SK: "Словакия",
			TM: "Туркменистан",
			ES: "Испания",
			SE: "Швеция",
			CH: "Швейцария",
			SY: "Сирия",
			AE: "О.А.Э.",
			UA: "Украина",
			UK: "Великобритания",
			DK: "Дания",
			RS: "Сербия"
		};
		var path = "/where-to-buy/";
		break;
	case "en":
		var massCountryName = {
			AL: "Albania",
			AT: "Austria",
			AU: "Australia",
			BY: "Belarus",
			BEN: "Benelux",
			BG: "Bulgaria",
			CN: "China",
			CO: "Colombia",
			HR: "Croatia",
			CZ: "Czech Republic",
			EE: "Estonia",
			FI: "Finland",
			FR: "France",
			DE: "Germany",
			GR: "Greece",
			HU: "Hungary",
			IS: "Iceland",
			IN: "India",
			IE: "Ireland",
			IT: "Italy",
			KZ: "Kazakhstan",
			KR: "Korea",
			LV: "Latvia",
			LY: "Libya",
			LT: "Lithuania",
			MT: "Malta",
			MX: "Mexico",
			NZ: "New Zealand",
			NG: "Nigeria",
			PH: "Philippines",
			PL: "Poland",
			PT: "Portugal",
			RO: "Romania",
			rossiya: "Russia",
			SA: "Saudi Arabia",
			SK: "Slovakia",	
			TM: "Turkmenistan",
			ES: "Spain",
			SE: "Sweden",
			CH: "Switzerland",
			SY: "Syria",
			AE: "U.A.E.",
			UA: "Ukraine",
			UK: "United Kingdom",
			DK: "Denmark",
			RS: "Serbia"
		};
		var path = "/where-to-buy/";
		massCountryUrl["rossiya"] = "/contacts.php";
		break;
	case "de":
		var massCountryName = {
			AL: "Albanien",
			AT: "Österreich",
			AU: "Australien",
			BY: "Weißrussland",
			BEN: "Benelux",
			BG: "Bulgarien",
			CN: "China",
			CO: "Kolumbien",
			HR: "Kroatien",
			CZ: "Tschechien",
			EE: "Estland",
			FI: "Finnland",
			FR: "Frankreich",
			DE: "Deutschland",
			GR: "Griechenland",
			HU: "Ungarn",
			IS: "Island",
			IN: "Indien",
			IE: "Irland",
			IT: "Italien",
			KZ: "Kasachstan",
			KR: "Korea",
			LV: "Lettland",
			LY: "Libyen",
			LT: "Litauen",
			MT: "Malta",
			MX: "Mexiko",
			NZ: "Neuseeland",
			NG: "Nigeria",
			PH: "Philippinen",
			PL: "Polen",
			PT: "Portugal",
			RO: "Rumänien",
			rossiya: "Russland",
			SA: "Saudi-Arabien",
			SK: "Slowakei",
			TM: "Turkmenistan",
			ES: "Spanien",
			SE: "Schweden",
			CH: "Schweiz",
			SY: "Syrien",
			AE: "VAE",
			UA: "Ukraine",
			UK: "Vereinigtes Königreich",
			DK: "Dänemark",
			RS: "Serbien"
		};
		var path = "/handler/";
		massCountryUrl["rossiya"] = "/kontakt.php";
		break;
	case "fr":
		var massCountryName = {
			AL: "Albanie",
			AT: "Autriche",
			AU: "Australie",
			BY: "Bélarus",
			BEN: "Benelux",
			BG: "Bulgarie",
			CN: "Chine",
			CO: "Colombie",
			HR: "Croatie",
			CZ: "République Tchèque",
			EE: "Estonie",
			FI: "Finlande",
			FR: "France",
			DE: "Allemagne",
			GR: "Grèce",
			HU: "Hongrie",
			IS: "Islande",
			IN: "Inde",
			IE: "Irlande",
			IT: "Italie",
			KZ: "Kazakhstan",
			KR: "Corée",
			LV: "Lettonie",
			LY: "Libye",
			LT: "Lituanie",
			MT: "Malta",
			MX: "Mexique",
			NZ: "Nouvelle-Zélande",
			NG: "Nigeria",
			PH: "Philippines",
			PL: "Pologne",
			PT: "Portugal",
			RO: "Roumanie",
			rossiya: "Russie",
			SA: "Arabie saoudite",
			SK: "Slovaquie",
			TM: "Turkménistan",
			ES: "Espagne",
			SE: "Suède",
			CH: "Suisse",
			SY: "Syrie",
			AE: "U.A.E.",
			UA: "Ukraine",
			UK: "Royaume-Uni",
			DK: "Danemark",
			RS: "Serbie"
		};
		var path = "/ou-acheter/";
		massCountryUrl["rossiya"] = "/contact.php";
		break;
	case "it":
		var massCountryName = {
			AL: "Albania",
			AT: "Austria",
			AU: "Australia",
			BY: "Bielorussia",
			BEN: "Benelux",
			BG: "Bulgaria",
			CN: "Cina",
			CO: "Colombia",
			HR: "Croazia",
			CZ: "Repubblica Ceca",
			EE: "Estonia",
			FI: "Finlandia",
			FR: "Francia",
			DE: "Germania",
			GR: "Grecia",
			HU: "Ungheria",
			IS: "Islanda",
			IN: "India",
			IE: "Irlanda",
			IT: "Italia",
			KZ: "Kazakistan",
			KR: "Corea",
			LV: "Lettonia",
			LY: "Libia",
			LT: "Lituania",
			MT: "Malta",
			MX: "Messico",
			NZ: "Nuova Zelanda",
			NG: "Nigeria",
			PH: "Filippine",
			PL: "Polonia",
			PT: "Portogallo",
			RO: "Romania",
			rossiya: "Russia",
			SA: "Arabia Saudita",
			SK: "Slovacchia",
			TM: "Turkmenistan",
			ES: "Spagna",
			SE: "Svezia",
			CH: "Svizzera",
			SY: "Siria",
			AE: "EAU",
			UA: "Ucraina",
			UK: "Regno Unito",
			DK: "Danimarca",
			RS: "Serbia"
		};
		var path = "/dove-comprare/";
		massCountryUrl["rossiya"] = "/contattaci.php";
		break;
	case "es":
		var massCountryName = {
			AL: "Albania",
			AT: "Austria",
			AU: "Australia",
			BY: "Bielorrusia",
			BEN: "Benelux",
			BG: "Bulgaria",
			CN: "China",
			CO: "Colombia",
			HR: "Croacia",
			CZ: "República Checa",
			EE: "Estonia",
			FI: "Finlandia",
			FR: "Francia",
			DE: "Alemania",
			GR: "Grecia",
			HU: "Hungría",
			IS: "Islandia",
			IN: "India",
			IE: "Irlanda",
			IT: "Italia",
			KZ: "Kazajistán",
			KR: "Corea",
			LV: "Letonia",
			LY: "Libia",
			LT: "Lituania",
			MT: "Malta",
			MX: "México",
			NZ: "Nueva Zelanda",
			NG: "Nigeria",
			PH: "Filipinas",
			PL: "Polonia",
			PT: "Portugal",
			RO: "Rumania",
			rossiya: "Rusia",
			SA: "Arabia Saudita",
			TM: "Turkmenistán",
			SK: "Eslovaquia",
			ES: "España",
			SE: "Suecia",
			CH: "Suiza",
			SY: "Siria",
			AE: "EAU",
			UA: "Ucrania",
			UK: "Reino Unido",
			DK: "Dinamarca",
			RS: "Serbia"
		};
		var path = "/donde-comprar/";
		massCountryUrl["rossiya"] = "/contacto.php";
		break;
}
massCountryUrl["MX"] = "feedback.php";
massCountryUrl["AE"] = "feedback.php";
massCountryUrl["SA"] = "feedback.php";
$(document).ready(function() {
	// красим страны, что есть в списке
	for(var i=0; i<massCountrys.length; i++)
	{
		$('g#'+massCountrys[i]+' > path').attr("fill", "#86B5DF");
	}
	// выделение страны при наведении мыши на страну
	$("g").mouseenter(function(){
		id = $(this).attr("id");
		country = massCountryName[id];
		if (country != undefined)
		{
			$("g#"+id+" > path").attr("fill", "#4486C5");
			$("#mapBlock").append('<div id="'+id+'Text" class="descrip"><div>'+massCountryName[id]+'</div><div><img width="15" border="0" height="15" src="/images/where-to-buy/ugol.svg"></div></div>');
		}
	});
	// действия при убирании курсора с выделенной страны
	$("g").mouseleave(function(){
		id = $(this).attr("id");
		country = massCountryName[id];
		if (country != undefined)
		{
			$('g#'+id+' > path').attr("fill", "#86B5DF");
			$("#"+id+"Text").remove();
		}
	});
	// клик по стране
	$('g').click(function(){
		id = $(this).attr("id");
		country = massCountryName[id];
		if (country != undefined)
		{
			if (id == "rossiya" && LANGUAGE_ID != "ru")
				document.location.href = massCountryUrl[id];
			else
				document.location.href = path+massCountryUrl[id]+"/";
		}
	});
});