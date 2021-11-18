<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"].'/createpdf/sert_tests__manager.php');	// создание сертификата 
 
		echo'ВЫКЛ создание сертификата <br><br>'; 

		$ID = strip_tags(trim($_GET["ID"]));
		$txt = "ТОО MMS Group\n Әли Асқарұлы";
		$datecomp = "Свидетельство действительно до 25 марта 2022 года";
		$sert_pole = "UF_SERT_D";
		$sert_pole_date = "UF_SERT_DATE";

		// $fileTemplate = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-sc-user-shablon.jpg";
		// $sert_type = "sc";
		// $textColour = array( 39, 87, 164 );
		
		// $fileTemplate = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-stp-user-shablon.jpg";
		// $sert_type = "stp";
		// $textColour = array( 123, 121, 119 ); 

		// $fileTemplate = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-adsc-user-shablon.jpg";
		// $sert_type = "adsc";
		// $textColour = array( 95, 79, 124 );

		// $fileTemplate = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-ai-user-shablon.jpg";
		// $sert_type = "ai";
		// $textColour = array( 0, 102, 110 );

		echo "ID: $ID  <br>";
		echo "Компания: $txt <br>";
		echo "Действие сертификата: $datecomp <br>";
		echo "Пользовательское поле: $sert_pole <br>";
		echo "Пользовательское поле - дата: $sert_pole_date <br>";
		echo "Расположение подложки: $fileTemplate <br>";
		echo "Тип сертификата: $sert_type<br>"; 
		echo "Цвет: <br>";
		echo $textColour[0]." ".$textColour[1]." ".$textColour[2]."<br>";

		// создание сертификата  
		// COMPANY 
		// createSert($ID, $txt, $datecomp, $sert_pole, $fileTemplate, $sert_type, $textColour);	
		// USER 
		// createSert($ID, $txt, $datecomp, $sert_pole, $sert_pole_date, $fileTemplate, $textColour);

	 

		// createSert($ID, $txt, $datecomp, $sert_pole, $sert_pole_date, $fileTemplate, $textColour);



		
		
// Тест моего ID 4196
// https://www.perco.local/createpdf/check_user-test.php?ID=4196&CERT=D
?>
