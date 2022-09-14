<?php
class frenifySC_ContactInfo {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_contact_info-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'contact_info', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'skin'						=> '',			
				'class'						=> '',			
				'id'						=> '',
				'email_text'				=> '',
				'email_own'					=> '',
				'email_url'					=> '',
				'call_text'					=> '',
				'call_number'				=> '',
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
			
		
		
		$html = sprintf( '<div %s><div class="container">', frenifyCore_Plugin::attributes( 'contact_info-shortcode' ) );
		
		$fn_email_icon	= '<p class="iconbox"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/message.svg" alt="" /></p>';
		$fn_email_text 	= '<span class="text">'.$args['email_text'].'</span>';
		$fn_email_own	= '<a href="'.$args['email_url'].'">'.$args['email_own'].'</a>';
		$fn_email		= '<div class="mailbox">'.$fn_email_icon.'<p>'.$fn_email_text.$fn_email_own.'</p></div>';
		$fn_call_text	= '<p>'.$args['call_text'].'</p>';
		$fn_call_number	= '<h3>'.$args['call_number'].'</h3>';
		$fn_call		= '<div class="callbox">'.$fn_call_text.$fn_call_number.'</div>';
		
		
		$html .= '<div class="inner">'.$fn_email.$fn_call.'</div>';
		$html .= '</div></div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_contact_info_'.$this->fotofly_fn_counter.' fotofly_fn_contact_info';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin']; 
		}
		
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;padding-top:%s;padding-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['padding_top'], self::$args['padding_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_ContactInfo();