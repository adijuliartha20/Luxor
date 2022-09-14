<?php
class frenifySC_PortfolioCustom {
	
	private $fotofly_fn_counter = 1;
	
	public static $args;


	/**
	 * Initiate the shortcode
	 */
	 
	public function __construct() {

		// Element attributes
		add_filter( 'fotofly_fn_attr_portfolio_custom-shortcode', array( $this, 'attr' ) );
		add_shortcode( 'portfolio_custom', array( $this, 'render' ) );
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
				'fn_post_type' 			=> '',		
				'layout' 				=> '',		
				'cat_slug' 				=> '',
				'exclude_cats' 			=> '',		
				'cat_slug_gallery' 		=> '',
				'exclude_cats_gallery' 	=> '',
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
		
		$layout1 = self::$args['layout'];
		if($layout1 == '' || $layout1 == 'triple'){
			$post_count = 3;
		}else if($layout1 == 'quintuple'){
			$post_count = 5;
		}else if($layout1 == 'quadruple'){
			$post_count = 4;
		}
		
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
		$portfolio_list = NULL;
		$fotofly_fn_portfolio_images = NULL;
		$count_images = NULL;
		
		$fotofly_fn_query 		= new WP_Query($query_args);
		$fotofly_fn_post_count 	= $fotofly_fn_query->found_posts;
		$fotofly_fn_max_pages 	= $fotofly_fn_query->max_num_pages;
		
		
		
		
		// START OUTPUT
		$html = '';
		$html .= sprintf('<div %s><div class="fotofly_fn_w_portfoliocustom">', frenifyCore_Plugin::attributes( 'portfolio_custom-shortcode' ));
		
		
		
		// TRIPLE
		if($layout1 == '' || $layout1 == 'triple') /* ::::::::::::::::::::::::::::: TRIPLE ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="fotofly_fn_w_portfoliocustom_triple"><ul class="w_portfolio_list">';
			
			foreach ( $fotofly_fn_query->posts as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-1000-1000.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
					
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					 
					$html   				   .= '<li class="fotofly_fn_w_portfoliocustom_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</li>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata(); 
			
			$html .= '<li class="discover">
						<div class="in">
							<a href="'.$button_url.'"></a>
							<p>
								<span class="text">'.$button_text.'</span>
								<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
							</p>
							<div class="image_holder">
								'.$fotofly_fn_backupthumbnail.'
							</div>
						</div>
					  </li>';
			$html .= '</ul></div>';	
		}else if($layout1 == 'quintuple') /* ::::::::::::::::::::::::::::: QUINTUPLE ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="fotofly_fn_w_portfoliocustom_quintuple">';
			$html .= '<div class="fotofly_fn_w_port_quintuple_col">';
			

			foreach (array_slice($fotofly_fn_query->posts,0,2)  as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-1000-1000.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
					
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					
					
					 
					$html   				   .= '<div class="fotofly_fn_w_port_quintuple_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata();
			$html .= '</div>';
			$html .= '<div class="fotofly_fn_w_port_quintuple_col mixed">';
			foreach (array_slice($fotofly_fn_query->posts,2,1)  as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-1000-1000.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
					
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					 
					$html   				   .= '<div class="fotofly_fn_w_port_quintuple_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata();
			$html .= '<div class="discover">
						<div class="in">
							<a href="'.$button_url.'"></a>
							<p>
								<span class="text">'.$button_text.'</span>
								<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
							</p>
							<div class="image_holder">
								'.$fotofly_fn_backupthumbnail.'
							</div>
						</div>
					  </div>';
			$html .= '</div>';
			$html .= '<div class="fotofly_fn_w_port_quintuple_col">';
			foreach (array_slice($fotofly_fn_query->posts,3,2)  as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-1000-1000.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
				
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					 
					$html   				   .= '<div class="fotofly_fn_w_port_quintuple_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata();
			
			$html .= '</div>';	
			$html .= '</div>';	
		}else if($layout1 == 'quadruple') /* ::::::::::::::::::::::::::::: QUADRUPLE ::::::::::::::::::::::::::::::: */
		{
			$html .= '<div class="fotofly_fn_w_portfoliocustom_quadruple">';
			$html .= '<div class="fotofly_fn_w_port_quadruple_col">';
			

			foreach (array_slice($fotofly_fn_query->posts,0,1)  as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-570-700.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
					
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					
					
					 
					$html   				   .= '<div class="fotofly_fn_w_port_quadruple_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata();
			$html .= '</div>';
			$html .= '<div class="fotofly_fn_w_port_quadruple_col righted">';
			foreach (array_slice($fotofly_fn_query->posts,1,1)  as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-570-700.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
				
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					 
					$html   				   .= '<div class="fotofly_fn_w_port_quadruple_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata();
			
			$html .= '</div>';	
			$html .= '<div class="fotofly_fn_w_port_quadruple_col mixed">';
			foreach (array_slice($fotofly_fn_query->posts,2,2)  as $fotofly_fn_portfoliopost ) {
				setup_postdata( $fotofly_fn_portfoliopost ); 
						
					$fotofly_fn_post_id 		= $fotofly_fn_portfoliopost->ID;
					$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
					$fotofly_fn_backupthumbnailurl = get_template_directory_uri() .'/framework/img/thumb/thumb-570-700.jpg'; 
					$fotofly_fn_backupthumbnail = '<img src="'.$fotofly_fn_backupthumbnailurl.'" alt="image" />';
					
					$post_thumbnail_id 			= get_post_thumbnail_id( $fotofly_fn_post_id );
					$post_thumbnail_url			= wp_get_attachment_image_src( $post_thumbnail_id, 'fotofly_fn_thumb-800-800' );
					$post_thumbnail_url = $post_thumbnail_url[0];
					
					$button_text 	= self::$args['button_text'];
					$button_url 	= self::$args['button_url'];
					if($button_url == ''){
						$button_url = '#';
					}
					// Attached images. We need to detect this function, because it is added via core plugin
					if(function_exists('rwmb_meta'))
					{
						$fotofly_fn_portfolio_images 			= rwmb_meta( $fotofly_fn_images, 'type=image&size=full', $fotofly_fn_post_id );
						
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
					 
					$html   				   .= '<div class="fotofly_fn_w_port_quadruple_item">
														<div class="item">
															<div class="image_holder">
																'.$fotofly_fn_backupthumbnail.'
															</div>
															<div class="image_holder_overlay" style="background-image:url('.$post_thumbnail_url.')"></div>
															<div class="title_holder">
																<div class="in"></div>
																<span><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_portfoliopost->post_title.'</a></span>
															</div>
															<div class="hover_overlay">
																<div class="in">
																	<a href="'.$fotofly_fn_post_permalink.'"></a>
																	<span><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
																</div>
															</div>
														</div>									
													</div>';
					$cat_list = $portfolio_list = NULL; 
			}
			wp_reset_postdata();
			$html .= '<div class="discover">
						<div class="in">
							<a href="'.$button_url.'"></a>
							<p>
								<span class="text">'.$button_text.'</span>
								<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>
							</p>
							<div class="image_holder">
								'.$fotofly_fn_backupthumbnail.'
							</div>
						</div>
					  </div>';
			$html .= '</div>';
			$html .= '</div>';	
		}
		
		
		
		
		
		$html .= '</div></div>';
		// END OUTPUT	

		$this->fotofly_fn_counter++;
		return $html;
		
		
	}
	
	
	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_w_portfoliocustom_wrap';

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

new frenifySC_PortfolioCustom();