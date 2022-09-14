<?php

	/**
	 * WooShortcodes element implementation, it extends DDElementTemplate like all other elements
	 */
	class fotofly_fn_WooShortcodes extends DDElementTemplate {
		public function __construct() {

			parent::__construct();
		}

		// Implementation for the element structure.
		public function create_element_structure() {

			// Add name of the class to deserialize it again when the element is sent back to the server from the web page
			$this->config['php_class'] = get_class( $this );
			// element id
			$this->config['id'] = 'woo_shortcodes';
			// element name
			$this->config['name'] = __( 'Woo Shortcodes', 'frenify-core' );
			// element icon
			$this->config['icon_url'] = "icons/sc-text_block.png";
			// css class related to this element
			$this->config['css_class'] = "fotofly_fn_element_box";
			// element icon class
			$this->config['icon_class'] = 'frenify-icon builder-options-icon frenifya-shopping-cart';
			// tooltip that will be displyed upon mouse over the element
			//$this->config['tool_tip']  		= 'Creates a Woo Featured Element';
			// any special html data attribute (i.e. data-width) needs to be passed
			// drop_level: elements with higher drop level can be dropped in elements with lower drop_level, 
			// i.e. element with drop_level = 2 can be dropped in element with drop_level = 0 or 1 only.
			$this->config['data'] = array( "drop_level" => "4" );
		}

		// override default implemenation for this function as this element have special view
		public function create_visual_editor( $params ) {

			$innerHtml = '<div class="fotofly_fn_iconbox textblock_element textblock_element_style" id="fotofly_fn_shortcodes">';
			$innerHtml .= '<div class="bilder_icon_container"><span class="fotofly_fn_iconbox_icon"><i class="frenifya-shopping-cart"></i><sub class="sub">' . __( 'Woo Shortcodes', 'frenify-core' ) . '</sub><p class="woo_shortcode">[woocommerce_order_tracking]</p></span></div>';
			$innerHtml .= '</div>';
			$this->config['innerHtml'] = $innerHtml;
		}

		//this function defines TextBlock sub elements or structure
		function popup_elements() {
			$this->config['subElements'] = array(
				array(
					"name"          => __( 'Shortocode', 'frenify-core' ),
					"desc"          => __( 'Choose woocommerce shortcode', 'frenify-core' ),
					"id"            => "fotofly_fn_woo_shortocode",
					"type"          => ElementTypeEnum::SELECT,
					"value"         => "",
					"allowedValues" => array(
						'1' => __( 'Order tracking', 'frenify-core' ),
						'2' => __( 'Product price/cart button', 'frenify-core' ),
						'3' => __( 'Product by SKU/ID', 'frenify-core' ),
						'4' => __( 'Products by SKU/ID', 'frenify-core' ),
						'5' => __( 'Product categories', 'frenify-core' ),
						'6' => __( 'Products by category slug', 'frenify-core' ),
						'7' => __( 'Recent products', 'frenify-core' ),
						'8' => __( 'Featured products', 'frenify-core' ),
						'9' => __( 'Shop Message', 'frenify-core' )
					)
				),
				array(
					"name"  => __( 'Shortcode content', 'frenify-core' ),
					"desc"  => __( 'Shortcode will appear here', 'frenify-core' ),
					"id"    => "fotofly_fn_woo_Shortcode_content",
					"type"  => ElementTypeEnum::TEXTAREA,
					"value" => "[woocommerce_order_tracking]"
				),
			);
		}
	}