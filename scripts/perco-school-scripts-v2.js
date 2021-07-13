//Переменные Меню
var li;
var selectItemNumber; //Выделенный пункт

function printdoc ()
{
	window.print();
}
//-------------------------------------
function varMenu ()
{
	li = $('#leftMenu ul li');
	li.each(function(i) {
		if ($(this).hasClass('selected')) {
			selectItemNumber = i;
		}
	});
}
function setclass(a)
{
	document.getElementById('wheretobuy').className = a;
}
window.onload = function ()
{
	var aw = new Array
	aw = document.getElementsByTagName("area")
	var i = 0
	while(aw[i])
	{
		var myid = aw[i].id
		aw[i].onmouseover = function(){ setclass(this.id);}
		aw[i].onmouseout = function(){setclass(mapclass);}
		i+=1
	}
}
$(document).ready(function(){
	$("a[rel^='prettyPhoto']").prettyPhoto({
		allow_resize: false,
		overlay_gallery: false,
		opacity: 0.60,
		slideshow: false,
		show_title: false,
		deeplinking: false,
		social_tools: false,
		theme:'facebook',
		iframe_markup:'<iframe src ="{path}?iframe=true&width={width}&height={height}" width="{width}" height="{height}" frameborder="no"></iframe>'
	});
	$('#Gallery').photobox('a',{ time:0, thumbs:false, loop:false });
	$('#scrollGallery').photobox('a',{ time:0, thumbs:false, loop:false });
	$("#vertCar").als({
		visible_items: 3,
		scrolling_items: 3,
		orientation: "horizontal",
		circular: "yes",
		autoscroll: "no"
	});
	$('#vertCar').photobox('a',{ time:0, thumbs:false, loop:false });
	$(".ls").each(function(i){
		$(this).hover(
			function(){
			$(this).parent().find('.strelkaleft').addClass('selectstrekla');
			},
			function(){
			   $(this).parent().find('.strelkaleft').removeClass('selectstrekla');
			}
		);
	});
	$(".rs").each(function(i){
		$(this).hover(
			function(){
			  $(this).parent().find('.strelkaright').addClass('selectstrekla');
			},
			function(){
			  $(this).parent().find('.strelkaright').removeClass('selectstrekla');
			}
		);
	});
//--------------------LeftMenu-----------------------//
	if($("#left #leftMenu").hasClass("startScript"))
	{
		$("ul#ifoimg li").removeClass("nodisplay");
		$('ul#ifoimg').cycle({
			fx: 'fade',
			speed:  3000,
			timeout: 10000,
			startingSlide: selectItemNumber,
			wrap: 'circular'
		});
	}
});