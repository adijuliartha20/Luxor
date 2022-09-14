<?php
class frenifySC_Instagram {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_instagram-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'instagram_fn', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'skin'						=> '',
				'username'					=> '',
				'linktext'					=> '',
				'linktarget'				=> '',
				'subtext'					=> '',
				'images_only'				=> '',
				'class'						=> '',			
				'id'						=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
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
		
		
		
		$username = self::$args['username'];
		$template_part = NULL;
		
		$images_limit = 8;
		$images_only = self::$args['images_only'];;
		$size = 'small'; // thumbnail, small, large, original
		$target = self::$args['linktarget'];
		$link = trailingslashit( 'https://www.instagram.com/' . esc_attr( trim( $username ) ) );
		$linkText = self::$args['linktext'];
		$subText = self::$args['subtext'];
		
		
		
		
		$follow_div = '<div class="follow"><div class="following"><img class="fotofly_fn_svg" src="'.get_template_directory_uri() .'/framework/img/svg/instagram.svg'.'" alt="" /><h3><a href="'.esc_url($link).'" rel="me" target="'.esc_attr( $target ).'">'.wp_kses_post( $linkText ).'</a></h3><p>'.esc_html($subText).'</p></div></div>';
		
		
		// IMAGES
		$media_array = fotofly_fn_scrape_instagram( $username );

		if ( is_wp_error( $media_array ) ) {

			$template_part .=  wp_kses_post( $media_array->get_error_message() );

		} else {
			
			function images_only($media_item){
				if($media_item['type'] == 'image')
					return true;
				return false;
			}
			
			// filter for images only?
			if ( $images_only = apply_filters( 'wpiw_images_only', $images_only ) ) {
				$media_array = array_filter( $media_array,  'images_only'  );
			}

			// slice list down to required limit
			$media_array = array_slice( $media_array, 0, $images_limit );

			// filters for custom classes
			$ulclass = apply_filters( 'wpiw_list_class', 'instagram-pics instagram-size-' . $size );
			$liclass = apply_filters( 'wpiw_item_class', '' );
			$aclass = apply_filters( 'wpiw_a_class', '' );
			$imgclass = apply_filters( 'wpiw_img_class', '' );

			
			
			$template_part .= $follow_div.'<ul class="'.esc_attr($ulclass).'">';
			foreach ( $media_array as $item ) {
				$template_part .= '<li class="'. esc_attr( $liclass ) .'"><a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"  class="'. esc_attr( $aclass ) .'"><img src="'.esc_url( $item[$size]).'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"  class="'. esc_attr( $imgclass ) .'"/></a></li>';
			}
			$template_part .= '</ul>';
			
			
		}
		
		
		

		// RENDER CONTENT
		$html = sprintf( '<div %s><div class="container"><div class="fotofly_instagram_content"><div class="fixer">%s</div></div></div></div>', frenifyCore_Plugin::attributes( 'instagram-shortcode' ), $template_part );
											
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_instagram';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}
//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin']; 
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_Instagram();