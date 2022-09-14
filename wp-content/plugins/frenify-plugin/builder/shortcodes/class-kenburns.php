<?php
class frenifySC_Kenburns {
	
	private $fotofly_fn_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_kenburns-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'kenburns', array( $this, 'render_parent' ) );
		add_shortcode( 'ken', array( $this, 'render_child' ) );

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
				'purchase_button' 	=> '',
				'title' 			=> '',
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
		
		
		$html  = '';
		$html .= sprintf('<div %s><div class="frenify_overlay" data-gradient="both"></div><div class="fotofly_fn_kenburns" data-interval="%s">%s</div></div>', frenifyCore_Plugin::attributes( 'kenburns-shortcode' ), self::$parent_args['slide_interval'], $child_output);
		
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_kenburns_wrap fotofly_fn_kenburns-%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_kenburns_%s', $this->fotofly_fn_counter );
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
				'title'			=> '',
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
			$button		= "<a href='".$purchase_url."' class='purchase_button overlay'><i class='pe-7s-cart'></i><span>".esc_html($fotofly_fn_option['purchase_btn_text'])."</span></a>";
		}
		if(self::$parent_args['purchase_button'] == 'disable'){
			$button			= '';	
		}
		// ---------------------------------------
		

		//$html = sprintf('"%s",', $image[0]);

		//$html = rtrim($html, ','); // removes last comma
		$html = '';
		if($image[0] != ''){
			$html = '<img src="'.$image[0].'" alt="" />';
		}
		

		return $html;

	}

}

new frenifySC_Kenburns();