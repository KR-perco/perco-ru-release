function countryHover(id, fill, action) {
    if (action == "mouseenter") {
        $("g#" + id + " > path").css("fill", "#1875C9");
        $("#mapBlock").append('<div id="' + id + 'Text" class="country"><div class="descrip">' + massCountries[id]["name"] + '</div></div>');
    } else {
        $("g#" + id + " > path").css("fill", fill);
        $("#" + id + "Text").remove();
    }
}
switch (LANGUAGE_ID) {
    case "ru":
        path = "/gde-kupit/";
    case "en":
        path = "";
        break;
    case "de":
        path = "";
        break;
    case "fr":
        path = "";
        break;
    case "it":
        path = "";
        break;
    case "es":
        path = "";
        break;
}
$(function() {
    // красим страны, что есть в списке
    for (key in massCountries) {
        $("g#" + key + " > path").css("fill", "#86B4DE");
        $("g#" + key + " > circle").css("display", "block");
    }
    // выделение страны при наведении мыши на страну
    $("g").mouseenter(function() {
        id = $(this).attr("id");
        fill = $("g#" + id + " > path").css("fill");
        country = massCountries[id];
        if (window.country)
            countryHover(id, fill, "mouseenter");
    });
    // действия при убирании курсора с выделенной страны
    $("g").mouseleave(function() {
        if (window.country)
            countryHover(id, fill, "mouseleave");
    });
    $(".country_name").hover(
        function() {
            id = $(this).attr("data-id");
            fill = $("g#" + id + " > path").css("fill");
            countryHover(id, fill, "mouseenter");
        },
        function() {
            countryHover(id, fill, "mouseleave");
        }
    );
    // клик по стране
    $("g").click(function() {
        id = $(this).attr("id");
        country = massCountries[id];
        if (window.country)
            document.location.href = path + massCountries[id]["url"] + "/";
    });
});