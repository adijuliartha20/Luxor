/*
 * Copyright (c) 2018 Frenify
 * Author: Frenify
 * This file is made for CURRENT TEMPLATE
*/

/*
	GLOBAL VARIABLES
*/

var borderStyle	= jQuery('.fotofly_fn_wrapper_all').data('border-style');

jQuery(document).ready(function(){

	"use strict";
	
	// here all ready functions
	
	
	frenify_inlinestyles();
	fotofly_fn_click_sound();
	frenify_fn_dataBgImg();
	fotofly_fn_logowidth();
	fotofly_fn_proofing_jump();
	frenify_fn_loop_images_runner();
	fotofly_fn_intro_interactive();
	frenify_fn_lightbox();
	fotofly_fn_rightclick_protection();
	woto_slider_runner();
	woto_slider_h();
	fotofly_fn_moving_thumbs();
	fotofly_fn_sticky_sidebar();
	fotofly_fn_monocloser();
	fotofly_fn_carousel_ps();
	fotofly_fn_intropage_closer();
	fotofly_fn_intropage_mversion();
	fotofly_fn_audiobox();
	fotofly_fn_main_bg_type();
	fotofly_fn_main_bg_type_calc();
	fotofly_fn_sticky_nav();
	fotofly_fn_sticky_nav_initialhide();
	fotofly_fn_blog_options();
	fotofly_fn_content_min_h();
	fotofly_fn_portfolio_postdatas();
	fotofly_fn_cycle_images();
	fotofly_fn_pagetitlechange();
	fotofly_fn_fixed_hamb();
	fotofly_fn_fixedhamb_click();
	fotofly_fn_megamenu_position();
	fotofly_fn_submenu();
	fotofly_fn_footerspace();
	fotofly_fn_centerlogo();
	fotofly_fn_mainnav_w();
	fotofly_fn_proofing();
	fotofly_fn_miniboxes();
	fotofly_fn_search();
	fotofly_fn_mMenuDisplay();
	fotofly_fn_hamburgermenu();
	fotofly_fn_vertmenu_notice();
	fotofly_fn_splitscreen_h();
	fotofly_fn_heroheader();
	fotofly_fn_heroheader_h();
	fotofly_fn_sticky_sidebar();
	fotofly_fn_magnific_popup2();
	fotofly_fn_jarallax();
	fotofly_fl_isotope();
	fotofly_fn_vermenuopener();
	fotofly_fn_vermenuopener_W();
	fotofly_fl_vermenuscroll();
	fotofly_fn_versubmenu();
	fotofly_fn_headerresponsive();
	fotofly_fn_mainslider_height();
	fotofly_fn_mainslider();
	fotofly_fn_imgtosvg();
	fotofly_fn_totop();
	
	setTimeout(function(){
		fotofly_fl_isotope();
	},1000);
	
	setTimeout(function(){
		fotofly_fl_isotope();
	},5000);
	
	
	jQuery(window).on('resize',function(e){
		e.preventDefault();
		fotofly_fn_intropage_mversion();
		fotofly_fn_sticky_nav_initialhide();
		woto_slider_h();
		fotofly_fn_moving_thumbs();
		fotofly_fn_main_bg_type_calc();
		fotofly_fn_hamburgermenu();
		fotofly_fn_content_min_h();
		fotofly_fn_pagetitlechange();
		fotofly_fn_fixed_hamb();
		fotofly_fn_megamenu_position();
		fotofly_fn_submenu();
		fotofly_fn_mainnav_w();
		fotofly_fn_heroheader_h();
		fotofly_fn_miniboxes();
		fotofly_fn_mMenuDisplay();
		fotofly_fn_vermenuopener_W();
		fotofly_fn_splitscreen_h();
		fotofly_fl_isotope();
		fotofly_fl_vermenuscroll();
		fotofly_fn_headerresponsive();
		fotofly_fn_mainslider_height();
	});
	
	
	jQuery(window).load(function(){
		fotofly_fn_miniboxes();
		fotofly_fn_sticky_nav_initialhide();
		fotofly_fn_megamenu_position();
		fotofly_fl_isotope();
	});
	
	jQuery(window).on('scroll', function(e) {
		e.preventDefault();
		fotofly_fn_totop_myhide();
    });
	
	if(jQuery().waitForImages){
		jQuery('.fotofly_fn_justified_images').waitForImages(function(){
			fotofly_fn_justified_images();
			setTimeout(function(){
				fotofly_fn_preloader();
			},50);
		});
	}
	
});
// -----------------------------------------------------
// ----------    INLINE STYLES TO HEADER    ------------
// -----------------------------------------------------
function frenify_inlinestyles(){
	"use strict";
	var datas 			= jQuery('*[data-inlinestyles]');
	var itemLength 		= datas.length;
	var InlineStyles 	= '';
	for(var i = 0;i<itemLength;i++){
		InlineStyles += jQuery(datas[i]).data('inlinestyles');
	}
	if(itemLength>0){
		jQuery('head').append('<style type="text/css">'+InlineStyles+'</style>');
	}
	datas.attr('data-inlinestyles','GH');
}
// -----------------------------------------------------
// ---------------    ONE CLICK SOUND    ---------------
// -----------------------------------------------------
function fotofly_fn_click_sound(){
	"use strict";
	
	var audio 	= jQuery('.fotofly_fn_mouse_click_sound audio');
	if(audio.length){
		var allClickableButtons = jQuery('a, .fotofly_fn_vertmenu_left, input, textarea, .fotofly_fn_psingle_mono .mono_title_opener, .fotofly_fn_psingle_mono .close_button, .flex-direction-nav a.flex-prev, .flex-direction-nav a.flex-next');
		
		allClickableButtons.on('click', function(){
			audio[0].play();
		});
	}
}
// -----------------------------------------------------
// ------------------   PRELOADER    -------------------
// -----------------------------------------------------
function fotofly_fn_preloader(){
	"use strict";
	var preloader 	= jQuery('.fotofly_fn_preloader');
	var list		= jQuery('.fotofly_fn_gsingle_list.full-justified');
	var list2		= jQuery('.fotofly_fn_portfolio_single.justified .portfolio_single .list');
	var list3		= jQuery('.fotofly_fn_portfolio_single.full-justified .portfolio_single .list');
	preloader.remove();
	if(list.length){
		list.addClass('fn-ready');
	}else if(list2.length){
		list2.addClass('fn-ready');
	}else if(list3.length){
		list3.addClass('fn-ready');
	}
}
// -----------------------------------------------------
// ---------   BACKGROUND IMAGE FROM DATA    -----------
// -----------------------------------------------------
function frenify_fn_dataBgImg(){
	"use strict";
	var div = jQuery('div');
	div.each(function(){
		var element = jQuery(this);
		var attrBg	= element.attr('data-fn-bg-img');
		var bgImg	= element.data('fn-bg-img');
		if(typeof(attrBg) !== 'undefined'){
			element.css({backgroundImage:'url('+bgImg+')'});
		}
	});
}
// -----------------------------------------------------
// -----------------   LOGO WIDTH    -------------------
// -----------------------------------------------------
function fotofly_fn_logowidth(){
	"use strict";
	var logoText 	= jQuery(".fotofly_fn_flogo.logo_text");
	var centerLogo 	= jQuery(".fotofly_fn_header .center_logo");
	var scale, remainder;
	if(!centerLogo.length){
		logoText.each(function(){
			var element = jQuery(this);
			var parentW = element.parent().width();
			var span	= element.find('span');
			var spanW 	= span.width();
			var spanH 	= span.height();
				remainder		= spanW - parentW;
			if(remainder > 0){
				scale = 1 - (remainder / spanW);
			}else{
				if(spanH > 150){
					scale = 1- ((spanH - 150) / spanH);
				}else{
					scale = 1;
				}
			}
			span.css({transform:'scale('+scale+')'});
		});
	}
	
}
// -----------------------------------------------------
// ---------------   JUSTIFIED IMAGES    ---------------
// -----------------------------------------------------
function fotofly_fn_justified_images(){
	"use strict";
	var justified = jQuery(".fotofly_fn_justified_images");
	justified.each(function(){
		var element 	= jQuery(this);
		var justHeight	= element.attr('data-just-h');
		var justGutter	= element.attr('data-just-g');
		if(typeof(justHeight) !== 'undefined' && typeof(justGutter) !== 'undefined'){
			if(justHeight !== ''){justHeight = justHeight;}
			if(justGutter !== ''){justGutter = justGutter;}
		}else{justHeight = 250;justGutter = 20;}
		element.justifiedGallery({
			rowHeight : justHeight,
			lastRow : 'nojustify',
			margins : justGutter,
			refreshTime: 500,
			refreshSensitivity: 0,
			maxRowHeight: null,
			border: 0,
			captions: false,
			randomize: false
		});
	});
		
}
// -----------------------------------------------------
// ----------------   PROOFING JUMP    -----------------
// -----------------------------------------------------
function fotofly_fn_proofing_jump(){
	"use strict";
	var proof_link 		= jQuery('.pixproof_photo_ref');
	
	if(proof_link.length){
		proof_link.each(function() {
            jQuery(this).on('click', function(e){
				e.preventDefault();
				
				var obj 	= jQuery(this).data('href');
				var target 	= jQuery('[id=' + obj.slice(1) +']');
				
				// experiment
				if (target.length) {
					var scrollTop = target.offset().top - 200;
					jQuery('html,body').scrollTo(scrollTop,obj,{
						animation:{
							duration: 700,
							easing: "easeInOutQuart"
						}
					});
					setTimeout(function (){
						target.addClass('scrolled_from_comments');
						setTimeout(function(){
							target.removeClass('scrolled_from_comments');
						}, 800);
					}, 700);

				}
				// experiment
				if(!target.length){
					alert('Image with that ID doesn\'t exist');	
				}
			});	
        });	
	}
}
// -----------------------------------------------------
// -----------   LOOP IMAGES (own plugin)    -----------
// -----------------------------------------------------
function frenify_fn_loop_images_runner(){
	"use strict";
	var customFnRotator = jQuery('.frenify-custom-rotator');
	var list 			= jQuery('.frenify-custom-rotator-list');
	var H				= jQuery(window).height();
	
	customFnRotator.css({height:H});
	
	if(customFnRotator.length) {
		
		if(list.find('.item').length % 2 === 1){ list.find('.item:last-child').remove();}
		
		var thumbUrl = list.data('thumb-url');
		list.find('.item').each(function(i) {
			jQuery(this).css('background-image', 'url(' + jQuery(this).find('img').attr('src') + ')').find('img').attr('src', thumbUrl);
			if (i % 2 === 1) {jQuery(this).appendTo('.rot-even-list');}
			else{jQuery(this).appendTo('.rot-odd-list');}
		});
		
		list.remove();
			
		jQuery('.rot-odd-list').each(function(){
			var el = jQuery(this);
			el.addClass('loaded');
			var firstSlide = el.find('.item').first();
			frenifyFNLoop(firstSlide);
		});

		jQuery('.rot-even-list').each(function(){
			var el = jQuery(this);
			el.addClass('loaded');
			var firstSlide = el.find('.item').first();
			frenifyFNLoop2(firstSlide);
		});

	}
	function frenifyFNLoop(slide) {

		var animationTime = 2+'s'; 

		slide.css({ 
			'animation-duration': animationTime, 
			'-webkit-animation-duration':  animationTime
			});

		slide.addClass('shalf');
		slide.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd',   
			function() {
				if(slide.is(':last-child')) {
					customFnRotator.addClass('finished');
				} else {
					frenifyFNLoop(slide.next());
					slide.addClass('thalf');
					slide.removeClass('shalf');
				}
				
		});  
	}
	
	function frenifyFNLoop2(slide) {

		var animationTime = 2+'s';

		slide.css({ 
			'animation-duration': animationTime, 
			'-webkit-animation-duration':  animationTime
			});

		slide.addClass('rhalf');
		slide.on('animationend webkitAnimationEnd oAnimationEnd MSAnimationEnd',   
			function() {
				if(slide.is(':last-child')) {
					customFnRotator.addClass('finished');
				} else {
					frenifyFNLoop2(slide.next());
					slide.addClass('jhalf');
					slide.removeClass('rhalf');
				}
				
		});  
	}
}
// -----------------------------------------------------
// --------------   INTRO INTERACTIVE    ---------------
// -----------------------------------------------------
function fotofly_fn_intro_interactive(){
	"use strict";
	var li = jQuery('.fotofly_fn_intropage .interactive-list li');
	var div = jQuery('.fotofly_fn_intropage .interactive-list .overlay > div');
	
	li.on('mouseenter',function(){
		var element			= jQuery(this);
		var attrClass		= element.attr('data-inter');		
		var overlayChild	= jQuery('.fotofly_fn_intropage .interactive-list .overlay .' + attrClass);
		
		li.removeClass('opened');
		element.addClass('opened');
		div.removeClass('opened');
		overlayChild.addClass('opened');
	});
}
// -----------------------------------------------------
// ---------------   GALLERY LIGHTBOX    ---------------
// -----------------------------------------------------
function frenify_fn_lightbox(){
	"use strict";
	if(jQuery().lightGallery){
		// FIRST WE SHOULD DESTROY LIGHTBOX FOR NEW SET OF IMAGES
		
		var gallery = jQuery('.frenify_fn_lightbox');
		
		gallery.each(function(){
			var element = jQuery(this);
			element.lightGallery(); // binding
			if(element.length){element.data('lightGallery').destroy(true); }// destroying
			jQuery(this).lightGallery({
				selector: ".lightbox",
				thumbnail: 1,
				loadYoutubeThumbnail: !1,
				loadVimeoThumbnail: !1,
				showThumbByDefault: !1,
				mode: "lg-fade",
				download:!1,
				getCaptionFromTitleOrAlt:!1,
			});
		});
	}	
	
}
// -----------------------------------------------------
// -----------   RIGHT CLICK PROTECTION    -------------
// -----------------------------------------------------
function fotofly_fn_rightclick_protection(){
	"use strict";
	var rightCLick = jQuery('.fotofly_fn_rightclick_protection');
	
	function fotofly_fn_rightclick_avoid(){
		rightCLick.fadeIn();
		rightCLick.on('click', function(e) {
			e.preventDefault();
			jQuery(this).fadeOut();
		});
	}
	
	if (rightCLick.hasClass('enable')) {
		
		jQuery(document).on("contextmenu",function(e){
			if(e.target.nodeName !== "INPUT" && e.target.nodeName !== "TEXTAREA"){
				 e.preventDefault();
				 fotofly_fn_rightclick_avoid();
			}
		 });
		
		jQuery(document).keydown(function(event){
			if(event.keyCode===123){
				return false; //Prevent from F12
			}
			else if(event.ctrlKey && event.shiftKey && event.keyCode===73){        
				return false;  //Prevent from Ctrl+Shift+I
			}
		});	
		
		jQuery("img").mousedown(function(){
			return false;
		});
	}
}
// -----------------------------------------------------
// --------------   WOTOSLIDER RUNNER    ---------------
// -----------------------------------------------------
function woto_slider_runner(){
	"use strict";
	if (jQuery('.block2preload:first').length) {
		(function (img, src) {
			img.src = src;
			img.onload = function () {
				jQuery('.block2preload:first').removeClass('block2preload').addClass('block_loaded').animate({
					'z-index': '15'
				}, 100, function() {					
					woto_slider_runner();
				});
				woto_slider_runner();
			};                
		}(new Image(), jQuery('.block2preload:first').attr('data-src')));
	}
}
function woto_slider_h(){
	"use strict";
	var wr 	= jQuery('.woto_gallery_all_wrapper');
	var H	= jQuery(window).height();
	wr.css({height: H});
}
// -----------------------------------------------------
// ----------------   MOVING THUMBS    -----------------
// -----------------------------------------------------
function fotofly_fn_moving_thumbs(){
	"use strict";
	var contentChilds = jQuery('.blog_moving_thumbs .blog_content ul li');
	
	contentChilds.each(function(){
		var contentChild 		= jQuery(this);
		var thumb 				= jQuery('.blog_moving_thumbs .fn_swimmer');
		var imageOffSetTop 		= jQuery('.blog_moving_thumbs .moving_content').offset().top;
		var contentChildH 		= contentChild.outerHeight(true)/2;
		var indexOfContentChild = contentChild.index();
		var movingParent 		= jQuery('.blog_moving_thumbs .moving_content ul');
		var thumbTransform 		= contentChild.offset().top - imageOffSetTop - (thumb.height()/2 - contentChildH);
		var movingParentTop 	= -(0+indexOfContentChild*thumb.height());
		
		//default
		
		contentChild.on('mouseenter',function(){
			thumb.css({transform:'translateY('+thumbTransform+'px) translateZ(0)'});
			movingParent.css({top:movingParentTop});
		});
		
	});
}
// -----------------------------------------------------
// ---------------   STICKY SIDEBAR    -----------------
// -----------------------------------------------------
function fotofly_fn_sticky_sidebar(){
	"use strict";
	
	var sticky = jQuery('.sticky_sidebar');
	sticky.each(function(){
		jQuery(this).theiaStickySidebar({
			containerSelector: '', // The sidebar's container element. If not specified, it defaults to the sidebar's parent.
			additionalMarginTop: 50,
			additionalMarginBottom: 0,
			updateSidebarHeight: true, // Updates the sidebar's height. Use this if the background isn't showing properly, for example.
			minWidth: 1040, // The sidebar returns to normal if its width is below this value. 
		});
	});
	
}
// -----------------------------------------------------
// ---------    MONO CLOSER (PORTFOLIO SINGLE)   -------
// -----------------------------------------------------
function fotofly_fn_monocloser(){
	"use strict";
	var opener  = jQuery('.mono_title_opener'),
		div		= jQuery('.fotofly_fn_psingle_mono .content_part'),
		closer	= jQuery('.fotofly_fn_psingle_mono .close_button');
	
	opener.on('click',function(){
		opener.addClass('closed');
		setTimeout(function(){div.addClass('fn-show fn-showw');cba();},500);
	});
	closer.on('click',function(){
		div.removeClass('fn-show');
		setTimeout(function(){div.removeClass('fn-showw');},500);
		setTimeout(function(){
			opener.removeClass('closed');
			//destroy nicescroll
			div.getNiceScroll().remove();
		},1000);
	});
	function cba(){
		div.niceScroll({
			touchbehavior:false,
			cursorwidth:0,
			autohidemode:true,
			cursorborder:"2px solid #333"
		});
	}
}
// -----------------------------------------------------
// ----------    CAROUSEL (PORTFOLIO SINGLE)   ---------
// -----------------------------------------------------
function fotofly_fn_carousel_ps(){
	"use strict";
	var carousel	= jQuery('.fotofly_fn_portfolio_single .owl-carousel');
	carousel.each(function(){
		jQuery(this).owlCarousel({
			margin:20,
			loop:true,
			autoWidth:true,
			items: 4,
			dots: false,
			nav: false,
			autoplay:true,
			autoplayTimeout:4000,
			
		});
	});
}
// -----------------------------------------------------
// -------------    INTROPAGE DISABLING   --------------
// -----------------------------------------------------
function fotofly_fn_intropage_closer(){
	"use strict";
	var intropage 	= jQuery('.fotofly_fn_intropage');
	var closer 		= intropage.find('.closer');
	var wrapper		= jQuery('.fotofly_fn_wrapper_all_content');
	var location	= window.location.href;
	var myLocation	= 'http://fotofly.benoon.com/1/intro/';
	
	
	if(intropage.length){
		if(location === myLocation){
			closer.on('click', function(){
				intropage.addClass('closeme');
				sessionStorage.setItem('status', 'disabled');
				wrapper.css({opacity:1,height:'auto',overflow:'auto'});
				return false;
			});
			sessionStorage.clear();
		}else{
			closer.on('click', function(){
				intropage.addClass('closeme');
				sessionStorage.setItem('status', 'disabled');
				return false;
			});
		}

		intropage.css({display:'block'});
		// check if intropage is disabled
		var status = sessionStorage.getItem('status');
		if(status){
			intropage.addClass('closeme');
		}
		// Remove all saved data from sessionStorage
		jQuery(document).keydown(function(event){
			if(event.keyCode === 116 && event.ctrlKey){
				sessionStorage.clear();
			}
		});

		// CLOSE KEY
		var aa	= '';
		var closeKeys	= intropage.data('close-key');
		// check for integer of closeKeys
		if(!Number.isInteger(closeKeys) && closeKeys !== ''){
			var res = closeKeys.split("/");
			for(var i = 0;i<res.length;i++){
				var resI = res[i];
				var adder = ' || ';
				if(i === (res.length - 1)){
					adder = '';
				}
				aa += 'event.keyCode === ' + resI + adder;
			}
		}else{
			aa = 'event.keyCode === ' + closeKeys;
		}
		if(closeKeys !== ''){
			if(!status){
				jQuery(document).keydown(function(event){
					if(eval(aa)){
						intropage.addClass('closeme');
						if(location === myLocation){
							sessionStorage.clear();
						}else{
							sessionStorage.setItem('status', 'disabled');
						}
						wrapper.css({opacity:1,height:'auto',overflow:'auto'});
					}
				});
			}
		}
	}	
}
function fotofly_fn_intropage_mversion(){
	"use strict";
	var intropage 	= jQuery('.fotofly_fn_intropage');
	var W			= jQuery(window).width();
	var mVersion	= intropage.data('mversion');
	if(intropage.length){
		if(mVersion === 'disable'){
			if(W<=1040){
				intropage.remove();
			}
		}
	}
}
// -----------------------------------------------------
// ------------------    AUDIOBOX    -------------------
// -----------------------------------------------------
function fotofly_fn_audiobox(){
	"use strict";
	
	var curPlaying;
	jQuery(".fotofly_fn_audio_controls .playback").click(function(e) {
        e.preventDefault();
        var song = jQuery('audio')[0];
        if(song.paused){
            song.play();
			jQuery(this).find('span.play').addClass('on');
			jQuery(this).find('span.pause').removeClass('on');
            if(curPlaying) {jQuery("audio", "#"+curPlaying)[0].pause();}
        } 
		else { 
			song.pause();
			jQuery(this).find('span.play').removeClass('on');
			jQuery(this).find('span.pause').addClass('on');
		}
        curPlaying = jQuery(this).parent()[0].id;
    });
	
}
// -----------------------------------------------------
// ---------------    MAIN BACKGROUND    ---------------
// -----------------------------------------------------
function fotofly_fn_main_bg_type(){
	"use strict";
	var bg 		= jQuery('.fotofly_fn_bg_all');
	var slider 	= bg.find('.overlay_fade_slider');
	var color 	= bg.find('.overlay_color');
	var video 	= bg.find('.overlay_video');
	
	// datas
	var overlay = bg.data('overlay-type');
	var opacity = bg.data('overlay-opacity');
	var mycolor = color.data('color');
	
	// overlay color and color transparency
	if(opacity !== ''){
		color.css({opacity:opacity/100});
	}else{
		color.css({opacity:1});
	}
	if(overlay !== 'default'){
		if(mycolor === 'dark'){
			color.css({backgroundColor:'#000'});
		}else if(mycolor === 'light'){
			color.css({backgroundColor:'#fff'});
		}
	}
	
	// slider version
	if(overlay === 'fade_slider'){
		slider.css({display: 'block'});
		slider.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: false,
			slideshowSpeed: 5000,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	}
	
	// video version
	else if(overlay === 'video'){
		var videoType 	= video.data('video-type');
		var youtube		= video.find('.fn_youtube');
		var vimeo		= video.find('.fn_vimeo');
		var mp4			= video.find('.fn_mp4');
		var unknown		= video.find('.fn_unknown');
		if(videoType === 'youtube'){
			vimeo.remove();
			mp4.remove();
			youtube.YTPlayer({}).YTPFullscreen();
			youtube.on("YTPStart",function(){
			   unknown.hide();
			});
		}else if(videoType === 'vimeo'){
			youtube.remove();
			mp4.remove();
			vimeo.vimeo_player({
				realfullscreen: true,
			}).v_fullscreen();
			vimeo.on("VPStart",function(){
			   unknown.hide();
			});
		}else if(videoType === 'mp4'){
			youtube.remove();
			vimeo.remove();
			unknown.hide();
		}
	}
}
function fotofly_fn_main_bg_type_calc(){
	"use strict";
	var H 			= jQuery(window).height();
	var bg 			= jQuery('.fotofly_fn_bg_all .overlay_fade_slider ul.slides > li');
	var introabout2 = jQuery('.fotofly_fn_intropage .about-2 .inner_in, .fotofly_fn_intropage .about-3 .cont_wrap');
	introabout2.css({minHeight:H});
	bg.css({height: H});
}
// -----------------------------------------------------
// -------------    STICKY NAVIGATION    ---------------
// -----------------------------------------------------
function fotofly_fn_sticky_nav_initialhide(){
	"use strict";
	
	var nav 	= jQuery('.fotofly_fn_header_sticky');
	var navH 	= nav.outerHeight(true, true);
	
	nav.css({top:-navH});
}

