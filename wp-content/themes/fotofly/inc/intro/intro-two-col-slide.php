<?php
global $fotofly_fn_option;
$slider = $intro_text = $intro_text_color = $intro_title_color = $logoURL = '';

$slider = $fotofly_fn_option['intro_interactive_add'];
	
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
// title color
if(isset($fotofly_fn_option['intro_interactive_color']) && $fotofly_fn_option['intro_interactive_color'] !== ''){
	$intro_title_color = $fotofly_fn_option['intro_interactive_color'];
}

$styles = '.fotofly_fn_intropage a.closer{
				color: '.esc_attr($intro_text_color).';
				border-bottom-color: '.esc_attr($intro_text_color).
			'}';
?>


<!-- TEXT SLIDE -->
<div class="two-col-slide" data-inlinestyles="<?php echo esc_attr($styles);?>">
	<?php $thumb_url = get_template_directory_uri() .'/framework/img/thumb/thumb-570-700.jpg';?>
	
	<div class="frenify-custom-rotator-list" data-thumb-url="<?php echo esc_url($thumb_url);?>">
		<?php
			if(isset($slider) && ! empty($slider))
			{   
				foreach($slider as $slide){
					$image = $slide['image'];
					$title = $slide['title'];
					?>
					<div class="item"><div><img src="<?php echo esc_attr($image); ?>" alt="" /><span style="color: <?php echo esc_attr($intro_title_color);?>"><?php echo esc_attr($title); ?></span></div></div><?php
				 } 
			} 
		?>
		
	</div>
	
	
	<div class="frenify-custom-rotator rot-odd-list"></div>
	<div class="frenify-custom-rotator rot-even-list"></div>

	<div class="line"></div>
	
	<div class="fn_logo"><img src="<?php echo esc_attr($logoURL); ?>" alt="" /></div>
	<div class="text_closer">
		<a href="#" class="closer"><?php echo esc_html($intro_text); ?></a>
	</div>
	
</div>
<!-- /TEXT SLIDE -->