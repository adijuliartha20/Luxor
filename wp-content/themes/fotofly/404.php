<?php
	get_header();
?>
          	
       	<!-- ERROR PAGE -->
       	<div class="fotofly_fn_error_page">
       		<div class="error_content">
				<div class="error_wrap">
					<div class="error_box">
						<div class="title_holder">
							<h1><?php esc_html_e('Oops! 404', 'fotofly') ?></h1>
							<p><?php esc_html_e('Sorry, but the page you are looking for was moved, removed, renamed or might never existed...', 'fotofly') ?></p>
						</div>
						<div class="search_holder">
							<form action="<?php echo esc_url(home_url('/')); ?>" method="get" >
								<div><input type="text" placeholder="<?php esc_html_e('Search', 'fotofly');?>" name="s" autocomplete="off" /></div>
								<div><input type="submit" class="pe-7s-search" value="<?php esc_html_e('Search', 'fotofly');?>" /></div>
							</form>
						</div>
						<div class="icon_holder"><i class="xcon-emo-displeased"></i></div>
					</div>
				</div>
       		</div>
       	</div>
       	<!-- /ERROR PAGE -->
        	
        
<?php get_footer(); ?>  