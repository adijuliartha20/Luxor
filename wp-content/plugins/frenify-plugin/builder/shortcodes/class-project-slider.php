<?php
class frenifySC_ProjectSlider {
	
	private $fotofly_fn_counter = 1;
	
	public static $args;


	/**
	 * Initiate the shortcode
	 */
	 
	public function __construct() {

		// Element attributes
		add_filter( 'fotofly_fn_attr_project_slider-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'project_slider', array( $this, 'render' ) ); // shortcode name
	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class' 				=> '',
				'id' 					=> '',
				'skin' 					=> '',
				'fn_post_type' 			=> '',		
				'max_post_count' 		=> '',		
				'cat_slug' 				=> '',
				'exclude_cats' 			=> '',		
				'cat_slug_gallery' 		=> '',
				'exclude_cats_gallery' 	=> '',
				'order' 				=> '',
				'offset'				=> '',
				'margin_top' 			=> '',
				'margin_bottom' 		=> '',
			), $args
		);
		
		// check: has "px" or not. if not: add "px"
		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}
		
		extract( $defaults );

		self::$args = $defaults;
		
		
		$post_type_from_parent 	= '';
		$fn_cat_slug			= '';
		$fn_cat_to_exclude		= '';
		$post_type_from_parent	= self::$args['fn_post_type'];
		$fn_posttype 			= 'fotofly-fn-'.$post_type_from_parent;
		$fn_postcat				= $post_type_from_parent.'_category';
		$fotofly_fn_images		= 'fotofly_fn_'.$post_type_from_parent.'_images';
		if($post_type_from_parent === 'portfolio'){
			$fn_cat_slug		= self::$args['cat_slug'];
			$fn_cat_to_exclude	= self::$args['exclude_cats'];
		}else if($post_type_from_parent === 'gallery'){
			$fn_cat_slug		= self::$args['cat_slug_gallery'];
			$fn_cat_to_exclude	= self::$args['exclude_cats_gallery'];
		}
		
		// Transform $cat_slugs to array
		if ( $fn_cat_slug ) {
			$cat_slugs = preg_replace( '/\s+/', '', $fn_cat_slug );
			$cat_slugs = explode( ',', $fn_cat_slug );
		} else {
			$cat_slugs = array();
		}		
		
		// Transform $cats_to_exclude to array
		if ( $fn_cat_to_exclude ) {
			$cats_to_exclude = preg_replace( '/\s+/', '', $fn_cat_slug );
			$cats_to_exclude = explode( ',' , $fn_cat_to_exclude );
		} else {
			$cats_to_exclude = array();			
		}
		
		$post_count = self::$args['max_post_count'];
		
		// Initialize the query array
		$query_args = array(
			'post_type' 			=> $fn_posttype,
			'paged' 				=> 1,
			'post_status' 			=> 'publish',  
			'posts_per_page'		=> $post_count,
			'has_password' 		 	=> false,
			'order' 				=> 'DESC', 
			'ignore_sticky_posts'	=> 1,
		);
		
		if ( $defaults['offset'] ) {
			$query_args['offset'] =  $offset;
		}
		
		if ( $defaults['order'] ) {
			$query_args['orderby'] =  $order;
		}		
		
		// Check if the are categories that should be excluded
		if ( ! empty ( $cats_to_exclude ) ) {
		
			// Exclude the correct cats from tax_query
			$query_args['tax_query'] = array(
				array(
					'taxonomy'	=> $fn_postcat, //'portfolio_category'
					'field'	 	=> 'slug',
					'terms'		=> $cats_to_exclude,
					'operator'	=> 'NOT IN'
				)
			);

			// Include the correct cats in tax_query
			if ( ! empty ( $cat_slugs ) ) {
				$query_args['tax_query']['relation'] = 'AND';
				$query_args['tax_query'][] = array(
					'taxonomy'	=> $fn_postcat, //'portfolio_category'
					'field'		=> 'slug',
					'terms'		=> $cat_slugs,
					'operator'	=> 'IN'
				);
			}		
		
		} else {
			// Include the cats from $cat_slugs in tax_query
			if ( ! empty ( $cat_slugs ) ) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' 	=> $fn_postcat, //'portfolio_category'
						'field' 	=> 'slug',
						'terms' 	=> $cat_slugs,
						'operator'	=> 'IN'
					)
				);
			}
		}
		wp_reset_query();
		
		
		$fotofly_fn_query = NULL;
		$fotofly_fn_post_img = NULL;
		$disabled = NULL;
		$term_link = NULL;
		$cat_list = NULL;
		$gallery_list = NULL;
		$fotofly_fn_portfolio_images = NULL;
		$count_images = NULL;
		
		$fotofly_fn_query 		= new WP_Query($query_args);
		$fotofly_fn_post_count 	= $fotofly_fn_query->found_posts;
		$fotofly_fn_max_pages 	= $fotofly_fn_query->max_num_pages;
		
		
		
		
		// START OUTPUT
		$html = '';
		$html .= sprintf('<div %s><div class="fotofly_fn_projectslider">', frenifyCore_Plugin::attributes( 'project_slider-shortcode' ));
		
		
		
		$html .= '<div class="container"><div class="fotofly_fn_projectslider_slider"><ul class="slides">';

		foreach ( $fotofly_fn_query->posts as $fotofly_fn_projectpost ) {
			setup_postdata( $fotofly_fn_projectpost ); 

				$fotofly_fn_post_id 		= $fotofly_fn_projectpost->ID;
				$fotofly_fn_post_img 		= fotofly_fn_get_thumbnail('1000', '1000', $fotofly_fn_post_id);
				$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
				$fotofly_fn_categories 		= get_the_terms( $fotofly_fn_post_id, $fn_postcat);
				$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-1000-1000.jpg'; 
				$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';

				$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
				$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-1000-1000' );
				$post_thumbnail_url 		= $post_thumbnail_url[0];

				$cat_count = sizeof($fotofly_fn_categories);
				if($cat_count >= 1){$cat_count = 1;}

				for($i = 0; $i < $cat_count; $i++){
					$term_link = get_term_link( $fotofly_fn_categories[$i]->slug, $fn_postcat );
					$cat_list .= '<a href="'.$term_link.'">'.$fotofly_fn_categories[$i]->name.'</a> / ';
				}
				$cat_list	= trim($cat_list, " / ");
				$date		= get_the_date('F, j', $fotofly_fn_post_id);


				// Attached images. We need to detect this function, because it is added via core plugin
				if(function_exists('rwmb_meta'))
				{
					$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );

					if($fotofly_fn_portfolio_images)
					{
						foreach(array_slice($fotofly_fn_portfolio_images, 0, 1) as $img){

							$object 	= wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-1000-1000' );
							$image_url 	= $object[0];
						} 
						if($post_thumbnail_url == ''){
							$post_thumbnail_url = $image_url;
						}
					}
				}
				if ( !empty( get_the_content() ) ){
					$item_content = '<p>'.fotofly_fn_excerpt(20).'</p>';
				}else{
					$item_content = '';
				}

				$html   				   .= '<li class="fotofly_fn_projectslider_item">
													<div class="fotofly_fn_first_half">
														<div class="gallery_cover">
															<div class="img_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"><a href="'.$fotofly_fn_post_permalink.'"></a></div>
															<div class="img_holder">'.$fotofly_fn_backupthumbnail.'</div>
														</div>
													</div>
													<div class="fotofly_fn_second_half">
														<div class="in">
															<div class="title_holder">
																<span>'.$cat_list.' / '.$date.'</span>
																<h1 class="title">
																	<a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_projectpost->post_title.'</a>
																</h1>
															</div>
															<div class="content_holder">
																'.$item_content.'
																<a href="'.$fotofly_fn_post_permalink.'" class="viewgallerylink" >'.esc_html($fotofly_fn_option['viewportfolio_text']).'</a>
															</div>
														</div>

													</div>									
												</li>';
				$cat_list = NULL; 
		}
		wp_reset_postdata(); 

		$html .= '';
		$html .= '</ul></div></div>';
		
		
		
		
		
		$html .= '</div></div>';
		// END OUTPUT	

		$this->fotofly_fn_counter++;
		return $html;
		
		
	}
	
	
	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_projectslider_wrap';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}
//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s; margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom']);
		
		return $attr;

	}
}

new frenifySC_ProjectSlider();