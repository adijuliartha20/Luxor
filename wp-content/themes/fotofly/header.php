<!DOCTYPE html >
<html <?php language_attributes(); ?>><head>
<?php 
	global $fotofly_fn_option, $post;
	
	/*-------------------Navigation Skin---------------------*/
	$fotofly_fn_nav_skin = '';
	
	if(function_exists('rwmb_meta')){
		$fotofly_fn_nav_skin 			= get_post_meta(get_the_ID(),'fotofly_fn_page_nav_color', true);
	}
	if(isset($fotofly_fn_option['nav_skin'])){
		if($fotofly_fn_nav_skin === 'undefined' || $fotofly_fn_nav_skin === ''){
			$fotofly_fn_nav_skin 		= $fotofly_fn_option['nav_skin'];
		}
	}
	if(is_404() || is_search() || is_archive()){
		$fotofly_fn_nav_skin			= $fotofly_fn_option['nav_skin_special'];
	}
	/*------------------- Navigation Skin --------------------*/
	
	/*------------------- Footer Options   --------------------*/
	$fotofly_fn_footerswitch = '';
	
	if(function_exists('rwmb_meta')){
		$fotofly_fn_footerswitch 		= get_post_meta(get_the_ID(),'fotofly_fn_page_footer_switch', true);
	}
	if(isset($fotofly_fn_option['footer_switch'])){
		if($fotofly_fn_footerswitch === 'undefined' || $fotofly_fn_footerswitch === ''){
			$fotofly_fn_footerswitch 	= $fotofly_fn_option['footer_switch'];
		}
	}
	
	$fotofly_fn_footer_widgetswitch = '';
	
	if(function_exists('rwmb_meta')){
		$fotofly_fn_footer_widgetswitch 		= get_post_meta(get_the_ID(),'fotofly_fn_page_footer_widget_switch', true);
	}
	if(isset($fotofly_fn_option['footer_widget_switch'])){
		if($fotofly_fn_footer_widgetswitch === 'undefined' || $fotofly_fn_footer_widgetswitch === ''){
			$fotofly_fn_footer_widgetswitch = $fotofly_fn_option['footer_widget_switch'];
		}
	}
	
	$fotofly_fn_footer_socialswitch = '';
	
	if(function_exists('rwmb_meta')){
		$fotofly_fn_footer_socialswitch = get_post_meta(get_the_ID(),'fotofly_fn_page_footer_social_switch', true);
	}
	if(isset($fotofly_fn_option['footer_social_list'])){
		if($fotofly_fn_footer_socialswitch === 'undefined' || $fotofly_fn_footer_socialswitch === ''){
			$fotofly_fn_footer_socialswitch = $fotofly_fn_option['footer_social_list'];
		}
	}
	/*------------------- /Footer Options   --------------------*/
	
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	if(isset($_GET['nav_skin'])){$fotofly_fn_nav_skin = $_GET['nav_skin'];}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	
	if(isset($fotofly_fn_option['portfolio_single_mobile_caption'])){
		$portfolioSingleMobileCaption = $fotofly_fn_option['portfolio_single_mobile_caption'];
	}else{
		$portfolioSingleMobileCaption = 'disable';
	}
	
?>

<meta charset="<?php esc_attr(bloginfo( 'charset' )); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>


<!-- RIGHT CLICK HTML -->
<?php 
	$right_click 		= $fotofly_fn_option['right_click'];
	$right_click_text 	= $fotofly_fn_option['right_click_text'];
	if(isset($_GET['right_click'])){$right_click = $_GET['right_click'];}
?>
<div class="fotofly_fn_rightclick_protection <?php echo esc_attr($right_click);?>">
	<div class="in">
		<div>
			<div class="message_holder">
				<p><?php echo esc_html($right_click_text);?></p>
			</div>
		</div>
	</div>
</div>
<!-- /RIGHT CLICK HTML -->

