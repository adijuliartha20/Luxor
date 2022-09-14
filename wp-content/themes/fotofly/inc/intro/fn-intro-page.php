<?php
global $fotofly_fn_option;
$intro_type = 'main';
$intro_switcher = 'disable';
$close_key_string = '';
$intro_m_switcher = 'disable';
// intro switcher
if(isset($fotofly_fn_option['intro_switcher'])){
	$intro_switcher = $fotofly_fn_option['intro_switcher'];
}
// intro template
if(isset($fotofly_fn_option['intro_template'])){
	$intro_type = $fotofly_fn_option['intro_template'];
}
// intro template
if(isset($fotofly_fn_option['intro_closer_button']) && $intro_switcher === 'enable'){
	$close_key_array = $fotofly_fn_option['intro_closer_button']; 	// get array
	$to_remove = array('0');										// get element = 0
	$result = array_diff($close_key_array, $to_remove);				// remove element = 0
	$result2 = array_unique($result);								// remove same elements
	$close_key_string = implode("/",$result2);						// array to string
}
// intro mobile switcher
if(isset($fotofly_fn_option['intro_m_switcher'])){
	$intro_m_switcher = $fotofly_fn_option['intro_m_switcher'];
}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* ::::::::::::::::::::::::  VARIABLES FOR PREVIEW DEMONSTRATION  ::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
	if(isset($_GET['intro_switcher'])){$intro_switcher = $_GET['intro_switcher'];}
	if(isset($_GET['intro_type'])){$intro_type = $_GET['intro_type'];}
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
/* :::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: */
?>

<?php if($intro_switcher == 'enable'){?>
<div class="fotofly_fn_intropage" data-type="<?php echo esc_attr($intro_type); ?>" data-close-key="<?php echo esc_attr($close_key_string); ?>" data-mversion="<?php echo esc_attr($intro_m_switcher); ?>">
	
	<?php 
		if($intro_type == 'intro-main'){
			get_template_part( 'inc/intro/intro-main');
		}else if($intro_type == 'intro-text-slider'){
			get_template_part( 'inc/intro/intro-text-slider');
		}else if($intro_type == 'intro-about'){
			get_template_part( 'inc/intro/intro-about');
		}else if($intro_type == 'intro-about-2'){
			get_template_part( 'inc/intro/intro-about-2');
		}else if($intro_type == 'intro-about-3'){
			get_template_part( 'inc/intro/intro-about-3');
		}else if($intro_type == 'intro-about-4'){
			get_template_part( 'inc/intro/intro-about-4');
		}else if($intro_type == 'intro-interactive-list'){
			get_template_part( 'inc/intro/intro-interactive-list');
		}else if($intro_type == 'intro-two-col-slide'){
			get_template_part( 'inc/intro/intro-two-col-slide');
		}
	?>
	<?php 
		if($intro_m_switcher == 'enable'){
			get_template_part( 'inc/intro/intro-mobile');
		}
	?>
	
</div>
<?php } ?>