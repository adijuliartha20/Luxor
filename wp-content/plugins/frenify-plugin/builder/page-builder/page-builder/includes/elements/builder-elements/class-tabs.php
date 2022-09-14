<?php
/**
 * Tabs element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Tabs extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'tabs_box';
			// element name
			$this->config['name']	 		= __('Tabs', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "tabs.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Tabs Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_tabs">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Tabs', 'frenify-core').'</sub><ul class="tabs_elements"><li>tab title 1 here</li><li>tab, title 2 here</li><li>tab title 3 here</li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$choices					= frenifyHelper::get_shortcode_choices();
			
	 $am_array = array();
	  $am_array[] = array ( 
							array("name"	=> __('Tab Title', 'frenify-core'),
										"desc"		=> __('Title of the tab', 'frenify-core'),
										"id"		=> "fotofly_fn_title[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("") 
							),							
						  	array( "name"	 => __('Tab Content', 'frenify-core'),
										"desc"		=> __('Add the tabs content', 'frenify-core'),
										"id"		=> "fotofly_fn_content_wp[0]",
										"type"		=> ElementTypeEnum::HTML_EDITOR,
										"value"	   => array("Tab content") 
							),
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
				array("name"			=> __('Layout', 'frenify-core'),
					  "desc"			=> __('Choose a layout for the shortcode.', 'frenify-core'),
					  "id"				=> "fotofly_fn_layout",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array(""),
					  "allowedValues"   => array('alpha'	 	=> __('Alpha', 'frenify-core'),
												 'beta'	 		=> __('Beta', 'frenify-core')) 
				  	  ),
				array("name"			=> __('Skin', 'frenify-core'),
					  "desc"			=> __('Choose a skin for the shortcode.', 'frenify-core'),
					  "id"				=> "fotofly_fn_skin",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array(""),
					  "allowedValues"   => array('light'	 => __('Light', 'frenify-core'),
												 'dark'	 => __('Dark', 'frenify-core')) 
				  	  ),
				  	  
				array("name" 			=> __('Horizontal Position', 'frenify-core'),
					  //"desc" 			=> __('Choose the layout of the shortcode', 'frenify-core'),
					  "id" 				=> "fotofly_fn_position",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array('left' 		=> __('Left', 'frenify-core'),
												 'right' 		=> __('Right', 'frenify-core'),
												 'center' 		=> __('Center', 'frenify-core'),) 
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
					  "buttonText"		=> __('Add New Tab', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_tab",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}