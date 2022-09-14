<?php
class frenifySC_ImgAfterBefore {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_img_after_before-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'img_after_before', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'orientation'				=> '',
				'after_text'				=> '',
				'before_text'				=> '',
				'after_img'					=> '',
				'before_img'				=> '',
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

		extract( $defaults );

		self::$args = $defaults;
			
		
		
		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'img_after_before-shortcode' ) );
		
		
		
		$divStart 	= '<div class="twentytwenty-container" data-orientation="'.self::$args['orientation'].'" data-before="'.self::$args['after_text'].'" data-after="'.self::$args['before_text'].'">';
		$img1		= '<img src="'.self::$args['after_img'].'" alt="" />';
		$img2		= '<img src="'.self::$args['before_img'].'" alt="" />';
        $divEnd		= '</div>';
		
		
		$html .= $divStart.$img1.$img2.$divEnd;
		$html .= '</div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_img_after_before_'.$this->fotofly_fn_counter.' fotofly_fn_img_after_before';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}
//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_ImgAfterBefore();