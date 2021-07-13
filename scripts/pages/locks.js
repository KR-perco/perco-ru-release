$(function(){
	$(".imgpodpis svg use").each(function(indx, element){
		id_text = $(this).attr("xlink:href")+"_"+LANGUAGE_ID;
		$(this).attr("xlink:href", id_text);
	});
});