<?php $quote = get_post_meta($post->ID, 'fotofly_fn_quote', TRUE); ?>

<div class="quote-post">
	
	<?php if( !is_single() ) { ?> <a href="<?php the_permalink(); ?>"><?php } ?>
    	
		<blockquote>
			<?php echo esc_html($quote); ?> <br />
			<div class="space20"></div>
			<b><?php the_title(); ?></b>
		</blockquote>
     
	<?php if( !is_single() ) { ?> </a> <?php } ?>

</div>
