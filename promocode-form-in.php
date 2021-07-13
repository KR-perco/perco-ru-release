<?
if ($_POST["email"] != "") {
    if ($_POST["company"] != "") $company = $_POST["company"];
    if ($_POST["name"] != "") $name = $_POST["name"];
    if ($_POST["phone"] != "") $phone = $_POST["phone"]; 
        else $phone = 'не указан';
    $email = $_POST["email"];
    $dateNaw = date('l jS \of F Y h:i:s A');
    
    $posts[] = array('company' => $company, 'name' => $name, 'phone' => $phone, 'email' => $email, 'date' => $dateNaw);
 

    $file = file_get_contents('promocode-forn-in.json'); // Открыть файл 
    $taskList = json_decode($file, true); // Декодировать в массив
    unset($file); // Очистить переменную $file

    $taskList[] = array('session' => $posts); // Представить новую переменную как элемент массива, в формате 'ключ'=>'имя переменной'
    file_put_contents('promocode-forn-in.json', json_encode($taskList)); // Перекодировать в формат и записать в файл.
    unset($taskList);
    
    
    
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
    $APPLICATION->SetTitle("Промокод - обработка заявки PERCo");
    $APPLICATION->SetPageProperty("title", "Системы безопасности – цены, купить комплексные системы безопасности, производство систем безопасности");
    $APPLICATION->SetPageProperty("description", "PERCo – крупнейший российский производитель оборудования и систем безопасности (СКУД - системы контроля доступа, видеонаблюдение, охранно-пожарная сигнализация, турникеты, считыватели, электромеханические замки)");
    $APPLICATION->SetPageProperty("keywords", "системы безопасности, контроль доступа, системы контроля доступа, скуд, скд, турникеты, охранно пожарная сигнализация, пожарная безопасность, видеонаблюдение, системы видеонаблюдения, учет рабочего времени");
    
    $APPLICATION->AddHeadScript("/scripts/pages/main.js"); // подключение скриптов
    $APPLICATION->SetAdditionalCSS("/css/form.css"); // подключение стилей
    
    $message = 'Компания: '. $posts[0][company]. "\r\n". '<br>Контактное лицо: '. $posts[0][name]. "\r\n". '<br>Телефон: '.$posts[0][phone]. "\r\n". '<br>e-mail: '. $posts[0][email]. "\r\n". '<br>Дата: '. $posts[0][date];
    
    echo'<h1>Ваша заявка успешно записана!</h1>';
    echo'<div><p>';
    echo $message;
    echo'</div></p>';
    // echo'<pre>';
    // print_r($posts);
    // echo'</pre>';
    
    // Отправляем
    $from = 'admin@perco.ru';
    $headers = 'From: promocoder <'.$from.'>' . "\r\n";
    $headers .= "Content-type: text/html; charset=\"utf-8\"";
    if (mail('podolskaya@perco.ru','Промокод', $message, $headers))
        echo '<br><p>Сообщение о заявке отправлено.</p>';
    else
        echo '<br><p>Заявка сохранена.</p>';



    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");

}



?>