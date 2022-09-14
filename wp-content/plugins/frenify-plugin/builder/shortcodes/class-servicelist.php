<?php
class frenifySC_ServiceList {

	private $fotofly_fn_counter = 1;
	private $child_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_service_list-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'service_list', array( $this, 'render' ) );
		add_shortcode( 'service_list_item', array( $this, 'render_child' ) );
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
				'skin' 				=> '',
				'cols' 				=> '',
				'number' 			=> '',
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
		
		
		$html = '';
		$html .= sprintf('<div %s><ul class="fotofly_fn_miniboxes">%s</ul></div>', frenifyCore_Plugin::attributes( 'service_list-shortcode' ), $child_output);
		
		
		$this->fotofly_fn_counter++;
		$this->child_counter = 1;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_servicelist fotofly_fn_servicelist_%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_servicelist_%s', $this->fotofly_fn_counter );
//		
//		if( self::$parent_args['id'] ) {
//			$attr['id'] .= ' ' .self::$parent_args['id'];
//		}
		if( self::$parent_args['skin']){
			$attr['data-skin'] = self::$parent_args['skin'];
		}
		if( self::$parent_args['cols']){
			$attr['data-cols'] = self::$parent_args['cols'];
		}
		
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
				'title'					=> '',
				'fn_content'			=> '',
				'url'					=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$title	 		= '<h3>'.self::$child_args['title'].'</h3>';
		$fn_content	 	= '<p>'.self::$child_args['fn_content'].'</p>';
		$url		 	= '<a href="'.self::$child_args['url'].'"></a>';
		$arrow			= '<span class="arrow"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></span>';
		$counter		= $this->child_counter;
		if($counter<10){
			$toCounter = 0;
		}else{
			$toCounter = '';
		}
		$counter2		= '<span class="number">'.$toCounter.$counter.'</span>';
		if(self::$parent_args['number'] != 'enable'){
			$counter2	= '';
		}
		
		$html 		= '';
		
		$html = '<li class="fotofly_fn_minibox">'.$counter2.'<div class="item">'.$url.'<div class="item_in">'.$title.$fn_content.$arrow.'</div></div></li>';
		
		$this->child_counter++;

		return $html;
		
	}
	

}

new frenifySC_ServiceList();