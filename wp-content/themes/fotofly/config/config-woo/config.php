<?php

function fotofly_fn_woocommerce_enabled()
{
	if ( class_exists( 'woocommerce' ) ){ return true; }
	return false;
}


add_theme_support( 'woocommerce' );

//check if the plugin is enabled, otherwise stop the script
if(!fotofly_fn_woocommerce_enabled()) { return false; }

remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action ('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

// disable core woo styles
function fotofly_fn_woo_dequeue_styles( $enqueue_styles ) {
	unset( $enqueue_styles['woocommerce-general'] ); // Remove the gloss
	unset( $enqueue_styles['woocommerce-layout'] ); // Remove the layout
	unset( $enqueue_styles['woocommerce-smallscreen'] ); // Remove the smallscreen optimisation
	return wp_kses_post($enqueue_styles);
}

// DEFAULT ACTIONS
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );			// Remove Deafult Rating
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 ); // Remove Deafult Sale


// CHANGE MAIN LAYOUT
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action( 'woocommerce_before_main_content', 'fotofly_fn_woocommerce_before_fotofly_fn_main_content' );
add_action( 'woocommerce_after_main_content', 'fotofly_fn_woocommerce_after_fotofly_fn_main_content' );



function fotofly_fn_woocommerce_before_fotofly_fn_main_content(){
	
	global $post;

	if(is_shop()) {
		$pageID = get_option('woocommerce_shop_page_id'); 
	} else {
		$pageID = get_the_ID();
	}
	
	
	$fotofly_fn_pagestyle 			= get_post_meta($pageID,'fotofly_fn_page_style', true);
	$fotofly_fn_pagetitle 			= get_post_meta($pageID,'fotofly_fn_page_title', true);
	$fotofly_fn_page_breadcrumbs 	= get_post_meta($pageID,'fotofly_fn_page_breadcrumbs', true);
	$fotofly_fn_pagetitletype 		= get_post_meta($pageID,'fotofly_fn_page_title_type', true);
	$fotofly_fn_pagetitleimg 		= get_post_meta($pageID,'fotofly_fn_page_title_img', true);
	$fotofly_fn_top_padding 		= get_post_meta($pageID,'fotofly_fn_page_padding_top', true);
	$fotofly_fn_bot_padding 		= get_post_meta($pageID,'fotofly_fn_page_padding_bottom', true);
	$fotofly_fn_parallaxspeed 		= get_post_meta($pageID,'fotofly_fn_page_parallax_speed', true)/10;
	$fotofly_fn_page_title_color 	= get_post_meta($pageID,'fotofly_fn_page_title_color', true);
	
	// page styles
	if($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'full' || $fotofly_fn_pagestyle == false){
		$fotofly_fn_x_pos = 'float-left';
	}else{
		$fotofly_fn_x_pos = 'float-right';
	}
	
	if($fotofly_fn_pagestyle == 'ls'){$fotofly_fn_last = 'last';}
	
	// title
	if($fotofly_fn_pagetitleimg != ''){
		$fotofly_fn_media = 'media';
	}else{$fotofly_fn_media = '';}

	$fotofly_fn_page_spaces = 'style=';
	if($fotofly_fn_top_padding != ''){$fotofly_fn_page_spaces .= 'padding-top:'.$fotofly_fn_top_padding.'px;';}
	if($fotofly_fn_bot_padding != ''){$fotofly_fn_page_spaces .= 'padding-bottom:'.$fotofly_fn_bot_padding.'px;';}
	if($fotofly_fn_top_padding == '' && $fotofly_fn_bot_padding == ''){$fotofly_fn_page_spaces = '';}
	
	$fotofly_fn_titlebg = wp_get_attachment_image_src($fotofly_fn_pagetitleimg, 'full'); 	// TITLE BG IMG
	
	if($fotofly_fn_pagetitletype == 'parallax'){$fotofly_fn_parallax = 'fotofly_fn_jarallax';}else{$fotofly_fn_parallax = '';}
	
	
	
	
	// Generate Proper Class
	$page_class = '';
	if(is_single()){
		$page_class = 'fotofly_fn_product_single';	
	}else if($fotofly_fn_pagestyle == 'full' || $fotofly_fn_pagestyle == false){
		$page_class = 'fotofly_fn_shop_full';
	} else if($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'ls'){
		$page_class = 'fotofly_fn_shop_withsidebar '.esc_attr($fotofly_fn_x_pos);	
	} else{
		$page_class = 'fotofly_fn_shop_full';
	}
	
	
	
	
	// content wrap
	echo '<section class="fotofly_fn_woo_wrap">';
	
	// Title Bar
	if($fotofly_fn_pagetitle != 'disable' && !is_single()){
		
			echo '<div class="fotofly_fn_content_title_wrap '.esc_attr($fotofly_fn_page_title_color.' '.$fotofly_fn_media).'">
					 <div class="fotofly_fn_page_title_wrap">
						<div class="container">';
			
						if($fotofly_fn_page_breadcrumbs !== 'disable'){fotofly_fn_breadcrumbs(); }

						echo '<div class="title_holder"><h3>';
							if(is_product()) {
								the_title();
							} else {
								woocommerce_page_title();
							}
						echo '</h3></div>';
			    echo '</div></div>';
				
				if($fotofly_fn_pagetitleimg != '') { // has media
					echo '<div class="fotofly_fn_page_title_bg_wrap">
							<div class="page_title_bg '.esc_html($fotofly_fn_parallax).'" style="background-image:url('.esc_url($fotofly_fn_titlebg[0]).');" data-speed="'.esc_attr($fotofly_fn_parallaxspeed).'"></div>
							<div class="page_title_overlay gra"></div>
						</div>';
				}
		
		echo '</div>';
		
	}
	$containerOpener = $containerCloser = '';
	if(!is_single()){
		$containerOpener = '<div class="container">';
		$containerCloser = '</div>';
	}
	// Content
	echo '<section class="fotofly_fn_main_content fotofly_fn_woo" '.esc_attr($fotofly_fn_page_spaces).'>
				<div class="'.esc_attr($page_class).'">
					<div class="fotofly_fn_woo_in">';
	echo wp_kses_post($containerOpener);
	
	// if we have sidebar
	if(($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'ls') && !is_single()){
		echo '<div class="fn-col-8 fix desc '.esc_attr($fotofly_fn_x_pos).' '.esc_attr($fotofly_fn_last).'">';
	}
}						

