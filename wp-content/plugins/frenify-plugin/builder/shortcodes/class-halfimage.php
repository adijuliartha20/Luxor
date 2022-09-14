<?php
class frenifySC_HalfImage {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_halfimage-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'halfimage', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'skin'						=> '',			
				'image_position'			=> '',			
				'image'						=> '',			
				'title'						=> '',				
				'link_text'					=> '',			
				'link_url'					=> '',			
				'link_target'				=> '',			
				'class'						=> '',			
				'id'						=> '',
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

		extract( $defaults );

		self::$args = $defaults;

		
		$html = sprintf( '<div %s><div class="fotofly_fn_halfimg_holder">', frenifyCore_Plugin::attributes( 'halfimage-shortcode' ) );
		
		// check image
		if(self::$args['image']){
			
			$img_url 	= self::$args['image'];
			$img_id 	= fotofly_fn_attachment_id_from_url($img_url);
			$image 		= wp_get_attachment_image_src($img_id, 'full'); //image
			
		}
		
		$title			= $args['title'];
		$linktext		= $args['link_text'];
		$linkurl		= $args['link_url'];
		$linktarget		= $args['link_target'];
		
		$titleready		= '<h3>'.$title.'</h3>';
		$contentready	= '<p>'.do_shortcode($content).'</p>';
		$linkready		= "<a href='".$linkurl."' target='_".$linktarget."'>".$linktext."<i class='xcon-angle-right'></i></a>";
		
		
		$imagecontent 	= '<div class="image_content"><div class="image_holder jarallax" style="background-image: url('.$img_url.')"></div></div>';
		$infocontent	= '<div class="info_content"><div class="info_in"><div class="title_holder">'.$titleready.$contentready.'</div>'.$linkready.'</div></div>';
		
		$html .= $imagecontent.$infocontent;
		$html .= '</div></div>';
												
		

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_halfimage';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}
//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin']; 
		}
		
		$attr['data-image-pos'] = self::$args['image_position']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_HalfImage();