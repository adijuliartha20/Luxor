<?php
/**
 * Title element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Intro extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'intro_box';
			// element name
			$this->config['name']	 		= __('Intro', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Title Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_intro">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Intro', 'frenify-core').'</sub><br /><sub class="intro_text">Intro Text</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$title_data = frenifyHelper::fotofly_fn_create_dropdown_data(1, 6);
			$this->config['subElements'] = array(
			  
			   array("name" 			=> __('Main Text', 'frenify-core'),
					  "desc"			=> __('Insert the main text', 'frenify-core'),
					  "id" 				=> "main_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Welcome to Beauty"
					  ),
					  
				array( "name"	 		=> __('Image', 'frenify-core'),
					  "desc"			=> __('Upload an image to display.', 'frenify-core'),
					  "id"				=> "image",
					  "type"			=> ElementTypeEnum::UPLOAD,
					  "upid"			=> array(1),
					  "value"	   		=> array()									
					  ),
					  
				array("name" 			=> __('Button Text', 'frenify-core'),
					  "desc"			=> __('Insert Button Text', 'frenify-core'),
					  "id" 				=> "button_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				array("name" 			=> __('Button Link', 'frenify-core'),
					  "desc"			=> __('Insert Button Link', 'frenify-core'),
					  "id" 				=> "button_href",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				array("name" 			=> __('Button Hover Animation', 'frenify-core'),
					  "desc"			=> __('Set Animation', 'frenify-core'),
					  "id" 				=> "button_hover",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "on",
					  "allowedValues" 	=> array('on' 	=>__('On', 'frenify-core'),
											    'off' 	=>__('Off', 'frenify-core'),)
					  ),
				array("name" 			=> __('To Down Button', 'frenify-core'),
					  "desc"			=> __('Insert id of any section. When this button is clicked it scrolls page to that section. It doesn\'s appears if you leave this blank', 'frenify-core'),
					  "id" 				=> "fotofly_fn_todown",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
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