function fotofly_fn_sticky_nav(){
	"use strict";
	var nav 	= jQuery('.fotofly_fn_header_sticky');
	
	var currentScroll = '';
	var lastScroll = '';
	var direction = '';

	if(nav.hasClass('on')){
		jQuery(window).on('scroll', function(){
			currentScroll = jQuery(this).scrollTop();

			if(currentScroll > lastScroll){
				direction = 'down';	
				lastScroll = currentScroll;
			}
			else if(currentScroll < lastScroll){
				direction = 'up';	
				lastScroll = currentScroll;	
			}
			
			if(currentScroll > 300 && direction === 'up') {
				if(!nav.hasClass('opened')){
					nav.addClass('opened');
				}
			}
			else{nav.removeClass('opened');}
		});
	}
}
// -----------------------------------------------------
// -------------    BLOG PAGE OPTIONS    ---------------
// -----------------------------------------------------
function fotofly_fn_blog_options(){
	"use strict";
	var content = jQuery('.fotofly_fn_blog_wrap .blog_content');
	var wrapper = jQuery('.fotofly_fn_blog_wrap .blog_wrapper');
	var split	= jQuery('.fotofly_fn_page_splitscreen');
	var cols	= content.data('blog-column');
	if(!split.length){
		if(cols === 1){
			wrapper.css({maxWidth:'720px'});
		}else if(cols === 2 || cols === 3){
			wrapper.parent().addClass('container');
			wrapper.css({maxWidth:'auto'});
			wrapper.css({padding:'0px'});
		}else if(cols > 3){
			wrapper.parent().removeClass('container');
			wrapper.css({maxWidth:'auto'});
		}
	}
}
// -----------------------------------------------------
// -------------    CONTENT MIN HEIGHT    --------------
// -----------------------------------------------------
function fotofly_fn_content_min_h(){
	"use strict";
	var content 	= jQuery('div.fotofly_fn_content, .fotofly_fn_password_protected_content, .fotofly_fn_error_page');
	var footer 		= jQuery('.fotofly_fn_footer');
	var header1 	= jQuery('.fotofly_fn_header');
	var header2		= jQuery('.fotofly_fn_header__one');
	var header3		= jQuery('.fotofly_fn_vertnav');
	var borderSize	= 0;
	var skin		= jQuery('.fotofly_fn_wrapper_all').data('nav-skin');
	
	
	var H		= jQuery(window).height();
	var h1h		= header1.outerHeight();
	var h2h		= header2.outerHeight();
	var fh		= footer.outerHeight();
	
	if(borderStyle === 'small'){
		borderSize = 30;
	
		if(skin === 'translight' || skin === 'transdark' || skin === 'nonelight' || skin === 'nonedark'){
			h1h = h2h = 0;
		}
	}else if(borderStyle === 'big'){
		borderSize = 60;
	}else{
		if(skin === 'translight' || skin === 'transdark' || skin === 'nonelight' || skin === 'nonedark'){
			h1h = h2h = 0;
		}
	}
	
	if(footer.length){
		if(header1.length){
			content.css({minHeight:H-fh-h1h-borderSize});
		}else if(header2.length){
			content.css({minHeight:H-fh-h2h-borderSize});
		}
		else if(header3.length){
			content.css({minHeight:H-fh-borderSize});
		}
	}else{
		if(header1.length){
			content.css({minHeight:H-h1h-borderSize});
		}else if(header2.length){
			content.css({minHeight:H-h2h-borderSize});
		}
		else if(header3.length){
			content.css({minHeight:H-borderSize});
		}
	}
	
	var monosliderulli = jQuery('.fotofly_fn_psingle_mono .mono_slider ul.slides > li');
	var mono = jQuery('.fotofly_fn_psingle_mono, .fotofly_fn_psingle_mono .content_part');
	if(header1.length){
		monosliderulli.css({height:H-h1h-borderSize});
		mono.css({height:H-h1h-borderSize});
	}else if(header2.length){
		monosliderulli.css({height:H-h2h-borderSize});
		mono.css({height:H-h2h-borderSize});
	}
}
// -----------------------------------------------------
// -------------    PORTFOLIO POST DATAS    ------------
// -----------------------------------------------------
function fotofly_fn_portfolio_postdatas(){
	"use strict";
	var ul	= jQuery('ul.fotofly_fn_portfolio_list');
	ul.each(function(){
		var element 				= jQuery(this);
		
		// datas
		var TextInsideColor			= element.data('title-inside-color');
		var TextInsideHoverColor	= element.data('title-inside-hover-color');
		
		var ulli					= element.children('li');
		ulli.each(function(){
			var $this					= jQuery(this);
			var title					= $this.find('.cover_image_wrap .title_wrap');
			var titleSpan				= title.find('.fn_cat');
			var titleSpanA				= title.find('.fn_cat a');
			var titleSpanExtra			= title.find('.fn_cat .extra');
			var titleHeadingA			= title.find('h3 a');
			// title color
			titleSpan.css({color:TextInsideColor});
			titleSpanA.css({color:TextInsideColor});
			titleHeadingA.css({color:TextInsideColor});
			titleSpanExtra.css({backgroundColor:TextInsideColor});

			titleHeadingA.on('mouseenter',function(){
				titleHeadingA.css({color:TextInsideHoverColor});
			}).on('mouseleave',function(){
				titleHeadingA.css({color:TextInsideColor});
			});
		});
		
		// work with columns
		var PortUl 		= jQuery('ul.fotofly_fn_portfolio_list');
		var PortInner	= jQuery('.fotofly_fn_portfolio_inner');
		var div			= jQuery('.fotofly_fn_portfolio > div');
		var PortUlLi 	= PortUl.find('li.fotofly_fn_item_wrap');
		PortUlLi.each(function(){
			var element 		= jQuery(this);
			var column			= PortUl.data('post-column');
			var columnGutter	= PortUl.data('post-column-gutter');
			if(columnGutter === 0 && (column === 3 || column === 5)){
				element.css({paddingLeft:'0px'});
				element.css({marginBottom:'0px'});
				PortUl.css({marginLeft:'-1px'});
			}else{
				element.css({paddingLeft:columnGutter + 'px'});
				element.css({marginBottom:columnGutter + 'px'});
				PortUl.css({marginLeft:'-' + columnGutter + 'px'});
			}
			if(column === 1){
				PortInner.css({maxWidth:'720px'});
			}else if(column === 2 || column === 3){
				div.addClass('container');
				PortInner.css({maxWidth:'auto'});
				PortInner.css({padding:'0px'});
			}else if(column === 4 || column === 5 || column === 6){
				div.removeClass('container');
				PortInner.css({maxWidth:'auto'});
				PortInner.css({margin:0});
			}
			if(columnGutter >= 40 && columnGutter < 60){
				PortUl.addClass('mygutter40');
			}else if(columnGutter >= 60 && columnGutter <= 80){
				PortUl.addClass('mygutter60');
			}
		});
		
	});
}
// -----------------------------------------------------
// -----------------    CYCLE IMAGES    ----------------
// -----------------------------------------------------
function fotofly_fn_cycle_images(){
	"use strict";
	
	var fn_cycle = jQuery('.fotofly_fn_cycle_slides');
	
	if(fn_cycle.length){
		fn_cycle.cycle({
			fx:      'fade',
			delay:   1000,
			speed:   800,
			timeout: 800,
		}).cycle('pause');
			
	jQuery('.fotofly_fn_portfolio.spinner .fotofly_fn_item').hover(function(){
		jQuery(this).find('.fotofly_fn_cycle_slides').addClass('on').cycle('resume');
			if(jQuery(this).find('ul li').length !== 0)
			{
				jQuery(this).addClass('on');
			}
		}, function(){
			jQuery(this).find('.fotofly_fn_cycle_slides').cycle('pause');
		});		
	}
}
// -----------------------------------------------------
// --------------    PAGE TITLE CHANGE    --------------
// -----------------------------------------------------
function fotofly_fn_pagetitlechange(){
	"use strict";
	
	var title		= jQuery('.fotofly_fn_content_title_wrap');
	var breadCrumbs	= title.find('.fotofly_fn_breadcrumbs');
	var header1		= jQuery('.fotofly_fn_header');
	var header1H	= header1.outerHeight();
	var header2		= jQuery('.fotofly_fn_header__one');
	var header2H	= header2.outerHeight();
	var blogpage	= jQuery('.fotofly_fn_blog_single_wrap');
	var skin		= jQuery('.fotofly_fn_wrapper_all').data('nav-skin');
	var extra		= 70;
	
	if(title.hasClass('media')){
		extra = 120;
	}
	if(borderStyle === 'big'){
		extra = 0;
	}
	if(skin === 'translight' || skin === 'transdark' || skin === 'nonelight' || skin === 'nonedark'){
		if(header1.length){
			title.css({paddingTop:header1H+extra});
			breadCrumbs.css({paddingTop:0});
			blogpage.css({paddingTop:header1H});
		}else if(header2.length){
			title.css({paddingTop:header2H+extra});
			breadCrumbs.css({paddingTop:0});
			blogpage.css({paddingTop:header2H});
		}
	}
}
// -----------------------------------------------------
// ---------------    FIXED HAMBURGER    ---------------
// -----------------------------------------------------
function fotofly_fn_fixed_hamb(){
	"use strict";
	var hambPart	= jQuery('.fotofly_fn_vertnav_hampart');
	var H			= jQuery(window).height();
	var W			= jQuery(window).width();
	
	if(borderStyle === 'small'){
		hambPart.css({height:H-30});
	}else{
		hambPart.css({height:H});
	}
	var a = '';
	
	var logoH		= jQuery('.fotofly_fn_vertnav_menupart .logo_full').outerHeight(true);
	var nav			= jQuery('.fotofly_fn_vertnav_menupart .menu_nav');
	var menuMain	= jQuery('.fotofly_fn_vertnav_menupart .menu-main-menu-container');
	var ul			= jQuery('.fotofly_fn_vertnav_menupart ul.nav_ver');
	var navH		= nav.outerHeight(true);
	var socialH		= jQuery('.fotofly_fn_vertnav_menupart .social_icons').outerHeight(true);
	
	if(borderStyle === 'small'){
		a = 110;
	}else if(borderStyle === 'big'){
		if(W > 1040){a = 200;}else{a = 80;}
	}else{
		a = 80;
	}
	var asHeight	= H-logoH-socialH-a;
	if(H-a>logoH+navH+socialH){
		nav.css({height:asHeight});
		menuMain.css({height:asHeight});
		ul.css({height:asHeight});
	}else{
		nav.css({height:'auto'});
		menuMain.css({height:'auto'});
		ul.css({height:'auto'});
	}
}
function fotofly_fn_fixedhamb_click(){
	"use strict";
	
	// fixed hamburger opener
	var hamburger		= jQuery('.fotofly_fn_vertnav_hampart .hamburger');
	hamburger.on('click',function(){
		var element 	= jQuery(this);
		var menupart	= jQuery('.fotofly_fn_vertnav_menupart');
		
		if(element.hasClass('is-active')){
			element.removeClass('is-active');
			menupart.removeClass('opened');
		}else{
			element.addClass('is-active');
			menupart.addClass('opened');
		}return false;
	});
	
	
	// default hamburger opener
	var hamburgerMob 	= jQuery('.header_helper ul li .hamburger');
	var mobNav			= jQuery('.fotofly_fn_mobilemenu_wrap');
	
	
	hamburgerMob.on('click',function(){
		var element 	= jQuery(this);
		
		
		if(element.hasClass('is-active')){
			element.removeClass('is-active');
			mobNav.slideUp(500);
		}else{
			element.addClass('is-active');
			mobNav.slideDown(500);
		}return false;
	});
	
}
// -----------------------------------------------------
// ---------------    MEGAMENU POSITION    -------------
// -----------------------------------------------------
// Correcting position of mega menus
function fotofly_fn_megamenu_position(){
	"use strict";
	jQuery('.fotofly_fn_main_nav > li').each(function() {
		var item 		= 	jQuery(this),
		megaDiv			= 	item.find("div.wide"),
		dropDiv 		= 	item.find("div.dropdown"),
		pos 			= 	item.position(),
		parentOffset	=   item.parent().offset().left,
		parentPosition	=   item.parent().position().left,
		mainOffset		=   parentOffset - parentPosition,		
		triangle 		= 	item.find('span.triangle');
		
		// check for bordered style of theme
		var a			= '';
		if(borderStyle === 'small'){
			a = 15;
		}else if(borderStyle === 'big'){
			a = 60;
		}else{
			a = 0;
		}
		
		if(dropDiv.length){
			triangle.css({left: item.outerWidth()/2});
		}

		// Mega Menu Position Fixes
		if(megaDiv.length)
		{
			megaDiv.css({left: ((pos.left + mainOffset) * -1)+a, paddingLeft:mainOffset, paddingRight:mainOffset});					
		}	
	});
	
	
	var navW 		= 	jQuery('.fotofly_fn_wrapper_all').width();
	var megaMenu 	= 	jQuery('.fotofly_fn_main_nav > li > div.wide');

	megaMenu.css({width:navW});
	
}
// -----------------------------------------------------
// --------------------    SUBMENU    ------------------
// -----------------------------------------------------
function fotofly_fn_submenu(){
	"use strict";
	
	// Submenu Itself
	jQuery('.fotofly_fn_main_nav li').hover(function() {
        jQuery(this).find('.slidein').css({'opacity':0.1,'margin-top':0}).fadeIn(200).stop(true, true).animate({'margin-top':0,'opacity':1}, 100);
		
    }, function() {
		jQuery(this).find('.slidein').fadeOut(1,function(){});
    });
	
	// Dropdown Grandchild
	jQuery('.fotofly_fn_main_nav li .dropdown ul li').hover(function() {
        jQuery(this).find('.fotofly_fn_grandchild-menu:first').stop().fadeIn('fast');
    }, function() {
		jQuery(this).find('.fotofly_fn_grandchild-menu:first').stop().fadeOut('fast');
    });
	
	// Add Triangle
	var begot = jQuery('.fotofly_fn_main_nav > li > div > span.triangle').length;
	if(!begot){jQuery('.fotofly_fn_main_nav > li > div.fotofly_fn_sub').append('<span class="triangle"></span>');}
	
}


