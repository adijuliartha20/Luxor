<?php
class frenifySC_Person {

	public static $args;
	private $fotofly_fn_counter = 1;
	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_person-shortcode', array( $this, 'attr' ) );
		
		add_shortcode( 'person', array( $this, 'render' ) );

	}

	function render( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',			
				'id'						=> '',
				'image'						=> '',
				'name'						=> '',
				'occ'						=> '',
				'text_align'				=> '',
				'margin_top' 				=> '',
				'margin_bottom' 			=> '',
				'facebook' 					=> '',
				'twitter' 					=> '',
				'instagram' 				=> '',
				'linkedin' 					=> '',
				'dribbble' 					=> '',
				'youtube' 					=> '',
				'pinterest' 				=> '',
				'flickr' 					=> '',
				'vimeo' 					=> '',
				'tumblr' 					=> '',
				'google' 					=> '',
				'skype' 					=> '',
				'email' 					=> '',
				'vkontakte' 				=> '',
				'500px' 					=> '', 
				'odnoklassniki' 			=> '',
				
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

		
		
		// SOCIAL LIST
		$social_list = '<ul class="social_list">';
		
		if( isset( self::$args['facebook'] ) && self::$args['facebook'] ) {
			$social_list .= '<li><a href="'.self::$args['facebook'].'" target="_blank"><i class="xcon-facebook"></i></a></li>'; 
		}
		if( isset( self::$args['twitter'] ) && self::$args['twitter'] ) {
			$social_list .= '<li><a href="'.self::$args['twitter'].'" target="_blank"><i class="xcon-twitter"></i></a></li>'; 
		}
		if( isset( self::$args['instagram'] ) && self::$args['instagram'] ) {
			$social_list .= '<li><a href="'.self::$args['instagram'].'" target="_blank"><i class="xcon-instagram"></i></a></li>'; 
		}
		if( isset( self::$args['google'] ) && self::$args['google'] ) {
			$social_list .= '<li><a href="'.self::$args['google'].'" target="_blank"><i class="xcon-gplus"></i></a></li>'; 
		}
		if( isset( self::$args['linkedin'] ) && self::$args['linkedin'] ) {
			$social_list .= '<li><a href="'.self::$args['linkedin'].'" target="_blank"><i class="xcon-linkedin"></i></a></li>'; 
		}
		if( isset( self::$args['vimeo'] ) && self::$args['vimeo'] ) {
			$social_list .= '<li><a href="'.self::$args['vimeo'].'" target="_blank"><i class="xcon-vimeo"></i></a></li>'; 
		}
		if( isset( self::$args['youtube'] ) && self::$args['youtube'] ) {
			$social_list .= '<li><a href="'.self::$args['youtube'].'" target="_blank"><i class="xcon-youtube"></i></a></li>'; 
		}
		if( isset( self::$args['flickr'] ) && self::$args['flickr'] ) {
			$social_list .= '<li><a href="'.self::$args['flickr'].'" target="_blank"><i class="xcon-flickr"></i></a></li>'; 
		}
		if( isset( self::$args['skype'] ) && self::$args['skype'] ) {
			$social_list .= '<li><a href="'.self::$args['skype'].'" target="_blank"><i class="xcon-skype"></i></a></li>'; 
		}
		if( isset( self::$args['tumblr'] ) && self::$args['tumblr'] ) {
			$social_list .= '<li><a href="'.self::$args['tumblr'].'" target="_blank"><i class="xcon-tumblr"></i></a></li>'; 
		}
		if( isset( self::$args['dribbble'] ) && self::$args['dribbble'] ) {
			$social_list .= '<li><a href="'.self::$args['dribbble'].'" target="_blank"><i class="xcon-dribbble"></i></a></li>'; 
		}
		if( isset( self::$args['email'] ) && self::$args['email'] ) {
			$social_list .= '<li><a href="'.self::$args['email'].'" target="_blank"><i class="xcon-email"></i></a></li>'; 
		}
		if( isset( self::$args['vkontakte'] ) && self::$args['vkontakte'] ) {
			$social_list .= '<li><a href="'.self::$args['vkontakte'].'" target="_blank"><i class="xcon-vk"></i></a></li>'; 
		}
		if( isset( self::$args['500px'] ) && self::$args['500px'] ) {
			$social_list .= '<li><a href="'.self::$args['500px'].'" target="_blank"><i class="xcon-500px"></i></a></li>'; 
		}
		if( isset( self::$args['odnoklassniki'] ) && self::$args['odnoklassniki'] ) {
			$social_list .= '<li><a href="'.self::$args['odnoklassniki'].'" target="_blank"><i class="xcon-odnoklassniki"></i></a></li>'; 
		}
		if( isset( self::$args['pinterest'] ) && self::$args['pinterest'] ) {
			$social_list .= '<li><a href="'.self::$args['pinterest'].'" target="_blank"><i class="xcon-pinterest"></i></a></li>'; 
		}
		
		$social_list .= '</ul>';
			
		
		
		$html = sprintf( '<div %s><div class="fotofly_fn_member_holder">', frenifyCore_Plugin::attributes( 'person-shortcode' ) );
		
		// check image
		if(self::$args['image']){
			
			$img_url = self::$args['image'];
			$img_id = fotofly_fn_attachment_id_from_url($img_url);
			$image = wp_get_attachment_image_src($img_id, 'full'); //image
			$temp_img = fotofly_fn_callback_thumbs(800,970);
			
			//$popup_opener = '<a href="#popup-call-'.$this->fotofly_fn_counter.'" class="open-popup-link"></a>';
			$popup_opener = '';
			/*$popup_div = '<div id="popup-call-'.$this->fotofly_fn_counter.'" class="details_popup mfp-hide">
										<div class="details_popup_in">
											<div class="title_holder">
												<h3>'.$name.'</h3>
											</div>
											<table>
												<tr>
													<td class="label">Occupation</td>
													<td>'.$occ.'</td>
												</tr>
												<tr>
													<td class="label">About</td>
													<td>'.do_shortcode($content).'</td>
												</tr>
											</table>
										</div>
									</div>';*/
			$popup_div = '';

			$html .= '<div class="img_holder">'.$popup_opener.$temp_img.'<div class="original_img" style="background-image:url('.$img_url.');"></div><div class="social_list_wrap">'.$social_list.'</div></div>';
			
		}
		
		$html .= '<div class="title_holder"><h3>'.$name.'</h3><span>'.$occ.'</span></div><div class="content_holder"><p>'.do_shortcode($content).'</p></div>';
		$html .= '</div></div>'.$popup_div;
												
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'fotofly_fn_member_'.$this->fotofly_fn_counter.' fotofly_fn_member';

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class']; 
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id']; 
//		}
		
		$attr['data-text-hor-pos'] = self::$args['text_align']; 
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );
		
		return $attr;
		
	}
	

}

new frenifySC_Person();