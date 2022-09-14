<?php

/**
 * Plugin Name: AAAA About Widget
 * Description: A widget that show info about author.
 * Version: 1.0
 * Author: Frenify
 * Author URI: http://themeforest.net/user/frenify
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'aboutinfo_widget' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function aboutinfo_widget() {
	register_widget( 'aboutinfo' );
}

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class aboutinfo extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		parent::__construct(
			'aboutinfo', // Base ID
			esc_html__( 'Frenify About', 'fotofly' ), // Name
			array( 'description' => esc_html__( 'A widget that displays info about author', 'fotofly' ), ) // Args
		);
	}
	

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		global $post;
		/* Our variables from the widget settings. */
		$title 					= apply_filters(esc_html__('About Me', 'fotofly'), $instance['title'] );
		$author_name 			= $instance['author_name'];
		$author_info 			= $instance['author_info'];
		$signature_url	 		= $instance['signature_photo'];
		$author_photo_url 		= $instance['author_photo'];
		
		
		/* Get image from id */
		$signature_photo_id 	= fotofly_fn_attachment_id_from_url($signature_url);
		$author_photo_id 		= fotofly_fn_attachment_id_from_url($author_photo_url);
		
		$signature_image 		= fotofly_fn_get_image_from_id($signature_photo_id, 'fotofly_fn_thumb-300-300');
		$author_image 			= fotofly_fn_get_image_from_id($author_photo_id, 'fotofly_fn_thumb-300-300');
		

		/* Before widget (defined by themes). */
		echo wp_kses_post($before_widget);
		if ( $title ) { echo wp_kses_post($before_title . $title . $after_title);  }?>
           	<div class="fotofly_fn_widget_aboutme">
				<div class="img_wrap">
					<?php echo wp_kses_post($author_image); ?>
					<h5><?php echo esc_html($author_name); ?></h5>
				</div>
                <div class="desc">
                	<p><?php echo wp_kses_post($author_info); ?></p>
                </div>
                <div class="signature">
                	<?php echo wp_kses_post($signature_image); ?>
                </div>
            </div>
            
		<?php 
		/* After widget (defined by themes). */
		echo wp_kses_post($after_widget);
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] 				= strip_tags( $new_instance['title'] );
		$instance['signature_photo'] 	= $new_instance['signature_photo'];
		$instance['author_photo'] 		= $new_instance['author_photo'];
		$instance['author_name']		= $new_instance['author_name'];
		$instance['author_info'] 		= $new_instance['author_info'];

		return wp_kses_post($instance);
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => esc_html__('About Me', 'fotofly'), 'signature_photo' => '', 'author_photo' => '', 'author_name' => '', 'author_info' => '', 'hireme_text' => esc_html__('Hire Me', 'fotofly'), 'hireme_url' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e('Title:', 'fotofly'); ?></label><br />
			<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="width100" />
		</p>
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'author_photo' )); ?>"><?php esc_html_e('Author Photo', 'fotofly'); ?></label><br />
            <img src="<?php echo esc_url($instance['author_photo']); ?>" class="widefat fn_img" alt="" /><br />
            <input class="fn_widget_add_button" type="button" value="<?php esc_html_e('Add Photo', 'fotofly'); ?>" />
			<input type="hidden" class="author_photo width100" id="<?php echo esc_attr($this->get_field_id( 'author_photo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_photo' )); ?>" value="<?php echo esc_attr($instance['author_photo']); ?>"/>
		</p> 
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'author_name' )); ?>"><?php esc_html_e('Author Name', 'fotofly'); ?></label><br />
			<input id="<?php echo esc_attr($this->get_field_id( 'author_name' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_name' )); ?>" value="<?php echo esc_attr($instance['author_name']); ?>" class="width100" />
		</p> 
        <p>
			<label for="<?php echo esc_attr($this->get_field_id( 'author_info' )); ?>"><?php esc_html_e('Author Info', 'fotofly'); ?></label><br />
			<textarea id="<?php echo esc_attr($this->get_field_id( 'author_info' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author_info' )); ?>" class="width100" rows="4" cols="4"><?php echo wp_kses_post($instance['author_info']); ?></textarea>
		</p> 
		<p>
			<label for="<?php echo esc_attr($this->get_field_id( 'signature_photo' )); ?>"><?php esc_html_e('Signature Photo', 'fotofly'); ?></label><br />
            <img src="<?php echo esc_url($instance['signature_photo']); ?>" class="widefat fn_img" alt="" /><br />
            <input class="fn_widget_add_button" type="button" value="<?php esc_html_e('Add Photo', 'fotofly'); ?>" />
			<input type="hidden" class="signature_photo width100" id="<?php echo esc_attr($this->get_field_id( 'signature_photo' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'signature_photo' )); ?>" value="<?php echo esc_attr($instance['signature_photo']); ?>"  />
		</p> 

	<?php
	}
}