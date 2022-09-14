<?php
/**
 * SharingBox implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_SharingBox extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'sharing_box';
			// element name
			$this->config['name']	 		= __('Sharing Box', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-share2';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Sharing Box';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_sharing_box">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-share2"></i><sub class="sub">'.__('Sharing Box', 'frenify-core').'</sub><p class="sharing_tagline">This Is The Text Title Is Entered</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$reverse_choices			= frenifyHelper::get_shortcode_choices_with_default();
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Tagline', 'frenify-core'),
					  "desc" 			=> __('The title tagline that will display', 'frenify-core'),
					  "id" 				=> "fotofly_fn_tagline",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> __('Share This Story, Choose Your Platform!', 'frenify-core')
					  ),
					  
				array("name" 			=> __('Tagline Color', 'frenify-core'),
					  "desc" 			=> __('Controls the text color. Leave blank for theme option selection', 'frenify-core'),
					  "id" 				=> "fotofly_fn_taglinecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
		array("name"	  => __('Background Color', 'frenify-core'),
					  "desc"	  => __('Controls the background color. Leave blank for theme option selection.', 'frenify-core'),
					  "id"		=> "fotofly_fn_backgroundcolor",
					  "type"	  => ElementTypeEnum::COLOR,
					  "value"	   => ""
			),

				array("name" 			=> __('Title', 'frenify-core'),
					  "desc" 			=> __('The post title that will be shared', 'frenify-core'),
					  "id" 				=> "fotofly_fn_title",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Link to Share', 'frenify-core'),
					  "desc" 			=> "",
					  "id" 				=> "fotofly_fn_link",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
				
				array("name" 			=> __('Description', 'frenify-core'),
					  "desc" 			=> __('The description that will be shared', 'frenify-core'),
					  "id" 				=> "fotofly_fn_description",
					  "type" 			=> ElementTypeEnum::TEXTAREA,
					  "value" 			=> ""
					  ),
					  
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
					  "type" 			=> ElementTypeEnum::INPUT,
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
					 
				array("name" 			=> __('Choose Image to Share on Pinterest', 'frenify-core'),
					  "desc" 			=> "",
					  "id" 				=> "fotofly_fn_pinterest_image",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "upid" 			=> "1",
					  "value" 			=> ""
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