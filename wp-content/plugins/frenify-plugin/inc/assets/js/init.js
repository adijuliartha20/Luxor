/*
 * Copyright (c) 2017 Frenify
 * Author: Frenify
 * This file is made for CURRENT TEMPLATE
*/


jQuery(document).ready(function(){

	"use strict";
	
	// here all ready functions
	
	
	
	fotofly_fn_w_imgafterbefore();
	fotofly_fn_w_customtitle();
	frenify_folder_slider_build();
	fotofly_fn_w_imghotspot();
	fotofly_fn_w_hoverwidth();
	fotofly_fn_w_flipbox_h();
	fotofly_fn_w_custompost_carousel();
	fotofly_fn_w_categorycolumn_h();
	fotofly_fn_w_categorycolumn();
	fotofly_fn_w_multiscroll();
	fotofly_fn_w_multiscroll_h();
	fotofly_fn_w_serviceCarousel();
	fotofly_fn_w_serviceCarousel_calc();
	fotofly_fn_w_portfoliocustom();
	fotofly_fn_w_alertbox();
	fotofly_fn_w_calltoaction();
	fotofly_fn_w_aboutme_h();
	fotofly_fn_w_magnific_popup();
	fotofly_fn_w_galleryblockFullpagejs();
	fotofly_fn_w_all_flexslider();
	fotofly_fn_w_all_flexslider_h();
	fotofly_fn_w_kenburns();
	fotofly_fn_w_kenburns_h();
	fotofly_fn_w_overlay_jarallax();
	fotofly_fn_w_fullwidth_min_height();
	fotofly_fn_w_equal_cols();
	fotofly_fn_w_animation();
	fotofly_fn_w_shortcodes();
	
	
	jQuery(window).on('resize',function(e){
		e.preventDefault();
		fotofly_fn_w_flipbox_h();
		fotofly_fn_w_categorycolumn_h();
		fotofly_fn_w_multiscroll_h();
		fotofly_fn_w_all_flexslider_h();
		fotofly_fn_w_aboutslider();
		fotofly_fn_w_serviceCarousel_calc();
		fotofly_fn_w_portfoliocustom();
		fotofly_fn_w_aboutme_h();
		fotofly_fn_w_kenburns_h();
		fotofly_fn_w_fullwidth_min_height();
		fotofly_fn_w_equal_cols();
	});
	
	jQuery(window).load(function(e){
		e.preventDefault();
		fotofly_fn_w_unitinfo_carousel();
		fotofly_fn_w_portfoliocustom();
		fotofly_fn_w_all_flexslider_h();
		setTimeout(function(){fotofly_fn_w_aboutslider();},200);
	});
	
});
function fotofly_fn_w_unitinfo_carousel(){
	"use strict";
	var element 		= jQuery('.fotofly_fn_unit_info');
	element.each(function(){
		var el 			= jQuery(this);
		var myCarousel 	= el.find('.owl-carousel');
		myCarousel.owlCarousel({
			margin:5,
			loop:false,
			autoWidth:true,
			items:4,
			nav: false,
			autoplay:false,
		});
		var prev = el.find('.owl_control > div:nth-child(1)');
		var next = el.find('.owl_control > div:nth-child(2)');
		prev.on('click',function(){
			myCarousel.trigger('prev.owl');
			return false;
		});
		next.on('click',function(){
			myCarousel.trigger('next.owl');
			return false;
		});
	});
	
}
// -----------------------------------------------------
// -------------    IMAGE AFTER BEFORE      ------------
// -----------------------------------------------------
function fotofly_fn_w_imgafterbefore(){
	"use strict";
	jQuery(".twentytwenty-container[data-orientation!='vertical']").twentytwenty({default_offset_pct: 0.5});
    jQuery(".twentytwenty-container[data-orientation='vertical']").twentytwenty({default_offset_pct: 0.5, orientation: 'vertical'});
}
// -----------------------------------------------------
// ----------------    CUSTOM TITLE      ---------------
// -----------------------------------------------------
function fotofly_fn_w_customtitle(){
	"use strict";
	var title 		= jQuery('.fotofly_fn_title');
	title.each(function(){
		var element = jQuery(this);
		var color	= element.data('text-color');
		var span	= element.find('span');
		span.css({color:color});
	});
}
// -----------------------------------------------------
// ----------------    IMAGE HOTSPOT      --------------
// -----------------------------------------------------
function fotofly_fn_w_imghotspot(){
	"use strict";
	var container 		= jQuery('.fotofly_fn_hotspot_container_wrap');
	container.each(function(){
		var element 	= jQuery(this);
		var child		= element.find('.fotofly_fn_hotspot');
		child.each(function(){
			var el		= jQuery(this);
			var span	= el.find('span');
			var tool	= el.find('.hs_tool');
			var top		= el.data('top');
			var left	= el.data('left');
			var opener	= el.data('hs-tooltip');
			var bgcol	= el.data('bg-color');
			var textcol	= el.data('text-color');
			el.css({left:left,top:top,backgroundColor:bgcol,color:textcol});
			if(opener === 'click'){
				span.on('click',function(){
					if(!tool.hasClass('opened')){
						tool.addClass('opened');
					}else{
						tool.removeClass('opened');
					}
				});
			}
		});
	});
}
// -----------------------------------------------------
// -----------------    HOVER WIDTH      ---------------
// -----------------------------------------------------
function fotofly_fn_w_hoverwidth(){
	"use strict";
	var container		= jQuery('.fotofly_fn_hover_width');
	container.each(function(){
		var element 	= jQuery(this);
		var children 	= element.find('.item_middle li');
		children.on('mouseenter',function(){
			var child 	= jQuery(this);
			children.removeClass('current');
			child.addClass('current');
		});
	});
}
// -----------------------------------------------------
// ----------------    FLIPBOX HEIGHT     --------------
// -----------------------------------------------------
function fotofly_fn_w_flipbox_h(){
	"use strict";
	
	var el 		= jQuery('.flip_h_boxes');
	 
	if(el.length){
		el.each(function(index, element) {
			var child	= jQuery(element).children('.flip_h_box');
			child.css({height:'auto'});
			var W 		= jQuery(window).width();
			if(W > 1){
				var elementHeights 	= child.map(function() {return jQuery(this).outerHeight();}).get();
				var maxHeight 		= Math.max.apply(null, elementHeights);
				child.css({height:maxHeight+'px'});
				
				// experiment
				var parent 		= jQuery(element).parent();
				var inner		= parent.find('.inner');
				var frontSide	= parent.find('.fn_flipbox_frontside');
				var backSide	= parent.find('.fn_flipbox_backside');

				if(maxHeight > 400){
					inner.css({height:maxHeight+'px'});
					frontSide.css({minHeight:maxHeight+'px'});
					backSide.css({minHeight:maxHeight+'px'});
				}else{
					inner.css({height:'400px'});
					frontSide.css({minHeight:'400px'});
					backSide.css({minHeight:'400px'});
				}
			}
		});  
	}
}
// -----------------------------------------------------
// --------------    CUSTOMPOST CAROUSEL    ------------
// -----------------------------------------------------
function fotofly_fn_w_custompost_carousel(){
	"use strict";
	var parentCarousel = jQuery('.fotofly_fn_w_custompost_carousel_wrap');
	parentCarousel.each(function(){
		var element = jQuery(this);
		var carousel = element.find('.owl-carousel');
		carousel.each(function(){
			var el = jQuery(this);
			el.owlCarousel({
				margin:31,
				loop:true,
				items: 5,
				dots: false,
				nav: false,
				autoplay:true,
				autoplayTimeout:4000,
				responsive:{
					0:{items:1},
					768:{items:2},
					1200:{items:3},
					1300:{items:4},
					1400:{items:5}
				}
			});

			var prev = element.find('.main_title_holder .owl_control > div:nth-child(1)');
			var next = element.find('.main_title_holder .owl_control > div:nth-child(2)');
			prev.on('click',function(){
				el.trigger('prev.owl');
				return false;
			});
			next.on('click',function(){
				el.trigger('next.owl');
				return false;
			});
		});
	});
	var parentCarousel2 = jQuery('.fotofly_fn_w_custompost_carousel_2');
	parentCarousel2.each(function(){
		var element = jQuery(this);
		var carousel = element.find('.owl-carousel');
		carousel.each(function(){
			var el = jQuery(this);
			el.owlCarousel({
				margin: 20,
				loop: true,
				dots: false,
				nav: false,
				autoplay: true,
				autoplayTimeout:4000,
				autoWidth: true
			});

			var prev = element.find('.main_title_holder .owl_control > div:nth-child(1)');
			var next = element.find('.main_title_holder .owl_control > div:nth-child(2)');
			prev.on('click',function(){
				el.trigger('prev.owl');
				return false;
			});
			next.on('click',function(){
				el.trigger('next.owl');
				return false;
			});
		});
	});
}
// -----------------------------------------------------
// ----------------    CATEGORY COLUMN    --------------
// -----------------------------------------------------
function fotofly_fn_w_categorycolumn_h(){
	"use strict";
	
	var H 					= jQuery(window).height();
	var category			= jQuery('.fotofly_fn_category_column_portfolio, .fotofly_fn_category_column_gallery');
	
	// CHECK FOR BORDER
	var borderStyle	= jQuery('.fotofly_fn_wrapper_all').data('border-style');
	var borderSize	= 0;
	if(borderStyle === 'small'){
		borderSize = 30;
	}else if(borderStyle === 'big'){
		borderSize = 80;
	}
	category.each(function(){
		var eachCategory 	= jQuery(this);
		var eachCategoryW 	= eachCategory.width();
		var list		 	= eachCategory.find('.list');
		var listLength 		= list.length;
		var defaultIndex	= '';

		// 1 column
		if(listLength === 1){defaultIndex = 1;}
		// 2 columns
		else if(listLength === 2){defaultIndex = 1/2;}
		// 3 columns
		else if(listLength === 3){
			if(eachCategoryW<1040){
				defaultIndex = 1/2;
			}else{
				defaultIndex = 1/3;
			}
		}
		// 4 columns and more
		else if(listLength >= 4){
			if(eachCategoryW > 1040 && eachCategoryW < 1300){
				defaultIndex = 1/3;
			}else if(eachCategoryW <= 1040){
				defaultIndex = 1/2;
			}else{
				defaultIndex = 1/4;
			}
		}
		var defaultWidth = eachCategoryW * defaultIndex;
		var hoveredWidth = eachCategoryW * defaultIndex * 1.3;

		list.css({width:defaultWidth,height:H-borderSize});

		list.each(function(){
			var element2 = jQuery(this);
			element2.on('mouseenter',function(){
				element2.css({width: hoveredWidth});
			}).on('mouseleave',function(){
				element2.css({width: defaultWidth});
			});
		});
	});
}
function fotofly_fn_w_categorycolumn(){
	"use strict";
	
	jQuery(".fotofly_fn_category_column_portfolio, .fotofly_fn_category_column_gallery").niceScroll({
		cursorcolor: "#111", // change cursor color in hex
        cursoropacitymin: 0, // change opacity when cursor is inactive (scrollabar "hidden" state), range from 1 to 0
        cursoropacitymax: 1, // change opacity when cursor is active (scrollabar "visible" state), range from 1 to 0
        cursorwidth: "0px", // cursor width in pixel (you can also write "5px")
        cursorborder: "none", // css definition for cursor border
        cursorborderradius: "3px", // border radius in pixel for cursor	
		background: "rgba(0,0,0,0.15)",
        autohidemode: false, // how hide the scrollbar works, possible values: 
	});
}
// -----------------------------------------------------
// ----------------    FOLDER SLIDER    ----------------
// -----------------------------------------------------
function frenify_folder_slider_build(){
	"use strict";
	
	jQuery('.frenify-folder-slider').each(function(){
		var folder			= jQuery(this);
		var items 			= folder.children();
		var itemCopy 		= items.first().clone().addClass('backup');
		var backupUrl		= folder.data('backupurl');
		var animationType	= folder.data('animation-type');

		// add thumbnail if its url exists
		if(backupUrl !== ''){itemCopy.find('img').attr('src', backupUrl);}

		// add img as background to items.
		items.each(function(){
			var el 		= jQuery(this);
			var img 	= el.find('img');
			var imgUrl 	= img.attr('src');
			el.css({backgroundImage:'url('+imgUrl+')'});
		});

		items.empty(); // remove images from items
		items.addClass('item').wrapAll('<div class="folder_fn_wrap"></div>');
		folder.append(itemCopy);

		var currentIndex = 0, trigger,
		itemAmt 	= items.length,
		itemWrap	= folder.find('.folder_fn_wrap'),
		item1 		= itemWrap.children().eq(0),
		item2 		= itemWrap.children().eq(1),
		item3 		= itemWrap.children().eq(2),
		item4 		= itemWrap.children().eq(3);
		
		var clickDisabled = false;

		item4.addClass('ae'); // initial hiding last child
		
		// function animate
		var cycleItems = function() {
			if(currentIndex === 0){
				item1.removeClass('ac ad ae').addClass('ab');
				item2.removeClass('ab ad ae').addClass('ac');
				item3.removeClass('ab ac ae').addClass('ad');
				item4.removeClass('ab ac ad').addClass('hideme'); setTimeout(function(){item4.removeClass('hideme').addClass('ae');}, 500);
			}
			else if(currentIndex === 1){
				item1.removeClass('ab ac ad').addClass('hideme'); setTimeout(function(){item1.removeClass('hideme').addClass('ae');}, 500);
				item2.removeClass('ac ad ae').addClass('ab');
				item3.removeClass('ab ad ae').addClass('ac');
				item4.removeClass('ab ac ae').addClass('ad');
			}
			else if(currentIndex === 2){
				item1.removeClass('ab ac ae').addClass('ad');
				item2.removeClass('ab ac ad').addClass('hideme'); setTimeout(function(){item2.removeClass('hideme').addClass('ae');}, 500);
				item3.removeClass('ac ad ae').addClass('ab');
				item4.removeClass('ab ad ae').addClass('ac');
			}
			else if(currentIndex === 3){
				item1.removeClass('ab ad ae').addClass('ac');
				item2.removeClass('ab ac ae').addClass('ad');
				item3.removeClass('ab ac ad').addClass('hideme'); setTimeout(function(){item3.removeClass('hideme').addClass('ae');}, 500);
				item4.removeClass('ac ad ae').addClass('ab');
			}
		};
		
		// check for number of posts
		if(itemAmt > 3){
			// action
			if(animationType === 'hover'){
				itemWrap.on('mouseenter', function() {
					trigger = setInterval(function() {
						currentIndex += 1;
						if (currentIndex > itemAmt - 1) {
							currentIndex = 0;
						}
						cycleItems();
					}, 1500);
				}).on('mouseleave', function(){
					clearTimeout(trigger);
				});
			}
			else if(animationType === 'click'){
				itemWrap.on('click', function() {

					if (clickDisabled === false){
						currentIndex += 1;
						if (currentIndex > itemAmt - 1) {
							currentIndex = 0;
						}
						cycleItems();

						// enable click after 1 second
						clickDisabled = true;
						setTimeout(function(){clickDisabled = false;}, 500);
					}

				});
			}
		}
		
		
	});
}
// -----------------------------------------------------
// -----------    MULTISCROLL (SHORTCODE)    -----------
// -----------------------------------------------------
function fotofly_fn_w_multiscroll(){
	"use strict";
	
	var el 		= jQuery('.fotofly_fn_w_multi_scroll');
	var sticky	= jQuery('.fotofly_fn_header_sticky');
	if(el.length){
		sticky.removeClass('on');
		el.multiscroll({
			css3: true,
			scrollingSpeed: 800
		});
	}
}
function fotofly_fn_w_multiscroll_h(){
	"use strict";
	
	var el 	= jQuery('.fotofly_fn_w_multi_scroll');
	var H	= jQuery(window).height();
	el.css({height:H});
}
// -----------------------------------------------------
// -----------    ABOUT SLIDER (SHORTCODE)    ----------
// -----------------------------------------------------
function fotofly_fn_w_aboutslider(){
	"use strict";
	
	var leftSideH 	= jQuery('.fotofly_fn_aboutslider .about_slider').height();
	var rightSide	= jQuery('.fotofly_fn_aboutslider .about_content');
	rightSide.css({minHeight:leftSideH});
}
// -----------------------------------------------------
// -------    SERVICE CAROUSEL (SHORTCODE)    ----------
// -----------------------------------------------------
function fotofly_fn_w_serviceCarousel(){
	"use strict";
	
	var carousel = jQuery('.fotofly_fn_service_carousel .owl-carousel');
	carousel.each(function(){
		jQuery(this).owlCarousel({
			margin:30,
			loop:true,
			items: 3,
			dots: false,
			nav: false,
			autoplay:true,
    		autoplayTimeout:4000,
			responsive:{
				0:{
					items:1,
				},
				768:{
					items:2,
				},
				1200:{
					items:3,
				}
			}
		});
	});
	
	var carouselItem 		= carousel.find('.service_item');
	
	carouselItem.each(function(){
		var el 				= jQuery(this);
		var list 			= el.find('.list_holder');
		var elementH 		= el.height();
		var elementContent 	= el.find('.content_holder');
		
		elementContent.on('mouseenter',function(){
			list.slideDown();
			el.addClass('opened');
			setTimeout(function(){NS_Destroy();NS();},500);
		}).on('mouseleave',function(){
			list.slideUp();
			el.removeClass('opened');
			setTimeout(function(){NS_Destroy();NS();},500);
		});
		elementContent.css({maxHeight:elementH});
		NS();
		
		// NiceScroll Destroyer
		function NS_Destroy(){
			elementContent.getNiceScroll().remove();
		}
		// NiceScroll
		function NS(){
			elementContent.niceScroll({
				touchbehavior:false,
				cursorwidth:0,
				autohidemode:true,
				cursorborder:"0px solid #333"
			});
		}
		
	});
	
}
function fotofly_fn_w_serviceCarousel_calc(){
	"use strict";
	
	var carousel 			= jQuery('.fotofly_fn_service_carousel .owl-carousel');
	var carouselItem 		= carousel.find('.service_item');
	
	carouselItem.each(function(){
		var el 				= jQuery(this);
		var elementH 		= el.height();
		var elementContent 	= el.find('.content_holder');
		elementContent.css({maxHeight:elementH});
	});
}
// -----------------------------------------------------
// -------    PORTFOLIO CUSTOM (SHORTCODE)    ----------
// -----------------------------------------------------
function fotofly_fn_w_portfoliocustom(){
	"use strict";
	/* for triple layout */
	var ul1H 		= jQuery('.fotofly_fn_w_portfoliocustom_triple ul.w_portfolio_list').height();
	var discover1 	= jQuery('.fotofly_fn_w_portfoliocustom_triple .discover .in');
	var li1H 		= jQuery('.fotofly_fn_w_portfoliocustom_triple ul.w_portfolio_list > li:nth-child(2)').height();
	discover1.css({height: ul1H - li1H - 40});
	
	/* for quadruple layout */
	var ul3H 		= jQuery('.fotofly_fn_w_port_quadruple_col:first-child').height();
	var li3H 		= jQuery('.fotofly_fn_w_port_quadruple_col.mixed .item').height();
	var discover3 	= jQuery('.fotofly_fn_w_portfoliocustom_quadruple .discover .in');
	discover3.css({height: ul3H - li3H - 40});
	
	/* for quintuple layout */
	var ul2H 		= jQuery('.fotofly_fn_w_port_quintuple_col:first-child').height();
	var li2H 		= jQuery('.fotofly_fn_w_port_quintuple_col.mixed .item').height();
	var discover2 	= jQuery('.fotofly_fn_w_portfoliocustom_quintuple .discover .in');
	discover2.css({height: ul2H - li2H - 40});
}

