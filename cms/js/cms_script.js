	var widthgallery = $(window).width()-228;
	var heightgallery = $(window).height()-83;
	$('#navigation').css({'height' : heightgallery});
	$('#page_pictures').css({'width' : widthgallery, 'height' : heightgallery});
	$('.page').css({'width' : widthgallery, 'height' : heightgallery});
 
    $(window).resize(function () {
		widthgallery = $(window).width()-228;
		heightgallery = $(window).height()-100;
		$('#page_pictures').css({'width' : widthgallery, 'height' : heightgallery});
		$('#navigation').css({'height' : heightgallery});
		$('.page').css({'width' : widthgallery, 'height' : heightgallery});		
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
	function show_nutrition(REF){
		$('#page_' + page).animate({left: '186', opacity: '0'},200);
		$('#page_' + page).fadeOut(1);
		$('#page_edit_' + page + '_' + REF).delay(200).fadeIn(1);
		$('#page_edit_' + page + '_' + REF).animate({left: '186', opacity: '1'},200);
		page = 'edit_' + page + '_' + REF;
	}