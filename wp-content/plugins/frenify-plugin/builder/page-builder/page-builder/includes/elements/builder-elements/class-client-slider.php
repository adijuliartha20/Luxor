<?php
/**
 * ClientSlider element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ClientSlider extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		} 

		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'client_slider';
			// element name
			$this->config['name']	 		= __('Client Slider', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-users';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Clients Slider';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_client_slider">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-users"></i><sub class="sub">'.__('Client Slider', 'frenify-core').'</sub><ul class="client_slider_elements"><li></li></ul></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {

	  $am_array = array();

	  $am_array[] = array ( 
							array( "name"	 => __('Client Website Link', 'frenify-core'),
										"desc"		=> __('Add the url to client\'s website <br>ex: http://example.com', 'frenify-core'),
										"id"		=> "fotofly_fn_url[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
							),
						  array("name"	=> __('Button Target', 'frenify-core'),
									  "desc"		=> __('_self = open in same window<br>_blank = open in new window', 'frenify-core'),
									  "id"		=> "fotofly_fn_target[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array("_self"),
									  "allowedValues"   => array('_self'	=>'_self',
																 '_blank'	 =>'_blank') 
						  ),
						  array("name"	=> __('Client Image', 'frenify-core'),
									  "desc"		=> __('Upload the client image', 'frenify-core'),
									  "id"		=> "fotofly_fn_image[0]",
									  "type"		=> ElementTypeEnum::UPLOAD,
							"upid"		=> array(1),
									  "value"	   => array()
							),
						  array( "name"	 => __('Image Alt Text', 'frenify-core'),
										"desc"		=> __('The alt attribute provides alternative information if an image cannot be viewed', 'frenify-core'),
										"id"		=> "fotofly_fn_alt[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
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
				array("name" 			=> __('Picture Size', 'frenify-core'),
					  "desc"			=> __('fixed = width and height will be fixed<br>auto = width and height will adjust to the image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_picture_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> array( "fixed"),
					  "allowedValues" 	=> array('fixed'  =>__('Fixed', 'frenify-core'),
								  				 'auto' =>__('Auto', 'frenify-core'))
					   
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
					  "buttonText"		=> __('Add New Client Image', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_client",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}