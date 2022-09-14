<?php

// loads the shortcodes class, wordpress is loaded with it
require_once( 'shortcodes.class.php' );

// get popup type
$popup = trim( $_GET['popup'] );
$shortcode = new fotofly_fn_shortcodes( $popup );

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<body>
<div id="frenify-popup">

	<div id="frenify-shortcode-wrap">

		<div id="frenify-sc-form-wrap">

			<?php
			$select_shortcode = array(
				'select' 				=> 'Choose a Shortcode',
				'accordion' 			=> 'Accordion',
				'brochure' 				=> 'Brochure',
				'columns' 				=> 'Columns',
				'tdcontent' 			=> 'Content',
				'countersbox' 			=> 'Counters Box',
				'coverbox' 				=> 'Cover Box',
				'customtitle' 			=> 'Custom Title',
				'expandable' 			=> 'Expandable',
				'fullwidth' 			=> 'Full Width Container',
				'flowgallery' 			=> 'Flow Gallery',
				'galleryblock'  		=> 'Gallery Block',
				'kenburns'  			=> 'Kenburns',
				'person' 				=> 'Person',
				'progressbar'			=> 'Progress Bar',
				'supersized'			=> 'Supersized Slider',
				'tabs' 					=> 'Tabs',
				'testimonials' 			=> 'Testimonials',
				'workstep' 				=> 'Work Step',

				//'alert' 					=> 'Alert',
				//'blog' 					=> 'Blog',
				//'button' 					=> 'Button',
				//'checklist' 				=> 'Checklist',
				//'columns' 				=> 'Columns',
				//'contentboxes' 			=> 'Content Boxes',
				//'countersbox' 			=> 'Counters Box',					
				//'counterscircle' 			=> 'Counters Circle',
				//'dropcap' 				=> 'Dropcap',
				//'flipboxes' 				=> 'Flip Boxes',
				//'fontawesome' 			=> 'Font Awesome',
				//'frenifyslider' 			=> 'frenify Slider',
				//'googlemap' 				=> 'Google Map',
				//'highlight' 				=> 'Highlight',
				//'imagecarousel' 			=> 'Image Carousel',
				//'imageframe' 				=> 'Image Frame',
				//'lightbox' 				=> 'Lightbox',
				//'menuanchor' 				=> 'Menu Anchor',
				//'modaltextlink' 			=> 'Modal Text Link',
				//'onepagetextlink' 		=> 'One Page Text Link',
				//'popover' 				=> 'Popover',
				//'postslider' 				=> 'Post Slider',
				//'pricingtable' 			=> 'Pricing Table',
				//'sectionseparator' 		=> 'Section Separator',
				//'separator' 				=> 'Separator',
				//'sharingbox' 				=> 'Sharing Box',
				//'slider' 					=> 'Slider',
				//'sociallinks' 			=> 'Social Links',
				//'soundcloud' 				=> 'SoundCloud',
				//'table' 					=> 'Table',
				//'taglinebox' 				=> 'Tagline Box',
				//'comparison' 				=> 'Comparison',
				//'countdown' 				=> 'Countdown',
				//'gallery' 				=> 'Gallery',
				//'hotspot' 				=> 'Hotspot',
				//'intro' 					=> 'Intro',
				//'modal' 					=> 'Modal',
				//'recentposts' 			=> 'Recent Posts',
				//'service' 				=> 'Service',
				//'servicepack' 			=> 'Service Pack',
				//'servicetabs' 			=> 'Service Tabs',
				//'toggle' 					=> 'Toggles',
				//'tooltip' 				=> 'Tooltip',
				//'vimeo' 					=> 'Vimeo',
				//'woofeatured' 			=> 'Woocommerce Featured Products Slider',
				//'wooproducts' 			=> 'Woocommerce Products Slider',
				//'youtube' 				=> 'Youtube'
			);
			?>
			<table id="frenify-sc-form-table" class="frenify-shortcode-selector">
				<tbody>
					<tr class="form-row">
						<td class="label">Choose Shortcode</td>
						<td class="field">
							<div class="frenify-form-select-field">
							<div class="frenify-shortcodes-arrow">&#xf107;</div>
								<select name="fotofly_fn_select_shortcode" id="fotofly_fn_select_shortcode" class="frenify-form-select frenify-input">
									<?php foreach($select_shortcode as $shortcode_key => $shortcode_value): ?>
									<?php if($shortcode_key == $popup): $selected = 'selected="selected"'; else: $selected = ''; endif; ?>
									<option value="<?php echo $shortcode_key; ?>" <?php echo $selected; ?>><?php echo $shortcode_value; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
			<form method="post" id="frenify-sc-form">

				<table id="frenify-sc-form-table">

					<?php echo $shortcode->output; ?>

					<tbody class="frenify-sc-form-button">
						<tr class="form-row">
							<td class="field"><a href="#" class="frenify-insert">Insert Shortcode</a></td>
						</tr>
					</tbody>

				</table>
				<!-- /#frenify-sc-form-table -->

			</form>
			<!-- /#frenify-sc-form -->

		</div>
		<!-- /#frenify-sc-form-wrap -->

		<div class="clear"></div>

	</div>
	<!-- /#frenify-shortcode-wrap -->

</div>
<!-- /#frenify-popup -->

</body>
</html>