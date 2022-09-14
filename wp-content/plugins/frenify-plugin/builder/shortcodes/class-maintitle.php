<?php
class frenifySC_frenifyMainTitle {

	public static $args;
	private $fotofly_fn_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {
		add_filter( 'fotofly_fn_attr_maintitle-shortcode', array( $this, 'attr' ) );
		
		add_shortcode('main_title', array( $this, 'render' ) );
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
				'subtitle' 			=> '',
				'descr'				=> '',
				't_layout' 			=> '',
				't_color' 			=> '',
				's_color' 			=> '',
				'd_color'	 		=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
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
		$html .= sprintf('<div %s><div class="container"><div class="title_holder"><h3 style="color:%s;">%s</h3><p style="color:%s;">%s</p></div><div class="descr" style="color:%s;"><p>%s</p></div></div></div>',frenifyCore_Plugin::attributes( 'maintitle-shortcode' ),$t_color,$title,$s_color,$subtitle,$d_color,$descr);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_maintitle fotofly_fn_maintitle-%s', $this->fotofly_fn_counter );
		
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' .self::$args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_maintitle_%s', $this->fotofly_fn_counter );
//		
//		if( self::$args['id'] ) {
//			$attr['id'] .= ' ' .self::$args['id'];
//		}
		
		$attr['data-layout'] = self::$args['t_layout'];
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;

	}

}

new frenifySC_frenifyMainTitle();