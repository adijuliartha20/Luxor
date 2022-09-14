// start the popup specefic scripts
// safe to use $
var old_tb_remove = window.tb_remove;
var using_text_editor = false;
var text_editor_toggle;
var html_editor_toggle;
var editor_area;
var cursor_position = 0;

jQuery(document).ready(function($) {
	var tb_remove = function() {
		// check if text editor shortcode button was used; if so return to it
		if ( using_text_editor ) {
			using_text_editor = false;
			window.switchEditors.switchto( jQuery('#content-html')[0] );
		}

		old_tb_remove();
	};

	window.fotofly_fn_tb_height = (92 / 100) * jQuery(window).height();
	window.fotofly_fn_fotofly_fn_shortcodes_height = (71 / 100) * jQuery(window).height();
	if(window.fotofly_fn_fotofly_fn_shortcodes_height > 550) {
		window.fotofly_fn_fotofly_fn_shortcodes_height = (74 / 100) * jQuery(window).height();
	}

	jQuery(window).resize(function() {
		window.fotofly_fn_tb_height = (92 / 100) * jQuery(window).height();
		window.fotofly_fn_fotofly_fn_shortcodes_height = (71 / 100) * jQuery(window).height();

		if(window.fotofly_fn_fotofly_fn_shortcodes_height > 550) {
			window.fotofly_fn_fotofly_fn_shortcodes_height = (74 / 100) * jQuery(window).height();
		}
	});

	fotofly_fn_shortcodes = {
		loadVals: function()
		{
			var shortcode = $('#_fotofly_fn_shortcode').text(),
				uShortcode = shortcode;

			// fill in the gaps eg {{param}}
			$('.frenify-input').each(function() {
				var input = $(this),
					id = input.attr('id'),
					id = id.replace('fotofly_fn_', ''),		// gets rid of the fotofly_fn_ prefix
					re = new RegExp("{{"+id+"}}","g");
					var value = input.val();
					if(value == null) {
					  value = '';
					}
				uShortcode = uShortcode.replace(re, value);
			});

			// adds the filled-in shortcode as hidden input
			$('#_fotofly_fn_ushortcode').remove();
			$('#frenify-sc-form-table').prepend('<div id="_fotofly_fn_ushortcode" class="hidden">' + uShortcode + '</div>');
		},
		cLoadVals: function()
		{
			var shortcode = $('#_fotofly_fn_cshortcode').text(),
				pShortcode = '';

				if(shortcode.indexOf("<li>") < 0) {
					shortcodes = '<br />';
				} else {
					shortcodes = '';
				}

			// fill in the gaps eg {{param}}
			$('.frenify-shortcodes-popup .child-clone-row').each(function() {
				var row = $(this),
					rShortcode = shortcode;

				if($(this).find('#fotofly_fn_slider_type').length >= 1) {
					if($(this).find('#fotofly_fn_slider_type').val() == 'image') {
						rShortcode = '[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]';
					} else if($(this).find('#fotofly_fn_slider_type').val() == 'video') {
						rShortcode = '[slide type="{{slider_type}}"]{{video_content}}[/slide]';
					}
				}
				$('.frenify-cinput', this).each(function() {
					var input = $(this),
						id = input.attr('id'),
						id = id.replace('fotofly_fn_', '')		// gets rid of the fotofly_fn_ prefix
						re = new RegExp("{{"+id+"}}","g");
						var value = input.val();
						if(value == null) {
						  value = '';
						}
					rShortcode = rShortcode.replace(re, input.val());
				});

				if(shortcode.indexOf("<li>") < 0) {
					shortcodes = shortcodes + rShortcode + '<br />';
				} else {
					shortcodes = shortcodes + rShortcode;
				}
			});

			// adds the filled-in shortcode as hidden input
			$('#_fotofly_fn_cshortcodes').remove();
			$('.frenify-shortcodes-popup .child-clone-rows').prepend('<div id="_fotofly_fn_cshortcodes" class="hidden">' + shortcodes + '</div>');

			// add to parent shortcode
			this.loadVals();
			pShortcode = $('#_fotofly_fn_ushortcode').html().replace('{{child_shortcode}}', shortcodes);

			// add updated parent shortcode
			$('#_fotofly_fn_ushortcode').remove();
			$('#frenify-sc-form-table').prepend('<div id="_fotofly_fn_ushortcode" class="hidden">' + pShortcode + '</div>');
		},
		children: function()
		{
			// assign the cloning plugin
			$('.frenify-shortcodes-popup .child-clone-rows').appendo({
				subSelect: '> div.child-clone-row:last-child',
				allowDelete: false,
				focusFirst: false,
				onAdd: function(row) {
					// Get Upload ID
					var prev_upload_id = jQuery(row).prev().find('.frenify-upload-button').data('upid');
					var new_upload_id = prev_upload_id + 1;
					jQuery(row).find('.frenify-upload-button').attr('data-upid', new_upload_id);

					// activate chosen
					jQuery('.frenify-form-multiple-select').chosen({
						width: '100%',
						placeholder_text_multiple: 'Select Options or Leave Blank for All'
					});

					// activate color picker
					jQuery('.wp-color-picker-field').wpColorPicker({
						change: function(event, ui) {
							fotofly_fn_shortcodes.loadVals();
							fotofly_fn_shortcodes.cLoadVals();
						}
					});

					// changing slide type
					var type = $(row).find('#fotofly_fn_slider_type').val();

					if(type == 'video') {
						$(row).find('#fotofly_fn_image_content, #fotofly_fn_image_url, #fotofly_fn_image_target, #fotofly_fn_image_lightbox').closest('li').hide();
						$(row).find('#fotofly_fn_video_content').closest('li').show();

						$(row).find('#_fotofly_fn_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
					}

					if(type == 'image') {
						$(row).find('#fotofly_fn_image_content, #fotofly_fn_image_url, #fotofly_fn_image_target, #fotofly_fn_image_lightbox').closest('li').show();
						$(row).find('#fotofly_fn_video_content').closest('li').hide();

						$(row).find('#_fotofly_fn_cshortcode').text('[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');
					}

					fotofly_fn_shortcodes.loadVals();
					fotofly_fn_shortcodes.cLoadVals();
				}
			});

			// remove button
			$('.frenify-shortcodes-popup .child-clone-row-remove').live('click', function() {
				var	btn = $(this),
					row = btn.parent();

				if( $('.frenify-shortcodes-popup .child-clone-row').size() > 1 )
				{
					row.remove();
				}
				else
				{
					alert('You need a minimum of one row');
				}

				return false;
			});

			// assign jUI sortable
			$( ".frenify-shortcodes-popup .child-clone-rows" ).sortable({
				placeholder: "sortable-placeholder",
				items: '.child-clone-row',
				cancel: 'div.iconpicker, input, select, textarea, a'
			});
		},
		resizeTB: function()
		{
			var	ajaxCont = $('#TB_ajaxContent'),
				tbWindow = $('#TB_window'),
				frenifyPopup = $('#frenify-popup');

			tbWindow.css({
				height: window.fotofly_fn_tb_height,
				width: frenifyPopup.outerWidth(),
				marginLeft: -(frenifyPopup.outerWidth()/2)
			});

			ajaxCont.css({
				paddingTop: 0,
				paddingLeft: 0,
				paddingRight: 0,
				height: window.fotofly_fn_tb_height,
				overflow: 'auto', // IMPORTANT
				width: frenifyPopup.outerWidth()
			});

			tbWindow.show();

			$('#frenify-popup').addClass('no_preview');
			$('#frenify-sc-form-wrap #frenify-sc-form').height(window.fotofly_fn_fotofly_fn_shortcodes_height);
		},
		load: function()
		{

			var	frenify = this,
				popup = $('#frenify-popup'),
				form = $('#frenify-sc-form', popup),
				shortcode = $('#_fotofly_fn_shortcode', form).text(),
				popupType = $('#_fotofly_fn_popup', form).text(),
				uShortcode = '';

			// if its the shortcode selection popup
			if($('#_fotofly_fn_popup').text() == 'shortcode-generator') {
				$('.frenify-sc-form-button').hide();
			}

			// resize TB
			fotofly_fn_shortcodes.resizeTB();
			$(window).resize(function() { fotofly_fn_shortcodes.resizeTB() });

			// initialise
			fotofly_fn_shortcodes.loadVals();
			fotofly_fn_shortcodes.children();
			fotofly_fn_shortcodes.cLoadVals();

			// update on children value change
			$('.frenify-cinput', form).live('change', function() {
				fotofly_fn_shortcodes.cLoadVals();
			});

			// update on value change
			$('.frenify-input', form).live('change', function() {
				fotofly_fn_shortcodes.loadVals();
			});

			// change shortcode when a user selects a shortcode from choose a dropdown field
			$('#fotofly_fn_select_shortcode').change(function() {
				var name = $(this).val();
				var label = $(this).text();

				if(name != 'select') {
					tinyMCE.activeEditor.execCommand("frenifyPopup", false, {
						title: label,
						identifier: name
					});

					$('#TB_window').hide();
				}
			});

			// activate chosen
			$('.frenify-form-multiple-select').chosen({
				width: '100%',
				placeholder_text_multiple: 'Select Options'
			});

			// update upload button ID
			jQuery('.frenify-upload-button:not(:first)').each(function() {
				var prev_upload_id = jQuery(this).data('upid');
				var new_upload_id = prev_upload_id + 1;
				jQuery(this).attr('data-upid', new_upload_id);
			});
		}
	}

	// run
	$('#frenify-popup').livequery(function() {
		fotofly_fn_shortcodes.load();

		$('#frenify-popup').closest('#TB_window').addClass('frenify-shortcodes-popup');

		$('#fotofly_fn_video_content').closest('li').hide();

			// activate color picker
			$('.wp-color-picker-field').wpColorPicker({
				change: function(event, ui) {
					setTimeout(function() {
						fotofly_fn_shortcodes.loadVals();
						fotofly_fn_shortcodes.cLoadVals();
					},
					1);
				}
			});
	});

	// when insert is clicked
	$('.frenify-insert').live('click', function() {

		if( using_text_editor ) {
			if( $('#fotofly_fn_select_shortcode').val() != 'table' ) {
				using_text_editor = false;

				// switch back to text editor mode
				window.switchEditors.switchto( text_editor_toggle[0] );

				var html = $('#_fotofly_fn_ushortcode').html().replace( /<br>/g, '' );

				// inserting the new shortcode at the correct position in the text editor content field
				editor_area.val( [ editor_area.val().slice(0, cursor_position), html, editor_area.val().slice(cursor_position)].join( '' ) );

				tb_remove();
			}

		} else if(window.tinyMCE)
		{
			window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, $('#_fotofly_fn_ushortcode').html());
			tb_remove();
		}
	});

	//tinymce.init(tinyMCEPreInit.mceInit['fotofly_fn_content']);
	//tinymce.execCommand('mceAddControl', true, 'fotofly_fn_content');
	//quicktags({id: 'fotofly_fn_content'});

	// activate upload button
	$('.frenify-upload-button').live('click', function(e) {
		e.preventDefault();

		upid = $(this).attr('data-upid');

		if($(this).hasClass('remove-image')) {
			$('.frenify-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', '').hide();
			$('.frenify-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', '');
			$('.frenify-upload-button[data-upid="' + upid + '"]').text('Upload').removeClass('remove-image');

			return;
		}

		var file_frame = wp.media.frames.file_frame = wp.media({
			title: 'Select Image',
			button: {
				text: 'Select Image',
			},
			frame: 'post',
			multiple: false  // Set to true to allow multiple files to be selected
		});

		file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();

		file_frame.on( 'select', function() {
			var selection = file_frame.state().get('selection');
			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				$('.frenify-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
				$('.frenify-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				fotofly_fn_shortcodes.loadVals();
				fotofly_fn_shortcodes.cLoadVals();
			});

			$('.frenify-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});

		file_frame.on( 'insert', function() {
			var selection = file_frame.state().get('selection');
			var size = jQuery('.attachment-display-settings .size').val();

			selection.map( function( attachment ) {
				attachment = attachment.toJSON();

				if(!size) {
					attachment.url = attachment.url;
				} else {
					attachment.url = attachment.sizes[size].url;
				}

				$('.frenify-upload-button[data-upid="' + upid + '"]').parent().find('img').attr('src', attachment.url).show();
				$('.frenify-upload-button[data-upid="' + upid + '"]').parent().find('input').attr('value', attachment.url);

				fotofly_fn_shortcodes.loadVals();
				fotofly_fn_shortcodes.cLoadVals();
			});

			$('.frenify-upload-button[data-upid="' + upid + '"]').text('Remove').addClass('remove-image');
			$('.media-modal-close').trigger('click');
		});
	});

	// activate iconpicker
	$('.iconpicker i').live('click', function(e) {
		e.preventDefault();

		var iconWithPrefix = $(this).attr('class');
		var fontName = $(this).attr('data-name');

		if($(this).hasClass('active')) {
			$(this).parent().find('.active').removeClass('active');

			$(this).parent().parent().find('input').attr('value', '');
		} else {
			$(this).parent().find('.active').removeClass('active');
			$(this).addClass('active');

			$(this).parent().parent().find('input').attr('value', fontName);
		}

		fotofly_fn_shortcodes.loadVals();
		fotofly_fn_shortcodes.cLoadVals();
	});

	// table shortcode
	$('#frenify-sc-form-table .frenify-insert').live('click', function(e) {
		e.stopPropagation();

		var shortcodeType = $('#fotofly_fn_select_shortcode').val();

		if(shortcodeType == 'table') {
			var type = $('#frenify-sc-form-table #fotofly_fn_type').val();
			var columns = $('#frenify-sc-form-table #fotofly_fn_columns').val();

			var text = '<div class="frenify-table table-' + type + '"><table width="100%"><thead><tr>';

			for(var i=0;i<columns;i++) {
				text += '<th>Column ' + (i + 1) + '</th>';
			}

			text += '</tr></thead><tbody>';

			for(var i=0;i<columns;i++) {
				text += '<tr>';
				if(columns >= 1) {
					text += '<td>Item #' + (i + 1) + '</td>';
				}
				if(columns >= 2) {
					text += '<td>Description</td>';
				}
				if(columns >= 3) {
					text += '<td>Discount:</td>';
				}
				if(columns >= 4) {
					text += '<td>$' + (i + 1) + '.00</td>';
				}
				if(columns >= 5) {
					text += '<td>$ 0.' + (i + 1) + '0</td>';
				}
				if(columns >= 6) {
					text += '<td>$ 0.' + (i + 1) + '0</td>';
				}
				text += '</tr>';
			}

			text += '<tr>';

			if(columns >= 1) {
				text += '<td><strong>All Items</strong></td>';
			}
			if(columns >= 2) {
				text += '<td><strong>Description</strong></td>';
			}
			if(columns >= 3) {
				text += '<td><strong>Your Total:</strong></td>';
			}
			if(columns >= 4) {
				text += '<td><strong>$10.00</strong></td>';
			}
			if(columns >= 5) {
				text += '<td><strong>Tax: $10.00</strong></td>';
			}
			if(columns >= 6) {
				text += '<td><strong>Gross: $10.00</strong></td>';
			}
			text += '</tr>';
			text += '</tbody></table></div>';

			if( using_text_editor ) {
				using_text_editor = false;

				// switch back to text editor mode
				window.switchEditors.switchto( text_editor_toggle[0] );

				// inserting the new shortcode at the correct position in the text editor content field
				editor_area.val( [ editor_area.val().slice(0, cursor_position), text, editor_area.val().slice(cursor_position)].join( '' ) );

				tb_remove();
			} else if(window.tinyMCE)
			{
				window.tinyMCE.activeEditor.execCommand('mceInsertContent', false, text);
				tb_remove();
			}
		}
	});

	// slider shortcode
	$('#fotofly_fn_slider_type').live('change', function(e) {
		e.preventDefault();

		var type = $(this).val();
		if(type == 'video') {
			$(this).parents('ul').find('#fotofly_fn_image_content, #fotofly_fn_image_url, #fotofly_fn_image_target, #fotofly_fn_image_lightbox').closest('li').hide();
			$(this).parents('ul').find('#fotofly_fn_video_content').closest('li').show();

			$('#_fotofly_fn_cshortcode').text('[slide type="{{slider_type}}"]{{video_content}}[/slide]');
		}

		if(type == 'image') {
			$(this).parents('ul').find('#fotofly_fn_image_content, #fotofly_fn_image_url, #fotofly_fn_image_target, #fotofly_fn_image_lightbox').closest('li').show();
			$(this).parents('ul').find('#fotofly_fn_video_content').closest('li').hide();

			$('#_fotofly_fn_cshortcode').text('[slide type="{{slider_type}}" link="{{image_url}}" linktarget="{{image_target}}" lightbox="{{image_lightbox}}"]{{image_content}}[/slide]');
		}
	});

	$('.frenify-add-video-shortcode').live('click', function(e) {
		e.preventDefault();

		var shortcode = $(this).attr('href');
		var content = $(this).parents('ul').find('#fotofly_fn_video_content');

		content.val(content.val() + shortcode);
		fotofly_fn_shortcodes.cLoadVals();
	});

	$('#frenify-popup textarea').live('focus', function() {
		var text = $(this).val();

		if(text == 'Your Content Goes Here') {
			$(this).val('');
		}
	});

	$('.frenify-gallery-button').live('click', function(e) {
		var gallery_file_frame;

		e.preventDefault();

		alert('To add images to this post or page for attachments layout, navigate to "Upload Files" tab in media manager and upload new images.');

		gallery_file_frame = wp.media.frames.gallery_file_frame = wp.media({
			title: 'Attach Images to Post/Page',
			button: {
				text: 'Go Back to Shortcode',
			},
			frame: 'post',
			multiple: true  // Set to true to allow multiple files to be selected
		});

		gallery_file_frame.open();

		$('.media-menu a:contains(Insert from URL)').remove();

		$('.media-menu-item:contains("Upload Files")').trigger('click');

		gallery_file_frame.on( 'select', function() {
			$('.media-modal-close').trigger('click');

			fotofly_fn_shortcodes.loadVals();
			fotofly_fn_shortcodes.cLoadVals();
		});
	});

	// text editor shortcode button was used
	jQuery(window).resize(function() {
		$('.quicktags-toolbar input[id*=fotofly_fn_shortcodes_text_mode]').addClass( 'frenify-shortcode-generator-button' );
	});
	$( '.switch-html, .frenify-expand-child' ).live('click', function(e) {
		$('.quicktags-toolbar input[id*=fotofly_fn_shortcodes_text_mode]').addClass( 'frenify-shortcode-generator-button' );
	});

	$('.quicktags-toolbar input[id*="fotofly_fn_shortcodes_text_mode"]').each(function() {
		$(this).addClass( 'frenify-shortcode-generator-button' );
	});

	$('.quicktags-toolbar input[id*=fotofly_fn_shortcodes_text_mode]').live('click', function(e) {

		var popup = 'shortcode-generator';

		// set the flag for text editor, change to visual editor
		using_text_editor = true;
		text_editor_toggle = $( this ).parents( '.wp-editor-wrap' ).find( '.wp-switch-editor.switch-html');
		html_editor_toggle = $( this ).parents( '.wp-editor-wrap' ).find( '.wp-switch-editor.switch-tmce');
		editor_area = $( this ).parents( '.wp-editor-container' ).find( '.wp-editor-area' );

		cursor_position = editor_area.getCursorPosition();

		window.switchEditors.switchto( html_editor_toggle[0] );

		// load thickbox
		tb_show("Frenify Shortcodes", ajaxurl + "?action=fotofly_fn_shortcodes_popup&popup=" + popup);

		jQuery('#TB_window').hide();
	});
});


// Helper function to check the cursor position of text editor content field before the shortcode generator is opened
(function($, undefined) {
    $.fn.getCursorPosition = function() {
        var el = $(this).get(0);
        var pos = 0;
        if ('selectionStart' in el) {
            pos = el.selectionStart;
        } else if ('selection' in document) {
            el.focus();
            var Sel = document.selection.createRange();
            var SelLength = document.selection.createRange().text.length;
            Sel.moveStart('character', -el.value.length);
            pos = Sel.text.length - SelLength;
        }
        return pos;
    }
})(jQuery);