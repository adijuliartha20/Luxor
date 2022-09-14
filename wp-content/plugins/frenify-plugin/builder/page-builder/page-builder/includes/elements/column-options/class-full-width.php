<?php

	/**
	 * FullWidthContainer implementation, it extends DDElementTemplate like all other elements
	 */
	class fotofly_fn_FullWidthContainer extends DDElementTemplate {

		public function __construct() {

			parent::__construct();
		}

		public function deprecated_args( $args ) {


			$toChange = array(
				'backgroundposition'    => 'background_position',
				'backgroundcolor'       => 'background_color',
				'backgroundattachment'  => 'background_parallax',
				'background_attachment' => 'background_parallax',
				'paddingtop'            => 'padding_top',
				'paddingbottom'         => 'padding_bottom',
				'backgroundcolor'       => 'background_color',
				'backgroundimage'       => 'background_image',
				'backgroundrepeat'      => 'background_repeat',
			);
			foreach ( $toChange as $old => $new ) {
				if ( isset( $args[ $old ] ) && ! empty( $args[ $old ] ) ) {
					if ( ! isset( $args[ $new ] ) || ( isset( $args[ $new ] ) && empty( $args[ $new ] ) && ! empty( $args[ $old ] ) ) ) {
						$args[ $new ] = $args[ $old ];
						unset( $args[ $old ] );
					}
				}
			}

			return $args;
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'full_width_container';
			// element shortcode base
			$this->config['base'] = 'fullwidth';
			// element name
			$this->config['name'] = __( 'Full Width Container', 'frenify-core' );
			// element icon
			$this->config['icon_url'] = "icons/sc-icon_box.png";
			// css class related to this element
			$this->config['css_class'] = "item-wrapper fotofly_fn_full_width sortable-element drag-element fotofly_fn_layout_column fotofly_fn_full_width item-container sort-container ui-draggable";
			// element icon class
			$this->config['icon_class'] = 'frenify-icon builder-options-icon xcon-th';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates a Full Width Container';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "drop_level" => "2" );
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="icon-move-horizontal"></i><sub class="sub">Full Width Container</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = '';
		}

		//this function defines FullWidth sub elements or structure
		function popup_elements() {
			$this->config['layout_opt'] = true;
			$border_size                = frenifyHelper::fotofly_fn_create_dropdown_data( 1, 10 );
			$padding_data               = frenifyHelper::fotofly_fn_create_dropdown_data( 1, 100 );
			$rate               		= frenifyHelper::fotofly_fn_create_dropdown_data( 1, 100 );
			$rate2               		= frenifyHelper::fotofly_fn_create_dropdown_data( 0, 1 );
			$number_rate 				= array(
											'0'   => '0',
											'0.1' => '0.1',
											'0.2' => '0.2',
											'0.3' => '0.3',
											'0.4' => '0.4',
											'0.5' => '0.5',
											'0.6' => '0.6',
											'0.7' => '0.7',
											'0.8' => '0.8',
											'0.9' => '0.9',
											'1'   => '1' 
										);
			
			
			

			$this->config['subElements'] = array(
				array(
					"name"          => __( 'Content Min Height', 'frenify-core' ),
					"id"            => "min_height",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "disable",
					"allowedValues" => array(
						'enable' 	=> __( 'Full Screen', 'frenify-core' ),
						'disable'  	=> __( 'Auto', 'frenify-core' ),
						'h100'  	=> 100,
						'h200'  	=> 200,
						'h300'  	=> 300,
						'h400'  	=> 400,
						'h500'  	=> 500,
						'h600'  	=> 600,
						'h700'  	=> 700,
						'h800'  	=> 800,
						'h900'  	=> 900,
						'h1000'  	=> 1000,
					)
				),
				array(
					"name"          => __( 'Content Layout', 'frenify-core' ),
					"id"            => "content_layout",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "contained",
					"allowedValues" => array(
						'contained' 		=> __( 'Contained', 'frenify-core' ),
						'wide-contained' 	=> __( 'Wide Contained', 'frenify-core' ),
						'full'  			=> __( 'Full', 'frenify-core' ),
					)
				),
				array(
					"name" 				=> __('Content Color', 'frenify-core'),
					"desc"				=> __('Leave blank for default color', 'frenify-core'),
					"id" 				=> "content_color",
					"type" 				=> ElementTypeEnum::COLOR,
					"value"	   			=> array(),
				),
				array(
					"name"  => __( 'Background Color', 'frenify-core' ),
					"desc"  => __( 'Set the background color.', 'frenify-core' ),
					"id"    => "background_color",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::COLOR,
					"value" => ""
				),
				array(
					"name"  => __( 'Background Color Transparency', 'frenify-core' ),
					"desc"  => __( 'Value should be between 0.1 and 1.0.', 'frenify-core' ),
					"id"    => "background_color_rate",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"allowedValues" => $number_rate,
					"value" => "0.4"
				),
				array(
					"name"          => __( 'Background Type', 'frenify-core' ),
					"id"            => "background_type",
					"type"          => ElementTypeEnum::SELECT,
					"group"         => __( 'Background', 'frenify-core' ),
					"value"         => "image",
					"allowedValues" => array(
						'parallax'      => __( 'Parallax', 'frenify-core' ),
						'video'   		=> __( 'Video', 'frenify-core' ),
						'bgslide'   	=> __( 'BG Slide', 'frenify-core' ),
						'image'   		=> __( 'Image', 'frenify-core' ),
					)
				),
				array(
					"name"  => __( 'Background Image', 'frenify-core' ),
					"desc"  => __( 'Upload an image to display in the background', 'frenify-core' ),
					"id"    => "background_image",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::UPLOAD,
					"data"  => array(
						"replace" => "frenify-hidden-img"
					),
					"upid"  => "1",
					"value" => ""
				),
				array(
					"name"          => __( 'Background Size', 'frenify-core' ),
					"desc"          => __( 'Choose how the background size.', 'frenify-core' ),
					"id"            => "background_size",
					"type"          => ElementTypeEnum::SELECT,
					"group"         => __( 'Background', 'frenify-core' ),
					"value"         => "cover",
					"allowedValues" => array(
						'auto' 			=> __( 'Auto', 'frenify-core' ),
						'contain'    	=> __( 'Contain', 'frenify-core' ),
						'cover'			=> __( 'Cover', 'frenify-core' )
					)
				),
				array(
					"name"          => __( 'Background Repeat', 'frenify-core' ),
					"desc"          => __( 'Choose how the background image repeats.', 'frenify-core' ),
					"id"            => "background_repeat",
					"type"          => ElementTypeEnum::SELECT,
					"group"         => __( 'Background', 'frenify-core' ),
					"value"         => "repeat",
					"allowedValues" => array(
						'no-repeat' => __( 'No Repeat', 'frenify-core' ),
						'repeat'    => __( 'Repeat Vertically and Horizontally', 'frenify-core' ),
						'repeat-x'  => __( 'Repeat Horizontally', 'frenify-core' ),
						'repeat-y'  => __( 'Repeat Vertically', 'frenify-core' )
					)
				),
				array(
					"name"          	=> __( 'Background Position', 'frenify-core' ),
					"desc"          	=> __( 'Choose the postion of the background image', 'frenify-core' ),
					"id"            	=> "background_position",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> __( 'Background', 'frenify-core' ),
					"value"         	=> "left top",
					"allowedValues" 	=> array(
						'left top'      	=> __( 'Left Top', 'frenify-core' ),
						'left center'   	=> __( 'Left Center', 'frenify-core' ),
						'left bottom'   	=> __( 'Left Bottom', 'frenify-core' ),
						'right top'     	=> __( 'Right Top', 'frenify-core' ),
						'right center'  	=> __( 'Right Center', 'frenify-core' ),
						'right bottom'  	=> __( 'Right Bottom', 'frenify-core' ),
						'center top'    	=> __( 'Center Top', 'frenify-core' ),
						'center center' 	=> __( 'Center Center', 'frenify-core' ),
						'center bottom' 	=> __( 'Center Bottom', 'frenify-core' )
					)
				),
				array(
					"name"  			=> __( 'Parallax Speed', 'frenify-core' ),
					"desc"  			=> __( 'Value should be between 0 and 1.', 'frenify-core' ),
					"id"    			=> "parallax_speed",
					"type"  			=> ElementTypeEnum::SELECT,
					"group"         	=> __( 'Background', 'frenify-core' ),
					"allowedValues" 	=> $number_rate,
					"value" 			=> "0.5"
				),
				array(
					"name"  => __( 'Background Video Url', 'frenify-core' ),
					"desc"  => '',
					"id"    => "video_url",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "",
				),
				
				array(
					"name"  		=> __( 'BG Slide Direction', 'frenify-core' ),
					"id"    		=> "bgslide_direction",
					"group" 		=> __( 'Background', 'frenify-core' ),
					"type"  		=> ElementTypeEnum::SELECT,
					"value" 		=> "hor",
					"allowedValues" => array(
						'hor' 			=> __('Horizontal', 'frenify-core'),
						'ver' 			=> __('Vertical', 'frenify-core'),
						'both' 			=> __('Both Direction', 'frenify-core'),
					),
				),
				array(
					"name"  => __( 'BG Slide: Reverse X axis', 'frenify-core' ),
					"id"    => "bgslide_xaxis",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "0",
					"allowedValues" => $rate2,
				),
				array(
					"name"  => __( 'BG Slide: Reverse Y axis', 'frenify-core' ),
					"id"    => "bgslide_yaxis",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "0",
					"allowedValues" => $rate2,
			    ),
				
				array(
					"name"  => __( 'BG Slide Rate', 'frenify-core' ),
					"id"    => "bgslide_rate",
					"group" => __( 'Background', 'frenify-core' ),
					"type"  => ElementTypeEnum::SELECT,
					"value" => "30",
					"allowedValues" => $rate,
			    ),
				
				
				array(
					"name"  => __( 'Margin Top', 'frenify-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    => "margin_top",
					"group" => __( 'Spacing', 'frenify-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
				),
				array(
					"name"  => __( 'Margin Bottom', 'frenify-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    => "margin_bottom",
					"group" => __( 'Spacing', 'frenify-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
				),
				array(
					"name"  => __( 'Padding Top', 'frenify-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    => "padding_top",
					"group" => __( 'Spacing', 'frenify-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "150px",
				),
				array(
					"name"  => __( 'Padding Bottom', 'frenify-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    => "padding_bottom",
					"group" => __( 'Spacing', 'frenify-core' ),
					"type"  => ElementTypeEnum::INPUT,
					"value" => "150px",
				),
				array(
					"name"          	=> __( 'Set Columns to Equal Height', 'frenify-core' ),
					"desc"          	=> __( 'Select to set all column shortcodes that are used inside the container to have equal height.', 'frenify-core' ),
					"id"            	=> "cols_equal_height",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> __( 'Columns', 'frenify-core' ),
					"value"         	=> "disable",
					"allowedValues" 	=> array(
						'enable'      	=> __( 'Enable', 'frenify-core' ),
						'disable'   	=> __( 'Disable', 'frenify-core' ),
					)
				),
				array(
					"name"          	=> __( 'Columns Vertical Align', 'frenify-core' ),
					"desc"          	=> __( 'Only works with columns inside a full width container that is set to equal heights.', 'frenify-core' ),
					"id"            	=> "cols_ver_align",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> __( 'Columns', 'frenify-core' ),
					"value"         	=> "none",
					"allowedValues" 	=> array(
						'none'      		=> __( 'None', 'frenify-core' ),
						'top'      			=> __( 'Top', 'frenify-core' ),
						'middle'   			=> __( 'Middle', 'frenify-core' ),
						'bottom'   			=> __( 'Bottom', 'frenify-core' ),
					)
				),
				array(
					"name"  => __( 'Menu Anchor', 'frenify-core' ),
					"desc"  => __( 'Just insert unique text(id)', 'frenify-core' ),
					"id"    => "menu_anchor",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'CSS Class', 'frenify-core' ),
					"desc"  => __( 'Add a class to the wrapping HTML element.', 'frenify-core' ),
					"id"    => "class",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'CSS ID', 'frenify-core' ),
					"desc"  => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' ),
					"id"    => "id",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
			);
		}
	}