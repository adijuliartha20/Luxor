<?php
class frenifySC_ServiceTabSingle {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_servicetab_single-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'servicetab_single', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'skin'						=> '',
				'img_pos'					=> '',
				'title'						=> '',
				'subtitle'					=> '',
				'image'						=> '',
				'price_text'				=> '',
				'price'						=> '',
				'fn_content'				=> '',
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
			
		
		$img_url 	= self::$args['image'];
		
		if($img_url !== ''){
			$have_image = 'yes';
		}else{
			$have_image = 'no';
		}
		$img_overlay 	= '<div class="img_overlay" style="background-image:url('.$img_url.')"></div>';
		$color_overlay 	= '<div class="color_overlay"><span class="picture"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/picture.svg" alt="" /></span></div>';
		
		
		
		// separate function
		$list = '';
		$string = self::$args['fn_content'];
		$fn_array = explode('/', $string);
		foreach($fn_array as $item){
			$list .= '<li>'.$item.'</li>';
		}
		
		$title		 	= self::$args['title'];
		$subtitle		= self::$args['subtitle'];
		$price_text 	= self::$args['price_text'];
		$price		 	= self::$args['price'];
		
		
		$html = '';
		
		$html .= sprintf( '<div %s><div class="img_holder %s">%s%s</div><div class="content_holder"><div class="fotofly_fn_holder_in"><div class="minicontent"><h3>%s</h3><p>%s</p><ul>%s</ul></div><div class="price_holder"><span class="text">%s</span><span class="price">%s</span></div></div></div></div>', frenifyCore_Plugin::attributes( 'servicetab_single-shortcode' ), $have_image, $img_overlay, $color_overlay, $title, $subtitle, $list, $price_text, $price );
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_servicetab_single_'.$this->fotofly_fn_counter.' fotofly_fn_servicetab_single';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}
//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin']; 
		}
		if( self::$args['img_pos'] ) {
			$attr['data-img-pos'] = self::$args['img_pos']; 
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;padding-top:%s;padding-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['padding_top'], self::$args['padding_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_ServiceTabSingle();