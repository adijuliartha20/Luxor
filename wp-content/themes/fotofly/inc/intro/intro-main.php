<?php
global $fotofly_fn_option;
$content_pos = $intro_text_color = $intro_text  = $logoURL = $bg_srcURL = '';

// background image
if(isset($fotofly_fn_option['intro_bg_img']['url']) && $fotofly_fn_option['intro_bg_img']['url'] !== ''){
	$bg_srcURL 	= $fotofly_fn_option['intro_bg_img']['url'];
}
// logo
if(isset($fotofly_fn_option['intro_logo']['url']) && $fotofly_fn_option['intro_logo']['url'] !== ''){
	$logoURL 	= $fotofly_fn_option['intro_logo']['url'];
}
// close text
if(isset($fotofly_fn_option['intro_close_text']) && $fotofly_fn_option['intro_close_text'] !== ''){
	$intro_text = $fotofly_fn_option['intro_close_text'];
}
// close text color
if(isset($fotofly_fn_option['intro_close_text_color']) && $fotofly_fn_option['intro_close_text_color'] !== ''){
	$intro_text_color = $fotofly_fn_option['intro_close_text_color'];
}
// content position
if(isset($fotofly_fn_option['intro_content_pos']) && $fotofly_fn_option['intro_content_pos'] !== ''){
	$content_pos = $fotofly_fn_option['intro_content_pos'];
}else{
	$content_pos = 'left-bottom';
}
$bottom = $top = $right = $left = 'auto';
$fn_px = '100px';
$fn_cc = '50%';
$transformX = $transformY = '0';
if($content_pos == 'left-top'){$left = $top = $fn_px;}
elseif($content_pos == 'center-top'){$left = $fn_cc;$top = $fn_px;$transformX = '-50%';}
elseif($content_pos == 'right-top'){$right = $top = $fn_px;}
elseif($content_pos == 'left-middle'){$left = $fn_px;$top = $fn_cc;$transformY = '-50%';}
elseif($content_pos == 'center-middle'){$left = $top = $fn_cc;$transformX = $transformY = '-50%';}
elseif($content_pos == 'right-middle'){$right = $fn_px;$top = $fn_cc;$transformY = '-50%';}
elseif($content_pos == 'center-bottom'){$left = $fn_cc;$bottom = $fn_px;$transformX = '-50%';}
elseif($content_pos == 'right-bottom'){$right = $bottom = $fn_px;}
else{$left = $bottom = $fn_px;}

$styles = '
		@media (max-width: 480px){
			'.$fn_px = "50px".';
		}
		.fotofly_fn_intropage a.closer{
			color:'.esc_attr($intro_text_color).';
			border-bottom-color: '.esc_attr($intro_text_color).';
		}
		.fotofly_fn_intropage .main .content{
			left: '.esc_attr($left).';
			top: '.esc_attr($top).';
			right: '.esc_attr($right).';
			bottom: '.esc_attr($bottom).';
			transform: translateX('.esc_attr($transformX).') translateY('.esc_attr($transformY).') translateZ(0);
		}';
?>
<!-- MAIN -->
<div class="main" data-inlinestyles="<?php echo esc_attr($styles);?>">
	<div class="bg" style="background-image: url(<?php echo esc_attr($bg_srcURL); ?>)"></div>
	<div class="content">
		<div class="fn_logo"><img src="<?php echo esc_attr($logoURL); ?>" alt="" /></div>
		<div class="fn_button"><a href="#" class="closer"><?php echo esc_html($intro_text); ?></a></div>
	</div>
</div>
<!-- /MAIN -->
