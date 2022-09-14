<?php
class frenifySC_ButtonFn {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_button_fn-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'button_fn', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'text'						=> '',
				'url'						=> '',
				'target'					=> '',
				'type'						=> '',
				'bg_type'					=> '',
				'size'						=> '',
				'animation_switch'			=> '',
				'gradient_direction'		=> '',
				'border_radius'				=> '',
				'alignment'					=> '',
				'text_color'				=> '',
				'bg_color'					=> '',
				'border_color'				=> '',
				'grad_start_color'			=> '',
				'grad_end_color'			=> '',
				'arrow_color'				=> '',
				'text_color_hover'			=> '',
				'bg_color_hover'			=> '',
				'border_color_hover'		=> '',
				'grad_start_color_hover'	=> '',
				'grad_end_color_hover'		=> '',
				'arrow_color_hover'			=> '',
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
		
		// check for button's border radius : has "px" or not. if not: add "px"
		if( strpos( $defaults['border_radius'], '%' ) === false && strpos( $defaults['border_radius'], 'px' ) === false ) {
			$defaults['border_radius'] = $defaults['border_radius'] . 'px';
		}

		extract( $defaults );

		self::$args = $defaults;
			
		
		
		$html 	= sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'button_fn-shortcode' ) );
		
		$text					= self::$args['text'];
		$url					= self::$args['url'];
		$target					= self::$args['target'];
		$type					= self::$args['type'];
		$bg_type				= self::$args['bg_type'];
		//$size					= self::$args['size']; done by data attribute for main div
		$animation_switch		= self::$args['animation_switch'];
		$gradient_direction		= self::$args['gradient_direction'];
		$border_radius			= self::$args['border_radius'];
		//$alignment				= self::$args['alignment']; done by inline style for main div
		$text_color				= self::$args['text_color'];
		$bg_color				= self::$args['bg_color'];
		$border_color			= self::$args['border_color'];
		$grad_start_color		= self::$args['grad_start_color'];
		$grad_end_color			= self::$args['grad_end_color'];
		$arrow_color			= self::$args['arrow_color'];
		$text_color_hover		= self::$args['text_color_hover'];
		$bg_color_hover			= self::$args['bg_color_hover'];
		$border_color_hover		= self::$args['border_color_hover'];
		$grad_start_color_hover	= self::$args['grad_start_color_hover'];
		$grad_end_color_hover	= self::$args['grad_end_color_hover'];
		$arrow_color_hover		= self::$args['arrow_color_hover'];
		
		
		$border_color_style = $arrow = $bg_style = $text_color_style = '';
		// button type
		if($type == 'simple'){
			$arrow .= '';
		}else if($type == ''){
			$arrow .= '<span class="arrow" style="color:'.$arrow_color.';"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>';
		}
		// button bg type
		if($bg_type == 'none'){
			$bg_style .= 'background: transparent;';
		}else if($bg_type == 'color'){
			$bg_style .= 'background: '.$bg_color.';';
		}else if($bg_type == 'gradient'){
			// gradient direction
			if($gradient_direction == '' || $gradient_direction == 'toptobottom'){
				$bg_style .= 'background: '.$bg_color.';'; /* For browsers that do not support gradients */
				$bg_style .= 'background: -webkit-linear-gradient('.$grad_start_color.', '.$grad_end_color.');'; /* For Safari 5.1 to 6.0 */
				$bg_style .= 'background: -o-linear-gradient('.$grad_start_color.', '.$grad_end_color.');'; /* For Opera 11.1 to 12.0 */
				$bg_style .= 'background: -moz-linear-gradient('.$grad_start_color.', '.$grad_end_color.');'; /* For Firefox 3.6 to 15 */
				$bg_style .= 'background: linear-gradient('.$grad_start_color.', '.$grad_end_color.');'; /* Standard syntax */
			}else if($gradient_direction == 'lefttoright'){
				$bg_style .= 'background: '.$bg_color.';'; /* For browsers that do not support gradients */
				$bg_style .= 'background: -webkit-linear-gradient(left, '.$grad_start_color.', '.$grad_end_color.');'; /* For Safari 5.1 to 6.0 */
				$bg_style .= 'background: -o-linear-gradient(right, '.$grad_start_color.', '.$grad_end_color.');'; /* For Opera 11.1 to 12.0 */
				$bg_style .= 'background: -moz-linear-gradient(right, '.$grad_start_color.', '.$grad_end_color.');'; /* For Firefox 3.6 to 15 */
				$bg_style .= 'background: linear-gradient(to right, '.$grad_start_color.', '.$grad_end_color.');'; /* Standard syntax */
			}else if($gradient_direction == 'diagonal'){
				$bg_style .= 'background: '.$bg_color.';'; /* For browsers that do not support gradients */
				$bg_style .= 'background: -webkit-linear-gradient(left top, '.$grad_start_color.', '.$grad_end_color.');'; /* For Safari 5.1 to 6.0 */
				$bg_style .= 'background: -o-linear-gradient(bottom right, '.$grad_start_color.', '.$grad_end_color.');'; /* For Opera 11.1 to 12.0 */
				$bg_style .= 'background: -moz-linear-gradient(bottom right, '.$grad_start_color.', '.$grad_end_color.');'; /* For Firefox 3.6 to 15 */
				$bg_style .= 'background: linear-gradient(to bottom right, '.$grad_start_color.', '.$grad_end_color.');'; /* Standard syntax */
			}else if($gradient_direction == 'angle'){
				$bg_style .= 'background: '.$bg_color.';'; /* For browsers that do not support gradients */
				$bg_style .= 'background: -webkit-linear-gradient(-30deg, '.$grad_start_color.', '.$grad_end_color.');'; /* For Safari 5.1 to 6.0 */
				$bg_style .= 'background: -o-linear-gradient(-30deg, '.$grad_start_color.', '.$grad_end_color.');'; /* For Opera 11.1 to 12.0 */
				$bg_style .= 'background: -moz-linear-gradient(-30deg, '.$grad_start_color.', '.$grad_end_color.');'; /* For Firefox 3.6 to 15 */
				$bg_style .= 'background: linear-gradient(-30deg, '.$grad_start_color.', '.$grad_end_color.');'; /* Standard syntax */
			}
		}
		// button text color
		if($text_color == ''){
			$text_color_style .= 'color: #111;';
		}else{
			$text_color_style .= 'color: '.$text_color.';';
		}
		// button border color
		if($border_color == '' || $border_color == 'transparent'){
			$border_color_style .= 'border: none;';
		}else{
			$border_color_style .= 'border-color: '.$border_color.';';
		}
		// button border radius
		$border_radius_style = 'border-radius: '.$border_radius.';';
		// button background styles
		$mainBgButton  = 	'.fotofly_fn_mainbutton_'.$this->fotofly_fn_counter.' a:after{'.$bg_style.'}';
		
		/*************************** BUTTON HOVER ELEMENTS ****************************/
		$bg_hover_style = '';
		if($bg_type == 'none'){
			$bg_hover_style .= 'background: transparent;';
		}else if($bg_type == 'color'){
			$bg_hover_style .= 'background: '.$bg_color_hover.';';
		}else if($bg_type == 'gradient'){
			// gradient direction
			if($gradient_direction == '' || $gradient_direction == 'toptobottom'){
				$bg_hover_style .= 'background: '.$bg_color_hover.' !important;'; /* For browsers that do not support gradients */
				$bg_hover_style .= 'background: -webkit-linear-gradient('.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Safari 5.1 to 6.0 */
				$bg_hover_style .= 'background: -o-linear-gradient('.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Opera 11.1 to 12.0 */
				$bg_hover_style .= 'background: -moz-linear-gradient('.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Firefox 3.6 to 15 */
				$bg_hover_style .= 'background: linear-gradient('.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* Standard syntax */
			}else if($gradient_direction == 'lefttoright'){
				$bg_hover_style .= 'background: '.$bg_color_hover.' !important;'; /* For browsers that do not support gradients */
				$bg_hover_style .= 'background: -webkit-linear-gradient(left, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Safari 5.1 to 6.0 */
				$bg_hover_style .= 'background: -o-linear-gradient(right, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Opera 11.1 to 12.0 */
				$bg_hover_style .= 'background: -moz-linear-gradient(right, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Firefox 3.6 to 15 */
				$bg_hover_style .= 'background: linear-gradient(to right, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* Standard syntax */
			}else if($gradient_direction == 'diagonal'){
				$bg_hover_style .= 'background: '.$bg_color_hover.' !important;'; /* For browsers that do not support gradients */
				$bg_hover_style .= 'background: -webkit-linear-gradient(left top, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Safari 5.1 to 6.0 */
				$bg_hover_style .= 'background: -o-linear-gradient(bottom right, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Opera 11.1 to 12.0 */
				$bg_hover_style .= 'background: -moz-linear-gradient(bottom right, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Firefox 3.6 to 15 */
				$bg_hover_style .= 'background: linear-gradient(to bottom right, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* Standard syntax */
			}else if($gradient_direction == 'angle'){
				$bg_hover_style .= 'background: '.$bg_color_hover.' !important;'; /* For browsers that do not support gradients */
				$bg_hover_style .= 'background: -webkit-linear-gradient(-30deg, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Safari 5.1 to 6.0 */
				$bg_hover_style .= 'background: -o-linear-gradient(-30deg, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Opera 11.1 to 12.0 */
				$bg_hover_style .= 'background: -moz-linear-gradient(-30deg, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* For Firefox 3.6 to 15 */
				$bg_hover_style .= 'background: linear-gradient(-30deg, '.$grad_start_color_hover.', '.$grad_end_color_hover.') !important;'; /* Standard syntax */
			}
		}
		
		if($animation_switch == 'disable'){
			$hoveBgButton	= '';
		}else{
			$hoveBgButton	=  	'
									.fotofly_fn_mainbutton_'.$this->fotofly_fn_counter.' a:before{'.$bg_hover_style.'}
									.fotofly_fn_mainbutton_'.$this->fotofly_fn_counter.' a:hover{
										color: '.$text_color_hover.' !important;
										border-color: '.$border_color_hover.' !important;
									}
									.fotofly_fn_mainbutton_'.$this->fotofly_fn_counter.' a:hover .arrow{
										color: '.$arrow_color_hover.' !important;
									}'.$mainBgButton;
		}
		
		
		$html 	.= '<a  data-inlinestyles="'.$hoveBgButton.'" style="'.$text_color_style.$border_radius_style.$border_color_style.'" href="'.$url.'" target="'.$target.'"><span class="text">'.$text.'</span>'.$arrow.'</a>';
		$html 	.= '</div>';
		
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_mainbutton_'.$this->fotofly_fn_counter.' fotofly_fn_mainbutton';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['data-size'] 	= self::$args['size'];

		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;text-align:%s', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['alignment']);
		
		return $attr;
		
	}
	

}

new frenifySC_ButtonFn();