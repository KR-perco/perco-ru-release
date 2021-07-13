

$(document).ready(function () {
	$(document).on({
		mouseenter: function () {
			id = $(this).attr("href-text");
			if (id) $(id).css("display", "block");
		},
		mouseleave: function () {
			if (id) $(id).css("display", "none");
		}
	}, "td > a");
	
	var priceSet;

    priceSet = function(data){
        /*
         * В переменной price приводим получаемую переменную в нужный вид:
         * 1. принудительно приводим тип в число с плавающей точкой,
         *    учли результат 'NAN' то по умолчанию 0
         * 2. фиксируем, что после точки только в сотых долях
         */
        var price       = Number.prototype.toFixed.call(parseFloat(data) || 0, 0),
            //заменяем точку на запятую
            price_sep   = price.replace(/(\D)/g, ","),
            //добавляем пробел как разделитель в целых
            price_sep   = price_sep.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1 ");

        return price_sep + ' руб';
    };


	beforeAll = $('.price-e');
	for (let i = 0; i < beforeAll.length; i++) {
		before =  beforeAll[i].innerHTML;
		clearBefore = before.replace(/[^+\d]/g, '');
		// console.log('before: ' + before);
		
		after = Math.round(clearBefore * priceRes);
				
		afterClear = after;
		
		after = priceSet(afterClear);
		
		beforeAll[i].innerHTML = beforeAll[i].innerHTML.replace(before, after);
	}


});
