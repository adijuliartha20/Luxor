<?php
/**
 * ContentBoxes implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ContentBoxes extends DDElementTemplate {
		public function __construct( $am_elements = array() ) {
			parent::__construct($am_elements);
		} 

		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'content_boxes';
			// element name
			$this->config['name']	 		= __('Content Boxes', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-newspaper';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Content Boxes';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_content_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-newspaper"></i><sub class="sub">'.__('Content Boxes', 'frenify-core').'</sub><p>layout = <span class="content_boxes_layout">icon-on-side</span> <br /> columns = <font class="content_boxes_columns">5</font></p></span></div>';
			$innerHtml .= '</div>';

			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements( $am_elements ) {
			
			$no_of_columns 						= frenifyHelper::fotofly_fn_create_dropdown_data(1,6);
			$reverse_choices					= frenifyHelper::get_reversed_choice_data();
			$animation_speed 					= frenifyHelper::get_animation_speed_data();
			$animation_direction 				= frenifyHelper::get_animation_direction_data();
			$animation_type 					= frenifyHelper::get_animation_type_data();
			$animation_speed_parent 			= frenifyHelper::get_animation_speed_data( true );
			$animation_direction_parent 		= frenifyHelper::get_animation_direction_data( true );
			$animation_type_parent 				= frenifyHelper::get_animation_type_data( true );

	  $am_array = array();

	  $am_array[] = array ( 
							array( "name"	 => __('Title', 'frenify-core'),
										"desc"		=> __('The box title.', 'frenify-core'),
										"id"		=> "fotofly_fn_title[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
							),
						  array( "name"	 => __('Icon', 'frenify-core'),
										"desc"		=> __('Click an icon to select, click again to deselect', 'frenify-core'),
										"id"		=> "icon[0]",
										"type"		=> ElementTypeEnum::ICON_BOX,
										"value"	   => array() ,
						  "list"		=> frenifyHelper::GET_ICONS_LIST()
							),
						  
						  array("name"	=> __('Content Box Background Color', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_backgroundcolor[0]",
									  "type"		=> ElementTypeEnum::COLOR,
									  "value"	   => array (),
									  "settings_lvl" => "child"
							),
						  array("name"	=> __('Icon Color', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_iconcolor[0]",
									  "type"		=> ElementTypeEnum::COLOR,
									   "settings_lvl" => "child",
									  "value"	   => array ()
							),
						  array("name"	=> __('Icon Background Color', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_circlecolor[0]",
									  "type"		=> ElementTypeEnum::COLOR,
									  "settings_lvl" => "child",
									  "value"	   => array ()
							),
						  array("name"	=> __('Icon Background Inner Border Color', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_circlebordercolor[0]",
									  "type"		=> ElementTypeEnum::COLOR,
									  "settings_lvl" => "child",
									  "value"	   => array ('')
							),
						  array("name"	=> __('Icon Background Inner Border Size', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_circlebordercolorsize[0]",
									  "type"		=> ElementTypeEnum::INPUT,
									  "settings_lvl" => "child",
									  "value"	   => array ('')
							),
						  array("name"	=> __('Icon Background Outer Border Color', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_outercirclebordercolor[0]",
									  "type"		=> ElementTypeEnum::COLOR,
									  "settings_lvl" => "child",
									  "value"	   => array ('')
							),
						  array("name"	=> __('Icon Background Outer Border Size', 'frenify-core'),
									  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
									  "id"		=> "fotofly_fn_outercirclebordersize[0]",
									  "type"		=> ElementTypeEnum::INPUT,
									  "settings_lvl" => "child",
									  "value"	   => array ('')
							),
						  array("name"	=> __('Rotate Icon', 'frenify-core'),
									  "desc"		=> __('Choose to rotate the icon.', 'frenify-core'),
									  "id"		=> "fotofly_fn_iconrotate[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array(""),
									  "allowedValues"   => array(''	   =>'None',
																 '90'	   =>'90',
										 '180'	  =>'180',
										 '270'	  => '270') 
						  ),
						  array("name"	=> __('Spinning Icon', 'frenify-core'),
									  "desc"		=> __('Choose to let the icon spin.', 'frenify-core'),
									  "id"		=> "fotofly_fn_iconspin[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array(""),
									  "allowedValues"   => $reverse_choices 
						  ),
						  array("name"	=> __('Icon Image', 'frenify-core'),
									  "desc"		=> __('To upload your own icon image, deselect the icon above and then upload your icon image', 'frenify-core'),
									  "id"		=> "fotofly_fn_image[0]",
									  "type"		=> ElementTypeEnum::UPLOAD,
							"upid"		=> array(1),
									  "value"	   => array()
							),
						  array( "name"	 => __('Icon Image Width', 'frenify-core'),
										"desc"		=> __('If using an icon image, specify the image width in pixels but do not add px, ex: 35', 'frenify-core'),
										"id"		=> "fotofly_fn_image_width[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array(35) 
							),
						  array( "name"	 => __('Icon Image Height', 'frenify-core'),
										"desc"		=> __('If using an icon image, specify the image height in pixels but do not add px, ex: 35', 'frenify-core'),
										"id"		=> "fotofly_fn_image_height[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array(35) 
							),
						  array( "name"	 => __('Link URL' , 'frenify-core'),
										"desc"		=> __('Add the link\'s url ex: http://example.com', 'frenify-core'),
										"id"		=> "fotofly_fn_link[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
							),
						  array( "name"	 => __('Link Text', 'frenify-core'),
										"desc"		=> __('Insert the text to display as the link', 'frenify-core'),
										"id"		=> "fotofly_fn_linktext[0]",
										"type"		=> ElementTypeEnum::INPUT,
										"value"	   => array() 
							),
						  array("name"	=> __('Link Target', 'frenify-core'),
									  "desc"		=> __('_self = open in same window<br>_blank = open in new window', 'frenify-core'),
									  "id"		=> "fotofly_fn_target[0]",
									  "type"		=> ElementTypeEnum::SELECT,
							"value"	   => array("_self"),
									  "allowedValues"   => array('_self'	=>'_self',
																 '_blank'	 =>'_blank') 
						  ),
						  array( "name"	 => __('Content Box Content', 'frenify-core'),
										"desc"		=> __('Add content for content box', 'frenify-core'),
										"id"		=> "fotofly_fn_content_wp[0]",
										"type"		=> ElementTypeEnum::HTML_EDITOR,
										"value"	   => array() 
							),
						array("name"			=> __( 'Animation Type', 'frenify-core' ),
							"desc"				=> __( 'Select the type on animation to use on the shortcode', 'frenify-core' ),
							"id"				=> "fotofly_fn_animation_type[0]",
							"type"				=> ElementTypeEnum::SELECT,
							"settings_lvl" => "child",
							"value"	  			=> array(),
							"allowedValues"		=> $animation_type_parent
						),
		
						array("name"			=> __( 'Direction of Animation', 'frenify-core' ),
							"desc"				=> __( 'Select the incoming direction for the animation', 'frenify-core' ),
							"id"				=> "fotofly_fn_animation_direction[0]",
							"type"				=> ElementTypeEnum::SELECT,
							"settings_lvl" => "child",
							"value"	   			=> array(),
							"allowedValues"   	=> $animation_direction_parent
						),
				
						array("name"			=> __( 'Speed of Animation', 'frenify-core' ),
							"desc"				=> __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
							"id"				=> "fotofly_fn_animation_speed[0]",
							"type"				=> ElementTypeEnum::SELECT,
							"settings_lvl" => "child",
							"value"	   			=> array(),
							"allowedValues"  	=> $animation_speed_parent
						),

					  );
			
			$this->config['defaults'] = $am_array[0];

			if($am_elements) {
			  $am_array_copy = $am_array[0];
			  $am_array = array();
			  foreach($am_elements as $key => $am_element) {
				$build_am = $am_array_copy;
				foreach($build_am as $build_am_key => $build_am_element) {
				  $build_am[$build_am_key]['value'] = $am_elements[$key][$build_am_key];
				  $build_am[$build_am_key]['id'] = str_replace('[0]', '[' . $key . ']', $build_am_element['id']);
				}
				$am_array[] = $build_am;
			  }
			}

			$this->config['subElements'] = array(
				array("name" 			=> __('Parent / Child Settings', 'frenify-core'),
					  "desc" 			=> __('"Parent Level" settings will control all box styles together. "Child Level" settings will control each box style individually.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_settings_lvl",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "child",
					  "allowedValues" 	=> array('parent' => 'Parent Level Settings', 'child' => 'Child Level Settings') 
					  ),
				array("name" 			=> __('Content Box Layout', 'frenify-core'),
					  "desc" 			=> __('Select the layout for the content box', 'frenify-core'),
					  "id" 				=> "fotofly_fn_layout",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "icon-with-title",
					  "allowedValues" 	=> array('icon-with-title' 	 	=> __('Classic Icon With Title', 'frenify-core'),
												 'icon-on-top' 		 	=> __('Classic Icon On Top', 'frenify-core'),
												 'icon-on-side' 	 	=> __('Classic Icon On Side', 'frenify-core'),
												 'icon-boxed' 		=> __('Classic Icon Boxed', 'frenify-core'),
												 'clean-vertical' 	 	=> __('Clean Layout Vertical', 'frenify-core'),
												 'clean-horizontal'  	=> __('Clean Layout Horizontal', 'frenify-core'),
												 'timeline-vertical' 	=> __('Timeline Vertical', 'frenify-core'),
												 'timeline-horizontal'  => __('Timeline Horizontal', 'frenify-core')) 
					  ),
				array("name" 			=> __('Number of Columns', 'frenify-core'),
					  "desc" 			=> __('Set the number of columns per row.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_columns",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "4",
					  "allowedValues" 	=> $no_of_columns 
					  ),
				array("name"			=> __('Content Alignment', 'frenify-core'),
				"desc"					=> __('Works with "Classic Icon With Title" and "Classic Icon On Side" layout options.', 'frenify-core'),
				"id"					=> "fotofly_fn_circle_align",
				"type"					=> ElementTypeEnum::SELECT,
				"value"	   				=> array("left"),
				"allowedValues"   		=> array('left'		=> 'Left',
												'right'	 	=> 'Right') 
						 ),
				array("name"			=> __('Title Size', 'frenify-core'),
					  "desc"			=> __('Controls the size of the title. Leave blank for theme option selection. In pixels ex: 18px.', 'frenify-core'),
					  "id"				=> "fotofly_fn_title_size",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value"	   		=> ''
						),
				array("name"			=> __('Title Font Color', 'frenify-core'),
					  "desc"			=> __('Controls the color of the title font. Leave blank for theme option selection. ex: #000', 'frenify-core'),
					  "id"				=> "fotofly_fn_title_color",
					  "type"			=> ElementTypeEnum::COLOR,
					  "value"	   		=> ''
						),
				array("name"			=> __('Body Font Color', 'frenify-core'),
					  "desc"			=> __('Controls the color of the body font. Leave blank for theme option selection. ex: #000', 'frenify-core'),
					  "id"				=> "fotofly_fn_body_color",
					  "type"			=> ElementTypeEnum::COLOR,
					  "value"	   		=> ''
						),
				array("name"	=> __('Content Box Background Color', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_backgroundcolor",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => ''
					),
				array("name"			=> __('Icon Background', 'frenify-core'),
				"desc"					=> __('Choose to show a background behind the icon. Select default for theme option selection.', 'frenify-core'),
				"id"					=> "fotofly_fn_icon_circle",
				"type"					=> ElementTypeEnum::SELECT,
				"value"	   				=> '',
				"allowedValues"   		=> array(''		=> 'Default',
												'yes'	 	=> 'Yes', 'no' => 'No') 
						 ),
				array("name" 			=> __('Icon Background Radius', 'frenify-core'),
					  "desc"			=> __('Choose the border radius of the icon background. Leave blank for theme option selection. In pixels (px), ex: 1px, or "round".', 'frenify-core'),
					  "id" 				=> "fotofly_fn_icon_circle_radius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				array("name"	=> __('Icon Color', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_iconcolor",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => ''
					),
				array("name"	=> __('Icon Background Color', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_circlecolor",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => ''
					),
				array("name"	=> __('Icon Background Inner Border Color', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_circlebordercolor",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => ''
					),
				array("name"	=> __('Icon Background Inner Border Size', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_circlebordercolorsize",
							  "type"		=> ElementTypeEnum::INPUT,
							  "value"	   => ''
					),
				array("name"	=> __('Icon Background Outer Border Color', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_outercirclebordercolor",
							  "type"		=> ElementTypeEnum::COLOR,
							  "value"	   => ''
					),
				array("name"	=> __('Icon Background Outer Border Size', 'frenify-core'),
							  "desc"		=> __('Leave blank for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_outercirclebordersize",
							  "type"		=> ElementTypeEnum::INPUT,
							  "value"	   => ''
					),
				array("name"			=> __('Icon Size', 'frenify-core'),
					  "desc"			=> __('Controls the size of the icon.  Leave blank for theme option selection. In pixels ex: 18px.', 'frenify-core'),
					  "id"				=> "fotofly_fn_icon_size",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value"	   		=> ''
						),
				array("name"			=> __('Icon Hover Animation Type', 'frenify-core'),
				"desc"					=> __('Select the animation type for icon on hover. Select default for theme option selection.', 'frenify-core'),
				"id"					=> "fotofly_fn_icon_hover_type",
				"type"					=> ElementTypeEnum::SELECT,
				"value"	   				=> array(''),
				"allowedValues"   		=> array('' => __('Default', 'frenify'), 'fade' => __('Fade', 'frenify'), 'slide' => __('Slide', 'frenify'), 'pulsate' => __('Pulsate', 'frenify'))
						 ),
				array("name"			=> __('Link Type', 'frenify-core'),
				"desc"					=> __('Select the type of link that should show in the content box. Select default for theme option selection.', 'frenify-core'),
				"id"					=> "fotofly_fn_link_type",
				"type"					=> ElementTypeEnum::SELECT,
				"value"	   				=> array(''),
				"allowedValues"   		=> array('' => 'Default', 'text' => 'Text', 'button-bar' => 'Button Bar', 'button' => 'Button') 
						 ),
				array("name"			=> __('Link Area', 'frenify-core'),
					  "desc"			=> __('Select which area the link will be assigned to. Select default for theme option selection.', 'frenify-core'),
					  "id"				=> "fotofly_fn_link_area",
					  "type"			=> ElementTypeEnum::SELECT,
					  "value"	   		=> array(''),
					  "allowedValues"	=> array('' => 'Default', 'link-icon' => 'Link+Icon', 'box' => 'Entire Content Box')
						),
				array("name"	=> __('Link Target', 'frenify-core'),
							  "desc"		=> __('_self = open in same window<br>_blank = open in new window. Select default for theme option selection.', 'frenify-core'),
							  "id"		=> "fotofly_fn_target",
							  "type"		=> ElementTypeEnum::SELECT,
					"value"	   => array(''),
							  "allowedValues"   => array('' => 'Default', '_self'	=>'_self',
														 '_blank'	 =>'_blank') 
				  ),
				array(
					"name"  => __( 'Animation Delay', 'frenify-core' ),
					"desc"  => __( 'Controls the delay of animation between each element in a set. In milliseconds, 1000 = 1 second.', 'frenify-core' ),
					"id"    => "animation_delay",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array("name"			=> __( 'Animation Type', 'frenify-core' ),
					"desc"				=> __( 'Select the type on animation to use on the shortcode', 'frenify-core' ),
					"id"				=> "fotofly_fn_animation_type",
					"type"				=> ElementTypeEnum::SELECT,
					"value"	  			=> '',
					"allowedValues"		=> $animation_type
				),
				array("name"			=> __( 'Direction of Animation', 'frenify-core' ),
					"desc"				=> __( 'Select the incoming direction for the animation', 'frenify-core' ),
					"id"				=> "fotofly_fn_animation_direction",
					"type"				=> ElementTypeEnum::SELECT,
					"value"	   			=> array('left'),
					"allowedValues"   	=> $animation_direction
				),
				array("name"			=> __( 'Speed of Animation', 'frenify-core' ),
					"desc"				=> __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
					"id"				=> "fotofly_fn_animation_speed",
					"type"				=> ElementTypeEnum::SELECT,
					"value"	   			=> array('0.1'),
					"allowedValues"  	=> $animation_speed
				),
				array(
					"name"  => __( 'Margin Top', 'frenify-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'frenify-core' ),
					"id"    => "margin_top",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'Margin Bottom', 'frenify-core' ),
					"desc"  => __( 'In pixels (px), ex: 1px.', 'frenify-core' ),
					"id"    => "margin_bottom",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
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
					  
				array("type" 			=> ElementTypeEnum::ADDMORE,
					  "buttonText"		=> __('Add New Content Box', 'frenify-core'),
					  "id"				=> "am_fotofly_fn_content",
					  "elements" 		=> $am_array
					  ),
				);
		}
	}