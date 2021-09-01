<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("title", "Выгрузка пользователей большой базы");
$APPLICATION->SetTitle("Выгрузка пользователей большой базы");


if(CModule::IncludeModule('subscribe'))
{
$arrRubricIds = [3]; // Большая база
foreach ($arrRubricIds as &$rubricId) { 
    //активные и подтвержденные адреса, подписанные на 28 id рубрики
    $subscr = CSubscription::GetList(
        array("ID"=>"ASC"),
        array("RUBRIC"=>$rubricId, "CONFIRMED"=>"Y", "ACTIVE"=>"Y")
    );
    while(($subscr_arr = $subscr->Fetch()))
        $aEmail[] = $subscr_arr["EMAIL"];
}

// $xml = new SimpleXMLElement('<root/>');
// array_walk_recursive($aEmail, array ($xml, 'addChild'));
var_dump($aEmail);
$file = './emails.txt';
file_put_contents($file, implode(PHP_EOL, $aEmail));
}
?>


<div id="subscribe_form">
    <h1>Выгрузка пользователей большой базы</h1>
    <p>
    Пишем в файл ./emails.txt
</div> 
<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>

