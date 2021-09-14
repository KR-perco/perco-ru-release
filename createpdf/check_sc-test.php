<?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
require($_SERVER["DOCUMENT_ROOT"]."/createpdf/sert_tests__company.php");	// создание сертификата 
 
        echo'ВЫКЛ создание сертификата <br><br>';
        // echo'ВКЛ создание сертификата <br><br>';
		$ID = strip_tags(trim($_GET["ID"])); 
		$txt = "ТОО «Бақ-Альянс»\n (Нір-Сұлтан)";
		$datecomp = "Сертификат действителен до 14.09.2022 года";
		$sert_pole = "UF_SERT_D";
		
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-adsc-shablon.jpg";
		// $sert = "adsc";
		// $textColour = array( 155, 97, 0 );
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-sc-shablon.jpg";
		// $sert = "sc";
		// $textColour = array( 39, 87, 164 );
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-stp-shablon.jpg";
		// $sert = "stp";
		// $textColour = array( 123, 121, 119 );
		// $logoFile = $_SERVER["DOCUMENT_ROOT"]."/createpdf/sertificat-ai-shablon.jpg";
		// $sert = "ai";
		// $textColour = array( 0, 102, 110 );
		
		echo "Компания: $txt <br>";
		echo "Действие сертификата: $datecomp <br>";
		echo "Пользовательское поле: $sert_pole <br>";
		echo "Расположение подложки: $logoFile <br>";
		echo "Цвет: <br>";
		echo $textColour[0]." ".$textColour[1]." ".$textColour[2]."<br>";
		echo "Тип сертификата: $sert"; 

		// createSert($ID, $txt, $datecomp, $sert_pole, $logoFile, $sert, $textColour);	// создание сертификата  

// http://www.perco.local/createpdf/check_sc.php?ID=3931&CERT=D  
?>
