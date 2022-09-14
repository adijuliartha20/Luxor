/*

	Flow Gallery - Slideshow jQuery Plugin
	Version : 1.0.0
	
*/
// GLOBAL VARIABLES
var 
	side_offset_1 	= 0.35,
	side_offset_2 	= 0.6,
	scale_1 		= 0.9,
	scale_2 		= 0.7,
	flow_interval   = '';
		

(function( $ ) {
	"use strict";

 	// START PROTOTYPE
    $.fn.flowGallery = function(options) {
		
		// GET DEFAULT OPTIONS TO SETTINGS
		var settings = $.extend($.fn.defaults, options ),
		
		// GET VARIABLES
		
		
		
		list			= 	this,
		child 			= 	list.find('li'),
		itemCount 		= 	child.size(),
		title_holder 	=   list.parent().find('.flow_gallery_title h3');
			
		/* SET SLIDE */
		var setSlide = function (slideNum) {	
			
			// INIT REFLECTION
			child.find('.img_reflection').each(function(){
				$(this).css('background-image', 'url('+$(this).attr('data-url')+')');
			});
			
			// REMOVE CLASSES FOR NEXT/PREV SLIDE
			list.find('.prevItem2').removeClass('prevItem2');
			list.find('.prevItem').removeClass('prevItem');
			list.find('.currentItem').removeClass('currentItem');
			list.find('.nextItem').removeClass('nextItem');
			list.find('.nextItem2').removeClass('nextItem2');
			child.css({'left' : '50%', 'transform' : 'scale(0,0)'}); 
			
			var currentItem = list.find('.flow_item_'+slideNum);
			currentItem.addClass('currentItem');
			
			// Item Index
			var nextItem, nextItem2, prevItem, prevItem2;
			
			
			// Detect Item Index
			if((parseInt(slideNum)+1) > itemCount) {
				nextItem 	= list.find('.flow_item_1');
				nextItem2	= list.find('.flow_item_2');
			} else if ((parseInt(slideNum)+1) === itemCount){
				nextItem 	= list.find('.flow_item_'+itemCount);
				nextItem2 	= list.find('.flow_item_1');
			} else {
				nextItem 	= list.find('.flow_item_'+(parseInt(slideNum)+1));
				nextItem2  	= list.find('.flow_item_'+(parseInt(slideNum)+2));
			}
			
			if((parseInt(slideNum)-1) < 1) {
				prevItem 	= list.find('.flow_item_'+itemCount);
				prevItem2 	= list.find('.flow_item_'+(itemCount-1));
			} else if ((slideNum-1) === 1){
				prevItem 	= list.find('.flow_item_1');
				prevItem2 	= list.find('.flow_item_'+itemCount);
			} else {
				prevItem 	= list.find('.flow_item_'+(parseInt(slideNum)-1));
				prevItem2 	= list.find('.flow_item_'+(parseInt(slideNum)-2));
			}
		
			// Add Class to Item by Index
			prevItem2.addClass('prevItem2');
			prevItem.addClass('prevItem');
			currentItem.addClass('currentItem');
			nextItem.addClass('nextItem');
			nextItem2.addClass('nextItem2');
			
			
			// CHANGE TITLE TEXT
			title_holder.fadeOut(300);
			setTimeout(function(){title_holder.html(currentItem.attr('data-title')); title_holder.fadeIn(300);}, 300);
			
			var W = jQuery(window).width();
			
			
			
			var setImgWidth, setImgHeight,
				reflectionH 	= list.find('.img_reflection .ir').height(),
				controller   	= list.parent().find('.flow_gallery_controller');
			
			
			// SET ITEM WIDTH AND HEIGHT
			var imgH 			= list.find('li img').data('initial-height'),
				imgW 			= list.find('li img').data('initial-width');
			
			// fallback (if we don't have initial height data in img tag)
			if(imgH === null){
				imgH 			= list.find('li img').height();
				imgW 			= list.find('li img').width();
			}
			
			
			var galleryW = W - (((W - imgW)/2) - (imgW*side_offset_2*scale_2))*2;
			
			
			if(W < galleryW){
				setImgWidth  = W/2;
				setImgHeight = imgH / (imgW/setImgWidth);
			}
			else{
				setImgWidth 	= 	imgW;
				setImgHeight 	= 	imgH;
			}
			
			
			
			list.height(setImgHeight);
			list.find('li').width(setImgWidth).height(setImgHeight + reflectionH);
			list.find('li img').width(setImgWidth).height(setImgHeight);
			
			
			var wrapWidth = jQuery('.fotofly_fn_flowgallery_wrap').width();
			
			var mainOffSet 		= (wrapWidth - setImgWidth) /2,
				prevOffset 		= mainOffSet - setImgWidth*side_offset_1,
				prevOffset2 	= mainOffSet - setImgWidth*side_offset_2,
				nextOffset 		= mainOffSet + setImgWidth*side_offset_1,
				nextOffset2 	= mainOffSet + setImgWidth*side_offset_2;
			
			
			controller.css({right:mainOffSet * 1.06});
			
			currentItem.css({'left' : mainOffSet, 'transform' : 'scale(1,1)'}); 
			prevItem.css({'left' : prevOffset, 'transform' : 'scale('+ scale_1 +', '+ scale_1 +')'});
			prevItem2.css({'left' : prevOffset2, 'transform' : 'scale('+ scale_2 +','+ scale_2 +')' });
			nextItem.css({'left' : nextOffset, 'transform' : 'scale('+ scale_1 +','+ scale_1 +')'});
			nextItem2.css({'left' : nextOffset2, 'transform' : 'scale('+ scale_2 +','+ scale_2 +')'});
			
	   	};
		
		
		// OUTPUT
		setSlide(1);
		
		// NEXT SLIDE
		var nextSlide = function () {
			clearInterval(flow_interval);
			
			var cur_slide = parseInt(list.find('.currentItem').attr('data-count'));
			cur_slide++;
			if (cur_slide > itemCount) {cur_slide = 1;}
			if (cur_slide < 1) {cur_slide = itemCount;}
	
			setSlide(cur_slide);
	
			if (!list.hasClass('paused')) {
				flow_interval = setInterval(function(){nextSlide();}, settings.slide_time);
			}
		};
		
		// PREV SLIDE
		var prevSlide = function () {
			clearInterval(flow_interval);
			
			var cur_slide = parseInt(list.find('.currentItem').attr('data-count'));
			cur_slide--;
			if (cur_slide > itemCount) {cur_slide = 1;}
			if (cur_slide < 1) {cur_slide = itemCount;}
			
			setSlide(cur_slide);
			
			if (!list.hasClass('paused')) {
				flow_interval = setInterval(function(){prevSlide();}, settings.slide_time);
			}		
		};
		
		// FIRE PREV AND NEXT SLIDES
		if(itemCount > 4){
			
			// RUN ON CLICK
			child.on('click',function(){
				
				clearInterval(flow_interval);
				if (!list.hasClass('paused')) {
					if($(this).hasClass('nextItem') || $(this).hasClass('nextItem2')){
						flow_interval = setInterval(function(){nextSlide();}, settings.slide_time);
					}
					if($(this).hasClass('prevItem') || $(this).hasClass('prevItem2')){
						flow_interval = setInterval(function(){prevSlide();}, settings.slide_time);
					}
				}				
				setSlide($(this).attr('data-count'));
			});
			
			// RUN WITH CONTROLLER
			list.parent().find('div.previous').on('click', function(){
				prevSlide();
				return false;
			});
			list.parent().find('div.next').on('click', function(){
				nextSlide();
				return false;
			});
			
			
			// RUN WITH KEYBOARD
			$(document.documentElement).keyup(function (event) {
				if ((event.keyCode === 37)) {
					prevSlide();
				} else if ((event.keyCode === 39)) {
					nextSlide();
				}
			});
			
			
			/*// RUN WITH SWIPE
			list.swipe({
				//Generic swipe handler for all directions
				swipe:function(event, direction) {
				  	if(direction === 'down' || direction === 'right'){
						console.log("You swiped " + direction );
						prevSlide();  
						return false;	
					}
					else if(direction === 'up' || direction === 'left'){
						console.log("You swiped " + direction );
						nextSlide();
						return false;	
					}
				  	else{
						console.log("You swiped " + direction );
						return false;	
					}
				},
				//Default is 75px, set to 0 for demo so any distance triggers swipe
				threshold:0
			});*/
			
			
		}
		
		// AUTOPLAY
		if (settings.autoplay === false) {
			list.addClass('paused');
		}
		
		
		
		
	};
	
	
	// DEFAULT OPTIONS
	$.fn.defaults = {
		autoplay		:	false,
		slide_time		:	'4000',							
	}; 
}( jQuery ));



