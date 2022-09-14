<?php
if ( defined( 'ABSPATH' ) && ! defined( 'RWMB_VER' ) ) {
	require_once dirname( __FILE__ ) . '/inc/loader.php';
	$loader = new RWMB_Loader();
	$loader->init();
}

/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign

$prefix = 'fotofly_fn_';
global $meta_boxes, $fotofly_fn_option;
$meta_boxes = array();

/* We need to get default navigation color from Theme Options */
$navBgDefault = '';
if(isset($fotofly_fn_option['nav_skin']) && $fotofly_fn_option['nav_skin'] != ''){
	$navBgDefault = $fotofly_fn_option['nav_skin'];
}
/* We need to get default footer switch from Theme Options */
$footerSwitchDefault = 'enable';
if(isset($fotofly_fn_option['footer_switch']) && $fotofly_fn_option['footer_switch'] != ''){
	$footerSwitchDefault = $fotofly_fn_option['footer_switch'];
}
/* We need to get default footer widget switch from Theme Options */
$footerWidgetSwitchDefault = 'enable';
if(isset($fotofly_fn_option['footer_widget_switch']) && $fotofly_fn_option['footer_widget_switch'] != ''){
	$footerWidgetSwitchDefault = $fotofly_fn_option['footer_widget_switch'];
}
/* We need to get default footer social list switch from Theme Options */
$footerSocialSwitchDefault = 'enable';
if(isset($fotofly_fn_option['footer_social_list']) && $fotofly_fn_option['footer_social_list'] != ''){
	$footerSocialSwitchDefault = $fotofly_fn_option['footer_social_list'];
}


/* ----------------------------------------------------- */
//  Page Options
/* ----------------------------------------------------- */


global $fotofly_fn_option;
$ffn_nav_heading 	= array('type'		=> 'custom-html');
$ffn_nav_skin 	 	= array('type'		=> 'custom-html');

if(isset($fotofly_fn_option['nav_temp']) && ($fotofly_fn_option['nav_temp'] != 'fixed_hamburger')){

	$ffn_nav_heading = array(
		'name'		=> esc_html__('Page Navigation', 'fotofly'),
		'type'		=> 'heading',
	);
	$ffn_nav_skin = array(
		'name'		=> esc_html__('Page Navigation Color', 'fotofly'),
		'id'		=> $prefix . "page_nav_color",
		'type'		=> 'select',
		'options'	=> array(
			'light'			=> esc_html__('Light', 'fotofly'),
			'dark'			=> esc_html__('Dark', 'fotofly'),
			'transdark'		=> esc_html__('Transdark', 'fotofly'),
			'translight'	=> esc_html__('Translight', 'fotofly'),
			'nonedark'		=> esc_html__('Nonedark', 'fotofly'),
			'nonelight'		=> esc_html__('Nonelight', 'fotofly'),

		),
		'multiple'	=> false,
		'std'		=> $navBgDefault
	);
}

