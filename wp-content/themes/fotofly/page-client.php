<?php
/*
	Template Name: Client Page
*/
get_header();

global $post, $fotofly_fn_option;
$fotofly_fn_pagestyle = '';
$fotofly_fn_pagetitle = '';
$fotofly_fn_page_breadcrumbs = '';
$fotofly_fn_pagetitletype = '';
$fotofly_fn_pagetitleimg = '';
$fotofly_fn_top_padding = '';
$fotofly_fn_bot_padding = '';
$fotofly_fn_parallax = '';
$fotofly_fn_titlebg = '';
$fotofly_fn_parallaxspeed = '';
$fotofly_fn_page_title_color = '';
$fotofly_fn_media = '';
$fotofly_fn_page_breadcrumbs_aa = '';
$fotofly_fn_clientpagetemp = '';
$fotofly_fn_nosplit = '';
$fotofly_fn_page_spaces = '';

if(function_exists('rwmb_meta')){
	$fotofly_fn_pagestyle 			= get_post_meta(get_the_ID(),'fotofly_fn_page_pagestyle', true);
	$fotofly_fn_pagetitle 			= get_post_meta(get_the_ID(),'fotofly_fn_page_title', true);
	$fotofly_fn_page_breadcrumbs 	= get_post_meta(get_the_ID(),'fotofly_fn_page_breadcrumbs', true);
	$fotofly_fn_pagetitletype 		= get_post_meta(get_the_ID(),'fotofly_fn_page_title_type', true);
	$fotofly_fn_pagetitleimg 		= get_post_meta(get_the_ID(),'fotofly_fn_page_title_img', true);
	$fotofly_fn_top_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_top', true);
	$fotofly_fn_bot_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_bottom', true);
	$fotofly_fn_parallaxspeed 		= get_post_meta(get_the_ID(),'fotofly_fn_page_parallax_speed', true)/10;
	$fotofly_fn_page_title_color 	= get_post_meta(get_the_ID(),'fotofly_fn_page_title_color', true);
	
	if($fotofly_fn_pagestyle == 'fotofly_fn_rightsidebar' || $fotofly_fn_pagestyle == 'fotofly_fn_fullwidth' || $fotofly_fn_pagestyle == false){
		$fotofly_fn_x_pos = 'float-left';
	}else{
		$fotofly_fn_x_pos = 'float-right';
	}
	if($fotofly_fn_pagetitleimg != ''){
		$fotofly_fn_media = 'media';
	}
		
	if($fotofly_fn_pagestyle == 'fotofly_fn_leftsidebar'){$fotofly_fn_last = 'last';}
	
	$fotofly_fn_page_spaces = 'style=';
	if($fotofly_fn_top_padding != ''){$fotofly_fn_page_spaces .= 'padding-top:'.$fotofly_fn_top_padding.'px;';}
	if($fotofly_fn_bot_padding != ''){$fotofly_fn_page_spaces .= 'padding-bottom:'.$fotofly_fn_bot_padding.'px;';}
	if($fotofly_fn_top_padding == '' && $fotofly_fn_bot_padding == ''){$fotofly_fn_page_spaces = '';}
	
	$fotofly_fn_titlebg = wp_get_attachment_image_src($fotofly_fn_pagetitleimg, 'full'); 	// TITLE BG IMG
	
	if($fotofly_fn_pagetitletype == 'parallax'){$fotofly_fn_parallax = 'fotofly_fn_jarallax';}else{$fotofly_fn_parallax = '';}
	
	
}

$fotofly_fn_clientpagetemp = $fotofly_fn_option['client_template'];
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	if(isset($_GET['temp'])){$fotofly_fn_clientpagetemp = $_GET['temp'];}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */


// CHeck if page is password protected
if(post_password_required($post)){
	echo '<div class="fotofly_fn_password_protected_content">
			<div class="in">
				<div>
					<div class="message_holder">
						'.get_the_password_form().'
						<div class="icon_holder"><i class="xcon-lock"></i></div>
					</div>
				</div>
			</div>
		  </div>';
}
else{
?>
	
			
	
	<!-- MAIN TITLE -->
	<?php if($fotofly_fn_pagetitle !== 'disable' || $fotofly_fn_page_breadcrumbs !== 'disable'){ ?>
		<div class="fotofly_fn_content_title_wrap <?php echo esc_attr($fotofly_fn_page_title_color.' '.$fotofly_fn_media); ?>"
		data-breadcrumbs="<?php echo esc_attr($fotofly_fn_page_breadcrumbs); ?>" 
		data-title="<?php echo esc_attr($fotofly_fn_pagetitle); ?>">

			<div class="fotofly_fn_page_title_wrap">
				<div class="container">

					<!-- BREADCRUMBS -->
					<?php 
						if($fotofly_fn_page_breadcrumbs !== 'disable'){fotofly_fn_breadcrumbs(); }
					?>
					<!-- /BREADCRUMBS -->

					<!-- TITLE -->
					<?php if($fotofly_fn_pagetitle !== 'disable'){ ?>
						<div class="title_holder">
							<h3><?php the_title(); ?></h3>
						</div>
					<?php } ?>
					<!-- /TITLE -->

				</div>
			</div>

			<!-- TITLE BACKGROUND -->
			<?php if($fotofly_fn_pagetitleimg != '') { // if img ?>
				<div class="fotofly_fn_page_title_bg_wrap">
					<div class="page_title_bg <?php echo esc_html($fotofly_fn_parallax); ?>" style="background-image:url(<?php echo esc_url($fotofly_fn_titlebg[0]); ?>);" data-speed="<?php echo esc_attr($fotofly_fn_parallaxspeed);?>"></div>
					<div class="page_title_overlay gra"></div>	
				</div>
			<?php } ?>
			<!-- /TITLE BACKGROUND -->

		</div>
	<?php } ?>
	<!-- /MAIN TITLE -->
	<div class="fotofly_fn_content_part" <?php echo esc_attr($fotofly_fn_page_spaces);?>>
				
			<!-- MAIN CONTENT -->
			<div class="content_wrap">
				<div class="container">
					
					
					<?php

						if($fotofly_fn_clientpagetemp === 'default'){
							get_template_part( 'inc/client/default');
						}else if($fotofly_fn_clientpagetemp === 'hover_shadow'){
							get_template_part( 'inc/client/hover_shadow');
						}else if($fotofly_fn_clientpagetemp === 'below_thumb'){
							get_template_part( 'inc/client/below_thumb');
						}else if($fotofly_fn_clientpagetemp === 'separated_thumb'){
							get_template_part( 'inc/client/separated_thumb');
						}else if($fotofly_fn_clientpagetemp === 'inline'){
							get_template_part( 'inc/client/inline');
						}else if($fotofly_fn_clientpagetemp === 'flipped'){
							get_template_part( 'inc/client/flipped');
						}else{
							get_template_part( 'inc/client/default');	
						}
					?>
				
				</div>
			</div>
			<!-- /MAIN CONTENT -->
			
	</div>
					

<?php
}
get_footer();
?>  