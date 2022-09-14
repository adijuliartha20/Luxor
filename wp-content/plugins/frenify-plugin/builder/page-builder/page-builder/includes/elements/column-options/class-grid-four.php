<?php

	/**
	 * One 1/4 layout category implementation, it extends DDElementTemplate like all other elements
	 */
	class fotofly_fn_GridFour extends DDElementTemplate {

		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'grid_four';
			// element shortcode base
			$this->config['base'] = 'one_fourth';
			// element name
			$this->config['name'] = '1/4';
			// element icon
			$this->config['icon_url'] = "icons/sc-four.png";
			// element icon class
			$this->config['icon_class'] = 'frenify-icon frenify-icon-grid-4';
			// css class related to this element
			$this->config['css_class'] = "fotofly_fn_layout_column grid_four item-container sort-container ";
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a single (1/4) width column';
			// any special html data attribute (i.e. data-width) needs to be passed
			// width determine the ratio of them element related to its parent element in the editor, 
			// it's only important for layout elements.
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "floated_width" => "0.25", "width" => "4", "drop_level" => "3" );
		}

		// override default implemenation for this function as this element doesn't have any content.
		public function create_visual_editor( $params ) {

			$this->config['innerHtml'] = "";
		}

		//this function defines 1/4 sub elements or structure
		function popup_elements() {
			
			$animation_type 			= frenifyHelper::get_animation_type_data();
			$number_rate 				= frenifyHelper::get_decimal_numbers();
			

			$this->config['layout_opt']  = true;
			$this->config['subElements'] = array(

				array(
					"name"          	=> esc_html__( 'Last Column', 'frenify-core' ),
					"desc"          	=> esc_html__( 'Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set.', 'frenify-core' ),
					"id"            	=> "last",
					"type"          	=> ElementTypeEnum::SELECT,
					"value"         	=> "no",
					"allowedValues" 	=> array(
						'yes' 				=> esc_html__( 'Yes', 'frenify-core' ),
						'no'  				=> esc_html__( 'No', 'frenify-core' ),
					)
				),
				array(
					"name"          	=> esc_html__( 'Column Spacing', 'frenify-core' ),
					"desc"          	=> esc_html__( 'Set to "disable" to eliminate space between columns.', 'frenify-core' ),
					"id"            	=> "spacing",
					"type"          	=> ElementTypeEnum::SELECT,
					"value"         	=> "enable",
					"allowedValues" 	=> array(
						'enable' 			=> esc_html__( 'Enable', 'frenify-core' ),
						'disable'  			=> esc_html__( 'Disable', 'frenify-core' ),
					)
				),
				array(
					"name"  			=> esc_html__( 'Padding', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0px",
				),
				array(
					"name"  			=> esc_html__( 'Margin Top', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0px",
				),
				array(
					"name"  			=> esc_html__( 'Margin Bottom', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0px",
				),
				array(
					"name"  			=> esc_html__( 'CSS Class', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Add a class to the wrapping HTML element.', 'frenify-core' ),
					"id"    			=> "class",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> ""
				),
				array(
					"name"  			=> esc_html__( 'CSS ID', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Add an ID to the wrapping HTML element.', 'frenify-core' ),
					"id"    			=> "id",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> ""
				),
				array(
					"name" 				=> esc_html__('Content Color', 'frenify-core'),
					"desc"				=> esc_html__('Leave blank for default color', 'frenify-core'),
					"id" 				=> "text_color",
					"type" 				=> ElementTypeEnum::COLOR,
					"group"         	=> esc_html__( 'Content', 'frenify-core' ),
					"value"	   			=> array(),
				),
				array(
					"name" 				=> esc_html__( 'Content Align', 'frenify-core' ),
					"id" 				=> 'text_align',
					"type" 				=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Content', 'frenify-core' ),
					"value"	   			=> array( 'left' ) ,
					"allowedValues" 	=> array(
						'center' 			=> esc_html__( 'Center', 'frenify-core' ),
						'left' 				=> esc_html__( 'Left', 'frenify-core' ),
						'right' 			=> esc_html__( 'Right', 'frenify-core' )
					)
				),
				array(
					"name" 				=> esc_html__('Background Color', 'frenify-core'),
					"desc"				=> esc_html__('Leave blank for default color', 'frenify-core'),
					"id" 				=> "background_color",
					"type" 				=> ElementTypeEnum::COLOR,
					"group"         	=> esc_html__( 'Background', 'frenify-core' ),
					"value"	   			=> array(),
				),
				array(
					"name"  			=> esc_html__( 'Background Color Transparency', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Value should be between 0 and 1.', 'frenify-core' ),
					"id"    			=> "background_color_rate",
					"type"  			=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Background', 'frenify-core' ),
					"allowedValues" 	=> $number_rate,
					"value" 			=> "1"
				),
				array(
					"name"          	=> esc_html__( 'Background Type', 'frenify-core' ),
					"id"            	=> "background_type",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Background', 'frenify-core' ),
					"value"         	=> "none",
					"allowedValues" 	=> array(
						'none'      		=> esc_html__( 'None', 'frenify-core' ),
						'image'   			=> esc_html__( 'Image', 'frenify-core' ),
						//'parallax'      	=> esc_html__( 'Parallax', 'frenify-core' ),
						//'video'   			=> esc_html__( 'Video', 'frenify-core' ),
					)
				),
				array(
					"name"  			=> esc_html__( 'Background Image', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Upload an image to display in the background (It is used as simple background image, parallax image and cover photo for video background)', 'frenify-core' ),
					"id"    			=> "background_image",
					"group" 			=> esc_html__( 'Background', 'frenify-core' ),
					"type"  			=> ElementTypeEnum::UPLOAD,
					"data"  			=> array(
						"replace" 			=> "frenify-hidden-img"
					),
					"upid"  			=> "1",
					"value" 			=> ""
				),
				array(
					"name"          	=> esc_html__( 'Background Position', 'frenify-core' ),
					"desc"          	=> esc_html__( 'Choose the postion of the background image', 'frenify-core' ),
					"id"           		=> "background_position",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Background', 'frenify-core' ),
					"value"         	=> "left top",
					"allowedValues" 	=> array(
						'left top'      	=> esc_html__( 'Left Top', 'frenify-core' ),
						'left center'   	=> esc_html__( 'Left Center', 'frenify-core' ),
						'left bottom'   	=> esc_html__( 'Left Bottom', 'frenify-core' ),
						'right top'     	=> esc_html__( 'Right Top', 'frenify-core' ),
						'right center'  	=> esc_html__( 'Right Center', 'frenify-core' ),
						'right bottom'  	=> esc_html__( 'Right Bottom', 'frenify-core' ),
						'center top'    	=> esc_html__( 'Center Top', 'frenify-core' ),
						'center center' 	=> esc_html__( 'Center Center', 'frenify-core' ),
						'center bottom' 	=> esc_html__( 'Center Bottom', 'frenify-core' )
					)
				),
				array(
					"name"          	=> esc_html__( 'Background Repeat', 'frenify-core' ),
					"desc"          	=> esc_html__( 'Choose how the background image repeats.', 'frenify-core' ),
					"id"            	=> "background_repeat",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Background', 'frenify-core' ),
					"value"         	=> "repeat",
					"allowedValues" 	=> array(
						'no-repeat' 		=> esc_html__( 'No Repeat', 'frenify-core' ),
						'repeat'    		=> esc_html__( 'Repeat Vertically and Horizontally', 'frenify-core' ),
						'repeat-x'  		=> esc_html__( 'Repeat Horizontally', 'frenify-core' ),
						'repeat-y'  		=> esc_html__( 'Repeat Vertically', 'frenify-core' )
					)
				),
				array(
					"name"          	=> esc_html__( 'Background Size', 'frenify-core' ),
					"id"            	=> "background_size",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Background', 'frenify-core' ),
					"value"         	=> "repeat",
					"allowedValues" 	=> array(
						'auto' 				=> esc_html__( 'Auto', 'frenify-core' ),
						'contain'    		=> esc_html__( 'Contain', 'frenify-core' ),
						'cover'  			=> esc_html__( 'Cover', 'frenify-core' ),
					)
				),
				
				array(
					"name"          	=> esc_html__( 'Border Position', 'frenify-core' ),
					"desc"          	=> esc_html__( 'Choose the position of the border.', 'frenify-core' ),
					"id"           		=> "border_position",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Border', 'frenify-core' ),
					"value"         	=> "all",
					"allowedValues" 	=> array(
						'all'      			=> esc_html__( 'All', 'frenify-core' ),
						'top'   			=> esc_html__( 'Top', 'frenify-core' ),
						'bottom'   			=> esc_html__( 'Bottom', 'frenify-core' ),
						'right'     		=> esc_html__( 'Right', 'frenify-core' ),
						'left'  			=> esc_html__( 'Left', 'frenify-core' )
					)
				),
				array(
					"name"  			=> esc_html__( 'Border Size', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 1px.', 'frenify-core' ),
					"id"    			=> "border_size",
					"type"  			=> ElementTypeEnum::INPUT,
					"group"         	=> esc_html__( 'Border', 'frenify-core' ),
					"value" 			=> "0px",
				),
				array(
					"name"          	=> esc_html__( 'Border Style', 'frenify-core' ),
					"desc"          	=> esc_html__( 'Choose the style of the border.', 'frenify-core' ),
					"id"           		=> "border_style",
					"type"          	=> ElementTypeEnum::SELECT,
					"group"         	=> esc_html__( 'Border', 'frenify-core' ),
					"value"         	=> "solid",
					"allowedValues" 	=> array(
						'solid'      		=> esc_html__( 'Solid', 'frenify-core' ),
						'dashed'   			=> esc_html__( 'Dashed', 'frenify-core' ),
						'dotted'   			=> esc_html__( 'Dotted', 'frenify-core' )
					)
				),
				array(
					"name" 				=> esc_html__('Border Color', 'frenify-core'),
					"desc"				=> esc_html__('Choose the border color', 'frenify-core'),
					"id" 				=> "border_color",
					"type" 				=> ElementTypeEnum::COLOR,
					"group"         	=> esc_html__( 'Border', 'frenify-core' ),
					"value"	   			=> array(),
				),
				
				array("name" 			=> esc_html__( 'Animation Type', 'frenify-core' ),
					  "desc" 			=> esc_html__( 'Select the type of animation to use on the shortcode', 'frenify-core' ),
					  "id" 				=> "animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "group" 			=> esc_html__( 'Animation', 'frenify-core' ),
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
				),
				array(
					"name"  			=> esc_html__( 'Animation Delay', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert Delay Time', 'frenify-core' ),
					"id"    			=> "animation_delay",
					"type"  			=> ElementTypeEnum::INPUT,
					"group" 			=> esc_html__( 'Animation', 'frenify-core' ),
					"value" 			=> "0",
				),	
				
			);
		}
	}