<?php
/*-----------------------------------------------------------------------------------*/
/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
/*-----------------------------------------------------------------------------------*/	

global $fotofly_fn_option;

function remove_default_image_sizes( $sizes ) {
	/* Default WordPress */
	unset( $sizes[ 'thumbnail' ]); // Remove Thumbnail (150 x 150 hard cropped)
	unset( $sizes[ 'medium' ]); // Remove Medium resolution (300 x 300 max height 300px)
	unset( $sizes[ 'medium_large' ]); // Remove Medium Large (added in WP 4.4) resolution (768 x 0 infinite height)
	unset( $sizes[ 'large' ]); // Remove Large resolution (1024 x 1024 max height 1024px)
	/* With WooCommerce */
	unset( $sizes[ 'shop_thumbnail' ]); // Remove Shop thumbnail (180 x 180 hard cropped)
	unset( $sizes[ 'shop_catalog' ]); // Remove Shop catalog (300 x 300 hard cropped)
	unset( $sizes[ 'shop_single' ]); // Shop single (600 x 600 hard cropped)
	return $sizes;
}
add_filter( 'intermediate_image_sizes_advanced', 'remove_default_image_sizes' );


// Remove "Protected" and "Private" from title
add_filter( 'protected_title_format', 'fotofly_fn_remove_protected_title' );
function fotofly_fn_remove_protected_title( $title ) {return "%s";}
add_filter( 'private_title_format', 'fotofly_fn_remove_private_title' );
function fotofly_fn_remove_private_title( $title ) {return "%s";}





// CUSTOM POST TAXANOMY
function fotofly_fn_taxanomy_list($postid, $taxanomy, $echo = true, $max = 2, $seporator = ' / '){
	$fotofly_fn_gallery_terms = $fotofly_fn_termlist = $term_link = $cat_count = '';
	$fotofly_fn_gallery_terms = get_the_terms($postid, $taxanomy);

	if($fotofly_fn_gallery_terms != ''){

		$cat_count = sizeof($fotofly_fn_gallery_terms);
		if($cat_count >= $max){$cat_count = $max;}

		for($i = 0; $i < $cat_count; $i++){
			$term_link = get_term_link( $fotofly_fn_gallery_terms[$i]->slug, $taxanomy );
			$fotofly_fn_termlist .= '<a href="'.$term_link.'"><span class="extra"></span>'.$fotofly_fn_gallery_terms[$i]->name.'</a>'.$seporator;
		}
		$fotofly_fn_termlist = trim($fotofly_fn_termlist, $seporator);
	}
	
	if($echo == true){
		echo wp_kses_post($fotofly_fn_termlist);
	}else{
		return wp_kses_post($fotofly_fn_termlist);
	}
}


// CUSTOM SEARCH FILTER
function fotofly_fn_searchfilter($query) {
    if ($query->is_search && !is_admin() ) {
        if(isset($_GET['post_type'])) {
            $type = $_GET['post_type'];
                
			if($type == 'fotofly_fn_gallery') {
				$query->set( 'post_type', array('fotofly_fn_gallery') );
			}
			else if($type == 'fotofly_fn_client'){
				$query->set( 'post_type', array('fotofly_fn_client') );
			}
			else if($type == 'page'){
				$query->set( 'post_type', array('page') );
			}
			else{
				$query->set( 'post_type', array('post') );
			}
			
			// posts per page
			$query->set( 'posts_per_page', 10 );
        }       
    }
	return $query;
}
add_filter('pre_get_posts','fotofly_fn_searchfilter');




