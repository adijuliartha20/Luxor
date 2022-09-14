<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "redux_demo";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */


	/* ADDED BY FRENIFY (from version 1.0.0.9) */
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );   
		}
	}
	add_action('init', 'removeDemoModeLink');
	/* ADDED BY FRENIFY (from version 1.0.0.9) */


    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        'page_title'           => __( 'Theme Options', 'redux-framework-demo' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => '',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => 'fotofly_fn_option',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '_options',
        // Page slug used to denote the panel
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        //'compiler'             => true,

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

// Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
//        $args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
    } else {
        $args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
    }

    // Add content after the form.
    $args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
    Redux::setHelpSidebar( $opt_name, $content );
    /*
     * ---> END ARGUMENTS
     */

  

    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */

    // -> START Basic Fields
    $adminURL = '<a href="'.admin_url('options-permalink.php').'">'.esc_html__('Here', 'fotofly').'</a>';	 
	$permalink_description = __('After changing this, go to following link and click save. '.$adminURL.'', 'redux-framework-demo');
	/*-----------------------------------------------------------------------------------------------------*/
	/*----------------------------------------- CUSTOM THEME OPTIONS --------------------------------------*/
	/*-----------------------------------------------------------------------------------------------------*/
	
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'General', 'redux-framework-demo' ),
        'id'    => 'general',
        'icon'  => 'el el-globe',
		'fields' 	=> array(
		
			array(
				'id'		=> 'theme_skin',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Theme Skin', 'redux-framework-demo'),
				"default" 	=> 'light',
				'options' 	=> array(
								'light'  		=> esc_html__('Light','fotofly'), 
								'dark' 			=> esc_html__('Dark','fotofly')),
								
			),
			array(
				'id'		=> 'theme_bordered_style',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Theme Border Type', 'redux-framework-demo'),
				"default" 	=> 'none',
				'options' 	=> array(
								'none'  		=> esc_html__('None','fotofly'), 
								'big'  			=> esc_html__('Big','fotofly'), 
								'small' 		=> esc_html__('Small','fotofly')),
								
			),
			array(
				'id'		=> 'theme_border_big_color',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Border Skin', 'redux-framework-demo'),
				"default" 	=> 'light',
				'options' 	=> array(
								'light'  		=> esc_html__('Light','fotofly'), 
								'dark' 			=> esc_html__('Dark','fotofly')),
				'required' => array( 'theme_bordered_style', '=', array('big') ),				
			),
			array(
				'id'		=> 'theme_border_small_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Border Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
				'required' => array( 'theme_bordered_style', '=', array('small') ),	
			),
			array(
				'id'		=> 'click_sound',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Click Sound', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('It works when you click on buttons, links, input areas and etc.', 'redux-framework-demo'),
				'default' 	=> 'disable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable','fotofly'), 
								'disable' 		=> esc_html__('Disable','fotofly')),			
			),
			array(
				'id'		=> 'click_sound_upload',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Your Sound', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required' => array( 'click_sound', '=', array('enable') ),	
			),
			array(
				'id'		=> 'totop_button',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('To Top Scrolling Button', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('It works on screens that above 1040px.', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable','fotofly'), 
								'disable' 		=> esc_html__('Disable','fotofly')),
								
			),
			array(
				'id' 		=> 'right_click',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Right Click Protection', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Enable / Disable', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable','fotofly'), 
								'disable' 		=> esc_html__('Disable','fotofly')),
			),
			array(
				'id' 		=> 'right_click_text',
				'type' 		=> 'textarea',
				'title' 	=> esc_html__('Right Click Popup Message', 'redux-framework-demo'),
				'default' 	=> 'Images are copyrighted by their respective owner and you don’t have permission to download them.',
				'required' => array( 'right_click', '=', 'enable' ),
			),	
			array(
				'id' 		=> 'open_graph_meta',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Open Graph Meta', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('If you disable this, social sharing may not work properly.', 'redux-framework-demo'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id'		=> 'split_content_pos',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Split Page Content Position', 'redux-framework-demo'),
				"default" 	=> 'right',
				'options' 	=> array(
								'left'  		=> 'Left',
								'right' 		=> 'Right'),
			),
			array(
				'id' 		=> 'purchase_btn_text',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Purchase Button Text', 'redux-framework-demo'),
				'subtitle' 	=> '',
				"default" 	=> esc_html__('Purchase', 'redux-framework-demo'),
			),
			array(
				'id'		=> 'shortcode_preview_image',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Shortcode Preview Image', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('This is a visual look of each shortcode. Not recommended to disable.', 'redux-framework-demo'),
				'default' 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable','fotofly'), 
								'disable' 		=> esc_html__('Disable','fotofly')),			
			),
			array(
				'id'		=> 'thumb_for_search',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Thumbnail Image in Search Results', 'redux-framework-demo'),
				'default' 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable','fotofly'), 
								'disable' 		=> esc_html__('Disable','fotofly')),			
			),
			
		)
	));
	Redux::setSection( $opt_name, array(
			'title' => esc_html__( 'Colors', 'redux-framework-demo' ),
			'id'    => 'main_color',
			'icon'  => 'el el-brush ',
			'fields' 	=> array(
			
			array(
				'id'		=> 'primary_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Primary Color', 'redux-framework-demo'),
				'default' 	=> '#eb1010',
				'validate' 	=> 'color',
				'required' 	=> array( 'body_color_switch', '=', array('disable') ),
			),
			array(
				'id'		=> 'box_shadow_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Main Shadow Color', 'redux-framework-demo'),
				'default' 	=> '#eb1010',
				'validate' 	=> 'color',
			),
			array(
				'id'        => 'box_shadow_opacity',
				'type'      => 'slider',
				'title'     => esc_html__('Main Shadow Transparency', 'redux-framework-demo'),
				"default"   => 0.3,
				"min"       => 0.01,
				"step"      => 0.01,
				"max"       => 1,
				'resolution' => 0.1,
				'display_value' => 'text'
			),
			array(
				'id'		=> 'body_color_switch',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable/Disable Custom Colors', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo')),
			),
			// ----------------------------------------------------------------------------------------------
			// Section Start 
			// ----------------------------------------------------------------------------------------------
			array(
			   	'id' 		=> 'body_color_section_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Custom Colors', 'redux-framework-demo'),
			   	'indent' 	=> true,
			  	'required'  => array( 'body_color_switch', '=', array('enable') ),
			),
				array(
					'id'		=> 'link_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Link Color', 'redux-framework-demo'),
					'default' 	=> '#eb1010',
					'validate' 	=> 'color',
				),
				array(
					'id'		=> 'heading_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Heading Color', 'redux-framework-demo'),
					'default' 	=> '#111',
					'validate' 	=> 'color',
				),
				array(
					'id'		=> 'body_color',
					'type' 		=> 'color',
					'transparent' => false,
					'title' 	=> esc_html__('Body Color', 'redux-framework-demo'),
					'default' 	=> '#555',
					'validate' 	=> 'color',
				),
			array(
				'id'     	=> 'body_color_section_end',
				'type'   	=> 'section',
				'indent' 	=> false,
				'required'  => array( 'intro_m_switcher', '=', array('enable') ),
			),
			// ----------------------------------------------------------------------------------------------
			// Section End 
			// ----------------------------------------------------------------------------------------------
		)
	));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Logo Options', 'redux-framework-demo' ),
        'id'    => 'logo',
        'icon'  => 'el el-puzzle',
		'fields' 	=> array(
		
			array(
				'id' 		=> 'fotofly_fn_logo_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Logo Type', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Choose the logo type.', 'redux-framework-demo'),
				"default" 	=> 'image',
				'options' 	=> array(
								'image'  		=> esc_html__('Image','fotofly'), 
								'svg'  			=> esc_html__('SVG file','fotofly'), 
								'text' 			=> esc_html__('Text','fotofly')),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_img_light',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Light Logo', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('We suggest to use png logo.', 'redux-framework-demo'),
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('image') ),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_img_dark',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Dark Logo', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('We suggest to use png logo.', 'redux-framework-demo'),
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('image') ),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_img_info',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Notice! For LOGO IMAGE max width = 200px, max height = 150px.', 'redux-framework-demo'),
				'required'  => array('fotofly_fn_logo_type', '=', array('image') ),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_svg_info',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Warning! In order to use the svg file as your website\'s logo, you need to change the contents of the two files:
				1. framework/img/svg/logo-svg-light.svg
				2. framework/img/svg/logo-svg-dark.svg
				These two files will be used as a logo in two versions of the header. If you want one file to remain as a logo in both versions of the header, you need to change the contents of these two files by the code of your svg file.', 'redux-framework-demo'),
				'required'  => array('fotofly_fn_logo_type', '=', array('svg') ),
			),
			
			array(
				'id'		=> 'fotofly_fn_logo_svg_lightcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Logo Light Color', 'redux-framework-demo'),
				'default' 	=> '',
				'validate' 	=> 'color',
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('svg') ),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_svg_darkcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Logo Dark Color', 'redux-framework-demo'),
				'default' 	=> '',
				'validate' 	=> 'color',
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('svg') ),
			),
		
			array(
				'id' 		=> 'fotofly_fn_logo_svg_w',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Logo Width', 'redux-framework-demo'),
                'subtitle'  => esc_html__( 'In px.', 'redux-framework-demo' ),
				"default" 	=> "120",
				"min" 		=> "20",
				"step" 		=> "5",
				"max" 		=> "200",
				'required'  => array('fotofly_fn_logo_type', '=', array('svg')),
			),
		
			array(
				'id' 		=> 'fotofly_fn_logo_svg_h',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Logo Height', 'redux-framework-demo'),
                'subtitle'  => esc_html__( 'In px.', 'redux-framework-demo' ),
				"default" 	=> "80",
				"min" 		=> "20",
				"step" 		=> "5",
				"max" 		=> "150",
				'required'  => array('fotofly_fn_logo_type', '=', array('svg')),
			),
			
			array(
				'id'		=> 'fotofly_fn_logo_text',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Logo Text', 'redux-framework-demo'),
				'default' 	=> "Fotofly",
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('text') ),
			),
			
			array(
				'id'		=> 'fotofly_fn_logo_text_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Logo Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the logo font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '60px',
					'font-family' 	=> 'Giorgia Italic',
					'font-weight' 	=> '400',
				),
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('text') ),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_text_lightcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Logo Light Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('text') ),
			),
		
			array(
				'id'		=> 'fotofly_fn_logo_text_darkcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Logo Dark Color', 'redux-framework-demo'),
				'default' 	=> '#111',
				'validate' 	=> 'color',
				'required' 	=> array( 'fotofly_fn_logo_type', '=', array('text') ),
			),
		
		)
	));

	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Navigation', 'redux-framework-demo' ),
        'id'    => 'navigation',
        'icon'  => 'el el-th',
		'fields' 	=> array(
			
			
					
			array(
				'id'		=> 'nav_temp',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Navigation Type', 'redux-framework-demo'),
				"default" 	=> 'middle_logo',
				'options' 	=> array(
								'middle_logo'  		=> esc_html__('Middle Logo', 'redux-framework-demo'), 
								'center_logo'  		=> esc_html__('Center Logo', 'redux-framework-demo'), 				
								'left_logo' 		=> esc_html__('Left Logo', 'redux-framework-demo'),
								'fixed_hamburger' 	=> esc_html__('Fixed Hamburger', 'redux-framework-demo')),				
			),
			
			array(
				'id' 		=> 'menu_position',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Menu Position', 'redux-framework-demo'),
				"default" 	=> 'right',
				'options' 	=> array(
								'left'  	=> esc_html__('Left', 'redux-framework-demo'),
								'center'  	=> esc_html__('Center', 'redux-framework-demo'),
								'right'  	=> esc_html__('Right', 'redux-framework-demo')),	
				
				'required' => array( 'nav_temp', '=', array('left_logo') ),
			),
			
			array(
				'id'		=> 'nav_skin',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Navigation Skin', 'redux-framework-demo'),
				"default" 	=> 'dark',
				'options' 	=> array(
								'dark'  		=> esc_html__('Dark', 'redux-framework-demo'),
								'light'  		=> esc_html__('Light', 'redux-framework-demo'),
								'transdark'  	=> esc_html__('Transdark', 'redux-framework-demo'),
								'translight'  	=> esc_html__('Translight', 'redux-framework-demo'),
								'nonedark'  	=> esc_html__('Nonedark', 'redux-framework-demo'),
								'nonelight'  	=> esc_html__('Nonelight', 'redux-framework-demo')),
				'required' => array( 'nav_temp', '=', array('middle_logo','center_logo','left_logo') ),
			),
		
			array(
				'id'		=> 'nav_skin_special',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Navigation Skin for 404, search and archive pages', 'redux-framework-demo'),
				"default" 	=> 'dark',
				'options' 	=> array(
								'dark'  		=> esc_html__('Dark', 'redux-framework-demo'),
								'light'  		=> esc_html__('Light', 'redux-framework-demo'),
								'transdark'  	=> esc_html__('Transdark', 'redux-framework-demo'),
								'translight'  	=> esc_html__('Translight', 'redux-framework-demo'),
								'nonedark'  	=> esc_html__('Nonedark', 'redux-framework-demo'),
								'nonelight'  	=> esc_html__('Nonelight', 'redux-framework-demo')),
				'required' => array( 'nav_temp', '=', array('middle_logo','center_logo','left_logo') ),
			),
			
			array(
				'id'		=> 'sticky_nav_switcher',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Sticky Navigation', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo')),
		
				'required' => array( 'nav_temp', '!=', array('fixed_hamburger') ),
			),
			array(
				'id' 		=> 'hamburger_position',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Hamburger Position', 'redux-framework-demo'),
				"default" 	=> 'onlyhamburger',
				'options' 	=> array(
								'hamburger_top'  		=> esc_html__('Hamburger Top', 'redux-framework-demo'),
								'onlyhamburger'  		=> esc_html__('Hamburger Center', 'redux-framework-demo'),
								'hamburger_bottom'  	=> esc_html__('Hamburger Bottom', 'redux-framework-demo')),	
				
				'required' => array( 'nav_temp', '=', array('fixed_hamburger') ),
			),
			array(
				'id' 		=> 'vermenu_bg',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Vertical Menu Background Color', 'redux-framework-demo'),
				"default" 	=> 'white',
				'options' 	=> array(
								'white'  				=> esc_html__('White', 'redux-framework-demo'),
								'black'  				=> esc_html__('Black', 'redux-framework-demo'),
								'gray'  				=> esc_html__('Gray', 'redux-framework-demo'),
								'transdark'  			=> esc_html__('TransDark', 'redux-framework-demo'),
								'translight'  			=> esc_html__('TransLight', 'redux-framework-demo')),	
				
				'required' => array( 'nav_temp', '=', array('fixed_hamburger') ),
			),
			array(
					'id' 		=> 'nav_search',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Enable/Disable Navigation Search', 'redux-framework-demo'),
					'options' 	=> array(
						'enable'    => esc_html__('Enable', 'fotofly'),
						'disable'   => esc_html__('Disable', 'fotofly')), //Must provide key => value pairs for radio options
					'default' 	=> 'enable'
			),
			array(
					'id' 		=> 'nav_share',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Enable/Disable Navigation Share', 'redux-framework-demo'),
					'options' 	=> array(
						'enable' 	=> esc_html__('Enable', 'fotofly'),
						'disable' 	=> esc_html__('Disable', 'fotofly')), //Must provide key => value pairs for radio options
					'default' 	=> 'enable'
			),
			array(
					'id' 		=> 'hamburger_menu',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Enable/Disable Hamburger Menu', 'redux-framework-demo'),
					'options' 	=> array(
						'enable'	=> esc_html__('Enable', 'fotofly'),
						'disable' 	=> esc_html__('Disable', 'fotofly')), //Must provide key => value pairs for radio options
					'default' 	=> 'enable'
			),
			array(
					'id' 		=> 'toggle_sidebar_skin',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('Toggle Sidebar Skin', 'redux-framework-demo'),
					'options' 	=> array(
					'dark' 		=> esc_html__('Dark','fotofly'),
					'light' 	=> esc_html__('Light','fotofly')), //Must provide key => value pairs for radio options
					'default' 	=> 'dark'
			),
			array(
					'id'		=> 'megamenu_cols',
					'type' 		=> 'button_set',
					'title' 	=> esc_html__('MegaMenu Columns Number', 'redux-framework-demo'),
					"default" 	=> 'col4',
					'options' 	=> array(
									'col3'  		=> esc_html__('3 Columns', 'fotofly'),
									'col4'  		=> esc_html__('4 Columns', 'fotofly'),
									'col5'  		=> esc_html__('5 Columns', 'fotofly')),
			)
		)
    ));

	
	Redux::setSection( $opt_name, array(
        'title' => __( 'Share Options', 'fotofly' ),
        'id'    => 'sharebox',
        'icon'  => 'el el-share-alt',
		'fields' 	=> array(  
			array(
				'id' 		=> 'portfolio_share_icon',
				'type' 		=> 'button_set',
				'title' 	=> __('Enable/Disable Portfolio Share Icon', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_facebook',
				'type' 		=> 'button_set',
				'title' 	=> __('Facebook Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_twitter',
				'type' 		=> 'button_set',
				'title' 	=> __('Twitter Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_google',
				'type' 		=> 'button_set',
				'title' 	=> __('Google Plus Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_pinterest',
				'type' 		=> 'button_set',
				'title' 	=> __('Pinterest Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'enable'
			),
			array(
				'id' 		=> 'share_linkedin',
				'type' 		=> 'button_set',
				'title' 	=> __('Linkedin Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'disable'
			),
			array(
				'id' 		=> 'share_email',
				'type' 		=> 'button_set',
				'title' 	=> __('Email Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'disable'
			),
			array(
				'id' 		=> 'share_vk',
				'type' 		=> 'button_set',
				'title' 	=> __('Vkontakte Share', 'fotofly'),
				'options' 	=> array('enable' => 'Enable', 'disable' => 'Disable'), //Must provide key => value pairs for radio options
				'default' 	=> 'disable'
			),
		)
    ));
	
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Typography', 'redux-framework-demo' ),
        'id'    => 'typography',
        'icon'  => 'el el-font',
		'fields' 	=> array(
			array(
				'id'		=> 'body_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Body Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the body font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '15px',
					'font-family' 	=> 'Anonymous Pro',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'nav_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Navigation Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the navigation font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '14px',
					'font-family' 	=> 'Poppins',
					'font-weight' 	=> '400',
				),
			),
		
			array(
				'id'		=> 'input_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Input Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the Input font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '15px',
					'font-family' 	=> 'Anonymous Pro',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'blockquote_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Blockquote Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the blockquote font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '14px',
					'font-family' 	=> 'Lora',
					'font-weight' 	=> '400',
				),
			),
			array(
				'id'		=> 'heading_font',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('Heading Font', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the heading font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' 	=> false,
				'font-size' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-family' 	=> 'Poppins',
					'font-weight' 	=> '400',
				),
			),
		
			array(
				'id'		=> 'fotofly_fn_twst',
				'type' 		=> 'typography',
				'title' 	=> esc_html__('For Title Shortcode', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Specify the title shortcode font properties.', 'redux-framework-demo'),
				'google' 	=> true,
				'preview'	=> false,
				'line-height'=>false,
				'color' => false,
				'text-align' => false,
				'default' 	=> array(
					'font-size' 	=> '15px',
					'font-family' 	=> 'Kalam',
					'font-weight' 	=> '400',
				),
			),
		)
    ));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Intro', 'redux-framework-demo' ),
        'id'    => 'intro_page',
        'icon'  => 'el el-arrow-right',
		'fields' 	=> array(
			array(
				'id'		=> 'intro_switcher',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Intro Enable/Disable', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable' 		=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 		=> esc_html__('Disable', 'redux-framework-demo'),),
			),
			array(
				'id'		=> 'intro_template',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Intro Template', 'redux-framework-demo'),
				"default" 	=> 'intro-main',
				'options' 	=> array(
								'intro-main' 					=> esc_html__('Main', 'redux-framework-demo'),
								'intro-text-slider' 			=> esc_html__('Text Slider', 'redux-framework-demo'),
								'intro-about' 					=> esc_html__('About #1', 'redux-framework-demo'),
								'intro-about-2' 				=> esc_html__('About #2', 'redux-framework-demo'),
								'intro-about-3' 				=> esc_html__('About #3', 'redux-framework-demo'),
								'intro-about-4' 				=> esc_html__('About #4', 'redux-framework-demo'),
								'intro-interactive-list' 		=> esc_html__('Interactive List', 'redux-framework-demo'),
								'intro-two-col-slide' 			=> esc_html__('Two Columns Slide', 'redux-framework-demo'),
								),
				'required'  => array( 'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_closer_button',
				'type' 		=> 'button_set',
				'multi' 	=> 'true',
				'title' 	=> esc_html__('Intropage Close Keys', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('Select the keys that respond to the closure of Intropage.', 'redux-framework-demo'),
				"default" 	=> '13',
				'options' 	=> array(
								'8' 			=> esc_html__('Backspace', 'redux-framework-demo'),
								'13' 			=> esc_html__('Enter', 'redux-framework-demo'),
								'27' 			=> esc_html__('Escape', 'redux-framework-demo'),
								'32' 			=> esc_html__('Space', 'redux-framework-demo'),
								'37' 			=> esc_html__('Left Arrow', 'redux-framework-demo'),
								'39' 			=> esc_html__('Right Arrow', 'redux-framework-demo'),
								'38' 			=> esc_html__('Up Arrow', 'redux-framework-demo'),
								'40' 			=> esc_html__('Down Arrow', 'redux-framework-demo'),
								),
				'required'  => array( 'intro_switcher', '=', array('enable') ),
			),
			array(
                'id'          => 'intro_interactive_add',
                'type'        => 'slides',
                'title'       => esc_html__( 'Slides Options', 'redux-framework-demo' ),
                'subtitle'    => esc_html__( 'Unlimited slides with drag and drop sortings.', 'redux-framework-demo' ),
                'placeholder' => array(
                    'title'       => esc_html__( 'This title will be looped.', 'redux-framework-demo' ),
                    'description' => esc_html__( 'Description Here', 'redux-framework-demo' ),
                    'url'         => esc_html__( 'Give us a link!', 'redux-framework-demo' ),
                ),
				'required'  => array( 'intro_template', '=', array('intro-interactive-list','intro-two-col-slide'),'intro_switcher', '=', array('enable') ),
            ),
			array(
				'id'		=> 'intro_interactive_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Title Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
				'required'  => array('intro_template', '=', array('intro-interactive-list','intro-two-col-slide'),  'intro_switcher', '=', array('enable')),
			),
			array(
				'id'		=> 'intro_a4_img_pos',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Image Position', 'redux-framework-demo'),
				"default" 	=> 'right',
				'options' 	=> array(
								'left' 		=> esc_html__('Left', 'redux-framework-demo'),
								'right' 	=> esc_html__('Right', 'redux-framework-demo'),),
				'required'  => array( 'intro_template', '=', array('intro-about-4'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_a3_i1',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload #1 Image', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about-3'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_a3_i2',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload #2 Image', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about-3'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_a3_i3',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload #3 Image', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about-3'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_about_pos',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Content Position', 'redux-framework-demo'),
				"default" 	=> 'left',
				'options' 	=> array(
								'left' 		=> esc_html__('Left', 'redux-framework-demo'),
								'right' 	=> esc_html__('Right', 'redux-framework-demo'),
								),
				'required'  => array( 'intro_template', '=', array('intro-about'), 'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_profile_img',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Profile Image', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about','intro-about-2','intro-about-4'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_sign',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Your Sign', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about','intro-about-2','intro-about-4'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id' 		=> 'intro_profile_name',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Enter Your Name', 'redux-framework-demo'),
				'subtitle' 	=> '',
				"default" 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about','intro-about-2','intro-about-4'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_profile_name_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Name Color', 'redux-framework-demo'),
				'default' 	=> '#bbb',
				'validate' 	=> 'color',
				'required'  => array('intro_template', '=', array('intro-about','intro-about-2','intro-about-4'),  'intro_switcher', '=', array('enable')),
			),
			array(
				'id' 		=> 'intro_info',
				'type' 		=> 'textarea',
				'title' 	=> esc_html__('Enter Content', 'redux-framework-demo'),
				'subtitle' 	=> '',
				"default" 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-about','intro-about-2','intro-about-3','intro-about-4'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_info_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Content Color', 'redux-framework-demo'),
				'default' 	=> '#999',
				'validate' 	=> 'color',
				'required'  => array('intro_template', '=', array('intro-about','intro-about-2','intro-about-3','intro-about-4'),  'intro_switcher', '=', array('enable')),
			),
			array(
                'id'          => 'intro_slides_add',
                'type'        => 'slides',
                'title'       => esc_html__( 'Slides Options', 'redux-framework-demo' ),
                'subtitle'    => esc_html__( 'Unlimited slides with drag and drop sortings.', 'redux-framework-demo' ),
                'placeholder' => array(
                    'title'       => esc_html__( 'This title will be looped.', 'redux-framework-demo' ),
                    'description' => esc_html__( 'Description Here', 'redux-framework-demo' ),
                    'url'         => esc_html__( 'Give us a link!', 'redux-framework-demo' ),
                ),
				'required'  => array( 'intro_template', '=', array('intro-text-slider'),'intro_switcher', '=', array('enable') ),
            ),
			array(
				'id'		=> 'intro_slides_title_animation',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Animation type of Title', 'redux-framework-demo'),
				"default" 	=> 'fx2',
				'options' 	=> array(
								'fx1' => '1','fx2' => '2','fx3' => '3','fx4' => '4','fx5' => '5','fx6' => '6','fx7' => '7','fx8' => '8','fx9' => '9','fx10' => '10','fx11' => '11','fx12' => '12','fx13' => '13','fx14' => '14','fx15' => '15','fx16' => '16','fx17' => '17','fx18' => '18',
								),
				'required'  => array('intro_template', '=', array('intro-text-slider'), 'intro_switcher', '=', array('enable') ),
			),
			array(
				'id' 		=> 'intro_slides_animation_delay',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Slide Interval', 'redux-framework-demo'),
                'subtitle'  => esc_html__( 'In milliseconds. For exm: 3000ms = 3s.', 'redux-framework-demo' ),
				"default" 	=> "4000",
				"min" 		=> "2000",
				"step" 		=> "100",
				"max" 		=> "10000",
				'required'  => array('intro_template', '=', array('intro-text-slider'), 'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_slides_title_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Title Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
				'required'  => array('intro_template', '=', array('intro-text-slider'),  'intro_switcher', '=', array('enable')),
			),
			array(
				'id'		=> 'intro_content_pos',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Content Position', 'redux-framework-demo'),
				"default" 	=> 'left-bottom',
				'options' 	=> array(
								'left-top' 			=> esc_html__('Left Top', 'redux-framework-demo'),
								'center-top' 		=> esc_html__('Center Top', 'redux-framework-demo'),
								'right-top' 		=> esc_html__('Right Top', 'redux-framework-demo'),
								'left-middle' 		=> esc_html__('Left Middle', 'redux-framework-demo'),
								'center-middle' 	=> esc_html__('Center Middle', 'redux-framework-demo'),
								'right-middle' 		=> esc_html__('Right Middle', 'redux-framework-demo'),
								'left-bottom' 		=> esc_html__('Left Bottom', 'redux-framework-demo'),
								'center-bottom' 	=> esc_html__('Center Bottom', 'redux-framework-demo'),
								'right-bottom' 		=> esc_html__('Right Bottom', 'redux-framework-demo'),
								),
				'required'  => array( 'intro_template', '=', array('intro-main'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_bg_img',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Background Image', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-main','intro-about-2'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_logo',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Logo', 'redux-framework-demo'),
				'subtitle' 	=> '',
				'required'  => array( 'intro_template', '=', array('intro-main', 'intro-two-col-slide'),'intro_switcher', '=', array('enable') ),
			),
			array(
				'id' 		=> 'intro_close_text',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Entering Text', 'redux-framework-demo'),
				'subtitle' 	=> '',
				"default" 	=> esc_html__('Take a look inside and discover', 'redux-framework-demo'),
				'required'  => array('intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_close_text_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Entering Text Color', 'redux-framework-demo'),
				'default' 	=> '#eb1010',
				'validate' 	=> 'color',
				'required'  => array('intro_switcher', '=', array('enable') ),
			),
			array(
				'id'		=> 'intro_m_switcher',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Mobile Layout Enable/Disable', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable' 		=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 		=> esc_html__('Disable', 'redux-framework-demo'),),
				'required'  => array( 'intro_switcher', '=', array('enable') ),
			),
			// ----------------------------------------------------------------------------------------------
			// Section Start 
			// ----------------------------------------------------------------------------------------------
			array(
			   	'id' 		=> 'intro_mversion_section_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Mobile Layout', 'redux-framework-demo'),
			   	'indent' 	=> true,
			  	'required'  => array( 'intro_m_switcher', '=', array('enable') ),
			),
			
					array(
						'id'		=> 'intro_m_bg_img',
						'type' 		=> 'media',
						'url'       => true,
						'title' 	=> esc_html__('Upload Background Image', 'redux-framework-demo'),
						'subtitle' 	=> '',
					),
					array(
						'id'		=> 'intro_m_logo',
						'type' 		=> 'media',
						'url'       => true,
						'title' 	=> esc_html__('Upload Logo', 'redux-framework-demo'),
						'subtitle' 	=> '',
					),
					array(
						'id' 		=> 'intro_m_close_text',
						'type' 		=> 'text',
						'title' 	=> esc_html__('Entering Text', 'redux-framework-demo'),
						'subtitle' 	=> '',
						"default" 	=> esc_html__('Take a look inside and discover', 'redux-framework-demo'),
					),
					array(
						'id'		=> 'intro_m_close_text_color',
						'type' 		=> 'color',
						'transparent' => false,
						'title' 	=> esc_html__('Entering Text Color', 'redux-framework-demo'),
						'default' 	=> '#eb1010',
						'validate' 	=> 'color',
					),
			array(
				'id'     	=> 'intro_mversion_section_end',
				'type'   	=> 'section',
				'indent' 	=> false,
				'required'  => array( 'intro_m_switcher', '=', array('enable') ),
			),
			// ----------------------------------------------------------------------------------------------
			// Section End 
			// ----------------------------------------------------------------------------------------------
		)
	));
	Redux::setSection( $opt_name, array(
        'title' => __( 'Client', 'redux-framework-demo' ),
        'id'    => 'clients',
        'icon'  => 'el el-adult',
		'fields' 	=> array(
			
			array(
				'id' 		=> 'client_slug',
				'type' 		=> 'text',
				'title' 	=> __('Client Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'client',
			),
			array(
				'id' 		=> 'clients_per_page',
				'type' 		=> 'slider',
				'title' 	=> __('Clients Per Page', 'redux-framework-demo'),
				"default" 	=> "12",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
			),
			array(
				'id'		=> 'client_template',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Client Page Template', 'redux-framework-demo'),
				"default" 	=> 'default',
				'options' 	=> array(
								'default'  			=> esc_html__('Default', 'fotofly'), 
								'hover_shadow'  	=> esc_html__('Hover Shadow', 'fotofly'), 
								'below_thumb'  		=> esc_html__('Below Thumb', 'fotofly'), 
								'separated_thumb'  	=> esc_html__('Separated Thumb', 'fotofly'), 
								'inline'  			=> esc_html__('Inline', 'fotofly'), 
								'flipped'  			=> esc_html__('Flipped', 'fotofly')),
			),
			array(
			   	'id' 		=> 'client_flipped_backside_section_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Backside Options', 'redux-framework-demo'),
			   	'indent' 	=> true,
			  	'required'  => array( 'client_template', '=', array('flipped') ),
			),
			array(
				'id'		=> 'client_flipped_back_ov_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Overlay Type', 'redux-framework-demo'),
				"default" 	=> 'gradient',
				'options' 	=> array(
								'color'  			=> esc_html__('Color', 'fotofly'),
								'gradient'  		=> esc_html__('Gradient', 'fotofly')),
				'required' => array( 'client_template', '=', array('flipped') ),			
			),
			array(
				'id'		=> 'client_flipped_back_textcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Text Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
				'required' => array( 'client_template', '=', array('flipped') ),
			),
			array(
				'id' 		=> 'client_flipped_back_gr_dir',
				'type' 		=> 'slider',
				'title' 	=> __('Gradient Direction (deg)', 'redux-framework-demo'),
				"default" 	=> "135",
				"min" 		=> "0",
				"step" 		=> "1",
				"max" 		=> "359",
				'required' => array( 'client_flipped_back_ov_type', '=', array('gradient'), 'client_template', '=', array('flipped') ),
			),
			array(
				'id'		=> 'client_flipped_back_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Overlay Color', 'redux-framework-demo'),
				'default' 	=> '#0d0d0d',
				'validate' 	=> 'color',
				'required' => array( 'client_template', '=', array('flipped') ),
			),
			array(
				'id'		=> 'client_flipped_back_startcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Gradient Start Color', 'redux-framework-demo'),
				'default' 	=> '#820041',
				'validate' 	=> 'color',
				'required' => array( 'client_flipped_back_ov_type', '=', array('gradient'), 'client_template', '=', array('flipped') ),
			),
			array(
				'id'		=> 'client_flipped_back_endcolor',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Gradient End Color', 'redux-framework-demo'),
				'default' 	=> '#3300b5',
				'validate' 	=> 'color',
				'required' => array( 'client_flipped_back_ov_type', '=', array('gradient'), 'client_template', '=', array('flipped') ),
			),
			array(
				'id'     	=> 'client_flipped_backside_section_end',
				'type'   	=> 'section',
				'indent' 	=> false,
				'required'  => array( 'client_template', '=', array('flipped') ),
			),
		)
    ));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Gallery', 'redux-framework-demo' ),
        'id'    => 'gallerypage',
        'icon'  => 'el el-picture',
		'fields' 	=> array(
			
		
			array(
				'id' 		=> 'gallery_slug',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Gallery Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'mygallery',
			),
		
			array(
				'id' 		=> 'gallery_cat_slug',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Gallery Category Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'mygallery-cat',
			),	
			
			array(
				'id' 		=> 'gallery_perpage',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Gallery Per Page', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "30",
				
			),
			
			array(
				'id'		=> 'gallery_template',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Gallery Template', 'redux-framework-demo'),
				"default" 	=> 'mini-thumbs',
				'options' 	=> array(
								'masonry'  		=> esc_html__('Masonry', 'redux-framework-demo'),
								'grid'  		=> esc_html__('Grid', 'redux-framework-demo'),
								'mini-thumbs'	=> esc_html__('Mini-Thumbs', 'redux-framework-demo'),
								'triple' 		=> esc_html__('Triple', 'redux-framework-demo')),				
			),
		
			array(
				'id'		=> 'gallery_grid_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Grid Types', 'redux-framework-demo'),
				"default" 	=> 'square',
				'options' 	=> array(
								'square'  		=> esc_html__('Square', 'redux-framework-demo'),
								'portrait' 		=> esc_html__('Portrait', 'redux-framework-demo'),
								'landscape' 	=> esc_html__('Landscape', 'redux-framework-demo'),),
				'required'  => array( 'gallery_template', '=', array('grid','triple') ),
			),
		
			array(
				'id'		=> 'gallery_mg_cols',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Columns Number', 'redux-framework-demo'),
				"default" 	=> '3',
				'options' 	=> array(
								'1'  		=> esc_html__('1 Column', 'fotofly'),
								'2'  		=> esc_html__('2 Columns', 'fotofly'),
								'3'  		=> esc_html__('3 Columns', 'fotofly'),
								'4'  		=> esc_html__('4 Columns', 'fotofly'),
								'5'  		=> esc_html__('5 Columns', 'fotofly'),
								'6'  		=> esc_html__('6 Columns', 'fotofly')),
				'required' => array( 'gallery_template', '=', array('masonry','grid')),
			),
			
			array(
				'id'		=> 'gallery_mg_gutter',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Columns Gutter', 'redux-framework-demo'),
				"default" 	=> '40',
				'options' 	=> array(
								'0'  		=> esc_html__('No Gutter', 'fotofly'),
								'5'  		=> esc_html__('5px', 'fotofly'),
								'10'  		=> esc_html__('10px', 'fotofly'),
								'20'  		=> esc_html__('20px', 'fotofly'),
								'30'  		=> esc_html__('30px', 'fotofly'),
								'40'  		=> esc_html__('40px', 'fotofly'),
								'50'  		=> esc_html__('50px', 'fotofly'),
								'60'  		=> esc_html__('60px', 'fotofly'),
								'70'  		=> esc_html__('70px', 'fotofly'),
								'80'  		=> esc_html__('80px', 'fotofly')),
				'required' => array( 'gallery_template', '=', array('masonry','grid')),
			),
		
			array(
				'id'		=> 'gallery_mt_grid_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Grid Types', 'redux-framework-demo'),
				"default" 	=> 'square',
				'options' 	=> array(
								'square'  		=> esc_html__('Square', 'redux-framework-demo'),
								'portrait' 		=> esc_html__('Portrait', 'redux-framework-demo'),
								'autow' 		=> esc_html__('Auto Width', 'redux-framework-demo'),),
				'required'  => array( 'gallery_template', '=', array('mini-thumbs') ),
			),
		
			array(
				'id' 		=> 'gallery_minithumbs_per',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Minithumbs per page', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "50",
				'required' => array( 'gallery_template', '=', array('mini-thumbs')),
			),
		
			array(
				'id'		=> 'gallery_category_visibility',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Gallery Category', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  	=> esc_html__('Enable', 'redux-framework-demo'), 
								'disable' 	=> esc_html__('Disable', 'redux-framework-demo')),				
			),
		
			
		)
    )); 

	Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Gallery Single', 'redux-framework-demo' ),
	'id'    => 'gallerysinglepage',
	'icon'  => 'el el-picture',
	'fields' 	=> array(
		
			
			array(
				'id'		=> 'gallery_single_layout',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Layout Types', 'redux-framework-demo'),
				"default" 	=> 'full-justified',
				'options' 	=> array(
								'masonry'  			=> esc_html__('Masonry', 'redux-framework-demo'),
								'grid'  			=> esc_html__('Grid', 'redux-framework-demo'),
								'full-slider'  		=> esc_html__('Full Slider', 'redux-framework-demo'),
								'full-justified'  	=> esc_html__('Full Justified', 'redux-framework-demo'),
								'kenburnsy'  		=> esc_html__('Kenburnsy Slider', 'redux-framework-demo'),
								'flow' 				=> esc_html__('Flow Slider', 'redux-framework-demo'),),
			),
		
			array(
				'id'		=> 'gallery_single_prevnextbox',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Previous / Next Box', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
			),
		
			array(
				'id'		=> 'gsingle_grid_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Grid Types', 'redux-framework-demo'),
				"default" 	=> 'portrait',
				'options' 	=> array(
								'square'  		=> esc_html__('Square', 'redux-framework-demo'),
								'portrait' 		=> esc_html__('Portrait', 'redux-framework-demo'),
								'landscape' 	=> esc_html__('Landscape', 'redux-framework-demo'),),
				'required'  => array( 'gallery_single_layout', '=', array('grid') ),
			),
		
			array(
				'id'		=> 'gsingle_flowgrid_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Grid Types', 'redux-framework-demo'),
				"default" 	=> 'landscape',
				'options' 	=> array(
								'square'  		=> esc_html__('Square', 'redux-framework-demo'),
								'portrait' 		=> esc_html__('Portrait', 'redux-framework-demo'),
								'landscape' 	=> esc_html__('Landscape', 'redux-framework-demo'),),
				'required'  => array(  'gallery_single_layout', '=', array('flow') ),
			),
		
			array(
				'id'		=> 'gsingle_f_warning',
				'type' 		=> 'info',
				'title' 	=> esc_html__('Warning! You must have more than 7 photos in your gallery.', 'redux-framework-demo'),
				'required'  => array('gallery_single_layout', '=', array('flow') ),
			),
		
			array(
				'id'		=> 'm_g_cols',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Columns Number', 'redux-framework-demo'),
				"default" 	=> '3',
				'options' 	=> array(
								'1'  		=> esc_html__('1 Column', 'fotofly'),
								'2'  		=> esc_html__('2 Columns', 'fotofly'),
								'3'  		=> esc_html__('3 Columns', 'fotofly'),
								'4'  		=> esc_html__('4 Columns', 'fotofly'),
								'5'  		=> esc_html__('5 Columns', 'fotofly'),
								'6'  		=> esc_html__('6 Columns', 'fotofly')),
				'required' => array( 'gallery_single_layout', '=', array('masonry','grid')),
			),
			
			array(
				'id' 		=> 'j_imgh',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Images Height(px)', 'redux-framework-demo'),
				"default" 	=> "300",
				"min" 		=> "100",
				"step" 		=> "10",
				"max" 		=> "700",
				'required' => array( 'gallery_single_layout', '=', array('full-justified')),
			),
		
			array(
				'id'		=> 'm_g_j_gutter',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Columns Gutter', 'redux-framework-demo'),
				"default" 	=> '5',
				'options' 	=> array(
								'0'  		=> esc_html__('No Gutter', 'fotofly'),
								'5'  		=> esc_html__('5px', 'fotofly'),
								'10'  		=> esc_html__('10px', 'fotofly'),
								'20'  		=> esc_html__('20px', 'fotofly'),
								'30'  		=> esc_html__('30px', 'fotofly'),
								'40'  		=> esc_html__('40px', 'fotofly'),
								'50'  		=> esc_html__('50px', 'fotofly'),
								'60'  		=> esc_html__('60px', 'fotofly'),
								'70'  		=> esc_html__('70px', 'fotofly'),
								'80'  		=> esc_html__('80px', 'fotofly')),
				'required' => array( 'gallery_single_layout', '=', array('masonry','grid','full-justified')),
			),
			
			
	
		)
		
	));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Portfolio', 'redux-framework-demo' ),
        'id'    => 'portfoliopage',
        'icon'  => 'el el-briefcase',
		'fields' 	=> array(
			
			
			array(
				'id' 		=> 'portfolio_slug',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Portfolio Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'project',
			),
			array(
				'id' 		=> 'portfolio_cat_slug',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Portfolio Category Slug', 'frenify-core'),
				'subtitle' 	=> $permalink_description,
				'default' 	=> 'project-cat',
			),
			array(
				'id'		=> 'viewportfolio_text',
				'type' 		=> 'text',
				'title' 	=> esc_html__('View Portfolio Text', 'redux-framework-demo'),
				'default' 	=> "View Portfolio",
			),
			array(
				'id'		=> 'portfolio_category_visibility',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Post Category', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  	=> esc_html__('Enable', 'redux-framework-demo'), 
								'disable' 	=> esc_html__('Disable', 'redux-framework-demo')),				
			),
			array(
				'id' 		=> 'portfolio_perpage',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Posts Per Page', 'redux-framework-demo'),
				"default" 	=> "6",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "30",
				
			),
			array(
				'id'		=> 'portfolio_template',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Portfolio Template', 'redux-framework-demo'),
				"default" 	=> 'masonry',
				'options' 	=> array(
								'masonry'  		=> 'Masonry',
								'grid' 			=> 'Grid',
								'spinner' 		=> 'Spinner',
								'split' 		=> 'Split',),
			),
			array(
				'id'		=> 'portfolio_grid_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Portfolio Grid Types', 'redux-framework-demo'),
				"default" 	=> 'portrait',
				'options' 	=> array(
								'square'  		=> 'Square',
								'portrait' 		=> 'Portrait',
								'landscape' 	=> 'Landscape',),
				'required'  => array( 'portfolio_template', '=', array('grid') ),
			),
			array(
				'id'		=> 'portfolio_spinner_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Portfolio Spinner Types', 'redux-framework-demo'),
				"default" 	=> 'square',
				'options' 	=> array(
								'square'  		=> 'Square',
								'portrait' 		=> 'Portrait',
								'landscape' 	=> 'Landscape',),
				'required'  => array( 'portfolio_template', '=', array('spinner') ),
			),
			array(
				'id' 		=> 'portfolio_post_column',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Post Columns', 'redux-framework-demo'),
				"default" 	=> "3",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "6",
				'required'  => array( 'portfolio_template', '!=', array('split') ),
			),
			array(
				'id' 		=> 'portfolio_post_column_split',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Post Columns', 'redux-framework-demo'),
				"default" 	=> "2",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "2",
				'required'  => array( 'portfolio_template', '=', array('split') ),
			),
			array(
				'id' 		=> 'portfolio_post_column_gutter',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Post Columns Gutter (px)', 'redux-framework-demo'),
				"default" 	=> "40",
				"min" 		=> "0",
				"step" 		=> "2",
				"max" 		=> "80",

			),
			array(
				'id'		=> 'portfolio_title_position',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Post Title Position', 'redux-framework-demo'),
				"default" 	=> 'inside',
				'options' 	=> array(
								'inside'  		=> esc_html__('Inside', 'redux-framework-demo'),
								'outside' 		=> esc_html__('Outside', 'redux-framework-demo')),
				
			),
			
			// ----------------------------------------------------------------------------------------------
			// Section Start (portfolio title position: Outside)
			// ----------------------------------------------------------------------------------------------
			array(
			   	'id' 		=> 'outside_title_section_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Outside Title Options', 'redux-framework-demo'),
			   	'indent' 	=> true,
			  	'required'  => array( 'portfolio_title_position', '=', array('outside') ),
			),
			
					array(
						'id'		=> 'portfolio_title_outside_position',
						'type' 		=> 'button_set',
						'title' 	=> esc_html__('Outside Title Position', 'redux-framework-demo'),
						"default" 	=> 'left',
						'options' 	=> array(
										'left'  		=> esc_html__('Left', 'redux-framework-demo'),
										'center'  		=> esc_html__('Center', 'redux-framework-demo'),
										'right'  		=> esc_html__('Right', 'redux-framework-demo')),
						'required' => array( 'portfolio_title_position', '=', array('outside') ),	
					),
			array(
				'id'     	=> 'outside_title_section_end',
				'type'   	=> 'section',
				'indent' 	=> false,
				'required'  => array( 'portfolio_title_position', '=', array('outside') ),
			),
			// ----------------------------------------------------------------------------------------------
			// Section End 
			// ----------------------------------------------------------------------------------------------
			
		
		
			// ----------------------------------------------------------------------------------------------
			// Section Start (portfolio title position: Inside)
			// ----------------------------------------------------------------------------------------------
			array(
			   	'id' 		=> 'inside_title_section_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Inside Title Options', 'redux-framework-demo'),
			   	'indent' 	=> true,
			  	'required'  => array( 'portfolio_title_position', '=', array('inside') ),
			),
					array(
						'id'		=> 'portfolio_title_inside_visibility',
						'type' 		=> 'button_set',
						'title' 	=> esc_html__('Title Visibility', 'redux-framework-demo'),
						"default" 	=> 'always',
						'options' 	=> array(
										'always'  		=> esc_html__('Always On', 'redux-framework-demo'),
										'hover'  		=> esc_html__('On Mouseenter', 'redux-framework-demo')),
						'required' => array( 'portfolio_title_position', '=', array('inside') ),	
					),
					array(
						'id'		=> 'portfolio_title_inside_color',
						'type' 		=> 'color',
						'transparent' => false,
						'title' 	=> esc_html__('Title Color', 'redux-framework-demo'),
						'default' 	=> '#fff',
						'validate' 	=> 'color',
						'required' => array( 'portfolio_title_position', '=', array('inside') ),	
					),
					array(
						'id'		=> 'portfolio_title_inside_hover_color',
						'type' 		=> 'color',
						'transparent' => false,
						'title' 	=> esc_html__('Title Hover Color', 'redux-framework-demo'),
						'default' 	=> '#eb1010',
						'validate' 	=> 'color',
						'required' => array( 'portfolio_title_position', '=', array('inside') ),	
					),
					array(
						'id'		=> 'portfolio_title_inside_position',
						'type' 		=> 'button_set',
						'title' 	=> esc_html__('Title Inside Position', 'redux-framework-demo'),
						"default" 	=> 'botl',
						'options' 	=> array(
										'topl'  		=> esc_html__('Top Left', 'redux-framework-demo'),
										'topc'  		=> esc_html__('Top Center', 'redux-framework-demo'),
										'topr'  		=> esc_html__('Top Right', 'redux-framework-demo'),
										'midl'  		=> esc_html__('Middle Left', 'redux-framework-demo'),
										'midc'  		=> esc_html__('Middle Center', 'redux-framework-demo'),
										'midr'  		=> esc_html__('Middle Right', 'redux-framework-demo'),
										'botl'  		=> esc_html__('Bottom Left', 'redux-framework-demo'),
										'botc'  		=> esc_html__('Bottom Center', 'redux-framework-demo'),
										'botr'  		=> esc_html__('Bottom Right', 'redux-framework-demo')),
						'required' => array( 'portfolio_title_position', '=', array('inside') ),	
					),
			array(
				'id'     	=> 'inside_title_section_end',
				'type'   	=> 'section',
				'indent' 	=> false,
				'required'  => array( 'portfolio_title_position', '=', array('inside') ),
			),
			// ----------------------------------------------------------------------------------------------
			// Section End
			// ----------------------------------------------------------------------------------------------
		
		
			array(
				'id'		=> 'portfolio_post_overlay',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Post Overlay', 'redux-framework-demo'),
				"default" 	=> 'none',
				'options' 	=> array(
								'none'  		=> esc_html__('None', 'redux-framework-demo'),
								'color'  		=> esc_html__('Color', 'redux-framework-demo'),
								'gradient'  	=> esc_html__('Gradient', 'redux-framework-demo'),
								'blackwhite'  	=> esc_html__('Black-and-white', 'redux-framework-demo'),
								'sepia'  		=> esc_html__('Sepia', 'redux-framework-demo'),
								'grayscale'  	=> esc_html__('GrayScale', 'redux-framework-demo'),
								'huerotate'  	=> esc_html__('Hue-Rotate', 'redux-framework-demo'),
								'invert'  		=> esc_html__('Invert', 'redux-framework-demo'),
								'saturate'  	=> esc_html__('Saturate', 'redux-framework-demo'),
								'blur' 			=> esc_html__('Blur', 'redux-framework-demo')),
				'required'  => array( 'portfolio_template', '=', array('masonry', 'grid', 'split') ),
				
			),
		
			// ----------------------------------------------------------------------------------------------
			// Section Start 
			// ----------------------------------------------------------------------------------------------
			array(
			   	'id' 		=> 'post_overlay_section_start',
			   	'type' 		=> 'section',
			   	'title' 	=> esc_html__('Overlay Options', 'redux-framework-demo'),
			   	'indent' 	=> true,
			  	'required'  => array( 'portfolio_post_overlay', '=', array('color','gradient','blur','sepia','grayscale','huerotate','invert','saturate') ),
			),
		
					array(
						'id' 		=> 'portfolio_post_overlay_color',
						'type' 		=> 'color',
						'transparent' => false,
						'title' 	=> esc_html__('Overlay Color', 'redux-framework-demo'),
						'default' 	=> '#000',
						'validate' 	=> 'color',
						'required'  => array( 'portfolio_post_overlay', '=', array('color') ),
					),
					array(
						'id'       => 'portfolio_post_overlay_gradient',
						'type'     => 'color_gradient',
						'title'    => esc_html__('Overlay Gradient', 'redux-framework-demo'),
						'validate' => 'color',
						'default'  => array(
							'from' => '#eb1010',
							'to'   => '#5C0809'),
						'required'  => array( 'portfolio_post_overlay', '=', array('gradient') ),

					),

					array(
						'id' 		=> 'portfolio_post_overlay_color_opacity',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('Overlay Opacity', 'redux-framework-demo'),
						'subtitle' 	=> esc_html__('Ex: 4 = 40%.', 'redux-framework-demo'),
						"default" 	=> "5",
						"min" 		=> "1",
						"step" 		=> "1",
						"max" 		=> "10",
						'required'  => array( 'portfolio_post_overlay', '=', array('color','gradient') ),

					),
		
					array(
						'id' 		=> 'portfolio_post_overlay_blur_rate',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('Blur Rate (px)', 'redux-framework-demo'),
						"default" 	=> "2",
						"min" 		=> "1",
						"step" 		=> "1",
						"max" 		=> "5",
						'required'  => array( 'portfolio_post_overlay', '=', array('blur') ),

					),
		
					array(
						'id' 		=> 'portfolio_post_overlay_grayscale_rate',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('GrayScale Rate (in %)', 'redux-framework-demo'),
						"default" 	=> "30",
						"min" 		=> "1",
						"step" 		=> "5",
						"max" 		=> "100",
						'required'  => array( 'portfolio_post_overlay', '=', array('grayscale') ),

					),
		
					array(
						'id' 		=> 'portfolio_post_overlay_huerotate_rate',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('GrayScale Rate (in degree)', 'redux-framework-demo'),
						"default" 	=> "30",
						"min" 		=> "1",
						"step" 		=> "5",
						"max" 		=> "360",
						'required'  => array( 'portfolio_post_overlay', '=', array('huerotate') ),

					),
		
					array(
						'id' 		=> 'portfolio_post_overlay_sepia_rate',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('Sepia Rate (in %)', 'redux-framework-demo'),
						"default" 	=> "30",
						"min" 		=> "1",
						"step" 		=> "5",
						"max" 		=> "100",
						'required'  => array( 'portfolio_post_overlay', '=', array('sepia') ),

					),
		
					array(
						'id' 		=> 'portfolio_post_overlay_invert_rate',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('Invert Rate (in %)', 'redux-framework-demo'),
						"default" 	=> "30",
						"min" 		=> "1",
						"step" 		=> "10",
						"max" 		=> "1000",
						'required'  => array( 'portfolio_post_overlay', '=', array('invert') ),

					),
					
					array(
						'id' 		=> 'portfolio_post_overlay_saturate_rate',
						'type' 		=> 'slider',
						'title' 	=> esc_html__('Saturate Rate (in %)', 'redux-framework-demo'),
						"default" 	=> "30",
						"min" 		=> "1",
						"step" 		=> "10",
						"max" 		=> "1000",
						'required'  => array( 'portfolio_post_overlay', '=', array('saturate') ),

					),
			
			array(
				'id'     	=> 'post_overlay_section_end',
				'type'   	=> 'section',
				'indent' 	=> false,
				'required'  => array( 'portfolio_post_overlay', '=', array('color','gradient','blur','sepia','grayscale','huerotate','invert','saturate') ),
			),
			
			// ----------------------------------------------------------------------------------------------
			// Section End
			// ----------------------------------------------------------------------------------------------		
			
		)
    ));
	Redux::setSection( $opt_name, array(
	'title' => esc_html__( 'Portfolio Single', 'redux-framework-demo' ),
	'id'    => 'portfoliosinglepage',
	'icon'  => 'el el-briefcase',
	'fields' 	=> array(
		
			
			array(
				'id'		=> 'portfolio_single_layout',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Layout Types', 'redux-framework-demo'),
				"default" 	=> 'full-justified',
				'options' 	=> array(
								'masonry'  			=> esc_html__('Masonry', 'redux-framework-demo'),
								'carousel'  		=> esc_html__('Carousel', 'redux-framework-demo'),
								'slider'  			=> esc_html__('Slider', 'redux-framework-demo'),
								'full-slider'  		=> esc_html__('Full Slider', 'redux-framework-demo'),
								'mono'  			=> esc_html__('Mono', 'redux-framework-demo'),
								'sticky'  			=> esc_html__('Sticky', 'redux-framework-demo'),
								'justified'  		=> esc_html__('Justified', 'redux-framework-demo'),
								'full-justified'  	=> esc_html__('Full Justified', 'redux-framework-demo'),
								'splitscreen' 		=> esc_html__('Splitscreen', 'redux-framework-demo'),),
			),
		
			array(
				'id'		=> 'portfolio_single_prevnextbox',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Previous / Next Box', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
			),
		
			array(
				'id'		=> 'portfolio_single_caption',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Desktop Caption', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
			),
		
			array(
				'id'		=> 'portfolio_single_mobile_caption',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Mobile Caption', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
			),
		
			array(
				'id' 		=> 'ps_j_height',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Images Height(px)', 'redux-framework-demo'),
				"default" 	=> "350",
				"min" 		=> "100",
				"step" 		=> "10",
				"max" 		=> "700",
				'required' => array( 'portfolio_single_layout', '=', array('justified', 'full-justified')),
			),
		
			array(
				'id'		=> 'ps_j_gutter',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Columns Gutter', 'redux-framework-demo'),
				"default" 	=> '10',
				'options' 	=> array(
								'0'  		=> esc_html__('No Gutter', 'fotofly'),
								'5'  		=> esc_html__('5px', 'fotofly'),
								'10'  		=> esc_html__('10px', 'fotofly'),
								'20'  		=> esc_html__('20px', 'fotofly'),
								'30'  		=> esc_html__('30px', 'fotofly'),
								'40'  		=> esc_html__('40px', 'fotofly'),
								'50'  		=> esc_html__('50px', 'fotofly'),
								'60'  		=> esc_html__('60px', 'fotofly'),
								'70'  		=> esc_html__('70px', 'fotofly'),
								'80'  		=> esc_html__('80px', 'fotofly')),
				'required' => array( 'portfolio_single_layout', '=', array('justified', 'full-justified')),
			),
			array(
				'id'		=> 'p_single_sticky',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Image Position', 'redux-framework-demo'),
				"default" 	=> 'left',
				'options' 	=> array(
								'left'  			=> esc_html__('Left', 'redux-framework-demo'),
								'right' 			=> esc_html__('Right', 'redux-framework-demo'),),
				
				'required' => array( 'portfolio_single_layout', '=', array('sticky') ),
			),
			array(
				'id'		=> 'p_single_carousel',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Image Ratio', 'redux-framework-demo'),
				"default" 	=> 'square',
				'options' 	=> array(
								'square'  			=> esc_html__('Square', 'redux-framework-demo'),
								'portrait'  		=> esc_html__('Portrait', 'redux-framework-demo'),
								'landscape'			=> esc_html__('Landscape', 'redux-framework-demo'),
								'autowidth' 		=> esc_html__('Autowidth', 'redux-framework-demo'),),
				
				'required' => array( 'portfolio_single_layout', '=', array('carousel') ),
			),
		
		)
	));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Blog', 'redux-framework-demo' ),
        'id'    => 'blogpage',
        'icon'  => 'el el-list-alt',
		'fields' 	=> array(
			
			array(
				'id'		=> 'blog_template',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Blog Template', 'redux-framework-demo'),
				"default" 	=> 'masonry',
				'options' 	=> array(
								'masonry'  			=> esc_html__('Masonry', 'redux-framework-demo'),
								'grid'  			=> esc_html__('Grid', 'redux-framework-demo'),
								'grid-modern'  		=> esc_html__('Grid Modern', 'redux-framework-demo'),
								'split'  			=> esc_html__('Split', 'redux-framework-demo'),
								'mosaic'  			=> esc_html__('Mosaic', 'redux-framework-demo'),
								'moving-thumbs'		=> esc_html__('Moving Thumbs', 'redux-framework-demo'),
								'creative-1'		=> esc_html__('Creative #1', 'redux-framework-demo'),
								'creative-2'		=> esc_html__('Creative #2', 'redux-framework-demo'),
								'creative-3'		=> esc_html__('Creative #3', 'redux-framework-demo'),
								'classic' 			=> esc_html__('Classic', 'redux-framework-demo'),),
			),
			array(
				'id'		=> 'blog_format_display',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Post Format Icon Enable / Disable', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
			),
			array(
				'id'		=> 'blog_mosaic_bg_switch',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Overlay Color Enable / Disable', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
				'required' => array( 'blog_template', '=', array('mosaic') ),
			),
			array(
				'id'		=> 'blog_mosaic_bg_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Overlay Color', 'redux-framework-demo'),
				'default' 	=> '#000',
				'validate' 	=> 'color',
				'required' => array( 'blog_mosaic_bg_switch', '=', array('enable'), 'blog_template', '=', array('mosaic') ),	
			),
			array(
				'id' 		=> 'blog_mosaic_bg_opacity',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Overlay Visibility', 'redux-framework-demo'),
				'subtitle' 	=> esc_html__('In %', 'redux-framework-demo'),
				"default" 	=> "30",
				"min" 		=> "0",
				"step" 		=> "1",
				"max" 		=> "100",
				'required'  => array( 'blog_mosaic_bg_switch', '=', array('enable'), 'blog_template', '=', array('mosaic') ),
			),
			array(
				'id'		=> 'blog_mosaic_title_color',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Title Color', 'redux-framework-demo'),
				'default' 	=> '#fff',
				'validate' 	=> 'color',
				'required' => array( 'blog_template', '=', array('mosaic') ),	
			),
			array(
				'id'		=> 'blog_grid_type',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Blog Grid Types', 'redux-framework-demo'),
				"default" 	=> 'square',
				'options' 	=> array(
								'square'  		=> esc_html__('Square', 'redux-framework-demo'),
								'portrait' 		=> esc_html__('Portrait', 'redux-framework-demo'),
								'landscape' 	=> esc_html__('Landscape', 'redux-framework-demo'),),
				'required'  => array( 'blog_template', '=', array('grid') ),
			),
			array(
				'id' 		=> 'blog_post_column',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Post Columns', 'redux-framework-demo'),
				"default" 	=> "3",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "6",
				'required'  => array( 'blog_template', '=', array('masonry','grid') ),
			),
			array(
				'id' 		=> 'blog_post_column_split',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Post Columns', 'redux-framework-demo'),
				"default" 	=> "2",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "2",
				'required'  => array( 'blog_template', '=', array('split') ),
			),
		
			array(
				'id'		=> 'blog_single_prevnextbox',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Previous / Next Box for Blog Single', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  			=> esc_html__('Enable', 'redux-framework-demo'),
								'disable' 			=> esc_html__('Disable', 'redux-framework-demo'),),
			),
			
		)
    ));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Footer', 'redux-framework-demo' ),
        'id'    => 'footer',
        'icon'  => 'el el-road',
		'fields' 	=> array(
			array(
				'id'		=> 'footer_switch',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable/Disable Footer', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable', 'fotofly'), 
								'disable' 		=> esc_html__('Disable', 'fotofly')),			
			),
		array(
				'id'		=> 'footer_widget_switch',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable/Disable Widget', 'redux-framework-demo'),
				"default" 	=> 'disable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable', 'fotofly'), 
								'disable' 		=> esc_html__('Disable', 'fotofly')),
		
				'required' => array( 'footer_switch', '=', array('enable') ),			
			),
		array(
				'id'		=> 'footer_cols',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Widget Columns Count', 'redux-framework-demo'),
				"default" 	=> 'col3',
				'options' 	=> array(
								'col1'  		=> esc_html__('1 Column', 'fotofly'),
								'col2'  		=> esc_html__('2 Columns', 'fotofly'),
								'col3'  		=> esc_html__('3 Columns', 'fotofly'),
								'col4'  		=> esc_html__('4 Columns', 'fotofly')),
				'required' => array( 'footer_widget_switch', '=', array('enable'), 'footer_switch', '=', array('enable')),
			),
		array(
				'id' 		=> 'footer_space',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Space Between Widget Columns (px)', 'redux-framework-demo'),
				"default" 	=> "30",
				"min" 		=> "0",
				"step" 		=> "5",
				"max" 		=> "200",
				
				'required' => array( 'footer_widget_switch', '=', array('enable'), 'footer_switch', '=', array('enable')),
			),
		array(
				'id'		=> 'footer_social_list',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable/Disable Social List', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable', 'fotofly'), 
								'disable' 		=> esc_html__('Disable', 'fotofly')),
				'required' => array( 'footer_switch', '=', array('enable') ),				
			),
		array(
				'id'		=> 'facebook_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Facebook', 'redux-framework-demo'),
				'default'	=> '#',
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'twitter_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Twitter', 'redux-framework-demo'),
				'default'	=> '#',
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'pinterest_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Pinterest', 'redux-framework-demo'),
				'default'	=> '#',
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'linkedin_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Linkedin', 'redux-framework-demo'),
				'default'	=> '#',
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'behance_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Behance', 'redux-framework-demo'),
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'vimeo_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Vimeo', 'redux-framework-demo'),
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'google_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Google', 'redux-framework-demo'),
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'youtube_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Youtube', 'redux-framework-demo'),
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
			array(
				'id'		=> 'instagram_foot',
				'type' 		=> 'text',
				'title' 	=> esc_html__('Instagram', 'redux-framework-demo'),
				'default'	=> '#',
				'required' => array( 'footer_social_list', '=', array('enable') ),
			),
		array(
				'id'		=> 'footer_logo_switch',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Enable/Disable Footer Logo', 'redux-framework-demo'),
				"default" 	=> 'enable',
				'options' 	=> array(
								'enable'  		=> esc_html__('Enable', 'fotofly'), 
								'disable' 		=> esc_html__('Disable', 'fotofly')),			
			),
		array(
			'id' 		=> 'copyright_footer_side',
			'type' 		=> 'textarea',
			'title' 	=> esc_html__('Copyright Text', 'redux-framework-demo'),
			'default' 	=> wp_kses_post('(C) 2018. All Rights Reserved'),
		
			'required' => array( 'footer_switch', '=', array('enable') ),
			),
		array(
				'id'		=> 'footer_logo',
				'type' 		=> 'media',
				'url'       => true,
				'title' 	=> esc_html__('Upload Footer Logo', 'redux-framework-demo'),
				'required' => array( 'footer_logo_switch', '=', array('enable') ),
			),
		array(
			'id' 		=> 'copyright_footer_side2',
			'type' 		=> 'textarea',
			'title' 	=> esc_html__('Author Text', 'redux-framework-demo'),
			'default' 	=> wp_kses_post('Site By <a href="https://themeforest.net/user/frenify" target="_blank">Frenify Design Team</a>'),
		
			'required' => array( 'footer_switch', '=', array('enable') ),
			),
		)
	));
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Woo Options', 'redux-framework-demo' ),
        'id'    => 'fn_woo_page',
        'icon'  => 'el el-shopping-cart',
		'fields' 	=> array(
			
			array(
				'id'		=> 'woo_product_img_grid',
				'type' 		=> 'button_set',
				'title' 	=> esc_html__('Products Grid Type', 'redux-framework-demo'),
				"default" 	=> 'square',
				'options' 	=> array(
								'square'  			=> 'Square',
								'portrait'  		=> 'Portrait',
								'landscape' 		=> 'Landscape'),
			),
		
			array(
				'id' 		=> 'woo_per_page',
				'type' 		=> 'slider',
				'title' 	=> esc_html__('Products Per Page', 'redux-framework-demo'),
				"default" 	=> "12",
				"min" 		=> "1",
				"step" 		=> "1",
				"max" 		=> "100",
			),
			array(
				'id'		=> 'woo_account_bg',
				'type' 		=> 'color',
				'transparent' => false,
				'title' 	=> esc_html__('Background Color for Account Page', 'redux-framework-demo'),
				'default' 	=> '#663399',
				'validate' 	=> 'color',	
			),
			
		)
    ));
	
	
	
	
	  
	Redux::setSection( $opt_name, array(
        'title' => esc_html__( 'Custom CSS', 'redux-framework-demo' ),
        'id'    => 'css',
        'icon'  => 'el el-edit',
		'fields' 	=> array(
			array(
				'id' 		=> 'custom_css',
				'type' 		=> 'textarea',
				'title' 	=> esc_html__('Custom CSS', 'redux-framework-demo'),
			),				
		)
    )); 
	
	
	
	/*-----------------------------------------------------------------------------------------------------*/
	/*---------------------------------------  END OF CUSTOM THEME OPTIONS --------------------------------*/
	/*-----------------------------------------------------------------------------------------------------*/

    /*
     * <--- END SECTIONS
     */
