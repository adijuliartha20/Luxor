<?php
/**
 * Button element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ButtonBlock extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'button_block';
			// element name
			$this->config['name']	 		= __('Button', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-check-empty';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Button';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_button">';
			$innerHtml .= '<div class="bilder_icon_container"> <a title="" target="_self" class="button orange" style="selector:attrib"><span class="frenify-button-text">Button Text</span></a> </div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$choices					= frenifyHelper::get_shortcode_choices();
			$leftright					= frenifyHelper::get_left_right_data();
			$animation_speed 			= frenifyHelper::get_animation_speed_data();
			$animation_direction 		= frenifyHelper::get_animation_direction_data();
			$animation_type 			= frenifyHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Button URL', 'frenify-core'),
					  "desc" 			=> __('Add the button\'s url ex: http://example.com', 'frenify-core'),
					  "id" 				=> "fotofly_fn_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Button Style', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "default",
					  "allowedValues" 	=> array('default' 			=> __('Default', 'frenify-core'),
					  						   'custom'			=> __('Custom', 'frenify-core'),
											   'green' 			=> __('Green', 'frenify-core'),
											   'darkgreen' 		=> __('Dark Green', 'frenify-core'),
											   'orange' 		=> __('Orange', 'frenify-core'),
											   'blue'			=> __('Blue', 'frenify-core'),
											   'red' 			=> __('Red', 'frenify-core'),
											   'pink' 			=> __('Pink', 'frenify-core'),
											   'darkgray' 		=> __('Dark Gray', 'frenify-core'),
											   'lightgray' 		=> __('Light Gray', 'frenify-core')) 
					 ),
					 
				array("name" 			=> __('Button Size', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s size. Choose default for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_size",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'frenify-core'),
						'small' 		=> __('Small', 'frenify-core'),
											   'medium' 		=> __('Medium', 'frenify-core'),
											   'large' 			=> __('Large', 'frenify-core'),
												'xlarge' 		=> __('XLarge', 'frenify-core'),) 
					 ),
					 
				array("name" 			=> __('Button Type', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s type. Choose default for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'frenify-core'),
						'flat' 		=>__('Flat', 'frenify-core'),
											   '3d' 			=>'3D') 
					 ),
					 
				array("name" 			=> __('Button Shape', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s shape. Choose default for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_shape",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''	   => __('Default', 'frenify-core'),
						'square' 		=> __('Square', 'frenify-core'),
												'pill' 			=> __('Pill', 'frenify-core'),
												'round' 		=> __('Round', 'frenify-core')) 
					 ),
					 
				array("name" 			=> __('Button Target', 'frenify-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'frenify-core'),
					  "id" 				=> "fotofly_fn_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array('_self' 		=>'_self',
											   '_blank' 		=>'_blank')
					 ),
					 
				array("name" 			=> __('Button Title attribute', 'frenify-core'),
					  "desc" 			=> __('Set a title attribute for the button link.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  	 
				array("name" 			=> __('Button\'s Text', 'frenify-core'),
					  "desc" 			=> __('Add the text that will display on button', 'frenify-core'),
					  "id" 				=> "fotofly_fn_content",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> "Button Text"
					  ),
				
				array("name" 			=> __('Button Gradient Top Color', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Set the top color of the button background.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_gradtopcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Bottom Color', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_gradbottomcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Top Color Hover', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Set the top hover color of the button background.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_gradtopcolorhover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Button Gradient Bottom Color Hover', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_gradbottomcolorhover",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Accent Color', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. This option controls the color of the button border, divider, text and icon.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Accent Hover Color', 'frenify-core'),
					  "desc" 			=> __('Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_borderhovercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Bevel Color (3D Mode only)', 'frenify-core'),
					  "desc" 			=> __('Custom setting. Set the bevel color of 3D buttons.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bevelcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Width', 'frenify-core'),
					  "desc"			=> __('Custom setting only. In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					 
				array("name" 			=> __('Select Custom Icon', 'frenify-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'frenify-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> frenifyHelper::GET_ICONS_LIST()
					  ),
					  
				
				array("name" 			=> __('Icon Position', 'frenify-core'),
					  "desc" 			=> __('Choose the position of the icon on the button.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_iconposition",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $leftright
					 ),
					 
				array("name" 			=> __('Icon Divider', 'frenify-core'),
					  "desc" 			=> __('Choose to display a divider between icon and text.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_icondivider",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $choices
					 ),
					 
				array("name" 			=> __('Modal Window Anchor', 'frenify-core'),
					  "desc"			=> __('Add the class name of the modal window you want to open on button click.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_modal",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
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
					  "allowedValues" 	=> $animation_speed 
					  ),

		  array("name"	  => __('Alignment', 'frenify-core'),
					  "desc"	  => __('Select the button\'s alignment.', 'frenify-core'),
					  "id"		=> "fotofly_fn_alignment",
					  "type"	  => ElementTypeEnum::SELECT,
			"value"	   => "",
					  "allowedValues"   => array(''	  => __('Default', 'frenify-core'),
						   'left'	 => __('Left', 'frenify-core'),
											   'center'	  => __('Center', 'frenify-core'),
						 'right'	=> __('Right', 'frenify-core')) 
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