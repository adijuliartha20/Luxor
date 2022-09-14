<?php $link = get_post_meta($post->ID, 'fotofly_fn_link', TRUE); ?>

<div class="link-post">
	
	<a href="<?php echo esc_url($link); ?>"><?php esc_html_e('Follow This Link', 'fotofly'); ?></a>
    
    <span class="sub-title">&mdash; <?php echo esc_url($link); ?></span>

</div>