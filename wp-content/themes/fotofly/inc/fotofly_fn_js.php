<?php
function fotofly_fn_inline_js() {
	global $fotofly_fn_option;
	
	wp_enqueue_script('fotofly_fn_inline_js', get_template_directory_uri() . '/framework/js/inline.js', array('jquery'), '1.0', FALSE);
    
	$fotofly_fn_ajax_url = admin_url('admin-ajax.php');
	
	$fotofly_fn_custom_js = "";
	
	$fotofly_fn_custom_js .= "";
	
   	wp_add_inline_script( 'fotofly_fn_inline_js', $fotofly_fn_custom_js );
}