<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
?>


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


$arSelect = Array("ID", "IBLOCK_ID", "NAME", "PROPERTY_*");
$arFilter = Array("IBLOCK_ID"=>'64', "SECTION_ID"=>'1848');
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, array());



while($ob = $res->GetNextElement()){
    $tmp = array();
    $i = 0;
    $arProps = $ob->GetProperties(); 
    $arFields = $ob->GetFields();
    /*?><pre><?var_dump($arFields);?></pre><?
    ?><pre><?var_dump($arProps["TEXT"]["VALUE"]);?></pre><?*/
    
    $tmp['NAME'] = $arFields['NAME'];
    $tmp['CODE'] = $arFields['CODE'];
    $tmp["PREVIEW_IMAGE"] = $arProps["IMAGE"]["VALUE"];
    $tmp["PREVIEW_TEXT"] = $arFields["PREVIEW_TEXT"];
    $tmp["DETAIL_TEXT"]  = $arFields["DETAIL_TEXT"];
    foreach ($arProps["TEXT"]["VALUE"] as $tab){
        echo gettype($arFields["PREVIEW_TEXT"]), "\n";
        echo gettype($tab["TEXT"]), "\n";
        //echo $tab["TEXT"], '\n';
        $tmp["TEXT"]["VALUE"][$i] = html_entity_decode($tab["TEXT"]);
        $i++;
        //echo $tab["TEXT"];
    }
    $tmp["TEXT"]["DESCRIPTION"]  = $arProps["TEXT"]["DESCRIPTION"];
    $elements[$tmp['CODE']] = $tmp;
    $i++;
}

?><pre><?var_dump($elements);?></pre><?

function getGallery($array){
    $i = 0;
    foreach ($array as $item){
        $arImagesFilter = Array("IBLOCK_ID"=>"65", "ACTIVE"=>"Y", "ID" => $item);
        $Images = CIBlockElement::GetList(array(), $arImagesFilter, false, Array());
        while($obImages = $Images->GetNextElement())
        {
            $arFields = $obImages->GetFields();
            $result[$i] = $arFields['NAME'];
            ++$i;
        }
    }
    return $result;
}

$json_file = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/data.json';

$data = json_encode($elements, JSON_UNESCAPED_UNICODE);
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