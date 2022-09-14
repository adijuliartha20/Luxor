<?php
	/**
	 * content to builder elements convertor
	 *
	 * @package   frenifyCore
	 * @author    frenify
	 * @link      http://theme-frenify.com
	 * @copyright frenify
	 */

	if ( ! class_exists( 'fotofly_fn_Core_Reversal' ) ) {

		class fotofly_fn_Core_Reversal {

			/**
			 * Instance of this class.
			 *
			 * @since    2.0.0
			 * @var      object
			 */
			protected static $instance = null;
			/**
			 * content of current post/page.
			 *
			 * @since    2.0.0
			 * @var      object
			 */
			protected static $content = null;
			/**
			 * array of all matched short-codes.
			 *
			 * @since    2.0.0
			 * @var      Array
			 */
			protected static $matches = null;
			/**
			 * array of all created elements.
			 *
			 * @since    2.0.0
			 * @var      Array
			 */
			protected static $elements = array();
			/**
			 * builder blocks count
			 *
			 * @since    2.0.0
			 * @var      Integer
			 */
			protected static $builder_blocks_count = 1;
			/**
			 * prepared builder blocks
			 *
			 * @since    2.0.0
			 * @var      Array
			 */
			protected static $prepared_builder_blocks = array();
			/**
			 * array of all available short-codes.
			 *
			 * @since    2.0.0
			 * @var      object
			 */
			public static $tags = array(
				'one_full'                 	=> 'one_full',
				'one_half'                 	=> 'one_half',
				'one_third'                	=> 'one_third',
				'one_fourth'               	=> 'one_fourth',
				//'one_fifth'               	=> 'one_fifth',
				//'two_fifth'               	=> 'two_fifth',
				//'three_fifth'             	=> 'three_fifth',
				//'four_fifth'              	=> 'four_fifth',
				//'one_sixth'               	=> 'one_sixth',
				//'five_sixth'              	=> 'five_sixth',
				'three_fourth'             	=> 'three_fourth',
				'two_third'                	=> 'two_third',
				'fullwidth'                	=> 'fullwidth',
				'flowgallery'               => 'flowgallery',
				//'alert_box'                   	=> 'alert_box',
				'alert_fn'                  => 'alert_fn',
				'fn_blog'                   => 'fn_blog',
				//'button'                  	=> 'button',
				//'checklist'               	=> 'checklist',
				'accordion'                 => 'accordion',
				'service_carousel'          => 'service_carousel',
				'brochures'                 => 'brochures',
				'clients'                  	=> 'clients',
				'countdown'                 => 'countdown',
				//'fotofly_fn_code'          	=> 'fotofly_fn_code',
				'comparison'            	=> 'comparison',
				//'content_boxes'           	=> 'content_boxes',
				//'counters_circle'         	=> 'counters_circle',
				'counters_box'             	=> 'counters_box',
				//'dropcap'						=> 'dropcap',
				//'postslider'              	=> 'postslider',
				'expandable'                => 'expandable',
				//'flip_boxes'              	=> 'flip_boxes',
				//'fontawesome'             	=> 'fontawesome',
				//'map'                     	=> 'map',
				'tdgallery'         		=> 'tdgallery',
				//'highlight'					=> 'highlight',
				'hotspots'					=> 'hotspots',
				'hotspot'					=> 'hotspot',
				//'imageframe'              	=> 'imageframe',
				//'images'                  	=> 'images',
				'intro'                    	=> 'intro',
				
				//'layerslider'             	=> 'layerslider',
				//'fotofly_fn_lightbox'      	=> 'fotofly_fn_lightbox',
				//'menu_anchor'             	=> 'menu_anchor',
				'modal'                    	=> 'modal',
				'person'                   	=> 'person',
				'about_me_fn'         	 	=> 'about_me_fn',
				'social_list_fn'       	 	=> 'social_list_fn',
				'instagram_fn'              => 'instagram_fn',
				'call_to_action_fn'			=> 'call_to_action_fn',
				'hover_width'				=> 'hover_width',
				'img_after_before'			=> 'img_after_before',
				'flipbox_fn'				=> 'flipbox_fn',
				'button_fn'					=> 'button_fn',
				'testimonial_single'        => 'testimonial_single',
				'servicetab_single'         => 'servicetab_single',
				'call_to_action_classic_fn'	=> 'call_to_action_classic_fn',
				'contact_info'				=> 'contact_info',
				'halfimage'                 => 'halfimage',
				'project_slider'          	=> 'project_slider',
				//'popover'						=> 'popover',
				//'pricing_table'				=> 'pricing_table',
				'progress'                 	=> 'progress',
				'recent_posts'             	=> 'recent_posts',
				'fullpage_gallery'          => 'fullpage_gallery',
				'cuspost_parallax'          => 'cuspost_parallax',
				'portfolio_custom'       	=> 'portfolio_custom',
				'custompost_ribbon'       	=> 'custompost_ribbon',
				'custompost_carousel'		=> 'custompost_carousel',
				'custompost_carousel_two'   => 'custompost_carousel_two',
				'multi_scroll'       		=> 'multi_scroll',
				'cortex_slider'       		=> 'cortex_slider',
				'cuspostcat_folder'       	=> 'cuspostcat_folder',
				'cuspostcat_modern'       	=> 'cuspostcat_modern',
				//'rev_slider'              	=> 'rev_slider',
				//'section_separator'       	=> 'section_separator',
				//'separator'               	=> 'separator',
				'service'               	=> 'service',
				'servicepack'               => 'servicepack',
				'sp'               			=> 'sp',
				'servicetabs'               => 'servicetabs',
				'coverbox'               	=> 'coverbox',
				'tdcontent'               	=> 'tdcontent',
				'supersized'                => 'supersized',
				'kenburns'               	=> 'kenburns',
				'flexslider'                => 'flexslider',
				'unit_info'                	=> 'unit_info',
				'category_column_portfolio'           => 'category_column_portfolio',
				'category_column_gallery'           => 'category_column_gallery',
				'about_slider'              => 'about_slider',
				'service_list'              => 'service_list',
				'wotoslider'                => 'wotoslider',
				//'slider'                  	=> 'slider',
				//'soundcloud'              	=> 'soundcloud',
				//'social_links'            	=> 'social_links',
				'fotofly_fn_tabs'          	=> 'fotofly_fn_tabs',

				//'tagline_box'             	=> 'tagline_box',
				'testimonials'             	=> 'testimonials',
				//'fotofly_fn_text'          	=> 'fotofly_fn_text',
				'custom_title'               => 'custom_title',
				'main_title'               => 'main_title',
				'custom_link'               => 'custom_link',
				'toggle'                    => 'toggle',
				'workstep'                  => 'workstep',
				//'tooltip'						=> 'tooltip',
				//'vimeo'                    	=> 'vimeo',
				//'featured_products_slider' 	=> 'featured_products_slider',
				//'products_slider'          	=> 'products_slider',

				//'youtube'                  	=> 'youtube',
				
				//CHILD ATTRIBUTES =================================================
				
				'li_item'                  	=> 'li_item',
				'brochure'                  => 'brochure',
				'client'                   	=> 'client',
				'content_box'              	=> 'content_box',
				'counter_circle'           	=> 'counter_circle',
				'counter_box'              	=> 'counter_box',
				'flowimg'                 	=> 'flowimg',
				'image'                    	=> 'image',
				'ken'             			=> 'ken',
				'fleximg'               	=> 'fleximg',
				'ui_image'               	=> 'ui_image',
				'servicetab'               	=> 'servicetab',
				'slide'                    	=> 'slide',
				'fotofly_fn_tab'            => 'fotofly_fn_tab',
				'testimonial'              	=> 'testimonial',
				'gimg'             			=> 'gimg',
				'simg'             			=> 'simg',
				'tog'                   	=> 'tog',
				'frenifyslider'             => 'frenifyslider',
				'acc'             			=> 'acc',
				'service_item'             	=> 'service_item',
				'wotoimg'             		=> 'wotoimg',
				'about_img'            		=> 'about_img',
				'category_col_portfolio'    => 'category_col_portfolio',
				'category_col_gallery'    	=> 'category_col_gallery',
				'service_list_item'    		=> 'service_list_item',
			);

			/**
			 * Initialize the hooks and filters for the page builder UI
			 *
			 * @since  2.0.0
			 */
			private function __construct() {
			}

			/**
			 * return an instance of this class.
			 *
			 * @since        2.0.0
			 * @return        object    A single instance of this class.
			 */
			public static function get_instance() {

				// If the single instance hasn't been set, set it now.
				if ( null == self::$instance ) {
					self::$instance = new self;
				}

				return self::$instance;

			}

			/**
			 * Print array nicely
			 *
			 * @since        2.0.0
			 * @return        null
			 */
			private static function print_array( $array ) {
				echo "<pre>";
				print_r( $array );
				echo "</pre>";
			}

			public static function content_to_elements( $content ) {
				//turn off error reporting in order to avoid notices and errors. :: Required for compatiblity
				/*ini_set('display_errors',1);
			ini_set('display_startup_errors',1);*/
				error_reporting( 0 );

				$index = 0;

				//echo memory_get_usage() . "\n";

				$content = fotofly_fn_Core_Reversal::convert_to_builder_blocks( $content );

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $content, fotofly_fn_Core_Reversal::$matches, PREG_SET_ORDER );

				//$memory_1 = memory_get_usage();


				if ( ! empty( fotofly_fn_Core_Reversal::$matches ) ) {
					foreach ( fotofly_fn_Core_Reversal::$matches as $match ) {
						switch ( $match[2] ) {
							case 'fullwidth':

								$full_width                  = new fotofly_fn_FullWidthContainer();
								$full_width->config['index'] = $index;
								$full_width->config['id']    = fotofly_fn_Core_Reversal::GUID();
								$index                       = $index + 1;
								$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
								if ( method_exists( 'fotofly_fn_FullWidthContainer', 'deprecated_args' ) ) {
									$attribs = $full_width->deprecated_args( $attribs );
								}
								$children = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $full_width->config['id'] );

								if ( ! is_array( $children ) ) {
									$attribs['content'] = stripslashes( $children );
								} else if ( is_array( $children ) ) {

									$full_width->config['childrenId'] = $children;
								}
								$full_width = fotofly_fn_Core_Reversal::prepare_full_width( $attribs, $full_width );

								array_push( fotofly_fn_Core_Reversal::$elements, $full_width->element_to_array() );
								break;

							default:
								fotofly_fn_Core_Reversal::convert_builder_elements( $match, $index );
								break;
						}

					}

				}

				//var_dump(fotofly_fn_Core_Reversal::$elements);
				header( "Content-Type: application/json" );
				//echo json_encode( array('count' => count( fotofly_fn_Core_Reversal::$elements ) ) );
				echo json_encode( fotofly_fn_Core_Reversal::$elements );
				//echo memory_get_usage() - $memory_1 . "\r\r";
				//echo memory_get_usage();
				exit();
			}


			/**
			 * Retrieve the shortcode regular expression for searching.
			 * The regular expression combines the shortcode tags in the regular expression
			 * in a regex class.
			 * The regular expression contains 6 different sub matches to help with parsing.
			 * 1 - An extra [ to allow for escaping shortcodes with double [[]]
			 * 2 - The shortcode name
			 * 3 - The shortcode argument list
			 * 4 - The self closing /
			 * 5 - The content of a shortcode when it wraps some content.
			 * 6 - An extra ] to allow for escaping shortcodes with double [[]]
			 *
			 * @since 2.0
			 * @uses  $shortcode_tags
			 * @return string The shortcode search regular expression
			 */
			public static function get_shortcode_regex( $ignored = false, $all = false ) {
				$shortcode_tags = fotofly_fn_Core_Reversal::$tags;

				$ignored_shortcode_tags = array(
					'highlight'       => 'highlight',
					'tooltip'         => 'tooltip',
					'popover'         => 'popover',
					'modal_text_link' => 'modal_text_link'
				);
				if ( $ignored ) {
					$shortcode_tags = $ignored_shortcode_tags;
				}
				if ( $all ) {
					$shortcode_tags = array_merge( $shortcode_tags, $ignored_shortcode_tags );
				}
				$tagnames = array_keys( $shortcode_tags );

				$tagregexp = join( '|', array_map( 'preg_quote', $tagnames ) );

				// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
				// Also, see shortcode_unautop() and shortcode.js.
				return
					'\\['                              // Opening bracket
					. '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
					. "($tagregexp)"                     // 2: Shortcode name
					. '(?![\\w-])'                       // Not followed by word character or hyphen
					. '('                                // 3: Unroll the loop: Inside the opening shortcode tag
					. '[^\\]\\/]*'                   // Not a closing bracket or forward slash
					. '(?:'
					. '\\/(?!\\])'               // A forward slash not followed by a closing bracket
					. '[^\\]\\/]*'               // Not a closing bracket or forward slash
					. ')*?'
					. ')'
					. '(?:'
					. '(\\/)'                        // 4: Self closing tag ...
					. '\\]'                          // ... and closing bracket
					. '|'
					. '\\]'                          // Closing bracket
					. '(?:'
					. '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
					. '[^\\[]*+'             // Not an opening bracket
					. '(?:'
					. '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
					. '[^\\[]*+'         // Not an opening bracket
					. ')*+'
					. ')'
					. '\\[\\/\\2\\]'             // Closing shortcode tag
					. ')?'
					. ')'
					. '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
			}

			/**
			 * Get globally unique identifier
			 *
			 * @since        2.0.0
			 * @return        String
			 */
			public static function GUID() {

				return 'frenifyb_' . sprintf( '%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand( 0, 65535 ), mt_rand( 0, 65535 ),
					mt_rand( 0, 65535 ), mt_rand( 16384, 20479 ), mt_rand( 32768, 49151 ), mt_rand( 0, 65535 ),
					mt_rand( 0, 65535 ), mt_rand( 0, 65535 ) );
			}

			/**
			 * Retrieve all attribsutes from the shortcodes tag.
			 * The attributes list has the attribute name as the key and the value of the
			 * attribute as the value in the key/value pair. This allows for easier
			 * retrieval of the attributes, since all attributes have to be known.
			 *
			 * @since 2.0
			 *
			 * @param string $text
			 *
			 * @return array List of attributes and their value.
			 */
			public static function shortcode_parse_atts( $text ) {
				$atts    = array();
				$pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
				$text    = preg_replace( "/[\x{00a0}\x{200b}]+/u", " ", $text );
				if ( preg_match_all( $pattern, $text, $match, PREG_SET_ORDER ) ) {
					foreach ( $match as $m ) {
						if ( ! empty( $m[1] ) ) {
							$atts[ strtolower( $m[1] ) ] = stripcslashes( $m[2] );
						} elseif ( ! empty( $m[3] ) ) {
							$atts[ strtolower( $m[3] ) ] = stripcslashes( $m[4] );
						} elseif ( ! empty( $m[5] ) ) {
							$atts[ strtolower( $m[5] ) ] = stripcslashes( $m[6] );
						} elseif ( isset( $m[7] ) and strlen( $m[7] ) ) {
							$atts[] = stripcslashes( $m[7] );
						} elseif ( isset( $m[8] ) ) {
							$atts[] = stripcslashes( $m[8] );
						}
					}
				} else {
					$atts = ltrim( $text );
				}

				return $atts;
			}

			/**
			 * Whether the passed content contains the specified shortcode
			 *
			 * @since 2.0
			 *
			 * @param String $tags
			 * @param string $tag
			 *
			 * @return boolean
			 */
			public static function has_shortcode( $content, $tag, $ignored_shortcode = false ) {

				if ( false === strpos( $content, '[' ) ) {
					return false;
				}


				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex( $ignored_shortcode ) . '/s', $content, $matches, PREG_SET_ORDER );
				if ( empty( $matches ) ) {
					return false;
				}

				foreach ( $matches as $shortcode ) {
					if ( $tag === $shortcode[2] ) {
						return true;
					}
				}


				return false;
			}

			/**
			 * whether shortcode exists in provided content
			 *
			 * @since 2.0
			 *
			 * @param String $content
			 *
			 * @return boolean
			 */
			public static function is_shortcode( $content ) {
				foreach ( fotofly_fn_Core_Reversal::$tags as $tag ) {
					if ( fotofly_fn_Core_Reversal::has_shortcode( $content, $tag ) ) {
						return true;
					}
				}

				return false;
			}

			/**
			 * Whether child elements exists. Will be checked via parent tag
			 *
			 * @since 2.0
			 *
			 * @param String   $content
			 * @param Interger $index
			 * @param string   $parent
			 *
			 * @return Array ChildrenID
			 */
			public static function check_for_child_elements( $content, &$index, $parent = null ) {

				if ( ! empty( $content ) && $content != ' ' ) {
					$content = fotofly_fn_Core_Reversal::convert_to_builder_blocks( $content );

					if ( fotofly_fn_Core_Reversal::is_shortcode( $content ) ) {
						$matches  = null;
						$children = array();
						preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $content, $matches, PREG_SET_ORDER );

						foreach ( $matches as $match ) {
							$child_id = fotofly_fn_Core_Reversal::convert_builder_elements( $match, $index, $parent );
							array_push( $children, $child_id );
						}

						return $children;

					} else {
						return $content;
					}
				}

				return $content;
			}

			/**
			 * Create text block element.
			 *
			 * @since 2.0
			 *
			 * @param    String     $content
			 * @param    Interger   $index
			 * @param        String $parent
			 *
			 * @return    Array        ElementId
			 */

			public static function create_text_element( $content, &$index, $parent = null ) {

				$children                                      = array();
				$text_block                                    = new fotofly_fn_frenifyText();
				$text_block->config['index']                   = $index;
				$text_block->config['id']                      = fotofly_fn_Core_Reversal::GUID();
				$index                                         = $index + 1;
				$text_block->config['subElements'][0]['value'] = stripslashes( $content );
				if ( ! is_null( $parent ) ) {
					$text_block->config['parentId'] = $parent;
				}
				array_push( fotofly_fn_Core_Reversal::$elements, $text_block->element_to_array() );
				array_push( $children, array( 'id' => $text_block->config['id'] ) );

				return $children;

			}

			/**
			 * Assign attributes to column options.
			 *
			 * @since 2.0
			 *
			 * @param    String $match
			 * @param    Array  $element
			 *
			 * @return    Array        Element
			 */
			public static function prepare_column_options( $match, $element ) {
				$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match ) );
				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'last':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'spacing':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						
						case 'padding';
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top';
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom';
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
						
						case 'text_color':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'text_align':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'background_color':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
							
						case 'background_color_rate':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
							
						case 'background_type':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
						
						case 'background_image':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
							
						case 'background_position':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
							
						case 'background_repeat':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
							
						case 'background_size':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;
							
						case 'border_position':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;
							
						case 'border_size':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;
							
						case 'border_style':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
							
						case 'border_color':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;
							
						case 'animation_type';
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;

						case 'animation_delay';
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Converted matched short-codes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param String   $match
			 * @param Interger $index
			 * @param string   $parent
			 *
			 * @return Array ID
			 */
			public static function convert_builder_elements( $match, &$index, $parent = null ) {
				switch ( $match[2] ) {
					case 'one_full':

						$grid_one                  = new fotofly_fn_GridOne();
						$grid_one->config['index'] = $index;
						$grid_one->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_one                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_one );
						$index                     = $index + 1;
						$children                  = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_one->config['id'] );

						if ( is_array( $children ) ) {
							$grid_one->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_one->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_one->element_to_array() );

						return array( 'id' => $grid_one->config['id'] );
						break;
					case 'one_half':

						$grid_two                  = new fotofly_fn_GridTwo();
						$grid_two->config['index'] = $index;
						$grid_two->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_two                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_two );
						$index                     = $index + 1;
						$children                  = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_two->config['id'] );

						if ( is_array( $children ) ) {
							$grid_two->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_two->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_two->element_to_array() );

						return array( 'id' => $grid_two->config['id'] );
						break;

					case 'one_third':

						$grid_three                  = new fotofly_fn_GridThree();
						$grid_three->config['index'] = $index;
						$grid_three->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_three                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_three );
						$index                       = $index + 1;
						$children                    = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_three->config['id'] );

						if ( is_array( $children ) ) {
							$grid_three->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_three->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_three->element_to_array() );

						return array( 'id' => $grid_three->config['id'] );
						break;

					case 'one_fourth':

						$grid_four                  = new fotofly_fn_GridFour();
						$grid_four->config['index'] = $index;
						$grid_four->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_four                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_four );
						$index                      = $index + 1;
						$children                   = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_four->config['id'] );

						if ( is_array( $children ) ) {
							$grid_four->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_four->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_four->element_to_array() );

						return array( 'id' => $grid_four->config['id'] );
						break;

					case 'one_fifth':

						$grid_five                  = new fotofly_fn_GridFive();
						$grid_five->config['index'] = $index;
						$grid_five->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_five                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_five );
						$index                      = $index + 1;
						$children                   = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_five->config['id'] );

						if ( is_array( $children ) ) {
							$grid_five->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_five->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_five->element_to_array() );

						return array( 'id' => $grid_five->config['id'] );
						break;

					case 'two_fifth':

						$grid_two_fifth                  = new fotofly_fn_GridTwoFifth();
						$grid_two_fifth->config['index'] = $index;
						$grid_two_fifth->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_two_fifth                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_two_fifth );
						$index                           = $index + 1;
						$children                        = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_two_fifth->config['id'] );

						if ( is_array( $children ) ) {
							$grid_two_fifth->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_two_fifth->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_two_fifth->element_to_array() );

						return array( 'id' => $grid_two_fifth->config['id'] );
						break;

					case 'three_fifth':

						$grid_three_fifth                  = new fotofly_fn_GridThreeFifth();
						$grid_three_fifth->config['index'] = $index;
						$grid_three_fifth->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_three_fifth                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_three_fifth );
						$index                             = $index + 1;
						$children                          = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_three_fifth->config['id'] );

						if ( is_array( $children ) ) {
							$grid_three_fifth->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_three_fifth->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_three_fifth->element_to_array() );

						return array( 'id' => $grid_three_fifth->config['id'] );
						break;

					case 'four_fifth':

						$grid_four_fifth                  = new fotofly_fn_GridFourFifth();
						$grid_four_fifth->config['index'] = $index;
						$grid_four_fifth->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_four_fifth                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_four_fifth );
						$index                            = $index + 1;
						$children                         = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_four_fifth->config['id'] );

						if ( is_array( $children ) ) {
							$grid_four_fifth->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_four_fifth->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_four_fifth->element_to_array() );

						return array( 'id' => $grid_four_fifth->config['id'] );
						break;

					case 'one_sixth':

						$grid_six                  = new fotofly_fn_GridSix();
						$grid_six->config['index'] = $index;
						$grid_six->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_six                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_six );
						$index                     = $index + 1;
						$children                  = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_six->config['id'] );

						if ( is_array( $children ) ) {
							$grid_six->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_six->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_six->element_to_array() );

						return array( 'id' => $grid_six->config['id'] );
						break;


					case 'five_sixth':

						$grid_five_six                  = new fotofly_fn_GridFiveSix();
						$grid_five_six->config['index'] = $index;
						$grid_five_six->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_five_six                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_five_six );
						$index                          = $index + 1;
						$children                       = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_five_six->config['id'] );

						if ( is_array( $children ) ) {
							$grid_five_six->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_five_six->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_five_six->element_to_array() );

						return array( 'id' => $grid_five_six->config['id'] );
						break;

					case 'three_fourth':

						$grid_three_fourth                  = new fotofly_fn_GridThreeFourth();
						$grid_three_fourth->config['index'] = $index;
						$grid_three_fourth->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_three_fourth                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_three_fourth );
						$index                              = $index + 1;
						$children                           = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_three_fourth->config['id'] );

						if ( is_array( $children ) ) {
							$grid_three_fourth->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_three_fourth->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_three_fourth->element_to_array() );

						return array( 'id' => $grid_three_fourth->config['id'] );
						break;

					case 'two_third':

						$grid_two_third                  = new fotofly_fn_GridTwoThird();
						$grid_two_third->config['index'] = $index;
						$grid_two_third->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$grid_two_third                  = fotofly_fn_Core_Reversal::prepare_column_options( $match[3], $grid_two_third );
						$index                           = $index + 1;
						$children                        = fotofly_fn_Core_Reversal::check_for_child_elements( $match[5], $index, $grid_two_third->config['id'] );

						if ( is_array( $children ) ) {
							$grid_two_third->config['childrenId'] = $children;
						}

						if ( ! is_null( $parent ) ) {
							$grid_two_third->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $grid_two_third->element_to_array() );

						return array( 'id' => $grid_two_third->config['id'] );
						break;
					case 'alert_fn':

						$alert_box                  = new fotofly_fn_Alert();
						$alert_box->config['index'] = $index;
						$alert_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                      = $index + 1;
						$attribs                    = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']         = stripslashes( $match[5] );
						$alert_box                  = fotofly_fn_Core_Reversal::prepare_alert_fn( $attribs, $alert_box );
						if ( ! is_null( $parent ) ) {
							$alert_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $alert_box->element_to_array() );

						return array( 'id' => $alert_box->config['id'] );

						break;
					case 'fn_blog':

						$wp_blog                  = new fotofly_fn_BlogFn();
						$wp_blog->config['index'] = $index;
						$wp_blog->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                    = $index + 1;
						$attribs                  = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$wp_blog                  = fotofly_fn_Core_Reversal::prepare_wp_fn_blog( $attribs, $wp_blog );
						if ( ! is_null( $parent ) ) {
							$wp_blog->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $wp_blog->element_to_array() );

						return array( 'id' => $wp_blog->config['id'] );

						break;
					case 'button':

						$wp_button                  = new fotofly_fn_ButtonBlock();
						$wp_button->config['index'] = $index;
						$wp_button->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                      = $index + 1;
						$attribs                    = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']         = stripslashes( $match[5] );
						$wp_button                  = fotofly_fn_Core_Reversal::prepare_wp_button( $attribs, $wp_button );
						if ( ! is_null( $parent ) ) {
							$wp_button->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $wp_button->element_to_array() );

						return array( 'id' => $wp_button->config['id'] );


						break;
					case 'checklist':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_checklist_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$checklist                  = new fotofly_fn_CheckList( $attribs['addmore'] );
						$checklist->config['index'] = $index;
						$checklist->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                      = $index + 1;
						$checklist                  = fotofly_fn_Core_Reversal::prepare_checklist( $attribs, $checklist );
						if ( ! is_null( $parent ) ) {
							$checklist->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $checklist->element_to_array() );

						return array( 'id' => $checklist->config['id'] );

						break;
					case 'clients':						
						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['lightbox'] = 'no';
						$attribs = fotofly_fn_Core_Reversal::get_client_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$client                  = new fotofly_fn_Client( $attribs['addmore'] );
						$client->config['index'] = $index;
						$client->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                   = $index + 1;
						$client                  = fotofly_fn_Core_Reversal::prepare_client( $attribs, $client );
						if ( ! is_null( $parent ) ) {
							$client->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $client->element_to_array() );

						return array( 'id' => $client->config['id'] );						

						break;
					case 'fotofly_fn_code':
						$code_block                  = new fotofly_fn_CodeBlock();
						$code_block->config['index'] = $index;
						$code_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$code_content				 = stripslashes( $match[5] );
						
						if ( base64_encode( base64_decode( $code_content ) ) === $code_content ){
							$code_content = base64_decode( $code_content );
						} else {
							//not encoded
						}
						
						$attribs['content']          = $code_content;
						$code_block                  = fotofly_fn_Core_Reversal::prepare_code_block( $attribs, $code_block );
						if ( ! is_null( $parent ) ) {
							$code_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $code_block->element_to_array() );

						return array( 'id' => $code_block->config['id'] );
						break;
					case 'content_boxes':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_content_boxes_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}

						if ( ( $attribs['layout'] == 'none' || $attribs['layout'] == 'icon-on-side' || $attribs['layout'] == 'icon-with-title' ) && ( ! isset( $attribs['icon_circle_size'] ) || $attribs['icon_circle_size'] == '' ) ) {
							$attribs['icon_circle_size'] = 'small';
						} elseif ( ! isset( $attribs['icon_circle_size'] ) && $attribs['icon_circle_size'] == '' ) {
							$attribs['icon_circle_size'] = 'large';
						}

						$content_boxes                  = new fotofly_fn_ContentBoxes( $attribs['addmore'] );
						$content_boxes->config['index'] = $index;
						$content_boxes->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$content_boxes                  = fotofly_fn_Core_Reversal::prepare_content_boxes( $attribs, $content_boxes );
						if ( ! is_null( $parent ) ) {
							$content_boxes->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $content_boxes->element_to_array() );

						return array( 'id' => $content_boxes->config['id'] );

						break;
					case 'counters_circle':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_counter_circle_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}

						$counter_circle                  = new fotofly_fn_CounterCircle( $attribs['addmore'] );
						$counter_circle->config['index'] = $index;
						$counter_circle->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                           = $index + 1;
						$counter_circle                  = fotofly_fn_Core_Reversal::prepare_counter_circle( $attribs, $counter_circle );
						if ( ! is_null( $parent ) ) {
							$counter_circle->config['parentId'] = $parent;
						}

						array_push( fotofly_fn_Core_Reversal::$elements, $counter_circle->element_to_array() );

						return array( 'id' => $counter_circle->config['id'] );

						break;
					case 'counters_box':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_counter_box_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$counter_box                  = new fotofly_fn_CounterBox( $attribs['addmore'] );
						$counter_box->config['index'] = $index;
						$counter_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$counter_box                  = fotofly_fn_Core_Reversal::prepare_counter_box( $attribs, $counter_box );
						if ( ! is_null( $parent ) ) {
							$counter_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $counter_box->element_to_array() );

						return array( 'id' => $counter_box->config['id'] );

						break;
						
					case 'brochures':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_brochure_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$brochure                  = new fotofly_fn_Brochure( $attribs['addmore'] );
						$brochure->config['index'] = $index;
						$brochure->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$brochure                  = fotofly_fn_Core_Reversal::prepare_brochure( $attribs, $brochure );
						if ( ! is_null( $parent ) ) {
							$brochure->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $brochure->element_to_array() );

						return array( 'id' => $brochure->config['id'] );

						break;
					/*case 'dropcap':
				
					$drop_Cap 							= new fotofly_fn_DropCap();
					$drop_Cap->config['index'] 			= $index;
					$drop_Cap->config['id'] 			= fotofly_fn_Core_Reversal::GUID();
					$index								= $index + 1;
					$attribs							= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$attribs['content']					= stripslashes( $match[5] );
					$drop_Cap							= fotofly_fn_Core_Reversal::prepare_wp_drop_Cap( $attribs, $drop_Cap );
					if ( !is_null( $parent ) ) { $drop_Cap->config['parentId'] = $parent; }
					array_push( fotofly_fn_Core_Reversal::$elements , $drop_Cap->element_to_array() );
					return array( 'id' => $drop_Cap->config['id'] );
				
				break;*/

					case 'postslider':

						$post_slider                  = new fotofly_fn_PostSlider();
						$post_slider->config['index'] = $index;
						$post_slider->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$post_slider                  = fotofly_fn_Core_Reversal::prepare_post_slider( $attribs, $post_slider );
						if ( ! is_null( $parent ) ) {
							$post_slider->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $post_slider->element_to_array() );

						return array( 'id' => $post_slider->config['id'] );

						break;
					case 'flip_boxes':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_flip_boxes_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$flip_boxes                  = new fotofly_fn_FlipBoxes( $attribs['addmore'] );
						$flip_boxes->config['index'] = $index;
						$flip_boxes->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$flip_boxes                  = fotofly_fn_Core_Reversal::prepare_flip_boxes( $attribs, $flip_boxes );
						if ( ! is_null( $parent ) ) {
							$flip_boxes->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $flip_boxes->element_to_array() );

						return array( 'id' => $flip_boxes->config['id'] );

						break;
					case 'fontawesome':

						$font_awesmoe                  = new fotofly_fn_FontAwesome();
						$font_awesmoe->config['index'] = $index;
						$font_awesmoe->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$font_awesmoe                  = fotofly_fn_Core_Reversal::prepare_wp_font_awesmoe( $attribs, $font_awesmoe );
						if ( ! is_null( $parent ) ) {
							$font_awesmoe->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $font_awesmoe->element_to_array() );

						return array( 'id' => $font_awesmoe->config['id'] );

						break;
					case 'map':

						$google_map                  = new fotofly_fn_GoogleMap();
						$google_map->config['index'] = $index;
						$google_map->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$google_map                  = fotofly_fn_Core_Reversal::prepare_wp_google_map( $attribs, $google_map );
						if ( ! is_null( $parent ) ) {
							$google_map->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $google_map->element_to_array() );

						return array( 'id' => $google_map->config['id'] );

						break;
						
					case 'tdgallery':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_gallery_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$gallery                  = new fotofly_fn_Gallery( $attribs['addmore'] );
						$gallery->config['index'] = $index;
						$gallery->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                           = $index + 1;
						$gallery                  = fotofly_fn_Core_Reversal::prepare_gallery( $attribs, $gallery );
						if ( ! is_null( $parent ) ) {
							$gallery->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery->element_to_array() );

						return array( 'id' => $gallery->config['id'] );

						break;
						
						
					case 'supersized':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_supersized_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_Supersized( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_supersized( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
						
					case 'kenburns':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_kenburns_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_Kenburns( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_kenburns( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
					
					case 'flexslider':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_flexslider_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_Flexslider( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_flexslider( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
						
					case 'unit_info':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_unit_info_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_UnitInfo( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_unit_info( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
						
					case 'category_column_portfolio':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_category_column_portfolio_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_CategoryColumnPortfolio( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_category_column_portfolio( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
						
					case 'category_column_gallery':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_category_column_gallery_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_CategoryColumnGallery( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_category_column_gallery( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
						
					case 'about_slider':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_about_slider_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_AboutSlider( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_about_slider( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
						
					case 'service_list':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_service_list_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_ServiceList( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_service_list( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
					
						
					case 'wotoslider':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_wotoslider_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$supersized                  = new fotofly_fn_Wotoslider( $attribs['addmore'] );
						$supersized->config['index'] = $index;
						$supersized->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$supersized                  = fotofly_fn_Core_Reversal::prepare_wotoslider( $attribs, $supersized );
						if ( ! is_null( $parent ) ) {
							$supersized->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $supersized->element_to_array() );

						return array( 'id' => $supersized->config['id'] );

						break;
					
					case 'flowgallery':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_flowgallery_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$flowgallery                  = new fotofly_fn_FlowGallery( $attribs['addmore'] );
						$flowgallery->config['index'] = $index;
						$flowgallery->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$flowgallery                  = fotofly_fn_Core_Reversal::prepare_flowgallery( $attribs, $flowgallery );
						if ( ! is_null( $parent ) ) {
							$flowgallery->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $flowgallery->element_to_array() );

						return array( 'id' => $flowgallery->config['id'] );

						break;
						
					
						
					/*case 'highlight':
				
					$high_light 								= new fotofly_fn_HighLight();
					$high_light->config['index'] 				= $index;
					$high_light->config['id'] 					= fotofly_fn_Core_Reversal::GUID();
					$index										= $index + 1;
					$attribs									= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$attribs['content']							= stripslashes( $match[5] );
					$high_light									= fotofly_fn_Core_Reversal::prepare_wp_high_light( $attribs, $high_light );
					
					if ( !is_null( $parent ) ) { $high_light->config['parentId'] = $parent; }
					array_push( fotofly_fn_Core_Reversal::$elements , $high_light->element_to_array() );
					return array( 'id' => $high_light->config['id'] );
					
				break;*/
					case 'imageframe':

						$image_frame                  = new fotofly_fn_ImageFrame();
						$image_frame->config['index'] = $index;
						$image_frame->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						//get img src and alt attribs
						$image_attrib = null;

						$doc           = new DOMDocument();
						$doc->encoding = 'utf-8'; //for sepcial characters handeling

						@$doc->loadHTML( '<?xml encoding="UTF-8">' . stripslashes( $match[5] ) );

						$tags = $doc->getElementsByTagName( 'img' );

						foreach ( $tags as $tag ) {

							$attribs['src'] = $tag->getAttribute( 'src' );
							$attribs['alt'] = $tag->getAttribute( 'alt' );
						}

						$image_frame = fotofly_fn_Core_Reversal::prepare_image_frame( $attribs, $image_frame );
						if ( ! is_null( $parent ) ) {
							$image_frame->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $image_frame->element_to_array() );

						return array( 'id' => $image_frame->config['id'] );

						break;
					case 'images':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_carousel_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$image_carousel                  = new fotofly_fn_ImageCarousel( $attribs['addmore'] );
						$image_carousel->config['index'] = $index;
						$image_carousel->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                           = $index + 1;
						$image_carousel                  = fotofly_fn_Core_Reversal::prepare_carousel( $attribs, $image_carousel );
						if ( ! is_null( $parent ) ) {
							$image_carousel->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $image_carousel->element_to_array() );

						return array( 'id' => $image_carousel->config['id'] );

						break;
					case 'layerslider':

						$layer_slider                  = new fotofly_fn_LayerSlider();
						$layer_slider->config['index'] = $index;
						$layer_slider->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$layer_slider                  = fotofly_fn_Core_Reversal::prepare_layerslider( $attribs, $layer_slider );
						if ( ! is_null( $parent ) ) {
							$layer_slider->config['parentId'] = $parent;
						}

						array_push( fotofly_fn_Core_Reversal::$elements, $layer_slider->element_to_array() );

						return array( 'id' => $layer_slider->config['id'] );

						break;
					case 'fotofly_fn_lightbox':

						$image_frame                  = new fotofly_fn_ImageFrame();
						$image_frame->config['index'] = $index;
						$image_frame->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                      = $index + 1;
						//get attribs
						$doc   = new DOMDocument();
						$aData = array();
						$iData = array();
						$doc->loadHTML( '<?xml encoding="UTF-8">' . stripslashes( $match[5] ) );
						$anchor = $doc->getElementsByTagName( 'a' );
						$image  = $doc->getElementsByTagName( 'img' );
						//get anchor data
						foreach ( $anchor as $node ) {
							if ( $node->hasAttributes() ) {
								foreach ( $node->attributes as $a ) {
									
									if ( $a->name == 'href' ) {
										$aData[ 'lightbox_image' ] = $a->value;
									} else if ( $a->name == 'data-caption' ) {
										$aData[ 'alt' ] = $a->value;
									} else {
										$aData[ $a->name ] = $a->value;
									}
								}
							}
							
							$aData[ 'lightbox' ] = 'yes';
						}
						//get image data
						foreach ( $image as $node ) {
							if ( $node->hasAttributes() ) {
								foreach ( $node->attributes as $a ) {
									$iData[ $a->name ] = $a->value;
								}
							}
						}
						//combine data
						$attribs = array_merge( $iData, $aData );

						$image_frame = fotofly_fn_Core_Reversal::prepare_image_frame( $attribs, $image_frame );
						if ( ! is_null( $parent ) ) {
							$image_frame->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $image_frame->element_to_array() );

						return array( 'id' => $image_frame->config['id'] );

						break;
					
					case 'menu_anchor':

						$menu_anchor                  = new fotofly_fn_MenuAnchor();
						$menu_anchor->config['index'] = $index;
						$menu_anchor->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$menu_anchor                  = fotofly_fn_Core_Reversal::prepare_menu_anchor( $attribs, $menu_anchor );
						if ( ! is_null( $parent ) ) {
							$menu_anchor->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $menu_anchor->element_to_array() );

						return array( 'id' => $menu_anchor->config['id'] );

						break;

					case 'modal':

						$modal                  = new fotofly_fn_Modal();
						$modal->config['index'] = $index;
						$modal->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  = $index + 1;
						$attribs                = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     = stripslashes( $match[5] );
						$modal                  = fotofly_fn_Core_Reversal::prepare_modal( $attribs, $modal );
						if ( ! is_null( $parent ) ) {
							$modal->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $modal->element_to_array() );

						return array( 'id' => $modal->config['id'] );

						break;

					case 'person':

						$person_box                  = new fotofly_fn_Person();
						$person_box->config['index'] = $index;
						$person_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$person_box                  = fotofly_fn_Core_Reversal::prepare_person( $attribs, $person_box );
						if ( ! is_null( $parent ) ) {
							$person_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $person_box->element_to_array() );

						return array( 'id' => $person_box->config['id'] );

						break;
						
					case 'call_to_action_fn':

						$call_to_action_fn_box                  = new fotofly_fn_CallToAction();
						$call_to_action_fn_box->config['index'] = $index;
						$call_to_action_fn_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$call_to_action_fn_box                  = fotofly_fn_Core_Reversal::prepare_call_to_action_fn( $attribs, $call_to_action_fn_box );
						if ( ! is_null( $parent ) ) {
							$call_to_action_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $call_to_action_fn_box->element_to_array() );

						return array( 'id' => $call_to_action_fn_box->config['id'] );

						break;
						
					case 'hover_width':

						$hover_width_box                  = new fotofly_fn_HoverWidth();
						$hover_width_box->config['index'] = $index;
						$hover_width_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$hover_width_box                  = fotofly_fn_Core_Reversal::prepare_hover_width( $attribs, $hover_width_box );
						if ( ! is_null( $parent ) ) {
							$hover_width_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $hover_width_box->element_to_array() );

						return array( 'id' => $hover_width_box->config['id'] );

						break;
						
					case 'img_after_before':

						$img_after_before_box                  = new fotofly_fn_ImgAfterBefore();
						$img_after_before_box->config['index'] = $index;
						$img_after_before_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$img_after_before_box                  = fotofly_fn_Core_Reversal::prepare_img_after_before( $attribs, $img_after_before_box );
						if ( ! is_null( $parent ) ) {
							$img_after_before_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $img_after_before_box->element_to_array() );

						return array( 'id' => $img_after_before_box->config['id'] );

						break;
					
					case 'flipbox_fn':

						$flipbox_fn_box                  = new fotofly_fn_FlipboxFn();
						$flipbox_fn_box->config['index'] = $index;
						$flipbox_fn_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$flipbox_fn_box                  = fotofly_fn_Core_Reversal::prepare_flipbox_fn( $attribs, $flipbox_fn_box );
						if ( ! is_null( $parent ) ) {
							$flipbox_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $flipbox_fn_box->element_to_array() );

						return array( 'id' => $flipbox_fn_box->config['id'] );

						break;
						
					case 'button_fn':

						$button_fn_box                  = new fotofly_fn_ButtonFn();
						$button_fn_box->config['index'] = $index;
						$button_fn_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$button_fn_box                  = fotofly_fn_Core_Reversal::prepare_button_fn( $attribs, $button_fn_box );
						if ( ! is_null( $parent ) ) {
							$button_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $button_fn_box->element_to_array() );

						return array( 'id' => $button_fn_box->config['id'] );

						break;	
					case 'testimonial_single':

						$testimonial_single_box                  	= new fotofly_fn_TestimonialSingle();
						$testimonial_single_box->config['index'] 	= $index;
						$testimonial_single_box->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index                       				= $index + 1;
						$attribs                     				= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          				= stripslashes( $match[5] );
						$testimonial_single_box                  	= fotofly_fn_Core_Reversal::prepare_testimonial_single( $attribs, $testimonial_single_box );
						if ( ! is_null( $parent ) ) {
							$testimonial_single_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $testimonial_single_box->element_to_array() );

						return array( 'id' => $testimonial_single_box->config['id'] );

						break;
						
						
					case 'servicetab_single':

						$servicetab_single_box                  	= new fotofly_fn_ServiceTabSingle();
						$servicetab_single_box->config['index'] 	= $index;
						$servicetab_single_box->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index                       				= $index + 1;
						$attribs                     				= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          				= stripslashes( $match[5] );
						$servicetab_single_box                  	= fotofly_fn_Core_Reversal::prepare_servicetab_single( $attribs, $servicetab_single_box );
						if ( ! is_null( $parent ) ) {
							$servicetab_single_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $servicetab_single_box->element_to_array() );

						return array( 'id' => $servicetab_single_box->config['id'] );

						break;
						
					case 'call_to_action_classic_fn':

						$call_to_action_fn_box                  = new fotofly_fn_CallToActionClassic();
						$call_to_action_fn_box->config['index'] = $index;
						$call_to_action_fn_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$call_to_action_fn_box                  = fotofly_fn_Core_Reversal::prepare_call_to_action_classic_fn( $attribs, $call_to_action_fn_box );
						if ( ! is_null( $parent ) ) {
							$call_to_action_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $call_to_action_fn_box->element_to_array() );

						return array( 'id' => $call_to_action_fn_box->config['id'] );

						break;
						
					case 'contact_info':

						$contact_info_box                  	= new fotofly_fn_ContactInfo();
						$contact_info_box->config['index'] 	= $index;
						$contact_info_box->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index								= $index + 1;
						$attribs                     		= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          		= stripslashes( $match[5] );
						$contact_info_box                  	= fotofly_fn_Core_Reversal::prepare_contact_info( $attribs, $contact_info_box );
						if ( ! is_null( $parent ) ) {
							$contact_info_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $contact_info_box->element_to_array() );

						return array( 'id' => $contact_info_box->config['id'] );

						break;
						
					case 'about_me_fn':

						$about_me_box                  = new fotofly_fn_AboutMe();
						$about_me_box->config['index'] = $index;
						$about_me_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$about_me_box                  = fotofly_fn_Core_Reversal::prepare_about_me( $attribs, $about_me_box );
						if ( ! is_null( $parent ) ) {
							$about_me_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $about_me_box->element_to_array() );

						return array( 'id' => $about_me_box->config['id'] );

						break;
						
					case 'social_list_fn':

						$social_list_box                  = new fotofly_fn_SocialList();
						$social_list_box->config['index'] = $index;
						$social_list_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$social_list_box                  = fotofly_fn_Core_Reversal::prepare_social_list( $attribs, $social_list_box );
						if ( ! is_null( $parent ) ) {
							$social_list_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $social_list_box->element_to_array() );

						return array( 'id' => $social_list_box->config['id'] );

						break;
					
					case 'instagram_fn':

						$instagram_box                  = new fotofly_fn_Instagram();
						$instagram_box->config['index'] = $index;
						$instagram_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       	= $index + 1;
						$attribs                     	= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          	= stripslashes( $match[5] );
						$instagram_box                  = fotofly_fn_Core_Reversal::prepare_instagram( $attribs, $instagram_box );
						if ( ! is_null( $parent ) ) {
							$instagram_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $instagram_box->element_to_array() );

						return array( 'id' => $instagram_box->config['id'] );

						break;
						
					case 'halfimage':

						$person_box                  = new fotofly_fn_HalfImage();
						$person_box->config['index'] = $index;
						$person_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$person_box                  = fotofly_fn_Core_Reversal::prepare_halfimage( $attribs, $person_box );
						if ( ! is_null( $parent ) ) {
							$person_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $person_box->element_to_array() );

						return array( 'id' => $person_box->config['id'] );

						break;
						
					case 'coverbox':

						$coverbox                  	 = new fotofly_fn_Coverbox();
						$coverbox->config['index'] 	 = $index;
						$coverbox->config['id']    	 = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$coverbox                    = fotofly_fn_Core_Reversal::prepare_coverbox( $attribs, $coverbox );
						if ( ! is_null( $parent ) ) {
							$coverbox->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $coverbox->element_to_array() );

						return array( 'id' => $coverbox->config['id'] );

						break;
						
					case 'tdcontent':

						$coverbox                  	 = new fotofly_fn_TDContent();
						$coverbox->config['index'] 	 = $index;
						$coverbox->config['id']    	 = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$coverbox                    = fotofly_fn_Core_Reversal::prepare_tdcontent( $attribs, $coverbox );
						if ( ! is_null( $parent ) ) {
							$coverbox->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $coverbox->element_to_array() );

						return array( 'id' => $coverbox->config['id'] );

						break;
						
					case 'comparison':

						$comparison                  = new fotofly_fn_Comparison();
						$comparison->config['index'] = $index;
						$comparison->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']          = stripslashes( $match[5] );
						$comparison                  = fotofly_fn_Core_Reversal::prepare_comparison( $attribs, $comparison );
						if ( ! is_null( $parent ) ) {
							$comparison->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $comparison->element_to_array() );

						return array( 'id' => $comparison->config['id'] );

						break;
						
					
					case 'hotspots':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_hotspot_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$hotspots                  = new fotofly_fn_Hotspot( $attribs['addmore'] );
						$hotspots->config['index'] = $index;
						$hotspots->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                           = $index + 1;
						$hotspots                  = fotofly_fn_Core_Reversal::prepare_hotspot( $attribs, $hotspots );
						if ( ! is_null( $parent ) ) {
							$hotspots->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $hotspots->element_to_array() );

						return array( 'id' => $hotspots->config['id'] );

						break;
						
					case 'workstep':

						$fotofly_fn_box                  = new fotofly_fn_WorkStep();
						$fotofly_fn_box->config['index'] = $index;
						$fotofly_fn_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']             = stripslashes( $match[5] );
						$fotofly_fn_box                  = fotofly_fn_Core_Reversal::prepare_workstep( $attribs, $fotofly_fn_box );
						if ( ! is_null( $parent ) ) {
							$fotofly_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $fotofly_fn_box->element_to_array() );

						return array( 'id' => $fotofly_fn_box->config['id'] );

						break;	
					
					
					case 'service':

						$fotofly_fn_box                  = new fotofly_fn_Service();
						$fotofly_fn_box->config['index'] = $index;
						$fotofly_fn_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']           = stripslashes( $match[5] );
						$fotofly_fn_box                  = fotofly_fn_Core_Reversal::prepare_service( $attribs, $fotofly_fn_box );
						if ( ! is_null( $parent ) ) {
							$fotofly_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $fotofly_fn_box->element_to_array() );

						return array( 'id' => $fotofly_fn_box->config['id'] );

						break;
						
					case 'servicepack':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_servicepack_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$fotofly_fn_box                  	= new fotofly_fn_Servicepack( $attribs['addmore'] );
						$fotofly_fn_box->config['index'] 	= $index;
						$fotofly_fn_box->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index                        	= $index + 1;
						$fotofly_fn_box                 	= fotofly_fn_Core_Reversal::prepare_servicepack( $attribs, $fotofly_fn_box );
						if ( ! is_null( $parent ) ) {
							$fotofly_fn_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $fotofly_fn_box->element_to_array() );

						return array( 'id' => $fotofly_fn_box->config['id'] );

						break;
					
					/*case 'popover':
				
					$popover 									= new fotofly_fn_Popover();
					$popover->config['index'] 					= $index;
					$popover->config['id'] 						= fotofly_fn_Core_Reversal::GUID();
					$index										= $index + 1;
					$attribs									= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$attribs['trigger_content']					= $match[5];
					$popover									= fotofly_fn_Core_Reversal::prepare_popover( $attribs, $popover );
					if ( !is_null( $parent ) ) { $popover->config['parentId'] = $parent; }
					array_push( fotofly_fn_Core_Reversal::$elements , $popover->element_to_array() );
					return array( 'id' => $popover->config['id'] );
				
				break;*/
					/*case 'pricing_table':
					
					$pricing_table 								= new fotofly_fn_PricingTable();
					$pricing_table->config['index'] 			= $index;
					$pricing_table->config['id'] 				= fotofly_fn_Core_Reversal::GUID();
					$index										= $index + 1;
					$attribs									= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$pricing_table								= fotofly_fn_Core_Reversal::prepare_pricing_table( $attribs, $pricing_table );
					if ( !is_null( $pricing_table ) ) { $pricing_table->config['parentId'] = $parent; }
					array_push( fotofly_fn_Core_Reversal::$elements , $pricing_table->element_to_array() );
					return array( 'id' => $pricing_table->config['id'] );
				
				break;*/
					case 'progress':

						$progress_bar                  = new fotofly_fn_ProgressBar();
						$progress_bar->config['index'] = $index;
						$progress_bar->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']            = stripslashes( $match[5] );
						$progress_bar                  = fotofly_fn_Core_Reversal::prepare_progress_bar( $attribs, $progress_bar );
						if ( ! is_null( $parent ) ) {
							$progress_bar->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $progress_bar->element_to_array() );

						return array( 'id' => $progress_bar->config['id'] );

						break;
						
					case 'recent_posts':

						$recent_posts                  = new fotofly_fn_RecentPosts();
						$recent_posts->config['index'] = $index;
						$recent_posts->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$recent_posts                  = fotofly_fn_Core_Reversal::prepare_recent_posts( $attribs, $recent_posts );
						if ( ! is_null( $parent ) ) {
							$recent_posts->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $recent_posts->element_to_array() );

						return array( 'id' => $recent_posts->config['id'] );

						break;
						
					case 'fullpage_gallery':

						$fullpage_gallery                  	= new fotofly_fn_FullPageGallery();
						$fullpage_gallery->config['index'] 	= $index;
						$fullpage_gallery->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index                          	= $index + 1;
						$attribs                        	= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$fullpage_gallery                  	= fotofly_fn_Core_Reversal::prepare_fullpage_gallery( $attribs, $fullpage_gallery );
						if ( ! is_null( $parent ) ) {
							$fullpage_gallery->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $fullpage_gallery->element_to_array() );

						return array( 'id' => $fullpage_gallery->config['id'] );

						break;
						
					case 'cuspost_parallax':

						$cuspost_parallax                  	= new fotofly_fn_CustompostParallax();
						$cuspost_parallax->config['index'] 	= $index;
						$cuspost_parallax->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index                          	= $index + 1;
						$attribs                        	= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$cuspost_parallax                  	= fotofly_fn_Core_Reversal::prepare_cuspost_parallax( $attribs, $cuspost_parallax );
						if ( ! is_null( $parent ) ) {
							$cuspost_parallax->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $cuspost_parallax->element_to_array() );

						return array( 'id' => $cuspost_parallax->config['id'] );

						break;
						
					case 'portfolio_custom':

						$gallery_block                  = new fotofly_fn_PortfolioCustom();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_portfolio_custom( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'custompost_ribbon':

						$gallery_block                  = new fotofly_fn_CustompostRibbon();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_custompost_ribbon( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'custompost_carousel':

						$gallery_block                  = new fotofly_fn_CustompostCarousel();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_custompost_carousel( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'custompost_carousel_two':

						$gallery_block                  = new fotofly_fn_CustompostCarouselTwo();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_custompost_carousel_two( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'multi_scroll':

						$gallery_block                  = new fotofly_fn_MultiScroll();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_multi_scroll( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'cortex_slider':

						$gallery_block                  = new fotofly_fn_CortexSlider();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_cortex_slider( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;	
						
					case 'cuspostcat_folder':

						$gallery_block                  = new fotofly_fn_CustompostCategoryFolder();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_cuspostcat_folder( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'cuspostcat_modern':

						$gallery_block                  = new fotofly_fn_CustompostCategoryModern();
						$gallery_block->config['index'] = $index;
						$gallery_block->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$gallery_block                  = fotofly_fn_Core_Reversal::prepare_cuspostcat_modern( $attribs, $gallery_block );
						if ( ! is_null( $parent ) ) {
							$gallery_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $gallery_block->element_to_array() );

						return array( 'id' => $gallery_block->config['id'] );

						break;
						
					case 'project_slider':

						$project_slider                  = new fotofly_fn_ProjectSlider();
						$project_slider->config['index'] = $index;
						$project_slider->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                          = $index + 1;
						$attribs                        = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$project_slider                  = fotofly_fn_Core_Reversal::prepare_project_slider( $attribs, $project_slider );
						if ( ! is_null( $parent ) ) {
							$project_slider->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $project_slider->element_to_array() );

						return array( 'id' => $project_slider->config['id'] );

						break;
					
						
					case 'rev_slider':

						$revolution                  = new fotofly_fn_RevolutionSlider();
						$revolution->config['index'] = $index;
						$revolution->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                       = $index + 1;
						$attribs                     = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$revolution                  = fotofly_fn_Core_Reversal::prepare_rev_slider( $attribs, $revolution );
						if ( ! is_null( $parent ) ) {
							$revolution->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $revolution->element_to_array() );

						return array( 'id' => $revolution->config['id'] );

						break;
					case 'section_separator':

						$section_sep                  = new fotofly_fn_SectionSeparator();
						$section_sep->config['index'] = $index;
						$section_sep->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$section_sep                  = fotofly_fn_Core_Reversal::prepare_section_separator( $attribs, $section_sep );
						if ( ! is_null( $parent ) ) {
							$section_sep->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $section_sep->element_to_array() );

						return array( 'id' => $section_sep->config['id'] );

						break;
					case 'separator':

						$separator                  = new fotofly_fn_Separator();
						$separator->config['index'] = $index;
						$separator->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                      = $index + 1;
						$attribs                    = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$separator                  = fotofly_fn_Core_Reversal::prepare_separator( $attribs, $separator );
						if ( ! is_null( $parent ) ) {
							$separator->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $separator->element_to_array() );

						return array( 'id' => $separator->config['id'] );

						break;
					case 'sharing':

						$sharing_box                  = new fotofly_fn_SharingBox();
						$sharing_box->config['index'] = $index;
						$sharing_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$sharing_box                  = fotofly_fn_Core_Reversal::prepare_sharing_box( $attribs, $sharing_box );
						if ( ! is_null( $parent ) ) {
							$sharing_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $sharing_box->element_to_array() );

						return array( 'id' => $sharing_box->config['id'] );

						break;
					case 'slider':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_slider_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$slider                  = new fotofly_fn_Slider( $attribs['addmore'] );
						$slider->config['index'] = $index;
						$slider->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                   = $index + 1;
						$slider                  = fotofly_fn_Core_Reversal::prepare_slider( $attribs, $slider );
						if ( ! is_null( $parent ) ) {
							$slider->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $slider->element_to_array() );

						return array( 'id' => $slider->config['id'] );

						break;
					case 'soundcloud':
						$sound_cloud                  = new fotofly_fn_SoundCloud();
						$sound_cloud->config['index'] = $index;
						$sound_cloud->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$sound_cloud                  = fotofly_fn_Core_Reversal::prepare_sound_cloud( $attribs, $sound_cloud );
						if ( ! is_null( $parent ) ) {
							$sound_cloud->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $sound_cloud->element_to_array() );

						return array( 'id' => $sound_cloud->config['id'] );


						break;
					case 'social_links':
						$social_links                  = new fotofly_fn_SocialLinks();
						$social_links->config['index'] = $index;
						$social_links->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$social_links                  = fotofly_fn_Core_Reversal::prepare_social_links( $attribs, $social_links );
						if ( ! is_null( $parent ) ) {
							$social_links->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $social_links->element_to_array() );

						return array( 'id' => $social_links->config['id'] );
						break;
					
					case 'fotofly_fn_tabs':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_tabs_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$tabs                  = new fotofly_fn_Tabs( $attribs['addmore'] );
						$tabs->config['index'] = $index;
						$tabs->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                 = $index + 1;
						$tabs                  = fotofly_fn_Core_Reversal::prepare_tabs( $attribs, $tabs );
						if ( ! is_null( $parent ) ) {
							$tabs->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $tabs->element_to_array() );

						return array( 'id' => $tabs->config['id'] );

						break;
						
					case 'accordion':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_accordion_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$accordion                  = new fotofly_fn_Accordion( $attribs['addmore'] );
						$accordion->config['index'] = $index;
						$accordion->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                 		= $index + 1;
						$accordion                  = fotofly_fn_Core_Reversal::prepare_accordion( $attribs, $accordion );
						if ( ! is_null( $parent ) ) {
							$accordion->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $accordion->element_to_array() );

						return array( 'id' => $accordion->config['id'] );

						break;
						
					case 'service_carousel':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_service_carousel_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$service_carousel                  	= new fotofly_fn_ServiceCarousel( $attribs['addmore'] );
						$service_carousel->config['index'] 	= $index;
						$service_carousel->config['id']    	= fotofly_fn_Core_Reversal::GUID();
						$index                 				= $index + 1;
						$service_carousel                 	= fotofly_fn_Core_Reversal::prepare_service_carousel( $attribs, $service_carousel );
						if ( ! is_null( $parent ) ) {
							$service_carousel->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $service_carousel->element_to_array() );

						return array( 'id' => $service_carousel->config['id'] );

						break;
						
					case 'toggle':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_toggle_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$toggle                  = new fotofly_fn_Toggle( $attribs['addmore'] );
						$toggle->config['index'] = $index;
						$toggle->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                 		= $index + 1;
						$toggle                  = fotofly_fn_Core_Reversal::prepare_toggle( $attribs, $toggle );
						if ( ! is_null( $parent ) ) {
							$toggles->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $toggle->element_to_array() );

						return array( 'id' => $toggle->config['id'] );

						break;
						
					case 'expandable':
						$expandable                  = new fotofly_fn_Expandable();
						$expandable->config['index'] = $index;
						$expandable->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  	 = $index + 1;
						$attribs                	 = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     	 = stripslashes( $match[5] );
						$expandable                  = fotofly_fn_Core_Reversal::prepare_expandable( $attribs, $expandable );
						if ( ! is_null( $parent ) ) {
							$intro->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $expandable->element_to_array() );

						return array( 'id' => $expandable->config['id'] );
						break;
						
					case 'servicetabs':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_servicetabs_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$servicetabs                  = new fotofly_fn_Servicetabs( $attribs['addmore'] );
						$servicetabs->config['index'] = $index;
						$servicetabs->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                 		  = $index + 1;
						$servicetabs                  = fotofly_fn_Core_Reversal::prepare_servicetabs( $attribs, $servicetabs );
						if ( ! is_null( $parent ) ) {
							$servicetabs->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $servicetabs->element_to_array() );

						return array( 'id' => $servicetabs->config['id'] );

						break;
					
					case 'countdown':
						$countdown                  = new fotofly_fn_Countdown();
						$countdown->config['index'] = $index;
						$countdown->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  	 = $index + 1;
						$attribs                	 = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     	 = stripslashes( $match[5] );
						$countdown                  = fotofly_fn_Core_Reversal::prepare_countdown( $attribs, $countdown );
						if ( ! is_null( $parent ) ) {
							$intro->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $countdown->element_to_array() );

						return array( 'id' => $countdown->config['id'] );
						break;
						
					case 'tagline_box':
						$tagline_box                  = new fotofly_fn_TaglineBox();
						$tagline_box->config['index'] = $index;
						$tagline_box->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$attribs                      = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']           = stripslashes( $match[5] );
						$tagline_box                  = fotofly_fn_Core_Reversal::prepare_tagline_box( $attribs, $tagline_box );
						if ( ! is_null( $parent ) ) {
							$tagline_box->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $tagline_box->element_to_array() );

						return array( 'id' => $tagline_box->config['id'] );
						break;
					case 'testimonials':

						$attribs = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs = fotofly_fn_Core_Reversal::get_testimonials_child_attrib( $match, $attribs );
						foreach ( $attribs['addmore'] as $am_key => $am_value ) {
							foreach ( $am_value as $am_actual_key => $am_actual_value ) {
								if ( $am_actual_value == null ) {
									$attribs['addmore'][ $am_key ][ $am_actual_key ] = '';
								}
							}
						}
						$testimonial                  = new fotofly_fn_Testimonial( $attribs['addmore'] );
						$testimonial->config['index'] = $index;
						$testimonial->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                        = $index + 1;
						$testimonial                  = fotofly_fn_Core_Reversal::prepare_testimonials( $attribs, $testimonial );
						if ( ! is_null( $parent ) ) {
							$testimonial->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $testimonial->element_to_array() );

						return array( 'id' => $testimonial->config['id'] );

						break;
				

					case 'custom_title':
						$title                  = new fotofly_fn_CustomTitle();
						$title->config['index'] = $index;
						$title->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  = $index + 1;
						$attribs                = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     = stripslashes( $match[5] );
						$title                  = fotofly_fn_Core_Reversal::prepare_custom_title( $attribs, $title );
						if ( ! is_null( $parent ) ) {
							$title->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $title->element_to_array() );

						return array( 'id' => $title->config['id'] );
						break;
						
					case 'main_title':
						$title                  = new fotofly_fn_MainTitle();
						$title->config['index'] = $index;
						$title->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  = $index + 1;
						$attribs                = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     = stripslashes( $match[5] );
						$title                  = fotofly_fn_Core_Reversal::prepare_main_title( $attribs, $title );
						if ( ! is_null( $parent ) ) {
							$title->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $title->element_to_array() );

						return array( 'id' => $title->config['id'] );
						break;
						
					case 'custom_link':
						$title                  = new fotofly_fn_CustomLink();
						$title->config['index'] = $index;
						$title->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  = $index + 1;
						$attribs                = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     = stripslashes( $match[5] );
						$title                  = fotofly_fn_Core_Reversal::prepare_custom_link( $attribs, $title );
						if ( ! is_null( $parent ) ) {
							$title->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $title->element_to_array() );

						return array( 'id' => $title->config['id'] );
						break;
					
					case 'intro':
						$intro                  = new fotofly_fn_Intro();
						$intro->config['index'] = $index;
						$intro->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  = $index + 1;
						$attribs                = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     = stripslashes( $match[5] );
						$intro                  = fotofly_fn_Core_Reversal::prepare_intro( $attribs, $intro );
						if ( ! is_null( $parent ) ) {
							$intro->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $intro->element_to_array() );

						return array( 'id' => $intro->config['id'] );
						break;
					
					/*case 'tooltip':
					$tooltip		 					= new fotofly_fn_Tooltip();
					$tooltip->config['index'] 			= $index;
					$tooltip->config['id'] 				= fotofly_fn_Core_Reversal::GUID();
					$index								= $index + 1;
					$attribs							= fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$attribs['content']					= stripslashes( $match[5] );
					$tooltip							= fotofly_fn_Core_Reversal::prepare_tooltip( $attribs, $tooltip );
					if ( !is_null( $parent ) ) { $tooltip->config['parentId'] = $parent; }
					array_push( fotofly_fn_Core_Reversal::$elements , $tooltip->element_to_array() );
					return array( 'id' => $tooltip->config['id'] );
				break;*/
					case 'vimeo':

						$vimeo                  = new fotofly_fn_Vimeo();
						$vimeo->config['index'] = $index;
						$vimeo->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                  = $index + 1;
						$attribs                = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']     = stripslashes( $match[5] );
						$vimeo                  = fotofly_fn_Core_Reversal::prepare_vimeo( $attribs, $vimeo );
						if ( ! is_null( $parent ) ) {
							$vimeo->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $vimeo->element_to_array() );

						return array( 'id' => $vimeo->config['id'] );
						break;
					case 'featured_products_slider':

						$featured_woo_slider                  = new fotofly_fn_WooFeatured();
						$featured_woo_slider->config['index'] = $index;
						$featured_woo_slider->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                                = $index + 1;
						$attribs                              = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']                   = stripslashes( $match[5] );
						$featured_woo_slider                  = fotofly_fn_Core_Reversal::prepare_featured_products_slider( $attribs, $featured_woo_slider );

						if ( ! is_null( $parent ) ) {
							$featured_woo_slider->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $featured_woo_slider->element_to_array() );

						return array( 'id' => $featured_woo_slider->config['id'] );
						break;
					case 'products_slider':

						$woo_carousel                  = new fotofly_fn_WooCarousel();
						$woo_carousel->config['index'] = $index;
						$woo_carousel->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']            = stripslashes( $match[5] );
						$woo_carousel                  = fotofly_fn_Core_Reversal::prepare_products_slider( $attribs, $woo_carousel );

						if ( ! is_null( $parent ) ) {
							$woo_carousel->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $woo_carousel->element_to_array() );

						return array( 'id' => $woo_carousel->config['id'] );
						break;
					case 'youtube':
						$youtube                  = new fotofly_fn_Youtube();
						$youtube->config['index'] = $index;
						$youtube->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                    = $index + 1;
						$attribs                  = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']       = stripslashes( $match[5] );
						$youtube                  = fotofly_fn_Core_Reversal::prepare_youtube( $attribs, $youtube );
						if ( ! is_null( $parent ) ) {
							$youtube->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $youtube->element_to_array() );

						return array( 'id' => $youtube->config['id'] );
						break;
					case 'fotofly_fn_text':
						$text_block                                    = new fotofly_fn_frenifyText();
						$text_block->config['index']                   = $index;
						$text_block->config['id']                      = fotofly_fn_Core_Reversal::GUID();
						$index                                         = $index + 1;
						$text_block->config['subElements'][0]['value'] = stripslashes( $match[5] );
						if ( ! is_null( $parent ) ) {
							$text_block->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $text_block->element_to_array() );

						return array( 'id' => $text_block->config['id'] );
						break;
					case 'frenifyslider':

						$frenifyslider                  = new fotofly_fn_frenifySlider();
						$frenifyslider->config['index'] = $index;
						$frenifyslider->config['id']    = fotofly_fn_Core_Reversal::GUID();
						$index                         = $index + 1;
						$attribs                       = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						$attribs['content']            = stripslashes( $match[5] );
						$frenifyslider                  = fotofly_fn_Core_Reversal::prepare_frenifyslider( $attribs, $frenifyslider );

						if ( ! is_null( $parent ) ) {
							$frenifyslider->config['parentId'] = $parent;
						}
						array_push( fotofly_fn_Core_Reversal::$elements, $frenifyslider->element_to_array() );

						return array( 'id' => $frenifyslider->config['id'] );
						break;
				}

			}

			/**
			 * Assign attributes from short-code to builder elements. (Generic function)
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function assign_attr_to_elements_generic( $attribs, $element ) {

				$elements = count( $element->config['subElements'] );
				$attribs  = array_values( $attribs );
				for ( $i = 0; $i < $elements; $i ++ ) {
					$element->config['subElements'][ $i ]['value'] = $attribs[ $i ];
				}

				return $element;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_checklist_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				if ( is_array( $matches ) && count( $matches ) > 0 ) {
					foreach ( $matches as $match ) {

						$child_attr         = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
						if ( isset( $child_attr['icon'] ) ) {
							$child_attr['icon'] = frenifyCore_Plugin::font_awesome_name_handler( $child_attr['icon'] );
							array_push( $array, array( $child_attr['icon'], stripslashes( $match[5] ) ) );
						}

					}

				} else {

					preg_match_all( '#<li>\s?(.*)\s?<\/li>#', $match[5], $matches );
					foreach ( $matches[1] as $li ) {
						array_push( $array, array( '', stripslashes( $li ) ) );
					}

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_clients_slider_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					array_push( $array, array(
						$child_attr['link'],
						$child_attr['linktarget'],
						$child_attr['image'],
						$child_attr['alt']
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			public static function get_client_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['link'],
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_content_boxes_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr         = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$child_attr['icon'] = frenifyCore_Plugin::font_awesome_name_handler( $child_attr['icon'] );

					array_push( $array, array(
						$child_attr['title'],
						$child_attr['icon'],
						$child_attr['backgroundcolor'],
						$child_attr['iconcolor'],
						$child_attr['circlecolor'],
						$child_attr['circlebordercolor'],
						$child_attr['circlebordersize'],
						$child_attr['outercirclebordercolor'],
						$child_attr['outercirclebordersize'],
						$child_attr['iconrotate'],
						$child_attr['iconspin'],
						$child_attr['image'],
						$child_attr['image_width'],
						$child_attr['image_height'],
						$child_attr['link'],
						$child_attr['linktext'],
						$child_attr['linktarget'],
						stripslashes( $match[5] ),
						$child_attr['animation_type'],
						$child_attr['animation_direction'],
						$child_attr['animation_speed']
					) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_counter_circle_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {


					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['value'],
						$child_attr['filledcolor'],
						$child_attr['unfilledcolor'],
						$child_attr['size'],
						$child_attr['scales'],
						$child_attr['countdown'],
						$child_attr['speed'],
						stripslashes( $match[5] )
					) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_counter_box_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr         = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$child_attr['icon'] = frenifyCore_Plugin::font_awesome_name_handler( $child_attr['icon'] );
					array_push( $array, array(
						$child_attr['value'],
						$child_attr['start'],
						$child_attr['speed'],
						stripslashes( $match[5] )
					) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_brochure_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr         = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					array_push( $array, array(
						$child_attr['link'],
						$child_attr['icon'],
						stripslashes( $match[5] )
					) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			/*public static function get_flip_boxes_child_attrib( $match, $attribs ) {

				$matches = null;

				$array = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {
					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$match[5]   = stripslashes( $match[5] );

					$child_attr['icon'] = frenifyCore_Plugin::font_awesome_name_handler( $child_attr['icon'] );

					array_push( $array, array(
						$child_attr['title_front'],
						$child_attr['title_back'],
						stripslashes( $child_attr['text_front'] ),
						stripslashes( $match[5] ),
						$child_attr['background_color_front'],
						$child_attr['title_front_color'],
						$child_attr['text_front_color'],
						$child_attr['background_color_back'],
						$child_attr['title_back_color'],
						$child_attr['text_back_color'],
						$child_attr['border_size'],
						$child_attr['border_color'],
						$child_attr['border_radius'],
						$child_attr['icon'],
						$child_attr['icon_color'],
						$child_attr['circle'],
						$child_attr['circle_color'],
						$child_attr['circle_border_color'],
						$child_attr['icon_rotate'],
						$child_attr['icon_spin'],
						$child_attr['image'],
						$child_attr['image_width'],
						$child_attr['image_height'],
						$child_attr['animation_type'],
						$child_attr['animation_direction'],
						$child_attr['animation_speed']
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}*/

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_carousel_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['link'],
						$child_attr['linktarget'],
						$child_attr['image'],
						$child_attr['alt']
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_gallery_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_supersized_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_kenburns_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_flexslider_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_unit_info_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_category_column_portfolio_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['cat_slug'],
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_category_column_gallery_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['cat_slug'],
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_about_slider_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_service_list_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['url'],
						$child_attr['title'],
						$child_attr['fn_content'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_wotoslider_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
						$child_attr['title'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_flowgallery_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );

					array_push( $array, array(
						$child_attr['image'],
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_slider_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$match[5]   = stripslashes( $match[5] );

					if ( ! isset( $child_attr['type'] ) ) {
						$child_attr['type'] = 'image';
					}

					if ( $child_attr['type'] == 'image' ) {

						array_push( $array, array(
							$child_attr['type'],
							$match[5],
							$child_attr['link'],
							$child_attr['linktarget'],
							$child_attr['lightbox'],
							null
						) );

					} elseif ( $child_attr['type'] == 'video' ) {

						array_push( $array, array( $child_attr['type'], null, null, null, null, $match[5] ) );

					}

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_tabs_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					
					
					
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( $child_attr['title'], $match[5] ) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_hotspot_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					
					
					
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( 
						$child_attr['top'],
						$child_attr['left'],
						$child_attr['bgcolor'],
						$child_attr['textcolor'],
						$child_attr['tooltip'],
						$child_attr['position'],
						$child_attr['title'], 
						$match[5] 
					) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_servicepack_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					
					
					
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( 
						$child_attr['title'],
						$child_attr['price'], 
						$match[5] 
					) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_accordion_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					
					
					
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( $child_attr['title'], $child_attr['open'], $match[5] ) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_service_carousel_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					
					
					
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( $child_attr['title'], $child_attr['image'], $child_attr['price_text'], $child_attr['price'], $match[5] ) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_toggle_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					
					
					
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( $child_attr['title'], $match[5] ) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_servicetabs_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$match[5]   = stripslashes( $match[5] );

					array_push( $array, array( $child_attr['title'], $child_attr['subtitle'], $child_attr['image'], $child_attr['price_text'], $child_attr['price'],  $match[5] ) );

				}

				$attribs['addmore'] = $array;

				return $attribs;
			}

			/**
			 * Extract attributes from child short-code.
			 *
			 * @since 2.0
			 *
			 * @param String $match
			 * @param Array  $attribs
			 *
			 * @return Array $attribs
			 */
			public static function get_testimonials_child_attrib( $match, $attribs ) {

				$matches = null;
				$array   = array();

				preg_match_all( '/' . fotofly_fn_Core_Reversal::get_shortcode_regex() . '/s', $match[5], $matches, PREG_SET_ORDER );

				foreach ( $matches as $match ) {

					$child_attr = fotofly_fn_Core_Reversal::shortcode_parse_atts( stripslashes( $match[3] ) );
					$match[5]   = stripslashes( $match[5] );

					if ( isset( $child_attr['gender'] ) ) {
						$avatar = $child_attr['gender'];
					} else {
						$avatar = $child_attr['avatar'];
					}

					array_push( $array, array(
						$child_attr['image'],
						$child_attr['name'],
						$child_attr['occupation'],
						/*$child_attr['avatar'],
						$child_attr['image'],
						$child_attr['image_border_radius'],
						$child_attr['company'],
						$child_attr['link'],
						$child_attr['target'],*/
						$match[5]
					) );
				}

				$attribs['addmore'] = $array;

				return $attribs;
			}
			
			
			

			

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_full_width( $attribs, $element ) {

				foreach ( $element->config['subElements'] as $key => $array ) {
					if ( isset( $attribs[ $array['id'] ] ) ) {
						// We have some data manipulation arguments
						if ( isset( $element->config['subElements'][ $key ]['data'] ) ) {
							if ( isset( $element->config['subElements'][ $key ]['data']['replace'] ) ) {
								$attribs[ $array['id'] ] = str_replace( $element->config['subElements'][ $key ]['data']['replace'], '', $attribs[ $array['id'] ] );
							}
							if ( isset( $element->config['subElements'][ $key ]['data']['append'] ) ) {
								if ( strpos( $attribs[ $array['id'] ], $element->config['subElements'][ $key ]['data']['append'] ) !== false ) {
									$attribs[ $array['id'] ] = str_replace( $element->config['subElements'][ $key ]['data']['append'], '', $attribs[ $array['id'] ] );
								}
							}
						}
						// Checking for allowed values
						if ( isset( $element->config['subElements'][ $key ]['allowedValues'] ) ) {
							foreach ( $element->config['subElements'][ $key ]['allowedValues'] as $k => $v ) {
								if ( $attribs[ $array['id'] ] == $k ) {
									$element->config['subElements'][ $key ]['value'] = $attribs[ $array['id'] ];
								}
							}
						} else {
							$element->config['subElements'][ $key ]['value'] = $attribs[ $array['id'] ];
						}
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_alert_fn( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'type';
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'accent_color';
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'background_color';
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'border_size';
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'box_shadow':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'animation_type';
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'animation_direction';
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'animation_speed';
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class';
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id';
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'content';
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_wp_fn_blog( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 'layout':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;							

						case 'cat_slug';
							$element->config['subElements'][1]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats';
							$element->config['subElements'][2]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;	
							
						case 'button_text':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;	
							
						case 'button_url':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_top';
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom';
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'class';
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'id';
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_wp_button( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'link';
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'color';
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'size';
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'type';
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'shape';
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'target';
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'title';
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'content';
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'gradient_colors';
							$grad_colors = explode( "|", $attribs[ $key ] );

							if ( isset( $grad_colors[0] ) ) {
								$element->config['subElements'][8]['value'] = $grad_colors[0];
							} else {
								$element->config['subElements'][8]['value'] = '';
							}
							if ( isset( $grad_colors[1] ) ) {
								$element->config['subElements'][9]['value'] = $grad_colors[1];
							} else {
								$element->config['subElements'][9]['value'] = '';
							}
							break;

						case 'gradient_hover_colors';
							$hover_colors = explode( "|", $attribs[ $key ] );
							if ( isset( $hover_colors[0] ) ) {
								$element->config['subElements'][10]['value'] = $hover_colors[0];
							} else {
								$element->config['subElements'][10]['value'] = '';
							}
							if ( isset( $hover_colors[1] ) ) {
								$element->config['subElements'][11]['value'] = $hover_colors[1];
							} else {
								$element->config['subElements'][11]['value'] = '';
							}
							break;

						case 'accent_color';
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'accent_hover_color';
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'bevel_color';
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'border_width';
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

						case 'icon';
							$element->config['subElements'][16]['value'] = frenifyCore_Plugin::font_awesome_name_handler( $attribs[ $key ] );
							break;

						case 'icon_position';
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;

						case 'icon_divider';
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;

						case 'modal';
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;

						case 'animation_type';
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;

						case 'animation_direction';
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;

						case 'animation_speed';
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;

						case 'alignment';
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;

						case 'class';
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;

						case 'id';
							$element->config['subElements'][25]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_checklist( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'icon':
							$element->config['subElements'][0]['value'] = frenifyCore_Plugin::font_awesome_name_handler( $attribs[ $key ] );
							break;

						case 'iconcolor':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'circle':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'circlecolor':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'size':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				//print_r($element);
				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_client( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'client_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'client_col':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'client_color':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'client_opacity':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_client_slider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'picture_size':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_code_block( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'content':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_content_boxes( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'settings_lvl':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'layout':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'columns':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'icon_align':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'title_size':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'title_color':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'body_color':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'backgroundcolor':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'icon_circle':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'icon_circle_radius':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'iconcolor':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'circlecolor':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'circlebordercolor':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'circlebordersize':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'outercirclebordercolor':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'outercirclebordersize':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

						case 'icon_size':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;

						case 'icon_hover_type':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;

						case 'link_type':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;

						case 'link_area':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;

						case 'link_target':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;

						case 'animation_delay':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;

						case 'animation_type':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;

						case 'animation_direction':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;

						case 'animation_speed':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;

						case 'margin_top':
							$element->config['subElements'][25]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][26]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][27]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][28]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_counter_circle( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'class':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_counter_box( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						case 'columns':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						case 'margin_top':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						case 'margin_bottom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_brochure( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'margin_top':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						case 'margin_bottom':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			/*public static function prepare_wp_drop_Cap($attribs, $element ){
			
			foreach( $attribs as $key => $value ) {
				switch ( $key ) {
					
					case 'color':
						$element->config['subElements'][1]['value'] = $attribs[$key];
					break;
					
					case 'boxed':
						$element->config['subElements'][2]['value'] = $attribs[$key];
					break;
					
					case 'boxed_radius':
						$element->config['subElements'][3]['value'] = $attribs[$key];
					break;
					
					case 'class':
						$element->config['subElements'][4]['value'] = $attribs[$key];
					break;
					
					case 'id':
						$element->config['subElements'][5]['value'] = $attribs[$key];
					break;
				}
			}
			return $element;
		}*/

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_post_slider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						case 'layout':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'excerpt':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'category':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'limit':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'lightbox':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_flip_boxes( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'columns':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_wp_font_awesmoe( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						case 'icon':
							$element->config['subElements'][0]['value'] = frenifyCore_Plugin::font_awesome_name_handler( $attribs[ $key ] );
							break;

						case 'circle':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'size':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'iconcolor':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'circlecolor':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'circlebordercolor':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'rotate':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'spin':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'animation_type':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'animation_direction':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'animation_speed':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'alignment':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_wp_google_map( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						case 'address':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;

						case 'type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'map_style':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'overlay_color':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'infobox':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'infobox_background_color':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'infobox_text_color':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'infobox_content':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'icon':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

						case 'width':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'height':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'zoom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'scrollwheel':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'scale':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'zoom_pancontrol':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'animation':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'popup':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			/*public static function prepare_wp_high_light($attrubs, $element){
			
			foreach( $attribs as $key => $value ) {
				
				switch ( $key ) {
					case 'color':
						$element->config['subElements'][0]['value'] = $attribs[$key];
					break;
					
					case 'rounded':
						$element->config['subElements'][1]['value'] = $attribs[$key];
					break;
					
					case 'content':
						$element->config['subElements'][2]['value'] = $attribs[$key];
					break;
					
					case 'class':
						$element->config['subElements'][3]['value'] = $attribs[$key];
					break;
					
					case 'id':
						$element->config['subElements'][4]['value'] = $attribs[$key];
					break;
				}
			}
			return $element;
		}*/
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_image_frame( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'lightbox':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'lightbox_image':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;							

						case 'style_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'hover_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'bordercolor':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'bordersize':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'borderradius':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'stylecolor':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'align':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'link':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'linktarget':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'animation_type':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'animation_direction':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'animation_speed':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

						case 'hide_on_mobile':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;

						case 'src':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'alt':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_carousel( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'picture_size':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'hover_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'autoplay':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'columns':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'column_spacing':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'scroll_items':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;							

						case 'show_nav':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'mouse_scroll':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'border':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'lightbox':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_gallery( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						/*case 'slide_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;*/
						
						case 'slide_autoplay':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						/*case 'slide_reverse':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;*/
							
						case 'slide_speed':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_supersized( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'purchase_button':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
						case 'slide_interval':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_kenburns( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'purchase_button':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
						case 'slide_interval':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_flexslider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'purchase_button':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'slide_interval':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_unit_info( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'title':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'descr':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						
						case 'link_url':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'link_text':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 't_color':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'd_color':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'l_color':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'l_bgcolor':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_category_column_portfolio( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'margin_top':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_category_column_gallery( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'margin_top':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_about_slider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'img_pos':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'slide_interval':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						
						case 'autoplay':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'a_content':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'link_text':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'link_url':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_service_list( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'cols':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'number':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_wotoslider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'purchase_button':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						case 'title_switch':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						case 'thumb_switch':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;	
						case 'slide_interval':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						
						case 'autoplay':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_flowgallery( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'layout':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
						case 'purchase_button':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;	
						case 'img_title':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;	
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_hotspot( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						
						case 'image':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_servicepack( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						
						case 'image':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'duration':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'totalcost':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'booking':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_layerslider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						case 'id':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_light_box( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'href':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'src':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'alt':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'title':
						case 'data-title':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'data-caption':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_menu_anchor( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						case 'name':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_modal( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'button_text':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'button_hover':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'button_size':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'opening_effect':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'title':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'content':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_service( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'image':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'title':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'subtitle':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'content':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_person( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'name':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'occ':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'image':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						
						case 'content':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'text_align':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						
						// Social Icons
						case 'email':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						case 'facebook':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
						case 'twitter':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
						case 'instagram':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
						case 'google':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
						case 'linkedin':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
						case 'vimeo':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
						case 'youtube':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
						case 'flickr':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
						case 'skype':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
						case 'tumblr':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;
						case 'dribbble':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;
						case 'pinterest':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;
						case 'vkontakte':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
						case '500px':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;
						case 'odnoklassniki':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;
						

						case 'margin_top':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_call_to_action_fn( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'border_radius':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'bggrad_direction':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'bgcolor':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'bggrad_from_color':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'bggrad_to_color':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						
						case 'name':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'link_url':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'link_target':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
						
						case 'color':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
							
						case 'padding_top':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
						
						// default
						case 'margin_top':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_hover_width( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'fn_content':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'link_url':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						
						case 'link_text':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'img1':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'img2':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'img3':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'img4':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'img5':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
							
						case 'padding_top':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
						
						// default
						case 'margin_top':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_img_after_before( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'orientation':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'after_text':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'before_text':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'after_img':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						
						case 'before_img':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
						
						// default
						case 'padding_top':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
						case 'margin_top':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_flipbox_fn( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'hover_effect_direction':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'content_position':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'border_radius':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_type_front':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'bg_color_front':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_gr_degree_front':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						
						case 'bg_gr_start_front':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_gr_end_front':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_img_front':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'title_front':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
							
						case 'title_color_front':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
							
						case 'content_front':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
							
						case 'content_color_front':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_type_back':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'bg_color_back':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_gr_degree_back':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;
						
						case 'bg_gr_start_back':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_gr_end_back':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_img_back':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
							
						case 'title_back':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;
							
						case 'title_color_back':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;
							
						case 'content_back':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;
							
						case 'content_color_back':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;
							
						case 'link_url_back':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;
							
						case 'link_text_back':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;
							
						case 'link_color_back':
							$element->config['subElements'][25]['value'] = $attribs[ $key ];
							break;
							
						// default options
						case 'padding_top':
							$element->config['subElements'][26]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][27]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][28]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][29]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][30]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][31]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_button_fn( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'text':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'url':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'target':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						
						case 'type':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_type':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'size':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'animation_switch':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'gradient_direction':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'border_radius':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'alignment':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
							
						case 'text_color':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_color':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
							
						case 'border_color':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
							
						case 'grad_start_color':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
							
						case 'grad_end_color':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
							
						case 'arrow_color':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;
							
						case 'text_color_hover':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;
							
						case 'bg_color_hover':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;
							
						case 'border_color_hover':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
							
						case 'grad_start_color_hover':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;
							
						case 'grad_end_color_hover':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;
							
						case 'arrow_color_hover':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;
							
						// default
						case 'margin_top':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][25]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_testimonial_single( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'layout':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'name':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'occupation':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'image':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
						
						case 'content_fn':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'rating':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						// default
						case 'padding_top':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
						case 'margin_top':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_servicetab_single( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'img_pos':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'subtitle':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'image':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
						
						case 'price_text':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'price':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'fn_content':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						// default
						case 'padding_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
						case 'margin_top':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_call_to_action_classic_fn( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'title':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'subtitle':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						
						case 'link_text':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'link_url':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'link_borrad':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'link_target':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						
						case 'title_color':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'subtitle_color':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'link_color':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'padding_top':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'padding_bottom':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
						
						// default
						case 'margin_top':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_contact_info( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'email_text':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'email_own':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						
						case 'email_url':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'call_text':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'call_number':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						
						// default
						case 'margin_top':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'padding_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'padding_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_about_me( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'image_position':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'image':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'name':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						
						case 'occupation':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'info_title':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						
						case 'content':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
						
						case 'info_button_text':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'info_button_url':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'info_button_target':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
						
						// Social Icons
						case 'email':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
						case 'facebook':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
						case 'twitter':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
						case 'instagram':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
						case 'google':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
						case 'linkedin':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;
						case 'vimeo':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;
						case 'youtube':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;
						case 'flickr':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
						case 'skype':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;
						case 'tumblr':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;
						case 'dribbble':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;
						case 'vkontakte':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;
						case '500px':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;
						case 'odnoklassniki':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;
						case 'pinterest':
							$element->config['subElements'][25]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][26]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][27]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][28]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][29]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_social_list( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'name':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						
						// Social Icons
						case 'email':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						case 'facebook':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						case 'twitter':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
						case 'instagram':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
						case 'google':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
						case 'linkedin':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
						case 'vimeo':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
						case 'youtube':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
						case 'flickr':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
						case 'skype':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
						case 'tumblr':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
						case 'dribbble':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
						case 'vkontakte':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
						case '500px':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;
						case 'odnoklassniki':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;
						case 'pinterest':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_instagram( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'username':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
						
						case 'linktext':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'linktarget':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'subtext':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'images_only':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'margin_top':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_halfimage( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'image_position':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'image':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'title':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						
						case 'content':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'link_text':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'link_url':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'link_target':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_workstep( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'step':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'title':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'content':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_coverbox( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						
						
						case 'template':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'skin':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'width':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'position':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'text_align':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'content':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'margin_top':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_tdcontent( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'content':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'text_align':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'color':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			
			
			
			
			
			public static function prepare_comparison( $attribs, $element ) {


				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'img1':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'img2':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'image_size':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'orientation':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'before':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
						
						case 'after':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			/*public static function prepare_popover( $attribs, $element ) {
			
			foreach( $attribs as $key => $value ) {
				
				switch ( $key ) {
					
					case 'title':
						$element->config['subElements'][0]['value'] = $attribs[$key];
					break;
					
					case 'title_bg_color':
						$element->config['subElements'][1]['value'] = $attribs[$key];
					break;
					
					case 'content':
						$element->config['subElements'][2]['value'] = $attribs[$key];
					break;
					
					case 'content_bg_color':
						$element->config['subElements'][3]['value'] = $attribs[$key];
					break;
					
					case 'bordercolor':
						$element->config['subElements'][4]['value'] = $attribs[$key];
					break;
					
					case 'textcolor':
						$element->config['subElements'][5]['value'] = $attribs[$key];
					break;
					
					case 'trigger':
						$element->config['subElements'][6]['value'] = $attribs[$key];
					break;
					
					case 'placement':
						$element->config['subElements'][7]['value'] = $attribs[$key];
					break;
					
					case 'class':
						$element->config['subElements'][9]['value'] = $attribs[$key];
					break;
					
					case 'id':
						$element->config['subElements'][10]['value'] = $attribs[$key];
					break;
					
					case 'trigger_content':
						$element->config['subElements'][8]['value'] = $attribs[$key];
					break;
				}
			}
			return $element;
		}*/
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			/*public static function prepare_pricing_table( $attribs, $element ) {
			foreach( $attribs as $key => $value ) {
				
				switch ( $key ) {
					case 'type':
						$element->config['subElements'][0]['value'] = $attribs[$key];
					break;
					
					case 'backgroundcolor':
						$element->config['subElements'][1]['value'] = $attribs[$key];
					break;
					
					case 'bordercolor':
						$element->config['subElements'][2]['value'] = $attribs[$key];
					break;
					
					case 'dividercolor':
						$element->config['subElements'][3]['value'] = $attribs[$key];
					break;
					
					case 'class':
						$element->config['subElements'][5]['value'] = $attribs[$key];
					break;
					
					case 'id':
						$element->config['subElements'][6]['value'] = $attribs[$key];
					break;
				}
			}
			return $element;
		}*/
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_progress_bar( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'value':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'filledcolor':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;


						case 'striped':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'size':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'rounded':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'margin_top':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'content':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_recent_posts( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'post_number':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'bg':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'margin_top':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_fullpage_gallery( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'layout':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'fn_post_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;	
							
						case 'max_post_count':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][6]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			
			
				/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_cuspost_parallax( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'fn_post_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;	
							
						case 'max_post_count':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][6]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_portfolio_custom( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'fn_post_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'layout':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][2]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
						
						case 'button_text':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
						
						case 'button_url':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_custompost_ribbon( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'fn_post_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'max_post_count':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][2]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_custompost_carousel( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
							
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'fn_post_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'subtitle':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'max_post_count':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][6]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][7]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][8]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_custompost_carousel_two( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
							
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'fn_post_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'subtitle':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'max_post_count':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][6]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][7]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][8]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_multi_scroll( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'fn_post_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'max_post_count':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][2]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_cortex_slider( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'fn_post_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;	
							
						case 'max_post_count':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][2]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_cuspostcat_folder( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'animation_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'fn_post_type':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'order':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_cuspostcat_modern( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {
							
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'fn_post_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;	
							
						case 'layout':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;	

						case 'cat_slug':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'order':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_project_slider( $attribs, $element ) {
				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'fn_post_type':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'max_post_count':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][3]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats':
							$element->config['subElements'][4]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'cat_slug_gallery':
							$element->config['subElements'][5]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'exclude_cats_gallery':
							$element->config['subElements'][6]['value'] = explode( ",", $attribs[ $key ] );
							break;
							
						case 'order':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;	
							
						case 'offset':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;	
						
						case 'margin_bottom':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_rev_slider( $attribs, $element ) {

				$element->config['subElements'][0]['value'] = $attribs[0];

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_section_separator( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'divider_candy':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'icon':
							$element->config['subElements'][1]['value'] = frenifyCore_Plugin::font_awesome_name_handler( $attribs[ $key ] );
							break;

						case 'icon_color':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'bordersize':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'bordercolor':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'backgroundcolor':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_separator( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'style':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'style_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'top_margin':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'top':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'bottom_margin':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'bottom':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'sep_color':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'color':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'border_size':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'icon':
							$element->config['subElements'][5]['value'] = frenifyCore_Plugin::font_awesome_name_handler( $attribs[ $key ] );
							break;

						case 'icon_circle':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'icon_circle_color':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'width':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'alignment':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;
					}
				}

				if ( isset( $attribs['top'] ) ) {
					if ( ! $attribs['bottom'] && $attribs['style'] != 'none' ) {
						$element->config['subElements'][2]['value'] = $attribs['top'];
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_sharing_box( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {

					switch ( $key ) {

						case 'tagline':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'tagline_color':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'backgroundcolor':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'title':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'link':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'description':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'icons_boxed':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'icons_boxed_radius':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'icon_colors':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'box_colors':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'tooltip_placement':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'pinterest_image':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_slider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'hover_type':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'width':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'height':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_sound_cloud( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'url':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'layout':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'comments':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'show_related':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'show_user':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'auto_play':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'color':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'width':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'height':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_social_links( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'icons_boxed':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'icons_boxed_radius':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'icon_colors':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'box_colors':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'tooltip_placement':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'rss':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;

						case 'facebook':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'twitter':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'instagram':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'dribbble':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'google':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'linkedin':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'blogger':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'tumblr':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'reddit':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'yahoo':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'deviantart':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

						case 'vimeo':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;

						case 'youtube':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;

						case 'pinterest':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;

						case 'digg':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;

						case 'flickr':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;

						case 'forrst':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;

						case 'myspace':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;

						case 'skype':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;

						case 'paypal':
							$element->config['subElements'][25]['value'] = $attribs[ $key ];
							break;

						case 'dropbox':
							$element->config['subElements'][26]['value'] = $attribs[ $key ];
							break;

						case 'soundcloud':
							$element->config['subElements'][27]['value'] = $attribs[ $key ];
							break;

						case 'vk':
							$element->config['subElements'][28]['value'] = $attribs[ $key ];
							break;

						case 'email':
							$element->config['subElements'][29]['value'] = $attribs[ $key ];
							break;

						case 'show_custom':
							$element->config['subElements'][30]['value'] = $attribs[ $key ];
							break;

						case 'alignment':
							$element->config['subElements'][31]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][32]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][33]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_tabs( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 'layout':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'skin':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'position':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_accordion( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_service_carousel( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
							
						case 'margin_top':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_toggle( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_servicetabs( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'position':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'tabs_position':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_tagline_box( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						case 'backgroundcolor':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'shadow':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'shadowopacity':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'border':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'bordercolor':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'highlightposition':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'content_alignment':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'link':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'linktarget':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'modal':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'button_size':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'button_type':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'button_shape':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'buttoncolor':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;

						case 'button':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'title':
							$element->config['subElements'][15]['value'] = $attribs[ $key ];
							break;

						case 'description':
							$element->config['subElements'][16]['value'] = $attribs[ $key ];
							break;

						case 'content':
							$element->config['subElements'][17]['value'] = $attribs[ $key ];
							break;

						case 'margin_top':
							$element->config['subElements'][18]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_bottom':
							$element->config['subElements'][19]['value'] = $attribs[ $key ];
							break;							

						case 'animation_type':
							$element->config['subElements'][20]['value'] = $attribs[ $key ];
							break;

						case 'animation_direction':
							$element->config['subElements'][21]['value'] = $attribs[ $key ];
							break;

						case 'animation_speed':
							$element->config['subElements'][22]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][23]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][24]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_testimonials( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						case 'class':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'addmore':
							break;

					}
				}

				return $element;
			}


			

			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_custom_title( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 'content':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'titletype':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'texttransform':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'textalign':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'textcolor':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_bottom':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_main_title( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 't_layout':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'title':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'subtitle':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'descr':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 't_color':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 's_color':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'd_color':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_bottom':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
						
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_custom_link( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {
						
						case 'content':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
						
						case 'url':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'alignment':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'transform':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'color':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_bottom':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;							

						case 'class':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_intro( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {						
							
						case 'main_text':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'image':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'button_text':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
						case 'button_href':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
						case 'button_hover':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'todown':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_expandable( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {						
							
						case 'skin':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'title':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'content':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}
			
			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_countdown( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {						
							
						case 'time':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;
							
						case 'date':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;
							
						case 'skin':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
							
						case 'size':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;
							
						case 'margin_top':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'margin_bottom':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

					}
				}

				return $element;
			}

			
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			/*public static function prepare_tooltip ($attribs, $element ) {
			
			foreach( $attribs as $key => $value ) {
				switch ( $key ) {
					
					case 'title':
						$element->config['subElements'][0]['value'] = $attribs[$key];
					break;
					
					case 'placement':
						$element->config['subElements'][1]['value'] = $attribs[$key];
					break;
					
					case 'content':
						$element->config['subElements'][2]['value'] = $attribs[$key];
					break;
					
					case 'class':
						$element->config['subElements'][3]['value'] = $attribs[$key];
					break;
					
					
					case 'id':
						$element->config['subElements'][0]['value'] = $attribs[$key];
					break;
					
				}
			}
			return $element;
		}*/
			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_vimeo( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'id':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'width':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'height':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'autoplay':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'api_params':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_featured_products_slider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'picture_size':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'carousel_layout':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'autoplay':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'columns':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'column_spacing':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;
							
						case 'scroll_items':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;								

						case 'navigation':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;

						case 'mouse_scroll':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;

						case 'show_cats':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'show_price':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'show_buttons':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_products_slider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'picture_size':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'cat_slug':
							$element->config['subElements'][1]['value'] = explode( ",", $attribs[ $key ] );
							break;

						case 'number_posts':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'carousel_layout':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'autoplay':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'columns':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;

						case 'column_spacing':
							$element->config['subElements'][6]['value'] = $attribs[ $key ];
							break;
							
						case 'scroll_items':
							$element->config['subElements'][7]['value'] = $attribs[ $key ];
							break;								

						case 'show_nav':
							$element->config['subElements'][8]['value'] = $attribs[ $key ];
							break;

						case 'mouse_scroll':
							$element->config['subElements'][9]['value'] = $attribs[ $key ];
							break;

						case 'show_cats':
							$element->config['subElements'][10]['value'] = $attribs[ $key ];
							break;

						case 'show_price':
							$element->config['subElements'][11]['value'] = $attribs[ $key ];
							break;

						case 'show_buttons':
							$element->config['subElements'][12]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][13]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][14]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_youtube( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'id':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'width':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'height':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;

						case 'autoplay':
							$element->config['subElements'][3]['value'] = $attribs[ $key ];
							break;

						case 'api_params':
							$element->config['subElements'][4]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][5]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Assign short-code attributes to builder elements.
			 *
			 * @since 2.0
			 *
			 * @param Array $attribs
			 * @param Array $element
			 *
			 * @return Array Element
			 */
			public static function prepare_frenifyslider( $attribs, $element ) {

				foreach ( $attribs as $key => $value ) {
					switch ( $key ) {

						case 'name':
							$element->config['subElements'][0]['value'] = $attribs[ $key ];
							break;

						case 'class':
							$element->config['subElements'][1]['value'] = $attribs[ $key ];
							break;

						case 'id':
							$element->config['subElements'][2]['value'] = $attribs[ $key ];
							break;
					}
				}

				return $element;
			}

			/**
			 * Regex callback for storing builder blocks as hashed value in the content
			 *
			 * @since 2.0
			 *
			 * @param Array $matches
			 *
			 * @return String
			 */
			public static function prepare_builder_blocks( $matches ) {
				if ( in_array( $matches[2], fotofly_fn_Core_Reversal::$tags ) ) {
					fotofly_fn_Core_Reversal::$prepared_builder_blocks[ fotofly_fn_Core_Reversal::$builder_blocks_count ] = array_merge( array(), $matches ); //for backward compatibility
					$shortcode                                                                                    = '[frenify:' . fotofly_fn_Core_Reversal::$builder_blocks_count . ']';
					fotofly_fn_Core_Reversal::$builder_blocks_count ++;

					return $shortcode;
				} else {
					return $matches[0];
				}
			}

			/**
			 * Parse builder blocks and non-builder blocks correctly.
			 *
			 * @since 2.0
			 *
			 * @param String $content
			 *
			 * @return String prepared content
			 */
			public static function convert_to_builder_blocks( $content ) {
				$content = preg_replace_callback( '/' . get_shortcode_regex() . '/s', 'fotofly_fn_Core_Reversal::prepare_builder_blocks', $content );

				$split_content = preg_split( '/(\[frenify:\d+\])/s', $content, - 1, PREG_SPLIT_DELIM_CAPTURE );

				$buffer = '';

				foreach ( $split_content as $matched_content ) {
					if ( preg_match_all( '/\[frenify:(\d+)\]/s', $matched_content, $matches ) ) {
						$buffer .= trim( fotofly_fn_Core_Reversal::$prepared_builder_blocks[ $matches[1][0] ][0] );
					} else {
						if ( strlen( trim( $matched_content ) ) > 1 ) {
							if ( ! fotofly_fn_Core_Reversal::has_shortcode( $matched_content, 'fotofly_fn_text' ) ) {
								$buffer .= '[fotofly_fn_text]' . trim( $matched_content ) . '[/fotofly_fn_text]';
							}
						}
					}
				}

				return $buffer;
			}
		}
	}