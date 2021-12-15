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
        var swiper = new Swiper('#main-slider', {
            slidesPerView: 1,
            loop: true,
            speed: 300,
            autoplay: false,
            navigation: {
                nextEl: '#main-slider .swiper-button-next',
                prevEl: '#main-slider .swiper-button-prev',
            },
            on: {
                init: function() {
                    $("#main-slider .swiper-wrapper").lightGallery({
                        selector: '#main-slider .swiper-slide'
                    });
                },

            }
        });
        console.log("Swiper initted");
        // console.log("lightSlider initted");
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

});

app.setPageTitle({
    title: "Каталог"
});