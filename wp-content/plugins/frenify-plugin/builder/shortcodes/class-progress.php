<?php
class frenifySC_Progressbar {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_progressbar-shortcode', array( $this, 'attr' ) );
		add_filter( 'fotofly_fn_attr_progressbar-shortcode-content', array( $this, 'content_attr' ) );
		
		add_shortcode('progress', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults =	frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'					=> '',
				'id'					=> '',
				'striped'					=> 'off',
				'size'					=> '',
				'rounded'					=> 'off',
				'filledcolor' 			=> '',
				'value'					=> '70',
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
		
		if( strpos( $defaults['value'], '%' ) === false) {
			$defaults['value'] = $defaults['value'] . '%';
		}

		extract( $defaults );

		self::$args = $defaults;
		
		$fotofly_fn_extra = '<div class="fotofly_fn_bar_bg"><div class="fotofly_fn_bar_wrap"><div class="fotofly_fn_bar"></div></div></div>';

		
		$html = sprintf( '<div %s><div %s><span><span class="label">%s</span><span class="number">%s</span></span>%s</div></div>', frenifyCore_Plugin::attributes( 'progressbar-shortcode' ), frenifyCore_Plugin::attributes( 'progressbar-shortcode-content' ), $content, $value, $fotofly_fn_extra );

		return $html;

	}

	function attr() {
	
		$attr = array();

		$attr['class'] = 'fotofly_fn_progress_wrap';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		$attr['data-round'] = self::$args['rounded'];
		
		$attr['data-strip'] = self::$args['striped'];
		
		$attr['data-size'] = self::$args['size'];

		return $attr;

	}

	function content_attr() {
	
		$attr = array();

		$attr['class'] = 'fotofly_fn_progress';
		
		$attr['data-color'] = self::$args['filledcolor'];

		$attr['data-value'] = self::$args['value'];

		return $attr;

	}
	

}

new frenifySC_Progressbar();