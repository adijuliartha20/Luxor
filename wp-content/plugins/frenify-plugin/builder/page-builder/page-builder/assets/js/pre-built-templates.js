
( function ( $ ) {
	"use strict";
	$.frenifyPreBuiltTemplates = ( function () {
		
		var loadTemplateHanlder 	= $( '.fotofly_fn_pre_built_template' );
		window.preBuiltTemplateID   = null;
		
		$( document ).ready( function () {
			
			//function to load pre built template
			loadTemplateHanlder.live('click', function ( e ) {
				if ( confirm( "Do you want to replace the current page content with the pre built template content? This action cannot be reversed." ) ) {
					getPreBuiltTemplateContent( $(this).attr( "data-id" ) );
				}
			});
			
			//function to get template data from server
			function getPreBuiltTemplateContent ( templateID ) {
				
				//show loader
				DdHelper.showHideLoader('show','');
				//setup data
				var data = {
								action		: 'fotofly_fn_custom_tabs',
								post_action : 'load_prebuilt_template',
								ID			: templateID
				};
				
				
				$.post(ajaxurl, data ,function( response ) {
					
					var data = {
									action		  : 'fotofly_fn_content_to_elements',
									content		 : response
					};
					
					$.post(ajaxurl, data ,function( response ) {
						
						//turn off tracking first, so these actions are not captured
						frenifyHistoryManager.turnOffTracking();
						//remove all current editor elements first
						Editor.deleteAllElements();
						//reset models with new elements
						app.editor.selectedElements.reset( response );
						//turn on tracking
						frenifyHistoryManager.turnOnTracking();
						//capture editor
						frenifyHistoryManager.captureEditor();
						//hide loads
						DdHelper.showHideLoader('hide');
					});
				});
				
			}
		});
	
	});
	
	$(document).ready(function () {
		
		$.frenifyPreBuiltTemplatesObj = new $.frenifyPreBuiltTemplates();
	});

}(jQuery));

