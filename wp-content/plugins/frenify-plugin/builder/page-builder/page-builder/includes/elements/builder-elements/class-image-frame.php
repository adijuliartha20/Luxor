<?php
/**
 * ImageFrame implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_ImageFrame extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'image_frame';
			// element name
			$this->config['name']	 		= __('Image Frame', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-image';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates an Image Frame';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_image_frame">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-image"></i><sub class="sub">'.__('Image Frame', 'frenify-core').'</sub><div class="img_frame_section">Image here</div></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$border_size 				= frenifyHelper::fotofly_fn_create_dropdown_data( 0, 10 );
			$reverse_choices			= frenifyHelper::get_reversed_choice_data();
			$animation_speed 			= frenifyHelper::get_animation_speed_data();
			$animation_direction 		= frenifyHelper::get_animation_direction_data();
			$animation_type 			= frenifyHelper::get_animation_type_data();
			
			$this->config['subElements'] = array(
				array("name" 			=> __('Frame Style Type', 'frenify-core'),
					  "desc" 			=> __('Select the frame style type.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'frenify-core'),
												 'glow' 			=> __('Glow', 'frenify-core'),
												 'dropshadow' 		=> __('Drop Shadow', 'frenify-core'),
												 'bottomshadow' 	=> __('Bottom Shadow', 'frenify-core')) 
					  ),

				array("name" 			=> __('Hover Type', 'frenify-core'),
					  "desc" 			=> __('Select the hover effect type.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_hover_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none' 			=> __('None', 'frenify-core'),
												 'zoomin' 			=> __('Zoom In', 'frenify-core'),
												 'zoomout' 			=> __('Zoom Out', 'frenify-core'),
												 'liftup' 			=> __('Lift Up', 'frenify-core')) 
					  ),
					  
				array("name" 			=> __('Border Color', 'frenify-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border Size', 'frenify-core'),
					  "desc" 			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordersize",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0px",
					  ),

				array("name" 			=> __('Border Radius', 'frenify-core'),
					  "desc"			=> __('Choose the radius of the image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_borderradius",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0" 
					  ),						  
					  
				array("name" 			=> __('Style Color', 'frenify-core'),
					  "desc" 			=> __('For all style types except border. Controls the style color. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_stylecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Align', 'frenify-core'),
					  "desc" 			=> __('Choose how to align the image.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_align",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array('none'				=> __('None', 'frenify-core'),
					  							'left' 				=> __('Left', 'frenify-core'),
												 'right' 			=> __('Right', 'frenify-core'),
												 'center' 			=> __('Center', 'frenify-core')) 
					  ),
					  
				array("name" 			=> __('Image lightbox', 'frenify-core'),
					  "desc" 			=> __('Show image in Lightbox.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Lightbox Image', 'frenify-core'),
					  "desc" 			=> __('Upload an image that will show up in the lightbox.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_lightboximage",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "2",
					  "value" 			=> ""
					  ),						  
					  
				array("name" 			=> __('Image', 'frenify-core'),
					  "desc" 			=> __('Upload an image to display in the frame.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "1",
					  "value" 			=> ""
					  ),				  
					  
				array("name" 			=> __('Image Alt Text', 'frenify-core'),
					  "desc"			=> __('The alt attribute provides alternative information if an image cannot be viewed.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_alt",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Picture Link URL', 'frenify-core'),
					  "desc"			=> __('Add the URL the picture will link to, ex: http://example.com.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_link",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),

				array("name"	  		=> __('Link Target', 'frenify-core'),
					  "desc"	  		=> __('_self = open in same window<br>_blank = open in new window.', 'frenify-core'),
					  "id"				=> "fotofly_fn_target",
					  "type"	  		=> ElementTypeEnum::SELECT,
					  "value"	   		=> "_self",
					  "allowedValues"   => array('_self'	=>'_self',
											   '_blank'	 =>'_blank') 
		   			  ),					  
				
				array("name" 			=> __('Animation Type', 'frenify-core'),
					  "desc" 			=> __('Select the type of animation to use on the shortcode.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0",
					  "allowedValues" 	=> $animation_type
					 ),
				
				array("name" 			=> __('Direction of Animation', 'frenify-core'),
					  "desc" 			=> __('Select the incoming direction for the animation.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_direction",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $animation_direction 
					 ),
				
				array("name" 			=> __('Speed of Animation', 'frenify-core'),
					  "desc"			=> __('Type in speed of animation in seconds (0.1 - 1).', 'frenify-core'),
					  "id" 				=> "fotofly_fn_animation_speed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "0.1" ,
					  "allowedValues"	=> $animation_speed
					  ),
				array(
					"name"          => __( 'Hide on Mobile', 'frenify-core' ),
					"desc"          => __( 'Select yes to hide full width container on mobile.', 'frenify-core' ),
					"id"            => "hide_on_mobile",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'no'  => __( 'No', 'frenify-core' ),
						'yes' => __( 'Yes', 'frenify-core' ),
					)
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