// -----------------------------------------------------
// ----------------    FOOTER SPACE    -----------------
// -----------------------------------------------------
function fotofly_fn_footerspace(){
	"use strict";
	var ul			= jQuery('.fotofly_fn_footer ul.widget_area');
	var ulLi		= jQuery('.fotofly_fn_footer ul.widget_area > li');
	var space		= ul.data('space');
	ulLi.each(function(){
		var element = jQuery(this);
		element.css({paddingLeft:space + 'px'});
		ul.css({marginLeft: 0 - space + 'px'});
	});
}
// -----------------------------------------------------
// ----------------    CENTER LOGO    ------------------
// -----------------------------------------------------
function fotofly_fn_centerlogo(){
	"use strict";
	var logo 			= jQuery('.fotofly_fn_header .middle_logo').html();
	var li				= jQuery('.fotofly_fn_header ul.nav__hor > li');
	var dataOfHedaer 	= jQuery('.fotofly_fn_header').data('logo');
	var number 			= li.length;
	
	if(number === 1){
		number = number;
	}else if(number > 1){
		number = Math.floor(number/2);
	}else{
		number = 1;
	}
	if(dataOfHedaer !== 'center'){
		jQuery('.fotofly_fn_header ul.nav__hor > li:nth-child('+number+')').after('<li class="middle_child">'+logo+'</li>');
	}
}
// -----------------------------------------------------
// ------------    MAIN NAVIGATION WIDTH    ------------
// -----------------------------------------------------
function fotofly_fn_mainnav_w(){
	"use strict";
	
	var headerOne	= jQuery('.fotofly_fn_header__one'),
	 	nav 		= headerOne.find('.navigation'),
	 	navUl 		= headerOne.find('ul.nav__hor'),
		logo		= headerOne.find('.logo'),
		logoH		= headerOne.find('.logo').outerHeight(),
		headerList 	= headerOne.find('.header_list'),
		navUlH		= navUl.height(),
		headerListH = headerList.outerHeight(),
		abc 		= logoH - navUlH,
		W			= jQuery(window).width();
	
	if(headerOne.length){
		if(W > 480){
			if(logoH > headerListH){
				headerList.css({height:logoH});
				nav.css({height:logoH});
				navUl.css({marginTop:abc});
			}else{
				logo.css({height:headerListH});
			}
		}else{
			headerList.css({height:'auto'});
			nav.css({height:'auto'});
		}
	}
	
}
// -----------------------------------------------------
// ---------------    PROOFING CHECK    ----------------
// -----------------------------------------------------
function fotofly_fn_proofing(){
	"use strict";
	var item		= jQuery('.fotofly_fn_proofing .proofing_list li');
	
	item.each(function(){
		var element = jQuery(this);
		var div		= element.children('.item');
		var btn1	= div.find('a.check');
		var btn2	= div.find('a.cancel');
		btn1.on('click',function(){
			div.addClass('checked');
			return false;
		});
		btn2.on('click',function(){
			div.removeClass('checked');
			return false;
		});
	});
}
// -----------------------------------------------------
// -----------------    MINI BOXES    ------------------
// -----------------------------------------------------
function fotofly_fn_miniboxes(){
  "use strict";
	 
  var el 		= jQuery('.fotofly_fn_miniboxes');
	 
  if(el.length){
   el.each(function(index, element) {
         
    var child	= jQuery(element).children('.fotofly_fn_minibox');
    
    child.css({height:'auto'});
    // Get an array of all element heights
    
    var W 		= jQuery(window).width();
    if(W > 460){
     var elementHeights = child.map(function() {return jQuery(this).outerHeight();}).get();
    
     // Math.max takes a variable number of arguments
     // `apply` is equivalent to passing each height as an argument
     var maxHeight 		= Math.max.apply(null, elementHeights);
     
     // Set each height to the max height
     child.css({height:maxHeight+'px'}); 
    }
   });  
  }
 }
