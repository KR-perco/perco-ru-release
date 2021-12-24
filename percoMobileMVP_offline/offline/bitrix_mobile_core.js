

/**********************************************************************/
/*********** Bitrix JS Core library ver 0.9.0 beta ********************/
/**********************************************************************/

;(function(window){

if (!!window.BX && !!window.BX.extend)
	return;

var _bxtmp;
if (!!window.BX)
{
	_bxtmp = window.BX;
}

window.BX = function(node, bCache)
{
	if (BX.type.isNotEmptyString(node))
	{
		var ob;

		if (!!bCache && null != NODECACHE[node])
			ob = NODECACHE[node];
		ob = ob || document.getElementById(node);
		if (!!bCache)
			NODECACHE[node] = ob;

		return ob;
	}
	else if (BX.type.isDomNode(node))
		return node;
	else if (BX.type.isFunction(node))
		return BX.ready(node);

	return null;
};

// language utility
BX.message = function(mess)
{
	if (BX.type.isString(mess))
	{
		if (typeof BX.message[mess] == "undefined")
		{
			BX.onCustomEvent("onBXMessageNotFound", [mess]);
			if (typeof BX.message[mess] == "undefined")
			{
				BX.debug("message undefined: " + mess);
				BX.message[mess] = "";
			}

		}

		return BX.message[mess];
	}
	else
	{
		for (var i in mess)
		{
			if (mess.hasOwnProperty(i))
			{
				BX.message[i] = mess[i];
			}
		}
		return true;
	}
};

if(!!_bxtmp)
{
	for(var i in _bxtmp)
	{
		if(_bxtmp.hasOwnProperty(i))
		{
			if(!BX[i])
			{
				BX[i]=_bxtmp[i];
			}
			else if(i=='message')
			{
				for(var j in _bxtmp[i])
				{
					if(_bxtmp[i].hasOwnProperty(j))
					{
						BX.message[j]=_bxtmp[i][j];
					}
				}
			}
		}
	}

	_bxtmp = null;
}

var

/* ready */
__readyHandler = null,
readyBound = false,
readyList = [],

/* list of registered proxy functions */
proxySalt = Math.random(),
proxyId = 1,
proxyList = [],

/* getElementById cache */
NODECACHE = {},

/* List of denied event handlers */
deniedEvents = [],

/* list of registered event handlers */
eventsList = [],

/* list of registered custom events */
customEvents = {},

/* list of external garbage collectors */
garbageCollectors = [],

/* list of loaded CSS files */
cssList = [],
cssInit = false,

/* list of loaded JS files */
jsList = [],
jsInit = false,


/* browser detection */
bSafari = navigator.userAgent.toLowerCase().indexOf('webkit') != -1,
bOpera = navigator.userAgent.toLowerCase().indexOf('opera') != -1,
bFirefox = navigator.userAgent.toLowerCase().indexOf('firefox') != -1,
bChrome = navigator.userAgent.toLowerCase().indexOf('chrome') != -1,
bIE = document.attachEvent && !bOpera,

/* regexps */
r = {
	script: /<script([^>]*)>/ig,
	script_end: /<\/script>/ig,
	script_src: /src=["\']([^"\']+)["\']/i,
	script_type: /type=["\']([^"\']+)["\']/i,
	space: /\s+/,
	ltrim: /^[\s\r\n]+/g,
	rtrim: /[\s\r\n]+$/g,
	style: /<link.*?(rel="stylesheet"|type="text\/css")[^>]*>/i,
	style_href: /href=["\']([^"\']+)["\']/i
},

eventTypes = {
	click: 'MouseEvent',
	dblclick: 'MouseEvent',
	mousedown: 'MouseEvent',
	mousemove: 'MouseEvent',
	mouseout: 'MouseEvent',
	mouseover: 'MouseEvent',
	mouseup: 'MouseEvent',
	focus: 'MouseEvent',
	blur: 'MouseEvent'
},

lastWait = [],

CHECK_FORM_ELEMENTS = {tagName: /^INPUT|SELECT|TEXTAREA|BUTTON$/i},

PRELOADING = 1, PRELOADED = 2, LOADING = 3, LOADED = 4,
assets = {},
isAsync = null;

BX.MSLEFT = 1;
BX.MSMIDDLE = 2;
BX.MSRIGHT = 4;

BX.ext = function(ob)
{
	for (var i in ob)
	{
		if(ob.hasOwnProperty(i))
		{
			this[i] = ob[i];
		}
	}
};

/* OO emulation utility */
BX.extend = function(child, parent)
{
	var f = function() {};
	f.prototype = parent.prototype;

	child.prototype = new f();
	child.prototype.constructor = child;

	child.superclass = parent.prototype;
	if(parent.prototype.constructor == Object.prototype.constructor)
	{
		parent.prototype.constructor = parent;
	}
};

BX.namespace = function(namespace)
{
	var parts = namespace.split(".");
	var parent = BX;

	if (parts[0] === "BX")
	{
		parts = parts.slice(1);
	}

	for (var i = 0; i < parts.length; i++) {

		if (typeof parent[parts[i]] === "undefined")
		{
			parent[parts[i]] = {};
		}
		parent = parent[parts[i]];
	}

	return parent;
};

BX.debug = function()
{
	if (BX.debugStatus())
	{
		if (window.console && window.console.log)
			window.console.log('BX.debug: ', arguments.length > 0 ? arguments : arguments[0]);
		if (window.console && window.console.trace)
			console.trace();
	}
};

BX.debugEnable = function(flag)
{
	flag = typeof (flag) == 'boolean'? flag: true;
	BX.debugEnableFlag = flag;

	console.info('Debug mode is '+(BX.debugEnableFlag? 'ON': 'OFF'))
};

BX.debugStatus = function()
{
	return BX.debugEnableFlag || false;
};

BX.is_subclass_of = function(ob, parent_class)
{
	if (ob instanceof parent_class)
		return true;

	if (parent_class.superclass)
		return BX.is_subclass_of(ob, parent_class.superclass);

	return false;
};

BX.clearNodeCache = function()
{
	NODECACHE = {};
	return false;
};

BX.bitrix_sessid = function() {return BX.message("bitrix_sessid"); };

/* DOM manipulation */
/**
 * Creates the specified HTML element
 * @param {String} tag
 * @param {Object} [data]
 * @param {Document} [context]
 * @returns {Element}
 */
BX.create = function(tag, data, context)
{
	context = context || document;

	if (null == data && typeof tag == 'object' && tag.constructor !== String)
	{
		data = tag; tag = tag.tag;
	}

	var elem;
	if (BX.browser.IsIE() && !BX.browser.IsIE9() && null != data && null != data.props && (data.props.name || data.props.id))
	{
		elem = context.createElement('<' + tag + (data.props.name ? ' name="' + data.props.name + '"' : '') + (data.props.id ? ' id="' + data.props.id + '"' : '') + '>');
	}
	else
	{
		elem = context.createElement(tag);
	}

	return data ? BX.adjust(elem, data) : elem;
};

BX.adjust = function(elem, data)
{
	var j,len;

	if (!elem.nodeType)
		return null;

	if (elem.nodeType == 9)
		elem = elem.body;

	if (data.attrs)
	{
		for (j in data.attrs)
		{
			if(data.attrs.hasOwnProperty(j))
			{
				if (j == 'class' || j == 'className')
					elem.className = data.attrs[j];
				else if (j == 'for')
					elem.htmlFor = data.attrs[j];
				else if(data.attrs[j] == "")
					elem.removeAttribute(j);
				else
					elem.setAttribute(j, data.attrs[j]);
			}
		}
	}

	if (data.style)
	{
		for (j in data.style)
		{
			if(data.style.hasOwnProperty(j))
			{
				elem.style[j] = data.style[j];
			}
		}
	}

	if (data.props)
	{
		for (j in data.props)
		{
			if(data.props.hasOwnProperty(j))
			{
				elem[j] = data.props[j];
			}
		}
	}

	if (data.events)
	{
		for (j in data.events)
		{
			if(data.events.hasOwnProperty(j))
			{
				BX.bind(elem, j, data.events[j]);
			}
		}
	}

	if (data.children && data.children.length > 0)
	{
		for (j=0,len=data.children.length; j<len; j++)
		{
			if (BX.type.isNotEmptyString(data.children[j]))
				elem.innerHTML += data.children[j];
			else if (BX.type.isElementNode(data.children[j]))
				elem.appendChild(data.children[j]);
		}
	}
	else if (data.text)
	{
		BX.cleanNode(elem);
		elem.appendChild((elem.ownerDocument || document).createTextNode(data.text));
	}
	else if (data.html)
	{
		elem.innerHTML = data.html;
	}

	return elem;
};

BX.remove = function(ob)
{
	if (ob && null != ob.parentNode)
		ob.parentNode.removeChild(ob);
	ob = null;
	return null;
};

BX.cleanNode = function(node, bSuicide)
{
	node = BX(node);
	bSuicide = !!bSuicide;

	if (node && node.childNodes)
	{
		while(node.childNodes.length > 0)
			node.removeChild(node.firstChild);
	}

	if (node && bSuicide)
	{
		node = BX.remove(node);
	}

	return node;
};

BX.html = function(node, html, parameters)
{
	if(typeof html == 'undefined')
		return node.innerHTML;

	if(typeof parameters == 'undefined')
		parameters = {};

	html = BX.processHTML(html.toString());

	var assets = [];
	var inlineJS = [];

	if(typeof html.STYLE != 'undefined' && html.STYLE.length > 0)
	{
		for(var k in html.STYLE)
			assets.push(html.STYLE[k]);
	}

	if(typeof html.SCRIPT != 'undefined' && html.SCRIPT.length > 0)
	{
		for(var k in html.SCRIPT)
		{
			if(html.SCRIPT[k].isInternal)
				inlineJS.push(html.SCRIPT[k].JS);
			else
				assets.push(html.SCRIPT[k].JS);
		}
	}

	if(parameters.htmlFirst && typeof html.HTML != 'undefined')
		node.innerHTML = html.HTML;

	var afterAsstes = function(){
		if(!parameters.htmlFirst && typeof html.HTML != 'undefined')
			node.innerHTML = html.HTML;

		for(var k in inlineJS)
			BX.evalGlobal(inlineJS[k]);

		if(BX.type.isFunction(parameters.callback))
			parameters.callback();
	}

	if(assets.length > 0)
	{
		BX.load(assets, afterAsstes);
	}
	else
		afterAsstes();
}

BX.insertAfter = function(node, dstNode)
{
	dstNode.parentNode.insertBefore(node, dstNode.nextSibling);
}

BX.prepend = function(node, dstNode)
{
	dstNode.insertBefore(node, dstNode.firstChild);
}

BX.append = function(node, dstNode)
{
	dstNode.appendChild(node);
}

BX.addClass = function(ob, value)
{
	var classNames;
	ob = BX(ob);

	value = BX.util.trim(value);
	if (value == '')
		return ob;

	if (ob)
	{
		if (!ob.className)
		{
			ob.className = value
		}
		else if (!!ob.classList && value.indexOf(' ') < 0)
		{
			ob.classList.add(value);
		}
		else
		{
			classNames = (value || "").split(r.space);

			var className = " " + ob.className + " ";
			for (var j = 0, cl = classNames.length; j < cl; j++)
			{
				if (className.indexOf(" " + classNames[j] + " ") < 0)
				{
					ob.className += " " + classNames[j];
				}
			}
		}
	}

	return ob;
};

BX.removeClass = function(ob, value)
{
	ob = BX(ob);
	if (ob)
	{
		if (ob.className && !!value)
		{
			if (BX.type.isString(value))
			{
				if (!!ob.classList && value.indexOf(' ') < 0)
				{
					ob.classList.remove(value);
				}
				else
				{
					var classNames = value.split(r.space), className = " " + ob.className + " ";
					for (var j = 0, cl = classNames.length; j < cl; j++)
					{
						className = className.replace(" " + classNames[j] + " ", " ");
					}

					ob.className = BX.util.trim(className);
				}
			}
			else
			{
				ob.className = "";
			}
		}
	}

	return ob;
};

BX.toggleClass = function(ob, value)
{
	var className;
	ob = BX(ob);

	if (BX.type.isArray(value))
	{
		className = ' ' + ob.className + ' ';
		for (var j = 0, len = value.length; j < len; j++)
		{
			if (BX.hasClass(ob, value[j]))
			{
				className = (' ' + className + ' ').replace(' ' + value[j] + ' ', ' ');
				className += ' ' + value[j >= len-1 ? 0 : j+1];

				j--;
				break;
			}
		}

		if (j == len)
			ob.className += ' ' + value[0];
		else
			ob.className = className;

		ob.className = BX.util.trim(ob.className);
	}
	else if (BX.type.isNotEmptyString(value))
	{
		if (!!ob.classList)
		{
			ob.classList.toggle(value);
		}
		else
		{
			className = ob.className;
			if (BX.hasClass(ob, value))
			{
				className = (' ' + className + ' ').replace(' ' + value + ' ', ' ');
			}
			else
			{
				className += ' ' + value;
			}

			ob.className = BX.util.trim(className);
		}
	}

	return ob;
};

BX.hasClass = function(el, className)
{
	el = BX(el);
	if (!el || !BX.type.isDomNode(el))
	{
		BX.debug(el);
		return false;
	}

	if (!el.className || !className)
	{
		return false;
	}

	if (!!el.classList && !!className && className.indexOf(' ') < 0)
	{
		return el.classList.contains(BX.util.trim(className));
	}
	else
		return ((" " + el.className + " ").indexOf(" " + className + " ")) >= 0;
};

BX.setOpacity = function(ob, percentage)
{
	if (ob.style.filter != null)
	{
		//IE
		ob.style.zoom = "100%";

		if (percentage == 100)
		{
			ob.style.filter = "";
		}
		else
		{
			ob.style.filter = 'alpha(opacity=' + percentage.toString() + ')';
		}
	}
	else if (ob.style.opacity != null)
	{
		// W3C
		ob.style.opacity = (percentage / 100).toString();
	}
	else if (ob.style.MozOpacity != null)
	{
		// Mozilla
		ob.style.MozOpacity = (percentage / 100).toString();
	}
};

BX.hoverEvents = function(el)
{
	if (el)
		return BX.adjust(el, {events: BX.hoverEvents()});
	else
		return {mouseover: BX.hoverEventsHover, mouseout: BX.hoverEventsHout};
};

BX.hoverEventsHover = function(){BX.addClass(this,'bx-hover');this.BXHOVER=true;};
BX.hoverEventsHout = function(){BX.removeClass(this,'bx-hover');this.BXHOVER=false;};

BX.focusEvents = function(el)
{
	if (el)
		return BX.adjust(el, {events: BX.focusEvents()});
	else
		return {mouseover: BX.focusEventsFocus, mouseout: BX.focusEventsBlur};
};

BX.focusEventsFocus = function(){BX.addClass(this,'bx-focus');this.BXFOCUS=true;};
BX.focusEventsBlur = function(){BX.removeClass(this,'bx-focus');this.BXFOCUS=false;};

BX.setUnselectable = function(node)
{
	node.style.userSelect = node.style.MozUserSelect = node.style.WebkitUserSelect = node.style.KhtmlUserSelect = node.style = 'none';
	node.setAttribute('unSelectable', 'on');
};

BX.setSelectable = function(node)
{
	node.style.userSelect = node.style.MozUserSelect = node.style.WebkitUserSelect = node.style.KhtmlUserSelect = node.style = '';
	node.removeAttribute('unSelectable');
};

BX.styleIEPropertyName = function(name)
{
	if (name == 'float')
		name = BX.browser.IsIE() ? 'styleFloat' : 'cssFloat';
	else
	{
		var res = BX.browser.isPropertySupported(name);
		if (res)
		{
			name = res;
		}
		else
		{
			var reg = /(\-([a-z]){1})/g;
			if (reg.test(name))
			{
				name = name.replace(reg, function () {return arguments[2].toUpperCase();});
			}
		}
	}
	return name;
};

/* CSS-notation should be used here */
BX.style = function(el, property, value)
{
	if (!BX.type.isElementNode(el))
		return null;

	if (value == null)
	{
		var res;

		if(el.currentStyle)
			res = el.currentStyle[BX.styleIEPropertyName(property)];
		else if(window.getComputedStyle)
		{
			var q = BX.browser.isPropertySupported(property, true);
			if (!!q)
				property = q;

			res = BX.GetContext(el).getComputedStyle(el, null).getPropertyValue(property);
		}

		if(!res)
			res = '';
		return res;
	}
	else
	{
		el.style[BX.styleIEPropertyName(property)] = value;
		return el;
	}
};

BX.focus = function(el)
{
	try
	{
		el.focus();
		return true;
	}
	catch (e)
	{
		return false;
	}
};

BX.firstChild = function(el)
{
	var e = el.firstChild;
	while (e && !BX.type.isElementNode(e))
	{
		e = e.nextSibling;
	}

	return e;
};

BX.lastChild = function(el)
{
	var e = el.lastChild;
	while (e && !BX.type.isElementNode(e))
	{
		e = e.previousSibling;
	}

	return e;
};

BX.previousSibling = function(el)
{
	var e = el.previousSibling;
	while (e && !BX.type.isElementNode(e))
	{
		e = e.previousSibling;
	}

	return e;
};

BX.nextSibling = function(el)
{
	var e = el.nextSibling;
	while (e && !BX.type.isElementNode(e))
	{
		e = e.nextSibling;
	}

	return e;
};

/*
	params: {
		obj : html node
		className : className value
		recursive : used only for older browsers to optimize the tree traversal, in new browsers the search is always recursively, default - true
	}

	Search all nodes with className
*/
BX.findChildrenByClassName = function(obj, className, recursive)
{
	if(!obj || !obj.childNodes) return null;

	var result = [];
	if (typeof(obj.getElementsByClassName) == 'undefined')
	{
		recursive = recursive !== false;
		result = BX.findChildren(obj, {className : className}, recursive);
	}
	else
	{
		var col = obj.getElementsByClassName(className);
		for (i=0,l=col.length;i<l;i++)
		{
			result[i] = col[i];
		}
	}
	return result;
};

/*
	params: {
		obj : html node
		className : className value
		recursive : used only for older browsers to optimize the tree traversal, in new browsers the search is always recursively, default - true
	}

	Search first node with className
*/
BX.findChildByClassName = function(obj, className, recursive)
{
	if(!obj || !obj.childNodes) return null;

	var result = null;
	if (typeof(obj.getElementsByClassName) == 'undefined')
	{
		recursive = recursive !== false;
		result = BX.findChild(obj, {className : className}, recursive);
	}
	else
	{
		var col = obj.getElementsByClassName(className);
		if (col && typeof(col[0]) != 'undefined')
		{
			result = col[0];
		}
		else
		{
			result = null;
		}
	}
	return result;
};

/*
	params: {
		tagName|tag : 'tagName',
		className|class : 'className',
		attribute : {attribute : value, attribute : value} | attribute | [attribute, attribute....],
		property : {prop: value, prop: value} | prop | [prop, prop]
	}

	all values can be RegExps or strings
*/
BX.findChildren = function(obj, params, recursive)
{
	return BX.findChild(obj, params, recursive, true);
};

BX.findChild = function(obj, params, recursive, get_all)
{
	if(!obj || !obj.childNodes) return null;

	recursive = !!recursive; get_all = !!get_all;

	var n = obj.childNodes.length, result = [];

	for (var j=0; j<n; j++)
	{
		var child = obj.childNodes[j];

		if (_checkNode(child, params))
		{
			if (get_all)
				result.push(child);
			else
				return child;
		}

		if(recursive == true)
		{
			var res = BX.findChild(child, params, recursive, get_all);
			if (res)
			{
				if (get_all)
					result = BX.util.array_merge(result, res);
				else
					return res;
			}
		}
	}

	if (get_all || result.length > 0)
		return result;
	else
		return null;
};

BX.findParent = function(obj, params, maxParent)
{
	if(!obj)
		return null;

	var o = obj;
	while(o.parentNode)
	{
		var parent = o.parentNode;

		if (_checkNode(parent, params))
			return parent;

		o = parent;

		if (!!maxParent &&
			(BX.type.isFunction(maxParent)
				|| typeof maxParent == 'object'))
		{
			if (BX.type.isElementNode(maxParent))
			{
				if (o == maxParent)
					break;
			}
			else
			{
				if (_checkNode(o, maxParent))
					break;
			}
		}
	}
	return null;
};

BX.findNextSibling = function(obj, params)
{
	if(!obj)
		return null;
	var o = obj;
	while(o.nextSibling)
	{
		var sibling = o.nextSibling;
		if (_checkNode(sibling, params))
			return sibling;
		o = sibling;
	}
	return null;
};

BX.findPreviousSibling = function(obj, params)
{
	if(!obj)
		return null;

	var o = obj;
	while(o.previousSibling)
	{
		var sibling = o.previousSibling;
		if(_checkNode(sibling, params))
			return sibling;
		o = sibling;
	}
	return null;
};

BX.checkNode = function(obj, params)
{
	return _checkNode(obj, params);
};

BX.findFormElements = function(form)
{
	if (BX.type.isString(form))
		form = document.forms[form]||BX(form);

	var res = [];

	if (BX.type.isElementNode(form))
	{
		if (form.tagName.toUpperCase() == 'FORM')
		{
			res = form.elements;
		}
		else
		{
			res = BX.findChildren(form, CHECK_FORM_ELEMENTS, true);
		}
	}

	return res;
};

BX.isParentForNode = function(whichNode, forNode)
{

	if(!BX.type.isDomNode(whichNode) || !BX.type.isDomNode(forNode))
		return false;

	while(true){

		if(whichNode == forNode)
			return true;

		if(forNode && forNode.parentNode)
			forNode = forNode.parentNode;
		else
			break;
	}

	return false;
}

BX.clone = function(obj, bCopyObj)
{
	var _obj, i, l;
	if (bCopyObj !== false)
		bCopyObj = true;

	if (obj === null)
		return null;

	if (BX.type.isDomNode(obj))
	{
		_obj = obj.cloneNode(bCopyObj);
	}
	else if (typeof obj == 'object')
	{
		if (BX.type.isArray(obj))
		{
			_obj = [];
			for (i=0,l=obj.length;i<l;i++)
			{
				if (typeof obj[i] == "object" && bCopyObj)
					_obj[i] = BX.clone(obj[i], bCopyObj);
				else
					_obj[i] = obj[i];
			}
		}
		else
		{
			_obj =  {};
			if (obj.constructor)
			{
				if (obj.constructor === Date)
					_obj = new Date(obj);
				else
					_obj = new obj.constructor();
			}

			for (i in obj)
			{
				if (typeof obj[i] == "object" && bCopyObj)
					_obj[i] = BX.clone(obj[i], bCopyObj);
				else
					_obj[i] = obj[i];
			}
		}

	}
	else
	{
		_obj = obj;
	}

	return _obj;
};

BX.merge = function(){
	var arg = Array.prototype.slice.call(arguments);

	if(arg.length < 2)
		return {};

	var result = arg.shift();

	for(var i = 0; i < arg.length; i++)
	{
		for(var k in arg[i]){

			if(typeof arg[i] == 'undefined' || arg[i] == null)
				continue;

			if(arg[i].hasOwnProperty(k)){

				if(typeof arg[i][k] == 'undefined' || arg[i][k] == null)
					continue;

				if(typeof arg[i][k] == 'object' && !BX.type.isDomNode(arg[i][k]) && (typeof arg[i][k]['isUIWidget'] == 'undefined')){

					// go deeper

					var isArray = 'length' in arg[i][k];

					if(typeof result[k] != 'object')
						result[k] = isArray ? [] : {};

					if(isArray)
						BX.util.array_merge(result[k], arg[i][k]);
					else
						BX.merge(result[k], arg[i][k]);

				}else
					result[k] = arg[i][k];
			}
		}
	}

	return result;
};

/* events */
BX.bind = function(el, evname, func)
{
	if (!el)
	{
		return;
	}

	if (evname === 'mousewheel')
	{
		BX.bind(el, 'DOMMouseScroll', func);
	}
	else if (evname === 'transitionend')
	{
		BX.bind(el, 'webkitTransitionEnd', func);
		BX.bind(el, 'msTransitionEnd', func);
		BX.bind(el, 'oTransitionEnd', func);
		// IE8-9 doesn't support this feature!
	}
	else if (evname === 'bxchange')
	{
		BX.bind(el, "change", func);
		BX.bind(el, "cut", func);
		BX.bind(el, "paste", func);
		BX.bind(el, "drop", func);
		BX.bind(el, "keyup", func);

		return;
	}

	if (el.addEventListener) // Gecko / W3C
	{
		el.addEventListener(evname, func, false);
	}
	else if (el.attachEvent) // IE
	{
		el.attachEvent("on" + evname, BX.proxy(func, el));
	}
	else
	{
		try
		{
			el["on" + evname] = func;
		}
		catch(e)
		{
			BX.debug(e)
		}
	}

	eventsList[eventsList.length] = {'element': el, 'event': evname, 'fn': func};
};

BX.unbind = function(el, evname, func)
{
	if (!el)
	{
		return;
	}

	if (evname === 'mousewheel')
	{
		BX.unbind(el, 'DOMMouseScroll', func);
	}
	else if (evname === 'transitionend')
	{
		BX.unbind(el, 'webkitTransitionEnd', func);
		BX.unbind(el, 'msTransitionEnd', func);
		BX.unbind(el, 'oTransitionEnd', func);
	}
	else if (evname === 'bxchange')
	{
		BX.unbind(el, "change", func);
		BX.unbind(el, "cut", func);
		BX.unbind(el, "paste", func);
		BX.unbind(el, "drop", func);
		BX.unbind(el, "keyup", func);

		return;
	}

	if(el.removeEventListener) // Gecko / W3C
	{
		el.removeEventListener(evname, func, false);
	}
	else if(el.detachEvent) // IE
	{
		el.detachEvent("on" + evname, BX.proxy(func, el));
	}
	else
	{
		el["on" + evname] = null;
	}
};

BX.getEventButton = function(e)
{
	e = e || window.event;

	var flags = 0;

	if (typeof e.which != 'undefined')
	{
		switch (e.which)
		{
			case 1: flags = flags|BX.MSLEFT; break;
			case 2: flags = flags|BX.MSMIDDLE; break;
			case 3: flags = flags|BX.MSRIGHT; break;
		}
	}
	else if (typeof e.button != 'undefined')
	{
		flags = event.button;
	}

	return flags || BX.MSLEFT;
};

BX.unbindAll = function(el)
{
	if (!el)
		return;

	for (var i=0,len=eventsList.length; i<len; i++)
	{
		try
		{
			if (eventsList[i] && (null==el || el==eventsList[i].element))
			{
				BX.unbind(eventsList[i].element, eventsList[i].event, eventsList[i].fn);
				eventsList[i] = null;
			}
		}
		catch(e){}
	}

	if (null==el)
	{
		eventsList = [];
	}
};

var captured_events = null, _bind = null;
BX.CaptureEvents = function(el_c, evname_c)
{
	if (_bind)
		return;

	_bind = BX.bind;
	captured_events = [];

	BX.bind = function(el, evname, func)
	{
		if (el === el_c && evname === evname_c)
			captured_events.push(func);

		_bind.apply(this, arguments);
	}
};

BX.CaptureEventsGet = function()
{
	if (_bind)
	{
		BX.bind = _bind;

		var captured = captured_events;

		_bind = null;
		captured_events = null;
		return captured;
	}
	return null;
};

// Don't even try to use it for submit event!
BX.fireEvent = function(ob,ev)
{
	var result = false, e = null;
	if (BX.type.isDomNode(ob))
	{
		result = true;
		if (document.createEventObject)
		{
			// IE
			if (eventTypes[ev] != 'MouseEvent')
			{
				e = document.createEventObject();
				e.type = ev;
				result = ob.fireEvent('on' + ev, e);
			}

			if (ob[ev])
			{
				ob[ev]();
			}
		}
		else
		{
			// non-IE
			e = null;

			switch (eventTypes[ev])
			{
				case 'MouseEvent':
					e = document.createEvent('MouseEvent');
					e.initMouseEvent(ev, true, true, top, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, null);
				break;
				default:
					e = document.createEvent('Event');
					e.initEvent(ev, true, true);
			}

			result = ob.dispatchEvent(e);
		}
	}

	return result;
};

BX.getWheelData = function(e)
{
	e = e || window.event;
	e.wheelData = e.detail ? e.detail * -1 : e.wheelDelta / 40;
	return e.wheelData;
};

BX.proxy_context = null;

BX.delegate = function (func, thisObject)
{
	if (!func || !thisObject)
		return func;

	return function() {
		var cur = BX.proxy_context;
		BX.proxy_context = this;
		var res = func.apply(thisObject, arguments);
		BX.proxy_context = cur;
		return res;
	}
};

BX.delegateLater = function (func_name, thisObject, contextObject)
{
	return function()
	{
		if (thisObject[func_name])
		{
			var cur = BX.proxy_context;
			BX.proxy_context = this;
			var res = thisObject[func_name].apply(contextObject||thisObject, arguments);
			BX.proxy_context = cur;
			return res;
		}
		return null;
	}
};

BX._initObjectProxy = function(thisObject)
{
	if (typeof thisObject['__proxy_id_' + proxySalt] == 'undefined')
	{
		thisObject['__proxy_id_' + proxySalt] = proxyList.length;
		proxyList[thisObject['__proxy_id_' + proxySalt]] = {};
	}
};

BX.proxy = function(func, thisObject)
{
	if (!func || !thisObject)
		return func;

	BX._initObjectProxy(thisObject);

	if (typeof func['__proxy_id_' + proxySalt] == 'undefined')
		func['__proxy_id_' + proxySalt] = proxyId++;

	if (!proxyList[thisObject['__proxy_id_' + proxySalt]][func['__proxy_id_' + proxySalt]])
		proxyList[thisObject['__proxy_id_' + proxySalt]][func['__proxy_id_' + proxySalt]] = BX.delegate(func, thisObject);

	return proxyList[thisObject['__proxy_id_' + proxySalt]][func['__proxy_id_' + proxySalt]];
};

BX.defer = function(func, thisObject)
{
	if (!!thisObject)
		return BX.defer_proxy(func, thisObject);
	else
		return function() {
			var arg = arguments;
			setTimeout(function(){func.apply(this,arg)}, 10);
		};
};

BX.defer_proxy = function(func, thisObject)
{
	if (!func || !thisObject)
		return func;

	BX.proxy(func, thisObject);

	this._initObjectProxy(thisObject);

	if (typeof func['__defer_id_' + proxySalt] == 'undefined')
		func['__defer_id_' + proxySalt] = proxyId++;

	if (!proxyList[thisObject['__proxy_id_' + proxySalt]][func['__defer_id_' + proxySalt]])
	{
		proxyList[thisObject['__proxy_id_' + proxySalt]][func['__defer_id_' + proxySalt]] = BX.defer(BX.delegate(func, thisObject));
	}

	return proxyList[thisObject['__proxy_id_' + proxySalt]][func['__defer_id_' + proxySalt]];
};

BX.once = function(el, evname, func)
{
	if (typeof func['__once_id_' + evname + '_' + proxySalt] == 'undefined')
	{
		func['__once_id_' + evname + '_' + proxySalt] = proxyId++;
	}

	this._initObjectProxy(el);

	if (!proxyList[el['__proxy_id_' + proxySalt]][func['__once_id_' + evname + '_' + proxySalt]])
	{
		var g = function()
		{
			BX.unbind(el, evname, g);
			func.apply(this, arguments);
		};

		proxyList[el['__proxy_id_' + proxySalt]][func['__once_id_' + evname + '_' + proxySalt]] = g;
	}

	return proxyList[el['__proxy_id_' + proxySalt]][func['__once_id_' + evname + '_' + proxySalt]];
};

BX.bindDelegate = function (elem, eventName, isTarget, handler)
{
	var h = BX.delegateEvent(isTarget, handler);
	BX.bind(elem, eventName, h);
	return h;
};

BX.delegateEvent = function(isTarget, handler)
{
	return function(e)
	{
		e = e || window.event;
		var target = e.target || e.srcElement;

		while (target != this)
		{
			if (_checkNode(target, isTarget))
			{
				return handler.call(target, e);
			}
			if (target && target.parentNode)
				target = target.parentNode;
			else
				break;
		}
		return null;
	}
};

BX.False = function() {return false;};
BX.DoNothing = function() {};

// TODO: also check event handlers set via BX.bind()
BX.denyEvent = function(el, ev)
{
	deniedEvents.push([el, ev, el['on' + ev]]);
	el['on' + ev] = BX.DoNothing;
};

BX.allowEvent = function(el, ev)
{
	for(var i=0, len=deniedEvents.length; i<len; i++)
	{
		if (deniedEvents[i][0] == el && deniedEvents[i][1] == ev)
		{
			el['on' + ev] = deniedEvents[i][2];
			BX.util.deleteFromArray(deniedEvents, i);
			return;
		}
	}
};

BX.fixEventPageXY = function(event)
{
	BX.fixEventPageX(event);
	BX.fixEventPageY(event);
	return event;
};

BX.fixEventPageX = function(event)
{
	if (event.pageX == null && event.clientX != null)
	{
		event.pageX =
			event.clientX +
			(document.documentElement && document.documentElement.scrollLeft || document.body && document.body.scrollLeft || 0) -
			(document.documentElement.clientLeft || 0);
	}

	return event;
};

BX.fixEventPageY = function(event)
{
	if (event.pageY == null && event.clientY != null)
	{
		event.pageY =
			event.clientY +
			(document.documentElement && document.documentElement.scrollTop || document.body && document.body.scrollTop || 0) -
			(document.documentElement.clientTop || 0);
	}

	return event;
};

BX.PreventDefault = function(e)
{
	if(!e) e = window.event;
	if(e.stopPropagation)
	{
		e.preventDefault();
		e.stopPropagation();
	}
	else
	{
		e.cancelBubble = true;
		e.returnValue = false;
	}
	return false;
};

BX.eventReturnFalse = function(e)
{
	e=e||window.event;
	if (e && e.preventDefault) e.preventDefault();
	else e.returnValue = false;
	return false;
};

BX.eventCancelBubble = function(e)
{
	e=e||window.event;
	if(e && e.stopPropagation)
		e.stopPropagation();
	else
		e.cancelBubble = true;
};

/* custom events */
/*
	BX.addCustomEvent(eventObject, eventName, eventHandler) - set custom event handler for particular object
	BX.addCustomEvent(eventName, eventHandler) - set custom event handler for all objects
*/
BX.addCustomEvent = function(eventObject, eventName, eventHandler)
{
	/* shift parameters for short version */
	if (BX.type.isString(eventObject))
	{
		eventHandler = eventName;
		eventName = eventObject;
		eventObject = window;
	}

	eventName = eventName.toUpperCase();

	if (!customEvents[eventName])
		customEvents[eventName] = [];

	customEvents[eventName].push(
		{
			handler: eventHandler,
			obj: eventObject
		}
	);
};

BX.removeCustomEvent = function(eventObject, eventName, eventHandler)
{
	/* shift parameters for short version */
	if (BX.type.isString(eventObject))
	{
		eventHandler = eventName;
		eventName = eventObject;
		eventObject = window;
	}

	eventName = eventName.toUpperCase();

	if (!customEvents[eventName])
		return;

	for (var i = 0, l = customEvents[eventName].length; i < l; i++)
	{
		if (!customEvents[eventName][i])
			continue;
		if (customEvents[eventName][i].handler == eventHandler && customEvents[eventName][i].obj == eventObject)
		{
			delete customEvents[eventName][i];
			return;
		}
	}
};

// Warning! Don't use secureParams with DOM nodes in arEventParams
BX.onCustomEvent = function(eventObject, eventName, arEventParams, secureParams)
{
	/* shift parameters for short version */
	if (BX.type.isString(eventObject))
	{
		secureParams = arEventParams;
		arEventParams = eventName;
		eventName = eventObject;
		eventObject = window;
	}

	eventName = eventName.toUpperCase();

	if (!customEvents[eventName])
		return;

	if (!arEventParams)
		arEventParams = [];

	var h;
	for (var i = 0, l = customEvents[eventName].length; i < l; i++)
	{
		h = customEvents[eventName][i];
		if (!h || !h.handler)
			continue;

		if (h.obj == window || /*eventObject == window || */h.obj == eventObject) //- only global event handlers will be called
		{
			h.handler.apply(eventObject, !!secureParams ? BX.clone(arEventParams) : arEventParams);
		}
	}
};

BX.bindDebouncedChange = function(node, fn, fnInstant, timeout, ctx)
{
	ctx = ctx || window;
	timeout = timeout || 300;

	var dataTag = 'bx-dc-previous-value';
	BX.data(node, dataTag, node.value);

	var act = function(fn, val){

		var pVal = BX.data(node, dataTag);

		if(typeof pVal == 'undefined' || pVal != val){
			if(typeof ctx != 'object')
				fn(val);
			else
				fn.apply(ctx, [val]);
		}
	};

	var actD = BX.debounce(function(){
		var val = node.value;
		act(fn, val);
		BX.data(node, dataTag, val);
	}, timeout);

	BX.bind(node, 'keyup', actD);
	BX.bind(node, 'change', actD);
	BX.bind(node, 'input', actD);

	if(BX.type.isFunction(fnInstant)){

		var actI = function(){
			act(fnInstant, node.value);
		};

		BX.bind(node, 'keyup', actI);
		BX.bind(node, 'change', actI);
		BX.bind(node, 'input', actI);
	}
};

BX.parseJSON = function(data, context)
{
	var result = null;
	if (BX.type.isString(data))
	{
		try {
			if (data.indexOf("\n") >= 0)
				eval('result = ' + data);
			else
				result = (new Function("return " + data))();
		} catch(e) {
			BX.onCustomEvent(context, 'onParseJSONFailure', [data, context])
		}
	}
	else if(BX.type.isPlainObject(data))
	{
		return data;
	}

	return result;
};

/* ready */
BX.isReady = false;
BX.ready = function(handler)
{
	bindReady();

	if (!BX.type.isFunction(handler))
	{
		BX.debug('READY: not a function! ', handler);
	}
	else
	{
		if (BX.isReady)
			handler.call(document);
		else if (readyList)
			readyList.push(handler);
	}
};

BX.submit = function(obForm, action_name, action_value, onAfterSubmit)
{
	action_name = action_name || 'save';
	if (!obForm['BXFormSubmit_' + action_name])
	{
		obForm['BXFormSubmit_' + action_name] = obForm.appendChild(BX.create('INPUT', {
			'props': {
				'type': 'submit',
				'name': action_name,
				'value': action_value || 'Y'
			},
			'style': {
				'display': 'none'
			}
		}));
	}

	if (obForm.sessid)
		obForm.sessid.value = BX.bitrix_sessid();

	setTimeout(BX.delegate(function() {BX.fireEvent(this, 'click'); if (onAfterSubmit) onAfterSubmit();}, obForm['BXFormSubmit_' + action_name]), 10);
};

// returns function which runs fn in timeout ms after returned function is finished being called
BX.debounce = function(fn, timeout, ctx)
{
	var timer = 0;

	return function()
	{
		ctx = ctx || this;
		var args = arguments;

		clearTimeout(timer);

		timer = setTimeout(function()
		{
			fn.apply(ctx, args);
		}, timeout);
	}
};

// returns function which runs fn and repeats every timeout ms while returned function is being called
BX.throttle = function(fn, timeout, ctx)
{

	var timer = 0,
		args = null,
		invoke;

	return function()
	{
		ctx = ctx || this;
		args = arguments;
		invoke = true;

		if(!timer)
		{
			var q = function()
			{
				if(invoke)
				{
					fn.apply(ctx, args);
					invoke = false;
					timer = setTimeout(q, timeout);
				}
				else
				{
					timer = null;
				}
			};
			q();
		}
	};
};

/* browser detection */
BX.browser = {

	IsIE: function()
	{
		return bIE;
	},

	IsIE6: function()
	{
		return (/MSIE 6/i.test(navigator.userAgent));
	},

	IsIE7: function()
	{
		return (/MSIE 7/i.test(navigator.userAgent));
	},

	IsIE8: function()
	{
		return (/MSIE 8/i.test(navigator.userAgent));
	},

	IsIE9: function()
	{
		return !!document.documentMode && document.documentMode >= 9;
	},

	IsIE10: function()
	{
		return !!document.documentMode && document.documentMode >= 10;
	},

	IsIE11: function()
	{
		return BX.browser.DetectIeVersion() >= 11;
	},

	IsOpera: function()
	{
		return bOpera;
	},

	IsSafari: function()
	{
		return bSafari;
	},

	IsFirefox: function()
	{
		return bFirefox;
	},

	IsChrome: function()
	{
		return bChrome;
	},

	IsMac: function()
	{
		return (/Macintosh/i.test(navigator.userAgent));
	},

	IsAndroid: function()
	{
		return (/Android/i.test(navigator.userAgent));
	},

	IsIOS: function()
	{
		return (/(iPad;)|(iPhone;)/i.test(navigator.userAgent));
	},

	IsMobile: function()
	{
		return (/(ipad|iphone|android|mobile|touch)/i.test(navigator.userAgent));
	},

	DetectIeVersion: function()
	{
		if(BX.browser.IsOpera() || BX.browser.IsSafari() || BX.browser.IsFirefox() || BX.browser.IsChrome())
		{
			return -1;
		}

		var rv = -1;
		if (!!(window.MSStream) && !(window.ActiveXObject) && ("ActiveXObject" in window))
		{
			//Primary check for IE 11 based on ActiveXObject behaviour (please see http://msdn.microsoft.com/en-us/library/ie/dn423948%28v=vs.85%29.aspx)
			rv = 11;
		}
		else if (BX.browser.IsIE10())
		{
			rv = 10;
		}
		else if (BX.browser.IsIE9())
		{
			rv = 9;
		}
		else if (BX.browser.IsIE())
		{
			rv = 8;
		}

		if (rv == -1 || rv == 8)
		{
			var re;
			if (navigator.appName == "Microsoft Internet Explorer")
			{
				re = new RegExp("MSIE ([0-9]+[\.0-9]*)");
				if (re.exec(navigator.userAgent) != null)
					rv = parseFloat( RegExp.$1 );
			}
			else if (navigator.appName == "Netscape")
			{
				//Alternative check for IE 11
				rv = 11;
				re = new RegExp("Trident/.*rv:([0-9]+[\.0-9]*)");
				if (re.exec(navigator.userAgent) != null)
					rv = parseFloat( RegExp.$1 );
			}
		}

		return rv;
	},

	IsDoctype: function(pDoc)
	{
		pDoc = pDoc || document;

		if (pDoc.compatMode)
			return (pDoc.compatMode == "CSS1Compat");

		return (pDoc.documentElement && pDoc.documentElement.clientHeight);
	},

	SupportLocalStorage: function()
	{
		return !!BX.localStorage && !!BX.localStorage.checkBrowser()
	},

	addGlobalClass: function() {

		var globalClass = "bx-core";
		if (BX.hasClass(document.documentElement, globalClass))
		{
			return;
		}

		//Mobile
		if (BX.browser.IsIOS())
		{
			globalClass += " bx-ios";
		}
		else if (BX.browser.IsMac())
		{
			globalClass += " bx-mac";
		}
		else if (BX.browser.IsAndroid())
		{
			globalClass += " bx-android";
		}

		globalClass += (BX.browser.IsMobile() ? " bx-touch" : " bx-no-touch");
		globalClass += (BX.browser.isRetina() ? " bx-retina" : " bx-no-retina");

		//Desktop
		var ieVersion = -1;
		if (/AppleWebKit/.test(navigator.userAgent))
		{
			globalClass += " bx-chrome";
		}
		else if ((ieVersion = BX.browser.DetectIeVersion()) > 0)
		{
			globalClass += " bx-ie bx-ie" + ieVersion;
			if (ieVersion > 7 && ieVersion < 10 && !BX.browser.IsDoctype())
			{
				// it seems IE10 doesn't have any specific bugs like others event in quirks mode
				globalClass += " bx-quirks";
			}
		}
		else if (/Opera/.test(navigator.userAgent))
		{
			globalClass += " bx-opera";
		}
		else if (/Gecko/.test(navigator.userAgent))
		{
			globalClass += " bx-firefox";
		}

		BX.addClass(document.documentElement, globalClass);
	},

	isPropertySupported: function(jsProperty, bReturnCSSName)
	{
		if (!BX.type.isNotEmptyString(jsProperty))
			return false;

		var property = jsProperty.indexOf("-") > -1 ? getJsName(jsProperty) : jsProperty;
		bReturnCSSName = !!bReturnCSSName;

		var ucProperty = property.charAt(0).toUpperCase() + property.slice(1);
		var properties = (property + ' ' + ["Webkit", "Moz", "O", "ms"].join(ucProperty + " ") + ucProperty).split(" ");
		var obj = document.body || document.documentElement;

		for (var i = 0; i < properties.length; i++)
		{
			var prop = properties[i];
			if (obj.style[prop] !== undefined)
			{
				var prefix = prop == property
							? ""
							: "-" + prop.substr(0, prop.length - property.length).toLowerCase() + "-";
				return bReturnCSSName ? prefix + getCssName(property) : prop;
			}
		}

		function getCssName(propertyName)
		{
			return propertyName.replace(/([A-Z])/g, function() { return "-" + arguments[1].toLowerCase(); } )
		}

		function getJsName(cssName)
		{
			var reg = /(\-([a-z]){1})/g;
			if (reg.test(cssName))
				return cssName.replace(reg, function () {return arguments[2].toUpperCase();});
			else
				return cssName;
		}

		return false;
	},

	addGlobalFeatures : function(features, prefix)
	{
		if (!BX.type.isArray(features))
			return;

		var classNames = [];
		for (var i = 0; i < features.length; i++)
		{
			var support = !!BX.browser.isPropertySupported(features[i]);
			classNames.push( "bx-" + (support ? "" : "no-") + features[i].toLowerCase());
		}
		BX.addClass(document.documentElement, classNames.join(" "));
	},

	isRetina : function()
	{
		return window.devicePixelRatio && window.devicePixelRatio >= 2;
	}
};

/* low-level fx funcitons*/
BX.show = function(ob, displayType)
{
	if (ob.BXDISPLAY || !_checkDisplay(ob, displayType))
	{
		ob.style.display = ob.BXDISPLAY;
	}
};

BX.hide = function(ob, displayType)
{
	if (!ob.BXDISPLAY)
		_checkDisplay(ob, displayType);

	ob.style.display = 'none';
};

BX.toggle = function(ob, values)
{
	if (!values && BX.type.isElementNode(ob))
	{
		var bShow = true;
		if (ob.BXDISPLAY)
			bShow = !_checkDisplay(ob);
		else
			bShow = ob.style.display == 'none';

		if (bShow)
			BX.show(ob);
		else
			BX.hide(ob);
	}
	else if (BX.type.isArray(values))
	{
		for (var i=0,len=values.length; i<len; i++)
		{
			if (ob == values[i])
			{
				ob = values[i==len-1 ? 0 : i+1];
				break;
			}
		}
		if (i==len)
			ob = values[0];
	}

	return ob;
};

/* some useful util functions */

BX.util = {
	array_values: function(ar)
	{
		if (!BX.type.isArray(ar))
			return BX.util._array_values_ob(ar);
		var arv = [];
		for(var i=0,l=ar.length;i<l;i++)
			if (ar[i] !== null && typeof ar[i] != 'undefined')
				arv.push(ar[i]);
		return arv;
	},

	_array_values_ob: function(ar)
	{
		var arv = [];
		for(var i in ar)
			if (ar[i] !== null && typeof ar[i] != 'undefined')
				arv.push(ar[i]);
		return arv;
	},

	array_keys: function(ar)
	{
		if (!BX.type.isArray(ar))
			return BX.util._array_keys_ob(ar);
		var arv = [];
		for(var i=0,l=ar.length;i<l;i++)
			if (ar[i] !== null && typeof ar[i] != 'undefined')
				arv.push(i);
		return arv;
	},

	_array_keys_ob: function(ar)
	{
		var arv = [];
		for(var i in ar)
			if (ar[i] !== null && typeof ar[i] != 'undefined')
				arv.push(i);
		return arv;
	},

	object_keys: function(obj)
	{
		var arv = [];
		for(var k in obj)
		{
			if(obj.hasOwnProperty(k))
			{
				arv.push(k);
			}
		}
		return arv;
	},

	array_merge: function(first, second)
	{
		if (!BX.type.isArray(first)) first = [];
		if (!BX.type.isArray(second)) second = [];

		var i = first.length, j = 0;

		if (typeof second.length === "number")
		{
			for (var l = second.length; j < l; j++)
			{
				first[i++] = second[j];
			}
		}
		else
		{
			while (second[j] !== undefined)
			{
				first[i++] = second[j++];
			}
		}

		first.length = i;

		return first;
	},

	array_unique: function(ar)
	{
		var i=0,j,len=ar.length;
		if(len<2) return ar;

		for (; i<len-1;i++)
		{
			for (j=i+1; j<len;j++)
			{
				if (ar[i]==ar[j])
				{
					ar.splice(j--,1); len--;
				}
			}
		}

		return ar;
	},

	in_array: function(needle, haystack)
	{
		for(var i=0; i<haystack.length; i++)
		{
			if(haystack[i] == needle)
				return true;
		}
		return false;
	},

	array_search: function(needle, haystack)
	{
		for(var i=0; i<haystack.length; i++)
		{
			if(haystack[i] == needle)
				return i;
		}
		return -1;
	},

	object_search_key: function(needle, haystack)
	{
		if (typeof haystack[needle] != 'undefined')
			return haystack[needle];

		for(var i in haystack)
		{
			if (typeof haystack[i] == "object")
			{
				var result = BX.util.object_search_key(needle, haystack[i]);
				if (result !== false)
					return result;
			}
		}
		return false;
	},

	trim: function(s)
	{
		if (BX.type.isString(s))
			return s.replace(r.ltrim, '').replace(r.rtrim, '');
		else
			return s;
	},

	urlencode: function(s){return encodeURIComponent(s);},

	// it may also be useful. via sVD.
	deleteFromArray: function(ar, ind) {return ar.slice(0, ind).concat(ar.slice(ind + 1));},
	insertIntoArray: function(ar, ind, el) {return ar.slice(0, ind).concat([el]).concat(ar.slice(ind));},

	htmlspecialchars: function(str)
	{
		if(!str.replace) return str;

		return str.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
	},

	htmlspecialcharsback: function(str)
	{
		if(!str.replace) return str;

		return str.replace(/\&quot;/g, '"').replace(/&#39;/g, "'").replace(/\&lt;/g, '<').replace(/\&gt;/g, '>').replace(/\&amp;/g, '&');
	},

	// Quote regular expression characters plus an optional character
	preg_quote: function(str, delimiter)
	{
		if(!str.replace)
			return str;
		return str.replace(new RegExp('[.\\\\+*?\\[\\^\\]$(){}=!<>|:\\' + (delimiter || '') + '-]', 'g'), '\\$&');
	},

	jsencode: function(str)
	{
		if (!str || !str.replace)
			return str;

		var escapes =
		[
			{ c: "\\\\", r: "\\\\" }, // should be first
			{ c: "\\t", r: "\\t" },
			{ c: "\\n", r: "\\n" },
			{ c: "\\r", r: "\\r" },
			{ c: "\"", r: "\\\"" },
			{ c: "'", r: "\\'" },
			{ c: "<", r: "\\x3C" },
			{ c: ">", r: "\\x3E" },
			{ c: "\\u2028", r: "\\u2028" },
			{ c: "\\u2029", r: "\\u2029" }
		];
		for (var i = 0; i < escapes.length; i++)
			str = str.replace(new RegExp(escapes[i].c, 'g'), escapes[i].r);
		return str;
	},

	nl2br: function(str)
	{
		if (!str || !str.replace)
			return str;

		return str.replace(/([^>])\n/g, '$1<br/>');
	},

	str_pad: function(input, pad_length, pad_string, pad_type)
	{
		pad_string = pad_string || ' ';
		pad_type = pad_type || 'right';
		input = input.toString();

		if (pad_type == 'left')
			return BX.util.str_pad_left(input, pad_length, pad_string);
		else
			return BX.util.str_pad_right(input, pad_length, pad_string);

	},

	str_pad_left: function(input, pad_length, pad_string)
	{
		var i = input.length, q=pad_string.length;
		if (i >= pad_length) return input;

		for(;i<pad_length;i+=q)
			input = pad_string + input;

		return input;
	},

	str_pad_right: function(input, pad_length, pad_string)
	{
		var i = input.length, q=pad_string.length;
		if (i >= pad_length) return input;

		for(;i<pad_length;i+=q)
			input += pad_string;

		return input;
	},

	strip_tags: function(str)
	{
		return str.split(/<[^>]+>/g).join('');
	},

	strip_php_tags: function(str)
	{
		return str.replace(/<\?(.|[\r\n])*?\?>/g, '');
	},

	popup: function(url, width, height)
	{
		var w, h;
		if(BX.browser.IsOpera())
		{
			w = document.body.offsetWidth;
			h = document.body.offsetHeight;
		}
		else
		{
			w = screen.width;
			h = screen.height;
		}
		return window.open(url, '', 'status=no,scrollbars=yes,resizable=yes,width='+width+',height='+height+',top='+Math.floor((h - height)/2-14)+',left='+Math.floor((w - width)/2-5));
	},

	// BX.util.objectSort(object, sortBy, sortDir) - Sort object by property
	// function params: 1 - object for sort, 2 - sort by property, 3 - sort direction (asc/desc)
	// return: sort array [[objectElement], [objectElement]] in sortDir direction

	// example: BX.util.objectSort({'L1': {'name': 'Last'}, 'F1': {'name': 'First'}}, 'name', 'asc');
	// return: [{'name' : 'First'}, {'name' : 'Last'}]
	objectSort: function(object, sortBy, sortDir)
	{
		sortDir = sortDir == 'asc'? 'asc': 'desc';

		var arItems = [], i;
		for (i in object)
		{
			if (object.hasOwnProperty(i) && object[i][sortBy])
			{
				arItems.push([i, object[i][sortBy]]);
			}
		}

		if (sortDir == 'asc')
		{
			arItems.sort(function(i, ii) {
				var s1, s2;
				if (!isNaN(i[1]) && !isNaN(ii[1]))
				{
					s1 = parseInt(i[1]);
					s2 = parseInt(ii[1]);
				}
				else
				{
					s1 = i[1].toString().toLowerCase();
					s2 = ii[1].toString().toLowerCase();
				}

				if (s1 > s2)
					return 1;
				else if (s1 < s2)
					return -1;
				else
					return 0;
			});
		}
		else
		{
			arItems.sort(function(i, ii) {
				var s1, s2;
				if (!isNaN(i[1]) && !isNaN(ii[1]))
				{
					s1 = parseInt(i[1]);
					s2 = parseInt(ii[1]);
				}
				else
				{
					s1 = i[1].toString().toLowerCase();
					s2 = ii[1].toString().toLowerCase();
				}
				if (s1 < s2)
					return 1;
				else if (s1 > s2)
					return -1;
				else
					return 0;
			});
		}

		var arReturnArray = Array();
		for (i = 0; i < arItems.length; i++)
		{
			arReturnArray.push(object[arItems[i][0]]);
		}

		return arReturnArray;
	},

	// #fdf9e5 => {r=253, g=249, b=229}
	hex2rgb: function(color)
	{
		var rgb = color.replace(/[# ]/g,"").replace(/^(.)(.)(.)$/,'$1$1$2$2$3$3').match(/.{2}/g);
		for (var i=0;  i<3; i++)
		{
			rgb[i] = parseInt(rgb[i], 16);
		}
		return {'r':rgb[0],'g':rgb[1],'b':rgb[2]};
	},

	remove_url_param: function(url, param)
	{
		if (BX.type.isArray(param))
		{
			for (var i=0; i<param.length; i++)
			{
				url = BX.util.remove_url_param(url, param[i]);
			}
		}
		else
		{
			var pos, params;
			if((pos = url.indexOf('?')) >= 0 && pos != url.length-1)
			{
				params = url.substr(pos + 1);
				url = url.substr(0, pos + 1);

				params = params.replace(new RegExp('(^|&)'+param+'=[^&#]*', 'i'), '');
				params = params.replace(/^&/, '');
				url = url + params;
			}
		}

		return url;
	},

	/*
	{'param1': 'value1', 'param2': 'value2'}
	 */
	add_url_param: function(url, params)
	{
		var param;
		var additional = '';
		var hash = '';
		var pos;

		for(param in params)
		{
			url = this.remove_url_param(url, param);
			additional += (additional != ''? '&':'') + param + '=' + params[param];
		}

		if((pos = url.indexOf('#')) >= 0)
		{
			hash = url.substr(pos);
			url = url.substr(0, pos);
		}

		if((pos = url.indexOf('?')) >= 0)
		{
			url = url + (pos != url.length-1? '&' : '') + additional + hash;
		}
		else
		{
			url = url + '?' + additional + hash;
		}

		return url;
	},

	even: function(digit)
	{
		return (parseInt(digit) % 2 == 0);
	},

	hashCode: function(str)
	{
		if(!BX.type.isNotEmptyString(str))
		{
			return 0;
		}

		var hash = 0;
		for (var i = 0; i < str.length; i++)
		{
			var c = str.charCodeAt(i);
			hash = ((hash << 5) - hash) + c;
			hash = hash & hash;
		}
		return hash;
	},

	getRandomString: function (length)
	{
		var chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
		var charQty = chars.length;

		length = parseInt(length);
		if(isNaN(length) || length <= 0)
		{
			length = 8;
		}

		var result = "";
		for (var i = 0; i < length; i++)
		{
			result += chars.charAt(Math.floor(Math.random() * charQty));
		}
		return result;
	},

	number_format: function(number, decimals, dec_point, thousands_sep)
	{
		var i, j, kw, kd, km, sign = '';
		decimals = Math.abs(decimals);
		if (isNaN(decimals) || decimals < 0)
		{
			decimals = 2;
		}
		dec_point = dec_point || ',';
		if (typeof thousands_sep === 'undefined')
			thousands_sep = '.';

		number = (+number || 0).toFixed(decimals);
		if (number < 0)
		{
			sign = '-';
			number = -number;
		}

		i = parseInt(number, 10) + '';
		j = (i.length > 3 ? i.length % 3 : 0);

		km = (j ? i.substr(0, j) + thousands_sep : '');
		kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
		kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, '0').slice(2) : '');

		return sign + km + kw + kd;
	},

	getExtension: function (url)
	{
		url = url || "";
		var items = url.split("?")[0].split(".");
		return items[items.length-1].toLowerCase();
	},
	addObjectToForm: function(object, form, prefix)
	{
		if(!BX.type.isString(prefix))
		{
			prefix = "";
		}

		for(var key in object)
		{
			if(!object.hasOwnProperty(key))
			{
				continue;
			}

			var value = object[key];
			var name = prefix !== "" ? (prefix + "[" + key + "]") : key;
			if(BX.type.isArray(value))
			{
				for(var i = 0; i < value.length; i++)
				{
					BX.util.addObjectToForm(value[i], form, (name + "[" + i.toString() + "]"));
				}
			}
			else if(BX.type.isPlainObject(value))
			{
				BX.util.addObjectToForm(value, form, name);
			}
			else
			{
				value = BX.type.isFunction(value.toString) ? value.toString() : "";
				if(value !== "")
				{
					form.appendChild(BX.create("INPUT", { attrs: { type: "hidden", name: name, value: value } }));
				}
			}
		}
	},

	observe: function(object, enable)
	{
		if (!BX.browser.IsChrome() || typeof(object) != 'object')
			return false;

		enable = enable !== false;

		var observer = function(options)
		{
			options.forEach(function(option){
				var groupName = option.name + ' changed';
				console.groupCollapsed(groupName);
				console.log('Old value: ', option.oldValue);
				console.log('New value: ', option.object[option.name]);
				console.groupEnd(groupName);
			});
		}
		if (enable)
		{
			Object.observe(object, observer);
		}
		else
		{
			Object.unobserve(object, observer);
		}

		return enable;
	}
};

BX.type = {
	isString: function(item) {
		return item === '' ? true : (item ? (typeof (item) == "string" || item instanceof String) : false);
	},
	isNotEmptyString: function(item) {
		return BX.type.isString(item) ? item.length > 0 : false;
	},
	isBoolean: function(item) {
		return item === true || item === false;
	},
	isNumber: function(item) {
		return item === 0 ? true : (item ? (typeof (item) == "number" || item instanceof Number) : false);
	},
	isFunction: function(item) {
		return item === null ? false : (typeof (item) == "function" || item instanceof Function);
	},
	isElementNode: function(item) {
		//document.body.ELEMENT_NODE;
		return item && typeof (item) == "object" && "nodeType" in item && item.nodeType == 1 && item.tagName && item.tagName.toUpperCase() != 'SCRIPT' && item.tagName.toUpperCase() != 'STYLE' && item.tagName.toUpperCase() != 'LINK';
	},
	isDomNode: function(item) {
		return item && typeof (item) == "object" && "nodeType" in item;
	},
	isArray: function(item) {
		return item && Object.prototype.toString.call(item) == "[object Array]";
	},
	isDate : function(item) {
		return item && Object.prototype.toString.call(item) == "[object Date]";
	},
	isPlainObject: function(item)
	{
		if(!item || typeof(item) !== "object" || item.nodeType)
		{
			return false;
		}

		var hasProp = Object.prototype.hasOwnProperty;
		try
		{
			if ( item.constructor && !hasProp.call(item, "constructor") && !hasProp.call(item.constructor.prototype, "isPrototypeOf") )
			{
				return false;
			}
		}
		catch (e)
		{
			return false;
		}

		var key;
		for (key in item)
		{
		}
		return typeof(key) === "undefined" || hasProp.call(item, key);
	}
};

BX.isNodeInDom = function(node, doc)
{
	return node === (doc || document) ? true :
		(node.parentNode ? BX.isNodeInDom(node.parentNode) : false);
};

BX.isNodeHidden = function(node)
{
	if (node === document)
		return false;
	else if (BX.style(node, 'display') == 'none')
		return true;
	else
		return (node.parentNode ? BX.isNodeHidden(node.parentNode) : true);
};

BX.evalPack = function(code)
{
	while (code.length > 0)
	{
		var c = code.shift();

		if (c.TYPE == 'SCRIPT_EXT' || c.TYPE == 'SCRIPT_SRC')
		{
			BX.loadScript(c.DATA, function() {BX.evalPack(code)});
			return;
		}
		else if (c.TYPE == 'SCRIPT')
		{
			BX.evalGlobal(c.DATA);
		}
	}
};

BX.evalGlobal = function(data)
{
	if (data)
	{
		var head = document.getElementsByTagName("head")[0] || document.documentElement,
			script = document.createElement("script");

		script.type = "text/javascript";

		if (!BX.browser.IsIE())
		{
			script.appendChild(document.createTextNode(data));
		}
		else
		{
			script.text = data;
		}

		head.insertBefore(script, head.firstChild);
		head.removeChild(script);
	}
};

BX.processHTML = function(data, scriptsRunFirst)
{
	var matchScript, matchStyle, matchSrc, matchHref, matchType, scripts = [], styles = [];
	var textIndexes = [];
	var lastIndex = r.script.lastIndex = r.script_end.lastIndex = 0;

	while ((matchScript = r.script.exec(data)) !== null)
	{
		r.script_end.lastIndex = r.script.lastIndex;
		var matchScriptEnd = r.script_end.exec(data);
		if (matchScriptEnd === null)
		{
			break;
		}

		// skip script tags of special types
		var skipTag = false;
		if ((matchType = matchScript[1].match(r.script_type)) !== null)
		{
			if(matchType[1] == 'text/html' || matchType[1] == 'text/template')
				skipTag = true;
		}

		if(skipTag)
		{
			textIndexes.push([lastIndex, r.script_end.lastIndex - lastIndex]);
		}
		else
		{
			textIndexes.push([lastIndex, matchScript.index - lastIndex]);

			var bRunFirst = scriptsRunFirst || (matchScript[1].indexOf('bxrunfirst') != '-1');

			if ((matchSrc = matchScript[1].match(r.script_src)) !== null)
			{
				scripts.push({"bRunFirst": bRunFirst, "isInternal": false, "JS": matchSrc[1]});
			}
			else
			{
				var start = matchScript.index + matchScript[0].length;
				var js = data.substr(start, matchScriptEnd.index-start);

				scripts.push({"bRunFirst": bRunFirst, "isInternal": true, "JS": js});
			}
		}

		lastIndex = matchScriptEnd.index + 9;
		r.script.lastIndex = lastIndex;
	}

	textIndexes.push([lastIndex, lastIndex === 0 ? data.length : data.length - lastIndex]);
	var pureData = "";
	for (var i = 0, length = textIndexes.length; i < length; i++)
	{
		pureData += data.substr(textIndexes[i][0], textIndexes[i][1]);
	}

	while ((matchStyle = pureData.match(r.style)) !== null)
	{
		if ((matchHref = matchStyle[0].match(r.style_href)) !== null && matchStyle[0].indexOf('media="') < 0)
		{
			styles.push(matchHref[1]);
		}

		pureData = pureData.replace(matchStyle[0], '');
	}

	return {'HTML': pureData, 'SCRIPT': scripts, 'STYLE': styles};
};

BX.garbage = function(call, thisObject)
{
	garbageCollectors.push({callback: call, context: thisObject});
};

/* window pos functions */

BX.GetDocElement = function (pDoc)
{
	pDoc = pDoc || document;
	return (BX.browser.IsDoctype(pDoc) ? pDoc.documentElement : pDoc.body);
};

BX.GetContext = function(node)
{
	if (BX.type.isElementNode(node))
		return node.ownerDocument.parentWindow || node.ownerDocument.defaultView || window;
	else if (BX.type.isDomNode(node))
		return node.parentWindow || node.defaultView || window;
	else
		return window;
};

BX.GetWindowInnerSize = function(pDoc)
{
	var width, height;

	pDoc = pDoc || document;

	if (window.innerHeight) // all except Explorer
	{
		width = BX.GetContext(pDoc).innerWidth;
		height = BX.GetContext(pDoc).innerHeight;
	}
	else if (pDoc.documentElement && (pDoc.documentElement.clientHeight || pDoc.documentElement.clientWidth)) // Explorer 6 Strict Mode
	{
		width = pDoc.documentElement.clientWidth;
		height = pDoc.documentElement.clientHeight;
	}
	else if (pDoc.body) // other Explorers
	{
		width = pDoc.body.clientWidth;
		height = pDoc.body.clientHeight;
	}
	return {innerWidth : width, innerHeight : height};
};

BX.GetWindowScrollPos = function(pDoc)
{
	var left, top;

	pDoc = pDoc || document;

	if (window.pageYOffset) // all except Explorer
	{
		left = BX.GetContext(pDoc).pageXOffset;
		top = BX.GetContext(pDoc).pageYOffset;
	}
	else if (pDoc.documentElement && (pDoc.documentElement.scrollTop || pDoc.documentElement.scrollLeft)) // Explorer 6 Strict
	{
		left = pDoc.documentElement.scrollLeft;
		top = pDoc.documentElement.scrollTop;
	}
	else if (pDoc.body) // all other Explorers
	{
		left = pDoc.body.scrollLeft;
		top = pDoc.body.scrollTop;
	}
	return {scrollLeft : left, scrollTop : top};
};

BX.GetWindowScrollSize = function(pDoc)
{
	var width, height;
	if (!pDoc)
		pDoc = document;

	if ( (pDoc.compatMode && pDoc.compatMode == "CSS1Compat"))
	{
		width = pDoc.documentElement.scrollWidth;
		height = pDoc.documentElement.scrollHeight;
	}
	else
	{
		if (pDoc.body.scrollHeight > pDoc.body.offsetHeight)
			height = pDoc.body.scrollHeight;
		else
			height = pDoc.body.offsetHeight;

		if (pDoc.body.scrollWidth > pDoc.body.offsetWidth ||
			(pDoc.compatMode && pDoc.compatMode == "BackCompat") ||
			(pDoc.documentElement && !pDoc.documentElement.clientWidth)
		)
			width = pDoc.body.scrollWidth;
		else
			width = pDoc.body.offsetWidth;
	}
	return {scrollWidth : width, scrollHeight : height};
};

BX.GetWindowSize = function(pDoc)
{
	var innerSize = this.GetWindowInnerSize(pDoc);
	var scrollPos = this.GetWindowScrollPos(pDoc);
	var scrollSize = this.GetWindowScrollSize(pDoc);

	return  {
		innerWidth : innerSize.innerWidth, innerHeight : innerSize.innerHeight,
		scrollLeft : scrollPos.scrollLeft, scrollTop : scrollPos.scrollTop,
		scrollWidth : scrollSize.scrollWidth, scrollHeight : scrollSize.scrollHeight
	};
};

BX.scrollTop = function(node, val){
	if(typeof val != 'undefined'){

		if(node == window){
			throw new Error('scrollTop() for window is not implemented');
		}else
			node.scrollTop = parseInt(val);

	}else{

		if(node == window)
			return BX.GetWindowScrollPos().scrollTop;

		return node.scrollTop;
	}
}

BX.scrollLeft = function(node, val){
	if(typeof val != 'undefined'){

		if(node == window){
			throw new Error('scrollLeft() for window is not implemented');
		}else
			node.scrollLeft = parseInt(val);

	}else{

		if(node == window)
			return BX.GetWindowScrollPos().scrollLeft;

		return node.scrollLeft;
	}
}

BX.hide_object = function(ob)
{
	ob = BX(ob);
	ob.style.position = 'absolute';
	ob.style.top = '-1000px';
	ob.style.left = '-1000px';
	ob.style.height = '10px';
	ob.style.width = '10px';
};

BX.is_relative = function(el)
{
	var p = BX.style(el, 'position');
	return p == 'relative' || p == 'absolute';
};

BX.is_float = function(el)
{
	var p = BX.style(el, 'float');
	return p == 'right' || p == 'left';
};

BX.is_fixed = function(el)
{
	var p = BX.style(el, 'position');
	return p == 'fixed';
};

BX.pos = function(el, bRelative)
{
	var r = { top: 0, right: 0, bottom: 0, left: 0, width: 0, height: 0 };
	bRelative = !!bRelative;
	if (!el)
		return r;
	if (typeof (el.getBoundingClientRect) != "undefined" && el.ownerDocument == document && !bRelative)
	{
		var clientRect = {};

		// getBoundingClientRect can return undefined and generate exception in some cases in IE8.
		try
		{
			clientRect = el.getBoundingClientRect();
		}
		catch(e)
		{
			clientRect =
			{
				top: el.offsetTop,
				left: el.offsetLeft,
				width: el.offsetWidth,
				height: el.offsetHeight,
				right: el.offsetLeft + el.offsetWidth,
				bottom: el.offsetTop + el.offsetHeight
			};
		}

		var root = document.documentElement;
		var body = document.body;

		r.top = clientRect.top + (root.scrollTop || body.scrollTop);
		r.left = clientRect.left + (root.scrollLeft || body.scrollLeft);
		r.width = clientRect.right - clientRect.left;
		r.height = clientRect.bottom - clientRect.top;
		r.right = clientRect.right + (root.scrollLeft || body.scrollLeft);
		r.bottom = clientRect.bottom + (root.scrollTop || body.scrollTop);
	}
	else
	{
		var x = 0, y = 0, w = el.offsetWidth, h = el.offsetHeight;
		var first = true;
		for (; el != null; el = el.offsetParent)
		{
			if (!first && bRelative && BX.is_relative(el))
				break;

			x += el.offsetLeft;
			y += el.offsetTop;
			if (first)
			{
				first = false;
				continue;
			}

			var elBorderLeftWidth = parseInt(BX.style(el, 'border-left-width')),
				elBorderTopWidth = parseInt(BX.style(el, 'border-top-width'));

			if (!isNaN(elBorderLeftWidth) && elBorderLeftWidth > 0)
				x += elBorderLeftWidth;
			if (!isNaN(elBorderTopWidth) && elBorderTopWidth > 0)
				y += elBorderTopWidth;
		}

		r.top = y;
		r.left = x;
		r.width = w;
		r.height = h;
		r.right = r.left + w;
		r.bottom = r.top + h;
	}

	for(var i in r)
	{
		if(r.hasOwnProperty(i))
		{
			r[i] = Math.round(r[i]);
		}
	}

	return r;
};

BX.width = function(node, val){
	if(typeof val != 'undefined')
		BX.style(node, 'width', parseInt(val)+'px');
	else{

		if(node == window)
			return window.innerWidth;

		//return parseInt(BX.style(node, 'width'));
		return BX.pos(node).width;
	}
}

BX.height = function(node, val){
	if(typeof val != 'undefined')
		BX.style(node, 'height', parseInt(val)+'px');
	else{

		if(node == window)
			return window.innerHeight;

		//return parseInt(BX.style(node, 'height'));
		return BX.pos(node).height;
	}
}

BX.align = function(pos, w, h, type)
{
	if (type)
		type = type.toLowerCase();
	else
		type = '';

	var pDoc = document;
	if (BX.type.isElementNode(pos))
	{
		pDoc = pos.ownerDocument;
		pos = BX.pos(pos);
	}

	var x = pos["left"], y = pos["bottom"];

	var scroll = BX.GetWindowScrollPos(pDoc);
	var size = BX.GetWindowInnerSize(pDoc);

	if((size.innerWidth + scroll.scrollLeft) - (pos["left"] + w) < 0)
	{
		if(pos["right"] - w >= 0 )
			x = pos["right"] - w;
		else
			x = scroll.scrollLeft;
	}

	if(((size.innerHeight + scroll.scrollTop) - (pos["bottom"] + h) < 0) || ~type.indexOf('top'))
	{
		if(pos["top"] - h >= 0 || ~type.indexOf('top'))
			y = pos["top"] - h;
		else
			y = scroll.scrollTop;
	}

	return {'left':x, 'top':y};
};

BX.scrollToNode = function(node)
{
	var obNode = BX(node);

	if (obNode.scrollIntoView)
		obNode.scrollIntoView(true);
	else
	{
		var arNodePos = BX.pos(obNode);
		window.scrollTo(arNodePos.left, arNodePos.top);
	}
};

/* non-xhr loadings */
BX.showWait = function(node, msg)
{
	node = BX(node) || document.body || document.documentElement;
	msg = msg || BX.message('JS_CORE_LOADING');

	var container_id = node.id || Math.random();

	var obMsg = node.bxmsg = document.body.appendChild(BX.create('DIV', {
		props: {
			id: 'wait_' + container_id
		},
		style: {
			background: 'url("/bitrix/js/main/core/images/wait.gif") no-repeat scroll 10px center #fcf7d1',
			border: '1px solid #E1B52D',
			color: 'black',
			fontFamily: 'Verdana,Arial,sans-serif',
			fontSize: '11px',
			padding: '10px 30px 10px 37px',
			position: 'absolute',
			zIndex:'10000',
			textAlign:'center'
		},
		text: msg
	}));

	setTimeout(BX.delegate(_adjustWait, node), 10);

	lastWait[lastWait.length] = obMsg;
	return obMsg;
};

BX.closeWait = function(node, obMsg)
{
	if(node && !obMsg)
		obMsg = node.bxmsg;
	if(node && !obMsg && BX.hasClass(node, 'bx-core-waitwindow'))
		obMsg = node;
	if(node && !obMsg)
		obMsg = BX('wait_' + node.id);
	if(!obMsg)
		obMsg = lastWait.pop();

	if (obMsg && obMsg.parentNode)
	{
		for (var i=0,len=lastWait.length;i<len;i++)
		{
			if (obMsg == lastWait[i])
			{
				lastWait = BX.util.deleteFromArray(lastWait, i);
				break;
			}
		}

		obMsg.parentNode.removeChild(obMsg);
		if (node) node.bxmsg = null;
		BX.cleanNode(obMsg, true);
	}
};

BX.setJSList = function(scripts)
{
	if (BX.type.isArray(scripts))
	{
		jsList = scripts;
	}
};

BX.getJSList = function()
{
	initJsList();
	return jsList;
};

BX.setCSSList = function(scripts)
{
	if (BX.type.isArray(scripts))
	{
		cssList = scripts;
	}
};

BX.getCSSList = function()
{
	initCssList();
	return cssList;
};

BX.getJSPath = function(js)
{
	return js.replace(/^(http[s]*:)*\/\/[^\/]+/i, '');
};

BX.getCSSPath = function(css)
{
	return css.replace(/^(http[s]*:)*\/\/[^\/]+/i, '');
};

BX.getCDNPath = function(path)
{
	return path;
};

BX.loadScript = function(script, callback, doc)
{
	if (!BX.isReady)
	{
		var _args = arguments;
		BX.ready(function() {
			BX.loadScript.apply(this, _args);
		});
		return;
	}

	doc = doc || document;

	if (BX.type.isString(script))
		script = [script];
	var _callback = function()
	{
		return (callback && BX.type.isFunction(callback)) ? callback() : null
	};
	var load_js = function(ind)
	{
		if(ind >= script.length)
			return _callback();

		if(!!script[ind])
		{
			var fileSrc = BX.getJSPath(script[ind]);
			if(isScriptLoaded(fileSrc))
			{
				load_js(++ind);
			}
			else
			{
				var oHead = doc.getElementsByTagName("head")[0] || doc.documentElement;
				var oScript = doc.createElement('script');
				oScript.src = script[ind];

				var bLoaded = false;
				oScript.onload = oScript.onreadystatechange = function()
				{
					if (!bLoaded && (!oScript.readyState || oScript.readyState == "loaded" || oScript.readyState == "complete"))
					{
						bLoaded = true;
						setTimeout(function (){load_js(++ind);}, 50);

						oScript.onload = oScript.onreadystatechange = null;
						if (oHead && oScript.parentNode)
						{
							oHead.removeChild(oScript);
						}
					}
				};

				jsList.push(fileSrc);
				return oHead.insertBefore(oScript, oHead.firstChild);
			}
		}
		else
		{
			load_js(++ind);
		}
		return null;
	};

	load_js(0);
};

BX.loadCSS = function(arCSS, doc, win)
{
	if (!BX.isReady)
	{
		var _args = arguments;
		BX.ready(function() {
			BX.loadCSS.apply(this, _args);
		});
		return null;
	}

	var bSingle = false;
	if (BX.type.isString(arCSS))
	{
		bSingle = true;
		arCSS = [arCSS];
	}

	var i,
		l = arCSS.length,
		lnk = null,
		pLnk = [];

	if (l == 0)
		return null;

	doc = doc || document;
	win = win || window;

	if (!win.bxhead)
	{
		var heads = doc.getElementsByTagName('HEAD');
		win.bxhead = heads[0];

		if (!win.bxhead)
		{
			return null;
		}
	}

	for (i = 0; i < l; i++)
	{
		var _check = BX.getCSSPath(arCSS[i]);
		if (isCssLoaded(_check))
		{
			continue;
		}

		lnk = document.createElement('LINK');
		lnk.href = arCSS[i];
		lnk.rel = 'stylesheet';
		lnk.type = 'text/css';

		var templateLink = getTemplateLink(win.bxhead);
		if (templateLink !== null)
		{
			templateLink.parentNode.insertBefore(lnk, templateLink);
		}
		else
		{
			win.bxhead.appendChild(lnk);
		}

		pLnk.push(lnk);
		cssList.push(_check);
	}

	if (bSingle)
		return lnk;

	return pLnk;
};

BX.load = function(items, callback, doc)
{
	if (!BX.isReady)
	{
		var _args = arguments;
		BX.ready(function() {
			BX.load.apply(this, _args);
		});
		return null;
	}

	doc = doc || document;
	if (isAsync === null)
	{
		isAsync = "async" in doc.createElement("script") || "MozAppearance" in doc.documentElement.style || window.opera;
	}

	return isAsync ? loadAsync(items, callback, doc) : loadAsyncEmulation(items, callback, doc);
};

BX.convert =
{
	nodeListToArray: function(nodes)
	{
		try
		{
			return (Array.prototype.slice.call(nodes, 0));
		}
		catch (ex)
		{
			var ary = [];
			for(var i = 0, l = nodes.length; i < l; i++)
			{
				ary.push(nodes[i]);
			}
			return ary;
		}
	}
};

function loadAsync(items, callback, doc)
{
	if (!BX.type.isArray(items))
	{
		return;
	}

	function allLoaded(items)
	{
		items = items || assets;
		for (var name in items)
		{
			if (items.hasOwnProperty(name) && items[name].state !== LOADED)
			{
				return false;
			}
		}

		return true;
	}

	function one(callback)
	{
		callback = callback || BX.DoNothing;

		if (callback._done)
		{
			return;
		}

		callback();
		callback._done = 1;
	}

	if (!BX.type.isFunction(callback))
	{
		callback = null;
	}

	var itemSet = {}, item, i;
	for (i = 0; i < items.length; i++)
	{
		item = items[i];
		item = getAsset(item);
		itemSet[item.name] = item;
	}

	for (i = 0; i < items.length; i++)
	{
		item = items[i];
		item = getAsset(item);
		load(item, function () {
			if (allLoaded(itemSet))
			{
				one(callback);
			}
		}, doc);
	}
}

function loadAsyncEmulation(items, callback, doc)
{
	function onPreload(asset)
	{
		asset.state = PRELOADED;
		if (BX.type.isArray(asset.onpreload) && asset.onpreload)
		{
			for (var i = 0; i < asset.onpreload.length; i++)
			{
				asset.onpreload[i].call();
			}
		}
	}

	function preLoad(asset)
	{
		if (asset.state === undefined)
		{
			asset.state = PRELOADING;
			asset.onpreload = [];

			loadAsset(
				{ url: asset.url, type: "cache", ext: asset.ext},
				function () { onPreload(asset); },
				doc
			);
		}
	}

	if (!BX.type.isArray(items))
	{
		return;
	}

	if (!BX.type.isFunction(callback))
	{
		callback = null;
	}

	var rest = [].slice.call(items, 1);
	for (var i = 0; i < rest.length; i++)
	{
		preLoad(getAsset(rest[i]));
	}

	load(getAsset(items[0]), items.length === 1 ? callback : function () {
		loadAsyncEmulation.apply(null, [rest, callback, doc]);
	}, doc);
}

function load(asset, callback, doc)
{
	callback = callback || BX.DoNothing;

	if (asset.state === LOADED)
	{
		callback();
		return;
	}

	if (asset.state === PRELOADING)
	{
		asset.onpreload.push(function () {
			load(asset, callback, doc);
		});
		return;
	}

	asset.state = LOADING;

	loadAsset(
		asset,
		function () {
			asset.state = LOADED;
			callback();
		},
		doc
	);
}

function loadAsset(asset, callback, doc)
{
	callback = callback || BX.DoNothing;

	function error(event)
	{
		ele.onload = ele.onreadystatechange = ele.onerror = null;
		callback();
	}

	function process(event)
	{
		event = event || window.event;
		if (event.type === "load" || (/loaded|complete/.test(ele.readyState) && (!doc.documentMode || doc.documentMode < 9)))
		{
			window.clearTimeout(asset.errorTimeout);
			window.clearTimeout(asset.cssTimeout);
			ele.onload = ele.onreadystatechange = ele.onerror = null;
			callback();
		}
	}

	function isCssLoaded()
	{
		if (asset.state !== LOADED && asset.cssRetries <= 20)
		{
			for (var i = 0, l = doc.styleSheets.length; i < l; i++)
			{
				if (doc.styleSheets[i].href === ele.href)
				{
					process({"type": "load"});
					return;
				}
			}

			asset.cssRetries++;
			asset.cssTimeout = window.setTimeout(isCssLoaded, 250);
		}
	}

	var ele;
	var ext = BX.type.isNotEmptyString(asset.ext) ? asset.ext : BX.util.getExtension(asset.url);

	if (ext === "css")
	{
		ele = doc.createElement("link");
		ele.type = "text/" + (asset.type || "css");
		ele.rel = "stylesheet";
		ele.href = asset.url;

		asset.cssRetries = 0;
		asset.cssTimeout = window.setTimeout(isCssLoaded, 500);
	}
	else
	{
		ele = doc.createElement("script");
		ele.type = "text/" + (asset.type || "javascript");
		ele.src = asset.url;
	}

	ele.onload = ele.onreadystatechange = process;
	ele.onerror = error;

	ele.async = false;
	ele.defer = false;

	asset.errorTimeout = window.setTimeout(function () {
		error({type: "timeout"});
	}, 7000);

	if (ext === "css")
	{
		cssList.push(BX.getCSSPath(asset.url));
	}
	else
	{
		jsList.push(BX.getJSPath(asset.url));
	}

	var templateLink = null;
	var head = doc.head || doc.getElementsByTagName("head")[0];
	if (ext === "css" && (templateLink = getTemplateLink(head)) !== null)
	{
		templateLink.parentNode.insertBefore(ele, templateLink);
	}
	else
	{
		head.insertBefore(ele, head.lastChild);
	}
}

function getAsset(item)
{
	var asset = {};
	if (typeof item === "object")
	{
		asset = item;
		asset.name = asset.name ? asset.name : BX.util.hashCode(item.url);
	}
	else
	{
		asset = { name: BX.util.hashCode(item), url : item };
	}

	var ext = BX.type.isNotEmptyString(asset.ext) ? asset.ext : BX.util.getExtension(asset.url);
	if ((ext === "css" && isCssLoaded(asset.url)) || isScriptLoaded(asset.url))
	{
		asset.state = LOADED;
	}

	var existing = assets[asset.name];
	if (existing && existing.url === asset.url)
	{
		return existing;
	}

	assets[asset.name] = asset;
	return asset;
}

function isCssLoaded(fileSrc)
{
	initCssList();
	return (BX.util.in_array(BX.getCSSPath(fileSrc), cssList));
}

function initCssList()
{
	if(!cssInit)
	{
		var linksCol = document.getElementsByTagName('link');

		if(!!linksCol && linksCol.length > 0)
		{
			for(var i = 0; i < linksCol.length; i++)
			{
				var href = linksCol[i].getAttribute('href');
				if (BX.type.isNotEmptyString(href))
				{
					cssList.push(BX.getCSSPath(href));
				}
			}
		}
		cssInit = true;
	}
}

function getTemplateLink(head)
{
	var findLink = function(tag)
	{
		var links = head.getElementsByTagName(tag);
		for (var i = 0, length = links.length; i < length; i++)
		{
			var templateStyle = links[i].getAttribute("data-template-style");
			if (BX.type.isNotEmptyString(templateStyle) && templateStyle == "true")
			{
				return links[i];
			}
		}

		return null;
	};

	var link = findLink("link");
	if (link === null)
	{
		link = findLink("style");
	}

	return link;
}

function isScriptLoaded(fileSrc)
{
	initJsList();
	return BX.util.in_array(BX.getJSPath(fileSrc), jsList);
}

function initJsList()
{
	if(!jsInit)
	{
		var scriptCol = document.getElementsByTagName('script');

		if(!!scriptCol && scriptCol.length > 0)
		{
			for(var i=0; i<scriptCol.length; i++)
			{
				var src = scriptCol[i].getAttribute('src');

				if (BX.type.isNotEmptyString(src))
				{
					jsList.push(BX.getJSPath(src));
				}
			}
		}
		jsInit = true;
	}
}

BX.reload = function(back_url, bAddClearCache)
{
	if (back_url === true)
	{
		bAddClearCache = true;
		back_url = null;
	}

	var new_href = back_url || top.location.href;

	var hashpos = new_href.indexOf('#'), hash = '';

	if (hashpos != -1)
	{
		hash = new_href.substr(hashpos);
		new_href = new_href.substr(0, hashpos);
	}

	if (bAddClearCache && new_href.indexOf('clear_cache=Y') < 0)
		new_href += (new_href.indexOf('?') == -1 ? '?' : '&') + 'clear_cache=Y';

	if (hash)
	{
		// hack for clearing cache in ajax mode components with history emulation
		if (bAddClearCache && (hash.substr(0, 5) == 'view/' || hash.substr(0, 6) == '#view/') && hash.indexOf('clear_cache%3DY') < 0)
			hash += (hash.indexOf('%3F') == -1 ? '%3F' : '%26') + 'clear_cache%3DY';

		new_href = new_href.replace(/(\?|\&)_r=[\d]*/, '');
		new_href += (new_href.indexOf('?') == -1 ? '?' : '&') + '_r='+Math.round(Math.random()*10000) + hash;
	}

	top.location.href = new_href;
};

BX.clearCache = function()
{
	BX.showWait();
	BX.reload(true);
};

BX.template = function(tpl, callback, bKillTpl)
{
	BX.ready(function() {
		_processTpl(BX(tpl), callback, bKillTpl);
	});
};

BX.isAmPmMode = function()
{
	return (BX.message('FORMAT_DATETIME').match('T') != null);
};

BX.formatDate = function(date, format)
{
	date = date || new Date();

	var bTime = date.getHours() || date.getMinutes() || date.getSeconds(),
		str = !!format
			? format :
			(bTime ? BX.message('FORMAT_DATETIME') : BX.message('FORMAT_DATE')
		);

	return str.replace(/YYYY/ig, date.getFullYear())
		.replace(/MMMM/ig, BX.util.str_pad_left((date.getMonth()+1).toString(), 2, '0'))
		.replace(/MM/ig, BX.util.str_pad_left((date.getMonth()+1).toString(), 2, '0'))
		.replace(/DD/ig, BX.util.str_pad_left(date.getDate().toString(), 2, '0'))
		.replace(/HH/ig, BX.util.str_pad_left(date.getHours().toString(), 2, '0'))
		.replace(/MI/ig, BX.util.str_pad_left(date.getMinutes().toString(), 2, '0'))
		.replace(/SS/ig, BX.util.str_pad_left(date.getSeconds().toString(), 2, '0'));
};
BX.formatName = function(user, template, login)
{
	user = user || {};
	template = (template || '');
	var replacement = {
		TITLE : (user["TITLE"] || ''),
		NAME : (user["NAME"] || ''),
		LAST_NAME : (user["LAST_NAME"] || ''),
		SECOND_NAME : (user["SECOND_NAME"] || ''),
		LOGIN : (user["LOGIN"] || ''),
		NAME_SHORT : user["NAME"] ? user["NAME"].substr(0, 1) + '.' : '',
		LAST_NAME_SHORT : user["LAST_NAME"] ? user["LAST_NAME"].substr(0, 1) + '.' : '',
		SECOND_NAME_SHORT : user["SECOND_NAME"] ? user["SECOND_NAME"].substr(0, 1) + '.' : '',
		EMAIL : (user["EMAIL"] || ''),
		ID : (user["ID"] || ''),
		NOBR : "",
		'/NOBR' : ""
	}, result = template;
	for (var ii in replacement)
	{
		if (replacement.hasOwnProperty(ii))
		{
			result = result.replace("#" + ii+ "#", replacement[ii])
		}
	}
	result = result.replace(/([\s]+)/gi, " ").trim();
	if (result == "")
	{
		result = (login == "Y" ? replacement["LOGIN"] : "");
		result = (result == "" ? "Noname" : result);
	}
	return result;
};

BX.getNumMonth = function(month)
{
	var wordMonthCut = ['jan', 'feb', 'mar', 'apr', 'may', 'jun', 'jul', 'aug', 'sep', 'oct', 'nov', 'dec'];
	var wordMonth = ['january', 'february', 'march', 'april', 'may', 'june', 'july', 'august', 'september', 'october', 'november', 'december'];

	var q = month.toUpperCase();
	for (i = 1; i <= 12; i++)
	{
		if (q == BX.message('MON_'+i).toUpperCase() || q == BX.message('MONTH_'+i).toUpperCase() || q == wordMonthCut[i-1].toUpperCase() || q == wordMonth[i-1].toUpperCase())
		{
			return i;
		}
	}
	return month;
};

BX.parseDate = function(str, bUTC, formatDate, formatDatetime)
{
	if (BX.type.isNotEmptyString(str))
	{
		if (!formatDate)
			formatDate = BX.message('FORMAT_DATE');
		if (!formatDatetime)
			formatDatetime = BX.message('FORMAT_DATETIME');

		var regMonths = '';
		for (i = 1; i <= 12; i++)
		{
			regMonths = regMonths + '|' + BX.message('MON_'+i);
		}

		var expr = new RegExp('([0-9]+|[a-z]+' + regMonths + ')', 'ig');
		var aDate = str.match(expr),
			aFormat = formatDate.match(/(DD|MI|MMMM|MM|M|YYYY)/ig),
			i, cnt,
			aDateArgs=[], aFormatArgs=[],
			aResult={};

		if (!aDate)
			return null;

		if(aDate.length > aFormat.length)
		{
			aFormat = formatDatetime.match(/(DD|MI|MMMM|MM|M|YYYY|HH|H|SS|TT|T|GG|G)/ig);
		}

		for(i = 0, cnt = aDate.length; i < cnt; i++)
		{
			if(BX.util.trim(aDate[i]) != '')
			{
				aDateArgs[aDateArgs.length] = aDate[i];
			}
		}

		for(i = 0, cnt = aFormat.length; i < cnt; i++)
		{
			if(BX.util.trim(aFormat[i]) != '')
			{
				aFormatArgs[aFormatArgs.length] = aFormat[i];
			}
		}


		var m = BX.util.array_search('MMMM', aFormatArgs);
		if (m > 0)
		{
			aDateArgs[m] = BX.getNumMonth(aDateArgs[m]);
			aFormatArgs[m] = "MM";
		}
		else
		{
			m = BX.util.array_search('M', aFormatArgs);
			if (m > 0)
			{
				aDateArgs[m] = BX.getNumMonth(aDateArgs[m]);
				aFormatArgs[m] = "MM";
			}
		}

		for(i = 0, cnt = aFormatArgs.length; i < cnt; i++)
		{
			var k = aFormatArgs[i].toUpperCase();
			aResult[k] = k == 'T' || k == 'TT' ? aDateArgs[i] : parseInt(aDateArgs[i], 10);
		}

		if(aResult['DD'] > 0 && aResult['MM'] > 0 && aResult['YYYY'] > 0)
		{
			var d = new Date();

			if(bUTC)
			{
				d.setUTCDate(1);
				d.setUTCFullYear(aResult['YYYY']);
				d.setUTCMonth(aResult['MM'] - 1);
				d.setUTCDate(aResult['DD']);
				d.setUTCHours(0, 0, 0);
			}
			else
			{
				d.setDate(1);
				d.setFullYear(aResult['YYYY']);
				d.setMonth(aResult['MM'] - 1);
				d.setDate(aResult['DD']);
				d.setHours(0, 0, 0);
			}

			if(
				(!isNaN(aResult['HH']) || !isNaN(aResult['GG']) || !isNaN(aResult['H']) || !isNaN(aResult['G']))
					&& !isNaN(aResult['MI'])
			)
			{
				if (!isNaN(aResult['H']) || !isNaN(aResult['G']))
				{
					var bPM = (aResult['T']||aResult['TT']||'am').toUpperCase()=='PM';
					var h = parseInt(aResult['H']||aResult['G']||0, 10);
					if(bPM)
					{
						aResult['HH'] = h + (h == 12 ? 0 : 12);
					}
					else
					{
						aResult['HH'] = h < 12 ? h : 0;
					}
				}
				else
				{
					aResult['HH'] = parseInt(aResult['HH']||aResult['GG']||0, 10);
				}

				if (isNaN(aResult['SS']))
					aResult['SS'] = 0;

				if(bUTC)
				{
					d.setUTCHours(aResult['HH'], aResult['MI'], aResult['SS']);
				}
				else
				{
					d.setHours(aResult['HH'], aResult['MI'], aResult['SS']);
				}
			}

			return d;
		}
	}

	return null;
};

BX.selectUtils =
{
	addNewOption: function(oSelect, opt_value, opt_name, do_sort, check_unique)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			var n = oSelect.length;
			if(check_unique !== false)
			{
				for(var i=0;i<n;i++)
				{
					if(oSelect[i].value==opt_value)
					{
						return;
					}
				}
			}

			oSelect.options[n] = new Option(opt_name, opt_value, false, false);
		}

		if(do_sort === true)
		{
			this.sortSelect(oSelect);
		}
	},

	deleteOption: function(oSelect, opt_value)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			for(var i=0;i<oSelect.length;i++)
			{
				if(oSelect[i].value==opt_value)
				{
					oSelect.remove(i);
					break;
				}
			}
		}
	},

	deleteSelectedOptions: function(oSelect)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			var i=0;
			while(i<oSelect.length)
			{
				if(oSelect[i].selected)
				{
					oSelect[i].selected=false;
					oSelect.remove(i);
				}
				else
				{
					i++;
				}
			}
		}
	},

	deleteAllOptions: function(oSelect)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			for(var i=oSelect.length-1; i>=0; i--)
			{
				oSelect.remove(i);
			}
		}
	},

	optionCompare: function(record1, record2)
	{
		var value1 = record1.optText.toLowerCase();
		var value2 = record2.optText.toLowerCase();
		if (value1 > value2) return(1);
		if (value1 < value2) return(-1);
		return(0);
	},

	sortSelect: function(oSelect)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			var myOptions = [];
			var n = oSelect.options.length;
			var i;
			for (i=0;i<n;i++)
			{
				myOptions[i] = {
					optText:oSelect[i].text,
					optValue:oSelect[i].value
				};
			}
			myOptions.sort(this.optionCompare);
			oSelect.length=0;
			n = myOptions.length;
			for(i=0;i<n;i++)
			{
				oSelect[i] = new Option(myOptions[i].optText, myOptions[i].optValue, false, false);
			}
		}
	},

	selectAllOptions: function(oSelect)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			var n = oSelect.length;
			for(var i=0;i<n;i++)
			{
				oSelect[i].selected=true;
			}
		}
	},

	selectOption: function(oSelect, opt_value)
	{
		oSelect = BX(oSelect);
		if(oSelect)
		{
			var n = oSelect.length;
			for(var i=0;i<n;i++)
			{
				oSelect[i].selected = (oSelect[i].value == opt_value);
			}
		}
	},

	addSelectedOptions: function(oSelect, to_select_id, check_unique, do_sort)
	{
		oSelect = BX(oSelect);
		if(!oSelect)
			return;
		var n = oSelect.length;
		for(var i=0; i<n; i++)
			if(oSelect[i].selected)
				this.addNewOption(to_select_id, oSelect[i].value, oSelect[i].text, do_sort, check_unique);
	},

	moveOptionsUp: function(oSelect)
	{
		oSelect = BX(oSelect);
		if(!oSelect)
			return;
		var n = oSelect.length;
		for(var i=0; i<n; i++)
		{
			if(oSelect[i].selected && i>0 && oSelect[i-1].selected == false)
			{
				var option = new Option(oSelect[i].text, oSelect[i].value);
				oSelect[i] = new Option(oSelect[i-1].text, oSelect[i-1].value);
				oSelect[i].selected = false;
				oSelect[i-1] = option;
				oSelect[i-1].selected = true;
			}
		}
	},

	moveOptionsDown: function(oSelect)
	{
		oSelect = BX(oSelect);
		if(!oSelect)
			return;
		var n = oSelect.length;
		for(var i=n-1; i>=0; i--)
		{
			if(oSelect[i].selected && i<n-1 && oSelect[i+1].selected == false)
			{
				var option = new Option(oSelect[i].text, oSelect[i].value);
				oSelect[i] = new Option(oSelect[i+1].text, oSelect[i+1].value);
				oSelect[i].selected = false;
				oSelect[i+1] = option;
				oSelect[i+1].selected = true;
			}
		}
	}
};

