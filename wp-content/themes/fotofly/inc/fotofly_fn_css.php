<?php

function fotofly_fn_inline_styles() {
	
	global $woocommerce, $fotofly_fn_option; 
	
	
	
	wp_enqueue_style('fotofly_fn_inline', get_template_directory_uri().'/framework/css/inline.css', array(), '1.0', 'all');
	/************************** START styles **************************/
	$fotofly_fn_custom_css = "";
	
	
	
	/************************** font styles **************************/
	$fotofly_fn_custom_css .= "			
		body,
		.fotofly_fn_comment h3.comment-reply-title a{
			font-family:'{$fotofly_fn_option['body_font']['font-family']}', Arial, Helvetica, sans-serif; 
			font-size:{$fotofly_fn_option['body_font']['font-size']};  
			font-weight:{$fotofly_fn_option['body_font']['font-weight']};  
		}
		
		.uneditable-input, input[type=number], input[type=email], input[type=url], input[type=search], input[type=tel], input[type=color], input[type=text], input[type=password], input[type=datetime], input[type=datetime-local], input[type=date], input[type=month], input[type=time], input[type=week], input, button, select, textarea{
			font-family: '{$fotofly_fn_option['input_font']['font-family']}', Arial, Helvetica, sans-serif; 
			font-size:{$fotofly_fn_option['input_font']['font-size']}; 
			font-weight:{$fotofly_fn_option['input_font']['font-weight']};
		}
		
		h1,h2,h3,h4,h5,h6,
		h1>a,h2>a,h3>a,h4>a,h5>a,h6>a,
		.fotofly_fn_comment h3.comment-reply-title,
		.fotofly_fn_call_to_action > a span,
		.fotofly_fn_hover_width a,
		.fotofly_fn_flipbox_fn a,
		.widget_block ul.menu > li > a,
		.widget_block ul.menu li ul li a,
		.fotofly_fn_rightclick_protection p,
		.fotofly_fn_intropage .interactive-list span,
		.frenify-custom-rotator span,
		ul.nav__hor li a,
		.fotofly_fn_vertnav_menupart ul.nav_ver > li > a,
		.fotofly_fn_vertnav_menupart ul.nav_ver li ul li a,
		ul.vert_menu_list > li > a,
		ul.vert_menu_list li ul li a,
		.fotofly_fn_title_content span,
		.portfolio_list_wrap ul li .port_list_single .port_cat a,
		.fotofly_fn_clients_list .title_holder a,
		.fotofly_fn_comment span.author,
		.fotofly_fn_comment .form-submit input.submit,
		.fotofly_fn_servicetab_single .content_holder .price_holder .price,
		.fotofly_fn_service_carousel .title_holder .price,
		.fotofly_fn_w_cuspostcatmod .title_holder a,
		.fotofly_fn_testimonial_single .title_holder p,
		.fotofly_fn_call_to_action_classic a,
		.fotofly_fn_sertabs ul.etabs li a,
		.fotofly_fn_sertabs .content_holder .price_holder .price,
		.fotofly_fn_accordion .accordion_in .acc_head,
		.fotofly_fn_tabs ul.etabs li a,
		.fotofly_fn_member .fotofly_fn_member_holder .title_holder span,
		.testimonials span.t_author,
		.testimonials p.t_author_oc,
		.fotofly_fn_w_portfoliocustom_triple .title_holder a,
		.fotofly_fn_w_portfoliocustom_triple .discover p,
		.fotofly_fn_w_portfoliocustom_quintuple .title_holder a,
		.fotofly_fn_w_portfoliocustom_quintuple .discover p,
		.fotofly_fn_w_portfoliocustom_quadruple .title_holder a,
		.fotofly_fn_unit_info .link_holder a,
		.footer_social_list li a,
		.fotofly_fn_w_portfoliocustom_quadruple .discover p{
			font-family: '{$fotofly_fn_option['heading_font']['font-family']}', Arial, Helvetica, sans-serif;
			font-weight:{$fotofly_fn_option['heading_font']['font-weight']};  
		}
		blockquote{
			font-family: '{$fotofly_fn_option['blockquote_font']['font-family']}', Arial, Helvetica, sans-serif; 
			font-size:{$fotofly_fn_option['blockquote_font']['font-size']}; 
			font-weight:{$fotofly_fn_option['blockquote_font']['font-weight']};
		}
		.fotofly_fn_flogo.logo_text span{
			font-family: '{$fotofly_fn_option['fotofly_fn_logo_text_font']['font-family']}', Arial, Helvetica, sans-serif; 
			font-size:{$fotofly_fn_option['fotofly_fn_logo_text_font']['font-size']}; 
			font-weight:{$fotofly_fn_option['fotofly_fn_logo_text_font']['font-weight']};
		}
		.fotofly_fn_call_to_action_classic h1,
		.fotofly_fn_halfimage .info_content h3 i,
		.fotofly_fn_about_me .info_content .title_holder h3 i{
			font-family: '{$fotofly_fn_option['fotofly_fn_twst']['font-family']}', Arial, Helvetica, sans-serif;
			font-weight:{$fotofly_fn_option['fotofly_fn_twst']['font-weight']};
		}
		
		";
	
		/************************** theme skin **************************/
		if($fotofly_fn_option['theme_skin'] == 'dark'){
			if($fotofly_fn_option['body_color_switch'] === 'enable'){
				wp_enqueue_style('skin_dark_with_body_color', get_template_directory_uri().'/framework/css/skin-dark-with-body-color.css', array(), '1.0', 'all');
			}else{
				wp_enqueue_style('skin_dark', get_template_directory_uri().'/framework/css/skin-dark.css', array(), '1.0', 'all');
			}
			
		}
		/************************** theme border *************************/
		$fotofly_fn_borderstyle			= $fotofly_fn_option['theme_bordered_style'];
		$fotofly_fn_border_small_style	= $fotofly_fn_option['theme_border_small_color'];

		if(isset($_GET['border_switcher'])){$fotofly_fn_borderstyle = $_GET['border_switcher'];}
		if(isset($_GET['border_small'])){$fotofly_fn_border_small_style = $_GET['border_small'];}
		if($fotofly_fn_borderstyle == 'small'){
			$a = $fotofly_fn_border_small_style;
		}else{
			$a = '';
		}
		if($a !== ''){
			$fotofly_fn_custom_css .= "
				.fotofly_fn_fixed_border_top,
				.fotofly_fn_fixed_border_bottom,
				.fotofly_fn_fixed_border_left,
				.fotofly_fn_fixed_border_right{background-color: {$a};}
			";
		}
		
		/********************** portfolio hover effects ******************/

		// overlay
		$post_overlay_type				= $fotofly_fn_option['portfolio_post_overlay'];
		$post_overlay_color 			= $fotofly_fn_option['portfolio_post_overlay_color'];
		$post_overlay_opacity			= $fotofly_fn_option['portfolio_post_overlay_color_opacity'];
		$post_overlay_blur_rate			= $fotofly_fn_option['portfolio_post_overlay_blur_rate'];
		$post_overlay_sepia_rate		= $fotofly_fn_option['portfolio_post_overlay_sepia_rate'];
		$post_overlay_grayscale_rate	= $fotofly_fn_option['portfolio_post_overlay_grayscale_rate'];
		$post_overlay_huerotate_rate	= $fotofly_fn_option['portfolio_post_overlay_huerotate_rate'];
		$post_overlay_invert_rate		= $fotofly_fn_option['portfolio_post_overlay_invert_rate'];
		$post_overlay_saturate_rate		= $fotofly_fn_option['portfolio_post_overlay_saturate_rate'];
		$post_overlay_grad_from			= $fotofly_fn_option['portfolio_post_overlay_gradient']['from'];
		$post_overlay_grad_to			= $fotofly_fn_option['portfolio_post_overlay_gradient']['to'];
	
	
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
			if(isset($_GET['type'])){$post_overlay_type = $_GET['type'];}
			if(isset($_GET['o_color'])){$post_overlay_color = $_GET['o_color'];}
			if(isset($_GET['o_opacity'])){$post_overlay_opacity = $_GET['o_opacity'];}
			if(isset($_GET['o_blur'])){$post_overlay_blur_rate = $_GET['o_blur'];}
			if(isset($_GET['o_sepia'])){$post_overlay_sepia_rate = $_GET['o_sepia'];}
			if(isset($_GET['o_gray'])){$post_overlay_grayscale_rate = $_GET['o_gray'];}
			if(isset($_GET['o_hue'])){$post_overlay_huerotate_rate = $_GET['o_hue'];}
			if(isset($_GET['o_satur'])){$post_overlay_saturate_rate = $_GET['o_satur'];}
			if(isset($_GET['o_invert'])){$post_overlay_invert_rate = $_GET['o_invert'];}
			if(isset($_GET['o_grfr'])){$post_overlay_grad_from = $_GET['o_grfr'];}
			if(isset($_GET['o_grto'])){$post_overlay_grad_to = $_GET['o_grto'];}
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */

		$fn_img_styles = $fn_styles = '';
		$post_overlay_opacity = $post_overlay_opacity/10;

		// none type
		if($post_overlay_type == 'none'){
			$fn_styles .= '';
		}
		// color type
		elseif($post_overlay_type == 'color'){
			$fn_styles .= 'background-color:'.$post_overlay_color.';opacity:'.$post_overlay_opacity.';';
			$fn_img_styles .= 'display: none;';
		}
		// gradient type
		elseif($post_overlay_type == 'gradient'){
			$fn_styles .= 'background:-webkit-linear-gradient('.$post_overlay_grad_from.', '.$post_overlay_grad_to.');';
			$fn_styles .= 'background:-o-linear-gradient('.$post_overlay_grad_from.', '.$post_overlay_grad_to.');';
			$fn_styles .= 'background:-moz-linear-gradient('.$post_overlay_grad_from.', '.$post_overlay_grad_to.');';
			$fn_styles .= 'background:linear-gradient('.$post_overlay_grad_from.', '.$post_overlay_grad_to.');';
			$fn_styles .= 'opacity:'.$post_overlay_opacity.';';
			$fn_img_styles .= 'display: none;';
		}
		// blackandwhite type
		elseif($post_overlay_type == 'blackwhite'){
			$fn_img_styles .= '-webkit-filter:grayscale(100%) brightness(80%) contrast(100%);';
			$fn_img_styles .= '-moz-filter:grayscale(100%) brightness(80%) contrast(100%);';
			$fn_img_styles .= '-ms-filter:grayscale(100%) brightness(80%) contrast(100%);';
			$fn_img_styles .= '-o-filter:grayscale(100%) brightness(80%) contrast(100%);';
			$fn_img_styles .= 'filter:grayscale(100%) brightness(80%) contrast(100%);';
		}
		// sepia type
		elseif($post_overlay_type == 'sepia'){
			$fn_img_styles .= '-webkit-filter:sepia('.$post_overlay_sepia_rate.'%);';
			$fn_img_styles .= '-moz-filter:sepia('.$post_overlay_sepia_rate.'%);';
			$fn_img_styles .= '-ms-filter:sepia('.$post_overlay_sepia_rate.'%);';
			$fn_img_styles .= '-o-filter:sepia('.$post_overlay_sepia_rate.'%);';
			$fn_img_styles .= 'filter:sepia('.$post_overlay_sepia_rate.'%);';
		}
		// grayscale type
		elseif($post_overlay_type == 'grayscale'){
			$fn_img_styles .= '-webkit-filter:grayscale('.$post_overlay_grayscale_rate.'%);';
			$fn_img_styles .= '-moz-filter:grayscale('.$post_overlay_grayscale_rate.'%);';
			$fn_img_styles .= '-ms-filter:grayscale('.$post_overlay_grayscale_rate.'%);';
			$fn_img_styles .= '-o-filter:grayscale('.$post_overlay_grayscale_rate.'%);';
			$fn_img_styles .= 'filter:grayscale('.$post_overlay_grayscale_rate.'%);';
		}
		// huerotate type
		elseif($post_overlay_type == 'huerotate'){
			$fn_img_styles .= '-webkit-filter:hue-rotate('.$post_overlay_huerotate_rate.'deg);';
			$fn_img_styles .= '-moz-filter:hue-rotate('.$post_overlay_huerotate_rate.'deg);';
			$fn_img_styles .= '-ms-filter:hue-rotate('.$post_overlay_huerotate_rate.'deg);';
			$fn_img_styles .= '-o-filter:hue-rotate('.$post_overlay_huerotate_rate.'deg);';
			$fn_img_styles .= 'filter:hue-rotate('.$post_overlay_huerotate_rate.'deg);';
		}
		// invert type
		elseif($post_overlay_type == 'invert'){
			$fn_img_styles .= '-webkit-filter:invert('.$post_overlay_invert_rate.'%);';
			$fn_img_styles .= '-moz-filter:invert('.$post_overlay_invert_rate.'%);';
			$fn_img_styles .= '-ms-filter:invert('.$post_overlay_invert_rate.'%);';
			$fn_img_styles .= '-o-filter:invert('.$post_overlay_invert_rate.'%);';
			$fn_img_styles .= 'filter:invert('.$post_overlay_invert_rate.'%);';
		}
		// saturate type
		elseif($post_overlay_type == 'saturate'){
			$fn_img_styles .= '-webkit-filter:saturate('.$post_overlay_saturate_rate.'%);';
			$fn_img_styles .= '-moz-filter:saturate('.$post_overlay_saturate_rate.'%);';
			$fn_img_styles .= '-ms-filter:saturate('.$post_overlay_saturate_rate.'%);';
			$fn_img_styles .= '-o-filter:saturate('.$post_overlay_saturate_rate.'%);';
			$fn_img_styles .= 'filter:saturate('.$post_overlay_saturate_rate.'%);';
		}
		// blur type
		elseif($post_overlay_type == 'blur'){
			$fn_img_styles .= '-webkit-filter:blur('.$post_overlay_blur_rate.'px);';
			$fn_img_styles .= '-moz-filter:blur('.$post_overlay_blur_rate.'px);';
			$fn_img_styles .= '-ms-filter:blur('.$post_overlay_blur_rate.'px);';
			$fn_img_styles .= '-o-filter:blur('.$post_overlay_blur_rate.'px);';
			$fn_img_styles .= 'filter:blur('.$post_overlay_blur_rate.'px);';
		}
		$portfolio_layout = $fotofly_fn_option['portfolio_template'];
		if($portfolio_layout == 'split'){
			$portfolio_attr = ".fotofly_fn_portfolio_split";
		}else{
			$portfolio_attr = '.fotofly_fn_portfolio.'.$portfolio_layout;
		}
		$fotofly_fn_custom_css .= "
		".$portfolio_attr." .fn_overlay_hover .fn_hover{".$fn_styles."}
		".$portfolio_attr." .fn_overlay_hover img{".$fn_img_styles."}
		".$portfolio_attr." .fn_overlay_hover a div{".$fn_img_styles."}
		";
		/********************* woocommerce/my-account bgcolor *********************/
		$woo_account_bg	= $fotofly_fn_option['woo_account_bg'];
		if(isset($woo_account_bg)){
			$fotofly_fn_custom_css .= "
			.fotofly_fn_woo_myaccount:after{background-color:".$woo_account_bg.";}
			";
		}
		/************************** fotofly logo styles **************************/
		$logo_type 	= $fotofly_fn_option['fotofly_fn_logo_type'];
		$logo_svgW	= $fotofly_fn_option['fotofly_fn_logo_svg_w'].'px';
		$logo_svgH	= $fotofly_fn_option['fotofly_fn_logo_svg_h'].'px';
		
		if($logo_type == 'svg'){
			$fotofly_fn_custom_css .= "
			.fotofly_fn_flogo svg{width:".$logo_svgW.";height:".$logo_svgH."}
			";
		}
		/*************** BACKSIDE OVERLAY OF CLIENT PAGE (FLIPPED) **************/
		$client_backside_overlayType = $client_backside_textcolor = $client_backside_color = $client_backside_startcolor = $client_backside_endcolor = $client_backside_grad_dir = '';
		if(isset($fotofly_fn_option['client_flipped_back_ov_type'])){
			$client_backside_overlayType = $fotofly_fn_option['client_flipped_back_ov_type'];
			$client_backside_textcolor 	= $fotofly_fn_option['client_flipped_back_textcolor'];
			$client_backside_color 		= $fotofly_fn_option['client_flipped_back_color'];
			$client_backside_startcolor = $fotofly_fn_option['client_flipped_back_startcolor'];
			$client_backside_endcolor 	= $fotofly_fn_option['client_flipped_back_endcolor'];
			$client_backside_grad_dir 	= $fotofly_fn_option['client_flipped_back_gr_dir'].'deg';
		}
		if($client_backside_overlayType === 'color'){
			$fotofly_fn_custom_css .= "
				.fotofly_fn_clients_list.flipped .item .o_gradient{
					background: ".$client_backside_color.";
				}
				.fotofly_fn_clients_list.flipped .inner p{
					color: ".$client_backside_textcolor.";
				}
			";
		}else if($client_backside_overlayType === 'gradient'){
			$fotofly_fn_custom_css .= "
				.fotofly_fn_clients_list.flipped .item .o_gradient{
					background: ".$client_backside_color.";
					background: -webkit-linear-gradient(".$client_backside_grad_dir.", ".$client_backside_startcolor.", ".$client_backside_endcolor.");
    				background: -o-linear-gradient(".$client_backside_grad_dir.", ".$client_backside_startcolor.", ".$client_backside_endcolor.");
    				background: -moz-linear-gradient(".$client_backside_grad_dir.", ".$client_backside_startcolor.", ".$client_backside_endcolor.");
					background: linear-gradient(".$client_backside_grad_dir.", ".$client_backside_startcolor.", ".$client_backside_endcolor.");
				}
				.fotofly_fn_clients_list.flipped .inner p{
					color: ".$client_backside_textcolor.";
				}
			";
		}
	
	$shadow_color 			= '#eb1010';
	$shadow_opacity 		= '0.3';
	$shadow_colorr 			= 'rgba(235,16,16,0.3)';
	if(isset($fotofly_fn_option['box_shadow_color'])){
		$shadow_color 		= $fotofly_fn_option['box_shadow_color'];
		$shadow_opacity 	= $fotofly_fn_option['box_shadow_opacity'];
		list($rr, $gg, $bb) = sscanf($shadow_color, "#%02x%02x%02x");
		$shadow_colorr		= 'rgba('.$rr.','.$gg.', '.$bb.', '.$shadow_opacity.')';
	}
	$fotofly_fn_custom_css .= "
		.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
		.woocommerce form.login input.button,
		.woocommerce-cart table.cart td.actions input[type='submit'],
		.woocommerce #respond input#submit,
		.fotofly_fn_comment .form-submit input.submit{--box-shadow-color: {$shadow_colorr};}
		a.totop:after,
		.fotofly_fn_search:after,
		.fotofly_fn_audio_controls a:after,
		.fotofly_fn_clients_list.separated_thumb .title_holder:after,
		.fotofly_fn_search,
		.header_helper ul.hidden:after,
		.fotofly_fn_w_cuspostcatmod .title_holder a:after{color: {$shadow_colorr};}
	";
	if($fotofly_fn_option['body_color_switch'] != 'enable'){
		$primary_color = $fotofly_fn_option['primary_color'];
		$fotofly_fn_custom_css .= "
			h1>a:hover,h2>a:hover,h3>a:hover,h4>a:hover,h5>a:hover,h6>a:hover,
			a,
			.fotofly_fn_intropage .closer,
			.fotofly_fn_searchpagelist_item a.read_more,
			.fotofly_fn_searchpage_nothing a.gotohome,
			.portfolio_btn a,
			.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder > a,
			.fotofly_fn_blog_wrap.blog_grid_modern .blog_wrapper ul.mypost li .title_holder h3 > a:hover,
			ul.fotofly_fn_portfolio_list .cover_image_wrap .title_wrap h3 a:hover,
			ul.fotofly_fn_portfolio_list .fotofly_fn_item > .title_wrap h3 a:hover,
			.fotofly_fn_portfolio_third .list_holder .list .title h3 a:hover,
			.fotofly_fn_portfolio_third[data-title-style='outside'] .list_holder .list .title > h3 a:hover,
			.fotofly_fn_proofgal .pixproof-data button,
			.fotofly_fn_clients_list .title_holder a:hover,
			ul.fotofly_fn_proofing_list a,
			.fotofly_fn_portfolio_list .title_holder h3 a:hover,
			.fotofly_fn_client_single[data-title-style='outside'] .works_list .item .title_holder > h3 a:hover,
			.fotofly_fn_gallerylist .title_wrap h3 a:hover,
			.fotofly_fn_gallerylist .seemore a,
			.fotofly_fn_blog_single_wrap .blog_single_wrapper .fn_post_header .link-post a,
			.fotofly_fn_tags > em,
			.fotofly_fn_tags > em a,
			.comment-navigation a,
			.fotofly_fn_comment span.author a:hover,
			.fotofly_fn_comment a.comment-reply-link,
			.fotofly_fn_comment a.comment-edit-link,
			.fotofly_fn_comment div.comment-text p > a,
			.fotofly_fn_comment h3.comment-reply-title a,
			.fotofly_fn_comment .logged-in-as,
			.fotofly_fn_comment .logged-in-as a:first-child,
			.fotofly_fn_comment .logged-in-as a:last-child,
			.fotofly_fn_footer .cright_content span a,
			.fotofly_fn_post .title_holder > a,
			.fotofly_fn_link a,
			.fotofly_fn_aboutslider .about_content a,
			.fotofly_fn_w_cortex_slider_wrap h3 a:hover,
			.fotofly_fn_w_multi_scroll .title_holder h3 a:hover,
			.fotofly_fn_category_column_portfolio table .title_holder h3 a:hover,
			.fotofly_fn_category_column_gallery table .title_holder h3 a:hover,
			.w_cpost_carousel .title_holder h3 a:hover,
			.fotofly_fn_w_cuspostcatfol_wrap[data-skin='dark'] .fotofly_fn_w_cuspostcatfol .title_holder h3 a:hover,
			.fotofly_fn_w_custompost_ribbon_wrap .title_holder h3 a:hover,
			ul.w_blog_list .title_holder h3 a:hover,
			.fotofly_fn_halfimage .info_content a,
			.fotofly_fn_instagram .following h3:hover a,
			.fotofly_fn_instagram[data-skin='dark'] .following h3 a:hover,
			.fotofly_fn_about_me .info_content .btn a,
			.fotofly_fn_accordion .accordion_in.acc_active .acc_head,
			.fotofly_fn_tabs[data-layout='beta'] ul.etabs li a.active,
			.fotofly_fn_galleryblock .content_holder a,
			.fotofly_fn_galleryblock_fullscreen .title_holder h3 a:hover,
			.fotofly_fn_w_cuspost_parallax_wrap[data-skin='dark'] .fotofly_fn_galleryblock .title_holder h3 a:hover,
			.fotofly_fn_projectslider .content_holder a,
			.fotofly_fn_projectslider_wrap[data-skin='dark'] .fotofly_fn_projectslider .title_holder h1 a:hover,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			a.woocommerce-review-link,
			.woocommerce .fn_cart-empty a.button,
			.woocommerce table.shop_table td.product-name a,
			.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
			.woocommerce-account .woocommerce-MyAccount-navigation a:hover,
			.fotofly_fn_woo_login_inner p a{color: {$primary_color};}

			.fotofly_fn_blog_wrap.blog_mosaic .blog_wrapper ul.mypost li .title_holder h3 a:hover{color: {$primary_color} !important;}

			.fotofly_fn_intropage .closer,
			.fotofly_fn_searchpagelist_item a.read_more,
			.fotofly_fn_searchpage_nothing a.gotohome,
			.portfolio_btn a,
			.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder > a,
			.fotofly_fn_proofgal .pixproof-data button,
			ul.fotofly_fn_proofing_list a,
			.fotofly_fn_gallerylist .seemore a,
			.fotofly_fn_blog_single_wrap .blog_single_wrapper .fn_post_header .link-post a,
			.fotofly_fn_footer .cright_content span a:hover,
			.fotofly_fn_post .title_holder > a,
			.fotofly_fn_link a,
			.fotofly_fn_aboutslider .about_content a,
			.fotofly_fn_about_me .info_content .btn a,
			.fotofly_fn_tabs[data-layout='beta'] ul.etabs li a.active,
			.fotofly_fn_galleryblock .content_holder a,
			.fotofly_fn_projectslider .content_holder a,
			.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
			a.woocommerce-review-link,
			.woocommerce .fn_cart-empty a.button,
			.woocommerce table.shop_table td.product-name a,
			.fotofly_fn_woo_login_inner p a{border-bottom-color: {$primary_color};}


			.fotofly_fn_tags > em a:after,
			.comment-navigation a:after,
			.fotofly_fn_comment a.comment-reply-link:after,
			.fotofly_fn_comment div.comment-text p > a:after,
			.fotofly_fn_comment .logged-in-as a:first-child:after,
			.footer_social_list li:after{background-color: {$primary_color};}

			ul.brochures li a i{background: {$primary_color};}
			@media (max-width: 768px){
				.fotofly_fn_galleryblock_halfimg .title_holder h3 a:hover{color: {$primary_color};}
			}
			.woocommerce-error{border-color: {$primary_color};}
		";
	}
	// THEME COLORS
	if($fotofly_fn_option['body_color_switch'] === 'enable'){
		$link_color = $fotofly_fn_option['link_color'];
		$fotofly_fn_custom_css .= "
		.fotofly_fn_tags > em a:after,
		.comment-navigation a:after,
		.fotofly_fn_comment a.comment-reply-link:after,
		.fotofly_fn_comment div.comment-text p > a:after,
		.fotofly_fn_comment .logged-in-as a:first-child:after,
		.footer_social_list li:after,
		.posted_in a:after,
		.calendar_wrap table td a:after,
		.tagged_as a:after, .posted_in a:after,
		.fotofly_fn_gallerylist .minithumb .title_holder span a:after,
		.fotofly_fn_galleryblock_fullscreen .title_holder span a:after,
		.fotofly_fn_projectslider .title_holder span a:after,
		.widget_archive ul li a:after,
		.widget_pages ul li a:after,
		.widget_meta ul li a:after,
		.widget_calendar table a:after,
		.widget_categories ul li a:after,
		.widget_recent_comments ul li a:after,
		.widget_recent_entries ul li a:after,
		.widget_rss ul li a:after,
		a.fotofly_fn_animated_link:after,
		.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder span.category a:after,
		ul.fotofly_fn_portfolio_list .fotofly_fn_item > .title_wrap .fn_cat a .extra,
		.fotofly_fn_portfolio_single .title_holder a:after,
		.fotofly_fn_psingle_mono .title_holder a:after,
		.fotofly_fn_psingle_sticky .title_holder a:after,
		.fotofly_fn_blog_single_wrap .blog_single_wrapper .post_content .title_holder > span a:after,
		.fotofly_fn_post .title_holder span.category a:after,
		.fotofly_fn_galleryblock .title_holder span a:after,
		.widget_block ul.menu > li:after,
		ul.brochures li a i{background-color: {$link_color};}
		
		.woocommerce .woocommerce-loop-product__title:hover,
		.fotofly_fn_clients_list .title_holder h3 a:hover,
		.fotofly_fn_gallerylist .minithumb .title_holder span a,
		.fotofly_fn_gallerylist .minithumb .title_holder span span.fn_cat,
		.posted_in a,
		.widget_archive ul li a,
		.widget_pages ul li a,
		.widget_meta ul li a,
		.widget_calendar table a,
		.widget_categories ul li a,
		.widget_recent_comments ul li a,
		.widget_recent_entries ul li a,
		.widget_rss ul li a,
		.wid-title span a,
		.widget_block ul.menu > li > a,
		.widget_block ul.menu li ul li a,
		.widget_block ul.menu li ul li a:hover,
		.tagcloud a,
		a.fotofly_fn_animated_link,
		.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder span.category a,
		.fotofly_fn_blog_wrap.blog_creative_1 .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_blog_wrap.blog_creative_2 .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_blog_wrap.blog_creative_3 .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_blog_wrap.blog_grid_modern .blog_wrapper ul.mypost li .title_holder span.category a,
		ul.fotofly_fn_portfolio_list .fotofly_fn_item > .title_wrap .fn_cat a,
		.fotofly_fn_portfolio_single .title_holder a,
		.fotofly_fn_psingle_mono .title_holder a,
		.fotofly_fn_psingle_sticky .title_holder a,
		.fotofly_fn_client_single[data-title-style='outside'] .works_list .item .title_holder > span a,
		.fotofly_fn_gallerylist.triple .title_holder span a,
		.fotofly_fn_gallerylist.triple .title_holder span a:after,
		.fotofly_fn_gallery_single .title_holder span a,
		.footer_social_list li a,
		.footer_social_list li a:hover,
		.fotofly_fn_post .title_holder span.category a,
		.fotofly_fn_mainbutton a,
		.fotofly_fn_hover_width a,
		.fotofly_fn_call_to_action a,
		.fotofly_fn_contact_info a,
		.fotofly_fn_member .social_list li a,
		.fotofly_fn_testimonial_slider a.t_occ:hover,
		.fotofly_fn_galleryblock .title_holder span a,
		.fotofly_fn_galleryblock_fullscreen .title_holder span a,
		.fotofly_fn_projectslider .title_holder span a,
		.calendar_wrap table td a,
		.tagged_as a, .posted_in a,
		.woocommerce-account .woocommerce-MyAccount-content p a,
		.woocommerce-account .addresses .title .edit,
		h1>a:hover,
		h2>a:hover,
		h3>a:hover,
		h4>a:hover,
		h5>a:hover,
		h6>a:hover,
		a,
		.widget_recent_comments ul li a,
		.widget_block.widget_rss li a.rsswidget,
		.fotofly_fn_intropage .closer,
		.fotofly_fn_searchpagelist_item a.read_more,
		.fotofly_fn_searchpage_nothing a.gotohome,
		.portfolio_btn a,
		.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_blog_wrap.blog_grid_modern .blog_wrapper ul.mypost li .title_holder h3 > a:hover,
		ul.fotofly_fn_portfolio_list .cover_image_wrap .title_wrap h3 a:hover,
		ul.fotofly_fn_portfolio_list .fotofly_fn_item > .title_wrap h3 a:hover,
		.fotofly_fn_portfolio_third .list_holder .list .title h3 a:hover,
		.fotofly_fn_portfolio_third[data-title-style='outside'] .list_holder .list .title > h3 a:hover,
		.fotofly_fn_proofgal .pixproof-data button,
		.fotofly_fn_clients_list .title_holder a:hover,
		ul.fotofly_fn_proofing_list a,
		.fotofly_fn_portfolio_list .title_holder h3 a:hover,
		.fotofly_fn_client_single[data-title-style='outside'] .works_list .item .title_holder > h3 a:hover,
		.fotofly_fn_gallerylist .title_wrap h3 a:hover,
		.fotofly_fn_gallerylist .seemore a,
		.fotofly_fn_blog_single_wrap .blog_single_wrapper .fn_post_header .link-post a,
		.fotofly_fn_tags > em,
		.fotofly_fn_tags > em a,
		.comment-navigation a,
		.fotofly_fn_comment span.author a:hover,
		.fotofly_fn_comment a.comment-reply-link,
		.fotofly_fn_comment a.comment-edit-link,
		.fotofly_fn_comment div.comment-text p > a,
		.fotofly_fn_comment h3.comment-reply-title a,
		.fotofly_fn_comment .logged-in-as,
		.fotofly_fn_comment .logged-in-as a:first-child,
		.fotofly_fn_comment .logged-in-as a:last-child,
		.fotofly_fn_footer .cright_content span a,
		.fotofly_fn_post .title_holder > a,
		.fotofly_fn_link a,
		.fotofly_fn_aboutslider .about_content a,
		.fotofly_fn_w_cortex_slider_wrap h3 a:hover,
		.fotofly_fn_w_multi_scroll .title_holder h3 a:hover,
		.fotofly_fn_category_column_portfolio table .title_holder h3 a:hover,
		.fotofly_fn_category_column_gallery table .title_holder h3 a:hover,
		.w_cpost_carousel .title_holder h3 a:hover,
		.fotofly_fn_w_cuspostcatfol_wrap[data-skin='dark'] .fotofly_fn_w_cuspostcatfol .title_holder h3 a:hover,
		.fotofly_fn_w_custompost_ribbon_wrap .title_holder h3 a:hover,
		ul.w_blog_list .title_holder h3 a:hover,
		.fotofly_fn_halfimage .info_content a,
		.fotofly_fn_instagram .following h3:hover a,
		.fotofly_fn_instagram[data-skin='dark'] .following h3 a:hover,
		.fotofly_fn_about_me .info_content .btn a,
		.fotofly_fn_accordion .accordion_in.acc_active .acc_head,
		.fotofly_fn_tabs[data-layout='beta'] ul.etabs li a.active,
		.fotofly_fn_galleryblock .content_holder a,
		.fotofly_fn_galleryblock_fullscreen .title_holder h3 a:hover,
		.fotofly_fn_w_cuspost_parallax_wrap[data-skin='dark'] .fotofly_fn_galleryblock .title_holder h3 a:hover,
		.fotofly_fn_projectslider .content_holder a,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
		a.woocommerce-review-link,
		.woocommerce .fn_cart-empty a.button,
		.woocommerce table.shop_table td.product-name a,
		.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
		.woocommerce-account .woocommerce-MyAccount-navigation a:hover,
		.fotofly_fn_woo_login_inner p a,
		.fotofly_fn_projectslider_wrap[data-skin='dark'] .fotofly_fn_projectslider .title_holder h1 a:hover{color: {$link_color};}

		.fotofly_fn_blog_wrap.blog_mosaic .blog_wrapper ul.mypost li .title_holder h3 a:hover{color: {$link_color} !important;}


		.fotofly_fn_intropage .closer,
		a.woocommerce-review-link,
		.woocommerce table.shop_table td.product-name a,
		.woocommerce .fn_cart-empty a.button,
		.fotofly_fn_searchpagelist_item a.read_more,
		.fotofly_fn_searchpage_nothing a.gotohome,
		.portfolio_btn a,
		.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_proofgal .pixproof-data button,
		ul.fotofly_fn_proofing_list a,
		.fotofly_fn_gallerylist .seemore a,
		.fotofly_fn_blog_single_wrap .blog_single_wrapper .fn_post_header .link-post a,
		.fotofly_fn_footer .cright_content span a:hover,
		.fotofly_fn_post .title_holder > a,
		.fotofly_fn_link a,
		.fotofly_fn_aboutslider .about_content a,
		.fotofly_fn_about_me .info_content .btn a,
		.fotofly_fn_tabs[data-layout='beta'] ul.etabs li a.active,
		.fotofly_fn_galleryblock .content_holder a,
		.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
		.fotofly_fn_woo_login_inner p a,
		.woocommerce-account .woocommerce-MyAccount-content p a,
		.woocommerce-account .addresses .title .edit,
		.tagcloud a:hover,
		.fotofly_fn_client_single[data-title-style='outside'] .works_list .item .title_holder > span a:hover,
		.fotofly_fn_blog_wrap.blog_creative_1 .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_blog_wrap.blog_creative_2 .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_blog_wrap.blog_creative_3 .blog_wrapper ul.mypost li .title_holder > a,
		.fotofly_fn_testimonial_slider a.t_occ:hover,
		.wid-title span a,
		.widget_recent_comments ul li a, .widget_block.widget_rss li a.rsswidget,
		.fotofly_fn_projectslider .content_holder a{border-bottom-color:{$link_color};}


		@media (max-width: 768px){
		.fotofly_fn_galleryblock_halfimg .title_holder h3 a:hover{color: {$link_color};}
		}
		.fotofly_fn_hover_width a,
		.woocommerce-error{border-color: {$link_color};}
		";
		$heading_color = $fotofly_fn_option['heading_color'];
		$fotofly_fn_custom_css .= "
		.flow_gallery_title h3,
		.fotofly_fn_alert .alert_content h3,
		.fotofly_fn_halfimage .info_content h3,
		.fotofly_fn_password_protected_content > .in > div:hover .icon_holder i,
		.fotofly_fn_workstep .title_holder h3,
		.comment-reply-title,
		h1>a,h2>a,h3>a,h4>a,h5>a,h6>a,
		.fotofly_fn_portfolio_third[data-title-style='outside'] .list_holder .list .title > h3 a,
		.fotofly_fn_clients_list .title_holder h3,
		.fotofly_fn_client_infobar .info .title h3,
		.fotofly_fn_client_single[data-title-style='outside'] .works_list .item .title_holder > h3 a,
		.fotofly_fn_about .title_holder h3,
		.fotofly_fn_blog_single_wrap .blog_single_wrapper .post_content .title_holder h3,
		.fotofly_fn_comment h3.comment-reply-title,
		.fotofly_fn_maintitle .title_holder h3,
		.fotofly_fn_unit_info .title_holder h3,
		.fotofly_fn_hover_width h3,
		.fotofly_fn_servicetab_single .content_holder h3,
		.fotofly_fn_service_carousel .title_holder h3,
		.fotofly_fn_aboutslider .about_content h3,
		.fotofly_fn_sertabs .content_holder h3,
		.fotofly_fn_halfimage .info_content h3,
		.fotofly_fn_instagram .following h3 a,
		.fotofly_fn_about_me .info_content .title_holder h3,
		.flow_gallery_title h3,
		.fotofly_fn_workstep .title_holder h3,
		.w_cpost_carousel .main_title_holder h2,
		.fotofly_fn_testimonial_single .title_holder h4,
		.fotofly_fn_searchpagelist_item h1,
		.fotofly_fn_portfolio_single .title_holder h1,
		.fotofly_fn_psingle_mono .mono_title_opener h1,
		.fotofly_fn_psingle_mono .title_holder h1,
		.fotofly_fn_psingle_sticky .title_holder h1,
		.fotofly_fn_comment span.author a,
		.fotofly_fn_comment span.author,
		.fotofly_fn_title_content span,
		.woocommerce div.product .product_title,
		.single_product_related_wrap h2,
		.woocommerce .fotofly_fn_woo_myaccount form legend,
		.woocommerce-page .cart-collaterals .cart_totals h2,
		.woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3,
		.fotofly_fn_comment h5.comment-title{color: {$heading_color};}
		.fotofly_fn_content_title_wrap .title_holder h3{color: {$heading_color} !important;}
		";
		$body_color = $fotofly_fn_option['body_color'];
		$fotofly_fn_custom_css .= "
		body,
		.woocommerce table.shop_table tr,
		.fotofly_fn_prevnext .arrow p svg,
		.comment-form-rating label,
		p.comment-form-author label, p.comment-form-email label, p.comment-form-comment label,
		.fotofly_fn_comment span.time,
		.tagged_as, .posted_in, .sku_wrapper,
		.woocommerce div.product .woocommerce-tabs .panel p,
		.fotofly_fn_contact_info h3,
		.woocommerce form .form-row label,
		.woocommerce ul.products > li .title_wrap a span.price,
		span.woocommerce-Price-amount.amount,
		.fotofly_fn_wrap_sorting p.woocommerce-result-count,
		.woocommerce-product-details__short-description p,
		.woocommerce form .form-row .required,
		.woocommerce-error, .woocommerce-info, .woocommerce-message,
		.woocommerce-account address,
		p,ul,blockquote,
		.fotofly_fn_tabs .tabcontent,
		.woocommerce-account .woocommerce-MyAccount-content p,
		.woocommerce .fn_cart-empty span,
		.gallery-caption,
		.widget_block,
		.tagcloud span,
		.widget_recent_comments ul li,
		.widget_block.widget_rss .rss-date,
		.widget_block.widget_rss cite,
		.textwidget p,
		.calendar_wrap table,
		.calendar_wrap table td,
		.calendar_wrap table th,
		.calendar_wrap table tr,
		.calendar_wrap table th,
		.fotofly_fn_searchpagelist_item .sub,
		.fotofly_fn_searchpagelist_item p,
		.fotofly_fn_searchpage_nothing p,
		.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder > span,
		.fotofly_fn_blog_wrap .blog_wrapper ul.mypost li .title_holder p,
		.fotofly_fn_blog_wrap.blog_grid_modern .blog_wrapper ul.mypost li .title_holder > span,	
		.fotofly_fn_pagesplit_partcontent p,
		ul.fotofly_fn_portfolio_list .fotofly_fn_item > .title_wrap .fn_cat,
		.fotofly_fn_portfolio_third .title_holder p,
		.fotofly_fn_portfolio_single .info p,
		.fotofly_fn_prevnext .arrow p svg,
		.fotofly_fn_prevnext .arrow p span,
		.fotofly_fn_portfolio_single .title_holder > span,
		.fotofly_fn_psingle_mono .title_holder > span,
		.fotofly_fn_psingle_mono .content_part_in .info p,
		.fotofly_fn_psingle_sticky .title_holder > span,
		.fotofly_fn_psingle_sticky .info p,
		.fotofly_fn_proofgal .pixproof-data span,
		.fotofly_fn_clients_list .title_holder span,
		.fotofly_fn_client_infobar .info .title p,
		.fotofly_fn_client_infobar .info .subtitle p,
		ul.fotofly_fn_proofing_list span,
		.fotofly_fn_about .info_holder p,
		form.wpcf7-form p label,
		div.wpcf7-validation-errors,
		.fotofly_fn_gallerylist .minithumb .title_holder > span,
		.fotofly_fn_gallerylist.triple .title_holder > span,
		.fotofly_fn_gallery_single .title_holder > span,
		.fotofly_fn_gallery_single .title_holder p span,
		.fotofly_fn_social_icons > label,
		.fotofly_fn_blog_single_wrap .blog_single_wrapper .post_content .title_holder > span,
		.fotofly_fn_blog_single_wrap .blog_single_wrapper .post_content .content_holder p,
		.fotofly_fn_tags > label,
		.fotofly_fn_comment div.comment-text p,
		.fotofly_fn_comment .input-holder label,
		.fotofly_fn_comment .input-holder span,
		.fotofly_fn_footer .cright_content span,
		.fotofly_fn_post .title_holder > span,
		.fotofly_fn_post .title_holder p,
		.fotofly_fn_password_protected_content > .in p,
		.fotofly_fn_maintitle .title_holder p,
		.fotofly_fn_unit_info .title_holder p,
		.fotofly_fn_hover_width p,
		.fotofly_fn_servicetab_single .content_holder p,
		.fotofly_fn_servicetab_single .content_holder ul li,
		.fotofly_fn_servicetab_single .content_holder .price_holder .text,
		.fotofly_fn_service_carousel .title_holder .text,
		.fotofly_fn_service_carousel .list_holder ul li,
		.fotofly_fn_aboutslider .about_content p,
		.fotofly_fn_servicelist .item p,
		.fotofly_fn_servicelist .number,
		.fotofly_fn_servicelist .item .arrow,
		.w_cpost_carousel .main_title_holder p,
		.fotofly_fn_w_cuspostcatfol .title_holder p,
		.fotofly_fn_testimonial_single .content_holder p,
		.fotofly_fn_testimonial_single .title_holder p,
		.fotofly_fn_sertabs .content_holder p,
		.fotofly_fn_sertabs .content_holder ul li,
		.fotofly_fn_sertabs .content_holder .price_holder .text,
		.fotofly_fn_contact_info p,
		.fotofly_fn_contact_info .callbox:before,
		.details_popup table,
		.fotofly_fn_social_list > label,
		.fotofly_fn_halfimage .info_content p,
		.fotofly_fn_instagram .following .fotofly_fn_svg,
		.fotofly_fn_about_me .info_content .title_holder p,
		.fotofly_fn_accordion .accordion_in .acc_content,
		.fotofly_fn_accordion .accordion_in .acc_content p,
		.fotofly_fn_alert .alert_content p,
		.fotofly_fn_expandable .econtent,
		.fotofly_fn_counter_list li i,
		.fotofly_fn_counter_list li span,
		.fotofly_fn_member .fotofly_fn_member_holder .title_holder span,
		.fotofly_fn_progress span.label,
		.fotofly_fn_progress span.number,
		.fotofly_fn_testimonial_slider .slider_text p,
		.fotofly_fn_testimonial_slider span.t_author,
		.fotofly_fn_testimonial_slider .t_occ,
		.fotofly_fn_testimonial_slider .fotofly_fn_nav span,
		.carouselle .carousel-item p,
		.testimonials span.t_author,
		.testimonials p.t_author_oc,
		.testimonials .fotofly_fn_item_in.dark .carouselle .carousel-item p,
		.fotofly_fn_workstep .content_holder p,
		.fotofly_fn_galleryblock .title_holder span,
		.fotofly_fn_galleryblock .content_holder p,
		.fotofly_fn_galleryblock .fotofly_fn_galleryblock_fullscreen .content_holder p,
		.fotofly_fn_projectslider .title_holder span,
		.fotofly_fn_w_custompost_carousel_2[data-skin='dark'] .w_cpost_carousel.c2 .main_title_holder p,
		.fotofly_fn_projectslider .content_holder p{color: {$body_color};}


		.fotofly_fn_comment span.time:after{background-color: {$body_color};}


		.calendar_wrap table,
		.calendar_wrap table td,
		.calendar_wrap table th,
		.calendar_wrap table tr{border-color: {$body_color};}

		.fotofly_fn_servicetab_single .content_holder ul li{border-top-color: {$body_color};}
		";
	}
	/****************************** END styles *****************************/
	if(isset($fotofly_fn_option['custom_css'])){
		$fotofly_fn_custom_css .= "	{$fotofly_fn_option['custom_css']}";	
	}

	wp_add_inline_style( 'fotofly_fn_inline', $fotofly_fn_custom_css );

			
}

?>