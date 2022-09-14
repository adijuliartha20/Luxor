<?php
class frenifySC_FlowGallery {

	private $gallery_counter = 1;
	private $data_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_flowgallery-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'flowgallery', array( $this, 'render_parent' ) );
		add_shortcode( 'flowimg', array( $this, 'render_child' ) );

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
				'layout' 			=> '',
				'purchase_button' 	=> '',
				'img_title' 		=> '',
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
		
		$my_title = '<div class="flow_gallery_title">
						<h3></h3>
					</div>';
					
		if(self::$parent_args['img_title'] == 'disable'){
			$my_title = '';
		}
					
		$my_controllers = '<div class="flow_gallery_controller">
								<div class="previous"><span class="prev line"></span></div>
								<div class="next"><span class="next line"></span></div>
							</div>';
		

		$html  = '';
		$html .= sprintf( '<div %s>%s<ul class="flow_list">%s</ul>%s </div>', frenifyCore_Plugin::attributes( 'flowgallery-shortcode' ), $my_controllers, do_shortcode($content),  $my_title );
		
		$this->gallery_counter++;
		
		$this->data_counter = 1;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_flowgallery_wrap fotofly_fn_flowgallery_%s', $this->gallery_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_flowgallery_%s', $this->gallery_counter );
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
		
		$img_url 			= self::$child_args['image'];
		$img_id 			= fotofly_fn_attachment_id_from_url($img_url);
		
		$layout				= self::$parent_args['layout'];
		if($layout == 'square' || $layout == ''){
			$callbackimage	= fotofly_fn_callback_thumbs(700,700);
		}else if($layout == 'portrait'){
			$callbackimage	= fotofly_fn_callback_thumbs(570,700);
		}else if($layout == 'landscape'){
			$callbackimage	= fotofly_fn_callback_thumbs(700,570);
		}
		
		$new_url 			= wp_get_attachment_image_src($img_id, 'fotofly_fn_thumb-1000-1000');
		$title 				= get_the_title($img_id);
		
		// purchase URL --------------------------
		$button			= '';
		$purchase_url 	= get_post_meta( $img_id, '_image_purchase_url', true );
		if($purchase_url !== ''){
			$button		= "<a href='".$purchase_url."' class='purchase_button overlay' target='_blank'><img class='fotofly_fn_svg' src='".fotofly_fn_ASSETS_URI."/img/shopping-cart.svg' alt='' /><p><span>".esc_html($fotofly_fn_option['purchase_btn_text'])."</span></p></a>";
		}
		if(self::$parent_args['purchase_button'] == 'disable'){
			$button			= '';	
		}
		
		
		$original_img = "<div class='original_img' style='background-image:url(".$img_url.")'></div>";
		
		
		// ---------------------------------------
		
		$html = sprintf("<li class='flow_item flow_item_%s' data-count='%s' data-title='%s'><div class='img_holder'>%s%s<div class='img_reflection' data-url='%s'><div class='ir'></div></div>%s</div><div class='ref_back'></div></li>", $this->data_counter, $this->data_counter, $title, $original_img, $callbackimage, $new_url[0], $button);
		$this->data_counter++;
		return $html;
	}

}

new frenifySC_FlowGallery();