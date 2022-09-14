<?php
class frenifySC_SocialList {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_social_list-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'social_list_fn', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'skin'						=> '',
				'name'						=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
				'facebook' 					=> '',
				'twitter' 					=> '',
				'instagram' 				=> '',
				'linkedin' 					=> '',
				'dribbble' 					=> '',
				'youtube' 					=> '',
				'pinterest' 				=> '',
				'flickr' 					=> '',
				'vimeo' 					=> '',
				'tumblr' 					=> '',
				'google' 					=> '',
				'skype' 					=> '',
				'email' 					=> '',
				'vkontakte' 				=> '',
				'500px' 					=> '', 
				'odnoklassniki' 			=> '',
				
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

		
		
		// SOCIAL LIST
		$social_list = '<ul class="social_list">';
		
		if( isset( self::$args['facebook'] ) && self::$args['facebook'] ) {
			$social_list .= '<li><a href="'.self::$args['facebook'].'" target="_blank"><i class="xcon-facebook"></i></a></li>'; 
		}
		if( isset( self::$args['twitter'] ) && self::$args['twitter'] ) {
			$social_list .= '<li><a href="'.self::$args['twitter'].'" target="_blank"><i class="xcon-twitter"></i></a></li>'; 
		}
		if( isset( self::$args['instagram'] ) && self::$args['instagram'] ) {
			$social_list .= '<li><a href="'.self::$args['instagram'].'" target="_blank"><i class="xcon-instagram"></i></a></li>'; 
		}
		if( isset( self::$args['google'] ) && self::$args['google'] ) {
			$social_list .= '<li><a href="'.self::$args['google'].'" target="_blank"><i class="xcon-gplus"></i></a></li>'; 
		}
		if( isset( self::$args['linkedin'] ) && self::$args['linkedin'] ) {
			$social_list .= '<li><a href="'.self::$args['linkedin'].'" target="_blank"><i class="xcon-linkedin"></i></a></li>'; 
		}
		if( isset( self::$args['vimeo'] ) && self::$args['vimeo'] ) {
			$social_list .= '<li><a href="'.self::$args['vimeo'].'" target="_blank"><i class="xcon-vimeo"></i></a></li>'; 
		}
		if( isset( self::$args['youtube'] ) && self::$args['youtube'] ) {
			$social_list .= '<li><a href="'.self::$args['youtube'].'" target="_blank"><i class="xcon-youtube-play"></i></a></li>'; 
		}
		if( isset( self::$args['flickr'] ) && self::$args['flickr'] ) {
			$social_list .= '<li><a href="'.self::$args['flickr'].'" target="_blank"><i class="xcon-flickr"></i></a></li>'; 
		}
		if( isset( self::$args['skype'] ) && self::$args['skype'] ) {
			$social_list .= '<li><a href="'.self::$args['skype'].'" target="_blank"><i class="xcon-skype"></i></a></li>'; 
		}
		if( isset( self::$args['tumblr'] ) && self::$args['tumblr'] ) {
			$social_list .= '<li><a href="'.self::$args['tumblr'].'" target="_blank"><i class="xcon-tumblr"></i></a></li>'; 
		}
		if( isset( self::$args['dribbble'] ) && self::$args['dribbble'] ) {
			$social_list .= '<li><a href="'.self::$args['dribbble'].'" target="_blank"><i class="xcon-dribbble"></i></a></li>'; 
		}
		if( isset( self::$args['email'] ) && self::$args['email'] ) {
			$social_list .= '<li><a href="'.self::$args['email'].'" target="_blank"><i class="xcon-email"></i></a></li>'; 
		}
		if( isset( self::$args['vkontakte'] ) && self::$args['vkontakte'] ) {
			$social_list .= '<li><a href="'.self::$args['vkontakte'].'" target="_blank"><i class="xcon-vk"></i></a></li>'; 
		}
		if( isset( self::$args['500px'] ) && self::$args['500px'] ) {
			$social_list .= '<li><a href="'.self::$args['500px'].'" target="_blank"><i class="xcon-500px"></i></a></li>'; 
		}
		if( isset( self::$args['odnoklassniki'] ) && self::$args['odnoklassniki'] ) {
			$social_list .= '<li><a href="'.self::$args['odnoklassniki'].'" target="_blank"><i class="xcon-odnoklassniki"></i></a></li>'; 
		}
		if( isset( self::$args['pinterest'] ) && self::$args['pinterest'] ) {
			$social_list .= '<li><a href="'.self::$args['pinterest'].'" target="_blank"><i class="xcon-pinterest"></i></a></li>'; 
		}
		
		$social_list .= '</ul>';
			
		
		
		$html = sprintf( '<div %s><div class="fotofly_fn_social_list_holder">', frenifyCore_Plugin::attributes( 'social_list-shortcode' ) );
		
		
		$name				= self::$args['name'];
		
		$html .= '<div class="fotofly_fn_social_list"><label>'.$name.'</label>'.$social_list.'</div>';
		$html .= '</div></div>';
												
		

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_social_list_wrapper';

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

new frenifySC_SocialList();