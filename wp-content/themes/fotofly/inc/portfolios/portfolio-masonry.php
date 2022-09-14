<?php 
global $fotofly_fn_option;

$fotofly_fn_cats_in  = $fotofly_fn_cats_out = array();
$fotofly_fn_has_password 		= 'ex';
$fotofly_fn_featured_posts 		= 'in';
$fotofly_fn_editorpick_posts 	= 'in';

if(function_exists('rwmb_meta')){
	$fotofly_fn_cats_in 			= get_post_meta(get_the_ID(),'fotofly_fn_portfolio_cats', false);
	$fotofly_fn_cats_out 			= get_post_meta(get_the_ID(),'fotofly_fn_portfolio_excluded_cats', false);
	$fotofly_fn_has_password 		= get_post_meta(get_the_ID(),'fotofly_fn_has_password', true);
	$fotofly_fn_featured_posts 		= get_post_meta(get_the_ID(),'fotofly_fn_featured_posts', true);
	$fotofly_fn_editorpick_posts 	= get_post_meta(get_the_ID(),'fotofly_fn_editorpick_posts', true);
	
	if(!empty($fotofly_fn_cats_in)){$fotofly_fn_cats_in 	= explode( ',', $fotofly_fn_cats_in[0] );}  // string to array
	if(!empty($fotofly_fn_cats_out)){$fotofly_fn_cats_out 	= explode( ',', $fotofly_fn_cats_out[0] );} // string to array
	
}

// QUERY ARGUMENTS
$fotofly_fn_portfolio_perpage = $fotofly_fn_option['portfolio_perpage'];
if(is_front_page()) { $paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
$query_args = array(
	'post_type' 			=> 'fotofly-fn-portfolio', 
	'paged' 				=> $paged, 
	'posts_per_page' 		=> $fotofly_fn_portfolio_perpage,
	'post_status' 			=> 'publish',
);

// PASSWORD PROTECTED POSTS
if($fotofly_fn_has_password == 'only'){
	$query_args['has_password'] = true;
}
else if($fotofly_fn_has_password == 'ex'){
	$query_args['has_password'] = false;
}

// FEATURED POSTS
if($fotofly_fn_featured_posts == 'only'){
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_featured_post',
		'value'     => '1',
		'compare'   => '==',
	);
}
else if($fotofly_fn_featured_posts == 'ex'){
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_featured_post',
		'value'     => '1',
		'compare'   => '!=',
	);
}

// EDITOR'S PICK POSTS
if($fotofly_fn_editorpick_posts == 'only'){
	if($fotofly_fn_featured_posts == 'only' || $fotofly_fn_featured_posts == 'ex'){$query_args['meta_query']['relation'] = 'AND';} // this helps query posts by multiple meta keys.
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_editorpick_post',
		'value'     => '1',
		'compare'   => '==',
	);
}
else if($fotofly_fn_editorpick_posts == 'ex'){
	if($fotofly_fn_featured_posts == 'only' || $fotofly_fn_featured_posts == 'ex'){$query_args['meta_query']['relation'] = 'AND';} // this helps query posts by multiple meta keys.
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_editorpick_post',
		'value'     => '1',
		'compare'   => '!=',
	);
}

// ADD TAXONOMY TO ARGUMENTS
if ( ! empty ( $fotofly_fn_cats_out ) ) {
	// Exclude the correct cats from tax_query
	$query_args['tax_query'] = array(
		array(
			'taxonomy'	=> 'portfolio_category',
			'field'	 	=> 'id',
			'terms'		=> $fotofly_fn_cats_out,
			'operator'	=> 'NOT IN'
		)
	);
	// Include the correct cats in tax_query
	if ( ! empty ( $fotofly_fn_cats_in ) ) {
		$query_args['tax_query']['relation'] = 'AND';
		$query_args['tax_query'][] = array(
			'taxonomy'	=> 'portfolio_category',
			'field'		=> 'id',
			'terms'		=> $fotofly_fn_cats_in,
			'operator'	=> 'IN'
		);
	}		
} else {
	// Include the cats from $cat_slugs in tax_query
	if ( ! empty ( $fotofly_fn_cats_in ) ) {
		$query_args['tax_query'] = array(
			array(
				'taxonomy' 	=> 'portfolio_category',
				'field' 	=> 'id',
				'terms' 	=> $fotofly_fn_cats_in
			)
		);
	}
}

// QUERY WITH ARGUMENTS
$fotofly_fn_loop = new WP_Query($query_args);
$fotofly_fn_counter = wp_count_posts('fotofly-fn-portfolio');


$portfolio_layout 	= $fotofly_fn_option['portfolio_template'];
$title_pos			= $fotofly_fn_option['portfolio_title_position'];

/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	if(isset($_GET['temp'])){$portfolio_layout = $_GET['temp'];}
	if(isset($_GET['title_pos'])){$title_pos = $_GET['title_pos'];}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
