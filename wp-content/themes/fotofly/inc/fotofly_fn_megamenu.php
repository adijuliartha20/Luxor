<?php

/*********************
CUSTOM WALKER
*********************/  


class fotofly_fn_walker extends Walker_Nav_Menu {
    protected $fotofly_fn_menu_css = array();
	
	function display_element ($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        // check, whether there are children for the given ID and append it to the element with a (new) ID
        $element->hasChildren = isset($children_elements[$element->ID]) && !empty($children_elements[$element->ID]);
        return parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
	
	
    function start_el( &$output, $object,  $depth = 0, $args = array(), $id = 0) {
        parent::start_el( $output, $object, $depth, $args );
		

		
        $fotofly_fn_cat_menu = $object->fotofly_fn_megamenu;
        
		if ( $fotofly_fn_cat_menu == NULL ) 
		{	
        	 $fotofly_fn_cat_menu = '1'; 
        }    

        
        
        $fotofly_fn_output = $fotofly_fn_posts = $fotofly_fn_menu_featured = $fotofly_fn_has_children = $fotofly_fn_slider_output = $fotofly_fn_recent_gallery = NULL;
		
        $fotofly_fn_current_type = $object->object;
        $fotofly_fn_current_classes = $object->classes;
        
		if ( in_array('fotofly_fn_has-children', $fotofly_fn_current_classes) ) { $fotofly_fn_has_children = ' fotofly_fn_with-sub'; }


		global $fotofly_fn_option;
		$megamenucols = 'col4';
		if(isset($fotofly_fn_option['megamenu_cols'])){
			$megamenucols = $fotofly_fn_option['megamenu_cols'];
		}
		
		// START SUBMENU TYPE -------------------------------------------------------------------------------------
        
        if ( ( $fotofly_fn_cat_menu == 1) && ( $depth == 0 ) && ($object->menu_item_parent == '0' && $object->hasChildren ) ) { 
			
			$output .= '<div class="dropdown slidein fotofly_fn_sub" data-cols="'.$megamenucols.'">'; 
		}
        if ( $fotofly_fn_cat_menu == 2 && ( $object->menu_item_parent == '0' && $object->hasChildren ) ) { 
			
			$output .= '<div class="menulist slidein wide fotofly_fn_sub" data-cols="'.$megamenucols.'">'; 
		} 
		if ( $fotofly_fn_cat_menu == 3 && ( $object->menu_item_parent == '0' ) ) { 
			
			$output .= '<div class="menugallery slidein wide fotofly_fn_sub"> data-cols="'.$megamenucols.'">'; 
		} 
		
		
		
		//  ----------------------------------------------------------------------------------------- 
		if ( ( $fotofly_fn_cat_menu == 3 ) && ( $object->menu_item_parent == '0' ) ) {
			
			$fotofly_fn_page_id 	= $object->object_id;
			$fotofly_fn_menu_id 	= $object->ID;
			$fotofly_fn_query = $fotofly_fn_post_img = $buffy = $disabled = $fotofly_fn_categories = $fotofly_fn_post_cats = $term_link = $fotofly_fn_gallery_images = $count_images = $fotofly_fn_gallery_locked_content = NULL;
			
			// FEATURED GALLERY QUERY ---------------------------------------------------------------------------
			$fotofly_fn_args = array(
				'post_type' 		  => 'fotofly-fn-gallery',  
				'post_status' 		  => 'publish',  
				'posts_per_page' 	  => 4,
				'paged'				  => 1, 
				'meta_key' 			  => 'fotofly_fn_featured_in_nav', 
				'meta_value' 		  => '1',  
				'meta_compare' 		  => '==',
				'ignore_sticky_posts' => 1,
				'orderby'			  => 'date');
				
			$fotofly_fn_query 		  =  new WP_Query($fotofly_fn_args);
			
			// FALLBACK
			if($fotofly_fn_query->post_count == 0)
			{
				$fotofly_fn_args = array(
				'post_type' 		  => 'fotofly-fn-gallery',  
				'post_status' 		  => 'publish',  
				'posts_per_page' 	  => 4,
				'paged'				  => 1,
				'ignore_sticky_posts' => 1,
				'orderby'			  => 'date');
				
				$fotofly_fn_query 	  =  new WP_Query($fotofly_fn_args);
			}
			
			$fotofly_fn_post_count 	  =  $fotofly_fn_query->found_posts;
			$fotofly_fn_max_pages 	  =  $fotofly_fn_query->max_num_pages;
			
			if($fotofly_fn_max_pages == 1 || $fotofly_fn_query->found_posts == ''){$disabled = 'disabled';}
		
			global $fotofly_fn_option;
			if(isset($fotofly_fn_option)){
			
				// RECENT GALLERY LOOP -----------------------------------------------------------------------------
				foreach ( $fotofly_fn_query->posts as $fotofly_fn_gallerypost ) {
					setup_postdata( $fotofly_fn_gallerypost ); 
							
						$fotofly_fn_post_id 			= $fotofly_fn_gallerypost->ID;
						$fotofly_fn_post_img 		= fotofly_fn_get_thumbnail('455', '350', $fotofly_fn_post_id);
						$fotofly_fn_post_permalink 	= get_permalink($fotofly_fn_post_id);
						$fotofly_fn_post_cats		= fotofly_fn_taxanomy_list($fotofly_fn_post_id, 'gallery_category', 2, false);
				
						
						
						if(function_exists('rwmb_meta'))
						{
							$fotofly_fn_gallery_images 			= rwmb_meta( 'fotofly_fn_gallery_images', 'type=image&size=full', $fotofly_fn_post_id );
							
							if($fotofly_fn_gallery_images)
							{
								$count_images = sizeof($fotofly_fn_gallery_images);	
							}
							else
							{
								$count_images = 0;	
							}
						}
						
						// Check Password Protection
						if(post_password_required($fotofly_fn_gallerypost)){
							$fotofly_fn_gallery_locked_content = '<div class="fotofly_fn_locked"><div><div><span><i class="xcon-lock"></i></span></div></div></div>';	
						}
						
						 
						$buffy   				   .= '<li class="animated hideforanimation">
														<div class="gallery_cover">
															'.$fotofly_fn_gallery_locked_content.'
															<div class="img_holder">'.$fotofly_fn_post_img.'</div>
															<a href="'.$fotofly_fn_post_permalink.'" class="overlay gra"></a>
															<div class="title_holder">
																<h1><a href="'.$fotofly_fn_post_permalink.'">'.$fotofly_fn_gallerypost->post_title.'</a></h1>
																<span>'.$fotofly_fn_post_cats.'</span>
															</div>
															<div class="detail_small">
																<span>'.$count_images.'</span>
																<i class="xcon-picture"></i>
															</div>
														</div>	
														
													  </li>'; 
						
						$fotofly_fn_post_cats = $fotofly_fn_gallery_locked_content = NULL; 
				}
				wp_reset_postdata(); 
			
			}
		
			// OUTPUT -----------------------------------------------------------------------------------------
			if ( $buffy != NULL ) {
				
				$buffy = str_replace('"', "'", $buffy);
				if(function_exists('fotofly_fn_gallery_script')){
					$output .= fotofly_fn_gallery_script($buffy, 'fotofly_fn_nav_gallery_wrap', $fotofly_fn_post_count, $fotofly_fn_max_pages);
				}
			}
			
			$output .= '<div class="fotofly_fn_nav_gallery_wrap" id="fotofly_fn_nav_gallery_wrap">
							<div class="list_wrap">
								<ul class="list">';
			if ( $buffy != NULL ) {
				$output .= $buffy; 
			}else{
				$output .= '<li><span>'.esc_html__('No Gallery Posts Added','fotofly').'</span></li>';
			}
			$output .= 			'</ul>
							</div>
							<div class="pagination" data-wid="fotofly_fn_nav_gallery_wrap">
								<span>
									<a href="#" class="fotofly_fn_ajax-prev-page disabled">
										<span class="a"><i class="xcon-left-open-big"></i></span>
										<span class="b"><i class="xcon-left-open-big"></i></span>
									</a>
									<a href="#" class="fotofly_fn_ajax-next-page '.$disabled.'">
										<span class="a"><i class="xcon-right-open-big"></i></span>
										<span class="b"><i class="xcon-right-open-big"></i></span>
									</a>
								</span>
								<span class="ajax_loader"><i class="xcon-spin3 animate-spin"></i></span>
							</div>
						</div>';
		
		}
		
		
		
		// END SUBMENU TYPE -----------------------------------------------------------------------------------------
		if ( $fotofly_fn_cat_menu == 3 && ( $object->menu_item_parent == '0' ) ) { 
			$output .= '</div>';
		} 
		
		
        // -----------------------------------------------------------------------------------------
        add_action( 'wp_head', array( $this, 'fotofly_fn_menu_css' ) );

    }
	
	
	
	
	
	// -----------------------------------------------------------------------------------------
	public function fotofly_fn_menu_css() {
        
    } 

   
    // start of the sub menu wrap ----------------------------------------------------------------------------------
    function start_lvl( &$output, $depth=0, $args = array() ) {

        if ( $depth > 2 ) { return; }
        if ( $depth >= 1 )  { $output .= '<ul class="fotofly_fn_grandchild-menu">'; }
        if ( $depth == 0 )  { $output .= '<div class="sub-menu-wrap"><ul class="fotofly_fn_submenu">'; }
    }
 
    // end of the sub menu wrap ------------------------------------------------------------------------------------
    function end_lvl( &$output, $depth=0, $args = array() ) {

		if ( $depth > 2 ) { return; }
		if ( $depth == 0 ) { $output .= '</ul></div></div>'; }
		if ( $depth >= 1 ) { $output .= '</ul>'; }

    }    
}





class fotofly_fn_walker_backend extends Walker_Nav_Menu {
    function start_lvl( &$output , $depth = 0 , $args = array() ) {}

