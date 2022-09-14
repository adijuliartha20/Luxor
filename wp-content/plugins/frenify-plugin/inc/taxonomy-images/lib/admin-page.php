<div class="wrap">
	<h2 class="frenify-page-heading"><?php echo __('Taxonomy Images', 'hb'); ?></h2>

	<form method="post" action="<?php echo admin_url('admin.php?page=frenify_tax_images'); ?>">
	
		<?php settings_fields( 'easy-tax-images-settings' ); ?>
		
		<div class="form-table">

			<div class="frenify-field-wrap">
				<div class="frenify-single-field">
                    <h3>
                        <?php echo __('Disable Featured Images for Following Taxonomies ', 'frenify'); ?>
                    </h3>
					<?php
						$options = get_option('frenify_options');
						$disabled_taxonomies = array('nav_menu', 'link_category', 'post_format');
						foreach ( get_taxonomies() as $tax) : 
							if (in_array($tax, $disabled_taxonomies)) 
								continue; 
						?>
							<input 
								type="checkbox"
                                class="css-checkbox"
                                id="css-checkbox-featured<?php echo $tax ?>"
                                name="frenify_options[excluded_taxonomies_featured][<?php echo $tax ?>]"
								value="<?php echo $tax ?>" 
								<?php checked(isset($options['excluded_taxonomies_featured'][$tax])); ?>
							>
                            <label class="css-label" for="css-checkbox-featured<?php echo $tax ?>">
                                <?php echo $tax ?>
                            </label>
						<?php endforeach;
					?>
				</div>

                <!--<div class="frenify-single-field">
                    <h3>
                        <?php echo __('Disable Cover Images for Following Taxonomies ', 'frenify'); ?>
                    </h3>
                    <?php
                    $options = get_option('frenify_options');
                    $disabled_taxonomies = array('nav_menu', 'link_category', 'post_format');
                    foreach ( get_taxonomies() as $tax) :
                        if (in_array($tax, $disabled_taxonomies))
                            continue;
                        ?>
                        <input
                            type="checkbox"
                            class="css-checkbox"
                            id="css-checkbox-cover<?php echo $tax ?>"
                            name="frenify_options[excluded_taxonomies_cover][<?php echo $tax ?>]"
                            value="<?php echo $tax ?>"
                            <?php checked(isset($options['excluded_taxonomies_cover'][$tax])); ?>
                            >
                        <label class="css-label" for="css-checkbox-cover<?php echo $tax ?>">
                            <?php echo $tax ?>
                        </label>
                    <?php endforeach;
                    ?>
                </div>-->

                <!--<div class="frenify-single-field frenify-image-wrap">
                    <h3>
                        <?php
                            _e('Default Feature Image Placeholder', 'frenify');
                        ?>
                    </h3>
                    <img class="frenify_image" src="<?php echo isset($options['default_featured_image']) ? $options['default_featured_image'] : ''  ?>"/><br/>
                    <input type="text" class="frenify_image_url" name="frenify_options[default_featured_image]" id="default_featured_image" value="<?php echo isset($options['default_featured_image']) ? $options['default_featured_image'] : ''  ?>" />
                    <br/>
                    <button class="frenify_upload_image button">
                        <?php
                        _e('Add Default Featured Image', 'frenify');
                        ?>
                    </button>
                </div>-->

                <!--<div class="frenify-single-field frenify-image-wrap">
                    <h3>
                        <?php
                        _e('Default Cover Image Placeholder', 'frenify');
                        ?>
                    </h3>
                    <img class="frenify_image" src="<?php echo isset($options['default_cover_image']) ? $options['default_cover_image'] : ''  ?>"/><br/>
                    <input type="text" class="frenify_image_url" name="frenify_options[default_cover_image]" id="default_cover_image" value="<?php echo isset($options['default_cover_image']) ? $options['default_cover_image'] : ''  ?>" />
                    <br/>
                    <button class="frenify_upload_image button">
                        <?php
                        _e('Add Default Cover Image', 'frenify');
                        ?>
                    </button>
                </div>-->
			</div>

		</div>
		<div class="frenify-field-wrap">
			<?php submit_button('Save'); ?>
		</div>
	</form>
</div>
