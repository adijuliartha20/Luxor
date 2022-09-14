<?php 
	global $fotofly_fn_option, $post;
	
	
	$main_nav 	= array('theme_location'  => 'main_menu','menu_class' => 'fotofly_fn_main_nav nav__hor', 'walker' => new fotofly_fn_walker);

?>
   
<!-- HEADER -->
<header class="fotofly_fn_header_sticky on">


	<div class="sticky_list">	
		<?php if(has_nav_menu('main_menu')){ wp_nav_menu( $main_nav );} else{echo '<ul class="nav__hor"><li><a href="">'.esc_html__('No menu assigned', 'fotofly').'</a></li></ul>';}?>
	</div>


</header>
<!-- /HEADER --> 