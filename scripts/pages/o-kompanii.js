$(function() {
    $("#kachestvo").lightGallery({
        selector: "this",
        download: false,
        iframeMaxWidth: "80%"
    });
    $(".play_video").lightGallery();
    // // create the panorama player with the container
    // pano = new pano2vrPlayer("virtual-tour");
    // // add the skin object
    // skin = new pano2vrSkin(pano);
    // // load the configuration
    // window.addEventListener("load", function() {
    //     pano.readConfigUrlAsync("/scripts/virtual-tour/pano.xml", function() { /* gyro=new pano2vrGyro(pano,"container"); */ });
    // });
    $('.video-gallery').lightGallery({
        youtubePlayerParams: {
            modestbranding: 1,
            showinfo: 0,
            rel: 0,
            youtubeThumbSize: 'default'
        }
    });
});

function readDeviceOrientation() {
    // window.innerHeight is not supported by IE
    var winH = window.innerHeight ? window.innerHeight : jQuery(window).height();
    var winW = window.innerWidth ? window.innerWidth : jQuery(window).width();
    //force height for iframe usage
    if (!winH || winH == 0) {
        winH = '100%';
    }
    // set the height of the document
    jQuery('html').css('height', winH);
    // scroll to top
    window.scrollTo(0, 0);
}
jQuery(document).ready(function() {
    if (/(iphone|ipod|ipad|android|iemobile|webos|fennec|blackberry|kindle|series60|playbook|opera\smini|opera\smobi|opera\stablet|symbianos|palmsource|palmos|blazer|windows\sce|windows\sphone|wp7|bolt|doris|dorothy|gobrowser|iris|maemo|minimo|netfront|semc-browser|skyfire|teashark|teleca|uzardweb|avantgo|docomo|kddi|ddipocket|polaris|eudoraweb|opwv|plink|plucker|pie|xiino|benq|playbook|bb|cricket|dell|bb10|nintendo|up.browser|playstation|tear|mib|obigo|midp|mobile|tablet)/.test(navigator.userAgent.toLowerCase())) {
        if (/iphone/.test(navigator.userAgent.toLowerCase()) && window.self === window.top) {
            jQuery('body').css('height', '100.18%');
        }
        // add event listener on resize event (for orientation change)
        if (window.addEventListener) {
            window.addEventListener("load", readDeviceOrientation);
            window.addEventListener("resize", readDeviceOrientation);
            window.addEventListener("orientationchange", readDeviceOrientation);
        }
        //initial execution
        setTimeout(function() { readDeviceOrientation(); }, 10);
    }
});


function accessWebVr(curScene, curTime) {

    unloadPlayer();

    loadPlayer(true, curScene, curTime);
}

function accessStdVr(curScene, curTime) {

    unloadPlayer();

    loadPlayer(false, curScene, curTime);
}

function loadPlayer(isWebVr, curScene, curTime) {
    if (isWebVr) {
        embedpano({
            id: "krpanoSWFObject",
            xml: "tour3data/test_tour_vr.xml",
            target: "panoDIV",
            passQueryParameters: true,
            bgcolor: "#000000",
            html5: "only+webgl",
            focus: false,
            vars: { skipintro: true, norotation: true, startscene: curScene, starttime: curTime }
        });
    } else {

        var isBot = /bot|googlebot|crawler|spider|robot|crawling/i.test(navigator.userAgent);
        embedpano({
            id: "krpanoSWFObject",
            swf: "tour3data/test_tour.swf",
            target: "panoDIV",
            passQueryParameters: true,
            bgcolor: "#000000",
            focus: false,
            html5: isBot ? "always" : "prefer",
            vars: { startscene: curScene, starttime: curTime },
            localfallback: "flash"
        });
    }
    //apply focus on the visit if not embedded into an iframe
    // зачем этот фокус на середину страницы тут, убрал
    if (top.location === self.location) {
        // kpanotour.Focus.applyFocus();
    }
}

function unloadPlayer() {
    if (jQuery('#krpanoSWFObject')) {
        removepano('krpanoSWFObject');
    }

}
var currentPanotourPlayer = null;

function getCurrentTourPlayer() {
    if (currentPanotourPlayer == null) {
        currentPanotourPlayer = document.getElementById('krpanoSWFObject');
    }
    return currentPanotourPlayer;
}

function isVRModeRequested() {
    var querystr = window.location.search.substring(1);
    var params = querystr.split('&');
    for (var i = 0; i < params.length; i++) {
        if (params[i].toLowerCase() == "vr") {
            return true;
        }
    }
    return false;
}