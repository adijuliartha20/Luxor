<?php 
	global $fotofly_fn_option;
	
	
	$main_nav 	= array('theme_location'  => 'main_menu','menu_class' => 'fotofly_fn_main_nav nav_ver');
	$mobile_nav = array('theme_location'  => 'mobile_menu','menu_class' => 'vert_menu_list nav_ver');


	$nav_skin = 'dark';
	if(isset($fotofly_fn_option['nav_skin'])){
		$nav_skin = $fotofly_fn_option['nav_skin'];
	}

	$fotofly_fn_hampos = 'onlyhamburger';
	if(isset($fotofly_fn_option['hamburger_position'])){
		$fotofly_fn_hampos = $fotofly_fn_option['hamburger_position'];
	}

	$fotofly_fn_menubg = 'white';
	if(isset($fotofly_fn_option['vermenu_bg'])){
		$fotofly_fn_menubg = $fotofly_fn_option['vermenu_bg'];
	}
?>
   	<!-- HEADER (FIXED HAMBURGER) -->   	
   	<div class="fotofly_fn_vertnav" data-ham-pos="<?php echo esc_attr($fotofly_fn_hampos);?>" data-menu-bg="<?php echo esc_attr($fotofly_fn_menubg);?>">
   		<div class="fotofly_fn_vertnav_hampart">
   			<div class="hamb_trigger">
   				<div class="hamburger hamburger--collapse-r">
					<div class="hamburger-box">
						<div class="hamburger-inner"></div>
					</div>
				</div>
   			</div>
   		</div>
   		<div class="fotofly_fn_vertnav_menupart scrollable">
   			<div class="inner">
				<div class="logo_full">
					<?php get_template_part('inc/special/fn-logo');?>
				</div>
				<div class="menu_nav">
					<?php if(has_nav_menu('main_menu')){ wp_nav_menu( $main_nav );} else{echo '<ul class="nav_ver"><li><a href="">'.esc_html__('No menu assigned', 'fotofly').'</a></li></ul>';}?>
				</div>
				<div class="social_icons">
					<?php 
						// SHARE BUTTON
						get_template_part( 'inc/fotofly_fn_sharebox');
						// SHARE BUTTON 
					?>
				</div>
			</div>
   		</div>
   	</div>
   	<!-- /HEADER (FIXED HAMBURGER) -->    