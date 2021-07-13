var massID = new Array("LICON", "CL201", "KT02", "KT05", "LB", "KR05", "KTC01", "IR05", "ARM", "IR03", "TTR08", "IC03", "AI01", "IR04", "AU01", "CTL04", "PU01", "IR10", "AU05", "CL05", "SUPREMA");
var massIDUrl = {
	LICON: "/products/kontroller-registratsii-cr01.php",
	CL201: "/products/kontroller-zamka-cl201.1.php",
	KT02: "/products/elektronnaya-prokhodnaya-kt02.3.php",
	KT05: "/products/elektronnaya-prokhodnaya-kt05.4.php",
	LB: "/products/elektromekhanicheskie-zamki/",
	KR05: "/products/elektronnaya-prokhodnaya-kr05.4.php",
	KTC01: "/products/elektronnaya-prokhodnaya-ktc01.4.php",
	IR05: "/products/kontrolnyy-schityvatel-ir05.2.php",
	ARM: "/products/setevoe-po/",
	IR03: "/products/beskontaktnyy-schityvatel-ir03.php",
	TTR08: "/products/turniket-tripod-ttr-08.php",
	IC03: "/products/kartopriemnik-ic03.1.php",
	AI01: "/products/blok-indikatsii-s-ik-priemnikom-ai01.php",
	IR04: "/products/beskontaktnyy-schityvatel-ir04.php",
	AU01: "/products/ik-pult-distantsionnogo-upravleniya-au01.php",
	CTL04: "/products/universalnyy-kontroller-ctl04.php",
	PU01: "/products/okhranno-pozharnaya-signalizatsiya-pu01.php",
	IR10: "/products/schityvatel-dalnego-deystviya-ir10.php",
	AU05: "/products/tablo-sistemnogo-vremeni-au05.php",
	CL05: "/products/kontroller-zamka-cl05.1.php",
	SUPREMA: "/products/biometricheskie-kontrollery-suprema.php",
};
$(function(){
	// выделение при наведении мыши на элемент
	$("g").mouseenter(function(){
		id = $(this).attr("id");
		idsplit = $(this).attr("id").split("-");
		elemID = massIDUrl[idsplit[0]];
		if (elemID != undefined)
		{
			$("g#"+id+" text").attr("text-decoration", "underline");
			$(this).attr("cursor", "pointer");
			$(this).attr("fill", "#4486C5");
		}
	});
	// действия при убирании курсора с выделенного элемента
	$("g").mouseleave(function(){
		id = $(this).attr("id");
		idsplit = $(this).attr("id").split("-");
		elemID = massIDUrl[idsplit[0]];
		if (elemID != undefined)
			$("g#"+id+" text").removeAttr("text-decoration");
	});
	// клик по элементу
	$("g").click(function(){
		id = $(this).attr("id").split("-");
		elemID = massIDUrl[id[0]];
		if (elemID != undefined)
			window.open(elemID, "_top");
	});
});