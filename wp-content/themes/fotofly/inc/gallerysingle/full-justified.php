<?php 
global $post, $fotofly_fn_option;
$fotofly_fn_categories = $fotofly_fn_post_cats = $fotofly_fn_gallery_images = $fotofly_fn_gallery_images_a_col = $fotofly_fn_gallery_images_gutter = $fotofly_fn_gallery_images_title = $fotofly_fn_gallery_sideinfotemp = '';


// Post Thumbnail		
$postid = get_the_ID();
$post_thumbnail_id = get_post_thumbnail_id( $postid );
$src = wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-720-9999');

// Categories
$fotofly_fn_post_cats		= fotofly_fn_taxanomy_list($postid, 'gallery_category', false, 2);


// Attached Images
if(function_exists('rwmb_meta')){
	$fotofly_fn_gallery_images 				= rwmb_meta( 'fotofly_fn_gallery_images', 'type=image&size=full' );
	$fotofly_fn_gallery_images_gutter 		= rwmb_meta( 'fotofly_fn_gallery_images_gutter' );
	$fotofly_fn_gallery_images_title 		= rwmb_meta( 'fotofly_fn_gallery_images_title' );	
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

$gsinglegutter = '10';
if(isset($fotofly_fn_option['m_g_j_gutter'])){
	$gsinglegutter = $fotofly_fn_option['m_g_j_gutter'];
}
$gsinglelayout = 'masonry';
if(isset($fotofly_fn_option['gallery_single_layout'])){
	$gsinglelayout = $fotofly_fn_option['gallery_single_layout'];
}
if(function_exists('rwmb_meta')){
	$gsinglelayout = rwmb_meta( 'fotofly_fn_gallery_single_layout' );
}
$gsinglejheight = '350';
if(isset($fotofly_fn_option['j_imgh'])){
	$gsinglejheight = $fotofly_fn_option['j_imgh'];
}

if(isset($_GET['temp'])){$gsinglelayout = $_GET['temp'];}
if(isset($_GET['height'])){$gsinglejheight = $_GET['height'];}
if(isset($_GET['gutter'])){$gsinglegutter = $_GET['gutter'];}

// Start Post
if (have_posts()) : while (have_posts()) : the_post();?>


		
<div class="fotofly_fn_content_part" <?php echo esc_attr($fotofly_fn_page_spaces); ?>>
	
		<!-- MAIN CONTENT -->
		<div class="content_wrap">
		
			
			<div class="fotofly_fn_gallery_single <?php echo esc_attr($gsinglelayout);?>">
				
				
				<div class="clearfix"></div>
				
				<div class="fotofly_fn_gsingle_list <?php echo esc_attr($gsinglelayout);?>" data-gutter="<?php echo esc_attr($gsinglegutter);?>">
					<div>
						<div class="fotofly_fn_justified_images frenify_fn_lightbox" data-just-h="<?php echo esc_attr($gsinglejheight); ?>" data-just-g="<?php echo esc_attr($gsinglegutter);?>">
							
							 <?php
								if($fotofly_fn_gallery_images)
								{   
									$count = sizeof($fotofly_fn_gallery_images);

									foreach($fotofly_fn_gallery_images as $img){

										$src 	= wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-9999-700' );
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
										?>


										<a class="lightbox" href="" data-src="<?php echo esc_attr($src2); ?>" data-sub-html="">
											<img src="<?php echo esc_url($src); ?>" alt="" />
											<?php echo wp_kses_post($playicon); ?>
										</a><?php

									 } 
								}?>


						</div>
						
						
					</div>
				</div>
				
				
				<!-- PRELOADER -->
				<div class="fotofly_fn_preloader">
					<div class="fn_preloader">
						<div class="fn-cube fn-cube1"></div>
						<div class="fn-cube fn-cube2"></div>
						<div class="fn-cube fn-cube3"></div>
						<div class="fn-cube fn-cube4"></div>
						<div class="fn-cube fn-cube5"></div>
						<div class="fn-cube fn-cube6"></div>
						<div class="fn-cube fn-cube7"></div>
						<div class="fn-cube fn-cube8"></div>
						<div class="fn-cube fn-cube9"></div>
					</div>
				</div>
				<!-- PRELOADER -->
				
				<div class="container">		
					<div class="title_holder">
						<h3><?php the_title(); ?></h3>
						<span>
							<span class="cat"><?php echo wp_kses_post($fotofly_fn_post_cats); ?></span>
							<span class="slash">/</span>
							<span class="date"><?php the_time(get_option('date_format')); ?></span>
						</span>
					</div>
				</div>
				
				<div class="clearfix"></div>

				<div class="container">
					<?php 
						// SHARE BUTTON
						get_template_part( 'inc/fotofly_fn_sharebox_post');
						// SHARE BUTTON 
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
					
						if($fotofly_fn_option['gallery_single_prevnextbox'] === 'disable'){
							$prevnext = 'no';
						}

					?>
					<!-- PREVNEXTBOX -->
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
					<!-- /PREVNEXTBOX -->
				</div>

			</div>
    	
		</div>
		<!-- /MAIN CONTENT -->

</div>

<?php  endwhile; endif;?>