	/**
	 * @see Walker_Nav_Menu::end_lvl()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference.
	 */
	function end_lvl( &$output , $depth = 0 , $args = array() ) {}

	/**
	 * @see Walker::start_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Menu item data object.
	 * @param int $depth Depth of menu item. Used for padding.
	 * @param object $args
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );
		
		// for select type
		if (empty($item->fotofly_fn_megamenu[0])) {
            $fotofly_fn_item_megamenu = NULL;
        } else {
            $fotofly_fn_item_megamenu = esc_attr ($item->fotofly_fn_megamenu[0]);
        }
		
		
		$removed_args = array(
			'action',
			'customlink-tab',
			'edit-menu-item',
			'menu-item',
			'page-tab',
			'_wpnonce',
		);

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) )
				$original_title = false;
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			/* translators: %s: title of menu item which is invalid */
			$title = sprintf( esc_html__( '%s (Invalid)','fotofly' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			/* translators: %s: title of menu item in draft status */
			$title = sprintf( esc_html__('%s (Pending)','fotofly'), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth )
			$submenu_text = 'style="display: none;"';

		?>
        
        
        <li id="menu-item-<?php echo esc_attr($item_id); ?>" class="<?php echo implode(' ', $classes ); ?>">
            <div class="menu-item-bar">
                <div class="menu-item-handle">
                    <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span class="is-submenu" <?php echo esc_attr($submenu_text); ?>><?php esc_html_e( 'sub item' , 'fotofly'); ?></span></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up', 'fotofly'); ?>">&#8593;</abbr></a>
                            |
                            <a href="<?php
                                echo wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                );
                            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down', 'fotofly'); ?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo esc_attr($item_id); ?>" title="<?php esc_attr_e('Edit Menu Item', 'fotofly'); ?>" href="<?php
                            echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) );
                        ?>"><?php esc_html_e( 'Edit Menu Item' , 'fotofly'); ?></a>
                    </span>
                </div>
            </div>

