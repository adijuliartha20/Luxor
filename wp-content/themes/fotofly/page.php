<?php

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
$fotofly_fn_last = '';
$fotofly_fn_page_spaces = '';

if(function_exists('rwmb_meta')){
	$fotofly_fn_pagestyle 			= get_post_meta(get_the_ID(),'fotofly_fn_page_style', true);
	$fotofly_fn_pagetitle 			= get_post_meta(get_the_ID(),'fotofly_fn_page_title', true);
	$fotofly_fn_page_breadcrumbs 	= get_post_meta(get_the_ID(),'fotofly_fn_page_breadcrumbs', true);
	$fotofly_fn_pagetitletype 		= get_post_meta(get_the_ID(),'fotofly_fn_page_title_type', true);
	$fotofly_fn_pagetitleimg 		= get_post_meta(get_the_ID(),'fotofly_fn_page_title_img', true);
	$fotofly_fn_top_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_top', true);
	$fotofly_fn_bot_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_bottom', true);
	$fotofly_fn_parallaxspeed 		= get_post_meta(get_the_ID(),'fotofly_fn_page_parallax_speed', true)/10;
	$fotofly_fn_page_title_color 	= get_post_meta(get_the_ID(),'fotofly_fn_page_title_color', true);
	
	// page styles
	if($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'full' || $fotofly_fn_pagestyle == false){
		$fotofly_fn_x_pos = 'float-left';
	}else{
		$fotofly_fn_x_pos = 'float-right';
	}
	
	if($fotofly_fn_pagestyle == 'ls'){$fotofly_fn_last = 'last';}
	
	// title
	if($fotofly_fn_pagetitleimg != ''){
		$fotofly_fn_media = 'media';
	}
		
	
	
	$fotofly_fn_page_spaces = 'style=';
	if($fotofly_fn_top_padding != ''){$fotofly_fn_page_spaces .= 'padding-top:'.$fotofly_fn_top_padding.'px;';}
	if($fotofly_fn_bot_padding != ''){$fotofly_fn_page_spaces .= 'padding-bottom:'.$fotofly_fn_bot_padding.'px;';}
	if($fotofly_fn_top_padding == '' && $fotofly_fn_bot_padding == ''){$fotofly_fn_page_spaces = '';}
	
	$fotofly_fn_titlebg = wp_get_attachment_image_src($fotofly_fn_pagetitleimg, 'full'); 	// TITLE BG IMG
	
	if($fotofly_fn_pagetitletype == 'parallax'){$fotofly_fn_parallax = 'fotofly_fn_jarallax';}else{$fotofly_fn_parallax = '';}
	
	
}


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
else
{

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

			<?php if($fotofly_fn_pagetitleimg != '') { // if img ?>
			<div class="fotofly_fn_page_title_bg_wrap">
				<div class="page_title_bg <?php echo esc_html($fotofly_fn_parallax); ?>" style="background-image:url(<?php echo esc_url($fotofly_fn_titlebg[0]); ?>);" data-speed="<?php echo esc_attr($fotofly_fn_parallaxspeed);?>"></div>
				<div class="page_title_overlay gra"></div>	
			</div>
			<?php } ?>

		</div>
	<?php } ?>
	<!-- /MAIN TITLE -->
						
	<div class="fotofly_fn_content_part" <?php echo esc_attr($fotofly_fn_page_spaces); ?>>
		
			
			<!-- MAIN CONTENT -->
			<div class="content_wrap">
				<div class="container">
				
				
					<?php

					// FULL WIDTH
					if($fotofly_fn_pagestyle == 'full' || $fotofly_fn_pagestyle == false){ ?>
					
						<!-- PAGE -->
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<?php the_content(); ?>

							<?php if ( comments_open()){?>
							<!-- Comments -->
							<div class="fotofly_fn_comment" id="comments">
								<?php comments_template(); ?>
							</div>
							<!-- /Comments -->
							<?php } ?>

						<?php endwhile; endif; ?>
						<!-- /PAGE -->
					
					<?php
						
					}else{ // WITH SIDEBAR ?>
					
						<div class="fn-col-8 fix desc <?php  echo esc_attr($fotofly_fn_x_pos).' '.esc_attr($fotofly_fn_last); ?>">
                            <!-- PAGE -->
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<?php the_content(); ?>

								<?php if ( comments_open()){?>
								<!-- Comments -->
								<div class="fotofly_fn_comment" id="comments">
									<?php comments_template(); ?>
								</div>
								<!-- /Comments -->
								<?php } ?>

							<?php endwhile; endif; ?>
							<!-- /PAGE -->
                        </div>
                        
                        
                        <!-- SIDEBAR -->
                        <?php get_sidebar(); ?>
                        <!-- /SIDEBAR -->
					
					<?php
					}?>
				</div>
			</div>
			<!-- /MAIN CONTENT -->
			
	</div>
<?php } ?>

<?php get_footer(); ?>  