BX.getEventTarget = function(e)
{
	if(e.target)
	{
		return e.target;
	}
	else if(e.srcElement)
	{
		return e.srcElement;
	}
	return null;
};

/******* HINT ***************/
// if function has 2 params - the 2nd one is hint html. otherwise hint_html is third and hint_title - 2nd;
// '<div onmouseover="BX.hint(this, 'This is &lt;b&gt;Hint&lt;/b&gt;')"'>;
// BX.hint(el, 'This is <b>Hint</b>') - this won't work, use constructor
BX.hint = function(el, hint_title, hint_html, hint_id)
{
	if (null == hint_html)
	{
		hint_html = hint_title;
		hint_title = '';
	}

	if (null == el.BXHINT)
	{
		el.BXHINT = new BX.CHint({
			parent: el, hint: hint_html, title: hint_title, id: hint_id
		});
		el.BXHINT.Show();
	}
};

BX.hint_replace = function(el, hint_title, hint_html)
{
	if (null == hint_html)
	{
		hint_html = hint_title;
		hint_title = '';
	}

	if (!el || !el.parentNode || !hint_html)
			return null;

	var obHint = new BX.CHint({
		hint: hint_html,
		title: hint_title
	});

	obHint.CreateParent();

	el.parentNode.insertBefore(obHint.PARENT, el);
	el.parentNode.removeChild(el);

	obHint.PARENT.style.marginLeft = '5px';

	return el;
};

