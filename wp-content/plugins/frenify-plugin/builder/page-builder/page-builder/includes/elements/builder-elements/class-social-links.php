<?php
/**
 * SocialLinks element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_SocialLinks extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'social_links';
			// element name
			$this->config['name']	 		= __('Social Links', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-link';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Social Links Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-link"></i><sub class="sub">'.__('Social Links', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= frenifyHelper::get_shortcode_choices_with_default();
			
			$this->config['subElements'] = array(
					 

				array("name" 			=> __('Boxed Social Icons', 'frenify-core'),
					  "desc" 			=> __('Choose to get a boxed icons. Choose default for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_iconboxed",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $reverse_choices 
					  ),
					  
				array("name" 			=> __('Social Icon Box Radius', 'frenify-core'),
					  "desc" 			=> __('Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_iconboxedradius",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> "4px"
					  ),
					  
				array("name" 			=> __('Social Icon Custom Colors', 'frenify-core'),
					  "desc" 			=> __('Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_iconcolor",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Social Icon Custom Box Colors', 'frenify-core'),
					  "desc" 			=> __('Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_boxcolor",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Social Icon Tooltip Position', 'frenify-core'),
					  "desc" 			=> __('Choose the display position for tooltips. Choose default for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_icontooltip",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 			=> 'Default',
												 'top' 			=> __('Top', 'frenify-core'),
												 'bottom' 		=> __('Bottom', 'frenify-core'),
												 'left' 		=> __('Left', 'frenify-core'),
												 'Right' 		=> __('Right', 'frenify-core')) 
					 ),
					 
					  
				array("name" 			=> __('Facebook Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Facebook link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_facebook",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Twitter Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Twitter link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_twitter",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),

		array("name"	  => __('Instagram Link', 'frenify-core'),
					  "desc"	  => __('Insert your custom Instagram link', 'frenify-core'),
					  "id"		=> "fotofly_fn_instagram",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

				array("name" 			=> __('Dribbble Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Dribbble link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_dribbble",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Google+ Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Google+ link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_google",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('LinkedIn Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom LinkedIn link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_linkedin",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Blogger Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Blogger link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_blogger",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Tumblr Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Tumblr link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_tumblr",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Reddit Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Reddit link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_reddit",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Yahoo Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Yahoo link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_yahoo",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Deviantart Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Deviantart link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_deviantart",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Vimeo Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Vimeo link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_vimeo",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Youtube Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Youtube link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_youtube",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Pinterest Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Pinterest link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_pinterest",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('RSS Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom RSS link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_rss",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Digg Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Digg link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_digg",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Flickr Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Flickr link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flickr",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Forrst Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Forrst link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_forrst",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Myspace Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Myspace link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_myspace",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Skype Link', 'frenify-core'),
					  "desc" 			=> __('Insert your custom Skype link', 'frenify-core'),
					  "id" 				=> "fotofly_fn_skype",
					  "type"			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),

		array("name"	  => __('PayPal Link', 'frenify-core'),
					  "desc"	  => __('Insert your custom PayPal link', 'frenify-core'),
					  "id"		=> "fotofly_fn_paypal",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		array("name"	  => __('Dropbox Link', 'frenify-core'),
					  "desc"	  => __('Insert your custom Dropbox link', 'frenify-core'),
					  "id"		=> "fotofly_fn_dropbox",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		array("name"	  => __('SoundCloud Link', 'frenify-core'),
					  "desc"	  => __('Insert your custom Soundcloud link', 'frenify-core'),
					  "id"		=> "fotofly_fn_soundcloud",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		array("name"	  => __('VK Link', 'frenify-core'),
					  "desc"	  => __('Insert your custom VK link', 'frenify-core'),
					  "id"		=> "fotofly_fn_vk",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),

		  array("name"	  => __('Email Address', 'frenify-core'),
					  "desc"	  => __('Insert an email address to display the email icon', 'frenify-core'),
					  "id"		=> "fotofly_fn_email",
					  "type"	  => ElementTypeEnum::INPUT,
					  "value"	   => ""
			),
					  
				array("name" 			=> __('Show Custom Social Icon', 'frenify-core'),
					  "desc" 			=> __('Show the custom social icon specified in Theme Options', 'frenify-core'),
					  "id" 				=> "fotofly_fn_show_custom",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "no",
					  "allowedValues" 	=> $reverse_choices 
					  ),

		  array("name"	  => __('Alignment', 'frenify-core'),
					  "desc"	  => __('Select the icon\'s alignment.', 'frenify-core'),
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