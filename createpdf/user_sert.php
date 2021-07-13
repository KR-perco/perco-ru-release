<?
define('FPDF_FONTPATH', $_SERVER["DOCUMENT_ROOT"].'/createpdf/');
require('fpdf/fpdf.php');
function createSert($ID, $txt, $datecomp, $sert_pole, $sert_data, $logoFile, $textColour)	// ID пользователя, текст, дата, поле сертификата, поле даты сертификата, шаблон
{
	$logoXPos = 0;
	$logoYPos = 0;
	$logoWidth = 210;
	$logoHeight = 297;

	$pdf = new FPDF( 'P', 'mm', 'A4' );	// Создаем титульную страницу
	$pdf->AddFont('Palatino','','palai.php');	// Добавляем шрифт
	$pdf->SetFont( 'Palatino', '', 24 );	// Устанавливаем шрифт
	$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );	// Устанавливаем цвет текста
	$pdf->AddPage();	// Создаем страницу
	$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth, $logoHeight);	// фоновое изображение
	$pdf->SetXY(25, 138);	// Устанавливаем координаты
	$pdf->MultiCell(160, 12, iconv("UTF-8", "windows-1251", $txt), 0, 'C');
	$pdf->AddFont('Futuris','','FTR.php');	// Добавляем шрифт
	$pdf->SetFont('Futuris', '', 13);	// Устанавливаем шрифт
	$pdf->SetTextColor(0, 0, 0);	// Устанавливаем цвет текста
	$pdf->SetXY(120, 266);	// Устанавливаем координаты
	$pdf->SetRightMargin(29); // Устанавливаем отступ справа
	$pdf->Cell(0, 10, iconv("UTF-8", "windows-1251", $datecomp), 0, 1, 'R');
	$pdf->Output( "sertificat_id" . $ID . ".pdf", "F" );
	$file_name = "sertificat_id" . $ID . ".pdf";

	$tmp_name = dirname($_SERVER['SCRIPT_FILENAME']) . "/" . $file_name;
	$arFields = array("name" => $file_name, "type" => "application/pdf", "tmp_name" => $tmp_name, "error" => 0, "size" => filesize($file_name));
	$fille=CFile::SaveFile($arFields, "sertificat");

	$arFile = CFile::GetFileArray($fille);
	$pr = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
	$filepath = CFile::MakeFileArray($pr);

	SetUserField ('USER', $ID, $sert_pole, $filepath);
	$gen_day = date("d.m.Y G:i:s");
	SetUserField ('USER', $ID, $sert_data, $gen_day);
	unlink($file_name);

	$rsUserSert = CUser::GetByID($ID);
	$arUserSert = $rsUserSert->Fetch();
	$rsFileSert = CFile::GetByID($arUserSert[$sert_pole]);
	$arFileSert = $rsFileSert->Fetch();
}
?>