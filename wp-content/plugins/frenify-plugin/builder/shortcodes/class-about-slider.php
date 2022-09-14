<?php
class frenifySC_AboutSlider {

	private $fotofly_fn_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_about_slider-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'about_slider', array( $this, 'render' ) );
		add_shortcode( 'about_img', array( $this, 'render_child' ) );
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
				'img_pos' 			=> '',
				'title' 			=> '',
				'a_content' 		=> '',
				'link_text' 		=> '',
				'link_url' 			=> '',
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
		
		
		$title 			= '<h3>'.self::$parent_args['title'].'</h3>';
		$a_content 		= '<p>'.self::$parent_args['a_content'].'</p>';
		$link_text		= self::$parent_args['link_text'];
		$link_url		= self::$parent_args['link_url'];
		$link			= '<a href="'.$link_url.'">'.$link_text.'</a>';
		$about_content 	= $title.$a_content.$link;
		
		
		$html = '';
		$html .= sprintf('<div %s><div class="about_slider_in"><div class="about_slider"><ul class="slides">%s</ul></div><div class="about_content"><div class="in">%s</div></div></div></div>', frenifyCore_Plugin::attributes( 'about_slider-shortcode' ), $child_output, $about_content);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_aboutslider fotofly_fn_aboutslider_%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_aboutslider_%s', $this->fotofly_fn_counter );
//		
//		if( self::$parent_args['id'] ) {
//			$attr['id'] .= ' ' .self::$parent_args['id'];
//		}
		
		if( self::$parent_args['autoplay']){
			if(self::$parent_args['autoplay'] == 'disable'){
				$fn_auto = 'false';
			}else{
				$fn_auto = 'true';
			}
			$attr['data-autoplay'] = $fn_auto;
		}
		if( self::$parent_args['slide_interval']){
			$attr['data-interval'] = self::$parent_args['slide_interval'];
		}
		if( self::$parent_args['img_pos']){
			$attr['data-img-pos'] = self::$parent_args['img_pos'];
		}
		if( self::$parent_args['skin']){
			$attr['data-skin'] = self::$parent_args['skin'];
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
		
		
		$img_url 	= self::$child_args['image'];
		$img_id 	= fotofly_fn_attachment_id_from_url($img_url);
		$image		= wp_get_attachment_image_src($img_id, 'full');
		
		$html 		= '';
		if($image[0] != ''){
			$html = '<li>'.fotofly_fn_callback_thumbs(570, 700).'<div class="overlay"><div class="overlay_img" style="background-image: url('.$image[0].');"></div></div></li>';
		}
		

		return $html;

	}

	

}

new frenifySC_AboutSlider();
