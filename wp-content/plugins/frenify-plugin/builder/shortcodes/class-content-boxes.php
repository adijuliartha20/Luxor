<?php
class frenifySC_ContentBoxes {

	private $content_box_counter = 1;
	private $column_counter = 1;
	private $num_of_columns = 1;
	private $total_num_of_columns = 1;
	private $row_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_content-box-shortcode', array( $this, 'child_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-content-wrapper', array( $this, 'content_wrapper_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-heading-wrapper', array( $this, 'heading_wrapper_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-content-container', array( $this, 'content_container_attr' ) );
		
		add_filter( 'fotofly_fn_attr_content-box-shortcode-link', array( $this, 'link_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-icon-parent', array( $this, 'icon_parent_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-icon-wrapper', array( $this, 'icon_wrapper_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-icon', array( $this, 'icon_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-shortcode-timeline', array( $this, 'timeline_attr' ) );
		add_filter( 'fotofly_fn_attr_content-box-heading', array( $this, 'content_box_heading_attr' ) );
		add_shortcode( 'content_box', array( $this, 'render_child' ) );

		add_filter( 'fotofly_fn_attr_content-boxes-shortcode', array( $this, 'parent_attr' ) );
		add_shortcode( 'content_boxes', array( $this, 'render_parent' ) );

	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults =	frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'					=> '',			
				'id' 					=> '',
				'backgroundcolor' 		=> $fotofly_fn_option['content_box_bg_color'],
				'columns' 				=> '',
				'circle'				=> '',
				'iconcolor' 			=> $fotofly_fn_option['content_box_icon_color'],
				'circlecolor' 			=> $fotofly_fn_option['content_box_icon_bg_color'],
				'circlebordercolor' 	=> $fotofly_fn_option['content_box_icon_bg_inner_border_color'],
				'circlebordersize'		=> $fotofly_fn_option['content_box_icon_bg_inner_border_size'],
				'outercirclebordercolor'=> $fotofly_fn_option['content_box_icon_bg_outer_border_color'],
				'outercirclebordersize' => $fotofly_fn_option['content_box_icon_bg_outer_border_size'],
				'icon_circle'			=> $fotofly_fn_option['content_box_icon_circle'],
				'icon_circle_radius'	=> $fotofly_fn_option['content_box_icon_circle_radius'],
				'icon_size'				=> $fotofly_fn_option['content_box_icon_size'],
				'icon_align'			=> '',
				'icon_hover_type'		=> $fotofly_fn_option['content_box_icon_hover_type'],
				'layout' 				=> 'icon-with-title',
				'margin_top' 			=> $fotofly_fn_option['content_box_margin_top'],
				'margin_bottom' 		=> $fotofly_fn_option['content_box_margin_bottom'],
				'title_size'			=> $fotofly_fn_option['content_box_title_size'],
				'title_color'			=> $fotofly_fn_option['content_box_title_color'],
				'body_color'			=> $fotofly_fn_option['content_box_body_color'],
				'link_type'				=> $fotofly_fn_option['content_box_link_type'],
				'link_area'				=> $fotofly_fn_option['content_box_link_area'],
				'linktarget'			=> $fotofly_fn_option['content_box_link_target'],
				'animation_type' 		=> '',
				'animation_delay' 		=> '',
				'animation_direction' 	=> 'left',
				'animation_speed'		=> '0.1',
				'settings_lvl'			=> 'child'
			), $args
		);

		if( $defaults['layout'] == 'timeline-vertical' ) {
			$defaults['columns'] = 1;
		}

		if( ( $defaults['layout'] == 'timeline-vertical' || $defaults['layout'] == 'timeline-horizontal' || $defaults['layout'] == 'clean-vertical' || $defaults['layout'] == 'clean-horizontal' ) && ! $defaults['outercirclebordercolor'] ) {
			//$defaults['outercirclebordercolor'] = '#f6f6f6';
		}

		if( $defaults['layout'] == 'timeline-vertical' || $defaults['layout'] == 'timeline-horizontal' ) {
			$defaults['animation_delay'] = 350;
			$defaults['animation_speed'] = 0.25;
			$defaults['animation_type'] = 'fade';
			$defaults['animation_direction'] = '';
		}

		extract( $defaults );

		self::$parent_args = $defaults;
		
		$this->column_counter = 1;
		$this->row_counter = 1;

		preg_match_all( '/(\[content_box (.*?)\](.*?)\[\/content_box\])/s', $content, $matches );
		$this->total_num_of_columns = count( $matches[0] );

		if( ! $columns || 
			empty( $columns ) 
		) {
			if( is_array( $matches ) && 
				! empty( $matches ) 
			) {
				$this->num_of_columns = count( $matches[0] );
				if( $this->num_of_columns > 6 ) {
					$this->num_of_columns = 6;
				}
			} else {
				$this->num_of_columns = 1;
			}
		} elseif( $columns > 6 ) {
			$this->num_of_columns = 6;
		} else {
			$this->num_of_columns = $columns;
		}

		$html = sprintf( '<div %s>%s<div class="frenify-clearfix"></div></div>', frenifyCore_Plugin::attributes( 'content-boxes-shortcode' ), do_shortcode( $content ) );

		$this->content_box_counter++;

		return $html;

	}

	function parent_attr() {

		$attr['class'] = sprintf( 'frenify-content-boxes content-boxes columns frenify-columns-%s frenify-content-boxes-%s content-boxes-%s row content-%s', $this->num_of_columns, $this->content_box_counter, self::$parent_args['layout'], self::$parent_args['icon_align'] );

		if( self::$parent_args['layout'] == 'timeline-horizontal' || self::$parent_args['layout'] == 'clean-vertical' ) {
			$attr['class'] .= ' content-boxes-icon-on-top';
		}

		if( self::$parent_args['layout'] == 'timeline-vertical' ) {
			$attr['class'] .= ' content-boxes-icon-with-title';
		}

		if( self::$parent_args['layout'] == 'clean-horizontal' ) {
			$attr['class'] .= ' content-boxes-icon-on-side';
		}

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' . self::$parent_args['class'];
		}

//		if( self::$parent_args['id'] ) {
//			$attr['id'] = self::$parent_args['id'];
//		}

		if( self::$parent_args['animation_delay'] ) {
			$attr['data-animation-delay'] = self::$parent_args['animation_delay'];
			$attr['class'] .= ' frenify-delayed-animation';
		}

		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );

