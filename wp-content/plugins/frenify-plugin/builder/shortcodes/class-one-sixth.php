<?php
class frenifySC_OneSixth {

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_one-sixth-shortcode', array( $this, 'attr' ) );
		add_filter( 'fotofly_fn_attr_one-sixth-shortcode-wrapper', array( $this, 'wrapper_attr' ) );		
		add_shortcode( 'one_sixth', array( $this, 'render' ) );

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
				'class'					=> '',
				'id'					=> '',
				'background_color'		=> '',
				'background_image'		=> '',
				'background_position' 	=> 'left top',				
				'background_repeat' 	=> 'no-repeat',				
				'border_color'			=> '',
				'border_position'		=> 'all',
				'border_size'			=> '',
				'border_style'			=> 'solid',
				'center_content'		=> 'no',
				'hide_on_mobile'		=> 'no',			
				'last'  				=> 'no',
				'margin_top'			=> $fotofly_fn_option['col_top_margin'],
				'margin_bottom'			=> $fotofly_fn_option['col_bottom_margin'],
				'padding'				=> '',
				'spacing'				=> 'yes',
				'animation_type' 		=> '',
				'animation_direction' 	=> 'left',
				'animation_speed' 		=> '0.1',
			), $args
		);

		extract( $defaults );

		if( $defaults['margin_top'] == '' ) {
			$defaults['margin_top'] = $fotofly_fn_option['col_top_margin'];
		}

		if( $defaults['margin_bottom'] == '' ) {
			$defaults['margin_bottom'] = $fotofly_fn_option['col_bottom_margin'];
		}
		
		self::$args = $defaults;
		
		// After the last column we need a clearing div
		$clearfix = '';
		if ( self::$args['last'] == 'yes' ) {
			$clearfix = sprintf( '<div %s></div>', frenifyCore_Plugin::attributes( 'frenify-clearfix' ) );
		}	

		$inner_content = do_shortcode( $content );

		// If content should be centered, add needed markup
		if ( $center_content == 'yes' ) {
			$inner_content = sprintf( '<div class="frenify-column-table"><div class="frenify-column-tablecell">%s</div></div>', $inner_content );
		}

		// Setup the main markup
		$html = sprintf( '<div %s><div %s>%s</div></div>%s', frenifyCore_Plugin::attributes( 'one-sixth-shortcode' ), frenifyCore_Plugin::attributes( 'one-sixth-shortcode-wrapper' ), $inner_content, $clearfix );

		return $html;

	}

	function attr() {

		$attr['class'] = 'frenify-one-sixth frenify-layout-column';
			
		// Set the last class on the rightmost column to supress margin
		if ( self::$args['last'] == 'yes' ) {
			$attr['class'] .= ' td-col-last';
		}

		// Set spacing class for correct widths
		$attr['class'] .= ' frenify-spacing-' . self::$args['spacing'];

		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$args['margin_top'], self::$args['margin_bottom'] );

		if( self::$args['hide_on_mobile'] == 'yes' ) {
			$attr['class'] .= ' frenify-hide-on-mobile';
		}
		
		// User specific class and id
		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}	

		return $attr;

	}
	
	function wrapper_attr() {
		$attr = array();
	
		$attr['class'] = 'frenify-column-wrapper';

		$attr['style'] = '';

		// Set custom background styles
		if ( self::$args['background_image'] ) {
			$attr['style'] .= sprintf( 'background:url(%s) %s %s %s;', self::$args['background_image'], self::$args['background_position'], self::$args['background_repeat'], self::$args['background_color']  );
			
			if ( self::$args['background_repeat'] == 'no-repeat') {
				$attr['style'] .= '-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover;background-size:cover;';
			}		
			
			$attr['data-bg-url'] = self::$args['background_image'];
		} elseif ( self::$args['background_color'] ) {
			$attr['style'] .= sprintf( 'background-color:%s;', self::$args['background_color'] );
		}
		
		// Set custom border styles
		if ( self::$args['border_color'] && 
			 self::$args['border_size'] && 
			 self::$args['border_style'] 
		) {
		 	if ( self::$args['border_position'] != 'all' ) {
		 		$border_position = '-' . self::$args['border_position'];
		 	} else {
		 		$border_position = '';
		 	}
		
			$attr['style'] .= sprintf( 'border%s:%s %s %s;', $border_position, self::$args['border_size'], self::$args['border_style'], self::$args['border_color'] );
		}
	
		// Set custom padding
		if ( self::$args['padding'] ) {
			$attr['style'] .= sprintf( 'padding:%s;', self::$args['padding'] );
		}
		
		// Animations
		if ( self::$args['animation_type'] ) {
			$animations = frenifyCore_Plugin::animations( array(
				'type'	  	=> self::$args['animation_type'],
				'direction' => self::$args['animation_direction'],
				'speed'	 	=> self::$args['animation_speed'],
			) );

			$attr = array_merge( $attr, $animations );
			
			$attr['class'] .= ' ' . $attr['animation_class'];
			unset( $attr['animation_class'] );	 
		}		
			
		return $attr;
	}

}

new frenifySC_OneSixth();
