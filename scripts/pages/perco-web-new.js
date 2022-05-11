$(function() {
    $("#horizontal_scroll > #scrollGallery").lightSlider({
        item: 1,
        pager: false,
        loop: true,
        adaptiveHeight: true,
        arrowsGray: false
    });
    $('#video-gallery').lightGallery({
        zoom: true,
        youtubePlayerParams: {
            modestbranding: 0,
            showinfo: 0,
            rel: 0,
            controls: 1
        }
    });
    $('#video-gallery-two').lightGallery({
        zoom: true,
        youtubePlayerParams: {
            modestbranding: 0,
            showinfo: 0,
            rel: 0,
            controls: 1
        }
    });
});

function checkHash() {
    if (location.hash === '#distribserv_open') {
        $('[for="klyuchevye-vozmozhnosti"]').click();
        var hiddenElement = document.getElementById("distribserv_open");
        hiddenElement.scrollIntoView({ behavior: "smooth" });
        if (!$('#hide-9')[0].checked) {

            $('label[for="hide-9"]').click();
        };
    }
}

window.onload = checkHash; // page load
window.onhashchange = checkHash; // local click


function showjpg(state) {
    document.getElementById('bio_img').style.display = state;
}