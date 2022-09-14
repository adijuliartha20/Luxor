<?php 
	global $post, $fotofly_fn_option;
	
	if(is_front_page()) { $paged = (get_query_var('page')) ? get_query_var('page') : 1;	} else { $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;}
	$loop = new WP_Query(array('post_type' => 'fotofly-fn-client', 'paged' => $paged, 'posts_per_page' => $fotofly_fn_option['clients_per_page']));
?>
					
<!-- DEFAULT -->				
<div class="fotofly_fn_clients_list hover_shadow">
	<ul class="fotofly_fn_miniboxes"><?php
		if ($loop->have_posts()) : while ($loop->have_posts()) : $loop->the_post(); 


		$postid = get_the_ID();
		$fotofly_fn_query = $fotofly_fn_args = $fotofly_fn_post_count = NULL;
		$count_images = 0;
		$fotofly_fn_args = array(
			'post_type' 		=> 'fotofly-fn-portfolio',  
			'post_status' 		=> 'publish',  
			'posts_per_page' 	=> -1,
			'meta_key'			=> 'fotofly_fn_portfolio_client',
			'meta_value'		=> $postid,
			'orderby'			=> 'date');

		$fotofly_fn_query 		= new WP_Query($fotofly_fn_args);
		$fotofly_fn_post_count 	= $fotofly_fn_query->found_posts;

		// CLIENT IMAGE
		if(function_exists('rwmb_meta'))
		{
			$fotofly_fn_client_images = rwmb_meta( 'fotofly_fn_client_photo', 'type=image&size=full', $postid);
			if($fotofly_fn_client_images){
				foreach($fotofly_fn_client_images as $img){
					$src = wp_get_attachment_image_src( $img['ID'], 'fotofly_fn_thumb-300-300' );
					$fotofly_fn_client_image = '<img src="'.esc_url($src[0]).'" alt="'.esc_attr($img['title']).'" />';
				} 
			}
		}


		?>

		<li class="fotofly_fn_minibox">
			<div class="item">
				<div class="img_holder"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post($fotofly_fn_client_image);?></a></div>
				<div class="title_holder">
					<?php 
						echo '<span>'.esc_html($fotofly_fn_post_count).' '; 
						if($fotofly_fn_post_count == 1){esc_html_e('Gallery', 'fotofly');}else{esc_html_e('Galleries', 'fotofly');}
						echo '</span>';
					?>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				</div>
			</div>
		</li><?php

		$fotofly_fn_client_image = '';

		endwhile; endif; ?>
	</ul>
</div>
<?php echo fotofly_fn_pagination($loop->max_num_pages, $range = 1); ?>				
<!-- /DEFAULT -->