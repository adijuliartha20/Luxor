<?php
class frenifySC_Alert {

	private $alert_class;
	private $icon_class;

	public static $args;

	/**
	 * Initiate the shortcode
	 */
	public function __construct() {

		add_filter( 'fotofly_fn_attr_alert-shortcode', array( $this, 'attr' ) );
		add_filter( 'fotofly_fn_attr_alert-shortcode-icon', array( $this, 'icon_attr' ) );
		add_filter( 'fotofly_fn_attr_alert-shortcode-button', array( $this, 'button_attr' ) );

		add_shortcode( 'alert_fn', array( $this, 'render' ) );

	}

	/**
	 * Render the shortcode
	 * @param  array $args	 Shortcode paramters
	 * @param  string $content Content between shortcode
	 * @return string		  HTML output
	 */
	function render( $args, $content = '') {

		$defaults = frenifyCore_Plugin::set_shortcode_defaults(
			array(
				'class'			   		=> '',
				'id'				 	=> '',
				'title'				 	=> '',
				'accent_color'			=> '',
				'background_color'		=> '',
				'border_size'			=> '',
				'box_shadow'			=> 'no',
				'icon'					=> '',
				'type'					=> 'general',
				'animation_type'	  	=> '',
				'animation_direction' 	=> 'left',
				'animation_speed'	 	=> ''
			), $args
		);

		extract( $defaults );

		self::$args = $defaults;

		switch( $args['type'] ) {

			case 'general':
				$this->alert_class = 'info';
				if( ! $icon || $icon != 'none' ) {
					self::$args['icon'] = $icon = 'xcon-info-outline';
				}
				break;
			case 'error':
				$this->alert_class = 'danger';
				if( ! $icon || $icon != 'none' ) {
					self::$args['icon'] = $icon = 'xcon-attention-alt';
				}				
				break;
			case 'success':
				$this->alert_class = 'success';
				if( ! $icon || $icon != 'none' ) {
					self::$args['icon'] = $icon = 'xcon-ok';
				}				
				break;
			case 'notice':
				$this->alert_class = 'warning';
				if( ! $icon || $icon != 'none' ) {
					self::$args['icon'] = $icon = 'xcon-cog';
				}				
				break;
			case 'blank':
				$this->alert_class = 'blank';
				break;
			case 'custom':
				$this->alert_class = 'custom';
				break;
		}
		
		$close_button = '<span class="close_button"><span class="after"></span><span class="before"></span></span>';

		$html = sprintf( '<div %s>', frenifyCore_Plugin::attributes( 'alert-shortcode' ) ) . "\n";
		$html .= '<div class="inner">';
		if( $icon && $icon != 'none' ) {
			$html .= sprintf( '<span %s><i %s></i></span>', frenifyCore_Plugin::attributes( 'alert-icon' ), frenifyCore_Plugin::attributes( 'alert-shortcode-icon' ) );
		}
		$html .= '<div class="alert_content"><h3>'.self::$args['title'].'</h3><p>'.do_shortcode( $content ).'</p></div>';
		$html .= $close_button.'</div></div>' . "\n";

		return $html;

	}

	function attr() {

		$attr = array();

		$attr['class'] = sprintf( 'fotofly_fn_alert alert %s alert-dismissable alert-%s', self::$args['type'], $this->alert_class );
		
		if( self::$args['box_shadow'] == 'yes' ) {
			$attr['class'] .= ' alert-shadow';
		}

		if( $this->alert_class == 'custom' ) {
			$attr['style'] = sprintf( 'background-color:%s;color:%s;border-color:%s;border-width:%s;', self::$args['background_color'],
									  self::$args['accent_color'], self::$args['accent_color'], self::$args['border_size'] );
			$attr['data-text-color'] 		= self::$args['accent_color'];
		}

		if( self::$args['animation_type'] ) {
			$animations = frenifyCore_Plugin::animations( array(
				'type'	  => self::$args['animation_type'],
				'direction' => self::$args['animation_direction'],
				'speed'	 => self::$args['animation_speed'],
			) );
			
			$attr = array_merge( $attr, $animations );
			
			$attr['class'] .= ' ' . $attr['animation_class']; 

			unset($attr['animation_class']);
		}

		if( self::$args['class'] ) {
			$attr['class'] .= ' ' . self::$args['class'];
		}

//		if( self::$args['id'] ) {
//			$attr['id'] = self::$args['id'];
//		}

		return $attr;

	}

	function icon_attr() {

		$attr = array();

		$attr['class'] = sprintf( '%s',  self::$args['icon'] );

		return $attr;

	}


	function button_attr() {

		$attr = array();

		if( $this->alert_class == 'custom' ) {
			$attr['style'] = sprintf( 'color:%s;border-color:%s;', self::$args['accent_color'], self::$args['accent_color'] );
			 
		}

		$attr['type'] = 'button';
		$attr['class'] = 'close toggle-alert';
		$attr['data-dismiss'] = 'alert';
		$attr['aria-hidden'] = 'true';
		
		
		return $attr;

	}

}

new frenifySC_Alert();