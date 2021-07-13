<?
session_start();
if(!empty($_FILES))
{
	// Файл передан через обычный массив $_FILES
	$file = $_FILES['file'];
	copy($file['tmp_name'],"files/".basename("ostatki.xls"));
	$_SESSION["info_files"][] = $file;
}
?>