BX.CHint = function(params)
{
	this.PARENT = BX(params.parent);

	this.HINT = params.hint;
	this.HINT_TITLE = params.title;

	this.PARAMS = {};
	for (var i in this.defaultSettings)
	{
		if (null == params[i])
			this.PARAMS[i] = this.defaultSettings[i];
		else
			this.PARAMS[i] = params[i];
	}

	if (null != params.id)
		this.ID = params.id;

	this.timer = null;
	this.bInited = false;
	this.msover = true;

	if (this.PARAMS.showOnce)
	{
		this.__show();
		this.msover = false;
		this.timer = setTimeout(BX.proxy(this.__hide, this), this.PARAMS.hide_timeout);
	}
	else if (this.PARENT)
	{
		BX.bind(this.PARENT, 'mouseover', BX.proxy(this.Show, this));
		BX.bind(this.PARENT, 'mouseout', BX.proxy(this.Hide, this));
	}

	BX.addCustomEvent('onMenuOpen', BX.delegate(this.disable, this));
	BX.addCustomEvent('onMenuClose', BX.delegate(this.enable, this));
};

BX.CHint.prototype.defaultSettings = {
	show_timeout: 1000,
	hide_timeout: 500,
	dx: 2,
	showOnce: false,
	preventHide: true,
	min_width: 250
};

BX.CHint.prototype.CreateParent = function(element, params)
{
	if (this.PARENT)
	{
		BX.unbind(this.PARENT, 'mouseover', BX.proxy(this.Show, this));
		BX.unbind(this.PARENT, 'mouseout', BX.proxy(this.Hide, this));
	}

	if (!params) params = {};
	var type = 'icon';

	if (params.type && (params.type == "link" || params.type == "icon"))
		type = params.type;

	if (element)
		type = "element";

	if (type == "icon")
	{
		element = BX.create('IMG', {
			props: {
				src: params.iconSrc
					? params.iconSrc
					: "/bitrix/js/main/core/images/hint.gif"
			}
		});
	}
	else if (type == "link")
	{
		element = BX.create("A", {
			props: {href: 'javascript:void(0)'},
			html: '[?]'
		});
	}

	this.PARENT = element;

	BX.bind(this.PARENT, 'mouseover', BX.proxy(this.Show, this));
	BX.bind(this.PARENT, 'mouseout', BX.proxy(this.Hide, this));

	return this.PARENT;
};

BX.CHint.prototype.Show = function()
{
	this.msover = true;

	if (null != this.timer)
		clearTimeout(this.timer);

	this.timer = setTimeout(BX.proxy(this.__show, this), this.PARAMS.show_timeout);
};

BX.CHint.prototype.Hide = function()
{
	this.msover = false;

	if (null != this.timer)
		clearTimeout(this.timer);

	this.timer = setTimeout(BX.proxy(this.__hide, this), this.PARAMS.hide_timeout);
};

BX.CHint.prototype.__show = function()
{
	if (!this.msover || this.disabled) return;
	if (!this.bInited) this.Init();

	if (this.prepareAdjustPos())
	{
		this.DIV.style.display = 'block';
		this.adjustPos();

		BX.bind(window, 'scroll', BX.proxy(this.__onscroll, this));

		if (this.PARAMS.showOnce)
		{
			this.timer = setTimeout(BX.proxy(this.__hide, this), this.PARAMS.hide_timeout);
		}
	}
};

BX.CHint.prototype.__onscroll = function()
{
	if (!BX.admin || !BX.admin.panel || !BX.admin.panel.isFixed()) return;

	if (this.scrollTimer) clearTimeout(this.scrollTimer);

	this.DIV.style.display = 'none';
	this.scrollTimer = setTimeout(BX.proxy(this.Reopen, this), this.PARAMS.show_timeout);
};

BX.CHint.prototype.Reopen = function()
{
	if (null != this.timer) clearTimeout(this.timer);
	this.timer = setTimeout(BX.proxy(this.__show, this), 50);
};

BX.CHint.prototype.__hide = function()
{
	if (this.msover) return;
	if (!this.bInited) return;

	BX.unbind(window, 'scroll', BX.proxy(this.Reopen, this));

	if (this.PARAMS.showOnce)
	{
		this.Destroy();
	}
	else
	{
		this.DIV.style.display = 'none';
	}
};

