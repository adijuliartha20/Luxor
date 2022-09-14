<?php

get_header();
global $fotofly_fn_option, $post;

$fotofly_fn_pagestyle = '';
$fotofly_fn_last ='';
$fotofly_fn_x_pos = '';


if(function_exists('rwmb_meta')){
	$fotofly_fn_pagestyle 			= get_post_meta(get_the_ID(),'fotofly_fn_page_style', true);
	// page styles
	if($fotofly_fn_pagestyle == 'rs' || $fotofly_fn_pagestyle == 'full' || $fotofly_fn_pagestyle == false){
		$fotofly_fn_x_pos = 'float-left';
	}else{
		$fotofly_fn_x_pos = 'float-right';
	}

	if($fotofly_fn_pagestyle == 'ls'){$fotofly_fn_last = 'last';}
	
}

// CHeck if page is password protected	
if(post_password_required($post)){
	echo '<div class="fotofly_fn_password_protected_content">
		 	<div class="in">
				<div>
					<div class="message_holder">
						'.get_the_password_form().'
						<div class="icon_holder"><i class="xcon-lock"></i></div>
					</div>
				</div>
		  	</div>
		  </div>';
}
else
{
?>	
       <!-- BLOG SINGLE -->
    	<div class="fotofly_fn_blog_single_wrap">
    		<div class="fotofly_fn_blog_single">
    			<div class="blog_single">
    				<div class="container">
    					
    					
    					<!-- FULL WIDTH -->
    					<?php 
							if($fotofly_fn_pagestyle == 'full'){ 
						?>
    					<div class="blog_single_wrapper">
    						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            
								<!-- POST HEADER -->
								<div class="fn_post_header post_format_<?php echo get_post_format();?>">
									<?php get_template_part( 'inc/post-format/format', get_post_format() );?>
								</div>
								<!-- /POST HEADER -->

								<!-- POST CONTENT -->
								<div class="post_content">
									<div class="title_holder">
										<span>
											<span class="category"><?php echo fotofly_fn_taxanomy_list(get_the_id(), 'category', false, 300, ', ')?></span>
											<span class="seporator"> / </span>
											<span class="date"><?php the_time(get_option('date_format'));?></span>
										</span>
										<h3><?php the_title(); ?></h3>
									</div>
									
									<div class="content_holder"><?php the_content(); ?></div>
									<div class="fn_link_pages"><?php wp_link_pages(); ?></div>
									
									<?php if(has_tag()){?>
										<div class="fotofly_fn_tags">
											<?php the_tags('<label>'.esc_html_e('Tags:', 'fotofly').'</label><em>', ', ', '</em>'); ?>
										</div>
									<?php } ?>
									
									<?php 
										// SHARE BUTTON
										get_template_part( 'inc/fotofly_fn_sharebox_post');
										// SHARE BUTTON 
									?>
								</div>
								<!-- /POST CONTENT -->
    						</article>
    						
    						<?php 
								$prevnext		= '';
								$previous_post 	= get_adjacent_post(false, '', true);
								$next_post 		= get_adjacent_post(false, '', false);
							
								if ($previous_post && $next_post) { 
									$prevnext	= 'yes';
								}else if(!$previous_post && $next_post){
									$prevnext	= 'next';
								}else if($previous_post && !$next_post){
									$prevnext	= 'prev';
								}else{
									$prevnext	= 'no';
								}
								
								if($fotofly_fn_option['blog_single_prevnextbox'] === 'disable'){
									$prevnext = 'no';
								}
							
							?>
							
							<div class="fotofly_fn_prevnext" data-switch="<?php echo esc_attr($prevnext); ?>">
								<div class="prevnext_inner fotofly_fn_miniboxes">
									<div class="arrow fotofly_fn_minibox previous_post">
										<div class="prev">
											<div class="pp">
												<p>
													<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/left-arrow.svg" alt="" />
													<span><?php echo esc_html__('Previous', 'fotofly'); ?></span>
												</p>
											</div>
											<h3><?php previous_post_link('%link'); ?></h3>
										</div>
									</div>
									<div class="arrow fotofly_fn_minibox next_post">
										<div class="next">
											<div class="pp">
												<p>
													<span><?php echo esc_html__('Next', 'fotofly'); ?></span>
													<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/left-arrow.svg" alt="" />
												</p>
											</div>
											<h3><?php next_post_link('%link'); ?></h3>
										</div>
									</div>
								</div>
							</div>
    						<?php if ( comments_open()){?>
    						<!-- POST COMMENT -->
    						<div class="fotofly_fn_comment_wrapper">
    							
   								<!-- WORDPRESS COMMENTS -->
								<div class="fotofly_fn_comment">
									<?php comments_template(); ?>
								</div>
   								<!-- /WORDPRESS COMMENTS -->

    						</div>
    						<!-- /POST COMMENT -->
    						<?php } ?>
    						
							<?php 
                            	endwhile; endif;
							?>
    					</div>
    					
    					
    					<!-- WITH SIDEBAR -->
    					<?php
							}else{ 
						?>
  						<div class="blog_single_wrapper">
   							<div class="fn-col-8 fix desc <?php  echo esc_attr($fotofly_fn_x_pos).' '.esc_attr($fotofly_fn_last); ?>">
   							
								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

									<!-- POST HEADER -->
									<div class="fn_post_header post_format_<?php echo get_post_format();?>">
										<?php get_template_part( 'inc/post-format/format', get_post_format() );?>
									</div>
									<!-- /POST HEADER -->

									<!-- POST CONTENT -->
									<div class="post_content">
										<div class="title_holder">
											<span>
												<span class="category"><?php echo fotofly_fn_taxanomy_list(get_the_id(), 'category', false, 300, ', ')?></span>
												<span class="seporator"> / </span>
												<span class="date"><?php the_time(get_option('date_format'));?></span>
											</span>
											<h3><?php the_title(); ?></h3>
										</div>
										
										<div class="content_holder"><?php the_content(); ?></div>
										<div class="fn_link_pages"><?php wp_link_pages(); ?></div>
											
											
										<div class="fotofly_fn_tags">
											<?php the_tags('<label>'.esc_html__('Tags:', 'fotofly').'</label><em>', ', ', '</em>'); ?>
										</div>
										<?php 
											// SHARE BUTTON
											get_template_part( 'inc/fotofly_fn_sharebox_post');
											// SHARE BUTTON 
										?>
									</div>
									<!-- /POST CONTENT -->
								</article>
								<?php 
									$prevnext		= '';
									$previous_post 	= get_adjacent_post(false, '', true);
									$next_post 		= get_adjacent_post(false, '', false);

									if ($previous_post && $next_post) { 
										$prevnext	= 'yes';
									}else if(!$previous_post && $next_post){
										$prevnext	= 'next';
									}else if($previous_post && !$next_post){
										$prevnext	= 'prev';
									}else{
										$prevnext	= 'no';
									}
									
									if($fotofly_fn_option['blog_single_prevnextbox'] === 'disable'){
										$prevnext = 'no';
									}
								?>

								<div class="fotofly_fn_prevnext" data-switch="<?php echo esc_attr($prevnext); ?>">
									<div class="prevnext_inner fotofly_fn_miniboxes">
										<div class="arrow fotofly_fn_minibox previous_post">
											<div class="prev">
												<div class="pp">
													<p>
														<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/left-arrow.svg" alt="" />
														<span><?php echo esc_html__('Previous', 'fotofly'); ?></span>
													</p>
												</div>
												<h3><?php previous_post_link('%link'); ?></h3>
											</div>
										</div>
										<div class="arrow fotofly_fn_minibox next_post">
											<div class="next">
												<div class="pp">
													<p>
														<span><?php echo esc_html__('Next', 'fotofly'); ?></span>
														<img class="fotofly_fn_svg" src="<?php echo get_template_directory_uri();?>/framework/img/svg/left-arrow.svg" alt="" />
													</p>
												</div>
												<h3><?php next_post_link('%link'); ?></h3>
											</div>
										</div>
									</div>
								</div>

								<?php if ( comments_open()){?>
								<!-- POST COMMENT -->
								<div class="fotofly_fn_comment_wrapper">

									<!-- WORDPRESS COMMENTS -->
									<div class="fotofly_fn_comment">
										<?php comments_template(); ?>
									</div>
									<!-- /WORDPRESS COMMENTS -->

								</div>
								<!-- /POST COMMENT -->
								<?php } ?>

								<?php 
									endwhile; endif;
								?>
							</div>
						<!-- SIDEBAR -->
                        <?php get_sidebar(); ?>
						</div>
                        <!-- /SIDEBAR -->
   						<?php } ?>
   						
    				</div>
    			</div>
    		</div>
    	</div>
    	<!-- /BLOG SINGLE -->
		
        	
<?php }?>     
<?php get_footer(); ?>  