/* ----------------------------------------------------- */
//  Page Options for Gallery Page
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'gallerycustomoptions',
	'title' => esc_html__('Filter Options', 'fotofly'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Categories', 'fotofly'),
			'desc'		=> esc_html__('Select a category or leave blank for all', 'fotofly'),
			'id'		=> $prefix . "gallery_cats",
			'type'              => 'taxonomy-advanced',
			'options'           => array(
				'taxonomy'      => 'gallery_category',
				'type'          => 'select_advanced',
				'args'          => array()
			),
			'multiple'	=> true,
			'std'		=> array( '' )
		),
		array(
			'name'		=> esc_html__('Exclude Categories', 'fotofly'),
			'desc'		=> esc_html__('Select a category to exclude', 'fotofly'),
			'id'		=> $prefix . "gallery_excluded_cats",
			'type'              => 'taxonomy-advanced',
			'options'           => array(
				'taxonomy'      => 'gallery_category',
				'type'          => 'select_advanced',
				'args'          => array()
			),
			'multiple'	=> true,
			'std'		=> array( '' )
		),
		array(
			'name'		=> esc_html__('Password Protected Posts', 'fotofly'),
			'id'		=> $prefix . "has_password_gallery",
			'type'		=> 'select',
			'options'	=> array(
				'ex'		=> esc_html__('Exclude', 'fotofly'),
				'in'		=> esc_html__('Include', 'fotofly'),
				'only'		=> esc_html__('Only', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> 'ex',
		),
		array(
			'name'		=> esc_html__('Featured Posts', 'fotofly'),
			'id'		=> $prefix . "featured_posts_gallery",
			'type'		=> 'select',
			'options'	=> array(
				'ex'		=> esc_html__('Exclude', 'fotofly'),
				'in'		=> esc_html__('Include', 'fotofly'),
				'only'		=> esc_html__('Only', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> 'in',
		),
		array(
			'name'		=> esc_html__('Editor\'s Picks', 'fotofly'),
			'id'		=> $prefix . "editorpick_posts_gallery",
			'type'		=> 'select',
			'options'	=> array(
				'ex'		=> esc_html__('Exclude', 'fotofly'),
				'in'		=> esc_html__('Include', 'fotofly'),
				'only'		=> esc_html__('Only', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> 'in',
		),
		
	)
);

/* ----------------------------------------------------- */
//  Page Options for Portfolio Page
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfoliocustomoptions',
	'title' => esc_html__('Filter Options', 'fotofly'),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Categories', 'fotofly'),
			'desc'		=> esc_html__('Select a category or leave blank for all', 'fotofly'),
			'id'		=> $prefix . "portfolio_cats",
			'type'              => 'taxonomy-advanced',
			'options'           => array(
				'taxonomy'      => 'portfolio_category',
				'type'          => 'select_advanced',
				'args'          => array()
			),
			'multiple'	=> true,
			'std'		=> array( '' )
		),
		array(
			'name'		=> esc_html__('Exclude Categories', 'fotofly'),
			'desc'		=> esc_html__('Select a category to exclude', 'fotofly'),
			'id'		=> $prefix . "portfolio_excluded_cats",
			'type'              => 'taxonomy-advanced',
			'options'           => array(
				'taxonomy'      => 'portfolio_category',
				'type'          => 'select_advanced',
				'args'          => array()
			),
			'multiple'	=> true,
			'std'		=> array( '' )
		),
		array(
			'name'		=> esc_html__('Password Protected Posts', 'fotofly'),
			'id'		=> $prefix . "has_password",
			'type'		=> 'select',
			'options'	=> array(
				'ex'		=> esc_html__('Exclude', 'fotofly'),
				'in'		=> esc_html__('Include', 'fotofly'),
				'only'		=> esc_html__('Only', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> 'ex',
		),
		array(
			'name'		=> esc_html__('Featured Posts', 'fotofly'),
			'id'		=> $prefix . "featured_posts",
			'type'		=> 'select',
			'options'	=> array(
				'ex'		=> esc_html__('Exclude', 'fotofly'),
				'in'		=> esc_html__('Include', 'fotofly'),
				'only'		=> esc_html__('Only', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> 'in',
		),
		array(
			'name'		=> esc_html__('Editor\'s Picks', 'fotofly'),
			'id'		=> $prefix . "editorpick_posts",
			'type'		=> 'select',
			'options'	=> array(
				'ex'		=> esc_html__('Exclude', 'fotofly'),
				'in'		=> esc_html__('Include', 'fotofly'),
				'only'		=> esc_html__('Only', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> 'in',
		),
		
	)
);


/* ----------------------------------------------------- */
//  Page Options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'page_main_options',
	'title' => esc_html__('Page Options', 'fotofly'),
	'pages' => array( 'page' ),
	'context' => 'normal',	
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
	
		array(
			'name'		=> esc_html__('Page Style', 'fotofly'),
			'type'		=> 'heading',
		),
		array(
			'name'		=> esc_html__('Page Style', 'fotofly'),
			'id'		=> $prefix . "page_style",
			'type'		=> 'select',
			'options'	=> array(
				'full'		=> esc_html__('Full Width', 'fotofly'),
				'rs'		=> esc_html__('Right Sidebar', 'fotofly'),
				'ls'		=> esc_html__('Left Sidebar', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> array( 'full' )
		),
		array(
			'name'		=> esc_html__('Page Sidebar', 'fotofly'),
			'id'		=> $prefix . "page_sidebar",
			'type'		=> 'select',
			'options'	=> '',
			'multiple'	=> false,
		),


		$ffn_nav_heading,
		$ffn_nav_skin,
	
		array(
			'name'		=> esc_html__('Page Title', 'fotofly'),
			'type'		=> 'heading',
		),
		array(
			'name'		=> esc_html__('Page Title', 'fotofly'),
			'id'		=> $prefix . "page_title",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> array( 'enable' )
		),
		array(
			'name'		=> esc_html__('Breadcrumbs', 'fotofly'),
			'id'		=> $prefix . "page_breadcrumbs",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> array( 'enable' )
		),
		array(
			'name'		=> esc_html__('Title Type', 'fotofly'),
			'id'		=> $prefix . "page_title_type",
			'type'		=> 'select',
			'options'	=> array(
				'regular'	=> esc_html__('Regular', 'fotofly'),
				'parallax'	=> esc_html__('Parallax', 'fotofly'),
			),
			'multiple'	=> false,
			'std'		=> array( 'parallax' )
		),
		
		array(
			'name'		=> esc_html__('Parallax Speed', 'fotofly'),
			'id'		=> $prefix . "page_parallax_speed",
			'type'		=> 'slider',
			'js_options' => array(
				'min'   		=> 0,
				'max'   		=> 10,
				'step'  		=> 1,
			),
			'std'		=> 5,
		),
		array(
			'name'		=> esc_html__('Title Text Color', 'fotofly'),
			'id'		=> $prefix . "page_title_color",
			'type'		=> 'select',
			'options'	=> array(
				'light'	=> esc_html__('Light', 'fotofly'),
				'dark'	=> esc_html__('Dark', 'fotofly'),
			),
			'multiple'	=> false,
			'std'		=> array( 'dark' )
		),
		array(
			'name'		=> esc_html__('Page Title Image', 'fotofly'),
			'desc'		=> esc_html__('Upload only one image for parallax title', 'fotofly'),
			'id'		=> $prefix . "page_title_img",
			'type'		=> 'image_advanced', //image, thickbox_image, plupload_image, image_advanced, image_select (or radio image)
			'max_file_uploads' => 1,
		),
		array(
			'name'		=> esc_html__('Footer Options', 'fotofly'),
			'type'		=> 'heading',
		),
		array(
			'name'		=> esc_html__('Footer', 'fotofly'),
			'id'		=> $prefix . "page_footer_switch",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> $footerSwitchDefault
		),
		array(
			'name'		=> esc_html__('Widgets', 'fotofly'),
			'id'		=> $prefix . "page_footer_widget_switch",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> $footerWidgetSwitchDefault
		),
		array(
			'name'		=> esc_html__('Social List', 'fotofly'),
			'id'		=> $prefix . "page_footer_social_switch",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> $footerSocialSwitchDefault
		),
		array(
			'name'		=> esc_html__('Page Spacing', 'fotofly'),
			'type'		=> 'heading',
		),	

		array(
			'name'		=> esc_html__('Padding Top', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_top",
			'type'		=> 'text',
			'size'  	=> 2,
			'std'		=> 70
		),
		array(
			'name'		=> esc_html__('Padding Bottom', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_bottom",
			'type'		=> 'text',
			'size'  	=> 2,
			'std'		=> 70
		),
	)
);
/* ----------------------------------------------------- */
//  Page Background Options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'page_advanced_options',
	'title' => esc_html__('Advanced Options', 'fotofly'),
	'pages' => array( 'page', 'fotofly-fn-portfolio', 'fotofly-fn-gallery' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
	
		array(
			'name'		=> esc_html__('Page Audio','fotofly'),
			'desc'		=> esc_html__('Supports .mp3 file. Insert url of .mp3 file','fotofly'),
			'id'		=> $prefix . "page_audio",
			'type'		=> 'text',
		),
		
	
		array(
			'name'		=> esc_html__('Background Options', 'fotofly'),
			'type'		=> 'heading',
		),	
		array(
			'name'		=> esc_html__('Backround Type', 'fotofly'),
			'id'		=> $prefix . "page_bg_type",
			'type'		=> 'select',
			'options'	=> array(
				'default'				=> esc_html__('Default', 'fotofly'),
				'image'					=> esc_html__('Image', 'fotofly'),
				'fade_slider'			=> esc_html__('Fade Slider', 'fotofly'),
				'kenburnsy_slider'		=> esc_html__('Kenburnsy Slider', 'fotofly'),
				'video'					=> esc_html__('Video', 'fotofly'),
			),
			'std'		=> 'default',
		),
		array(
			'name'		=> esc_html__('Overlay Color', 'fotofly'),
			'id'		=> $prefix . "page_bg_color",
			'type'		=> 'select',
			'options'	=> array(
				'dark'			=> esc_html__('Dark', 'fotofly'),
				'light'			=> esc_html__('Light', 'fotofly'),
			),
			'std'		=> 'dark',
		),
	
		array(
			'name'		=> esc_html__('Overlay Color Transparency', 'fotofly'),
			'desc'		=> esc_html__('You have to decrease overlay color transparency to make background visible', 'fotofly'),
			'id'		=> $prefix . "page_fg_opacity",
			'type'		=> 'slider',
			'suffix' 	=> ' %',
			'js_options' => array(
				'min'   		=> 0,
				'max'   		=> 100,
				'step'  		=> 1,
			),
			'std'		=> 60,
		),
		array(
			'name'		=> esc_html__('Background Image', 'fotofly'),
			'desc'		=> esc_html__('Upload only one image for background', 'fotofly'),
			'id'		=> $prefix . "page_bg_img",
			'type'		=> 'image_advanced', //image, thickbox_image, plupload_image, image_advanced, image_select (or radio image)
			'max_file_uploads' => 1,
		),
		array(
			'name'		=> esc_html__('Background Slider', 'fotofly'),
			'desc'		=> esc_html__('Upload images for background slider', 'fotofly'),
			'id'		=> $prefix . "page_bg_slider",
			'type'		=> 'image_advanced', //image, thickbox_image, plupload_image, image_advanced, image_select (or radio image)
			'max_file_uploads' => 30,
		),
		array(
			'name'		=> esc_html__('Background Video Url', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "page_bg_video",
			'type'		=> 'oembed',
			'size'  	=> 30,
			'std'		=> ''
		),
		array(
			'name'		=> esc_html__('Video FallBack Image', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "page_bg_video_poster",
			'type'		=> 'image_advanced', //image, thickbox_image, plupload_image, image_advanced, image_select (or radio image)
			'max_file_uploads' => 1,
		),
	)
);







// GET DEFAULT LAYOUT FROM GLOBAL OPTIONS
$fotofly_fn_portfolio_single_layout = 'masonry';
if(isset($fotofly_fn_option['portfolio_single_layout'])){
	$fotofly_fn_portfolio_single_layout = $fotofly_fn_option['portfolio_single_layout'];
}
/* ----------------------------------------------------- */
//  Portfolio Options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'fotofly_fn_meta_portfolio',
	'title' => esc_html__('Post Options', 'fotofly'),
	'pages' => array( 'fotofly-fn-portfolio' ),
	'context' => 'normal',
	'priority' => 'default',

	// List of meta fields
	'fields' => array(
		
		
		array(
			'name'		=> esc_html__('Featured Post', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "featured_post",
			'type'		=> 'checkbox',
		),
		array(
			'name'		=> esc_html__('Editor\'s Pick', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "editorpick_post",
			'type'		=> 'checkbox',
		),
		array(
			'name'		=> esc_html__('Post layout', 'fotofly'),
			'id'		=> $prefix . "portfolio_single_layout",
			'type'		=> 'select',
			'options'	=> array(
				'masonry'				=> esc_html__('Masonry', 'fotofly'),
				'carousel'  			=> esc_html__('Carousel', 'fotofly'),
				'slider'  				=> esc_html__('Slider', 'fotofly'),
				'full-slider'  			=> esc_html__('Full Slider', 'fotofly'),
				'mono'  				=> esc_html__('Mono', 'fotofly'),
				'sticky'  				=> esc_html__('Sticky', 'fotofly'),
				'justified'  			=> esc_html__('Justified', 'fotofly'),
				'full-justified'  		=> esc_html__('Full Justified', 'fotofly'),
				'splitscreen'			=> esc_html__('Split Screen', 'fotofly'),
			),
			'multiple'	=> false,
			'std'		=> $fotofly_fn_portfolio_single_layout
		),
		array(
			'name'		=> esc_html__('Post Images', 'fotofly'),
			'desc'		=> esc_html__('Upload images. In order to upload more images, use "Ctrl + Click"', 'fotofly'),
			'id'		=> $prefix . 'portfolio_images',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 999,
		),
		
	)
);
// GET DEFAULT LAYOUT FROM GLOBAL OPTIONS
$fotofly_fn_gallery_single_layout = 'mini-thumbs';
if(isset($fotofly_fn_option['gallery_single_layout'])){
	$fotofly_fn_gallery_single_layout = $fotofly_fn_option['gallery_single_layout'];
}
/* ----------------------------------------------------- */
//  Gallery Options
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'fotofly_fn_meta_gallery',
	'title' => esc_html__('Post Options', 'fotofly'),
	'pages' => array( 'fotofly-fn-gallery' ),
	'context' => 'normal',
	'priority' => 'default',

	// List of meta fields
	'fields' => array(
		
		
		array(
			'name'		=> esc_html__('Featured Post', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "featured_post",
			'type'		=> 'checkbox',
		),
		array(
			'name'		=> esc_html__('Editor\'s Pick', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "editorpick_post",
			'type'		=> 'checkbox',
		),
		array(
			'name'		=> esc_html__('Post layout', 'fotofly'),
			'id'		=> $prefix . "gallery_single_layout",
			'type'		=> 'select',
			'options'	=> array(
				'masonry'  			=> esc_html__('Masonry', 'redux-framework-demo'),
				'grid'  			=> esc_html__('Grid', 'redux-framework-demo'),
				'full-slider'  		=> esc_html__('Full Slider', 'redux-framework-demo'),
				'full-justified'  	=> esc_html__('Full Justified', 'redux-framework-demo'),
				'kenburnsy'  		=> esc_html__('Kenburnsy Slider', 'redux-framework-demo'),
				'flow' 				=> esc_html__('Flow Slider', 'redux-framework-demo'),),
			'multiple'	=> false,
			'std'		=> $fotofly_fn_gallery_single_layout
		),
		array(
			'name'		=> esc_html__('Post Images', 'fotofly'),
			'desc'		=> esc_html__('Upload images. In order to upload more images, use "Ctrl + Click"', 'fotofly'),
			'id'		=> $prefix . 'gallery_images',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 999,
		),
		
	)
);


/***** *****/
/* Get Clients list */
$args = array(
    'numberposts' => -1,
    'post_type' => array('fotofly-fn-client'),
);

$clients_arr = get_posts($args);
$clients_select = array();
$clients_select['(Display Post Featured Image)'] = '';
//$clients_select['(Hide Post Featured Image)'] = -1;

foreach($clients_arr as $client)
{
	$clients_select[$client->ID] = $client->post_title;
}
/* ----------------------------------------------------- */
//  Client Selectbox for Portfolio
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-client',
	'title' => esc_html__('Client Options', 'fotofly'),
	'pages' => array( 'fotofly-fn-portfolio' ),
	'context' => 'side',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		array( 
				"name" 		=> esc_html__('Select client for this portfolio', 'fotofly'),
				"desc" 		=> '',
				"id" 		=> $prefix."portfolio_client",
				'type'		=> 'select',
				'options'	=> $clients_select,
				'multiple'	=> false,
				'std'		=> ''
			),
	)
);

/* ----------------------------------------------------- */
//  Client and Cover Image
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-client-image',
	'title' => esc_html__('Images', 'fotofly'),
	'pages' => array( 'fotofly-fn-client' ),
	'context' => 'side',
	'priority' => 'low',

	// List of meta fields
	'fields' => array(
		
		array( 
				"name" 		=> esc_html__('Client Photo', 'fotofly'),
				"desc" 		=> '',
				"id" 		=> $prefix."client_photo",
				'type'		=> 'image_advanced',
				'max_file_uploads' => 1,
			),
		array( 
				"name" 		=> esc_html__('Cover Photo', 'fotofly'),
				"desc" 		=> '',
				"id" 		=> $prefix."client_cover_photo",
				'type'		=> 'image_advanced',
				'max_file_uploads' => 1,
			),
	)
);

/* ----------------------------------------------------- */
//  Client Selectbox for Proofing
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-client',
	'title' => esc_html__('Client Options', 'fotofly'),
	'pages' => array( 'fotofly-fn-proofing' ),
	'context' => 'side',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		array( 
				"name" 		=> esc_html__('Select client for this gallery', 'fotofly'),
				"desc" 		=> '',
				"id" 		=> $prefix."proofing_client",
				'type'		=> 'select',
				'options'	=> $clients_select,
				'multiple'	=> false,
				'std'		=> ''
			),
	)
);


/* ----------------------------------------------------- */
//  Page Options for portfolio and client
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'pagecom',
	'title' => esc_html__('Page Options', 'fotofly'),
	'pages' => array( 'fotofly-fn-gallery', 'fotofly-fn-portfolio', 'fotofly-fn-client'),
	'context' => 'normal',
	'priority' => 'default',

	// List of meta fields
	'fields' => array(
		$ffn_nav_heading,
		$ffn_nav_skin,
		array(
			'name'		=> esc_html__('Footer Options', 'fotofly'),
			'type'		=> 'heading',
		),
		array(
			'name'		=> esc_html__('Footer', 'fotofly'),
			'id'		=> $prefix . "page_footer_switch",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> $footerSwitchDefault
		),
		array(
			'name'		=> esc_html__('Widgets', 'fotofly'),
			'id'		=> $prefix . "page_footer_widget_switch",
			'type'		=> 'select',
			'options'	=> array(
				'enable'	=> esc_html__('Enable', 'fotofly'),
				'disable'	=> esc_html__('Disable', 'fotofly'),

			),
			'multiple'	=> false,
			'std'		=> $footerWidgetSwitchDefault
		),
		array(
			'name'		=> esc_html__('Page Spacing', 'fotofly'),
			'type'		=> 'heading',
		),	

		array(
			'name'		=> esc_html__('Page Padding Top', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_top",
			'type'		=> 'text',
			'std'		=> 70
		),
		array(
			'name'		=> esc_html__('Page Padding Bottom', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . "page_padding_bottom",
			'type'		=> 'text',
			'std'		=> 70
		),
		
	)
);
/* ----------------------------------------------------- */
//  Video Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-video',
	'title' => esc_html__('Video Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		
		array( 
				"name" 		=> esc_html__('Embeded Code', 'fotofly'),
				"desc" 		=> esc_html__('You can include embeded code here. (Youtube, Vimeo, Dailymotion, ....)', 'fotofly'),
				"id" 		=> $prefix."video_embed",
				"type"		=> "textarea",
				"std" 		=> ''
			),
	)
);

/* ----------------------------------------------------- */
//  Audio Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-audio',
	'title' => esc_html__('Audio Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
				'name'		=> esc_html__('Soundcloud Audio', 'fotofly'),
				'desc'		=> esc_html__('Enter Soundcloud URL. For example: https://soundcloud.com/mjimmortal/sets/immortal', 'fotofly'),
				'id'		=> $prefix . 'audio_soundcloud',
				'type'		=> 'text',
				'std'		=> ''
		)
	)
);

/* ----------------------------------------------------- */
//  Gallery Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-gallery',
	'title' => esc_html__('Gallery Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Gallery Images', 'fotofly'),
			'desc'		=> esc_html__('Upload images. In order to upload more images, use "Ctrl + Click"', 'fotofly'),
			'id'		=> $prefix . 'postgallery',
			'type'		=> 'image_advanced',
			'max_file_uploads' => 100,
		),
	)
);

/* ----------------------------------------------------- */
//  Link Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-link',
	'title' => esc_html__('Link Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> 'Link URL',
			'desc'		=> esc_html__('Please input the URL for your link. I.e. http://www.exampledomain.com', 'fotofly'),
			'desc'		=> esc_html__('Please input the URL for your link. I.e. http://www.exampledomain.com', 'fotofly'),
			'id'		=> $prefix . 'link',
			'type'		=> 'text'	
		)
	)
);


