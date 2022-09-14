<?php
class frenifySC_CustompostCategoryModern {
	
	private $fotofly_fn_counter = 1;
	
	public static $args;


	/**
	 * Initiate the shortcode
	 */
	 
	public function __construct() {

		// Element attributes
		add_filter( 'fotofly_fn_attr_cuspostcat_modern-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'cuspostcat_modern', array( $this, 'render' ) );
	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string HTML output
	 */
	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class' 				=> '',
				'id' 					=> '',
				'skin' 					=> '',
				'layout' 				=> '',
				'fn_post_type' 			=> '',
				'cat_slug' 				=> '',	
				'cat_slug_gallery' 		=> '',
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
		
		
		$layout1				= self::$args['layout'];
		if($layout1 === 'square'){
			$thumbImage = fotofly_fn_callback_thumbs(1000, 1000);
		}else if($layout1 === 'portrait'){
			$thumbImage = fotofly_fn_callback_thumbs(570, 700);
		}else if($layout1 === 'landscape'){
			$thumbImage = fotofly_fn_callback_thumbs(840, 570);
		}
		
		$fn_cat_slug			= '';
		$post_type_from_parent	= self::$args['fn_post_type'];
		$fn_posttype 			= 'fotofly-fn-'.$post_type_from_parent;
		$fn_postcat				= $post_type_from_parent.'_category';
		$fotofly_fn_images		= 'fotofly_fn_'.$post_type_from_parent.'_images';
		if($post_type_from_parent == 'portfolio'){
			$fn_cat_slug		= self::$args['cat_slug'];
		}else if($post_type_from_parent == 'gallery'){
			$fn_cat_slug		= self::$args['cat_slug_gallery'];
		}
		
		// Transform $cat_slugs to array
		if ( $fn_cat_slug ) {
			$cat_slugs = preg_replace( '/\s+/', '', $fn_cat_slug );
			$cat_slugs = explode( ',', $fn_cat_slug );
		} else {
			$cat_slugs = array();
		}		
		
		
		// Initialize the query array
		$query_args = array(
			'post_type' 			=> $fn_posttype,
			'paged' 				=> 1,
			'post_status' 			=> 'publish',  
			'posts_per_page'		=> 1,
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
		
		wp_reset_query();
		
		
		$fotofly_fn_query = NULL;
		$fotofly_fn_post_img = NULL;
		$disabled = NULL;
		$term_link = NULL;
		$cat_list = NULL;
		$portfolio_list = NULL;
		$fotofly_fn_portfolio_images = NULL;
		$count_images = NULL;
		
		$fotofly_fn_query 		= new WP_Query($query_args);
		$fotofly_fn_post_count 	= $fotofly_fn_query->found_posts;
		$fotofly_fn_max_pages 	= $fotofly_fn_query->max_num_pages;
		
		
		
		//echo "$fn_cat_slug, $fn_postcat##";
		$term 			= get_term_by('slug', $fn_cat_slug, $fn_postcat);//print_r($term);
		$fn_cat_name = $term->name;
		$category_link 	= get_category_link( $term );
		
		$fn_arrow		= '<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>';
		
		// START OUTPUT
		$html = '';
		$html .= sprintf('<div %s><div class="fotofly_fn_w_cuspostcatmod fsdfs">', frenifyCore_Plugin::attributes( 'cuspostcat_modern-shortcode' ));
		
		$html .= '<div class="title_holder">
					<a href="'.$category_link.'"><span class="text">'.$fn_cat_name.'</span>'.$fn_arrow.'</a>
				</div>';
		
		
		//print_r($fotofly_fn_query->posts);

		foreach ( $fotofly_fn_query->posts as $fotofly_fn_portfoliopost ) {
			setup_postdata( $fotofly_fn_portfoliopost ); 
				$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;//echo $fotofly_fn_post_id.'#';
				$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
				$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );//print_r($post_thumbnail_url);echo '#';
				$post_thumbnail_url 		= $post_thumbnail_url[0];

				$catImageURL 				= f_display_image_url($term->term_taxonomy_id);
				
				if($catImageURL === ''){
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{

						$fotofly_fn_portfolio_images = rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );

						if($fotofly_fn_portfolio_images){
							foreach(array_slice($fotofly_fn_portfolio_images, 0, 1) as $img){
								$object = wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-800-800' );
								$image_url = $object[0];
							}
							if($post_thumbnail_url == ''){
								$post_thumbnail_url = $image_url;
							}
						}
					}
				}else{
					
					$post_thumbnail_url = $catImageURL;
				}
			
			
				$html   				   .= 	'<div class="item">
													<div class="image_holder">'.$thumbImage.'</div>
													<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
												</div>';
				$cat_list = $portfolio_list = NULL; 
		}
		wp_reset_postdata(); 
	
		
		
		$html .= '</div></div>';
		// END OUTPUT	

		$this->fotofly_fn_counter++;
		return $html;
		
		
	}
	
	
	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_w_cuspostcatmod_wrap';

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

new frenifySC_CustompostCategoryModern();