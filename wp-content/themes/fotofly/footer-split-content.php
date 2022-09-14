<?php 
global $fotofly_fn_option;
if($fotofly_fn_option['footer_switch']!=='disable'){ ?>

<!-- FOOTER SPLIT CONTENT -->
<footer class="fotofly_fn_footer">
	
	<?php 
		$fotofly_fn_nosocial = '';
		$fotofly_fn_nosocial = $fotofly_fn_option['footer_social_list'];
		if($fotofly_fn_nosocial !== 'disable'){
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

</footer>
<!-- /FOOTER SPLIT CONTENT -->

<?php }?>