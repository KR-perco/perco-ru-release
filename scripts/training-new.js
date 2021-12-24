$(document).ready(function() {
    var url_string = window.location.href;
    var url = new URL(url_string);
    var modal = url.searchParams.get("modal");
    if (modal == "open") {
        $(".training-item__reg-link").trigger('click');
    }
});