// Variable
app.setPageTitle({
    title: "Каталог"
});

var scroll = $('.scrollmenu a');

var posts = $('.section-list .section');
posts.hide();

var postActive = $('.active');
postActive.show();

// Click function
$( ".scrollmenu a" ).click(function() { 
    // Get data of category
    $('.scrollmenu a').removeClass('active');
    $(this).addClass('active');
    
    var customType = $( this ).data('filter'); // category
    console.log(customType);
    console.log(posts.length); // Length of articles

    

    
    posts
        .hide()
        .filter(function () {
            return $(this).data('cat') === customType;
        })
        .fadeIn();
});

$( ".description .more" ).click(function() { 
    $('.description .more').css("display","none");
    $('.description .second_text').fadeIn();
    $('.description .second_text').css("display","block");
    $('.description .less').css("display","block");
});

$( ".description .less" ).click(function() { 
    $('.description .less').css("display","none");
    $('.description .second_text').fadeOut();
    $('.description .second_text').css("display","none");
    $('.description .more').css("display","block");
});

$(function(){
    $('#scrollGallery').lightSlider({
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
    });

    $('#scroll').lightSlider({
        adaptiveHeight:true,
        item:1,
        slideMargin:15,
        loop:true,
        pager:false,
        onSliderLoad: function(ell) {
            ell.lightGallery({
                selector: '#scroll .lslide',
                download: false
            });
        }  
    });

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
        adaptiveHeight:true,
        item:1,
        slideMargin:0,
        loop:true,
        pager:false
    });
    $('#img_items2').lightSlider({
        adaptiveHeight:true,
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