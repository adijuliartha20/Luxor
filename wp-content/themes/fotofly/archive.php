<?php

get_header();

global $post, $fotofly_fn_option;

$curauth = get_userdata(get_query_var('author'));
?>
        
    
        <section class="fotofly_fn_content_archive">
			<div class="container">
				<div class="fotofly_fn_title">
					<div class="fotofly_fn_title_content">
						<span>
						<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
						<?php /* If this is a category archive */ if (is_category()) { ?>
							<?php printf(esc_html__('All posts in %s', 'fotofly'), single_cat_title('',false)); ?>
						<?php /* If this is a tag archive */ } elseif( is_tax() ) { $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
							<?php printf(esc_html__('All posts in %s', 'fotofly'), $term->name ); ?>
						<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
							<?php printf(esc_html__('All posts tagged in %s', 'fotofly'), single_tag_title('',false)); ?>
						<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
							<?php esc_html_e('Archive for', 'fotofly') ?> <?php the_time(get_option('date_format')); ?>
						 <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
							<?php esc_html_e('Archive for', 'fotofly') ?> <?php the_time('F, Y'); ?>
						<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
							<?php esc_html_e('Archive for', 'fotofly') ?> <?php the_time('Y'); ?>
						<?php /* If this is an author archive */ } elseif (is_author()) { ?>
							<?php esc_html_e('All posts by', 'fotofly') ?> <?php echo esc_html($curauth->display_name); ?>
						<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							<?php esc_html_e('Blog Archives', 'fotofly') ?>
						<?php } ?>

						</span>
					</div>
				</div>

				<div class="blog">
					<ul class="fotofly_fn_archive_list fotofly_fn_masonry">
					<?php


						if (have_posts()) : while (have_posts()) : the_post(); ?>
						<li class="fotofly_fn_masonry_in">
							<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="fotofly_fn_post">
								   <?php if(has_post_thumbnail()){ ?>
									<div class="img_holder">
										<a href="<?php the_permalink(); ?>">
											<?php 
												the_post_thumbnail('full');
											?>
										</a>
									</div>
									<?php }else{ ?>
						   			<div class="no_img_holder">
										<a href="<?php the_permalink(); ?>"></a>
					   					<span><?php the_title(); ?></span>
						   			</div>
							   		<?php } ?>
								   <div class="title_holder">
										<span>
											<span class="category"><?php the_category(', ');?></span>
											<span class="date"><?php the_time(get_option('date_format')); ?></span>
										</span>
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
										<p><?php echo fotofly_fn_excerpt(30); ?></p>
										<a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More', 'fotofly') ?></a>
									</div>

								</div>
							</article>
						</li><?php 

						endwhile; endif; ?>
					</ul>
					
					<?php fotofly_fn_pagination(); wp_reset_postdata(); ?>
					
				</div>
			</div>
        </section>
		<!-- /MAIN CONTENT -->
        
<?php get_footer(); ?>   