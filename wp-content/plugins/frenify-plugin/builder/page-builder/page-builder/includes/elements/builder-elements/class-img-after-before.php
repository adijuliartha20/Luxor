<?php
/**
 * ImgAfterBefore element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ImgAfterBefore extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'img_after_before';
			// element name
			$this->config['name']	 		= __('Image After Before', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "image_after_before.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Image After Before Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Image After Before', 'frenify-core').'</sub><div class="img_frame_section">Image here</div><p class="call_to_action_name">John Doe</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array( "name" 			=> __('Slide Direction', 'frenify-core'),
					  "id" 				=> "orientation",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "horizontal",
					  "allowedValues" 	=> array(
												'horizontal' 		=> esc_html__('Horizontal', 'frenify-core'),
												'vertical' 			=> esc_html__('Vertical', 'frenify-core'),
												 )
					  ),
				
				array("name" 			=> __('Before Text', 'frenify-core'),
					  "desc"			=> __('Insert before text.', 'frenify-core'),
					  "id" 				=> "before_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Before" 
					  ),
				
				array("name" 			=> __('After Text', 'frenify-core'),
					  "desc"			=> __('Insert after text.', 'frenify-core'),
					  "id" 				=> "after_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "After" 
					  ),
				
				
				array("name" 			=> esc_html__('Upload Before Image', 'frenify-core'),
					  "id" 				=> "before_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 2,
					  ),
				
				array("name" 			=> esc_html__('Upload After Image', 'frenify-core'),
					  "id" 				=> "after_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 1,
					  ),
				array(
					"name"  			=> __( 'Padding Top', 'frenify-core' ),
					"desc"  			=> __( 'Padding top for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> __( 'Padding Bottom', 'frenify-core' ),
					"desc"  			=> __( 'Padding bottom for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
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