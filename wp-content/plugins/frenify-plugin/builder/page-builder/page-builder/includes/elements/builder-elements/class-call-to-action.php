<?php
/**
 * CallToAction element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_CallToAction extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'call_to_action_fn';
			// element name
			$this->config['name']	 		= __('Call To Action', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "call_to_action.jpg";
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
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Call To Action', 'frenify-core').'</sub><div class="img_frame_section">Image here</div><p class="call_to_action_name">John Doe</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> __('Border Radius', 'frenify-core'),
					  "desc"			=> __('Border Radius for box. In pixels, ex: 3px.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_border_radius",
					   "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0px",
					 ),
				
				
				array("name" 			=> __('Background Overlay', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_bg_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "color",
					  "allowedValues" 	=> array(
												'color' 			=> __('Color', 'frenify-core'),
												'gradient' 			=> __('Gradient', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Gradient Direction', 'frenify-core'),
					  "desc"			=> __('Gradient direction in degree, ex. 90deg = left to right.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bg_graddirection",
					   "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "135deg",
					 ),
					 
				array("name" 			=> __('Background Color', 'frenify-core'),
					  "desc" 			=> __('Choose a background color.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bgcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#3651ff"
					  ),
				
				array("name" 			=> __('Background Gradient Start Color', 'frenify-core'),
					  "desc" 			=> __('Choose a background gradient start color.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bggradtocolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Background Gradient End Color', 'frenify-core'),
					  "desc" 			=> __('Choose a background gradient end color.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bggradfromcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Name', 'frenify-core'),
					  "desc"			=> __('Insert the name.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_name",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link Url', 'frenify-core'),
					  "desc"			=> __('Insert link URL.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_url",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "#" 
					  ),
				
				array("name" 			=> __('Link Target', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_link_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_blank",
					  "allowedValues" 	=> array('_blank' 			=> __('_blank', 'frenify-core'),
												 '_parent' 			=> __('_parent', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Text Color', 'frenify-core'),
					  "desc"			=> __('Choose a color of text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_color",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff" 
					  ),
				
				array(
					"name"  			=> __( 'Padding Top', 'frenify-core' ),
					"desc"  			=> __( 'Padding top for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "75",
				),
				array(
					"name"  			=> __( 'Padding Bottom', 'frenify-core' ),
					"desc"  			=> __( 'Padding bottom for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "75",
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