<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die ();?>
<?
$aMenuLinks = Array(
	Array(
		"Журнал",
		"/client/prepodavatelskaya/",
		Array(),
		Array("INFOIMG"=>"acces-partenaires.jpg", "STARTSCRIPT"=>"NO"),
		"CSite::InGroup(array(1,26))"
	),
	Array(
		"Список студентов ",
		"/client/prepodavatelskaya/list/",
		Array(),
		Array("INFOIMG"=>"obuchenie-dlya-polzovatelej.jpg"),
		"CSite::InGroup(array(1,26))"
	),
	Array(
		"Связь с PERC<span style='text-transform:lowercase;'>o</span>",
		"/client/prepodavatelskaya/svyaz-s-perco/",
		Array(),
		Array("INFOIMG"=>"acces-partenaires.jpg"),
		"CSite::InGroup(array(1,26))"
	)
	/*Array(
		"Форум",
		"/forum/"
	)*/
);
?>