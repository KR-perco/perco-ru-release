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
if (empty($_POST["fields"])){
    echo ('<div id="loader-error">Please select at least one field to upload!</div>');
    exit;
}

if (empty($_POST["product"])){
    echo ('<div id="loader-error">Please select at least one item to unload!</div>');
    exit;
}

$map = array();
$map_sec = array();
$elements = array();
$data = array();

$current_date = date("Y.m.d(H-i-s)");
mkdir('/home/d/dc178435/public_html/upload/export/'.$current_date, 0777, true);

$folder = '/home/d/dc178435/public_html/upload/export/'.$current_date;
$arhive = '/home/d/dc178435/public_html/upload/export/'.$current_date.'.zip';


$arFilter = Array('IBLOCK_ID'=> '60', 'GLOBAL_ACTIVE'=>'Y');
$db_list = CIBlockSection::GetList(Array("left_margin"=>"asc"), $arFilter, true);

while($ar_result = $db_list->GetNext())
{
    if (in_array($ar_result['CODE'], $_POST["product"])){
        $map[''.$ar_result['ID']] = $ar_result;
    }
}

$elSelect = array("ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "CODE");



if (in_array("anouns", $_POST["fields"])){
    array_push($elSelect, "PREVIEW_TEXT");
}

if (in_array("photo", $_POST["fields"])){
    array_push($elSelect, "PROPERTY_IMAGE");
    mkdir('/home/d/dc178435/public_html/upload/export/'.$current_date.'/images', 0777, true);
    $folder_images = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/images';
}

if (in_array("description", $_POST["fields"])){
    array_push($elSelect, "PROPERTY_TEXT");
}

foreach($map as $key=>$val){
    $elFilter = Array("IBLOCK_ID" => "60", "SECTION_ID"=> $val['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $elResult = CIBlockElement::GetList(Array(), $elFilter, false, false, $elSelect);
    while($ob = $elResult->GetNextElement())
    {
        $arFields = $ob->GetFields();
        $arPropFields = $ob->GetProperties();

        if (in_array("photo", $_POST["fields"])){
            $lengh = strlen($arFields["PROPERTY_IMAGE_VALUE"][0]);
            if ($lengh <= 6){
                $images = getImages($arFields["PROPERTY_IMAGE_VALUE"], $folder_images);
				
				/*echo '<pre>!!!';
				print_r($arFields);
				echo '!!!</pre>';*/
				
                if($images != NULL){
                    $arFields["PROPERTY_IMAGE_VALUE"] = $images;
                }
            }else{

                $path = explode("/", $arFields["PROPERTY_IMAGE_VALUE"][0]);
                $file_name = array_pop($path);
                $file = '/home/d/dc178435/public_html'.$arFields["PROPERTY_IMAGE_VALUE"][0];
                $newfile = $folder_images.'/'.$file_name;
                copy ($file, $newfile);

                $arFields["PROPERTY_IMAGE_VALUE"] = $folder_images.'/'.$file_name;
            }

        }
		

        $properties = getProp($arPropFields["SPECIFICATIONS"]["VALUE"], $current_date);
        if($properties != NULL){
            $arFields["SPECIFICATIONS"] = $properties;
        }

        $res = CIBlockSection::GetByID($arFields['IBLOCK_SECTION_ID']);  
        $ar_res = $res->GetNext(); 
       
        //$elements[''.$arFields['IBLOCK_SECTION_ID']][$arFields['CODE']] = $arFields;
        $elements[''.$ar_res['CODE']][$arFields['CODE']] = $arFields; //массив разделов с элементами
        
    }
}

if (!empty($_POST["excel"])){
    include 'data_excel.php';
}

$json_file = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/data.json';

$data = json_encode($elements, JSON_UNESCAPED_UNICODE);
//$data = json_encode($elements);

$fp = fopen($json_file, "w");
fwrite($fp, $data);

fclose($fp);

zip($folder, $arhive);


echo '<div id="form_result">Файл сохранён.';
$nname = 'скачать';
$ffile = '/upload/export/'.$current_date.'.zip';
$ggoogle = "onclick=\"ga('send', 'event', {'eventCategory': 'Поддержка покупателя', 'eventAction': 'download', 'eventLabel': '".$ffile."'});\"";
$download .= '<div> <a href="'.$ffile.'" target="_blank" '.$ggoogle.' download>'.$nname.'</a></div></div>';
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

/* Запись изображений в массив */
function getImages($array, $folder) {
    $i = 0;
	// echo'array:<br>';
	// echo '<pre>';
	// print_r($array);
	// echo '</pre>';
	// echo'folder:<br>';
	// echo '<pre>';
	// print_r($folder);
	// echo '</pre>';
    foreach ($array as $items){
		//echo'цикл:<br>';
        $arImagesFilter = Array("IBLOCK_ID"=>"18", "ACTIVE"=>"Y", "ID" => $items);
        $arImagesSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
        $Images = CIBlockElement::GetList(array(), $arImagesFilter, false, Array(), $arImagesSelect);
		// echo '<pre>';
		// print_r($arImagesFilter);
		// echo '</pre>';
        while($obImages = $Images->GetNextElement())
        {
            $arImagesFields = $obImages->GetProperties();
            //$imagesArray[''.$i]['PREVIEW'] = $arImagesFields["PREVIEW"]["VALUE"];
            //$imagesArray[''.$i]['FULL'] = $arImagesFields["FULL"]["VALUE"];

            $path = explode("/", $arImagesFields["PREVIEW"]["VALUE"]);
            $file_name = array_pop($path);
            $file = '/home/d/dc178435/public_html'.$arImagesFields["PREVIEW"]["VALUE"];
            $newfile = $folder.'/'.$file_name;
            copy ($file, $newfile);

            $imagesArray[''.$i]['PREVIEW'] = 'images/'.$file_name;

            $path = explode("/", $arImagesFields["FULL"]["VALUE"]);
            $file_name = array_pop($path);
            $file = '/home/d/dc178435/public_html'.$arImagesFields["FULL"]["VALUE"];
            $newfile = $folder.'/'.$file_name;
            copy ($file, $newfile);

            $imagesArray[''.$i]['FULL'] = 'images/'.$file_name;
            
            ++$i;
        }
    }
    return $imagesArray;
}

/* Запись спецификаций в массив */
function getProp($propId, $date) {
    $arPropFilter = Array("IBLOCK_ID"=>"19", "ACTIVE"=>"Y", "ID" => $propId);
    $arPropSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
    $Prop = CIBlockElement::GetList(array(), $arPropFilter, false, Array(), $arPropSelect);
    $i = 0; $j = 0;
    while($obProp = $Prop->GetNextElement()){

        $arPropFields = $obProp->GetProperties();
        
        // Чертеж ->
        if (in_array("sheme", $_POST["fields"])){
            mkdir('/home/d/dc178435/public_html/upload/export/'.$date.'/sheme', 0777, true);
            $folder_sheme = '/home/d/dc178435/public_html/upload/export/'.$date.'/sheme';
            $propertiesArray["SHEMA"] = copySheme($arPropFields["SHEMA"]["VALUE"], $folder_sheme);
        }

        // Стоимость ->
        if (in_array("cost", $_POST["fields"])){
            $propertiesArray["PRICE"] = $arPropFields["PRICE"]["VALUE"];		
        }

        // Загружаемые файлы ->
        if (in_array("docs", $_POST["fields"])){
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
                    $newDocs = copyDocs($arPropDown["FILE"]["VALUE"][$keyFile], $folder_docs);
                    if($newDocs != NULL){
                        $propertiesArray["DOWNLOAD"][''.$i] = $newDocs;
                    }
                    $i++;
                }
            }
            
        }

        // Характеристики ->
        if (in_array("characteristics", $_POST["fields"])){
            foreach($arPropFields["SPECIFICATIONS"]["VALUE"] as $val)
            {
                $arFilter = Array("IBLOCK_ID"=>"66", "ACTIVE"=>"Y", "ID" => $val);
                $res = CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter);
                while($spec = $res->GetNextElement())
                {
                    $arSpec = $spec->GetProperties();
                    
                    $propertiesArray["CHARACTERISTICS"][''.$j]["VALUE"] = $arSpec["ru"]["VALUE"];
                    $propertiesArray["CHARACTERISTICS"][''.$j]["DESCRIPTION"] = $arSpec["ru"]["DESCRIPTION"];
                    $j++;
                }	
            }    
        } 

        return $propertiesArray;
    }
} 

function copySheme($file, $folder) {
    $path = explode('/', $file);
    $file_name = array_pop($path);
    $need_file = '/home/d/dc178435/public_html'.$file;
    $newfile = $folder.'/'.$file_name;
    copy ($need_file, $newfile);
    $file_path = 'sheme/'.$file_name;
    return $file_path;
}

function copyDocs($file, $folder) {
    set_time_limit(70);
    $path = explode('/', $file);
    if ($path[2] != 'other'){
        $file_name = array_pop($path);
        $need_file = '/home/d/dc178435/public_html'.$file;
        $newfile = $folder.'/'.$file_name;
        copy ($need_file, $newfile);
        $file_path = 'docs/'.$file_name;
        return $file_path; 
    }
}
?>