// -----------------------------------------------------
// -------------------   SEARCH    ---------------------
// -----------------------------------------------------
function fotofly_fn_search(){
	"use strict";
	var btn			= jQuery('.header_helper ul li.search > a');
	var searchBox	= jQuery('.fotofly_fn_search');
	
	btn.on('click',function(){
		if(searchBox.hasClass('opened')){
			searchBox.removeClass('opened');
			btn.removeClass('opened');
		}else{
			searchBox.addClass('opened');
			btn.addClass('opened');
		}return false;
	});
	jQuery(window).on('click',function() {
		searchBox.removeClass('opened');
		btn.removeClass('opened');
	});

	searchBox.on('click',function(event){
		event.stopPropagation();
	});
}
// -----------------------------------------------------
// ---------------   HAMBURGER MENU    -----------------
// -----------------------------------------------------
function fotofly_fn_mMenuDisplay(){
	"use strict";
	var W 		= jQuery(window).width();
	var ham		= jQuery('.header_helper ul li .hamburger');
	var mobNav	= jQuery('.fotofly_fn_mobilemenu_wrap');
	if(W>1040){
		mobNav.hide();
		ham.removeClass('is-active');
	}
}
// -----------------------------------------------------
// ---------------   HAMBURGER MENU    -----------------
// -----------------------------------------------------
function fotofly_fn_hamburgermenu(){
	"use strict";
	
	var mobNav			= jQuery('.fotofly_fn_mobilemenu_wrap');
	
	var header1 		= jQuery('.fotofly_fn_header');
	var header2		 	= jQuery('.fotofly_fn_header__one');
	
	
	// check for skin of header
	var wrapper		= jQuery('.fotofly_fn_wrapper_all');
	var $data 		= wrapper.data('nav-skin');
	var h1 			= header1.outerHeight();
	var h2 			= header2.outerHeight();
	if($data === 'transdark'){
		mobNav.css({backgroundColor:'#0d0d0d'});
	}
	if($data === 'nonedark'){
		mobNav.css({backgroundColor:'#fff'});
	}
	if($data === 'transdark' || $data === 'nonedark'){
		
		mobNav.addClass('dark');
		if(header1.length){
			mobNav.css({paddingTop:h1});
		}else if(header2.length){
			mobNav.css({paddingTop:h2});
		}else{
			mobNav.css({paddingTop:'0px'});
		}
	}else if($data === 'translight' || $data === 'nonelight'){
		if(header1.length){
			mobNav.css({paddingTop:h1});
		}else if(header2.length){
			mobNav.css({paddingTop:h2});
		}else{
			mobNav.css({paddingTop:'0px'});
		}
	}
	
	// check if theme's border = big
	if(borderStyle === 'big'){
		mobNav.css({paddingTop:0});
		if(header1.length){
			wrapper.css({paddingTop:h1});
		}else if(header2.length){
			wrapper.css({paddingTop:h2});
		}
	}
	
	// for main logo
	var flogo 		= jQuery('.fotofly_fn_flogo');
	var fixedNav 	= jQuery('.fotofly_fn_vertnav');
	var fixedBG 	= fixedNav.data('menu-bg');
	flogo.each(function(){
		var element = jQuery(this);
		var logoDarkColor = element.data('dark-color');
		var logoLightColor = element.data('light-color');
		if(fixedNav.length){
			if(fixedBG === 'white' || fixedBG === 'gray' || fixedBG === 'translight'){
				element.css({color:logoLightColor});
			}else if(fixedBG === 'black' || fixedBG === 'transdark'){
				element.css({color:logoDarkColor});
			}
		}else{
			if($data === 'dark' || $data === 'transdark' || $data === 'nonedark'){
				element.css({color:logoLightColor});
			}else if($data === 'light' || $data === 'translight' || $data === 'nonelight'){
				element.css({color:logoDarkColor});
			}
		}
	});
}
// -----------------------------------------------------
// -------------   VERTICAL MENU NOTICE    -------------
// -----------------------------------------------------
function fotofly_fn_vertmenu_notice(){
	"use strict";
	var close = jQuery("#floatingmes");
	var block = jQuery(".fotofly_fn_vertmenu_left");
	
	// theme's border
	var a			= '';
	var b			= '';
	var header1 	= jQuery('.fotofly_fn_header');
	var header2		= jQuery('.fotofly_fn_header__one');
	var header1H	= header1.height();
	var header2H	= header2.height();
	
	if(borderStyle === 'big'){
		if(header1.length){
			a = header1H;
			b = 60;
		}else if(header2.length){
			a = header2H;
			b = 60;
		}
	}else if(borderStyle === 'small'){
		a = b = 15;
	}else{
		a = b = 0;
	}
	
	block.on('mousemove',function(pos){
		close.show(); 
		close.css('left',(pos.pageX+10-b)+'px').css('top',(pos.pageY+10-a)+'px'); 	
	}).on('mouseleave',function() {
		close.hide();
	});
}
// -----------------------------------------------------
// -----------------   HERO HEADER    ------------------
// -----------------------------------------------------
function fotofly_fn_splitscreen_h(){
	"use strict";
	var H			= jQuery(window).height();
	var W			= jQuery(window).width();
	var nav			= jQuery('.fotofly_fn_header');
	var nav2		= jQuery('.fotofly_fn_header__one');
	var navH		= nav.height();
	var nav2H		= nav2.height();
	var splitLeft	= jQuery('.fotofly_fn_page_splitleft');
	var splitRight	= jQuery('.fotofly_fn_page_splitright');
	var split		= jQuery('.fotofly_fn_page_splitscreen');
	var a			= '';
	var b			= '';
	
	// if border style = small or big
	if(borderStyle === 'small'){
		a = 30;
	}else if(borderStyle === 'big' && (W > 1040)){
		a = 60;
	}else{
		a = 0;
	}
	// check for navigation type
	if(nav.length){
		b = navH;
	}else if(nav2.length){
		b = nav2H;
	}
	// split height
	splitLeft.css({height:H - b-a});
	splitRight.css({height:H - b-a});
	split.css({minHeight:(H - b-a)});
	
	if(W > 768){splitRight.css({height:H-b-a});}else{splitRight.css({height:'auto'});}
	
	// split width	
	var wrapper		= split.width();
	splitLeft.css({width:wrapper/2});
	splitRight.css({width:wrapper/2});
	
}
// -----------------------------------------------------
// -----------------   HERO HEADER    ------------------
// -----------------------------------------------------
function fotofly_fn_heroheader(){
	"use strict";
	
	var hero					= jQuery('.fotofly_fn_heroheader');
	
	hero.each(function(){
		var element				= jQuery(this);
		
		var bgColor				= element.data('bg-color');
		var bgOpacity			= element.data('bg-opacity');
		var textColor			= element.data('text-color');
		
		var content				= element.find('.heroheader_content_wrap');
		var background			= element.find('.heroheader_bg_wrap .overlay_color');
		
		background.css({backgroundColor:bgColor,opacity:bgOpacity});
		
		content.css({color: textColor});
		content.find('a').css({color: textColor});
		
	});
}
function fotofly_fn_heroheader_h(){
	"use strict";
	var hero					= jQuery('.fotofly_fn_heroheader');
	var H						= jQuery(window).height();
	hero.each(function(){
		var element				= jQuery(this);
		var WHOption			= element.data('window-height');
		var content				= element.find('.heroheader_content_wrap');
		var paddingTop			= element.data('padding-top');
		var paddingBottom		= element.data('padding-bottom');
		if(WHOption.length && WHOption === 'on'){
			content.css({height:H});
		}else{
			content.css({paddingTop:paddingTop,paddingBottom:paddingBottom});
		}
	});
}
// -----------------------------------------------------
// ---------------   STICKY SIDEBAR    -----------------
// -----------------------------------------------------
function fotofly_fn_sticky_sidebar(){
	"use strict";
	
	var sticky	= jQuery('.sticky_sidebar');
	
	sticky.each(function(){
		var element = jQuery(this);
		element.theiaStickySidebar({
			containerSelector: '', // The sidebar's container element. If not specified, it defaults to the sidebar's parent.
			additionalMarginTop: 20,
			additionalMarginBottom: 20,
			updateSidebarHeight: true, // Updates the sidebar's height. Use this if the background isn't showing properly, for example.
			minWidth: 979, // The sidebar returns to normal if its width is below this value. 
		});
	});
	
	
	
}
// -----------------------------------------------------
// --------------    MAGNIFIC POPUP    -----------------
// -----------------------------------------------------
function fotofly_fn_magnific_popup2(){
	"use strict";
	
	jQuery('.open-popup-link').magnificPopup({
		type:'inline',
		midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	});
	
	
	
	jQuery('.fotofly_fn_popup_gallery').each(function() { // the containers for all your galleries
		jQuery(this).magnificPopup({
			delegate: 'a', // the selector for gallery item
			type: 'image',
			gallery: {
			  enabled:true
			},
		});
	});
	
	
	jQuery('.gallery_zoom').each(function() { // the containers for all your galleries
		jQuery(this).magnificPopup({
			delegate: 'a.zoom', // the selector for gallery item
			type: 'image',
			gallery: {
			  enabled:true
			},
			removalDelay: 300,
			mainClass: 'mfp-fade'
		});
		
	});
}
// -----------------------------------------------------
// --------------------    JARALLAX    -----------------
// -----------------------------------------------------
function fotofly_fn_jarallax(){
	"use strict";
	
	jQuery('.fotofly_fn_jarallax').each(function(){
		var element			= jQuery(this);
		var	customSpeed		= element.data('speed');
		
		if(customSpeed !== "undefined" && customSpeed !== ""){
			customSpeed = customSpeed;
		}else{
			customSpeed 	= 0.1;
		}
		element.jarallax({
			speed: customSpeed
		});
	});
	
}
// -----------------------------------------------------
// --------------    ISOTOPE MASONRY    ----------------
// -----------------------------------------------------
function fotofly_fl_isotope(){
	"use strict";
	var isotope = jQuery('.fotofly_fn_masonry');
	
	isotope.each(function(){
		jQuery(this).isotope({
		  itemSelector: '.fotofly_fn_masonry_in',
		  masonry: {

		  }
		});
	});
	
}
// -----------------------------------------------------
// -------------    VERTICAL MENU OPENER ---------------
// -----------------------------------------------------
function fotofly_fn_vermenuopener(){
	"use strict";
	
	var btn			= jQuery('.header_helper ul li.trigger a');
	var verMenu		= jQuery('.fotofly_fn_vertmenu');
	var verMenuLeft	= jQuery('.fotofly_fn_vertmenu_left');
	var close		= jQuery("#floatingmes");
	
	btn.on('click',function(){
		verMenu.addClass('opened');
		verMenuLeft.addClass('opened');
		jQuery('#fp-nav').hide();
		return false;
	});
	
	verMenuLeft.on('click',function(){
		verMenu.removeClass('opened');
		verMenuLeft.removeClass('opened');
		close.hide();
		setTimeout(function(){
			jQuery('#fp-nav').show();
		},500);
		return false;
	});
	
}
function fotofly_fn_vermenuopener_W(){
	"use strict";
	var verMenu		= jQuery('.fotofly_fn_vertmenu');
	var verMenuLeft	= jQuery('.fotofly_fn_vertmenu_left');
	var W			= jQuery(window).width();
	var close		= jQuery("#floatingmes");
	
	if(W<1020){
		verMenu.removeClass('opened');
		verMenuLeft.removeClass('opened');
		close.hide();
	}
	
}
// -----------------------------------------------------
// -------------    VERTICAL MENU SCROLL ---------------
// -----------------------------------------------------
function fotofly_fl_vermenuscroll(){
	"use strict";
	
	var H			= jQuery(window).height();
	var W			= jQuery(window).width();
	var scrollable	= jQuery('.scrollable');
	
	var verMenu		= jQuery('.fotofly_fn_vertmenu');
	
	verMenu.css({height:H});
	
	scrollable.each(function(){
		var element	= jQuery(this);
		var wH		= jQuery(window).height();
		if(element.hasClass('fotofly_fn_vertnav_menupart') || element.hasClass('fotofly_fn_vertmenu_content')){
			if(borderStyle === 'small'){
				element.css({height: wH-30});
			}else if(borderStyle === 'big'){
				if(W > 1040){element.css({height: wH-120});}else{element.css({height:wH});}
			}else{
				element.css({height: H});
			}
		}else{
			element.css({height: wH});
		}

		element.niceScroll({
			touchbehavior:false,
			cursorwidth:0,
			autohidemode:true,
			cursorborder:"0px solid #eee"
		});
	});
	
}
// -----------------------------------------------------
// -------------    VERTICAL SUBMENU    ----------------
// -----------------------------------------------------
function fotofly_fn_versubmenu(){
	"use strict";
	
	var nav 					= jQuery('ul.nav_ver, .widget_block ul.menu');
	
	nav.each(function(){
		jQuery(this).find('a').on('click', function(e){
			var element 			= jQuery(this);
			var parentItem			= element.parent('li');
			var parentItems			= element.parents('li');
			var parentUls			= parentItem.parents('ul.sub_menu');
			var subMenu				= element.next();
			var allSubMenusParents 	= nav.find('li');

			allSubMenusParents.removeClass('opened');

			if(subMenu.length){
				fotofly_fl_vermenuscroll();
				e.preventDefault();

				if(!(subMenu.parent('li').hasClass('active'))){
					if(!(parentItems.hasClass('opened'))){parentItems.addClass('opened');}

					allSubMenusParents.each(function(){
						var el = jQuery(this);
						if(!el.hasClass('opened')){el.find('ul.sub_menu').slideUp();}
					});

					allSubMenusParents.removeClass('active');
					parentUls.parent('li').addClass('active');
					subMenu.parent('li').addClass('active');
					subMenu.slideDown();


				}else{
					subMenu.parent('li').removeClass('active');
					subMenu.slideUp();
				}
				return false;
			}
		});
	});
}
// -----------------------------------------------------
// --------------     HEADER RESPONSIVE     ------------
// -----------------------------------------------------
function fotofly_fn_headerresponsive(){
	"use strict";
	
	var helperW				= jQuery('.fotofly_fn_header .header_helper').width();
	var headerList			= jQuery('.fotofly_fn_header .header_list');
	
	
	headerList.css({paddingRight:helperW,paddingLeft:helperW});
}
// -----------------------------------------------------
// --------------     MAIN FLEXSLIDER     --------------
// -----------------------------------------------------
function fotofly_fn_mainslider(){
	"use strict";
	
	
	// for intro page flexslider
	var flexslider2	= jQuery('.fotofly_fn_flexslider');
	flexslider2.each(function(){
		var el = jQuery(this),
			delay = el.data('delay');
		el.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: false,
			slideshowSpeed: delay,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	// for portfolio single (slider)
	var flexslider3	= jQuery('.fotofly_fn_portfolio_single.slider .list');
	flexslider3.each(function(){
		var el = jQuery(this);
		el.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: true,
			slideshowSpeed: 4000,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	// for portfolio single (full-slider)
	var flexslider4	= jQuery('.fotofly_fn_portfolio_single.full-slider .list');
	flexslider4.each(function(){
		var el = jQuery(this);
		el.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: true,
			slideshowSpeed: 4000,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	// for portfolio single (mono)
	var flexslider5	= jQuery('.fotofly_fn_psingle_mono .mono_slider');
	flexslider5.each(function(){
		var el = jQuery(this);
		el.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: false,
			slideshowSpeed: 4000,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	var flexslider6	= jQuery('.fotofly_fn_gsingle_list .flexslider');
	flexslider6.each(function(){
		var el = jQuery(this);
		el.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: true,
			slideshowSpeed: 4000,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	var flexslider7	= jQuery('.post-type-wrapper .flexslider');
		flexslider7.each(function(){
			var el = jQuery(this);
			el.flexslider({
				animation: "fade",
				controlNav: false,
				directionNav: true,
				slideshowSpeed: 4000,
				pauseOnAction: true,
				after: function(slider){
					if(!slider.playing){
						slider.play();
					}
				}
			});
		});
}
function fotofly_fn_mainslider_height(){
	"use strict";
	
	var H 				= jQuery(window).height();
	var ulli 			= jQuery('.fotofly_fn_flexslider ul.slides > li, .fotofly_fn_portfolio_single.slider ul.slides > li, .fotofly_fn_portfolio_single.full-slider .list ul.slides > li, .fotofly_fn_gsingle_list ul.slides > li, .post-type-wrapper ul.slides > li');
	var mainSlider		= jQuery('.fotofly_fn_mainslider');
	
	ulli.css({height:H});
	mainSlider.css({height:H});
}
// -----------------------------------------------------
// ---------------    IMAGE TO SVG    ------------------
// -----------------------------------------------------
function fotofly_fn_imgtosvg(){
	"use strict";
	
	jQuery('img.fotofly_fn_svg').each(function(){
		
		var $img 		= jQuery(this);
		var imgClass	= $img.attr('class');
		var imgURL		= $img.attr('src');

		jQuery.get(imgURL, function(data) {
			// Get the SVG tag, ignore the rest
			var $svg = jQuery(data).find('svg');

			// Add replaced image's classes to the new SVG
			if(typeof imgClass !== 'undefined') {
				$svg = $svg.attr('class', imgClass+' replaced-svg');
			}

			// Remove any invalid XML tags as per http://validator.w3.org
			$svg = $svg.removeAttr('xmlns:a');

			// Replace image with new SVG
			$img.replaceWith($svg);

		}, 'xml');

	});
}
// -----------------------------------------------------
// --------------------    TOTOP    --------------------
// -----------------------------------------------------
function fotofly_fn_totop(){
	"use strict";
	var totop		= jQuery('a.totop');
	if(totop.length){
		totop.on('click', function(e) {
			e.preventDefault();		
			jQuery("html, body").animate({ scrollTop: 0 }, 'slow');
			return false;
		});
	}
	
}
function fotofly_fn_totop_myhide(){
	"use strict";
	
	var totop		= jQuery('a.totop');
	var audio		= jQuery('.fotofly_fn_audio_controls');
	
	if(totop.length){
		var topOffSet 	= totop.offset().top;
		if(topOffSet > 1000){
			totop.addClass('opened');
			audio.addClass('totoped');
		}else{
			totop.removeClass('opened');
			audio.removeClass('totoped');
		}
	}
}