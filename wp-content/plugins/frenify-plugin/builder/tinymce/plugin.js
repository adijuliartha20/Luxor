tinymce.PluginManager.add('fotofly_fn_button', function(ed, url) {
	ed.addCommand("frenifyPopup", function ( a, params )
	{
		var popup = 'shortcode-generator';

		if(typeof params != 'undefined' && params.identifier) {
			popup = params.identifier;
		}

		// load thickbox
		tb_show("Frenify Shortcodes", ajaxurl + "?action=fotofly_fn_shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});

	// Add a button that opens a window
	/*ed.addButton('fotofly_fn_button', {
		text: '',
		icon: true,
		image: frenifyShortcodes.plugin_folder + '/builder/tinymce/images/icon.png',
		cmd: 'frenifyPopup'
	});*/
});