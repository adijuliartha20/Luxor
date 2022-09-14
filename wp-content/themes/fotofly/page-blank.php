<?php
/*
	Template Name: Blank Page
*/
get_header('null');?>
<?php 
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
else{
?>
	<div class="fotofly_fn_wrapper_all">
			<!-- MAIN CONTENT -->
			<div class="content_wrap">
				<!-- PAGE -->
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

				<?php endwhile; endif; ?>
				<!-- /PAGE -->
			</div>
			<!-- /MAIN CONTENT -->
	</div>

<?php } ?> 

<?php get_footer('null'); ?>  