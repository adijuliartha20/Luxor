<?php
/**
 * Custom Templates implementation
 */
class CustomTemplates {
	private $value = array();
	private $elements = array();
	
	public function __construct() {
		
		$this->value['id'] 		= "custom_templates_div";
		$this->value['name'] 	= __('Custom Templates', 'frenify-core');
		$this->value['icon'] 	= "icon_pack/tab_icon_3.png";
		$this->value['class']	= "frenify-tab frenifya-file-al";
		$this->load_elements();
	}
	
	public function to_array() {
		
		$this->value['elements'] = $this->elements;
		return $this->value;
	}
	
	/**
	 * Load all the category's elements
	 */
	private function load_elements() {
	   
	}  
}