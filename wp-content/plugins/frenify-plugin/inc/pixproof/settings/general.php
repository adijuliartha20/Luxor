<?php
//not used yet - moved them to a per gallery option
return array(
	'type'    => 'postbox',
	'label'   => 'General Settings',
	'options' => array(
		'gallery_position_in_content' => array (
			'default'        => 'before',
			'type'           => 'select',
			'desc'	  => esc_html__( 'Select the gallery position in content: ', 'frenify-core'),
			'options' => array(
						'before'    => esc_html__( 'Before the content', 'frenify-core' ),
						'after' 	=> esc_html__( 'After the content', 'frenify-core' ),
					),
		),

		'enable_archive_zip_download'   => array(
			'label'          => esc_html__( 'Enable Images Download', 'frenify-core' ),
			'default'        => true,
			'type'           => 'switch',
			'show_group'     => 'enable_pixproof_gallery_group',
			'display_option' => true
		), /* ALL THESE PREFIXED WITH PORTFOLIO SHOULD BE KIDS!! **/

		'enable_pixproof_gallery_group' => array(
			'type'    => 'group',
			'options' => array(
				'zip_archive_generation' => array(
					'name'    => 'zip_archive_generation',
					'label'   => esc_html__( 'The ZIP archive should be generated:', 'frenify-core' ),
					'desc'    => esc_html__( 'How the archive file should be generated?', 'frenify-core' ),
					'default' => 'manual',
					'type'    => 'select',
					'options' => array(
						'manual'    => esc_html__( 'Manually (uploaded by the gallery owner)', 'frenify-core' ),
						'automatic' => esc_html__( 'Automatically (from the selected images)', 'frenify-core' ),
					),
				),
			)
		),


		/*'disable_pixproof_style'   => array(
			'label'          => esc_html__( 'Disable Plugin Style', 'frenify-core' ),
			'desc'           => esc_html__( 'If you want to style the PixProof galleries yourself you can remove the plugin style here ', 'frenify-core'),
			'default'        => false,
			'type'           => 'switch',
			'display_option' => true
		),*/
	)
); # config