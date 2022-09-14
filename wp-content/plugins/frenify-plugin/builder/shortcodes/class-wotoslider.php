<?php
class frenifySC_Wotoslider {

	private $fotofly_fn_counter = 1;
	private $fotofly_fn_counter_child = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_wotoslider-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'wotoslider', array( $this, 'render' ) );
		add_shortcode( 'wotoimg', array( $this, 'render_child' ) );
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
				'title_switch' 		=> '',
				'thumb_switch' 		=> '',
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
				'slide_interval' 	=> '',
				'autoplay'		 	=> '',
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
		
		// main woto elements
		$woto_aaa = $woto_title = $woto_control = '';
		
		
		// -------------- WOTO CONTROL --------------------
		$woto_dots			= '<a href="#" class="woto_control_opener"><span></span></a>';
		$woto_pause_play	= '<a href="#" class="woto_state_play woto_play_pause"><span class="pause"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/pause.svg" alt="" /></span><span class="play"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/play.svg" alt="" /></span></a>';
		$woto_previous		= '<a href="#" class="prev"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></a>';
		$woto_next			= '<a href="#" class="next"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/left-arrow.svg" alt="" /></a>';
		$woto_hidden_control = '<div class="hidden_control">'.$woto_previous.$woto_pause_play.$woto_next.'</div>';
		
		// -------------- CHECK for options --------------------
		
		if(self::$parent_args['title_switch'] == 'disable'){
			$woto_title	= '';	
		}else{
			$woto_title = '<div class="woto_title_wrapper"><h1 class="woto_title"></h1></div>';
		}
		$woto_control 	= '<div class="woto_controls">'.$woto_dots.$woto_hidden_control.'</div>';
		
		if(self::$parent_args['thumb_switch'] == 'disable'){
			$thumb_area	= '';	
		}else{
			$thumb_area		= '<div class="woto_thmb_viewport"><div class="woto_thmb_wrapper"><ul class="woto_thmb_list woto_thumbs"></ul></div></div>';
		}
		if(self::$parent_args['autoplay']){
			$data_autoplay = self::$parent_args['autoplay'];
			if($data_autoplay !== 'disable'){
				$data_autoplay = 'autoplay';
			}else{
				$data_autoplay = '';
			}
		}
		if(self::$parent_args['slide_interval']){
			$slide_interval = self::$parent_args['slide_interval'];
			if($slide_interval !== ''){
				$slide_interval = self::$parent_args['slide_interval'];
			}else{
				$slide_interval = 4000;
			}
		}
		// --------------------------------------------------
		$woto_bbb 		= '<div class="woto_gallery_slider" data-thumbs-btn-title="Thumbs"></div>';
		$woto_aaa	   .= $woto_title.$woto_control.$woto_bbb;
		// main child
		$woto_main_child_open = '<div class="woto_gallery_trigger personal_preloader"></div><div class="woto_gallery_wrapper fadeOnLoad"><ul class="no_fit woto_gallery_container '.$data_autoplay.' woto_slider fade video_cover controls_on" data-video="0" data-interval="'.$slide_interval.'" data-autoplay="'.$data_autoplay.'">';
		$woto_main_child_close = '</ul></div>';
		
		$html = '';
		$html .= sprintf('<div %s>%s%s%s%s%s</div>',frenifyCore_Plugin::attributes( 'wotoslider-shortcode' ),$thumb_area, $woto_aaa , $woto_main_child_open, $child_output, $woto_main_child_close);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'woto_gallery_all_wrapper woto_gallery_all_wrapper-%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'woto_gallery_all_wrapper_%s', $this->fotofly_fn_counter );
//		
//		if( self::$parent_args['id'] ) {
//			$attr['id'] .= ' ' .self::$parent_args['id'];
//		}
		
		if( self::$parent_args['purchase_button']){
			$attr['data-purchase'] = self::$parent_args['purchase_button'];
		}
		if( self::$parent_args['title_switch']){
			$attr['data-title'] = self::$parent_args['title_switch'];
		}
		if( self::$parent_args['thumb_switch']){
			$attr['data-thumbs'] = self::$parent_args['thumb_switch'];
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
				'title'			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$img_url 	= self::$child_args['image'];
		$img_id 	= fotofly_fn_attachment_id_from_url($img_url);
		$image 		= wp_get_attachment_image_src($img_id, 'full');
		$image1 	= wp_get_attachment_image_src($img_id, 'fotofly_fn_thumb-300-300');
		
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
		

		$child_title = self::$child_args['title'];
		$html = '';
		if($image[0] != ''){
			$html = '<li 
					class="woto_slide slide_image block2preload woto_slide'.$this->fotofly_fn_counter.'" 
					data-count="'.$this->fotofly_fn_counter.'" 
					data-src="'.$image[0].'" 
					data-title="'.$child_title.'"
					data-thumb-src="'.$image1[0].'"
					data-type="image">
					'.$button.'
				</li>';
			
		}
		
		$this->fotofly_fn_counter++;
		

		return $html;

	}
	
	

}

new frenifySC_Wotoslider();
