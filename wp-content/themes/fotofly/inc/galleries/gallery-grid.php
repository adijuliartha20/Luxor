<?php 
global $fotofly_fn_option;

$fotofly_fn_cats_in  = $fotofly_fn_cats_out = array();
$fotofly_fn_has_password 		= 'ex';
$fotofly_fn_featured_posts 		= 'in';
$fotofly_fn_editorpick_posts 	= 'in';

if(function_exists('rwmb_meta')){
	$fotofly_fn_cats_in 			= get_post_meta(get_the_ID(),'fotofly_fn_gallery_cats', false);
	$fotofly_fn_cats_out 			= get_post_meta(get_the_ID(),'fotofly_fn_gallery_excluded_cats', false);
	$fotofly_fn_has_password 		= get_post_meta(get_the_ID(),'fotofly_fn_has_password_gallery', true);
	$fotofly_fn_featured_posts 		= get_post_meta(get_the_ID(),'fotofly_fn_featured_posts_gallery', true);
	$fotofly_fn_editorpick_posts 	= get_post_meta(get_the_ID(),'fotofly_fn_editorpick_posts_gallery', true);
	
	if(!empty($fotofly_fn_cats_in)){$fotofly_fn_cats_in 	= explode( ',', $fotofly_fn_cats_in[0] );}  // string to array
	if(!empty($fotofly_fn_cats_out)){$fotofly_fn_cats_out 	= explode( ',', $fotofly_fn_cats_out[0] );} // string to array
	
}

// QUERY ARGUMENTS
$fotofly_fn_gallery_perpage = $fotofly_fn_option['gallery_perpage'];
if(is_front_page()) { $paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
$query_args = array(
	'post_type' 			=> 'fotofly-fn-gallery', 
	'paged' 				=> $paged, 
	'posts_per_page' 		=> $fotofly_fn_gallery_perpage,
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
		'key'       => 'fotofly_fn_featured_post_gallery',
		'value'     => '1',
		'compare'   => '==',
	);
}
else if($fotofly_fn_featured_posts == 'ex'){
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_featured_post_gallery',
		'value'     => '1',
		'compare'   => '!=',
	);
}

// EDITOR'S PICK POSTS
if($fotofly_fn_editorpick_posts == 'only'){
	if($fotofly_fn_featured_posts == 'only' || $fotofly_fn_featured_posts == 'ex'){$query_args['meta_query']['relation'] = 'AND';} // this helps query posts by multiple meta keys.
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_editorpick_post_gallery',
		'value'     => '1',
		'compare'   => '==',
	);
}
else if($fotofly_fn_editorpick_posts == 'ex'){
	if($fotofly_fn_featured_posts == 'only' || $fotofly_fn_featured_posts == 'ex'){$query_args['meta_query']['relation'] = 'AND';} // this helps query posts by multiple meta keys.
	$query_args['meta_query'][] = array(
		'key'       => 'fotofly_fn_editorpick_post_gallery',
		'value'     => '1',
		'compare'   => '!=',
	);
}

// ADD TAXONOMY TO ARGUMENTS
if ( ! empty ( $fotofly_fn_cats_out ) ) {
	// Exclude the correct cats from tax_query
	$query_args['tax_query'] = array(
		array(
			'taxonomy'	=> 'gallery_category',
			'field'	 	=> 'id',
			'terms'		=> $fotofly_fn_cats_out,
			'operator'	=> 'NOT IN'
		)
	);
	// Include the correct cats in tax_query
	if ( ! empty ( $fotofly_fn_cats_in ) ) {
		$query_args['tax_query']['relation'] = 'AND';
		$query_args['tax_query'][] = array(
			'taxonomy'	=> 'gallery_category',
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
				'taxonomy' 	=> 'gallery_category',
				'field' 	=> 'id',
				'terms' 	=> $fotofly_fn_cats_in
			)
		);
	}
}

// QUERY WITH ARGUMENTS
$fotofly_fn_loop = new WP_Query($query_args);
$fotofly_fn_counter = wp_count_posts('fotofly-fn-gallery');

