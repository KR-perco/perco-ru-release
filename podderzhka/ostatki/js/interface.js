$(document).ready(function() {
	// Инфа о выбранных файлах
	var finalInfo = $("#complete");
	// Счетчик всех выбранных файлов
    var fileCount = 0;

	// ul-список
	var fileList = $('#file-list');

	// Стандарный input для файлов
	var fileInput = $('#file-field');

	function browser()
	{
		var ua = navigator.userAgent;
		if (ua.search(/MSIE/) > 0) return 'IE';
	}

	////////////////////////////////////////////////////////////////////////////
	// Подключаем и настраиваем плагин загрузки

	fileInput.damnUploader({
		// куда отправлять
		url: './serverLogic.php',
		// имитация имени поля с файлом (будет ключом в $_FILES, если используется PHP)
		fieldName:  'file',
		// ручная обработка события выбора файла (в случае, если выбрано несколько, будет вызвано для каждого)
		// если обработчик возвращает true, файлы добавляются в очередь автоматически
		onSelect: function(file) {
			// if (browser() == "IE" && fileCount < 1)
				// addFileToQueue(file);
			// else
			// {
				// if (browser() != "IE")
					addFileToQueue(file);
			// }
			return false;
		},
		// когда все загружены
		onAllComplete: function() {
			fileCount = 0;
			finalComplete();
		}
	});
	////////////////////////////////////////////////////////////////////////////
	// Вспомогательные функции

	function finalComplete() {
		finalInfo.text("complete");
	}

	// Обновление progress bar'а
	function updateProgress(progress, bar, precent, value) {
		var width = progress.width();
		var bgrValue = value * (width / 100);
		bar.width(bgrValue);
		precent.attr('rel', value).text(value+'%');
	}

    // Отображение выбраных файлов, ручное добавление в очередь загрузки.
    function addFileToQueue(file) {
		// Создаем элемент tr и помещаем в него название, размер и progress bar
		var tr = $('<tr/>').appendTo(fileList);
		var title = $('<td class="name"/>').appendTo(tr);
		$('<span/>').text(file.name+' ').appendTo(title);
		var td_s = $('<td class="size"/>').appendTo(tr);
		$('<span/>').text((file.size / 1024 / 1024).toFixed(2) + ' Mб').appendTo(td_s);
		// Добавляем прогрессбар в текущий элемент списка
		var td_p = $('<td/>').appendTo(tr);
		var div_p = $('<div class="progress"/>').appendTo(td_p);
		var pBar = $('<div/>').addClass('bar').appendTo(div_p);
		var d_p = $('<div class="precent"/>').attr('rel', '0').text('0%').appendTo(div_p);
		var td = $('<td class="cancel"/>').appendTo(tr);
		var cancelButton = $('<button class="btn btn-warning"/>').attr({
			href: '#cancel',
			title: 'удалить',
		}).appendTo(td);
		$('<i class="icon-ban-circle icon-white">').appendTo(cancelButton);
		$('<span>').text('Удалить').appendTo(cancelButton);


		fileCount++;

		// Создаем объект загрузки
		var uploadItem = {
			file: file,
			onProgress: function(percents) {
				updateProgress(div_p, pBar, d_p, percents);
			},
			onComplete: function(successfully, data, errorCode) {
				if(successfully) {
					cancelButton.remove();
					$(".precent").text("100%");
					$('<span/>').text('Загружено').appendTo(td);
					$('tr').addClass('download');
					
				} else {
					if(!this.cancelled) {
					$('<span style="color: red;"/>').text('ошибка при загрузке. Код:'+errorCode).appendTo(td);
					$('tr').addClass('error');
					}
				}
			}
		};
		// ... и помещаем его в очередь
		if (browser() != "IE")
			var queueId = fileInput.duAdd(uploadItem);

		// обработчик нажатия ссылки "отмена"
		cancelButton.click(function() {
			//fileInput.trigger('uploader.test', queueId);
			//fileInput.damnUploader('cancel', queueId);
			//fileInput.trigger('uploader.cancel', queueId);
			fileInput.duCancel(queueId);
			tr.remove();
			fileCount--;
			return false;
		});
		return uploadItem;
	}
	////////////////////////////////////////////////////////////////////////////
	// Обработчики событий

	// Обаботка события нажатия на кнопку "Загрузить все".
	// стартуем все загрузки
	$("#upload").click(function() {
		fileInput.duStart();
	});
});