BX.CHint.prototype.__hide_immediately = function()
{
	this.msover = false;
	this.__hide();
};

BX.CHint.prototype.Init = function()
{
	this.DIV = document.body.appendChild(BX.create('DIV', {
		props: {className: 'bx-panel-tooltip'},
		style: {display: 'none'},
		children: [
			BX.create('DIV', {
				props: {className: 'bx-panel-tooltip-top-border'},
				html: '<div class="bx-panel-tooltip-corner bx-panel-tooltip-left-corner"></div><div class="bx-panel-tooltip-border"></div><div class="bx-panel-tooltip-corner bx-panel-tooltip-right-corner"></div>'
			}),
			(this.CONTENT = BX.create('DIV', {
				props: {className: 'bx-panel-tooltip-content'},
				children: [
					BX.create('DIV', {
						props: {className: 'bx-panel-tooltip-underlay'},
						children: [
							BX.create('DIV', {props: {className: 'bx-panel-tooltip-underlay-bg'}})
						]
					})
				]
			})),

			BX.create('DIV', {
				props: {className: 'bx-panel-tooltip-bottom-border'},
				html: '<div class="bx-panel-tooltip-corner bx-panel-tooltip-left-corner"></div><div class="bx-panel-tooltip-border"></div><div class="bx-panel-tooltip-corner bx-panel-tooltip-right-corner"></div>'
			})
		]
	}));

	if (this.ID)
	{
		this.CONTENT.insertBefore(BX.create('A', {
			attrs: {href: 'javascript:void(0)'},
			props: {className: 'bx-panel-tooltip-close'},
			events: {click: BX.delegate(this.Close, this)}
		}), this.CONTENT.firstChild)
	}

	if (this.HINT_TITLE)
	{
		this.CONTENT.appendChild(
			BX.create('DIV', {
				props: {className: 'bx-panel-tooltip-title'},
				text: this.HINT_TITLE
			})
		)
	}

	if (this.HINT)
	{
		this.CONTENT_TEXT = this.CONTENT.appendChild(BX.create('DIV', {props: {className: 'bx-panel-tooltip-text'}})).appendChild(BX.create('SPAN', {html: this.HINT}));
	}

	if (this.PARAMS.preventHide)
	{
		BX.bind(this.DIV, 'mouseout', BX.proxy(this.Hide, this));
		BX.bind(this.DIV, 'mouseover', BX.proxy(this.Show, this));
	}

	this.bInited = true;
};

BX.CHint.prototype.setContent = function(content)
{
	this.HINT = content;

	if (this.CONTENT_TEXT)
		this.CONTENT_TEXT.innerHTML = this.HINT;
	else
		this.CONTENT_TEXT = this.CONTENT.appendChild(BX.create('DIV', {props: {className: 'bx-panel-tooltip-text'}})).appendChild(BX.create('SPAN', {html: this.HINT}));
};

BX.CHint.prototype.prepareAdjustPos = function()
{
	this._wnd = {scrollPos: BX.GetWindowScrollPos(),scrollSize:BX.GetWindowScrollSize()};
	return BX.style(this.PARENT, 'display') != 'none';
};

BX.CHint.prototype.getAdjustPos = function()
{
	var res = {}, pos = BX.pos(this.PARENT), min_top = 0;

	res.top = pos.bottom + this.PARAMS.dx;

	if (BX.admin && BX.admin.panel.DIV)
	{
		min_top = BX.admin.panel.DIV.offsetHeight + this.PARAMS.dx;

		if (BX.admin.panel.isFixed())
		{
			min_top += this._wnd.scrollPos.scrollTop;
		}
	}

	if (res.top < min_top)
		res.top = min_top;
	else
	{
		if (res.top + this.DIV.offsetHeight > this._wnd.scrollSize.scrollHeight)
			res.top = pos.top - this.PARAMS.dx - this.DIV.offsetHeight;
	}

	res.left = pos.left;
	if (pos.left < this.PARAMS.dx)
		pos.left = this.PARAMS.dx;
	else
	{
		var floatWidth = this.DIV.offsetWidth;

		var max_left = this._wnd.scrollSize.scrollWidth - floatWidth - this.PARAMS.dx;

		if (res.left > max_left)
			res.left = max_left;
	}

	return res;
};

BX.CHint.prototype.adjustWidth = function()
{
	if (this.bWidthAdjusted) return;

	var w = this.DIV.offsetWidth, h = this.DIV.offsetHeight;

	if (w > this.PARAMS.min_width)
		w = Math.round(Math.sqrt(1.618*w*h));

	if (w < this.PARAMS.min_width)
		w = this.PARAMS.min_width;

	this.DIV.style.width = w + "px";

	if (this._adjustWidthInt)
		clearInterval(this._adjustWidthInt);
	this._adjustWidthInt = setInterval(BX.delegate(this._adjustWidthInterval, this), 5);

	this.bWidthAdjusted = true;
};

BX.CHint.prototype._adjustWidthInterval = function()
{
	if (!this.DIV || this.DIV.style.display == 'none')
		clearInterval(this._adjustWidthInt);

	var
		dW = 20,
		maxWidth = 1500,
		w = this.DIV.offsetWidth,
		w1 = this.CONTENT_TEXT.offsetWidth;

	if (w > 0 && w1 > 0 && w - w1 < dW && w < maxWidth)
	{
		this.DIV.style.width = (w + dW) + "px";
		return;
	}

	clearInterval(this._adjustWidthInt);
};

BX.CHint.prototype.adjustPos = function()
{
	this.adjustWidth();

	var pos = this.getAdjustPos();

	this.DIV.style.top = pos.top + 'px';
	this.DIV.style.left = pos.left + 'px';
};

BX.CHint.prototype.Close = function()
{
	if (this.ID && BX.WindowManager)
		BX.WindowManager.saveWindowOptions(this.ID, {display: 'off'});
	this.__hide_immediately();
	this.Destroy();
};

BX.CHint.prototype.Destroy = function()
{
	if (this.PARENT)
	{
		BX.unbind(this.PARENT, 'mouseover', BX.proxy(this.Show, this));
		BX.unbind(this.PARENT, 'mouseout', BX.proxy(this.Hide, this));
	}

	if (this.DIV)
	{
		BX.unbind(this.DIV, 'mouseover', BX.proxy(this.Show, this));
		BX.unbind(this.DIV, 'mouseout', BX.proxy(this.Hide, this));

		BX.cleanNode(this.DIV, true);
	}
};

BX.CHint.prototype.enable = function(){this.disabled = false;};
BX.CHint.prototype.disable = function(){this.__hide_immediately(); this.disabled = true;};

/* ready */
if (document.addEventListener)
{
	__readyHandler = function()
	{
		document.removeEventListener("DOMContentLoaded", __readyHandler, false);
		runReady();
	}
}
else if (document.attachEvent)
{
	__readyHandler = function()
	{
		if (document.readyState === "complete")
		{
			document.detachEvent("onreadystatechange", __readyHandler);
			runReady();
		}
	}
}

function bindReady()
{
	if (!readyBound)
	{
		readyBound = true;

		if (document.readyState === "complete")
		{
			return runReady();
		}

		if (document.addEventListener)
		{
			document.addEventListener("DOMContentLoaded", __readyHandler, false);
			window.addEventListener("load", runReady, false);
		}
		else if (document.attachEvent) // IE
		{
			document.attachEvent("onreadystatechange", __readyHandler);
			window.attachEvent("onload", runReady);

			var toplevel = false;
			try {toplevel = (window.frameElement == null);} catch(e) {}

			if (document.documentElement.doScroll && toplevel)
				doScrollCheck();
		}
	}

	return null;
}


function runReady()
{
	if (!BX.isReady)
	{
		if (!document.body)
			return setTimeout(runReady, 15);

		BX.isReady = true;


		if (readyList && readyList.length > 0)
		{
			var fn, i = 0;
			while (readyList && (fn = readyList[i++]))
			{
				try{
					fn.call(document);
				}
				catch(e){
					BX.debug('BX.ready error: ', e);
				}
			}

			readyList = null;
		}
		// TODO: check ready handlers binded some other way;
	}
	return null;
}

// hack for IE
function doScrollCheck()
{
	if (BX.isReady)
		return;

	try {document.documentElement.doScroll("left");} catch( error ) {setTimeout(doScrollCheck, 1); return;}

	runReady();
}
/* \ready */

function _adjustWait()
{
	if (!this.bxmsg) return;

	var arContainerPos = BX.pos(this),
		div_top = arContainerPos.top;

	if (div_top < BX.GetDocElement().scrollTop)
		div_top = BX.GetDocElement().scrollTop + 5;

	this.bxmsg.style.top = (div_top + 5) + 'px';

	if (this == BX.GetDocElement())
	{
		this.bxmsg.style.right = '5px';
	}
	else
	{
		this.bxmsg.style.left = (arContainerPos.right - this.bxmsg.offsetWidth - 5) + 'px';
	}
}

function _checkDisplay(ob, displayType)
{
	if (typeof displayType != 'undefined')
		ob.BXDISPLAY = displayType;

	var d = ob.style.display || BX.style(ob, 'display');
	if (d != 'none')
	{
		ob.BXDISPLAY = ob.BXDISPLAY || d;
		return true;
	}
	else
	{
		ob.BXDISPLAY = ob.BXDISPLAY || 'block';
		return false;
	}
}

function _processTpl(tplNode, cb, bKillTpl)
{
	if (tplNode)
	{
		if (bKillTpl)
			tplNode.parentNode.removeChild(tplNode);

		var res = {}, nodes = BX.findChildren(tplNode, {attribute: 'data-role'}, true);

		for (var i = 0, l = nodes.length; i < l; i++)
		{
			res[nodes[i].getAttribute('data-role')] = nodes[i];
		}

		cb.apply(tplNode, [res]);
	}
}

function _checkNode(obj, params)
{
	params = params || {};

	if (BX.type.isFunction(params))
		return params.call(window, obj);

	if (!params.allowTextNodes && !BX.type.isElementNode(obj))
		return false;
	var i,j,len;
	for (i in params)
	{
		if(params.hasOwnProperty(i))
		{
			switch(i)
			{
				case 'tag':
				case 'tagName':
					if (BX.type.isString(params[i]))
					{
						if (obj.tagName.toUpperCase() != params[i].toUpperCase())
							return false;
					}
					else if (params[i] instanceof RegExp)
					{
						if (!params[i].test(obj.tagName))
							return false;
					}
				break;

				case 'class':
				case 'className':
					if (BX.type.isString(params[i]))
					{
						if (!BX.hasClass(obj, params[i]))
							return false;
					}
					else if (params[i] instanceof RegExp)
					{
						if (!BX.type.isString(obj.className) || !params[i].test(obj.className))
							return false;
					}
				break;

				case 'attr':
				case 'attribute':
					if (BX.type.isString(params[i]))
					{
						if (!obj.getAttribute(params[i]))
							return false;
					}
					else if (BX.type.isArray(params[i]))
					{
						for (j = 0, len = params[i].length; j < len; j++)
						{
							if (params[i] && !obj.getAttribute(params[i]))
								return false;
						}
					}
					else
					{
						for (j in params[i])
						{
							if(params[i].hasOwnProperty(j))
							{
								var q = obj.getAttribute(j);
								if (params[i][j] instanceof RegExp)
								{
									if (!BX.type.isString(q) || !params[i][j].test(q))
									{
										return false;
									}
								}
								else
								{
									if (q != '' + params[i][j])
									{
										return false;
									}
								}
							}
						}
					}
				break;

				case 'property':
					if (BX.type.isString(params[i]))
					{
						if (!obj[params[i]])
							return false;
					}
					else if (BX.type.isArray(params[i]))
					{
						for (j = 0, len = params[i].length; j < len; j++)
						{
							if (params[i] && !obj[params[i]])
								return false;
						}
					}
					else
					{
						for (j in params[i])
						{
							if (BX.type.isString(params[i][j]))
							{
								if (obj[j] != params[i][j])
									return false;
							}
							else if (params[i][j] instanceof RegExp)
							{
								if (!BX.type.isString(obj[j]) || !params[i][j].test(obj[j]))
									return false;
							}
						}
					}
				break;

				case 'callback':
					return params[i](obj);
			}
		}
	}

	return true;
}

/* garbage collector */
function Trash()
{
	var i,len;

	for (i = 0, len = garbageCollectors.length; i<len; i++)
	{
		try {
			garbageCollectors[i].callback.apply(garbageCollectors[i].context || window);
			delete garbageCollectors[i];
			garbageCollectors[i] = null;
		} catch (e) {}
	}

	try {BX.unbindAll();} catch(e) {}
/*
	for (i = 0, len = proxyList.length; i < len; i++)
	{
		try {
			delete proxyList[i];
			proxyList[i] = null;
		} catch (e) {}
	}
*/
}

if(window.attachEvent) // IE
	window.attachEvent("onunload", Trash);
else if(window.addEventListener) // Gecko / W3C
	window.addEventListener('unload', Trash, false);
else
	window.onunload = Trash;
/* \garbage collector */

// set empty ready handler
BX(BX.DoNothing);
window.BX = BX;
BX.browser.addGlobalClass();

/* data storage */
BX.data = function(node, key, value)
{
	if(typeof node == 'undefined')
		return undefined;

	if(typeof key == 'undefined')
		return undefined;

	if(typeof value != 'undefined')
	{
		// write to manager
		dataStorage.set(node, key, value);
	}
	else
	{
		var data = undefined;

		// from manager
		if((data = dataStorage.get(node, key)) != undefined)
		{
			return data;
		}
		else
		{
			// from attribute data-*
			if('getAttribute' in node && (data = node.getAttribute('data-'+key.toString())))
				return data;
		}

		return undefined;
	}
};

BX.DataStorage = function()
{

	this.keyOffset = 1;
	this.data = {};
	this.uniqueTag = 'BX-'+Math.random();

	this.resolve = function(owner, create){
		if(typeof owner[this.uniqueTag] == 'undefined')
			if(create)
			{
				try
				{
					Object.defineProperty(owner, this.uniqueTag, {
						value: this.keyOffset++
					});
				}
				catch(e)
				{
					owner[this.uniqueTag] = this.keyOffset++;
				}
			}
			else
				return undefined;

		return owner[this.uniqueTag];
	};
	this.get = function(owner, key){
		if((owner != document && !BX.type.isElementNode(owner)) || typeof key == 'undefined')
			return undefined;

		owner = this.resolve(owner, false);

		if(typeof owner == 'undefined' || typeof this.data[owner] == 'undefined')
			return undefined;

		return this.data[owner][key];
	};
	this.set = function(owner, key, value){

		if((owner != document && !BX.type.isElementNode(owner)) || typeof value == 'undefined')
			return;

		var o = this.resolve(owner, true);

		if(typeof this.data[o] == 'undefined')
			this.data[o] = {};

		this.data[o][key] = value;
	};
};

// some internal variables for new logic
var dataStorage = new BX.DataStorage();	// manager which BX.data() uses to keep data

BX.LazyLoad = {
	images: [],
	imageStatus: {
		hidden: -2,
		error: -1,
		"undefined": 0,
		inited: 1,
		loaded: 2
	},
	imageTypes: {
		image: 1,
		background: 2
	},

	registerImage: function(id, isImageVisibleCallback)
	{
		if (BX.type.isNotEmptyString(id))
		{
			this.images.push({
				id: id,
				node: null,
				src: null,
				type: null,
				func: BX.type.isFunction(isImageVisibleCallback) ? isImageVisibleCallback : null,
				status: this.imageStatus.undefined
			});
		}
	},

	registerImages: function(ids, isImageVisibleCallback)
	{
		if (BX.type.isArray(ids))
		{
			for (var i = 0, length = ids.length; i < length; i++)
			{
				this.registerImage(ids[i], isImageVisibleCallback);
			}
		}
	},

	showImages: function(checkOwnVisibility)
	{
		var image = null;
		var isImageVisible = false;

		checkOwnVisibility = checkOwnVisibility === false ? false : true;
		for (var i = 0, length = this.images.length; i < length; i++)
		{
			image = this.images[i];

			if (image.status == this.imageStatus.undefined)
			{
				this.initImage(image);
			}

			if (image.status !== this.imageStatus.inited)
			{
				continue;
			}

			if (
				!image.node
				|| !image.node.parentNode
			)
			{
				image.node = null;
				image.status = this.imageStatus.error;
				continue;
			}

			isImageVisible = true;
			if (checkOwnVisibility && image.func)
			{
				isImageVisible = image.func(image);
			}

			if (
				isImageVisible === true
				&& this.isElementVisibleOnScreen(image.node)
			)
			{
				if (image.type == this.imageTypes.image)
				{
					image.node.src = image.src;
				}
				else
				{
					image.node.style.backgroundImage = "url('" + image.src + "')";
				}

				image.node.setAttribute("data-src", "");
				image.status = this.imageStatus.loaded;
			}
		}
	},

	initImage: function(image)
	{
		image.status = this.imageStatus.error;
		var node = BX(image.id);
		if (node)
		{
			var src = node.getAttribute("data-src");
			if (BX.type.isNotEmptyString(src))
			{
				image.node = node;
				image.src = src;
				image.status = this.imageStatus.inited;
				image.type = (image.node.tagName.toLowerCase() == "img"
					? this.imageTypes.image
					: this.imageTypes.background
				);
			}
		}
	},

	isElementVisibleOnScreen: function (element)
	{
		var coords = this.getElementCoords(element);

		var windowTop = window.pageYOffset || document.documentElement.scrollTop;
		var windowBottom = windowTop + document.documentElement.clientHeight;

		coords.bottom = coords.top + element.offsetHeight;

		var topVisible = coords.top > windowTop && coords.top < windowBottom;
		var bottomVisible = coords.bottom < windowBottom && coords.bottom > windowTop;

		return topVisible || bottomVisible;
	},

	isElementVisibleOn2Screens: function(element)
	{
		var coords = this.getElementCoords(element);

		var windowHeight = document.documentElement.clientHeight;
		var windowTop = window.pageYOffset || document.documentElement.scrollTop;
		var windowBottom = windowTop + windowHeight;

		coords.bottom = coords.top + element.offsetHeight;

		windowTop -= windowHeight;
		windowBottom += windowHeight;

		var topVisible = coords.top > windowTop && coords.top < windowBottom;
		var bottomVisible = coords.bottom < windowBottom && coords.bottom > windowTop;

		return topVisible || bottomVisible;
	},

	getElementCoords: function(element)
	{
		var box = element.getBoundingClientRect();

		return {
			originTop: box.top,
			originLeft: box.left,
			top: box.top + window.pageYOffset,
			left: box.left + window.pageXOffset
		};
	},

	onScroll: function()
	{
		BX.LazyLoad.showImages();
	},

	clearImages: function ()
	{
		this.images = [];
	}

};

BX.getCookie = function (name)
{
	var matches = document.cookie.match(new RegExp(
		"(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
	));

	return matches ? decodeURIComponent(matches[1]) : undefined;
};

BX.FixFontSize = function(params)
{
	this.node = null;
	this.prevWindowSize = 0;
	this.mainWrapper = null;
	this.textWrapper = null;
	this.objList = params.objList;
	this.minFontSizeList = [];
	this.minFontSize = 0;

	if(params.onresize)
	{
		this.prevWindowSize = window.innerWidth || document.documentElement.clientWidth;
		BX.bind(window, 'resize', BX.proxy(BX.throttle(this.onResize, 350),this));
	}

	this.createTestNodes();
	this.decrease();
};

BX.FixFontSize.prototype =
{
	createTestNodes: function()
	{
		this.textWrapper = BX.create('div',{
			style : {
				display : 'inline-block',
				whiteSpace : 'nowrap'
			}
		});

		this.mainWrapper = BX.create('div',{
			style : {
				height : 0,
				overflow : 'hidden'
			},
			children : [this.textWrapper]
		});

	},
	insertTestNodes: function()
	{
		document.body.appendChild(this.mainWrapper);
	},
	removeTestNodes: function()
	{
		document.body.removeChild(this.mainWrapper);
	},
	decrease: function()
	{
		var width,
			fontSize;

		this.insertTestNodes();

		for(var i=this.objList.length-1; i>=0; i--)
		{
			width  = parseInt(getComputedStyle(this.objList[i].node)["width"]);
			fontSize = parseInt(getComputedStyle(this.objList[i].node)["font-size"]);

			this.textWrapperSetStyle(this.objList[i].node);

			if(this.textWrapperInsertText(this.objList[i].node))
			{
				while(this.textWrapper.offsetWidth > width && fontSize > 0)
				{
					this.textWrapper.style.fontSize = --fontSize + 'px';
				}

				if(this.objList[i].smallestValue)
				{
					this.minFontSize = this.minFontSize ? Math.min(this.minFontSize, fontSize) : fontSize;

					this.minFontSizeList.push(this.objList[i].node)
				}
				else
				{
					this.objList[i].node.style.fontSize = fontSize + 'px';
				}
			}
		}

		if(this.minFontSizeList.length > 0)
			this.setMinFont();

		this.removeTestNodes();

	},
	increase: function()
	{
		this.insertTestNodes();
		var width,
			fontSize;

		this.insertTestNodes();

		for(var i=this.objList.length-1; i>=0; i--)
		{
			width  = parseInt(getComputedStyle(this.objList[i].node)["width"]);
			fontSize = parseInt(getComputedStyle(this.objList[i].node)["font-size"]);

			this.textWrapperSetStyle(this.objList[i].node);

			if(this.textWrapperInsertText(this.objList[i].node))
			{
				while(this.textWrapper.offsetWidth < width && fontSize < this.objList[i].maxFontSize)
				{
					this.textWrapper.style.fontSize = ++fontSize + 'px';
				}

				if(this.objList[i].smallestValue)
				{
					this.minFontSize = this.minFontSize ? Math.min(this.minFontSize, fontSize) : fontSize;

					this.minFontSizeList.push(this.objList[i].node)
				}
				else
				{
					this.objList[i].node.style.fontSize = fontSize + 'px';
				}
			}
		}

		if(this.minFontSizeList.length > 0)
			this.setMinFont();

		this.removeTestNodes();
	},
	setMinFont : function()
	{
		for(var i = this.minFontSizeList.length-1; i>=0; i--)
		{
			this.minFontSizeList[i].style.fontSize = this.minFontSize + 'px';
		}

		this.minFontSize = 0;
	},
	onResize : function()
	{
		var width = window.innerWidth || document.documentElement.clientWidth;

		if(this.prevWindowSize > width)
			this.decrease();

		else if (this.prevWindowSize < width)
			this.increase();

		this.prevWindowSize = width;
	},
	textWrapperInsertText : function(node)
	{
		if(node.textContent){
			this.textWrapper.textContent = node.textContent;
			return true;
		}
		else if(node.innerText)
		{
			this.textWrapper.innerText = node.innerText;
			return true;
		}
		else {
			return false;
		}
	},
	textWrapperSetStyle : function(node)
	{
		this.textWrapper.style.fontFamily = getComputedStyle(node)["font-family"];
		this.textWrapper.style.fontSize = getComputedStyle(node)["font-size"];
		this.textWrapper.style.fontStyle = getComputedStyle(node)["font-style"];
		this.textWrapper.style.fontWeight = getComputedStyle(node)["font-weight"];
		this.textWrapper.style.lineHeight = getComputedStyle(node)["line-height"];
	}
};

BX.FixFontSize.init = function(params)
{
	return new BX.FixFontSize(params);
};

if(typeof(BX.ParamBag) === "undefined")
{
	BX.ParamBag = function()
	{
		this._params = {};
	};

	BX.ParamBag.prototype =
	{
		initialize: function(params)
		{
			this._params = params ? params : {};
		},
		getParam: function(name, defaultvalue)
		{
			var p = this._params;
			return typeof(p[name]) != "undefined" ? p[name] : defaultvalue;
		},
		setParam: function(name, value)
		{
			this._params[name] = value;
		},
		clear: function()
		{
			this._params = {};
		}
	};

	BX.ParamBag.create = function(params)
	{
		var self = new BX.ParamBag();
		self.initialize(params);
		return self;
	}
}

})(window);



