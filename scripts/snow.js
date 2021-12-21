window.onload = function() {
    switch (true) {
        case window.innerWidth <= 768:
            snowingTimeout = 500;
            break;
        case window.innerWidth > 768 && window.innerWidth <= 1280:
            snowingTimeout = 300;
            break;
        case window.innerWidth > 1280:
            snowingTimeout = 100;
            break;
    }
    snow(1);
}
window.addEventListener('resize', () => {
    switch (true) {
        case window.innerWidth <= 768:
            snowingTimeout = 500;
            break;
        case window.innerWidth > 768 && window.innerWidth <= 1280:
            snowingTimeout = 300;
            break;
        case window.innerWidth > 1280:
            snowingTimeout = 100;
            break;
    }
});

function snow(id) {
    var pos_x = Math.random() * (99 - 1) + 1;
    pos_x = Math.floor(pos_x);
    if (pos_x >= 1 & pos_x <= 10) { var q = -10; var png_sh = 1; }
    if (pos_x > 10 & pos_x <= 20) { var q = 10; var png_sh = 3; }
    if (pos_x > 20 & pos_x <= 30) { var q = -10; var png_sh = 0; }
    if (pos_x > 30 & pos_x <= 40) { var q = 10; var png_sh = 2; }
    if (pos_x > 40 & pos_x <= 50) { var q = -10; var png_sh = 1; }
    if (pos_x > 50 & pos_x <= 60) { var q = 10; var png_sh = 3; }
    if (pos_x > 60 & pos_x <= 70) { var q = -10; var png_sh = 0; }
    if (pos_x > 70 & pos_x <= 80) { var q = 10; var png_sh = 2; }
    if (pos_x > 80 & pos_x <= 90) { var q = -10; var png_sh = 1; }
    if (pos_x > 90 & pos_x <= 99) { var q = 10; var png_sh = 3; }
    var end_x = pos_x + q;
    var width = Math.random() * 8 + 4;
    var img = "<img id='snow_" + id + "' width='" + width + "px' style='left:" + pos_x + "%; top:-4%; position:absolute; z-index: 10000000; color: #fff; fill: #fff; stroke: #fff;' src='/images/snow/show_" + png_sh + ".svg'/>";
    $("#main_banner").append(img);
    move_show(id, end_x);
    id++;
    setTimeout("snow(" + id + ");", snowingTimeout); //100
}

function move_show(id, end_x) {
    $("#snow_" + id).animate({ top: "150%", left: "" + end_x + "%" }, 20000, function() //20000
        {
            $("#snow_" + id).empty().remove();
        });
}