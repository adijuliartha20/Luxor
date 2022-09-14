<?php
class frenifySC_frenifyLightbox {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_shortcode('frenify_fn_lightbox', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		return do_shortcode( $content );
	}

}

new frenifySC_frenifyLightbox();