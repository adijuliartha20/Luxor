<?php



if( ! class_exists( 'Fotofly_Frenify_Custom_Post' ) ) {
	class Fotofly_Frenify_Custom_Post {

		function __construct() {
			// portfolio
			add_action( 'init', array( $this, 'portfolio_init' ) );
			add_action( 'init', array( $this, 'portfolio_taxonomy_init' ) );
			
			// gallery
			add_action( 'init', array( $this, 'gallery_init' ) );
			add_action( 'init', array( $this, 'gallery_taxonomy_init' ) );
			
			// clients
			add_action( 'init', array( $this, 'client_init' ) );
			
			// changing "Featured Image" text for custom post type
		}

		
		
		/********************************************************/
		/*  PORTFOLIO POST REGISTER
		/********************************************************/
		
		function portfolio_init() {
			
			global $fotofly_fn_option;
			
			$portfolio_slug = 'portfolio';
			if(isset($fotofly_fn_option['portfolio_slug']) && $fotofly_fn_option['portfolio_slug'] != ''){
				$portfolio_slug = $fotofly_fn_option['portfolio_slug'];
			}
			
			
			
			// Labels for display gallery projects
			$labels = array(
				'name'					=> esc_html__( 'Portfolio Posts', 'frenify-core' ),
				'singular_name'			=> esc_html__( 'Portfolio Post', 'frenify-core' ),
				'menu_name'				=> esc_html__( 'Portfolio Posts', 'frenify-core' ),
				'name_admin_bar' 		=> esc_html__( 'Portfolio Posts', 'frenify-core' ),
				'add_new'				=> esc_html__( 'Add New', 'frenify-core' ),
				'add_new_item'			=> esc_html__( 'Add New Portfolio Post', 'frenify-core' ),
				'edit_item' 			=> esc_html__( 'Edit Portfolio Post', 'frenify-core' ),
				'new_item' 				=> esc_html__( 'New Portfolio Post', 'frenify-core' ),
				'view_item' 			=> esc_html__( 'View Portfolio Post', 'frenify-core' ),
				'search_items' 			=> esc_html__( 'Search Portfolio Posts', 'frenify-core' ),
				'not_found' 			=> esc_html__( 'No Portfolio posts found', 'frenify-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Portfolio posts found in trash', 'frenify-core' ),
				'all_items' 			=> esc_html__( 'Portfolio Posts', 'frenify-core' )
			);
		
			// Arguments for gallery projects
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-format-gallery', //XXS_PLUGIN_URI . 'assets/img/portfolio-icon.png',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $portfolio_slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor', 'thumbnail' )
			);
		
			// Register our portfolio post type
			register_post_type( 'fotofly-fn-portfolio', $args );
		}
		
		function portfolio_taxonomy_init() {
			
			global $fotofly_fn_option;
			
			$slug = 'portfolio-cat';
			if(isset($fotofly_fn_option['portfolio_cat_slug']) && $fotofly_fn_option['portfolio_cat_slug'] != ''){
				$slug = $fotofly_fn_option['portfolio_cat_slug'];
			}
		
			// Label for 'portfolio category' taxonomy
			$labels = array(
				'name'							=> esc_html__( 'Portfolio Categories', 'frenify-core' ),
				'singular_name'					=> esc_html__( 'Portfolio Category', 'frenify-core' ),
				'menu_name'						=> esc_html__( 'Portfolio Categories', 'frenify-core' ),
				'edit_item'						=> esc_html__( 'Edit Category', 'frenify-core' ),
				'update_item'					=> esc_html__( 'Update Category', 'frenify-core' ),
				'add_new_item'					=> esc_html__( 'Add New Category', 'frenify-core' ),
				'new_item_name'					=> esc_html__( 'New Category Name', 'frenify-core' ),
				'parent_item'					=> esc_html__( 'Parent Category', 'frenify-core' ),
				'parent_item_colon'				=> esc_html__( 'Parent Category:', 'frenify-core' ),
				'all_items'						=> esc_html__( 'All Categories', 'frenify-core' ),
				'search_items'					=> esc_html__( 'Search Categories', 'frenify-core' ),
				'popular_items'					=> esc_html__( 'Popular Categories', 'frenify-core' ),
				'separate_items_with_commas'	=> esc_html__( 'Separate Categoriess with commas', 'frenify-core' ),
				'add_or_remove_items'			=> esc_html__( 'Add or remove Categories', 'frenify-core' ),
				'choose_from_most_used'			=> esc_html__( 'Choose from the most used Categories', 'frenify-core' ),
				'not_found'						=> esc_html__( 'No Categories found', 'frenify-core' )
			);
		
			// Arguments for 'gallery category' taxonomy
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_ui' 			=> true,
				'show_in_nav_menus'	=> true,
				'show_admin_column'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'query_var'			=> true,
				'rewrite'			=> array( 'slug' => $slug, 'with_front' => false, 'hierarchical' => true )
			);
			
			// Register Taxanomy
			register_taxonomy( 'portfolio_category', 'fotofly-fn-portfolio', $args );
			
			
		}
		
		
		
		
		
		/********************************************************/
		/*  GALLERY POST REGISTER
		/********************************************************/
		
		function gallery_init() {
			
			global $fotofly_fn_option;
			
			$gallery_slug = 'gallery';
			if(isset($fotofly_fn_option['gallery_slug']) && $fotofly_fn_option['gallery_slug'] != ''){
				$gallery_slug = $fotofly_fn_option['gallery_slug'];
			}
			
			
			
			// Labels for display gallery projects
			$labels = array(
				'name'					=> esc_html__( 'Gallery Posts', 'frenify-core' ),
				'singular_name'			=> esc_html__( 'Gallery Post', 'frenify-core' ),
				'menu_name'				=> esc_html__( 'Gallery Posts', 'frenify-core' ),
				'name_admin_bar' 		=> esc_html__( 'Gallery Posts', 'frenify-core' ),
				'add_new'				=> esc_html__( 'Add New', 'frenify-core' ),
				'add_new_item'			=> esc_html__( 'Add New Gallery Post', 'frenify-core' ),
				'edit_item' 			=> esc_html__( 'Edit Gallery Post', 'frenify-core' ),
				'new_item' 				=> esc_html__( 'New Gallery Post', 'frenify-core' ),
				'view_item' 			=> esc_html__( 'View Gallery Post', 'frenify-core' ),
				'search_items' 			=> esc_html__( 'Search Gallery Posts', 'frenify-core' ),
				'not_found' 			=> esc_html__( 'No Gallery posts found', 'frenify-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Gallery posts found in trash', 'frenify-core' ),
				'all_items' 			=> esc_html__( 'Gallery Posts', 'frenify-core' )
			);
		
			// Arguments for gallery projects
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-format-gallery', //XXS_PLUGIN_URI . 'assets/img/portfolio-icon.png',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $gallery_slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'thumbnail' )
			);
		
			// Register our gallery post type
			register_post_type( 'fotofly-fn-gallery', $args );
		}
		
		function gallery_taxonomy_init() {
			
			global $fotofly_fn_option;
			
			$slug = 'gallery-cat';
			if(isset($fotofly_fn_option['gallery_cat_slug']) && $fotofly_fn_option['gallery_cat_slug'] != ''){
				$slug = $fotofly_fn_option['gallery_cat_slug'];
			}
		
			// Label for 'gallery category' taxonomy
			$labels = array(
				'name'							=> esc_html__( 'Gallery Categories', 'frenify-core' ),
				'singular_name'					=> esc_html__( 'Gallery Category', 'frenify-core' ),
				'menu_name'						=> esc_html__( 'Gallery Categories', 'frenify-core' ),
				'edit_item'						=> esc_html__( 'Edit Category', 'frenify-core' ),
				'update_item'					=> esc_html__( 'Update Category', 'frenify-core' ),
				'add_new_item'					=> esc_html__( 'Add New Category', 'frenify-core' ),
				'new_item_name'					=> esc_html__( 'New Category Name', 'frenify-core' ),
				'parent_item'					=> esc_html__( 'Parent Category', 'frenify-core' ),
				'parent_item_colon'				=> esc_html__( 'Parent Category:', 'frenify-core' ),
				'all_items'						=> esc_html__( 'All Categories', 'frenify-core' ),
				'search_items'					=> esc_html__( 'Search Categories', 'frenify-core' ),
				'popular_items'					=> esc_html__( 'Popular Categories', 'frenify-core' ),
				'separate_items_with_commas'	=> esc_html__( 'Separate Categoriess with commas', 'frenify-core' ),
				'add_or_remove_items'			=> esc_html__( 'Add or remove Categories', 'frenify-core' ),
				'choose_from_most_used'			=> esc_html__( 'Choose from the most used Categories', 'frenify-core' ),
				'not_found'						=> esc_html__( 'No Categories found', 'frenify-core' )
			);
		
			// Arguments for 'gallery category' taxonomy
			$args = array(
				'labels'			=> $labels,
				'public'			=> true,
				'show_ui' 			=> true,
				'show_in_nav_menus'	=> true,
				'show_admin_column'	=> true,
				'show_tagcloud'		=> false,
				'hierarchical'		=> true,
				'query_var'			=> true,
				'rewrite'			=> array( 'slug' => $slug, 'with_front' => false, 'hierarchical' => true )
			);
			
			// Register Taxanomy
			register_taxonomy( 'gallery_category', 'fotofly-fn-gallery', $args );
			
			
		}
		
		/********************************************************/
		/*  CLIENT POST REGISTER
		/********************************************************/
		
		function client_init() {
			
			global $fotofly_fn_option;
			
			$slug = 'client';
			if(isset($fotofly_fn_option['client_slug']) && $fotofly_fn_option['client_slug'] != ''){
				$slug = $fotofly_fn_option['client_slug'];
			}
			
			// Labels for display client
			$labels = array(
				'name'					=> esc_html__( 'Clients', 'frenify-core' ),
				'singular_name'			=> esc_html__( 'Client', 'frenify-core' ),
				'menu_name'				=> esc_html__( 'Clients', 'frenify-core' ),
				'name_admin_bar' 		=> esc_html__( 'Clients', 'frenify-core' ),
				'add_new'				=> esc_html__( 'Add New', 'frenify-core' ),
				'add_new_item'			=> esc_html__( 'Add New Client', 'frenify-core' ),
				'edit_item' 			=> esc_html__( 'Edit Client', 'frenify-core' ),
				'new_item' 				=> esc_html__( 'New Client', 'frenify-core' ),
				'view_item' 			=> esc_html__( 'View Client', 'frenify-core' ),
				'search_items' 			=> esc_html__( 'Search Clients', 'frenify-core' ),
				'not_found' 			=> esc_html__( 'No Clients found', 'frenify-core' ),
				'not_found_in_trash'	=> esc_html__( 'No Clients found in trash', 'frenify-core' ),
				'all_items' 			=> esc_html__( 'Clients', 'frenify-core' )
			);
		
			// Arguments for client
			$args = array(
				'labels' 				=> $labels,
				'public' 				=> true,
				'publicly_queryable' 	=> true,
				'show_in_nav_menus' 	=> true,
				'show_in_admin_bar' 	=> true,
				'exclude_from_search'	=> false,
				'show_ui'				=> true,
				'show_in_menu'			=> true,
				'menu_position'			=> 4,
				'menu_icon'				=> 'dashicons-admin-users',
				'can_export'			=> true,
				'delete_with_user'		=> false,
				'hierarchical'			=> false,
				'has_archive'			=> true,
				'capability_type'		=> 'post',
				'rewrite'				=> array( 'slug' => $slug, 'with_front' => false ),
				'supports'				=> array( 'title', 'editor')
			);
		
			// Register our client
			register_post_type( 'fotofly-fn-client', $args );
		}
		
		
	
		
	}

	$fotofly_fn_custompost = new Fotofly_Frenify_Custom_Post();
}