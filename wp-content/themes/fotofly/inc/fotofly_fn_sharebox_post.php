<?php
/*
Name: Fotofly
Description: Custom Love Posts
Author: Frenify
Author URI: http://themeforest.net/user/frenify
*/
global $fotofly_fn_option, $post; $src = '';

$postid = get_the_ID();
if (has_post_thumbnail()) {
	$post_thumbnail_id = get_post_thumbnail_id( $postid );
	$src = wp_get_attachment_image_src( $post_thumbnail_id, 'full');
	$src = $src[0];
}

?>
<?php if(isset($fotofly_fn_option)){?>
<div class="fotofly_fn_social_icons">
	<label><?php esc_html_e('Share:', 'fotofly');?></label>
	<ul>
		<?php if(isset($fotofly_fn_option['share_facebook']) == 1 && $fotofly_fn_option['share_facebook'] != 'disable') { ?>
		<li><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank"><i class="xcon-facebook"></i></a></li>
		<?php } ?>

		<?php if(isset($fotofly_fn_option['share_twitter']) == 1 && $fotofly_fn_option['share_twitter'] != 'disable') { ?>
		<li><a href="https://twitter.com/share?url=<?php the_permalink();?>"  target="_blank"><i class="xcon-twitter"></i></a></li>
		<?php } ?>

		<?php if(isset($fotofly_fn_option['share_google']) == 1 && $fotofly_fn_option['share_google'] != 'disable') { ?>
		<li><a href="https://plus.google.com/share?url=<?php the_permalink();?>" target="_blank"><i class="xcon-gplus"></i></a></li>
		<?php } ?>

		<?php if(isset($fotofly_fn_option['share_pinterest']) == 1 && $fotofly_fn_option['share_pinterest'] != 'disable') { ?>
		<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php if($src != ''){echo esc_url($src);} ?>" target="_blank"><i class="xcon-pinterest"></i></a></li>
		<?php } ?>

		<?php if(isset($fotofly_fn_option['share_linkedin']) == 1 && $fotofly_fn_option['share_linkedin'] != 'disable') { ?>
		<li><a href="http://linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;" target="_blank"><i class="xcon-linkedin"></i></a></li>
		<?php } ?>

		<?php if(isset($fotofly_fn_option['share_email']) == 1 && $fotofly_fn_option['share_email'] != 'disable') { ?>
		<li><a href="mailto:?amp;body=<?php the_permalink() ?>" target="_blank"><i class="xcon-email"></i></a></li>
		<?php } ?>

		<?php if(isset($fotofly_fn_option['share_vk']) == 1 && $fotofly_fn_option['share_vk'] != 'disable') { ?>
		<li><a href="https://www.vk.com/sharer.php?url=<?php the_permalink();?>" target="_blank"><i class="xcon-vk"></i></a></li>
		<?php } ?>

	</ul>
</div>
<?php } ?>