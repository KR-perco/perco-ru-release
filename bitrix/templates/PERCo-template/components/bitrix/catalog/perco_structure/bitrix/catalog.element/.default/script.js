window.addEventListener('load', () => {
    $(".newcolor").lightGallery({
        selector: "a"
    });
    $("#shema").lightGallery({
        selector: "a"
    });
    $("#sheme_skud").lightGallery({
        selector: "a",
        zoom: true,
        download: true
    });
    $(".video").lightGallery({
        selector: ".itemVideo",
        zoom: true,
        download: true,
        youtubePlayerParams: {
            modestbranding: 0,
            showinfo: 0,
            rel: 0,
            controls: 1
        }
    });
    $('.review').lightGallery({
        selector: "div",
        zoom: false,
        download: true,
        youtubePlayerParams: {
            modestbranding: 0,
            showinfo: 0,
            rel: 0,
            controls: 1
        }
    });
    $("#main_image_list").lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 6,
        slideMargin: 0,
        controls: false,
        enableDrag: false,
        mode: "fade",
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: "#main_image_list .lslide"
            });
        }
    });
    if (location.hash == '#shema') {
        console.log(document.querySelector('#shema'));
        document.querySelector('#shema>a').dispatchEvent(new Event('click'));
    }

    $(".news-img, .news-imges").lightGallery({
        selector: "a"
    });
});