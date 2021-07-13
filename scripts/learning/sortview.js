// функция проверки элемента в массиве
Array.prototype.in_array = function(p_val)
{
	for(var i = 0, l = this.length; i < l; i++)
	{
		if(this[i] == p_val)
		{
			return true;
		}
	}
	return false;
}

function SortStudents(program, students)
{
	if (program == 1)
	{
		$(".uchitelskaya_jurnal tbody tr").css("display", "none");
		if (students == 1)
			for (i=0; i < arUserActiveAI.length; i++)
				document.getElementById(arUserActiveAI[i]).style.display = 'table-row';
		if (students == 2)
			for (i=0; i < arSertOkAI.length; i++)
				document.getElementById(arSertOkAI[i]).style.display = 'table-row';
		if (students == 3)
			for (i=0; i < arUserNoActiveAI.length; i++)
				document.getElementById(arUserNoActiveAI[i]).style.display = 'table-row';
		if (students == 4)
			for (i=0; i < arUserPereattAI.length; i++)
				document.getElementById(arUserPereattAI[i]).style.display = 'table-row';
	}
	if (program == 2)
	{
		$(".uchitelskaya_jurnal tbody tr").css("display", "none");
		if (students == 1)
			for (i=0; i < arUserActiveSTP.length; i++)
				document.getElementById(arUserActiveSTP[i]).style.display = 'table-row';
		if (students == 2)
			for (i=0; i < arSertOkSTP.length; i++)
				document.getElementById(arSertOkSTP[i]).style.display = 'table-row';
		if (students == 3)
			for (i=0; i < arUserNoActiveSTP.length; i++)
				document.getElementById(arUserNoActiveSTP[i]).style.display = 'table-row';
		if (students == 4)
			for (i=0; i < arUserPereattSTP.length; i++)
				document.getElementById(arUserPereattSTP[i]).style.display = 'table-row';
	}
	if (program == 3)
	{
		$(".uchitelskaya_jurnal tbody tr").css("display", "none");
		if (students == 1)
			for (i=0; i < arUserActiveAS.length; i++)
				document.getElementById(arUserActiveAS[i]).style.display = 'table-row';
		if (students == 2)
			for (i=0; i < arSertOkAS.length; i++)
				document.getElementById(arSertOkAS[i]).style.display = 'table-row';
		if (students == 3)
			for (i=0; i < arUserNoActiveAS.length; i++)
				document.getElementById(arUserNoActiveAS[i]).style.display = 'table-row';
		if (students == 4)
			for (i=0; i < arUserPereattAS.length; i++)
				document.getElementById(arUserPereattAS[i]).style.display = 'table-row';
	}
}

function Sort(type, check)
{
	switch(type)
	{
		case "ai":
			if (check)
			{
				for (i=0; i < arAI.length; i++)
						document.getElementById(arAI[i]).style.display = 'table-row';
			}
			else
			{
				for (i=0; i < arAI.length; i++)
						document.getElementById(arAI[i]).style.display = 'none';
			}
			break;
		case "stp":
			if (check)
			{
				for (i=0; i < arSTP.length; i++)
						document.getElementById(arSTP[i]).style.display = 'table-row';
			}
			else
			{
				for (i=0; i < arSTP.length; i++)
						document.getElementById(arSTP[i]).style.display = 'none';
			}
			break;
		case "as":
			if (check)
			{
				for (i=0; i < arAS.length; i++)
						document.getElementById(arAS[i]).style.display = 'table-row';
			}
			else
			{
				for (i=0; i < arAS.length; i++)
						document.getElementById(arAS[i]).style.display = 'none';
			}
			break;
		case "sc":
			if (check)
			{
				for (i=0; i < arSC.length; i++)
						document.getElementById(arSC[i]).style.display = 'table-row';
			}
			else
			{
				for (i=0; i < arSC.length; i++)
						document.getElementById(arSC[i]).style.display = 'none';
			}
			break;
	}
}

function SortVuz(students)
{
	$(".uchitelskaya_jurnal tbody tr").css("display", "none");
	switch(students)
	{
		case "1":
			for (i=0; i < arUserActive.length; i++)
				document.getElementById(arUserActive[i]).style.display = 'table-row';
			break;
		case "2":
			for (i=0; i < arUserNoActive.length; i++)
				document.getElementById(arUserNoActive[i]).style.display = 'table-row';
			break;
	}
}

var img_dir = "/bitrix/images/icons/"; // папка с картинками
var sort_case_sensitive = false; // вид сортировки (регистрозависимый или нет)
//initial_sort_id = 0;
//initial_sort_up = 0;
// ф-ция, определяющая алгоритм сортировки
function _sort(a, b) {
    var a = a[0];
    var b = b[0];
    var _a = (a + '').replace(/,/, '.');
    var _b = (b + '').replace(/,/, '.');
	_a = (_a + '').replace(/\n/, '.');
	_b = (_b + '').replace(/\n/, '.');
    if(isFinite(_a) && isFinite(_b)) return sort_numbers(parseFloat(_a), parseFloat(_b));
    else if (!sort_case_sensitive) return sort_insensitive(a, b);
    else return sort_sensitive(a, b);
}

