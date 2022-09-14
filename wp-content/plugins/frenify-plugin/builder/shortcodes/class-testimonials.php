<?php
class frenifySC_Testimonials {

	private $testimonials_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_testimonials-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'testimonials', array( $this, 'render_parent' ) );
		add_shortcode( 'testimonial', array( $this, 'render_child' ) );

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
				'skin'     			=> '',
				'margin_top'     	=> '0px',
				'margin_bottom'     => '0px',
				'class' 			=> '',
				'id' 				=> '',
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

		$nav = '<div class="fotofly_fn_nav">
					<span class="fotofly_fn_left"><i class="xcon-left-open-big"></i></span>
					<span class="fotofly_fn_right"><i class="xcon-right-open-big"></i></span>
				</div>';
				

		$html = sprintf( '<div %s><div class="fotofly_fn_item_in '.self::$parent_args['skin'].'"><span class="fotofly_fn_quote"><i class="xcon-quote-right-alt"></i></span><div class="carouselle">%s</div>%s</div></div>', frenifyCore_Plugin::attributes( 'testimonials-shortcode' ) , do_shortcode($content), $nav );

		$this->testimonials_counter++;

		return $html;

	}

	function attr() {

		$attr = array();
		
		$attr['class'] = 'testimonials';
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );	

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

//		if( self::$parent_args['id'] ) {
//			$attr['id'] = self::$parent_args['id'];
//		}

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
				'name'				=> '',
				'image' 			=> '',
				'occupation'		=> '',
			), $args
		);


		extract( $defaults );

		self::$child_args = $defaults;	

		$html = $this->render_child_classic( $content );

		return $html;

	}
	
	/* Render classic design */
	private function render_child_classic( $content ) {
		$inner_content = '';
		$image_holder = '';
		
		
		// check image -----------------------
		if(self::$child_args['image']){
			
			$img_url = self::$child_args['image'];
			$img_id = fotofly_fn_attachment_id_from_url($img_url);
			$image = fotofly_fn_get_image_from_id($img_id, 'fotofly_fn_thumb-300-300'); //image

			$image_holder .= '<div class="img_holder">'.$image.'</div>';
		}
		// -----------------------------------
		
		if( self::$child_args['name'] ) {

			$inner_content .= sprintf( '<span class="t_author">%s</span>', self::$child_args['name'] );
		
		}
		
		if( self::$child_args['occupation'] ) {

			$inner_content .= sprintf( '<p class="t_author_oc">%s</p>', self::$child_args['occupation'] );
		
		}
		
		if(do_shortcode( $content )){
			$html = sprintf( '<div class="carousel-item"><div class="team-item"><div class="xx_b"><p>%s</p>%s</div><div class="title_holder">%s</div></div></div>', do_shortcode( $content ), $image_holder, $inner_content );
		
			return $html;
		}
	
	}
	
}

new frenifySC_Testimonials();