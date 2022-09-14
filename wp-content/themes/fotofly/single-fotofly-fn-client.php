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
$fotofly_fn_page_spaces =' ';

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

// Post Thumbnail		
$postid = get_the_ID();
$fotofly_fn_client_image = $fotofly_fn_cover_image = $src1[0] = $src2[0] = '';

if(function_exists('rwmb_meta')){
	$fotofly_fn_client_images = rwmb_meta( 'fotofly_fn_client_photo', 'type=image&size=full', $postid);
	$fotofly_fn_cover_images = rwmb_meta( 'fotofly_fn_client_cover_photo', 'type=image&size=full', $postid);
	
	if($fotofly_fn_client_images){
		foreach($fotofly_fn_client_images as $img){
			$src1 = wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-300-300' );
			$fotofly_fn_client_image = '<img src="'.esc_url($src1[0]).'" alt="'.esc_attr($img['title']).'" />';
		} 
	}
	if($fotofly_fn_cover_images){
		foreach($fotofly_fn_cover_images as $img){
			$src2 = wp_get_attachment_image_src( $img['ID'], 'full' );
			$fotofly_fn_cover_image = '<img src="'.esc_url($src2[0]).'" alt="'.esc_attr($img['title']).'" />';
		} 
	}
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
						
	<div class="fotofly_fn_content_part" <?php echo esc_attr($fotofly_fn_page_spaces); ?>>
		
			
			<!-- MAIN CONTENT -->
			<div class="content_wrap">
				<div class="container">
				
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<div class="fotofly_fn_client_single">

					<?php

					$fotofly_fn_query = $fotofly_fn_post_img = $fotofly_fn_query_1 = $fotofly_fn_proofing_output = $buffy = $term_link = $fotofly_fn_post_cats = $output = $fotofly_fn_portfolio_images = $count_images = $off = $fotofly_fn_portfolio_locked_content = NULL;
 					
 					
 					$fotofly_fn_args_1 = array(
						'post_type' 		=> 'fotofly-fn-proofing',  
						'post_status' 		=> 'publish',  
						'posts_per_page' 	=> -1,
						'meta_key'			=> 'fotofly_fn_proofing_client',
						'meta_value'		=> $postid,
						'orderby'			=> 'date');
 
 					$fotofly_fn_query_1 = new WP_Query($fotofly_fn_args_1);
 
 					foreach ( $fotofly_fn_query_1->posts as $fotofly_fn_proofingpost ) {
						$fotofly_fn_proofing_id 			= $fotofly_fn_proofingpost->ID;
						$fotofly_fn_proofing_output  		.= '<li><div class="item"><span>'.esc_html__('You have a new gallery to confirm:', 'fotofly').'</span> <a href="'.get_permalink($fotofly_fn_proofing_id).'">'.$fotofly_fn_proofingpost->post_title.'</a></div></li>';
					}
 
 
 
					$count_photos = 0;
					$fotofly_fn_args = array(
						'post_type' 		=> 'fotofly-fn-portfolio',  
						'post_status' 		=> 'publish',  
						'posts_per_page' 	=> -1,
						'meta_key'			=> 'fotofly_fn_portfolio_client',
						'meta_value'		=> $postid,
						'orderby'			=> 'date');

					$fotofly_fn_query = new WP_Query($fotofly_fn_args);
					$fotofly_fn_post_count = $fotofly_fn_query->found_posts;


					foreach ( $fotofly_fn_query->posts as $fotofly_fn_portfoliopost ) {
							$fotofly_fn_portfolio_id 			= $fotofly_fn_portfoliopost->ID;

							// Check Meta Box Function Exists
							if(function_exists('rwmb_meta'))
							{
								$fotofly_fn_portfolio_images = rwmb_meta( 'fotofly_fn_portfolio_images', 'type=image&size=full', $fotofly_fn_portfolio_id );

								if($fotofly_fn_portfolio_images){
									$count_photos += sizeof($fotofly_fn_portfolio_images);	
								}else{
									$count_photos += 0;
								}
							}
						}

					?>


					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

						<div class="fotofly_fn_client_infobar">
							<div class="info">
								<div class="img_holder"><?php echo wp_kses_post($fotofly_fn_client_image); ?></div>
								<div class="title_holder">
									<div class="title">
										<p class="fotofly_fn_count">
											<?php 
											echo '<span>'.esc_html($fotofly_fn_post_count).' '; 
											if($fotofly_fn_post_count == 1){esc_html_e('Gallery', 'fotofly');}else{esc_html_e('Galleries', 'fotofly');} 

											echo '</span> / <span>'.$count_photos.' '.esc_html__('Photos', 'fotofly');
											?>
											</span>
										</p>
										<h3><?php the_title(); ?></h3>
									</div>
									<div class="subtitle"><?php the_content();?></div>
								</div>
							</div>
						</div>

						
						<ul class="fotofly_fn_proofing_list"><?php echo wp_kses_post($fotofly_fn_proofing_output); ?></ul>
						
						
						<?php 

						// RECENT GALLERY LIST
						foreach ( $fotofly_fn_query->posts as $fotofly_fn_portfoliopost ) {
							setup_postdata( $fotofly_fn_portfoliopost ); 

								$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
								$fotofly_fn_post_img 		= fotofly_fn_get_thumbnail('720', '9999', $fotofly_fn_post_id, false);
								$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
								$fotofly_fn_post_cats		= fotofly_fn_taxanomy_list($fotofly_fn_post_id, 'portfolio_category', false, 1);

								if(function_exists('rwmb_meta'))
								{
									$fotofly_fn_portfolio_images 	= rwmb_meta( 'fotofly_fn_portfolio_images', 'type=image&size=full', $fotofly_fn_post_id );

									if($fotofly_fn_portfolio_images){
										foreach(array_slice($fotofly_fn_portfolio_images, 0, 1) as $img){
											$object = wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-720-9999' );
											$image_extraURL = $object[0];
											$image_extra = '<img src="'.$image_extraURL.'" alt="" />';
										}
										if($fotofly_fn_post_img == ''){
											$fotofly_fn_post_img = $image_extra;
										}
									}
								}

								// Check Password Protection
								if(post_password_required($fotofly_fn_portfoliopost)){
									$fotofly_fn_portfolio_locked_content = '<div class="fotofly_fn_locked"><div><div><span><i class="xcon-lock"></i></span></div></div></div>';	
								}

								$buffy   .= '<li class="fotofly_fn_masonry_in">
												<div class="fotofly_fn_portfolio_item item">
													<div class="portfolio_cover">
														'.$fotofly_fn_portfolio_locked_content.'
														<div class="img_holder">'.$fotofly_fn_post_img.'</div>
														<div class="title_holder">
															<span>'.$fotofly_fn_post_cats.'</span>
															<h3>
																<a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a>
															</h3>
														</div>									
													</div>
												</div>
											</li>';
								$fotofly_fn_post_cats  = $fotofly_fn_portfolio_locked_content = $off = NULL; 
						}
						wp_reset_postdata();


						$output .= '<div class="fotofly_fn_portfolio_list"><ul class="fotofly_fn_masonry">';

						// OUTPUT
						if ( $buffy != NULL ) {
							$output .= $buffy; 
						}else{
							$output .= '<li class="nogallery"><div><span>'.esc_html__('No Gallery Posts are related to this client','fotofly').'</span></div></li>';
						}

						$output .= '</ul></div>';

						echo wp_kses_post($output);


						?>

						<div class="clearfix"></div>

					</article>

				</div>
				<?php endwhile; endif;?>
					
				</div>
			</div>
			<!-- /MAIN CONTENT -->
			
	</div>
<?php } ?>

<?php get_footer(); ?>  