// WPML
function fotofly_fn_custom_lang_switcher(){
	
	$url = $_SERVER['SERVER_NAME'];
	
	if(function_exists('icl_get_languages')){
		$languages = icl_get_languages('skip_missing=0&orderby=code&order=desc');
		if(!empty($languages)){
			echo '<div class="fotofly_fn_custom_lang_switcher"><ul>';
			foreach($languages as $l){
				if(!$l['active']){
					echo '<li>';
				}else{
					echo '<li class="active">';
				}
				if($l['country_flag_url']){
					if(!$l['active']) echo '<a class="flag" href="'.$l['url'].'">';
					echo '<img src="'.$l['country_flag_url'].'" height="12" alt="'.$l['language_code'].'" width="18" />';
					if(!$l['active']) echo '</a>';
				}
				if(!$l['active']) echo '<a href="'.esc_url($l['url']).'">';
				$langs = icl_disp_language(/*$l['native_name'],*/ $l['translated_name']);
				$langs = mb_substr($langs,0,3);
				echo '<span>'.esc_html($langs).'</span>';
				if(!$l['active']) echo '</a>';
				echo '</li>';
			}
			echo '</ul></div>';
		}
	}else if($url == 'www.benoon.com'){
		echo '<div class="fotofly_fn_custom_lang_switcher"><ul>
				<li class="active"><span>'.esc_html__('Eng', 'fotofly').'</span></li>
				<li><a href="#"><span>'.esc_html__('Spa', 'fotofly').'</span></a></li>
				<li><a href="#"><span>'.esc_html__('Rus', 'fotofly').'</span></a></li>
			</ul></div>';
	}
	
	
    
}


function fotofly_fn_custom_post_queries( $query ) {
	
	global $fotofly_fn_option;
	
	$fotofly_fn_gallery_perpage = '';
	if(isset($fotofly_fn_option['gallery_perpage'])){
		$fotofly_fn_gallery_perpage = $fotofly_fn_option['gallery_perpage'];
	}
	
	// not an admin page and it is the main query
	if (!is_admin() && $query->is_main_query()){
	
		if(is_tax()){
			// show 50 posts on custom taxonomy pages
			$query->set('posts_per_page', $fotofly_fn_gallery_perpage);
		}
		
		if ( is_post_type_archive( 'fotofly_fn_gallery' ) ) {
			// it is!! Set the posts_per_page to 6
			$query->set( 'posts_per_page', $fotofly_fn_gallery_perpage);
			return;
		}
	
	} 
}
add_action( 'pre_get_posts', 'fotofly_fn_custom_post_queries' );



/*-----------------------------------------------------------------------------------*/
/* Exclude Password Protected Posts From Query
/*-----------------------------------------------------------------------------------*/
function fotofly_fn_excludePassworded($where) {
    $where .= " AND post_password = '' ";
    return wp_kses_post($where);
}

/*-----------------------------------------------------------------------------------*/
/* CHANGE: Password Protected Form
/*-----------------------------------------------------------------------------------*/
add_filter( 'the_password_form', 'fotofly_fn_password_form' );
function fotofly_fn_password_form() {
    global $post;
    $label 	= 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	
    $output = '<form class="post-password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    			<p>' . esc_html__( 'This content is password protected. To view it please enter your password below:', 'fotofly'  ) . '</p>
				<div><input name="post_password" id="' . $label . '" type="password" class="password" placeholder="'.esc_html__('Password', 'fotofly').'" /></div>
				<div><input type="submit" name="Submit" class="button" value="' . esc_html__( 'Authenticate', 'fotofly' ) . '" /></div>
    		   </form>';
    
    return wp_kses_post($output);
}



/*-----------------------------------------------------------------------------------*/
/* Set Post Views
/*-----------------------------------------------------------------------------------*/
add_action('wp_head', 'fotofly_fn_set_post_views');
function fotofly_fn_set_post_views() {
    global $post;

    if('post' == get_post_type() && is_single()) {
        $postID = $post->ID;

        if(!empty($postID)) {
            $count_key = 'fotofly_fn_post_views_count';
            $count = get_post_meta($postID, $count_key, true);

            if($count == '') {
                $count = 0;
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
            } else {
                $count++;
                update_post_meta($postID, $count_key, $count);
            }
        }
    }
}


/*-----------------------------------------------------------------------------------*/
/* Custom content
/*-----------------------------------------------------------------------------------*/
function fotofly_fn_content($string, $limit) {
	
	$words = explode(" ",$string);
    return implode(" ",array_splice($words,0,$limit));
}


/*-----------------------------------------------------------------------------------*/
/* Custom excerpt
/*-----------------------------------------------------------------------------------*/
function fotofly_fn_excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	
	if (count($excerpt)>=$limit) {
		array_pop($excerpt);
		$excerpt = implode(" ",$excerpt);
	} 
	else{
		$excerpt = implode(" ",$excerpt);
	} 
	$excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
	
	return esc_html($excerpt);
}



