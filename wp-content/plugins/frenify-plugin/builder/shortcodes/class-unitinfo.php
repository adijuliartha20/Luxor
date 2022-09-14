<?php
class frenifySC_UnitInfo {

	private $fotofly_fn_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_unit_info-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'unit_info', array( $this, 'render' ) );
		add_shortcode( 'ui_image', array( $this, 'render_child' ) );
	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '' ) {

		$defaults =	frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'title' 			=> '',
				'descr' 			=> '',
				'link_url' 			=> '',
				'link_text' 		=> '',
				't_color' 			=> '',
				'd_color' 			=> '',
				'l_color' 			=> '',
				'l_bgcolor' 		=> '',
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
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

		self::$parent_args = $defaults;
		
		$child_output = do_shortcode($content);
		$child_output = rtrim($child_output, ',');
		
		$arrow			= '<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>';
		$owl_control 	= '<div class="owl_control"><div>'.$arrow.'</div><div>'.$arrow.'</div></div>';
		
		$html = '';
		$html .= sprintf('<div %s><div class="title_holder" style="color:%s"><h3 style="color:%s">%s</h3><p>%s</p></div><div class="img_holder">%s<div class="owl-carousel">%s</div></div><div class="link_holder"><a href="%s" target="_blank" style="color:%s;background-color:%s;">%s%s</a></div></div>',frenifyCore_Plugin::attributes( 'unit_info-shortcode' ),$d_color, $t_color, $title, $descr, $owl_control,$child_output,$link_url,$l_color,$l_bgcolor,$link_text,$arrow);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_unit_info fotofly_fn_unit_info-%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_unit_info_%s', $this->fotofly_fn_counter );
//		
//		if( self::$parent_args['id'] ) {
//			$attr['id'] .= ' ' .self::$parent_args['id'];
//		}
		
		
		
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		return $attr;

	}
	
	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'image'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		
		$img_url = self::$child_args['image'];
		$img_id = fotofly_fn_attachment_id_from_url($img_url);
		
		$image = wp_get_attachment_image_src($img_id, 'fotofly_fn_thumb-720-9999');
		
		$img = '<img src="'.$image[0].'" alt="" />';
		

		$html = '';
		if($image[0] != ''){
			$html = '<div class="item">'.$img.'</div>';
		}
		

		return $html;

	}

	

}

new frenifySC_UnitInfo();