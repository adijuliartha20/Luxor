<?php
class frenifySC_CustompostCategoryFolder {
	
	private $fotofly_fn_counter = 1;
	
	public static $args;


	/**
	 * Initiate the shortcode
	 */
	 
	public function __construct() {

		// Element attributes
		add_filter( 'fotofly_fn_attr_cuspostcat_folder-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'cuspostcat_folder', array( $this, 'render' ) );
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
				'animation_type'		=> '',
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
		
		
		$fn_cat_slug			= '';
		$post_type_from_parent	= self::$args['fn_post_type'];
		$fn_posttype 			= 'fotofly-fn-'.$post_type_from_parent;
		$fn_postcat				= $post_type_from_parent.'_category';
		$fotofly_fn_images		= 'fotofly_fn_'.$post_type_from_parent.'_images';
		if($post_type_from_parent === 'portfolio'){
			$fn_cat_slug		= self::$args['cat_slug'];
		}else if($post_type_from_parent === 'gallery'){
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
			'posts_per_page'		=> 4,
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
		
		
		
		
		$term 					= get_term_by('name', $fn_cat_slug, $fn_postcat);
		$category_link 			= get_category_link( $term );
		
		$count_holder = '';
		if($post_type_from_parent === 'gallery'){
			$count_holder = $fotofly_fn_post_count.' Galleries';
		}else if($post_type_from_parent === 'portfolio'){
			$count_holder = $fotofly_fn_post_count.' Portfolios';
		}
		
		// START OUTPUT
		$html = '';
		$html .= sprintf('<div %s><div class="fotofly_fn_w_cuspostcatfol">', frenifyCore_Plugin::attributes( 'cuspostcat_folder-shortcode' ));
		
		//$html .= fotofly_fn_callback_thumbs(840, 570);
		$html .= '<div class="title_holder">
					<h3><a href="'.$category_link.'">'.$fn_cat_slug.'</a></h3>
					<p>'.$count_holder.'</p>
				</div>';
		$frenify_backup = get_template_directory_uri() .'/framework/img/thumb/thumb-840-570.jpg'; 
		
		$html .= '<div class="frenify-folder-slider" data-animation-type="'.$animation_type.'" data-backupurl="'.$frenify_backup.'">';
		

		foreach ( $fotofly_fn_query->posts as $fotofly_fn_portfoliopost ) {
			setup_postdata( $fotofly_fn_portfoliopost ); 

				$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
				$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);

				$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
				$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
				$post_thumbnail_url = $post_thumbnail_url[0];

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

				$html	 .= '<div><img src="'.$post_thumbnail_url.'" alt="" /></div>';
				$cat_list = $portfolio_list = NULL; 
		}
		wp_reset_postdata(); 


		$html .= '</div>';	
		
		
		
		
		
		
		$html .= '</div></div>';
		// END OUTPUT	

		$this->fotofly_fn_counter++;
		return $html;
		
		
	}
	
	
	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_w_cuspostcatfol_wrap';

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

new frenifySC_CustompostCategoryFolder();