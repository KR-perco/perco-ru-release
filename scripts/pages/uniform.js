var options = $("#company option");
var array_option = new Array();


for(var i = 0; i < options.length; i++) {

	var b = {};
	b.label = options[i].text;
	b.value = options[i].value;
	array_option.push(b);

}


$("#input_search").autocomplete({
    maxResults: 15,
	minLength: 1,
	source: function(request, response) {
        var results = $.ui.autocomplete.filter(array_option, request.term);
        response(results.slice(0, this.options.maxResults));
    },
	select: function(event, ui) {
        event.preventDefault();
        $("#input_search").val(ui.item.label);
		switch (ui.item.value){
			case 'Авторизованный дилер и сервисный центр':
				$("#error-alert td").text("Вы можете заказать бесплатно 4 футболки. Стоимость каждого дополнительного поло состовляет 1000 рублей.");
				break;
			case 'Авторизованный инсталлятор':
				$("#error-alert td").text("Вы можете заказать бесплатно 2 футболки. Стоимость каждого дополнительного поло состовляет 1000 рублей.");
				break;
			case 'Сервисный центр':
				$("#error-alert td").text("Вы можете заказать бесплатно 2 футболки. Стоимость каждого дополнительного поло состовляет 1000 рублей.");
				break;
			case 'Сертифицированный торговый партнер':
				$("#error-alert td").text("Вы можете заказать бесплатно 2 футболки. Стоимость каждого дополнительного поло состовляет 1000 рублей.");
				break;
		}
    },
	focus: function(event, ui) {
        event.preventDefault();
        $("#input_search").val(ui.item.label);
    }
	
});
