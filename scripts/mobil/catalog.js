$(document).ready(function() {
    var posts = $('.section-list .section');
    posts.hide();

    var postActive = $('.active');
    postActive.show();

    $(".scrollmenu a").click(function() {
        $('.scrollmenu a').removeClass('active');
        $(this).addClass('active');

        var customType = $(this).data('filter');

        posts
            .hide()
            .filter(function() {
                return $(this).data('cat') === customType;
            })
            .fadeIn();
    });

    var paragraphs = document.querySelectorAll('.preview_text p');

    if (paragraphs.length > 1) {
        $('.preview_text p:not(:first-child)').css("display", "none");
        $('.preview_text').append('<div class="more">Подробнее</div>');
        $('.preview_text').append('<div class="less">Скрыть</div>');
        $('.less').css("display", "none");
    }

    $(".description .more").click(function() {
        $('.description .more').css("display", "none");
        $('.less').css("display", "block");
        $('.preview_text p:not(:first-child)').fadeIn();
    });

    $(".description .less").click(function() {
        $('.description .less').css("display", "none");
        $('.description .more').css("display", "block");
        $('.preview_text p:not(:first-child)').fadeOut();
    });


    function initSlider() {
        $('#main-slider').lightSlider({
            item: 1,
            slideMargin: 15,
            loop: true,
            pager: false,
            onSliderLoad: function(el) {
                el.lightGallery({
                    selector: '#main-slider .lslide'
                });
            }
        });
        console.log("lightSlider initted");
    }

    let mainImg = document.querySelector("#main-slider img");

    if (mainImg) {

        function addImageProcess(img) {
            let promise = new Promise(function(resolve, reject) {
                if (img.onload || img.complete) {
                    resolve(img.height);
                    console.log(`Изображение загружено, размеры ${img.width}x${img.height}`);
                } else if (img.onerror) {
                    reject("Load img Error!");
                    console.log("Ошибка во время загрузки изображения");
                }
                img.onload = function() {
                    resolve(img.height);
                };

                img.onerror = function() {
                    reject("Load img Error!");
                };

            });
            return promise;
        }

        let promise = addImageProcess(mainImg);

        const consumer = () => {
            promise.then(
                (result) => {
                    initSlider();
                },
                (error) => {
                    console.log('init slider Error!');
                });
        }
        consumer();
    }

    $('#img_items0').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        loop: true,
        pager: false
    });
    $('#img_items1').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        loop: false,
        pager: false
    });
    $('#img_items2').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        loop: true,
        pager: false
    });
    $('#img_items3').lightSlider({
        adaptiveHeight: true,
        item: 1,
        slideMargin: 0,
        loop: true,
        pager: false
    });

});

app.setPageTitle({
    title: "Каталог"
});