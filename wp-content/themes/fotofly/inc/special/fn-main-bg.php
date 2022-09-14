<?php 
$fotofly_fn_bg_video_poster = $fotofly_fn_page_bg_type = $fotofly_fn_bg_video = $fotofly_fn_bg_slider_images = $fotofly_fn_bg_image = $fotofly_fn_bg_imageURL = $fotofly_fn_bg_video_posterURL = $fotofly_fn_bg_video_type = $fotofly_fn_page_bg_color = $fotofly_fn_bg_opacity = '';
	
	if(function_exists('rwmb_meta')){
		$fotofly_fn_page_bg_type 		= get_post_meta(get_the_ID(),'fotofly_fn_page_bg_type', true);
		$fotofly_fn_bg_video 			= get_post_meta(get_the_ID(),'fotofly_fn_page_bg_video', true);
		$fotofly_fn_page_bg_color 		= get_post_meta(get_the_ID(),'fotofly_fn_page_bg_color', true);
		$fotofly_fn_bg_opacity 			= get_post_meta(get_the_ID(),'fotofly_fn_page_fg_opacity', true);
		$fotofly_fn_bg_slider_images 	= get_post_meta(get_the_ID(),'fotofly_fn_page_bg_slider', false );
		$fotofly_fn_bg_image 			= get_post_meta(get_the_ID(),'fotofly_fn_page_bg_img', true );	
		$fotofly_fn_bg_video_poster		= get_post_meta(get_the_ID(),'fotofly_fn_page_bg_video_poster', true );	
	}
	
	// check format of video for background
	if($fotofly_fn_page_bg_type == 'video'){
		if (strpos($fotofly_fn_bg_video, 'youtube') > 0) {
			$fotofly_fn_bg_video_type =  'youtube';
		} elseif (strpos($fotofly_fn_bg_video, 'vimeo') > 0) {
			$fotofly_fn_bg_video_type = 'vimeo';
		} elseif (strpos($fotofly_fn_bg_video, 'mp4') > 0){
			$fotofly_fn_bg_video_type = 'mp4';
		}else {
			$fotofly_fn_bg_video_type = 'unknown';
		}
	}
?>

<!-- SPECIAL DIV FOR BACKGROUND -->
<div class="fotofly_fn_bg_all" 
data-overlay-type="<?php echo esc_attr($fotofly_fn_page_bg_type);?>" 
data-overlay-opacity="<?php echo esc_attr($fotofly_fn_bg_opacity);?>" 
>
	<?php 
		if($fotofly_fn_bg_image){
			$fotofly_fn_bg_imageURL = wp_get_attachment_image_src( $fotofly_fn_bg_image, 'full' );
			$fotofly_fn_bg_imageURL = $fotofly_fn_bg_imageURL[0];
		}
		if($fotofly_fn_bg_video_poster){
			$fotofly_fn_bg_video_posterURL = wp_get_attachment_image_src( $fotofly_fn_bg_video_poster, 'full' );
			$fotofly_fn_bg_video_posterURL = $fotofly_fn_bg_video_posterURL[0];
		}
	?>

	<!-- overlay image -->
	<?php if($fotofly_fn_page_bg_type == 'image'){ ?>
	<div class="overlay_image" style="background-image: url(<?php echo esc_url($fotofly_fn_bg_imageURL);?>)"></div>
	<?php } ?>
	<!-- /overlay image -->

	<!-- overlay video -->
	<?php if($fotofly_fn_page_bg_type == 'video'){ ?>
	<div class="overlay_video" data-video-type="<?php echo esc_attr($fotofly_fn_bg_video_type);?>">
		
		<?php if($fotofly_fn_bg_video_type == 'youtube'){?>
			<div class="fn_youtube" id="fn_bgndVideo" data-property="{videoURL:'<?php echo esc_attr($fotofly_fn_bg_video);?>',containment:'self',autoPlay:true, mute:true, startAt:0, opacity:1, showYTLogo:false, showControls:false, realfullscreen:true}"></div>
		<?php }?>
		
		<?php if($fotofly_fn_bg_video_type == 'vimeo'){?>
			<div class="fn_vimeo" data-property="{videoURL:'<?php echo esc_attr($fotofly_fn_bg_video);?>',containment:'self',autoPlay:true, mute:true, startAt:0, opacity:1, showControls:false, showYTLogo:false}"></div>
		<?php }?>
		
		<?php if($fotofly_fn_bg_video_type == 'mp4'){?>
			<div class="fn_mp4">
				<video poster="<?php echo esc_attr($fotofly_fn_bg_video_posterURL); ?>" playsinline muted autoplay loop tabindex="0">
					<source src="<?php echo esc_attr($fotofly_fn_bg_video);?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
				</video>
			</div>
		<?php }?>
		
		<div class="fn_unknown" style="background-image: url(<?php echo esc_url($fotofly_fn_bg_video_posterURL);?>)"></div>

	</div>
	<?php } ?>
	<!-- /overlay video -->

	<!-- overlay color -->
	<div class="overlay_color" data-color="<?php echo esc_attr($fotofly_fn_page_bg_color); ?>"></div>
	<!-- /overlay color -->

	<!-- overlay (fade) slider -->
	<?php if($fotofly_fn_page_bg_type == 'fade_slider'){ ?>
	<div class="overlay_fade_slider">
		<ul class="slides">
			<?php
				if($fotofly_fn_bg_slider_images)
				{   

					foreach($fotofly_fn_bg_slider_images as $img){

						$src2 	= wp_get_attachment_image_src( $img, 'full' );
						$src2 	= $src2[0];

						?>

						<li>
							<div class="single" style="background-image: url(<?php echo esc_url($src2); ?>)">
							</div>

						</li><?php

					 } 
				} 
			?>
		</ul>
	</div>
	<?php } ?>
	<!-- /overlay (fade) slider -->
	
	<!-- overlay (kenburnsy) slider -->
	<?php if($fotofly_fn_page_bg_type == 'kenburnsy_slider'){ ?>
	<div class="overlay_kenburnsy_slider">
		<div class="fotofly_fn_kenburns_wrap">
			<div class="fotofly_fn_kenburns" data-interval="9000">

				 <?php
					if($fotofly_fn_bg_slider_images)
					{
						foreach($fotofly_fn_bg_slider_images as $img){

							$src 	= wp_get_attachment_image_src( $img, 'full' );
							?>
								<img src="<?php echo esc_url($src[0]); ?>" alt="" />
							<?php

						 }
					}
				?>


			</div>
		</div>
	</div>
	<?php } ?>
	<!-- /overlay (kenburnsy) slider -->

</div>
<!-- /SPECIAL DIV FOR BACKGROUND -->