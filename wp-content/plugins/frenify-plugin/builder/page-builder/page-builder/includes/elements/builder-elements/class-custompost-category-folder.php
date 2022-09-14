<?php
/**
 * RecentWorks implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_CustompostCategoryFolder extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'cuspostcat_folder';
			// element name
			$this->config['name']	 		= __('Custom Post Category Folder', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "custompost_category_folder.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Portfolio Custom Block';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_portfolio_custom">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.__('Custom Post Category Folder', 'frenify-core').'</sub><p>Post Type = <span class="portfolio_custom_layout">Portfolio</span><span class="rw_cats_container"><br>Category = <font class="portfolio_custom_cats">All</font></span></p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;

		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			$wp_categories_list3  		= frenifyHelper::fotofly_fn_shortcodes_categories('portfolio_category');
			$wp_categories_list4  		= frenifyHelper::fotofly_fn_shortcodes_categories('gallery_category');
			$choices					= frenifyHelper::get_shortcode_choices();
			
			$this->config['subElements'] = array(
				
				array( "name" 			=> __('Skin', 'frenify-core'),
					  "id" 				=> "skin",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "light",
					  "allowedValues" 	=> array(
												'light' 				=> __('Light', 'frenify-core'),
												'dark' 					=> __('Dark', 'frenify-core'),
												 )
					  ),
				
				array( "name" 			=> __('Animation Type', 'frenify-core'),
					  "id" 				=> "animation_type",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "hover",
					  "allowedValues" 	=> array(
												'hover' 				=> __('On Hover', 'frenify-core'),
												'click' 				=> __('On Click', 'frenify-core'),
												'disable' 				=> __('Disable', 'frenify-core'),
												 )
					  ),
			
				array( "name" 			=> __('Post Type', 'frenify-core'),
					  "desc" 			=> __('Choose the post type for the shortcode', 'frenify-core'),
					  "id" 				=> "fotofly_fn_fnposttype",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "portfolio",
					  "allowedValues" 	=> array('portfolio' 			=> __('Portfolio', 'frenify-core'),
												 'gallery' 				=> __('Gallery', 'frenify-core'),
												 )
					  ),
				
					  	    
				array("name" 			=> __('Category', 'frenify-core'),
					  "desc" 			=> __('Select a category.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_catslug_folder",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list3 
					 ),
				
				array("name" 			=> __('Category', 'frenify-core'),
					  "desc" 			=> __('Select a category.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_catslug_folder_gallery",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> array(''),
					  "allowedValues" 	=> $wp_categories_list4 
					 ),
					  
				array("name" 			=> __('Order Posts', 'frenify-core'),
					  "desc" 			=> __('Choose ordering type for posts', 'frenify-core'),
					  "id" 				=> "fotofly_fn_order_folder",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('' 					=> __('Newness', 'frenify-core'),
												 'rand' 				=> __('Random', 'frenify-core'))
					  ),
					  
				array("name" 			=> __('Post Offset', 'frenify-core'),
					  "desc" 			=> __('The number of posts to skip. ex: 1.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_offset_folder",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> ""
					  ),
					  
				array(
					"name"  			=> __( 'Margin Top', 'frenify-core' ),
					"desc"  			=> __( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
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