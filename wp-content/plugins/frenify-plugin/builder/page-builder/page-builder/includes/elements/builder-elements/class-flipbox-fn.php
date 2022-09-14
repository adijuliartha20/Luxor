<?php
/**
 * FlipboxFn element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_FlipboxFn extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   			= 'flipbox_fn';
			// element name
			$this->config['name']	 		= esc_html__('Flipbox', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// preview image
			$this->config['preview_img']  	= "flipbox.jpg";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-expand-alt';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Call To Action Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_flipbox_fn">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-expand-alt"></i><sub class="sub">'.esc_html__('Flipbox', 'frenify-core').'</sub>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			
			
			$this->config['subElements'] = array(
				
				array("name" 			=> esc_html__('Hover Effect Direction For Flipbox', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the hover effect direction of Flipbox.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_hoveffdir",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "lefttoright",
					  "allowedValues" 	=> array(
												'lefttoright' 			=> esc_html__('Left To Right', 'frenify-core'),
												'righttoleft' 			=> esc_html__('Right To Left', 'frenify-core'),
												'toptobottom' 			=> esc_html__('Top To Bottom', 'frenify-core'),
												'bottomtotop' 			=> esc_html__('Bottom To Top', 'frenify-core'),) 
					  ),
				
				array("name" 			=> esc_html__('Content Position For Flipbox', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the content position of Flipbox.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_conpos",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "topleft",
					  "allowedValues" 	=> array(
												'topleft' 				=> esc_html__('Top Left', 'frenify-core'),
												'topcenter' 			=> esc_html__('Top Center', 'frenify-core'),
												'topright' 				=> esc_html__('Top Right', 'frenify-core'),
												'middleleft' 			=> esc_html__('Middle Left', 'frenify-core'),
												'middlecenter' 			=> esc_html__('Middle Center', 'frenify-core'),
												'middleright' 			=> esc_html__('Middle Right', 'frenify-core'),
												'bottomleft' 			=> esc_html__('Bottom Left', 'frenify-core'),
												'bottomcenter' 			=> esc_html__('Bottom Center', 'frenify-core'),
												'bottomright' 			=> esc_html__('Bottom Right', 'frenify-core')) 
					  ),
					  
				array("name" 			=> esc_html__('Border Radius For Flipbox', 'frenify-core'),
					  "desc"			=> esc_html__('Insert the border radius in px or %, eg. 3px.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_brad",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "0px" 
					  ),
				
				array("name" 			=> esc_html__('Background Type of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background type of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_bgtype_front",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "color",
					  "allowedValues" 	=> array(
												'color' 			=> esc_html__('Color', 'frenify-core'),
												'gradient' 			=> esc_html__('Gradient', 'frenify-core'),
												'image' 			=> esc_html__('Image', 'frenify-core')) 
					  ),
				
				array("name" 			=> esc_html__('Background Color of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background color of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_bgcol_front",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Gradient Degree of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Gradient Degree as Direction, ex. 90deg = left to right.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_grdeg_front",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "135deg",
					  
					  ),
				
				array("name" 			=> esc_html__('Gradient Start Color of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background gradient start color of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_grstart_front",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Gradient End Color of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background gradient end color of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_grend_front",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Upload Background Image of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the background image of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_bgimg_front",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 1,
					  ),
				
				array(
					"name"  			=> esc_html__( 'Title of Front Side', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert the title of Flipbox\'s front side.', 'frenify-core' ),
					"id"    			=> "fotofly_fn_flip_title_front",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
				),
				
				array("name" 			=> esc_html__('Title Color of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the title color of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_titlecol_front",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array(
					"name"  			=> esc_html__( 'Content of Front Side', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert the content of Flipbox\'s front side.', 'frenify-core' ),
					"id"    			=> "fotofly_fn_flip_con_front",
					"type"  			=> ElementTypeEnum::TEXTAREA,
					"value" 			=> "",
				),
				
				
				array("name" 			=> esc_html__('Content Color of Front Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the content color of Flipbox\'s front side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_concol_front",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Background Type of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background type of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_bgtype_back",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "color",
					  "allowedValues" 	=> array(
												'color' 			=> esc_html__('Color', 'frenify-core'),
												'gradient' 			=> esc_html__('Gradient', 'frenify-core'),
												'image' 			=> esc_html__('Image', 'frenify-core')) 
					  ),
				
				array("name" 			=> esc_html__('Background Color of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background color of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_bgcol_back",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Gradient Degree of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Gradient Degree as Direction, ex. 90deg = left to right.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_grdeg_back",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "135deg",
					  
					  ),
				
				array("name" 			=> esc_html__('Gradient Start Color of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background gradient start color of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_grstart_back",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Gradient End Color of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the background gradient end color of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_grend_back",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array("name" 			=> esc_html__('Upload Background Image of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Upload the background image of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_bgimg_back",
					  "type" 			=> ElementTypeEnum::UPLOAD,
					  "value" 			=> "",
					  "upid"			=> 2,
					  ),
				
				array(
					"name"  			=> esc_html__( 'Title of Back Side', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert the title of Flipbox\'s back side.', 'frenify-core' ),
					"id"    			=> "fotofly_fn_flip_title_back",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
				),
				
				array("name" 			=> esc_html__('Title Color of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the title color of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_titlecol_back",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array(
					"name"  			=> esc_html__( 'Content of Back Side', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert the content of Flipbox\'s back side.', 'frenify-core' ),
					"id"    			=> "fotofly_fn_flip_con_back",
					"type"  			=> ElementTypeEnum::TEXTAREA,
					"value" 			=> "",
				),
				
				
				array("name" 			=> esc_html__('Content Color of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the content color of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_concol_back",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				array(
					"name"  			=> esc_html__( 'Link URL of Back Side', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert the link URL of Flipbox\'s back side or leave blank.', 'frenify-core' ),
					"id"    			=> "fotofly_fn_flip_linkurl_back",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
				),
				
				array(
					"name"  			=> esc_html__( 'Link Text of Back Side', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Insert the link text of Flipbox\'s back side.', 'frenify-core' ),
					"id"    			=> "fotofly_fn_flip_linktext_back",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "",
				),
				
				array("name" 			=> esc_html__('Link Color of Back Side', 'frenify-core'),
					  "desc"			=> esc_html__('Choose the link color of Flipbox\'s back side.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_flip_linkcol_back",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> "" 
					  ),
				
				// default values
				
				array(
					"name"  			=> esc_html__( 'Padding Top', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Padding top for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> esc_html__( 'Padding Bottom', 'frenify-core' ),
					"desc"  			=> esc_html__( 'Padding bottom for text. In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "padding_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),	
				
				
				array(
					"name"  			=> esc_html__( 'Margin Top', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_top",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),
				array(
					"name"  			=> esc_html__( 'Margin Bottom', 'frenify-core' ),
					"desc"  			=> esc_html__( 'In pixels, ex: 10px.', 'frenify-core' ),
					"id"    			=> "margin_bottom",
					"type"  			=> ElementTypeEnum::INPUT,
					"value" 			=> "0",
				),	
					 
				array("name" 			=> esc_html__('CSS Class', 'frenify-core'),
					  "desc"			=> esc_html__('Add a class to the wrapping HTML element.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_class",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> esc_html__('CSS ID', 'frenify-core'),
					  "desc"			=> esc_html__('Add an ID to the wrapping HTML element.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_id",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
				);
		}
	}