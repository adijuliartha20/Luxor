<?php
global $post, $fotofly_fn_option;
$fotofly_fn_last 		= '';
$fotofly_fn_pagestyle 	= get_post_meta(get_the_ID(),'fotofly_fn_page_style', true);

if($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'ls' || $fotofly_fn_pagestyle == false){$fotofly_fn_last = 'last';}?>


		<div class="fotofly_fn_sidebar fn-col-4 <?php echo esc_attr($fotofly_fn_last); ?>" data-sticky="on">
			<div class="fotofly_fn_sidebar_in">
				<div class="forheight">

						<?php 

						global $woocommerce;

						if(is_page()){

							/* Page Sidebar */
							if (function_exists( 'generated_dynamic_sidebar' )){
								generated_dynamic_sidebar();
							}

						}else if($woocommerce && is_shop() || $woocommerce && is_product_category() || $woocommerce && is_product_tag() || $woocommerce && is_product()) {
							
							if ( is_active_sidebar( 'woocommerce-sidebar' ) ){
								dynamic_sidebar('WooCommerce Sidebar');
							}; 
							/* Woo Sidebar */
							if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('WooCommerce Sidebar') );

						}else if(is_single()){

							/* Page Sidebar */
							if ( is_active_sidebar( 'main-sidebar' ) ){
								dynamic_sidebar('Main Sidebar');
							}; 
						}else {

							/* Main Sidebar */
							
							if ( is_active_sidebar( 'main-sidebar' ) ){
								dynamic_sidebar('Main Sidebar');
							}; 
						}
						?>
				</div>
			</div>
		</div>