// ф-ция сортировки чисел
function sort_numbers(a, b) {
	return a - b;
}

// ф-ция регистронезависимой сортировки
function sort_insensitive(a, b) {
    var anew = a.toLowerCase();
    var bnew = b.toLowerCase();
    if (anew < bnew) return -1;
    if (anew > bnew) return 1;
    return 0;
}

// ф-ция регистрозависимой сортировки
function sort_sensitive(a, b) {
    if (a < b) return -1;
    if (a > b) return 1;
    return 0;
}

// вспомогательная ф-ция, выдирающая из дочерних узлов весь текст
function getConcatenedTextContent(node) {
    var _result = "";
    if (node == null) {
        return _result;
    }
    var childrens = node.childNodes;
    var i = 0;
    while (i < childrens.length) {
        var child = childrens.item(i);
        switch (child.nodeType) {
            case 1: // ELEMENT_NODE
            case 5: // ENTITY_REFERENCE_NODE
                _result += getConcatenedTextContent(child);
                break;
            case 3: // TEXT_NODE
            case 2: // ATTRIBUTE_NODE
            case 4: // CDATA_SECTION_NODE
                _result += child.nodeValue;
                break;
            case 6: // ENTITY_NODE
            case 7: // PROCESSING_INSTRUCTION_NODE
            case 8: // COMMENT_NODE
            case 9: // DOCUMENT_NODE
            case 10: // DOCUMENT_TYPE_NODE
            case 11: // DOCUMENT_FRAGMENT_NODE
            case 12: // NOTATION_NODE
            // skip
            break;
        }
        i++;
    }
    return _result;
}

// суть скрипта
function sort(e) {
    var el = window.event ? window.event.srcElement : e.currentTarget;
    while (el.tagName.toLowerCase() != "td") el = el.parentNode;
    var a = new Array();
    var name = el.lastChild.nodeValue;
    var dad = el.parentNode;
    var table = dad.parentNode.parentNode;
    var up = table.up;
	var up_img = '';
    var node, arrow, curcol;
	var arrow_del;
    for (var i = 0; (node = dad.getElementsByTagName("td").item(i)); i++) {
        if (node.lastChild.nodeValue == name){
            curcol = i;
            if (node.className == "curcol"){
                arrow = node.firstChild;
                table.up = Number(!up);
				if (table.up)
					up_img = "up_down-up";
				else
					up_img = "up_down-down";
            }else{
                node.className = "curcol";
				node.removeChild(node.firstChild);
                arrow = node.insertBefore(document.createElement("img"),node.firstChild);
                table.up = 0;
				up_img = "up_down-down";
            }
            arrow.src = img_dir + up_img + ".gif";
            arrow.alt = "";
        }else{
            if (node.className == "curcol"){
                node.className = "";
                if (node.firstChild)
				{
					node.removeChild(node.firstChild);
					arrow_del = node.insertBefore(document.createElement("img"),node.firstChild);
					arrow_del.src = "/bitrix/images/icons/up_down.gif";
				}
            }
        }
    }
    var tbody = table.getElementsByTagName("tbody").item(0);
    for (var i = 0; (node = tbody.getElementsByTagName("tr").item(i)); i++) {
        a[i] = new Array();
        a[i][0] = getConcatenedTextContent(node.getElementsByTagName("td").item(curcol));
        a[i][1] = getConcatenedTextContent(node.getElementsByTagName("td").item(1));
        a[i][2] = getConcatenedTextContent(node.getElementsByTagName("td").item(0));
        a[i][3] = node;
    }
    a.sort(_sort);
    if (table.up) a.reverse();
    for (var i = 0; i < a.length; i++) {
        tbody.appendChild(a[i][3]);
    }
}

// ф-ция инициализации всего процесса
function init(e) {
    if (!document.getElementsByTagName) return;

    for (var j = 0; (thead = document.getElementsByTagName("thead").item(j)); j++) {
        var node;
        for (var i = 0; (node = thead.getElementsByTagName("td").item(i)); i++) {
            if (node.addEventListener) node.addEventListener("click", sort, false);
            else if (node.attachEvent) node.attachEvent("onclick", sort);
            node.title = "Нажмите на заголовок, чтобы отсортировать колонку";
        }
        thead.parentNode.up = 0;
        
        if (typeof(initial_sort_id) != "undefined"){
            td_for_event = thead.getElementsByTagName("td").item(initial_sort_id);
            if (document.createEvent){
                var evt = document.createEvent("MouseEvents");
                evt.initMouseEvent("click", false, false, window, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1, td_for_event);
                td_for_event.dispatchEvent(evt);
            } else if (td_for_event.fireEvent) td_for_event.fireEvent("onclick");
            if (typeof(initial_sort_up) != "undefined" && initial_sort_up){
                if (td_for_event.dispatchEvent) td_for_event.dispatchEvent(evt);
                else if (td_for_event.fireEvent) td_for_event.fireEvent("onclick");
            }
        }
    }
}

// запускаем ф-цию init() при возникновении события load
var root = window.addEventListener || window.attachEvent ? window : document.addEventListener ? document : null;
if (root){
    if (root.addEventListener) root.addEventListener("load", init, false);
    else if (root.attachEvent) root.attachEvent("onload", init);
}