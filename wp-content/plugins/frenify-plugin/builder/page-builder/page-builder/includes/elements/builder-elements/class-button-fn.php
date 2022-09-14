<?php
/**
 * ButtonFn element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ButtonFn extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'button_fn';
			// element name
			$this->config['name']	 		= esc_html__('Main Button', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "button.jpg";
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
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_mainbutton">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.esc_html__('Main Button', 'frenify-core').'</sub>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
					  
				array("name" 			=> esc_html__('Button\'s Text', 'frenify-core'),
					  "desc"			=> esc_html__('Add the text that will display on button.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btntext",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Button Text" 
					  ),
				
				array("name" 			=> esc_html__('Button\'s URL ', 'frenify-core'),
					  "desc"			=> esc_html__('Add the button\'s url. Eg: http://example.com', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnurl",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Button Target', 'frenify-core'),
					  "desc"			=> esc_html__('_self = open in same window. _blank = open in new window.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btntarget",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_blank",
					  "allowedValues" 	=> array(
												'_self' 		=>'_self',
											   	'_blank' 		=>'_blank') 
					 ),
				
				array("name" 			=> esc_html__('Button Type', 'frenify-core'),
					  "desc" 			=> esc_html__('Select the button\'s type.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btntype",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(
												''	   			=> esc_html__('With Arrow', 'frenify-core'),
												'simple' 		=> esc_html__('Only Text', 'frenify-core'),) 
					 ),
				
				array("name" 			=> esc_html__('Button Background Type', 'frenify-core'),
					  "desc" 			=> esc_html__('Select the button\'s background type.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnbgtype",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "color",
					  "allowedValues" 	=> array(
												'none'	   			=> esc_html__('No Background', 'frenify-core'),
												'color'	   			=> esc_html__('Color', 'frenify-core'),
												'gradient' 			=> esc_html__('Gradient', 'frenify-core'),) 
					 ),
				
				array("name" 			=> esc_html__('Button Size', 'frenify-core'),
					  "desc" 			=> esc_html__('Select the button\'s size.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnsize",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "medium",
					  "allowedValues" 	=> array(
												'small' 		=> esc_html__('Small', 'frenify-core'),
											   	'medium' 		=> esc_html__('Medium', 'frenify-core'),
											   	'large' 		=> esc_html__('Large', 'frenify-core'),) 
					 ),
				
				array("name" 			=> esc_html__('Button Hover Animation Enable / Disable', 'frenify-core'),
					  "desc" 			=> '',
					  "id" 				=> "fotofly_fn_btnhoveranim",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "enable",
					  "allowedValues" 	=> array(
											   	'enable' 		=> esc_html__('Enable', 'frenify-core'),
											   	'disable' 		=> esc_html__('Disable', 'frenify-core'),) 
					 ),
				
				array("name" 			=> esc_html__('Gradient Direction', 'frenify-core'),
					  "desc" 			=> esc_html__('Select the button\'s gradient direction.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btngrddir",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "toptobottom",
					  "allowedValues" 	=> array(
											   	'toptobottom' 		=> esc_html__('Top To Bottom', 'frenify-core'),
											   	'lefttoright' 		=> esc_html__('Left To Right', 'frenify-core'),
											   	'diagonal' 			=> esc_html__('Diagonal', 'frenify-core'),
											   	'angle' 			=> esc_html__('Angle Effect', 'frenify-core'),) 
					 ),
				
				array("name" 			=> esc_html__('Border Radius for the Button', 'frenify-core'),
					  "desc"			=> esc_html__('Set the border radius of the Button in px or %.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnborrad",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "3px" 
					  ),
				
				array("name" 			=> esc_html__('Button\'s alignment', 'frenify-core'),
					  "desc" 			=> esc_html__('Select the button\'s alignment.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnalign",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array(
											   	'left' 				=> esc_html__('Left', 'frenify-core'),
											   	'center' 			=> esc_html__('Center', 'frenify-core'),
											   	'right' 			=> esc_html__('Right', 'frenify-core'),) 
					 ),
				
				array("name" 			=> esc_html__('Button\'s Text Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the color of the button text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btntextcol",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#111"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Background Color', 'frenify-core'),
					  "desc" 			=> esc_html__('This Color will be used for browsers that do not support gradients.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnbgcol",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#f5f5f5"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Border Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the color of the button border.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnborcol",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> esc_html__('Button\'s Gradient Start Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the color of the button gradient start.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btngradstartcol",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#eb1010"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Gradient End Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the color of the button gradient end.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btngradendcol",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#652d9e"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Arrow Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the color of the button arrow.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnarrcol",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#111"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Text Hover Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the hover color of the button text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btntextcol_hover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Background Hover Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the hover color of the button background.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnbgcol_hover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#111"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Border Hover Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the hover color of the button border.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnborcol_hover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> esc_html__('Button\'s Gradient Start Hover Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the hover color of the button gradient start.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btngradstartcol_hover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#1f6dd3"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Gradient End Hover Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the hover color of the button gradient end.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btngradendcol_hover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#eb1010"
					  ),
				
				array("name" 			=> esc_html__('Button\'s Arrow Hover Color', 'frenify-core'),
					  "desc" 			=> esc_html__('Set the hover color of the button arrow.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btnarrcol_hover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "#fff"
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