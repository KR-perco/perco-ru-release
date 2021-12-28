$(function() {
    $("#slider").lightSlider({
        item: 1,
        mode: "fade",
        auto: true,
        loop: true,
        pause: 3000,
        speed: 3000,
    });
    $("#banners.bmob").lightSlider({
        item: 6,
        adaptiveHeight: true,
        slideMargin: 10,
        pager: false,
        controls: true,
        responsive: [{
                breakpoint: 1120,
                settings: {
                    item: 2,
                }
            },
            {
                breakpoint: 790,
                settings: {
                    item: 1,
                }
            }
        ]
    });
    // Перехват события addClass, не меняя его действия - добавляем свое событие на него
    var origFn = $.fn.addClass;
    $.fn.addClass = function() {
        if ($("li.active").parent().attr("id") == "slider") {
            $(".resheniya_links div").removeClass();
            var ahref = $("#slider li.active > a").attr("href");
            $(".resheniya_links a[href='" + ahref + "']").parent().attr("class", "active");
        }
        return origFn.apply(this, arguments);
    }

    if (LANGUAGE_ID == `ru`) {
        document.querySelector(`.head-tel`).addEventListener(`click`, function(e) {
            ga('send', 'event', { 'eventCategory': 'number', 'eventAction': 'click', 'eventLabel': '8 (800) 333-52-53' });
        });

        document.querySelector(`.head-tel2`).addEventListener(`click`, function(e) {
            ga('send', 'event', { 'eventCategory': 'number', 'eventAction': 'click', 'eventLabel': '8 (812) 247-04-57' });
        });

        document.querySelector(`.footer-tel`).addEventListener(`click`, function(e) {
            ga('send', 'event', { 'eventCategory': 'number', 'eventAction': 'click', 'eventLabel': '8 (800) 333-52-53 footer' });
        });
    }




    let vars = {};
    /**
     * Создать куки запись
     * @param {string} name Обязательное, название записи
     * @param {string} value Обязательное, значение записи
     * @param {string} days Обязательное, время для жизни
     */
    vars.setCookie = (name, value, days) => {
        let expires = '';

        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
            expires = `; expires=${date.toUTCString()}`;
        }

        document.cookie = `${name}=${value || ''}${expires}; path=/`;
    };

    /**
     * Получить куки запись
     * @param {string} name Обязательное, название записи
     */
    vars.getCookie = (name) => {
        let nameEQ = `${name}=`;
        let ca = document.cookie.split(';');

        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];

            while (c.charAt(0) === ' ') {
                c = c.substring(1, c.length);
            }

            if (c.indexOf(nameEQ) === 0) {
                return c.substring(nameEQ.length, c.length);
            }
        }

        return null;
    };

    /**
     * Удалить куки запись
     * @param {string} name Обязательное, название записи
     */
    vars.eraseCookie = (name) => {
        document.cookie = `${name}=; Max-Age=-99999999;`;
    };

    async function asyncPlay(video) {
        const play = await video.play().catch((e) => {
            return new Error("video not play")
        });
        if (play instanceof Error) {
            console.log `Error play video`;
            setTimeout(function() {
                asyncPlay(video);
            }, 1000);
        }
    }


    const video = document.getElementById('ny-vid');

    video.oncanplay = (event) => {
        asyncPlay(video);
        var displayed = vars.getCookie("NY_displayed");
        if (displayed === null) {
            vars.setCookie("NY_displayed", true, 365);
            Fancybox.show([{ src: "#popup-content", type: "inline" }], {
                on: {
                    done: (fancybox, slide) => {
                        video.onended = function() {
                            fancybox.close();
                        };
                    }
                }
            });
        }
    };

});