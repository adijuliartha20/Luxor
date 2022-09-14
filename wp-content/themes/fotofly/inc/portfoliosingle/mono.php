<?php 
global $post, $fotofly_fn_option;
$fotofly_fn_categories = $fotofly_fn_post_cats = $fotofly_fn_portfolio_images = $fotofly_fn_portfolio_images_a_col = $fotofly_fn_portfolio_images_gutter = $fotofly_fn_portfolio_images_title = $fotofly_fn_portfolio_sideinfotemp = '';


// Post Thumbnail		
$postid = get_the_ID();
$post_thumbnail_id = get_post_thumbnail_id( $postid );
$src = wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-720-9999');

// Categories
$fotofly_fn_post_cats		= fotofly_fn_taxanomy_list($postid, 'portfolio_category', false, 2);


// Attached Images
if(function_exists('rwmb_meta')){
	$fotofly_fn_portfolio_images 			= rwmb_meta( 'fotofly_fn_portfolio_images', 'type=image&size=full' );
	$fotofly_fn_portfolio_images_gutter 	= rwmb_meta( 'fotofly_fn_portfolio_images_gutter' );
	$fotofly_fn_portfolio_images_title 		= rwmb_meta( 'fotofly_fn_portfolio_images_title' );	
}


/* From another pages */
$fotofly_fn_top_padding = '';
$fotofly_fn_bot_padding = '';
$fotofly_fn_page_spaces = '';

if(function_exists('rwmb_meta')){
	$fotofly_fn_top_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_top', true);
	$fotofly_fn_bot_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_bottom', true);
	
	$fotofly_fn_page_spaces = 'style=';
	if($fotofly_fn_top_padding != ''){$fotofly_fn_page_spaces .= 'padding-top:'.$fotofly_fn_top_padding.'px;';}
	if($fotofly_fn_bot_padding != ''){$fotofly_fn_page_spaces .= 'padding-bottom:'.$fotofly_fn_bot_padding.'px;';}
	if($fotofly_fn_top_padding == '' && $fotofly_fn_bot_padding == ''){$fotofly_fn_page_spaces = '';}
	
}

if(isset($fotofly_fn_option['portfolio_single_caption'])){
	$fotofly_fn_portfolio_caption = $fotofly_fn_option['portfolio_single_caption'];
}else{
	$fotofly_fn_portfolio_caption = 'disable';
}


// Start Post
if (have_posts()) : while (have_posts()) : the_post();?>


<div class="fotofly_fn_content_part single_mono_space">
	
		<!-- MAIN CONTENT -->
		<div class="content_wrap">
		
			<!-- SINGLE PORTFOLIO MONO -->
			<div class="fotofly_fn_psingle_mono">
			
				<!-- CONTENT PART -->
				<div class="content_part fn-effect-3" <?php echo esc_attr($fotofly_fn_page_spaces); ?>>
					<div class="content_part_in fn-content">
					
						
				 		<!-- CLOSER -->
				 		<span class="close_button">
				 			<span class="after"></span>
				 			<span class="before"></span>
				 		</span>
				 		<!-- /CLOSER -->
					
						<div class="title_holder">
							<h1><?php the_title(); ?></h1>
							<span>
								<span class="cat"><?php echo wp_kses_post($fotofly_fn_post_cats); ?></span>
								<span class="slash">/</span>
								<span class="date"><?php the_time(get_option('date_format')); ?></span>
							</span>
						</div>

						<div class="info">
							<?php the_content(); ?>
						</div>

						<?php 
							if($fotofly_fn_option['portfolio_share_icon'] == 'enable'){
								// SHARE BUTTON
								get_template_part( 'inc/fotofly_fn_sharebox_post');
								// SHARE BUTTON
							}
						?>

						<?php 
							$prevnext		= '';
							$previous_post 	= get_adjacent_post(false, '', true);
							$next_post 		= get_adjacent_post(false, '', false);

							if ($previous_post && $next_post) { 
								$prevnext	= 'yes';
							}else if(!$previous_post && $next_post){
								$prevnext	= 'next';
							}else if($previous_post && !$next_post){
								$prevnext	= 'prev';
							}else{
								$prevnext	= 'no';
							}
						
							if($fotofly_fn_option['portfolio_single_prevnextbox'] === 'disable'){
								$prevnext = 'no';
							}

						?>

						<div class="fotofly_fn_prevnext" data-switch="<?php echo esc_attr($prevnext); ?>">
							<div class="prevnext_inner fotofly_fn_miniboxes">
								<div class="arrow fotofly_fn_minibox previous_post">
									<div class="prev">
										<div class="pp">
											<p>
												<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/left-arrow.svg" alt="" />
												<span><?php echo esc_html__('Previous', 'fotofly'); ?></span>
											</p>
										</div>
										<h3><?php previous_post_link('%link'); ?></h3>
									</div>
								</div>
								<div class="arrow fotofly_fn_minibox next_post">
									<div class="next">
										<div class="pp">
											<p>
												<span><?php echo esc_html__('Next', 'fotofly'); ?></span>
												<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/left-arrow.svg" alt="" />
											</p>
										</div>
										<h3><?php next_post_link('%link'); ?></h3>
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
				<!-- /CONTENT PART -->
				
				<!-- SLIDER PART -->
				<div class="slider_part">
					<div class="mono_slider">
						<ul class="slides frenify_fn_lightbox">

							 <?php
								if($fotofly_fn_portfolio_images)
								{   
									$count = sizeof($fotofly_fn_portfolio_images);

									foreach($fotofly_fn_portfolio_images as $img){

										$src 	= wp_get_attachment_image_src( $img['ID'], 'full' );
										$src 	= $src[0];

										$src2 	= wp_get_attachment_image_src( $img['ID'], 'full' );
										$src2 	= $src2[0];

										$playicon	= '';
										$video_url 	= get_post_meta( $img['ID'], '_image_video_url', true );
										if($video_url !== ''){
											$src2		= $video_url;
											$iconImg 	= '<img class="fotofly_fn_svg" src="'.get_template_directory_uri() .'/framework/img/svg/play-video.svg" alt="" />';
											$overlay	= '<div class="fotofly_fn_videoitem_overlay"></div>';
											$playicon	= '<span class="fotofly_fn_videoitem">'.$iconImg.'</span>'.$overlay;
										}
										$forLG 	= '<img src="'.$src.'" alt="" />';
										?>

										<li>
											<div class="single lightbox" data-src="<?php echo esc_attr($src2); ?>">
												<?php echo wp_kses_post($forLG);?>
												<div class="single_o_img" style="background-image: url(<?php echo esc_url($src);?>)"></div>
												<?php echo wp_kses_post($playicon); ?>
												<!-- CAPTION -->
												<?php if($fotofly_fn_portfolio_caption === 'enable'){ ?>
												<div class="fotofly_fn_hovercaption">
													<h3><?php echo esc_html($img['title']);?></h3>
													<h5><?php echo esc_html($img['caption']);?></h5>
												</div>
												<?php } ?>
												<!-- /CAPTION -->
											</div>
										</li><?php

									 } 
								}?>

						</ul>
					</div>
				</div>
				<!-- /SLIDER PART -->
				
				<div class="mono_title_opener">
					<h1><?php the_title();?></h1>
				</div>
				
			</div>
			<!-- /SINGLE PORTFOLIO MONO -->
    	
		</div>
		<!-- /MAIN CONTENT -->

</div>

<?php  endwhile; endif;?>