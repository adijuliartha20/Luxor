<?php
/**
 * Testimonial element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Gallery extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'gallery_box';
			// element name
			$this->config['name']	 		= __('Gallery', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
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
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_gallery">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Gallery', 'frenify-core').'</sub><ul class="gallery_content"><li></li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
		
		$reverse_choices			= frenifyHelper::get_reversed_choice_data();

	 	$am_array = array();
	  	$am_array[] = array (
							array(		"name"		=> __('Image', 'frenify-core'),
										"desc"		=> __('Insert the image', 'frenify-core'),
										"id"		=> "fotofly_fn_image[0]",
										"type"		=> ElementTypeEnum::UPLOAD, 
										"upid"		=> 1,
									  	"value"	    => ''
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
				
				/*array(
					"name"  => __( 'Slide Type', 'frenify-core' ),
					"desc"  => __( 'Choose Slide Type', 'frenify-core' ),
					"id"    => "slide_type",
					"type"  => ElementTypeEnum::SELECT,
					"value" => "fade",
					"allowedValues" => array(
						'fade' 		=> __( 'Fade', 'frenify-core' ),
						'slide'    	=> __( 'Slide', 'frenify-core' ),
					)
				),*/
				array(
					"name"  => __( 'Slide Autoplay', 'frenify-core' ),
					"desc"  => __( 'Set autoplay', 'frenify-core' ),
					"id"    => "slide_autoplay",
					"type"  => ElementTypeEnum::SELECT,
					"value" => "fade",
					"allowedValues" => array(
						'on' 		=> __( 'On', 'frenify-core' ),
						'off'    	=> __( 'Off', 'frenify-core' ),
					)
				),
				/*array(
					"name"  => __( 'Slide Reverse', 'frenify-core' ),
					"desc"  => __( 'Works when slide type is "Slide"', 'frenify-core' ),
					"id"    => "slide_reverse",
					"type"  => ElementTypeEnum::SELECT,
					"value" => "off",
					"allowedValues" => array(
						'on' 		=> __( 'On', 'frenify-core' ),
						'off'    	=> __( 'Off', 'frenify-core' ),
					)
				),*/
				array(
					"name"  => __( 'Slide Speed', 'frenify-core' ),
					"desc"  => __( 'In milliseconds, ex: 4000.', 'frenify-core' ),
					"id"    => "slide_speed",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "4000",
				),
				array(
					"name"  => __( 'Margin Top', 'frenify-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    => "margin_top",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
				),
				array(
					"name"  => __( 'Margin Bottom', 'frenify-core' ),
					"desc"  => __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    => "margin_bottom",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "0",
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
					  "buttonText"		=> __('Add More', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_gallery",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}