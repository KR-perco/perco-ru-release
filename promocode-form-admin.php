<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Промокод - заявки PERCo");
$APPLICATION->SetPageProperty("title", "Системы безопасности – цены, купить комплексные системы безопасности, производство систем безопасности");
$APPLICATION->SetPageProperty("description", "PERCo – крупнейший российский производитель оборудования и систем безопасности (СКУД - системы контроля доступа, видеонаблюдение, охранно-пожарная сигнализация, турникеты, считыватели, электромеханические замки)");
$APPLICATION->SetPageProperty("keywords", "системы безопасности, контроль доступа, системы контроля доступа, скуд, скд, турникеты, охранно пожарная сигнализация, пожарная безопасность, видеонаблюдение, системы видеонаблюдения, учет рабочего времени");

$APPLICATION->AddHeadScript("/scripts/pages/main.js"); // подключение скриптов
$APPLICATION->SetAdditionalCSS("/css/form.css"); // подключение стилей

if($USER->IsAuthorized()) {
    
    
    echo'<h1>Список заявок на промокод</h1>';
    
    
    $file = file_get_contents('promocode-forn-in.json'); // Открыть файл 
    $taskList = json_decode($file, true); // Декодировать в массив
    unset($file); // Очистить переменную $file
    
    foreach ($taskList as $tasck) {
        $textPrint = '<div style="margin:20px; padding:10px; background-color:#ededed;"><span>Компания: '. $tasck[session][0][company]. '</span><br>'. '<span>Контактное лицо: '. $tasck[session][0][name]. '</span><br>'. '<span>Телефон: '.$tasck[session][0][phone]. '</span><br>'. '<span>e-mail: '. $tasck[session][0][email]. '</span><br>'. '<span>Дата: '. $tasck[session][0][date]. '</span></div>';
        echo $textPrint;   
        
        // echo '<span>Компания: ';
        // echo $tasck[session][0][company];
        // echo '</span><br>';
        // echo '<span>Контактное лицо: ';
        // echo $tasck[session][0][name];
        // echo '</span><br>';
        // echo '<span>Телефон: ';
        // echo $tasck[session][0][phone];
        // echo '</span><br>';
        // echo '<span>e-mail: ';
        // echo $tasck[session][0][email];
        // echo '</span><br>';
        // echo '<span>дата: ';
        // echo $tasck[session][0][date];
        // echo '</span>';
        
        
    }
    
    unset($tasck);
    
}
else echo'<h1>У вас нет доступа</h1>';
    




require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>