var	html = jQuery('html'),
	woto_slider = jQuery('.woto_slider'),
	woto_sliderAll = jQuery('.woto_gallery_all_wrapper'),
	woto_title_wrapper = jQuery('.woto_title_wrapper'),
	woto_title = jQuery('.woto_title'),
	woto_descr = jQuery('.woto_descr'),
	woto_btn_prev = jQuery('.woto_slider_prev'),
	woto_btn_next = jQuery('.woto_slider_next'),
	woto_controls = jQuery('.woto_controls'),
	max_slide = woto_slider.find('.woto_slide').length,
	woto_overlay = jQuery('.woto_overlay'),
	woto_thmb_viewport = jQuery('.woto_thmb_viewport'),
	woto_thumbs = jQuery('.woto_thumbs'),
	myWindow = jQuery(window);

html.addClass('woto_gallery_page');

if (woto_sliderAll.length > 0) {
	jQuery(document.documentElement).keyup(function (event) {
		if ((event.keyCode == 37)) {
			woto_prevSlide();
		} else if ((event.keyCode == 39)) {
			woto_nextSlide();
		}
	});
}
if (woto_slider.hasClass('controls_off')) {
	html.addClass('hide_woto_controls');
}
var woto_interval = setInterval('woto_nextSlide()', woto_slider.attr('data-interval'));
clearInterval(woto_interval);
jQuery('.woto_play_pause').removeClass('woto_state_play');

jQuery(document).ready(function ($) {
	if (woto_sliderAll.length){
		woto_thumbnails_add_fn();
		woto_thumb_slide = jQuery('.thmb_slide');
		if (woto_sliderAll.length > 0) {

			jQuery('.woto_slider_prev, .woto_controls .prev').on('click', function () {
				woto_prevSlide();
				return false;
			});
			jQuery('.woto_slider_next, .woto_controls .next').on('click', function () {
				woto_nextSlide();
				return false;
			});
			jQuery('.woto_control_opener').on('click', function () {
				jQuery('.woto_control_opener, .woto_controls .hidden_control').toggleClass('opened');
				return false;
			});
			jQuery('.woto_play_pause').on('click', function(){
				if (jQuery(this).hasClass('woto_state_play')) {
					clearInterval(woto_interval);
				} else {
					if (!jQuery('.woto_play_pause').hasClass('paused_by_video')) {
						woto_interval = setInterval('woto_nextSlide()', woto_slider.attr('data-interval'));
					}
				}
				jQuery('.woto_play_pause').toggleClass('woto_state_play');
				return false;
			});

			//Touch Events
			if (woto_overlay.length > 0) {
				var touch_container = woto_overlay;
			} else {
				var touch_container = woto_slider;
			}
			touch_container.on('touchstart', function(event) {
				clearInterval(woto_interval);
				touch = event.originalEvent.touches[0];
				startAt = touch.pageX;
				html.addClass('touched');
			});		

			touch_container.on('touchmove', function(event) {			
				touch = event.originalEvent.touches[0];
				movePath = -1* (startAt - touch.pageX)/2;
				movePercent = (movePath*100)/myWindow.width();
			});
			touch_container.on('touchend', function(event) {
				html.removeClass('touched');
				touch = event.originalEvent.changedTouches[0];
				test_path = startAt - touch.pageX;
				console.log(test_path);
				if (test_path > 100 ) {
					woto_nextSlide();
				}
				if (test_path < -100 ) {
					woto_prevSlide();
				}
			});			
			set_step = 0;

			if (jQuery('.woto_thumbs').length > 0) {
				woto_thumbs_setup();
			}
			woto_thumb_slide = jQuery('.thmb_slide');
			woto_thumb_slide.on('click', function(){
				var setThmb = jQuery(this).attr('data-count');
				setSlide(setThmb);
			});


			set_step = 0;
			max_right = myWindow.width() - woto_thumbs.width();
			
			
			jQuery(window).load(function(){
				if ((myWindow.width() > 1024) && (woto_thumbs.width() > myWindow.width())) {
					woto_thumbs.on('mouseenter',function(e){
						woto_thumbs.addClass('hovered');
						woto_title_wrapper.addClass('hovered');
						move_thumbs = setInterval(function () {
							curstep = parseInt(woto_thumbs.css('left'));
							setstep = curstep + set_step;
							max_right = myWindow.width() - woto_thumbs.width();

							if (setstep > 0) {
								setstep = 0;
							} else if (setstep < max_right) {
								setstep = max_right;
							}

							woto_thumbs.css('left', setstep+'px');
						}, 100);

					});
					woto_thumbs.on('mousemove',function(e){
						cursorX = e.clientX;
						left_zone = myWindow.width()/3;
						right_zone = myWindow.width() - left_zone;

						if (cursorX < left_zone) {
							cur_pos = left_zone - cursorX;
							set_step = Math.floor(cur_pos/15);
						} else if (cursorX > right_zone) {
							cur_pos = cursorX - right_zone;
							curent_step = parseInt(woto_thumbs.css('left'));
							set_step = -1*Math.floor(cur_pos/15);
						} else {
							set_step = 0;
						}

					});
					woto_thumbs.on('mouseleave', function () {
						woto_thumbs.removeClass('hovered');
						woto_title_wrapper.removeClass('hovered');
						slideNum = jQuery('.current-thmb').attr('data-count');

						thmbs_on_screen = Math.ceil(myWindow.width()/woto_thumb_slide.width()/2);
						set_thmb_left = -1 * woto_thumb_slide.width() * (slideNum-thmbs_on_screen);
						max_right = myWindow.width() - woto_thumbs.width();

						if (slideNum > thmbs_on_screen);
						if (set_thmb_left < max_right) {
							set_thmb_left = max_right;
						}
						if (set_thmb_left > 0) {
							set_thmb_left = 0;
						}
						if (!woto_thumbs.hasClass('hovered')) {
							woto_thumbs.css('left', set_thmb_left+'px');
						}
						clearInterval(move_thumbs);
					});
				}
			});
			
			if (woto_thumbs.width() < myWindow.width()) {
				woto_thumbs.addClass('centered_thumbs');
			} else {
				woto_thumbs.removeClass('centered_thumbs');
			}		
			jQuery('.woto_slider_share').on('click', function(){
				html.addClass('show_share');
			});
			jQuery('.woto_share_fadder').on('click', function(){
				html.removeClass('show_share');
			});
			woto_thmb_viewport.on('mouseenter',function(e){
				html.addClass('thmbs_showed');
			});
			woto_thmb_viewport.on('mouseleave',function(e){
				html.removeClass('thmbs_showed');
			});
		}
		woto_sliderAll.height(myWindow.height());
	}
});

