<?php
/**
 * Section Separator element implementation, it extends DDElementTemplate like all other elements
 */
	class fotofly_fn_SectionSeparator extends DDElementTemplate {
		public function __construct() {
			
			parent::__construct();
		} 
		
		// Implementation for the element structure.
		public function create_element_structure() {
			
			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] 		= get_class($this);
			// element id
			$this->config['id']	   		= 'section_separator';
			// element name
			$this->config['name']	 		= __('Section Separator', 'frenify-core');
			// element icon
			$this->config['icon_url']  		= "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] 		= "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class']		= 'frenify-icon builder-options-icon frenifya-ellipsis';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Separator Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] 			= array("drop_level"   => "4");
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {
			
			
			$innerHtml  = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-ellipsis"></i><sub class="sub">'.__('Section Separator', 'frenify-core').'</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}
		
		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$margin_data = frenifyHelper::fotofly_fn_create_dropdown_data(1,100);
			$this->config['subElements'] = array(
			
			   array("name" 			=> __('Position of the Divider Candy', 'frenify-core'),
					  "desc" 			=> __('Select the position of the triangle candy', 'frenify-core'),
					  "id" 				=> "fotofly_fn_divider_candy",
					  "type" 			=> ElementTypeEnum::SELECT,
					  "value" 			=> "",
					  "allowedValues" 	=> array('top' 			=> __('Top', 'frenify-core'),
												 'bottom' 		=> __('Bottom', 'frenify-core'),
												 'bottom,top' 	=> __('Top and Bottom', 'frenify-core')) 
					 ),
				array("name" 			=> __('Select Icon', 'frenify-core'),
					  "desc" 			=> __('Click an icon to select, click again to deselect', 'frenify-core'),
					  "id" 				=> "icon",
					  "type" 			=> ElementTypeEnum::ICON_BOX,
					  "value" 			=> "",
					  "list"			=> frenifyHelper::GET_ICONS_LIST()
					  ),
					  
				array("name" 			=> __('Icon Color', 'frenify-core'),
					  "desc" 			=> __('Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_iconcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Border', 'frenify-core'),
					  "desc"			=> __('In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_border",
					  "type" 			=> ElementTypeEnum::INPUT,
					  "value" 			=> "1px" 
					  ),
					  
				array("name" 			=> __('Border Color', 'frenify-core'),
					  "desc" 			=> __('Controls the border color. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_bordercolor",
					  "type" 			=> ElementTypeEnum::COLOR,
					  "value" 			=> ""
					  ),
					  
				array("name" 			=> __('Background Color of Divider Candy', 'frenify-core'),
					  "desc" 			=> __('Controls the background color of the triangle. Leave blank for theme option selection.', 'frenify-core'),
					  "id" 				=> "fotofly_fn_backgroundcolor",
					  "type" 			=> ElementTypeEnum::COLOR,
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