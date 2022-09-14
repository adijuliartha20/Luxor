<?php
/**
 * ImageCarousel implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ImageCarousel extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'image_carousel';
			// element name
			$this->config['name']	 		= __('Image Carousel', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-images';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates an Image Coursel';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_image_carousel">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-images"></i><sub class="sub">'.__('Image Carousel', 'frenify-core').'</sub><ul class="image_carousel_elements"><li></li><li></li><li></li><li></li><li></li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			$no_of_columns 				= frenifyHelper::fotofly_fn_create_dropdown_data( 1 , 6 );

	 		$am_array = array();
	  		$am_array[] = array ( 
							array( "name"	 => __('Image Website Link', 'frenify-core'),
										"desc"		=> __('Add the url to image\'s website. If lightbox option is enabled, you have to add the full image link to show it in the lightbox.', 'frenify-core'),
										"id"		=> "fotofly_fn_url[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array()
							),
						  array("name"	=> __('Link Target', 'frenify-core'),
									  "desc"		=> __('_self = open in same window<br>_blank = open in new window', 'frenify-core'),
									  "id"		=> "fotofly_fn_target[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array("_self"),
									  "allowedValues"   => array('_self'	=>'_self',
																 '_blank'	 =>'_blank') 
						  ),
						  array( "name"	 => __('Image', 'frenify-core'),
										"desc"		=> __('Upload an image to display.', 'frenify-core'),
										"id"		=> "fotofly_fn_image[0]",
										"type"		=> ElementTypeEnum::UPLOAD,
										"upid"		=> array(1),
									  	"value"	   => array()									
							),
						  array( "name"	 => __('Image Alt Text', 'frenify-core'),
										"desc"		=> __('The alt attribute provides alternative information if an image cannot be viewed.', 'frenify-core'),
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
					  "desc" 			=> __('fixed = width and height will be fixed<br>auto = width and height will adjust to the image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_picture_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "fixed",
					  "allowedValues" 	=> array('fixed' 				=> __('Fixed', 'frenify-core'),
												 'auto' 				=> __('Auto', 'frenify-core')) 
					  ),
			  	
				array("name" 			=> __('Hover Type', 'frenify-core'),
					  "desc" 			=> __('Select the hover effect type.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_hover_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'frenify-core'),
												 'zoomin' 			=> __('Zoom In', 'frenify-core'),
												 'zoomout' 			=> __('Zoom Out', 'frenify-core'),
												 'liftup' 			=> __('Lift Up', 'frenify-core')) 
					  ),

				array("name" 			=> __('Autoplay', 'frenify-core'),
					  "desc" 			=> __('Choose to autoplay the carousel.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_autoplay",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'frenify-core'),
												 'no' 				=> __('No', 'frenify-core')) 
					  ),			  	
			  	
				array("name" 			=> __('Maximum Columns', 'frenify-core'),
					  "desc" 			=> __('Select the number of max columns to display.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "5",
					  "allowedValues" 	=> $no_of_columns
					  ),
					  
				array("name" 			=> __('Column Spacing', 'frenify-core'),
					  "desc" 			=> __("Insert the amount of spacing between items without 'px'. ex: 13.", 'frenify-core'),
					  "id" 				=> "fotofly_fn_column_spacing",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "13",
					 ),				 
					 
				array("name" 			=> __('Scroll Items', 'frenify-core'),
					  "desc" 			=> __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", 'frenify-core'),
					  "id" 				=> "fotofly_fn_scroll_items",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "",
					 ),						 
			  	
				array("name" 			=> __('Show Navigation', 'frenify-core'),
					  "desc" 			=> __('Choose to show navigation buttons on the carousel.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_navigation",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'frenify-core'),
												 'no' 				=> __('No', 'frenify-core')) 
					  ),	
					  
				array("name" 			=> __('Mouse Scroll', 'frenify-core'),
					  "desc" 			=> __('Choose to enable mouse drag control on the carousel. IMPORTANT: For easy draggability, when mouse scroll is activated, links will be disabled.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_mouse_scroll",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'frenify-core'),
												 'no' 				=> __('No', 'frenify-core')) 
					  ),	
					  
				array("name" 			=> __('Border', 'frenify-core'),
					  "desc" 			=> __('Choose to enable a border around the images.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_border",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'frenify-core'),
												 'no' 				=> __('No', 'frenify-core')) 
					  ),
 	
				array("name" 			=> __('Image lightbox', 'frenify-core'),
					  "desc" 			=> __('Show image in lightbox.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 				=> __('Yes', 'frenify-core'),
												 'no' 				=> __('No', 'frenify-core')) 
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
					  "buttonText"		=> __('Add New Image', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_image",
					  "elements" 		=> $am_array
											
					  )
					  
				);
		}
	}