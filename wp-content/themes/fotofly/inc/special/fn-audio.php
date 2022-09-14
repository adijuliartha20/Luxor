<?php 
	global $fotofly_fn_option;
	$fotofly_fn_pageaudio 			= get_post_meta(get_the_ID(),'fotofly_fn_page_audio', true);
	if(isset($fotofly_fn_pageaudio)){ 
		 if($fotofly_fn_pageaudio != ''){
?>
<!-- AUDIO BUTTON -->
<div class="fotofly_fn_audio_controls">
	<a href="#" class="playback">
		<span class="play on"><i class="xcon-volume-up"></i></span>
		<span class="pause"><i class="xcon-volume-off"></i></span>
	</a>

	<audio autoplay preload loop>
		<source src="<?php echo esc_url($fotofly_fn_pageaudio); ?>" type="audio/mpeg">
	</audio> 
</div>
<!-- /AUDIO BUTTON -->
<?php }} ?>

<?php
// SOUND URL
$gl_clickURL = '';
if(isset($fotofly_fn_option['click_sound']) && $fotofly_fn_option['click_sound'] === 'enable'){
	if($fotofly_fn_option['click_sound_upload']['url'] !== ''){
		$gl_clickURL = $fotofly_fn_option['click_sound_upload']['url'];
	}else{
		$gl_clickURL = get_template_directory_uri() . '/framework/img/click-1.mp3';
	}
}
if(isset($_GET['click_sound'])){$gl_clickURL = get_template_directory_uri() . '/framework/img/click-1.mp3';}
// SOUND SWITCHER
$gl_click = '';
if(isset($fotofly_fn_option['click_sound'])){
	$gl_click = $fotofly_fn_option['click_sound'];
}
if(isset($_GET['click_switcher'])){$gl_click = $_GET['click_switcher'];}
if(isset($gl_click) & $gl_click !== 'disable'){
	$gl_click = $gl_click;
?>
<div class="fotofly_fn_mouse_click_sound">
	<audio preload>
		<source src="<?php echo esc_url($gl_clickURL); ?>" type="audio/mpeg">
	</audio> 
</div>
<?php } ?>