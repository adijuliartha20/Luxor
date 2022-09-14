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
	if(isset($_GET['top_space'])){$fotofly_fn_top_padding = $_GET['top_space'];}
	
	$fotofly_fn_page_spaces = 'style=';
	if($fotofly_fn_top_padding != ''){$fotofly_fn_page_spaces .= 'padding-top:'.$fotofly_fn_top_padding.'px;';}
	if($fotofly_fn_bot_padding != ''){$fotofly_fn_page_spaces .= 'padding-bottom:'.$fotofly_fn_bot_padding.'px;';}
	if($fotofly_fn_top_padding == '' && $fotofly_fn_bot_padding == ''){$fotofly_fn_page_spaces = '';}
}

$gsinglelayout = 'masonry';
if(isset($fotofly_fn_option['gallery_single_layout'])){
	$gsinglelayout = $fotofly_fn_option['gallery_single_layout'];
}
if(function_exists('rwmb_meta')){
	$gsinglelayout = rwmb_meta( 'fotofly_fn_gallery_single_layout' );
}
if(isset($_GET['temp'])){$gsinglelayout = $_GET['temp'];}

// Start Post
if (have_posts()) : while (have_posts()) : the_post();?>


		
<div class="fotofly_fn_content_part" <?php echo esc_attr($fotofly_fn_page_spaces); ?>>
	
		<!-- MAIN CONTENT -->
		<div class="content_wrap">
		
			
			<div class="fotofly_fn_gallery_single <?php echo esc_attr($gsinglelayout);?>">
				
				
				
				<div class="clearfix"></div>
				
				<div class="fotofly_fn_gsingle_list <?php echo esc_attr($gsinglelayout);?>">
					<div class="flexslider">
						<ul class="slides frenify_fn_lightbox">

							 <?php
								if($fotofly_fn_gallery_images)
								{   
									$count = sizeof($fotofly_fn_gallery_images);

									foreach($fotofly_fn_gallery_images as $img){

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
										?>

										<li>
											<div class="lightbox" data-src="<?php echo esc_attr($src2);?>" data-sub-html="">
												<img class="myghost" src="<?php echo esc_url($src); ?>" alt="<?php echo esc_attr($img['ID']); ?>" />
												<div class="overlay_img" style="background-image: url('<?php echo esc_url($src);?>')"></div>
												<?php echo wp_kses_post($playicon); ?>
											</div>
										</li><?php

									 } 
								}?>


						</ul>
						
						
					</div>
				</div>
				
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