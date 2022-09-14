<?php
/**
 * PostSlider implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_PostSlider extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'post_slider';
			// element name
			$this->config['name']	 		= __('Post Slider', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-layers-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates Elastic Slider';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_post_slider">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-layers-alt"></i><sub class="sub">'.__('Post Slider', 'frenify-core').'</sub><p>layout = <span class="post_slider_layout">posts-with-excerpts</span><br /><span class="cat_container" style="selector:attrib"> category = <span class="post_slider_cat">design</span></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$wp_categories 	= frenifyHelper::get_wp_categories_list();
			$cat_element	= array('' => 'All');
			$wp_categories  = $cat_element + $wp_categories;
			
			$this->config['subElements'] = array(
			
				array("name" 			=> __('Layout', 'frenify-core'),
					  "desc" 			=> __('Choose a layout style for Post Slider.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "posts",
					  "allowedValues" 	=> array('posts' 				=> __('Posts with Title', 'frenify-core'),
												 'posts-with-excerpt' 	=> __('Posts with Title and Excerpt', 'frenify-core'),
												 'attachments' 			=> __('Attachment Layout, Only Images Attached to Post/Page', 'frenify-core')) 
					  ),
					  
				array("name" 			=> __('Excerpt Number of Words', 'frenify-core'),
					  "desc" 			=> __('Insert the number of words you want to show in the excerpt.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_excerpt",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "35",
					  ),
					  
				array("name" 			=> __('Category', 'frenify-core'),
					  "desc" 			=> __('Select a category of posts to display.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_category",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $wp_categories
					  ),
					  
				array("name" 			=> __('Number of Slides', 'frenify-core'),
					  "desc" 			=> __('Select the number of slides to display.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_limit",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "3"
					  ),
					  
				array("name" 			=> __('Lightbox on Click', 'frenify-core'),
					  "desc" 			=> __('Only works on attachment layout.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_lightbox",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "yes",
					  "allowedValues" 	=> array('yes' 					=> __('Yes', 'frenify-core'),
												 'no' 					=> __('No', 'frenify-core')) 
					  ),
					  
				array("name" 			=> __('Attach Images to Post/Page Gallery', 'frenify-core'),
					  "desc" 			=> __('Only works for attachments layout.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_gallery",
					  "type" 			=> ElementTypeEnum::GALLERY,
					  "value" 			=> " "
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