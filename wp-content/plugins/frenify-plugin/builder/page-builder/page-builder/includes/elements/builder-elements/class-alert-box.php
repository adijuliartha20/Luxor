<?php
/**
 * Alert Box implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_AlertBox extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   	= 'alert_box';
			// element name
			$this->config['name']	 	= __('Alert', 'frenify-core');
			// element icon
			$this->config['icon_url']  	= "icons/sc-notification.png";
			// css class related to this element
			$this->config['css_class'] 	= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']	= 'frenify-icon builder-options-icon frenifya-exclamation-sign';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates an Alert Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_alert">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-exclamation-sign"></i><sub class="sub">'.__('Preview text will go here and custom icon choice', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$animation_speed 		= frenifyHelper::get_animation_speed_data();
			$animation_direction 	= frenifyHelper::get_animation_direction_data();
			$animation_type 		= frenifyHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Alert Type', 'frenify-core'),
					  "desc" 			=> __('Select the type of alert message. Choose custom for advanced color options below.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "general",
					  "allowedValues" 	=> array('general' 	=>__('General', 'frenify-core'),
											   'error' 		=>__('Error', 'frenify-core'),
											   'success' 	=> __('Success', 'frenify-core'),
											   'notice' 	=> __('Notice', 'frenify-core'),
											   'custom' 	=> __('Custom', 'frenify-core'),)
					  ),
				
				array("name" 			=> __('Accent Color', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Set the border, text and icon color for custom alert boxes.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_accentcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Background Color', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Set the background color for custom alert boxes.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Width', 'frenify-core'),
					  "desc"			=> __('Custom setting. For custom alert boxes. In pixels (px), ex: 1px.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Select Custom Icon', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Click an icon to select, click again to deselect', 'frenify-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> frenifyHelper::GET_ICONS_LIST()
					  ),

		array("name"	  => __('Box Shadow', 'frenify-core'),
			"desc"	  => __('Display a box shadow below the alert box.', 'frenify-core'),
					  "id"		=> "fotofly_fn_boxshadow",
					  "type"	  => ElementTypeEnum::SELECT,
					  "value"	   => "yes",
			"allowedValues"   => array('yes'	=> __('Yes', 'frenify-core'),
											   'no'	 => __('No', 'frenify-core'),)
		   ),
											   
				array("name" 			=> __('Alert Content', 'frenify-core'),
					  "desc" 			=> __('Insert the alert\'s content', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> __('Your Content Goes Here', 'frenify-core')
					  ),
					  
				array("name" 			=> __('Animation Type', 'frenify-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'frenify-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'frenify-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "" ,
					  "allowedValues"	=> $animation_speed
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