<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$SNIPPETS = Array();
$SNIPPETS['snippet0001.snp'] = Array('title' => 'Картинки', 'description' => 'Для изменения выбрать режим кода и заменить link-big на ссылку на большую картинку, link-small - ссылку на маленькую картинку, text - на подпись к картинке, для большего количества картинок - копировать тег <a> с содержимым внутри тега <div>');
$SNIPPETS['snippet0002.snp'] = Array('title' => 'Загрузка файла', 'description' => 'Замените слово code соответствующим символьным кодом загружаемого файла');
$SNIPPETS['snippet0003.snp'] = Array('title' => 'Цена', 'description' => 'Замените слово code соответствующим символьным кодом характеристики продукта');
$SNIPPETS['snippet0004.snp'] = Array('title' => 'Картинка с текстом', 'description' => 'В теге <div> заменить значение width на ширину картинки, text - на подпись к картинке, а также подпись к элементам на картинке 1-text, 2-text и т.д. top и left - указать смещение относительно лева и права краев картинки. Если нужны еще подписи, копировать тег <div> с содержимым 1-text (или любой другой) внутри тега <div class=imgpodpis>');
$SNIPPETS['snippet0005.snp'] = Array('title' => 'Вставка php', 'description' => 'Ставим строку равную описанию к подключению php-файла, имеет вид [php:nomer]
Вместо слова nomer пишем цифру по порядку, например 01, в результате будет [php:01]');
$SNIPPETS['snippet0006.snp'] = Array('title' => 'Схема S-20');
$SNIPPETS['snippet0007.snp'] = Array('title' => 'Загрузка файла (с картинкой)', 'description' => 'Заменяем слово code на символьный код файла.
Внутри тега <div> делаем столько строк [download:code] - сколько нужно файлов, располагаться будут по горизонтали.
Если надо по вертикали или один файл с картинкой, то просто удалить тег <div> и </div>, чтобы осталась строчка вида [download:code]');
$SNIPPETS['snippet0008.snp'] = Array('title' => 'Раскрывающийся блок', 'description' => 'hide-1 - меняем цифру прибавляя 1, если несколько таких блоков, т.е. hide-1, hide-2 и т.д.');
?>