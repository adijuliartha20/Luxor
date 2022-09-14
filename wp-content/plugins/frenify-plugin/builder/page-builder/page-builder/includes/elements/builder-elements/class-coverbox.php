<?php
/**
 * Person element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Coverbox extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'coverbox_box';
			// element name
			$this->config['name']	 		= __('Cover Box', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "coverbox.jpg";
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
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_idcoverbox">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Cover Box', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> __('Template', 'frenify-core'),
					  "desc"  			=> '',
					  "id" 				=> "fotofly_fn_template",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "alpha",
					  "allowedValues" 	=> array(
												'alpha' 			=> __('Alpha', 'frenify-core'),
												'beta' 				=> __('Beta', 'frenify-core'),
												'gamma' 			=> __('Gamma', 'frenify-core'),
												'delta' 			=> __('Delta', 'frenify-core'),
												'epsilon' 			=> __('Epsilon', 'frenify-core'),
												'zeta' 				=> __('Zeta', 'frenify-core'),
												'eta' 				=> __('Eta', 'frenify-core'),
												'theta' 			=> __('Theta', 'frenify-core'),
												) 
					  ),
				
				array("name" 			=> __('Skin', 'frenify-core'),
					  "desc"  			=> '',
					  "id" 				=> "fotofly_fn_skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array('light' 			=> __('Light', 'frenify-core'),
												 'dark' 			=> __('Dark', 'frenify-core')) 
					  ),	
				
				array("name" 			=> __('Max Width', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_width",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "max600",
					  "allowedValues" 	=> array(
												'max400' 				=> '400px',
												'max500' 				=> '500px',
												'max600' 				=> '600px',
												'max700' 				=> '700px',
												'max800' 				=> '800px',
												'max900' 				=> '900px',
												'max1000' 				=> '1000px',
											) 
					  ),
				
				array("name" 			=> __('Box Position', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_position",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "center",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'frenify-core'),
												 'right' 			=> __('Right', 'frenify-core'),
												 'center' 			=> __('Center', 'frenify-core')) 
					  ),	  
				array("name" 			=> __('Text Align', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_text_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "center",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'frenify-core'),
												 'right' 			=> __('Right', 'frenify-core'),
												 'center' 			=> __('Center', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Content', 'frenify-core'),
					  "desc"			=> '',
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