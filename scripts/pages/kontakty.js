/* <![CDATA[ */
var google_conversion_id = 988809681;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "4KZTCP-RogUQ0ZPA1wM";
var google_conversion_value = 0;
/* ]]> */
$(function() {
    $(".map").lightGallery({
        selector: "a",
        zoom: false,
        download: false,
        iframeMaxWidth: "80%"
    });
});


$(document).ready(function() {
    ymaps.ready(function() {
        var geolocation = ymaps.geolocation;
        if (geolocation.city == 'Санкт-Петербург') {
            $("#spb").attr("checked", "checked");
        } else if (geolocation.city == 'Псков') {
            $("#pskov").attr("checked", "checked");
        } else $("#moscow").attr("checked", "checked");

    });
});