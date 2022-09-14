<?php
class frenifySC_CategoryColumnGallery {

	private $fotofly_fn_counter = 1;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_category_column_gallery-shortcode', array( $this, 'attr' ) );

		add_shortcode( 'category_column_gallery', array( $this, 'render' ) );
		add_shortcode( 'category_col_gallery', array( $this, 'render_child' ) );
	}

	/**
	 * Render the shortcode
	 * 
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '' ) {

		$defaults =	frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom' 	=> '',
			), $args
		);
		
		// check: has "px" or not. if not: add "px"
		if( strpos( $defaults['margin_top'], '%' ) === false && strpos( $defaults['margin_top'], 'px' ) === false ) {
			$defaults['margin_top'] = $defaults['margin_top'] . 'px';
		}

		if( strpos( $defaults['margin_bottom'], '%' ) === false && strpos( $defaults['margin_bottom'], 'px' ) === false ) {
			$defaults['margin_bottom'] = $defaults['margin_bottom'] . 'px';
		}

		extract( $defaults );

		self::$parent_args = $defaults;
		
		$child_output = do_shortcode($content);
		$child_output = rtrim($child_output, ',');
		
		$html = '';
		$html .= sprintf('<div %s><table><tr>%s</tr></table></div>',frenifyCore_Plugin::attributes( 'category_column_gallery-shortcode' ),$child_output);
		
		
		$this->fotofly_fn_counter++;
		
		return $html;

	}
	
	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_category_column_gallery fotofly_fn_category_column_gallery-%s', $this->fotofly_fn_counter );
		
		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}
		
//		$attr['id'] = sprintf( 'fotofly_fn_category_column_gallery_%s', $this->fotofly_fn_counter );
//		
//		if( self::$parent_args['id'] ) {
//			$attr['id'] .= ' ' .self::$parent_args['id'];
//		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		return $attr;

	}
	
	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'image'				=> '',
				'cat_slug' 			=> '',
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		
		$img_url = self::$child_args['image'];
		$img_id = fotofly_fn_attachment_id_from_url($img_url);
		
		$image = wp_get_attachment_image_src($img_id, 'full');
		
		/********************** category link ***********************/
		
		$fn_cat_slug 	=  self::$child_args['cat_slug'];
		$term 			= get_term_by('name', $fn_cat_slug, 'gallery_category');
		$category_link 	= get_category_link( $term );
		
		/********************** category link ***********************/
		
		$html = '';
		if($image[0] != ''){
			$html = '<td style="background-image: url('.$image[0].');">
						<div class="list">
							<div class="title_holder">
   								<h3><a href="'.$category_link.'">'.$fn_cat_slug.'</a></h3>
   							</div>
   						</div>
					</td>';
		}
		

		return $html;

	}

	

}

new frenifySC_CategoryColumnGallery();
