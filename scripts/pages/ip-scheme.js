$(function(){
	$(".scheme svg > use").each(function(indx, element){
		id = $(this).attr("id");
		if (id == undefined && LANGUAGE_ID != "ru")
		{
			id_text = $(this).attr("xlink:href")+"_"+LANGUAGE_ID;
			$(this).attr("xlink:href", id_text);
		}
	});
	if (location.pathname !== `/products/ip-based-entrance-control-systems/`) {
		if (model == "[object SVGTextElement]"){
			$("#model").text("KT-05");
		}else $("#model").text(model);
	} else {
		$("#model").text(`IP-Stile`);
		$("#model").attr("x", "54");
	}
	model_id = "#"+$(".scheme[data-id]").attr("data-id");
	if (model_id != undefined)
		$("#use_model").attr("xlink:href", model_id);
	//if (model_id == "#kt")
	//	$("#model").attr("y", "51");

	/*новые правки*/
	if (location.pathname == `/products/ip-based-entrance-control-systems/`) {
		document.querySelectorAll(`#model`).forEach(line => {
			if (line.textContent == `IP-Stile`) {
				//$(line).text(`KT-05`);
				$(line).text(`IP-Stile`);
			}
			if (line.textContent == `проходная`) {
				$(line).text(``);
			}
		});
	}
	if (location.pathname == `/products/kt-08a-ip-stile.php`) {
		document.querySelectorAll(`#model`).forEach(line => {
			if (line.textContent == `KT08.3A`) {
				$(line).attr("x", "54");
			}
			if (line.textContent == `проходная`) {
				$(line).text(`IP-Stile`);
			}
		});
	}
	if (location.pathname == `/products/kt-05a-ip-stile.php`) {
		document.querySelectorAll(`#model`).forEach(line => {
			if (line.textContent == `KT05.4A`) {
				$(line).attr("x", "54");
			}
			if (line.textContent == `проходная`) {
				$(line).text(`IP-Stile`);
			}
		});
	}
	if (location.pathname == `/products/kt-05-ip-stile.php`) {
		document.querySelectorAll(`#model`).forEach(line => {
			if (line.textContent == `KT05.4`) {
				$(line).attr("x", "54");
			}
			if (line.textContent == `проходная`) {
				$(line).text(`IP-Stile`);
			}
		});
	}
	if (location.pathname == `/products/kt-02-ip-stile.php`) {
		document.querySelectorAll(`#model`).forEach(line => {
			if (line.textContent == `KT02.3`) {
				$(line).attr("x", "54");
			}
			if (line.textContent == `проходная`) {
				$(line).text(`IP-Stile`);
			}
		});
	}
	if (location.pathname == `/prodotti/kt-05-9a-ip-stile.php`) {
		$('text#model:eq(1)').text('IP-Stile');
	}
	if (location.pathname == `/productos/kt-05-9a-paso-electr-nico.php`) {
		$('text#model:eq(1)').attr('x', 51);
		$('text#model:eq(1)').text('Paso electrónico');
	}
	/*новые правки*/
});