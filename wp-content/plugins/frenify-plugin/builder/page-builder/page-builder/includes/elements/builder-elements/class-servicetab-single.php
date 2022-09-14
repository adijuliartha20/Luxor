<?php
/**
 * CallToAction element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ServiceTabSingle extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'servicetab_single';
			// element name
			$this->config['name']	 		= esc_html__('Servicetab Single', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "servicetab_single.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Call To Action Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_call_to_action">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.esc_html__('Servicetab Single', 'frenify-core').'</sub>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> esc_html__('Skin', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array(
												'light' 		=> esc_html__('Light', 'frenify-core'),
												'dark' 			=> esc_html__('Dark', 'frenify-core'),
												)
					  ),
				array("name" 			=> esc_html__('Image Postition', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_img_pos",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array(
												'left' 			=> esc_html__('Left', 'frenify-core'),
												'right' 		=> esc_html__('Right', 'frenify-core'),
												)
					  ),
				array("name" 			=> esc_html__('Title', 'frenify-core'),
					  "desc"			=> esc_html__('Insert the title.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Subtitle', 'frenify-core'),
					  "desc"			=> esc_html__('Insert the subtitle.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_subtitle",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Image', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the Image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 1,
					  ),
				
				array("name" 			=> esc_html__('Price Text', 'frenify-core'),
					  "desc"			=> esc_html__('Insert the price text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_price_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Starting from:" 
					  ),
				
				array("name" 			=> esc_html__('Price', 'frenify-core'),
					  "desc"			=> esc_html__('Insert the price.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_price",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Content', 'frenify-core'),
					  "desc"			=> esc_html__('You have to use "/" to separate and display sentences as list view.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),
				
				array(
					"name"  			=> esc_html__( 'Padding Top', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Padding top for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> esc_html__( 'Padding Bottom', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Padding bottom for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
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
					 
				array("name" 			=> esc_html__('CSS Class', 'frenify-core'),
					  "desc"			=> esc_html__('Add a class to the wrapping HTML element.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> esc_html__('CSS ID', 'frenify-core'),
					  "desc"			=> esc_html__('Add an ID to the wrapping HTML element.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				);
		}
	}