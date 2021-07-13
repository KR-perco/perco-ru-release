/**
 * Замена стандартного alert
 *
 */
var oldAlert = window.alert;

window.alert = function ( message, color, gname ) {

	var header = (typeof(color) == 'undefined')? 'Уведомление':'Внимание!';
	color = (typeof(color) == 'undefined')? 'alert-blue':'alert-red';
	while ( message.indexOf('\n')!=-1 ) message = message.replace('\n', '<br/>');
	// если уже показано - то убираем
	if ( $('div.alert-wrapper').length ) $('div.alert-wrapper').remove();
	$('<div class="alert-wrapper"><div class="alert-shadow"></div><div class="alert-box"></div></div>').appendTo('body');
	var wrapper = $('div.alert-wrapper');
	var shadow = $('div.alert-shadow').hide();
	var box = $('div.alert-box').hide();
		// внутренности окошка
	var inner = '<div class="alert-box-header ' + color + '">' + header + '</div><div class="alert-box-container">' + message + '<br /><div class="alert-box-input"><input type="button" value="OK" /></div></div>';
		shadow.css({opacity: 0.1}).fadeIn(300);
		box.html(inner).fadeIn(300);
		box.css({
			marginLeft: (-1 * (box.width()/2)) + 'px',
			marginTop: (-1 * ( (box.height()/2) + 30 )) + 'px'
		});
	var closer = function (){
		shadow.fadeOut(300);
		box.fadeOut(300, function(){
			wrapper.remove();
		});
		setTimeout(window.location.assign(gname), 300);
	 }
				$(document).one('keydown', function(e) {
					if(e.which==27) {closer(); closea=true;}
				});
	box.find('input[type="button"]').click(closer);
	shadow.click(closer);
	// ставим таймаут на исчезновение окошка
	//setTimeout(closer, 7000);
}