jQuery(window).resize(function () {
	if(woto_sliderAll.length){
		//if (woto_sliderAll.length > 0) {
			setGalleryContainer(jQuery('.woto_gallery_container'));
//			setVideoFrame();
		//}
		woto_sliderAll.height(setHeight);
	}
});

function woto_prevSlide() {
	cur_slide = parseInt(jQuery('.current-slide').attr('data-count'));
	cur_slide--;
	max_slide = woto_slider.find('.woto_slide').length;
	if (cur_slide > max_slide) cur_slide = 1;
	if (cur_slide < 1) cur_slide = max_slide;	
	setSlide(cur_slide);
}

function woto_nextSlide() {
	cur_slide = parseInt(jQuery('.current-slide').attr('data-count'));
	cur_slide++;
	max_slide = woto_slider.find('.woto_slide').length;
	if (cur_slide > max_slide) cur_slide = 1;
	if (cur_slide < 1) cur_slide = max_slide;
	setSlide(cur_slide);
}

function setSlide(slideNum) {
	clearInterval(woto_interval);
	slideNum = parseInt(slideNum);

	woto_thumbs.removeClass('current-thmb');
	jQuery('.current-thmb').removeClass('current-thmb');
	
	jQuery('.prev-slide').removeClass('prev-slide');
	jQuery('.current-slide').removeClass('current-slide');
	jQuery('.next-slide').removeClass('next-slide');

	if((parseInt(slideNum)+1) > max_slide) {
		nextSlide = jQuery('.woto_slide1');
	} else if ((parseInt(slideNum)+1) == max_slide){
		nextSlide = jQuery('.woto_slide'+max_slide);
	} else {
		nextSlide = jQuery('.woto_slide'+(parseInt(slideNum)+1));
	}
	
	if((parseInt(slideNum)-1) < 1) {
		prevSlide = jQuery('.woto_slide'+max_slide);
	} else if ((slideNum-1) == 1){
		prevSlide = jQuery('.woto_slide1');
	} else {
		prevSlide = jQuery('.woto_slide'+(parseInt(slideNum)-1));
	}

	prevSlide.addClass('prev-slide');
	var curSlide = jQuery('.woto_slide'+slideNum);
	
	curSlide.addClass('current-slide');
	nextSlide.addClass('next-slide');

	woto_thumbs.find('.thmb_slide'+slideNum).addClass('current-thmb');
	
	if (prevSlide.find('div').length > 0) {
		prevSlide.find('div').remove();
	}
	if (nextSlide.find('div').length > 0) {
		nextSlide.find('div').remove();
	}
	woto_descr.fadeOut(500, function () {
		
		setTimeout("woto_descr.html(jQuery('.current-slide').attr('data-descr'))",100);
		setTimeout("woto_descr.fadeIn(500)",200);
	});
	woto_title.fadeOut(500, function () {
		if (!html.hasClass('gallery_started')) html.addClass('gallery_started');
		setTimeout("woto_title.html(jQuery('.current-slide').attr('data-title'))",100);
		setTimeout("woto_title.fadeIn(500)",200);
	});
	woto_btn_prev.attr('data-count', prevSlide.attr('data-count') + '/' + max_slide);
	woto_btn_next.attr('data-count', nextSlide.attr('data-count') + '/' + max_slide);
	
	if (curSlide.attr('data-type') == 'image' && !curSlide.hasClass('block_loaded'))  {
		curSlide.attr('style', 'background:none');
		slide_not_loaded(curSlide.attr('data-count'));
	} else {
		if (nextSlide.attr('data-type') == 'image') {
			nextSlide.attr('style', 'background:url(' + nextSlide.attr('data-src') + ') no-repeat;');
		}
	
		if (prevSlide.attr('data-type') == 'image') {
			prevSlide.attr('style', 'background:url(' + prevSlide.attr('data-src') + ') no-repeat;');
		}
		
		if (curSlide.attr('data-type') == 'image') {
			curSlide.attr('style', 'background:url(' + curSlide.attr('data-src') + ') no-repeat;');
		}
			
		if (!prevSlide.hasClass('was_showed')) {
			prevSlide.addClass('was_showed');
		}
		if (!curSlide.hasClass('was_showed')) {
			curSlide.addClass('was_showed');
		}
		if (!nextSlide.hasClass('was_showed')) {
			nextSlide.addClass('was_showed');
		}
		
		//setVideoFrame();
		if (jQuery('.woto_play_pause').hasClass('woto_state_play')) {
			woto_interval = setInterval('woto_nextSlide()', woto_slider.attr('data-interval'));
		}		
	}
}
function setGalleryContainer() {	
	
	setHeight = myWindow.height();
	woto_slider.height(setHeight).css('top', '0px');	
	woto_sliderAll.height(setHeight);	
	
	woto_thumbs_setup();
}