<?php 
	
	$mobile_nav = array('theme_location'  => 'mobile_menu','menu_class' => 'vert_menu_list nav_ver','menu_id' => 'vert_menu_list');
	
	
	$fotofly_fn_hamburger = 'disable';
	if(isset($fotofly_fn_option['hamburger_menu'])){
		$fotofly_fn_hamburger = $fotofly_fn_option['hamburger_menu'];
	}
	$fotofly_fn_navshare = 'enable';
	if(isset($fotofly_fn_option['nav_share'])){
		$fotofly_fn_navshare = $fotofly_fn_option['nav_share'];
	}
	$fotofly_fn_navsearch = 'enable';
	if(isset($fotofly_fn_option['nav_search'])){
		$fotofly_fn_navsearch = $fotofly_fn_option['nav_search'];
	}
	$fotofly_fn_sidebarskin = 'dark';
	if(isset($fotofly_fn_option['toggle_sidebar_skin'])){
		$fotofly_fn_sidebarskin = $fotofly_fn_option['toggle_sidebar_skin'];
	}
	$fotofly_fn_vertnav = 'off';
	if(isset($fotofly_fn_option['nav_temp'])){
		$fotofly_fn_vertnav = $fotofly_fn_option['nav_temp'];
	}
	
	
	$fotofly_fn_pagetitle_switch	='enable';
	$fotofly_fn_pagetitle			= get_post_meta(get_the_ID(),'fotofly_fn_page_title', true);
	$fotofly_fn_page_breadcrumbs 	= get_post_meta(get_the_ID(),'fotofly_fn_page_breadcrumbs', true);
	if($fotofly_fn_pagetitle !== 'disable' || $fotofly_fn_page_breadcrumbs !== 'disable'){
		$fotofly_fn_pagetitle_switch = 'enable';
	}else{
		$fotofly_fn_pagetitle_switch = 'disable';
	}
	
	
	$fotofly_fn_borderstyle			= $fotofly_fn_option['theme_bordered_style'];
	$fotofly_fn_border_big_style	= $fotofly_fn_option['theme_border_big_color'];
	$fotofly_fn_border_small_style	= $fotofly_fn_option['theme_border_small_color'];
	
	if(isset($_GET['border_switcher'])){$fotofly_fn_borderstyle = $_GET['border_switcher'];}
	if(isset($_GET['border_small'])){$fotofly_fn_border_small_style = $_GET['border_small'];}
	
	
?>