function fotofly_fn_woocommerce_after_fotofly_fn_main_content(){
	
	global $post;
	

	if(is_shop()) {
		$pageID = get_option('woocommerce_shop_page_id'); 
	} else {
		$pageID = get_the_ID();
	}

	$fotofly_fn_pagestyle 			= get_post_meta($pageID,'fotofly_fn_page_style', true);

	echo '</div>'; // end column
	
	
	// if we have sidebar
	if(($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'ls') && !is_single()){
		echo '</div>';
		get_sidebar();
	}
	$containerOpener = $containerCloser = '';
	if(!is_single()){
		$containerOpener = '<div class="container">';
		$containerCloser = '</div>';
	}
	echo '</div>';
	echo wp_kses_post($containerCloser);
	echo '</section>'; // end main content
	
	echo '</section>'; // end content wrapper
	
	
}




// PRODUCTS PER PAGE
add_filter('loop_shop_per_page', 'fotofly_fn_loop_shop_per_page');
function fotofly_fn_loop_shop_per_page()
{
	global $fotofly_fn_option;

	parse_str($_SERVER['QUERY_STRING'], $params);

	if(isset($fotofly_fn_option['woo_per_page']) == 1 && $fotofly_fn_option['woo_per_page']) {
		$per_page = $fotofly_fn_option['woo_per_page'];
	} else {
		$per_page = 12;
	}

	return esc_html($per_page);
}



// Removes the default post image from shop overview pages and replaces it with this image

