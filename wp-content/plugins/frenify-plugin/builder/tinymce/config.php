<?php
/*-----------------------------------------------------------------------------------*/
/*	Default Options
/*-----------------------------------------------------------------------------------*/

// Number of posts array
function fotofly_fn_shortcodes_range ( $range, $all = true, $default = false, $range_start = 1 ) {
	if( $all ) {
		$number_of_posts['-1'] = 'All';
	}

	if( $default ) {
		$number_of_posts[''] = 'Default';
	}

	foreach( range( $range_start, $range ) as $number ) {
		$number_of_posts[$number] = $number;
	}

	return $number_of_posts;
}

// Taxonomies
function fotofly_fn_shortcodes_categories ( $taxonomy, $empty_choice = false, $empty_choice_label = 'Default' ) {
	$post_categories = array();
	if( $empty_choice == true ) {
		$post_categories[''] = $empty_choice_label;
	}

	$get_categories = get_categories('hide_empty=0&taxonomy=' . $taxonomy);

	if( ! is_wp_error( $get_categories ) ) {
		if( $get_categories && is_array($get_categories) ) {
			foreach ( $get_categories as $cat ) {
				if( array_key_exists('slug', $cat) && 
					array_key_exists('name', $cat) 
				) {
					$post_categories[$cat->slug] = $cat->name;
				}
			}
		}

		if( isset( $post_categories ) ) {
			return $post_categories;
		}
	}
}

$choices = array( 'yes' => __('Yes', 'frenify-core'), 'no' => __('No', 'frenify-core') );
$reverse_choices = array( 'no' => __('No', 'frenify-core'), 'yes' => __('Yes', 'frenify-core') );
$choices_with_default = array( '' => __('Default', 'frenify-core'), 'yes' => __('Yes', 'frenify-core'), 'no' => __('No', 'frenify-core') );
$reverse_choices_with_default = array( '' => __('Default', 'frenify-core'), 'no' => __('No', 'frenify-core'), 'yes' => __('Yes', 'frenify-core') );
$leftright = array( 'left' => __('Left', 'frenify-core'), 'right' => __('Right', 'frenify-core') );
$dec_numbers = array( '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' );
$animation_type = array(
                    		'none' 					=> 'None',
							'bounce' 				=> 'Bounce',
							'fadeIn' 				=> 'Fade',
							'flash'					=> 'Flash',
							'pulse'					=> 'Pulse',
							'rubberBand'			=> 'Rubberband',						   
							'shake' 				=> 'Shake',
							'headShake'				=> 'HeadShake',
							'swing'					=> 'Swing',
							'tada'					=> 'Tada',
							'wobble'				=> 'Wobble',
							'jello'					=> 'Jello',
							'bounceIn'				=> 'bounceIn',
							'bounceInDown'			=> 'bounceInDown',
							'bounceInLeft'			=> 'bounceInLeft',
							'bounceInRight'			=> 'bounceInRight',
							'bounceInUp'			=> 'bounceInUp',
							'fadeInDown'			=> 'fadeInDown',
							'fadeInDownBig'			=> 'fadeInDownBig',
							'fadeInLeft'			=> 'fadeInLeft',
							'fadeInLeftBig'			=> 'fadeInLeftBig',
							'fadeInRight'			=> 'fadeInRight',
							'fadeInRightBig'		=> 'fadeInRightBig',
							'fadeInUp'				=> 'fadeInUp',
							'fadeInUpBig'			=> 'fadeInUpBig',
							'flipInX'				=> 'flipInX',
							'flipInY'				=> 'flipInY',
							'lightSpeedIn'			=> 'lightSpeedIn',
							'rotateIn'				=> 'rotateIn',
							'rotateInDownLeft'		=> 'rotateInDownLeft',
							'rotateInDownRight'		=> 'rotateInDownRight',
							'rotateInUpLeft'		=> 'rotateInUpLeft',
							'rotateInUpRight'		=> 'rotateInUpRight',
							'hinge'					=> 'hinge',
							'rollIn'				=> 'rollIn',
							'zoomIn'				=> 'zoomIn',
							'zoomInDown'			=> 'zoomInDown',
							'zoomInLeft'			=> 'zoomInLeft',
							'zoomInRight'			=> 'zoomInRight',
							'zoomInUp'				=> 'zoomInUp',
							'slideInDown'			=> 'slideInDown',
							'slideInLeft'			=> 'slideInLeft',
							'slideInRight'			=> 'slideInRight',
							'slideInUp'				=> 'slideInUp'
                );
$animation_direction = array(
                    'down'         => __( 'Down', 'frenify-core' ),
                    'left'         => __( 'Left', 'frenify-core' ),
                    'right'     => __( 'Right', 'frenify-core' ),
                    'up'         => __( 'Up', 'frenify-core' ),
                    'static'     => __( 'Static', 'frenify-core' ),
                );

// Fontawesome icons list
$pattern = '/\.(fa-(?:\w+(?:-)?)+):before\s+{\s*content:\s*"(.+)";\s+}/';
$fontawesome_path = fotofly_fn_TINYMCE_DIR . '/css/font-awesome.css';
if( file_exists( $fontawesome_path ) ) {
	@$subject = file_get_contents( $fontawesome_path );
}

preg_match_all($pattern, $subject, $matches, PREG_SET_ORDER);

$icons = array();

foreach($matches as $match){
	$icons[$match[1]] = $match[2];
}

$checklist_icons = array ( 'icon-check' => '\f00c', 'icon-star' => '\f006', 'icon-angle-right' => '\f105', 'icon-asterisk' => '\f069', 'icon-remove' => '\f00d', 'icon-plus' => '\f067' );

/*-----------------------------------------------------------------------------------*/
/*	Shortcode Selection Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['shortcode-generator'] = array(
	'no_preview' => true,
	'params' => array(),
	'shortcode' => '',
	'popup_title' => ''
);

/*-----------------------------------------------------------------------------------*/
/*	Alert Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['alert'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Alert Type', 'frenify-core' ),
			'desc' => __( 'Select the type of alert message. Choose custom for advanced color options below.', 'frenify-core' ),
			'options' => array(
				'general' => __('General', 'frenify-core'),
				'error' => __('Error', 'frenify-core'),
				'success' => __('Success', 'frenify-core'),
				'notice' => __('Notice', 'frenify-core'),
				'custom' => __('Custom', 'frenify-core'),
			)
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the border, text and icon color for custom alert boxes.', 'frenify-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the background color for custom alert boxes.', 'frenify-core')
		),
		'bordersize' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'frenify-core' ),
			'desc' => __('Custom setting only. For custom alert boxes. In pixels (px), ex: 1px.', 'frenify-core')
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Click an icon to select, click again to deselect', 'frenify-core' ),
			'options' => $icons
		),
		'boxshadow' => array(
			'type' => 'select',
			'label' => __( 'Box Shadow', 'frenify-core' ),
			'desc' =>  __( 'Display a box shadow below the alert box.', 'frenify-core' ),
			'options' => $choices
		),		
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Alert Content', 'frenify-core' ),
			'desc' => __( 'Insert the alert\'s content', 'frenify-core' ),
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'frenify-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'frenify-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'frenify-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'frenify-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),		
	),
	'shortcode' => '[alert type="{{type}}" accent_color="{{accentcolor}}" background_color="{{backgroundcolor}}" border_size="{{bordersize}}" icon="{{icon}}" box_shadow="{{boxshadow}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/alert]',
	'popup_title' => __( 'Alert Shortcode', 'frenify-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Blog Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['blog'] = array(
	'no_preview' => true,
	'params' => array(

		'layout' => array(
			'type' => 'select',
			'label' => __( 'Blog Layout', 'frenify-core' ),
			'desc' => __( 'Select the layout for the blog shortcode', 'frenify-core' ),
			'options' => array(
				'large' => __('Large', 'frenify-core'),
				'medium' => __('Medium', 'frenify-core'),
				'large alternate' => __('Large Alternate', 'frenify-core'),
				'medium alternate' => __('Medium Alternate', 'frenify-core'),
				'grid' => __('Grid', 'frenify-core'),
				'timeline' => __('Timeline', 'frenify-core')
			)
		),
		'posts_per_page' => array(
			'type' => 'select',
			'label' => __( 'Posts Per Page', 'frenify-core' ),
			'desc' => __( 'Select number of posts per page.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_range( 25, true, true )
		),
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'frenify-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'frenify-core')
		),			
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'frenify-core' ),
			'desc' => __( 'Select a category or leave blank for all.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'frenify-core' ),
			'desc' => __( 'Select a category to exclude.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'category' )
		),
		'title' => array(
			'type' => 'select',
			'label' => __( 'Show Title', 'frenify-core' ),
			'desc' =>  __( 'Display the post title below the featured image.', 'frenify-core' ),
			'options' => $choices
		),
		'title_link' => array(
			'type' => 'select',
			'label' => __( 'Link Title To Post', 'frenify-core' ),
			'desc' =>  __( 'Choose if the title should be a link to the single post page.', 'frenify-core' ),
			'options' => $choices
		),		
		'thumbnail' => array(
			'type' => 'select',
			'label' => __( 'Show Thumbnail', 'frenify-core' ),
			'desc' =>  __( 'Display the post featured image.', 'frenify-core' ),
			'options' => $choices
		),
		'excerpt' => array(
			'type' => 'select',
			'label' => __( 'Show Excerpt', 'frenify-core' ),
			'desc' =>  __( 'Show excerpt or choose "no" for full content.', 'frenify-core' ),
			'options' => $choices
		),
		'excerpt_length' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Number of words/characters in Excerpt', 'frenify-core' ),
			'desc' =>  __( 'Controls the excerpt length based on words or characters that is set in Theme Options > Extra.', 'frenify-core' ),
		),
		'meta_all' => array(
			'type' => 'select',
			'label' => __( 'Show Meta Info', 'frenify-core' ),
			'desc' =>  __( 'Choose to show all meta data.', 'frenify-core' ),
			'options' => $choices
		),
		'meta_author' => array(
			'type' => 'select',
			'label' => __( 'Show Author Name', 'frenify-core' ),
			'desc' =>  __( 'Choose to show the author.', 'frenify-core' ),
			'options' => $choices
		),
		'meta_categories' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'frenify-core' ),
			'desc' =>  __( 'Choose to show the categories.', 'frenify-core' ),
			'options' => $choices
		),
		'meta_comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comment Count', 'frenify-core' ),
			'desc' =>  __( 'Choose to show the comments.', 'frenify-core' ),
			'options' => $choices
		),
		'meta_date' => array(
			'type' => 'select',
			'label' => __( 'Show Date', 'frenify-core' ),
			'desc' =>  __( 'Choose to show the date.', 'frenify-core' ),
			'options' => $choices
		),
		'meta_link' => array(
			'type' => 'select',
			'label' => __( 'Show Read More Link', 'frenify-core' ),
			'desc' =>  __( 'Choose to show the Read More link.', 'frenify-core' ),
			'options' => $choices
		),
		'meta_tags' => array(
			'type' => 'select',
			'label' => __( 'Show Tags', 'frenify-core' ),
			'desc' =>  __( 'Choose to show the tags.', 'frenify-core' ),
			'options' => $choices
		),
		'paging' => array(
			'type' => 'select',
			'label' => __( 'Show Pagination', 'frenify-core' ),
			'desc' =>  __( 'Show numerical pagination boxes.', 'frenify-core' ),
			'options' => $choices
		),
		'scrolling' => array(
			'type' => 'select',
			'label' => __( 'Pagination Type', 'frenify-core' ),
			'desc' =>  __( 'Choose the type of pagination.', 'frenify-core' ),
			'options' => array(
				'pagination' => __('Pagination', 'frenify-core'),
				'infinite' => __('Infinite Scrolling', 'frenify-core'),
				'load_more_button' => __('Load More Button', 'frenify-core')
			)
		),
		'blog_grid_columns' => array(
			'type' => 'select',
			'label' => __( 'Grid Layout # of Columns', 'frenify-core' ),
			'desc' => __( 'Select whether to display the grid layout in 2, 3 or 4 column.', 'frenify-core' ),
			'options' => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			)
		),
		'blog_grid_column_spacing' => array(
			'std' => '40',
			'type' => 'text',
			'label' => __( 'Grid Layout Column Spacing', 'frenify-core' ),
			'desc' => __( 'Insert the amount of spacing between blog grid posts without "px".', 'frenify-core' )
		),			
		'strip_html' => array(
			'type' => 'select',
			'label' => __( 'Strip HTML from Posts Content', 'frenify-core' ),
			'desc' =>  __( 'Strip HTML from the post excerpt.', 'frenify-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),		
	),
	'shortcode' => '[blog number_posts="{{posts_per_page}}" offset="{{offset}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" title="{{title}}" title_link="{{title_link}}" thumbnail="{{thumbnail}}" excerpt="{{excerpt}}" excerpt_length="{{excerpt_length}}" strip_html="{{strip_html}}" meta_all="{{meta_all}}" meta_author="{{meta_author}}" meta_categories="{{meta_categories}}" meta_comments="{{meta_comments}}" meta_date="{{meta_date}}" meta_link="{{meta_link}}" meta_tags="{{meta_tags}}" paging="{{paging}}" scrolling="{{scrolling}}" blog_grid_columns="{{blog_grid_columns}}" blog_grid_column_spacing="{{blog_grid_column_spacing}}" layout="{{layout}}" class="{{class}}" id="{{id}}"][/blog]',
	'popup_title' => __( 'Blog Shortcode', 'frenify-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Button Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['button'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button URL', 'frenify-core' ),
			'desc' => __( 'Add the button\'s url ex: http://example.com.', 'frenify-core' )
		),
		'style' => array(
			'type' => 'select',
			'label' => __( 'Button Style', 'frenify-core' ),
			'desc' => __( 'Select the button\'s color. Select default or color name for theme options, or select custom to use advanced color options below.', 'frenify-core' ),
			'options' => array(
				'default' => __('Default', 'frenify-core'),
				'custom' => __('Custom', 'frenify-core'),
				'green' => __('Green', 'frenify-core'),
				'darkgreen' => __('Dark Green', 'frenify-core'),
				'orange' => __('Orange', 'frenify-core'),
				'blue' => __('Blue', 'frenify-core'),
				'red' => __('Red', 'frenify-core'),
				'pink' => __('Pink', 'frenify-core'),
				'darkgray' => __('Dark Gray', 'frenify-core'),
				'lightgray' => __('Light Gray', 'frenify-core'),
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'frenify-core' ),
			'desc' => __( 'Select the button\'s size. Choose default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'small' => __('Small', 'frenify-core'),
				'medium' => __('Medium', 'frenify-core'),
				'large' => __('Large', 'frenify-core'),
				'xlarge' => __('XLarge', 'frenify-core'),
			)
		),
		'type' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'frenify-core' ),
			'desc' => __( 'Select the button\'s type. Choose default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'flat' => __('Flat', 'frenify-core'),
				'3d' => '3D',
			)
		),
		'shape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'frenify-core' ),
			'desc' => __( 'Select the button\'s shape. Choose default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'square' => __('Square', 'frenify-core'),
				'pill' => __('Pill', 'frenify-core'),
				'round' => __('Round', 'frenify-core'),
			)
		),				
		'target' => array(
			'type' => 'select',
			'label' => __( 'Button Target', 'frenify-core' ),
			'desc' => __( '_self = open in same window <br />_blank = open in new window.', 'frenify-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Title Attribute', 'frenify-core' ),
			'desc' => __( 'Set a title attribute for the button link.', 'frenify-core' ),
		),
		'content' => array(
			'std' => __('Button Text', 'frenify-core'),
			'type' => 'text',
			'label' => __( 'Button\'s Text', 'frenify-core' ),
			'desc' => __( 'Add the text that will display in the button.', 'frenify-core' ),
		),
		'gradtopcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the top color of the button background.', 'frenify-core' )
		),
		'gradbottomcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the bottom color of the button background or leave empty for solid color.', 'frenify-core' )
		),
		'gradtopcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Top Color Hover', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the top hover color of the button background.', 'frenify-core' )
		),
		'gradbottomcolorhover' => array(
			'type' => 'colorpicker',
			'label' => __( 'Button Gradient Bottom Color Hover', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the bottom hover color of the button background or leave empty for solid color.', 'frenify-core' )
		),
		'accentcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Color', 'frenify-core' ),
			'desc' => __( 'Custom setting only. This option controls the color of the button border, divider, text and icon.', 'frenify-core' )
		),
		'accenthovercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Accent Hover Color', 'frenify-core' ),
			'desc' => __( 'Custom setting only. This option controls the hover color of the button border, divider, text and icon.', 'frenify-core' )
		),		
		'bevelcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Bevel Color (3D Mode only)', 'frenify-core' ),
			'desc' => __( 'Custom setting only. Set the bevel color of 3D buttons.', 'frenify-core' )
		),		
		'borderwidth' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Width', 'frenify-core' ),
			'desc' => __( 'Custom setting only. In pixels (px), ex: 1px.  Leave blank for theme option selection.', 'frenify-core' )
		),
		/*
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'frenify-core' ),
			'desc' => __('Custom setting. Backside.', 'frenify-core')
		),
		'borderhovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Hover Color', 'frenify-core' ),
			'desc' => __('Custom setting. Backside.', 'frenify-core')
		),		
		'textcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Color', 'frenify-core' ),
			'desc' => __('Custom setting. Backside.', 'frenify-core')
		),
		'texthovercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Text Hover Color', 'frenify-core' ),
			'desc' => __('Custom setting. Backside.', 'frenify-core')
		),
		*/
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Custom Icon', 'frenify-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'frenify-core' ),
			'options' => $icons
		),
		/*
		'iconcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Icon Color', 'frenify-core' ),
			'desc' => __('Custom setting. Leave blank for theme option selection.', 'frenify-core')
		),
		*/
		'iconposition' => array(
			'type' => 'select',
			'label' => __( 'Icon Position', 'frenify-core' ),
			'desc' => __( 'Choose the position of the icon on the button.', 'frenify-core' ),
			'options' => $leftright
		),			
		'icondivider' => array(
			'type' => 'select',
			'label' => __( 'Icon Divider', 'frenify-core' ),
			'desc' => __( 'Choose to display a divider between icon and text.', 'frenify-core' ),
			'options' => $choices
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'frenify-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'frenify-core' ),
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'frenify-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'frenify-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'frenify-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'frenify-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
			'options' => $dec_numbers,
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'frenify-core' ),
			'desc' => __( 'Select the button\'s alignment.', 'frenify-core' ),
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),			
	),
	'shortcode' => '[button link="{{url}}" color="{{style}}" size="{{size}}" type="{{type}}" shape="{{shape}}" target="{{target}}" title="{{title}}" gradient_colors="{{gradtopcolor}}|{{gradbottomcolor}}" gradient_hover_colors="{{gradtopcolorhover}}|{{gradbottomcolorhover}}" accent_color="{{accentcolor}}" accent_hover_color="{{accenthovercolor}}" bevel_color="{{bevelcolor}}" border_width="{{borderwidth}}" icon="{{icon}}" icon_divider="{{icondivider}}" icon_position="{{iconposition}}" modal="{{modal}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]{{content}}[/button]',
	'popup_title' => __( 'Button Shortcode', 'frenify-core')
);