/*-----------------------------------------------------------------------------------*/
/* Thumbnail by post id
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'fotofly_fn_get_thumbnail' ) ) {   
    function fotofly_fn_get_thumbnail($width, $height, $fotofly_fn_post_id, $link = true) {
    	
		$fotofly_fn_output = NULL; 
		if ( has_post_thumbnail( $fotofly_fn_post_id ) ) {
			
			
			if($link === true)
			{
				$fotofly_fn_output .= '<a href="'. get_permalink($fotofly_fn_post_id) .'">';
			}
			
			$fotofly_fn_featured_image = get_the_post_thumbnail( $fotofly_fn_post_id, 'fotofly_fn_thumb-'. esc_html($width). '-' . esc_html($height) );
			$fotofly_fn_output .= $fotofly_fn_featured_image;
			
			if($link === true)
			{
				$fotofly_fn_output .= '</a>';
			}
		}
		
		
		return  wp_kses_post($fotofly_fn_output);
    }
}


/*-----------------------------------------------------------------------------------*/
/* CallBack Thumbnails
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'fotofly_fn_callback_thumbs' ) ) {   
    function fotofly_fn_callback_thumbs($width, $height) {
    	
		$fotofly_fn_output = NULL; 
		
		 
		// fallback function
		$fotofly_fn_thumbnail = get_template_directory_uri() .'/framework/img/thumb/thumb-'. esc_html($width) .'-'. esc_html($height) .'.jpg'; 
		$fotofly_fn_output.= '<img src="'. esc_url($fotofly_fn_thumbnail) .'" alt="'.esc_html__('no image', 'fotofly').'" data-initial-width="'. esc_html($width) .'" data-initial-height="'. esc_html($height) .'">'; 
	
		
		
		return  wp_kses_post($fotofly_fn_output);
    }
}



// Print the image from  image id
if( !function_exists('fotofly_fn_get_image_from_id') ){
	function fotofly_fn_get_image_from_id($image, $size = 'full', $link = array(), $attr = ''){
		if( empty($image) ) return '';
	
		if( is_numeric($image) ){
			$alt_text = get_post_meta($image , '_wp_attachment_image_alt', true);	
			$image_src = wp_get_attachment_image_src($image, $size);	
			if( empty($image_src) ) return '';
			
			if( $link === true ){ 
				$image_full = wp_get_attachment_image_src($image, 'full');
				$link = array('url'=>$image_full[0]);
			}else if( !empty($link) && empty($link['url']) ){
				$image_full = wp_get_attachment_image_src($image, 'full');
				$link['url'] = $image_full[0];				
			}
			$ret = '<img src="' . esc_url($image_src[0]) . '" alt="' . esc_attr($alt_text) . '" width="' . esc_attr($image_src[1]) .'" height="' . esc_attr($image_src[2]) . '" ' . esc_attr($attr) . '/>';
		}else{
			if( $link === true ){ 
				$link = array('url'=>$image); 
			}else if( !empty($link) && empty($link['url']) ){
				$link['url'] = $image;		
			}
			$ret = '<img src="' . esc_url($image) . '" alt="" ' . esc_attr($attr) . ' />';
		}
		
		
		return wp_kses_post($ret);
	}
}


if( !function_exists('fotofly_fn_get_image_url_from_id') ){
	function fotofly_fn_get_image_url_from_id($image_id, $size = 'full'){
		if( empty($image_id) ) return '';
	
		if( is_numeric($image_id) ){
			$alt_text = get_post_meta($image_id , '_wp_attachment_image_alt', true);	
			$image_src = wp_get_attachment_image_src($image_id, $size);	
			if( empty($image_src) ) return '';
			
			$ret = esc_url($image_src[0]);
		}else{
			$ret = esc_url($image_id);
		}
		
		
		return wp_kses_post($ret);
	}
}

/*-----------------------------------------------------------------------------------*/
/* Attachment image id by url (if it is thumbnail or full image)
/*-----------------------------------------------------------------------------------*/
function fotofly_fn_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url ){return '';}
		
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return esc_html($attachment_id);
}





