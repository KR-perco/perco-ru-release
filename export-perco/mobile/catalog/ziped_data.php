<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');

$map = array();
$doparray = array();
$elements = array();
$data = array();

$current_date = date("Y.m.d(H-i-s)");
mkdir('/home/d/dc178435/public_html/upload/export/'.$current_date, 0777, true);

$folder = '/home/d/dc178435/public_html/upload/export/'.$current_date;
$arhive = '/home/d/dc178435/public_html/upload/export/'.$current_date.'.zip';


//catalog - составление дерева всех элементов каталога
    $arFilter         = array('ACTIVE' => 'Y', 'IBLOCK_ID' => '60', 'GLOBAL_ACTIVE' => 'Y');
    $arSelect         = array('ID', 'NAME', 'CODE', 'DEPTH_LEVEL', 'IBLOCK_SECTION_ID');
    $arOrder          = array('DEPTH_LEVEL' => 'ASC', 'SORT' => 'ASC');
    $rsSections       = CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
    $sectionLinc      = array();
    $arResult         = array();
    $sectionLinc[0]   = &$arResult;
    while ($arSection = $rsSections->GetNext()) {

        $map['IBLOCK_SECTION_ID'] = $arSection['IBLOCK_SECTION_ID'];
        $map['ID'] = $arSection['ID'];
        $map['NAME'] = $arSection['NAME'];
        $map['CODE'] = $arSection['CODE'];

        $sectionLinc[(int)$map['IBLOCK_SECTION_ID']]['CHILD'][$map['CODE']] = $map;
        $sectionLinc[$map['ID']]                                            = &$sectionLinc[(int)$map['IBLOCK_SECTION_ID']]['CHILD'][$map['CODE']];

    }

    unset($sectionLinc);
    $arResult = $arResult['CHILD'];
//end catalog
?><pre><?var_dump($arResult)?></pre><?
?><hr color="red"><?

$elSelect = array("ID", "IBLOCK_ID", "NAME", "CODE", "DETAIL_TEXT", "PROPERTY_IMAGE", "PREVIEW_TEXT", "PROPERTY_TEXT");