add_action( 'woocommerce_before_shop_loop_item_title', 'fotofly_fn_woocommerce_thumbnail', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

function fotofly_fn_woocommerce_thumbnail()
{
	global $product, $fotofly_fn_option;
	if ($product->get_type() == 'bundle' ){
		$product = new WC_Product_Bundle($product->get_id());
	}
	
	$rating = $product->get_rating_html(); //get rating
	$onsale = $product->is_on_sale(); //on sale
	$permalink = get_permalink( $product->get_id() );
	
	$price = $product->get_price_html();
	$title = $product->get_title();

	$id = get_the_ID();
	
	if(isset($fotofly_fn_option['woo_product_img_grid'])){
		$productsGridType 	= $fotofly_fn_option['woo_product_img_grid'];
	}else{
		$productsGridType 	= 'square';
	}
	if($productsGridType 		== 'square'){
		$productThumb			= fotofly_fn_callback_thumbs(1000, 1000);
	}else if($productsGridType 	== 'portrait'){
		$productThumb			= fotofly_fn_callback_thumbs(800,970);
	}else if($productsGridType 	== 'landscape'){
		$productThumb			= fotofly_fn_callback_thumbs(840,570);
	}

	echo "<div class='thumbnail_container'>";
		echo wp_kses_post($productThumb);
			echo '<div class="original_img" data-fn-bg-img="'.get_the_post_thumbnail_url($id,'fotofly_fn_thumb-800-800').'"></div>';
			if($product->get_type() == 'simple') echo "<span class='cart-loading'><i class='xcon-ok'></i></span>";
			fotofly_fn_add_cart_button();
			echo "<a href='".$permalink."' class='overlay'></a>";
			if($onsale == 1){ echo "<span class='onsale'>" .esc_html__('Sale', 'fotofly') ."</span>"; }
	echo "</div>";
}

// NEW ADD TO CART BUTTON
function fotofly_fn_add_cart_button()
{
	global $product;

	if ($product->get_type() == 'bundle' ){
		$product = new WC_Product_Bundle($product->get_id());
	}

	$extraClass  = "";

	ob_start();
	woocommerce_template_loop_add_to_cart();
	$output = ob_get_clean();

	if(!empty($output))
	{
		$pos = strpos($output, ">");
		
		if ($pos !== false) {
		    $output = substr_replace($output,"><i class='xcon-basket'></i> ", $pos , strlen(1));
		}
	}
	 
	if(empty($extraClass)) $output .= "";
	
	
	if($output) echo "<div class='fotofly_fn_cart_buttons $extraClass'>$output</div>";
}

// REMOVE "ADD TO CART" TEXT FROM NEW BUTTON
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text' );
function woo_custom_cart_button_text() {
        return '';
}

// REMOVE DEAFULT "ADD TO CART" TEXT FROM PRUDUCTS ON SHOP PAGE
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);


// wrap product titles and sale number on overview pages into an extra div for improved styling options

add_action( 'woocommerce_before_shop_loop_item_title', 'fotofly_fn_shop_overview_extra_header_div', 20);
function fotofly_fn_shop_overview_extra_header_div()
{
	global $product;

	if ($product->get_type() == 'bundle' ){
		$product = new WC_Product_Bundle($product->get_id());
	}
	
	echo "<div class='title_wrap'><a class='' href='".get_permalink($product->get_id())."'>";
}

add_action( 'woocommerce_after_shop_loop_item_title',  'fotofly_fn_close_div', 1000);
function fotofly_fn_close_div()
{
	echo "</a></div>";
}

// WRAP SORTING
add_action( 'woocommerce_before_shop_loop',  'fotofly_fn_wrap_sorting', 10);
add_action( 'woocommerce_before_shop_loop',  'fotofly_fn_wrap_sorting_end', 30);
function fotofly_fn_wrap_sorting()
{
	echo "<div class='fotofly_fn_wrap_sorting'>";
}
function fotofly_fn_wrap_sorting_end()
{
	echo "</div>";
}

// WRAP BREADCRUMBS
add_action( 'woocommerce_before_main_content',  'fotofly_fn_wrap_crumb', 10);
add_action( 'woocommerce_before_shop_loop',  'fotofly_fn_wrap_crumb_end', 0);
add_action( 'woocommerce_before_single_product',  'fotofly_fn_wrap_crumb_end', 0);
function fotofly_fn_wrap_crumb()
{
	echo "<div class='fotofly_fn_wrap_crumb'>";
}
function fotofly_fn_wrap_crumb_end()
{
	echo "</div>";
}

