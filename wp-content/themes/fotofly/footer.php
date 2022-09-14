<?php 
global $fotofly_fn_option;
if(isset($fotofly_fn_option['footer_logo_switch'])){
	$footer_logo_switch = $fotofly_fn_option['footer_logo_switch'];
}else{
	$footer_logo_switch = 'enable';
}
?>
		
		</div>
		<!-- /CONTENT -->


		<?php if($fotofly_fn_option['footer_switch']!=='disable'){ ?>
		<!-- FOOTER -->
		<footer class="fotofly_fn_footer" data-logo-switch="<?php echo esc_attr($footer_logo_switch);?>">

			<?php if($fotofly_fn_option['footer_widget_switch']=='enable'){ ?>
			<div class="footer_widget_area">
				<div class="container">

					<?php



					$fc = '';

					if(isset($fotofly_fn_option['footer_cols']) && $fotofly_fn_option['footer_cols'] != ''){$fc = $fotofly_fn_option['footer_cols'];}
					switch($fc){
						case 'col1': $number = 1;break;
						case 'col2': $number = 2;break;
						case 'col3': $number = 3;break;
						case 'col4': $number = 4;break;
						default: $number = 3;break;
					}
					$space = $fotofly_fn_option['footer_space'];
					?>

					<ul class="widget_area" data-columns="<?php echo esc_attr($fc); ?>" data-space="<?php echo esc_attr($space); ?>">
						<?php
						for($counter = 1; $counter <= $number; $counter++){
						?>

						<?php if ( is_active_sidebar( 'footer-widget-'.$counter )){ ?>
						<li>
							<div class="item"><?php dynamic_sidebar( 'footer-widget-'.$counter ); ?></div>
						</li>
						<?php } ?>

						<?php
						}	
						?>
					</ul>
				</div>
			</div>
			<?php } ?>
			
			
			<?php 
				$fotofly_fn_nosocial = '';
				$fotofly_fn_nosocial = $fotofly_fn_option['footer_social_list'];
			 	if($fotofly_fn_nosocial == 'enable'){
			?>
               <div class="footer_social">
					<div class="container">
						<ul class="footer_social_list" >
							<?php if(isset($fotofly_fn_option['facebook_foot']) == 1 && $fotofly_fn_option['facebook_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['facebook_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Facebook', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['twitter_foot']) == 1 && $fotofly_fn_option['twitter_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['twitter_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Twitter', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['pinterest_foot']) == 1 && $fotofly_fn_option['pinterest_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['pinterest_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Pinterest', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['google_foot']) == 1 && $fotofly_fn_option['google_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['google_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Google+', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['youtube_foot']) == 1 && $fotofly_fn_option['youtube_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['youtube_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Youtube', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['instagram_foot']) == 1 && $fotofly_fn_option['instagram_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['instagram_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Instagram', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['linkedin_foot']) == 1 && $fotofly_fn_option['linkedin_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['linkedin_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Linkedin', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['behance_foot']) == 1 && $fotofly_fn_option['behance_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['behance_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Behance', 'fotofly');?></span></a></li>
							<?php } ?>

							<?php if(isset($fotofly_fn_option['vimeo_foot']) == 1 && $fotofly_fn_option['vimeo_foot'] != '') { ?>
							<li><a href="<?php echo esc_url($fotofly_fn_option['vimeo_foot']); ?>" target="_blank"><span class="sl_popup"><?php esc_html_e('Vimeo', 'fotofly');?></span></a></li>
							<?php } ?>

						</ul>
					</div>
               </div>
            <?php } ?>

			<div class="copyright">
				<div class="container">
					<div class="cright_content">
						<div class="left_content">
							<!--<?php 
								if(isset($fotofly_fn_option['footer_logo']['url']) && $fotofly_fn_option['footer_logo']['url'] !== ''){ 
									$footer_logo = $fotofly_fn_option['footer_logo']['url'];

								}else{ 
									$footer_logo = get_template_directory_uri() .'/framework/img/footer-logo.png';
								} 
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img src="<?php echo esc_url($footer_logo);?>" alt="" />
							</a>
							-->
						</div>
						<?php if($fotofly_fn_option['footer_logo_switch'] !== 'disable'){?>
						<div class="center_content">
							<?php 
								if(isset($fotofly_fn_option['footer_logo']['url']) && $fotofly_fn_option['footer_logo']['url'] !== ''){ 
									$footer_logo = $fotofly_fn_option['footer_logo']['url'];

								}else{ 
									$footer_logo = get_template_directory_uri() .'/framework/img/footer-logo.png';
								} 
							?>
							<a href="<?php echo esc_url(home_url('/')); ?>">
								<img src="<?php echo esc_url($footer_logo);?>" alt="" />
							</a>
						</div>
						<?php }?>
						<div class="right_content">
							<!--<span>
								<?php 
									if(isset($fotofly_fn_option['copyright_footer_side2'])){ 
										echo wp_kses_post($fotofly_fn_option['copyright_footer_side2']);

									}else{ 
										echo esc_html__('Site By Frenify Design Team', 'fotofly');
									} 
								?>
							</span>
							<span>
								<?php 
									if(isset($fotofly_fn_option['copyright_footer_side'])){ 
										echo wp_kses_post($fotofly_fn_option['copyright_footer_side']);

									}else{ 
										esc_html_e('(C) 2018. All Rights Reserved', 'fotofly');
									} 
								?>
							</span>-->
						</div>
					</div>
				</div>
			</div>

		</footer>
		<?php }?>
    	<!-- /FOOTER -->
    
		<a class="totop <?php echo esc_html($fotofly_fn_option['totop_button']); ?>" href="#"><span class="line"></span></a>
		
		
	</div>
</div>
<!-- / WRAPPER ALL -->


<?php wp_footer(); ?>
</body>
</html>