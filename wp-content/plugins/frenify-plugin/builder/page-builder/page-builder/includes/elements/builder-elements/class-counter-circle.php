<?php
/**
 * CounterCircle implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_CounterCircle extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'counter_circle';
			// element name
			$this->config['name']	 		= __('Counter Circle', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-clock';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Counter Circle';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-clock"></i><sub class="sub">'.__('Counter Circle', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$fille_area_data 			= frenifyHelper::fotofly_fn_create_dropdown_data( 1, 100 );
			$reverse_choices			= frenifyHelper::get_reversed_choice_data();

	  $am_array = array();
	  $am_array[] = array ( 
							array( "name"	 => __('Filled Area Percentage', 'frenify-core'),
										"desc"		=> __('From 1% to 100%', 'frenify-core'),
										"id"		=> "fotofly_fn_value[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   => array('') ,
						  "allowedValues"   => $fille_area_data
							),
						  array( "name"	 => __('Filled Color', 'frenify-core'),
										"desc"		=> __('Controls the color of the filled in area. Leave blank for theme option selection.', 'frenify-core'),
										"id"		=> "fotofly_fn_filledcolor[0]",
										"type"		=> ElementTypeEnum::COLOR,
										"value"	   => array('') 
							),
						  array( "name"	 => __('Unfilled Color', 'frenify-core'),
										"desc"		=> __('Controls the color of the unfilled in area. Leave blank for theme option selection.'),
										"id"		=> "fotofly_fn_unfilledcolor[0]",
										"type"		=> ElementTypeEnum::COLOR,
										"value"	   => array('') 
							),
						  array( "name"	 => __('Size of the Counter', 'frenify-core'),
										"desc"		=> __('Insert size of the counter in px. ex: 220', 'frenify-core'),
										"id"		=> "fotofly_fn_size[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("220") 
							),
						  array( "name"	 => __('Show Scales', 'frenify-core'),
										"desc"		=> __('Choose to show a scale around circles.', 'frenify-core'),
										"id"		=> "fotofly_fn_scales[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   => array(''),
						  "allowedValues"   => $reverse_choices
							),
						  array( "name"	 => __('Countdown', 'frenify-core'),
										"desc"		=> __('Choose to let the circle filling move counter clockwise.', 'frenify-core'),
										"id"		=> "fotofly_fn_countdown[0]",
										"type"		=> ElementTypeEnum::SELECT,
										"value"	   => array('') ,
						  "allowedValues"   => $reverse_choices
							),
						  array( "name"	 => __('Animation Speed', 'frenify-core'),
										"desc"		=> __('Insert animation speed in milliseconds', 'frenify-core'),
										"id"		=> "fotofly_fn_speed[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("1500") 
							),
						  array( "name"	 => __('Counter Circle Text', 'frenify-core'),
										"desc"		=> __('Insert text for counter circle box, keep it short', 'frenify-core'),
										"id"		=> "fotofly_fn_content[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array("Text") 
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
					  "buttonText"		=> __('Add New Counter Circle', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_circle",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}