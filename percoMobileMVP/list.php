<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$data = Array(
    "data"=>Array(
        "company"=>Array(
                    Array(
                        "ID"=>1, //идентификатор записи
                        "NAME"=>"Google", //имя для отображения
                        "URL" => "http://google.ru",
                        "IMAGE"=>"http://www.mintfo.com/wp-content/uploads/2012/08/New-blue-logo-Google-revamps-mainpage-favicon-300x300.png",
                        "TAGS" => "Заграничный поисковик",
                        "SECTION_ID"=>"milk"//принадлежность к секции
                    ),
                    Array(
                        "ID"=>2,
                        "NAME"=>"Bitrix",
                        "SECTION_ID"=>"meat",
                        "IMAGE"=>"http://www.incr.ru/img/bitrix-logo.png",
                        "TAGS"=>"Отечественная CMS",
                        "URL"=>"http://bitrix.ru"
                    ),
                    Array(
                        "ID"=>3,
                        "NAME"=>"Yandex",
                        "SECTION_ID"=>"meat",
                        "IMAGE"=>"http://blogs.computerra.ru/wp-content/uploads/2012/10/yandex-browser-logo-289x300.jpg",
                        "TAGS" => "Свой домашний браузер",
                        "URL"=>"http://yandex.ru"
                    )
            ),
        ),
        "names"=>Array("company"=>"Компании")
);
$data = $APPLICATION->ConvertCharsetArray($data, "windows-1251","utf-8");
$APPLICATION->RestartBuffer();
echo json_encode($data);
die(); 