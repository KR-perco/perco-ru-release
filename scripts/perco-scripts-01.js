function closeWarning() {
    document.getElementById('cookie-warning').style.display = "none";
    document.getElementById('cookie-warning-en').style.display = "none";
}

function warning_schet() {
    alert("Для получения счета обратитесь в Учебный центр: seminar@perco.ru");
    /* var check = confirm("Внимание! Для компаний, в штате которых есть хотя бы один сотрудник, прошедший  очное обучение в учебном центре PERCo, сертификация проводится бесплатно. Для подтверждения бесплатной сертификации добавьте такого сотрудника в профиле компании и укажите дату прохождения им очного обучения.");
    if (check)
    {
    	window.open("/client/company/list/schet.php","_blank");
    }
    else
    	return false; */
}

function setCookie(name, value, exdays) {
    var exdate = new Date();
    exdate.setDate(exdate.getDate() + exdays);
    var curCookie = name + "=" + escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
    document.cookie = curCookie;
}
$(function() {
    $(".img_items").lightGallery({
        selector: "a"
    });
    $("#footer_city").hover(
        function() {
            $(this).find(".podlozhka").width($(this).width());
            $("#all-city").css("display", "block");
        },
        function() {
            $("#all-city").css("display", "none");
        }
    );
    $(".link_img").lightGallery({
        selector: "a"
    });
    $("header input").change(function() {
        var cur_check = $(this).attr("id");
        $("header input").each(function(indx, element) {
            if (cur_check != $(element).attr("id"))
                $(element).attr("checked", false);
        });
    });
    if (url("path") != "/podderzhka/servisnoe-obsluzhivanie.php") {
        var min_width = false;
        if (window.innerWidth < 900 && min_width == false) {
            min_width = true;
            $(".tabs input[type=radio]").attr("checked", false);
            $(".tabs input[type=radio]").attr("type", "checkbox");
        }
        $(window).resize(function() {
            if (window.innerWidth < 900 && min_width == false) {
                min_width = true;
                $(".tabs input[type=radio]").attr("checked", false);
                $(".tabs input[type=radio]").attr("type", "checkbox");
            }
            if (window.innerWidth > 900 && min_width) {
                min_width = false;
                $(".tabs input[type=checkbox]").attr("type", "radio");
                $(".tabs input[type=radio]:first-child").click();
            }
        });
    }
    $(window).scroll(function() {
        if (window.innerWidth < 900) {
            if ($(this).scrollTop() > 100)
                $(".scrollup").fadeIn();
            else
                $(".scrollup").fadeOut();
        } else
            $('.scrollup').fadeOut();
    });

    $(".scrollup").click(function() {
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

    var isCookie = getCookie("firstVisit");

    function getCookie(name) {
        var matches = document.cookie.match(new RegExp(
            "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
        ));
        return matches ? decodeURIComponent(matches[1]) : undefined;
    }

    function setCookie(name, value, options) {
        options = options || {};

        var expires = options.expires;

        if (typeof expires == "number" && expires) {
            var d = new Date();
            d.setTime(d.getTime() + expires * 1000);
            expires = options.expires = d;
        }
        if (expires && expires.toUTCString) {
            options.expires = expires.toUTCString();
        }

        value = encodeURIComponent(value);

        var updatedCookie = name + "=" + value;

        for (var propName in options) {
            updatedCookie += "; " + propName;
            var propValue = options[propName];
            if (propValue !== true) {
                updatedCookie += "=" + propValue;
            }
        }

        document.cookie = updatedCookie;
    }

    if (location.hostname == "www.en.perco.local") {
        //alert(location.hostname)
        if (isCookie == undefined) {
            document.getElementById('cookie-warning-en').style.display = "block";
            setCookie("firstVisit", "", {
                expires: 86400 * 365
            });
        }
    }
    if (location.hostname == "www.perco.local") {
        //alert(location.hostname)
        if (isCookie == undefined) {
            document.getElementById('cookie-warning').style.display = "block";
            setCookie("firstVisit", "", {
                expires: 86400 * 365
            })
        }
    }

    console.log(isCookie);
    if (location.hostname == "www.perco.ru") {
        if (isCookie == undefined) {
            document.getElementById('cookie-warning').style.display = "block";
            setCookie("firstVisit", "", {
                expires: 86400 * 365
            })
        }
    }

    if (location.hostname == "www.perco.com" ||
        location.hostname == "de.perco.com" ||
        location.hostname == "fr.perco.com" ||
        location.hostname == "it.perco.com" ||
        location.hostname == "es.perco.com") {
        if (isCookie == undefined) {
            document.getElementById('cookie-warning-en').style.display = "block";
            setCookie("firstVisit", "", {
                expires: 86400 * 365
            })
        }
    }
});


$(document).ready(function() {

    tables = document.getElementsByClassName("col-table-i");
    if (tables) {
        $('td').hover(
            function() {
                it = $(this).attr('data-id');
                $(it).toggleClass('on', 200);
            });
        for (j = 0; j < tables.length; ++j) {
            mark = tables[j].getElementsByTagName("p");
            replaceMark(mark);
        }

        function replaceMark(mark) {
            for (i = 0; i < mark.length; ++i) {
                mark[i].innerHTML = mark[i].innerHTML.replace('+', '<img width="18" src="/images/sistema-kontrolya-dostupa-perco-web/mark.svg">');
            }
        }
    }


    $('div.col-table').click(function() {
        $('div.col-table').toggleClass('smaller', 200);
        $('div.col-table').toggleClass('col-table-rotate');
    });




    function upSize(elements) {
        for (var [key, value] of elements) {
            if (!(key == '#price p' || key == '.pictogram_item p')) value++
                elements.set(key, value);
        }
        changeSize(elements);
        printSize(elements);
    }

    function downSize(elements) {
        for (var [key, value] of elements) {
            if (!(key == '#price p' || key == '.pictogram_item p')) value--
                elements.set(key, value);
        }
        changeSize(elements);
        printSize(elements);
    }

    function changeSize(elements) {
        for (var [key, value] of elements) {
            $(key).css("font-size", value + "px");
        }
    }

    function printSize(elements) {
        $('#size').text(' ');
        for (var [key, value] of elements) {
            if (value) $('<span>' + key + ": " + value + 'px</span><br>').appendTo('#size');
        }
    }


});