<?php
class frenifySC_OnePageTextLink {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_one-page-text-link-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'one_page_text_link', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'			   	=> '',
				'id'				 	=> '',
				'link'					=> '',
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		$html = sprintf( '<a %s>%s</a>', 
						 frenifyCore_Plugin::attributes( 'one-page-text-link-shortcode' ), do_shortcode( $content ) );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'frenify-one-page-text-link';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}

		$attr['href'] = self::$args['link'];

		return $attr;

	}
	
}

new frenifySC_OnePageTextLink();
