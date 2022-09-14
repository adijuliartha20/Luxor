<?php
class frenifySC_FlipboxFn {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_flipbox_fn-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'flipbox_fn', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
			
				//main options
				'hover_effect_direction'	=> '',
				'content_position'			=> '',
				'border_radius'				=> '',
				
				// front side options
				'bg_type_front'				=> '',
				'bg_color_front'			=> '',
				'bg_gr_degree_front'		=> '',
				'bg_gr_start_front'			=> '',
				'bg_gr_end_front'			=> '',
				'bg_img_front'				=> '',
				'title_front'				=> '',
				'title_color_front'			=> '',
				'content_front'				=> '',
				'content_color_front'		=> '',
			
				// back side options
				'bg_type_back'				=> '',
				'bg_color_back'				=> '',
				'bg_gr_degree_back'			=> '',
				'bg_gr_start_back'			=> '',
				'bg_gr_end_back'			=> '',
				'bg_img_back'				=> '',
				'title_back'				=> '',
				'title_color_back'			=> '',
				'content_back'				=> '',
				'content_color_back'		=> '',
				'link_url_back'				=> '',
				'link_text_back'			=> '',
				'link_color_back'			=> '',
				
				// default options
				'padding_top'				=> '',
				'padding_bottom'			=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
				'class'						=> '',			
				'id'						=> '',
				
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
		
		// check for border-radius of clipbox: has "px" or not. if not: add "px"
		if( strpos( $defaults['border_radius'], '%' ) === false && strpos( $defaults['border_radius'], 'px' ) === false ) {
			$defaults['border_radius'] = $defaults['border_radius'] . 'px';
		}

		extract( $defaults );

