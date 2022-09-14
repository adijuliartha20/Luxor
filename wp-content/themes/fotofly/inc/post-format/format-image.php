<?php 
	global $fotofly_fn_option;

	$postid = get_the_ID();
	$post_thumbnail_id = get_post_thumbnail_id( $postid );
	$src = wp_get_attachment_image_src( $post_thumbnail_id, 'full');
	$image = '<img src="'.$src[0].'" alt="" />';

	if(has_post_thumbnail()){
?>
<div class="img_holder">
	<?php echo wp_kses_post($image);?>
</div>
<?php } ?>