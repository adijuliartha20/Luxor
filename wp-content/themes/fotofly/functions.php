<?php

	add_action( 'after_setup_theme', 'fotofly_fn_setup', 50 );

	function fotofly_fn_setup(){

			// REGISTER THEME MENU
			if(function_exists('register_nav_menus')){
				register_nav_menus(array('main_menu' 	=> esc_html__('Main Menu','fotofly')));
				register_nav_menus(array('mobile_menu' 	=> esc_html__('Mobile Menu','fotofly')));
			}

			// This theme styles the visual editor with editor-style.css to match the theme style.
			add_action( 'wp_enqueue_scripts', 'fotofly_fn_scripts', 100 ); 
			add_action( 'wp_enqueue_scripts', 'fotofly_fn_styles', 100 );
			add_action( 'wp_enqueue_scripts', 'fotofly_fn_inline_styles', 150 );
			add_action( 'admin_enqueue_scripts', 'fotofly_fn_admin_scripts' );
		
			// Actions
			add_action( 'tgmpa_register', 'fotofly_fn_register_required_plugins' );
		
			// Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
			add_theme_support( 'post-formats', array('video','audio','gallery','image','link','quote') );
		
			// This theme uses post thumbnails
			add_theme_support( 'post-thumbnails' );
		
			set_post_thumbnail_size( 300, 300, true ); 								// Normal post thumbnails
		
			add_image_size( 'fotofly_fn_thumb-9999-700', 9999, 700, false);			// Justified Images
			add_image_size( 'fotofly_fn_thumb-800-800', 800, 800, true);			// Portfolio Categories
			add_image_size( 'fotofly_fn_thumb-720-9999', 720, 9999, false);			// Portfolio Page
			add_image_size( 'fotofly_fn_thumb-300-300', 300, 300, true);			// Clients, Commentary
		
			//Load Translation Text Domain
			load_theme_textdomain( 'fotofly', get_template_directory() . '/languages' );
		
			// Firing Title Tag Function
			fotofly_fn_theme_slug_setup();
		
			if ( ! isset( $content_width ) ) $content_width = 1170;
		
			// Add default posts and comments RSS feed links to head
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'wp_list_comments' );
		
			add_editor_style() ;
		
		
		
		
			
		/* ------------------------------------------------------------------------ */
		/*  Inlcudes
		/* ------------------------------------------------------------------------ */
			include_once( get_template_directory().'/inc/fotofly_fn_functions.php'); 				// Custom Functions
			include_once( get_template_directory().'/inc/fotofly_fn_googlefonts.php'); 				// Google Fonts Init
			include_once( get_template_directory().'/inc/fotofly_fn_css.php'); 						// Inline Css
			include_once( get_template_directory().'/inc/fotofly_fn_sidebars.php'); 				// Widget Area
			include_once( get_template_directory().'/inc/fotofly_fn_megamenu.php'); 				// Megamenu
			include_once( get_template_directory().'/inc/fotofly_fn_pagination.php'); 				// Pagination
			include_once( get_template_directory().'/config/config-woo/config.php'); 				// WooCommerce
		
			
			include_once( get_template_directory().'/inc/widgets/widget-about.php'); 				// Load Widgets
			
			
	}