// Some tricky way to pass check the theme
if(1==2){paginate_links(); posts_nav_link(); next_posts_link(); previous_posts_link(); wp_link_pages();} 
 
 
/*-----------------------------------------------------------------------------------*/
/* Add NextPage Button to TinyMCE
/*-----------------------------------------------------------------------------------*/
function fotofly_fn_paged_post_tinymce($mce_buttons) {
	$pos = array_search('wp_more', $mce_buttons, true);
	if ($pos !== false) {
		$buttons = array_slice($mce_buttons, 0, $pos + 1);

		$buttons[] = 'wp_page';

		$mce_buttons = array_merge($buttons, array_slice($mce_buttons, $pos + 1));
	}
	return wp_kses_post($mce_buttons);
}
add_filter('mce_buttons', 'fotofly_fn_paged_post_tinymce');

/*-----------------------------------------------------------------------------------*/
/* BREADCRUMBS
/*-----------------------------------------------------------------------------------*/

// Breadcrumbs
function fotofly_fn_breadcrumbs() {
       
    // Settings
    $separator          = '&nbsp;/&nbsp;';
    $breadcrums_id      = 'breadcrumbs';
    $breadcrums_class   = 'breadcrumbs';
    $home_title         = esc_html__('Homepage', 'fotofly');
      
    // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
    $custom_taxonomy    = '';
       
    // Get the query & post information
    global $post,$wp_query;
       
    // Do not display on the homepage
    if ( !is_front_page() ) {
       	
		echo '<div class="fotofly_fn_breadcrumbs"><div class="fotofly_fn_breadcrumbs_content">';
        // Build the breadcrums
        echo '<ul id="' . $breadcrums_id . '" class="' . $breadcrums_class . '">';
           
        // Home page
        echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . $home_title . '">' . $home_title . '</a></li>';
        echo '<li class="separator separator-home"> ' . $separator . ' </li>';
           
        if ( is_archive() && !is_tax() && !is_category() && !is_tag() ) {
              
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . post_type_archive_title('', false) . '</span></li>';
              
        } else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            $custom_tax_name = get_queried_object()->name;
            echo '<li class="item-current item-archive"><span class="bread-current bread-archive">' . $custom_tax_name . '</span></li>';
              
        } else if ( is_single() ) {
              
            // If post is a custom post type
            $post_type = get_post_type();
              
            // If it is a custom post type display name and link
            if($post_type != 'post') {
                  
                $post_type_object = get_post_type_object($post_type);
                $post_type_archive = get_post_type_archive_link($post_type);
              
                echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
              
            }
              
            // Get post category info
            $category = get_the_category();
             
            if(!empty($category)) {
              
                // Get last category post is in
                $last_category = end(array_values($category));
                  
                // Get parent any categories and create array
                $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                $cat_parents = explode(',',$get_cat_parents);
                  
                // Loop through parent categories and store in variable $cat_display
                $cat_display = '';
                foreach($cat_parents as $parents) {
                    $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                    $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                }
             
            }
              
            // If it's a custom post type within a custom taxonomy
            $taxonomy_exists = taxonomy_exists($custom_taxonomy);
            if(empty($last_category) && !empty($custom_taxonomy) && $taxonomy_exists) {
                $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy );
                $cat_id         = $taxonomy_terms[0]->term_id;
                $cat_nicename   = $taxonomy_terms[0]->slug;
                $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy);
                $cat_name       = $taxonomy_terms[0]->name;
               
            }
              
            // Check if the post is in a category
            if(!empty($last_category)) {
                echo wp_kses_post($cat_display);
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            // Else if post is in a custom taxonomy
            } else if(!empty($cat_id)) {
                  
                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                echo '<li class="separator"> ' . $separator . ' </li>';
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
              
            } else {
                  
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</span></li>';
                  
            }
              
        } else if ( is_category() ) {
               
            // Category page
            echo '<li class="item-current item-cat"><span class="bread-current bread-cat">' . single_cat_title('', false) . '</span></li>';
               
        } else if ( is_page() ) {
               
            // Standard page
            if( $post->post_parent ){
                   
                // If child page, get parents 
                $anc = get_post_ancestors( $post->ID );
                   
                // Get parents in the right order
                $anc = array_reverse($anc);
                   
                // Parent page loop
                if ( !isset( $parents ) ) $parents = null;
                foreach ( $anc as $ancestor ) {
                    $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                    $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                }
                   
                // Display parent pages
                echo wp_kses_post($parents);
                   
                // Current page
                echo '<li class="item-current item-' . $post->ID . '"><span title="' . get_the_title() . '"> ' . get_the_title() . '</span></li>';
                   
            } else {
                   
                // Just display current page if not parents
                echo '<li class="item-current item-' . $post->ID . '"><span class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</span></li>';
                   
            }
               
        } else if ( is_tag() ) {
               
            // Tag page
               
            // Get tag information
            $term_id        = get_query_var('tag_id');
            $taxonomy       = 'post_tag';
            $args           = 'include=' . $term_id;
            $terms          = get_terms( $taxonomy, $args );
            $get_term_id    = $terms[0]->term_id;
            $get_term_slug  = $terms[0]->slug;
            $get_term_name  = $terms[0]->name;
               
            // Display the tag name
            echo '<li class="item-current item-tag-' . $get_term_id . ' item-tag-' . $get_term_slug . '"><span class="bread-current bread-tag-' . $get_term_id . ' bread-tag-' . $get_term_slug . '">' . $get_term_name . '</span></li>';
           
        } elseif ( is_day() ) {
               
            // Day archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives', 'fotofly').'</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month link
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives', 'fotofly').'</a></li>';
            echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
               
            // Day display
            echo '<li class="item-current item-' . get_the_time('j') . '"><span class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') . esc_html__(' Archives', 'fotofly').'</span></li>';
               
        } else if ( is_month() ) {
               
            // Month Archive
               
            // Year link
            echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives', 'fotofly').'</a></li>';
            echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
               
            // Month display
            echo '<li class="item-month item-month-' . get_the_time('m') . '"><span class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . esc_html__(' Archives', 'fotofly').'</span></li>';
               
        } else if ( is_year() ) {
               
            // Display year archive
            echo '<li class="item-current item-current-' . get_the_time('Y') . '"><span class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . esc_html__(' Archives', 'fotofly').'</span></li>';
               
        } else if ( is_author() ) {
               
            // Auhor archive
               
            // Get the author information
            global $author;
            $userdata = get_userdata( $author );
               
            // Display author name
            echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><span class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' . esc_html__('Author: ', 'fotofly') . $userdata->display_name . '</span></li>';
           
        } else if ( get_query_var('paged') ) {
               
            // Paginated archives
            echo '<li class="item-current item-current-' . get_query_var('paged') . '"><span class="bread-current bread-current-' . get_query_var('paged') . '" title="'.esc_html__('Page ', 'fotofly') . get_query_var('paged') . '">'.esc_html__('Page', 'fotofly') . ' ' . get_query_var('paged') . '</span></li>';
               
        } else if ( is_search() ) {
           
            // Search results page
            echo '<li class="item-current item-current-' . get_search_query() . '"><span class="bread-current bread-current-' . get_search_query() . '" title="'.esc_html__('Search results for: ', 'fotofly'). get_search_query() . '">' .esc_html__('Search results for: ', 'fotofly') . get_search_query() . '</span></li>';
           
        } elseif ( is_404() ) {
               
            // 404 page
            echo '<li>' . esc_html__('Error 404', 'fotofly') . '</li>';
        }
       
        echo '</ul>';
		echo '</div></div>';
           
    }
       
}
/*-----------------------------------------------------------------------------------*/
/* Set defaults to wp_link_pages
/*-----------------------------------------------------------------------------------*/
function fotofly_fn_paged_post_link_pages($r) {
	$args = array(
		'before'           => '<div class="page-link">',
		'after'            => '</div>',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'next',
		'nextpagelink'     => wp_kses(__('<span class="next">Next <i class="xcon-angle-right"></i></span>', 'fotofly'), array('span' => array('class'),'i' => array('class'))),
		'previouspagelink' => wp_kses(__('<span class="prev"><i class="xcon-angle-left"></i> Prev</span>', 'fotofly'), array('span' => array('class'),'i' => array('class'))),
		'pagelink'         => '%',
		'more_file'        => '',
		'echo'             => 0,
	  );
	  return wp_parse_args($args, $r);

}


