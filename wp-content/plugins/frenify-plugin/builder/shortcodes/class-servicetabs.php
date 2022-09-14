<?php
class frenifySC_Servicetabs {

	private $tabs_counter = 1;
	private $tab_counter = 1;
	private $tabs = array();
	private $active = false;

	public static $parent_args;
	public static $child_args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_servicetabs-shortcode', array( $this, 'attr' ) );
		add_filter( 'fotofly_fn_attr_servicetabs-shortcode-link', array( $this, 'link_attr' ) );		
		add_filter( 'fotofly_fn_attr_servicetabs-shortcode-tab', array( $this, 'tab_attr' ) );

		add_shortcode( 'stabs', array( $this, 'render_parent' ) );
		add_shortcode( 'stab', array( $this, 'render_child' ) );
		
		add_shortcode( 'servicetabs', array( $this, 'service_tabs' ) );
		add_shortcode( 'servicetab', array( $this, 'service_tab' ) );

	}

	/**
	 * Render the parent shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_parent( $args, $content = '') {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'skin'				=> '',
				'position'			=> '',
				'tabs_position'		=> '',
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

		$justified_class = '';
		
		
		$html = sprintf( '<div %s><div class="container"><div class="fotofly_fn_sertabs"><ul %s>', frenifyCore_Plugin::attributes( 'servicetabs-shortcode' ), frenifyCore_Plugin::attributes( 'etabs' ) );

		
		if( empty( $this->tabs ) ) {
			$this->parse_tab_parameter( $content, 'servicetab', $args );
		}

		for( $i = 0; $i < count( $this->tabs ); $i++ ) {
			
			if($i <=9){
				$number = '0'.($i+1);
			}else{
				$number = ($i+1);
			}
			
			$html .= sprintf( '<li><a %s><span class="e_number">%s</span><span class="e_title">%s</span></a></li>', frenifyCore_Plugin::attributes( 'servicetabs-shortcode-link', array( 'index' => $i ) ), $number, $this->tabs[$i]['title'] );
			
		}
		
		$html .= '';
		$html .= sprintf( '</ul><div %s>%s</div></div></div></div>', frenifyCore_Plugin::attributes( 'tabcontent' ), do_shortcode($content) );

		$this->tabs_counter++;
		$this->tab_counter = 1;
		$this->active = false;
		unset( $this->tabs );

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_service_tabs fotofly_fn_service_tabs_%s', $this->tabs_counter );

		if( self::$parent_args['class'] ) {
			$attr['class'] .= ' ' .self::$parent_args['class'];
		}

//		if( self::$parent_args['id'] ) {
//			$attr['id'] = self::$parent_args['id'];
//		}
		
		if( self::$parent_args['skin'] ) {
			$attr['data-skin'] = self::$parent_args['skin'];
		}
		
		if( self::$parent_args['position'] ) {
			$attr['data-position'] = self::$parent_args['position'];
		}
		
		if( self::$parent_args['tabs_position'] ) {
			$attr['data-tabs-position'] = self::$parent_args['tabs_position'];
		}
		
		$attr['style'] = sprintf( 'margin-top:%s;margin-bottom:%s;', self::$parent_args['margin_top'], self::$parent_args['margin_bottom'] );
		
		return $attr;

	}	

	function link_attr( $atts ) {

		$attr = array();

		$index = $atts['index'];

		$attr['class'] = 'tab-link';
		//$attr['id'] = strtolower( preg_replace( '/\s+/', '', $this->tabs[$index]['title'] ) );
		$attr['href'] = '#' . $this->tabs[$index]['unique_id'];

		return $attr;

	}
		

	/**
	 * Render the child shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render_child( $args, $content = '') {

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'title'				=> '',
				'subtitle'			=> '',
				'price_text'		=> '',
				'price'				=> '',
				'image'				=> '',
				'id'				=> '',
				'fotofly_fn_tab'	=> 'no'
			), $args
		);

		extract( $defaults );

		self::$child_args = $defaults;
		
		$img_url 	= self::$child_args['image'];
		$img_id 	= fotofly_fn_attachment_id_from_url($img_url);
		$img_src 	= fotofly_fn_get_image_url_from_id($img_id, 'fotofly_fn_thumb-800-800');
		
		if($img_url !== ''){
			$have_image = 'yes';
		}else{
			$have_image = 'no';
		}
		$img_overlay 	= '<div class="img_overlay" style="background-image:url('.$img_src.')"></div>';
		$color_overlay 	= '<div class="color_overlay"><span class="picture"><img class="fotofly_fn_svg" src="'.fotofly_fn_ASSETS_URI.'/img/picture.svg" alt="" /></span></div>';
		
		
		
		// separate function
		$list = '';
		$string = do_shortcode( $content );
		$fn_array = explode('/', $string);
		foreach($fn_array as $item){
			$list .= '<li>'.$item.'</li>';
		}
		
		$title		 	= self::$child_args['title'];
		$subtitle		= self::$child_args['subtitle'];
		$price_text 	= self::$child_args['price_text'];
		$price		 	= self::$child_args['price'];
		
		
		

		$html = sprintf( '<div %s><div class="img_holder %s">%s%s</div><div class="content_holder"><div class="fotofly_fn_holder_in"><div class="minicontent"><h3>%s</h3><p>%s</p><ul>%s</ul></div><div class="price_holder"><span class="text">%s</span><span class="price">%s</span></div></div></div></div>', frenifyCore_Plugin::attributes( 'servicetabs-shortcode-tab' ), $have_image, $img_overlay, $color_overlay, $title, $subtitle, $list, $price_text, $price );

		return $html;

	}

	function tab_attr() {

		$attr = array();

		$attr['class'] = 'tab-pane';
		
		if( self::$child_args['fotofly_fn_tab'] == 'yes' ) {
			$attr['id'] = self::$child_args['id'];
		} else {
			$index = self::$child_args['id'] - 1;
			$attr['id'] = $this->tabs[$index]['unique_id'];
		}
		

		return $attr;

	}
	
	
	function service_tabs( $atts, $content = null ) {
		global $fotofly_fn_option;

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class' 			=> '',
				'skin' 				=> '',
				'position' 			=> '',
				'tabs_position'		=> '',
				'id' 				=> '',
				'margin_top' 		=> '',
				'margin_bottom'		=> '',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;

		$content = preg_replace('/tab\][^\[]*/','tab]', $content);
		$content = preg_replace('/^[^\[]*\[/','[', $content);

		$this->parse_tab_parameter( $content, 'servicetab' );

		$shortcode_wrapper = '[stabs skin="'.$atts['skin'].'" position="'.$atts['position'].'" tabs_position="'.$atts['tabs_position'].'" margin_top="' . $atts['margin_top'] . '" margin_bottom="' . $atts['margin_bottom'] .'" class="' . $atts['class'] . '" id="' . $atts['id'] . '"]';
		$shortcode_wrapper .= $content;
		$shortcode_wrapper .= '[/stabs]';

		return do_shortcode($shortcode_wrapper);
	}

	function service_tab( $atts, $content = null) {
		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'title'			=> '',
				'subtitle'		=> '',
				'price_text'	=> '',
				'price'			=> '',
				'image'			=> '',
				'link'			=> '',
				'id'			=> '',
			), $atts
		);

		extract( $defaults );

		$atts = $defaults;	
	
		// create unique tab id for linking
		$sanitized_title = hash("md5", $title, false);
		$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
		$unique_id = 'tab-' . substr( md5( get_the_ID() . '-' . $this->tabs_counter . '-' . $this->tab_counter . '-' . $sanitized_title), 13 );

		$shortcode_wrapper = sprintf( '[stab id="%s" title="%s" subtitle="%s" image="%s" price_text="%s" price="%s" fotofly_fn_tab="yes"]%s[/stab]', $unique_id, $title, $subtitle, $image, $price_text, $price , do_shortcode( $content ) );

		$this->tab_counter++;

		return do_shortcode( $shortcode_wrapper );
	}
	
	
	
	function parse_tab_parameter( $content, $shortcode, $args = null ) {
		$preg_match_tabs_single = preg_match_all( frenifyCore_Plugin::get_shortcode_regex( $shortcode ), $content, $tabs_single );

		if( is_array( $tabs_single[0] ) ) {
			foreach( $tabs_single[0] as $key => $tab ) {
				
				
				if( is_array( $args ) ) {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' id=([0-9]+)/i', $tab, $ids );	

					if( array_key_exists( '0', $ids[1] ) ) {
						$id = $ids[1][0];
					} else {
						$title = 'default';
					}				

					foreach ( $args as $key => $value ) {

						if( $key == $shortcode . $id ) {
							
							$title = $value;
						}
					}
				} else {
					$preg_match_titles = preg_match_all( '/' . $shortcode . ' title="([^\"]+)"/i', $tab, $titles );
					if( array_key_exists( '0', $titles[1] ) ) {
						$title = $titles[1][0];
					} else {
						$title = 'default';
					}
				}
				
			
				$preg_match_icons = preg_match_all( '/' . $shortcode . '( id=[0-9]+| title="[^\"]+")? image="([^\"]+)"/i', $tab, $images );
				if( array_key_exists( '0', $images[2] ) ) {
					$image = $images[2][0];
				} else {
					$image = 'none';
				}
				
				// create unique tab id for linking
				$sanitized_title = hash("md5", $title, false);
				$sanitized_title = 'tab'. str_replace( '-', '_', $sanitized_title );
				$unique_id = 'tab-' . substr( md5( get_the_ID() . '-' . $this->tabs_counter . '-' . $this->tab_counter . '-' . $sanitized_title), 13 );

				// create array for every single tab shortcode
				$this->tabs[] = array('title' => $title, 'image' => $image, 'unique_id' => $unique_id );
				
				$this->tab_counter++;
			}
			
			$this->tab_counter = 1;
		}
	}

}

new frenifySC_Servicetabs();