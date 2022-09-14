<?php
/**
 * Separator element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_Separator extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'separator_element';
			// element name
			$this->config['name']	 		= __('Separator', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-minus';
			// tooltip that will be displyed upon mous over the element
			//$this->config['tool_tip']  		= 'Creates a Separator Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_seprator">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><span class="upper_container" style="selector:spattrib"><i class="frenifya-minus"></i><sub class="sub">'.__('Separator', 'frenify-core').'</sub></span><section class="separator double_dotted" style="selector:sattrib"><i class="fake_class" style="selector:iattrib"></i></section></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$margin_data = frenifyHelper::fotofly_fn_create_dropdown_data(1,100);
			$choices = frenifyHelper::get_shortcode_choices_with_default();
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Style', 'frenify-core'),
					  "desc" 			=> __('Choose the separator line style', 'frenify-core'),
					  "id" 				=> "fotofly_fn_style",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "none",
					  "allowedValues" 	=> array(		'none' => __('No Style', 'frenify-core'),
		'single' => __('Single Border Solid', 'frenify-core'),
		'double' => __('Double Border Solid', 'frenify-core'),
		'single|dashed' => __('Single Border Dashed', 'frenify-core'),
		'double|dashed' => __('Double Border Dashed', 'frenify-core'),
		'single|dotted' => __('Single Border Dotted', 'frenify-core'),
		'double|dotted' => __('Double Border Dotted', 'frenify-core'),
		'shadow' => __('Shadow', 'frenify-core')) 
					 ),
				
				array("name" 			=> __('Margin Top', 'frenify-core'),
					  "desc"			=> __('Spacing above the separator. In pixels.  Use a number without px.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_top",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Margin Bottom', 'frenify-core'),
					  "desc"			=> __('Spacing below the separator. In pixels.  Use a number without px.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bottom",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Separator Color', 'frenify-core'),
					  "desc" 			=> __('Controls the separator color. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_sepcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),

				array("name" 			=> __('Border Size', 'frenify-core'),
					  "desc"			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_border_size",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" ,
					  ),
					  
				array("name" 			=> __('Select Icon', 'frenify-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'frenify-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> frenifyHelper::GET_ICONS_LIST()
					  ),
					  
				array("name" 			=> __('Circled Icon', 'frenify-core'),
					  "desc" 			=> __('Choose to have a circle in separator color around the icon.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_circle",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> $choices
					  ),	
					  
				array("name" 			=> __('Circle Color', 'frenify-core'),
					  "desc" 			=> __('Controls the background color of the circle around the icon.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_circlecolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),					  
					  
				array("name" 			=> __('Separator Width', 'frenify-core'),
					  "desc"			=> __('In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_width",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "" 
					  ),
					  
				array("name" 			=> __('Alignment', 'frenify-core'),
					  "desc" 			=> __('Select the separator alignment; only works when a width is specified.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_alignment",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('center' 	=> __('Center', 'frenify-core'),
					  							 'left' 	=> __('Left', 'frenify-core'),
												 'right' 	=> __('Right', 'frenify-core'))
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