<?php
/**
 * Accordion element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ServiceCarousel extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'service_carousel';
			// element name
			$this->config['name']	 		= __('Service Carousel', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "service_carousel.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Toggles Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_servicecarousel">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Service Carousel', 'frenify-core').'</sub><ul class="toggles_content"><li>Toggle title here</li><li>Toggle title here</li><li>Toggle title here</li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {

	  $am_array = array();
	  $am_array[] = array ( 
							array(		"name"		=> __('Title', 'frenify-core'),
										"desc"		=> __('Insert the title of the item', 'frenify-core'),
										"id"		=> "title[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("") 
							),
							array(		"name"		=> __('Image', 'frenify-core'),
										"desc"		=> __('Insert the image of the item', 'frenify-core'),
										"id"		=> "image[0]",
										"type"		=> ElementTypeEnum::UPLOAD, 
										"upid"		=> 1,
									  	"value"	    => ''
							),
							array(		"name"		=> __('Price Text', 'frenify-core'),
										"desc"		=> __('Insert the text for price.', 'frenify-core'),
										"id"		=> "price_text[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("Starting from:") 
							),
							array(		"name"		=> __('Price', 'frenify-core'),
										"desc"		=> __('Insert the price.', 'frenify-core'),
										"id"		=> "price[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("$1") 
							),
						  	array( 		"name"	 	=> __('Content', 'frenify-core'),
										"desc"		=> __('You have to use "/" to separate and display sentences as list view.', 'frenify-core'),
										"id"		=> "fotofly_fn_content_wp[0]",
										"type"		=> ElementTypeEnum::TEXTAREA,
										"value"	   	=> array("") 
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
					  "buttonText"		=> __('Add New', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_accordion",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}