function run_woto_slider() {
	woto_slider.addClass('started');
	if (woto_slider.hasClass('autoplay')) {
		jQuery('.woto_play_pause').addClass('woto_state_play');
		clearInterval(woto_interval);
		woto_interval = setInterval('woto_nextSlide()', woto_slider.attr('data-interval'));
	}
	woto_thumbs_setup();
	setSlide(1);
}

function slide_not_loaded(slide_num) {
	slide_num = parseInt(slide_num);
	var curSlide = jQuery('.woto_slide'+slide_num);
	if (curSlide.attr('data-type') == 'image' && !curSlide.hasClass('block_loaded'))  {
		curSlide.attr('style', 'background:none');
		setTimeout("slide_not_loaded(jQuery('.current-slide').attr('data-count'))",500);	
	} else {
		setSlide(slide_num);
	}
}

function woto_thumbs_setup() {
	woto_thumbs.width(woto_thumbs.find('li').width()*woto_thumbs.find('li').length);
}
if(woto_sliderAll.length){
	run_woto_slider();
}
function woto_thumbnails_add_fn(){
	"use strict";
		
	var thumbList = jQuery('.woto_thmb_viewport .woto_thmb_list');
	var slideItem = jQuery('.woto_gallery_container li');
	var itemLength = slideItem.length;
	var thumb = '';
	for(var i = 0;i<itemLength;i++){
		var itemI = slideItem[i];
		var src = jQuery(itemI).data('thumb-src');
		thumb += '<li class="thmb_slide thmb_slide'+(i+1)+'" data-count="'+(i+1)+'"><div><div data-fn-bg-img="'+src+'"></div></div></li>';
	}
	thumbList.html(thumb);
	frenify_fn_dataBgImg();
}