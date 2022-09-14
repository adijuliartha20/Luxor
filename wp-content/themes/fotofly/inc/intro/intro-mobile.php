<?php
global $fotofly_fn_option;
$intro_text_color = $intro_text  = $logoURL = $bg_srcURL = '';

// background image
if(isset($fotofly_fn_option['intro_m_bg_img']['url']) && $fotofly_fn_option['intro_m_bg_img']['url'] !== ''){
	$bg_srcURL 	= $fotofly_fn_option['intro_m_bg_img']['url'];
}
// logo
if(isset($fotofly_fn_option['intro_m_logo']['url']) && $fotofly_fn_option['intro_m_logo']['url'] !== ''){
	$logoURL 	= $fotofly_fn_option['intro_m_logo']['url'];
}
// close text
if(isset($fotofly_fn_option['intro_m_close_text']) && $fotofly_fn_option['intro_m_close_text'] !== ''){
	$intro_text = $fotofly_fn_option['intro_m_close_text'];
}
// close text color
if(isset($fotofly_fn_option['intro_m_close_text_color']) && $fotofly_fn_option['intro_m_close_text_color'] !== ''){
	$intro_text_color = $fotofly_fn_option['intro_m_close_text_color'];
}

$styles = '
		.fotofly_fn_intropage .mobile-layout a.closer{
			color:'.esc_attr($intro_text_color).';
			border-bottom-color: '.esc_attr($intro_text_color).';
		}';
?>
<!-- MAIN -->
<div class="mobile-layout" data-inlinestyles="<?php echo esc_attr($styles);?>">
	<div class="bg" style="background-image: url(<?php echo esc_attr($bg_srcURL); ?>)"></div>
	<div class="content">
		<div class="fn_logo"><img src="<?php echo esc_attr($logoURL); ?>" alt="" /></div>
		<div class="fn_button"><a href="#" class="closer"><?php echo esc_html($intro_text); ?></a></div>
	</div>
</div>
<!-- /MAIN -->
