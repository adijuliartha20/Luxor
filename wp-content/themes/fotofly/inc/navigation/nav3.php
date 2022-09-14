<?php 
	global $fotofly_fn_option, $post;
	
	
	$main_nav 	= array('theme_location'  => 'main_menu','menu_class' => 'fotofly_fn_main_nav nav__hor', 'walker' => new fotofly_fn_walker);
	$mobile_nav = array('theme_location'  => 'mobile_menu','menu_class' => 'vert_menu_list nav_ver');
?>
   
	<!-- HEADER -->
    <header class="fotofly_fn_header" data-logo="center">
    	<div class="fotofly_fn_header_content">
			<div class="header_inner">
				
				<!-- FOR MOBILE DEVICES -->
				<div class="header_mobile_logo">
					<?php get_template_part('inc/special/fn-logo');?>
				</div>
				<!-- /FOR MOBILE DEVICES -->
				
				<!-- FOR HUGESIZE SCREENS -->
				<div class="header_list">
					<div class="center_logo">
						<?php get_template_part('inc/special/fn-logo');?>
					</div>
					<?php if(has_nav_menu('main_menu')){ wp_nav_menu( $main_nav );} else{echo '<ul class="nav__hor"><li><a href="">'.esc_html__('No menu assigned', 'fotofly').'</a></li></ul>';}?>
				</div>
				<!-- /FOR HUGESIZE SCREENS -->
				
				<!-- EXTRA BUTTONS -->
				<div class="header_helper">
					<ul>
						<li class="search">
							<a href="#">
								<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/search.svg" alt="" />
								<img class="fotofly_fn_svg close" src="<?php echo get_template_directory_uri();?>/framework/img/svg/close.svg" alt="" />
							</a>
							<div class="fotofly_fn_search">
								<div class="in">
									<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
										<input type="text" placeholder="<?php esc_html_e('Search', 'fotofly');?>" name="s" autocomplete="off" />
										<input type="submit" class="pe-7s-search" value="" />
										<a href="#"><img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/search.svg" alt="" /></a>
									</form>
								</div>
							</div>
						</li>
						<li class="share">
							<a href="#"><img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/share.svg" alt="" /></a>
							<?php 
								// SHARE BUTTON
								get_template_part( 'inc/fotofly_fn_sharebox');
								// SHARE BUTTON 
							?>
							
						</li>
						<li class="trigger">
							<a href="#">
								<span class="trigger">
									<span class="a"></span>
									<span class="b"></span>
									<span class="c"></span>
								</span>
							</a>
						</li>
						<li class="mobile_trigger">
							<div class="hamburger hamburger--collapse-r">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
						</li>
					</ul>
				</div>
				<!-- EXTRA BUTTONS -->
				
			</div>
    	</div>
    </header>
    <!-- /HEADER -->
    