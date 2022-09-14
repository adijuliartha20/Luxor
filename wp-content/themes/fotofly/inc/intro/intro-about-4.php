<?php
global $fotofly_fn_option;
 $intro_profile_img_pos = $intro_info = $intro_content_color = $intro_name_color = $intro_name = $intro_sign = $intro_text_color = $intro_text = $intro_profile_img = '';


// profile image position
if(isset($fotofly_fn_option['intro_a4_img_pos']) && $fotofly_fn_option['intro_a4_img_pos'] !== ''){
	$intro_profile_img_pos = $fotofly_fn_option['intro_a4_img_pos'];
}
// sign
if(isset($fotofly_fn_option['intro_sign']['url']) && $fotofly_fn_option['intro_sign']['url'] !== ''){
	$intro_sign 	= $fotofly_fn_option['intro_sign']['url'];
}
// content
if(isset($fotofly_fn_option['intro_info']) && $fotofly_fn_option['intro_info'] !== ''){
	$intro_info = $fotofly_fn_option['intro_info'];
}
// content color
if(isset($fotofly_fn_option['intro_info_color']) && $fotofly_fn_option['intro_info_color'] !== ''){
	$intro_content_color = $fotofly_fn_option['intro_info_color'];
}
// name
if(isset($fotofly_fn_option['intro_profile_name']) && $fotofly_fn_option['intro_profile_name'] !== ''){
	$intro_name = $fotofly_fn_option['intro_profile_name'];
}
// name color
if(isset($fotofly_fn_option['intro_profile_name_color']) && $fotofly_fn_option['intro_profile_name_color'] !== ''){
	$intro_name_color = $fotofly_fn_option['intro_profile_name_color'];
}
// profile image
if(isset($fotofly_fn_option['intro_profile_img']['url']) && $fotofly_fn_option['intro_profile_img']['url'] !== ''){
	$intro_profile_img 	= $fotofly_fn_option['intro_profile_img']['url'];
}
// close text
if(isset($fotofly_fn_option['intro_close_text']) && $fotofly_fn_option['intro_close_text'] !== ''){
	$intro_text = $fotofly_fn_option['intro_close_text'];
}
// close text color
if(isset($fotofly_fn_option['intro_close_text_color']) && $fotofly_fn_option['intro_close_text_color'] !== ''){
	$intro_text_color = $fotofly_fn_option['intro_close_text_color'];
}

$styles = '.fotofly_fn_intropage a.closer{
				color: '.esc_attr($intro_text_color).';
				border-bottom-color: '.esc_attr($intro_text_color).
			'}';
?>

<!-- ABOUT -->
<div class="about-4" data-inlinestyles="<?php echo esc_attr($styles);?>">
	
	
	<div class="content" data-img-pos="<?php echo esc_attr($intro_profile_img_pos);?>">
		
		<!-- INFO CONTENT -->
		<div class="content_info">
			<div class="info_wrap scrollable">
				<div class="info_content">
					<div class="title">
						<h1 style="color: <?php echo esc_attr($intro_name_color);?>"><?php echo esc_html($intro_name); ?></h1>
					</div>
					<div class="info">
						<p style="color: <?php echo esc_attr($intro_content_color);?>"><?php echo esc_html($intro_name); ?><?php echo esc_html($intro_info); ?></p>
					</div>
					<div class="sign">
						<img src="<?php echo esc_attr($intro_sign); ?>" alt="" />
					</div>
				</div>
				<div class="fn_button"><a href="#" class="closer"><?php echo esc_html($intro_text); ?></a></div>
			</div>
		</div>
		<!-- /INFO CONTENT -->
		
		
		<!-- IMAGE CONTENT -->
		<div class="content_image" style="background-image: url(<?php echo esc_attr($intro_profile_img);?>)">
		</div>
		<!-- /IMAGE CONTENT -->
		
	</div>
	
</div>
<!-- /ABOUT -->