<?php
class frenifySC_frenifyCustomTitle {

	public static $args;
	private $fotofly_fn_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'fotofly_fn_attr_fntitle-shortcode', array( $this, 'attr' ) );
		
		add_shortcode('custom_title', array( $this, 'render' ) );
	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '' ) {

		$defaults =	frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'title' 			=> '',
				'titletype' 		=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
				'textcolor' 		=> '',
				'textalign' 		=> '',
				'texttransform'		=> '',
				'class' 			=> '',
				'id' 				=> '',
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
		
		$input = do_shortcode( $content );
		
		$html = '';
		$html .= sprintf('<div %s><div class="fotofly_fn_title_content"><span>%s</span></div></div>',frenifyCore_Plugin::attributes( 'fntitle-shortcode' ),$input);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_title fotofly_fn_title-%s', $this->fotofly_fn_counter );
		
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' .self::$args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_title_%s', $this->fotofly_fn_counter );
//		
//		if( self::$args['id'] ) {
//			$attr['id'] .= ' ' .self::$args['id'];
//		}
		
		$attr['data-type'] = self::$args['titletype'];
		$attr['data-text-pos'] = self::$args['textalign']; 
		$attr['data-text-transform'] = self::$args['texttransform']; 
		$attr['data-text-color'] = self::$args['textcolor']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;

	}

}

new frenifySC_frenifyCustomTitle();