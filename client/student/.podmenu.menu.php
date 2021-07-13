<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die ();?>
<?
$aMenuLinks = Array(
	Array(
		"Экзаменационный журнал",
		"/client/student/",
		Array(),
		Array("INFOIMG"=>"acces-partenaires.jpg"),
		"CSite::InGroup(array(1,10))"
	),
	Array(
		"Связь с преподавателем",
		"/client/student/svyaz.php",
		Array(),
		Array("INFOIMG"=>"acces-partenaires.jpg"),
		"CSite::InGroup(array(1,10))"
	)
	/*Array(
		"Форум",
		"/forum/",
	)*/
);
?>