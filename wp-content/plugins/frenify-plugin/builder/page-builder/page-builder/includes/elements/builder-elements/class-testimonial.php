<?php
/**
 * Testimonial element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Testimonial extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'testimonial_box';
			// element name
			$this->config['name']	 		= __('Testimonial', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "testimonial.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Testimonial Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_testimonial">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Testimonial', 'frenify-core').'</sub><p class="testimonial_content">John Doe, frenify <br>Brandon Gredo, frenify</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
		
		$reverse_choices			= frenifyHelper::get_reversed_choice_data();

	 	$am_array = array();
	  	$am_array[] = array (
							array(	  "name" 			=> __('Picture', 'frenify-core'),
									  "desc" 			=> __('Upload an image to display.', 'frenify-core'),
									  "id" 				=> "fotofly_fn_image[0]",
									  "upid"			=> 1,
									  "type" 			=> ElementTypeEnum::UPLOAD,
									  "value" 			=> ""
							),
							array(		"name"		=> __('Name', 'frenify-core'),
										"desc"		=> __('Insert the name of the person', 'frenify-core'),
										"id"		=> "fotofly_fn_name[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("") 
							),
							array(		"name"		=> __('Occupation', 'frenify-core'),
										"desc"		=> __('Insert the occupation of the person', 'frenify-core'),
										"id"		=> "fotofly_fn_occupation[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   	=> array("") 
							),
						  	array( 		"name"	 	=> __('Testimonial Content', 'frenify-core'),
										"desc"		=> __('Add the testimonial content', 'frenify-core'),
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
						"name" 			=> __('Skin', 'frenify-core'),
					  	"id" 			=> "skin",
					  	"type" 			=> ElementTypeEnum::SELECT,
					  	"value"	   		=> array('light') ,
						"allowedValues" => array('light' 	=> __('Light', 'frenify-core'),
												 'dark' 	=> __('Dark', 'frenify-core'))
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
					  "buttonText"		=> __('Add New Testimonial', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_testimonial",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}