;(function(window){

if (window.BX.ajax)
	return;

var
	BX = window.BX,

	tempDefaultConfig = {},
	defaultConfig = {
		method: 'GET', // request method: GET|POST
		dataType: 'html', // type of data loading: html|json|script
		timeout: 0, // request timeout in seconds. 0 for browser-default
		async: true, // whether request is asynchronous or not
		processData: true, // any data processing is disabled if false, only callback call
		scriptsRunFirst: false, // whether to run _all_ found scripts before onsuccess call. script tag can have an attribute "bxrunfirst" to turn  this flag on only for itself
		emulateOnload: true,
		skipAuthCheck: false, // whether to check authorization failure (SHOUD be set to true for CORS requests)
		start: true, // send request immediately (if false, request can be started manually via XMLHttpRequest object returned)
		cache: true, // whether NOT to add random addition to URL
		preparePost: true, // whether set Content-Type x-www-form-urlencoded in POST
		headers: false, // add additional headers, example: [{'name': 'If-Modified-Since', 'value': 'Wed, 15 Aug 2012 08:59:08 GMT'}, {'name': 'If-None-Match', 'value': '0'}]
		lsTimeout: 30, //local storage data TTL. useless without lsId.
		lsForce: false //wheter to force query instead of using localStorage data. useless without lsId.
/*
other parameters:
	url: url to get/post
	data: data to post
	onsuccess: successful request callback. BX.proxy may be used.
	onfailure: request failure callback. BX.proxy may be used.
	onprogress: request progress callback. BX.proxy may be used.

	lsId: local storage id - for constantly updating queries which can communicate via localStorage. core_ls.js needed

any of the default parameters can be overridden. defaults can be changed by BX.ajax.Setup() - for all further requests!
*/
	},
	ajax_session = null,
	loadedScripts = {},
	loadedScriptsQueue = [],
	r = {
		'url_utf': /[^\034-\254]+/g,
		'script_self': /\/bitrix\/js\/main\/core\/core(_ajax)*.js$/i,
		'script_self_window': /\/bitrix\/js\/main\/core\/core_window.js$/i,
		'script_self_admin': /\/bitrix\/js\/main\/core\/core_admin.js$/i,
		'script_onload': /window.onload/g
	};

// low-level method
BX.ajax = function(config)
{
	var status, data;

	if (!config || !config.url || !BX.type.isString(config.url))
	{
		return false;
	}

	for (var i in tempDefaultConfig)
		if (typeof (config[i]) == "undefined") config[i] = tempDefaultConfig[i];

	tempDefaultConfig = {};

	for (i in defaultConfig)
		if (typeof (config[i]) == "undefined") config[i] = defaultConfig[i];

	config.method = config.method.toUpperCase();

	if (!BX.localStorage)
		config.lsId = null;

	if (BX.browser.IsIE())
	{
		var result = r.url_utf.exec(config.url);
		if (result)
		{
			do
			{
				config.url = config.url.replace(result, BX.util.urlencode(result));
				result = r.url_utf.exec(config.url);
			} while (result);
		}
	}

	if(config.dataType == 'json')
		config.emulateOnload = false;

	if (!config.cache && config.method == 'GET')
		config.url = BX.ajax._uncache(config.url);

	if (config.method == 'POST' && config.preparePost)
	{
		config.data = BX.ajax.prepareData(config.data);
	}

	var bXHR = true;
	if (config.lsId && !config.lsForce)
	{
		var v = BX.localStorage.get('ajax-' + config.lsId);
		if (v !== null)
		{
			bXHR = false;

			var lsHandler = function(lsData) {
				if (lsData.key == 'ajax-' + config.lsId && lsData.value != 'BXAJAXWAIT')
				{
					var data = lsData.value,
						bRemove = !!lsData.oldValue && data == null;
					if (!bRemove)
						BX.ajax.__run(config, data);
					else if (config.onfailure)
						config.onfailure("timeout");

					BX.removeCustomEvent('onLocalStorageChange', lsHandler);
				}
			};

			if (v == 'BXAJAXWAIT')
			{
				BX.addCustomEvent('onLocalStorageChange', lsHandler);
			}
			else
			{
				setTimeout(function() {lsHandler({key: 'ajax-' + config.lsId, value: v})}, 10);
			}
		}
	}

	if (bXHR)
	{
		config.xhr = BX.ajax.xhr();
		if (!config.xhr) return;

		if (config.lsId)
		{
			BX.localStorage.set('ajax-' + config.lsId, 'BXAJAXWAIT', config.lsTimeout);
		}

		config.xhr.open(config.method, config.url, config.async);

		if (!config.skipBxHeader && !BX.ajax.isCrossDomain(config.url))
		{
			config.xhr.setRequestHeader('Bx-ajax', 'true');
		}

		if (config.method == 'POST' && config.preparePost)
		{
			config.xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		}
		if (typeof(config.headers) == "object")
		{
			for (i = 0; i < config.headers.length; i++)
				config.xhr.setRequestHeader(config.headers[i].name, config.headers[i].value);
		}

		if(!!config.onprogress)
		{
			BX.bind(config.xhr, 'progress', config.onprogress);
		}

		var bRequestCompleted = false;
		var onreadystatechange = config.xhr.onreadystatechange = function(additional)
		{
			if (bRequestCompleted)
				return;

			if (additional === 'timeout')
			{
				if (config.onfailure)
				{
					config.onfailure("timeout");
				}

				BX.onCustomEvent(config.xhr, 'onAjaxFailure', ['timeout', '', config]);

				config.xhr.onreadystatechange = BX.DoNothing;
				config.xhr.abort();

				if (config.async)
				{
					config.xhr = null;
				}
			}
			else
			{
				if (config.xhr.readyState == 4 || additional == 'run')
				{
					status = BX.ajax.xhrSuccess(config.xhr) ? "success" : "error";
					bRequestCompleted = true;
					config.xhr.onreadystatechange = BX.DoNothing;

					if (status == 'success')
					{
						var authHeader = (!!config.skipAuthCheck || BX.ajax.isCrossDomain(config.url))
							? false
							: config.xhr.getResponseHeader('X-Bitrix-Ajax-Status');

						if(!!authHeader && authHeader == 'Authorize')
						{
							if (config.onfailure)
							{
								config.onfailure("auth", config.xhr.status);
							}

							BX.onCustomEvent(config.xhr, 'onAjaxFailure', ['auth', config.xhr.status, config]);
						}
						else
						{
							var data = config.xhr.responseText;

							if (config.lsId)
							{
								BX.localStorage.set('ajax-' + config.lsId, data, config.lsTimeout);
							}

							BX.ajax.__run(config, data);
						}
					}
					else
					{
						if (config.onfailure)
						{
							config.onfailure("status", config.xhr.status);
						}

						BX.onCustomEvent(config.xhr, 'onAjaxFailure', ['status', config.xhr.status, config]);
					}

					if (config.async)
					{
						config.xhr = null;
					}
				}
			}
		};

		if (config.async && config.timeout > 0)
		{
			setTimeout(function() {
				if (config.xhr && !bRequestCompleted)
				{
					onreadystatechange("timeout");
				}
			}, config.timeout * 1000);
		}

		if (config.start)
		{
			config.xhr.send(config.data);

			if (!config.async)
			{
				onreadystatechange('run');
			}
		}

		return config.xhr;
	}
};

BX.ajax.xhr = function()
{
	if (window.XMLHttpRequest)
	{
		try {return new XMLHttpRequest();} catch(e){}
	}
	else if (window.ActiveXObject)
	{
		try { return new window.ActiveXObject("Msxml2.XMLHTTP.6.0"); }
			catch(e) {}
		try { return new window.ActiveXObject("Msxml2.XMLHTTP.3.0"); }
			catch(e) {}
		try { return new window.ActiveXObject("Msxml2.XMLHTTP"); }
			catch(e) {}
		try { return new window.ActiveXObject("Microsoft.XMLHTTP"); }
			catch(e) {}
		throw new Error("This browser does not support XMLHttpRequest.");
	}

	return null;
};

BX.ajax.isCrossDomain = function(url, location)
{
	location = location || window.location;

	//Relative URL gets a current protocol
	if (url.indexOf("//") === 0)
	{
		url = location.protocol + url;
	}

	//Fast check
	if (url.indexOf("http") !== 0)
	{
		return false;
	}

	var link = window.document.createElement("a");
	link.href = url;

	return  link.protocol !== location.protocol ||
			link.hostname !== location.hostname ||
			BX.ajax.getHostPort(link.protocol, link.host) !== BX.ajax.getHostPort(location.protocol, location.host);
};

BX.ajax.getHostPort = function(protocol, host)
{
	var match = /:(\d+)$/.exec(host);
	if (match)
	{
		return match[1];
	}
	else
	{
		if (protocol === "http:")
		{
			return "80";
		}
		else if (protocol === "https:")
		{
			return "443";
		}
	}

	return "";
};

BX.ajax.__prepareOnload = function(scripts)
{
	if (scripts.length > 0)
	{
		BX.ajax['onload_' + ajax_session] = null;

		for (var i=0,len=scripts.length;i<len;i++)
		{
			if (scripts[i].isInternal)
			{
				scripts[i].JS = scripts[i].JS.replace(r.script_onload, 'BX.ajax.onload_' + ajax_session);
			}
		}
	}

	BX.CaptureEventsGet();
	BX.CaptureEvents(window, 'load');
};

BX.ajax.__runOnload = function()
{
	if (null != BX.ajax['onload_' + ajax_session])
	{
		BX.ajax['onload_' + ajax_session].apply(window);
		BX.ajax['onload_' + ajax_session] = null;
	}

	var h = BX.CaptureEventsGet();

	if (h)
	{
		for (var i=0; i<h.length; i++)
			h[i].apply(window);
	}
};

BX.ajax.__run = function(config, data)
{
	if (!config.processData)
	{
		if (config.onsuccess)
		{
			config.onsuccess(data);
		}

		BX.onCustomEvent(config.xhr, 'onAjaxSuccess', [data, config]);
	}
	else
	{
		data = BX.ajax.processRequestData(data, config);
	}
};


BX.ajax._onParseJSONFailure = function(data)
{
	this.jsonFailure = true;
	this.jsonResponse = data;
	this.jsonProactive = /^\[WAF\]/.test(data);
};

BX.ajax.processRequestData = function(data, config)
{
	var result, scripts = [], styles = [];
	switch (config.dataType.toUpperCase())
	{
		case 'JSON':

			BX.addCustomEvent(config.xhr, 'onParseJSONFailure', BX.proxy(BX.ajax._onParseJSONFailure, config));
			result = BX.parseJSON(data, config.xhr);
			BX.removeCustomEvent(config.xhr, 'onParseJSONFailure', BX.proxy(BX.ajax._onParseJSONFailure, config));

			if(!!result && BX.type.isArray(result['bxjs']))
			{
				for(var i = 0; i < result['bxjs'].length; i++)
				{
					if(BX.type.isNotEmptyString(result['bxjs'][i]))
					{
						scripts.push({
							"isInternal": false,
							"JS": result['bxjs'][i],
							"bRunFirst": config.scriptsRunFirst
						});
					}
					else
					{
						scripts.push(result['bxjs'][i])
					}
				}
			}

			if(!!result && BX.type.isArray(result['bxcss']))
			{
				styles = result['bxcss'];
			}

		break;
		case 'SCRIPT':
			scripts.push({"isInternal": true, "JS": data, "bRunFirst": config.scriptsRunFirst});
			result = data;
		break;

		default: // HTML
			var ob = BX.processHTML(data, config.scriptsRunFirst);
			result = ob.HTML; scripts = ob.SCRIPT; styles = ob.STYLE;
		break;
	}

	var bSessionCreated = false;
	if (null == ajax_session)
	{
		ajax_session = parseInt(Math.random() * 1000000);
		bSessionCreated = true;
	}

	if (styles.length > 0)
		BX.loadCSS(styles);

	if (config.emulateOnload)
			BX.ajax.__prepareOnload(scripts);

	var cb = BX.DoNothing;
	if(config.emulateOnload || bSessionCreated)
	{
		cb = BX.defer(function()
		{
			if (config.emulateOnload)
				BX.ajax.__runOnload();
			if (bSessionCreated)
				ajax_session = null;
			BX.onCustomEvent(config.xhr, 'onAjaxSuccessFinish', [config]);
		});
	}

	try
	{
		if (!!config.jsonFailure)
		{
			throw {type: 'json_failure', data: config.jsonResponse, bProactive: config.jsonProactive};
		}

		config.scripts = scripts;

		BX.ajax.processScripts(config.scripts, true);

		if (config.onsuccess)
		{
			config.onsuccess(result);
		}

		BX.onCustomEvent(config.xhr, 'onAjaxSuccess', [result, config]);

		BX.ajax.processScripts(config.scripts, false, cb);
	}
	catch (e)
	{
		if (config.onfailure)
			config.onfailure("processing", e);
		BX.onCustomEvent(config.xhr, 'onAjaxFailure', ['processing', e, config]);
	}
};

BX.ajax.processScripts = function(scripts, bRunFirst, cb)
{
	var scriptsExt = [], scriptsInt = '';

	cb = cb || BX.DoNothing;

	for (var i = 0, length = scripts.length; i < length; i++)
	{
		if (typeof bRunFirst != 'undefined' && bRunFirst != !!scripts[i].bRunFirst)
			continue;

		if (scripts[i].isInternal)
			scriptsInt += ';' + scripts[i].JS;
		else
			scriptsExt.push(scripts[i].JS);
	}

	scriptsExt = BX.util.array_unique(scriptsExt);
	var inlineScripts = scriptsInt.length > 0 ? function() { BX.evalGlobal(scriptsInt); } : BX.DoNothing;

	if (scriptsExt.length > 0)
	{
		BX.load(scriptsExt, function() {
			inlineScripts();
			cb();
		});
	}
	else
	{
		inlineScripts();
		cb();
	}
};

// TODO: extend this function to use with any data objects or forms
BX.ajax.prepareData = function(arData, prefix)
{
	var data = '';
	if (BX.type.isString(arData))
		data = arData;
	else if (null != arData)
	{
		for(var i in arData)
		{
			if (arData.hasOwnProperty(i))
			{
				if (data.length > 0)
					data += '&';
				var name = BX.util.urlencode(i);
				if(prefix)
					name = prefix + '[' + name + ']';
				if(typeof arData[i] == 'object')
					data += BX.ajax.prepareData(arData[i], name);
				else
					data += name + '=' + BX.util.urlencode(arData[i]);
			}
		}
	}
	return data;
};

BX.ajax.xhrSuccess = function(xhr)
{
	return (xhr.status >= 200 && xhr.status < 300) || xhr.status === 304 || xhr.status === 1223 || xhr.status === 0;
};

BX.ajax.Setup = function(config, bTemp)
{
	bTemp = !!bTemp;

	for (var i in config)
	{
		if (bTemp)
			tempDefaultConfig[i] = config[i];
		else
			defaultConfig[i] = config[i];
	}
};

BX.ajax.replaceLocalStorageValue = function(lsId, data, ttl)
{
	if (!!BX.localStorage)
		BX.localStorage.set('ajax-' + lsId, data, ttl);
};


BX.ajax._uncache = function(url)
{
	return url + ((url.indexOf('?') !== -1 ? "&" : "?") + '_=' + (new Date()).getTime());
};

/* simple interface */
BX.ajax.get = function(url, data, callback)
{
	if (BX.type.isFunction(data))
	{
		callback = data;
		data = '';
	}

	data = BX.ajax.prepareData(data);

	if (data)
	{
		url += (url.indexOf('?') !== -1 ? "&" : "?") + data;
		data = '';
	}

	return BX.ajax({
		'method': 'GET',
		'dataType': 'html',
		'url': url,
		'data':  '',
		'onsuccess': callback
	});
};

BX.ajax.getCaptcha = function(callback)
{
	return BX.ajax.loadJSON('/bitrix/tools/ajax_captcha.php', callback);
};

BX.ajax.insertToNode = function(url, node)
{
	node = BX(node);
	if (!!node)
	{
		var eventArgs = { cancel: false };
		BX.onCustomEvent('onAjaxInsertToNode', [{ url: url, node: node, eventArgs: eventArgs }]);
		if(eventArgs.cancel === true)
		{
			return;
		}

		var show = null;
		if (!tempDefaultConfig.denyShowWait)
		{
			show = BX.showWait(node);
			delete tempDefaultConfig.denyShowWait;
		}

		return BX.ajax.get(url, function(data) {
			node.innerHTML = data;
			BX.closeWait(node, show);
		});
	}
};

BX.ajax.post = function(url, data, callback)
{
	data = BX.ajax.prepareData(data);

	return BX.ajax({
		'method': 'POST',
		'dataType': 'html',
		'url': url,
		'data':  data,
		'onsuccess': callback
	});
};

/* load and execute external file script with onload emulation */
BX.ajax.loadScriptAjax = function(script_src, callback, bPreload)
{
	if (BX.type.isArray(script_src))
	{
		for (var i=0,len=script_src.length;i<len;i++)
		{
			BX.ajax.loadScriptAjax(script_src[i], callback, bPreload);
		}
	}
	else
	{
		var script_src_test = script_src.replace(/\.js\?.*/, '.js');

		if (r.script_self.test(script_src_test)) return;
		if (r.script_self_window.test(script_src_test) && BX.CWindow) return;
		if (r.script_self_admin.test(script_src_test) && BX.admin) return;

		if (typeof loadedScripts[script_src_test] == 'undefined')
		{
			if (!!bPreload)
			{
				loadedScripts[script_src_test] = '';
				return BX.loadScript(script_src);
			}
			else
			{
				return BX.ajax({
					url: script_src,
					method: 'GET',
					dataType: 'script',
					processData: true,
					emulateOnload: false,
					scriptsRunFirst: true,
					async: false,
					start: true,
					onsuccess: function(result) {
						loadedScripts[script_src_test] = result;
						if (callback)
							callback(result);
					}
				});
			}
		}
		else if (callback)
		{
			callback(loadedScripts[script_src_test]);
		}
	}
};

/* non-xhr loadings */
BX.ajax.loadJSON = function(url, data, callback, callback_failure)
{
	if (BX.type.isFunction(data))
	{
		callback_failure = callback;
		callback = data;
		data = '';
	}

	data = BX.ajax.prepareData(data);

	if (data)
	{
		url += (url.indexOf('?') !== -1 ? "&" : "?") + data;
		data = '';
	}

	return BX.ajax({
		'method': 'GET',
		'dataType': 'json',
		'url': url,
		'onsuccess': callback,
		'onfailure': callback_failure
	});
};

/*
arObs = [{
	url: url,
	type: html|script|json|css,
	callback: function
}]
*/
BX.ajax.load = function(arObs, callback)
{
	if (!BX.type.isArray(arObs))
		arObs = [arObs];

	var cnt = 0;

	if (!BX.type.isFunction(callback))
		callback = BX.DoNothing;

	var handler = function(data)
		{
			if (BX.type.isFunction(this.callback))
				this.callback(data);

			if (++cnt >= len)
				callback();
		};

	for (var i = 0, len = arObs.length; i<len; i++)
	{
		switch(arObs[i].type.toUpperCase())
		{
			case 'SCRIPT':
				BX.loadScript([arObs[i].url], BX.proxy(handler, arObs[i]));
			break;
			case 'CSS':
				BX.loadCSS([arObs[i].url]);

				if (++cnt >= len)
					callback();
			break;
			case 'JSON':
				BX.ajax.loadJSON(arObs[i].url, BX.proxy(handler, arObs[i]));
			break;

			default:
				BX.ajax.get(arObs[i].url, '', BX.proxy(handler, arObs[i]));
			break;
		}
	}
};

/* ajax form sending */
BX.ajax.submit = function(obForm, callback)
{
	if (!obForm.target)
	{
		if (null == obForm.BXFormTarget)
		{
			var frame_name = 'formTarget_' + Math.random();
			obForm.BXFormTarget = document.body.appendChild(BX.create('IFRAME', {
				props: {
					name: frame_name,
					id: frame_name,
					src: 'javascript:void(0)'
				},
				style: {
					display: 'none'
				}
			}));
		}

		obForm.target = obForm.BXFormTarget.name;
	}

	obForm.BXFormCallback = callback;
	BX.bind(obForm.BXFormTarget, 'load', BX.proxy(BX.ajax._submit_callback, obForm));

	BX.submit(obForm);

	return false;
};

BX.ajax.submitComponentForm = function(obForm, container, bWait)
{
	if (!obForm.target)
	{
		if (null == obForm.BXFormTarget)
		{
			var frame_name = 'formTarget_' + Math.random();
			obForm.BXFormTarget = document.body.appendChild(BX.create('IFRAME', {
				props: {
					name: frame_name,
					id: frame_name,
					src: 'javascript:void(0)'
				},
				style: {
					display: 'none'
				}
			}));
		}

		obForm.target = obForm.BXFormTarget.name;
	}

	if (!!bWait)
		var w = BX.showWait(container);

	obForm.BXFormCallback = function(d) {
		if (!!bWait)
			BX.closeWait(w);

		var callOnload = function(){
			if(!!window.bxcompajaxframeonload)
			{
				setTimeout(function(){window.bxcompajaxframeonload();window.bxcompajaxframeonload=null;}, 10);
			}
		};

		BX(container).innerHTML = d;
		BX.onCustomEvent('onAjaxSuccess', [null,null,callOnload]);
	};

	BX.bind(obForm.BXFormTarget, 'load', BX.proxy(BX.ajax._submit_callback, obForm));

	return true;
};

// func will be executed in form context
BX.ajax._submit_callback = function()
{
	//opera and IE8 triggers onload event even on empty iframe
	try
	{
		if(this.BXFormTarget.contentWindow.location.href.indexOf('http') != 0)
			return;
	} catch (e) {
		return;
	}

	if (this.BXFormCallback)
		this.BXFormCallback.apply(this, [this.BXFormTarget.contentWindow.document.body.innerHTML]);

	BX.unbindAll(this.BXFormTarget);
};

BX.ajax.prepareForm = function(obForm, data)
{
	data = (!!data ? data : {});
	var i, ii, el,
		_data = [],
		n = obForm.elements.length,
		files = 0, length = 0;
	if(!!obForm)
	{
		for (i = 0; i < n; i++)
		{
			el = obForm.elements[i];
			if (el.disabled)
				continue;
			switch(el.type.toLowerCase())
			{
				case 'text':
				case 'textarea':
				case 'password':
				case 'hidden':
				case 'select-one':
					_data.push({name: el.name, value: el.value});
					length += (el.name.length + el.value.length);
					break;
				case 'file':
					if (!!el.files)
					{
						for (ii = 0; ii < el.files.length; ii++)
						{
							files++;
							_data.push({name: el.name, value: el.files[ii], file : true});
							length += el.files[ii].size;
						}
					}
					break;
				case 'radio':
				case 'checkbox':
					if(el.checked)
					{
						_data.push({name: el.name, value: el.value});
						length += (el.name.length + el.value.length);
					}
					break;
				case 'select-multiple':
					for (var j = 0; j < el.options.length; j++)
					{
						if (el.options[j].selected)
						{
							_data.push({name : el.name, value : el.options[j].value});
							length += (el.name.length + el.options[j].length);
						}
					}
					break;
				default:
					break;
			}
		}

		i = 0; length = 0;
		var current = data;

		while(i < _data.length)
		{
			var p = _data[i].name.indexOf('[');
			if (p == -1) {
				current[_data[i].name] = _data[i].value;
				current = data;
				i++;
			}
			else
			{
				var name = _data[i].name.substring(0, p);
				var rest = _data[i].name.substring(p+1);
				if(!current[name])
					current[name] = [];

				var pp = rest.indexOf(']');
				if(pp == -1)
				{
					current = data;
					i++;
				}
				else if(pp == 0)
				{
					//No index specified - so take the next integer
					current = current[name];
					_data[i].name = '' + current.length;
				}
				else
				{
					//Now index name becomes and name and we go deeper into the array
					current = current[name];
					_data[i].name = rest.substring(0, pp) + rest.substring(pp+1);
				}
			}
		}
	}
	return {data : data, filesCount : files, roughSize : length};
};
BX.ajax.submitAjax = function(obForm, config)
{
	config = (!!config && typeof config == "object" ? config : {});
	config.url = (config["url"] || obForm.getAttribute("action"));
	config.data = BX.ajax.prepareForm(obForm).data;

	if (!window["FormData"])
	{
		BX.ajax(config);
	}
	else
	{
		var isFile = function(item)
		{
			var res = Object.prototype.toString.call(item);
			return (res == '[object File]' || res == '[object Blob]');
		},
		appendToForm = function(fd, key, val)
		{
			if (!!val && typeof val == "object" && !isFile(val))
			{
				for (var ii in val)
				{
					if (val.hasOwnProperty(ii))
					{
						appendToForm(fd, (key == '' ? ii : key + '[' + ii + ']'), val[ii]);
					}
				}
			}
			else
				fd.append(key, (!!val ? val : ''));
		},
		prepareData = function(arData)
		{
			var data = {};
			if (null != arData)
			{
				if(typeof arData == 'object')
				{
					for(var i in arData)
					{
						if (arData.hasOwnProperty(i))
						{
							var name = BX.util.urlencode(i);
							if(typeof arData[i] == 'object' && arData[i]["file"] !== true)
								data[name] = prepareData(arData[i]);
							else if (arData[i]["file"] === true)
								data[name] = arData[i]["value"];
							else
								data[name] = BX.util.urlencode(arData[i]);
						}
					}
				}
				else
					data = BX.util.urlencode(arData);
			}
			return data;
		},
		fd = new window.FormData();

		if (config.method !== 'POST')
		{
			config.data = BX.ajax.prepareData(config.data);
			if (config.data)
			{
				config.url += (config.url.indexOf('?') !== -1 ? "&" : "?") + config.data;
				config.data = '';
			}
		}
		else
		{
			if (config.preparePost === true)
				config.data = prepareData(config.data);
			appendToForm(fd, '', config.data);
			config.data = fd;
		}

		config.preparePost = false;
		config.start = false;

		var xhr = BX.ajax(config);
		if (!!config["onprogress"])
			xhr.upload.addEventListener(
				'progress',
				function(e){
					var percent = null;
					if(e.lengthComputable && (e.total || e["totalSize"])) {
						percent = e.loaded * 100 / (e.total || e["totalSize"]);
					}
					config["onprogress"](e, percent);
				}
			);
		xhr.send(fd);
	}
};

BX.ajax.UpdatePageData = function (arData)
{
	if (arData.TITLE)
		BX.ajax.UpdatePageTitle(arData.TITLE);
	if (arData.WINDOW_TITLE || arData.TITLE)
		BX.ajax.UpdateWindowTitle(arData.WINDOW_TITLE || arData.TITLE);
	if (arData.NAV_CHAIN)
		BX.ajax.UpdatePageNavChain(arData.NAV_CHAIN);
	if (arData.CSS && arData.CSS.length > 0)
		BX.loadCSS(arData.CSS);
	if (arData.SCRIPTS && arData.SCRIPTS.length > 0)
	{
		var f = function(result,config,cb){

			if(!!config && BX.type.isArray(config.scripts))
			{
				for(var i=0,l=arData.SCRIPTS.length;i<l;i++)
				{
					config.scripts.push({isInternal:false,JS:arData.SCRIPTS[i]});
				}
			}
			else
			{
				BX.loadScript(arData.SCRIPTS,cb);
			}

			BX.removeCustomEvent('onAjaxSuccess',f);
		};
		BX.addCustomEvent('onAjaxSuccess',f);
	}
	else
	{
		var f1 = function(result,config,cb){
			if(BX.type.isFunction(cb))
			{
				cb();
			}
			BX.removeCustomEvent('onAjaxSuccess',f1);
		};
		BX.addCustomEvent('onAjaxSuccess', f1);
	}
};

BX.ajax.UpdatePageTitle = function(title)
{
	var obTitle = BX('pagetitle');
	if (obTitle)
	{
		obTitle.removeChild(obTitle.firstChild);
		if (!obTitle.firstChild)
			obTitle.appendChild(document.createTextNode(title));
		else
			obTitle.insertBefore(document.createTextNode(title), obTitle.firstChild);
	}
};

BX.ajax.UpdateWindowTitle = function(title)
{
	document.title = title;
};

BX.ajax.UpdatePageNavChain = function(nav_chain)
{
	var obNavChain = BX('navigation');
	if (obNavChain)
	{
		obNavChain.innerHTML = nav_chain;
	}
};

/* user options handling */
BX.userOptions = {
	options: null,
	bSend: false,
	delay: 5000,
	path: '/bitrix/admin/user_options.php?'
};

BX.userOptions.setAjaxPath = function(url)
{
	BX.userOptions.path = url.indexOf('?') == -1? url+'?': url+'&';
}
BX.userOptions.save = function(sCategory, sName, sValName, sVal, bCommon)
{
	if (null == BX.userOptions.options)
		BX.userOptions.options = {};

	bCommon = !!bCommon;
	BX.userOptions.options[sCategory+'.'+sName+'.'+sValName] = [sCategory, sName, sValName, sVal, bCommon];

	var sParam = BX.userOptions.__get();
	if (sParam != '')
		document.cookie = BX.message('COOKIE_PREFIX')+"_LAST_SETTINGS=" + sParam + "&sessid="+BX.bitrix_sessid()+"; expires=Thu, 31 Dec 2020 23:59:59 GMT; path=/;";

	if(!BX.userOptions.bSend)
	{
		BX.userOptions.bSend = true;
		setTimeout(function(){BX.userOptions.send(null)}, BX.userOptions.delay);
	}
};

BX.userOptions.send = function(callback)
{
	var sParam = BX.userOptions.__get();
	BX.userOptions.options = null;
	BX.userOptions.bSend = false;

	if (sParam != '')
	{
		document.cookie = BX.message('COOKIE_PREFIX') + "_LAST_SETTINGS=; path=/;";
		BX.ajax({
			'method': 'GET',
			'dataType': 'html',
			'processData': false,
			'cache': false,
			'url': BX.userOptions.path+sParam+'&sessid='+BX.bitrix_sessid(),
			'onsuccess': callback
		});
	}
};

BX.userOptions.del = function(sCategory, sName, bCommon, callback)
{
	BX.ajax.get(BX.userOptions.path+'action=delete&c='+sCategory+'&n='+sName+(bCommon == true? '&common=Y':'')+'&sessid='+BX.bitrix_sessid(), callback);
};

BX.userOptions.__get = function()
{
	if (!BX.userOptions.options) return '';

	var sParam = '', n = -1, prevParam = '', aOpt, i;

	for (i in BX.userOptions.options)
	{
		if(BX.userOptions.options.hasOwnProperty(i))
		{
			aOpt = BX.userOptions.options[i];

			if (prevParam != aOpt[0]+'.'+aOpt[1])
			{
				n++;
				sParam += '&p['+n+'][c]='+BX.util.urlencode(aOpt[0]);
				sParam += '&p['+n+'][n]='+BX.util.urlencode(aOpt[1]);
				if (aOpt[4] == true)
					sParam += '&p['+n+'][d]=Y';
				prevParam = aOpt[0]+'.'+aOpt[1];
			}

			sParam += '&p['+n+'][v]['+BX.util.urlencode(aOpt[2])+']='+BX.util.urlencode(aOpt[3]);
		}
	}

	return sParam.substr(1);
};

BX.ajax.history = {
	expected_hash: '',

	obParams: null,

	obFrame: null,
	obImage: null,

	obTimer: null,

	bInited: false,
	bHashCollision: false,
	bPushState: !!(history.pushState && BX.type.isFunction(history.pushState)),

	startState: null,

	init: function(obParams)
	{
		if (BX.ajax.history.bInited)
			return;

		this.obParams = obParams;
		var obCurrentState = this.obParams.getState();

		if (BX.ajax.history.bPushState)
		{
			BX.ajax.history.expected_hash = window.location.pathname;
			if (window.location.search)
				BX.ajax.history.expected_hash += window.location.search;

			BX.ajax.history.put(obCurrentState, BX.ajax.history.expected_hash, '', true);
			// due to some strange thing, chrome calls popstate event on page start. so we should delay it
			setTimeout(function(){BX.bind(window, 'popstate', BX.ajax.history.__hashListener);}, 500);
		}
		else
		{
			BX.ajax.history.expected_hash = window.location.hash;

			if (!BX.ajax.history.expected_hash || BX.ajax.history.expected_hash == '#')
				BX.ajax.history.expected_hash = '__bx_no_hash__';

			jsAjaxHistoryContainer.put(BX.ajax.history.expected_hash, obCurrentState);
			BX.ajax.history.obTimer = setTimeout(BX.ajax.history.__hashListener, 500);

			if (BX.browser.IsIE())
			{
				BX.ajax.history.obFrame = document.createElement('IFRAME');
				BX.hide_object(BX.ajax.history.obFrame);

				document.body.appendChild(BX.ajax.history.obFrame);

				BX.ajax.history.obFrame.contentWindow.document.open();
				BX.ajax.history.obFrame.contentWindow.document.write(BX.ajax.history.expected_hash);
				BX.ajax.history.obFrame.contentWindow.document.close();
			}
			else if (BX.browser.IsOpera())
			{
				BX.ajax.history.obImage = document.createElement('IMG');
				BX.hide_object(BX.ajax.history.obImage);

				document.body.appendChild(BX.ajax.history.obImage);

				BX.ajax.history.obImage.setAttribute('src', 'javascript:location.href = \'javascript:BX.ajax.history.__hashListener();\';');
			}
		}

		BX.ajax.history.bInited = true;
	},

	__hashListener: function(e)
	{
		e = e || window.event || {state:false};

		if (BX.ajax.history.bPushState)
		{
			BX.ajax.history.obParams.setState(e.state||BX.ajax.history.startState);
		}
		else
		{
			if (BX.ajax.history.obTimer)
			{
				window.clearTimeout(BX.ajax.history.obTimer);
				BX.ajax.history.obTimer = null;
			}

			var current_hash;
			if (null != BX.ajax.history.obFrame)
				current_hash = BX.ajax.history.obFrame.contentWindow.document.body.innerText;
			else
				current_hash = window.location.hash;

			if (!current_hash || current_hash == '#')
				current_hash = '__bx_no_hash__';

			if (current_hash.indexOf('#') == 0)
				current_hash = current_hash.substring(1);

			if (current_hash != BX.ajax.history.expected_hash)
			{
				var state = jsAjaxHistoryContainer.get(current_hash);
				if (state)
				{
					BX.ajax.history.obParams.setState(state);

					BX.ajax.history.expected_hash = current_hash;
					if (null != BX.ajax.history.obFrame)
					{
						var __hash = current_hash == '__bx_no_hash__' ? '' : current_hash;
						if (window.location.hash != __hash && window.location.hash != '#' + __hash)
							window.location.hash = __hash;
					}
				}
			}

			BX.ajax.history.obTimer = setTimeout(BX.ajax.history.__hashListener, 500);
		}
	},

	put: function(state, new_hash, new_hash1, bStartState)
	{
		if (this.bPushState)
		{
			if(!bStartState)
			{
				history.pushState(state, '', new_hash);
			}
			else
			{
				BX.ajax.history.startState = state;
			}
		}
		else
		{
			if (typeof new_hash1 != 'undefined')
				new_hash = new_hash1;
			else
				new_hash = 'view' + new_hash;

			jsAjaxHistoryContainer.put(new_hash, state);
			BX.ajax.history.expected_hash = new_hash;

			window.location.hash = BX.util.urlencode(new_hash);

			if (null != BX.ajax.history.obFrame)
			{
				BX.ajax.history.obFrame.contentWindow.document.open();
				BX.ajax.history.obFrame.contentWindow.document.write(new_hash);
				BX.ajax.history.obFrame.contentWindow.document.close();
			}
		}
	},

	checkRedirectStart: function(param_name, param_value)
	{
		var current_hash = window.location.hash;
		if (current_hash.substring(0, 1) == '#') current_hash = current_hash.substring(1);

		var test = current_hash.substring(0, 5);
		if (test == 'view/' || test == 'view%')
		{
			BX.ajax.history.bHashCollision = true;
			document.write('<' + 'div id="__ajax_hash_collision_' + param_value + '" style="display: none;">');
		}
	},

	checkRedirectFinish: function(param_name, param_value)
	{
		document.write('</div>');

		var current_hash = window.location.hash;
		if (current_hash.substring(0, 1) == '#') current_hash = current_hash.substring(1);

		BX.ready(function ()
		{
			var test = current_hash.substring(0, 5);
			if (test == 'view/' || test == 'view%')
			{
				var obColNode = BX('__ajax_hash_collision_' + param_value);
				var obNode = obColNode.firstChild;
				BX.cleanNode(obNode);
				obColNode.style.display = 'block';

				// IE, Opera and Chrome automatically modifies hash with urlencode, but FF doesn't ;-(
				if (test != 'view%')
					current_hash = BX.util.urlencode(current_hash);

				current_hash += (current_hash.indexOf('%3F') == -1 ? '%3F' : '%26') + param_name + '=' + param_value;

				var url = '/bitrix/tools/ajax_redirector.php?hash=' + current_hash;

				BX.ajax.insertToNode(url, obNode);
			}
		});
	}
};

BX.ajax.component = function(node)
{
	this.node = node;
};

BX.ajax.component.prototype.getState = function()
{
	var state = {
		'node': this.node,
		'title': window.document.title,
		'data': BX(this.node).innerHTML
	};

	var obNavChain = BX('navigation');
	if (null != obNavChain)
		state.nav_chain = obNavChain.innerHTML;

	BX.onCustomEvent(state.node, "onComponentAjaxHistoryGetState", [state]);

	return state;
};

BX.ajax.component.prototype.setState = function(state)
{
	BX(state.node).innerHTML = state.data;
	BX.ajax.UpdatePageTitle(state.title);

	if (state.nav_chain)
	{
		BX.ajax.UpdatePageNavChain(state.nav_chain);
	}

	BX.onCustomEvent(state.node, "onComponentAjaxHistorySetState", [state]);
};

var jsAjaxHistoryContainer = {
	arHistory: {},

	put: function(hash, state)
	{
		this.arHistory[hash] = state;
	},

	get: function(hash)
	{
		return this.arHistory[hash];
	}
};


BX.ajax.FormData = function()
{
	this.elements = [];
	this.files = [];
	this.features = {};
	this.isSupported();
	this.log('BX FormData init');
};

BX.ajax.FormData.isSupported = function()
{
	var f = new BX.ajax.FormData();
	var result = f.features.supported;
	f = null;
	return result;
};

BX.ajax.FormData.prototype.log = function(o)
{
	if (false) {
		try {
			if (BX.browser.IsIE()) o = JSON.stringify(o);
			console.log(o);
		} catch(e) {}
	}
};

BX.ajax.FormData.prototype.isSupported = function()
{
	var f = {};
	f.fileReader = (window.FileReader && window.FileReader.prototype.readAsBinaryString);
	f.readFormData = f.sendFormData = !!(window.FormData);
	f.supported = !!(f.readFormData && f.sendFormData);
	this.features = f;
	this.log('features:');
	this.log(f);

	return f.supported;
};

BX.ajax.FormData.prototype.append = function(name, value)
{
	if (typeof(value) === 'object') { // seems to be files element
		this.files.push({'name': name, 'value':value});
	} else {
		this.elements.push({'name': name, 'value':value});
	}
};

BX.ajax.FormData.prototype.send = function(url, callbackOk, callbackProgress, callbackError)
{
	this.log('FD send');
	this.xhr = BX.ajax({
			'method': 'POST',
			'dataType': 'html',
			'url': url,
			'onsuccess': callbackOk,
			'onfailure': callbackError,
			'start': false,
			'preparePost':false
		});

	if (callbackProgress)
	{
		this.xhr.upload.addEventListener(
			'progress',
			function(e) {
				if (e.lengthComputable)
					callbackProgress(e.loaded / (e.total || e.totalSize));
			},
			false
		);
	}

	if (this.features.readFormData && this.features.sendFormData)
	{
		var fd = new FormData();
		this.log('use browser formdata');
		for (var i in this.elements)
		{
			if(this.elements.hasOwnProperty(i))
				fd.append(this.elements[i].name,this.elements[i].value);
		}
		for (i in this.files)
		{
			if(this.files.hasOwnProperty(i))
				fd.append(this.files[i].name, this.files[i].value);
		}
		this.xhr.send(fd);
	}

	return this.xhr;
};

BX.addCustomEvent('onAjaxFailure', BX.debug);
})(window);



/**
 * Class for Web SQL Database
 * @param params
 * @constructor
 */

;
(function (window)
{
	if (window.BX.dataBase) return;

	var BX = window.BX;

	/**
	 * Parameters description:
	 * version - version of the database
	 * name - name of the database
	 * displayName - display name of the database
	 * capacity - size of the database in bytes.
	 * @param params
	 */
	BX.dataBase = function (params)
	{
		this.tableList = [];
		if(typeof window.openDatabase != 'undefined')
			this.dbObject = window.openDatabase(params.name, params.version, params.displayName, params.capacity);
	};


	BX.dataBase.prototype.isTableExists = function (tableName, callback)
	{
		var that = this;
		var tableListCallback = function ()
		{
			var length = that.tableList.length;
			for (var i = 0; i < length; i++)
			{
				if (that.tableList[i].toUpperCase() == tableName.toUpperCase())
				{
					callback(true);
					return;
				}
			}

			callback(false);
		};

		if (this.tableList.length <= 0)
			this.getTableList(tableListCallback);
		else
			tableListCallback();

	};

	/**
	 * Takes the list of existing tables from the database
	 * @param callback The callback handler will be invoked with boolean parameter as a first argument
	 * @example
	 */
	BX.dataBase.prototype.getTableList = function (callback)
	{
		var that = this;
		var callbackFunc = callback;
		this.query(
			{
				query: "SELECT tbl_name from sqlite_master WHERE type = 'table'",
				values: []
			},
			function (res)
			{
				if (res.count > 0)
				{
					for (var i = 0; i < res.items.length; i++)
						that.tableList[that.tableList.length] = res.items[i].tbl_name;
				}

				if (callbackFunc != null && typeof (callbackFunc) == "function")
					callbackFunc(that.tableList)
			}
		);
	};

	/**
	 * Creates the table in the database
	 * @param params
	 */
	BX.dataBase.prototype.createTable = function (params)
	{
		params.action = "create";
		if (params.success)
		{
			var userSuccessCallback = params.success;
			params.success = BX.proxy(function (result)
			{
				userSuccessCallback(result);
				this.getTableList();
			}, this);
		}
		var str = this.getQuery(params);
		this.query(str, params.success, params.fail);
	};

	/**
	 * Drops the table from the database
	 * @param params
	 */
	BX.dataBase.prototype.dropTable = function (params)
	{
		params.action = "drop";
		if(params.success)
		{
			var userSuccessCallback = params.success;
			params.success = function(result)
			{
				userSuccessCallback(result);
				this.getTableList();
			}
		}
		var str = this.getQuery(params);
		this.query(str, params.success, params.fail);
	};

	/**
	 * Drops the table from the database
	 * @param params
	 */
	BX.dataBase.prototype.addRow = function (params)
	{
		params.action = "insert";
		this.query(
			this.getQuery(params),
			params.success,
			params.fail
		);
	};

	/**
	 * Gets the data from the table
	 * @param params
	 */
	BX.dataBase.prototype.getRows = function (params)
	{
		params.action = "select";
		this.query(
			this.getQuery(params),
			params.success,
			params.fail
		);
	};

	/**
	 * Updates the table
	 * @param params
	 */
	BX.dataBase.prototype.updateRows = function (params)
	{
		params.action = "update";
		var queryData = this.getQuery(params);
		this.query(queryData, params.success, params.fail);
	};

	/**
	 * Deletes rows from the table
	 * @param params
	 */
	BX.dataBase.prototype.deleteRows = function (params)
	{
		params.action = "delete";
		var str = this.getQuery(params);
		this.query(str, params.success, params.fail);
	};

	/**
	 * Builds the query string and the set of values.
	 * @param params
	 * @returns {{query: string, values: Array}}
	 */
	BX.dataBase.prototype.getQuery = function (params)
	{
		var values = [];
		var where = params.filter;
		var select = params.fields;
		var insert = params.insertFields;
		var set = params.updateFields;
		var tableName = params.tableName;
		var strQuery = "";

		switch (params.action)
		{
			case "delete":
			{
				strQuery = "DELETE FROM " + tableName.toUpperCase() + " " + this.getFilter(where);
				values = this.getValues([where]);
				break;
			}

			case "update":
			{
				strQuery = "UPDATE " + tableName.toUpperCase() + " " + this.getFieldPair(set, "SET ") + " " + this.getFilter(where);
				values = this.getValues([set, where]);
				break;
			}

			case "create":
			{
				var fieldsString = "";
				if (typeof(select) == "object")
				{
					var field = "";
					for (var j = 0; j < select.length; j++)
					{
						field = "";
						if (typeof(select[j]) == "object")
						{
							if (select[j].name)
							{

								field = select[j].name;
								if (select[j].unique && select[j].unique == true)
									field += " unique";
							}

						}
						else if (typeof(select[j]) == "string" && select[j].length > 0)
							field = select[j];

						if (field.length > 0)
						{

							if (fieldsString.length > 0)
								fieldsString += "," + field.toUpperCase();
							else
								fieldsString = field.toUpperCase();
						}
					}
				}

				strQuery = "CREATE TABLE IF NOT EXISTS " + tableName.toUpperCase() + " (" + fieldsString + ") ";
				break;
			}

			case "drop":
			{
				strQuery = "DROP TABLE IF EXISTS " + tableName.toUpperCase();
				break;
			}
			case "select":
			{
				strQuery = "SELECT " + this.getValueArrayString(select, "*") + " FROM " + tableName.toUpperCase() + " " + this.getFilter(where);
				values = this.getValues([where]);
				break;
			}
			case "insert":
			{
				values = this.getValues([insert]);
				strQuery = "INSERT INTO " + tableName.toUpperCase() + " (" + this.getKeyString(insert) + ") VALUES(%values%)";
				var valueTemplate = "";
				for (var i = 0; i < values.length; i++)
				{
					if (valueTemplate.length > 0)
						valueTemplate += ",?";
					else
						valueTemplate = "?"
				}

				strQuery = strQuery.replace("%values%", valueTemplate);

				break;
			}
		}

		return {
			query: strQuery,
			values: values
		}
	};


	/**
	 * Gets pairs for query string
	 * @param {object} fields The object with set of key-value pairs
	 * @param {string} operator The keyword that will be join on the beginning of the string
	 * @returns {string}
	 */
	BX.dataBase.prototype.getFieldPair = function (fields, operator)
	{
		var pairsRow = "";
		var keyWord = operator || "";

		if (typeof(fields) == "object")
		{
			var i = 0;
			for (var key in fields)
			{
				var pair = ((i > 0) ? ", " : "") + (key.toUpperCase() + "=" + "?");
				if (pairsRow.length == 0 && keyWord.length > 0)
					pairsRow = keyWord;
				pairsRow += pair;
				i++;
			}
		}

		return pairsRow;
	};

	BX.dataBase.prototype.getFilter = function (fields)
	{
		var pairsRow = "";
		var keyWord = "WHERE ";

		if (typeof(fields) == "object")
		{
			var i = 0;
			for (var key in fields)
			{
				var pair = "";
				var count = 1;
				if (typeof(fields[key]) == "object")
					count = fields[key].length;
				for (var j = 0; j < count; j++)
				{
					pair = ((j > 0) ? pair + " OR " : "(") + (key.toUpperCase() + "=" + "?");
					if ((j + 1) == count)
						pair += ")"
				}
				;

				pairsRow += pair;
				i++;
			}
		}
		return pairsRow == "" ? "" : "WHERE " + pairsRow;
	};

	/**
	 * Gets the string with keys of fields that have splitted by commas
	 * @param fields
	 * @param defaultResult
	 * @returns {string}
	 */
	BX.dataBase.prototype.getKeyString = function (fields, defaultResult)
	{
		var result = "";
		if (!defaultResult)
			defaultResult = "";
		if (typeof(fields) == "array")
		{
			for (var i = 0; i < valuesItem.length; i++)
			{

				if (result.length > 0)
					result += "," + valuesItem[i].toUpperCase();
				else
					result = valuesItem[i].toUpperCase();
			}
		}
		else if (typeof(fields) == "object")
		{
			for (var key in fields)
			{
				if (result.length > 0)
					result += "," + key.toUpperCase();
				else
					result = key.toUpperCase();
			}
		}

		if (result.length == 0)
			result = defaultResult;

		return result;
	};

	/**
	 * Gets the string with values of the array that have splitted by commas
	 * @param fields
	 * @param defaultResult
	 * @returns {string}
	 */
	BX.dataBase.prototype.getValueArrayString = function (fields, defaultResult)
	{
		var result = "";
		if (!defaultResult)
			defaultResult = "";
		if (typeof(fields) == "object")
		{
			for (var i = 0; i < fields.length; i++)
			{

				if (result.length > 0)
					result += "," + fields[i].toUpperCase();
				else
					result = fields[i].toUpperCase();
			}
		}


		if (result.length == 0)
			result = defaultResult;

		return result;
	};

	/**
	 * Gets the array of values
	 * @param values
	 * @returns {Array}
	 */
	BX.dataBase.prototype.getValues = function (values)
	{
		var resultValues = [];
		for (var j = 0; j < values.length; j++)
		{
			var valuesItem = values[j];

			if (typeof(valuesItem) == "object")
			{
				for (var keyField in valuesItem)
				{
					if (typeof(valuesItem[keyField]) != "object")
						resultValues[resultValues.length] = valuesItem[keyField];
					else
						for (var i = 0; i < valuesItem[keyField].length; i++)
						{
							resultValues[resultValues.length] = valuesItem[keyField][i];
						}
				}
			}
			else if (typeof(valuesItem) == "array")
			{
				for (var i = 0; i < valuesItem.length; i++)
				{
					if (typeof(valuesItem[i]) != "object")
						resultValues[resultValues.length] = valuesItem[i];
				}
			}
		}


		return resultValues;
	};

	/**
	 * Executes the query
	 * @param success The success callback
	 * @param fail The failture callback
	 * @returns {string}
	 * @param query
	 */
	BX.dataBase.prototype.query = function (query, success, fail)
	{
		if (!this.dbObject)
		{
			return;
		}

		if(typeof success =='undefined' || typeof success != 'function')
			success = function(){};
		if (typeof fail == 'undefined' || typeof fail != 'function')
			fail = function(){};
		this.dbObject.transaction(
			function (tx)
			{
				tx.executeSql(
					query.query,
					query.values,
					function (tx, results)
					{

						var result = {
							originalResult: results
						};

						var len = results.rows.length;
						if (len >= 0)
						{
							result.count = len;
							result.items = [];

							for (var i = 0; i < len; i++)
							{
								var item = {};
								var dbItem = results.rows.item(i);
								for (var key in dbItem)
								{
									if (dbItem.hasOwnProperty(key))
									{
										item[key] = dbItem[key];
									}
								}
								result.items.push(item);
							}
						}

						if (success != null)
							success(result, tx);
					},
					function (tx, res)
					{
						if (fail != null)
							fail(res, tx);
					}
				);
			}
		);
	};

	/**
	 * Gets the beautifying result from the query response
	 * @param results
	 * @returns {*}
	 */

	BX.dataBase.prototype.getResponseObject = function (results)
	{

		var len = results.rows.length;

		var result = [];
		for (var i = 0; i < len; i++)
		{
			result[result.length] = results.rows.item(i);
		}

		return result;
	};

})(window);