		return $attr;

	}

	/**
	 * Render the child shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults =	frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'						=> '',
				'id'						=> '',
				'backgroundcolor'			=> self::$parent_args['backgroundcolor'],
				'circle'	 				=> '',
				'circlecolor' 				=> self::$parent_args['circlecolor'],
				'circlebordercolor' 		=> self::$parent_args['circlebordercolor'],
				'circlebordersize'			=> self::$parent_args['circlebordersize'],
				'outercirclebordercolor'	=> self::$parent_args['outercirclebordercolor'],
				'outercirclebordersize' 	=> self::$parent_args['outercirclebordersize'],
				'icon' 						=> '',
				'iconcolor' 				=> self::$parent_args['iconcolor'],
				'iconrotate'				=> '',
				'iconspin'					=> '',
				'image' 					=> '',
				'image_height' 				=> '35',				
				'image_width' 				=> '35',
				'link' 						=> '',
				'linktarget' 				=> self::$parent_args['linktarget'],
				'linktext' 					=> '',
				'textcolor'					=> '',
				'title' 					=> '',
				'animation_type' 			=> self::$parent_args['animation_type'],
				'animation_direction' 		=> self::$parent_args['animation_direction'],
				'animation_speed' 			=> self::$parent_args['animation_speed'],
			), $args
		);

		if( ( self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'timeline-horizontal' || self::$parent_args['layout'] == 'clean-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) && ! $defaults['outercirclebordercolor'] ) {
			//$defaults['outercirclebordercolor'] = '#f6f6f6';
		}

		if( self::$parent_args['settings_lvl'] == 'parent' ) {
			$defaults['backgroundcolor'] = self::$parent_args['backgroundcolor'];
			$defaults['circlecolor'] = self::$parent_args['circlecolor'];
			$defaults['circlebordercolor'] = self::$parent_args['circlebordercolor'];
			$defaults['circlebordersize'] = self::$parent_args['circlebordersize'];
			$defaults['outercirclebordercolor'] = self::$parent_args['outercirclebordercolor'];
			$defaults['outercirclebordersize'] = self::$parent_args['outercirclebordersize'];
			$defaults['iconcolor'] = self::$parent_args['iconcolor'];
			$defaults['animation_type'] = self::$parent_args['animation_type'];
			$defaults['animation_direction'] = self::$parent_args['animation_direction'];
			$defaults['animation_speed'] = self::$parent_args['animation_speed'];
		}

		extract( $defaults );

		self::$child_args = $defaults;

		$output = '';
		$icon_output = '';
		$title_output = '';
		$content_output = '';
		$link_output = '';
		$alt = '';
		$heading = '';

		if( $image && 
			$image_width && 
			$image_height
		) {
		
			$image_id = frenifyCore_Plugin::get_attachment_id_from_url( $image );

			if( $image_id ) {
				$alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
			}
		
			$icon_output = sprintf( '<div %s><img src="%s" width="%s" height="%s" alt="%s" /></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-icon' ), $image, $image_width, $image_height, $alt );
		} elseif( $icon ) {
			if( $outercirclebordercolor && $outercirclebordersize ) {
				$icon_output = sprintf( '<div %s><span %s><i %s></i></span></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-icon-parent' ), frenifyCore_Plugin::attributes( 'content-box-shortcode-icon-wrapper' ), frenifyCore_Plugin::attributes( 'content-box-shortcode-icon' ) );
			} else {
				$icon_output = sprintf( '<div %s><i %s></i></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-icon-parent' ), frenifyCore_Plugin::attributes( 'content-box-shortcode-icon' ) );
			}
		}

		if( $title ) {
			$title_output = sprintf( '<h2 %s>%s</h2>', frenifyCore_Plugin::attributes( 'content-box-heading' ), $title );
		}
		
		if( ( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'icon-with-title' || self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) && self::$parent_args['icon_align'] == 'right' ) {
			$heading_content = $title_output . $icon_output;
		} else {
			$heading_content = $icon_output . $title_output;
		}
		
		if( $link ) {
			$heading_content = sprintf( '<a %s %s>%s</a>', frenifyCore_Plugin::attributes( 'heading-link' ), 
										frenifyCore_Plugin::attributes( 'content-box-shortcode-link' ), $heading_content );
		}
		
		if ( $heading_content ) {
			$heading = sprintf( '<div %s>%s</div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-heading-wrapper' ), $heading_content );
		}

		if( $link &&  
			$linktext 
		) {
			if( self::$parent_args['link_type'] == 'text' || self::$parent_args['link_type'] == 'button-bar' ) {
				$link_output = sprintf( '<div class="frenify-clearfix"></div><a %s %s>%s</a><div class="frenify-clearfix"></div>', frenifyCore_Plugin::attributes( 'frenify-read-more' ), frenifyCore_Plugin::attributes( 'content-box-shortcode-link' ), $linktext );
			} else if( self::$parent_args['link_type'] == 'button' ) {
				$link_output = sprintf( '<div class="frenify-clearfix"></div><a %s>%s</a><div class="frenify-clearfix"></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-link' ), $linktext );
			}
		}

		$content_output = sprintf( '<div class="frenify-clearfix"></div><div %s>%s</div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-content-container'), do_shortcode( $content ) . $link_output );

		$output = $heading . $content_output;

		$timeline = '';

		if( $icon && self::$parent_args['icon_circle'] == 'yes' && self::$parent_args['layout'] == 'timeline-horizontal' && self::$parent_args['columns'] != '1' ) {
			$timeline = sprintf( '<div %s></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-timeline' ) );
		}


		if( $icon && self::$parent_args['icon_circle'] == 'yes' && self::$parent_args['layout'] == 'timeline-vertical' ) {
			$timeline = sprintf( '<div %s></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode-timeline' ) );
		}

		$html = sprintf( '<div %s><div %s>%s%s</div></div>', frenifyCore_Plugin::attributes( 'content-box-shortcode' ), 
						 frenifyCore_Plugin::attributes( 'content-box-shortcode-content-wrapper' ), $output, $timeline );

		$clearfix_test = $this->column_counter / $this->num_of_columns;

		if ( is_int( $clearfix_test ) ) {
			$html .= '<div class="frenify-clearfix"></div>';
		}

		$this->column_counter++;

		return $html;

	}

	function child_attr() {

		$columns = 12 / $this->num_of_columns;

		if( $this->row_counter > intval( $this->num_of_columns ) ) {
			$this->row_counter = 1;
		}

		$attr['class'] = sprintf( 'frenify-column content-box-column content-box-column-%s col-lg-%s col-md-%s col-sm-%s', $this->column_counter, $columns, $columns, $columns );
		$attr['style'] = '';

		$border_color = '';

		if( self::$child_args['circlebordercolor'] ) {
			$border_color = self::$child_args['circlebordercolor'];
		}

		if( self::$child_args['outercirclebordercolor'] ) {
			$border_color = self::$child_args['outercirclebordercolor'];
		}

		if( ! self::$child_args['circlebordercolor'] && ! self::$child_args['outercirclebordercolor'] ) {
			$border_color = '#f6f6f6';
		}

		if( $this->num_of_columns == '5'  ) {
			$attr['class'] = 'frenify-column content-box-column col-lg-2 col-md-2 col-sm-2';
		}

		if( intval( $this->column_counter ) % intval( $this->num_of_columns ) == 1 ) {
			$attr['class'] .= ' content-box-column-first-in-row';
		}

		if( intval( $this->column_counter ) == intval( $this->total_num_of_columns ) ) {
			$attr['class'] .= ' content-box-column-last';
		}

		if( $this->row_counter == intval( $this->num_of_columns ) ) {
			$attr['class'] .= ' content-box-column-last-in-row';
		}

		if( $border_color && ( self::$parent_args['layout'] == 'clean-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) ) {
			$attr['style'] .= sprintf( 'border-color:%s;', $border_color );
		}

		if( self::$child_args['class'] ) {
			$attr['class'] .= ' ' . self::$child_args['class'];
		}

//		if( self::$child_args['id'] ) {
//			$attr['id'] = self::$child_args['id'];
//		}

		$this->row_counter++;

		return $attr;

	}
	
	function content_wrapper_attr() {
	
		$attr['class'] = 'col content-wrapper';
		
		// set parent values if child values are unset to get downwards compatibility
		if( ! self::$child_args['backgroundcolor'] ) {
			self::$child_args['backgroundcolor'] = self::$parent_args['backgroundcolor'];
		}		
		
		if( self::$child_args['backgroundcolor'] ) {
			$attr['style'] = sprintf( 'background-color:%s;', self::$child_args['backgroundcolor'] );
			
			if ( self::$child_args['backgroundcolor'] != 'transparent' ) {
				$attr['class'] .= '-background';
			}
		}
		
		if( self::$parent_args['layout']  == 'icon-boxed' ) {
			$attr['class'] .= ' content-wrapper-boxed';
		}

		if( self::$child_args['link'] && self::$parent_args['link_area'] == 'box' ) {
			$attr['data-link'] = self::$child_args['link'];
		}

		$attr['class'] .= ' link-area-' . self::$parent_args['link_area'];

		if( self::$child_args['link'] && self::$parent_args['link_type'] ) {
			$attr['class'] .= ' link-type-' . self::$parent_args['link_type'];
		}

		if(  self::$child_args['outercirclebordercolor'] && self::$child_args['outercirclebordersize'] ) {
			$attr['class'] .= ' content-icon-wrapper-yes';
		}
		if( self::$child_args['outercirclebordercolor'] && self::$child_args['outercirclebordersize'] && self::$parent_args['icon_hover_type'] == 'pulsate' ) {
			$attr['class'] .= ' icon-wrapper-hover-animation-' . self::$parent_args['icon_hover_type'];
		} else {
			$attr['class'] .= ' icon-hover-animation-' . self::$parent_args['icon_hover_type'];
		}
		
		if( self::$child_args['textcolor'] ) {
			$attr['style'] .= sprintf( 'color:%s;', self::$child_args['textcolor'] );
		}
		
		if( self::$child_args['animation_type'] ) {
			$animations = frenifyCore_Plugin::animations( array(
				'type'	  => self::$child_args['animation_type'],
				'direction' => self::$child_args['animation_direction'],
				'speed'	 => self::$child_args['animation_speed'],
			) );

			$attr = array_merge( $attr, $animations );
			
			$attr['class'] .= ' ' . $attr['animation_class'];
			unset($attr['animation_class']);	 
		}
	
		return $attr;
	}
	
	
	function link_attr() {
		global $fotofly_fn_option;

		$attr['class'] = '';

		if( self::$child_args['link'] ) {
			$attr['href'] = self::$child_args['link'];
		}
		
		if( self::$child_args['linktarget'] ) {
			$attr['target'] = self::$child_args['linktarget'];
		}

		if( self::$parent_args['link_type'] == 'button' ) {
			$attr['class'] .= sprintf( 'frenify-read-more-button frenify-button frenify-button-default frenify-button-%s frenify-button-%s frenify-button-%s', strtolower( $fotofly_fn_option['button_size'] ), strtolower( $fotofly_fn_option['button_shape'] ), strtolower( $fotofly_fn_option['button_type'] ) );
		}

		return $attr;

	}	

	function heading_wrapper_attr() {

		$attr['class'] = 'heading';
		$attr['style'] = '';

		if( self::$child_args['icon'] || self::$child_args['image'] ) {
			$attr['class'] .= ' heading-with-icon';
		}
		
		if( self::$parent_args['icon_align'] ) {
			$attr['class'] .= ' icon-'.self::$parent_args['icon_align'];
		}

		return $attr;

	}

	function icon_parent_attr() {
		$attr['class'] = 'icon';
		$attr['style'] = '';

		if(  self::$parent_args['icon_circle'] != 'yes' && self::$parent_args['layout'] == 'icon-boxed' ) {
			$attr['style'] .= sprintf( 'position:absolute;width: 100%%;top:-%spx;', 50 + intval( self::$parent_args['icon_size'] ) / 2 );
		}
		
		if ( self::$parent_args['layout'] == 'timeline-vertical' && self::$parent_args['icon_align'] == 'right' && ( ! self::$child_args['outercirclebordercolor'] || ! self::$child_args['circlebordersize'] ) ) {
			$attr['style'] .= 'padding-left:20px;';
		}

		if( self::$parent_args['animation_delay'] ) {
			$animation_delay = self::$parent_args['animation_delay'];
			$attr['style'] .= '-webkit-animation-duration: ' . $animation_delay . 'ms;';
			$attr['style'] .= 'animation-duration: ' . $animation_delay . 'ms;';
		}

		return $attr;
	}

	function icon_wrapper_attr() {
	
		$attr['style'] = '';

		if( self::$child_args['icon'] ) {

			$attr['class'] = '';
			
			if( self::$parent_args['icon_circle'] == 'yes' ) {
				$attr['style'] .= sprintf( 'height:%spx;width:%spx;line-height:%spx;', ( self::$parent_args['icon_size'] * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ), ( self::$parent_args['icon_size'] * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ), ( self::$parent_args['icon_size'] * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ) );

				if( self::$child_args['outercirclebordercolor'] ) {
					$attr['style'] .= sprintf( 'border-color:%s;', self::$child_args['outercirclebordercolor'] );
				}

				if( self::$child_args['outercirclebordersize'] ) {
					$attr['style'] .= sprintf( 'border-width:%s;', self::$child_args['outercirclebordersize'] );
				}

				$attr['style'] .= sprintf( 'border-style:%s;', 'solid' );

				if( self::$child_args['circlebordercolor'] ) {
					$attr['style'] .= sprintf( 'background-color:%s;', self::$child_args['circlebordercolor'] );
				}

				if( self::$parent_args['layout'] == 'icon-boxed' ) {
					$attr['style'] .= sprintf( 'position:absolute;top:-%spx;margin-left:-%spx;', 50 + ( ( ( self::$parent_args['icon_size'] * 2 ) + intval( self::$child_args['circlebordersize'] ) * 2 ) / 2 ), ( ( self::$parent_args['icon_size'] * 2 )  + intval( self::$child_args['circlebordersize'] ) * 2 ) / 2 );
				}

				if( self::$parent_args['icon_circle_radius'] == 'round' ) {
					self::$parent_args['icon_circle_radius'] = '100%';
				}

				if( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) {
					$margin_direction = 'margin-right';
					if ( self::$parent_args['icon_align'] == 'right' ) {
						$margin_direction = 'margin-left';
					}
					
					$margin = '20px';
					if ( self::$parent_args['layout'] == 'timeline-vertical' && self::$parent_args['icon_align'] == 'right' ) {
						$margin = '10px';
					}					
					
					$attr['style'] .= sprintf( '%s:%s;', $margin_direction, $margin );
				}

				$attr['style'] .= sprintf( 'box-sizing:%s;', 'content-box' );
				$attr['style'] .= sprintf( 'border-radius:%s;', self::$parent_args['icon_circle_radius'] );
			}
		}

		return $attr;

	}

	function icon_attr() {
	
		$attr['style'] = '';
	
		if( self::$child_args['image'] ) {
			$attr['class'] = 'image';
			
			if( self::$parent_args['layout'] == 'icon-boxed' && 
				self::$child_args['image_width'] && 
				self::$child_args['image_height']
			) {
				$attr['style'] = sprintf( 'margin-left:-%spx;', self::$child_args['image_width'] / 2 );
				$attr['style'] .= sprintf( 'top:-%spx;', self::$child_args['image_height'] / 2 + 50 );
			}			
			
		} else if( self::$child_args['icon'] ) {

			$attr['class'] = sprintf( 'fa fontawesome-icon %s', frenifyCore_Plugin::font_awesome_name_handler( self::$child_args['icon'] ) );
			
			// set parent values if child values are unset to get downwards compatibility
			if( ! self::$child_args['circle'] ) {
				self::$child_args['circle'] = self::$parent_args['circle'];
			}		
			
			if( self::$parent_args['icon_circle'] == 'yes' ) {

				$attr['class'] .= ' circle-yes';

				if( self::$child_args['circlebordercolor'] ) {
					$attr['style'] .= sprintf( 'border-color:%s;', self::$child_args['circlebordercolor'] );
				}

				if( self::$child_args['circlebordersize'] ) {
					$attr['style'] .= sprintf( 'border-width:%s;', self::$child_args['circlebordersize'] );
				}

				if( self::$child_args['circlecolor'] ) {
					$attr['style'] .= sprintf( 'background-color:%s;', self::$child_args['circlecolor'] );
				}

				$attr['style'] .= sprintf( 'height:%spx;width:%spx;line-height:%spx;', self::$parent_args['icon_size'] * 2, self::$parent_args['icon_size'] * 2, self::$parent_args['icon_size'] * 2 );

				if( self::$parent_args['layout'] == 'icon-boxed' && ! self::$child_args['outercirclebordercolor'] &&  ! self::$child_args['outercirclebordersize'] ) {
					$attr['style'] .= sprintf( 'top:-%spx;margin-left:-%spx;', 50 + ( ( self::$parent_args['icon_size'] * 2 ) / 2 ), ( self::$parent_args['icon_size'] * 2 ) / 2 );
				}

				if( self::$parent_args['icon_circle_radius'] == 'round' ) {
					self::$parent_args['icon_circle_radius'] = '100%';
				}

				$attr['style'] .= sprintf( 'border-radius:%s;', self::$parent_args['icon_circle_radius'] );

				if( self::$child_args['outercirclebordercolor'] && self::$child_args['outercirclebordersize'] ) {
					// If there is a thick border, kill border width and make it center aligned positioned
					$attr['style'] .= sprintf( 'border-width:%s;', '0' );
					$attr['style'] .= sprintf( 'position:%s;', 'relative' );
					$attr['style'] .= sprintf( 'top:%s;', self::$child_args['circlebordersize'] );
					$attr['style'] .= sprintf( 'left:%s;', self::$child_args['circlebordersize'] );
					$attr['style'] .= 'margin:0;';
					$attr['style'] .= sprintf( 'border-radius:%spx;', intval( self::$parent_args['icon_circle_radius'] ) - intval( self::$child_args['outercirclebordersize'] ) );
				}
			} else {

				$attr['class'] .= ' circle-no';

				$attr['style'] .= sprintf( 'background-color:%s;border-color:%s;height:%s;width:%spx;line-height:%s;', 'transparent', 'transparent', 'auto', self::$parent_args['icon_size'], 'normal' );

				if( self::$parent_args['layout'] == 'icon-boxed' ) {
					$attr['style'] .= sprintf( 'position:%s;left:%s;right:%s;top:%s;margin-left:%s;margin-right:%s;', 'relative', 'auto', 'auto', 'auto', 'auto', 'auto' );
				}
			}

			if( self::$child_args['iconcolor'] ) {
				$attr['style'] .= sprintf( 'color:%s;', self::$child_args['iconcolor'] );
			}

			if( self::$child_args['iconrotate'] ) {
				$attr['class'] .= ' fa-rotate-' . self::$child_args['iconrotate'];
			}

			if( self::$child_args['iconspin'] == 'yes' ) {
				$attr['class'] .= ' fa-spin';
			}

			$attr['style'] .= sprintf( 'font-size:%spx;', frenifyCore_Plugin::strip_unit( self::$parent_args['icon_size'] ) );
		}

		return $attr;

	}

	function content_container_attr() {
		$attr['class'] = 'content-container';
		$attr['style'] = '';

		if( ( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) && 
			self::$child_args['image'] && 
			self::$child_args['image_width'] && 
			self::$child_args['image_height']
		) {		
			if( self::$parent_args['layout'] == 'clean-horizontal' ) {
				$attr['style'] .= sprintf( 'padding-left:%spx;', self::$child_args['image_width'] + 20 );
			} else {
				if ( self::$parent_args['icon_align'] == 'right' ) {
					$attr['style'] .= sprintf( 'padding-right:%spx;', self::$child_args['image_width'] + 20 );
				} else {
					$attr['style'] .= sprintf( 'padding-left:%spx;', self::$child_args['image_width'] + 20 );
				}
			}
			
			if ( self::$parent_args['layout'] == 'timeline-vertical' ) {
				$image_height = self::$child_args['image_height'];
				if ( $image_height > self::$parent_args['title_size'] &&
					 $image_height - self::$parent_args['title_size'] - 15 > 0
				) {
					$attr['style'] .= sprintf( 'margin-top:-%spx;', $image_height - self::$parent_args['title_size'] );
				}
			}
		} else if ( ( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) && self::$child_args['icon'] ) {
			if ( self::$parent_args['icon_circle'] == 'yes' ) {
				$full_icon_size = ( self::$parent_args['icon_size'] * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ) + ( intval( self::$child_args['outercirclebordersize'] ) * 2 );
			} else {
				$full_icon_size = self::$parent_args['icon_size'];
			}
			
			if( self::$parent_args['layout'] == 'clean-horizontal' ) {
				$attr['style'] .= sprintf( 'padding-left:%spx;', $full_icon_size + 20 );
			} else {
				if ( self::$parent_args['icon_align'] == 'right' ) {
					$attr['style'] .= sprintf( 'padding-right:%spx;', $full_icon_size + 20 );
				} else {
					$attr['style'] .= sprintf( 'padding-left:%spx;', $full_icon_size + 20 );
				}				
			}

			if ( self::$parent_args['layout'] == 'timeline-vertical' ) {
				if ( $full_icon_size > self::$parent_args['title_size'] &&
					 $full_icon_size - self::$parent_args['title_size'] - 15 > 0
				) {
					if ( self::$parent_args['layout'] == 'timeline-vertical' ) {
						$attr['style'] .= sprintf( 'margin-top:-%spx;', ( $full_icon_size - self::$parent_args['title_size'] ) / 2 );
					} else {
						$attr['style'] .= sprintf( 'margin-top:-%spx;', $full_icon_size - self::$parent_args['title_size'] );
					}
				}
			}
		}

		if( self::$parent_args['icon_align'] == 'right' && isset ( $attr['style'] ) && ( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'icon-with-title' || self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) ) {
			$attr['style'] .= sprintf( ' text-align:%s;', self::$parent_args['icon_align'] );
		} else if( self::$parent_args['icon_align'] == 'right' && !isset( $attr['style'] ) && ( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'icon-with-title' || self::$parent_args['layout'] == 'timeline-vertical' || self::$parent_args['layout'] == 'clean-horizontal' ) ) {
			$attr['style'] .= sprintf( ' text-align:%s;', self::$parent_args['icon_align'] );
		}

		if( self::$parent_args['body_color'] ) {
			$attr['style'] .= sprintf( 'color:%s;', self::$parent_args['body_color'] );
		}

		return $attr;
		
	}

	function timeline_attr() {
		if( self::$parent_args['layout'] == 'timeline-horizontal' ) {
			$attr['class'] = 'content-box-shortcode-timeline';
			$attr['style'] = '';

			$border_color = '';
			if ( self::$parent_args['icon_circle'] == 'yes' ) {
				if ( intval( self::$child_args['outercirclebordersize'] ) ) {
					$full_icon_size = ( intval( self::$parent_args['icon_size'] ) * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ) + ( intval( self::$child_args['outercirclebordersize'] ) * 2 );
				} else {
					$full_icon_size = intval( self::$parent_args['icon_size'] ) * 2;
				}
			} else {
				$full_icon_size = intval( self::$parent_args['icon_size'] );
			}

			$position_top = $full_icon_size / 2;

			if ( self::$child_args['backgroundcolor'] && self::$child_args['backgroundcolor'] != 'transparent' ) {
				$position_top += 35;
			}			
			
			if( self::$child_args['circlebordercolor'] ) {
				$border_color = self::$child_args['circlebordercolor'];
			}

			if( self::$child_args['outercirclebordercolor'] && self::$child_args['outercirclebordersize'] ) {
				$border_color = self::$child_args['outercirclebordercolor'];
			}

			if( ! self::$child_args['circlebordercolor'] && ! self::$child_args['outercirclebordercolor'] ) {
				$border_color = '#f6f6f6';
			}

			if( $border_color ) {
				$attr['style'] .= sprintf( 'border-color:%s;', $border_color );
			}

			if( $position_top ) {
				$attr['style'] .= sprintf( 'top:%spx;', intval( $position_top ) );
			}
		} else if( self::$parent_args['layout'] == 'timeline-vertical' ) {
			$attr['class'] = 'content-box-shortcode-timeline-vertical';
			$attr['style'] = '';

			$border_color = '';
			
			if ( self::$parent_args['icon_circle'] == 'yes' ) {
				if ( intval( self::$child_args['outercirclebordersize'] ) ) {
					$full_icon_size = ( intval( self::$parent_args['icon_size'] ) * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ) + ( intval( self::$child_args['outercirclebordersize'] ) * 2 );
				} else {
					$full_icon_size = intval( self::$parent_args['icon_size'] ) * 2;
				}
			} else {
				$full_icon_size = intval( self::$parent_args['icon_size'] );
			}

			$position_top = $full_icon_size;
			$position_horizontal = $full_icon_size / 2 + 15;
			if ( self::$child_args['backgroundcolor'] && self::$child_args['backgroundcolor'] != 'transparent' ) {
				$position_top += 35;
				$position_horizontal += 35;
			}

			if( self::$child_args['circlebordercolor'] ) {
				$border_color = self::$child_args['circlebordercolor'];
			}

			if( self::$child_args['outercirclebordercolor'] && self::$child_args['outercirclebordersize'] ) {
				$border_color = self::$child_args['outercirclebordercolor'];

			}

			if( ! self::$child_args['circlebordercolor'] && ! self::$child_args['outercirclebordercolor'] ) {
				$border_color = '#f6f6f6';
			}

			if( $border_color ) {
				$attr['style'] .= sprintf( 'border-color:%s;', $border_color );
			}

			if ( $position_horizontal ) {
				if ( self::$parent_args['icon_align'] == 'right' ) {					
					$attr['style'] .= sprintf( 'right:%spx;', intval( $position_horizontal ) );
				} else {
					$attr['style'] .= sprintf( 'left:%spx;', intval( $position_horizontal ) );
				}
			}
			
			if ( $position_top ) {
				$attr['style'] .= sprintf( 'top:%spx;', $position_top );
			}
		}

		if( self::$parent_args['animation_delay'] ) {
			$animation_delay = self::$parent_args['animation_delay'];
			$attr['style'] .= '-webkit-transition-duration: ' . $animation_delay . 'ms;';
			$attr['style'] .= 'animation-duration: ' . $animation_delay . 'ms;';
		}

		return $attr;
	}

	function content_box_heading_attr() {
		$attr['class'] = 'content-box-heading';
		$attr['style'] = '';

		if( self::$parent_args['title_size'] ) {
			$font_size = frenifyCore_Plugin::strip_unit( self::$parent_args['title_size'] );
		
			$attr['style'] = sprintf( 'font-size: %spx;line-height:%spx;', $font_size, $font_size + 2 );
		}

		if( self::$parent_args['title_color'] ) {
			$attr['style'] .= sprintf( 'color:%s;', self::$parent_args['title_color'] );
		}
		
		if ( self::$parent_args['layout'] == 'icon-on-side' || self::$parent_args['layout'] == 'clean-horizontal' ) {
			
			if ( self::$child_args['image'] && 
				 self::$child_args['image_width'] && 
				 self::$child_args['image_height']
			) {		

				if ( self::$parent_args['icon_align'] == 'right' ) {
					$attr['style'] .= sprintf( 'padding-right:%spx;', self::$child_args['image_width'] + 20 );
				} else {
					$attr['style'] .= sprintf( 'padding-left:%spx;', self::$child_args['image_width'] + 20 );
				}

			} else if ( self::$child_args['icon'] ) {
				if ( self::$parent_args['icon_circle'] == 'yes' ) {
					$full_icon_size = ( self::$parent_args['icon_size'] * 2 ) + ( intval( self::$child_args['circlebordersize'] ) * 2 ) + ( intval( self::$child_args['outercirclebordersize'] ) * 2 );
				} else {
					$full_icon_size = self::$parent_args['icon_size'];
				}

				if ( self::$parent_args['icon_align'] == 'right' ) {
					$attr['style'] .= sprintf( 'padding-right:%spx;', $full_icon_size + 20 );
				} else {
					$attr['style'] .= sprintf( 'padding-left:%spx;', $full_icon_size + 20 );
				}				
			}
		}

		return $attr;
	}
}

new frenifySC_ContentBoxes();