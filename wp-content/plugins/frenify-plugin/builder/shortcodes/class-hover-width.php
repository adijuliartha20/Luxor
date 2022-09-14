<?php
class frenifySC_HoverWidth {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_hover_width-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'hover_width', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'skin'						=> '',
				'title'						=> '',
				'fn_content'				=> '',
				'link_url'					=> '',
				'link_text'					=> '',
				'img1'						=> '',
				'img2'						=> '',
				'img3'						=> '',
				'img4'						=> '',
				'img5'						=> '',
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
			
		
		
		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'hover_width-shortcode' ) );
		
		$titlehtml 		= '<h3>'.$title.'</h3>';
		$contenthtml 	= '<p>'.$fn_content.'</p>';
		$leftSide 		= '<div class="item item_left"><div class="item_in">'.$titlehtml.$contenthtml.'</div></div>';
		
		$thumb 			= fotofly_fn_callback_thumbs(1000, 1000);
		$image1			= '<li class="current">'.$thumb.'<div class="h_item" style="background-image:url('.$img1.')"></div></li>';
		$image2			= '<li>'.$thumb.'<div class="h_item" style="background-image:url('.$img2.')"></div></li>';
		$image3			= '<li>'.$thumb.'<div class="h_item" style="background-image:url('.$img3.')"></div></li>';
		$image4			= '<li>'.$thumb.'<div class="h_item" style="background-image:url('.$img4.')"></div></li>';
		$image5			= '<li>'.$thumb.'<div class="h_item" style="background-image:url('.$img5.')"></div></li>';
		
		$middleSide		= '<div class="item item_middle"><div class="item_in"><ul>'.$image1.$image2.$image3.$image4.$image5.'</ul></div></div>';
		
		$linkhtml		= '<a href="'.$link_url.'"><span class="text">'.$link_text.'</span><span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span></a>';
		$rightSide		= '<div class="item item_right"><div class="item_in">'.$linkhtml.'</div></div>';
		
		$html .= $leftSide.$middleSide.$rightSide;
		$html .= '</div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_hover_width_'.$this->fotofly_fn_counter.' fotofly_fn_hover_width';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}
//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin']; 
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_HoverWidth();