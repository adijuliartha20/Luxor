<?php
class frenifySC_ImageCarousel {

	private $image_carousel_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_image-carousel-shortcode', array( $this, 'attr' ) );
		add_filter( 'fotofly_fn_attr_image-carousel-shortcode-carousel', array( $this, 'carousel_attr' ) );
		add_filter( 'fotofly_fn_attr_image-carousel-shortcode-slide-link', array( $this, 'slide_link_attr' ) );
		add_filter( 'fotofly_fn_attr_frenify-image-wrapper', array( $this, 'image_wrapper' ) );
		//add_filter( 'fotofly_fn_attr_frenify-nav-prev', array( $this, 'fotofly_fn_nav_prev' ) );
		//add_filter( 'fotofly_fn_attr_frenify-nav-next', array( $this, 'fotofly_fn_nav_next' ) );

		add_shortcode( 'images', array( $this, 'render_parent' ) );
		add_shortcode( 'image', array( $this, 'render_child' ) );
		
		/*add_shortcode( 'clients', array( $this, 'render_parent' ) );
		add_shortcode( 'client', array( $this, 'render_child' ) );*/
		

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	Shortcode paramters
	 * @param  string $content Content between shortcode
	 *
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'				=> '',
				'id'				=> '',
				'autoplay'			=> 'no',
				'border'			=> 'yes',
				'columns'			=> '5',
				'column_spacing'	=> '13',
				'lightbox'			=> 'no',
				'mouse_scroll'		=> 'no',
				'picture_size' 		=> 'fixed',
				'scroll_items'		=> '',
				'show_nav'			=> 'yes',
				'hover_type'		=> 'none'
		), $args );

		extract( $defaults );

		self::$parent_args = $defaults;
			 
		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'image-carousel-shortcode' ) );
			$html .= sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'image-carousel-shortcode-carousel' ) );
				$html .= sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'frenify-carousel-positioner' ) );
					// The main carousel
					$html .= sprintf( '<ul %s>', frenifyCore_Plugin::attributes( 'frenify-carousel-holder' ) );
						$html .= do_shortcode( $content );
					$html .= '</ul>';
					
					// Check if navigation should be shown
					if ( $show_nav == 'yes' ) {
						$html .= sprintf( '<div %s><span %s></span><span %s></span></div>', frenifyCore_Plugin::attributes( 'frenify-carousel-nav' ),
										  frenifyCore_Plugin::attributes( 'frenify-nav-prev' ), frenifyCore_Plugin::attributes( 'frenify-nav-next' ) );
					}
				$html .= '</div>';
			$html .= '</div>';
		$html .= '</div>';					
						 
		$this->image_carousel_counter++;

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = 'frenify-image-carousel frenify-image-carousel-' . self::$parent_args['picture_size'];		

		if( self::$parent_args['lightbox'] == 'yes' ) {
		  $attr['class'] .= ' lightbox-enabled';
		}
		
		if( self::$parent_args['border'] == 'yes' ) {
		  $attr['class'] .= ' frenify-carousel-border';
		}		

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class']; 
		}

//		if( self::$parent_args['id'] ) {
//			$attr['id'] = self::$parent_args['id']; 
//		}

		return $attr;

	}
	
	function carousel_attr() {	
	
		$attr['class'] = 'frenify-carousel';
		
		$attr['data-autoplay'] = self::$parent_args['autoplay'];
		$attr['data-columns'] = self::$parent_args['columns'];
		$attr['data-itemmargin'] = self::$parent_args['column_spacing'];
		$attr['data-itemwidth'] = 180;
		$attr['data-touchscroll'] = self::$parent_args['mouse_scroll'];	
		$attr['data-imagesize'] = self::$parent_args['picture_size'];
		$attr['data-scrollitems'] = self::$parent_args['scroll_items'];
		
		return $attr;
		
	}


	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 *
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(	   	
				'alt'			=> '',
				'image'	  		=> '',				
				'link'	   		=> '',
				'linktarget' 	=> '_self',
			), $args 
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$image_id = frenifyCore_Plugin::get_attachment_id_from_url( $image );

		if( ! $alt && empty( $alt ) && $image_id ) {
			self::$child_args['alt'] = $alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
		}
		
		if( $image_id ) {
			self::$child_args['title_attr'] = get_post_field( 'post_excerpt', $image_id );
		}
		
		$output = sprintf( '<img src="%s" alt="%s" />', $image, $alt );

		if( self::$parent_args['mouse_scroll'] == 'no' &&
			( $link || self::$parent_args['lightbox'] == 'yes' )
		) {
			$output = sprintf( '<a %s>%s</a>', frenifyCore_Plugin::attributes( 'image-carousel-shortcode-slide-link' ), $output );
		}

		$html = sprintf( '<li %s><div %s><div %s>%s</div></div></li>', frenifyCore_Plugin::attributes( 'frenify-carousel-item'), frenifyCore_Plugin::attributes( 'frenify-carousel-item-wrapper'), 
						 frenifyCore_Plugin::attributes( 'frenify-image-wrapper' ), $output );
		return $html;

	}
	
	function slide_link_attr() {

		$attr = array();

		if( self::$parent_args['lightbox'] == 'yes' ) {

		  	if( ! self::$child_args['link'] ) {
		  		self::$child_args['link'] = self::$child_args['image'];
		  	}
	  	
		  	$attr['data-rel'] = sprintf( 'iLightbox[gallery_image_%s]', $this->image_carousel_counter );
			
			$image_id = frenifyCore_Plugin::get_attachment_id_from_url( self::$child_args['image'] );
			
			$attr['data-caption'] = get_post_field( 'post_excerpt', $image_id );
			$attr['data-title'] = get_post_field( 'post_title', $image_id );
		}

		$attr['href'] = self::$child_args['link'];
		
		$attr['target'] = self::$child_args['linktarget'];

		return $attr;

	}

	function image_wrapper() {

		$attr = array();

		$attr['class'] = 'frenify-image-wrapper';

		if( self::$parent_args['hover_type'] ) {
			$attr['class'] .= ' hover-type-' . self::$parent_args['hover_type'];
		}

		return $attr;

	}

	function fotofly_fn_nav_prev() {

		$attr = array();

		$attr['class'] = 'frenify-nav-prev frenify-icon-left';

		return $attr;

	}

	function fotofly_fn_nav_next() {

		$attr = array();

		$attr['class'] = 'frenify-nav-next  frenify-icon-right';

		return $attr;

	}

}

new frenifySC_ImageCarousel();