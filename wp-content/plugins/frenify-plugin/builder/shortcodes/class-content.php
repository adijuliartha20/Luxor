<?php
class frenifySC_TDContent {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_tdcontent-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'tdcontent', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'color'						=> '',
				'text_align'				=> '',
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

		
		
		$html = sprintf( '<div class="clearfix"></div><div %s><p>%s</p></div><div class="clearfix"></div>', frenifyCore_Plugin::attributes( 'tdcontent-shortcode' ), do_shortcode($content) );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_custom_content';
		
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['data-x-pos'] = self::$args['text_align']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;color:%s', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['color'] );
		
		return $attr;
		
	}
	

	

}

new frenifySC_TDContent();