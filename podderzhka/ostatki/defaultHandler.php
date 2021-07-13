<?
session_start();
if(!empty($_FILES))
{
	// Файл передан через обычный массив $_FILES
	$file['tmp_name'] = $_FILES['file']['tmp_name'][0];
	$file['name'] = $_FILES['file']['name'][0];
	$file['size'] = $_FILES['file']['size'][0];
	if (move_uploaded_file($file['tmp_name'],"files/"."ostatki.xls"))
	{
		$_SESSION["info_files"][] = $file;
	}
}
?>