/*-----------------------------------------------------------------------------------*/
/*	Brochure Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['brochure'] = array(
	'params' => array(
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),
	),
	'shortcode' => '[brochures margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/brochures]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Download Link', 'frenify-core' ),
				'desc' => __( 'Insert link to download brochure', 'frenify-core')
			),
			'icon' => array(
				'std' => '0',
				'type' => 'select',
				'label' => __( 'Icon', 'frenify-core' ),
				'desc' => __( 'Choose icon for brochure type', 'frenify-core' ),
				'options' => array(
									'pdf'			=> "Pdf",
									'archive'	 	=> "Archive",
									'word'	 		=> "Word",
									'audio'	 		=> "Audio",
									'video'	 		=> "Video",
									'powerpoint'	=> "Powerpoint",
									'excel'	 		=> "Excel",)
								
			),			
					
			'content' => array(
				'std' => __('Text', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Brochure Text', 'frenify-core' ),
				'desc' => __( 'Insert text for brochure', 'frenify-core' ),
			)
		),
		'shortcode' => '[brochure link="{{link}}" icon="{{icon}}"]{{content}}[/brochure]',
		'clone_button' => __( 'Add New', 'frenify-core')
	)
);



/*-----------------------------------------------------------------------------------*/
/*	Checklist Config
/*-----------------------------------------------------------------------------------*/
$fotofly_fn_shortcodes['checklist'] = array(
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'frenify-core' ),
			'desc' => __( 'Global setting for all list items, this can be overridden individually below. Click an icon to select, click again to deselect.', 'frenify-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'frenify-core' ),
			'desc' => __( 'Global setting for all list items. Leave blank for theme option selection. Defines the icon color.', 'frenify-core')
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'frenify-core' ),
			'desc' => __( 'Global setting for all list items. Set to default for theme option selection. Choose to have icons in circles.', 'frenify-core' ),
			'options' => $choices_with_default
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Circle Color', 'frenify-core' ),
			'desc' => __( 'Global setting for all list items. Leave blank for theme option selection. Defines the circle color.', 'frenify-core')
		),
		'size' => array(
			'std' => '13px',
			'type' => 'text',
			'label' => __( 'Item Size', 'frenify-core' ),
			'desc' => __( 'Select the list item\'s size. In pixels (px), ex: 13px.', 'frenify-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),		
	),

	'shortcode' => '[checklist icon="{{icon}}" iconcolor="{{iconcolor}}" circle="{{circle}}" circlecolor="{{circlecolor}}" size="{{size}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/checklist]',
	'popup_title' => __( 'Checklist Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Select Icon', 'frenify-core' ),
				'desc' => __( 'This setting will override the global setting above. Leave blank for theme option selection.', 'frenify-core' ),
				'options' => $icons
			),				
			'content' => array(
				'std' => __('Your Content Goes Here', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'List Item Content', 'frenify-core' ),
				'desc' => __( 'Add list item content', 'frenify-core' ),
			),
		),
		'shortcode' => '[li_item icon="{{icon}}"]{{content}}[/li_item]',
		'clone_button' => __( 'Add New List Item', 'frenify-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Client Slider Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['clients'] = array(
	'no_preview' => true,
	'params' => array(
		'client_type' => array(
			'std' 		=> 	'b',
			'type'		=> 	'select',
			'label' 	=> 	__( 'Client Template', 'frenify-core' ),
			'options' 	=> 	array(
				'a' 	=> 'A',
				'b'    	=> 'B',
				'c'    	=> 'C',
				'd'    	=> 'D',
				'e'    	=> 'E',
			)
		),
		'client_col' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Client Columns', 'frenify-core' ),
			'std' 		=> 	'5',
			'options' 	=> 	array(
				'1' 		=> '1',
				'2' 		=> '2',
				'3' 		=> '3',
				'4' 		=> '4',
				'5' 		=> '5',
				'6' 		=> '6',
			)
		),
		'client_color' => array(
			'std' => '#000000',
			'type' => 'colorpicker',
			'label' => __( 'Color', 'frenify-core' ),
		),
		'client_opacity' => 	array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Color Transparency', 'frenify-core' ),
			'std' 		=> 	'0.9',
			'options' 	=> 	array(
				'0' 		=> '0',
				'0.1' 		=> '0.1',
				'0.2' 		=> '0.2',
				'0.3' 		=> '0.3',
				'0.4' 		=> '0.4',
				'0.5' 		=> '0.5',
				'0.6' 		=> '0.6',
				'0.7' 		=> '0.7',
				'0.8' 		=> '0.8',
				'0.9' 		=> '0.9',
				'1' 		=> '1',
			)
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[clients client_type="{{client_type}}" client_col="{{client_col}}" client_color="{{client_color}}" client_opacity="{{client_opacity}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/clients]',
	'popup_title' => __('Insert Shortcode', 'frenify-core'),

	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Client Link', 'frenify-core' ),
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'frenify-core' ),
				'desc' => __('Upload an image to display in the tab.', 'frenify-core')
			),
		),
		'shortcode' => '[client image="{{image}}" image="{{image}}"]',
		'clone_button' => __( 'Add More', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Columns Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['columns'] = array(
	'shortcode' => ' {{child_shortcode}} ', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Columns Shortcode', 'frenify-core' ),
	'no_preview' => true,
	'params' => array(),

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'column' => array(
				'type' => 'select',
				'label' => __( 'Column Type', 'frenify-core' ),
				'desc' => __( 'Select the width of the column', 'frenify-core' ),
				'options' => array(
					'one_full'		=> __('One Column', 'frenify-core'),
					'one_half' 		=> __('One Half', 'frenify-core'),
					'one_third' 	=> __('One Third', 'frenify-core'),
					'two_third' 	=> __('Two Thirds', 'frenify-core'),
					'one_fourth'	=> __('One Fourth', 'frenify-core'),
					'three_fourth' 	=> __('Three Fourth', 'frenify-core'),	
					'one_fifth' 	=> __('One Fifth', 'frenify-core'),
					'two_fifth' 	=> __('Two Fifth', 'frenify-core'),
					'three_fifth' 	=> __('Three Fifth', 'frenify-core'),
					'four_fifth' 	=> __('Four Fifth', 'frenify-core'),
					'one_sixth' 	=> __('One Sixth', 'frenify-core'),
					'five_sixth' 	=> __('Five Sixth', 'frenify-core'),
					'one' 	        => __('One ( Six Sixth )', 'frenify-core'),
				)
			),
			'last' => array(
				'type' => 'select',
				'label' => __( 'Last Column', 'frenify-core' ),
				'desc' => __('Choose if the column is last in a set. This has to be set to "Yes" for the last column in a set', 'frenify-core'),
				'options' => $reverse_choices
			),
			'spacing' 	=> array(
				'type' 			=> 'select',
				'label' 		=> __( 'Column Spacing', 'frenify-core' ),
				'desc' 			=> __('Set to "disable" to eliminate space between columns.', 'frenify-core'),
				'options' 		=> array(
					'enable' 			=> __( 'Enable', 'frenify-core' ),
					'disable'  			=> __( 'Disable', 'frenify-core' ),
				),
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Column Content', 'frenify-core' ),
				'desc' => __( 'Insert the column content', 'frenify-core' ),
			),
			'text_color' => array(
				'type' 		=> 'colorpicker',
				'label' 	=> __( 'Text Color', 'frenify-core' ),
				'desc' 		=> __( 'Leave blank for default color', 'frenify-core')
			),
			'text_align' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Text Align', 'frenify-core' ),
				'options' => array(
					'center' 	=> __('Center', 'frenify-core'),
					'left' 		=> __('Left', 'frenify-core'),
					'right' 	=> __('Right', 'frenify-core'),
				)
			),	
			'background_color' => array(
				'type' 		=> 'colorpicker',
				'label' 	=> __( 'Background Color', 'frenify-core' ),
				'desc' 		=> __( 'Leave blank for default color', 'frenify-core')
			),
			'background_color_rate' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Background Color Transparency', 'frenify-core' ),
				'std' 		=> '1',
				'options' 	=> $decimals,
			),
			'background_type' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Background Type', 'frenify-core' ),
				'options' => array(
					'none'      		=> __( 'None', 'frenify-core' ),
					'image'   			=> __( 'Image', 'frenify-core' ),
				)
			),
			'background_image' => array(
				'type' 		=> 'uploader',
				'label' 	=> __( 'Background Image', 'frenify-core' ),
				'desc' 		=> __('Upload an image to display in the background', 'frenify-core')
			),
			'background_repeat' => array(
				'type'	 	=> 'select',
				'label' 	=> __( 'Background Repeat', 'frenify-core' ),
				'desc' 		=> __( 'Choose how the background image repeats.', 'frenify-core' ),
				'std' 		=> 'repeat',
				'options' 	=> array(
					'no-repeat' => __( 'No Repeat', 'frenify-core' ),
					'repeat'    => __( 'Repeat Vertically and Horizontally', 'frenify-core' ),
					'repeat-x'  => __( 'Repeat Horizontally', 'frenify-core' ),
					'repeat-y'  => __( 'Repeat Vertically', 'frenify-core' )
				)
			),
			'background_position' => array(
				'type' 		=> 'select',
				'label' 	=> __('Background Position', 'frenify-core' ),
				'desc' 		=> __('Choose the postion of the background image', 'frenify-core'),
				'std'		=> 'left top',
				'options' 	=> array(
					'left top'      => __( 'Left Top', 'frenify-core' ),
					'left center'   => __( 'Left Center', 'frenify-core' ),
					'left bottom'   => __( 'Left Bottom', 'frenify-core' ),
					'right top'     => __( 'Right Top', 'frenify-core' ),
					'right center'  => __( 'Right Center', 'frenify-core' ),
					'right bottom'  => __( 'Right Bottom', 'frenify-core' ),
					'center top'    => __( 'Center Top', 'frenify-core' ),
					'center center' => __( 'Center Center', 'frenify-core' ),
					'center bottom' => __( 'Center Bottom', 'frenify-core' )
				),
			),
			'background_size' => array(
				'type'	 	=> 'select',
				'label' 	=> __( 'Background Size', 'frenify-core' ),
				'desc' 		=> __( 'Choose the background size.', 'frenify-core' ),
				'std' 		=> 'auto',
				'options' 	=> array(
					'auto' 				=> __( 'Auto', 'frenify-core' ),
					'contain'    		=> __( 'Contain', 'frenify-core' ),
					'cover'  			=> __( 'Cover', 'frenify-core' ),
				)
			),
			'border_position' => array(
				'type'	 	=> 'select',
				'label' 	=> __( 'Border Position', 'frenify-core' ),
				'desc' 		=> __( 'Choose the position of the border.', 'frenify-core' ),
				'std' 		=> 'all',
				'options' 	=> array(
					'all'      			=> __( 'All', 'frenify-core' ),
					'top'   			=> __( 'Top', 'frenify-core' ),
					'bottom'   			=> __( 'Bottom', 'frenify-core' ),
					'right'     		=> __( 'Right', 'frenify-core' ),
					'left'  			=> __( 'Left', 'frenify-core' )
				)
			),
			'border_size' => array(
				'std' 	=> '',
				'type' => 'text',
				'label' => __( 'Border Size', 'frenify-core' ),
				'desc' => __( 'In pixels (px), ex: 1px.', 'frenify-core' )
			),
			'border_style' => array(
				'type'	 	=> 'select',
				'label' 	=> __( 'Border Style', 'frenify-core' ),
				'desc' 		=> __( 'Choose the style of the border.', 'frenify-core' ),
				'std' 		=> 'solid',
				'options' 	=> array(
					'solid'      		=> __( 'Solid', 'frenify-core' ),
					'dashed'   			=> __( 'Dashed', 'frenify-core' ),
					'dotted'   			=> __( 'Dotted', 'frenify-core' )
				)
			),
			'border_color' => array(
				'type' 		=> 'colorpicker',
				'label' 	=> __( 'Border Color', 'frenify-core' ),
				'desc' 		=> __( 'Choose the border color', 'frenify-core')
			),
			'padding' => array(
				'std' 	=> '',
				'type' => 'text',
				'label' => __( 'Padding', 'frenify-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'frenify-core' )
			),
			'margin_top' => array(
				'std' 	=> '',
				'type' => 'text',
				'label' => __( 'Margin Top', 'frenify-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'frenify-core' )
			),
			'margin_bottom' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Margin Bottom', 'frenify-core' ),
				'desc' => __( 'In pixels (px), ex: 10px.', 'frenify-core' )
			),
			'animation_type' => array(
				'type' 			=> 'select',
				'label' 		=> __( 'Animation Type', 'frenify-core' ),
				'desc' 			=> __( 'Select the type on animation to use on the shortcode', 'frenify-core' ),
				'options' 		=> $animation_type,
			),
			'animation_delay' => array(
				'std' 			=> '0',
				'type' 			=> 'text',
				'label' 		=> __( 'Animation Delay', 'frenify-core' ),
				'desc' 			=> __( 'Insert Delay Time', 'frenify-core' ),
			),
			'class' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS Class', 'frenify-core' ),
				'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
			),
			'id' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'CSS ID', 'frenify-core' ),
				'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
			),			
		),
		'shortcode' => '[{{column}} last="{{last}}" spacing="{{spacing}}" padding="{{padding}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}" text_color="{{text_color}}" text_align="{{text_align}}" background_color="{{background_color}}" background_color_rate="{{background_color_rate}}" background_type="{{background_type}}" background_image="{{background_image}}" background_position="{{background_position}}" background_repeat="{{background_repeat}}" background_size="{{background_size}}" border_position="{{border_position}}" border_size="{{border_size}}" border_style="{{border_style}}" border_color="{{border_color}}" animation_type="{{animation_type}}" animation_delay="{{animation_delay}}"]{{content}}[/{{column}}] ',
		'clone_button' => __( 'Add Column', 'frenify-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Content Boxes Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['contentboxes'] = array(
	'params' => array(
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Box Layout', 'frenify-core' ),
			'desc' => __( 'Select the layout for the content box', 'frenify-core' ),
			'options' => array(
				'icon-with-title' => __('Classic Icon With Title', 'frenify-core'),
				'icon-on-top' => __('Classic Icon On Top', 'frenify-core'),
				'icon-on-side' => __('Classic Icon On Side', 'frenify-core'),
				'icon-boxed' => __('Icon Boxed', 'frenify-core'),
				'clean-vertical' => __('Clean Layout Vertical', 'frenify-core'),
				'clean-horizontal' => __('Clean Layout Horizontal', 'frenify-core'),
				'timeline-vertical' => __('Timeline Vertical', 'frenify-core'),
				'timeline-horizontal' => __('Timeline Horizontal', 'frenify-core')
			)
		),
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'frenify-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_range( 6, false )
		),
		'icon_align' => array(
			'std' => 'left',
			'type' => 'select',
			'label' => __( 'Content Alignment', 'frenify-core' ),
			'desc' =>  __( 'Works with "Classic Icon With Title" and "Classic Icon On Side" layout options.' ),
			'options' => array('left'		=> 'Left',
							   'right'	 	=> 'Right') 
		),
		'title_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title Size', 'frenify-core' ),
			'desc' => __( 'Controls the size of the title. Leave blank for theme option selection. In pixels ex: 18px.', 'frenify-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Content Box Background Color', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'icon_circle' => array(
			'type' => 'select',
			'label' => __( 'Icon Background', 'frenify-core' ),
			'desc' => __( 'Controls the background behind the icon. Select default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'yes' => __('Yes', 'frenify-core'),
				'no' => __('No', 'frenify-core'),
			)
		),
		'icon_circle_radius' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Radius', 'frenify-core' ),
			'desc' => __( 'Choose the border radius of the icon background. Leave blank for theme option selection. In pixels (px), ex: 1px, or "round".', 'frenify-core')
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Color', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Inner Border Color', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'circlebordercolorsize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Inner Border Size', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'outercirclebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Background Outer Border Color', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'outercirclebordercolorsize' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Background Outer Border Size', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
		),
		'icon_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Icon Size', 'frenify-core' ),
			'desc' => __( 'Controls the size of the icon.  Leave blank for theme option selection. In pixels ex: 18px.', 'frenify-core')
		),
		'link_type' => array(
			'type' => 'select',
			'label' => __( 'Link Type', 'frenify-core' ),
			'desc' => __( 'Select the type of link that should show in the content box. Select default for theme option selection.', 'frenify-core' ),
			'options' => array(
				''	=> 'Default',
				'text' => 'Text',
				'button-bar' => 'Button Bar',
				'button' => 'Button'
			)
		),
		'link_area' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Link Area', 'frenify-core' ),
			'desc' =>  __( 'Select which area the link will be assigned to' ),
			'options' => array('' => 'Default',
								'link-icon'		=> 'Link+Icon',
							   'box'	 		=> 'Entire Content Box') 
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'frenify-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'frenify-core' ),
			'options' => array(
				''	=> 'Default',
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'animation_delay' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Animation Delay', 'frenify-core' ),
			'desc' => __( 'Controls the delay of animation between each element in a set. In milliseconds.', 'frenify-core')
		),
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'frenify-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'frenify-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'frenify-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'frenify-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
			'options' => $dec_numbers,
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'In pixels (px), ex: 10px.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'In pixels (px), ex: 10px.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),			
	),
	'shortcode' => '[content_boxes layout="{{layout}}" columns="{{columns}}" icon_align="{{icon_align}}" title_size="{{title_size}}" backgroundcolor="{{backgroundcolor}}" icon_circle="{{icon_circle}}" icon_circle_radius="{{icon_circle_radius}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" circlebordercolorsize="{{circlebordercolorsize}}" outercirclebordercolor="{{circlebordercolor}}" outercirclebordercolorsize="{{outercirclebordercolorsize}}" icon_size="{{icon_size}}" link_type="{{link_type}}" link_area="{{link_area}}" animation_delay="{{animation_delay}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" margin_top="{{margin_top}}" margin_bottom="{{margin_top}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/content_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Content Boxes Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'frenify-core'),
				'desc' => __( 'The box title.', 'frenify-core' ),
			),
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'frenify-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'frenify-core' ),
				'options' => $icons
			),
			'backgroundcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Content Box Background Color', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Color', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Inner Border Color', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'circlebordercolorsize' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Icon Background Inner Border Size', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'outercirclebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Background Outer Border Color', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'outercirclebordercolorsize' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Icon Background Outer Border Size', 'frenify-core' ),
				'desc' => __( 'Leave blank for theme option selection.', 'frenify-core')
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'frenify-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'frenify-core' ),
				'options' => array(
					''	=> __('None', 'frenify-core'),
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'frenify-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'frenify-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'frenify-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'frenify-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'frenify-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'frenify-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'frenify-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'frenify-core' ),
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link Url', 'frenify-core' ),
				'desc' => __( 'Add the link\'s url ex: http://example.com', 'frenify-core' ),

			),
			'linktext' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link Text', 'frenify-core' ),
				'desc' => __( 'Insert the text to display as the link', 'frenify-core' ),

			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'frenify-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'frenify-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'content' => array(
				'std' => __('Your Content Goes Here', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Content Box Content', 'frenify-core' ),
				'desc' => __( 'Add content for content box', 'frenify-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'frenify-core' ),
				'desc' => __( 'Select the type on animation to use on the shortcode', 'frenify-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'frenify-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'frenify-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[content_box title="{{title}}" icon="{{icon}}" backgroundcolor="{{backgroundcolor}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" circlebordercolorsize="{{circlebordercolorsize}}" outercirclebordercolor="{{circlebordercolor}}" outercirclebordercolorsize="{{outercirclebordercolorsize}}" iconrotate="{{iconrotate}}" iconspin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" link="{{link}}" linktarget="{{target}}" linktext="{{linktext}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/content_box]',
		'clone_button' => __( 'Add New Content Box', 'frenify-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Counters Box Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['countersbox'] = array(
	'params' => array(
		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'frenify-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_range( 6, false )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),
	),
	'shortcode' => '[counters_box columns="{{columns}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/counters_box]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'value' => array(
				'std' => '777',
				'type' => 'text',
				'label' => __( 'Counter Value', 'frenify-core' ),
				'desc' => __( 'The number to which the counter will animate.', 'frenify-core')
			),
			'start' => array(
				'std' => '0',
				'type' => 'text',
				'label' => __( 'Counter Starting Value', 'frenify-core' ),
				'desc' => __( 'The number to which the counter starts.', 'frenify-core' ),
			),			
			'speed' => array(
				'std' => '2000',
				'type' => 'text',
				'label' => __( 'Counter Speed', 'frenify-core' ),
			),
					
			'content' => array(
				'std' => __('Text', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Counter Box Text', 'frenify-core' ),
				'desc' => __( 'Insert text for counter box', 'frenify-core' ),
			)
		),
		'shortcode' => '[counter_box value="{{value}}" start="{{start}}" speed="{{speed}}"]{{content}}[/counter_box]',
		'clone_button' => __( 'Add New', 'frenify-core')
	)
);



/*-----------------------------------------------------------------------------------*/
/*	Dropcap Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['dropcap'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => 'A',
			'type' => 'textarea',
			'label' => __( 'Dropcap Letter', 'frenify-core' ),
			'desc' => __( 'Add the letter to be used as dropcap', 'frenify-core' ),
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Color', 'frenify-core' ),
			'desc' => __( 'Controls the color of the dropcap letter. Leave blank for theme option selection.', 'frenify-core ')
		),		
		'boxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Dropcap', 'frenify-core' ),
			'desc' => __( 'Choose to get a boxed dropcap.', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'boxedradius' => array(
			'std' => '8px',
			'type' => 'text',
			'label' => __( 'Box Radius', 'frenify-core' ),
			'desc' => __('Choose the radius of the boxed dropcap. In pixels (px), ex: 1px, or "round".', 'frenify-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),
	),
	'shortcode' => '[dropcap color="{{color}}" boxed="{{boxed}}" boxed_radius="{{boxedradius}}" class="{{class}}" id="{{id}}"]{{content}}[/dropcap]',
	'popup_title' => __( 'Dropcap Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Post Slider Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['postslider'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'frenify-core' ),
			'desc' => __( 'Choose a layout style for Post Slider.', 'frenify-core' ),
			'options' => array(
				'posts' => __('Posts with Title', 'frenify-core'),
				'posts-with-excerpt' => __('Posts with Title and Excerpt', 'frenify-core'),
				'attachments' => __('Attachment Layout, Only Images Attached to Post/Page', 'frenify-core')
			)
		),
		'excerpt' => array(
			'std' => 35,
			'type' => 'text',
			'label' => __( 'Excerpt Number of Words', 'frenify-core' ),
			'desc' => __( 'Insert the number of words you want to show in the excerpt.', 'frenify-core' ),
		),
		'category' => array(
			'std' => 35,
			'type' => 'select',
			'label' => __( 'Category', 'frenify-core' ),
			'desc' => __( 'Select a category of posts to display.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'category', true, 'All' )
		),
		'limit' => array(
			'std' => 3,
			'type' => 'text',
			'label' => __( 'Number of Slides', 'frenify-core' ),
			'desc' => __( 'Select the number of slides to display.', 'frenify-core' )
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Lightbox on Click', 'frenify-core' ),
			'desc' => __( 'Only works on attachment layout.', 'frenify-core' ),
			'options' => $choices
		),
		'image' => array(
			'type' => 'gallery',
			'label' => __( 'Attach Images to Post/Page Gallery', 'frenify-core' ),
			'desc' => __( 'Only works for attachments layout.', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),		
	),
	'shortcode' => '[postslider layout="{{type}}" excerpt="{{excerpt}}" category="{{category}}" limit="{{limit}}" id="" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"][/postslider]',
	'popup_title' => __( 'Post Slider Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Flip Boxes Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['flipboxes'] = array(
	'params' => array(

		'columns' => array(
			'std' => 4,
			'type' => 'select',
			'label' => __( 'Number of Columns', 'frenify-core' ),
			'desc' =>  __( 'Set the number of columns per row.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_range( 6, false )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[flip_boxes columns="{{columns}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/flip_boxes]', // as there is no wrapper shortcode
	'popup_title' => __( 'Flip Boxes Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'titlefront' => array(
				'std' => __('Your Content Goes Here', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Flip Box Frontside Heading', 'frenify-core' ),
				'desc' => __( 'Add a heading for the frontside of the flip box.', 'frenify-core' ),
			),			
			'titleback' => array(
				'std' => __('Your Content Goes Here', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Flip Box Backside Heading', 'frenify-core' ),
				'desc' => __( 'Add a heading for the backside of the flip box.', 'frenify-core' ),
			),			
			'textfront' => array(
				'std' => __('Your Content Goes Here', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Flip Box Frontside Content', 'frenify-core' ),
				'desc' => __( 'Add content for the frontside of the flip box.', 'frenify-core' ),
			),			
			'content' => array(
				'std' => __('Your Content Goes Here', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Flip Box Backside Content', 'frenify-core' ),
				'desc' => __( 'Add content for the backside of the flip box.', 'frenify-core' ),
			),		
			'backgroundcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Frontside', 'frenify-core' ),
				'desc' => __( 'Controls the background color of the frontside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'frenify-core' )
			),
			'titlecolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Frontside', 'frenify-core' ),
				'desc' => __( 'Controls the heading color of the frontside. Leave blank for theme option selection.', 'frenify-core' )
			),
			'textcolorfront' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Frontside', 'frenify-core' ),
				'desc' => __( 'Controls the text color of the frontside. Leave blank for theme option selection.', 'frenify-core' )
			),			
			'backgroundcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Background Color Backside', 'frenify-core' ),
				'desc' => __( 'Controls the background color of the backside. Leave blank for theme option selection. NOTE: flip boxes must have background colors to work correctly in all browsers.', 'frenify-core' )
			),
			'titlecolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Heading Color Backside', 'frenify-core' ),
				'desc' => __( 'Controls the heading color of the backside. Leave blank for theme option selection.', 'frenify-core' )
			),				
			'textcolorback' => array(
				'type' => 'colorpicker',
				'label' => __( 'Text Color Backside', 'frenify-core' ),
				'desc' => __( 'Controls the text color of the backside. Leave blank for theme option selection.', 'frenify-core' )
			),			
			'bordersize' => array(
				'std' => '1px',
				'type' => 'text',
				'label' => __( 'Border Size', 'frenify-core' ),
				'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core' ),
			),
			'bordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Border Color', 'frenify-core' ),
				'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'frenify-core' )
			),
			'borderradius' => array(
				'std' => '4px',
				'type' => 'text',
				'label' => __( 'BorderRadius', 'frenify-core' ),
				'desc' => __( 'Controls the flip box border radius. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'frenify-core' ),
			),			
			'icon' => array(
				'type' => 'iconpicker',
				'label' => __( 'Icon', 'frenify-core' ),
				'desc' => __( 'Click an icon to select, click again to deselect.', 'frenify-core' ),
				'options' => $icons
			),			
			'iconcolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Color', 'frenify-core' ),
				'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'frenify-core' )
			),
			'circle' => array(
				'std' => 0,
				'type' => 'select',
				'label' => __( 'Icon Circle', 'frenify-core' ),
				'desc' => __( 'Choose to use a circled background on the icon.', 'frenify-core' ),
				'options' => $choices
			),			
			'circlecolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Background Color', 'frenify-core' ),
				'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'frenify-core')
			),
			'circlebordercolor' => array(
				'type' => 'colorpicker',
				'label' => __( 'Icon Circle Border Color', 'frenify-core' ),
				'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'frenify-core')
			),
			'iconrotate' => array(
				'type' => 'select',
				'label' => __( 'Rotate Icon', 'frenify-core' ),
				'desc' => __( 'Choose to rotate the icon.', 'frenify-core' ),
				'options' => array(
					''	=> __('None', 'frenify-core'),
					'90' => '90',
					'180' => '180',
					'270' => '270',					
				)
			),				
			'iconspin' => array(
				'type' => 'select',
				'label' => __( 'Spinning Icon', 'frenify-core' ),
				'desc' => __( 'Choose to let the icon spin.', 'frenify-core' ),
				'options' => $reverse_choices
			),									
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Icon Image', 'frenify-core' ),
				'desc' => __( 'To upload your own icon image, deselect the icon above and then upload your icon image.', 'frenify-core' ),
			),
			'image_width' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Width', 'frenify-core' ),
				'desc' => __( 'If using an icon image, specify the image width in pixels but do not add px, ex: 35.', 'frenify-core' ),
			),
			'image_height' => array(
				'std' => 35,
				'type' => 'text',
				'label' => __( 'Icon Image Height', 'frenify-core' ),
				'desc' => __( 'If using an icon image, specify the image height in pixels but do not add px, ex: 35.', 'frenify-core' ),
			),
			'animation_type' => array(
				'type' => 'select',
				'label' => __( 'Animation Type', 'frenify-core' ),
				'desc' => __( 'Select the type of animation to use on the shortcode', 'frenify-core' ),
				'options' => $animation_type,
			),
			'animation_direction' => array(
				'type' => 'select',
				'label' => __( 'Direction of Animation', 'frenify-core' ),
				'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
				'options' => $animation_direction,
			),
			'animation_speed' => array(
				'type' => 'select',
				'std' => '',
				'label' => __( 'Speed of Animation', 'frenify-core' ),
				'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'frenify-core' ),
				'options' => $dec_numbers,
			)
		),
		'shortcode' => '[flip_box title_front="{{titlefront}}" title_back="{{titleback}}" text_front="{{textfront}}" border_color="{{bordercolor}}" border_radius="{{borderradius}}" border_size="{{bordersize}}" background_color_front="{{backgroundcolorfront}}" title_front_color="{{titlecolorfront}}" text_front_color="{{textcolorfront}}" background_color_back="{{backgroundcolorback}}" title_back_color="{{titlecolorback}}" text_back_color="{{textcolorback}}" icon="{{icon}}" icon_color="{{iconcolor}}" circle="{{circle}}" circle_color="{{circlecolor}}" circle_border_color="{{circlebordercolor}}" icon_rotate="{{iconrotate}}" icon_spin="{{iconspin}}" image="{{image}}" image_width="{{image_width}}" image_height="{{image_height}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}"]{{content}}[/flip_box]',
		'clone_button' => __( 'Add New Flip Box', 'frenify-core')
	)
);


/*-----------------------------------------------------------------------------------*/
/*	FontAwesome Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['fontawesome'] = array(
	'no_preview' => true,
	'params' => array(

		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'frenify-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'frenify-core' ),
			'options' => $icons
		),
		'circle' => array(
			'type' => 'select',
			'label' => __( 'Icon in Circle', 'frenify-core' ),
			'desc' => __( 'Choose to display the icon in a circle.', 'frenify-core' ),
			'options' => $choices
		),
		'size' => array(
			'std' => '13px',
			'type' => 'text',
			'label' => __( 'Icon Size', 'frenify-core' ),
			'desc' => __( 'Set the size of the icon. In pixels (px), ex: 13px.', 'frenify-core' ),
		),			
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'frenify-core' ),
			'desc' => __( 'Controls the color of the icon. Leave blank for theme option selection.', 'frenify-core')
		),
		'circlecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Background Color', 'frenify-core' ),
			'desc' => __( 'Controls the color of the circle. Leave blank for theme option selection.', 'frenify-core')
		),
		'circlebordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Circle Border Color', 'frenify-core' ),
			'desc' => __( 'Controls the color of the circle border. Leave blank for theme option selection.', 'frenify-core')
		),
		'rotate' => array(
			'type' => 'select',
			'label' => __( 'Rotate Icon', 'frenify-core' ),
			'desc' => __( 'Choose to rotate the icon.', 'frenify-core' ),
			'options' => array(
				''	=> __('None', 'frenify-core'),
				'90' => '90',
				'180' => '180',
				'270' => '270',					
			)
		),				
		'spin' => array(
			'type' => 'select',
			'label' => __( 'Spinning Icon', 'frenify-core' ),
			'desc' => __( 'Choose to let the icon spin.', 'frenify-core' ),
			'options' => $reverse_choices
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'frenify-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode', 'frenify-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'frenify-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'frenify-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'frenify-core' ),
			'options' => $dec_numbers,
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'frenify-core' ),
			'desc' => __( 'Select the icon\'s alignment.', 'frenify-core' ),
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),		
	),
	'shortcode' => '[fontawesome icon="{{icon}}" circle="{{circle}}" size="{{size}}" iconcolor="{{iconcolor}}" circlecolor="{{circlecolor}}" circlebordercolor="{{circlebordercolor}}" rotate="{{rotate}}" spin="{{spin}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Font Awesome Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Fullwidth Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['fullwidth'] = array(
	'no_preview' => true,
	'params' => array(
		
		'min_height' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Content Min Height', 'frenify-core' ),
			'std'  		=> 'yes',
			'options' 	=> array(
				'enable' 	=> __( 'Full Screen', 'frenify-core' ),
				'disable'  	=> __( 'Auto', 'frenify-core' ),
				'h100'  	=> 100,
				'h200'  	=> 200,
				'h300'  	=> 300,
				'h400'  	=> 400,
				'h500'  	=> 500,
				'h600'  	=> 600,
				'h700'  	=> 700,
				'h800'  	=> 800,
				'h900'  	=> 900,
				'h1000'  	=> 1000,
			),
		),
	
		'content_layout' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Content Layout', 'frenify-core' ),
			'std'  		=> 'yes',
			'options' 	=> array(
								'contained' => __( 'Contained', 'frenify-core' ),
								'full'  	=> __( 'Full', 'frenify-core' ),
							),
		),
		'content_color' => array(
			'type' 		=> 'colorpicker',
			'label' 	=> __( 'Content Color', 'frenify-core' ),
		),
		'background_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'frenify-core' ),
			'desc' => __( 'Controls the background color.', 'frenify-core')
		),
		'background_color_rate' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Background Color Transparency', 'frenify-core' ),
			'std' 		=> '0.3',
			'options' 	=> array( '0' => '0', '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' ),
			
		),
		'background_type' => array(
			'type'	 	=> 'select',
			'label' 	=> __( 'Background Size', 'frenify-core' ),
			'desc' 		=> __( 'Choose how the background size.', 'frenify-core' ),
			'std' 		=> 'image',
			'options' 	=> array(
				'parallax'      => __( 'Parallax', 'frenify-core' ),
				'video'   		=> __( 'Video', 'frenify-core' ),
				'bgslide'   	=> __( 'BG Slide', 'frenify-core' ),
				'image'   		=> __( 'Image', 'frenify-core' )
			)
		),
		'background_image' => array(
			'type' 		=> 'uploader',
			'label' 	=> __( 'Background Image', 'frenify-core' ),
			'desc' 		=> __('Upload an image to display in the background', 'frenify-core')
		),
		'background_size' => array(
			'type'	 	=> 'select',
			'label' 	=> __( 'Background Size', 'frenify-core' ),
			'desc' 		=> __( 'Choose how the background size.', 'frenify-core' ),
			'std' 		=> 'cover',
			'options' 	=> array(
				'auto' 			=> __( 'Auto', 'frenify-core' ),
				'contain'    	=> __( 'Contain', 'frenify-core' ),
				'cover'  		=> __( 'Cover', 'frenify-core' )
			)
		),
		'background_repeat' => array(
			'type'	 	=> 'select',
			'label' 	=> __( 'Background Repeat', 'frenify-core' ),
			'desc' 		=> __( 'Choose how the background image repeats.', 'frenify-core' ),
			'std' 		=> 'repeat',
			'options' 	=> array(
				'no-repeat' => __( 'No Repeat', 'frenify-core' ),
				'repeat'    => __( 'Repeat Vertically and Horizontally', 'frenify-core' ),
				'repeat-x'  => __( 'Repeat Horizontally', 'frenify-core' ),
				'repeat-y'  => __( 'Repeat Vertically', 'frenify-core' )
			)
		),
		'background_position' => array(
			'type' 		=> 'select',
			'label' 	=> __('Background Position', 'frenify-core' ),
			'desc' 		=> __('Choose the postion of the background image', 'frenify-core'),
			'std'		=> 'left top',
			'options' 	=> array(
				'left top'      => __( 'Left Top', 'frenify-core' ),
				'left center'   => __( 'Left Center', 'frenify-core' ),
				'left bottom'   => __( 'Left Bottom', 'frenify-core' ),
				'right top'     => __( 'Right Top', 'frenify-core' ),
				'right center'  => __( 'Right Center', 'frenify-core' ),
				'right bottom'  => __( 'Right Bottom', 'frenify-core' ),
				'center top'    => __( 'Center Top', 'frenify-core' ),
				'center center' => __( 'Center Center', 'frenify-core' ),
				'center bottom' => __( 'Center Bottom', 'frenify-core' )
			),
		),
		'parallax_speed' => array(
			'type' 		=> 'select',
			'label' 	=> __('Parallax Speed', 'frenify-core' ),
			'std'		=> '0.5',
			'options' 	=> array( '0' => '0', '0.1' => '0.1', '0.2' => '0.2', '0.3' => '0.3', '0.4' => '0.4', '0.5' => '0.5', '0.6' => '0.6', '0.7' => '0.7', '0.8' => '0.8', '0.9' => '0.9', '1' => '1' ),
		),
		'video_url' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'Video Url', 'frenify-core' ),
			'desc' 		=> '',
		),
		'bgslide_direction' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide Direction', 'frenify-core' ),
			'std'  		=> 'hor',
			'options' 	=> array(
				'hor' 		=> __('Horizontal', 'frenify-core'),
				'ver' 		=> __('Vertical', 'frenify-core'),
				'both' 		=> __('Both Direction', 'frenify-core'),
			),
		),
		'bgslide_xaxis' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide: Reverse X axis', 'frenify-core' ),
			'std'  		=> '0',
			'options' 	=> array( '0' => '0', '1' => '1' ),
		),	
		'bgslide_yaxis' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide: Reverse Y axis', 'frenify-core' ),
			'std'  		=> '0',
			'options' 	=> array( '0' => '0', '1' => '1' ),
		),	
		'bgslide_rate' 	=> array(
			'type' 		=> 'select',
			'label' 	=> __( 'BG Slide Rate', 'frenify-core' ),
			'std'  		=> '30',
			'options'	=> fotofly_fn_shortcodes_range( 100, false )
		),	
		'margin_top' => array(
			'std' 		=> '0px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Top', 'frenify-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' 		=> '0px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Bottom', 'frenify-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'frenify-core' )
		),	
		'padding_top' => array(
			'std' 		=> '150px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Top', 'frenify-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'frenify-core' )
		),
		'padding_bottom' => array(
			'std' 		=> '150px',
			'type' 		=> 'text',
			'label' 	=> __( 'Padding Bottom', 'frenify-core' ),
			'desc' 		=> __( 'In pixels or percentage, ex: 10px or 10%.', 'frenify-core' )
		),
		'cols_equal_height' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Set Columns to Equal Height', 'frenify-core' ),
			'desc' 		=> __('Select to set all column shortcodes that are used inside the container to have equal height.', 'frenify-core'),
			'std'  		=> 'disable',
			'options' 	=> array(
				'enable' 		=> __('Enable', 'frenify-core'),
				'disable' 		=> __('Disable', 'frenify-core'),
			),
		),
		'cols_ver_align' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Columns Vertical Align', 'frenify-core' ),
			'desc' 		=> __('Only works with columns inside a full width container that is set to equal heights.', 'frenify-core'),
			'std'  		=> 'none',
			'options' 	=> array(
				'none' 			=> __('None', 'frenify-core'),
				'top' 			=> __('Top', 'frenify-core'),
				'middle' 		=> __('Middle', 'frenify-core'),
				'bottom' 		=> __('Bottom', 'frenify-core'),
			),
		),
		'menu_anchor' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'Menu Anchor', 'frenify-core' ),
			'desc' 		=> __( 'Just insert unique text(id).', 'frenify-core')
		),
		'class' => array(
			'std'		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'CSS Class', 'frenify-core' ),
			'desc' 		=> __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' 		=> '',
			'type' 		=> 'text',
			'label' 	=> __( 'CSS ID', 'frenify-core' ),
			'desc' 		=> __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),
		'content' => array(
			'std' 		=> __('Your Content Goes Here', 'frenify-core'),
			'type' 		=> 'textarea',
			'label' 	=> __( 'Content', 'frenify-core' ),
			'desc' 		=> __( 'Add content', 'frenify-core' ),
		),			
	),
	'shortcode' => '[fullwidth min_height="{{min_height}}" content_layout="{{content_layout}}" content_color="{{content_color}}" background_color="{{background_color}}" background_color_rate="{{background_color_rate}}" background_type="{{background_type}}" background_image="{{background_image}}" background_size="{{background_size}}" background_repeat="{{background_repeat}}" background_position="{{background_position}}" parallax_speed="{{parallax_speed}}" video_url="{{video_url}}"  bgslide_direction="{{bgslide_direction}}" bgslide_xaxis="{{bgslide_xaxis}}" bgslide_yaxis="{{bgslide_yaxis}}" bgslide_rate="{{bgslide_rate}}"  margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" padding_top="{{padding_top}}" padding_bottom="{{padding_bottom}}" cols_equal_height="{{cols_equal_height}}" cols_ver_align="{{cols_ver_align}}" menu_anchor="{{menu_anchor}}" class="{{class}}" id="{{id}}"]{{content}}[/fullwidth]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Google Map Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['googlemap'] = array(
	'no_preview' => true,
	'params' => array(
		'type' => array(
			'type' => 'select',
			'label' => __( 'Map Type', 'frenify-core' ),
			'desc' => __( 'Select the type of google map to display.', 'frenify-core' ),
			'options' => array(
				'roadmap' => __('Roadmap', 'frenify-core'),
				'satellite' => __('Satellite', 'frenify-core'),
				'hybrid' => __('Hybrid', 'frenify-core'),
				'terrain' => __('Terrain', 'frenify-core')
			)
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Map Width', 'frenify-core' ),
			'desc' => __( 'Map width in percentage or pixels. ex: 100%, or 940px.', 'frenify-core')
		),
		'height' => array(
			'std' => '300px',
			'type' => 'text',
			'label' => __( 'Map Height', 'frenify-core' ),
			'desc' => __( 'Map height in pixels. ex: 300px', 'frenify-core')
		),
		'zoom' => array(
			'std' => 14,
			'type' => 'select',
			'label' => __( 'Zoom Level', 'frenify-core' ),
			'desc' => __( 'Higher number will be more zoomed in.', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_range( 25, false )
		),
		'scrollwheel' => array(
			'type' => 'select',
			'label' => __( 'Scrollwheel on Map', 'frenify-core' ),
			'desc' => __( 'Enable zooming using a mouse\'s scroll wheel.', 'frenify-core' ),
			'options' => $choices
		),
		'scale' => array(
			'type' => 'select',
			'label' => __( 'Show Scale Control on Map', 'frenify-core' ),
			'desc' => __( 'Display the map scale.', 'frenify-core' ),
			'options' => $choices
		),
		'zoom_pancontrol' => array(
			'type' => 'select',
			'label' => __( 'Show Pan Control on Map', 'frenify-core' ),
			'desc' => __( 'Displays pan control button.', 'frenify-core' ),
			'options' => $choices
		),
		'animation' => array(
			'type' => 'select',
			'label' => __( 'Address Pin Animation', 'frenify-core' ),
			'desc' => __( 'Choose to animate the address pins when the map first loads.', 'frenify-core' ),
			'options' => $choices
		),		
		'popup' => array(
			'type' => 'select',
			'label' => __( 'Show tooltip by default', 'frenify-core' ),
			'desc' => __( 'Display or hide the tooltip when the map first loads.', 'frenify-core' ),
			'options' => $choices
		),
		'mapstyle' => array(
			'type' => 'select',
			'label' => __( 'Select the Map Styling', 'frenify-core' ),
			'desc' => __( 'Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.', 'frenify-core' ),
			'options' => array(
				'default' => __('Default Styling', 'frenify-core'),
				'theme' => __('Theme Styling', 'frenify-core'),
				'custom' => __('Custom Styling', 'frenify-core'),
			)
		),	
		'overlaycolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Map Overlay Color', 'frenify-core' ),
			'desc' => __( 'Custom styling setting only. Pick an overlaying color for the map. Works best with "roadmap" type.', 'frenify-core')
		),
		'infobox' => array(
			'type' => 'select',
			'label' => __( 'Infobox Styling', 'frenify-core' ),
			'desc' => __( 'Custom styling setting only. Choose between default or custom info box.', 'frenify-core' ),
			'options' => array(
				'default' => __('Default Infobox', 'frenify-core'),
				'custom' => __('Custom Infobox', 'frenify-core'),
			)
		),
		'infoboxcontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Infobox Content', 'frenify-core' ),
			'desc' => __( 'Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3', 'frenify-core' ),
		),		
		'infoboxtextcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Text Color', 'frenify-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box text.', 'frenify-core')
		),
		'infoboxbackgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Info Box Background Color', 'frenify-core' ),
			'desc' => __( 'Custom styling setting only. Pick a color for the info box background.', 'frenify-core')
		),
		'icon' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Custom Marker Icon', 'frenify-core' ),
			'desc' => __( 'Custom styling setting only. Use full image urls for custom marker icons or input "theme" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3', 'frenify-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Address', 'frenify-core' ),
			'desc' => __( 'Add address to the location which will show up on map. For multiple addresses, separate addresses by using the | symbol. <br />ex: Address 1|Address 2|Address 3', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' ),
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' ),
		)
	),
	'shortcode' => '[map address="{{content}}" type="{{type}}" map_style="{{mapstyle}}" overlay_color="{{overlaycolor}}" infobox="{{infobox}}" infobox_background_color="{{infoboxbackgroundcolor}}" infobox_text_color="{{infoboxtextcolor}}" infobox_content="{{infoboxcontent}}" icon="{{icon}}" width="{{width}}" height="{{height}}" zoom="{{zoom}}" scrollwheel="{{scrollwheel}}" scale="{{scale}}" zoom_pancontrol="{{zoom_pancontrol}}" popup="{{popup}}" animation="{{animation}}" class="{{class}}" id="{{id}}"][/map]',
	'popup_title' => __( 'Google Map Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Gallery Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['gallery'] = array(
	'no_preview' => true,
	'params' => array(
		/*'slide_type' => array(
			'std' 		=> 	'fade',
			'type'		=> 	'select',
			'label' 	=> 	__( 'Slide Type', 'frenify-core' ),
			'desc' 		=> 	__( 'Choose Slide Type', 'frenify-core' ),
			'options' 	=> 	array(
				'fade' 			=> __('Fade', 'frenify-core'),
				'slide' 		=> __('Slide', 'frenify-core'),
			)
		),*/
		'slide_autoplay' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Slide Autoplay', 'frenify-core' ),
			'desc' 		=> 	__( 'Set Autoplay', 'frenify-core' ),
			'std' 		=> 	'on',
			'options' 	=> 	array(
				'on' 			=> __( 'On', 'frenify-core' ),
				'off'    		=> __( 'Off', 'frenify-core' ),
			)
		),
		/*'slide_reverse' => 	array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Slide Reverse', 'frenify-core' ),
			'desc' 		=> 	__( 'Works when slide type is "Slide"', 'frenify-core' ),
			'std' 		=> 	'off',
			'options' 	=> 	array(
				'on' 			=> __( 'On', 'frenify-core' ),
				'off'    		=> __( 'Off', 'frenify-core' ),
			)
		),*/
		'slide_speed' => array(
			'std' => '4000',
			'type' => 'text',
			'label' => __( 'Slide Speed', 'frenify-core' ),
			'desc' => __( 'In milliseconds, ex: 4000.', 'frenify-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[tdgallery slide_autoplay="{{slide_autoplay}}" slide_speed="{{slide_speed}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/tdgallery]',
	'popup_title' => __('Insert Shortcode', 'frenify-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'frenify-core' ),
				'desc' => __('Upload an image to display in the tab.', 'frenify-core')
			),
		),
		'shortcode' => '[gimg image="{{image}}"][/gimg]',
		'clone_button' => __( 'Add More', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Supersized Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['supersized'] = array(
	'no_preview' => true,
	'params' => array(
		'purchase_button' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Purchase Button', 'frenify-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'frenify-core' ),
				'disable'    		=> __( 'Disable', 'frenify-core' ),
			)
		),
		'slide_interval' => array(
			'std' => '4000',
			'type' => 'text',
			'label' => __( 'Slide Speed', 'frenify-core' ),
			'desc' => __( 'In milliseconds, ex: 4000.', 'frenify-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[supersized purchase_button="{{purchase_button}}" slide_interval="{{slide_interval}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/supersized]',
	'popup_title' => __('Insert Shortcode', 'frenify-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'frenify-core' ),
				'desc' => __('Upload an image to display in the tab.', 'frenify-core')
			),
		),
		'shortcode' => '[simg image="{{image}}"][/simg]',
		'clone_button' => __( 'Add More', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Supersized Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['kenburns'] = array(
	'no_preview' => true,
	'params' => array(
		'purchase_button' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Purchase Button', 'frenify-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'frenify-core' ),
				'disable'    		=> __( 'Disable', 'frenify-core' ),
			)
		),
		'slide_interval' => array(
			'std' => '9000',
			'type' => 'text',
			'label' => __( 'Slide Speed', 'frenify-core' ),
			'desc' => __( 'In milliseconds, ex: 4000.', 'frenify-core' )
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[kenburns purchase_button="{{purchase_button}}" slide_interval="{{slide_interval}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/kenburns]',
	'popup_title' => __('Insert Shortcode', 'frenify-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'frenify-core' ),
				'desc' => __('Upload an image to display in the tab.', 'frenify-core')
			),
		),
		'shortcode' => '[ken image="{{image}}"][/ken]',
		'clone_button' => __( 'Add More', 'frenify-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Flow Gallery Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['flowgallery'] = array(
	'no_preview' => true,
	'params' => array(
		'purchase_button' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Purchase Button', 'frenify-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'frenify-core' ),
				'disable'    		=> __( 'Disable', 'frenify-core' ),
			)
		),
		'img_title' => array(
			'type' 		=> 	'select',
			'label' 	=> 	__( 'Enable/Disable Image Title', 'frenify-core' ),
			'std' 		=> 	'enable',
			'options' 	=> 	array(
				'enable' 			=> __( 'Enable', 'frenify-core' ),
				'disable'    		=> __( 'Disable', 'frenify-core' ),
			)
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[flowgallery purchase_button="{{purchase_button}}" img_title="{{img_title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/flowgallery]',
	'popup_title' => __('Insert Shortcode', 'frenify-core'),

	'child_shortcode' => array(
		'params' => array(
			'image' => array(
				'type' 		=> 'uploader',
				'label' 	=> __( 'Image', 'frenify-core' ),
				'desc' 		=> __('Upload an image to display in the gallery.', 'frenify-core')
			),
		),
		'shortcode' => '[flowimg image="{{image}}"][/flowimg]',
		'clone_button' => __( 'Add More', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Highlight Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['highlight'] = array(
	'no_preview' => true,
	'params' => array(

		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Highlight Color', 'frenify-core' ),
			'desc' => __( 'Pick a highlight color', 'frenify-core')
		),
		'rounded' => array(
			'type' => 'select',
			'label' => __( 'Highlight With Round Edges', 'frenify-core' ),
			'desc' => __( 'Choose to have rounded edges.', 'frenify-core' ),
			'options' => $reverse_choices
		),		
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Content to Higlight', 'frenify-core' ),
			'desc' => __( 'Add your content to be highlighted', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),			

	),
	'shortcode' => '[highlight color="{{color}}" rounded="{{rounded}}" class="{{class}}" id="{{id}}"]{{content}}[/highlight]',
	'popup_title' => __( 'Highlight Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Image Carousel Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['imagecarousel'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'frenify-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'frenify-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'frenify-core'),
				'auto' => __('Auto', 'frenify-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'frenify-core' ),
			'desc' => __('Select the hover effect type.', 'frenify-core'),
			'options' => array(
				'none' => __('None', 'frenify-core'),
				'zoomin' => __('Zoom In', 'frenify-core'),
				'zoomout' => __('Zoom Out', 'frenify-core'),
				'liftup' => __('Lift Up', 'frenify-core')
			)
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'frenify-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'frenify-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'frenify-core' ),
			'desc' => __('Select the number of max columns to display.', 'frenify-core'),
			'options' => fotofly_fn_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '13',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'frenify-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "frenify-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'frenify-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "frenify-core"),
		),
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'frenify-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'frenify-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'frenify-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel. IMPORTANT: For easy draggability, when mouse scroll is activated, links will be disabled.', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'border' => array(
			'type' => 'select',
			'label' => __( 'Border', 'frenify-core' ),
			'desc' => __( 'Choose to enable a border around the images.', 'frenify-core' ),
			'options' => $choices
		),		
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'frenify-core' ),
			'desc' => __( 'Show image in lightbox.', 'frenify-core' ),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),	
	),
	'shortcode' => '[images picture_size="{{picture_size}}" hover_type="{{hover_type}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" border="{{border}}" lightbox="{{lightbox}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/images]', // as there is no wrapper shortcode
	'popup_title' => __( 'Image Carousel Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Website Link', 'frenify-core' ),
				'desc' => __( 'Add the url to image\'s website. If lightbox option is enabled, you have to add the full image link to show it in the lightbox.', 'frenify-core' )
			),
			'target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'frenify-core' ),
				'desc' => __( '_self = open in same window <br />_blank = open in new window', 'frenify-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'frenify-core' ),
				'desc' => __( 'Upload an image to display.', 'frenify-core' ),
			),
			'alt' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Image Alt Text', 'frenify-core' ),
				'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'frenify-core' ),
			)
		),
		'shortcode' => '[image link="{{link}}" linktarget="{{target}}" image="{{image}}" alt="{{alt}}"]',
		'clone_button' => __( 'Add New Image', 'frenify-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Image Frame Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['imageframe'] = array(
	'no_preview' => true,
	'params' => array(
		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Frame Style Type', 'frenify-core' ),
			'desc' => __( 'Select the frame style type.', 'frenify-core' ),
			'options' => array(
				'none' => __('None', 'frenify-core'),
				'glow' => __('Glow', 'frenify-core'),
				'dropshadow' => __('Drop Shadow', 'frenify-core'),
				'bottomshadow' => __('Bottom Shadow', 'frenify-core')
			)
		),
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'frenify-core' ),
			'desc' => __('Select the hover effect type.', 'frenify-core'),
			'options' => array(
				'none' => __('None', 'frenify-core'),
				'zoomin' => __('Zoom In', 'frenify-core'),
				'zoomout' => __('Zoom Out', 'frenify-core'),
				'liftup' => __('Lift Up', 'frenify-core')
			)
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Border Color', 'frenify-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'bordersize' => array(
			'std' => '0px',
			'type' => 'text',
			'label' => __( 'Border Size', 'frenify-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'borderradius' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __( 'Border Radius', 'frenify-core' ),
			'desc' => __( 'Choose the radius of the image. In pixels (px), ex: 1px, or "round".  Leave blank for theme option selection.', 'frenify-core' ),
		),			
		'stylecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Style Color', 'frenify-core' ),
			'desc' => __( 'For all style types except border. Controls the style color. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'align' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Align', 'frenify-core' ),
			'desc' => __('Choose how to align the image.', 'frenify-core'),
			'options' => array(
				'none' => __('None', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
				'center' => __('Center', 'frenify-core')
			)
		),
		'lightbox' => array(
			'type' => 'select',
			'label' => __( 'Image lightbox', 'frenify-core' ),
			'desc' => __( 'Show image in Lightbox.', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'lightbox_image' => array(
			'type' => 'uploader',
			'label' => __( 'Lightbox Image', 'frenify-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'frenify-core' ),
		),			
		'image' => array(
			'type' => 'uploader',
			'label' => __( 'Image', 'frenify-core' ),
			'desc' => __('Upload an image to display in the frame.', 'frenify-core')
		),	
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Image Alt Text', 'frenify-core' ),
			'desc' => __('The alt attribute provides alternative information if an image cannot be viewed.', 'frenify-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Picture Link URL', 'frenify-core' ),
			'desc' => __( 'Add the URL the picture will link to, ex: http://example.com.', 'frenify-core' ),
		),
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'frenify-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window.', 'frenify-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'frenify-core' ),
			'desc' => __( 'Select the type of animation to use on the shortcode.', 'frenify-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'frenify-core' ),
			'desc' => __( 'Select the incoming direction for the animation.', 'frenify-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'frenify-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1).', 'frenify-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core')
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core')
		),			
	),
	'shortcode' => '[imageframe lightbox="{{lightbox}}" lightbox_image="{{lightbox_image}}" style_type="{{style_type}}" hover_type="{{hover_type}}" bordercolor="{{bordercolor}}" bordersize="{{bordersize}}" borderradius="{{borderradius}}" stylecolor="{{stylecolor}}" align="{{align}}" link="{{link}}" linktarget="{{target}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]&lt;img alt="{{alt}}" src="{{image}}" /&gt;[/imageframe]',
	'popup_title' => __( 'Image Frame Shortcode', 'frenify-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Intro Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['intro'] = array(
	'no_preview' => true,
	'params' => array(
		'main_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Main Text', 'frenify-core' ),
			'desc' => __( 'Insert Main Text', 'frenify-core' )
		),
		'image' => array(
			'type' => 'uploader',
			'label' => __( 'Image', 'frenify-core' ),
			'desc' => __( 'Upload Image', 'frenify-core' )
		),			
		'button_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Title', 'frenify-core' ),
			'desc' => __( 'Insert Button Text', 'frenify-core' ),
		),
		'button_href' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Link', 'frenify-core' ),
			'desc' => __( 'Insert Button Link', 'frenify-core' ),
		),
		'button_hover' => array(
			'std' => 'on',
			'type' => 'text',
			'label' => __( 'Button Hover Animation', 'frenify-core' ),
			'desc' => __( 'Set Hover Animation', 'frenify-core' ),
			'options' => array(
				'on' => __('On', 'frenify-core'),
				'off' => __('Off', 'frenify-core')
			)
		),
		'todown' => array(
			'std' 	=> '',
			'type'	=> 'text',
			'label' => __( 'To Down Button', 'frenify-core' ),
			'desc' 	=> __( 'Insert id of any section. When this button is clicked it scrolls page to that section. It doesn\'s appears if you leave this blank', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[intro main_text="{{main_text}}" image="{{image}}" button_text="{{button_text}}" button_href="{{button_href}}" button_hover="{{button_hover}}" todown="{{todown}}" class="{{class}}" id="{{id}}"][/intro]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Lightbox Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['lightbox'] = array(
	'no_preview' => true,
	'params' => array(

		'full_image' => array(
			'type' => 'uploader',
			'label' => __( 'Full Image', 'frenify-core' ),
			'desc' => __( 'Upload an image that will show up in the lightbox.', 'frenify-core' ),
		),
		'thumb_image' => array(
			'type' => 'uploader',
			'label' => __( 'Thumbnail Image', 'frenify-core' ),
			'desc' => __( 'Clicking this image will show lightbox.', 'frenify-core' ),
		),
		'alt' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Alt Text', 'frenify-core' ),
			'desc' => __( 'The alt attribute provides alternative information if an image cannot be viewed.', 'frenify-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Lightbox Description', 'frenify-core' ),
			'desc' => __( 'This will show up in the lightbox as a description below the image.', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),				
	),
	'shortcode' => '[fotofly_fn_lightbox] &lt;a title="{{title}}" class="{{class}}" id="{{id}}" href="{{full_image}}" data-rel="prettyPhoto"&gt;&lt;img alt="{{alt}}" src="{{thumb_image}}" /&gt;&lt;/a&gt; [/fotofly_fn_lightbox]',
	'popup_title' => __( 'Lightbox Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Menu Anchor Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['menuanchor'] = array(
	'no_preview' => true,
	'params' => array(

		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Menu Anchor', 'frenify-core' ),
			'desc' => __('This name will be the id you will have to use in your one page menu.', 'frenify-core'),

		)
	),
	'shortcode' => '[menu_anchor name="{{name}}"]',
	'popup_title' => __( 'Menu Anchor Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Modal Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['modal'] = array(
	'no_preview' => true,
	'params' => array(

		'button_text' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Button Text', 'frenify-core' ),
		),
		'button_hover' => array(
			'std' => '',
			'type' => 'select',
			'label' => __( 'Button Hover Effect', 'frenify-core' ),
			'options' => array(
				'on' => __('On', 'frenify-core'),
				'off' => __('Off', 'frenify-core')
			)
		),		
		'button_size' => array(
			'std' => array('medium'),
			'type' => 'select',
			'label' => __( 'Button Size', 'frenify-core' ),
			'options' => array(
				'small' => __('Small', 'frenify-core'),
				'medium' => __('Medium', 'frenify-core'),
				'big' => __('Big', 'frenify-core')
			)
		),
		'opening_effect' => array(
			'type' => 'select',
			'label' => __( 'Modal Window Opening Effect', 'frenify-core' ),
			'options' => array(
				'td-zoom-out' => __('Zoom Out', 'frenify-core'),
				'td-zoom-in' => __('Zoom In', 'frenify-core'),
			)
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Heading', 'frenify-core' ),
			
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Contents of Modal', 'frenify-core' ),
			'desc' => __( 'Add your content to be displayed in modal.', 'frenify-core' ),
		),		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),					
	),
	'shortcode' => '[modal button_text="{{button_text}}" button_hover="{{button_hover}}" button_size="{{button_size}}" opening_effect="{{opening_effect}}" title="{{title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/modal]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);



/*-----------------------------------------------------------------------------------*/
/*	One Page Text Link Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['onepagetextlink'] = array(
	'no_preview' => true,
	'params' => array(
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name Of Anchor', 'frenify-core' ),
			'desc' => __('Unique identifier of the anchor to scroll to on click.', 'frenify-core'),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'frenify-core' ),
			'desc' => __( 'Insert text or HTML code here (e.g: HTML for image). This content will be used to trigger the scrolling to the anchor.', 'frenify-core' ),
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[one_page_text_link link="{{link}}" class="{{class}}" id="{{id}}"]{{content}}[/one_page_text_link]',
	'popup_title' => __( 'One Page Text Link Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Person Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['person'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Name', 'frenify-core' ),
			'desc' => __( 'Insert the name of the person.', 'frenify-core' ),
		),
		'occ' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Occupation', 'frenify-core' ),
		),
		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Picture', 'frenify-core' ),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'frenify-core' ),
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'frenify-core' ),
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
			)
		),
	
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'frenify-core' ),
			'desc' => __( 'Insert your email address', 'frenify-core' )
		),
		
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'frenify-core' )
		),
		
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'frenify-core' )
		),
	
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Instagram Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Instagram link', 'frenify-core' )
		),
	
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'frenify-core' )
		),
	
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Linkedin Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Linkedin link', 'frenify-core' )
		),
	
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'frenify-core' )
		),
	
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'frenify-core' )
		),
	
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'frenify-core' )
		),
	
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Skype link', 'frenify-core' )
		),
	
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'frenify-core' )
		),
	
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'frenify-core' )
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[person name="{{name}}" occ="{{occ}}" image="{{image}}" text_align="{{text_align}}" email="{{email}}" facebook="{{facebook}}" twitter="{{twitter}}" instagram="{{instagram}}" google="{{google}}" linkedin="{{linkedin}}" vimeo="{{vimeo}}" youtube="{{youtube}}" flickr="{{flickr}}" skype="{{skype}}" tumblr="{{tumblr}}" dribbble="{{dribbble}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/person]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Coverbox Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['coverbox'] = array(
	'no_preview' => true,
	'params' => array(
		'template' => array(
			'type' => 'select',
			'label' => __( 'Template', 'frenify-core' ),
			'std' => 'alpha',
			'options' => array(
				'alpha' 	=> __('Alpha', 'frenify-core'),
				'beta' 		=> __('Beta', 'frenify-core'),
				'gamma' 	=> __('Gamma', 'frenify-core'),
				'delta' 	=> __('Delta', 'frenify-core'),
				'epsilon' 	=> __('Epsilon', 'frenify-core'),
				'zeta' 		=> __('Zeta', 'frenify-core'),
				'eta' 		=> __('Eta', 'frenify-core'),
				'theta' 	=> __('Theta', 'frenify-core'),
			)
		),
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'frenify-core' ),
			'std' => 'light',
			'options' => array(
				'light' => __('Light', 'frenify-core'),
				'dark' => __('Dark', 'frenify-core'),
			)
		),
		'width' => array(
			'type' => 'select',
			'label' => __( 'Max Width', 'frenify-core' ),
			'std' => 'max600',
			'options' => array(
				'max400' 				=> '400px',
				'max500' 				=> '500px',
				'max600' 				=> '600px',
				'max700' 				=> '700px',
				'max800' 				=> '800px',
				'max900' 				=> '900px',
				'max1000' 				=> '1000px',
			)
		),
		'position' => array(
			'type' => 'select',
			'label' => __( 'Position', 'frenify-core' ),
			'std' => 'center',
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
			)
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'frenify-core' ),
			'std' => 'center',
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
			)
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'frenify-core' ),
		),
		
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[coverbox  template="{{template}}"  skin="{{skin}}" width="{{width}}" position="{{position}}" text_align="{{text_align}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/coverbox]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	TDContent Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['tdcontent'] = array(
	'no_preview' => true,
	'params' => array(
		
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'frenify-core' ),
		),
		'text_align' => array(
			'type' 	=> 'select',
			'label' => __( 'Text Align', 'frenify-core' ),
			'std' 	=> 'center',
			'options' => array(
				'left' 		=> __('Left', 'frenify-core'),
				'right' 	=> __('Right', 'frenify-core'),
				'center' 	=> __('Center', 'frenify-core'),
			)
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[tdcontent text_align="{{text_align}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/tdcontent]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Comparison Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['comparison'] = array(
	'no_preview' => true,
	'params' => array(
		'img1' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Image 1', 'frenify-core' ),
		),
		'img2' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Image 2', 'frenify-core' ),
		),
		'image_size' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Image Size', 'frenify-core' ),
			'options' 	=> array(
				 '1170' 	=> '1170x650',
				 'full' 	=> 'Original Image'
			)
		),
		'orientation' => array(
			'type' => 'select',
			'label' => __( 'Orientation', 'frenify-core' ),
			'options' => array(
				'horizontal' => __('Horizontal', 'frenify-core'),
				'vertical' => __('Vertical', 'frenify-core')
			)
		),
		'before' => array(
			'std' => 'Before',
			'type' => 'text',
			'label' => __( 'Before Text', 'frenify-core' ),
		),
		'after' => array(
			'std' => 'After',
			'type' => 'text',
			'label' => __( 'After Text', 'frenify-core' ),
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[comparison img1="{{img1}}" img2="{{img2}}" image_size="{{image_size}}" orientation="{{orientation}}" before="{{before}}" after="{{after}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/comparison]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Hotspot Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['hotspot'] = array(
	'params' => array(
		'image' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Hotspot Image', 'frenify-core' ),
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),	
	),
	'shortcode' => '[hotspots  image="{{image}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/hotspots]', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'top' => array(
				'std' 		=> '0%',
				'type' 		=> 'text',
				'label' 	=> __( 'Top Spacing', 'frenify-core' ),
				'desc' 		=> __( 'Insert space in percent. Make sure it isn\'t higher than 100%', 'frenify-core' )
			),
			'left' => array(
				'std' 		=> '0%',
				'type' 		=> 'text',
				'label' 	=> __( 'Left Spacing', 'frenify-core' ),
				'desc' 		=> __( 'Insert space in percent. Make sure it isn\'t higher than 100%', 'frenify-core' )
			),
			'skin' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Skin', 'frenify-core' ),
				'options' 	=> array(
					'light' 	=> 'Light',
					'dark' 		=> 'Dark'
				)
			),
			'rounded' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Rounded', 'frenify-core' ),
				'options' 	=> array(
					'a' 		=> 'A',
					'b' 		=> 'B',
					'off' 		=> 'Off'
				)
			),
			'tooltip' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Tooltip Visibilty', 'frenify-core' ),
				'options' 	=> array(
					'open' 		=> 'Open',
					'hover' 	=> 'on Hover',
					'click' 	=> 'on Click'
				)
			),
			'position' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Tooltip Position', 'frenify-core' ),
				'options' 	=> array(
					'n'			=> "North",
					's'	 		=> "South",
					'e'	 		=> "East",
					'w'	 		=> "West",
					'nw'	 	=> "North-West",
					'ne'	 	=> "North-East",
					'sw'	 	=> "South-West",
					'se'	 	=> "South-East",
				)
			),
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'frenify-core' ),
			)
		),
		'shortcode' => '[hotspot top="{{top}}" left="{{left}}" skin="{{skin}}" rounded="{{rounded}}" tooltip="{{tooltip}}" position="{{position}}" title="{{title}}"][/hotspot]',
		'clone_button' => __( 'Add New', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Work Step Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['workstep'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Step', 'frenify-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'frenify-core' ),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Content', 'frenify-core' ),
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '40px',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[workstep step="{{step}}" title="{{title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/workstep]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);


/*-----------------------------------------------------------------------------------*/
/*	Service Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['service'] = array(
	'no_preview' => true,
	'params' => array(

		'image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Image', 'frenify-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'frenify-core' ),
			'desc' => __( 'Insert the title of the service.', 'frenify-core' ),
		),
		'subtitle' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Subtitle', 'frenify-core' ),
		),
		'content' => array(
			'std' => __('Your Content Goes Here', 'frenify-core'),
			'type' => 'textarea',
			'label' => __( 'Text or HTML code', 'frenify-core' ),
		),
		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '40px',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[service image="{{image}}" title="{{title}}" subtitle="{{subtitle}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/service]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Servicepack Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['servicepack'] = array(
	'params' => array(
		'image' => array(
			'std' 		=> '',
			'type' 		=> 'uploader',
			'label' 	=> __( 'Image', 'frenify-core' ),
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'frenify-core' ),
		),
		'duration' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Duration', 'frenify-core' ),
		),
		'totalcost' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Total Cost', 'frenify-core' ),
		),
		'booking' => array(
			'std' 		=> 'on',
			'type' 		=> 'select',
			'label' 	=> __( 'Booking Button', 'frenify-core' ),
			'options' 	=> array(
				'on' 		=> 'Enable',
				'off' 		=> 'Disable'
			)
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),	
	),
	'shortcode' => '[servicepack  image="{{image}}" title="{{title}}" duration="{{duration}}" totalcost="{{totalcost}}" booking="{{booking}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/servicepack]', // as there is no wrapper shortcode
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Title', 'frenify-core' ),
			),
			'price' => array(
				'std' => '$27.00',
				'type' => 'text',
				'label' => __( 'Price', 'frenify-core' ),
			)
		),
		'shortcode' => '[sp title="{{title}}" price="{{price}}"][/sp]',
		'clone_button' => __( 'Add New', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Popover Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['popover'] = array(
	'params' => array(
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Popover Heading', 'frenify-core' ),
			'desc' => __( 'Heading text of the popover.', 'frenify-core' ),
		),
		'titlebgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Heading Background Color', 'frenify-core' ),
			'desc' => __( 'Controls the background color of the popover heading. Leave blank for theme option selection.', 'frenify-core')
		),			
		'popovercontent' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Contents Inside Popover', 'frenify-core' ),
			'desc' => __( 'Text to be displayed inside the popover.', 'frenify-core' ),
		),
		'contentbgcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Content Background Color', 'frenify-core' ),
			'desc' => __( 'Controls the background color of the popover content area. Leave blank for theme option selection.', 'frenify-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Border Color', 'frenify-core' ),
			'desc' => __( 'Controls the border color of the of the popover box. Leave blank for theme option selection.', 'frenify-core')
		),
		'textcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Popover Text Color', 'frenify-core' ),
			'desc' => __( 'Controls all the text color inside the popover box. Leave blank for theme option selection.', 'frenify-core')
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Popover Trigger Method', 'frenify-core' ),
			'desc' => __( 'Choose mouse action to trigger popover.', 'frenify-core' ),
			'options' => array(
				'click' => __('Click', 'frenify-core'),
				'hover' => __('Hover', 'frenify-core'),
			)
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Popover Position', 'frenify-core' ),
			'desc' => __( 'Choose the display position of the popover. Choose default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'top' => __('Top', 'frenify-core'),
				'bottom' => __('Bottom', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'Right' => __('Right', 'frenify-core'),
			)
		),
		'content' => array(
			'std' => __('Text', 'frenify-core'),
			'type' => 'text',
			'label' => __( 'Triggering Content', 'frenify-core' ),
			'desc' => __( 'Content that will trigger the popover.', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[popover title="{{title}}" title_bg_color="{{titlebgcolor}}" content="{{popovercontent}}" content_bg_color="{{contentbgcolor}}" bordercolor="{{bordercolor}}" textcolor="{{textcolor}}" trigger="{{trigger}}" placement="{{placement}}" class="{{class}}" id="{{id}}"]{{content}}[/popover]', // as there is no wrapper shortcode
	'popup_title' => __( 'Popover Shortcode', 'frenify-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Pricing Table Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['pricingtable'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'frenify-core' ),
			'desc' => __( 'Select the type of pricing table', 'frenify-core' ),
			'options' => array(
				'1' => __('Style 1', 'frenify-core'),
				'2' => __('Style 2', 'frenify-core'),
			)
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'frenify-core' ),
			'desc' => __('Controls the background color. Leave blank for theme option selection.', 'frenify-core')
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'frenify-core' ),
			'desc' => __('Controls the border color. Leave blank for theme option selection.', 'frenify-core')
		),
		'dividercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Divider Color', 'frenify-core' ),
			'desc' => __('Controls the divider color. Leave blank for theme option selection.', 'frenify-core')
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'frenify-core' ),
			'desc' => __('Select how many columns to display', 'frenify-core'),
			'options' => array(
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '1 Column',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '2 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '3 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '4 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '5 Columns',
				'&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;[pricing_column title=&quot;Standard&quot; standout=&quot;no&quot;][pricing_price currency=&quot;$&quot; currency_position=&quot;left&quot; price=&quot;15.55&quot; time=&quot;monthly&quot;][/pricing_price][pricing_row]Feature 1[/pricing_row][pricing_footer]Signup[/pricing_footer][/pricing_column]&lt;br /&gt;' => '6 Columns'
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[pricing_table type="{{type}}" backgroundcolor="{{backgroundcolor}}" bordercolor="{{bordercolor}}" dividercolor="{{dividercolor}}" class="{{class}}" id="{{id}}"]{{columns}}[/pricing_table]',
	'popup_title' => __( 'Pricing Table Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Progress Bar Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['progressbar'] = array(
	'params' => array(

		'value' => array(
			'type' => 'select',
			'label' => __( 'Filled Area Percentage', 'frenify-core' ),
			'desc' => __( 'From 1% to 100%', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_range( 100, false )
		),
		'content' => array(
			'std' => __('Text', 'frenify-core'),
			'type' => 'text',
			'label' => __( 'Progess Bar Text', 'frenify-core' ),
			'desc' => __( 'Text will show up on progess bar', 'frenify-core' ),
		),
		'filledcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Filled Color', 'frenify-core' ),
			'desc' => __( 'Controls the color of the filled in area. Leave blank for theme option selection.', 'frenify-core' )
		),
		'striped' => array(
			'type' => 'select',
			'label' => __( 'Striped Filling', 'frenify-core' ),
			'desc' => __( 'Choose to get the filled area striped.', 'frenify-core' ),
			'options' => array(
							"on" => "On",
							"off" => "Off",
						)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'frenify-core' ),
			'desc' => __( 'Set size of the shortcode.', 'frenify-core' ),
			'options' => array(
							"small" => "Small",
							"medium" => "Medium",
							"big" => "Big",
						)
		),
		'rounded' => array(
			'type' => 'select',
			'label' => __( 'Rounded Corner', 'frenify-core' ),
			'desc' => __( 'Set rounded corner', 'frenify-core' ),
			'options' => array(
							"off" => "On",
							"a" => "Small",
							"b" => "Medium",
							"c" => "Large",
						)
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),			
		
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[progress value="{{value}}" filledcolor="{{filledcolor}}" striped="{{striped}}" size="{{size}}" rounded="{{rounded}}" class="{{class}}" id="{{id}}"]{{content}}[/progress]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Recent Posts Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['recentposts'] = array(
	'no_preview' => true,
	'params' => array(

			
		'post_number' => array(
			'std' => 3,
			'type' => 'text',
			'label' => __( 'Number of Posts', 'frenify-core' ),
			'desc' => __('Select the number of posts to display', 'frenify-core')
		),
		'bg' => array(
			'type' => 'uploader',
			'label' => __( 'Background Image', 'frenify-core' ),
			'desc' => __('Upload Image', 'frenify-core')
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[recent_posts post_number="{{post_number}}" bg="{{bg}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"][/recent_posts]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Gallery Block Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['galleryblock'] = array(
	'no_preview' => true,
	'params' => array(
		'layout' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Layout', 'frenify-core' ),
			'desc' 		=> __('Choose the layout for the shortcode', 'frenify-core'),
			'options' 	=> array(
				'slider' 			=> __('Slider', 'frenify-core'),
				'halfimg' 			=> __('Half Img', 'frenify-core'),
				'split' 			=> __('Split', 'frenify-core'),
				'fullscreen' 		=> __('Fullscreen', 'frenify-core'),
				'fullwidth' 		=> __('Fullwidth', 'frenify-core'),
				'creative1' 		=> __('Creative A', 'frenify-core'),
				//'creative2' 		=> __('Creative B', 'frenify-core'),
			)
		),	
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'frenify-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'portfolio_category' )
		),
		'exclude_cats' => array(
			'type' => 'multiple_select',
			'label' => __( 'Exclude Categories', 'frenify-core' ),
			'desc' => __( 'Select a category to exclude', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'portfolio_category' )
		),		
		'post_count' => array(
			'std' => 4,
			'type' => 'text',
			'label' => __( 'Number of Posts', 'frenify-core' ),
			'desc' => __('Select the number of posts to display', 'frenify-core')
		),
		'order' => array(
			'type' 		=> 'select',
			'label' 	=> __( 'Order Posts', 'frenify-core' ),
			'desc' 		=> __('Choose ordering type for posts', 'frenify-core'),
			'options' 	=> array(
				'' 				=> __('Newness', 'frenify-core'),
				'rand' 			=> __('Random', 'frenify-core'),
			)
		),	
		'offset' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Post Offset', 'frenify-core' ),
			'desc' => __('The number of posts to skip. ex: 1.', 'frenify-core')
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),				
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[gallery_block layout="{{layout}}" cat_slug="{{cat_slug}}" exclude_cats="{{exclude_cats}}" post_count="{{post_count}}" order="{{order}}" offset="{{offset}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}"  class="{{class}}" id="{{id}}"][/gallery_block]',
	'popup_title' => __( 'Gallery Block Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Section Separator Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['sectionseparator'] = array(
	'no_preview' => true,
	'params' => array(
		'divider_candy' => array(
			'type' => 'select',
			'label' => __( 'Position of the Divider Candy', 'frenify-core' ),
			'desc' => __( 'Select the position of the triangle candy.', 'frenify-core' ),
			'options' => array(
				'top' => __('Top', 'frenify-core'),
				'bottom' => __('Bottom', 'frenify-core'),
				'bottom,top' => __('Top and Bottom', 'frenify-core'),
			)
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'frenify-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect', 'frenify-core' ),
			'options' => $icons
		),
		'iconcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Icon Color', 'frenify-core' ),
			'desc' => __( 'Leave blank for theme option selection.', 'frenify-core' )
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'frenify-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'frenify-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color of Divider Candy', 'frenify-core' ),
			'desc' => __( 'Controls the background color of the triangle. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[section_separator divider_candy="{{divider_candy}}" icon="{{icon}}" icon_color="{{iconcolor}}" bordersize="{{border}}" bordercolor="{{bordercolor}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Section Separator Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Separator Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['separator'] = array(
	'no_preview' => true,
	'params' => array(

		'style_type' => array(
			'type' => 'select',
			'label' => __( 'Style', 'frenify-core' ),
			'desc' => __( 'Choose the separator line style', 'frenify-core' ),
			'options' => array(
				'none' => __('No Style', 'frenify-core'),
				'single' => __('Single Border Solid', 'frenify-core'),
				'double' => __('Double Border Solid', 'frenify-core'),
				'single|dashed' => __('Single Border Dashed', 'frenify-core'),
				'double|dashed' => __('Double Border Dashed', 'frenify-core'),
				'single|dotted' => __('Single Border Dotted', 'frenify-core'),
				'double|dotted' => __('Double Border Dotted', 'frenify-core'),
				'shadow' => __('Shadow', 'frenify-core')
			)
		),	
		'topmargin' => array(
			'std' => 40,
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Spacing above the separator. In pixels. Use a number without px.', 'frenify-core' ),
		),
		'bottommargin' => array(
			'std' => 40,
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Spacing below the separator. In pixels. Use a number without px.', 'frenify-core' ),
		),
		'sepcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Separator Color', 'frenify-core' ),
			'desc' => __( 'Controls the separator color. Leave blank for theme option selection.', 'frenify-core' )
		),
		'border_size' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Border Size', 'frenify-core' ),
			'desc' => __( 'In pixels (px), ex: 1px. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'icon' => array(
			'type' => 'iconpicker',
			'label' => __( 'Select Icon', 'frenify-core' ),
			'desc' => __( 'Click an icon to select, click again to deselect.', 'frenify-core' ),
			'options' => $icons
		),
		'icon_circle' => array(
			'type' => 'select',
			'label' => __( 'Circled Icon', 'frenify-core' ),
			'desc' => __( 'Choose to have a circle in separator color around the icon.', 'frenify-core' ),
			'options' => $choices_with_default
		),	
		'icon_circle_color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Circle Color', 'frenify-core' ),
			'desc' => __( 'Controls the background color of the circle around the icon.', 'frenify-core' )
		),
		'width' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Separator Width', 'frenify-core' ),
			'desc' => __( 'In pixels (px or %), ex: 1px, ex: 50%. Leave blank for full width.', 'frenify-core' ),
		),
		'alignment' => array(
			'std' => 'center',
			'type' => 'select',
			'label' => __( 'Alignment', 'frenify-core' ),
			'desc' => __( 'Select the separator alignment; only works when a width is specified.', 'frenify-core' ),
			'options' => array(
				'center' => __('Center', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
			)			
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[separator style_type="{{style_type}}" top_margin="{{topmargin}}" bottom_margin="{{bottommargin}}"  sep_color="{{sepcolor}}" border_size="{{border_size}}" icon="{{icon}}" icon_circle="{{icon_circle}}" icon_circle_color="{{icon_circle_color}}" width="{{width}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Separator Shortcode', 'frenify-core' )
);



/*-----------------------------------------------------------------------------------*/
/*	Servicetabs Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['servicetabs'] = array(
	'no_preview' => true,
	'params' => array(
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[servicetabs margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/servicetabs]',
	'popup_title' => __('Insert Shortcode', 'frenify-core'),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Tab Title', 'frenify-core' ),
				'desc' => __( 'Title of the tab', 'frenify-core' ),
			),
			'image' => array(
				'type' => 'uploader',
				'label' => __( 'Image', 'frenify-core' ),
				'desc' => __('Upload an image to display in the tab.', 'frenify-core')
			),
			'link' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Link', 'frenify-core' ),
				'desc' => __( 'Insert the link of the tab', 'frenify-core' ),
			),			
			'content' => array(
				'std' => __('Tab Content', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Tab Content', 'frenify-core' ),
				'desc' => __( 'Add the tabs content', 'frenify-core' )
			)
		),
		'shortcode' => '[servicetab title="{{title}}" image="{{image}}" link="{{link}}"]{{content}}[/servicetab]',
		'clone_button' => __( 'Add Tab', 'frenify-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Sharing Box Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['sharingbox'] = array(
	'no_preview' => true,
	'params' => array(
		'tagline' => array(
			'std' => __('Share This Story, Choose Your Platform!', 'frenify-core'),
			'type' => 'text',
			'label' => __( 'Tagline', 'frenify-core' ),
			'desc' => __('The title tagline that will display', 'frenify-core')
		),
		'taglinecolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Tagline Color', 'frenify-core' ),
			'desc' => __( 'Controls the text color. Leave blank for theme option selection.', 'frenify-core')
		),
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'label' => __( 'Background Color', 'frenify-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'frenify-core')
		),
		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'frenify-core' ),
			'desc' => __('The post title that will be shared', 'frenify-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'frenify-core' ),
			'desc' => __('The link that will be shared', 'frenify-core')
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Description', 'frenify-core' ),
			'desc' => __('The description that will be shared', 'frenify-core')
		),
		'link' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link to Share', 'frenify-core' ),
			'desc' => ''
		),
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'frenify-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'frenify-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'frenify-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'frenify-core' ),
		),	
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'frenify-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'frenify-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'frenify-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'top' => __('Top', 'frenify-core'),
				'bottom' => __('Bottom', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
			)
		),		
		'pinterest_image' => array(
			'std' => '',
			'type' => 'uploader',
			'label' => __( 'Choose Image to Share on Pinterest', 'frenify-core' ),
			'desc' => ''
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[sharing tagline="{{tagline}}" tagline_color="{{taglinecolor}}" title="{{title}}" link="{{link}}" description="{{description}}" pinterest_image="{{pinterest_image}}" icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" box_colors="{{boxcolor}}" icon_colors="{{iconcolor}}" tooltip_placement="{{icontooltip}}" backgroundcolor="{{backgroundcolor}}" class="{{class}}" id="{{id}}"][/sharing]',
	'popup_title' => __( 'Sharing Box Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Slider Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['slider'] = array(
	'params' => array(
		'hover_type' => array(
			'std' => 'none',
			'type' => 'select',
			'label' => __( 'Hover Type', 'frenify-core' ),
			'desc' => __('Select the hover effect type.', 'frenify-core'),
			'options' => array(
				'none' => __('None', 'frenify-core'),
				'zoomin' => __('Zoom In', 'frenify-core'),
				'zoomout' => __('Zoom Out', 'frenify-core'),
				'liftup' => __('Lift Up', 'frenify-core')
			)
		),
		'size' => array(
			'std' => '100%',
			'type' => 'size',
			'label' => __( 'Image Size (Width/Height)', 'frenify-core' ),
			'desc' => __( 'Width and Height in percentage (%) or pixels (px)', 'frenify-core' ),
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[slider hover_type="{{hover_type}}" width="{{size_width}}" height="{{size_height}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/slider]', // as there is no wrapper shortcode
	'popup_title' => __( 'Slider Shortcode', 'frenify-core' ),
	'no_preview' => true,

	// child shortcode is clonable & sortable
	'child_shortcode' => array(
		'params' => array(
			'slider_type' => array(
				'type' => 'select',
				'label' => __( 'Slide Type', 'frenify-core' ),
				'desc' => __('Choose a video or image slide', 'frenify-core'),
				'options' => array(
					'image' => __('Image', 'frenify-core'),
					'video' => __('Video', 'frenify-core')
				)
			),
			'video_content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Video Shortcode or Video Embed Code', 'frenify-core' ),
				'desc' => __('Click the Youtube or Vimeo Shortcode button below then enter your unique video ID, or copy and paste your video embed code.<a href=\'[youtube id="Enter video ID (eg. Wq4Y7ztznKc)" width="600" height="350"]\' class="frenify-shortcodes-button frenify-add-video-shortcode">Insert Youtube Shortcode</a><a href=\'[vimeo id="Enter video ID (eg. 10145153)" width="600" height="350"]\' class="frenify-shortcodes-button frenify-add-video-shortcode">Insert Vimeo Shortcode</a>', 'frenify-core')
			),
			'image_content' => array(
				'std' => '',
				'type' => 'uploader',
				'label' => __( 'Slide Image', 'frenify-core' ),
				'desc' => __('Upload an image to display in the slide', 'frenify-core')
			),
			'image_url' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Full Image Link or External Link', 'frenify-core' ),
				'desc' => __('Add the url of where the image will link to. If lightbox option is enabled,and you don\'t add the full image link, lightbox will open slide image', 'frenify-core')
			),
			'image_target' => array(
				'type' => 'select',
				'label' => __( 'Link Target', 'frenify-core' ),
				'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'frenify-core' ),
				'options' => array(
					'_self' => '_self',
					'_blank' => '_blank'
				)
			),
			'image_lightbox' => array(
				'type' => 'select',
				'label' => __( 'Lighbox', 'frenify-core' ),
				'desc' => __( 'Show image in Lightbox', 'frenify-core' ),
				'options' => $choices
			),
		),
		'shortcode' => '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]',
		'clone_button' => __( 'Add New Slide', 'frenify-core')
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Social Links Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['sociallinks'] = array(
	'no_preview' => true,
	'params' => array(
		'iconboxed' => array(
			'type' => 'select',
			'label' => __( 'Boxed Social Icons', 'frenify-core' ),
			'desc' => __( 'Choose to get a boxed icons. Choose default for theme option selection.', 'frenify-core' ),
			'options' => $reverse_choices_with_default
		),
		'iconboxedradius' => array(
			'std' => '4px',
			'type' => 'text',
			'label' => __( 'Social Icon Box Radius', 'frenify-core' ),
			'desc' => __( 'Choose the radius of the boxed icons. In pixels (px), ex: 1px, or "round". Leave blank for theme option selection.', 'frenify-core' ),
		),
		'iconcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Colors', 'frenify-core' ),
			'desc' => __( 'Specify the color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'boxcolor' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Social Icon Custom Box Colors', 'frenify-core' ),
			'desc' => __( 'Specify the box color of social icons. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'icontooltip' => array(
			'type' => 'select',
			'label' => __( 'Social Icon Tooltip Position', 'frenify-core' ),
			'desc' => __( 'Choose the display position for tooltips. Choose default for theme option selection.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'top' => __('Top', 'frenify-core'),
				'bottom' => __('Bottom', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'Right' => __('Right', 'frenify-core'),
			)
		),			
		'facebook' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Facebook Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Facebook link', 'frenify-core' ),
		),
		'twitter' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Twitter Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Twitter link', 'frenify-core' ),
		),
		'instagram' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Instagram Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Instagram link', 'frenify-core' ),
		),
		'dribbble' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dribbble Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Dribbble link', 'frenify-core' ),
		),
		'google' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Google+ Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Google+ link', 'frenify-core' ),
		),
		'linkedin' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'LinkedIn Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom LinkedIn link', 'frenify-core' ),
		),
		'blogger' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Blogger Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Blogger link', 'frenify-core' ),
		),
		'tumblr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tumblr Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Tumblr link', 'frenify-core' ),
		),
		'reddit' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Reddit Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Reddit link', 'frenify-core' ),
		),
		'yahoo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Yahoo Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Yahoo link', 'frenify-core' ),
		),
		'deviantart' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Deviantart Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Deviantart link', 'frenify-core' ),
		),
		'vimeo' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Vimeo Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Vimeo link', 'frenify-core' ),
		),
		'youtube' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Youtube Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Youtube link', 'frenify-core' ),
		),
		'pinterest' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Pinterst Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Pinterest link', 'frenify-core' ),
		),
		'rss' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'RSS Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom RSS link', 'frenify-core' ),
		),		
		'digg' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Digg Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Digg link', 'frenify-core' ),
		),
		'flickr' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Flickr Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Flickr link', 'frenify-core' ),
		),
		'forrst' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Forrst Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Forrst link', 'frenify-core' ),
		),
		'myspace' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Myspace Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Myspace link', 'frenify-core' ),
		),
		'skype' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Skype Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom Skype link', 'frenify-core' ),
		),
		'paypal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'PayPal Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom paypal link', 'frenify-core' ),
		),
		'dropbox' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Dropbox Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom dropbox link', 'frenify-core' ),
		),
		'soundcloud' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom soundcloud link', 'frenify-core' ),
		),
		'vk' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'VK Link', 'frenify-core' ),
			'desc' => __( 'Insert your custom vk link', 'frenify-core' ),
		),
		'email' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Email Address', 'frenify-core' ),
			'desc' => __( 'Insert an email address to display the email icon', 'frenify-core' ),
		),
		'show_custom' => array(
			'type' => 'select',
			'label' => __( 'Show Custom Social Icon', 'frenify-core' ),
			'desc' => __( 'Show the custom social icon specified in Theme Options', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'alignment' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Alignment', 'frenify-core' ),
			'desc' => __( 'Select the icon\'s alignment.', 'frenify-core' ),
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
			)
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[social_links icons_boxed="{{iconboxed}}" icons_boxed_radius="{{iconboxedradius}}" icon_colors="{{iconcolor}}" box_colors="{{boxcolor}}" tooltip_placement="{{icontooltip}}" rss="{{rss}}" facebook="{{facebook}}" twitter="{{twitter}}" instagram="{{instagram}}" dribbble="{{dribbble}}" google="{{google}}" linkedin="{{linkedin}}" blogger="{{blogger}}" tumblr="{{tumblr}}" reddit="{{reddit}}" yahoo="{{yahoo}}" deviantart="{{deviantart}}" vimeo="{{vimeo}}" youtube="{{youtube}}" pinterest="{{pinterest}}" digg="{{digg}}" flickr="{{flickr}}" forrst="{{forrst}}" myspace="{{myspace}}" skype="{{skype}}" paypal="{{paypal}}" dropbox="{{dropbox}}" soundcloud="{{soundcloud}}" vk="{{vk}}" email="{{email}}" show_custom="{{show_custom}}" alignment="{{alignment}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Social Links Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	SoundCloud Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['soundcloud'] = array(
	'no_preview' => true,
	'params' => array(

		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'SoundCloud Url', 'frenify-core' ),
			'desc' => __('The SoundCloud url, ex: http://api.soundcloud.com/tracks/110813479', 'frenify-core')
		),
		'layout' => array(
			'type' => 'select',
			'label' => __( 'Layout', 'frenify-core' ),
			'desc' => __('Choose the layout of the soundcloud embed.', 'frenify-core'),
			'options' => array( 'classic' => 'Classic', 'visual' => 'Visual' )
		),			
		'comments' => array(
			'type' => 'select',
			'label' => __( 'Show Comments', 'frenify-core' ),
			'desc' => __('Choose to display comments', 'frenify-core'),
			'options' => $choices
		),
		'show_related' => array(
			'type' => 'select',
			'label' => __( 'Show Related', 'frenify-core' ),
			'desc' => __('Choose to display related items.', 'frenify-core'),
			'options' => $choices
		),	
		'show_user' => array(
			'type' => 'select',
			'label' => __( 'Show User', 'frenify-core' ),
			'desc' => __('Choose to display the user who posted the item.', 'frenify-core'),
			'options' => $choices
		),		
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'frenify-core' ),
			'desc' => __('Choose to autoplay the track', 'frenify-core'),
			'options' => $reverse_choices
		),
		'color' => array(
			'type' => 'colorpicker',
			'std' => '#ff7700',
			'label' => __( 'Color', 'frenify-core' ),
			'desc' => __('Select the color of the shortcode', 'frenify-core')
		),
		'width' => array(
			'std' => '100%',
			'type' => 'text',
			'label' => __( 'Width', 'frenify-core' ),
			'desc' => __('In pixels (px) or percentage (%)', 'frenify-core')
		),
		'height' => array(
			'std' => '150px',
			'type' => 'text',
			'label' => __( 'Height', 'frenify-core' ),
			'desc' => __('In pixels (px)', 'frenify-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[soundcloud url="{{url}}" layout="{{layout}}" comments="{{comments}}" show_related="{{show_related}}" show_user="{{show_user}}" auto_play="{{autoplay}}" color="{{color}}" width="{{width}}" height="{{height}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Sharing Box Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Table Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['table'] = array(
	'no_preview' => true,
	'params' => array(

		'type' => array(
			'type' => 'select',
			'label' => __( 'Type', 'frenify-core' ),
			'desc' => __( 'Select the table style', 'frenify-core' ),
			'options' => array(
				'1' => __('Style 1', 'frenify-core'),
				'2' => __('Style 2', 'frenify-core'),
			)
		),
		'columns' => array(
			'type' => 'select',
			'label' => __( 'Number of Columns', 'frenify-core' ),
			'desc' => __('Select how many columns to display', 'frenify-core'),
			'options' => array(
				'1' => '1 Column',
				'2' => '2 Columns',
				'3' => '3 Columns',
				'4' => '4 Columns',
				'5' => '5 Columns',
				'6' => '6 Columns'				
			)
		)
	),
	'shortcode' => '',
	'popup_title' => __( 'Table Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Tabs Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['tabs'] = array(
	'no_preview' => true,
	'params' => array(
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'frenify-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'frenify-core' ),
			'options' => array(
				'light' => __('Light', 'frenify-core'),
				'dark' => __('Dark', 'frenify-core')
			)
		),	
		'position' => array(
			'type' => 'select',
			'label' => __( 'Horizontal Position', 'frenify-core' ),
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
				'center' => __('Center', 'frenify-core')
			)
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[fotofly_fn_tabs skin="{{skin}}" position="{{position}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}"  class="{{class}}" id="{{id}}"]{{child_shortcode}}[/fotofly_fn_tabs]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Tab Title', 'frenify-core' ),
				'desc' => __( 'Title of the tab', 'frenify-core' ),
			),		
			'content' => array(
				'std' => __('Tab Content', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Tab Content', 'frenify-core' ),
				'desc' => __( 'Add the tabs content', 'frenify-core' )
			)
		),
		'shortcode' => '[fotofly_fn_tab title="{{title}}"]{{content}}[/fotofly_fn_tab]',
		'clone_button' => __( 'Add Tab', 'frenify-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Accordion Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['accordion'] = array(
	'no_preview' => true,
	'params' => array(
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'frenify-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'frenify-core' ),
			'options' => array(
				'light' => __('Light', 'frenify-core'),
				'dark' => __('Dark', 'frenify-core')
			)
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[accordion skin="{{skin}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/accordion]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Accordion Title', 'frenify-core' ),
				'desc' => __( 'Title of the accordion', 'frenify-core' ),
			),
			'open' => array(
				'type' 		=> 'select',
				'label' 	=> __( 'Open', 'frenify-core' ),
				'desc' 		=> __( 'Choose to have the accordion open', 'frenify-core' ),
				'std' 		=> 'no',
				'options' 	=> array(
					'no' 		=> __('No', 'frenify-core'),
					'yes' 		=> __('Yes', 'frenify-core')
				)
			),			
			'content' => array(
				'std' => __('Accordion Content', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Accordion Content', 'frenify-core' ),
				'desc' => __( 'Add the accordion content', 'frenify-core' )
			)
		),
		'shortcode' => '[acc title="{{title}}" open="{{open}}"]{{content}}[/acc]',
		'clone_button' => __( 'Add New', 'frenify-core' )
	)
);


/*-----------------------------------------------------------------------------------*/
/*	Toggle Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['toggle'] = array(
	'no_preview' => true,
	'params' => array(
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'frenify-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'frenify-core' ),
			'options' => array(
				'light' => __('Light', 'frenify-core'),
				'dark' => __('Dark', 'frenify-core')
			)
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[toggle skin="{{skin}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/toggle]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),

	'child_shortcode' => array(
		'params' => array(
			'title' => array(
				'std' => __('Title', 'frenify-core'),
				'type' => 'text',
				'label' => __( 'Toggle Title', 'frenify-core' ),
				'desc' => __( 'Title of the toggle', 'frenify-core' ),
			),		
			'content' => array(
				'std' => __('Toggle Content', 'frenify-core'),
				'type' => 'textarea',
				'label' => __( 'Toggle Content', 'frenify-core' ),
				'desc' => __( 'Add the toggle content', 'frenify-core' )
			)
		),
		'shortcode' => '[tog title="{{title}}"]{{content}}[/tog]',
		'clone_button' => __( 'Add New', 'frenify-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Expandable Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['expandable'] = array(
	'no_preview' => true,
	'params' => array(
		'title' => array(
			'std' 	=> '',
			'type' 	=> 'text',
			'label' => __( 'Title', 'frenify-core' ),
			'desc' 	=> __( 'Insert the title of the expandable box', 'frenify-core' ),
		),	
		'content' => array(
			'std' 	=> '',
			'type' 	=> 'textarea',
			'label' => __( 'Content', 'frenify-core' ),
			'desc' 	=> __( 'Insert the content of the expandable box', 'frenify-core' ),
		),	
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[toggle title="{{title}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/toggle]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),

);


/*-----------------------------------------------------------------------------------*/
/*	Countdown Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['countdown'] = array(
	'no_preview' => true,
	'params' => array(
		'time' => array(
			'std' 	=> '09:50',
			'type' 	=> 'text',
			'label' => __( 'Time', 'frenify-core' ),
			'desc' 	=> __( 'IInsert the end time. Example: 09:50', 'frenify-core' ),
		),
		'date' => array(
			'std' 	=> 'April 1 2017',
			'type' 	=> 'text',
			'label' => __( 'Date', 'frenify-core' ),
			'desc' 	=> __( 'Insert the end date. Example: April 1 2017', 'frenify-core' ),
		),
		'skin' => array(
			'type' => 'select',
			'label' => __( 'Skin', 'frenify-core' ),
			'desc' => __( 'Choose a skin for the shortcode.', 'frenify-core' ),
			'options' => array(
				'light' => __('Light', 'frenify-core'),
				'dark' => __('Dark', 'frenify-core')
			)
		),	
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'frenify-core' ),
			'desc' => __( 'Set size of the shortcode.', 'frenify-core' ),
			'options' => array(
				'big' 	 => __('Big', 'frenify-core'),
				'medium' => __('Medium', 'frenify-core'),
				'small'  => __('Small', 'frenify-core')
			)
		),		
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),

	'shortcode' => '[countdown time="{{time}}" date="{{date}}"  skin="{{skin}}"  size="{{size}}"  margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Insert Shortcode', 'frenify-core' ),

);

/*-----------------------------------------------------------------------------------*/
/*	Tagline Box Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['taglinebox'] = array(
	'no_preview' => true,
	'params' => array(
		'backgroundcolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Background Color', 'frenify-core' ),
			'desc' => __( 'Controls the background color. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'shadow' => array(
			'type' => 'select',
			'label' => __( 'Shadow', 'frenify-core' ),
			'desc' => __( 'Show the shadow below the box', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'shadowopacity' => array(
			'type' => 'select',
			'label' => __( 'Shadow Opacity', 'frenify-core' ),
			'desc' => __( 'Choose the opacity of the shadow', 'frenify-core' ),
			'options' => $dec_numbers
		),
		'border' => array(
			'std' => '1px',
			'type' => 'text',
			'label' => __( 'Border Size', 'frenify-core' ),
			'desc' => __( 'In pixels (px), ex: 1px', 'frenify-core' ),
		),
		'bordercolor' => array(
			'type' => 'colorpicker',
			'std' => '',
			'label' => __( 'Border Color', 'frenify-core' ),
			'desc' => __( 'Controls the border color. Leave blank for theme option selection.', 'frenify-core' ),
		),
		'highlightposition' => array(
			'type' => 'select',
			'label' => __( 'Highlight Border Position', 'frenify-core' ),
			'desc' => __( 'Choose the position of the highlight. This border highlight is from theme options primary color and does not take the color from border color above', 'frenify-core' ),
			'options' => array(
				'top' => __('Top', 'frenify-core'),
				'bottom' => __('Bottom', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
				'none' => __('None', 'frenify-core'),
			)
		),
		'contentalignment' => array(
			'type' => 'select',
			'label' => __( 'Content Alignment', 'frenify-core' ),
			'desc' => __( 'Choose how the content should be displayed.', 'frenify-core' ),
			'options' => array(
				'left' => __('Left', 'frenify-core'),
				'center' => __('Center', 'frenify-core'),
				'right' => __('Right', 'frenify-core'),
			)
		),		
		'button' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Button Text', 'frenify-core' ),
			'desc' => __( 'Insert the text that will display in the button', 'frenify-core' ),
		),
		'url' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Link', 'frenify-core' ),
			'desc' => __( 'The url the button will link to', 'frenify-core')
		),		
		'target' => array(
			'type' => 'select',
			'label' => __( 'Link Target', 'frenify-core' ),
			'desc' => __( '_self = open in same window <br /> _blank = open in new window', 'frenify-core' ),
			'options' => array(
				'_self' => '_self',
				'_blank' => '_blank'
			)
		),
		'modal' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Modal Window Anchor', 'frenify-core' ),
			'desc' => __( 'Add the class name of the modal window you want to open on button click.', 'frenify-core' ),
		),			
		'buttonsize' => array(
			'type' => 'select',
			'label' => __( 'Button Size', 'frenify-core' ),
			'desc' => __( 'Select the button\'s size.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'small' => __('Small', 'frenify-core'),
				'medium' => __('Medium', 'frenify-core'),
				'large' => __('Large', 'frenify-core'),
				'xlarge' => __('XLarge', 'frenify-core'),
			)
		),
		'buttontype' => array(
			'type' => 'select',
			'label' => __( 'Button Type', 'frenify-core' ),
			'desc' => __( 'Select the button\'s type.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'flat' => __('Flat', 'frenify-core'),
				'3d' => '3D',
			)
		),
		'buttonshape' => array(
			'type' => 'select',
			'label' => __( 'Button Shape', 'frenify-core' ),
			'desc' => __( 'Select the button\'s shape.', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'square' => __('Square', 'frenify-core'),
				'pill' => __('Pill', 'frenify-core'),
				'round' => __('Round', 'frenify-core'),
			)
		),		
		'buttoncolor' => array(
			'type' => 'select',
			'label' => __( 'Button Color', 'frenify-core' ),
			'desc' => __( 'Choose the button color <br />Default uses theme option selection', 'frenify-core' ),
			'options' => array(
				'' => __('Default', 'frenify-core'),
				'green' => __('Green', 'frenify-core'),
				'darkgreen' => __('Dark Green', 'frenify-core'),
				'orange' => __('Orange', 'frenify-core'),
				'blue' => __('Blue', 'frenify-core'),
				'red' => __('Red', 'frenify-core'),
				'pink' => __('Pink', 'frenify-core'),
				'darkgray' => __('Dark Gray', 'frenify-core'),
				'lightgray' => __('Light Gray', 'frenify-core'),
			)
		),
		'title' => array(
			'type' => 'textarea',
			'label' => __( 'Tagline Title', 'frenify-core' ),
			'desc' => __( 'Insert the title text', 'frenify-core' ),
			'std' => __('Title', 'frenify-core')
		),
		'description' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Tagline Description', 'frenify-core' ),
			'desc' => __( 'Insert the description text', 'frenify-core' ),
		),
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Additional Content', 'frenify-core' ),
			'desc' => __( 'This is additional content you can add to the tagline box. This will show below the title and description if one is used.', 'frenify-core' ),
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),		
		'animation_type' => array(
			'type' => 'select',
			'label' => __( 'Animation Type', 'frenify-core' ),
			'desc' => __( 'Select the type on animation to use on the shortcode', 'frenify-core' ),
			'options' => $animation_type,
		),
		'animation_direction' => array(
			'type' => 'select',
			'label' => __( 'Direction of Animation', 'frenify-core' ),
			'desc' => __( 'Select the incoming direction for the animation', 'frenify-core' ),
			'options' => $animation_direction,
		),
		'animation_speed' => array(
			'type' => 'select',
			'std' => '',
			'label' => __( 'Speed of Animation', 'frenify-core' ),
			'desc' => __( 'Type in speed of animation in seconds (0.1 - 1)', 'frenify-core' ),
			'options' => $dec_numbers,
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[tagline_box backgroundcolor="{{backgroundcolor}}" shadow="{{shadow}}" shadowopacity="{{shadowopacity}}" border="{{border}}" bordercolor="{{bordercolor}}" highlightposition="{{highlightposition}}" content_alignment="{{contentalignment}}" link="{{url}}" linktarget="{{target}}" modal="{{modal}}" button_size="{{buttonsize}}" button_shape="{{buttonshape}}" button_type="{{buttontype}}" buttoncolor="{{buttoncolor}}" button="{{button}}" title="{{title}}" description="{{description}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" animation_type="{{animation_type}}" animation_direction="{{animation_direction}}" animation_speed="{{animation_speed}}" class="{{class}}" id="{{id}}"]{{content}}[/tagline_box]',
	'popup_title' => __( 'Insert Tagline Box Shortcode', 'frenify-core')
);

/*-----------------------------------------------------------------------------------*/
/*	Testimonials Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['testimonials'] = array(
	'no_preview' => true,
	'params' => array(
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Top', 'frenify-core' ),
			'desc' => __( 'Add a custom top margin. In pixels.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Margin Bottom', 'frenify-core' ),
			'desc' => __( 'Add a custom bottom margin. In pixels.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[testimonials margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{child_shortcode}}[/testimonials]',
	'popup_title' => __( 'Insert Testimonials Shortcode', 'frenify-core' ),

	'child_shortcode' => array(
		'params' => array(
			'name' => array(
				'std' => '',
				'type' => 'text',
				'label' => __( 'Name', 'frenify-core' ),
				'desc' => __( 'Insert the name of the person.', 'frenify-core' ),
			),
			'content' => array(
				'std' => '',
				'type' => 'textarea',
				'label' => __( 'Testimonial Content', 'frenify-core' ),
				'desc' => __( 'Add the testimonial content', 'frenify-core' ),
			)
		),
		'shortcode' => '[testimonial name="{{name}}"]{{content}}[/testimonial]',
		'clone_button' => __( 'Add Testimonial', 'frenify-core' )
	)
);

/*-----------------------------------------------------------------------------------*/
/*	Title Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['customtitle'] = array(
	'no_preview' => true,
	'params' => array(
		'content' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Title', 'frenify-core' ),
			'desc' => __( 'Insert the title text', 'frenify-core' ),
		),
		'template' => array(
			'type' => 'select',
			'label' => __( 'Template', 'frenify-core' ),
			'desc' => '',
			'options' => array(
				'alpha' => __('Alpha', 'frenify-core'),
				'beta' => __('Beta', 'frenify-core'),
			)
		),
		'size' => array(
			'type' => 'select',
			'label' => __( 'Size', 'frenify-core' ),
			'desc' => '',
			'options' => array(
				'size1' => __('H1', 'frenify-core'),
				'size2' => __('H2', 'frenify-core'),
				'size3' => __('H3', 'frenify-core'),
				'size4' => __('H4', 'frenify-core'),
				'size5' => __('H5', 'frenify-core'),
				'size6' => __('H6', 'frenify-core'),
			)
		),
		'text_transform' => array(
			'type' => 'select',
			'label' => __( 'Text Transform', 'frenify-core' ),
			'desc' => '',
			'options' => array(
				'uppercase' 		=> __('Uppercase', 'frenify-core'),
				'lovercase' 		=> __('Lovercase', 'frenify-core'),
				'capitalize' 		=> __('Capitalize', 'frenify-core')
			)
		),
		'text_align' => array(
			'type' => 'select',
			'label' => __( 'Text Align', 'frenify-core' ),
			'desc' => '',
			'options' => array(
				'left' 			=> __('Left', 'frenify-core'),
				'right' 		=> __('Right', 'frenify-core'),
				'center' 		=> __('Center', 'frenify-core')
			)
		),
		'color' => array(
			'type' => 'colorpicker',
			'label' => __( 'Color', 'frenify-core' ),
			'desc' => ''
		),
		'margin_top' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Top Margin', 'frenify-core' ),
			'desc' => __( 'Spacing above the title. In px or em, e.g. 10px.', 'frenify-core' )
		),
		'margin_bottom' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Bottom Margin', 'frenify-core' ),
			'desc' => __( 'Spacing below the title. In px or em, e.g. 10px.', 'frenify-core' )
		),			
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[customtitle template="{{template}}" size="{{size}}" text_transform={{text_transform}} text_align="{{text_align}}" color="{{color}}" margin_top="{{margin_top}}" margin_bottom="{{margin_bottom}}" class="{{class}}" id="{{id}}"]{{content}}[/customtitle]',
	'popup_title' => __( 'Sharing Box Shortcode', 'frenify-core' )
);



/*-----------------------------------------------------------------------------------*/
/*	Tooltip Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['tooltip'] = array(
	'no_preview' => true,
	'params' => array(

		'title' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Tooltip Text', 'frenify-core' ),
			'desc' => __( 'Insert the text that displays in the tooltip', 'frenify-core' )
		),
		'placement' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Position', 'frenify-core' ),
			'desc' => __( 'Choose the display position.', 'frenify-core' ),
			'options' => array(
				'top' => __('Top', 'frenify-core'),
				'bottom' => __('Bottom', 'frenify-core'),
				'left' => __('Left', 'frenify-core'),
				'Right' => __('Right', 'frenify-core'),
			)
		),
		'trigger' => array(
			'type' => 'select',
			'label' => __( 'Tooltip Trigger', 'frenify-core' ),
			'desc' => __( 'Choose action to trigger the tooltip.', 'frenify-core' ),
			'options' => array(
				'hover' => __('Hover', 'frenify-core'),
				'click' => __('Click', 'frenify-core'),
			)
		),			
		'content' => array(
			'std' => '',
			'type' => 'textarea',
			'label' => __( 'Content', 'frenify-core' ),
			'desc' => __( 'Insert the text that will activate the tooltip hover', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[tooltip title="{{title}}" placement="{{placement}}" trigger="{{trigger}}" class="{{class}}" id="{{id}}"]{{content}}[/tooltip]',
	'popup_title' => __( 'Tooltip Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Vimeo Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['vimeo'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'frenify-core' ),
			'desc' => __( 'For example the Video ID for <br />https://vimeo.com/75230326 is 75230326', 'frenify-core' )
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'frenify-core' ),
			'desc' => __( 'In pixels but only enter a number, ex: 600', 'frenify-core' )
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'frenify-core' ),
			'desc' => __( 'In pixels but enter a number, ex: 350', 'frenify-core' )
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'frenify-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'frenify-core' ),
			'desc' => __( 'Use additional API parameter, for example &title=0 to disable title on video. VimeoPlus account may be required.', 'frenify-core' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[vimeo id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Vimeo Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Featured Slider Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['woofeatured'] = array(
	'no_preview' => true,
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'frenify-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'frenify-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'frenify-core'),
				'auto' => __('Auto', 'frenify-core')
			)
		),
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'frenify-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'frenify-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'frenify-core'),
				'title_below_image' => __('Title below image', 'frenify-core'),
			)
		),			
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'frenify-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'frenify-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'std' => '5',
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'frenify-core' ),
			'desc' => __('Select the number of max columns to display.', 'frenify-core'),
			'options' => fotofly_fn_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '0',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'frenify-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "frenify-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'frenify-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "frenify-core"),
		),	
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'frenify-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'frenify-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'frenify-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'frenify-core' ),
			'options' => $reverse_choices
		),		
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'frenify-core' ),
			'desc' => __('Choose to show or hide the categories', 'frenify-core'),
			'options' => $reverse_choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'frenify-core' ),
			'desc' => __('Choose to show or hide the price', 'frenify-core'),
			'options' => $reverse_choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'frenify-core' ),
			'desc' => __('Choose to show or hide the icon buttons', 'frenify-core'),
			'options' => $reverse_choices
		),	
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[featured_products_slider picture_size="{{picture_size}}" carousel_layout="{{carousel_layout}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Featured Products Slider Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	Woo Products Slider Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['wooproducts'] = array(
	'params' => array(
		'picture_size' => array(
			'type' => 'select',
			'label' => __( 'Picture Size', 'frenify-core' ),
			'desc' => __( 'fixed = width and height will be fixed <br />auto = width and height will adjust to the image.', 'frenify-core' ),
			'options' => array(
				'fixed' => __('Fixed', 'frenify-core'),
				'auto' => __('Auto', 'frenify-core')
			)
		),
		'cat_slug' => array(
			'type' => 'multiple_select',
			'label' => __( 'Categories', 'frenify-core' ),
			'desc' => __( 'Select a category or leave blank for all', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'product_cat' )
		),
		'number_posts' => array(
			'std' => 5,
			'type' => 'text',
			'label' => __( 'Number of Products', 'frenify-core' ),
			'desc' => __('Select the number of products to display', 'frenify-core')
		),
		'carousel_layout' => array(
			'type' => 'select',
			'label' => __( 'Carousel Layout', 'frenify-core' ),
			'desc' => __( 'Choose to show titles on rollover image, or below image.', 'frenify-core' ),
			'options' => array(
				'title_on_rollover' => __('Title on rollover', 'frenify-core'),
				'title_below_image' => __('Title below image', 'frenify-core'),
			)
		),			
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay', 'frenify-core' ),
			'desc' => __('Choose to autoplay the carousel.', 'frenify-core'),
			'options' => $reverse_choices
		),
		'columns' => array(
			'std' => '5',
			'type' => 'select',
			'label' => __( 'Maximum Columns', 'frenify-core' ),
			'desc' => __('Select the number of max columns to display.', 'frenify-core'),
			'options' => fotofly_fn_shortcodes_range( 6, false )	
		),		
		'column_spacing' => array(
			'std' => '13',
			'type' => 'text',
			'label' => __( 'Column Spacing', 'frenify-core' ),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 13.", "frenify-core"),
		),
		'scroll_items' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Scroll Items', 'frenify-core' ),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "frenify-core"),
		),				
		'show_nav' => array(
			'type' => 'select',
			'label' => __( 'Show Navigation', 'frenify-core' ),
			'desc' => __( 'Choose to show navigation buttons on the carousel.', 'frenify-core' ),
			'options' => $choices
		),	
		'mouse_scroll' => array(
			'type' => 'select',
			'label' => __( 'Mouse Scroll', 'frenify-core' ),
			'desc' => __( 'Choose to enable mouse drag control on the carousel.', 'frenify-core' ),
			'options' => $reverse_choices
		),		
		'show_cats' => array(
			'type' => 'select',
			'label' => __( 'Show Categories', 'frenify-core' ),
			'desc' => __('Choose to show or hide the categories', 'frenify-core'),
			'options' => $choices
		),
		'show_price' => array(
			'type' => 'select',
			'label' => __( 'Show Price', 'frenify-core' ),
			'desc' => __('Choose to show or hide the price', 'frenify-core'),
			'options' => $choices
		),
		'show_buttons' => array(
			'type' => 'select',
			'label' => __( 'Show Buttons', 'frenify-core' ),
			'desc' => __('Choose to show or hide the icon buttons', 'frenify-core'),
			'options' => $choices
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),			
	),
	'shortcode' => '[products_slider picture_size="{{picture_size}}" cat_slug="{{cat_slug}}" number_posts="{{number_posts}}" carousel_layout="{{carousel_layout}}" autoplay="{{autoplay}}" columns="{{columns}}" column_spacing="{{column_spacing}}" scroll_items="{{scroll_items}}" show_nav="{{show_nav}}" mouse_scroll="{{mouse_scroll}}" show_price="{{show_price}}" show_buttons="{{show_buttons}}" class="{{class}}" id="{{id}}"]',
	'popup_title' => __( 'Woocommerce Products Slider Shortcode', 'frenify-core' ),
	'no_preview' => true,
);

/*-----------------------------------------------------------------------------------*/
/*	Youtube Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['youtube'] = array(
	'no_preview' => true,
	'params' => array(

		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'Video ID', 'frenify-core' ),
			'desc' => __('For example the Video ID for <br />http://www.youtube.com/LOfeCR7KqUs is LOfeCR7KqUs', 'frenify-core')
		),
		'width' => array(
			'std' => '600',
			'type' => 'text',
			'label' => __( 'Width', 'frenify-core' ),
			'desc' => __('In pixels but only enter a number, ex: 600', 'frenify-core')
		),
		'height' => array(
			'std' => '350',
			'type' => 'text',
			'label' => __( 'Height', 'frenify-core' ),
			'desc' => __('In pixels but only enter a number, ex: 350', 'frenify-core')
		),
		'autoplay' => array(
			'type' => 'select',
			'label' => __( 'Autoplay Video', 'frenify-core' ),
			'desc' =>  __( 'Set to yes to make video autoplaying', 'frenify-core' ),
			'options' => $reverse_choices
		),
		'apiparams' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'AdditionalAPI Parameter', 'frenify-core' ),
			'desc' => __('Use additional API parameter, for example &rel=0 to disable related videos', 'frenify-core')
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),		
	),
	'shortcode' => '[youtube id="{{id}}" width="{{width}}" height="{{height}}" autoplay="{{autoplay}}" api_params="{{apiparams}}" class="{{class}}"]',
	'popup_title' => __( 'Youtube Shortcode', 'frenify-core' )
);

/*-----------------------------------------------------------------------------------*/
/*	frenify Slider Config
/*-----------------------------------------------------------------------------------*/

$fotofly_fn_shortcodes['frenifyslider'] = array(
	'no_preview' => true,
	'params' => array(
		'name' => array(
			'type' => 'select',
			'label' => __( 'Slider Name', 'frenify-core' ),
			'desc' => __( 'This is the shortcode name that can be used in the post content area. It is usually all lowercase and contains only letters, numbers, and hyphens. ex: "frenifyslider_slidernamehere"', 'frenify-core' ),
			'options' => fotofly_fn_shortcodes_categories( 'slide-page' )
		),
		'class' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS Class', 'frenify-core' ),
			'desc' => __( 'Add a class to the wrapping HTML element.', 'frenify-core' )
		),
		'id' => array(
			'std' => '',
			'type' => 'text',
			'label' => __( 'CSS ID', 'frenify-core' ),
			'desc' => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' )
		),
	),
	'shortcode' => '[frenifyslider id="{{id}}" class="{{class}}" name="{{name}}"][/frenifyslider]',
	'popup_title' => __( 'frenify Slider Shortcode', 'frenify-core' )
);