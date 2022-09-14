<?php
/**
 * Template used to display the pixproof gallery
 * Available vars:
 * array        $gallery_ids        An array with all attachments ids
 * object       $attachments        An object with all the attachments
 * string       $number_of_images   Count attachments
 * string       $columns            Number of columns
 * string       $thumbnails_size    The size of the thumbnail
 */
?>
<div id="pixproof_gallery" class="pixproof_gallery cf  js-pixproof-gallery">
	<ul class="fotofly_fn_masonry">
	<?php
	$idx = 1;
	foreach ( $attachments as $attachment ) {
		if ( 'selected' == self::get_attachment_class( $attachment ) ) {
			$select_label = esc_html__( 'Deselect', 'frenify-core' );
		} else {
			$select_label = esc_html__( 'Select', 'frenify-core' );
		}
		
		//$thumb_img  = wp_get_attachment_image_src( $attachment->ID, $thumbnails_size );
		$thumb_img  = wp_get_attachment_image_src( $attachment->ID, 'fotofly_fn_thumb-720-9999' );
		$image_full = wp_get_attachment_image_src( $attachment->ID, 'full-size' );

		//lets determine what should we display under each image according to settings
		// also what id should we assign to that image so the auto comments linking works
		$image_name   = '';
		$image_id_tag = '';
		if ( isset( $photo_display_name ) ) {
			switch ( $photo_display_name ) {
				case 'unique_ids':
					$image_name   = '#' . $attachment->ID;
					$image_id_tag = 'item-' . $attachment->ID;
					break;
				case 'consecutive_ids':
					$image_name   = '#' . $idx;
					$image_id_tag = 'item-' . $idx;
					break;
				case 'file_name':
					$image_name   = '#' . $attachment->post_name;
					$image_id_tag = 'item-' . $attachment->post_name;
					break;
				case 'unique_ids_photo_title':
					$image_name   = '#' . $attachment->ID . ' ' . $attachment->post_title;
					$image_id_tag = 'item-' . $attachment->ID;
					break;
				case 'consecutive_ids_photo_title':
					$image_name   = '#' . $idx . ' ' . $attachment->post_title;
					$image_id_tag = 'item-' . $idx;
					break;
			}
		} else {
			//default to unique ids aka attachment id
			$image_name   = '#' . $attachment->ID;
			$image_id_tag = 'item-' . $attachment->ID;
		} ?>
		<li class="proof-photo fotofly_fn_masonry_in js-proof-photo  gallery-item <?php self::attachment_class( $attachment ); ?>" <?php self::attachment_data( $attachment ); ?>  id="<?php echo $image_id_tag; ?>">
			<div class="proof-photo__container">
				<div class="fotofly_fn_extra">
                    <div class="img_holder"><img src="<?php echo $thumb_img[0]; ?>" alt="<?php echo $attachment->post_title; ?>"/></div>
                    <div class="proof-photo__status">
						<span class="proof-photo__id">
							<?php echo $image_name; ?>
						</span>
                        <span class="ticker"><i class="xcon-ok"></i></span>
                    </div>
                    <span class="spinner"></span>
                    <div class="overlay"></div>
                </div>
                <div class="proof-photo__meta">
					<div class="flexbox">
						<div class="flexbox__item">
							<ul>
								<li><a class="meta__action  zoom-action" href="<?php echo $image_full[0]; ?>" data-photoid="<?php echo $image_id_tag; ?>">
										<span><i class="xcon-search"></i></span>
								</a></li>
								<li><a class="meta__action  select-action" href="#" data-photoid="<?php echo $image_id_tag; ?>">
										<span class="a"><i class="xcon-ok"></i></span>
                                        <span class="b"><i class="xcon-cancel"></i></span>
								</a></li>
								
							</ul>
						</div>
					</div>
				</div>
                
			</div>
		</li>
		<?php
		/*if ( $idx % $columns == 0 ) {
			echo '<br style="clear: both">';
		}*/
		$idx ++;
	} ?>

	</ul>
</div>
