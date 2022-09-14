<?php
/**
 * Template used to display the pixproof gallery
 * Available vars:
 * string       $client_name
 * string       $event_date
 * int          $number_of_images
 * string       $file
 */
?>
<div id="pixproof_data" class="pixproof-data">
	<div class="grid">
		<ul>
			<?php if ( ! empty( $client_name )) { ?>
			<!-- CLIENT NAME -->
			<li class="grid__item">
				<div class="entry__meta-box">
					<span class="title"><?php esc_attr_e('Client:', 'frenify-core');?></span>
					<span class="value"><?php echo $client_name; ?></span>
				</div>
			</li>
			<!-- /CLIENT NAME -->
			<?php
			}
			if ( ! empty( $event_date )) {
			?>
			<!-- EVENT DATE -->
			<li class="grid__item">
				<div class="entry__meta-box">
					<span class="title"><?php esc_html_e('Event Date:', 'frenify-core');?></span>
					<span class="value"><?php echo $event_date; ?></span>
				</div>
			</li>
			<!-- /EVENT DATE -->
			<?php
			}
			if ( ! empty( $number_of_images )) {
			?>
			<!-- NUMBER OF IMAGES -->
			<li class="grid__item">
				<div class="entry__meta-box">
					<span class="title"><?php esc_html_e('Images:', 'frenify-core');?></span>
					<span class="value"><?php echo $number_of_images; ?></span>
				</div>
			</li>
			<!-- /NUMBER OF IMAGES -->
			<?php
			}
			if ( ! empty( $file )) { ?>
			<!-- DOWNLOAD -->
			<li class="grid__item last">
				<div class="entry__meta-box">
					<button class="button-download button js-download" onclick="window.open('<?php echo $file; ?>')"><?php esc_html_e('Download Images', 'frenify-core');?></button>
				</div>
			</li>
			<!-- /DOWNLOAD -->
			<?php } ?>
		</ul>
	</div>
</div>
<?php
