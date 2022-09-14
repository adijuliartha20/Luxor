<?php 
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
$fotofly_fn_page_spaces = '';

$fotofly_fn_nosplit = '';

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
$fotofly_fn_nosplit 	= $fotofly_fn_option['blog_template'];
$fotofly_fn_blog_column = $fotofly_fn_option['blog_post_column'];
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

<!-- MAIN CONTENT -->
<div class="content_wrap">

	<!-- BLOG -->
	<div class="fotofly_fn_blog_wrap blog_grid_modern">
		<div class="fotofly_fn_blog">
			<div class="blog">
				<div class="blog_wrapper">

					<div class="blog_content">
						<ul class="mypost">

							<?php 
								if(is_front_page()) { $fotofly_fn_paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $fotofly_fn_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
								query_posts('posts_per_page=&paged='.esc_html($fotofly_fn_paged)); 


								if (have_posts()) : while (have_posts()) : the_post();
							?>
							<li id="post-<?php the_ID(); ?>">
								<div <?php post_class(); ?>>
									<?php 
										$thumb	= fotofly_fn_callback_thumbs(800,970);
										$bg_img = get_the_post_thumbnail_url(get_the_id(),'full');
									?>
									<?php 
										$format = get_post_format();
										if($format == ''){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/post-default.svg';
										}else if($format == 'gallery'){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/gallery.svg';
										}else if($format == 'video'){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/video-player.svg';
										}else if($format == 'link'){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/link.svg';
										}else if($format == 'quote'){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/quote.svg';
										}else if($format == 'audio'){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/audio.svg';
										}else if($format == 'image'){
											$svgURL = get_template_directory_uri() .'/framework/img/svg/image.svg';
										}
										$svgImage = '<img class="fotofly_fn_svg" src="'.esc_url($svgURL).'" alt="" />';

										if($fotofly_fn_option['blog_format_display'] == 'enable'){
											$svg_holder = 	'<div class="svg_holder '.$format.'">
															<span class="fn_icon">'.$svgImage.'</span>
														</div>';
										}else{
											$svg_holder = '';
										}
										$svgNoImageURL = get_template_directory_uri() .'/framework/img/svg/image.svg';
										$svgNoImageHTML = '<img class="fotofly_fn_svg" src="'.esc_url($svgNoImageURL).'" alt="" />';
									?>
									<?php if(has_post_thumbnail()){ ?>
									<div class="cover_image">
										<a href="<?php the_permalink(); ?>">
											<?php echo wp_kses_post($thumb); ?>
											<div class="img_holder_in" style="background-image: url('<?php echo esc_url($bg_img); ?>')"></div>
											<?php echo wp_kses_post($svg_holder); ?>
										</a>
									</div>
									<?php }else{ ?>
									
									<div class="no_image">
										<a href="<?php the_permalink(); ?>">
											<?php echo wp_kses_post($thumb); ?>
											<?php echo wp_kses_post($svgNoImageHTML);?>
											<?php echo wp_kses_post($svg_holder);?>
										</a>
									</div>
									<?php } ?>
									
									<div class="title_holder">
										<span>
											<span class="category"><?php echo fotofly_fn_taxanomy_list(get_the_id(), 'category', false, 1)?></span> /
											<span class="date"><?php the_time(get_option('date_format'));?></span>
										</span>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									</div>
								</div>
							</li>
							<?php endwhile; endif; wp_reset_postdata();?>

						</ul>
					</div>
					<?php fotofly_fn_pagination(); ?>
				</div>
			</div>
		</div>
	</div>
	<!-- /BLOG -->


</div>
<!-- /MAIN CONTENT -->