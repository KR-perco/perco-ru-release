$(function(){
	$("#status_dso form").submit(function(e){
		e.preventDefault();	//отменяем стандартное действие при отправке формы
		//берем из формы метод передачи данных
		var m_method = $(this).attr("method");	//получаем адрес скрипта на сервере, куда нужно отправить форму
		var m_action = $(this).attr("action");
		//получаем данные, введенные пользователем в формате input1=value1&input2=value2...,
		//то есть в стандартном формате передачи данных формы
		var m_data = $(this).serialize();
		$.ajax({
			type: m_method,
			url: m_action,
			data: m_data,
			success: function(result){
			$("#form_back").html(result);
			}
		});
	});
});