?>
<!-- PORTFLOIO ALPHA -->
<div class="fotofly_fn_portfolio <?php echo esc_attr($portfolio_layout);?>" data-post-title-position="<?php echo esc_attr($title_pos); ?>">
	<div>
		<div class="fotofly_fn_portfolio_inner">
			<div class="portfolio_inner_wrapper">


				<div class="fotofly_fn_portfolio_list_wrap">
					<div class="list_inner">
					
						<?php 
							// title
							$post_title_outside_pos 		= $fotofly_fn_option['portfolio_title_outside_position'];
							$post_title_inside_pos 			= $fotofly_fn_option['portfolio_title_inside_position'];
							$post_title_inside_vis 			= $fotofly_fn_option['portfolio_title_inside_visibility'];
							$post_title_inside_color 		= $fotofly_fn_option['portfolio_title_inside_color'];
							$post_title_inside_hover_color 	= $fotofly_fn_option['portfolio_title_inside_hover_color'];
							
							// column
							$post_column					= $fotofly_fn_option['portfolio_post_column'];
							$post_column_gutter				= $fotofly_fn_option['portfolio_post_column_gutter'];
						
							
							if(isset($_GET['col'])){$post_column = $_GET['col'];}
							if(isset($_GET['gutter'])){$post_column_gutter = $_GET['gutter'];}
							if(isset($_GET['title_out_pos'])){$post_title_outside_pos = $_GET['title_out_pos'];}
							if(isset($_GET['title_in_pos'])){$post_title_inside_pos = $_GET['title_in_pos'];}
							if(isset($_GET['title_in_vis'])){$post_title_inside_vis = $_GET['title_in_vis'];}
						?>
						<ul class="fotofly_fn_masonry fotofly_fn_portfolio_list" 
						
								data-title-inside-position="<?php echo esc_attr($post_title_inside_pos); ?>" 
								data-title-outside-position="<?php echo esc_attr($post_title_outside_pos); ?>" 
								data-title-inside-visibility="<?php echo esc_attr($post_title_inside_vis); ?>" 
								data-title-inside-color="<?php echo esc_attr($post_title_inside_color); ?>" 
								data-title-inside-hover-color="<?php echo esc_attr($post_title_inside_hover_color); ?>" 
								data-post-column="<?php echo esc_attr($post_column); ?>" 
								data-post-column-gutter="<?php echo esc_attr($post_column_gutter); ?>" 
						
						>
						
							<?php 
								if ($fotofly_fn_loop->have_posts()) : while ($fotofly_fn_loop->have_posts()) : $fotofly_fn_loop->the_post(); 


								$fotofly_fn_post_cats			= fotofly_fn_taxanomy_list(get_the_id(), 'portfolio_category', false, 2);

								$fotofly_fn_post_cats_switch = $fotofly_fn_option['portfolio_category_visibility'];
								if($fotofly_fn_post_cats_switch != 'disable'){
									$fotofly_fn_post_cats = '<span class="fn_cat">'.$fotofly_fn_post_cats.'</span>';
								}else{
									$fotofly_fn_post_cats = '';
								}

								$fotofly_fn_portfolio_post_title = NULL; // initial variable
								$fotofly_fn_portfolio_post_title = '<div class="title_wrap">
																		'.$fotofly_fn_post_cats.'
																		<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
																	</div>';
								$imageURL 	= get_the_post_thumbnail_url(get_the_id(),'fotofly_fn_thumb-720-9999');
								$image   	= '<a href="'.get_the_permalink().'"><img src="'.$imageURL.'" alt="" /></a>';
								
								// Attached images. We need to detect this function, because it is added via core plugin
								if(function_exists('rwmb_meta'))
								{
									$fotofly_fn_portfolio_images 	= rwmb_meta( 'fotofly_fn_portfolio_images', 'type=image&size=full', get_the_id() );

									if($fotofly_fn_portfolio_images){
										foreach(array_slice($fotofly_fn_portfolio_images, 0, 1) as $img){
											$object = wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-720-9999' );
											$image_extraURL = $object[0];
											$image_extra = '<img src="'.$image_extraURL.'" alt="" />';
										}
										if($imageURL == ''){
											$image = '<a href="'.get_the_permalink().'">'.$image_extra.'</a>';
										}
									}
								}

							?>
							<li class="fotofly_fn_masonry_in fotofly_fn_item_wrap">
								<div class="fotofly_fn_item">
								
									
									<?php 
									$password 	=  	'<a class="locked_content" href="'.get_the_permalink().'">
														<i class="xcon-lock"></i>
													</a>';
									?>
									
									
									<div class="cover_image_wrap">
									<?php if(post_password_required($post)){ echo wp_kses_post($password); } ?>
										
										
										<!-- fn_overlay -->
										<div class="fn_overlay_hover">
											<div class="fn_hover"></div>
											<?php echo wp_kses_post($image);?>
										</div>
										<!-- /fn_overlay -->
										
										<div class="cover_image">
											<?php echo wp_kses_post($image);?>
										</div>
										<?php echo wp_kses_post($fotofly_fn_portfolio_post_title); ?>
									</div>

									<?php echo wp_kses_post($fotofly_fn_portfolio_post_title); ?>

								</div>
							</li>
							<?php endwhile; endif;?>
						</ul>
					</div>
				</div>
				

				<!-- PAGINATION -->
				<?php fotofly_fn_pagination($fotofly_fn_loop->max_num_pages); wp_reset_postdata();?>
				<!-- /PAGINATION -->

			</div>
		</div>
	</div>
</div>
<!-- /PORTFLOIO ALPHA -->