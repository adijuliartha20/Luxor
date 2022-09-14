<?php
/**
 * CallToAction element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_CallToActionClassic extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'call_to_action_classic_fn';
			// element name
			$this->config['name']	 		= __('Call To Action Classic', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "call_to_action_classic.jpg";
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
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Call To Action Modern', 'frenify-core').'</sub>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
					  
				array("name" 			=> __('Title', 'frenify-core'),
					  "desc"			=> __('Insert the title.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Subtitle', 'frenify-core'),
					  "desc"			=> __('Insert the subtitle.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_subtitle",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link text', 'frenify-core'),
					  "desc"			=> __('Insert the link text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linktext",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link Url', 'frenify-core'),
					  "desc"			=> __('Insert link URL.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link_url",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "#" 
					  ),
				
				array("name" 			=> __('Border Radius for the Link', 'frenify-core'),
					  "desc"			=> __('Insert the border radius in px or %.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linkborrad",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Link Target', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_link_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_blank",
					  "allowedValues" 	=> array('_blank' 			=> __('_blank', 'frenify-core'),
												 '_parent' 			=> __('_parent', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Title Color', 'frenify-core'),
					  "desc"			=> __('Choose a color of title.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_titlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff" 
					  ),
				
				array("name" 			=> __('Subtitle Color', 'frenify-core'),
					  "desc"			=> __('Choose a color of subtitle.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_subtitlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff" 
					  ),
				
				array("name" 			=> __('Link Color', 'frenify-core'),
					  "desc"			=> __('Choose a color of link.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linkcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff" 
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