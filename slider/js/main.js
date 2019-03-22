var _width = $(window).outerWidth();
var _height = $(window).outerHeight() - 100;

var $main = $('#slider');
var _attr = 'data-trans3d';
var _all_3dtrans = 'tr1';
var mainSlider;
var timer;

var total_slides;			// total number of slides advertised
var slide_counter = 0;		// main slide counter
var duration = 8000;		// duration of advert

var adverts = new Array();	// Store adverts' order



function setTransition() {
	var a = 2;
	
	while (a < 61) {
		_all_3dtrans += ' tr' + a;
		a++;
	}

	// add transitions
	$('#slider').find('ul li').each(function () {
		$(this).attr(_attr, _all_3dtrans);
	});
}


function setSize() {
	var scr_width = _width * 0.75;
	var scr_height = _height * 0.9;

	$main.attr({ 'data-width':scr_width + 'px', 'data-height':scr_height + 'px' });
	console.log('set size: ' + scr_width + 'px, ' + scr_height + 'px');
	//id="slider" class="cute-slider" data-width="1420" data-height="950"
}



function refreshThumbs() {
	$('.br-list-thumb').eq(0).insertAfter($('.br-list-thumb').last());
}



function setCounter() {
	if (slide_counter == total_slides) {
		slide_counter = 1;
	} 
	else {
		slide_counter++;
	}

	for (var i = 0; i < adverts.length; i++) {
		if (adverts[i] == slide_counter) {
			pauseSlider();
			showAdvert(adverts[i]);
		}
	}
}

function setSliderEvents() {
		
	// when change starts event
	this.changeStart = function(event){
	    setCounter();
	    hideSlideBanner(slide_counter);

	    clearTimeout(timer);
		timer = setTimeout(function () {
	    	$('.br-thumblist, .br-infocontent').addClass('change');
	    }, 1000);
	}

	// when change ends event
	this.changeEnd = function(event){
		refreshThumbs();
		showSlideBanner(slide_counter);

		var change_ended;
		clearTimeout(change_ended);
		change_ended = setTimeout(function () {
			$('.br-thumblist, .br-infocontent').removeClass('change');
		}, 300)
	}
	
}


function runSlider(slider, wrapper) {
	var slider = new Cute.Slider();
	slider.setup("slider" , "wrapper");		
	mainSlider = slider;	
	//slider.pause();
	$('.br-infocontent').insertBefore('#wrapper');
	$('.br-thumblist').insertBefore('#wrapper');
	slider.api.addEventListener(Cute.SliderEvent.CHANGE_START , this.changeStart , this);
	slider.api.addEventListener(Cute.SliderEvent.CHANGE_END , this.changeEnd , this);

	initAdverts();
}



function showAdvert(el) {
	$('.advert[data-order="' + el + '"]').fadeIn(500).delay(duration).fadeOut(500);
}


function pauseSlider() {
	mainSlider.pause();

	var pause_slider;
	clearTimeout(pause_slider);
	pause_slider = setTimeout(function () {
		mainSlider.play();
	}, duration);
	
}


function initAdverts() {
	if ($('.advert').length) {
		$('.advert').each(function () {
			var dataOrder = $(this).attr('data-order');
			adverts.push(dataOrder);
		});
	}
	else {
		console.error("It seems there are no adverts defined");
	}
}




////////// Slide banner
function hideSlideBanner(el) {
	var i = el - 1;
	$('#slide-banner').find('li').eq(i).removeClass('active');
	console.log('1hide' + i);
}


function showSlideBanner(el) {
	var i = el;
	var $slide = $('#slide-banner').find('li').eq(i);

	if ($slide.find('span').html() == '') {
		$slide.css('display', 'none');
	}
	else {
		$slide.addClass('active');
	}
	
	console.log('1show' + i);
}



$(document).ready(function () {

	total_slides = $('.slide-item').length;
	// setTransition();

	$('#start').on('click', function () {
		$(this).parent().addClass('hide');
		$('#box').removeClass('hide');

		//setSize();
		setSliderEvents();
		runSlider('slider', 'wrapper');		
	});

});