            <div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr($item_id); ?>" style="float: left; clear: both; margin-bottom: 9px;">
                <?php if( 'custom' == $item->type ) : ?>
                    <p class="field-url description description-wide">
                        <label for="edit-menu-item-url-<?php echo esc_attr($item_id); ?>">
                            <?php esc_html_e( 'URL' , 'fotofly'); ?><br />
                            <input type="text" id="edit-menu-item-url-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                    </p>
                <?php endif; ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'Navigation Label' , 'fotofly'); ?><br />
                        <input type="text" id="edit-menu-item-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'Title Attribute' , 'fotofly' ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo esc_attr($item_id); ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr($item_id); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr($item_id); ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <?php esc_html_e( 'Open link in a new window/tab' , 'fotofly'); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'CSS Classes (optional)' , 'fotofly'); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'Link Relationship (XFN)' , 'fotofly'); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo esc_attr($item_id); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-fotofly_fn_megamenu description description-wide" style="margin:20px 0;">
                     <label for="edit-menu-item-fotofly_fn_megamenu-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Menu Type' , 'fotofly'); ?></label>
                     <select id="edit-menu-item-fotofly_fn_megamenu-<?php echo esc_attr($item_id); ?>" name="menu-item-fotofly_fn_megamenu[<?php echo esc_attr($item_id); ?>]"  class="widefat" >
                        <option value="1" <?php if (($fotofly_fn_item_megamenu == '1')|| ($fotofly_fn_item_megamenu == NULL)) echo 'selected="selected"'; ?>><?php esc_html_e('Standart', 'fotofly') ?></option>
                        <option value="2" <?php if ($fotofly_fn_item_megamenu == '2') echo 'selected="selected"'; ?>><?php esc_html_e('Mega Menu', 'fotofly') ?></option>
                       
                     </select>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo esc_attr($item_id); ?>">
                        <?php esc_html_e( 'Description' , 'fotofly'); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo esc_attr($item_id); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr($item_id); ?>]">
                            <?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php esc_html_e('The description will be displayed in the menu if the current theme supports it.' , 'fotofly'); ?></span>
                    </label>
                </p>  
                <p class="field-move hide-if-no-js description description-wide">
                    <label>
                        <span><?php esc_html_e( 'Move' , 'fotofly'); ?></span>
                        <a href="#" class="menus-move-up"><?php esc_html_e( 'Up one' , 'fotofly'); ?></a>
                        <a href="#" class="menus-move-down"><?php esc_html_e( 'Down one' , 'fotofly'); ?></a>
                        <a href="#" class="menus-move-left"></a>
                        <a href="#" class="menus-move-right"></a>
                        <a href="#" class="menus-move-top"><?php esc_html_e( 'To the top' , 'fotofly'); ?></a>
                    </label>
                </p>

                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php echo esc_html__('Original: ' , 'fotofly'); echo '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>'; ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr($item_id); ?>" href="<?php
                    echo wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            admin_url( 'nav-menus.php' )
                        ),
                        'delete-menu_item_' . $item_id
                    ); ?>"><?php esc_html_e( 'Remove' , 'fotofly'); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr($item_id); ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                        ?>#menu-item-settings-<?php echo esc_attr($item_id); ?>"><?php esc_html_e('Cancel' , 'fotofly'); ?></a>
                </div>

                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr($item_id); ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr($item_id); ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div><!-- .menu-item-settings-->
            <ul class="menu-item-transport"></ul>
		</li>
        <?php
        $output .= ob_get_clean();
    }
}





