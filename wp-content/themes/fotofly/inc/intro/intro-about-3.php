<?php
global $fotofly_fn_option;
$img1 = $img2 = $img3 = $intro_info = $intro_content_color = $intro_text_color = $intro_text = '';



// image #1
if(isset($fotofly_fn_option['intro_a3_i1']['url']) && $fotofly_fn_option['intro_a3_i1']['url'] !== ''){
	$img1 	= $fotofly_fn_option['intro_a3_i1']['url'];
}
// image #2
if(isset($fotofly_fn_option['intro_a3_i2']['url']) && $fotofly_fn_option['intro_a3_i2']['url'] !== ''){
	$img2 	= $fotofly_fn_option['intro_a3_i2']['url'];
}
// image #3
if(isset($fotofly_fn_option['intro_a3_i3']['url']) && $fotofly_fn_option['intro_a3_i3']['url'] !== ''){
	$img3 	= $fotofly_fn_option['intro_a3_i3']['url'];
}
// content
if(isset($fotofly_fn_option['intro_info']) && $fotofly_fn_option['intro_info'] !== ''){
	$intro_info = $fotofly_fn_option['intro_info'];
}
// content color
if(isset($fotofly_fn_option['intro_info_color']) && $fotofly_fn_option['intro_info_color'] !== ''){
	$intro_content_color = $fotofly_fn_option['intro_info_color'];
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
<div class="about-3" data-inlinestyles="<?php echo esc_attr($styles);?>">
	
	<div class="bg"></div>
	
	<div class="content">
		<div class="content_in scrollable">
			<div class="container">
				<div class="cont_wrap">
					<!-- Lines -->
					<div class="line1"></div>
					<div class="line2"></div>
					<div class="line3"></div>
					<div class="line4"></div>
					<!-- Lines -->
					<div class="list">
						<ul>
							<li>
								<div class="item">
									<?php echo fotofly_fn_callback_thumbs(800,970);; ?>
									<div class="o_img" style="background-image: url(<?php echo esc_attr($img1);?>)"></div>
								</div>
							</li>
							<li>
								<div class="item">
									<?php echo fotofly_fn_callback_thumbs(800,970);; ?>
									<div class="o_img" style="background-image: url(<?php echo esc_attr($img2);?>)"></div>
								</div>
							</li>
							<li>
								<div class="item">
									<?php echo fotofly_fn_callback_thumbs(800,970);; ?>
									<div class="o_img" style="background-image: url(<?php echo esc_attr($img3);?>)"></div>
								</div>
							</li>
						</ul>
					</div>
					<div class="info">
						<p style="color: <?php echo esc_attr($intro_content_color);?>"><?php echo esc_html($intro_info); ?></p>
					</div>
					<div class="fn_button"><a href="#" class="closer"><?php echo esc_html($intro_text); ?></a></div>
				</div>
			</div>
		</div>
	</div>
	
</div>
<!-- /ABOUT -->