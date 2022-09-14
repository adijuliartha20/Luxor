<?php
class frenifySC_CallToActionClassic {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_call_to_action_classic-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'call_to_action_classic_fn', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'title'						=> '',
				'subtitle'					=> '',
				'title_color'				=> '',
				'subtitle_color'			=> '',
				'link_text'					=> '',
				'link_color'				=> '',
				'link_borrad'				=> '',
				'link_url'					=> '',
				'link_target'				=> '',
				'padding_top'				=> '',
				'padding_bottom'			=> '',
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
		if( strpos( $defaults['padding_top'], '%' ) === false && strpos( $defaults['padding_top'], 'px' ) === false ) {
			$defaults['padding_top'] = $defaults['padding_top'] . 'px';
		}

		if( strpos( $defaults['padding_bottom'], '%' ) === false && strpos( $defaults['padding_bottom'], 'px' ) === false ) {
			$defaults['padding_bottom'] = $defaults['padding_bottom'] . 'px';
		}
		
		// check for border-radius: has "px" or not. if not: add "px"
		if( strpos( $defaults['link_borrad'], '%' ) === false && strpos( $defaults['link_borrad'], 'px' ) === false ) {
			$defaults['link_borrad'] = $defaults['link_borrad'] . 'px';
		}

		extract( $defaults );

		self::$args = $defaults;
			
		
		
		$html = sprintf( '<div %s><div class="container">', frenifyCore_Plugin::attributes( 'call_to_action_classic-shortcode' ) );
		
		
		$fn_title 		= '<h1 style="color:'.$args['title_color'].'">'.$args['title'].'</h1>';
		$fn_subtitle 	= '<p style="color:'.$args['subtitle_color'].'">'.$args['subtitle'].'</p>';
		if(self::$args['link_url'] !== ''){
			$fn_link	= '<a style="color:'.$args['link_color'].'; border-color:'.$args['link_color'].'; border-radius:'.$args['link_borrad'].'" href="'.esc_attr(self::$args['link_url']).'" target="'.$args['link_target'].'"><span class="text">'.$args['link_text'].'</span><span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span></a>';
		}else{
			$fn_link 	= '';
		}
		
		
		$html .= '<div class="inner">'.$fn_title.$fn_subtitle.$fn_link.'</div>';
		$html .= '</div></div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_call_to_action_classic_'.$this->fotofly_fn_counter.' fotofly_fn_call_to_action_classic';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['data-title-color'] 		= self::$args['title_color']; 
		$attr['data-subtitle-color'] 	= self::$args['subtitle_color']; 
		$attr['data-link-color'] 		= self::$args['link_color']; 
		$attr['data-link-borrad'] 		= self::$args['link_borrad']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;padding-top:%s;padding-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['padding_top'], self::$args['padding_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_CallToActionClassic();