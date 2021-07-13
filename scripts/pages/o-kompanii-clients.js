$(document).ready(function(){
	$('.country_name').click(function() {
        // console.log('change size');
        // let sizeCount = Math.round((600 + $('#country').height())/230);
        let height = Math.round((600 + $('#country').height())/230) * 240;
		$('.lSSlideWrapper').css('height', height);
	});

});