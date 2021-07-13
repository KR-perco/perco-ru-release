<?
define('FPDF_FONTPATH', $_SERVER["DOCUMENT_ROOT"].'/createpdf/');
require_once('fpdf/fpdf.php');

function createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour)	// ID пользователя, текст, дата, поле сертификата, шаблон, тип сертификата
{
	$logoXPos = 0;
	$logoYPos = 0;
	$logoWidth = 210;
	$logoHeight = 297;
	$tmp = "";
	//считываем номер счета
	$f = fopen ($_SERVER["DOCUMENT_ROOT"]."/createpdf/nomer_".$sert.".txt", "r");
	$nomer = fgets($f);
	$nol = strlen($nomer) - strlen($nomer+1);
	for($i=0;$i<$nol;$i++)
		$tmp .= "0";
	$nomer = $tmp . ($nomer+1);
	$nomer_sert = $nomer;
	fclose($f);
	// записываем новый номер
	$f = fopen ($_SERVER["DOCUMENT_ROOT"]."/createpdf/nomer_".$sert.".txt", "w");
	fwrite($f,$nomer);
	fclose($f);

	$pdf = new FPDF( 'P', 'mm', 'A4' );	// Создаем титульную страницу
	$pdf->AddFont('Futuris','','FTR.php');	// Добавляем шрифт
	$pdf->SetFont('Futuris', '', 22);	// Устанавливаем шрифт
	$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );	// Устанавливаем цвет текста
	$pdf->AddPage();	// Создаем страницу
	$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth, $logoHeight);	// фоновое изображение
	if ($sert == "adsc")
		$pdf->SetXY(25, 91);	// Устанавливаем коор
	else
		$pdf->SetXY(25, 96);	// Устанавливаем координатыдинаты
	$pdf->MultiCell(160, 12, iconv("UTF-8", "windows-1251", $nomer_sert), 0, 'C');
	$pdf->AddFont('FuturisExtra','','FuturisExtra.php');	// Добавляем шрифт
	$pdf->SetFont('FuturisExtra', '', 18);	// Устанавливаем шрифт
	if ($sert == "sc")
		$pdf->SetXY(25, 133);	// Устанавливаем координаты
	else
		$pdf->SetXY(25, 147);	// Устанавливаем координаты
	$pdf->MultiCell(160, 8, iconv("UTF-8", "windows-1251", $txt), 0, 'C');
	$pdf->AddFont('Futuris','','FTR.php');	// Добавляем шрифт
	$pdf->SetFont( 'Futuris', '', 13);	// Устанавливаем шрифт
	$pdf->SetTextColor(0, 0, 0);	// Устанавливаем цвет текста
	$pdf->SetXY(125, 265);	// Устанавливаем координаты
	$pdf->SetRightMargin(29); // Устанавливаем отступ справа
	$pdf->Cell(0, 10, iconv("UTF-8", "windows-1251", $datecomp), 0, 1, 'R');
	$pdf->Output( "sertificat_id" . $ID . ".pdf", "F" );
	$file_name = "sertificat_id" . $ID . ".pdf";

	$tmp_name = dirname($_SERVER['SCRIPT_FILENAME']) . "/" . $file_name;
	$arFields = array("name" => $file_name, "type" => "application/pdf", "tmp_name" => $tmp_name, "error" => 0, "size" => filesize($file_name));
	$fille = CFile::SaveFile($arFields, "sertificat");

	$arFile = CFile::GetFileArray($fille);
	$pr = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
	$filepath = CFile::MakeFileArray($pr);

	SetUserField ("USER", $ID, $sert_pole, $filepath);
	unlink($file_name);

	$rsCompanySert = CUser::GetByID($ID);
	$arCompanySert = $rsCompanySert->Fetch();
	$rsFileSert = CFile::GetByID($arCompanySert[$sert_pole]);
	$arFileSert = $rsFileSert->Fetch();
}
?>