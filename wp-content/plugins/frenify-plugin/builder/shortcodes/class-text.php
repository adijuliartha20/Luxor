<?php
class frenifySC_frenifyText {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('frenify_fn_text', array( $this, 'render' ) );

		add_filter( 'frenify_fn_text_content', 'shortcode_unautop' );
		add_filter( 'frenify_fn_text_content', 'do_shortcode' );
	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		return apply_filters( 'frenify_fn_text_content', wpautop( $content, false ) );
	}

}

new frenifySC_frenifyText();