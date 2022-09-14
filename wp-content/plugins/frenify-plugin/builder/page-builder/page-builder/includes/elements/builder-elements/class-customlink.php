<?php
/**
 * Title element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_CustomLink extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'custom_link';
			// element name
			$this->config['name']	 		= __('Custom Link', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "custom_link.jpg";
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
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_idcustomlink">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><sub class="title_text align_right">'.__('Custom Link', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$title_data = frenifyHelper::fotofly_fn_create_dropdown_data(1, 6);
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Link Text', 'frenify-core'),
					  "desc"			=> __('Insert the link text', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_name",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link URL', 'frenify-core'),
					  "desc"			=> __('Insert the link url', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_url",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Alignment', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_link_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "center",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'frenify-core'),
												 'right' 			=> __('Right', 'frenify-core'),
												 'center' 			=> __('Center', 'frenify-core')) 
					  ),
				array("name" 			=> __('Text Transform', 'frenify-core'),
					  "desc" 			=> '',
					  "id" 				=> "fotofly_fn_transform",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "capitalize",
					  "allowedValues" 	=> array(
												'uppercase' 	=> __('Uppercase', 'frenify-core'),
											   	'lowercase' 	=> __('Lowercase', 'frenify-core'),
											   	'capitalize' 	=> __('Capitalize', 'frenify-core'),)
					  ),
					  
				array("name" 			=> __('Link Color', 'frenify-core'),
					  "desc" 			=> __('Set the color of the link.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#eb1010"
					  ),
				
				array("name" 			=> __('Margin Top', 'frenify-core'),
					  "desc"			=> __('Spacing above the title. In px or em, e.g. 10px.', 'frenify-core'),
					  "id" 				=> "margin_top",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0" 
					  ),
					  
				array("name" 			=> __('Margin Bottom', 'frenify-core'),
					  "desc"			=> __('Spacing below the title. In px or em, e.g. 10px.', 'frenify-core'),
					  "id" 				=> "margin_bottom",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0" 
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