// CHANGE BREADCRUMBS
add_filter( 'woocommerce_breadcrumb_defaults', 'fotofly_fn_woocommerce_breadcrumbs' );
function fotofly_fn_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => '<span> &#47; </span>',
            'wrap_before' => '<nav class="woocommerce-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</nav>',
            'before'      => '',
            'after'       => '',
            'home'        => esc_html__( 'Home', 'fotofly' ),
        );
}


// Single Page Changes
add_action( 'woocommerce_before_single_product_summary', 'fotofly_fn_open_product_wrap', 2);
add_action( 'woocommerce_after_single_product_summary',  'fotofly_fn_close_product_wrap', 10);
function fotofly_fn_open_product_wrap()
{
	if(!is_single()){
		echo "<div class='container'>";
	}
}

function fotofly_fn_close_product_wrap()
{
	if(!is_single()){
		echo "</div>";
	}
}


// Single Page Changes
add_action( 'woocommerce_before_single_product_summary', 'fotofly_fn_open_image_div', 2);
add_action( 'woocommerce_before_single_product_summary',  'fotofly_fn_close_image_div', 20);
function fotofly_fn_open_image_div()
{
	echo "<div class='single-product-image-wrap'>";
}

function fotofly_fn_close_image_div()
{
	echo "</div>";
}



// Single Page Changes
add_action( 'woocommerce_before_single_product_summary', 'fotofly_fn_open_summary_div', 20);
add_action( 'woocommerce_after_single_product_summary',  'fotofly_fn_close_summary_div', 0);
function fotofly_fn_open_summary_div()
{
	echo "<div class='single-product-summary-wrap'>";
}

function fotofly_fn_close_summary_div()
{
	echo "</div>";
}


remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta', 0 );

add_action( 'woocommerce_before_single_product_summary','woocommerce_breadcrumb', 20, 0);




remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
add_action( 'woocommerce_after_single_product_summary', 'fotofly_fn_woocommerce_output_related_products', 20);

function fotofly_fn_woocommerce_output_related_products()
{
	$output = "";
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
		'orderby'        => 'rand'
	);
	ob_start();
	woocommerce_related_products($defaults); 
	$content = ob_get_clean();
	if($content)
	{
		
		$output .= '<div class="clearfix"></div><div class="single_product_related_wrap">';
		$output .= $content;
		$output .= '</div>';
		echo wp_kses_post($output);
	}

}



// DISABLE PRETTY PHOTO

add_action( 'wp_enqueue_scripts', 'fotofly_fn_remove_woo_lightbox', 99 );
function fotofly_fn_remove_woo_lightbox(){
    remove_action( 'wp_head', array( $GLOBALS['woocommerce'], 'generator' ) );
        wp_dequeue_style( 'woocommerce_prettyPhoto_css' );
        wp_dequeue_script( 'prettyPhoto' );
        wp_dequeue_script( 'prettyPhoto-init' );
}

if(!function_exists('fotofly_fn_woocommerce_post_thumbnail_description'))
{
	function fotofly_fn_woocommerce_post_thumbnail_description($img, $post_id)
	{
		global $post, $woocommerce, $product;

		if(has_post_thumbnail())
		{
			$image_title = esc_attr(get_post_field('post_title', get_post_thumbnail_id()));
			$image_link  = wp_get_attachment_url( get_post_thumbnail_id() );
			$image  = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
				'title' => $image_title
				) );
			$attachment_count = count( $product->get_gallery_attachment_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			return sprintf( '<a href="%s" class="woocommerce-main-image zoom" title="%s" >%s</a>', $image_link, $image_title, $image);
		}

		return wp_kses_post($img);
	}
}

if(!function_exists('fotofly_fn_woocommerce_gallery_thumbnail_description'))
{

	function fotofly_fn_woocommerce_gallery_thumbnail_description($img, $attachment_id )
	{
			$image_link = wp_get_attachment_url( $attachment_id );

			if(!$image_link) return wp_kses_post($img);

			$image = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_single' ) );
			$image_title = esc_attr(get_post_field('post_title', $attachment_id));

			$img = sprintf( '<a href="%s" class="zoom" title="%s" >%s</a>', $image_link, $image_title, $image );

		return wp_kses_post($img);
	}
}




