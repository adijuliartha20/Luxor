<?php

global $fotofly_fn_option, $post;


get_header();

$fotofly_fn_gallerysingletemp = '';
if(function_exists('rwmb_meta')){
	$fotofly_fn_gallerysingletemp 		= rwmb_meta( 'fotofly_fn_gallery_single_layout' );
}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	if(isset($_GET['temp'])){$fotofly_fn_gallerysingletemp = $_GET['temp'];}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */


// CHeck if page is password protected
if(post_password_required($post)){
	echo '<div class="fotofly_fn_password_protected_content">
		 	<div class="in">
				<div>
					<div class="message_holder">
						'.get_the_password_form().'
						<div class="icon_holder"><i class="xcon-lock"></i></div>
					</div>
				</div>
		 	</div>
		  </div>';
}
else
{
	
	
	if($fotofly_fn_gallerysingletemp === 'masonry'){
		get_template_part( 'inc/gallerysingle/masonry');
	}else if($fotofly_fn_gallerysingletemp === 'grid'){
		get_template_part( 'inc/gallerysingle/grid');
	}else if($fotofly_fn_gallerysingletemp === 'full-slider'){
		get_template_part( 'inc/gallerysingle/full-slider');
	}else if($fotofly_fn_gallerysingletemp === 'full-justified'){
		get_template_part( 'inc/gallerysingle/full-justified');
	}else if($fotofly_fn_gallerysingletemp === 'kenburnsy'){
		get_template_part( 'inc/gallerysingle/kenburnsy');
	}else if($fotofly_fn_gallerysingletemp === 'flow'){
		get_template_part( 'inc/gallerysingle/flow');
	}else{
		get_template_part( 'inc/gallerysingle/masonry');	
	}
		
}

get_footer();

?>   