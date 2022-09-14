<?php
global $fotofly_fn_option;
	
	// default logo
	$logoLightURL					= get_template_directory_uri().'/framework/img/logo-light.png';
	$logoDarkURL					= get_template_directory_uri().'/framework/img/logo-dark.png';
	
	
	
	$logo_type = $fotofly_fn_option['fotofly_fn_logo_type'];
	if(isset($logo_type)){$logo_type = $logo_type;}else{$logo_type = '';}
	
	/******************************** IMAGE ************************************/
	// light logo URL
	$logo_imglight = $logo_imglightURL = '';
	if(isset($fotofly_fn_option['fotofly_fn_logo_img_light'])){
		$logo_imglight 		= $fotofly_fn_option['fotofly_fn_logo_img_light'];
	}
	if(isset($fotofly_fn_option['fotofly_fn_logo_img_light']['url'])){
		$logo_imglightURL 	= $fotofly_fn_option['fotofly_fn_logo_img_light']['url'];
	}
	if(isset($logo_imglight) && isset($logo_imglightURL)){
		if($logo_imglightURL !== ''){
			$logoLightURL = $logo_imglightURL;
		}
	}

	// dark logo URL
	$logo_imgdark = $logo_imgdarkURL = '';
	if(isset($fotofly_fn_option['fotofly_fn_logo_img_dark'])){
		$logo_imgdark 		= $fotofly_fn_option['fotofly_fn_logo_img_dark'];
	}
	if(isset($fotofly_fn_option['fotofly_fn_logo_img_dark']['url'])){
		$logo_imgdarkURL 	= $fotofly_fn_option['fotofly_fn_logo_img_dark']['url'];
	}
	if(isset($logo_imgdark) && isset($logo_imgdarkURL)){
		if($logo_imgdarkURL !== ''){
			$logoDarkURL = $logo_imgdarkURL;
		}
	}
	
	/******************************** SVG **************************************/
	$svgLight = '<img class="fotofly_fn_svg light" src="'.get_template_directory_uri() .'/framework/img/svg/logo-svg-light.svg'.'" alt="" />';
	$svgDark = '<img class="fotofly_fn_svg dark" src="'.get_template_directory_uri() .'/framework/img/svg/logo-svg-dark.svg'.'" alt="" />';
	$logo_svglightcolor	= $fotofly_fn_option['fotofly_fn_logo_svg_lightcolor'];
	$logo_svgdarkcolor	= $fotofly_fn_option['fotofly_fn_logo_svg_darkcolor'];

	/******************************** TEXT ************************************/
	$logo_text 			= $fotofly_fn_option['fotofly_fn_logo_text'];
	$logo_textlightcolor = $fotofly_fn_option['fotofly_fn_logo_text_lightcolor'];
	$logo_textdarkcolor = $fotofly_fn_option['fotofly_fn_logo_text_darkcolor'];


?>
<?php if($logo_type == 'image'){ ?>
	<a class="fotofly_fn_flogo logo_img" href="<?php echo esc_url(home_url('/')); ?>">
		<img class="light" src="<?php echo esc_url($logoLightURL);  ?>" alt="<?php esc_attr(bloginfo('description')); ?>" />
		<img class="dark" src="<?php echo esc_url($logoDarkURL);  ?>" alt="<?php esc_attr(bloginfo('description')); ?>" />
	</a>
<?php } elseif($logo_type == 'svg'){?>
	<a class="fotofly_fn_flogo logo_svg" href="<?php echo esc_url(home_url('/')); ?>" data-dark-color="<?php echo esc_attr($logo_svgdarkcolor);?>" data-light-color="<?php echo esc_attr($logo_svglightcolor);?>">
		<?php echo wp_kses_post($svgLight)?>
		<?php echo wp_kses_post($svgDark)?>
	</a>
<?php } elseif($logo_type == 'text'){?>
	<a class="fotofly_fn_flogo logo_text" href="<?php echo esc_url(home_url('/')); ?>" data-dark-color="<?php echo esc_attr($logo_textdarkcolor);?>" data-light-color="<?php echo esc_attr($logo_textlightcolor);?>">
		<span><?php echo esc_html($logo_text);?></span>
	</a>
<?php }elseif($logo_type == '' || $logo_type == 'undefined'){?>
	<a class="fotofly_fn_flogo logo_img" href="<?php echo esc_url(home_url('/')); ?>">
		<img class="light" src="<?php echo esc_url($logoLightURL);  ?>" alt="<?php esc_attr(bloginfo('description')); ?>" />
		<img class="dark" src="<?php echo esc_url($logoDarkURL);  ?>" alt="<?php esc_attr(bloginfo('description')); ?>" />
	</a>
<?php }?>