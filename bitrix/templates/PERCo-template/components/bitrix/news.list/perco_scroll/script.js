function resize_scroll() {
    var height = 0;
    // if ($("div").is("#secel_list"))
    // height = $("#secel_list").height();
    // if ($("div").is("#first_info"))
    // height = $("#first_info").height();
    $("#content > *").each(function(indx) {
        height += $(this).height();
    });
    var number = parseInt((height / 230), 10);
    if (number < 3)
        number = 3;
    height = number * 240;
    return { "height": height, "number": number };
}
$(function() {
    var slider = $("#scroll > #scrollGallery");
    setTimeout(function() {
        mass = resize_scroll();
        slider.lightSlider({
            controls: true,
            loop: true,
            item: mass["number"],
            pager: false,
            vertical: true,
            verticalHeight: mass["height"],
            onSliderLoad: function(el) {
                el.lightGallery({ selector: "li" })
            }
        });
    }, 100);
    $("#horizontal_scroll > #scrollGallery").lightSlider({
        item: 4,
        slideMargin: 10,
        adaptiveHeight: true,
        pager: false,
        loop: false,
        responsive: [{
                breakpoint: 1150,
                settings: {
                    item: 3,
                }
            },
            {
                breakpoint: 950,
                settings: {
                    item: 2,
                }
            },
            {
                breakpoint: 720,
                settings: {
                    item: 1,
                }
            }
        ],
        onSliderLoad: function(el) {
            el.lightGallery({ selector: "li" })
        }
    });

    $(".tabs label").click(function() {
        setTimeout(function() {
            mass = resize_scroll();
            slider.parent().css("height", mass["height"]);
        }, 100);
    });
});