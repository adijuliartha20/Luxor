<?php
/**
 * halfimage element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_HalfImage extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'halfimage_box';
			// element name
			$this->config['name']	 		= __('Half Image', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "half_image.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a halfimage Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_halfimage">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Half Image', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> __('Skin', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array('light' 			=> __('Light', 'frenify-core'),
												 'dark' 			=> __('Dark', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Image Position', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_image_position",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'frenify-core'),
												 'right' 			=> __('Right', 'frenify-core')) 
					  ),
					 
				array("name" 			=> __('Picture', 'frenify-core'),
					  "desc" 			=> __('Upload an image to display of the fist part content.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_picture",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
					  ),
				array("name" 			=> __('Title', 'frenify-core'),
					  "desc"			=> __('Insert the title of the second part content.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Content', 'frenify-core'),
					  "desc"			=> __('Insert the content of the second part content', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link Text', 'frenify-core'),
					  "desc"			=> __('Insert link text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linktext",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link URL', 'frenify-core'),
					  "desc"			=> __('Insert link URL.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linkurl",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  	  
				array("name" 			=> __('Link Target Type', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_link_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "blank",
					  "allowedValues" 	=> array('blank' 			=> __('Blank', 'frenify-core'),
												 'parent' 			=> __('Parent', 'frenify-core')) 
					  ),
				array(
					"name"  			=> __( 'Margin Top', 'frenify-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
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