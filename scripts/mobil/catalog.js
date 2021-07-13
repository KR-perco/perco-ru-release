$(document).ready(function () {
    var posts = $('.section-list .section');
    posts.hide();

    var postActive = $('.active');
    postActive.show();

    $( ".scrollmenu a" ).click(function() { 
        $('.scrollmenu a').removeClass('active');
        $(this).addClass('active');
       
        var customType = $( this ).data('filter');
        
        posts
            .hide()
            .filter(function () {
                return $(this).data('cat') === customType;
            })
            .fadeIn();
    });

    var paragraphs = document.querySelectorAll('.preview_text p');

    if (paragraphs.length > 1){
        $('.preview_text p:not(:first-child)').css("display","none");
        $('.preview_text').append('<div class="more">Подробнее</div>');
        $('.preview_text').append('<div class="less">Скрыть</div>');
        $('.less').css("display","none");
    }    

    $( ".description .more" ).click(function() {
        $('.description .more').css("display","none");
        $('.less').css("display","block");
        $('.preview_text p:not(:first-child)').fadeIn();
    });

    $( ".description .less" ).click(function() {
        $('.description .less').css("display","none");
        $('.description .more').css("display","block"); 
        $('.preview_text p:not(:first-child)').fadeOut();
    });
});

app.setPageTitle({
    title: "Каталог"
});

$(function(){
    /*$('#scrollGallery').lightSlider({
        adaptiveHeight:true,
        item:2,
        slideMargin:0,
        loop:true,
        pager:false,
        responsive : [
            {
                breakpoint:650,
                settings: {
                    item:1,
                    slideMove:1,
                    slideMargin:20,
                  }
            }
        ],
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#horizontal_scroll .lslide'
            });
        }   
    });*/

    $('#main-slider').lightSlider({
        adaptiveHeight:true,
        item:1,
        slideMargin:15,
        loop:true,
        pager:false,
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#main-slider .lslide'
            });
        }   
    });

    $('#img_items0').lightSlider({
        adaptiveHeight:true,
        item:1,
        slideMargin:0,
        loop:true,
        pager:false
    });
    $('#img_items1').lightSlider({
        item:1,
        slideMargin:0,
        loop:true,
        pager:false
    });
    $('#img_items2').lightSlider({

        item:1,
        slideMargin:0,
        loop:true,
        pager:false
    });
    $('#img_items3').lightSlider({
        adaptiveHeight:true,
        item:1,
        slideMargin:0,
        loop:true,
        pager:false
    });
});