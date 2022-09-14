<?php
global $fotofly_fn_option;
$slider = $intro_text = $intro_text_color = $intro_title_color = '';

$slider = $fotofly_fn_option['intro_slides_add'];

// close text
if(isset($fotofly_fn_option['intro_close_text']) && $fotofly_fn_option['intro_close_text'] !== ''){
	$intro_text = $fotofly_fn_option['intro_close_text'];
}
// close text color
if(isset($fotofly_fn_option['intro_close_text_color']) && $fotofly_fn_option['intro_close_text_color'] !== ''){
	$intro_text_color = $fotofly_fn_option['intro_close_text_color'];
}
// title color
if(isset($fotofly_fn_option['intro_slides_title_color']) && $fotofly_fn_option['intro_slides_title_color'] !== ''){
	$intro_title_color = $fotofly_fn_option['intro_slides_title_color'];
}
// title animation type
$intro_title_animation_type = 'fx2';
if(isset($fotofly_fn_option['intro_slides_title_animation']) && $fotofly_fn_option['intro_slides_title_animation'] !== ''){
	$intro_title_animation_type = $fotofly_fn_option['intro_slides_title_animation'];
}
// slide interval
$intro_slide_interval = '4000';
if(isset($fotofly_fn_option['intro_slides_animation_delay']) && $fotofly_fn_option['intro_slides_animation_delay'] !== ''){
	$intro_slide_interval = $fotofly_fn_option['intro_slides_animation_delay'];
}

$styles = '.fotofly_fn_intropage a.closer{
				color: '.esc_attr($intro_text_color).';
				border-bottom-color: '.esc_attr($intro_text_color).
			'}';
?>


<!-- TEXT SLIDE -->
<div class="text-slider" data-inlinestyles="<?php echo esc_attr($styles);?>">
	
	<div class="fotofly_fn_flexslider" data-delay="<?php echo esc_attr($intro_slide_interval); ?>">
		<ul class="slides">
			
			<?php
				if(isset($slider) && ! empty($slider))
				{   

					foreach($slider as $slide){
						$image = $slide['image'];

						?>

						<li><div style="background-image: url(<?php echo esc_url($image); ?>)"></div></li>
						<?php

					 } 
				} 
			?>
			
		</ul>
	</div>
	
	<div class="frenify_text_slideshow">
		<div class="fn_text_slideshow" data-effect="<?php echo esc_attr($intro_title_animation_type);?>" data-interval="<?php echo esc_attr($intro_slide_interval); ?>"> <!-- fx1...fx18, min 2000... max 10000 -->
			<?php
				if(isset($slider) && ! empty($slider))
				{   
					$i = 1;
					foreach($slider as $key=>$slide){
						
						
						$title = $slide['title'];
						
						// for first div
						if($i == 1){
							$current = 'current';
						}else{
							$current = '';
						}
						
						?>

						<div class="slide <?php echo esc_attr($current);?>">
							<h2 class="title" style="color: <?php echo esc_attr($intro_title_color);?>"><?php echo esc_html($title); ?></h2>
						</div>
						<?php
						$i++;
					 } 
				} 
			?>
		</div>
	</div>
	
	<div class="text_closer">
		<a href="#" class="closer"><?php echo esc_html($intro_text); ?></a>
	</div>
	
</div>
<!-- /TEXT SLIDE -->