foreach($arResult as $key=>$val){
    
    //элементы в разделах верхнего уровня
    $elFilter = Array("IBLOCK_ID" => "60", "SECTION_ID"=> $val['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
    $elResult = CIBlockElement::GetList(Array("SORT"=>"ASC"), $elFilter, false, false, $elSelect);
    
    $doparray = getInformation($elResult, $current_date);
    $elements[$val['CODE']] = $doparray; //массив разделов с элементами
    $elements[$val['CODE']]['NAMES'] = $val['NAME'];

    //элементы во вложенных разделах
    if ($val['CHILD']){
        $elements[$val['CODE']] = $val['CHILD']; 
        foreach ($val['CHILD'] as $element){
            $elFilter = Array("IBLOCK_ID" => "60", "SECTION_ID"=> $element['ID'], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
            $elResult = CIBlockElement::GetList(Array("SORT"=>"ASC"), $elFilter, false, false, $elSelect);
            $doparray = getInformation($elResult, $current_date);
            $elements[$val['CODE']][$element['CODE']]['ELEMENTS'] = $doparray;
        }
    }

    // комплексная система
    if(($val['CHILD']['po-kompleksnoy-sistemy-bezopasnosti-perco-s-20']['CHILD']['lokalnoe-po'])||($val['CHILD']['po-kompleksnoy-sistemy-bezopasnosti-perco-s-20']['CHILD']['setevoe-po'])){
        $setevoePO = $val['CHILD']['po-kompleksnoy-sistemy-bezopasnosti-perco-s-20']['CHILD']['setevoe-po']['ID'];
        $lokalnoePO = $val['CHILD']['po-kompleksnoy-sistemy-bezopasnosti-perco-s-20']['CHILD']['lokalnoe-po']['ID'];
        
        // сетевое ПО комплексной системы безопасности
        $elFilter = Array("IBLOCK_ID" => "60", "SECTION_ID"=> $setevoePO, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $elResult = CIBlockElement::GetList(Array("SORT"=>"ASC"), $elFilter, false, false, $elSelect);
        $doparray = getInformation($elResult, $current_date);
        $elements['kompleksnaya-sistema-bezopasnosti-perco-s-20']['po-kompleksnoy-sistemy-bezopasnosti-perco-s-20']['CHILD']['setevoe-po']['ELEMENTS'] = $doparray;

        // локальное ПО комплексной системы безопасности
        $elFilter = Array("IBLOCK_ID" => "60", "SECTION_ID"=> $lokalnoePO, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
        $elResult = CIBlockElement::GetList(Array("SORT"=>"ASC"), $elFilter, false, false, $elSelect);
        $doparray = getInformation($elResult, $current_date);
        $elements['kompleksnaya-sistema-bezopasnosti-perco-s-20']['po-kompleksnoy-sistemy-bezopasnosti-perco-s-20']['CHILD']['lokalnoe-po']['ELEMENTS'] = $doparray;

    }
}

//итоговый массив
?><pre><?var_dump($elements)?></pre><?

//запись данных в json-формате
$json_file = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/data.json';
$data = json_encode($elements, JSON_UNESCAPED_UNICODE);
$fp = fopen($json_file, "w");
fwrite($fp, $data);
fclose($fp);

//архивирование папки
zip($folder, $arhive);

//Вывод ссылки для скачивания архива
$archive = '/upload/export/'.$current_date.'.zip';
$download .= '<div>Нажмите, чтобы <a href="'.$archive.'" target="_blank" download>скачать</a></div></div>';
echo '<div id="form_result">Файл записан';
echo $download;





/* Архивирование папки с файлами */
function zip($source, $destination) {
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
function getInformation($elResult, $current_date) {
    $ar = array();
    while($ob = $elResult->GetNextElement())
    {   
        $arFields = $ob->GetFields();
        $arPropFields = $ob->GetProperties();

        $doparray["ID"] = $arFields["ID"];
        $doparray["NAME"] = $arFields["NAME"];
        $doparray["CODE"] = $arFields["CODE"];
        $doparray["DOP_NAME"] = $arPropFields["DOP_NAME"]["VALUE"];  
        $doparray["PREVIEW_TEXT"] = $arFields["PREVIEW_TEXT"];
        $doparray["DETAIL_TEXT"] = $arFields["DETAIL_TEXT"];
        $doparray["PROPERTY_TEXT_VALUE"] = $arFields["PROPERTY_TEXT_VALUE"];
        $doparray["PROPERTY_TEXT_DESCRIPTION"] = $arFields["PROPERTY_TEXT_DESCRIPTION"];



        $images = getImages($arPropFields["IMAGE_PREVIEW"]["VALUE"]);
        $doparray["IMAGE_PREVIEW"] = $images;

        $images = getImages($arFields["PROPERTY_IMAGE_VALUE"]);
        $doparray["PROPERTY_IMAGE_VALUE"] = $images;

        $properties = getProp($arPropFields["SPECIFICATIONS"]["VALUE"], $current_date);
        if($properties != NULL){
            $doparray["SPECIFICATIONS"] = $properties;
        }

        $ar[$doparray['CODE']] = $doparray;
    }
    return $ar;
}

/* Запись изображений в массив */
function getImages($images) {
    global $current_date;
    $doparray = array();
    $dopstring = '';

    $folder_images = '/home/d/dc178435/public_html/upload/export/'.$current_date.'/img';
    mkdir($folder_images, 0777, true);

    if (is_array($images)){
        $lengh = strlen($images[0]);
        if ($lengh <= 6){
            $i = 0;
            foreach ($images as $items){
                $arImagesFilter = Array("IBLOCK_ID"=>"18", "ACTIVE"=>"Y", "ID" => $items);
                $arImagesSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
                $Images = CIBlockElement::GetList(array(), $arImagesFilter, false, Array(), $arImagesSelect);
                while($obImages = $Images->GetNextElement())
                {
                    $arImagesFields = $obImages->GetProperties();
                    copyFile($arImagesFields["PREVIEW"]["VALUE"], $folder_images);
                    $doparray[''.$i]['PREVIEW'] = array_pop(explode("/", (str_replace('jpg', 'png', $arImagesFields["PREVIEW"]["VALUE"]))));
                    ++$i;
                }    
            }

            return $doparray;

        }else{
            copyFile($images[0], $folder_images);
            $dopstring = array_pop(explode("/", (str_replace('jpg', 'png', $images[0]))));
            return $dopstring;
        }
    }else{
        copyFile($images, $folder_images);
        $dopstring = array_pop(explode("/", (str_replace('jpg', 'png', $images))));
        return $dopstring;
    }
}

/* Запись спецификаций в массив */
function getProp($propId, $date) {
    $arPropFilter = Array("IBLOCK_ID"=>"19", "ACTIVE"=>"Y", "ID" => $propId);
    $arPropSelect = Array("ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_PREVIEW_PAGE");
    $Prop = CIBlockElement::GetList(array(), $arPropFilter, false, Array(), $arPropSelect);
    $i = 0; $j = 0;
    $newDocs = '';
    $name = '';
    while($obProp = $Prop->GetNextElement()){

        $arPropFields = $obProp->GetProperties();
        
        // Чертеж ->
        mkdir('/home/d/dc178435/public_html/upload/export/'.$date.'/sheme', 0777, true);
        $folder_sheme = '/home/d/dc178435/public_html/upload/export/'.$date.'/sheme';
        copyFile($arPropFields["SHEMA"]["VALUE"], $folder_sheme);
        $propertiesArray["SHEMA"] = array_pop(explode("/", (str_replace('svg', 'png', $arPropFields["SHEMA"]["VALUE"]))));

        // Стоимость ->
        $propertiesArray["PRICE"] = $arPropFields["PRICE"]["VALUE"];		

        // Загружаемые файлы ->
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
                
                $newDocs = copyFile($arPropDown["FILE"]["VALUE"][$keyFile], $folder_docs);
                $name = $arPropDown["NAME"]["VALUE"][$keyFile];
                if($newDocs != NULL){
                    $propertiesArray["DOWNLOAD"][''.$i]["VALUE"] = $newDocs;
                    $propertiesArray["DOWNLOAD"][''.$i]["NAME"] = $name;
                }
                $i++;
            }
            
        }

        // Характеристики ->
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
        return $propertiesArray;
    }
} 

/* Копирование файлов с основного сайта в отдельный каталог, для дальнейшей архивации*/
function copyFile($file, $folder) {
    set_time_limit(70);

    $path = explode('/', $file);
    if ($path[2] != 'other'){
        $file_name = array_pop($path);
        $need_file = '/home/d/dc178435/public_html'.$file;
        $newfile = $folder.'/'.$file_name;
        copy ($need_file, $newfile);
        if (getimagesize($newfile)){
            $file_name_png = str_replace('jpg', 'png', $file_name);
            $newpngfile = $folder.'/'.$file_name_png;
            imagepng(imagecreatefromstring(file_get_contents($newfile)), $newpngfile);
            unlink($newfile);
        }
    }
    return $file_name;
}
?>