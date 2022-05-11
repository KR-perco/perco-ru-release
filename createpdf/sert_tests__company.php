<?
define('FPDF_FONTPATH', $_SERVER["DOCUMENT_ROOT"].'/createpdf/'); 
// require_once('fpdf/fpdf.php');
require_once('tfpdf/tfpdf.php');

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
	$withToBreakLine = 130;
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

	$pdf = new tFPDF( 'P', 'mm', 'A4' );	// Создаем титульную страницу
	// $pdf->AddFont('Futuris','','FTR.php');	// Старый шрифт 
	$pdf->AddFont('FuturaNewBook-Reg','','FuturaNewBook-Reg.ttf', true); 
	$pdf->SetFont('FuturaNewBook-Reg', '', 22);
	$pdf->SetTextColor( $textColour[0], $textColour[1], $textColour[2] );
	$pdf->AddPage();	// Создаем страницу
	$pdf->Image($logoFile, $logoXPos, $logoYPos, $logoWidth, $logoHeight);	// фоновое изображение
	// Номер сертификата
	if ($sert == "adsc")
		$pdf->SetXY(25, 92);
	else
		$pdf->SetXY(25, 99);
	$pdf->MultiCell(160, 12, $nomer_sert, 0, 'C');
	// Название компании, город (если есть)
	$pdf->AddFont('FuturaNew','','FuturaNewDemi.ttf', true);
	$pdf->SetFont('FuturaNew', '', 20);	
	$txt_width = $pdf->GetStringWidth($txt); 
	if ($txt_width <= $withToBreakLine)
		if ($sert == "sc")
			$pdf->SetXY(25, 139); 
		else if ($sert == "stp")
			$pdf->SetXY(25, 151); 
		else if ($sert == "adsc")
			$pdf->SetXY(25, 151); 
		else 
			$pdf->SetXY(25, 153); 
	else 
		if ($sert == "sc")
			$pdf->SetXY(25, 135); 
		else if ($sert == "stp")
			$pdf->SetXY(25, 147); 
		else if ($sert == "adsc")
			$pdf->SetXY(25, 147); 
		else 
			$pdf->SetXY(25, 149); 
	$pdf->SetLeftMargin(55);
	$pdf->MultiCell(100, 8, $txt, 0, 'C');
	// Подпись "Действителен до"
	$pdf->AddFont('FuturaNewBook-Reg','','FuturaNewBook-Reg.ttf', true);	// Добавляем шрифт
	$pdf->SetFont('FuturaNewBook-Reg', '', 13);	// Устанавливаем шрифт
	$pdf->SetTextColor(0, 0, 0);
	$pdf->SetXY(125, 265);
	$pdf->SetRightMargin(29);
	$pdf->Cell(0, 10, $datecomp, 0, 1, 'R');
	$pdf->Output( "sertificat_id" . $ID . ".pdf", "F" );
	$file_name = "sertificat_id" . $ID . ".pdf";

	$tmp_name = dirname($_SERVER['SCRIPT_FILENAME']) . "/" . $file_name;
	$arFields = array("name" => $file_name, "type" => "application/pdf", "tmp_name" => $tmp_name, "error" => 0, "size" => filesize($file_name));
	// На время тестирования кладём в папку "tests-company-serts"
	$fille = CFile::SaveFile($arFields, "sertificat");

	$arFile = CFile::GetFileArray($fille);
	$pr = '/upload/'.$arFile["SUBDIR"].'/'.$arFile["FILE_NAME"];
	$filepath = CFile::MakeFileArray($pr);

	SetUserField ("USER", $ID, $sert_pole, $filepath);
	unlink($file_name);
 
	echo '<a href='.$pr.' target="_blank">Готовый сертификат</a>';

	$rsCompanySert = CUser::GetByID($ID);
	$arCompanySert = $rsCompanySert->Fetch();
	$rsFileSert = CFile::GetByID($arCompanySert[$sert_pole]);
	$arFileSert = $rsFileSert->Fetch();
}
?>