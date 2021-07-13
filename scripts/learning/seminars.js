var CountSel = 0;
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

function seminarsView(seminarsid)
{
	document.getElementById(seminarsid).style.display = "block";
}
function seminarsHide(seminarsid)
{
	document.getElementById(seminarsid).style.display = "none";
}
function viewAll()
{
	CountSel = 0;
	if (allSeminars == false)
	{
		allSeminars = true;
		$(".seminar_info_block").css("display", "block");
		$(".news-calendar td > div").css("backgroundImage", "");
	}
}
function selectSel(seminarsel, typeid)
{
	switch(typeid)
	{
		case 'seminarviezd':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-seminarviezd-select.png")';
			break;
		case 'seminarvucentre':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-seminarvucentre-select.png")';
			break;
		case 'vebinar':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-vebinar-select.png")';
			break;
		case 'isvs':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-isvs-select.png")';
			break;
		case 'issvuc':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-issvuc-select.png")';
			break;
		case 'vssvuc':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-vssvuc-select.png")';
			break;
		case 'issvucnext':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-issvucnext-select.png")';
			break;
		case 'issvucend':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-issvucend-select.png")';
			break;
		case 'vssvucend':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-vssvucend-select.png")';
			break;
		case 'svucnext':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-svucnext-select.png")';
			break;
		case 'svucend':
			document.getElementById(seminarsel).style.backgroundImage = 'url("/images/calendar/bg-calendar-svucend-select.png")';
			break;
	}
}
function viewEvents(seminarsid, seminarsel, typeid)
{
	var i = 0;
	if(document.getElementById(seminarsid))
		var styleDisplay = document.getElementById(seminarsid).style.display;
	if (allSeminars == true)
	{
		allSeminars = false;
		$(".seminar_info_block").css("display", "none");
		document.getElementById(seminarsid).style.display = "block";
		CountSel++;
		selectSel(seminarsel, typeid);
	}
	else
	{
		if (styleDisplay == 'block')
		{
			document.getElementById(seminarsid).style.display = "none";
			document.getElementById(seminarsel).style.backgroundImage = "";
			CountSel--;
		}
		else
		{
			document.getElementById(seminarsid).style.display = "block";
			selectSel(seminarsel, typeid);
			CountSel++;
		}
		if (CountSel == 0)
		{
			allSeminars = true;
			$(".seminar_info_block").css("display", "block");
			document.getElementById(seminarsel).style.backgroundImage = "";
		}
	}
}
function goPage(eventid, eventparam)
{
	if(eventid == "" && eventparam == "")
		window.location.assign("./schedule/");
	else
	{
		if (eventparam != "")
			eventparam = "?"+eventparam;
		window.location.assign("./schedule/"+eventparam+"#"+eventid);
	}
}