<!-- WRAPPER ALL -->
<div class="fotofly_fn_wrapper_all" 
  data-totop="<?php echo esc_attr($fotofly_fn_option['totop_button']); ?>" 
  data-hamburger-menu="<?php echo esc_attr($fotofly_fn_hamburger);?>" 
  data-nav-share="<?php echo esc_attr($fotofly_fn_navshare);?>" 
  data-nav-search="<?php echo esc_attr($fotofly_fn_navsearch);?>" 
  data-nav-skin="<?php echo esc_attr($fotofly_fn_nav_skin);?>" 
  data-sidebar-skin="<?php echo esc_attr($fotofly_fn_sidebarskin);?>" 
  data-vertmenu="<?php echo esc_attr($fotofly_fn_vertnav);?>" 
  data-page-footer-switch="<?php echo esc_attr($fotofly_fn_footerswitch);?>" 
  data-page-footer-widget-switch="<?php echo esc_attr($fotofly_fn_footer_widgetswitch);?>" 
  data-page-footer-social-switch="<?php echo esc_attr($fotofly_fn_footer_socialswitch);?>" 
  data-page-title-switch="<?php echo esc_attr($fotofly_fn_pagetitle_switch);?>" 
  data-border-style="<?php echo esc_attr($fotofly_fn_borderstyle);?>" 
  data-border-big-type="<?php echo esc_attr($fotofly_fn_border_big_style);?>" 
  data-border-small-type="<?php echo esc_attr($fotofly_fn_border_small_style);?>" 
  data-portfolio-single-mobile-caption="<?php echo esc_attr($portfolioSingleMobileCaption);?>" 
  >
  
	<!-- SPECAIL DIVS FOR BORDER -->
	<div class="fotofly_fn_fixed_border_top"></div>
	<div class="fotofly_fn_fixed_border_right"></div>
	<div class="fotofly_fn_fixed_border_bottom"></div>
	<div class="fotofly_fn_fixed_border_left"></div>
	<!-- /SPECAIL DIVS FOR BORDER -->
   
   	<!-- INTROPAGE -->
    <?php get_template_part('inc/intro/fn-intro-page'); ?>
    <!-- /INTROPAGE -->
    
    <!-- AUDIO -->
    <?php if(!is_404() && !is_search() && !is_archive()){
		get_template_part('inc/special/fn-audio');
	}?>
	<!-- /AUDIO -->
  
   	<!-- MAIN BACKGROUND -->
    <?php if(!is_404() && !is_search() && !is_archive()){
		get_template_part('inc/special/fn-main-bg');
	}else{
		$skin_styles = '.fotofly_fn_wrapper_all{background-color:#f5f5f5;}';
		if(isset($fotofly_fn_option['theme_skin']) && $fotofly_fn_option['theme_skin'] == 'dark'){
			$skin_styles = '.fotofly_fn_wrapper_all{background-color:#151515;}';
		}
	?>
   		<div data-inlinestyles="<?php echo esc_attr($skin_styles);?>"></div>
   	<?php }?>
   	<!-- /MAIN BACKGROUND -->
   
   <div class="fotofly_fn_wrapper_all_content">
	<?php 
	
	// call navigation by type
	$nav_temp = $fotofly_fn_option['nav_temp'];
	if($nav_temp == 'middle_logo'){
		get_template_part('inc/navigation/nav1');
	}else if($nav_temp == 'left_logo'){
		get_template_part('inc/navigation/nav2');
	}else if($nav_temp == 'center_logo'){
		get_template_part('inc/navigation/nav3');
	}else if($nav_temp == 'fixed_hamburger'){
		get_template_part('inc/navigation/nav4');
	}else{
		get_template_part('inc/navigation/nav1');
	}
	
	// check for sticky navigation and call him
	$sticky_switcher = $fotofly_fn_option['sticky_nav_switcher'];
	if($sticky_switcher != 'disable' && $nav_temp != 'fixed_hamburger'){
		get_template_part( 'inc/navigation/sticky-nav');
	}
	
	?>
    
    <!-- MOBILE MENU -->
    <div class="fotofly_fn_mobilemenu_wrap">
    	<div class="fotofly_fn_mobilemenu">
    		<div class="mob_container">
    			<div class="mobilemenu">
    			
					<?php if(has_nav_menu('mobile_menu')){ wp_nav_menu( $mobile_nav );} else{echo '<ul class="vert_menu_list nav_ver"><li><a href="">'.esc_html__('No menu assigned', 'fotofly').'</a></li></ul>';}?>
   			
    			</div>
    		</div>
    	</div>
    </div>
    <!-- /MOBILE MENU -->
    
    <div id="floatingmes"><?php esc_html_e('Close','fotofly');?></div>
    
    <!-- VERTICAL MENU -->
    <div class="fotofly_fn_vertmenu">
    	<div class="fotofly_fn_vertmenu_content scrollable">
    		
    		<div class="vertmenu_content">
				<div class="vertmenu">
				
					<!-- languagebox -->
					<?php echo fotofly_fn_custom_lang_switcher();?>
					<!-- /languagebox -->
					
					<!-- sidebar -->
					<?php 
						if ( is_active_sidebar( 'toggle-sidebar' )){ 
							 dynamic_sidebar( 'toggle-sidebar' ); 
						 }
					?>
					<!-- /sidebar -->
					
				</div>
			</div>
    		
    	</div>
    	<div class="vertmenu_secondary"></div>
    	<div class="fotofly_fn_vertmenu_left"></div>
    </div>
    <!-- /VERTICAL MENU -->
    
    <!-- CONTENT -->
    <div class="fotofly_fn_content">
    