<?php
/**
 * AboutMe element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_AboutMe extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'about_me_fn';
			// element name
			$this->config['name']	 		= __('About Me', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "about_me.jpg";
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
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_about_me">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('About Me', 'frenify-core').'</sub><div class="img_frame_section">Image here</div><p class="about_me_name">John Doe</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
					 
				array("name" 			=> __('Skin', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array('light' 			=> __('Light', 'frenify-core'),
												 'dark' 			=> __('Dark', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Image Position', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_img_pos",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "left",
					  "allowedValues" 	=> array('left' 			=> __('Left', 'frenify-core'),
												 'right' 			=> __('Right', 'frenify-core')) 
					  ),
				
				array("name" 			=> __('Picture', 'frenify-core'),
					  "desc" 			=> __('Upload an image to display.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_picture",
					  "upid" 			=> "1",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Name', 'frenify-core'),
					  "desc"			=> __('Insert the name.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_name",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Occupation', 'frenify-core'),
					  "desc"			=> __('Insert the occupation', 'frenify-core'),
					  "id" 				=> "fotofly_fn_occ",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					 
				array("name" 			=> __('Info Title', 'frenify-core'),
					  "desc"			=> __('Insert the title of the second half content.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_info_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Info Content', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_content_wp",
					  "type" 			=> ElementTypeEnum::HTML_EDITOR,
					  "value" 			=> "" 
					  ),
					  	  
				array("name" 			=> __('Button Text', 'frenify-core'),
					  "desc"			=> __('Insert the text of the button.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btn_text",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Button URL', 'frenify-core'),
					  "desc"			=> __('Insert the URL of the button.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_btn_url",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> __('Button Target', 'frenify-core'),
					  "desc"			=> '',
					  "id" 				=> "fotofly_fn_btn_target",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "_blank",
					  "allowedValues" 	=> array('_blank' 			=> __('_blank', 'frenify-core'),
												 '_parent' 			=> __('_parent', 'frenify-core')) 
					  ),
				// social links
				array(
					"name"  			=> __( 'Email Address', 'frenify-core' ),
					"desc"  			=> __( 'Insert an email address', 'frenify-core' ),
					"id"    			=> "email",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Facebook Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Facebook link', 'frenify-core' ),
					"id"    			=> "facebook",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Twitter Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Twitter link', 'frenify-core' ),
					"id"    			=> "twitter",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Instagram Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Instagram link', 'frenify-core' ),
					"id"    			=> "instagram",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Google+ Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Google+ link', 'frenify-core' ),
					"id"    			=> "google",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'LinkedIn Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom LinkedIn link', 'frenify-core' ),
					"id"    			=> "linkedin",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Vimeo Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Vimeo Link', 'frenify-core' ),
					"id"    			=> "vimeo",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Youtube Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Youtube Link', 'frenify-core' ),
					"id"    			=> "youtube",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Flickr Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Flickr Link', 'frenify-core' ),
					"id"    			=> "flickr",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Skype Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Skype Link', 'frenify-core' ),
					"id"    			=> "skype",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Tumblr Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Tumblr Link', 'frenify-core' ),
					"id"    			=> "tumblr",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Dribbble Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Dribbble Link', 'frenify-core' ),
					"id"    			=> "dribbble",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Vkontakte Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Vkontakte Link', 'frenify-core' ),
					"id"    			=> "vkontakte",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( '500px Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom 500px Link', 'frenify-core' ),
					"id"    			=> "500px",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Odnoklassniki Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Odnoklassniki Link', 'frenify-core' ),
					"id"    			=> "odnoklassniki",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Pinterest Link', 'frenify-core' ),
					"desc"  			=> __( 'Insert your custom Pinterest Link', 'frenify-core' ),
					"id"    			=> "pinterest",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
					"group"         	=> __( 'Social', 'frenify-core' ),
				),
				array(
					"name"  			=> __( 'Margin Top', 'frenify-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
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