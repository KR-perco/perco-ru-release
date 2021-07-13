//Переменные Меню
var li;
var selectItemNumber; //Выделенный пункт
function printdoc ()
{
	window.print();
}
function varMenu ()
{
	li = $('#leftMenu ul li');
	li.each(function(i) {
		if ($(this).hasClass('selected')) {
			selectItemNumber = i;
		}
	});
}
//-------------------------------------
$(document).ready(function(){
	if ($('#photobox'))
		$('#photobox a').removeAttr("rel");
	$("a[rel^='prettyPhoto']").prettyPhoto({
		allow_resize: false,
		default_width: 250,
		overlay_gallery: false,
		opacity: 0.60,
		slideshow: false,
		show_title: false,
		deeplinking: false,
		social_tools: false,
		theme:'facebook',
		iframe_markup:'<iframe src="{path}?iframe=true&width={width}&height={height}" width="{width}" height="{height}" frameborder="no"></iframe>'
	});
	$('#Gallery').photobox('a',{ time:0, thumbs:false, loop:false });
	$('#scrollGallery').photobox('a',{ time:0, thumbs:false, loop:false });
	$('#photobox').photobox('a',{ time:0, thumbs:false, loop:false });
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
	if($("#menu #leftMenu").hasClass("startScript"))
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
//-----новсти---//
	$("#shownewslink").click(function () {
		$("#shownews").fadeIn(1000);
		$("#shownewslink").fadeOut(100);
	});
});
window.onload = function ()
{
	//Adobe Edge Runtime
	if ($(".EDGE-13406137").length>0)
	{
		AdobeEdge.loadComposition('/scripts/banners/inter-catalog', 'EDGE-13406137', {
			scaleToFit: "none",
			centerStage: "none",
			minW: "0",
			maxW: "undefined",
			width: "351px",
			height: "255px"
		}, {"dom":{}}, {"dom":{}});
	}
	if ($(".EDGE-16757158").length>0)
	{
		AdobeEdge.loadComposition('/scripts/banners/inter-catalog-system', 'EDGE-16757158', {
			scaleToFit: "none",
			centerStage: "none",
			minW: "0",
			maxW: "undefined",
			width: "351px",
			height: "255px"
		}, {"dom":{}}, {"dom":{}});
	}
	//Adobe Edge Runtime End
}
function warning_schet()
{
	var check = confirm("Внимание! Для компаний, в штате которых есть хотя бы один сотрудник, прошедший  очное обучение в учебном центре PERCo, сертификация проводится бесплатно. Для подтверждения бесплатной сертификации добавте такого сотрудника в профиле компании и укажите дату прохождения им очного обучения.");
	if (check)
	{
		window.open("/client/company/list/schet.php","_blank");
	}
	else
		return false;
}