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