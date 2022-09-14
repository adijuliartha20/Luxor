<?php
class frenifySC_BlogFn {
	
	private $fotofly_fn_counter = 1;
	
	public static $args;


	/**
	 * Initiate the shortcode
	 */
	 
	public function __construct() {

		// Element attributes
		add_filter( 'fotofly_fn_attr_blog_triple-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'fn_blog', array( $this, 'render' ) );
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
				'layout' 				=> '',			
				'cat_slug' 				=> '',
				'exclude_cats' 			=> '',
				'order' 				=> '',
				'offset'				=> '',
				'button_text'			=> '',
				'button_url'			=> '',
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
		
		
		// Transform $cat_slugs to array
		if ( self::$args['cat_slug'] ) {
			$cat_slugs = preg_replace( '/\s+/', '', self::$args['cat_slug'] );
			$cat_slugs = explode( ',', self::$args['cat_slug'] );
		} else {
			$cat_slugs = array();
		}		
		
		// Transform $cats_to_exclude to array
		if ( self::$args['exclude_cats'] ) {
			$cats_to_exclude = preg_replace( '/\s+/', '', self::$args['cat_slug'] );
			$cats_to_exclude = explode( ',' , self::$args['exclude_cats'] );
		} else {
			$cats_to_exclude = array();			
		}
		
		/*if(self::$args['layout'] == '' || self::$args['layout'] == 'triple'){
			$post_count = 3;
		}else if(self::$args['layout'] == 'quintuple'){
			$post_count = 5;
		}else if(self::$args['layout'] == 'quadruple'){
			$post_count = 4;
		}*/

		// Initialize the query array
		$query_args = array(
			'post_type' 			=> 'post',
			'paged' 				=> 1,
			'post_status' 			=> 'publish',  
			'posts_per_page'		=> 3,
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
					'taxonomy'	=> 'category',
					'field'	 	=> 'slug',
					'terms'		=> $cats_to_exclude,
					'operator'	=> 'NOT IN'
				)
			);

			// Include the correct cats in tax_query
			if ( ! empty ( $cat_slugs ) ) {
				$query_args['tax_query']['relation'] = 'AND';
				$query_args['tax_query'][] = array(
					'taxonomy'	=> 'category',
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
						'taxonomy' 	=> 'category',
						'field' 	=> 'slug',
						'terms' 	=> $cat_slugs
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
		$blog_list = NULL;
		$fotofly_fn_blog_images = NULL;
		$count_images = NULL;
		
		$fotofly_fn_query 		= new WP_Query($query_args);
		$fotofly_fn_post_count 	= $fotofly_fn_query->found_posts;
		$fotofly_fn_max_pages 	= $fotofly_fn_query->max_num_pages;
		
		
		
		// START OUTPUT
		$html = '';
		$html .= sprintf('<div %s><div class="container">', frenifyCore_Plugin::attributes( 'blog_triple-shortcode' ));
		
		
		$html .= '<div class="fotofly_fn_w_blogtriple"><ul class="w_blog_list">';
		foreach ( $fotofly_fn_query->posts as $fotofly_fn_blogpost ) {
			
			setup_postdata( $fotofly_fn_blogpost ); 

				$fotofly_fn_post_id 		= $fotofly_fn_blogpost->ID;
				$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
				$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-570-700.jpg'; 
				$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';

				$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
				$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
				$post_thumbnail_url 		= $post_thumbnail_url[0];
			
				// ----------------- category --------------
				$fotofly_fn_categories 		= get_the_terms( $fotofly_fn_post_id, 'category');
				
				$cat_count = sizeof($fotofly_fn_categories);
					if($cat_count >= 1){$cat_count = 1;}
					
					for($i = 0; $i < $cat_count; $i++){
						$term_link = get_term_link( $fotofly_fn_categories[$i]->slug, 'category' );
						$cat_list .= '<a href="'.$term_link.'">'.$fotofly_fn_categories[$i]->name.'</a> / ';
					}
					$cat_list = trim($cat_list, " / ");
				// -----------------------------------------
			
				$date = get_the_time(('F, j'), $fotofly_fn_post_id);
			
				$button_text 	= self::$args['button_text'];
				$button_url 	= self::$args['button_url'];
				if($button_url == ''){
					$button_url = '#';
				}
				$html  	   .= '<li class="fotofly_fn_w_blogtriple_item">
								<div class="item">
									<div class="image_holder">
										'.$fotofly_fn_backupthumbnail.'
									</div>
									<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
									<div class="title_holder">
										<div class="in"></div>
										<p>'.$cat_list.' / <span>'.$date.'</span></p>
										<h3><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_blogpost->post_title.'</a></h3>
									</div>
								</div>									
							</li>';
			$cat_list = NULL;
		}
		wp_reset_postdata(); 


		$html .= '</ul></div>';	
		$html .= '</div></div>';
		// END OUTPUT	

		$this->fotofly_fn_counter++;
		return $html;
		
		
	}
	
	
	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_w_blogtriple_wrap';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}
		
		$attr['style'] = sprintf( 'margin-top:%s; margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom']);
		
		return $attr;

	}
}

new frenifySC_BlogFn();