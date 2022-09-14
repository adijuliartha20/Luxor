<?php
class frenifySC_CallToAction {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_call_to_action-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'call_to_action_fn', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'bg_type'					=> '',
				'border_radius'				=> '',
				'name'						=> '',
				'color'						=> '',
				'bgcolor'					=> '',
				'bggrad_direction'			=> '',
				'bggrad_from_color'			=> '',
				'bggrad_to_color'			=> '',
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
		if( strpos( $defaults['border_radius'], '%' ) === false && strpos( $defaults['border_radius'], 'px' ) === false ) {
			$defaults['border_radius'] = $defaults['border_radius'] . 'px';
		}

		extract( $defaults );

		self::$args = $defaults;
			
		$bg_style = 'style="';
		if($bg_type =='color'){
			$bg_style .= 'background:'.$bgcolor.';';
		}elseif($bg_type == 'gradient'){
			$bg_style .= 'background:'.$bgcolor.';';
			$bg_style .= 'background: -webkit-linear-gradient('.$bggrad_direction.', '.$bggrad_from_color.', '.$bggrad_to_color.');';
			$bg_style .= 'background: -o-linear-gradient('.$bggrad_direction.', '.$bggrad_from_color.', '.$bggrad_to_color.');';
			$bg_style .= 'background: -moz-linear-gradient('.$bggrad_direction.', '.$bggrad_from_color.', '.$bggrad_to_color.');';
			$bg_style .= 'background: linear-gradient('.$bggrad_direction.', '.$bggrad_from_color.', '.$bggrad_to_color.');';
		}
		$bg_style .= '"';
		
		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'call_to_action-shortcode' ) );
		
		
		$html .= '<div class="call_inner" '.$bg_style.'></div><a href="'.esc_attr(self::$args['link_url']).'" target="'.$args['link_target'].'" style="padding-top:'.self::$args['padding_top'].';padding-bottom:'.self::$args['padding_bottom'].';border-radius:'.self::$args['border_radius'].';"><span>'.$args['name'].'<i class="xcon-angle-right"></i></span></a>';
		$html .= '</div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_call_to_action_'.$this->fotofly_fn_counter.' fotofly_fn_call_to_action';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['data-bg-type'] 			= self::$args['bg_type'];
		$attr['data-bggrad-direction'] 	= self::$args['bggrad_direction'];
		$attr['data-bg-color'] 			= self::$args['bgcolor'];
		$attr['data-bggrad-start'] 		= self::$args['bggrad_from_color'];
		$attr['data-bggrad-end'] 		= self::$args['bggrad_to_color'];
		$attr['data-text-color'] 		= self::$args['color'];
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;border-radius:%s;', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['border_radius']);
		
		return $attr;
		
	}
	

}

new frenifySC_CallToAction();