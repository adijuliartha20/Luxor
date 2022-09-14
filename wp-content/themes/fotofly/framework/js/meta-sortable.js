jQuery(document).ready(function(){ 
	"use strict";
	
	
	// SOME META BOX FIXES
	var field = jQuery('.rwmb-meta-box .rwmb-field');
	
	field.each(function(){
		var item 	= jQuery(this);
		var uid		= item.find('.rwmb-label label').attr('for');
		item.addClass(uid);
	});
	
	
	
	// PAGE TEMPLATE SELECT
	jQuery('#pageparentdiv #page_template').on('change', function(){
		
		
		
		var selected_option 				= jQuery(this).children("option:selected").val();
		var page_main_options				= jQuery('#page_main_options');
		var portfolio_custom_options		= jQuery('#portfoliocustomoptions');
		var gallery_custom_options			= jQuery('#gallerycustomoptions');
		
		if(selected_option === 'page-blank.php'){
			page_main_options.addClass('closed').slideUp();
		}
		else{
			if(page_main_options.hasClass('closed')){
				page_main_options.removeClass('closed').slideDown();
			}
		}
		
		
		// We don't need footer options here
		if(selected_option === 'page-split.php'){
			jQuery('.fotofly_fn_page_footer_widget_switch, .fotofly_fn_page_footer_switch').slideUp();
		}else{
			jQuery('.fotofly_fn_page_footer_widget_switch, .fotofly_fn_page_footer_switch').slideDown();
		}
		
		
		// Portfolio Filters
		if(selected_option === 'page-portfolio.php'){
			portfolio_custom_options.removeClass('closed').slideDown();
		}else{
			portfolio_custom_options.addClass('closed').slideUp();
		}
		
		// Gallery Filters
		if(selected_option === 'page-gallery.php'){
			gallery_custom_options.removeClass('closed').slideDown();
		}else{
			gallery_custom_options.addClass('closed').slideUp();
		}
		
		
		// We don't need sidebar options here
		if(selected_option === 'default' || selected_option === 'page-blog.php' || selected_option === 'page-portfolio.php'){
			jQuery('.fotofly_fn_page_style').slideDown(200);
			jQuery('.fotofly_fn_page_sidebar').slideDown(200);
			
		}else{
			jQuery('.fotofly_fn_page_style').slideUp(200);
			jQuery('.fotofly_fn_page_sidebar').delay(100).slideUp(200);
		}

	});
	jQuery("#pageparentdiv #page_template").triggerHandler("change");
	
	
	
	// RTANSFER SIDEBAR SELECT OPTIONS
	var sidebaroptions = jQuery('.sbg_container select[name="sidebar_generator_replacement[0]"]').html();
	jQuery('select#fotofly_fn_page_sidebar').html(sidebaroptions);
	jQuery('select#fotofly_fn_page_sidebar').on('change', function(){
		var changed = jQuery(this).children('option:selected').val();
		jQuery('.sbg_container select[name="sidebar_generator_replacement[0]"] option[value="'+changed+'"]').attr('selected', 'selected');
	});
	jQuery('select#fotofly_fn_page_sidebar').triggerHandler("change");
	
	
	fn_page_background();
	fn_blogpostformats();
	
});



function fn_page_background(){
	"use strict";
	
	var page_bg_select = jQuery('select#fotofly_fn_page_bg_type');
	page_bg_select.on('change', function(){
		var chosed = jQuery(this).children('option:selected').val();
		
		jQuery('.fotofly_fn_page_fg_opacity, .fotofly_fn_page_bg_color, .fotofly_fn_page_bg_img, .fotofly_fn_page_bg_slider, .fotofly_fn_page_bg_video').hide();
		
		if(chosed === 'image'){
			jQuery('.fotofly_fn_page_fg_opacity, .fotofly_fn_page_bg_color, .fotofly_fn_page_bg_img').slideDown();
			jQuery('.fotofly_fn_page_bg_slider, .fotofly_fn_page_bg_video_poster, .fotofly_fn_page_bg_video').slideUp();
		}
		else if(chosed === 'fade_slider' || chosed === 'kenburnsy_slider'){
			jQuery('.fotofly_fn_page_fg_opacity, .fotofly_fn_page_bg_color, .fotofly_fn_page_bg_slider').slideDown();
			jQuery('.fotofly_fn_page_bg_img, .fotofly_fn_page_bg_video_poster, .fotofly_fn_page_bg_video').slideUp();
		}
		else if(chosed === 'video'){
			jQuery('.fotofly_fn_page_fg_opacity, .fotofly_fn_page_bg_video_poster, .fotofly_fn_page_bg_color, .fotofly_fn_page_bg_video').slideDown();
			jQuery('.fotofly_fn_page_bg_slider, .fotofly_fn_page_bg_img').slideUp();
		}
		else{
			jQuery(' .fotofly_fn_page_bg_video_poster, .fotofly_fn_page_bg_color, .fotofly_fn_page_bg_img, .fotofly_fn_page_bg_slider, .fotofly_fn_page_bg_video').slideUp();
		}
	});
	jQuery('select#fotofly_fn_page_bg_type').triggerHandler("change");
	
}

function fn_blogpostformats(){
	"use strict";
	jQuery('#post-formats-select input').change(checkFormat);
	
	function checkFormat(){
		var format = jQuery('#post-formats-select input:checked').attr('value');
		
		//only run on the posts page
		if(typeof format !== 'undefined'){
			
			
			jQuery('#post-body div[id^=frenify-meta-post-]').hide();
			jQuery('#post-body #frenify-meta-post-'+format+'').stop(true,true).fadeIn(500);
					
		}
	
	}

	checkFormat();
}