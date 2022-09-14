<?php

	/**
	 * WooCarousel element implementation, it extends DDElementTemplate like all other elements
	 */
	class fotofly_fn_WooCarousel extends DDElementTemplate {
		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'woo_carousel';
			// element shortcode base
			$this->config['base'] = 'products_slider';
			// element name
			$this->config['name'] = __( 'Woo Carousel', 'frenify-core' );
			// element icon
			$this->config['icon_url'] = "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] = "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class'] = 'frenify-icon builder-options-icon frenifya-tag';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Woo Slider';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "drop_level" => "4" );
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-tag"></i><sub class="sub">' . __( 'Woo Carousel', 'frenify-core' ) . '</sub></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}

		// This function generates array of woo-commerce categories
		function get_woo_commerce_categories() {
			//Check if WooCommerce is active
			if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				$taxonomy     = 'product_cat';
				$orderby      = 'name';
				$show_count   = 0;      // 1 for yes, 0 for no
				$pad_counts   = 0;      // 1 for yes, 0 for no
				$hierarchical = 1;      // 1 for yes, 0 for no
				$title        = '';
				$empty        = 0;

				$args = array(
					'taxonomy'     => $taxonomy,
					'orderby'      => $orderby,
					'show_count'   => $show_count,
					'pad_counts'   => $pad_counts,
					'hierarchical' => $hierarchical,
					'title_li'     => $title,
					'hide_empty'   => $empty
				);

				$categories_list = array();
				$all_categories  = get_categories( $args );

				if ( is_wp_error( $all_categories ) || isset( $all_categories['errors'] ) ) {
					return $categories_list;
				}


				foreach ( $all_categories as $category ) {

					$data = array(
						$category->slug => $category->name . " (" . $category->category_count . ")"
						//category name and post count
					);
					$categories_list += $data;
				}

				return $categories_list;
			} else {
				return array();
			}
		}

		//this function defines TextBlock sub elements or structure
		function popup_elements() {

			$no_of_columns           = frenifyHelper::fotofly_fn_create_dropdown_data( 1, 6 );
			$woo_commerce_categories = $this->get_woo_commerce_categories();
			$choices                 = frenifyHelper::get_shortcode_choices();

			$this->config['subElements'] = array(

				array(
					"name"          => __( 'Picture Size', 'frenify-core' ),
					"desc"          => __( 'fixed = width and height will be fixed<br>auto = width and height will adjust to the image.', 'frenify-core' ),
					"id"            => "picture_size",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "fixed",
					"allowedValues" => array(
						'fixed' => __( 'Fixed', 'frenify-core' ),
						'auto'  => __( 'Auto', 'frenify-core' )
					)
				),
				array(
					"name"          => __( 'Categories', 'frenify-core' ),
					"desc"          => __( 'Select a category or leave blank for all', 'frenify-core' ),
					"id"            => "cat_slug",
					"type"          => ElementTypeEnum::MULTI,
					"value"         => array( '' ),
					"allowedValues" => $woo_commerce_categories
				),
				array(
					"name"  => __( 'Number of Products', 'frenify-core' ),
					"desc"  => __( 'Select the number of products to display', 'frenify-core' ),
					"id"    => "number_posts",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "5"
				),
				array(
					"name"          => __( 'Carousel Layout', 'frenify-core' ),
					"desc"          => __( 'Choose to show titles on rollover image, or below image.', 'frenify-core' ),
					"id"            => "carousel_layout",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "title_on_rollover",
					"allowedValues" => array(
						'title_on_rollover' => __( 'Title on rollover', 'frenify-core' ),
						'title_below_image' => __( 'Title below image', 'frenify-core' )
					)
				),
				array(
					"name"          => __( 'Carousel Autoplay', 'frenify-core' ),
					"desc"          => __( 'Choose to autoplay the carousel.', 'frenify-core' ),
					"id"            => "autoplay",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'frenify-core' ),
						'no'  => __( 'No', 'frenify-core' )
					)
				),
				array(
					"name"          => __( 'Maximum Columns', 'frenify-core' ),
					"desc"          => __( 'Select the number of max columns to display.', 'frenify-core' ),
					"id"            => "columns",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "5",
					"allowedValues" => $no_of_columns
				),
				array(
					"name"  => __( 'Column Spacing', 'frenify-core' ),
					"desc"  => __( "Insert the amount of spacing between items without 'px'. ex: 13.", 'frenify-core' ),
					"id"    => "column_spacing",
					"type"  => ElementTypeEnum::INPUT,
					"value" => "13",
				),
				array(
					"name" 			=> __('Carousel Scroll Items', 'frenify-core'),
					"desc" 			=> __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", 'frenify-core'),
					"id" 			=> "fotofly_fn_scroll_items",
					"type" 			=> ElementTypeEnum::INPUT,
					"value" 		=> "",	
				),
				array(
					"name"          => __( 'Carousel Show Navigation', 'frenify-core' ),
					"desc"          => __( 'Choose to show navigation buttons on the carousel.', 'frenify-core' ),
					"id"            => "navigation",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "yes",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'frenify-core' ),
						'no'  => __( 'No', 'frenify-core' )
					)
				),
				array(
					"name"          => __( 'Carousel Mouse Scroll', 'frenify-core' ),
					"desc"          => __( 'Choose to enable mouse drag control on the carousel.', 'frenify-core' ),
					"id"            => "mouse_scroll",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => array(
						'yes' => __( 'Yes', 'frenify-core' ),
						'no'  => __( 'No', 'frenify-core' )
					)
				),
				array(
					"name"          => __( 'Show Categories', 'frenify-core' ),
					"desc"          => __( 'Choose to show or hide the categories', 'frenify-core' ),
					"id"            => "show_cats",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => $choices
				),
				array(
					"name"          => __( 'Show Price', 'frenify-core' ),
					"desc"          => __( 'Choose to show or hide the price', 'frenify-core' ),
					"id"            => "show_price",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => $choices
				),
				array(
					"name"          => __( 'Show Buttons', 'frenify-core' ),
					"desc"          => __( 'Choose to show or hide the icon buttons', 'frenify-core' ),
					"id"            => "show_buttons",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "no",
					"allowedValues" => $choices
				),
				array(
					"name"  => __( 'CSS Class', 'frenify-core' ),
					"desc"  => __( 'Add a class to the wrapping HTML element.', 'frenify-core' ),
					"id"    => "class",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
				array(
					"name"  => __( 'CSS ID', 'frenify-core' ),
					"desc"  => __( 'Add an ID to the wrapping HTML element.', 'frenify-core' ),
					"id"    => "id",
					"type"  => ElementTypeEnum::INPUT,
					"value" => ""
				),
			);
		}
	}