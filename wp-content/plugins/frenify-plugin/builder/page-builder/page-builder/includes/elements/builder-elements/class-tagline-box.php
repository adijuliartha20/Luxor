<?php
/**
 * TaglineBox block implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_TaglineBox extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'tagline_box';
			// element name
			$this->config['name']	 		= __('Tagline Box', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-list-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Tagline Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_tagline_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-list-alt"></i><sub class="sub">'.__('Tagline Box', 'frenify-core').'</sub><p class="tagline_title">Tagline title text will go here...</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		//function to create shadow opacity data
		function create_shadow_opacity_data() {
			$opacity_data 	= array();
			$options 		= .1;
			while ($options < 1) {
				
				$opacity_data["fotofly_fn_".$options] = $options;
				$options				= $options + .1;
			}
			return $opacity_data;
		}
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= frenifyHelper::get_reversed_choice_data();
			$animation_speed 			= frenifyHelper::get_animation_speed_data();
			$animation_direction 		= frenifyHelper::get_animation_direction_data();
			$animation_type 			= frenifyHelper::get_animation_type_data();
			
			$opacity_data = $this->create_shadow_opacity_data();
			$this->config['subElements'] = array(
				array("name" 			=> __('Background Color', 'frenify-core'),
					  "desc" 			=> __('Controls the background color. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Shadow', 'frenify-core'),
					  "desc" 			=> __('Show the shadow below the box', 'frenify-core'),
					  "id" 				=> "fotofly_fn_shadow",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices
					  ),
					  
				array("name" 			=> __('Shadow Opacity', 'frenify-core'),
					  "desc" 			=> __('Choose the opacity of the shadow', 'frenify-core'),
					  "id" 				=> "fotofly_fn_shadowopacity",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.7",
					  "allowedValues" 	=> $opacity_data
					  ),
					  
				array("name" 			=> __('Border', 'frenify-core'),
					  "desc"			=> __('In pixels (px), ex: 1px', 'frenify-core'),
					  "id" 				=> "fotofly_fn_border",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Border Color', 'frenify-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Highlight Border Position', 'frenify-core'),
					  "desc" 			=> __('Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'frenify-core'),
					  "id" 				=> "fotofly_fn_highlightposition",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "top",
					  "allowedValues" 	=> array('top' 			=> __('Top', 'frenify-core'),
												'bottom' 		=> __('Bottom', 'frenify-core'),
												'left'			=> __('Left', 'frenify-core'),
												'right' 		=> __('Right', 'frenify-core'),
												'none'			=> __('None', 'frenify-core'))
					  ),
					  
				array("name" 			=> __('Content Alignment', 'frenify-core'),
					  "desc" 			=> __('Choose how the content should be displayed.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_contentalignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'frenify-core'),
												'center' 		=> __('Center', 'frenify-core'),
												'right'			=> __('Right', 'frenify-core'))
					  ),
					  
				array("name" 			=> __('Button Text', 'frenify-core'),
					  "desc" 			=> __('Insert the text that will display in the button', 'frenify-core'),
					  "id" 				=> "fotofly_fn_button",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Link', 'frenify-core'),
					  "desc" 			=> __('The url the button will link to', 'frenify-core'),
					  "id" 				=> "fotofly_fn_url",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Link Target', 'frenify-core'),
					  "desc" 			=> __('_self = open in same window<br>_blank = open in new window', 'frenify-core'),
					  "id" 				=> "fotofly_fn_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_self",
					  "allowedValues" 	=> array('_self' 		=>'_self',
											   '_blank' 		=>'_blank') 
					 ),

		array("name"	  => __('Modal Window Anchor', 'frenify-core'),
					  "desc"	  => __('Add the class name of the modal window you want to open on button click.', 'frenify-core'),
					  "id"		=> "fotofly_fn_modalanchor",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""),
					 
				array("name" 			=> __('Button Size', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s size.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_buttonsize",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'frenify-core'),
					  							'small' 		=>__('Small', 'frenify-core'),
											   'medium' 		=>__('Medium', 'frenify-core'),
											   'large' 			=> __('Large', 'frenify-core'),
											   'xlarge' 		=> __('XLarge', 'frenify-core')) 
					 ),
					 
				array("name" 			=> __('Button Type', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s type.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_buttontype",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'frenify-core'),
					  							'flat' 		=>__('Flat', 'frenify-core'),
											   '3D' 			=>'3D') 
					 ),
					 
				array("name" 			=> __('Button Shape', 'frenify-core'),
					  "desc" 			=> __('Select the button\'s shape.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_buttonshape",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array(''		=>__('Default', 'frenify-core'),
					  							'square' 		=> __('Square', 'frenify-core'),
											   'pill' 			=> __('Pill', 'frenify-core'),
											   'round' 			=> __('Round', 'frenify-core')) 
					 ),
					 
				array("name" 			=> __('Button Color', 'frenify-core'),
					  "desc" 			=> __('Choose the button color<br>Default uses theme option selection', 'frenify-core'),
					  "id" 				=> "fotofly_fn_buttoncolor",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=> __('Default', 'frenify-core'),
											   'green' 			=> __('Green', 'frenify-core'),
											   'darkgreen' 		=> __('Dark Green', 'frenify-core'),
											   'orange' 		=> __('Orange', 'frenify-core'),
											   'blue'			=> __('Blue', 'frenify-core'),
											   'red' 			=> __('Red', 'frenify-core'),
											   'pink' 			=> __('Pink', 'frenify-core'),
											   'darkgray' 		=> __('Dark Gray', 'frenify-core'),
											   'lightgray' 		=> __('Light Gray', 'frenify-core')) 
					 ),
					 
				array("name" 			=> __('Tagline Title', 'frenify-core'),
					  "desc"			=> __('Insert the title text', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Tagline Description', 'frenify-core'),
					  "desc"			=> __('Insert the description text', 'frenify-core'),
					  "id" 				=> "fotofly_fn_description",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> "" 
					  ),

				array("name" 			=> __('Additional Content', 'frenify-core'),
					  "desc"			=> __('This is additional content you can add to the tagline box. This will show below the title and description if one is used.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_additionalcontent",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Margin Top', 'frenify-core'),
					  "desc" 			=> __('Add a custom top margin. In pixels.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_margin_top",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),
					  
				array("name" 			=> __('Margin Bottom', 'frenify-core'),
					  "desc" 			=> __('Add a custom bottom margin. In pixels.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_margin_bottom",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""),						  
					  
				array("name" 			=> __('Animation Type', 'frenify-core'),
					  "desc" 			=> __('Select the type on animation to use on the shortcode', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'frenify-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'frenify-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_speed",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0.1",
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