		self::$args = $defaults;
			
		
		
		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'flipbox_fn-shortcode' ) );
		
		/******************* all option of flipbox *****************/
		$border_radius 			= $args['border_radius'];
				
		// front side options
		$bg_type_front 			= $args['bg_type_front'];
		$bg_color_front 		= $args['bg_color_front'];
		$bg_gr_degree_front 	= $args['bg_gr_degree_front'];
		$bg_gr_start_front 		= $args['bg_gr_start_front'];
		$bg_gr_end_front 		= $args['bg_gr_end_front'];
		$bg_img_front 			= $args['bg_img_front'];
		$title_front 			= $args['title_front'];
		$title_color_front 		= $args['title_color_front'];
		$content_front 			= $args['content_front'];
		$content_color_front 	= $args['content_color_front'];
			
		// back side options
		$bg_type_back 			= $args['bg_type_back'];
		$bg_color_back 			= $args['bg_color_back'];
		$bg_gr_degree_back 		= $args['bg_gr_degree_back'];
		$bg_gr_start_back 		= $args['bg_gr_start_back'];
		$bg_gr_end_back 		= $args['bg_gr_end_back'];
		$bg_img_back 			= $args['bg_img_back'];
		$title_back 			= $args['title_back'];
		$title_color_back 		= $args['title_color_back'];
		$content_back 			= $args['content_back'];
		$content_color_back 	= $args['content_color_back'];
		$link_url_back 			= $args['link_url_back'];
		$link_text_back 		= $args['link_text_back'];
		$link_color_back 		= $args['link_color_back'];
		
		
		$border_radius_style 	= '-webkit-border-radius:'.$border_radius.';'.'-moz-border-radius:'.$border_radius.';'.'border-radius:'.$border_radius.';';
		/******************* front side of flipbox *****************/
		$frontside = $bgfront = $title_fronthtml = $content_fronthtml = '';
		
		// background type
		if($bg_type_front == 'color'){
			$bgfront .= '<div class="o_color" style="background-color:'.$bg_color_front.';'.$border_radius_style.'"></div>';
		}else if($bg_type_front == 'gradient'){
			$bgstyle_front = '';
			$bgstyle_front .= 'background: '.$bg_color_front.';'; /* For browsers that do not support gradients */
			$bgstyle_front .= 'background: -webkit-linear-gradient('.$bg_gr_degree_front.', '.$bg_gr_start_front.', '.$bg_gr_end_front.');'; /* For Safari 5.1 to 6.0 */
			$bgstyle_front .= 'background: -o-linear-gradient('.$bg_gr_degree_front.', '.$bg_gr_start_front.', '.$bg_gr_end_front.');'; /* For Opera 11.1 to 12.0 */
			$bgstyle_front .= 'background: -moz-linear-gradient('.$bg_gr_degree_front.', '.$bg_gr_start_front.', '.$bg_gr_end_front.');'; /* For Firefox 3.6 to 15 */
			$bgstyle_front .= 'background: linear-gradient('.$bg_gr_degree_front.', '.$bg_gr_start_front.', '.$bg_gr_end_front.');'; /* Standard syntax */
			$bgfront .= '<div class="o_gradient" style="'.$bgstyle_front.$border_radius_style.'"></div>';
		}else if($bg_type_front == 'image'){
			$bgfront .= '<div class="o_image" style="background-image:url('.$bg_img_front.');'.$border_radius_style.'"></div>';
		}
		$title_fronthtml 	.= '<h3 style="color:'.$title_color_front.'">'.$title_front.'</h3>';
		$content_fronthtml 	.= '<p style="color:'.$content_color_front.'">'.$content_front.'</p>';
		$front_inner = '<div class="inner"><div class="in">'.$title_fronthtml.$content_fronthtml.'</div></div>';
		$frontside .= '<div class="fn_flipbox_frontside" style="'.$border_radius_style.'">'.$bgfront.$front_inner.'</div>';
		
		
		/******************* back side of flipbox *****************/
		$backside = $bgback = $title_backhtml = $content_backhtml = '';
		
		// background type
		if($bg_type_back == 'color'){
			$bgback .= '<div class="o_color" style="background-color:'.$bg_color_back.';'.$border_radius_style.'"></div>';
		}else if($bg_type_back == 'gradient'){
			$bgstyle_back = '';
			$bgstyle_back .= 'background: '.$bg_color_back.';'; /* For browsers that do not support gradients */
			$bgstyle_back .= 'background: -webkit-linear-gradient('.$bg_gr_degree_back.', '.$bg_gr_start_back.', '.$bg_gr_end_back.');'; /* For Safari 5.1 to 6.0 */
			$bgstyle_back .= 'background: -o-linear-gradient('.$bg_gr_degree_back.', '.$bg_gr_start_back.', '.$bg_gr_end_back.');'; /* For Opera 11.1 to 12.0 */
			$bgstyle_back .= 'background: -moz-linear-gradient('.$bg_gr_degree_back.', '.$bg_gr_start_back.', '.$bg_gr_end_back.');'; /* For Firefox 3.6 to 15 */
			$bgstyle_back .= 'background: linear-gradient('.$bg_gr_degree_back.', '.$bg_gr_start_back.', '.$bg_gr_end_back.');'; /* Standard syntax */
			$bgback .= '<div class="o_gradient" style="'.$bgstyle_back.$border_radius_style.'"></div>';
		}else if($bg_type_back == 'image'){
			$bgback .= '<div class="o_image" style="background-image:url('.$bg_img_back.');'.$border_radius_style.'"></div>';
		}
		// button
		if($link_url_back == ''){
			$link_url_backhtml = '';
		}else{
			$link_text = '<span class="text">'.$link_text_back.'</span>';
			$link_arrow = '<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>';
			$link_url_backhtml = '<a href="'.$link_url_back.'" style="color:'.$link_color_back.';border-color:'.$link_color_back.'">'.$link_text.$link_arrow.'</a>';
		}
		
		$title_backhtml 	.= '<h3 style="color:'.$title_color_back.'">'.$title_back.'</h3>';
		$content_backhtml 	.= '<p style="color:'.$content_color_back.'">'.$content_back.'</p>';
		$back_inner = '<div class="inner"><div class="in">'.$title_backhtml.$content_backhtml.$link_url_backhtml.'</div></div>';
		$backside .= '<div class="fn_flipbox_backside" style="'.$border_radius_style.'">'.$bgback.$back_inner.'</div>';
		
		
		// get same height
		$child1 = '<div class="flip_h_box fn_front">'.$title_fronthtml.$content_fronthtml.'</div>';
		$child2 = '<div class="flip_h_box fn_back">'.$title_backhtml.$content_backhtml.$link_url_backhtml.'</div>';
		$parent	= '<div class="flip_h_boxes fn_flip">'.$child1.$child2.'</div>';
		
		
		$html .= $parent.$frontside.$backside;
		$html .= '</div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_flipbox_fn_'.$this->fotofly_fn_counter.' fotofly_fn_flipbox_fn';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['data-content-pos']	= self::$args['content_position'];
		$attr['data-effect'] 		= self::$args['hover_effect_direction'];
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;padding-top:%s;padding-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['padding_top'], self::$args['padding_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_FlipboxFn();