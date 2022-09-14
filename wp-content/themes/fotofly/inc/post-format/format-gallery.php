<?php 
$postgallery = get_post_meta(get_the_ID(),'fotofly_fn_postgallery', false);
?>
<?php if($postgallery){ ?>
<div class="post-type-wrapper frenify_fn_lightbox">
    <div class="flexslider">
        <ul class="slides">
       <?php
			$postid = get_the_ID();
			global $wpdb;
			
            if ( !is_array( $postgallery ) ) $postgallery = ( array ) $postgallery;
        
            $postgallery = implode( ',', $postgallery ); 
			$postgallery = esc_sql( $postgallery );
            
            $images = $wpdb->get_col( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s AND ID IN ( $postgallery ) ORDER BY menu_order DESC ", array('attachment') ));
			
            foreach($images as $img){
            
				$src = wp_get_attachment_image_src( $img, 'full' );
				$src = $src[0];
					
					
			?>
                <li class="lightbox" data-src="<?php echo esc_attr($src); ?>">
                  	<img class="noimg" src="<?php echo esc_attr($src); ?>" alt="" />
                   	<div class="img_overlay" style="background-image: url('<?php echo esc_url($src); ?>')"></div>
                </li>
        <?php 	
			} ?>
        </ul>
    </div>
</div>
<?php } ?>