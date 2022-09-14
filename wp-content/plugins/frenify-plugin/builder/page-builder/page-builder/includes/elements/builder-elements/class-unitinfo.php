<?php
/**
 * Testimonial element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_UnitInfo extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		}
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'unit_info';
			// element name
			$this->config['name']	 		= esc_html__('Unit Info', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "unit_info.jpg";
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
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_unit_info">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Unit Info', 'frenify-core').'</sub><ul class="gallery_content"><li></li></ul></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
		
		$reverse_choices			= frenifyHelper::get_reversed_choice_data();

	 	$am_array = array();
	  	$am_array[] = array (
							array(		"name"		=> esc_html__('Image', 'frenify-core'),
										"desc"		=> esc_html__('Insert the image', 'frenify-core'),
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
				
				array(
					"name"  => esc_html__( 'Title', 'frenify-core' ),
					"desc"  => esc_html__( 'Insert the title.', 'frenify-core' ),
					"id"    => "title",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "",
				),
				
				array(
					"name"  => esc_html__( 'Description', 'frenify-core' ),
					"desc"  => esc_html__( 'Insert the description.', 'frenify-core' ),
					"id"    => "descr",
					"type"  => ElementTypeEnum::TEXTAREA,
					"value" => "",
				),
				
				array(
					"name"  => esc_html__( 'Link URL', 'frenify-core' ),
					"desc"  => esc_html__( 'Insert the link URL.', 'frenify-core' ),
					"id"    => "link_url",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "#",
				),
				
				array(
					"name"  => esc_html__( 'Link Text', 'frenify-core' ),
					"desc"  => esc_html__( 'Insert the link text.', 'frenify-core' ),
					"id"    => "link_text",
					"type"  => ElementTypeEnum::INPUT,
					"value" => esc_html__( 'Read All', 'frenify-core' ),
				),
				
				array("name" 			=> __('Title Color', 'frenify-core'),
					  "desc" 			=> __('Set the color of the title.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#111"
					  ),
				
				array("name" 			=> __('Description Color', 'frenify-core'),
					  "desc" 			=> __('Set the color of the description.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_descr_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#555"
					  ),
				
				array("name" 			=> __('Link Text Color', 'frenify-core'),
					  "desc" 			=> __('Set the color of the link text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff"
					  ),
				
				array("name" 			=> __('Link Background Color', 'frenify-core'),
					  "desc" 			=> __('Set the color of the link background.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_bg_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#c05959"
					  ),
				
				array(
					"name"  			=> esc_html__( 'Margin Top', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> esc_html__( 'Margin Bottom', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),					  	
					  
				array(
					"name" 				=> esc_html__('CSS Class', 'frenify-core'),
				  	"desc"				=> esc_html__('Add a class to the wrapping HTML element.', 'frenify-core'),
					"id" 				=> "fotofly_fn_class",
					"type" 				=> ElementTypeEnum::INPUT,
					"value" 			=> "" 
				  ),

				array(
					"name" 				=> esc_html__('CSS ID', 'frenify-core'),
					"desc"				=> esc_html__('Add an ID to the wrapping HTML element.', 'frenify-core'),
					"id" 				=> "fotofly_fn_id",
					"type" 				=> ElementTypeEnum::INPUT,
					"value" 			=> "" 
				 ),
					  
				array(
					"type" 				=> ElementTypeEnum::ADDMORE,
				  	"buttonText"		=> esc_html__('Add More', 'frenify-core'),
				  	"id"				=> "am_fotofly_fn_supersized",
				  	"elements" 			=> $am_array
				 ),
			);
		}
	}