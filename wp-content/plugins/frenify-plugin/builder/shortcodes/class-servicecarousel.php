<?php
class frenifySC_ServiceCarousel {

	private $service_carousel_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_service_carousel-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'service_carousel', array( $this, 'render_parent' ) );
		add_shortcode( 'service_item', array( $this, 'render_child' ) );

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
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

		
		$html = sprintf( '<div %s><div class="mobile_version"><div>%s</div></div><div class="owl-carousel">%s</div></div>', frenifyCore_Plugin::attributes( 'service_carousel-shortcode' ), do_shortcode($content),do_shortcode($content));

		$this->service_carousel_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_service_carousel fotofly_fn_service_carousel_%s', $this->service_carousel_counter);



		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

//		if( self::$parent_args['id'] ) {
//			$attr['id'] = self::$parent_args['id'];
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

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'title'				=> '',
				'price_text'		=> '',
				'price'				=> '',
				'image'				=> '',
				'id'				=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$img_url 	= self::$child_args['image'];
		$img_id 	= fotofly_fn_attachment_id_from_url($img_url);
		$img_src 	= fotofly_fn_get_image_url_from_id($img_id, 'fotofly_fn_thumb-800-800');
		
		if($img_url !== ''){
			$have_image = 'yes';
		}else{
			$have_image = 'no';
		}
		$img_overlay 	= '<div class="img_overlay" style="background-image:url('.$img_src.')"></div>';
		$img_callback 	= fotofly_fn_callback_thumbs(570, 700);
		$color_overlay 	= '<div class="color_overlay"><span class="picture"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/picture.svg" alt="" /></span></div>';
		
		
		
		// separate function
		$list = '';
		$string = do_shortcode( $content );
		$fn_array = explode('/', $string);
		foreach($fn_array as $item){
			$list .= '<li>'.$item.'</li>';
		}
		
		$title		 	= '<h3>'.self::$child_args['title'].'</h3>';
		$price_text 	= '<span class="text">'.self::$child_args['price_text'].'</span>';
		$price		 	= '<span class="price">'.self::$child_args['price'].'</span>';
		$price_holder	= '<p>'.$price_text.$price.'</p>';
		
		$title_section	= '<div class="title_holder">'.$title.$price_holder.'</div>';
		$list_section 	= '<div class="list_holder"><ul>'.$list.'</ul></div>';
		$img_section	= '<div class="img_holder '.$have_image.'">'.$img_callback.$img_overlay.$color_overlay.'</div>';
		
		$full_section	= $img_section.'<div class="content_holder">'.$title_section.$list_section.'</div>';
		
		$extra_section	= '<li class="msection"><div class="mobile_section">'.$title_section.'</div></li>';
		$extra_section	= '';

		$html = sprintf( '%s<div %s>%s</div>', $extra_section, frenifyCore_Plugin::attributes( 'service_item' ), $full_section );

		return $html;

	}

}

new frenifySC_ServiceCarousel();