// -----------------------------------------------------
// --------------------    ALERT    --------------------
// -----------------------------------------------------
function fotofly_fn_w_alertbox(){
	"use strict";
	
	jQuery('.fotofly_fn_alert').each(function(index, element) {
		jQuery(element).find('span.close_button').on('click', function(e){
			e.preventDefault();
			jQuery(element).children().animate({opacity:0});
			jQuery(element).delay(200).slideUp();
			return false;
		});
		
		var alert 				= jQuery(element);
		var animation 			= alert.data('animation-type');
		var delay 				= alert.data('animationduration');
		
		alert.waypoint({
			handler: function(){
						setTimeout(function(){
							alert.removeClass('hideforanimation').addClass(animation);
							alert.removeClass('frenify-animated');
						}, delay);
					},
			offset: '90%'
		});
		
		if(alert.hasClass('custom')){
			var color 		= alert.data('text-color');
			var title 		= alert.find('.alert_content h3');
			var content 	= alert.find('.alert_content p');
			var closeBtnA	= alert.find('.inner .close_button .after');
			var closeBtnB	= alert.find('.inner .close_button .before');
			closeBtnA.css({backgroundColor:color});
			closeBtnB.css({backgroundColor:color});
			title.css({color:color});
			content.css({color:color});
		}
	});
}
// -----------------------------------------------------
// --------------    CALL TO ACTION    -----------------
// -----------------------------------------------------
function fotofly_fn_w_calltoaction(){
	"use strict";
	var div	= jQuery('.fotofly_fn_call_to_action');
	div.each(function(){
		var element = jQuery(this);
		var btn		= element.find('a');
		var color	= element.data('text-color');
		var bgcolor	= element.data('bg-color');
		if(color.length){btn.css({color:color});}
		if(bgcolor.length){element.css({backgroundColor:bgcolor});}
	});
}
// -----------------------------------------------------
// --------------    ABOUTME (SH) HEIGHT   -------------
// -----------------------------------------------------
function fotofly_fn_w_aboutme_h(){
	"use strict";
	var W 			= jQuery(window).width();
	var aboutmeH	= jQuery('.fotofly_fn_about_me').height();
	var infoContent	= jQuery('.fotofly_fn_about_me .info_content');
	
	if(W>1040){
		infoContent.css({minHeight:aboutmeH});
	}else{
		infoContent.css({minHeight:'auto'});
	}
}
// -----------------------------------------------------
// --------------    MAGNIFIC POPUP    -----------------
// -----------------------------------------------------
function fotofly_fn_w_magnific_popup(){
	"use strict";
	
	jQuery('.open-popup-link').magnificPopup({
		type:'inline',
		midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
	});
}
// -----------------------------------------------------
// FULLPAGE JAVASCRIPT     ( used for "HALF SCREEN IMAGE / FULLSCREEN" ) 
// -----------------------------------------------------
function fotofly_fn_w_galleryblockFullpagejs(){
	"use strict";
	
	var el = jQuery('.fotofly_fn_fullpagejs');
	
	if(el.length){
		el.fullpage({
			navigation: true,
			responsiveWidth: 769,
			navigationPosition: 'right',
			afterLoad: function(){},
			onLeave: function(){}		
		});	
		
		
	}
	// for changing navigation color
	var el2 = jQuery('.fotofly_fn_galleryblock_fullscreen');
	if(el2.length){
		var body  = jQuery('body');
	
		if(!(body.hasClass('fn_fullpagejs'))){
			body.addClass('fn_fullpagejs');
		}
	}
}
// -----------------------------------------------------
// ------------------    FLEXSLIDER   ------------------
// -----------------------------------------------------
function fotofly_fn_w_all_flexslider(){
	"use strict";
	
	jQuery('.fotofly_fn_w_custompost_ribbon_wrap .flexslider').each(function() {
		jQuery(this).flexslider({
			animation: "slide",
			prevText: "",
			nextText: "",
			smoothHeight: false,
			slideshowSpeed: 5000,
			animationSpeed:1000,
			pauseOnHover:true,
			controlNav:false,
			touch:true,
			autoPlay: true
		});
	});
	
	
	jQuery('.fotofly_fn_w_cortex_slider_wrap').each(function() {
		var element	 	= jQuery(this);
		var interval 	= element.data('interval');
		var flexslider	= element.find('.flexslider');
		
		flexslider.flexslider({
			animation: "slide",
			controlNav: false,
			directionNav: true,
			slideshowSpeed: interval,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	
	jQuery('.fotofly_fn_mainslider').each(function() {
		var element	 	= jQuery(this);
		var interval 	= element.data('interval');
		var flexslider	= element.find('.flexslider');
		
		flexslider.flexslider({
			animation: "fade",
			controlNav: false,
			directionNav: true,
			slideshowSpeed: interval,
			pauseOnAction: true,
			after: function(slider){
				if(!slider.playing){
					slider.play();
				}
			}
		});
	});
	
	jQuery('.fotofly_fn_galleryblock_slider').each(function() {
		jQuery(this).flexslider({
			animation: "slide",
			prevText: "",
			nextText: "",
			smoothHeight: false,
			slideshowSpeed: 5000,
			animationSpeed:1000,
			pauseOnHover:true,
			controlNav:false,
			touch:true,
			autoPlay: true
		});
	});
	
	jQuery('.fotofly_fn_projectslider_slider').each(function() {
		jQuery(this).flexslider({
			animation: "slide",
			prevText: "",
			nextText: "",
			smoothHeight: false,
			slideshowSpeed: 5000,
			animationSpeed:1000,
			pauseOnHover:true,
			controlNav:false,
			touch:true,
			autoPlay: true
		});
	});
	jQuery('.fotofly_fn_aboutslider').each(function(){
		var element 	= jQuery(this);
		var slider		= element.find('.about_slider');
		var autoplay 	= element.data('autoplay');
		var interval 	= element.data('interval');
		slider.flexslider({
			animation: "slide",
			prevText: "",
			nextText: "",
			smoothHeight: false,
			slideshowSpeed: interval,
			animationSpeed:1000,
			pauseOnHover:true,
			controlNav:false,
			touch:true,
			autoPlay: autoplay
		});
	});
}
function fotofly_fn_w_all_flexslider_h(){
	"use strict";
	var H 				= jQuery(window).height();
	var ulli 			= jQuery('.fotofly_fn_w_custompost_ribbon_wrap ul.slides > li, .fotofly_fn_w_cortex_slider_wrap ul.slides > li,.fotofly_fn_mainslider ul.slides > li');
	var mainSlider		= jQuery('.fotofly_fn_mainslider, .fotofly_fn_w_cortex_slider_wrap');
	
	ulli.css({height:H});
	mainSlider.css({height:H});
}
// -----------------------------------------------------
// ---------------    KENBURNS SLIDER    ---------------
// -----------------------------------------------------
function fotofly_fn_w_kenburns(){
	"use strict";

	var kenburns = jQuery('.fotofly_fn_kenburns');
	kenburns.each(function(){
		var element = jQuery(this);
		var duration = element.data('interval');
		element.kenburnsy({
			fullscreen: true,
			duration: duration,
		});
	});
}
function fotofly_fn_w_kenburns_h(){
	"use strict";

	var H 			= jQuery(window).height();
	var kenburns 	= jQuery('.fotofly_fn_kenburns');
	kenburns.css({height:H});
}
// -----------------------------------------------------
// --------------------    JARALLAX    -----------------
// -----------------------------------------------------
function fotofly_fn_w_overlay_jarallax(){
	"use strict";
	
	jQuery('.fotofly_fn_overlay_parallax.jarallax').each(function(){
		var element			= jQuery(this);
		var	customSpeed		= element.data('parallax-speed');
		
		if(customSpeed !== "undefined" && customSpeed !== ""){
			customSpeed = customSpeed;
		}else{
			customSpeed 	= 0.1;
		}
		element.jarallax({
			speed: customSpeed
		});
	});
	// for project fullwidth
	jQuery('.fotofly_fn_project_fullwidth_fullwidth .img_holder_bg.jarallax').each(function(){
		var element			= jQuery(this);
		element.jarallax({
			speed: 0.5
		});
	});
	// for halfimage shortcode
	jQuery('.fotofly_fn_halfimage .image_holder.jarallax').each(function(){
		var element			= jQuery(this);
		element.jarallax({
			speed: 0.5
		});
	});
	// for fullpage gallery shortcode (fullwidth)
	jQuery('.fotofly_fn_galleryblock_fullwidth .img_holder_bg.jarallax').each(function(){
		var element			= jQuery(this);
		element.jarallax({
			speed: 0.2
		});
	});
}
// -----------------------------------------------------
// ---------------    FULLWIDTH HEIGHT    --------------
// -----------------------------------------------------
function fotofly_fn_w_fullwidth_min_height(){
	"use strict";
	
	var H			= jQuery(window).height();
	var container 	= jQuery('.fotofly_fn_fullwidth');
	
	container.each(function(){
		var cont		= jQuery(this);
		var minH		= cont.data('min-height');
		
		if(cont.length){
			if(minH === 'enable'){
				cont.css({minHeight:H});
			}
		}
	
	});
	
}
// -----------------------------------------------------
// -----------------    EQUAL COLUMNS    ---------------
// -----------------------------------------------------
function fotofly_fn_w_equal_cols(){
	"use strict";
	
	var el 				= jQuery('.fotofly_fn_fullwidth');
	
	if(el.length){
		el.each(function() {
			var container 		= jQuery(this);
			var equal_cols 		= container.data('cols-equal-height');
			var child 			= container.find('.frenify-layout-column .fotofly_fn_content_holder');
			var W 				= jQuery(window).width();

			child.css({height:'auto'});
			// Get an array of all element heights

			
			if(W > 800){
				if(equal_cols === 'enable'){
					var elementHeights = child.map(function() {return jQuery(this).outerHeight();}).get();

					// Math.max takes a variable number of arguments
					// `apply` is equivalent to passing each height as an argument
					var maxHeight = Math.max.apply(null, elementHeights);

					// Set each height to the max height
					child.css({height:maxHeight+'px'});	
				}
			}
		});		
	}
}
// -----------------------------------------------------
// -------------------    ANIMATION    -----------------
// -----------------------------------------------------
function fotofly_fn_w_animation(){
	"use strict";

	
	var animated_div			= 	jQuery('.fotofly_fn_animated_block');
	animated_div.each(function(){
		var wrap				=	jQuery(this);
		var animation 			= 	wrap.data('animation');
		var delay 				= 	wrap.data('delay');
		
		wrap.waypoint({	
			handler: function(){
						setTimeout(function(){
							wrap.removeClass('hideforanimation').addClass(animation);
						}, delay);
					},
			offset: '90%'
		});
		
	});

}
// -----------------------------------------------------
// -------------------    SHORTCODES    ----------------
// -----------------------------------------------------
function fotofly_fn_w_shortcodes(){
	"use strict";
	
	// FLOW GALLERY
	jQuery('.flow_list').each(function() {
		var el = jQuery(this);
		el.waitForImages(function() {
			el.flowGallery();	
		});
        
    });
	
	// TESTIMONIALS
	jQuery('.fotofly_fn_testimonial_slider').each(function() {
        var container = jQuery(this);
		var autoplay  = container.data('autoplay');
		var timeout  = container.data('timeout');
		var a, t;
		
		if(autoplay === 'enable'){a = true;}else{a = false;}
		if(timeout !== ''){t = timeout;}else{t = 9000;}
		var owl = container.find('.slider');
		
		owl.flickity({
			freeScroll: false,
			wrapAround: true,
			dots: true,
			autoPlay: true,
			pauseAutoPlayOnHover: false
		});
	});
	
	// TESTIMONIALS
	jQuery('.testimonials').each(function() {
        var container = jQuery(this);
		var owl = container.find('.carouselle');
		
		owl.flickity({
			freeScroll: false,
			wrapAround: true,
			dots: true,
			autoPlay: true,
			pauseAutoPlayOnHover: false,
			prevNextButtons: false,
			pageDots: true
		});
	});
	
	
	// PROGRESS BAR
	jQuery('.fotofly_fn_progress_wrap').each(function() {
		var pWrap = jQuery(this);
		pWrap.waypoint({handler: function(){fotofly_fn_progress(pWrap);},offset:'90%'});	
	});
	
	// COUNTERS
	jQuery('.fotofly_fn_counter').each(function() {
        var el = jQuery(this);
		el.waypoint({
			handler: function(){
				if(!el.hasClass('stop')){
					el.addClass('stop').countTo({
						refreshInterval: 50,
						formatter: function (value, options) {
							return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
						},	
					});
				}
			},
			offset:'90%'	
		});
    });
	
	
	// BACKGROUND SLIDE
	jQuery('.fotofly_fn_overlay_bgslide').each(function() {
        var bs 		= jQuery(this);
		var bsType  = bs.data('bstype');
		var xaxis  	= bs.data('xaxis');
		var yaxis  	= bs.data('yaxis');
		var bsRate  = bs.data('rate');
		var rate    = '';
		
		if(bsRate >= 30){rate = bsRate;}else{rate = 30;}
		
		var x = 0;
		var y = 0;
		setInterval(function(){
			if(xaxis === '' || xaxis === 0){x+=1;}else{x-=1;}
			if(yaxis === '' || yaxis === 0){y+=1;}else{y-=1;}
			
			if(bsType === 'hor'){
				bs.css('background-position', x + 'px  0');
					
			}else if(bsType === 'ver'){
				bs.css('background-position', '0 ' + y + 'px');
					
			}else if(bsType === 'both'){
				bs.css('background-position', x + 'px ' + y + 'px');	
			}
			
		}, rate);
		
    });
	
	// ACCORDION
	jQuery(".fotofly_fn_accordion").fotofly_fn_accordion({
		showIcon: false, //boolean	
		animation: true, //boolean
		closeAble: true, //boolean
        slideSpeed: 500 //integer, miliseconds
	});
	
	// OVERLAY
	jQuery('.fotofly_fn_overlay_color').each(function() {
        var tdt 	=   jQuery(this);
		var tdtRate =	tdt.data('transparency');
		var tdtBg 	=	tdt.data('color');
		var rate 	= 	"";
		if(tdtRate <= 1){rate = tdtRate;}else{rate = 1;}
		
		tdt.css({opacity:rate, backgroundColor:tdtBg});
    });
	
	// MENU ANCHOR
	jQuery('ul.nav__hor li a[href*=\\#]').on('click', function(event){     
		event.preventDefault();
		var fw	= jQuery('.fotofly_fn_fullwidth');
		if(fw.length){
			if(fw.data('navi') !== ''){
				jQuery('html,body').animate({scrollTop:jQuery(this.hash).offset().top}, 500);
			}
		}
		
	});
	
	// TABS
	if(jQuery().easytabs) {
		jQuery('.fotofly_fn_tabs').each(function(){
			jQuery(this).easytabs({
				animate: true,
				animationSpeed: 400,
				updateHash: false,
			});
		});
		jQuery('.fotofly_fn_sertabs').each(function(){
			jQuery(this).easytabs({
				animate: true,
				animationSpeed: 400,
				updateHash: false,
			});
		});
	}
	
	// EXPANDABLE BOX
	jQuery('.fotofly_fn_expandable').each(function(index, element) {
        var expand = jQuery(element);
		var etitle = expand.children('.etitle');
		var econtent = expand.children('.econtent');
		
		econtent.children().css({opacity:0});
		
		etitle.bind('click', function(e){
			e.preventDefault();
			if(!expand.hasClass('open')){
				expand.addClass('open');
				econtent.slideDown(500);
				econtent.children().delay(300).animate({opacity:1});
			}else{
				expand.removeClass('open');
				econtent.children().animate({opacity:0});
				econtent.delay(300).slideUp(500);		
			}
		});
    });
	
	
	// COUNTERS
	jQuery('.fotofly_fn_counter').each(function() {
        var el = jQuery(this);
		el.waypoint({
			handler: function(){
				if(!el.hasClass('stop')){
					el.addClass('stop').countTo({
						refreshInterval: 50,
						formatter: function (value, options) {
							return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
						},	
					});
				}
			},
			offset:'90%'	
		});
    });

}
// -----------------------------------------------------
// ------------------    PROGRESS BAR    ---------------
// -----------------------------------------------------
function fotofly_fn_progress(container){
	"use strict";
	container.find('.fotofly_fn_progress').each(function(i) {
		var progress = jQuery(this);
		var pValue = parseInt(progress.data('value'));
		var pColor = progress.data('color');
		var pBarWrap = progress.find('.fotofly_fn_bar_wrap');
		var pBar = progress.find('.fotofly_fn_bar');
		pBar.css({width:pValue+'%', backgroundColor:pColor});
		setTimeout(function(){pBarWrap.addClass('open');},(i*500));
	});
	
}