if ( ! function_exists( 'fotofly_fn_megamenu_walker' ) ) { 
    function fotofly_fn_megamenu_walker($walker) {
            if ( $walker === 'Walker_Nav_Menu_Edit' ) {
                        $walker = 'fotofly_fn_walker_backend';
                  }
           return wp_kses_post($walker);
        }
}
add_filter( 'wp_edit_nav_menu_walker', 'fotofly_fn_megamenu_walker');  





if ( ! function_exists( 'fotofly_fn_megamenu_walker_save' ) ) { 
    function fotofly_fn_megamenu_walker_save($menu_id, $menu_item_db_id) {

        if  (isset($_POST['menu-item-fotofly_fn_megamenu'][$menu_item_db_id])) {
            update_post_meta( $menu_item_db_id, '_menu_item_fotofly_fn_megamenu', $_POST['menu-item-fotofly_fn_megamenu'][$menu_item_db_id]);
        } else {
            update_post_meta( $menu_item_db_id, '_menu_item_fotofly_fn_megamenu', '1');
        }
    }
}
add_action( 'wp_update_nav_menu_item', 'fotofly_fn_megamenu_walker_save', 10, 2 );





if ( ! function_exists( 'fotofly_fn_megamenu_walker_loader' ) ) { 
    function fotofly_fn_megamenu_walker_loader($menu_item) {
		$menu_item->fotofly_fn_megamenu = get_post_meta($menu_item->ID, '_menu_item_fotofly_fn_megamenu', true);
		return $menu_item;
    }
}
add_filter( 'wp_setup_nav_menu_item', 'fotofly_fn_megamenu_walker_loader' ); 
?>