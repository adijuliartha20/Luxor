<?php
global $fotofly_fn_option;
$slider = $intro_text = $intro_text_color = $intro_title_color = '';

$slider = $fotofly_fn_option['intro_interactive_add'];

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
if(isset($_GET['intro_title_color'])){$intro_title_color = $_GET['intro_title_color'];}

$styles = '.fotofly_fn_intropage a.closer{
				color: '.esc_attr($intro_text_color).';
				border-bottom-color:'.esc_attr($intro_text_color).';
			}
			.fotofly_fn_intropage .interactive-list span:after{
				background-color: '.esc_attr($intro_title_color).';
			}
			.fotofly_fn_intropage .interactive-list span{
				color:'.esc_attr($intro_title_color).';
		}';
?>


<!-- TEXT SLIDE -->
<div class="interactive-list" data-inlinestyles="<?php echo esc_attr($styles);?>">
	
	<div class="overlay">
		<?php
			if(isset($slider) && ! empty($slider))
			{   
				$i = 0;
				foreach($slider as $slide){
					$image = $slide['image'];
					$i++;
					?>
					<?php if($i == 1){$opened = 'opened';}else{$opened = '';} ?>
					<div class="a<?php echo esc_attr($i);?> <?php echo esc_attr($opened);?>" style="background-image: url(<?php echo esc_url($image); ?>)"></div>
					<?php

				 } 
			} 
		?>
	</div>
	
	<div class="inner">
		<ul>
			<?php
				if(isset($slider) && ! empty($slider))
				{   
					$i = 0;
					foreach($slider as $slide){
						$title = $slide['title'];
						$i++;
						if($i == 1){$opened = 'opened';}else{$opened = '';}
						?>
						<li data-inter="a<?php echo esc_attr($i);?>" class="<?php echo esc_attr($opened);?>"><span><?php echo esc_html($title); ?></span></li>
						<?php

					 } 
				} 
			?>
		</ul>
	</div>
	
	
	<div class="text_closer">
		<a href="#" class="closer"><?php echo esc_html($intro_text); ?></a>
	</div>
	
</div>
<!-- /TEXT SLIDE -->
