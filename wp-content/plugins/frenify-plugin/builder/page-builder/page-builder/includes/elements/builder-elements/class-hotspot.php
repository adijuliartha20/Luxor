<?php
/**
 * CounterBox implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Hotspot extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'hotspot';
			// element name
			$this->config['name']	 		= __('Hotspot', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "hotspot.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Counter Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_hotspot">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Hotspot', 'frenify-core').'</sub><ul class="list_elements"><li>List</li></ul></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$no_of_columns 				= frenifyHelper::fotofly_fn_create_dropdown_data(1,6);
			$choices					= frenifyHelper::get_shortcode_choices();
			
	  $am_array = array();
	  $am_array[] = array ( 
							array( 		"name"	 	=> __('Top Spacing', 'frenify-core'),
										"desc"		=> __('Insert space in percent. Make sure it isn\'t higher than 100%', 'frenify-core'),
										"id"		=> "fotofly_fn_top[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("0%") 
							),
							array( 		"name"	 	=> __('Left Spacing', 'frenify-core'),
										"desc"		=> __('Insert space in percent. Make sure it isn\'t higher than 100%', 'frenify-core'),
										"id"		=> "fotofly_fn_left[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("0%") 
							),
							array( 		"name"	 	=> __('Background Color', 'frenify-core'),
										"id"		=> "fotofly_fn_bgcolor[0]",
										"type"		=> ElementTypeEnum::COLOR,
										"value"	   	=> "#111" 
							),
		  					array( 		"name"	 	=> __('Text Color', 'frenify-core'),
										"id"		=> "fotofly_fn_textcolor[0]",
										"type"		=> ElementTypeEnum::COLOR,
										"value"	   	=> "#ccc" 
							),
							array( 		"name"	 	=> __('Tooltip', 'frenify-core'),
										"id"		=> "fotofly_fn_tooltip[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   	=> array("open"),
										"allowedValues"   => array( 'open'		=> "Open",
												 					'hover'	 	=> "on Hover",
																	'click'	 	=> "on Click",
																  ) 
							),
							array( 		"name"	 	=> __('Position', 'frenify-core'),
										"id"		=> "fotofly_fn_position[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   	=> array("t"),
										"allowedValues"   => array( 'r'			=> "Right",
												 					'l'	 		=> "Left",
																	't'	 		=> "Top",
																	'b'	 		=> "Bottom",
																	'tl'	 	=> "Top-Left",
																	'tr'	 	=> "Top-Right",
																	'bl'	 	=> "Bottom-Left",
																	'br'	 	=> "Bottom-Right",
																  ) 
							),
						  	array( 		"name"	 	=> __('Title', 'frenify-core'),
										"id"		=> "fotofly_fn_title[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("Text") 
							)
					  );

			$this->config['defaults'] = $am_array[0];

			if($am_elements) {
			  $am_array_copy = $am_array[0];
			  $am_array = array();
			  foreach($am_elements as $key => $am_element) {
				$build_am = $am_array_copy;
				foreach($build_am as $build_am_key => $build_am_element) {
				  $build_am[$build_am_key]['value'] = $am_elements[$key][$build_am_key];
				  $build_am[$build_am_key]['id'] = str_replace('[0]', '[' . $key . ']', $build_am_element['id']);
				}
				$am_array[] = $build_am;
			  }
			}

			$this->config['subElements'] = array(
				array("name" 			=> __('Hotspot Image', 'frenify-core'),
					  "id" 				=> "fotofly_fn_image",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
				),
				array(
					"name"  			=> __( 'Margin Top', 'frenify-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> __( 'Margin Bottom', 'frenify-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),	
					 
				array("name" 			=> __('CSS Class', 'frenify-core'),
					  "desc"			=> __('Add a class to the wrapping HTML element.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('CSS ID', 'frenify-core'),
					  "desc"			=> __('Add an ID to the wrapping HTML element.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				array("type" 			=> ElementTypeEnum::ADDMORE,
					  "buttonText"		=> __('Add New Counter Box', 'frenify-core'),
					  "id"				=> "cb_fotofly_fn_box",
					  "elements" 		=> $am_array
											
					  )
				);
		}
	}