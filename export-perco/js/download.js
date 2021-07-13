$(function(){
	$("#download_zip form").submit(function(e){
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

	var t = document.forms.Tree;
	var fieldset = [].filter.call(t.querySelectorAll('fieldset'), function(element) {return element;});
	fieldset.forEach(function(eFieldset) {
	var main = [].filter.call(t.querySelectorAll('[type="checkbox"]'), function(element) {return element.parentNode.nextElementSibling == eFieldset;});
	main.forEach(function(eMain) {
		var all = eFieldset.querySelectorAll('[type="checkbox"]');
		eFieldset.onchange = function() {
		var allChecked = eFieldset.querySelectorAll('[type="checkbox"]:checked').length;
		eMain.checked = allChecked == all.length;
		eMain.indeterminate = allChecked > 0 && allChecked < all.length;
		}
		eMain.onclick = function() {
		for(var i=0; i<all.length; i++)
			all[i].checked = this.checked;
		}
	});
	});
});