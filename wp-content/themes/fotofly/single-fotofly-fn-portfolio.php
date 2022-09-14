<?php

get_header();

global $fotofly_fn_option, $post;

if(function_exists('rwmb_meta')){
	$fotofly_fn_portfoliosingletemp 	= rwmb_meta( 'fotofly_fn_portfolio_single_layout' );	
}



/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	if(isset($_GET['temp'])){$fotofly_fn_portfoliosingletemp = $_GET['temp'];}
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
	
	if($fotofly_fn_portfoliosingletemp === 'splitscreen'){
		get_template_part( 'inc/portfoliosingle/splitscreen');
	}else if($fotofly_fn_portfoliosingletemp === 'slider'){
		get_template_part( 'inc/portfoliosingle/slider');
	}else if($fotofly_fn_portfoliosingletemp === 'full-slider'){
		get_template_part( 'inc/portfoliosingle/full-slider');
	}else if($fotofly_fn_portfoliosingletemp === 'carousel'){
		get_template_part( 'inc/portfoliosingle/carousel');
	}else if($fotofly_fn_portfoliosingletemp === 'mono'){
		get_template_part( 'inc/portfoliosingle/mono');
	}else if($fotofly_fn_portfoliosingletemp === 'sticky'){
		get_template_part( 'inc/portfoliosingle/sticky');
	}else if($fotofly_fn_portfoliosingletemp === 'justified'){
		get_template_part( 'inc/portfoliosingle/justified');
	}else if($fotofly_fn_portfoliosingletemp === 'full-justified'){
		get_template_part( 'inc/portfoliosingle/full-justified');
	}else{
		get_template_part( 'inc/portfoliosingle/full-justified');	
	}
		
}
if($fotofly_fn_portfoliosingletemp == 'splitscreen' || $fotofly_fn_portfoliosingletemp == 'mono'){
	get_footer('null');
}else{
	get_footer();
}

?>   