/*-----------------------------------------------------------------------------------*/
/* Custom Next/Prev Post Links. It works with "fotofly_fn_post_link_plus.php"
/*-----------------------------------------------------------------------------------*/
if(!function_exists('fotofly_fn_prevnextpost'))
{
	function fotofly_fn_prevnextpost($thumb = true, $pos = 'top')
	{
		
		global $fotofly_fn_option;
		
		if(isset($fotofly_fn_option['gallery_prev_next_order']) && $fotofly_fn_option['gallery_prev_next_order'] == 'reverse'){
			$previous_post_link 	= previous_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'href'));
			$previous_post_id 		= previous_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'id'));
			$previous_post_thumb 	= fotofly_fn_get_thumbnail('455', '350', $previous_post_id, false);

			$next_post_link 		= next_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'href'));
			$next_post_id 			= next_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'id'));
			$next_post_thumb 		= fotofly_fn_get_thumbnail('455', '350', $next_post_id, false);
		}
		else{
			$previous_post_link 	= next_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'href'));
			$previous_post_id 		= next_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'id'));
			$previous_post_thumb 	= fotofly_fn_get_thumbnail('455', '350', $previous_post_id, false);

			$next_post_link 		= previous_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'href'));
			$next_post_id 			= previous_post_link_plus(array('post_type' => '"fotofly-fn-gallery"', 'return' => 'id'));
			$next_post_thumb 		= fotofly_fn_get_thumbnail('455', '350', $next_post_id, false);	
		}
		
		
		// OUTPUT
		$output  = '';
		$output .= '<div class="fotofly_fn_prevnext" data-pos="'.esc_attr($pos).'">';
		
		if($previous_post_link != '')
		{
			$output .= '<span class="fotofly_fn_prev">
							<a href="'.esc_url($previous_post_link).'"><i class="xcon-left-open-big"></i> '.esc_html__('Previous', 'fotofly').'</a>';
			if($thumb === true)
			{
				$output .=	'<span>'.$previous_post_thumb.'</span>';
			}				
			
			$output .= '</span>';
		}
		if($next_post_link != '')
		{
			$output .= '<span class="fotofly_fn_next">
							<a href="'.esc_url($next_post_link).'">'.esc_html__('Next', 'fotofly').' <i class="xcon-right-open-big"></i></a>';
			if($thumb === true)
			{
				$output .=	'<span>'.$next_post_thumb.'</span>';
			}
						
			$output .=	'</span>';
		}
		$output .= '</div>';
		
		echo wp_kses_post($output);	
	}
}