/* ----------------------------------------------------------------------------------- */
/*  ENQUEUE STYLES AND SCRIPTS
/* ----------------------------------------------------------------------------------- */
	function fotofly_fn_scripts() {
		wp_enqueue_script('modernizr.custom', get_template_directory_uri() . '/framework/js/modernizr.custom.js', array('jquery'), '1.0', FALSE);
		wp_enqueue_script('ie8', get_template_directory_uri() . '/framework/js/ie8.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('nicescroll', get_template_directory_uri() . '/framework/js/nicescroll.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('countto', get_template_directory_uri() . '/framework/js/countto.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('isotope', get_template_directory_uri() . '/framework/js/isotope.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/framework/js/magnific-popup.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('sticky-sidebar', get_template_directory_uri() . '/framework/js/sticky-sidebar.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('resizesensor', get_template_directory_uri() . '/framework/js/resizesensor.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('jarallax', get_template_directory_uri() . '/framework/js/jarallax.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('fotofly-fn-custom-slider', get_template_directory_uri() . '/framework/js/custom-slider.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('cycle', get_template_directory_uri() . '/framework/js/cycle.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('waypoints', get_template_directory_uri() . '/framework/js/waypoints.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('fotofly-fn-accordion', get_template_directory_uri() . '/framework/js/accordion.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('easytabs', get_template_directory_uri() . '/framework/js/easytabs.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('flickity', get_template_directory_uri() . '/framework/js/flickity.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('vimeo-player', get_template_directory_uri() . '/framework/js/vimeo-player.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('mbyt-player', get_template_directory_uri() . '/framework/js/mbyt-player.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('charming', get_template_directory_uri() . '/framework/js/charming.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('anime', get_template_directory_uri() . '/framework/js/anime.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('textfx', get_template_directory_uri() . '/framework/js/textfx.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/framework/js/owl-carousel.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('event-move', get_template_directory_uri() . '/framework/js/event-move.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('scrollto', get_template_directory_uri() . '/framework/js/scrollto.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('fotofly-fn-woocommerce', get_template_directory_uri().'/config/config-woo/woocommerce.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('lightgallery', get_template_directory_uri() . '/framework/js/lightgallery.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('justified', get_template_directory_uri() . '/framework/js/justified.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('fotofly-fn-init', get_template_directory_uri() . '/framework/js/init.js', array('jquery'), '1.0', TRUE);
		if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
		
		wp_script_add_data( 'ie8', 'conditional', 'lt IE 10' );
	}
	
	function fotofly_fn_admin_scripts() {
		wp_enqueue_script('widget-upload', get_template_directory_uri() . '/framework/js/widget-upload.js', array('jquery'), '1.0', FALSE);
		wp_enqueue_script('fotofly-fn-meta-sortable', get_template_directory_uri() . '/framework/js/meta-sortable.js', array('jquery'), '1.0', FALSE);
		wp_enqueue_style('fotofly-fn-meta-sortable', get_template_directory_uri().'/framework/css/meta-sortable.css', array(), '1.0', 'all');
	}

	function fotofly_fn_styles(){
		wp_enqueue_style('fotofly-fn-woocommerce', get_template_directory_uri().'/config/config-woo/woocommerce.css');
		wp_enqueue_style('lightgallery', get_template_directory_uri().'/framework/css/lightgallery.css', array(), '1.0', 'all');
		wp_enqueue_style('justified', get_template_directory_uri().'/framework/css/justified.css', array(), '1.0', 'all');
		wp_enqueue_style('fotofly-fn-base', get_template_directory_uri().'/framework/css/base.css', array(), '1.0', 'all');
		wp_enqueue_style('fotofly-fn-skeleton', get_template_directory_uri().'/framework/css/skeleton.css', array(), '1.0', 'all');
		wp_enqueue_style('magnific-popup', get_template_directory_uri().'/framework/css/magnific-popup.css', array(), '1.0', 'all');
		wp_enqueue_style('perfect-scrollbar', get_template_directory_uri().'/framework/css/perfect-scrollbar.css', array(), '1.0', 'all');
		wp_enqueue_style('flickity', get_template_directory_uri().'/framework/css/flickity.css', array(), '1.0', 'all');
		wp_enqueue_style('vimeo-player', get_template_directory_uri().'/framework/css/vimeo-player.css', array(), '1.0', 'all');
		wp_enqueue_style('letter-effect', get_template_directory_uri().'/framework/css/letter-effect.css', array(), '1.0', 'all');
		wp_enqueue_style('owl-carousel', get_template_directory_uri().'/framework/css/owl-carousel.css', array(), '1.0', 'all');
		wp_enqueue_style('flexslider', get_template_directory_uri().'/framework/css/flexslider.css', array(), '1.0', 'all');
		wp_enqueue_style('fontello', get_template_directory_uri().'/framework/css/fontello.css', array(), '1.0', 'all');
		wp_enqueue_style('animation', get_template_directory_uri().'/framework/css/animation.css', array(), '1.0', 'all');
		wp_enqueue_style('fotofly-fn-stylesheet', get_stylesheet_uri(), array(), '1', 'all' ); // Main Stylesheet
	}




/* ----------------------------------------------------------------------------------- */
/*  Title tag: works WordPress v4.1 and above
/* ----------------------------------------------------------------------------------- */
	function fotofly_fn_theme_slug_setup() {
		add_theme_support( 'title-tag' );
	}

	
/*-----------------------------------------------------------------------------------*/
/*	TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/

require_once get_template_directory().'/plugin/class-tgm-plugin-activation.php';

function fotofly_fn_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		array(
			'name'               => 'Frenify Plugin', // The plugin name.
			'slug'               => 'frenify-plugin', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/plugin/frenify-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),
		array(
			'name'               => 'Redux Framework', // The plugin name.
			'slug'               => 'redux-framework', // The plugin slug (typically the folder name).
			'source'             => 'https://github.com/reduxframework/redux-framework/archive/master.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => 'https://github.com/reduxframework/redux-framework', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'fotofly',            // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}



?>