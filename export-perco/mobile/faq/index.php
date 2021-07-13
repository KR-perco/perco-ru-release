<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
?>

<script type="text/javascript">
	$(document).ready(function(){
        $('#loader').hide();
        $('#loader-text').hide(); 
	});
</script>

<?
$map = array();
$map_sec = array();
$elements = array();
$data = array();
$type = array();
$tmp = array();

$current_date = date("Y.m.d(H-i-s)");
mkdir('/home/d/dc178435/public_html/upload/export/'.$current_date, 0777, true);

$folder = '/home/d/dc178435/public_html/upload/export/'.$current_date;
$arhive = '/home/d/dc178435/public_html/upload/export/'.$current_date.'.zip';


$arFilter = Array('IBLOCK_ID'=> '83', 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter, true);

while($ar_result = $db_list->GetNext())
{
    if ($ar_result['IBLOCK_SECTION_ID']){
        $map[''.$ar_result['IBLOCK_SECTION_ID']]['ITEMS'][''.$ar_result['ID']] = $ar_result;
        $elFilter = Array("IBLOCK_ID" => "83", "SECTION_ID"=> $ar_result['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $elSelect = Array("ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "PREVIEW_TEXT");
        $elResult = CIBlockElement::GetList(Array(), $elFilter, false, false, $elSelect);
        while($ob = $elResult->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $map[''.$ar_result['IBLOCK_SECTION_ID']]['ITEMS'][''.$ar_result['ID']]['ELEMENTS'][''.$arFields['ID']] = $arFields;
        }
    } else {
        $map[''.$ar_result['ID']] = $ar_result;
        $elFilter = Array("IBLOCK_ID" => "83", "SECTION_ID"=> $ar_result['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $elSelect = Array("ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "PREVIEW_TEXT");
        $elResult = CIBlockElement::GetList(Array(), $elFilter, false, false, $elSelect);
        while($ob = $elResult->GetNextElement())
        {
            $arFields = $ob->GetFields();
            $map[''.$ar_result['ID']]['ELEMENTS'][''.$arFields['ID']] = $arFields;
        }
    }
}

?><pre><?var_dump($map);?></pre><?





$json_file = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/data.json';

$data = json_encode($map, JSON_UNESCAPED_UNICODE);
//$data = json_encode($elements);

$fp = fopen($json_file, "w");
fwrite($fp, $data);

fclose($fp);

zip($folder, $arhive);


echo '<div id="form_result">Файл записан';
$nname = 'скачать';
$ffile = '/upload/export/'.$current_date.'.zip';
$ggoogle = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$ffile."'});\"";
$download .= '<div>Нажмите, чтобы <a href="'.$ffile.'" target="_blank" '.$ggoogle.' download>'.$nname.'</a></div></div>';
echo $download;



function zip($source, $destination)
{
    // Initialize archive object
    $zip = new ZipArchive();
    $zip->open($destination, ZipArchive::CREATE | ZipArchive::OVERWRITE);
    
    // Create recursive directory iterator
    /// @var SplFileInfo[] $files
    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($source),
        RecursiveIteratorIterator::LEAVES_ONLY
    );
    
    foreach ($files as $name => $file)
    {
        // Skip directories (they would be added automatically)
        if (!$file->isDir())
        {
            // Get real and relative path for current file
            $filePath = $file->getRealPath();
            $relativePath = substr($filePath, strlen($source) + 1);
    
            // Add current file to archive
            $zip->addFile($filePath, $relativePath);
        }
    }
    
    // Zip archive will be created only after closing object
    $zip->close();
};
?>