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
    
$result = array();

$current_date = date("Y.m.d(H-i-s)");
mkdir('/home/d/dc178435/public_html/upload/export/'.$current_date, 0777, true);

$folder = '/home/d/dc178435/public_html/upload/export/'.$current_date;
$arhive = '/home/d/dc178435/public_html/upload/export/'.$current_date.'.zip';

$arSelect = array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE", "SORT", "DETAIL_TEXT", "PROPERTY_IMAGE");
$arFilter = Array("IBLOCK_ID"=> 60, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
while($ob = $res->GetNextElement())
{
    $arFields = $ob->GetFields();
    $arPropFields = $ob->GetProperties();
    
    $result[$arFields['CODE']]['name'] = $arFields['NAME'];
    //$result['code'] = $arFields['CODE'];

    $properties = getProps($arPropFields["SPECIFICATIONS"]["VALUE"], $current_date);
    if($properties != NULL){
        $result[$arFields['CODE']]["download"] = $properties["download"];
    }
    
}

?><pre><?var_dump($result)?></pre><?

$json_file = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/data.json';

$data = json_encode($result, JSON_UNESCAPED_UNICODE);
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




/* Запись спецификаций в массив */
function getProps($propId, $date) {
    $arPropFilter = Array("IBLOCK_ID"=>"19", "ACTIVE"=>"Y", "ID" => $propId);
    $arPropSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
    $Prop = CIBlockElement::GetList(array(), $arPropFilter, false, Array(), $arPropSelect);
    $i = 0;
    while($obProp = $Prop->GetNextElement()){

        $arPropFields = $obProp->GetProperties();

        mkdir('/home/d/dc178435/public_html/upload/export/'.$date.'/docs', 0777, true);
        $folder_docs = '/home/d/dc178435/public_html/upload/export/'.$date.'/docs';
        if ($arPropFields["DOWNLOADS"]["VALUE"])
        {
            $arFilter = Array("IBLOCK_ID"=>"21", "ACTIVE"=>"Y", "SECTION_ID" => $arPropFields["DOWNLOADS"]["VALUE"]);
            $res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter);
            
            while($ob = $res->GetNextElement())
            {
                $arPropDown = $ob->GetProperties();
                $keyFile = array_search(LANGUAGE_ID, $arPropDown["FILE"]["DESCRIPTION"]);
                if($keyFile === false)
                    continue;
                $value = copyDocss($arPropDown["FILE"]["VALUE"][$keyFile], $folder_docs);
                $name = $arPropDown["NAME"]["VALUE"][$keyFile];

                $size = filesize('/home/d/dc178435/public_html'.$value);
                if($value != NULL){
                    $propertiesArray["download"][''.$i]["value"] = $value;
                    $propertiesArray["download"][''.$i]["name"] = $name;
                    $propertiesArray["download"][''.$i]["size"] = $size;
                }
                $i++;
            }
        }
            
        return $propertiesArray;
    }
} 



function copyDocss($file, $folder) {
    set_time_limit(70);
    $path = explode('/', $file);
    if ($path[2] != 'other'){
        //$need_file = '/home/d/dc178435/public_html'.$file;
        //$newfile = $folder.'/'.$file_name;
        //copy ($need_file, $newfile);
        return $file; 
    }
}
?>