/**
 * @module mobileapp
 */
;
(function ()
{

	if (window.app) return;
	/*
	 * Event list:
	 * onOpenPageAfter
	 * onOpenPageBefore
	 * onHidePageAfter
	 * onHidePageBefore
	 * UIApplicationDidBecomeActiveNotification
	 * onInternetStatusChange
	 * onOpenPush
	 * onKeyboardWillShow
	 * onKeyboardWillHide
	 * onKeyboardDidHide
	 * onKeyboardDidShow
	 */

	/**
	 * Class for Web SQL Database
	 * @param params
	 * @constructor
	 */
	MobileDatabase = function ()
	{
		this.tableList = [];
		this.db = window.openDatabase("Database", "1.0", "Bitrix Base", 20 * 1024 * 1024);
	};

	MobileDatabase.prototype.init = function ()
	{
		ReadyDevice(BX.proxy(function ()
		{
			this.db = window.openDatabase("Database", "1.0", "Bitrix Base", 200000);
		}, this))
	};

	MobileDatabase.prototype.isTableExists = function (tableName, callback)
	{
		var that = this;
		var tableListCallback = function ()
		{
			var length = that.tableList.length;
			for (var i = 0; i < length; i++)
			{
				if (that.tableList[i].toUpperCase() == tableName.toUpperCase())
				{
					callback(true);
					return;
				}
			}

			callback(false);
		};

		if (this.tableList.length <= 0)
			this.getTableList(tableListCallback);
		else
			tableListCallback();

	};

	/**
	 * Takes the list of existing tables from the database
	 * @param callback The callback handler will be invoked with boolean parameter as a first argument
	 * @example
	 */
	MobileDatabase.prototype.getTableList = function (callback)
	{
		var that = this;
		var callbackFunc = callback;
		this.query(
			{
				query: "SELECT tbl_name from sqlite_master WHERE type = 'table'",
				values: {}
			},
			function (res)
			{
				if (res.count > 0)
				{
					for (var i = 0; i < res.items.length; i++)
						that.tableList[that.tableList.length] = res.items[i].tbl_name;
				}

				if (callbackFunc != null && typeof (callbackFunc) == "function")
					callbackFunc(that.tableList)
			}
		);
	};

	/**
	 * Creates the table in the database
	 * @param params
	 */
	MobileDatabase.prototype.createTable = function (params)
	{
		params.action = "create";
		var str = this.getQuery(params);
		this.query(str, params.success, params.fail);
	};

	/**
	 * Drops the table from the database
	 * @param params
	 */
	MobileDatabase.prototype.dropTable = function (params)
	{
		params.action = "drop";
		var str = this.getQuery(params);
		this.query(str, params.success, params);
	};

	/**
	 * Drops the table from the database
	 * @param params
	 */
	MobileDatabase.prototype.addRow = function (params)
	{
		params.action = "insert";
		this.query(
			this.getQuery(params),
			params.success,
			params.fail
		);
	};

	/**
	 * Gets the data from the table
	 * @param params
	 */
	MobileDatabase.prototype.getRows = function (params)
	{
		params.action = "select";
		this.query(
			this.getQuery(params),
			params.success,
			params.fail
		);
	};

	/**
	 * Updates the table
	 * @param params
	 */
	MobileDatabase.prototype.updateRows = function (params)
	{
		params.action = "update";
		var queryData = this.getQuery(params);
		this.query(queryData, params.success, params);
	};

	/**
	 * Deletes rows from the table
	 * @param params
	 */
	MobileDatabase.prototype.deleteRows = function (params)
	{
		params.action = "delete";
		var str = this.getQuery(params);
		this.query(str, params.success, params);
	};

	/**
	 * Builds the query string and the set of values.
	 * @param params
	 * @returns {{query: string, values: Array}}
	 */
	MobileDatabase.prototype.getQuery = function (params)
	{
		var values = [];
		var where = params.filter;
		var select = params.fields;
		var insert = params.insertFields;
		var set = params.updateFields;
		var tableName = params.tableName;
		var strQuery = "";

		switch (params.action)
		{
			case "delete":
			{
				strQuery = "DELETE FROM " + tableName.toUpperCase() + " " + this.getFilter(where);
				values = this.getValues([where]);
				break;
			}

			case "update":
			{
				strQuery = "UPDATE " + tableName.toUpperCase() + " " + this.getFieldPair(set, "SET ") + " " + this.getFilter(where);
				values = this.getValues([set, where]);
				break;
			}

			case "create":
			{
				var fieldsString = "";
				if (typeof(select) == "object")
				{
					var field = "";
					for (var j = 0; j < select.length; j++)
					{
						field = "";
						if (typeof(select[j]) == "object")
						{
							if (select[j].name)
							{

								field = select[j].name;
								if (select[j].unique && select[j].unique == true)
									field += " unique";
							}

						}
						else if (typeof(select[j]) == "string" && select[j].length > 0)
							field = select[j];

						if (field.length > 0)
						{

							if (fieldsString.length > 0)
								fieldsString += "," + field.toUpperCase();
							else
								fieldsString = field.toUpperCase();
						}
					}
				}

				strQuery = "CREATE TABLE IF NOT EXISTS " + tableName.toUpperCase() + " (" + fieldsString + ") ";
				break;
			}

			case "drop":
			{
				strQuery = "DROP TABLE IF EXISTS " + tableName.toUpperCase();
				break;
			}

			case "select":
			{
				strQuery = "SELECT " + this.getValueArrayString(select, "*") + " FROM " + tableName.toUpperCase() + " " + this.getFilter(where);
				values = this.getValues([where]);
				break;
			}

			case "insert":
			{
				values = this.getValues([insert]);
				strQuery = "INSERT INTO " + tableName.toUpperCase() + " (" + this.getKeyString(insert) + ") VALUES(%values%)";
				var valueTemplate = "";
				for (var i = 0; i < values.length; i++)
				{
					if (valueTemplate.length > 0)
						valueTemplate += ",?";
					else
						valueTemplate = "?"
				}

				strQuery = strQuery.replace("%values%", valueTemplate);

				break;
			}
		}

		return {
			query: strQuery,
			values: values
		}
	};

	/**
	 * Gets pairs for query string
	 * @param {object} fields The object with set of key-value pairs
	 * @param {string} operator The keyword that will be join on the beginning of the string
	 * @returns {string}
	 */
	MobileDatabase.prototype.getFieldPair = function (fields, operator)
	{
		var pairsRow = "";
		var keyWord = operator || "";

		if (typeof(fields) == "object")
		{
			var i = 0;
			for (var key in fields)
			{
				var pair = ((i > 0) ? ", " : "") + (key.toUpperCase() + "=" + "?");
				if (pairsRow.length == 0 && keyWord.length > 0)
					pairsRow = keyWord;
				pairsRow += pair;
				i++;
			}
		}

		return pairsRow;
	};

	MobileDatabase.prototype.getFilter = function (fields)
	{
		var pairsRow = "";
		var keyWord = "WHERE ";

		if (typeof(fields) == "object")
		{
			var i = 0;
			for (var key in fields)
			{
				var pair = "";
				var count = 1;
				if (typeof(fields[key]) == "object")
					count = fields[key].length;
				for (var j = 0; j < count; j++)
				{
					pair = ((j > 0) ? pair + " OR " : "(") + (key.toUpperCase() + "=" + "?");
					if ((j + 1) == count)
						pair += ")"
				}
				;

				pairsRow += pair;
				i++;
			}
		}
		return "WHERE " + pairsRow;
	};

	/**
	 * Gets the string with keys of fields that have splitted by commas
	 * @param fields
	 * @param defaultResult
	 * @returns {string}
	 */
	MobileDatabase.prototype.getKeyString = function (fields, defaultResult)
	{
		var result = "";
		if (!defaultResult)
			defaultResult = "";
		if (typeof(fields) == "array")
		{
			for (var i = 0; i < valuesItem.length; i++)
			{

				if (result.length > 0)
					result += "," + valuesItem[i].toUpperCase();
				else
					result = valuesItem[i].toUpperCase();
			}
		}
		else if (typeof(fields) == "object")
		{
			for (var key in fields)
			{
				if (result.length > 0)
					result += "," + key.toUpperCase();
				else
					result = key.toUpperCase();
			}
		}

		if (result.length == 0)
			result = defaultResult;

		return result;
	};

	/**
	 * Gets the string with values of the array that have splitted by commas
	 * @param fields
	 * @param defaultResult
	 * @returns {string}
	 */
	MobileDatabase.prototype.getValueArrayString = function (fields, defaultResult)
	{
		var result = "";
		if (!defaultResult)
			defaultResult = "";
		if (typeof(fields) == "object")
		{
			for (var i = 0; i < fields.length; i++)
			{

				if (result.length > 0)
					result += "," + fields[i].toUpperCase();
				else
					result = fields[i].toUpperCase();
			}
		}

		if (result.length == 0)
			result = defaultResult;

		return result;
	};

	/**
	 * Gets the array of values
	 * @param values
	 * @returns {Array}
	 */
	MobileDatabase.prototype.getValues = function (values)
	{
		var resultValues = [];
		for (var j = 0; j < values.length; j++)
		{
			var valuesItem = values[j];

			if (typeof(valuesItem) == "object")
			{
				for (var keyField in valuesItem)
				{
					if (typeof(valuesItem[keyField]) != "object")
						resultValues[resultValues.length] = valuesItem[keyField];
					else
						for (var i = 0; i < valuesItem[keyField].length; i++)
						{
							resultValues[resultValues.length] = valuesItem[keyField][i];
						}
				}
			}
			else if (typeof(valuesItem) == "array")
			{
				for (var i = 0; i < valuesItem.length; i++)
				{
					if (typeof(valuesItem[i]) != "object")
						resultValues[resultValues.length] = valuesItem[i];
				}
			}
		}


		return resultValues;
	};

	/**
	 * Executes the query
	 * @param success The success callback
	 * @param fail The failture callback
	 * @returns {string}
	 * @param query
	 */
	MobileDatabase.prototype.query = function (query, success, fail)
	{
		this.db.transaction(
			function (tx)
			{
				tx.executeSql(
					query.query,
					query.values,
					function (tx, results)
					{

						var result = {
							originalResult: results
						};

						var len = results.rows.length;
						if (len >= 0)
						{
							result.count = len;
							result.items = [];
							for (var i = 0; i < len; i++)
							{
								result.items[result.items.length] = results.rows.item(i);
							}
						}

						if (success != null)
							success(result, tx);
					},
					function (tx, res)
					{
						if (fail != null)
							fail(res, tx);
					}
				);
			}
		);
	};

	/**
	 * Gets the beautifying result from the query response
	 * @param results
	 * @returns {*}
	 */

	MobileDatabase.prototype.getResponseObject = function (results)
	{

		var len = results.rows.length;

		var result = [];
		for (var i = 0; i < len; i++)
		{
			result[result.length] = results.rows.item(i);
		}

		return result;
	};

	/**
	 * Base of Cordova Plugin
	 * @param name
	 * @constructor
	 */
	window.BXCordovaPlugin = function (name, sync, convertBoolean)
	{
		this.pluginName = name;
		this.useSyncPlugin = (sync == true);
		this.callbackIndex = 0;
		this.callbacks = {};
		this.callbackIndex = 0;
		this.dataBrigePath = (typeof mobileSiteDir == "undefined"?"/": mobileSiteDir) + "mobile/";
		this.available = false;
		this.convertBoolean = (typeof convertBoolean == "undefined" ? true: convertBoolean);
		this.platform = null;
		this.db = null;
		this.isDatabaseSupported = true;
		if (window.openDatabase)
			this.db = new MobileDatabase();
		else
			this.isDatabaseSupported = false;
		var _that = this;
		document.addEventListener("deviceready", function ()
		{
			_that.available = true;
		}, false);
	};

	BXCordovaPlugin.prototype.RegisterCallBack = function (func)
	{

		if ((typeof func) === "function")
		{
			this.callbackIndex++;
			this.callbacks[this.callbackIndex] = func;
			return this.callbackIndex;

		}

		return false;
	};

	BXCordovaPlugin.prototype.CallBackExecute = function (index, result)
	{
		//execute callback by register index
		if (this.callbacks[index] && (typeof this.callbacks[index]) === "function")
		{
			this.callbacks[index](result);
		}
	};

	BXCordovaPlugin.prototype.prepareParams = function (params, convertBoolean)
	{
		//prepare params
		var convertBooleanFlag = true;
		if((typeof convertBoolean) == "boolean")
		{
			convertBooleanFlag = convertBoolean;
		}


		if (typeof(params) == "object")
		{
			for (var key in params)
			{
				if (typeof(params[key]) == "object")
					params[key] = this.prepareParams(params[key]);
				if (typeof(params[key]) == "function")
					params[key] = this.RegisterCallBack(params[key]);
				else if(convertBooleanFlag)
				{
					if (params[key] === true)
						params[key] = "YES";
					else if (params[key] === false)
						params[key] = "NO";
				}

			}
		}
		else
		{
			if (typeof(params) == "function")
				params = this.RegisterCallBack(params);
			else if (convertBooleanFlag)
			{
				if (params === true)
					params = "YES";
				else if (params === false)
					params = "NO";
			}
		}

		return params;
	};

	BXCordovaPlugin.prototype.clone = function(obj, copyObject)
	{
		var _obj, i, l;

		if (copyObject !== false)
			copyObject = true;

		if (obj === null)
			return null;

		if (typeof obj == 'object')
		{
			if (Object.prototype.toString.call(obj) == "[object Array]")
			{
				_obj = [];
				for (i = 0, l = obj.length; i < l; i++)
				{
					if (typeof obj[i] == "object" && copyObject)
						_obj[i] = this.clone(obj[i], copyObject);
					else
						_obj[i] = obj[i];
				}
			}
			else
			{
				_obj = {};

				for (i in obj)
				{
					if (typeof obj[i] == "object" && copyObject)
						_obj[i] = this.clone(obj[i], copyObject);
					else
						_obj[i] = obj[i];
				}
			}
		}
		else
		{
			_obj = obj;
		}

		return _obj;
	};

	BXCordovaPlugin.prototype.exec = function (funcName, params, convertBoolean)
	{

		var pluginParams = {};

		if(typeof convertBoolean == "undefined")
		{
			convertBoolean = this.convertBoolean;
		}

		if (!this.available)
		{
			document.addEventListener("deviceready", BX.proxy(function ()
			{
				this.exec(funcName, params, convertBoolean);
			}, this), false);
			return false;
		}


		if (typeof(params) != "undefined")
		{
			pluginParams = this.clone(params, true);
			pluginParams = this.prepareParams(pluginParams, convertBoolean);

			if (typeof(pluginParams) == "object")
				pluginParams = JSON.stringify(pluginParams);
		}
		else
		{
			pluginParams = "{}";
		}


		if(window.syncPlugin && this.useSyncPlugin)
		{
			window.syncPlugin.execute(funcName, pluginParams);
			return;
		}

		if (device.platform.toUpperCase() == "ANDROID" || device.cordova > '2.0.0')
		{
			return Cordova.exec(null, null, this.pluginName, funcName, [pluginParams]);
		}
		else
		{
			return Cordova.exec(this.pluginName + "." + funcName, pluginParams);
		}

	};


	//:::::::::::::::::::::::::::::
	//::::::::Mobile WebRTC::::::::
	//:::::::::::::::::::::::::::::
	var webrtc = new BXCordovaPlugin("MobileWebRTC");
	window.webrtc = webrtc;


	//UI methods
	webrtc.UI =
	{
		parent: webrtc,
		state: {
			"OUTGOING_CALL": "outgoing_call",
			"INCOMING_CALL": "incoming_call",
			"CONVERSATION": "conversation",
			"FAIL_CALL": "fail_call"
		}
	};

	webrtc.UI.exec = function (func, params)
	{
		this.parent.exec(func, params);
	};

	webrtc.UI.show = function (state, options)
	{
		var params = options || {};
		params.state = state;
		return this.exec("showUi", params);
	};

	webrtc.UI.close = function (params)
	{
		return this.exec("closeUi", params);
	};

	webrtc.UI.showLocalVideo = function (params)
	{
		return this.exec("showLocalVideo", params);
	};

	//WebRTC methods
	webrtc.createPeerConnection = function (params)
	{
		return this.exec("createPeerConnection", params);
	};

	webrtc.createOffer = function (params)
	{
		return this.exec("createOffer", params);
	};

	webrtc.createAnswer = function (params)
	{
		return this.exec("createAnswer", params);
	};

	webrtc.addIceCandidates = function (params)
	{

		return this.exec("addIceCandidates", params);
	};

	webrtc.setRemoteDescription = function (params)
	{
		return this.exec("setRemoteDescription", params);
	};

	webrtc.getUserMedia = function (params)
	{
		return this.exec("getUserMedia", params);
	};

	webrtc.onReconnect = function (params)
	{
		return this.exec("onReconnect", params);
	};

	webrtc.setEventListeners = function (params)
	{
		return this.exec("setEventListeners", params);
	};


	/**
	 * BitrixMobile
	 * @constructor
	 */

	var app = new BXCordovaPlugin("BitrixMobile", true);
	window.app = app;

	//#############################
	//#####--api version 12--#######
	//#############################
	/**
	 * Available actions - "show", "add"
	 * @param action
	 * @param params
	 */

	app.notificationBar = function (action, params)
	{
		this.exec("notificationBar", {"action": action, "params": params});
	};

	//#############################
	//#####--api version 10--######
	//#############################
	/**
	 * Available actions - "show", "create"
	 * @param action
	 * @param params
	 */
	app.actionSheet = function(action, params)
	{
		this.exec("actionSheet",{"action":action, "params": params});
	};

	/**
	 * Available actions - "show", "hide","setParams"
	 * @param action
	 * @param params
	 */
	app.titleAction = function(action, params)
	{
		this.exec("titleAction",{"action":action, "params": params});
	};

	/**
	 * Available actions
	 * 	"start" - starts refresh
	 * 	"stop" - stop refresh with 1 sec delay
	 * 	"setParams" - sets params
	 *  Available keys in the params object:
	 *    enable - enable/disable control
	 *    callback - js-callback which will be executed as soon as the refresh action has done
	 *  button_name - title of send button
	 *  useImageButton - bool, if true send button will be shown as an image
	 *  instead of standard send button
	 *  plusAction - js-callback for "+" button
	 *  action - js-callback, example:
	 *
	 * @param action
	 * @param params
	 */
	app.refresh = function (action, params)
	{
		this.exec("refreshAction", {"action": action, "params": params});
	};

	/**
	 * Available actions:
	 * 		"show" - shows text panel
	 * 		"hide" - hides text panel
	 * 		"clear" - clears text
	 * 		"focus" - makes text panel focused and shows keyboard
	 * 		"setParams" - sets params which were passed as a second argument
	 * Available keys in params object:
	 * 	placeholder - text placeholder
	 * 	text - text in input field
	 *  button_name - title of send button
	 *  useImageButton - bool, if true send button will be shown as an image
	 *  instead of standard send button
	 *  plusAction - js-callback for "+" button
	 *  action - js-callback, example:
	 *  			function(text)
	 *              {
	 *					app.textPanelAction("clear");
 	 *					alert(text);
 	 *				},
	 * @param action
	 * @param params
	 */
	app.textPanelAction = function (action, params)
	{
		this.exec("textPanelAction", {"action": action, "params": params});
	};

	//#############################
	//#####--api version 9--#######
	//#############################


	app.showSlidingPanel = function (params)
	{
		return this.exec("showSlidingPanel", params);
	};

	app.changeAccount = function ()
	{
		return this.exec("changeAccount", {});
	};

	//#############################
	//#####--api version 7--#######
	//#############################

	/**
	 * Shows cached documents.
	 * It may be used to deletion of unused documents
	 * to make up more free space on the disc
	 * @param params
	 * @returns {*}
	 */
	app.showDocumentsCache = function (params)
	{
		return this.exec("showDocumentsCache", params);
	};
	/**
	 * Shows additional white panel under navigation bar.
	 * @param params - The parameters
	 * @param params.buttons - The dictionary of buttons on the panel
	 * @param params.hidden_buttons_panel - The parameter control by visibility of the panel
	 * while scrolling down. true - by default
	 * @deprecated
	 * @returns {*}
	 */
	app.showButtonPanel = function (params)
	{
		return this.exec("showButtonPanel", params);
	};
	/**
	 * Hides additional white panel under navigation bar.
	 * @param params - The parameters
	 * @returns {*}
	 */
	app.hideSlidingPanel = app.hideButtonPanel = function (params)
	{
		return this.exec("hideSlidingPanel", params);
	};


	/**
	 * Shows dialog of choosing of the values
	 * @param params - The parameters
	 * @param params.callback - The handler
	 * @param params.values - The array of values. For example - ["apple","google","bitrix"]
	 * @param params.default_value - The selected item by default. For example - "bitrix"
	 * @param params.multiselect - It enables to set multiple choice mode. false - by default
	 *
	 * @returns {*}
	 */
	app.showSelectPicker = function (params)
	{
		return this.exec("showSelectPicker", params);
	};
	/**
	 * Hides dialog of choosing of the values
	 * @param params - The parameters
	 * @returns {*}
	 */
	app.hideSelectPicker = function (params)
	{
		return this.exec("hideSelectPicker", params);
	};
	/**
	 * Shows badge with the number on the button
	 * @param params
	 * @returns {*}
	 */
	app.updateButtonBadge = function (params)
	{
		return this.exec("updateButtonBadge", params);
	};

	//#############################
	//#####--api version 6--#######
	//#############################

	/**
	 * Opens barcode scanner
	 *
	 * @example
	 * app.openBarCodeScanner({
 *     callback:function(data){
 *          //handle data (example of the data  - {type:"SSD", canceled:0, text:"8293473200"})
 *     }
 * })
	 * @param params The parameters
	 * @param params.callback The handler
	 *
	 * @returns {*}
	 */
	app.openBarCodeScanner = function (params)
	{
		return this.exec("openBarCodeScanner", params);
	};

	/**
	 * Shows photo controller
	 * @example
	 * <pre>
	 *     app.openPhotos({
 *        "photos":[
 *            {
 *                "url":"http://mysite.com/sample.jpg",
 *                "description": "description text"
 *            },
 *            {
 *                "url":"/sample2.jpg",
 *                "description": "description text 2"
 *            }
 *            ...
 *       ]
 *  });
	 *  </pre>
	 * @param params The parameters
	 * @param params.photos The array of photos
	 *
	 * @returns {*}
	 */
	app.openPhotos = function (params)
	{
		return this.exec("openPhotos", params);
	};

	/**
	 * Removes all application controller cache (iOS)
	 * @param params The parameters. Empty yet.
	 * @returns {*}
	 */
	app.removeAllCache = function (params)
	{
		return this.exec("removeAllCache", params);
	};

	/**
	 * Add the page with passed url address to navigation stack
	 * @param params  The parameters
	 * @param params.url The page url
	 * @param [params.data] The data that will be saved for the page. Use getPageParams() to get stored data.
	 * @param [params.title] The title that will be placed in the center in navigation bar
	 * @param [params.unique] The unique flag for the page. false by default.
	 * @param [params.cache] The unique flag for the page. false by default.
	 * @returns {*}
	 */
	app.loadPageBlank = function (params)
	{
		return this.exec("openNewPage", params);
	};


	/**
	 * Loads the page as the first page in navigation chain.
	 * @param params The parameters
	 * @param params.url The absolute path of the page or url (http://example.com)
	 * @param [params.page_id] Identifier of the page, if this parameter will defined the page will be cached.
	 * @param [params.title] The title that will placed in the center of navigation bar
	 * @returns {*}
	 */
	app.loadPageStart = function (params)
	{
		return this.exec("loadPage", params);
	};

	/**
	 * shows confirm alert
	 * @param params
	 */
	app.confirm = function (params)
	{
		if (!this.available)
		{
			document.addEventListener("deviceready", BX.proxy(function ()
			{
				this.confirm(params)
			}, this), false);
			return;
		}

		var confirmData = {
			callback: function ()
			{
			},
			title: "",
			text: "",
			buttons: "OK"
		};
		if (params)
		{
			if (params.title)
				confirmData.title = params.title;
			if (params.buttons && params.buttons.length > 0)
			{
				confirmData.buttons = "";
				for (var i = 0; i < params.buttons.length; i++)
				{
					if (confirmData.buttons.length > 0)
					{
						confirmData.buttons += "," + params.buttons[i];
					}
					else
						confirmData.buttons = params.buttons[i];
				}
			}
			confirmData.accept = params.accept;

			if (params.text)
				confirmData.text = params.text;
			if (params.callback && typeof(params.callback) == "function")
				confirmData.callback = params.callback;
		}

		navigator.notification.confirm(
			confirmData.text,
			confirmData.callback,
			confirmData.title,
			confirmData.buttons
		);

	};
	/**
	 * shows alert with custom title
	 * @param params
	 */
	app.alert = function (params)
	{

		if (!this.available)
		{
			document.addEventListener("deviceready", BX.proxy(function ()
			{
				this.alert(params)
			}, this), false);
			return;
		}

		var alertData = {
			callback: function ()
			{
			},
			title: "",
			button: "",
			text: ""
		};
		if (params)
		{
			if (params.title)
				alertData.title = params.title;
			if (params.button)
				alertData.button = params.button;
			if (params.text)
				alertData.text = params.text;
			if (params.callback && typeof(params.callback) == "function")
				alertData.callback = params.callback;
		}

		navigator.notification.alert(
			alertData.text,
			alertData.callback,
			alertData.title,
			alertData.button
		);

	};

	/**
	 * opens left slider
	 * @returns {*}
	 */
	app.openLeft = function ()
	{
		return this.exec("openMenu");
	};

	/**
	 * sets title of the current page
	 * @param params
	 * title - text title
	 * @returns {*}
	 */
	app.setPageTitle = function (params)
	{
		return this.exec("setPageTitle", params);
	};

	//#############################
	//#####--api version 5--#######
	//#############################
	/**
	 * removes cache of table by id
	 * in next time a table appear it will be reloaded
	 * @param tableId
	 * @returns {*}
	 */
	app.removeTableCache = function (tableId)
	{
		return this.exec("removeTableCache", {"table_id": tableId});
	};

	/** shows native datetime picker
	 * @param params
	 * @param params.format {string} date's format
	 * @param params.type {string} "datetime"|"time"|"date"
	 * @param params.callback {string}  The handler on date select event
	 * @returns {*}
	 */
	app.showDatePicker = function (params)
	{
		return this.exec("showDatePicker", params);
	};

	/**
	 * hides native datetime picker
	 * @returns {*}
	 */
	app.hideDatePicker = function ()
	{

		return this.exec("hideDatePicker");
	};

	//#############################
	//#####--api version 4--#######
	//#############################
	/**
	 * @deprecated
	 * Shows native input panel
	 * @param params
	 * @param {string} params.placeholder  Text for the placeholder
	 * @param {string} params.button_name  Label of the button
	 * @param {function} params.action Onclick-handler for the button
	 * @example
	 * app.showInput({
 *				placeholder:"New message...",
 *				button_name:"Send",
 *				action:function(text)
 *				{
 *					app.clearInput();
 *					alert(text);
 *				},
 *			});
	 * @returns {*}
	 */
	app.showInput = function (params)
	{
		return this.exec("showInput", params);
	};

	/**
	 * @deprecated
	 * use it to disable with activity indicator or enable button
	 * @param {boolean} loading_status
	 * @returns {*}
	 */
	app.showInputLoading = function (loading_status)
	{
		if (loading_status && loading_status !== true)
			loading_status = false;
		return this.exec("showInputLoading", {"status": loading_status});

	};

	/**
	 * Clears native input
	 * @deprecated
	 * @returns {*}
	 */
	app.clearInput = function ()
	{
		return this.exec("clearInput");
	};

	/**
	 * hides native input
	 * @returns {*}
	 */
	app.hideInput = function ()
	{
		return this.exec("hideInput");
	};

//#############################
//#####--api version 3--#######
//#############################

	/**
	 * reloads page
	 * @param params
	 */
	app.reload = function (params)
	{
		var params = params || {url: document.location.href};

		if (window.platform == 'android')
		{
			this.exec('reload', params);
		}
		else
		{
			document.location.href = params.url;
		}
	};

	/**
	 * makes flip-screen effect
	 * @returns {*}
	 */
	app.flipScreen = function ()
	{
		return this.exec("flipScreen");
	};

	/**
	 * removes buttons of the page
	 * @deprecated
	 * @param params
	 * @param {string} params.position Position of button
	 * @returns {*}
	 */
	app.removeButtons = function (params)
	{
		return this.exec("removeButtons", params);
	};

	/**
	 *
	 * @param {object} params Settings of the table
	 * @param {string} params.url The url to download json-data
	 * @param {string} [params.table_id] The identifier of the table
	 * @param {boolean} [params.isroot] If true the table will be opened as first screen
	 * @param {object} [params.TABLE_SETTINGS]  Start settings of the table, it can be overwritten after download json data
	 * @param {object} [params.table_settings]  Start settings of the table, it can be overwritten after download json data
	 * @description TABLE_SETTINGS
	 *     callback: handler on ok-button tap action, it works only when 'markmode' is true
	 *     markmode: set it true to turn on mark mode, false - by default
	 *     modal: if true your table will be opened in modal dialog, false - by default
	 *     multiple: it works if 'markmode' is true, set it false to turn off multiple selection
	 *     okname - name of ok button
	 *     cancelname - name of cancel button
	 *     showtitle: true - to make title visible, false - by default
	 *     alphabet_index: if true - table will be divided on alphabetical sections
	 *     selected: this is a start selected data in a table, for example {users:[1,2,3,4],groups:[1,2,3]}
	 *     button:{
 	*                name: "name",
 	*                type: "plus",
 	*                callback:function(){
 	*                    //your code
 	*                }
 	*     };
	 * @returns {*}
	 */
	app.openBXTable = function (params)
	{
		if (typeof(params.table_settings) != "undefined")
		{
			params.TABLE_SETTINGS = params.table_settings;
			delete params.table_settings;
		}
		if (params.TABLE_SETTINGS.markmode && params.TABLE_SETTINGS.markmode == true)
		{
			if (params.TABLE_SETTINGS.callback && typeof(params.TABLE_SETTINGS.callback) == "function")
			{
				var insertCallback = params.TABLE_SETTINGS.callback;
				params.TABLE_SETTINGS.callback = function (data)
				{
					insertCallback(BitrixMobile.Utils.htmlspecialchars(data));
				}
			}
		}

		if(typeof params.TABLE_SETTINGS.modal != "undefined")
		{
			params.modal = params.TABLE_SETTINGS.modal;
		}

		return this.exec("openBXTable", params);
	};

	/**
	 * Open document in separated window
	 * @deprecated
	 * @param params
	 * @param {string} params.url  The document url
	 * @example
	 * app.openDocument({"url":"/upload/123.doc"});
	 * @returns {*}
	 */
	app.openDocument = function (params)
	{
		return this.exec("openDocument", params);
	};

	/**
	 * Shows the small loader in the center of the screen
	 * The loader will be automatically hided when "back" button pressed
	 * @param params - settings
	 * @param params.text The text of the loader
	 * @returns {*}
	 */
	app.showPopupLoader = function (params)
	{
		return this.exec("showPopupLoader", params);
	};

	/**
	 * Hides the small loader
	 * @param params The parameters
	 * @returns {*}
	 */
	app.hidePopupLoader = function (params)
	{
		return this.exec("hidePopupLoader", params);
	};

	/**
	 * Changes the parameters of the current page, that can be getted by getPageParams()
	 * @param params - The parameters
	 * @param params.data any mixed data
	 * @param {function} params.callback The callback-handler
	 * @returns {*}
	 */
	app.changeCurPageParams = function (params)
	{
		return this.exec("changeCurPageParams", params);
	};

	/**
	 * Gets the parameters of the page
	 * @param params The parameters
	 * @param {function} params.callback The handler
	 * @returns {*}
	 */
	app.getPageParams = function (params)
	{

		if (!this.enableInVersion(3))
			return false;

		return this.exec("getPageParams", params);
	};

	/**
	 * Creates the ontext menu of the page
	 * @example
	 * Parameters example:
	 * <pre>
	 *params =
	 *{
	*   			items:[
	*				{
	*					name:"Post message",
	*					action:function() { postMessage();},
	*					image: "/upload/post_message_icon.phg"
	*				},
	*				{
	*					name:"To Bitrix!",
	*					url:"http://bitrix.ru",
	*					icon: 'settings'
	*				}
	*			]
	 *}
	 *
	 * </pre>
	 * @param params The parameters
	 * @returns {*}
	 */
	app.menuCreate = function (params)
	{
		return this.exec("menuCreate", params);
	};

	/**
	 * Shows the context menu
	 * @returns {*}
	 */
	app.menuShow = function ()
	{
		return this.exec("menuShow");
	};

	/**
	 * Hides the context menu
	 * @returns {*}
	 */
	app.menuHide = function ()
	{
		return this.exec("menuHide");
	};

//#############################
//#####--api version 2--#######
//#############################

	/**
	 * Checks if it's required application version or not
	 * @param ver The version of API
	 * @param [strict]
	 * @returns {boolean}
	 */
	app.enableInVersion = function (ver, strict)
	{
		var api_version = 1;
		try
		{
			if(typeof(appVersion) != "undefined")
			{
				api_version = appVersion;
			}
			else
			{
				api_version = BXMobileAppContext.getApiVersion();
			}
		} catch (e)
		{
			//do noth
		}

		return (typeof(strict)!="undefined" && strict == true)
					? (parseInt(api_version) == parseInt(ver))
					: (parseInt(api_version) >= parseInt(ver));
	};


	/**
	 * Checks if the page is visible in this moment
	 * @param params The parameters
	 * @param params.callback The handler
	 * @returns {*}
	 */
	app.checkOpenStatus = function (params)
	{
		return this.exec("checkOpenStatus", params);
	};

	app.asyncRequest = function (params)
	{
		//native asyncRequest
		//params.url
		return this.exec("asyncRequest", params);
	};

//#############################
//#####--api version 1--#######
//#############################

	/**
	 * Opens url in external browser
	 * @param url
	 * @returns {*}
	 */
	app.openUrl = function (url)
	{
		//open url in external browser
		return this.exec("openUrl", url);
	};

	/**
	 * Register a callback
	 * @param {function} func The callback function
	 * @returns {number}
	 * @constructor
	 */
	app.RegisterCallBack = function (func)
	{
		if (typeof(func) == "function")
		{
			this.callbackIndex++;

			this.callbacks["callback" + this.callbackIndex] = func;

			return this.callbackIndex;
		}

	};

	/**
	 * Execute registered callback function by index
	 * @param index The index of callback function
	 * @param result The parameters that will be passed to callback as a first argument
	 * @constructor
	 */
	app.CallBackExecute = function (index, result)
	{
		if (this.callbacks["callback" + index] && (typeof this.callbacks["callback" + index]) === "function")
		{
			this.callbacks["callback" + index](result);
		}
	};

	/**
	 * Generates the javascript-event
	 * that can be caught by any application browsers
	 * except current browser
	 * @param eventName
	 * @param params
	 * @param where
	 * @returns {*|Array|{index: number, input: string}}
	 * @param needPrepare
	 */
	app.onCustomEvent = function (eventName, params, where, needPrepare)
	{
		if(typeof needPrepare == "undefined")
		{
			needPrepare = true;
		}

		if (!this.available)
		{
			document.addEventListener("deviceready", BX.delegate(function ()
			{
				this.onCustomEvent(eventName, params, where, needPrepare);
			}, this), false);

			return;
		}
		if(needPrepare)
			params = this.prepareParams(params);

		if (typeof(params) == "object")
			params = JSON.stringify(params);

		if (device.platform.toUpperCase() == "ANDROID" || device.cordova > '2.0.0')
		{
			var params_pre = {
				"eventName": eventName,
				"params": params
			};
			return Cordova.exec(null, null, "BitrixMobile", "onCustomEvent", [params_pre]);
		}
		else
		{
			return Cordova.exec("BitrixMobile.onCustomEvent", eventName, params, where);
		}
	};

	/**
	 * Gets javascript variable from current and left
	 * @param params The parameters
	 * @param params.callback The handler
	 * @param params.var The variable's name
	 * @param params.from The browser ("left"|"current")
	 * @returns {*}
	 */
	app.getVar = function (params)
	{
		return this.exec("getVar", params);
	};

	/**
	 *
	 * @param variable
	 * @param key
	 * @returns {*}
	 */
	app.passVar = function (variable, key)
	{

		try
		{
			evalVar = window[variable];
			if (!evalVar)
				evalVar = "empty"
		}
		catch (e)
		{
			evalVar = ""
		}

		if (evalVar)
		{

			if (typeof(evalVar) == "object")
				evalVar = JSON.stringify(evalVar);

			if (platform.toUpperCase() == "ANDROID")
			{

				key = key || false;
				if (key)
					Bitrix24Android.receiveStringValue(JSON.stringify({variable: evalVar, key: key}));
				else
					Bitrix24Android.receiveStringValue(evalVar);
			} else
			{
				return evalVar;
			}
		}
	};


	/**
	 * Opens the camera/albums dialog
	 * @param options The parameters
	 * @param options.source  0 - albums, 1 - camera
	 * @param options.callback The event handler that will be fired when the photo will have selected. Photo will be passed into the callback in base64 as a first parameter.
	 */
	app.takePhoto = function (options)
	{
		if (!this.available)
		{
			document.addEventListener("deviceready", BX.proxy(function ()
			{
				this.takePhoto(options);
			}, this), false);
			return;
		}

		if (!options.callback)
			options.callback = function ()
			{
			};
		if (!options.fail)
			options.fail = function ()
			{
			};

		var params = {
			quality: (options.quality || (this.enableInVersion(2) ? 40 : 10)),
			correctOrientation: (options.correctOrientation || false),
			targetWidth: (options.targetWidth || false),
			targetHeight: (options.targetHeight || false),
			sourceType: ((typeof options.source != "undefined") ? options.source : 0),
			mediaType: ((typeof options.mediaType != "undefined") ? options.mediaType : 0),
			allowEdit: ((typeof options.allowEdit != "undefined") ? options.allowEdit : false),
			saveToPhotoAlbum: ((typeof options.saveToPhotoAlbum != "undefined") ? options.saveToPhotoAlbum : false)
		};

		if (options.destinationType !== undefined)
			params.destinationType = options.destinationType;
		navigator.camera.getPicture(options.callback, options.fail, params);


	};
	/**
	 * Opens left screen of the slider
	 * @deprecated It is deprecated. Use BitrixMobile.openLeft.
	 * @see BitrixMobile.openLeft
	 * @returns {*}
	 */
	app.openMenu = function ()
	{
		return this.exec("openMenu");
	};

	/**
	 * Opens page in modal dialog
	 * @param options The parameters
	 * @param options.url The page url
	 * @returns {*}
	 */
	app.showModalDialog = function (options)
	{
		return this.exec("showModalDialog", options);
	};

	/**
	 * Closes current modal dialog
	 * @param options
	 * @returns {*}
	 */
	app.closeModalDialog = function (options)
	{
		return this.exec("closeModalDialog", options);
	};

	/**
	 * Closes current controller
	 * @param [params] The parameters
	 * @param {boolean} [params.drop] It works on <b>Android</b> only. <u>true</u> - the controller will be dropped after it has disappeared, <u>false</u> - the controller will not be dropped after it has disappeared.
	 * @returns {*}
	 */
	app.closeController = function (params)
	{
		return this.exec("closeController", params);
	};

	/**
	 * Adds buttons to the navigation panel.
	 * @param buttons The parameters
	 * @param buttons.callback The onclick handler
	 * @param buttons.type  The type of the button (plus|back|refresh|right_text|back_text|users|cart)
	 * @param buttons.name The name of the button
	 * @param buttons.bar_type The panel type ("toolbar"|"navbar")
	 * @param buttons.position The position of the button ("left"|"right")
	 * @returns {*}
	 */
	app.addButtons = function (buttons)
	{
		return this.exec("addButtons", buttons);
	};

	/**
	 * Opens the center of the slider
	 * @returns {*}
	 */
	app.openContent = function ()
	{
		return this.exec("openContent");
	};

	/**
	 * Opens the left side of the slider
	 * @deprecated Use closeLeft()
	 * @returns {*}
	 */
	app.closeMenu = function ()
	{
		return this.exec("closeMenu");
	};

	/**
	 * Opens the page as the first page in the navigation stack
	 * @deprecated Use loadStartPage(params).
	 * @param url
	 * @param page_id
	 * @returns {*}
	 */
	app.loadPage = function (url, page_id)
	{
		//open page from menu
		if (this.enableInVersion(2) && page_id)
		{
			params = {
				url: url,
				page_id: page_id
			};
			return this.exec("loadPage", params);
		}

		return this.exec("loadPage", url);
	};

	/**
	 * Sets identifier of the page
	 * @param pageID
	 * @returns {*}
	 */
	app.setPageID = function (pageID)
	{
		return this.exec("setPageID", pageID);
	};

	/**
	 * Opens the new page with slider effect
	 * @deprecated Use loadPageBlank(params)
	 * @param url
	 * @param data
	 * @param title
	 * @returns {*}
	 */
	app.openNewPage = function (url, data, title)
	{

		if (this.enableInVersion(3))
		{
			var params = {
				url: url,
				data: data,
				title: title
			};

			return this.exec("openNewPage", params);
		}
		else
			return this.exec("openNewPage", url);
	};

	/**
	 * Loads the page into the left side of the slider using the url
	 * @deprecated
	 * @param url
	 * @returns {*}
	 */
	app.loadMenu = function (url)
	{
		return this.exec("loadMenu", url);
	};

	/**
	 * Opens the list
	 * @deprecated Use openBXTable();
	 * @returns {*}
	 * @param params
	 */
	app.openTable = function (params)
	{
		if (params.markmode && params.markmode == true)
		{
			if (params.callback && typeof(params.callback) == "function")
			{
				if (!(params.skipSpecialChars && params.skipSpecialChars === true))
				{
					var insertCallback = params.callback;

					params.callback = function (data)
					{
						insertCallback(BitrixMobile.Utils.htmlspecialchars(data));
					}
				}
			}
		}
		return this.exec("openTable", params);
	};

	/**
	 * @deprecated Use openBXTable()
	 *  <b>PLEASE, DO NOT USE IT!!!!</b>
	 * It is simple wrapper of openBXTable()
	 * @see BitrixMobile.openBXTable
	 * @param options The parameter.
	 * @returns {*}
	 */
	app.openUserList = function (options)
	{
		return this.exec("openUserList", options);
	};

	app.addUserListButton = function (options)
	{
		//open table controller
		//options.url
		return this.exec("addUserListButton", options);
	};

	app.pullDown = function (params)
	{
		//on|off pull down action on the current page
		//params.pulltext, params.downtext, params.loadtext
		//params.callback - action on pull-down-refresh
		//params.enable - true|false
		return this.exec("pullDown", params);
	};
	/**
	 * @deprecated
	 * @returns {*}
	 */
	app.pullDownLoadingStop = function ()
	{
		return this.exec("pullDownLoadingStop");
	};

	/**
	 * Enables or disables scroll ability of the current page
	 * @deprecated
	 * @param enable_status The scroll ability status
	 * @returns {*}
	 */
	app.enableScroll = function (enable_status)
	{
		//enable|disable scroll on the current page
		var enable_status = enable_status || false;
		return this.exec("enableScroll", enable_status);
	};

	/**
	 * Enables or disables firing events of  hiding/showing  of soft keyboard
	 * @deprecated
	 * @param enable_status
	 * @returns {*}
	 */
	app.enableCaptureKeyboard = function (enable_status)
	{
		//enable|disable capture keyboard event on the current page
		var enable_status = enable_status || false;
		return this.exec("enableCaptureKeyboard", enable_status);
	};

	/**
	 * Enables or disables the ability of automatic showing/hiding of the loading screen at the current page
	 * when it has started or has finished loading process
	 * @deprecated
	 * @param enable_status The ability status
	 * @returns {*}
	 */
	app.enableLoadingScreen = function (enable_status)
	{
		//enable|disable autoloading screen on the current page
		var enable_status = enable_status || false;
		return this.exec("enableLoadingScreen", enable_status);
	};


	/**
	 *@deprecated
	 * Shows the loading screen at the page
	 * @returns {*}
	 */
	app.showLoadingScreen = function ()
	{
		//show loading screen
		return this.exec("showLoadingScreen");
	};

	/**
	 * Hides the loadding screen at the page
	 * @deprecated
	 * @returns {*}
	 */
	app.hideLoadingScreen = function ()
	{
		//hide loading screen
		return this.exec("hideLoadingScreen");
	};


	/**
	 * Sets visibility status of the navigation bar
	 * @deprecated
	 * @param {boolean} visible The visibility status
	 * @returns {*}
	 */
	app.visibleNavigationBar = function (visible)
	{
		//visibility status of the native navigation bar
		var visible = visible || false;
		return this.exec("visibleNavigationBar", visible);
	};

	/**
	 * Sets visibility status of the bottom bar
	 * @deprecated
	 * @param {boolean} visible The visibility status
	 * @returns {*}
	 */
	app.visibleToolBar = function (visible)
	{
		//visibility status of toolbar at the bottom
		var visible = visible || false;
		return this.exec("visibleToolBar", visible);
	};

	/**
	 * @deprecated
	 * @param enable
	 * @returns {*}
	 */
	app.enableSliderMenu = function (enable)
	{
		//lock|unlock slider menu
		var enable = enable || false;
		return this.exec("enableSliderMenu", enable);
	};

	app.enableRight = function (enable)
	{
		//lock|unlock slider menu
		var enable = enable || false;
		return this.exec("enableRight", enable);
	};

	/**
	 * @deprecated
	 * @param counters
	 * @returns {*}
	 */
	app.setCounters = function (counters)
	{
		//set counters values on the navigation bar
		//counters.messages,counters.notifications
		return this.exec("setCounters", counters);
	};

	/**
	 * @deprecated
	 * @param number
	 * @returns {*}
	 */
	app.setBadge = function (number)
	{
		//application's badge number on the dashboard
		return this.exec("setBadge", number);
	};

	/**
	 * @deprecated
	 * @param pagename
	 * @returns {*}
	 */
	app.refreshPanelPage = function (pagename)
	{
		//set counters values on the navigation bar
		//counters.messages,counters.notifications

		if (!pagename)
			pagename = "";
		var options = {
			page: pagename
		};
		return this.exec("refreshPanelPage", options);
	};


	/**
	 * Sets page urls for the notify popup window and the messages popup window
	 * @deprecated
	 * @param pages
	 * @returns {*}
	 */
	app.setPanelPages = function (pages)
	{
		//pages for notify panel
		//pages.messages_page, pages.notifications_page,
		//pages.messages_open_empty, pages.notifications_open_empty
		return this.exec("setPanelPages", pages);
	};

	/**
	 * Gets the token from the current device. You may use the token to send push-notifications to the device.
	 * @returns {*}
	 */
	app.getToken = function ()
	{
		//get device token
		var dt = "APPLE";
		if (platform != "ios")
			dt = "GOOGLE";
		var params = {
			callback: function (token)
			{
				BX.proxy(
					BX.ajax.post(
						app.dataBrigePath,
						{
							mobile_action: "save_device_token",
							device_name: (typeof device.name == "undefined"? device.model: device.name),
							uuid: device.uuid,
							device_token: token,
							device_type: dt,
							sessid: BX.bitrix_sessid()
						},
						function (data)
						{
						}), this);
			}
		};

		return this.exec("getToken", params);
	};

	/**
	 * Executes a request by the check_url with Basic Authorization header
	 * @param params The parameters
	 * @param params.success The success javascript handler
	 * @param params.check_url The check url
	 * @returns {*}
	 * @constructor
	 */
	app.BasicAuth = function (params)
	{
		//basic autorization
		//params.success, params.check_url
		params = params || {};

		var userSuccessCallback = (params.success && typeof(params.success) == "function")
			? params.success
			: function ()
		{
		};
		var userFailCallback = (params.failture && typeof(params.failture) == "function")
			? params.failture
			: function ()
		{
		};

		var authParams = {
			check_url: params.check_url,
			success: function (data)
			{
				if (typeof data != "object")
				{
					try
					{
						data = JSON.parse(data);
					}
					catch (e)
					{
						data = {"status": "failed"}
					}
				}

				if (data.status == "success" && data.sessid_md5)
				{
					if (BX.message.bitrix_sessid != data.sessid_md5)
					{
						BX.message.bitrix_sessid = data.sessid_md5;
						app.onCustomEvent("onSessIdChanged", {sessid: data.sessid_md5});
					}

				}

				userSuccessCallback(data);
			},
			failture: function (data)
			{
				if (data.status == "failed")
					app.exec("showAuthForm");
				else
					userFailCallback(data);
			}

		};

		return this.exec("BasicAuth", authParams);
	};

	/**
	 * Logout
	 * @deprecated DO NOT USE IT ANY MORE!!!!
	 * @see BitrixMobile#asyncRequest
	 * @see BitrixMobile#showAuthForm
	 * @returns {*}
	 */
	app.logOut = function ()
	{
		//logout
		//request to mobile.data with mobile_action=logout
		if (this.enableInVersion(2))
		{
			this.asyncRequest({url: this.dataBrigePath + "?mobile_action=logout&uuid=" + device.uuid});
			return this.exec("showAuthForm");
		}

		var xhr = new XMLHttpRequest();
		xhr.open("GET", this.dataBrigePath + "?mobile_action=logout&uuid=" + device.uuid, true);
		xhr.onreadystatechange = function ()
		{
			if (xhr.readyState == 4 && xhr.status == "200")
			{
				return app.exec("showAuthForm");
			}

		};
		xhr.send(null);
	};
	/**
	 * Get location data
	 * @param options
	 */
	app.getCurrentLocation = function (options)
	{

		if (!this.available)
		{
			document.addEventListener("deviceready", BX.proxy(function ()
			{
				this.getCurrentLocation(options);
			}, this), false);
			return;
		}
		//get geolocation data
		var geolocationSuccess;
		var geolocationError;
		if (options)
		{
			geolocationSuccess = options.onsuccess;
			geolocationError = options.onerror;
		}
		navigator.geolocation.getCurrentPosition(
			geolocationSuccess, geolocationError);
	};

	app.setVibrate = function (ms)
	{
		// vibrate (ms)
		ms = ms || 500;
		navigator.notification.vibrate(parseInt(ms));
	};

	app.bindloadPageBlank = function ()
	{
		//Hack for Android Platform
		document.addEventListener(
			"DOMContentLoaded",
			function ()
			{
				document.body.addEventListener(
					"click",
					function (e)
					{
						var intentLink = null;
						var hash = "__bx_android_click_detect__";
						if (e.target.tagName.toUpperCase() == "A")
							intentLink = e.target;
						else
							intentLink = BX.findParent(e.target, {tagName: "A"}, 10);

						if (intentLink && intentLink.href && intentLink.href.length > 0)
						{
							if (intentLink.href.indexOf(hash) == -1 && intentLink.href.indexOf("javascript") != 0)
							{
								if (intentLink.href.indexOf("#") == -1)
									intentLink.href += "#" + hash;
								else
									intentLink.href += "&" + hash;
							}

						}

					},
					false
				);
			},
			false
		);

	};

	BitrixMobile = {};
	BitrixMobile.Utils = {

		autoResizeForm: function (textarea, pageContainer, maxHeight)
		{
			if (!textarea || !pageContainer)
				return;

			var formContainer = textarea.parentNode;
			maxHeight = maxHeight || 126;

			var origTextareaHeight = (textarea.ownerDocument || document).defaultView.getComputedStyle(textarea, null).getPropertyValue("height");
			var origFormContainerHeight = (formContainer.ownerDocument || document).defaultView.getComputedStyle(formContainer, null).getPropertyValue("height");

			origTextareaHeight = parseInt(origTextareaHeight); //23
			origFormContainerHeight = parseInt(origFormContainerHeight); //51
			textarea.setAttribute("data-orig-height", origTextareaHeight);
			formContainer.setAttribute("data-orig-height", origFormContainerHeight);

			var currentTextareaHeight = origTextareaHeight;
			var hiddenTextarea = document.createElement("textarea");
			hiddenTextarea.className = "send-message-input";
			hiddenTextarea.style.height = currentTextareaHeight + "px";
			hiddenTextarea.style.visibility = "hidden";
			hiddenTextarea.style.position = "absolute";
			hiddenTextarea.style.left = "-300px";

			document.body.appendChild(hiddenTextarea);

			textarea.addEventListener("change", resize, false);
			textarea.addEventListener("cut", resizeDelay, false);
			textarea.addEventListener("paste", resizeDelay, false);
			textarea.addEventListener("drop", resizeDelay, false);
			textarea.addEventListener("keyup", resize, false);

			if (window.platform == "android")
				textarea.addEventListener("keydown", resizeDelay, false);

			function resize()
			{
				hiddenTextarea.value = textarea.value;
				var scrollHeight = hiddenTextarea.scrollHeight;
				if (scrollHeight > maxHeight)
					scrollHeight = maxHeight;

				if (currentTextareaHeight != scrollHeight)
				{
					currentTextareaHeight = scrollHeight;
					textarea.style.height = scrollHeight + "px";
					formContainer.style.height = origFormContainerHeight + (scrollHeight - origTextareaHeight) + "px";
					pageContainer.style.bottom = origFormContainerHeight + (scrollHeight - origTextareaHeight) + "px";

					if (window.platform == "android")
						window.scrollTo(0, document.documentElement.scrollHeight);
				}
			}

			function resizeDelay()
			{
				setTimeout(resize, 0);
			}

		},

		resetAutoResize: function (textarea, pageContainer)
		{

			if (!textarea || !pageContainer)
				return;

			var formContainer = textarea.parentNode;

			var origTextareaHeight = textarea.getAttribute("data-orig-height");
			var origFormContainerHeight = formContainer.getAttribute("data-orig-height");

			textarea.style.height = origTextareaHeight + "px";
			formContainer.style.height = origFormContainerHeight + "px";
			pageContainer.style.bottom = origFormContainerHeight + "px";
		},

		showHiddenImages: function ()
		{
			var images = document.getElementsByTagName("img");
			for (var i = 0; i < images.length; i++)
			{
				var image = images[i];
				var realImage = image.getAttribute("data-src");
				if (!realImage)
					continue;

				if (BitrixMobile.Utils.isElementVisibleOnScreen(image))
				{
					image.src = realImage;
					image.setAttribute("data-src", "");
				}
			}
		},

		isElementVisibleOnScreen: function (element)
		{
			var coords = BitrixMobile.Utils.getElementCoords(element);

			var windowTop = window.pageYOffset || document.documentElement.scrollTop;
			var windowBottom = windowTop + document.documentElement.clientHeight;

			coords.bottom = coords.top + element.offsetHeight;

			var topVisible = coords.top > windowTop && coords.top < windowBottom;
			var bottomVisible = coords.bottom < windowBottom && coords.bottom > windowTop;

			return topVisible || bottomVisible;
		},

		isElementVisibleOn2Screens: function (element)
		{
			var coords = BitrixMobile.Utils.getElementCoords(element);

			var windowHeight = document.documentElement.clientHeight;
			var windowTop = window.pageYOffset || document.documentElement.scrollTop;
			var windowBottom = windowTop + windowHeight;

			coords.bottom = coords.top + element.offsetHeight;

			windowTop -= windowHeight;
			windowBottom += windowHeight;

			var topVisible = coords.top > windowTop && coords.top < windowBottom;
			var bottomVisible = coords.bottom < windowBottom && coords.bottom > windowTop;

			return topVisible || bottomVisible;

		},

		getElementCoords: function (element)
		{
			var box = element.getBoundingClientRect();

			return {
				originTop: box.top,
				originLeft: box.left,
				top: box.top + window.pageYOffset,
				left: box.left + window.pageXOffset
			};
		},

		htmlspecialchars: function (variable)
		{
			if (BX.type.isString(variable))
				return variable.replace(/&/g, '&amp;').replace(/"/g, '&quot;').replace(/</g, '&lt;').replace(/>/g, '&gt;');

			if (BX.type.isArray(variable))
			{
				for (var i = 0; i < variable.length; i++)
				{
					variable[i] = BitrixMobile.Utils.htmlspecialchars(variable[i]);
				}
			}
			else if (typeof(variable) == "object")
			{

				var obj = {};
				for (var key in variable)
					obj[key] = BitrixMobile.Utils.htmlspecialchars(variable[key]);
				variable = obj;
			}

			return variable;

		}
	};


	BitrixMobile.fastClick = {
		bindDelegate:function(elem, isTarget, handler)
		{
			if(typeof window.BX != "undefined")
			{
				var h = BX.delegateEvent(isTarget, handler);
				new FastButton(elem, h, true);
			}
			else
			{
				document.addEventListener('DOMContentLoaded', function ()
				{
					BitrixMobile.fastClick.bindDelegate(elem, isTarget, handler)
				});

			}
		},
		bind:function(elem, handler)
		{
			new FastButton(elem, handler, true);
		}

	};

	BitrixMobile.LazyLoad = {

		images: [],

		status: {
			hidden: -2,
			error: -1,
			"undefined": 0,
			inited: 1,
			loaded: 2
		},

		types: {
			image: 1,
			background: 2
		},

		clearImages: function ()
		{
			this.images = [];
		},

		showImages: function (checkOwnVisibility)
		{
			checkOwnVisibility = checkOwnVisibility === false ? false : true;
			for (var i = 0, length = this.images.length; i < length; i++)
			{
				var image = this.images[i];
				if (image.status == this.status.undefined)
				{
					this._initImage(image);
				}

				if (image.status !== this.status.inited)
				{
					continue;
				}

				if (!image.node || !image.node.parentNode)
				{
					image.node = null;
					image.status = BitrixMobile.LazyLoad.status.error;
					continue;
				}

				var isImageVisible = true;
				if (checkOwnVisibility && image.func)
				{
					isImageVisible = image.func(image);
				}

				if (isImageVisible === true && BitrixMobile.Utils.isElementVisibleOn2Screens(image.node))
				{
					if (image.type == BitrixMobile.LazyLoad.types.image)
					{
						image.node.src = image.src;
					}
					else
					{
						image.node.style.backgroundImage = "url('" + image.src + "')";
					}

					image.node.setAttribute("data-src", "");
					image.status = this.status.loaded;
				}
			}
		},

		registerImage: function (id, isImageVisibleCallback)
		{
			if (BX.type.isNotEmptyString(id))
			{
				this.images.push({
					id: id,
					node: null,
					src: null,
					type: null,
					func: BX.type.isFunction(isImageVisibleCallback) ? isImageVisibleCallback : null,
					status: this.status.undefined
				});
			}
		},

		registerImages: function (ids, isImageVisibleCallback)
		{
			if (BX.type.isArray(ids))
			{
				for (var i = 0, length = ids.length; i < length; i++)
				{
					this.registerImage(ids[i], isImageVisibleCallback);
				}
			}
		},

		_initImage: function (image)
		{
			image.status = this.status.error;
			var node = BX(image.id);
			if (node)
			{
				var src = node.getAttribute("data-src");
				if (BX.type.isNotEmptyString(src))
				{
					image.node = node;
					image.src = src;
					image.status = this.status.inited;
					image.type = image.node.tagName.toLowerCase() == "img" ?
						BitrixMobile.LazyLoad.types.image :
						BitrixMobile.LazyLoad.types.background;
				}
			}
		},

		getImageById: function (id)
		{
			for (var i = 0, length = this.images.length; i < length; i++)
			{
				if (this.images[i].id == id)
				{
					return this.images[i];
				}
			}

			return null;
		},

		removeImage: function (id)
		{
			for (var i = 0, length = this.images.length; i < length; i++)
			{
				if (this.images[i].id == id)
				{
					this.images = BX.util.deleteFromArray(this.images, i);
					break;
				}
			}

		},

		onScroll: function ()
		{
			BitrixMobile.LazyLoad.showImages();
		}

	};


	window.BitrixAnimation = {

		animate: function (options)
		{
			if (!options || !options.start || !options.finish ||
				typeof(options.start) != "object" || typeof(options.finish) != "object"
			)
				return null;

			for (var propName in options.start)
			{
				if (!options.finish[propName])
				{
					delete options.start[propName];
				}
			}

			options.progress = function (progress)
			{
				var state = {};
				for (var propName in this.start)
					state[propName] = Math.round(this.start[propName] + (this.finish[propName] - this.start[propName]) * progress);

				if (this.step)
					this.step(state);
			};

			return BitrixAnimation.animateProgress(options);
		},

		animateProgress: function (options)
		{
			var start = new Date();
			var delta = options.transition || BitrixAnimation.transitions.linear;
			var duration = options.duration || 1000;

			var timer = setInterval(function ()
			{

				var progress = (new Date() - start) / duration;
				if (progress > 1)
					progress = 1;

				options.progress(delta(progress));

				if (progress == 1)
				{
					clearInterval(timer);
					options.complete && options.complete();
				}

			}, options.delay || 13);

			return timer;
		},

		makeEaseInOut: function (delta)
		{
			return function (progress)
			{
				if (progress < 0.5)
					return delta(2 * progress) / 2;
				else
					return (2 - delta(2 * (1 - progress))) / 2;
			}
		},

		makeEaseOut: function (delta)
		{
			return function (progress)
			{
				return 1 - delta(1 - progress);
			};
		},

		transitions: {

			linear: function (progress)
			{
				return progress;
			},

			elastic: function (progress)
			{
				return Math.pow(2, 10 * (progress - 1)) * Math.cos(20 * Math.PI * 1.5 / 3 * progress);
			},

			quad: function (progress)
			{
				return Math.pow(progress, 2);
			},

			cubic: function (progress)
			{
				return Math.pow(progress, 3);
			},

			quart: function (progress)
			{
				return Math.pow(progress, 4);
			},

			quint: function (progress)
			{
				return Math.pow(progress, 5);
			},

			circ: function (progress)
			{
				return 1 - Math.sin(Math.acos(progress));
			},

			back: function (progress)
			{
				return Math.pow(progress, 2) * ((1.5 + 1) * progress - 1.5);
			},

			bounce: function (progress)
			{
				for (var a = 0, b = 1; 1; a += b, b /= 2)
				{
					if (progress >= (7 - 4 * a) / 11)
					{
						return -Math.pow((11 - 6 * a - 11 * progress) / 4, 2) + Math.pow(b, 2);
					}
				}
			}
		}
	};

//Events' handlers

	document.addEventListener('DOMContentLoaded', function ()
	{
		//if we are using framecache+appcache we should to refresh server-depended lang variables
		BX.addCustomEvent("onFrameDataReceived", function (data)
			{
				if (data.lang)
					app.onCustomEvent("onServerLangReceived", data.lang);

			}
		);

		BX.addCustomEvent("onServerLangReceived", function (lang)
			{

				if (lang)
				{
					for (var k in lang)
					{
						BX.message[k] = lang[k];
					}
				}

			}
		);
	}, false);

	document.addEventListener("deviceready", function ()
	{
		app.available = true;

		BX.addCustomEvent("onSessIdChanged", function (data)
			{
				BX.message.bitrix_sessid = data.sessid;
			}
		);

		BX.addCustomEvent('onPageParamsChangedLegacy', function (params)
		{
			if (params.url != location.pathname+location.search)
				return false;

			BXMobileApp.UI.Page.params.set({data: params.data});
			BX.onCustomEvent('onPageParamsChanged', [params.data]);

			return true;
		});
	}, false);

	MobileAjaxWrapper = function ()
	{
		this.type = null;
		this.method = null;
		this.url = null;
		this.callback = null;
		this.failure_callback = null;
		this.progress_callback = null;
		this.offline = null;
		this.processData = null;
		this.xhr = null;
};

	MobileAjaxWrapper.prototype.Init = function (params)
	{
		if (params.type != 'json')
			params.type = 'html';

		if (params.method != 'POST')
			params.method = 'GET';

		if (params.processData == 'undefined')
			params.processData = true;

		this.type = params.type;
		this.method = params.method;
		this.url = params.url;
		this.data = params.data;
		this.processData = params.processData;
		this.start = params.start;
		this.preparePost = params.preparePost;
		this.callback = params.callback;

		if (params.callback_failure != 'undefined')
			this.failure_callback = params.callback_failure;
		if (params.callback_progress != 'undefined')
			this.progress_callback = params.callback_progress;
		if (params.callback_loadstart != 'undefined')
			this.loadstart_callback = params.callback_loadstart;
		if (params.callback_loadend != 'undefined')
			this.loadend_callback = params.callback_loadend;
	}

	MobileAjaxWrapper.prototype.Wrap = function (params)
	{
		this.Init(params);

		this.xhr = BX.ajax({
			'timeout': 30,
			'start' : this.start,
			'preparePost' : this.preparePost,
			'method': this.method,
			'dataType': this.type,
			'url': this.url,
			'data': this.data,
			'processData': this.processData,
			'onsuccess': BX.defer(
				function (response)
				{
					if (this.xhr.status === 0)
						var bFailed = true;
					else if (this.type == 'json')
					{
						var bFailed = (typeof response == 'object' && typeof response.status != 'undefined' && response.status == 'failed');
					}
					else if (this.type == 'html')
						var bFailed = (response == '{"status":"failed"}');

					if (bFailed)
					{
						this.RepeatRequest();
					}
					else
					{
						this.callback(response);
					}
				},
				this
			),
			'onfailure': BX.delegate(function (errorCode, requestStatus)
			{
				if (
					errorCode !== undefined
					&& errorCode == 'status'
					&& requestStatus !== undefined
					&& requestStatus == 401
				)
				{
					this.RepeatRequest();
				}
				else
				{
					this.failure_callback();
				}
			}, this)
		});

		if (this.progress_callback != null)
			BX.bind(this.xhr, "progress", this.progress_callback);

		if (this.load_callback != null)
			BX.bind(this.xhr, "load", this.load_callback);

		if (this.loadstart_callback != null)
			BX.bind(this.xhr, "loadstart", this.loadstart_callback);

		if (this.loadend_callback != null)
			BX.bind(this.xhr, "loadend", this.loadend_callback);

		if (this.error_callback != null)
			BX.bind(this.xhr, "error", this.error_callback);

		if (this.abort_callback != null)
			BX.bind(this.xhr, "abort", this.abort_callback);
		return this.xhr;
	}

	MobileAjaxWrapper.prototype.RepeatRequest = function ()
	{
		app.BasicAuth({
			'success': BX.delegate(
				function (auth_data)
				{
					this.data.sessid = auth_data.sessid_md5;
					this.xhr = BX.ajax({
						'timeout': 30,
						'method': this.method,
						'dataType': this.type,
						'url': this.url,
						'data': this.data,
						'onsuccess': BX.delegate(
							function (response_ii)
							{
								if (this.xhr.status === 0)
									var bFailed = true;
								else if (this.type == 'json')
								{
									var bFailed = (typeof response_ii == 'object' && typeof response_ii.status != 'undefined' && response_ii.status == 'failed');
								}
								else if (this.type == 'html')
									var bFailed = (response_ii == '{"status":"failed"}');

								if (bFailed)
									this.failure_callback();
								else
									this.callback(response_ii);
							},
							this
						),
						'onfailure': BX.delegate(function ()
						{
							this.failure_callback();
						}, this)
					});
				},
				this
			),
			'failture': BX.delegate(function ()
			{
				this.failure_callback();
			}, this)
		});
	}

	MobileAjaxWrapper.prototype.OfflineAlert = function (callback)
	{
		navigator.notification.alert(BX.message('MobileAppOfflineMessage'), (callback || BX.DoNothing), BX.message('MobileAppOfflineTitle'));
	}

	BMAjaxWrapper = new MobileAjaxWrapper;

	MobileNetworkStatus = function ()
	{
		this.offline = null;

		var _this = this;

		document.addEventListener("offline", function()
		{
			_this.offline = true;
		}, false);

		document.addEventListener("online", function()
		{
			_this.offline = false;
		}, false);

		document.addEventListener('DOMContentLoaded', function()
		{
			BX.addCustomEvent("UIApplicationDidBecomeActiveNotification", function(params)
			{
				var networkState = navigator.network.connection.type;
				_this.offline = (networkState == Connection.UNKNOWN || networkState == Connection.NONE);
			});
		}, false);
	};

	BMNetworkStatus = new MobileNetworkStatus;

})();


(function ()
{


	function addListener(el, type, listener, useCapture)
	{
		if (el.addEventListener)
		{
			el.addEventListener(type, listener, useCapture);
			return {
				destroy: function ()
				{
					el.removeEventListener(type, listener, useCapture);
				}
			};
		} else
		{
			var handler = function (e)
			{
				listener.handleEvent(window.event, listener);
			}
			el.attachEvent('on' + type, handler);

			return {
				destroy: function ()
				{
					el.detachEvent('on' + type, handler);
				}
			};
		}
	}

	var isTouch = true;

	/* Construct the FastButton with a reference to the element and click handler. */
	this.FastButton = function (element, handler, useCapture)
	{
		// collect functions to call to cleanup events
		this.events = [];
		this.touchEvents = [];
		this.element = element;
		this.handler = handler;
		this.useCapture = useCapture;
		if (isTouch)
			this.events.push(addListener(element, 'touchstart', this, this.useCapture));
		this.events.push(addListener(element, 'click', this, this.useCapture));
	};

	/* Remove event handling when no longer needed for this button */
	this.FastButton.prototype.destroy = function ()
	{
		for (i = this.events.length - 1; i >= 0; i -= 1)
			this.events[i].destroy();
		this.events = this.touchEvents = this.element = this.handler = this.fastButton = null;
	};

	/* acts as an event dispatcher */
	this.FastButton.prototype.handleEvent = function (event)
	{
		switch (event.type)
		{
			case 'touchstart':
				this.onTouchStart(event);
				break;
			case 'touchmove':
				this.onTouchMove(event);
				break;
			case 'touchend':
				this.onClick(event);
				break;
			case 'click':
				this.onClick(event);
				break;
		}
	};


	this.FastButton.prototype.onTouchStart = function (event)
	{
		event.stopPropagation ? event.stopPropagation() : (event.cancelBubble = true);
		this.touchEvents.push(addListener(this.element, 'touchend', this, this.useCapture));
		this.touchEvents.push(addListener(document.body, 'touchmove', this, this.useCapture));
		this.startX = event.touches[0].clientX;
		this.startY = event.touches[0].clientY;
	};


	this.FastButton.prototype.onTouchMove = function (event)
	{
		if (Math.abs(event.touches[0].clientX - this.startX) > 10 || Math.abs(event.touches[0].clientY - this.startY) > 10)
		{
			this.reset(); //if he did, then cancel the touch event
		}
	};


	this.FastButton.prototype.onClick = function (event)
	{
		this.reset();
		var result = this.handler.call(this.element, event);

		if (result !== null)
		{
			event.preventDefault();
			event.stopPropagation ? event.stopPropagation() : (event.cancelBubble = true);
		}

		if (event.type == 'touchend')
			clickbuster.preventGhostClick(this.startX, this.startY);
		return result;
	};

	this.FastButton.prototype.reset = function ()
	{
		for (i = this.touchEvents.length - 1; i >= 0; i -= 1)
			this.touchEvents[i].destroy();
		this.touchEvents = [];
	};

	this.clickbuster = function ()
	{
	}

	this.clickbuster.preventGhostClick = function (x, y)
	{
		clickbuster.coordinates.push(x, y);
		window.setTimeout(clickbuster.pop, 2500);
	};

	this.clickbuster.pop = function ()
	{
		clickbuster.coordinates.splice(0, 2);
	};


	this.clickbuster.onClick = function (event)
	{
		for (var i = 0; i < clickbuster.coordinates.length; i += 2)
		{
			var x = clickbuster.coordinates[i];
			var y = clickbuster.coordinates[i + 1];
			if (Math.abs(event.clientX - x) < 25 && Math.abs(event.clientY - y) < 25)
			{
				event.stopPropagation ? event.stopPropagation() : (event.cancelBubble = true);
				event.preventDefault ? event.preventDefault() : (event.returnValue = false);
			}
		}
	};

	if (isTouch)
	{
		document.addEventListener('click', clickbuster.onClick, true);
		clickbuster.coordinates = [];
	}
})(this);


function ReadyDevice(func)
{
	document.addEventListener("deviceready", func, false);
}


;
(function ()
{

	if (window.BXMobileApp) return;

	window.BXMobileApp =
	{
		apiVersion: (typeof appVersion != "undefined"? appVersion : 1),
		//platform: platform,
		cordovaVersion: "3.6.3",
		UI: {
			IOS: {
				flip: function ()
				{
					app.flipScreen()
				}
			},
			Slider: {
				state: {
					CENTER: 0,
					LEFT: 1,
					RIGHT: 2
				},
				setState: function (state)
				{
					switch (state)
					{
						case this.state.CENTER:
							app.openContent();
							break;
						case this.state.LEFT:
							app.openLeft();
							break;
						case this.state.RIGHT:
							app.exec("openRight");
							break;
						default ://to do nothing
					}
				},
				setStateEnabled: function (state, enabled)
				{
					switch (state)
					{
						case this.state.LEFT:
							app.enableSliderMenu(enabled);
							break;
						case this.state.RIGHT:
							app.exec("enableRight", enabled);
							break;
						default ://to do nothing
					}
				}
			},
			Photo: {
				show: function (params)
				{
					app.openPhotos(params);
				}
			},
			Document: {
				showCacheList: function (params)
				{
					app.showDocumentsCache(params);
				},
				open: function (params)
				{
					app.openDocument(params);
				}
			},
			DatePicker: {
				setParams: function (params)
				{
					if (typeof params == "object")
						this.params = params;
				},
				show: function (params)
				{
					this.setParams(params);
					app.showDatePicker(this.params);

				},
				hide: function ()
				{
					app.hideDatePicker();
				}
			},
			SelectPicker:{
				show: function(params){
					app.showSelectPicker(params);
				},
				hide: function(){
					app.hideSelectPicker();
				}
			},
			BarCodeScanner: {
				open: function (params)
				{
					app.openBarCodeScanner(params);
				}
			},
			NotifyPanel: {
				setNotificationNumber:function(number){
					app.setCounters({notifications:number});
				},
				setMessagesNumber:function(number){
					app.setCounters({messages:number});
				},
				setCounters: function (params)
				{
					app.setCounters(params);
				},
				refreshPage: function (pagename)
				{
					app.refreshPanelPage(pagename);
				},
				setPages: function (pages)
				{
					app.setPanelPages(pages);
				}
			},
			Badge:{
				/**
				 * Sets number fot badge
				 * @since 14
				 * @param {int} number value of badge
				 */
				setIconBadge: function(number){
					app.exec("setBadge", number)
				},
				/**
				 * Sets number fot badge
				 * @since 14
				 * @param {string} badgeCode identifier of badge
				 * @param {int} number value of badge
				 */
				setButtonBadge: function(badgeCode, number){
					app.exec("setButtonBadge",{
						code:badgeCode,
						value:number
					})
				}

			},
			types: {
				COMMON: 0,
				BUTTON: 1,
				PANEL: 2,
				TABLE: 3,
				MENU: 4,
				ACTION_SHEET: 5,
				NOTIFY_BAR: 6
			},
			parentTypes: {
				TOP_BAR: 0,
				BOTTOM_BAR: 1,
				SLIDING_PANEL: 2,
				UNKNOWN: 3
			}
		},
		PushManager:
		{
			prepareParams : function (push)
			{
				if (typeof (push) != 'object' || typeof (push.params) == 'undefined')
				{
					return {'ACTION': 'NONE'};
				}

				var result = {};
				try
				{
					result = JSON.parse(push.params);
				}
				catch(e)
				{
					result = {'ACTION': push.params};
				}

				return result;
			}
		},

		PageManager:
		{
			loadPageBlank: function (params)
			{
				/**
				 * Notice:
				 * use "bx24ModernStyle:true" to get new look of navigation bar
				 */
				app.loadPageBlank(params);
			},
			loadPageUnique: function (params)
			{
				if (typeof(params) != 'object')
					return false;

				/**
				 * Notice:
				 * use "bx24ModernStyle:true" to get new look of navigation bar
				 */

				params.unique = true;

				app.loadPageBlank(params);

				if (typeof(params.data) == 'object')
				{
					app.onCustomEvent("onPageParamsChangedLegacy", {url: params.url, data: params.data});
					BX.onCustomEvent("onPageParamsChangedLegacy", [{url: params.url, data: params.data}]);
				}

				return true;
			},
			loadPageStart: function (params)
			{
				app.loadPageStart(params);
			},
			loadPageModal: function (params)
			{
				app.showModalDialog(params)
			}
		},
		TOOLS: {
			extend: function (child, parent)
			{
				var f = function ()
				{
				};
				f.prototype = parent.prototype;

				child.prototype = new f();
				child.prototype.constructor = child;

				child.superclass = parent.prototype;
				if (parent.prototype.constructor == Object.prototype.constructor)
				{
					parent.prototype.constructor = parent;
				}
			},
			merge: function (obj1, obj2)
			{

				for (var key in obj1)
				{
					if (typeof obj2[key] != "undefined")
					{
						obj1[key] = obj2[key];
					}
				}

				return obj1;
			}

		},
		onCustomEvent: function (eventName, params)
		{
			app.onCustomEvent(eventName, params, false, false)
		}
	};


//--->Base UI element
	BXMobileApp.UI.Element = function (id, params)
	{
		this.id = (typeof id == "undefined")
			? this.type + "_" + Math.random()
			: id;
		this.parentId = ((params.parentId) ? params.parentId : BXMobileApp.UI.UNKNOWN);
		this.isCreated = false;
		this.isShown = false;
	};


	BXMobileApp.UI.Element.prototype.onCreate = function ()
	{
		this.isCreated = true;
		if (this.isShown)
		{
			app.exec("show", {type: this.type, id: this.id});
		}
	};

	BXMobileApp.UI.Element.prototype.getIdentifiers = function ()
	{
		return {
			id: this.id,
			type: this.type,
			parentId: this.parentId
		};
	};

	BXMobileApp.UI.Element.prototype.show = function ()
	{
		this.isShown = true;
		if (this.isCreated)
		{
			app.exec("show", {type: this.type, id: this.id});
		}
	};

	BXMobileApp.UI.Element.prototype.hide = function ()
	{
		this.isShown = false;
		app.exec("hide", {type: this.type, id: this.id});
	};

	BXMobileApp.UI.Element.prototype.destroy = function ()
	{
		//TODO destroy object
	};


	/**
	 * Button class
	 * @param id
	 * @param params
	 * @constructor
	 */
	BXMobileApp.UI.Button = function (id, params)
	{
		this.params = params;
		BXMobileApp.UI.Button.superclass.constructor.apply(this, [id, params]);
	};

	BXMobileApp.TOOLS.extend(BXMobileApp.UI.Button, BXMobileApp.UI.Element);
	BXMobileApp.UI.Button.prototype.setBadge = function (number)
	{
		if(this.params.badgeCode)
		{
			BXMobileApp.UI.Badge.setButtonBadge(this.params.badgeCode, number);
		}
	};

	BXMobileApp.UI.Button.prototype.remove = function ()
	{
		app.removeButtons(this.params);
	};

	/**
	 * Menu class
	 * @param id
	 * @param {Object} params
	 * @config {array<{name:string, action:function, url:string}>} items - list of items
	 *
	 * @constructor
	 */

	BXMobileApp.UI.Menu = function (params, id)
	{
		this.items = params.items;
		this.type = BXMobileApp.UI.types.MENU;
		BXMobileApp.UI.Menu.superclass.constructor.apply(this, [id, params]);
		app.menuCreate({items: this.items});
	};
	BXMobileApp.TOOLS.extend(BXMobileApp.UI.Menu, BXMobileApp.UI.Element);

	BXMobileApp.UI.Menu.prototype.show = function ()
	{
		app.menuShow();
	};

	BXMobileApp.UI.Menu.prototype.hide = function ()
	{
		app.menuHide();
	};


	/**
	 * @since 14
	 * @param params - params object
	 * @config {string} [message] - text of notification
	 * @config {string} [groupId] - identifier of group ("common" by default)
	 * @config {string} [color] - background color (hex, alpha is supported)
	 * @config {string} [textColor] - color of text (hex, alpha is supported)
	 * @config {string} [loaderColor] - loader color (hex, alpha is supported)
	 * @config {string} [bottomBorderColor] - color of bottom border (hex, alpha is supported)
	 * @config {int} [indicatorHeight] - max height of indicator container (image or loader)
	 * @config {int} [maxLines] - max number of lines
	 * @config {boolean} [useLoader] - (false/true) loading indicator will be used
	 * @config {string} [imageURL] - link to the image file which will be used as indicator
	 * @config {string} [iconName] - name of image in application resources which will be used as indicator
	 * @config {string} [imageBorderRadius] - border radius of the indicator in %
	 * @config {string} [align] - alignment of content (indicator+text), "left"|"center"
	 * @config {boolean} [useCloseButton] - close button will be displayed at the right side of the notification
	 * @config {int} [autoHideTimeout] - auto close timeout (for example 2000 ms)
	 * @config {boolean} [hideOnTap] - the notification will be close if user tapped on it.
	 * @config {function} [onHideAfter] - the function which will be called after the notification has closed
	 * @config {function} [onTap] - the function which will when user has tapped on the notification
	 * @config {object} [extra] - custom data, it will be passed to the onTap and onHideAfter
	 * @config {boolean} [isGlobal] - global notification flag
	 * @param {string} id - identifier of the notification
	 * @constructor
	 *
	 */
	BXMobileApp.UI.NotificationBar = function (params, id)
	{
		this.params = BXMobileApp.TOOLS.merge(params, {});
		this.type = BXMobileApp.UI.types.NOTIFY_BAR;

		BXMobileApp.UI.NotificationBar.superclass.constructor.apply(this, [id, params]);
		var addParams = this.params;
		addParams["id"] = this.id;
		addParams["onCreate"] =  BX.proxy(function (params)
		{
			this.onCreate(params)
		}, this);
		app.exec("notificationBar",
			{
				action: "add",
				params: addParams

			});
	};
	BXMobileApp.TOOLS.extend(BXMobileApp.UI.NotificationBar, BXMobileApp.UI.Element);

	BXMobileApp.UI.NotificationBar.prototype.onCreate = function (json)
	{
		this.isCreated = true;
		if(this.isShown)
		{
			app.exec("notificationBar", {action:"show", params: this.params});
		}
	};

	BXMobileApp.UI.NotificationBar.prototype.show = function ()
	{
		if (this.isCreated)
		{
			app.exec("notificationBar", {action: "show", params: this.params});
		}

		this.isShown = true;
	};

	BXMobileApp.UI.NotificationBar.prototype.hide = function ()
	{
		if (this.isShown)
		{
			app.exec("notificationBar", {action: "hide", params: this.params});
		}

		this.isShown = false;
	};



	/**
	 * ActionSheet class
	 * @param params main parameters
	 * @config {string} title title of action sheet
	 * @config {object} buttons set of button
	 *
	 * @example
	 * <code>
	 * Format of button item:
	 * {
	 *      title: "Title"
	 *      callback:function(){
	 *          //do something
	 *      }
	 * }
	 * </code>
	 *
	 * @param id unique identifier

	 * @constructor
	 */
	BXMobileApp.UI.ActionSheet = function (params, id)
	{

		this.items = params.buttons;
		this.title = (params.title ? params.title : "");
		this.type = BXMobileApp.UI.types.ACTION_SHEET;
		BXMobileApp.UI.ActionSheet.superclass.constructor.apply(this, [id, params]);
		app.exec("createActionSheet", {
			"onCreate": BX.proxy(function (sheet)
			{
				this.onCreate(sheet);
			}, this),
			id: this.id,
			title: this.title,
			buttons: this.items
		});
	};

	BXMobileApp.TOOLS.extend(BXMobileApp.UI.ActionSheet, BXMobileApp.UI.Element);

	BXMobileApp.UI.ActionSheet.prototype.show = function ()
	{
		if (this.isCreated)
		{
			app.exec("showActionSheet", {"id": this.id});
		}
		this.isShown = true;
	};

	BXMobileApp.UI.ActionSheet.prototype.onCreate = function (json)
	{
		this.isCreated = true;
		if (this.isShown)
		{
			app.exec("showActionSheet", {"id": this.id});
		}
	};

	/**
	 * Table class
	 * @param id
	 * @param params
	 * @constructor
	 */
	BXMobileApp.UI.Table = function (params, id)
	{
		this.params = {
			table_id: id,
			url: params.url||"",
			isroot: false,

			TABLE_SETTINGS: {
				callback: function ()
				{
				},
				markmode: false,
				modal: false,
				multiple: false,
				okname: "OK",
				cancelname: "Cancel",
				showtitle: false,
				alphabet_index: false,
				selected: {},
				button: {}
			}
		};

		this.params.table_settings = this.params.TABLE_SETTINGS;

		this.params = BXMobileApp.TOOLS.merge(this.params, params);
		this.params.type = BXMobileApp.UI.types.TABLE;
		BXMobileApp.UI.Table.superclass.constructor.apply(this, [id, params]);
	};

	BXMobileApp.TOOLS.extend(BXMobileApp.UI.Table, BXMobileApp.UI.Element);

	BXMobileApp.UI.Table.prototype.show = function ()
	{
		app.openBXTable(this.params);
	};

	BXMobileApp.UI.Table.prototype.useCache = function (cacheEnable)
	{
		this.params.TABLE_SETTINGS.cache = cacheEnable || false;
	};

	BXMobileApp.UI.Table.prototype.useAlphabet = function (useAlphabet)
	{
		this.params.TABLE_SETTINGS.alphabet_index = useAlphabet || false;
	};

	BXMobileApp.UI.Table.prototype.setModal = function (modal)
	{
		this.params.TABLE_SETTINGS.modal = modal || false;
	};

	BXMobileApp.UI.Table.prototype.clearCache = function ()
	{
		return app.exec("removeTableCache", {"table_id": this.id});
	};


	/**
	 * @type {{isVisible: BXMobileApp.UI.Page.isVisible, reload: BXMobileApp.UI.Page.reload, reloadUnique: BXMobileApp.UI.Page.reloadUnique, close: BXMobileApp.UI.Page.close, captureKeyboardEvents: BXMobileApp.UI.Page.captureKeyboardEvents, setId: BXMobileApp.UI.Page.setId, getTitle: BXMobileApp.UI.Page.getTitle, params: {set: BXMobileApp.UI.Page.params.set, get: BXMobileApp.UI.Page.params.get}, TopBar: {show: BXMobileApp.UI.Page.TopBar.show, hide: BXMobileApp.UI.Page.TopBar.hide, setColors: BXMobileApp.UI.Page.TopBar.setColors, updateButtons: BXMobileApp.UI.Page.TopBar.updateButtons, title: {params: {imageUrl: string, text: string, detailText: string, callback: string}, timeout: number, isAboutToShow: boolean, show: BXMobileApp.UI.Page.TopBar.title.show, hide: BXMobileApp.UI.Page.TopBar.title.hide, setImage: BXMobileApp.UI.Page.TopBar.title.setImage, setText: BXMobileApp.UI.Page.TopBar.title.setText, setDetailText: BXMobileApp.UI.Page.TopBar.title.setDetailText, setCallback: BXMobileApp.UI.Page.TopBar.title.setCallback, redraw: BXMobileApp.UI.Page.TopBar.title.redraw, _applyParams: BXMobileApp.UI.Page.TopBar.title._applyParams}}, SlidingPanel: {buttons: {}, hide: BXMobileApp.UI.Page.SlidingPanel.hide, show: BXMobileApp.UI.Page.SlidingPanel.show, addButton: BXMobileApp.UI.Page.SlidingPanel.addButton, removeButton: BXMobileApp.UI.Page.SlidingPanel.removeButton}, Refresh: {params: {enable: boolean, callback: boolean, pulltext: string, downtext: string, loadtext: string, timeout: string}, setParams: BXMobileApp.UI.Page.Refresh.setParams, setEnabled: BXMobileApp.UI.Page.Refresh.setEnabled, start: BXMobileApp.UI.Page.Refresh.start, stop: BXMobileApp.UI.Page.Refresh.stop}, BottomBar: {buttons: {}, show: BXMobileApp.UI.Page.BottomBar.show, hide: BXMobileApp.UI.Page.BottomBar.hide, addButton: BXMobileApp.UI.Page.BottomBar.addButton}, PopupLoader: {show: BXMobileApp.UI.Page.PopupLoader.show, hide: BXMobileApp.UI.Page.PopupLoader.hide}, LoadingScreen: {show: BXMobileApp.UI.Page.LoadingScreen.show, hide: BXMobileApp.UI.Page.LoadingScreen.hide, setEnabled: BXMobileApp.UI.Page.LoadingScreen.setEnabled}, TextPanel: {defaultParams: {placeholder: string, button_name: string, mentionDataSource: {}, action: BXMobileApp.UI.Page.TextPanel.defaultParams.action, smileButton: {}, plusAction: string, callback: string, useImageButton: boolean}, params: {}, isAboutToShow: boolean, temporaryParams: {}, timeout: number, setParams: BXMobileApp.UI.Page.TextPanel.setParams, show: BXMobileApp.UI.Page.TextPanel.show, hide: BXMobileApp.UI.Page.TextPanel.hide, focus: BXMobileApp.UI.Page.TextPanel.focus, clear: BXMobileApp.UI.Page.TextPanel.clear, setUseImageButton: BXMobileApp.UI.Page.TextPanel.setUseImageButton, setAction: BXMobileApp.UI.Page.TextPanel.setAction, setText: BXMobileApp.UI.Page.TextPanel.setText, showLoading: BXMobileApp.UI.Page.TextPanel.showLoading, getParams: BXMobileApp.UI.Page.TextPanel.getParams, redraw: BXMobileApp.UI.Page.TextPanel.redraw, _applyParams: BXMobileApp.UI.Page.TextPanel._applyParams}, Scroll: {setEnabled: BXMobileApp.UI.Page.Scroll.setEnabled}}}
	 */
	BXMobileApp.UI.Page =
	{
		isVisible: function (params)
		{
			app.exec("checkOpenStatus", params);
		},
		reload: function ()
		{
			app.reload();
		},
		reloadUnique: function()
		{
			BXMobileApp.UI.Page.params.get({callback:function(data){

				BX.localStorage.set('mobileReloadPageData', {url: location.pathname+location.search, data: data});
				app.reload();
			}});
		},
		close: function (params)
		{
			app.closeController(params)
		},
		captureKeyboardEvents: function (enable)
		{
			app.enableCaptureKeyboard(!((typeof enable == "boolean" && enable === false)))
		},
		setId:function(id)
		{
			app.setPageID(id);
		},
		/**
		 *
		 * @returns {BXMPage.TopBar.title|{params, timeout, isAboutToShow, show, hide, setImage, setText, setDetailText, setCallback, redraw, _applyParams}}
		 */
		getTitle:function(){
			return this.TopBar.title;
		},
		params: {
			set: function (params)
			{
				app.changeCurPageParams(params);
			},
			get: function (params)
			{
				var data = BX.localStorage.get('mobileReloadPageData');
				if (data && data.url == location.pathname+location.search && params.callback)
				{
					BX.localStorage.remove('mobileReloadPageData');
					params.callback(data.data);
				}
				else
				{
					app.getPageParams(params);
				}
			}
		},
		TopBar: {
			show: function ()
			{
				app.visibleNavigationBar(true);
			},
			hide: function ()
			{
				app.visibleNavigationBar(false);
			},
			/**
			 * @since 14
			 * @param colors colors for the elements of top bar
			 * @config {string} [background] color of top bar
			 * @config {string} [titleText] color of title text
			 * @config {string} [titleDetailText] color of subtitle text
			 */
			setColors:function(colors){
				app.exec("setTopBarColors", colors);
			},
			/**
			 * Updates buttons
			 * @since 14
			 * @param {object} buttons
			 */
			updateButtons: function (buttons)
			{
				this.buttons = buttons;
				app.addButtons(buttons);
			},
			title: {
				params: {
					imageUrl: "",
					text: "",
					detailText: "",
					callback: ""
				},
				timeout:0,
				isAboutToShow:false,
				show: function ()
				{
					this.isAboutToShow = (this.timeout > 0);

					if(!this.isAboutToShow)
						app.titleAction("show");
				},
				hide: function ()
				{
					app.titleAction("hide")
				},
				setImage: function (imageUrl)
				{
					this.params.imageUrl = imageUrl;
					this.redraw();
				},
				setText: function (text)
				{
					this.params.text = text;
					this.redraw();
				},
				setDetailText: function (text)
				{
					this.params.detailText = text;
					this.redraw();
				},
				setCallback: function (callback)
				{
					this.params.callback = callback;
					this.redraw();
				},
				redraw:function()
				{
					if(this.timeout > 0)
						clearTimeout(this.timeout);

					this.timeout = setTimeout(BX.proxy(this._applyParams, this), 10);
				},
				_applyParams:function()
				{
					app.titleAction("setParams", this.params);
					this.timeout = 0;

					if(this.isAboutToShow)
						this.show()
				}
			}
		},
		SlidingPanel: {
			buttons: {},
			hide: function ()
			{
				app.hideButtonPanel();
			},
			/**
			 * Shows additional panel under navigation bar.
			 * @param params - params object
			 * @config {object} buttons - object of buttons
			 * @config {boolean} hidden_buttons_panel - (true/false) use this to control on visibility of panel while scrolling
			 */
			show: function (params)
			{
				app.showSlidingPanel(params);
			},
			addButton: function (buttonObject)
			{
				//TODO
			},
			removeButton: function (buttonId)
			{
				//TODO
			}
		},
		Refresh: {
			//on|off pull down action on the current page
			//params.pulltext, params.downtext, params.loadtext
			//params.callback - action on pull-down-refresh
			//params.enable - true|false
			params: {
				enable: false,
				callback: false,
				pulltext: "Pull to refresh",
				downtext: "Release to refresh",
				loadtext: "Loading...",
				timeout: "60"
			},
			setParams: function (params)
			{
				this.params.pulltext = (params.pullText ? params.pullText : this.params.pulltext);
				this.params.downtext = (params.releaseText ? params.releaseText : this.params.downtext);
				this.params.loadtext = (params.loadText ? params.loadText : this.params.loadtext);
				this.params.callback = (params.callback ? params.callback : this.params.callback);
				this.params.enable = (typeof params.enabled == "boolean" ? params.enabled : this.params.enable);
				this.params.timeout = (params.timeout ? params.timeout : this.params.timeout);
				app.pullDown(this.params);
			},
			setEnabled: function (enabled)
			{
				this.params.enable = (typeof enabled == "boolean" ? enabled : this.params.enable);
				app.pullDown(this.params);
			},
			start: function ()
			{
				app.exec("pullDownLoadingStart");
			},
			stop: function ()
			{
				app.exec("pullDownLoadingStop");
			}

		},
		BottomBar: {
			buttons: {},
			show: function ()
			{
				//TODO
			},
			hide: function ()
			{
				//TODO
			},
			addButton: function (buttonObject)
			{
				//TODO
			}
		},
		PopupLoader:{
			show:function(text){
				app.exec("showPopupLoader", {text: text})
			},
			hide:function(){
				app.exec("hidePopupLoader");
			}
		},
		LoadingScreen: {
			show: function ()
			{
				app.showLoadingScreen();
			},
			hide: function ()
			{
				app.hideLoadingScreen();
			},
			setEnabled: function (enabled)
			{
				app.enableLoadingScreen(!((typeof enabled == "boolean" && enabled === false)))
			}
		},
		TextPanel: {
			defaultParams : {
				placeholder: "Text here...",
				button_name: "Send",
                mentionDataSource: {},
				action: function (){},
                smileButton:{},
				plusAction: "",
				callback:"-1",
				useImageButton: true
			},
			params:{},
			isAboutToShow: false,
			temporaryParams: {},
            timeout:0,
			setParams: function (params)
			{
				this.params = BXMobileApp.TOOLS.merge(this.defaultParams, params);
				if (this.isAboutToShow)
				{
                    this.redraw();
				}
			},
			show: function (params)
			{
				if (typeof params == "object")
				{
					this.setParams(params);
				}

				var showParams = this.getParams();
				if (!this.isAboutToShow)
				{
					for (var key in this.temporaryParams)
					{
						showParams[key] = this.temporaryParams[key];
					}

					this.temporaryParams = {};
				}

				if (BXMobileApp.apiVersion >= 10)
				{
					app.textPanelAction("show", showParams);
				}
				else
				{
					delete showParams['text'];
					app.showInput(showParams);
				}

				this.isAboutToShow = true;
			},
			hide: function ()
			{
				if (BXMobileApp.apiVersion >= 10)
					app.textPanelAction("hide");
				else
					app.hideInput();
			},
			focus: function ()
			{
				if (BXMobileApp.apiVersion >= 10)
					app.textPanelAction("focus", this.getParams());
			},
			clear: function ()
			{
				if (BXMobileApp.apiVersion >= 10)
					app.textPanelAction("clear", this.getParams());
				else
					app.clearInput();

			},
			setUseImageButton: function (use)
			{
				this.params.useImageButton = !((typeof use == "boolean" && use === false));
                this.redraw();
			},
			setAction: function (callback)
			{
				this.params.action = callback;
                this.redraw();
			},
			setText: function (text)
			{
				if (!this.isAboutToShow)
				{
					this.temporaryParams["text"] = text;
				}
				else
				{

                    var params = app.clone(this.params, true);
                    params.text = text;
					app.textPanelAction("setParams", params);
				}


			},
			showLoading: function (shown)
			{
				app.showInputLoading(shown);
			},
			getParams: function ()
			{
				var params = {};
				for (var key in this.params)
				{
					params[key] = this.params[key]
				}

				return params;
			},
            redraw:function()
            {
                if(this.timeout > 0)
                    clearTimeout(this.timeout);

                this.timeout = setTimeout(BX.proxy(this._applyParams, this), 100);
            },
            _applyParams:function()
            {
                app.textPanelAction("setParams", this.params);
                this.timeout = 0;

                if(this.isAboutToShow)
                    this.show()
            }

		},
		Scroll: {
			setEnabled: function (enabled)
			{
				app.enableScroll(enabled);
			}
		}

	};

	 //Short aliases

	/**
	 *
	 * @type {*|{topBar: {show: Function, hide: Function, buttons: {}, addRightButton: Function, addLeftButton: Function, title: {show: Function, hide: Function, setImage: Function, setText: Function, setDetailText: Function}}, slidingPanel: {buttons: {}, hide: {}, show: {}, addButton: Function, removeButton: Function}, refresh: {params: {enable: boolean, callback: boolean, pulltext: string, downtext: string, loadtext: string}, setParams: Function, setEnabled: Function, start: Function, stop: Function}, bottomBar: {show: Function, hide: Function, buttons: {}, addButton: Function}, menus: {items: {}, create: Function, get: Function, update: Function}}}
	 */
	window.BXMPage = BXMobileApp.UI.Page;
	/**
	 * @type {Window.BXMobileApp.UI.Slider|{state, setState, setStateEnabled}}
	 */
	window.BXMSlider = BXMobileApp.UI.Slider;
	/**
	 * @type {Window.BXMobileApp.UI|{IOS, Slider, Photo, Document, DatePicker, SelectPicker, BarCodeScanner, NotifyPanel, Badge, types, parentTypes}}
	 */
	window.BXMUI = BXMobileApp.UI;
	/**
	 * @type {Window.BXMobileApp.PageManager|{loadPageBlank, loadPageUnique, loadPageStart, loadPageModal}}
	 */
	window.BXMPager = BXMobileApp.PageManager;

})();




