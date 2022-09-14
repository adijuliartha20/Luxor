<?php
/**
 * Column Options implementation
 */
class ColumnOptions {
	private $value = array();
	private $elements = array();
	
	public function __construct() {
		
		$this->value['id'] 		= "Column_options_div";
		$this->value['name'] 	= __('Columns', 'frenify-core');
		$this->value['icon'] 	= "icon_pack/tab_icon_1.png";
		$this->value['class']	= "frenify-tab frenifya-colum";
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
		//load all layout category elements
		
		$full_width			= new fotofly_fn_FullWidthContainer();
		array_push( $this->elements, $full_width->element_to_array() );

		$grid_one 			= new fotofly_fn_GridOne();
		array_push( $this->elements, $grid_one->element_to_array() );

		$grid_two 			= new fotofly_fn_GridTwo();
		array_push( $this->elements, $grid_two->element_to_array() );
		
		$grid_three 		= new fotofly_fn_GridThree();
		array_push( $this->elements, $grid_three->element_to_array() );
		
		$grid_two_third		= new fotofly_fn_GridTwoThird();
		array_push( $this->elements, $grid_two_third->element_to_array() );
		
		$grid_four			= new fotofly_fn_GridFour();
		array_push( $this->elements, $grid_four->element_to_array() );
		
		$grid_three_fourth	= new fotofly_fn_GridThreeFourth();
		array_push( $this->elements, $grid_three_fourth->element_to_array() );
		
		$grid_five			= new fotofly_fn_GridFive();
		//array_push( $this->elements, $grid_five->element_to_array() );
		
		$grid_two_fifth		= new fotofly_fn_GridTwoFifth();
		//array_push( $this->elements, $grid_two_fifth->element_to_array() );
		
		$grid_three_fifth	= new fotofly_fn_GridThreeFifth();
		//array_push( $this->elements, $grid_three_fifth->element_to_array() );
		
		$grid_four_fifth	= new fotofly_fn_GridFourFifth();
		//array_push( $this->elements, $grid_four_fifth->element_to_array() );
		
		$grid_one_six		= new fotofly_fn_GridSix();
		//array_push( $this->elements, $grid_one_six->element_to_array() );
		
		$grid_five_six		= new fotofly_fn_GridFiveSix();
		//array_push( $this->elements, $grid_five_six->element_to_array() );
	   
	}  
}