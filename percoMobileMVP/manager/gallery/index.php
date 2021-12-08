<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
CModule::IncludeModule('iblock');
$APPLICATION->AddHeadScript("/scripts/url.min.js"); 
?>
<script>
	app.setPageTitle({
         title: "Фотогалерея"
	  });
	  
</script> 
<div id="gallery">
    <div class="scrollmenu">
        <a id="biznes_centry" onclick="changeSection('biznes_centry')"><img alt="Бизнес-центры" src="/percoMobileMVP/img/gallery-bc.png">Бизнес-центры</a>

        <a id="promyshlennye-predpriyatiya" onclick="changeSection('promyshlennye-predpriyatiya')"><img alt="Промышленные предприятия" src="/percoMobileMVP/img/gallery-pp.png">Промышленные предприятия</a>

        <a id="sportivnye-i-razvlekatelnye-obekty" onclick="changeSection('sportivnye-i-razvlekatelnye-obekty')"><img alt="Спортивные и развлекательные объекты" src="/percoMobileMVP/img/gallery-sp.png">Спортивные и развлекательные объекты</a>

        <a id="gosudarstvennye-uchrezhdeniya" onclick="changeSection('gosudarstvennye-uchrezhdeniya')"><img alt="Государственные учреждения" src="/percoMobileMVP/img/gallery-gu.png">Государственные учреждения</a>

        <a id="muzei-i-teatry" onclick="changeSection('muzei-i-teatry')"><img alt="Музеи и театры" src="/percoMobileMVP/img/gallery-mt.png">Музеи и театры</a>

        <a id="shkoly" onclick="changeSection('shkoly')"><img alt="Школы" src="/percoMobileMVP/img/gallery-sh.png">Школы</a>

        <a id="vuzy" onclick="changeSection('vuzy')"><img alt="ВУЗы" src="/percoMobileMVP/img/gallery-v.png">ВУЗы</a>

        <a id="ofisy-kompaniy" onclick="changeSection('ofisy-kompaniy')"><img alt="Офисы компаний" src="/percoMobileMVP/img/gallery-ok.png">Офисы компаний</a>

        <a id="transportnye-obekty" onclick="changeSection('transportnye-obekty')"><img alt="Транспортные объекты" src="/percoMobileMVP/img/gallery-tu.png">Транспортные объекты</a>

        <a id="medicinskie-uchrezhdeniya" onclick="changeSection('medicinskie-uchrezhdeniya')"><img alt="Медицинские учреждения" src="/percoMobileMVP/img/gallery-m.png">Медицинские учреждения</a>

        <a id="prochie" onclick="changeSection('prochie')"><img alt="Прочие" src="/percoMobileMVP/img/gallery-p.png">Прочие</a>
    </div>
    
    <div id="scroll">
    </div>	  

</div>

<script>
    function changeSection(section){                           
        $('.scrollmenu a').removeClass('active');
        $('#' + section).addClass('active');
        $('#scroll').empty();
        
        document.getElementById('scroll').insertAdjacentHTML('afterbegin', '<ul id="scrollGallery"></ul>');

        $.getJSON('data_gallery.json', {}, function(json){
            
            var scroll = '';
            var slide, filename;

            for (var i = json[section].length - 1; i >= 0; i--) {
                // filename = json[section][i].FULL.VALUE.replace('jpg', 'png');
                filename = json[section][i].FULL.VALUE;
                filename_thumb = json[section][i].FULL.VALUE_THUMB;
                console.log(filename_thumb);
                slide = '<li style="background-image: url(https://www.perco.ru' + filename + ');" data-thumb="https://www.perco.ru' + filename_thumb + '" data-img="https://www.perco.ru' + filename + '"><div class="caption-container"><p>' + json[section][i].NAME; + '</p></div></li>';
        
                scroll += slide;
            }

            document.getElementById('scrollGallery').insertAdjacentHTML('afterbegin', scroll);

            slider = $("#scrollGallery").lightSlider({
                gallery: true,
                item: 1,
                loop: true,
                enableDrag: true,
                thumbItem: 4,
                mode: "fade",
            });
            slider.refresh();
        });
    }

    changeSection('biznes_centry');
</script>

<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>