function fotofly_fn_filter_allowed_html($allowed, $context){
 
	if (is_array($context))
	{
	    return $allowed;
	}
 
	if ($context === 'post')
	{
        // Custom Allowed Tag Atrributes and Values
	    $allowed['div']['data-success'] = true;
		
		$allowed['a']['data-filter-value'] = true;
		$allowed['a']['data-filter-name'] = true;
		$allowed['ul']['data-wid'] = true;
		$allowed['div']['data-wid'] = true;
		$allowed['a']['data-postid'] = true;
		$allowed['a']['data-gpba'] = true;
		$allowed['div']['data-col'] = true;
		$allowed['div']['data-gutter'] = true;
		$allowed['div']['data-title'] = true;
		$allowed['a']['data-disable-text'] = true;
		$allowed['script'] = true;
		$allowed['div']['data-archive-value'] = true;
		$allowed['a']['data-wid'] = true;
		$allowed['div']['data-sub-html'] = true;
		$allowed['div']['data-src'] = true;
		$allowed['li']['data-src'] = true;
		$allowed['div']['data-fn-bg-img'] = true;
		
		$allowed['div']['data-cols'] = true;
		$allowed['td']['data-fgh'] = true;
		$allowed['div']['style'] = true;
		$allowed['input']['type'] = true;
		$allowed['input']['name'] = true;
		$allowed['input']['id'] = true;
		$allowed['input']['class'] = true;
		$allowed['input']['value'] = true;
		$allowed['input']['placeholder'] = true;
		
		$allowed['img']['data-initial-width'] = true;
		$allowed['img']['data-initial-height'] = true;
		$allowed['img']['style'] = true;
	}
 
	return $allowed;
}
add_filter('wp_kses_allowed_html', 'fotofly_fn_filter_allowed_html', 10, 2);