/* UPDATE SLIDE */
function updateFlowSlide() {	
	"use strict";
	// VARS
	
	var list2		= 	jQuery('.flow_list');
	list2.each(function(){
		var list	= 	jQuery(this);
		var nextItem, nextItem2, prevItem, prevItem2, currentItem;

		prevItem2 	= list.find('.prevItem2');
		prevItem	= list.find('.prevItem');
		currentItem = list.find('.currentItem');
		nextItem 	= list.find('.nextItem');
		nextItem2 	= list.find('.nextItem2');

		// SET ITEM WIDTH AND HEIGHT



		var W = jQuery(window).width();

		// SET ITEM WIDTH AND HEIGHT
		var setImgWidth, setImgHeight,
			reflectionH 	= list.find('.img_reflection .ir').height(),
			controller   	= list.parent().find('.flow_gallery_controller');


		// SET ITEM WIDTH AND HEIGHT
		var imgH 			= list.find('li img').data('initial-height'),
			imgW 			= list.find('li img').data('initial-width');

		// fallback (if we don't have initial height data in img tag)
		if(imgH === null){
			imgH 			= list.find('li img').height();
			imgW 			= list.find('li img').width();
		}


		var galleryW = W - (((W - imgW)/2) - (imgW*side_offset_2*scale_2))*2;


		if(W < galleryW){
			setImgWidth  = W/2;
			setImgHeight = imgH / (imgW/setImgWidth);
		}
		else{
			setImgWidth 	= 	imgW;
			setImgHeight 	= 	imgH;
		}



		list.height(setImgHeight);
		list.find('li').width(setImgWidth).height(setImgHeight + reflectionH);
		list.find('li img').width(setImgWidth).height(setImgHeight);


		var wrapWidth = jQuery('.fotofly_fn_flowgallery_wrap').width();

		var mainOffSet 		= (wrapWidth - setImgWidth) /2,
			prevOffset 		= mainOffSet - setImgWidth*side_offset_1,
			prevOffset2 	= mainOffSet - setImgWidth*side_offset_2,
			nextOffset 		= mainOffSet + setImgWidth*side_offset_1,
			nextOffset2 	= mainOffSet + setImgWidth*side_offset_2;


		controller.css({right:mainOffSet * 1.06});

		currentItem.css({'left' : mainOffSet, 'transform' : 'scale(1,1)'}); 
		prevItem.css({'left' : prevOffset, 'transform' : 'scale('+ scale_1 +', '+ scale_1 +')'});
		prevItem2.css({'left' : prevOffset2, 'transform' : 'scale('+ scale_2 +','+ scale_2 +')' });
		nextItem.css({'left' : nextOffset, 'transform' : 'scale('+ scale_1 +','+ scale_1 +')'});
		nextItem2.css({'left' : nextOffset2, 'transform' : 'scale('+ scale_2 +','+ scale_2 +')'});
	});	
}

jQuery(window).resize(function() {
	"use strict";
	updateFlowSlide();	
});
jQuery(window).load(function(){
	"use strict";
	updateFlowSlide();	
});