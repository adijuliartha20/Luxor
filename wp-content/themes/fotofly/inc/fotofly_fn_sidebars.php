<?php

/* ------------------------------------------------------------------------ */
/* Define Sidebars */
/* ------------------------------------------------------------------------ */

add_action( 'widgets_init', 'fotofly_fn_widgets_init', 1000 );


function fotofly_fn_widgets_init() {
	if (function_exists('register_sidebar')) {
		
		global $fotofly_fn_option;
		
		if(isset($fotofly_fn_option['footer_widget_switch']) && isset($fotofly_fn_option['footer_switch']) && $fotofly_fn_option['footer_widget_switch'] === 'enable' && $fotofly_fn_option['footer_switch'] === 'enable'){
			/* ------------------------------------------------------------------------ */
			/* Footer Widgets
			/* ------------------------------------------------------------------------ */
			switch($fotofly_fn_option['footer_cols']){
					case 'col1': $number = 1;break;
					case 'col2': $number = 2;break;
					case 'col3': $number = 3;break;
					case 'col4': $number = 4;break;
					default: $number = 3;break;
				}
			for($counter = 1; $counter <= $number; $counter++){
				register_sidebar(array(
					'name' => 'Footer Widget '.$counter,
					'id'   => 'footer-widget-'.$counter,
					'description'   => esc_html__('These are widgets for footer.', 'fotofly'),
					'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
					'after_widget'  => '</div></div>',
					'before_title'  => '<div class="wid-title"><span>',
					'after_title'   => '</span></div>'
				));
			}
		}
		
		/* ------------------------------------------------------------------------ */
		/* Sidebar Widgets
		/* ------------------------------------------------------------------------ */
		register_sidebar(array(
			'name' => 'Main Sidebar',
			'id'   => 'main-sidebar',
			'description'   => esc_html__('These are widgets for the sidebar.', 'fotofly'),
			'before_widget' => '<div id="%1$s" class="widget_block clear %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
		
		register_sidebar(array(
			'name' => 'Toggle Sidebar',
			'id'   => 'toggle-sidebar',
			'description'   => esc_html__('These are widgets for toggle sidebar.', 'fotofly'),
			'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
		
		register_sidebar(array(
			'name' => 'WooCommerce Sidebar',
			'id'   => 'woocommerce-sidebar',
			'description'   => esc_html__('These are widgets for woocommerce sidebar.', 'fotofly'),
			'before_widget' => '<div id="%1$s" class="widget_block clearfix %2$s"><div>',
			'after_widget'  => '</div></div>',
			'before_title'  => '<div class="wid-title"><span>',
			'after_title'   => '</span></div>'
		));
	}
}

    
?>