<?php
/**
 * Person element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Instagram extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'instagram_box';
			// element name
			$this->config['name']	 		= __('Instagram', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "instagram.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Person Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_person">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Instagram', 'frenify-core').'</sub><p class="username">.</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> __('Skin', 'frenify-core'),
					  "id" 				=> "skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array(
												'light' 	=>__('Light', 'frenify-core'),
											    'dark' 		=>__('Dark', 'frenify-core'),)
					  ),
					  
				array("name" 			=> __('Instagram Username', 'frenify-core'),
					  "id" 				=> "fotofly_fn_username",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "frenify" 
					  ),
				
				array("name" 			=> __('Link Name', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linkname",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "@FotoFly"
					  ),
				
				array("name" 			=> __('Link Target', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linktarget",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_blank",
					  "allowedValues" 	=> array(
												'_blank' 	=>__('_blank', 'frenify-core'),
											    '_self' 	=>__('_self', 'frenify-core'),)
					  ),
				
				array("name" 			=> __('Sub Text', 'frenify-core'),
					  "id" 				=> "fotofly_fn_subtext",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "follow us on instagram" 
					  ),
				
				array("name" 			=> __('Images Only', 'frenify-core'),
					  "id" 				=> "fotofly_fn_imagesonly",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "false",
					  "allowedValues" 	=> array(
												'false' 	=>__('False', 'frenify-core'),
											    'true' 		=>__('True', 'frenify-core'),)
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