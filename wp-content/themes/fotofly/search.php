<?php

get_header();

global $post, $fotofly_fn_option;


$fotofly_fn_post_type = '';
if(isset($_GET['post_type'])) {
	$fotofly_fn_post_type = $_GET['post_type'];
}
$has_post_thumb = '';
?>
        
        
        
<!-- MAIN CONTENT -->
<section class="fotofly_fn_content">

	<div class="container"> 


		<!-- SEARCH -->
		<div class="space70"></div>
		
		<div class="fotofly_fn_searchpage_title">
			<h3><?php printf( esc_html__('Search results for "%s"', 'fotofly'), get_search_query() ); ?></h3>
		</div>
		
		
		<div class="fotofly_fn_searchpagelist">
			<?php if (have_posts()){ ?>
				<?php while (have_posts()) : the_post(); ?>
				<article  id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
					if($fotofly_fn_option['thumb_for_search'] !== 'disable'){
						if(has_post_thumbnail()){
							$has_post_thumb = 'fn_has_post_thumb';
						}else{
							$has_post_thumb = '';
						}
					}
				?>
					<div class="fotofly_fn_searchpagelist_item <?php echo esc_attr($has_post_thumb);?>">
						
						<div class="fn_thumb_results">
							<div class="title_img">
								<div class="title_holder">
									<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<span class="sub"><span><?php the_time(get_option('date_format')); ?></span></span>
								</div>
								<div class="img_holder">
									<?php 
										$imageURL 	= get_the_post_thumbnail_url(get_the_id(),'fotofly_fn_thumb-300-300');
									?>
									<img src="<?php echo esc_url($imageURL);?>" alt="" />
								</div>	
							</div>
							<div class="content_holder">
								<?php 	
									if(!empty(get_the_content())){?>
										<p><?php echo fotofly_fn_excerpt(30);?></p>
								<?php }?>
								<a href="<?php the_permalink(); ?>" class="read_more"><?php esc_html_e('Read More', 'fotofly') ?></a>
							</div>
						</div>
						<div class="fn_results">
							<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
							<span class="sub"><span><?php the_time(get_option('date_format')); ?></span></span>
							<?php 	
								if(!empty(get_the_content())){?>
									<p><?php echo fotofly_fn_excerpt(30);?></p>
							<?php }?>
							<a href="<?php the_permalink(); ?>" class="read_more"><?php esc_html_e('Read More', 'fotofly') ?></a>
						</div>
					</div>
				</article>
				<?php endwhile; ?>
			<?php 
			}else{
			$fotofly_fn_gotohome = '<a class="gotohome" href="'.esc_url(home_url('/')).'">'.esc_html__('Go Home','fotofly').'</a>';
			printf('<div class="fotofly_fn_searchpage_nothing"><div><p>%s</p><div>%s</div></div></div>', esc_html__('Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'fotofly'), $fotofly_fn_gotohome);}
			?>
		</div>

			<?php fotofly_fn_pagination(); wp_reset_postdata();	?>

		<div class="space100"></div>
		<!-- /SEARCH -->

	</div>    
</section>
<!-- /MAIN CONTENT -->
        
<?php get_footer('null'); ?>   