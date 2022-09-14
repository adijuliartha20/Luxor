<?php get_header(); ?>

<?php 
global $post, $fotofly_fn_option;

?>



<!-- MAIN CONTENT -->
<div class="content_wrap">
	
	<div class="space100"></div>

	<!-- BLOG -->
	<div class="fotofly_fn_blog_wrap blog_classic page_index">
		<div class="fotofly_fn_blog">
			<div class="blog container">
				<div class="blog_wrapper">

					<div class="blog_content">
						<ul class="mypost">

							<?php 
								


								if (have_posts()) : while (have_posts()) : the_post();
							?>
							<li id="post-<?php the_ID(); ?>">
								<div <?php post_class(); ?>>
									
									<?php 
										$svgNoImageURL = get_template_directory_uri() .'/framework/img/svg/image.svg';
										$svgNoImageHTML = '<img class="fotofly_fn_svg" src="'.esc_url($svgNoImageURL).'" alt="" />';
									?>

									<?php if(has_post_thumbnail()){ ?>
									<div class="img_holder">
										<a href="<?php the_permalink(); ?>">
											<?php 
												the_post_thumbnail('full');
											?>
										</a>
									</div>
									<?php }?>

									<div class="title_holder">
										<span>
											<span class="category"><?php echo fotofly_fn_taxanomy_list(get_the_id(), 'category', false, 1)?></span>
											<span class="seporator"> / </span>
											<span class="date"><?php the_time(get_option('date_format'));?></span>
										</span>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<p><?php echo fotofly_fn_excerpt(26); ?></p>
										<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'fotofly') ?></a>
									</div>
									
								</div>
							</li>
							<?php endwhile; endif; wp_reset_postdata();?>

						</ul>
					</div>
					<?php fotofly_fn_pagination(); ?>
					<div class="space100"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- /BLOG -->


</div>
<!-- /MAIN CONTENT -->

<?php get_footer(); ?>  