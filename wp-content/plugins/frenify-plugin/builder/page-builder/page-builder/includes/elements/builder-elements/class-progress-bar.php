<?php
/**
 * ProgressBar implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ProgressBar extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'progress_bar';
			// element name
			$this->config['name']	 		= __('Progress Bar', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "progress_bar.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Prcing Bar';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_progress_bar">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Progress Bar', 'frenify-core').'</sub><p class="progress_bar_text">HTML Skills</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$filled_area 				= frenifyHelper::fotofly_fn_create_dropdown_data( 1, 100 );
			$reverse_choices			= frenifyHelper::get_reversed_choice_data_2();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Filled Area Percentage', 'frenify-core'),
					  "desc" 			=> __('From 1% to 100%', 'frenify-core'),
					  "id" 				=> "fotofly_fn_value",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "50",
					  "allowedValues" 	=> $filled_area 
					  ),
					  
				array("name" 			=> __('Progess Bar Text', 'frenify-core'),
					  "desc"			=> __('Text will show up on progess bar', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 	  
				array("name" 			=> __('Filled Color', 'frenify-core'),
					  "desc" 			=> __('Controls the color of the filled in area. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_filledcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Striped Filling', 'frenify-core'),
					  "desc" 			=> __('Choose to get the filled area striped.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_striped",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "off",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name"			=> __('Size', 'frenify-core'),
					  "desc"			=> __('Set size of the shortcode.', 'frenify-core'),
					  "id"				=> "fotofly_fn_size",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array("big"),
					  "allowedValues"   => array('big'		 => __('Big', 'frenify-core'),
												 'medium'	 => __('Medium', 'frenify-core'),
												 'small'	 => __('Small', 'frenify-core')) 
				),
				array("name"			=> __('Rounded Corner', 'frenify-core'),
					  "desc"			=> __('Set rounded corner', 'frenify-core'),
					  "id"				=> "fotofly_fn_round",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array("off"),
					  "allowedValues"   => array('off'		=> __('Off', 'frenify-core'),
												 'a'	 	=> __('Small', 'frenify-core'),
												 'b'	 	=> __('Medium', 'frenify-core'),
												 'c'	 	=> __('Large', 'frenify-core')) 
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

					  
				);
		}
	}