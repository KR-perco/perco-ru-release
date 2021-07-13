<?
$rsFiles = CIBlockElement::GetList(array("SORT"=>"asc"), array( "IBLOCK_CODE"=>"files", "SECTION_CODE" => "sistema-kontrolya-dostupa-perco-web"));	// перечень полей необходимых в результате выборки
if (intval($rsFiles->SelectedRowsCount()) > 0)
{
	$version = "";
	$list_files = "";
	while($arFiles = $rsFiles->GetNextElement())
	{
		$ico = "";
		$arPropsFile = $arFiles->GetProperties();
		$keyName = array_search(LANGUAGE_ID, $arPropsFile["NAME"]["DESCRIPTION"]);
		$keyFile = array_search(LANGUAGE_ID, $arPropsFile["FILE"]["DESCRIPTION"]);
		$name = $arPropsFile["NAME"]["VALUE"][$keyName];
		$file = $arPropsFile["FILE"]["VALUE"][$keyFile];
		$fSize = '('.printFileInfo($file, "size").')&nbsp;';
		$date = printFileInfo($file, "date");
		
		switch($arPropsFile["ICON"]["VALUE"])
			{
				case "pdf":
					$ico = "/images/icons/pdf.svg";
					break;
				case "dwf":
					if (LANGUAGE_ID == "ru")
						$AutoCadtitle = 'для просмотра должна быть установлена программа Autodesk DWF Viewer<br />';
					$ico = "/images/icons/dwf.svg";
					break;
				case "dwg":
					$ico = "/images/icons/dwg.svg";
					break;
				default:
					$ico = "/images/icons/download.svg";
					break;
			}
		if ($arPropsFile["INSTAL_VERSION"]["VALUE"])
			$version = ", версия ".$arPropsFile["INSTAL_VERSION"]["VALUE"];
		$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
		$list_files .= '<div class="list_files"><div class="icon"><img alt="Иконка" src="'.$ico.'" /></div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.$version.'</a> <span class="color">'.$fSize.' — '.$date.'</span></div>';
	}
	$php_result = $list_files;
}
$rsFiles = CIBlockElement::GetList(array("SORT"=>"asc"), array( "IBLOCK_CODE"=>"files", "SECTION_CODE" => "standartnyy-paket-po-i-dopolnitelnye-moduli"));	// перечень полей необходимых в результате выборки
if (intval($rsFiles->SelectedRowsCount()) > 0)
{
	$version = "";
	$list_files = "";
	while($arFiles = $rsFiles->GetNextElement())
	{
		$ico = "";
		$arPropsFile = $arFiles->GetProperties();
		$keyName = array_search(LANGUAGE_ID, $arPropsFile["NAME"]["DESCRIPTION"]);
		$keyFile = array_search(LANGUAGE_ID, $arPropsFile["FILE"]["DESCRIPTION"]);
		$name = $arPropsFile["NAME"]["VALUE"][$keyName];
		$file = $arPropsFile["FILE"]["VALUE"][$keyFile];
		$fSize = '('.printFileInfo($file, "size").')&nbsp;';
		$date = printFileInfo($file, "date");
		
		$ico = "/images/icons/download.svg";

		if ($arPropsFile["INSTAL_VERSION"]["VALUE"])
			$version = ", версия ".$arPropsFile["INSTAL_VERSION"]["VALUE"];
		$google = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$file."'});\"";
		$list_files .= '<div class="list_files"><div class="icon"><img alt="Иконка" src="'.$ico.'" /></div><a href="'.$file.'" target="_blank" '.$google.' download>'.$name.$version.'</a> <span class="color">'.$fSize.' — '.$date.'</span></div>';
	}
}
$php_result = "<div>".$php_result.$list_files."</div>";
?>