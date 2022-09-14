/*
* Previews of builder elements
*/
( function($) {

	var frenifyPreview		= {};
	window.frenifyPreview 	= frenifyPreview;
	
	
	/**
	* Caller for respective element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updatePreview = function ( thisRef, model, subElements ) {
		if(typeof model.get('css_class') != 'undefined' && model.get('css_class').indexOf('frenify_fn_layout_column') > -1) {
			return;
		}

		switch( model.get( 'php_class' ) ) { //switch case on name of element
			case 'frenify_fn_AlertBox':
				frenifyPreview.updateAlertPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_WpBlog':
				frenifyPreview.updateBlogPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ButtonBlock':
				frenifyPreview.updateButtonPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_CheckList':
				frenifyPreview.updateChecklistPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Client':
				frenifyPreview.updateClientPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_ClientSlider':
				frenifyPreview.updateClientSliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ContentBoxes':
				frenifyPreview.updateContentBoxesPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_CounterBox':
				frenifyPreview.updateCounterBoxPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_FlipBoxes':
				frenifyPreview.updateFlipBoxesPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_FontAwesome':
				frenifyPreview.updateFontAwesomePreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_frenifySlider':
				frenifyPreview.updatefrenifySliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_GoogleMap':
				frenifyPreview.updateGoogleMapPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Gallery':
				frenifyPreview.updateGalleryPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Supersized':
				frenifyPreview.updateSupersizedPreview( thisRef, model, subElements );
			break;
				
			case 'frenify_fn_Kenburns':
				frenifyPreview.updateKenburnsPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_FlowGallery':
				frenifyPreview.updateFlowGalleryPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ImageFrame':
				frenifyPreview.updateImageFramePreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ImageCarousel':
				frenifyPreview.updateImageCarouselPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Intro':
				frenifyPreview.updateIntroPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_LightBox':
				frenifyPreview.updateLightBoxPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_LayerSlider':
				frenifyPreview.updateLayerSliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_MenuAnchor':
				frenifyPreview.updateMenuAnchorPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Modal':
				frenifyPreview.updateModalPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Person':
				frenifyPreview.updatePersonPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_WorkStep':
				frenifyPreview.updateWorkStepPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Service':
				frenifyPreview.updateServicePreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Servicepack':
				frenifyPreview.updateServicepackPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Comparison':
				frenifyPreview.updateComparisonPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Hotspot':
				frenifyPreview.updateHotspotPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_PostSlider':
				frenifyPreview.updatePostSliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_PricingTable':
				frenifyPreview.updatePricingTablePreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ProgressBar':
				frenifyPreview.updateProgressBarPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_RecentPosts':
				frenifyPreview.updateRecentPostsPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_GalleryBlock':
				frenifyPreview.updateGalleryBlockPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ProjectSlider':
				frenifyPreview.updateProjectSliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_ProjectFullwidth':
				frenifyPreview.updateProjectFullwidthPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_RevolutionSlider':
				frenifyPreview.updateRevSliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Separator':
				frenifyPreview.updateSeparatorPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Servicetabs':
				frenifyPreview.updateServicetabsPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_SharingBox':
				frenifyPreview.updateSharingBoxPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Slider':
				frenifyPreview.updateSliderPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_SoundCloud':
				frenifyPreview.updateSoundCloudPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Tabs':
				frenifyPreview.updateTabsPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Table':
				frenifyPreview.updateTablePreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_TaglineBox':
				frenifyPreview.updateTaglineBoxPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Testimonial':
				frenifyPreview.updateTestimonialPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_frenifyText':
				frenifyPreview.updateTextBlockPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_CustomTitle':
				frenifyPreview.updateCustomTitlePreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Accordion':
				frenifyPreview.updateAccordionPreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Toggle':
				frenifyPreview.updateTogglePreview( thisRef, model, subElements );
			break;
			
			case 'frenify_fn_Expandable':
				frenifyPreview.updateExpandablePreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Vimeo':
				frenifyPreview.updateVimeoPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_WooShortcodes':
				frenifyPreview.updateWooShortcodesPreview( thisRef, model, subElements );
			break;

			case 'frenify_fn_Youtube':
				frenifyPreview.updateYoutubePreview( thisRef, model, subElements );
			break;

			default:
				$(thisRef.el).find('.innerElement').html( model.get('innerHtml') );
		}
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateAlertPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		var icon		= '';
		//for icon
		switch(subElements[0].value ) {
			case 'general':
				icon = 'fa fa-lg fa-info-circle';
			break;
			case 'error':
				icon = 'fa fa-lg fa-exclamation-triangle';
			break;
			case 'success':
				icon = 'fa fa-lg fa-check-circle';
			break;
			case 'notice':
				icon = 'fa fa-lg fa-lg fa-cog';
			break;
			case 'custom':
				icon = 'fa '+subElements[4].value;
			break;
		}
		innerHtml 		= innerHtml.replace( $(innerHtml).find('sub.sub').html() , subElements[6].value );
		innerHtml 		= innerHtml.replace( $(innerHtml).find('i').attr('class') , icon );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateBlogPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		innerHtml 		= innerHtml.replace( $(innerHtml).find('span.blog_layout').html() , subElements[0].value );
		if(subElements[0].value == 'grid') {
			innerHtml 		= innerHtml.replace( $(innerHtml).find('font.blog_columns').html() , '<br /> columns = ' + subElements[19].value );
		} else {
			innerHtml 		= innerHtml.replace( $(innerHtml).find('font.blog_columns').html(), '' );
		}

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateButtonPreview = function( thisRef, model, subElements ) {

		var innerHtml 	=  model.get('innerHtml');
		var buttonStyle	= '';
		//for button color
		switch( subElements[1].value ) {
			case 'custom':
				var topC = ( subElements[8].value == 'transparent' ) ? '#ebeaea' : subElements[8].value;
				var botC = subElements[9].value;
				var acnC = subElements[12].value;
				buttonStyle = "background: "+topC+";background: -moz-linear-gradient(top,  "+topC+" 0%, "+botC+" 100%);background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,"+topC+"), color-stop(100%,"+botC+"));background: -webkit-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: -o-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: -ms-linear-gradient(top,  "+topC+" 0%,"+botC+" 100%);background: linear-gradient(to bottom,  "+topC+" 0%,"+botC+" 100%);filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='"+topC+"', endColorstr='"+botC+"',GradientType=0 );border: 1px solid #fff;color: #fff;border: 1px solid "+acnC+";color: "+acnC+";";
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('style') , buttonStyle );
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('class') , 'button custom' );
			break;

			default:
				buttonStyle		= "button "+subElements[1].value;
				innerHtml 		= innerHtml.replace( $(innerHtml).find('a.button').attr('class') , buttonStyle );
			break;
		}
		innerHtml 		= innerHtml.replace( $(innerHtml).find('span.frenify-button-text').html() , subElements[7].value );


		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateChecklistPreview = function( thisRef, model, subElements ) {

		var innerHtml 		=  model.get('innerHtml');
		var totalElements 	= subElements[7].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i <  totalElements; i ++) {
			element		= subElements[7].elements[i];
			value		= '';
			//fot HTML
			if( /<[a-z][\s\S]*>/i.test( element[1].value ) ) {
				value = $(element[1].value).text();
			}else {
				value = element[1].value;
			}

			if( element[1].value != '' ) {
				previewData+= '<li><i ';
				if( element[0].value != '' ) {
					previewData+= 'class="fa '+element[0].value+'"></i>';
				} else {
					previewData+= 'class="fa '+subElements[0].value+'"></i>';
				}
				previewData+=  value;
				previewData+= '</li>';
				counter++;
			}
			if( counter == 3 ) { break; }
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.checklist_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateClientPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[8].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[8].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[1].value+'">';
			previewData+= '</li>';

			if( i == 3 ) break;
		}

		innerHtml = innerHtml.replace( $(innerHtml).find('ul.client_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateClientSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[3].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[3].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[2].value+'">';
			previewData+= '</li>';

			if( i == 4 ) break;
		}

		innerHtml = innerHtml.replace( $(innerHtml).find('ul.client_slider_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateContentBoxesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.content_boxes_layout').html() , subElements[1].value );
		innerHtml			= innerHtml.replace( $(innerHtml).find('font.content_boxes_columns').html() , subElements[2].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateCounterBoxPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.counter_box_columns').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateFlipBoxesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.flip_boxes_columns').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateFontAwesomePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var previewData		= '';
		var iconElement		= '';
		//for icon
		if( !subElements[0].value.trim() ) {
			iconElement = '<i class="frenifya-flag" style="color:'+subElements[3].value+'"></i>';
		} else {
			iconElement = '<i class="fa '+subElements[0].value+'" style="color:'+subElements[3].value+'"></i>';
		}
		//for circle
		if( subElements[1].value == 'yes' ) {
			previewData = '<h3 style="background:'+subElements[4].value+'">'+iconElement+'</h3>';
		} else {
			previewData = iconElement;
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.frenify_fn_iconbox_icon').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updatefrenifySliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.frenify_fn_slider_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateGoogleMapPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.google_map_address').html() , subElements[16].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateImageFramePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[9].value+'">' );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateImageCarouselPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[12].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[12].elements[i];
			previewData+= '<li>';
			previewData+= ' <img src="'+element[2].value+'">';
			previewData+= '</li>';

			if( i == 4 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.image_carousel_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateGalleryPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= '<li>';
				previewData+= ' <img src="'+element[0].value+'">';
				previewData+= '</li>';
	
				
			}
			
			if( i == 3 ) break;
			
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateSupersizedPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value !== '' ) {
				previewData+= '<li>';
				previewData+= ' <img src="'+element[0].value+'">';
				previewData+= '</li>';
	
				
			}
			
			if( i === 3 ) {break;}
			
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	};
	
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateKenburnsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];

			//if name exists
			if ( element[0].value !== '' ) {
				previewData+= '<li>';
				previewData+= ' <img src="'+element[0].value+'">';
				previewData+= '</li>';
	
				
			}
			
			if( i === 3 ) {break;}
			
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	};
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateFlowGalleryPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';
		
		if(totalElements !== '' || totalElements !== 'undefined' || totalElements !== null){
			for ( i = 0; i < totalElements; i ++) {
				element 	= subElements[6].elements[i];
	
				//if name exists
				if ( element[0].value !== '' ) {
					previewData+= '<li>';
					previewData+= ' <img src="'+element[0].value+'">';
					previewData+= '</li>';
				}
				if( i === 3 ) {break;}
			}
		}
		
		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.gallery_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	};
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateLayerSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.layer_slider_id').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateMenuAnchorPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.anchor_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateModalPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.modal_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updatePersonPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[2].value+'">' );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.person_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	frenifyPreview.updateComparisonPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[0].value+'"> <img src="'+subElements[1].value+'">' );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	
	
	frenifyPreview.updateHotspotPreview = function( thisRef, model, subElements ) {
		
		
		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];
			if( element[6].value != '' ) {
				previewData+= '<li> - '+element[6].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.list_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	// SERVICE
	frenifyPreview.updateWorkStepPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.workstep_name').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	
	// SERVICE
	frenifyPreview.updateServicePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('div.img_frame_section').html() , '<img src="'+subElements[0].value+'">' );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.service_name').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	
	// SERVICE PACK
	frenifyPreview.updateServicepackPreview = function( thisRef, model, subElements ) {
		
		
		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[9].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[9].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li> - '+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.list_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updatePostSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		//for attachment layout
		if( subElements[0].value == 'attachments' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.cat_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.cat_container').attr('style') , 'display:' );
		}
		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.post_slider_layout').html() , subElements[0].value );

		var cat				= ( !subElements[2].value.trim() ) ? 'all' : subElements[2].value;
		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.post_slider_cat').html() , cat );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updatePricingTablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var columns			= subElements[4].value.match(/pricing_column/g);

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.pricing_table_style').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.pricing_table_columns').html() , columns.length / 2 );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateProgressBarPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.progress_bar_text').html() , subElements[9].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateRecentPostsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('.recent_posts span').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateGalleryBlockPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');


		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.gallery_block_layout').html() , subElements[0].value );

		var cats 			= frenifyParser.getUniqueElements(subElements[1].value).join();
		cats 				= ( cats == '' ? 'All' : cats);
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.gallery_block_cats').html() , cats );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateProjectSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');


		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.project_slider_layout').html() , subElements[0].value );

		var cats 			= frenifyParser.getUniqueElements(subElements[1].value).join();
		cats 				= ( cats == '' ? 'All' : cats);
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.project_slider_cats').html() , cats );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateProjectFullwidthPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');


		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.project_fullwidth_layout').html() , subElements[0].value );

		var cats 			= frenifyParser.getUniqueElements(subElements[1].value).join();
		cats 				= ( cats == '' ? 'All' : cats);
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.project_fullwidth_cats').html() , cats );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateRevSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.rev_slider_name').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateSeparatorPreview = function( thisRef, model, subElements ) {

		var innerHtml 			= model.get('innerHtml');
		var sep_css, icon_css	= '';
		subElements[0].value 	= ( !subElements[0].value.trim() ) ? 'none' : subElements[0].value;
		innerHtml 				= innerHtml.replace( $(innerHtml).find('section').attr('class') , 'separator ' + subElements[0].value.replace("|", "_") );

		switch( subElements[0].value ) {

			case 'none':
				//do nothing
			break;

			case 'double':
				  sep_css	= 'border-bottom: 1px solid '+subElements[3].value+';border-top: 1px solid '+subElements[3].value+';';
			break;

			case 'double|dashed':
				sep_css		= 'border-bottom: 1px dashed '+subElements[3].value+';border-top: 1px dashed '+subElements[3].value+';';
			break;

			case 'double|dotted':
				sep_css		= 'border-bottom: 1px dotted '+subElements[3].value+';border-top: 1px dotted '+subElements[3].value+';';
			break;

			case 'shadow':
				sep_css		= 'background:radial-gradient(ellipse at 50% -50% , '+subElements[3].value+' 0px, rgba(255, 255, 255, 0) 80%) repeat scroll 0 0 rgba(0, 0, 0, 0)';
			break;

			default:
				sep_css		= 'background:'+subElements[3].value+';';
			break;

		}

		// width
		if( subElements[8].value != '' ) {
			sep_css += 'width:'+subElements[7].value+';';

			// alignment
			if( subElements[9].value == 'left' ) {
				sep_css += 'margin-left:5%;margin-right:0;';
			} else if ( subElements[9].value == 'right' ) {
				sep_css += 'float:right;margin-right:5%;';
			}
		}

		if( subElements[3].value != '' || subElements[8].value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('section').attr('style') , sep_css );
		}

		//for icon
		if( subElements[0].value != 'none' && subElements[0].value != '' && subElements[5].value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('class') , "icon fa "+subElements[5].value);
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('class') , "fake_class");
		}
		//color for circle border
		if ( subElements[6].value != 'no' ) {
			icon_css 			= "color:"+subElements[3].value+";border-color:"+subElements[3].value+';';
		} else {
			icon_css 			= "color:"+subElements[3].value+";border-color:transparent;";
		}

		//color for circle bg
		if ( subElements[7].value != '' ) {
			icon_css 			+= "background-color:"+subElements[7].value;
		}

		innerHtml 				= innerHtml.replace( $(innerHtml).find('i:eq(1)').attr('style') , icon_css );

		//for upper content
		if( subElements[0].value != 'none' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.upper_container').attr('style') , 'display:none' );
		} else {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('span.upper_container').attr('style') , '' );
		}
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateSharingBoxPreview  = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.sharing_tagline').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateSliderPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];

			previewData+= '<li>';
			if( element[0].value == 'video' ) {
				previewData+= '<h1 class="video_type">Video</h1>';
			} else if ( element[0].value == 'image' ) {
				previewData+= ' <img src="'+element[1].value+'">';
			}
			previewData+= '</li>';

			if( i == 4 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.slider_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateSoundCloudPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.soundcloud_url').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateTabsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[6].elements.length;
		var previewData		= '';
		var counter			= 0;
		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[6].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.tabs_elements').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateTablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('span.table_style').html() , subElements[0].value );
		innerHtml 			= innerHtml.replace( $(innerHtml).find('font.table_columns').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateTaglineBoxPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.tagline_title').html() , subElements[15].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateTestimonialPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[4].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[4].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= '- ' + element[0].value + ',<br /> ';
			}
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.testimonial_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateServicetabsPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[4].elements.length;
		var previewData		= '';

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[4].elements[i];

			//if name exists
			if ( element[0].value != '' ) {
				previewData+= '- ' + element[0].value + '<br /> ';
			}
			//if company exists
			/*if( element[0].value != '' ) {
				previewData+= ', '+element[0].value+'<br>';
			} else {
				previewData+= ', <br>';
			}*/
		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.servicetabs_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateTextBlockPreview = function( thisRef, model, subElements ) {

		var text_block 		= $.parseHTML( subElements[0].value );
		var text_block_html = '';
		var insert_icon = '';

		$(text_block).each(function() {
			if($(this).get(0).tagName != 'IMG' && typeof $(this).get(0).tagName != 'undefined') {
				var childrens = $($(this).get(0)).find('*');
				var child_img = false;
				if(childrens.length >= 1) {
					$.each(childrens, function() {
						if($(this).get(0).tagName == 'IMG') {
							child_img = true;
						}
					});
				}
				if(child_img == true) {
					text_block_html += $(this).outerHTML();
				} else {
					text_block_html += $(this).text();
				}
			} else {
				text_block_html += $(this).outerHTML();
			}
		});

		if(text_block_html.indexOf('[/pricing_table]') > -1) {
			insert_icon = '<span class="text-block-icon"><i class="frenifya-icon frenifya-dollar"></i>Pricing Table</span>';
		}

		if(subElements[0].value.indexOf('<div class="table-1">') > -1 || subElements[0].value.indexOf('<div class="table-2">') > -1) {
			insert_icon = '<span class="text-block-icon"><i class="frenifya-icon frenifya-table"></i>Table</span>';
		}

		if(
			typeof wp.shortcode.next('woocommerce_order_tracking', text_block_html) == 'object' ||
			typeof wp.shortcode.next('add_to_cart', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product', text_block_html) == 'object' ||
			typeof wp.shortcode.next('products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product_categories', text_block_html) == 'object' ||
			typeof wp.shortcode.next('product_category', text_block_html) == 'object' ||
			typeof wp.shortcode.next('recent_products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('featured_products', text_block_html) == 'object' ||
			typeof wp.shortcode.next('woocommerce_shop_messages', text_block_html) == 'object'
			) {
			insert_icon = '<span class="text-block-icon"><i class="frenifya-icon frenifya-shopping-cart"></i>Woo Shortcodes</span>';
		}

		innerHtml   = $( '<div class="fake-wrapper">' + model.get('innerHtml') + '</div>' ).find( 'span' ).append( insert_icon + '<small>'+text_block_html+'</small>' ).parents('.fake-wrapper').html();

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateCustomTitlePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var value			= '';
		//HTML check
		if( /<[a-z][\s\S]*>/i.test( subElements[0].value ) ) {
			value = $(subElements[0].value).text();
		}else {
			value = subElements[0].value;
		}
		//for text
		if( value != '' ) {
			innerHtml 			= innerHtml.replace( $(innerHtml).find('sub.title_text').html() , value );
		}
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateIntroPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var value			= '';
		
		value = subElements[0].value;
		
		innerHtml 			= innerHtml.replace( $(innerHtml).find('.intro_text').html() , value );
		
		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateAccordionPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';
		var counter			= 0;

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.toggles_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}

	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateTogglePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');
		var totalElements 	= subElements[5].elements.length;
		var previewData		= '';
		var counter			= 0;

		for ( i = 0; i < totalElements; i ++) {
			element 	= subElements[5].elements[i];
			if( element[0].value != '' ) {
				previewData+= '<li>'+element[0].value+'</li>';
				counter++;
			}

			if( counter == 3 ) break;

		}

		innerHtml 			= innerHtml.replace( $(innerHtml).find('ul.toggles_content').html() , previewData );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}
	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateExpandablePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('.expandable_section').html() , subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );

	}

	
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateVimeoPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.viemo_url').html() , "https://vimeo.com/"+subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateWooShortcodesPreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.woo_shortcode').html() , subElements[1].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
	/**
	* Update Preview of element
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Reference to current element
	*
	* @param		OBJECT 		Data model of element
	*
	* @param		OBJECT 		Sub elements data
	*
	* @return 		NULL
	**/
	frenifyPreview.updateYoutubePreview = function( thisRef, model, subElements ) {

		var innerHtml 		= model.get('innerHtml');

		innerHtml 			= innerHtml.replace( $(innerHtml).find('p.youtube_url').html() , "http://www.youtube.com/"+subElements[0].value );

		$(thisRef.el).find('.innerElement').html( innerHtml );
	}
  })(jQuery);

