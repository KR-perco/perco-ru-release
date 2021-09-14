<?
define('FPDF_FONTPATH', $_SERVER["DOCUMENT_ROOT"].'/createpdf/');
// require('fpdf/fpdf.php'); 
require_once('tfpdf/tfpdf.php');

function createSert($ID, $txt, $datecomp, $sert_pole, $sert_pole_date, $fileTemplate, $textColour)	// ID пользователя, текст, дата, поле сертификата, поле даты сертификата, шаблон
{
	$logoXPos = 0;
	$logoYPos = 0;
	$logoWidth = 210;
	$logoHeight = 297;

	$pdf = new tFPDF( 'P', 'mm', 'A4' );	// Создаем титульную страницу
	// $pdf->AddFont('Palatino','','palai.php');	// Добавляем шрифт
	$pdf->AddFont('FuturaNew','','FuturaNewDemi.ttf', true);	// Добавляем шрифт
	$pdf->SetFont( 'FuturaNew', '', 24 );	// Устанавливаем шрифт
	$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );	// Устанавливаем цвет текста
	$pdf->AddPage();	// Создаем страницу
	$pdf->Image($fileTemplate, $logoXPos, $logoYPos, $logoWidth, $logoHeight);	// фоновое изображение
	$pdf->SetXY(25, 147);	// Устанавливаем координаты
	$pdf->MultiCell(160, 12, $txt, 0, 'C');
	$pdf->AddFont('FuturaNewBook-Reg','','FuturaNewBook-Reg.ttf', true);	// Добавляем шрифт
	$pdf->SetFont('FuturaNewBook-Reg', '', 13);	// Устанавливаем шрифт
	$pdf->SetTextColor(0, 0, 0);	// Устанавливаем цвет текста
	$pdf->SetXY(120, 266);	// Устанавливаем координаты
	$pdf->SetRightMargin(29); // Устанавливаем отступ справа
	$pdf->Cell(0, 10, $datecomp, 0, 1, 'R');
	$pdf->Output( "sertificat_id" . $ID . ".pdf", "F" );

	// Сохраняем PDF
	$file_name = "sertificat_id" . $ID . ".pdf"; 
	$tmp_name = dirname($_SERVER['SCRIPT_FILENAME']) . "/" . $file_name;
	$arFields = array("name" => $file_name, "type" => "application/pdf", "tmp_name" => $tmp_name, "error" => 0, "size" => filesize($file_name));
	// На время тестирования кладём в папку "tests-user-serts"
	$fille = CFile::SaveFile($arFields, "sertificat");
	
	// Привязываем файл к пользователю/компании
	$arFile = CFile::GetFileArray($fille);
	$pr = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
	$filepath = CFile::MakeFileArray($pr); 
	SetUserField ('USER', $ID, $sert_pole, $filepath);
	$gen_day = date("d.m.Y G:i:s");
	SetUserField ('USER', $ID, $sert_pole_date, $gen_day);
	unlink($file_name);

	$rsUserSert = CUser::GetByID($ID);
	$arUserSert = $rsUserSert->Fetch();
	$rsFileSert = CFile::GetByID($arUserSert[$sert_pole]);
	$arFileSert = $rsFileSert->Fetch();
}
?>