$gallerycols = '3';
if(isset($fotofly_fn_option['gallery_mg_cols'])){
	$gallerycols = $fotofly_fn_option['gallery_mg_cols'];
}
$gallerygutter = '40';
if(isset($fotofly_fn_option['gallery_mg_gutter'])){
	$gallerygutter = $fotofly_fn_option['gallery_mg_gutter'];
}
$gallerytemplate = 'masonry';
if(isset($fotofly_fn_option['gallery_template'])){
	$gallerytemplate = $fotofly_fn_option['gallery_template'];
}
$gallerygridtype = 'portrait';
if(isset($fotofly_fn_option['gallery_grid_type'])){
	$gallerygridtype = $fotofly_fn_option['gallery_grid_type'];
}


if(isset($_GET['temp'])){$gallerytemplate 	= $_GET['temp'];}
if(isset($_GET['col'])){$gallerycols 		= $_GET['col'];}
if(isset($_GET['gutter'])){$gallerygutter 	= $_GET['gutter'];}
if(isset($_GET['grid'])){$gallerygridtype 	= $_GET['grid'];}


if($gallerygridtype == 'square'){
	$gallerythumb = fotofly_fn_callback_thumbs(1000,1000);
}else if($gallerygridtype == 'portrait'){
	$gallerythumb = fotofly_fn_callback_thumbs(800,970);
}else if($gallerygridtype == 'landscape'){
	$gallerythumb = fotofly_fn_callback_thumbs(840,570);
}

?>

<div class="fotofly_fn_gallerypage">
	<div class="fotofly_fn_gallerylist <?php echo esc_attr($gallerytemplate);?>" data-cols="<?php echo esc_attr($gallerycols);?>" data-gutter="<?php echo esc_attr($gallerygutter);?>">
		<div>
			
			<ul class="g_list fotofly_fn_masonry">

				
				<?php 
					if ($fotofly_fn_loop->have_posts()) : while ($fotofly_fn_loop->have_posts()) : $fotofly_fn_loop->the_post(); 


					$fotofly_fn_post_cats			= fotofly_fn_taxanomy_list(get_the_id(), 'gallery_category', false, 2);

					$fotofly_fn_post_cats_switch = $fotofly_fn_option['gallery_category_visibility'];
					if($fotofly_fn_post_cats_switch !== 'disable'){
						$fotofly_fn_post_cats = '<span class="fn_cat">'.$fotofly_fn_post_cats.'</span>';
					}else{
						$fotofly_fn_post_cats = '';
					}

					$fotofly_fn_gallery_post_title = NULL; // initial variable
					$fotofly_fn_gallery_post_title = '<div class="title_wrap">
															'.$fotofly_fn_post_cats.'
															<h3><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3>
														</div>';
					$bg_img = get_the_post_thumbnail_url(get_the_id(),'fotofly_fn_thumb-800-800');
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_gallery_images 	= rwmb_meta( 'fotofly_fn_gallery_images', 'type=image&size=full', get_the_id() );

						if($fotofly_fn_gallery_images){
							foreach(array_slice($fotofly_fn_gallery_images, 0, 1) as $img){
								$object = wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-800-800' );
								$image_extraURL = $object[0];
							}
							if($bg_img == ''){
								$bg_img = $image_extraURL;
							}
						}
					}
					
					$password 	=  	'<a class="locked_content" href="'.get_the_permalink().'">
										<i class="xcon-lock"></i>
									 </a>';

				?>
				<li class="fotofly_fn_masonry_in">
					<div class="single">

						<?php if(post_password_required($post)){echo wp_kses_post($password);}?>
						<?php echo wp_kses_post($gallerythumb);?>
						<?php echo wp_kses_post($fotofly_fn_gallery_post_title); ?>
						<div class="overlay_img" style="background-image: url(<?php echo esc_html($bg_img);?>)"><a href="<?php the_permalink();?>"></a></div>
					</div>
				</li>
				<?php endwhile; endif;?>
				
			</ul>

		</div>
	</div>
	
	<div class="container">
		<!-- PAGINATION -->
		<?php fotofly_fn_pagination($fotofly_fn_loop->max_num_pages); wp_reset_postdata();?>
		<!-- /PAGINATION -->
	</div>
	
</div>