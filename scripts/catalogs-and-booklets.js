$(document).ready(function() {
    if (document.getElementById('booklets-input')) { // если иcпользуется нужный шаблон формы
        let bns = document.getElementsByClassName("form-popup-link");
        Fancybox.bind("[data-fancybox]", {
            on: {
                // "*": (event, fancybox, slide) => { console.log(`event: ${event}`); },

                initLayout: (event) => {

                },
                destroy: (event) => {},
            },
        });
        for (i = 0; i < bns.length; i++) {
            bns[i].addEventListener("click", function() {
                let merchInput = document.querySelector('#booklets-input > input');
                if (document.querySelector('.input-copy')) {
                    document.querySelector('.input-copy').innerHTML = this.dataset.merch;
                }
                merchInput.value = this.dataset.merch;
                console.log(this.dataset.merch);
            });
        }
    }

});