// SHOPPING CART

add_action( 'fotofly_fn_header_cart', 'fotofly_fn_woocommerce_cart_dropdown', 10);
function fotofly_fn_woocommerce_cart_dropdown()
{
	global $woocommerce;
	$cart_subtotal = $woocommerce->cart->get_cart_subtotal();
	$link = $woocommerce->cart->get_cart_url();
	$count = $woocommerce->cart->cart_contents_count;


	
	$html = "";
	$html .= "<div class='cart-wrap' data-success='".__('was added to the cart', 'fotofly')."'><div class='cart-nav'>";
	$html .= 	"<a class='cart_link' href='".$link."'><span><i class='pe-7s-cart'></i> <span class='prod_count'>" .$count. "</span></span></a>";
	$html .= 	'<div class="dropdown_widget dropdown_widget_cart"><div class="widget_shopping_cart_content">';
	$html .= "</div></div><div class='cart-note'></div></div></div>";

	echo wp_kses_post($html);
}

// Update number of items next to basket on nav
add_filter('add_to_cart_fragments', 'fotofly_fn_header_add_to_cart_fragment');
function fotofly_fn_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	
	ob_start(); ?>
    <span class='prod_count'><?php echo esc_html($woocommerce->cart->cart_contents_count); ?></span>
	<?php
	
	$fragments['span.prod_count'] = ob_get_clean();
	
	return wp_kses_post($fragments);
}


// ---------------------------------------------------------------------------------------------------------------
// Added date : Dec 06, 2017. For frenify profile
// ---------------------------------------------------------------------------------------------------------------
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );
add_action( 'woocommerce_before_single_product_summary', 'fotofly_fn_woocommerce_show_product_images', 20 );

function fotofly_fn_woocommerce_show_product_images(){
	global $post, $product;
	
	$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
	$thumbnail_size    = apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' );
	$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
	$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, $thumbnail_size );
	$placeholder       = has_post_thumbnail() ? 'with-images' : 'without-images';
	$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . $placeholder,
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
	) );
	
	
	echo '<div class="'.esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ).'" data-columns="'.esc_attr( $columns ).'" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper frenify_woo_product_list">';

			$attributes = array(
				'title'                   => get_post_field( 'post_title', $post_thumbnail_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);
			if ( has_post_thumbnail() ) {
				$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'woocommerce_thumbnail' ) . '" class="woocommerce-product-gallery__image main_image"><a href="' . esc_url( $full_size_image[0] ) . '">';
				$html .= get_the_post_thumbnail( $post->ID, $full_size_image[0], $attributes );
				$html .= '</a></div>';
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'fotofly' ) );
				$html .= '</div>';
			}
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
			echo fotofly_fn_woo_product_thumbs();
			
	
	echo '</figure></div>';
}

function fotofly_fn_woo_product_thumbs(){
	global $post, $product;
	
	echo '<div class="frenify_thumb_wrap"><ul>';
	
	$attachment_ids = $product->get_gallery_image_ids();
	if ( $attachment_ids && has_post_thumbnail() ) {
		foreach ( $attachment_ids as $attachment_id ) {
			$full_size_image = wp_get_attachment_image_src( $attachment_id, 'full' );
			$thumbnail       = wp_get_attachment_image_src( $attachment_id, 'woocommerce_thumbnail' );
			$attributes      = array(
				'title'                   => get_post_field( 'post_title', $attachment_id ),
				'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
				'data-src'                => $full_size_image[0],
				'data-large_image'        => $full_size_image[0],
				'data-large_image_width'  => $full_size_image[1],
				'data-large_image_height' => $full_size_image[2],
			);
			$html  = '<li><div data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '">';
			$html .= wp_get_attachment_image( $attachment_id, 'fotofly_fn_thumb-300-300', false, $attributes );
			$html .= '</a></div></li>';
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
		}
	}
	
	echo '</ul></div>';
}