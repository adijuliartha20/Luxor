<?php
global $fotofly_fn_option;
$intro_bg_img = $intro_info = $intro_content_color = $intro_name_color = $intro_name = $intro_sign = $intro_text_color = $intro_text = $intro_profile_img = '';


// background image
if(isset($fotofly_fn_option['intro_bg_img']['url']) && $fotofly_fn_option['intro_bg_img']['url'] !== ''){
	$intro_bg_img 	= $fotofly_fn_option['intro_bg_img']['url'];
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
			border-bottom-color: '.esc_attr($intro_text_color).'
		}';
?>

<!-- ABOUT -->
<div class="about-2" data-inlinestyles="<?php echo esc_attr($styles);?>">
	
	
	<div class="bg" style="background-image: url(<?php echo esc_attr($intro_bg_img); ?>)"></div>
	
	<div class="content">
		<div class="content_in scrollable">
			<div class="inner">
				<div class="inner_in">
					<div class="avatar">
						<?php echo fotofly_fn_callback_thumbs(1000,1000); ?>
						<div class="avatar_overlay" style="background-image: url(<?php echo esc_attr($intro_profile_img);?>)"></div>
					</div>
					<div class="title_holder">
						<div class="title"><h1 style="color: <?php echo esc_attr($intro_name_color);?>"><?php echo esc_html($intro_name); ?></h1></div>
						<div class="info"><p style="color: <?php echo esc_attr($intro_content_color);?>"><?php echo esc_html($intro_name); ?><?php echo esc_html($intro_info); ?></p></div>
						<div class="sign"><img src="<?php echo esc_attr($intro_sign); ?>" alt="" /></div>
					</div>
					<div class="fn_button"><a href="#" class="closer"><?php echo esc_html($intro_text); ?></a></div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- /ABOUT -->