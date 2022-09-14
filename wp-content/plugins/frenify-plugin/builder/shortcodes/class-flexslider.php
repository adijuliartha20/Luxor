<?php
class frenifySC_Flexslider {

	private $fotofly_fn_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_flexslider-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'flexslider', array( $this, 'render' ) );
		add_shortcode( 'fleximg', array( $this, 'render_child' ) );
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
				'purchase_button' 	=> '',
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
				'slide_interval' 	=> '',
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
		$html .= sprintf('<div %s><div class="flexslider"><ul class="slides">%s</ul></div></div>',frenifyCore_Plugin::attributes( 'flexslider-shortcode' ),$child_output);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_mainslider fotofly_fn_mainslider-%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_mainslider_%s', $this->fotofly_fn_counter );
//		
//		if( self::$parent_args['id'] ) {
//			$attr['id'] .= ' ' .self::$parent_args['id'];
//		}
		
		if( self::$parent_args['slide_interval']){
			$attr['data-interval'] = self::$parent_args['slide_interval'];
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
				'image'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		
		$img_url = self::$child_args['image'];
		$img_id = fotofly_fn_attachment_id_from_url($img_url);
		
		$image = wp_get_attachment_image_src($img_id, 'full');
		
		
		// purchase URL --------------------------
		$button			= '';
		$purchase_url 	= get_post_meta( $img_id, '_image_purchase_url', true );
		if($purchase_url !== ''){
			$button		= "<a href='".$purchase_url."' class='purchase_button' target='_blank'><img class='fotofly_fn_svg' src='".fotofly_fn_ASSETS_URI."/img/shopping-cart.svg' alt='' /><p><span>".esc_html($fotofly_fn_option['purchase_btn_text'])."</span></p></a>";
		}
		if(self::$parent_args['purchase_button'] == 'disable'){
			$button			= '';	
		}
		// ---------------------------------------
		

		//$html = sprintf('"%s",', $image[0]);

		//$html = rtrim($html, ','); // removes last comma
		$html = '';
		if($image[0] != ''){
			$html = '<li><div class="overlay"><div class="overlay_img" style="background-image: url('.$image[0].');"></div></div><div class="purchase">'.$button.'</div></li>';
		}
		

		return $html;

	}

	

}

new frenifySC_Flexslider();
