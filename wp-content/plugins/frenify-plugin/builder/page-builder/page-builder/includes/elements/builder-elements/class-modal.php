<?php
/**
 * Modal implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Modal extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'elemenet_modal';
			// element name
			$this->config['name']	 		= __('Modal', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-modal.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a simple text block';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_modal">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Modal', 'frenify-core').'</sub><p>modal name = <span class="modal_name">myModal</span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$choices					= frenifyHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Modal Button Text', 'frenify-core'),
					  "id" 				=> "fotofly_fn_button_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Button Hover Effect', 'frenify-core'),
					  "id" 				=> "fotofly_fn_button_hover",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('on' 			=> __('On', 'frenify-core'),
												 'off' 			=> __('Off', 'frenify-core')
												 ) 
					  ),
				array("name" 			=> __('Button Size', 'frenify-core'),
					  "id" 				=> "fotofly_fn_button_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> array('medium'),
					  "allowedValues" 	=> array('small' 			=> __('Small', 'frenify-core'),
												 'medium' 			=> __('Medium', 'frenify-core'),
												 'big' 				=> __('Big', 'frenify-core')
												 ) 
					  ),
				array("name" 			=> __('Modal Window Opening Effect', 'frenify-core'),
					  "id" 				=> "fotofly_fn_opening_effect",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> array('td-zoom-out'),
					  "allowedValues" 	=> array('td-zoom-out' 			=> __('Zoom Out', 'frenify-core'),
												 'td-zoom-in' 			=> __('Zoom In', 'frenify-core')
												 ) 
					  ),
					  
				array("name" 			=> __('Modal Heading', 'frenify-core'),
					  "desc"			=> __('Heading text for the modal.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),	  
				array("name" 			=> __('Contents of Modal', 'frenify-core'),
					  "desc"			=> __('Add your content to be displayed in modal.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
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