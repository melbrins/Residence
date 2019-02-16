var page = '<?php echo $page; ?>'; 
$(document).ready(function(){
		$('.page').css({'display' : 'none'});
		$('#page_' + page).fadeIn(1);
		$('#page_' + page).animate({left: '196', opacity:'1'},200);
		$('.menu').removeClass('active');
		$('#'+ page).addClass('active');
		
});
var widthgallery = $(window).width()-260;
var heightgallery = $(window).height()-80;
$('#navigation').css({'height' : heightgallery});
$('#page_pictures').css({'width' : widthgallery, 'height' : heightgallery});
$('.page').css({'width' : widthgallery, 'height' : heightgallery});

$(window).resize(function () {
	widthgallery = $(window).width()-260;
	heightgallery = $(window).height()-80;
	$('#page_pictures').css({'width' : widthgallery, 'height' : heightgallery});
	$('#navigation').css({'height' : heightgallery});
	$('.page').css({'width' : widthgallery, 'height' : heightgallery});		
});

$('.menu').click(function() {
	$('.menu').removeClass('active');
	$(this).addClass('active');
	$('#page_' + page).animate({left: '186', opacity:'0'},200);
	$('#page_' + page).fadeOut(1);
	$('#msg').fadeOut(200);	
	page = $(this).attr('id');
	$('#page_' + page).delay(200).fadeIn(1);
	$('#page_' + page).animate({left: '196', opacity:'1'},200);		
});
var arrow = true;
$('.list_services').click(function(){
	if( arrow == true){
		$('.second').animate({height: '0', opacity: '0'},200);
		$('.arrow-right').addClass("close");
		$('.second').fadeOut(1);
		arrow = false;
	}else{
		$('.second').animate({height: '150', opacity: '1'},200);
		$('.arrow-right').removeClass("close");
		$('.second').delay(200).fadeIn(1);
		arrow=true;
	}
});
$('.new_article').click(function(){
	$('#page_nutrition').animate({left: '186', opacity:'0'},200);
	$('#page_' + page).fadeOut(1);
	page= 'new_article';
	$('#page_new_article').delay(200).fadeIn(1);
	$('#page_new_article').animate({left : '196', opacity: '1'}, 200);
});
function show_nutrition(ID){
	$('#page_nutrition').animate({left: '186', opacity: '0'},200);
	$('#page_nutrition').fadeOut(1);
	page = 'art_nutrition_'+ ID;
	$('#page_art_nutrition_'+ ID).delay(200).fadeIn(1);
	$('#page_art_nutrition_'+ID).animate({left: '196', opacity: '1'},200);
}