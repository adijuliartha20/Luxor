<?php
/**
 * FontAwesome implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_FontAwesome extends DDElementTemplate {
		
		public function __construct() {
			 
			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 	= get_class($this);
			// element id
			$this->config['id']	   	= 'font_awesome';
			// element name
			$this->config['name']	 	= __('Font Awesome', 'frenify-core');
			// element icon
			$this->config['icon_url']  	= "icons/sc-icon_box.png";
			// css class related to this element
			$this->config['css_class'] 	= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']	= 'frenify-icon builder-options-icon frenifya-flag';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  	= 'Creates Font Awesome Elements';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 		= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_font_awesome">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><h3 style="selector:hattrib"><i class="frenifya-flag" style="selector:iattrib"></i></h3></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$animation_speed 			= frenifyHelper::get_animation_speed_data();
			$animation_direction 		= frenifyHelper::get_animation_direction_data();
			$animation_type 			= frenifyHelper::get_animation_type_data();
			$choices					= frenifyHelper::get_shortcode_choices();
			$reverse_choices			= frenifyHelper::get_reversed_choice_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Select Icon', 'frenify-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect.', 'frenify-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "fa-flag",
					  "list"			=> frenifyHelper::GET_ICONS_LIST()
					  ),
				
				array("name" 			=> __('Icon in Circle', 'frenify-core'),
					  "desc" 			=> __('Choose to display the icon in a circle', 'frenify-core'),
					  "id" 				=> "fotofly_fn_circle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> $choices 
					  ),
				
				array("name" 			=> __('Icon Size', 'frenify-core'),
					  "desc" 			=> __('Set the size of the icon. In pixels (px), ex: 13px.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Icon Color', 'frenify-core'),
					  "desc" 			=> __('Controls the color of the icon. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_iconcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Icon Circle Background Color', 'frenify-core'),
					  "desc" 			=> __('Controls the color of the circle. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_circlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Icon Circle Border Color', 'frenify-core'),
					  "desc" 			=> __('Controls the color of the circle border. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "circlebordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Rotate Icon', 'frenify-core'),
					  "desc" 			=> __('Choose to rotate the icon.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_rotate",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=>'None',
											   '90' 			=>'90',
											   '180' 			=> '180',
											   '270'			=> '270')
					  ),
					  
				array("name" 			=> __('Spinning Icon', 'frenify-core'),
					  "desc" 			=> __('Choose to let the icon spin.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_spin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Animation Type', 'frenify-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0",
					  "allowedValues" 	=> $animation_type 
					 ),
				
				array("name" 			=> __('Direction of Animation', 'frenify-core'),
					  "desc" 			=> __('Select the incoming direction for the animation', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> '',
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'frenify-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1)', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues"	=> $animation_speed 
					  ),

			    array("name"	  	=> __('Alignment', 'frenify-core'),
					  "desc"	  	=> __('Select the icon\'s alignment.', 'frenify-core'),
					  "id"			=> "fotofly_fn_alignment",
					  "type"	  	=> ElementTypeEnum::SELECT,
					  "value"	   	=> "",
					  "allowedValues"   => array(
							''	  		=> __('Default', 'frenify-core'),
							'left'	 	=> __('Left', 'frenify-core'),
							'center'	=> __('Center', 'frenify-core'),
							'right'		=> __('Right', 'frenify-core')) 
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