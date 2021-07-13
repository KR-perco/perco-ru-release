<?php
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$rsUserCompany = CUser::GetByID($USER->GetID());
$arUserCompany = $rsUserCompany->Fetch();
if ($arUserCompany["UF_SCHET"] == "")
{
	define('FPDF_FONTPATH', $_SERVER["DOCUMENT_ROOT"].'/createpdf/');
	require ('fpdf/fpdf.php');
	$textColour = array( 13, 99, 99 );
	$logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/schet-na-sertifikat.jpg";
	$logoXPos = 0;
	$logoYPos = 0;
	$logoWidth = 210;
	$logoHeight = 297;
	$company = $arUserCompany['WORK_COMPANY'].", ИНН ".$arUserCompany['UF_INN'];
	//считываем номер счета
	$f = fopen ($_SERVER["DOCUMENT_ROOT"]."/createpdf/inn.txt", "r");
	$nomer = fgets($f);
	$nol = strlen($nomer) - strlen($nomer+1);
	for($i=0;$i<$nol;$i++)
		$tmp .= "0";
	$nomer = $tmp . ($nomer+1);
	$nomer_scheta = "F-".$nomer." от ".date("d.m.Y");
	fclose($f);
	// записываем новый номер
	$f = fopen ($_SERVER["DOCUMENT_ROOT"]."/createpdf/inn.txt", "w");
	fwrite($f,$nomer);
	fclose($f);
	$file_name = "schet_id".$arUserCompany["ID"].".pdf";

	$pdf = new FPDF( 'P', 'mm', 'A4' );	// Создаем титульную страницу
	$pdf->AddFont('Futuris','','FUTN.php');	// Добавляем шрифт
	$pdf->SetFont('Futuris', '', 13);	// Устанавливаем шрифт
	$pdf->SetTextColor(0, 0, 0);	// Устанавливаем цвет текста
	$pdf->SetXY(0, 88);	// Устанавливаем координаты
	$pdf->SetTopMargin(58); // Устанавливаем отступ сверху
	$pdf->SetLeftMargin(62); // Устанавливаем отступ слева
	$pdf->AddPage();	// Создаем страницу
	$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth, $logoHeight);	// фоновое изображение
	$pdf->MultiCell(100, 12, iconv("UTF-8", "windows-1251", $nomer_scheta), 0, 'L');
	$pdf->SetXY(10, 89);	// Устанавливаем координаты
	$pdf->MultiCell(160, 12, iconv("UTF-8", "windows-1251", $company), 0, 'C');
	$pdf->Output( $file_name, "F" );

	$tmp_name = dirname($_SERVER['SCRIPT_FILENAME']) . "/" . $file_name;
	$arFields = array("name" => $file_name, "type" => "application/pdf", "tmp_name" => $tmp_name, "error" => 0, "size" => filesize($file_name));
	$fille=CFile::SaveFile($arFields, "schet");

	$arFile = CFile::GetFileArray($fille);
	$pr = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
	$filepath = CFile::MakeFileArray($pr);
	
	SetUserField ('USER', $arUserCompany["ID"], "UF_SCHET", $filepath);
	unlink($file_name);
	$id_file = $fille;
}
else
	$id_file = $arUserCompany["UF_SCHET"];
$rsFileSchet = CFile::GetByID($id_file);
$arFileSchet = $rsFileSchet->Fetch();
$schet = '/upload/' . $arFileSchet["SUBDIR"] . '/' . $arFileSchet["FILE_NAME"];
Header("Location: ".$schet, true, 301);
?>