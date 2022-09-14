<?php
class frenifySC_TestimonialSingle {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_testimonial_single-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'testimonial_single', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'skin'						=> '',
				'layout'					=> '',
				'name'						=> '',
				'occupation'				=> '',
				'image'						=> '',
				'content_fn'				=> '',
				'rating'					=> '',
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
			
		
		
		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'testimonial_single-shortcode' ) );
		
		
		/********************** IMAGE **********************/
		$img_url 		= self::$args['image'];
		$img_id 		= fotofly_fn_attachment_id_from_url($img_url);
		$fn_image 		= fotofly_fn_get_image_from_id($img_id, 'fotofly_fn_thumb-300-300'); //image
		
		$fn_thumb_img	= '<img class="backup" src="'.fotofly_fn_ASSETS_URI.'/img/fn_avka.png" alt="" />';
		if($img_url !== ''){
			$fn_thumb_img = '';
		}
		$image_holder	= '<div class="image_holder">'.$fn_image.$fn_thumb_img.'</div>';

		/********************** RATING *********************/
		$fn_rating		= $args['rating'];
		$starsAbs		= '<div class="abs"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/stars.svg" alt="" /></div>';
		$starsRel		= '<div class="rel"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/stars.svg" alt="" /></div>';
		$rating_holder	= '<div class="fotofly_fn_rating_star" data-rating="'.$fn_rating.'">'.$starsAbs.$starsRel.'</div>';
		
		/********************** CONTENT *********************/
		$fn_name 		= '<h4>'.$args['name'].'</h4>';
		$fn_occ		 	= '<p>'.$args['occupation'].'</p>';
		$fn_content	 	= '<p>'.$args['content_fn'].'</p>';
		
		$content_holder = '<div class="content_holder"><div class="content">'.$fn_content.'</div>'.$rating_holder.'</div>';
		$title_holder	= '<div class="title_holder">'.$image_holder.$fn_name.$fn_occ.'</div>';
		$all			= $content_holder.$title_holder;
		
		/********************** LAYOUT **********************/
		$layout			= self::$args['layout'];
		if($layout === 'beta'){
			$all		= $title_holder.$content_holder;
		}
		
		$html .= '<div class="inner">'.$all.'</div>';
		$html .= '</div>';
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_testimonial_single_'.$this->fotofly_fn_counter.' fotofly_fn_testimonial_single';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		if( self::$args['skin'] ) {
			$attr['data-skin'] = self::$args['skin']; 
		}
		
		if( self::$args['layout'] ) {
			$attr['data-layout'] = self::$args['layout']; 
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;padding-top:%s;padding-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'], self::$args['padding_top'], self::$args['padding_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_TestimonialSingle();