/* ----------------------------------------------------- */
//  Quote Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-quote',
	'title' => esc_html__('Quote Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Quote Content', 'fotofly'),
			'desc'		=> esc_html__('Please type the text for your quote here.', 'fotofly'),
			'id'		=> $prefix . 'quote',
			'type'		=> 'textarea'
		)
	)
);


/* ----------------------------------------------------- */
//  Image Settings (FOR POSTS)
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'frenify-meta-post-image',
	'title' => esc_html__('Image Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Please, use "Featured Image" section to attach image.', 'fotofly'),
			'desc'		=> '',
			'id'		=> $prefix . 'image',
			'type'		=> 'heading'
		)	
	)
);



/* ----------------------------------------------------- */
//  Post Options
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'frenify-postoption',
	'title' => esc_html__('Post Options', 'fotofly'),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> esc_html__('Choose page style', 'fotofly'),
			'id'		=> $prefix . "page_style",
			'type'		=> 'select',
			'options'	=> array(
				'full'		=> esc_html__('Full Width', 'fotofly'),
				'rs'		=> esc_html__('Right Sidebar', 'fotofly'),
				'ls'		=> esc_html__('Left Sidebar', 'fotofly'),
				
			),
			'multiple'	=> false,
			'std'		=> array( 'rs' )
		),
	)
);




/**************************************************************************/
/*********************								***********************/
/********************* 		META BOX REGISTERING 	***********************/
/*********************								***********************/
/**************************************************************************/

/**
 * Register meta boxes
 *
 * @return void
 */
function fotofly_fn_register_meta_boxes()
{
	global $meta_boxes;
	global $fotofly_fn_option;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'fotofly_fn_register_meta_boxes' );