<?php
class frenifySC_OneFourth {

	public static $args;
	private $fotofly_fn_counter = 1;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_one-fourth-shortcode', array( $this, 'attr' ) );
		add_filter( 'fotofly_fn_attr_one-fourth-in', array( $this, 'attr_2' ) );
		add_filter( 'fotofly_fn_attr_one-fourth-in-in', array( $this, 'attr_3' ) );
		
		add_shortcode( 'one_fourth', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 *
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {
		global $fotofly_fn_option;
		
		$defaults =	shortcode_atts(
			array(
				'class'						=> '',
				'id'						=> '',				
				'last'  					=> 'no',
				'spacing'  					=> 'enable',
				'background_color' 			=> '',
				'background_color_rate' 	=> '1',
				'background_type' 			=> 'none',
				'background_image' 			=> '',
				'background_size' 			=> 'auto',
				'background_repeat' 		=> '',
				'background_position' 		=> '',
				'border_position' 			=> 'all',
				'border_size' 				=> '',
				'border_style' 				=> '',
				'border_color' 				=> '',
				'text_color' 				=> '',
				'text_align' 				=> 'left',
				'padding'					=> '',
				'margin_top'				=> '0px',
				'margin_bottom'				=> '0px',
				'animation_type'			=> 'none',
				'animation_delay'			=> '0',
			), $args
		);

		extract( $defaults );

		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}
		
		if( strpos( $defaults['padding'], '%' ) === false && strpos( $defaults['padding'], 'px' ) === false ) {
			$defaults['padding'] = $defaults['padding'] . 'px';
		}
		
		if( strpos( $defaults['border_size'], '%' ) === false && strpos( $defaults['border_size'], 'px' ) === false ) {
			$defaults['border_size'] = $defaults['border_size'] . 'px';
		}
		
		self::$args = $defaults;
		
		
		
		
		/* STYLE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		
		$styles = '';
		$styles .= '.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . '{
						text-align: ' . self::$args['text_align'] . ';
					}';
		
		$styles .= '.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ',
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' h1,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' h2,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' h3,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' h4,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' h5,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' h6,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' p,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' a,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' a:hover,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' blockquote,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' em,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' strong,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' span,
					.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' .fotofly_fn_custom_content{
						color: ' . self::$args['text_color'] . ';
					}';
		
		$styles .= '.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' .fotofly_fn_overlay_color{
				background-color: ' . self::$args['background_color'] . ';
				opacity: ' . self::$args['background_color_rate'] . ';
			}';

		// check overlay type
		if(self::$args['background_type'] == 'video'){
			$styles .= '.fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' .fotofly_fn_overlay_video{
				background-image: url('.self::$args['background_image'].');
				background-size:'.self::$args['background_size'].';
				background-repeat:'.self::$args['background_repeat'].';
				background-position:'.self::$args['background_position'].';
			}';	
		}
		
		
		/* CLEARFIX ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		
		$clearfix = '';
		if ( self::$args['last'] == 'yes' ) {
			$clearfix = sprintf( '<div %s></div>', frenifyCore_Plugin::attributes( 'frenify-clearfix' ) );
		}	

		$inner_content = do_shortcode( $content );
		
		
		/* BACKGROUND COLOR ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		$overlay = '';
		if(self::$args['background_color']){
			$overlay .= '<div class="fotofly_fn_overlay_color" data-color="'.self::$args['background_color'].'" data-transparency="'.self::$args['background_color_rate'].'"></div>';	
		}
		
		/* OVERLAY TYPE ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		if ( !empty(self::$args['background_image']) ) {
			if(self::$args['background_type'] == 'image'){
				$overlay .= '<div class="fotofly_fn_overlay_image"></div>';	
			}
		}


		/* MAIN HTML ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
		$html = sprintf('<div %s data-inlinestyles="%s">
							<div %s>
								<div %s>
									<div class="fotofly_fn_content_holder"><div>%s</div></div>
									<div class="fotofly_fn_bg">%s</div>
								</div>
							</div>
						</div>%s', 
						
						frenifyCore_Plugin::attributes( 'one-fourth-shortcode' ), 
						$styles,
						frenifyCore_Plugin::attributes( 'one-fourth-in' ), 
						frenifyCore_Plugin::attributes( 'one-fourth-in-in' ),
						$inner_content, 
						$overlay, 
						$clearfix 
					   );
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}

	function attr() {

		$attr['class'] = 'fn-col-3 frenify-layout-column fotofly_fn_column_one_fourth_' . $this->fotofly_fn_counter . ' ';
			
		// Set the last class on the rightmost column to supress margin
		if ( self::$args['last'] == 'yes' ) {
			$attr['class'] .= ' last';
		}
		
		if ( self::$args['spacing'] == 'disable' ) {
			$attr['class'] .= ' no-space';
		}
		
		// Add extra class
		if(self::$args['background_color'] != '' || self::$args['background_image'] != '') {
			$attr['class'] .= ' have_bg';
		}

		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom']);
		
		
		

		// User specific class and id
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}		

		return $attr;

	}
	
	function attr_2() {
		
		$attr['class'] = 'col_in';
		
		// animation of the block
		if(self::$args['animation_type'] && self::$args['animation_type'] != 'none'){
			$attr['class'] .= ' fotofly_fn_animated_block animated hideforanimation ';
			
			$attr['data-animation'] = self::$args['animation_type']; 
			$attr['data-delay'] = self::$args['animation_delay']; 
		}

		return $attr;
	}
	
	function attr_3() {
		
		$attr['class'] = 'col_in_in';
		$attr['style'] = sprintf( 'padding:%s;', self::$args['padding']);
		
		// BORDER
		if(self::$args['border_position'] == 'all'){
			$attr['style'] .= sprintf( 'border-width:%s;border-style:%s;border-color:%s;', self::$args['border_size'], self::$args['border_style'], self::$args['border_color'] );
		}else{
			$attr['style'] .= sprintf( 'border-'.self::$args['border_position'].'-width:%s;border-style:%s;border-color:%s;', self::$args['border_size'], self::$args['border_style'], self::$args['border_color'] );
		}
		
		return $attr;
	}

}
new frenifySC_OneFourth();