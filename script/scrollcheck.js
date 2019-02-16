// Scroll up and down elements
function goToScroll(id){
	$('html, body').animate({scrollTop: $('#'+id).offset().top}, 500);
}


$(document).ready(function() {
	
	// Smooth scroll to anchor points
	$(".main_nav").click(function(event){
		//prevent the default action for the click event
		event.preventDefault();

		//get the full url - like mysitecom/index.htm#home
		var full_url = this.href;

		//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
		var parts = full_url.split("#");
		var trgt = parts[1];

		//get the top offset of the target anchor
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top - 145;

		//goto that anchor by setting the body scroll top to anchor top
		$('html, body').animate({scrollTop:target_top}, 500);
	});
	// Smooth scroll to anchor points
	$(".ser_nav").click(function(event){
		//prevent the default action for the click event
		event.preventDefault();

		//get the full url - like mysitecom/index.htm#home
		var full_url = this.href;

		//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
		var parts = full_url.split("#");
		var trgt = parts[1];

		//get the top offset of the target anchor
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top - 145;

		//goto that anchor by setting the body scroll top to anchor top
		$('html, body').animate({scrollTop:target_top}, 500);
	});
	
	$(".gallery_btn").click(function(event){
		//prevent the default action for the click event
		event.preventDefault();

		//get the full url - like mysitecom/index.htm#home
		var full_url = this.href;

		//split the url by # and get the anchor target name - home in mysitecom/index.htm#home
		var parts = full_url.split("#");
		var trgt = parts[1];

		//get the top offset of the target anchor
		var target_offset = $("#"+trgt).offset();
		var target_top = target_offset.top - 145;

		//goto that anchor by setting the body scroll top to anchor top
		$('html, body').animate({scrollTop:target_top}, 500);
	});

	// Test to see window position and highlight the appropriate navigation element
	$(window).scroll(function scrollCheck() {
			var top = 0;
			top = $(window).scrollTop();
			if(top < 300) {
				$("#btn_home").addClass("active");
				$("#btn_welcome").removeClass("active");
				$("#btn_services").removeClass("active");
				$("#btn_gallery").removeClass("active");
			}
			if ((top >= 300) && (top < 800)) {
				$("#btn_home").removeClass("active");
				$("#btn_welcome").addClass("active");
				$("#btn_services").removeClass("active");
				$("#btn_gallery").removeClass("active");
			}
			if ((top >= 800) && (top < 1300)) {
				$("#btn_home").removeClass("active");
				$("#btn_welcome").removeClass("active");
				$("#btn_services").addClass("active");
				$("#btn_gallery").removeClass("active");
			}
			if(top >= 1300) {
				$("#btn_home").removeClass("active");
				$("#btn_welcome").removeClass("active");
				$("#btn_services").removeClass("active");
				$("#btn_gallery").addClass("active");
			}
			
		});
	
});