<?php
/**
 * HoverWidth element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_HoverWidth extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'hover_width';
			// element name
			$this->config['name']	 		= __('Hover Width', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "hover_width.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Hover Width Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_call_to_action">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Hover Width', 'frenify-core').'</sub><div class="img_frame_section">Image here</div><p class="call_to_action_name">John Doe</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array( "name" 			=> __('Skin', 'frenify-core'),
					  "id" 				=> "skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array('light' 				=> esc_html__('Light', 'frenify-core'),
												 'dark' 				=> esc_html__('Dark', 'frenify-core'),
												 )
					  ),
				
				array("name" 			=> __('Title', 'frenify-core'),
					  "desc"			=> __('Insert the title.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Content', 'frenify-core'),
					  "desc"			=> __('Insert the content.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link URL', 'frenify-core'),
					  "desc"			=> __('Insert the link URL.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linkurl",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link Text', 'frenify-core'),
					  "desc"			=> __('Insert the link text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linktext",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "View All" 
					  ),
				
				array("name" 			=> esc_html__('Upload Image #1', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the first image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_img1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 1,
					  ),
				
				array("name" 			=> esc_html__('Upload Image #2', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the second image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_img2",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 2,
					  ),
				
				array("name" 			=> esc_html__('Upload Image #3', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the third image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_img3",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 3,
					  ),
				
				array("name" 			=> esc_html__('Upload Image #4', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the fourth image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_img4",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 4,
					  ),
				
				array("name" 			=> esc_html__('Upload Image #5', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the fifth image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_img5",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 5,
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