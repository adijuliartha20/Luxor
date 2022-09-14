<?php 
global $post, $fotofly_fn_option;
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
$fotofly_fn_page_spaces = '';

$fotofly_fn_nosplit = '';

if(function_exists('rwmb_meta')){
	$fotofly_fn_pagetitle 			= get_post_meta(get_the_ID(),'fotofly_fn_page_title', true);
	$fotofly_fn_page_breadcrumbs 	= get_post_meta(get_the_ID(),'fotofly_fn_page_breadcrumbs', true);
	$fotofly_fn_pagetitletype 		= get_post_meta(get_the_ID(),'fotofly_fn_page_title_type', true);
	$fotofly_fn_pagetitleimg 		= get_post_meta(get_the_ID(),'fotofly_fn_page_title_img', true);
	$fotofly_fn_top_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_top', true);
	$fotofly_fn_bot_padding 		= get_post_meta(get_the_ID(),'fotofly_fn_page_padding_bottom', true);
	$fotofly_fn_parallaxspeed 		= get_post_meta(get_the_ID(),'fotofly_fn_page_parallax_speed', true)/10;
	$fotofly_fn_page_title_color 	= get_post_meta(get_the_ID(),'fotofly_fn_page_title_color', true);
	
	
	$fotofly_fn_page_spaces = 'style=';
	if($fotofly_fn_top_padding != ''){$fotofly_fn_page_spaces .= 'padding-top:'.$fotofly_fn_top_padding.'px;';}
	if($fotofly_fn_bot_padding != ''){$fotofly_fn_page_spaces .= 'padding-bottom:'.$fotofly_fn_bot_padding.'px;';}
	if($fotofly_fn_top_padding == '' && $fotofly_fn_bot_padding == ''){$fotofly_fn_page_spaces = '';}
	
	$fotofly_fn_titlebg = wp_get_attachment_image_src($fotofly_fn_pagetitleimg, 'full'); 	// TITLE BG IMG
	
	if($fotofly_fn_pagetitletype == 'parallax'){$fotofly_fn_parallax = 'fotofly_fn_jarallax';}else{$fotofly_fn_parallax = '';}
	
	$fotofly_fn_nosplit = $fotofly_fn_option['blog_template'];
	
}
// for thumbnail
$thumb = NULL;
if(has_post_thumbnail()){
	$thumb = wp_get_attachment_url(get_post_thumbnail_id());
}

$fotofly_fn_blog_column = $fotofly_fn_option['blog_post_column_split'];

if(isset($_GET['col'])){$fotofly_fn_blog_column = $_GET['col'];}
?>
<!-- MAIN CONTENT -->
<div class="content_wrap">

	<!-- SPLIT PAGE -->
	<div class="fotofly_fn_page_splitscreen" data-content-pos="<?php echo esc_attr($fotofly_fn_option['split_content_pos']); ?>">

		<!-- SPLITLEFT -->
		<div class="fotofly_fn_page_splitleft">
			<div class="splitscreen_title">
				<div class="in">

					<div class="title_holder">
						<h1><?php the_title(); ?></h1>
					</div>

				</div>
			</div>
			<div class="splitscreen_title_back">
				<div class="bg" style="background-image:url(<?php echo esc_url($thumb); ?>);"></div>
			</div>
		</div>
		<!-- /SPLITLEFT -->

		<!-- SPLITRIGHT -->
		<div class="fotofly_fn_page_splitright">
			<div class="in">
				<div class="contained">

				<!-- RIGHT CONTENT HERE -->

					<!-- MAIN TITLE -->
					<?php if($fotofly_fn_pagetitle !== 'disable' || $fotofly_fn_page_breadcrumbs !== 'disable'){ ?>
						<div class="fotofly_fn_content_title_wrap <?php echo esc_attr($fotofly_fn_page_title_color.' '.$fotofly_fn_media); ?>"
						data-breadcrumbs="<?php echo esc_attr($fotofly_fn_page_breadcrumbs); ?>" 
						data-title="<?php echo esc_attr($fotofly_fn_pagetitle); ?>">

							<div class="fotofly_fn_page_title_wrap">

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

					<div class="fotofly_fn_pagesplit_partcontent" <?php echo esc_attr($fotofly_fn_page_spaces); ?>>

						<!-- BLOG -->

						<div class="fotofly_fn_blog_wrap">
							<div class="fotofly_fn_blog">
								<div class="blog">
										<div class="blog_wrapper">

											<div class="blog_content" data-blog-column="<?php echo esc_attr($fotofly_fn_blog_column); ?>">
												<ul class="fotofly_fn_masonry mypost">

													<?php 
														if(is_front_page()) { $fotofly_fn_paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $fotofly_fn_paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
														query_posts('posts_per_page=&paged='.esc_html($fotofly_fn_paged)); 


														if (have_posts()) : while (have_posts()) : the_post();
													?>
													<li class="fotofly_fn_masonry_in" id="post-<?php the_ID(); ?>">
														<div <?php post_class(); ?>>
														<?php 	
															/* POST FORMAT */
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
															<div class="img_holder">
																<a href="<?php the_permalink(); ?>">
																	<?php 
																		the_post_thumbnail('fotofly_fn_thumb-720-9999');
																	?>
																</a>
																<?php echo wp_kses_post($svg_holder);?>
															</div>
															<?php }else{ ?>
															<div class="no_img">
																<a href="<?php the_permalink(); ?>">
																	<?php echo wp_kses_post($svgNoImageHTML);?>
																	<?php echo wp_kses_post($svg_holder);?>
																</a>
															</div>
															<?php } ?>
															<div class="title_holder">
																<span>
																	<span class="category"><?php echo fotofly_fn_taxanomy_list(get_the_id(), 'category', false, 1)?></span>
																	<span class="seporator"> / </span>
																	<span class="date"><?php the_time(get_option('date_format')); ?></span>
																</span>
																<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
																<p><?php echo fotofly_fn_excerpt(30); ?></p>
																<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'fotofly') ?></a>
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

				<!-- /RIGHT CONTENT HERE -->
				</div>
				
				
				<?php get_footer('split-content'); ?> 
			</div>
		</div>
		<!-- /SPLITRIGHT -->


	</div>		
	<!-- /SPLIT PAGE -->

</div>
<!-- /MAIN CONTENT -->