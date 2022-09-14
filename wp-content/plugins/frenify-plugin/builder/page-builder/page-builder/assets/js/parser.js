/*
* Parser for builder elements
*/
( function($) {
	"use strict";
	var frenifyParser 		= {};
	window.frenifyParser 	= frenifyParser;
	var elements			= [];
	var isActive			= '';
	var shortCodes			= '';
	var shortcodeData 		= '';
	var totalElements		= '';
	var subElements			= '';
	var i;

	/**
	 * get editor data and add to array
	 * @param 	NULL
	 * @return 	NULL
	 */
	frenifyParser.checkBuilderElements = function( publishRequest ) {
		elements 		= JSON.parse( frenifyHistoryManager.getAllElementsData() );
		if(typeof tinyMCE.get('content') == 'object' && tinyMCE.get('content') != null) {
			tinyMCE.get('content').focus(); //disabled by FRENIFY
			isActive 	= (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden();
		} else {
			isActive = false;
		}

		if( elements.length > 0 ) {
			shortCodes 		= frenifyParser.parseColumnOptions();

			if( isActive ) {
				shortCodes 		= window.switchEditors.wpautop(shortCodes);
				window.tinyMCE.get('content').setContent( shortCodes, {format: 'html'} );
			} else {
				$('#content').val( shortCodes );
			}
		} else if( publishRequest && elements.length < 1 ) {

			if( isActive ) {
				window.tinyMCE.activeEditor.setContent('');
			} else {
				$('#content').val('');
			}

		}
		//publish now
		if( publishRequest ) $( '#publish' ).trigger( "click" );
	}

    /**
     * Construct the shortcode
     *
     * @since  	3.8?
     */
    frenifyParser.buildShortcodeContainer = function( element ) {
        var $shortcode = "[" + element.base;
        if ( element.subElements ) {
            $.each( element.subElements, function( index, obj ) {
                if (obj.data) {
                    if (obj.data.replace) {
                        obj.value.replace(obj.data.replace, '');
                    }
                    if (obj.data.append) {
                        obj.value += obj.data.append;
                    }
                }

                obj.id = obj.id.replace('frenify_fn_', '' ).replace('[0]','');
                if ( $.isArray( obj.value ) ) {
                    obj.value = frenifyParser.getUniqueElements( obj.value ).join('|');
                }
                $shortcode += ' ' + obj.id +'="'+obj.value+'"';
            });
        }
        $shortcode += "]";
        return $shortcode;
    };

	/**
	* Parser for column options
	*
	* @since  	2.0.0
	*/
	frenifyParser.parseColumnOptions = function() {
		elements 			= JSON.parse( frenifyHistoryManager.getAllElementsData() );
		shortCodes 			= ''; // this element will have all shortcodes once processing ends
		$.each(elements, function( index, element ) { //traverse elements
            if ( !element.hasOwnProperty('parentId') || element.php_class == 'frenify_fn_FullWidthContainer' ) { //if element does not have any parent (column element)
                if ( element.base && element.base != "" ) {
                    shortCodes +=  frenifyParser.buildShortcodeContainer ( element );
                    if ( ~element.php_class.indexOf( 'frenify_fn_Grid' ) || element.php_class == "frenify_fn_FullWidthContainer" ) {
                        shortCodes +=  frenifyParser.parseColumnElement( element );
                    }
                    shortCodes += '[/' + element.base + ']';
                } else {
                    // NOT CONVERTED TO NEW JS
                    //parse this element separately.
                    shortCodes+= frenifyParser.parseBuilderElements( element );
                }
            }

		});
		return shortCodes;

	}
	/**
	* Parses column options elements for parent and children
	*
	* @since	 	2.0.0
	*
	* @param		element				OBJECT 		Object having element data
	*
	* @return 		columnElements		String		Shortcodes of parsed elements
	**/
	frenifyParser.parseColumnElement = function( element ) {
		var columnElements = '';
		var childElements = element.childrenId.length;

		if ( childElements > 0 ) {

			columnElements = frenifyParser.parseChildElements( element );
		}
		return columnElements;

	}
	/**
	* Parses child elements of single column option
	*
	* @since	 	2.0.0
	*
	* @param		element						OBJECT 		Object having element data
	*
	* @return 		builderElementShortcode		String		Shortcodes of parsed elements
	**/
	frenifyParser.parseChildElements = function( element ) {
		var builderElementShortcode = '';

		$.each(element['childrenId'], function( index, child ) {
			if( child != null ) {
				//get element by id
				var builderElement = $.grep( elements, function( element ){ return element.id == child.id; });
				//if element found
				if ( builderElement.length > 0 ) {
					//generate short-code for this element
                    if ( builderElement[0].base && builderElement[0].base != "" ) {
                        builderElementShortcode +=  frenifyParser.buildShortcodeContainer ( builderElement[0] );
                        if ( ~builderElement[0].php_class.indexOf( 'frenify_fn_Grid' ) || builderElement[0].php_class == "frenify_fn_FullWidthContainer" ) {
                            builderElementShortcode +=  frenifyParser.parseColumnElement( builderElement[0] );
                        }
                        builderElementShortcode += '[/' + builderElement[0].base + ']';
                    } else {
                        // NOT CONVERTED TO NEW JS
                        builderElementShortcode+= frenifyParser.parseBuilderElements( builderElement[0] );
                    }
				}
			}

		});
		return builderElementShortcode;
	}
	/**
	 * parser for builder elements
	 *
	 * @since	 	2.0.0
	 *
	 * @param		element			OBJECT 		Object having element data
	 *
	 * @return 		short_code	 	String		Shortcode of parsed elements
	 */
	frenifyParser.parseBuilderElements = function( element ) {
		var shortCodes = '';

        switch( element.php_class ) {
            case 'frenify_fn_GridOne' :
                shortCodes+= '[one_full '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/one_full]';
                return shortCodes;
                break;
            case 'frenify_fn_GridTwo' :
                shortCodes+= '[one_half '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/one_half]';
                return shortCodes;
                break;

            case 'frenify_fn_GridThree' :
                shortCodes+= '[one_third '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/one_third]';
                return shortCodes;
                break;

            case 'frenify_fn_GridFour' :
                shortCodes+= '[one_fourth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/one_fourth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridFive' :
                shortCodes+= '[one_fifth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/one_fifth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridTwoFifth' :
                shortCodes+= '[two_fifth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/two_fifth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridThreeFifth' :
                shortCodes+= '[three_fifth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/three_fifth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridFourFifth' :
                shortCodes+= '[four_fifth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/four_fifth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridSix' :
                shortCodes+= '[one_sixth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/one_sixth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridFiveSix' :
                shortCodes+= '[five_sixth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/five_sixth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridThreeFourth' :
                shortCodes+= '[three_fourth '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/three_fourth]';
                return shortCodes;
                break;

            case 'frenify_fn_GridTwoThird' :
                shortCodes+= '[two_third '+ frenifyParser.prepareColumnElement( element.subElements ) + ']';
                shortCodes+=  frenifyParser.parseColumnElement( element )
                shortCodes+= '[/two_third]';
                return shortCodes;
                break;
            /*case 'frenify_fn_FullWidthContainer' :
             shortCodes+=  frenifyParser.buildFullWidthContainerShortcode( element.subElements );
             shortCodes+=  frenifyParser.parseColumnElement( element )
             shortCodes+=  '[/fullwidth]';
             return shortCodes;
             break;*/
            case 'frenify_fn_AlertBox':
                return frenifyParser.buildAlertShortcode( element.subElements );
                break;
            case 'frenify_fn_WpBlog':
                return frenifyParser.buildBlogShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_ButtonBlock':
                return frenifyParser.buildButtonShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_CheckList' :
                return frenifyParser.buildChecklistShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_CodeBlock':
                return frenifyParser.buildCodeBlockShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Client' :
                return frenifyParser.buildClientShortcode( element.subElements ) ;
                break;
			
			case 'frenify_fn_ContentBoxes' :
                return frenifyParser.buildContentBoxShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_CounterCircle' :
                return frenifyParser.buildCounterCircleShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_CounterBox' :
                return frenifyParser.buildCounterBoxShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Brochure' :
                return frenifyParser.buildBrochureShortcode( element.subElements ) ;
                break;

            /*case 'frenify_fn_DropCap' :
             return frenifyParser.buildDropcapShortcode( element.subElements ) ;
             break;*/

            case 'frenify_fn_PostSlider' :
                return frenifyParser.buildPostSliderShortcode( element.subElements ) ;
                break;
            case 'frenify_fn_FlipBoxes' :
                return frenifyParser.buildFlipBoxesShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_FontAwesome' :
                return frenifyParser.buildFontAwesomeShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_GoogleMap' :
                return frenifyParser.buildGoogleMapShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Gallery' :
                return frenifyParser.buildGalleryShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Supersized' :
                return frenifyParser.buildSupersizedShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Kenburns' :
                return frenifyParser.buildKenburnsShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_FlowGallery' :
                return frenifyParser.buildFlowGalleryShortcode( element.subElements ) ;
                break;

            /*case 'frenify_fn_HighLight' :
             return frenifyParser.buildHighlightShortcode( element.subElements ) ;
             break;*/

            case 'frenify_fn_ImageFrame' :
                return frenifyParser.buildImageFrameShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_ImageCarousel' :
                return frenifyParser.buildImageCarouselShortcode( element.subElements ) ;
                break;
			
			case 'frenify_fn_Intro':
                return frenifyParser.buildIntroShortcode( element.subElements ) ;
                break;
			
            case 'frenify_fn_LayerSlider' :
                return frenifyParser.buildLayerSliderShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_MenuAnchor' :
                return frenifyParser.buildMenuAnchorShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Modal' :
                return frenifyParser.buildModalShortcode( element.subElements ) ;
                break;


            case 'frenify_fn_Person' :
                return frenifyParser.buildPersonShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_HalfImage' :
                return frenifyParser.buildHalfImageShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Coverbox' :
                return frenifyParser.buildCoverboxShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_TDContent' :
                return frenifyParser.buildTDContentShortcode( element.subElements ) ;
                break;	
			
			
			case 'frenify_fn_Comparison' :
                return frenifyParser.buildComparisonShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Hotspot' :
                return frenifyParser.buildHotspotShortcode( element.subElements ) ;
                break;
			
			case 'frenify_fn_WorkStep' :
                return frenifyParser.buildWorkStepShortcode( element.subElements ) ;
                break;
			
			case 'frenify_fn_Service' :
                return frenifyParser.buildServiceShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Servicepack' :
                return frenifyParser.buildServicepackShortcode( element.subElements ) ;
                break;

            /*case 'frenify_fn_Popover' :
             return frenifyParser.buildPopoverShortcode( element.subElements ) ;
             break;*/

            case 'frenify_fn_PricingTable' :
                return frenifyParser.buildPricingTableShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_ProgressBar' :
                return frenifyParser.buildProgressBarShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_RecentPosts' :
                return frenifyParser.buildRecentPostsShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_GalleryBlock' :
                return frenifyParser.buildGalleryBlockShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_RevolutionSlider' :
                return frenifyParser.buildRevSliderShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_SectionSeparator' :
                return frenifyParser.buildSectionSeparatorShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Separator' :
                return frenifyParser.buildSeparatorShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Servicetabs':
                return frenifyParser.buildServicetabsShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_SharingBox' :
                return frenifyParser.buildSharingBoxShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Slider' :
                return frenifyParser.buildSliderShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_SoundCloud' :
                return frenifyParser.buildSoundcloudShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_SocialLinks' :
                return frenifyParser.buildSocialLinksShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Tabs' :
                return frenifyParser.buildTabsShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Accordion' :
                return frenifyParser.buildAccordionShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Toggle' :
                return frenifyParser.buildToggleShortcode( element.subElements ) ;
                break;
				
			case 'frenify_fn_Expandable' :
                return frenifyParser.buildExpandableShortcode( element.subElements ) ;
                break;
			case 'frenify_fn_Countdown' :
                return frenifyParser.buildCountdownShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Table' :
                return frenifyParser.buildTableShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_TaglineBox' :
                return frenifyParser.buildTaglineShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_Testimonial' :
                return frenifyParser.buildTestimonialShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_frenifyText' :
                return frenifyParser.buildTextBlockShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_CustomTitle':
                return frenifyParser.buildCustomTitleShortcode( element.subElements ) ;
                break;

            /*case 'frenify_fn_Tooltip':
             return frenifyParser.buildTooltipShortcode( element.subElements ) ;
             break;*/

            case 'frenify_fn_Vimeo':
                return frenifyParser.buildVimeoShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_WooFeatured' :
                return frenifyParser.buildWooFeaturedShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_WooCarousel' :
                return frenifyParser.buildWooCarouselShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_WooShortcodes' :
                return frenifyParser.buildWooShortcodes( element.subElements ) ;
                break;

            case 'frenify_fn_Youtube':
                return frenifyParser.buildYoutubeShortcode( element.subElements ) ;
                break;

            case 'frenify_fn_frenifySlider':
                return frenifyParser.buildfrenifySliderShortcode( element.subElements ) ;
                break;
        }
	}
	/* ** ** ** ** Parser code starts here ** ** ** */

	/**
	* Returns layout shortcode attributes
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Layout shortcode attributes
	**/

	frenifyParser.prepareColumnElement = function( args ) {
		shortcodeData= 'last="'+args[0].value+'"';
		shortcodeData+= ' spacing="'+args[1].value+'"';
		shortcodeData+= ' center_content="'+args[2].value+'"';
		shortcodeData+= ' hide_on_mobile="'+args[3].value+'"';
        shortcodeData+= ' background_color="'+args[4].value+'"';
		shortcodeData+= ' background_image="'+args[5].value.replace('frenify-hidden-img','')+'"';
		shortcodeData+= ' background_repeat="'+args[6].value+'"';
		shortcodeData+= ' background_position="'+args[7].value+'"';
		shortcodeData+= ' border_position="'+args[8].value+'"';
		shortcodeData+= ' border_size="'+args[9].value+'"';
		shortcodeData+= ' border_color="'+args[10].value+'"';
		shortcodeData+= ' border_style="'+args[11].value+'"';
		shortcodeData+= ' padding="'+args[12].value+'"';
		shortcodeData+= ' animation_type="'+args[13].value+'"';
		shortcodeData+= ' animation_direction="'+args[14].value+'"';
		shortcodeData+= ' animation_speed="'+args[15].value+'"';
		shortcodeData+= ' class="'+args[16].value+'"';
		shortcodeData+= ' id="'+args[17].value+'"';

		return shortcodeData;
	}
	/**
	* Returns Alert box shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Alert doable shortcode
	**/
	frenifyParser.buildAlertShortcode = function( args ) {

		shortcodeData = '[alert';
		shortcodeData+= ' type="'+args[0].value+'"';
		shortcodeData+= ' accent_color="'+args[1].value+'"';
		shortcodeData+= ' background_color="'+args[2].value+'"';
		shortcodeData+= ' border_size="'+args[3].value+'"';
		shortcodeData+= ' icon="'+args[4].value+'"';
		shortcodeData+= ' box_shadow="'+args[5].value+'"';
		shortcodeData+= ' animation_type="'+args[7].value+'"';
		shortcodeData+= ' animation_direction="'+args[8].value+'"';
		shortcodeData+= ' animation_speed="'+args[9].value+'"';
		shortcodeData+= ' class="'+args[10].value+'"';
		shortcodeData+= ' id="'+args[11].value+'"]';
		shortcodeData+=   args[6].value;
		shortcodeData+= '[/alert]';

		return shortcodeData;
	}
	/**
	* Returns Blog shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Blog doable shortcode
	**/
	frenifyParser.buildBlogShortcode = function( args ) {

		shortcodeData = '[blog';
		shortcodeData+= ' number_posts="'+args[1].value+'"';
		shortcodeData+= ' offset="'+args[2].value+'"';
		shortcodeData+= ' cat_slug="'+frenifyParser.getUniqueElements(args[3].value).join()+'"';
		shortcodeData+= ' exclude_cats="'+frenifyParser.getUniqueElements(args[4].value).join()+'"';
		shortcodeData+= ' title="'+args[5].value+'"';
		shortcodeData+= ' title_link="'+args[6].value+'"';
		shortcodeData+= ' thumbnail="'+args[7].value+'"';
		shortcodeData+= ' excerpt="'+args[8].value+'"';
		shortcodeData+= ' excerpt_length="'+args[9].value+'"';
		shortcodeData+= ' meta_all="'+args[10].value+'"';
		shortcodeData+= ' meta_author="'+args[11].value+'"';
		shortcodeData+= ' meta_categories="'+args[12].value+'"';
		shortcodeData+= ' meta_comments="'+args[13].value+'"';
		shortcodeData+= ' meta_date="'+args[14].value+'"';
		shortcodeData+= ' meta_link="'+args[15].value+'"';
		shortcodeData+= ' meta_tags="'+args[16].value+'"';
		shortcodeData+= ' paging="'+args[17].value+'"';
		shortcodeData+= ' scrolling="'+args[18].value+'"';
		shortcodeData+= ' strip_html="'+args[21].value+'"';
		shortcodeData+= ' blog_grid_columns="'+args[19].value+'"';
		shortcodeData+= ' blog_grid_column_spacing="'+args[20].value+'"';
		shortcodeData+= ' layout="'+args[0].value+'"';
		shortcodeData+= ' class="'+args[22].value+'"';
		shortcodeData+= ' id="'+args[23].value+'"]';
		shortcodeData+= '[/blog]';
		return shortcodeData;
	}
	/**
	* Returns Button shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Button doable shortcode
	**/
	frenifyParser.buildButtonShortcode = function( args ) {

		shortcodeData = '[button';
		shortcodeData+= ' link="'+args[0].value+'"';
		shortcodeData+= ' color="'+args[1].value+'"';
		shortcodeData+= ' size="'+args[2].value+'" ';
		shortcodeData+= ' type="'+args[3].value+'"';
		shortcodeData+= ' shape="'+args[4].value+'"';
		shortcodeData+= ' target="'+args[5].value+'"';
		shortcodeData+= ' title="'+args[6].value+'"';
		shortcodeData+= ' gradient_colors="'+args[8].value+'|'+args[9].value+'"';
		shortcodeData+= ' gradient_hover_colors="'+args[10].value+'|'+args[11].value+'"';
		shortcodeData+= ' accent_color="'+args[12].value+'"';
		shortcodeData+= ' accent_hover_color="'+args[13].value+'"';
		shortcodeData+= ' bevel_color="'+args[14].value+'"';
		shortcodeData+= ' border_width="'+args[15].value+'"';
		shortcodeData+= ' icon="'+args[16].value+'"';
		shortcodeData+= ' icon_position="'+args[17].value+'"';
		shortcodeData+= ' icon_divider="'+args[18].value+'"';
		shortcodeData+= ' modal="'+args[19].value+'"';
		shortcodeData+= ' animation_type="'+args[20].value+'"';
		shortcodeData+= ' animation_direction="'+args[21].value+'"';
		shortcodeData+= ' animation_speed="'+args[22].value+'"';
		shortcodeData+= ' alignment="'+args[23].value+'"';
		shortcodeData+= ' class="'+args[24].value+'"';
		shortcodeData+= ' id="'+args[25].value+'"]';
		shortcodeData+=   args[7].value;
		shortcodeData+= '[/button]';

		return shortcodeData;
	}
	/**
	* Returns Checkbox shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Checkbox doable shortcode
	**/
	frenifyParser.buildChecklistShortcode = function( args ) {
		shortcodeData = '[checklist';
		shortcodeData+= ' icon="'+args[0].value+'"';
		shortcodeData+= ' iconcolor="'+args[1].value+'"';
		shortcodeData+= ' circle="'+args[2].value+'"';
		shortcodeData+= ' circlecolor="'+args[3].value+'"';
		shortcodeData+= ' size="'+args[4].value+'"';
		shortcodeData+= ' class="'+args[5].value+'"';
		shortcodeData+= ' id="'+args[6].value+'"]';

		totalElements 	= args[7].elements.length;

		for ( i = 0; i <  totalElements; i ++) {
			subElemtns 		= args[7].elements[i];
			shortcodeData+= '[li_item';
			shortcodeData+= ' icon="'+subElemtns[0].value+'"]';
			shortcodeData+=   subElemtns[1].value;
			shortcodeData+= '[/li_item]';

		}
		shortcodeData+= '[/checklist]';

		return shortcodeData;
	}
	/**
	* Returns Code Block shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Client Slider doable shortcode
	**/
	frenifyParser.buildCodeBlockShortcode = function( args ) {

		shortcodeData = '[frenify_fn_code]';

		if( !Boolean( Number( frenify_fn_vars.disable_encoding ) ) ) {
			shortcodeData+=  frenifyParser.base64Encode( args[0].value );
		} else {
			shortcodeData+=  args[0].value;
		}
		shortcodeData+= '[/frenify_fn_code]';

		return shortcodeData;
	}
	
	/**
	* Returns Clients shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildClientShortcode = function( args ) {
		shortcodeData = '[clients';
		shortcodeData+= ' client_type="'+args[0].value+'"';
		shortcodeData+= ' client_col="'+args[1].value+'"';
		shortcodeData+= ' client_color="'+args[2].value+'"';
		shortcodeData+= ' client_opacity="'+args[3].value+'"';
		shortcodeData+= ' margin_top="'+args[4].value+'"';
		shortcodeData+= ' margin_bottom="'+args[5].value+'"';
		shortcodeData+= ' class="'+args[6].value+'"';
		shortcodeData+= ' id="'+args[7].value+'"]';

		totalElements =  args[8].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[8].elements[i];
			shortcodeData+= '[client';
			shortcodeData+= ' link="'+element[0].value+'"';
			shortcodeData+= ' image="'+element[1].value+'"]';

		}

		shortcodeData+= '[/clients]';

		return shortcodeData;
	}
	
	/**
	* Returns Content Box shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Content Box doable shortcode
	**/
	frenifyParser.buildContentBoxShortcode = function( args ) {
		shortcodeData = '[content_boxes';
        shortcodeData+= ' settings_lvl="'+args[0].value+'"';
		shortcodeData+= ' layout="'+args[1].value+'"';
        shortcodeData+= ' columns="'+args[2].value+'"';
        shortcodeData+= ' icon_align="'+args[3].value+'"';
        shortcodeData+= ' title_size="'+args[4].value+'"';
        shortcodeData+= ' title_color="'+args[5].value+'"';
        shortcodeData+= ' body_color="'+args[6].value+'"';
        shortcodeData+= ' backgroundcolor="'+args[7].value+'"';
        shortcodeData+= ' icon_circle="'+args[8].value+'"';
        shortcodeData+= ' icon_circle_radius="'+args[9].value+'"';
        shortcodeData+= ' iconcolor="'+args[10].value+'"';
        shortcodeData+= ' circlecolor="'+args[11].value+'"';
        shortcodeData+= ' circlebordercolor="'+args[12].value+'"';
        shortcodeData+= ' circlebordersize="'+args[13].value+'"';
        shortcodeData+= ' outercirclebordercolor="'+args[14].value+'"';
        shortcodeData+= ' outercirclebordersize="'+args[15].value+'"';
		shortcodeData+= ' icon_size="'+args[16].value+'"';
        shortcodeData+= ' icon_hover_type="'+args[17].value+'"';
        shortcodeData+= ' link_type="'+args[18].value+'"';
        shortcodeData+= ' link_area="'+args[19].value+'"';
        shortcodeData+= ' linktarget="'+args[20].value+'"';
        shortcodeData+= ' animation_delay="'+args[21].value+'"';
        shortcodeData+= ' animation_type="'+args[22].value+'"';
        shortcodeData+= ' animation_direction="'+args[23].value+'"';
        shortcodeData+= ' animation_speed="'+args[24].value+'"';
        shortcodeData+= ' margin_top="'+args[25].value+'"';
        shortcodeData+= ' margin_bottom="'+args[26].value+'"';
		shortcodeData+= ' class="'+args[27].value+'"';
		shortcodeData+= ' id="'+args[28].value+'"]';

		totalElements 	= args[29].elements.length;
		subElements		= args[29].elements;

		for ( i = 0; i < totalElements; i++) {
			subElements		= args[29].elements[i];
			shortcodeData+= '[content_box';
			shortcodeData+= ' title="'+subElements[0].value+'"';
			shortcodeData+= ' icon="'+subElements[1].value+'"';
			shortcodeData+= ' backgroundcolor="'+subElements[2].value+'"';
			shortcodeData+= ' iconcolor="'+subElements[3].value+'"';
			shortcodeData+= ' circlecolor="'+subElements[4].value+'"';
			shortcodeData+= ' circlebordercolor="'+subElements[5].value+'"';
            shortcodeData+= ' circlebordersize="'+subElements[6].value+'"';
            shortcodeData+= ' outercirclebordercolor="'+subElements[7].value+'"';
            shortcodeData+= ' outercirclebordersize="'+subElements[8].value+'"';
			shortcodeData+= ' iconrotate="'+subElements[9].value+'"';
			shortcodeData+= ' iconspin="'+subElements[10].value+'"';
			shortcodeData+= ' image="'+subElements[11].value+'"';
			shortcodeData+= ' image_width="'+subElements[12].value+'"';
			shortcodeData+= ' image_height="'+subElements[13].value+'"';
			shortcodeData+= ' link="'+subElements[14].value+'"';
			shortcodeData+= ' linktext="'+subElements[15].value+'"';
			shortcodeData+= ' linktarget="'+subElements[16].value+'"';
			shortcodeData+= ' animation_type="'+subElements[18].value+'"';
			shortcodeData+= ' animation_direction="'+subElements[19].value+'"';
			shortcodeData+= ' animation_speed="'+subElements[20].value+'"]';
			shortcodeData+= ' '+subElements[17].value+'';
			shortcodeData+= '[/content_box]';
		}

		shortcodeData+= '[/content_boxes]';
		return shortcodeData;
	}
	/**
	* Returns Counter Circle shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Counter Circle doable shortcode
	**/
	frenifyParser.buildCounterCircleShortcode = function ( args ) {

		shortcodeData = '[counters_circle';
		shortcodeData+= ' class="'+args[0].value+'"';
		shortcodeData+= ' id="'+args[1].value+'"]';

		totalElements 	= args[2].elements.length;

		for ( i = 0; i < totalElements; i++ ) {
			subElements 	= args[2].elements[i];
			shortcodeData+= '[counter_circle';
			shortcodeData+= ' filledcolor="'+subElements[1].value+'"';
			shortcodeData+= ' unfilledcolor="'+subElements[2].value+'"';
			shortcodeData+= ' size="'+subElements[3].value+'"';
			shortcodeData+= ' scales="'+subElements[4].value+'"';
			shortcodeData+= ' countdown="'+subElements[5].value+'"';
			shortcodeData+= ' speed="'+subElements[6].value+'"';
			shortcodeData+= ' value="'+subElements[0].value+'"]'+subElements[7].value+'';
			shortcodeData+= '[/counter_circle]';
		}

		shortcodeData+= '[/counters_circle]';
		return shortcodeData;
	}
	frenifyParser.buildCounterBoxShortcode = function( args ) {
		shortcodeData = '[counters_box ';
		shortcodeData+= ' columns="'+args[0].value+'"';
		shortcodeData+= ' margin_top="'+args[1].value+'"';
		shortcodeData+= ' margin_bottom="'+args[2].value+'"';
		shortcodeData+= ' class="'+args[3].value+'"';
		shortcodeData+= ' id="'+args[4].value+'"]';

		totalElements 	= args[5].elements.length;

		for (i = 0; i < totalElements; i++ ){
			subElements 	= args[5].elements[i];

			shortcodeData+= '[counter_box';
			shortcodeData+= ' value="'+subElements[0]['value']+'"';
			shortcodeData+= ' start="'+subElements[1]['value']+'"';
			shortcodeData+= ' speed="'+subElements[2]['value']+'"]';
			shortcodeData+=   subElements[3].value;
			shortcodeData+= '[/counter_box]';
		}

		shortcodeData+= '[/counters_box]';
		return shortcodeData;
	}
	
	
	/**
	* Returns Brochure shortcode
	**/
	
	frenifyParser.buildBrochureShortcode = function( args ) {
		shortcodeData = '[brochures ';
		shortcodeData+= ' margin_top="'+args[0].value+'"';
		shortcodeData+= ' margin_bottom="'+args[1].value+'"';
		shortcodeData+= ' class="'+args[2].value+'"';
		shortcodeData+= ' id="'+args[3].value+'"]';

		totalElements 	= args[4].elements.length;

		for ( i = 0; i < totalElements; i++ ){
			subElements 	= args[4].elements[i];

			shortcodeData+= '[brochure';
			shortcodeData+= ' link="'+subElements[0]['value']+'"';
			shortcodeData+= ' icon="'+subElements[1]['value']+'"]';
			shortcodeData+=   subElements[2].value;
			shortcodeData+= '[/brochure]';
		}

		shortcodeData+= '[/brochures]';
		return shortcodeData;
	}
	
	/**
	* Returns DropCap shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		DropCap doable shortcode
	**/
	/*frenifyParser.buildDropcapShortcode = function( args ) {

		shortcodeData = '[dropcap ';
		shortcodeData+= ' color="'+args[1].value+'" ';
		shortcodeData+= ' boxed="'+args[2].value+'" ';
		shortcodeData+= ' boxed_radius="'+args[3].value+'" ';
		shortcodeData+= ' class="'+args[4].value+'" ';
		shortcodeData+= ' id="'+args[5].value+'"] ';
		shortcodeData+=   args[0].value;
		shortcodeData+= '[/dropcap]';
		shortcodeData+= ' \r';

		return shortcodeData;
	}*/

	/**
	* Returns Flex Slider shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Flex Slider doable shortcode
	**/
	frenifyParser.buildPostSliderShortcode = function( args ) {

		shortcodeData = '[postslider';
		shortcodeData+= ' layout="'+args[0].value+'"';
		shortcodeData+= ' excerpt="'+args[1].value+'"';
		shortcodeData+= ' category="'+args[2].value.replace(' ','')+'"';
		shortcodeData+= ' limit="'+args[3].value+'"';
		shortcodeData+= ' lightbox="'+args[4].value+'"';
		shortcodeData+= ' class="'+args[6].value+'"';
		shortcodeData+= ' id="'+args[7].value+'"]';
		shortcodeData+= '[/postslider]';

		return shortcodeData;
	}
	/**
	* Returns Flip Box shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Flip Box doable shortcode
	**/
	frenifyParser.buildFlipBoxesShortcode = function( args ) {

		shortcodeData = '[flip_boxes';
		shortcodeData+= ' columns="'+args[0].value+'"';
		shortcodeData+= ' class="'+args[1].value+'"';
		shortcodeData+= ' id="'+args[2].value+'"]';

		totalElements 		= args[3].elements.length;

		for ( i = 0;  i < totalElements; i++ ) {
			subElements 		= args[3].elements[i];
			shortcodeData+= '[flip_box';
			shortcodeData+= ' title_front="'+subElements[0].value+'"';
			shortcodeData+= ' title_back="'+subElements[1].value+'"';
			shortcodeData+= ' text_front="'+subElements[2].value+'"';
			shortcodeData+= ' background_color_front="'+subElements[4].value+'"';
			shortcodeData+= ' title_front_color="'+subElements[5].value+'"';
			shortcodeData+= ' text_front_color="'+subElements[6].value+'"';
			shortcodeData+= ' background_color_back="'+subElements[7].value+'"';
			shortcodeData+= ' title_back_color="'+subElements[8].value+'"';
			shortcodeData+= ' text_back_color="'+subElements[9].value+'"';
			shortcodeData+= ' border_size="'+subElements[10].value+'"';
			shortcodeData+= ' border_color="'+subElements[11].value+'"';
			shortcodeData+= ' border_radius="'+subElements[12].value+'"';
			shortcodeData+= ' icon="'+subElements[13].value+'"';
			shortcodeData+= ' icon_color="'+subElements[14].value+'"';
			shortcodeData+= ' circle="'+subElements[15].value+'"';
			shortcodeData+= ' circle_color="'+subElements[16].value+'"';
			shortcodeData+= ' circle_border_color="'+subElements[17].value+'"';
			shortcodeData+= ' icon_rotate="'+subElements[18].value+'"';
			shortcodeData+= ' icon_spin="'+subElements[19].value+'"';
			shortcodeData+= ' image="'+subElements[20].value+'"';
			shortcodeData+= ' image_width="'+subElements[21].value+'"';
			shortcodeData+= ' image_height="'+subElements[22].value+'"';
			shortcodeData+= ' animation_type="'+subElements[23].value+'"';
			shortcodeData+= ' animation_direction="'+subElements[24].value+'"';
			shortcodeData+= ' animation_speed="'+subElements[25].value+'"]';
			shortcodeData+=   subElements[3].value;
			shortcodeData+= '[/flip_box]';
		}
		shortcodeData+= '[/flip_boxes]';

		return shortcodeData;

	}
	/**
	* Returns Font Awesome shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Font Awesome doable shortcode
	**/
	frenifyParser.buildFontAwesomeShortcode = function( args ) {

		shortcodeData = '[fontawesome';
		shortcodeData+=' icon="'+args[0].value+'"';
		shortcodeData+=' circle="'+args[1].value+'"';
		shortcodeData+=' size="'+args[2].value+'"';
		shortcodeData+=' iconcolor="'+args[3].value+'"';
		shortcodeData+=' circlecolor="'+args[4].value+'"';
		shortcodeData+=' circlebordercolor="'+args[5].value+'"';
		shortcodeData+=' rotate="'+args[6].value+'"';
		shortcodeData+=' spin="'+args[7].value+'"';
		shortcodeData+=' animation_type="'+args[8].value+'"';
		shortcodeData+=' animation_direction="'+args[9].value+'"';
		shortcodeData+=' animation_speed="'+args[10].value+'"';
		shortcodeData+=' alignment="'+args[11].value+'"';
		shortcodeData+=' class="'+args[12].value+'"';
		shortcodeData+=' id="'+args[13].value+'"]';

		return shortcodeData;
	}
	/**
	* Returns Full Width Container shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Full Widht Container doable shortcode
	**/
	frenifyParser.buildFullWidthContainerShortcode = function( args ) {

		shortcodeData = '[fullwidth';
		shortcodeData+= ' backgroundcolor="'+args[0].value+'"';
		shortcodeData+= ' backgroundimage="'+args[1].value.replace('frenify-hidden-img','')+'"';
		shortcodeData+= ' backgroundrepeat="'+args[2].value+'"';
		shortcodeData+= ' backgroundposition="'+args[3].value+'"';
		shortcodeData+= ' backgroundattachment="'+args[4].value+'"';
		shortcodeData+= ' video_webm="'+args[5].value+'"';
		shortcodeData+= ' video_mp4="'+args[6].value+'"';
		shortcodeData+= ' video_ogv="'+args[7].value+'"';
		shortcodeData+= ' video_preview_image="'+args[8].value+'"';
		shortcodeData+= ' overlay_color="'+args[9].value+'"';
		shortcodeData+= ' overlay_opacity="'+args[10].value+'"';
		shortcodeData+= ' video_mute="'+args[11].value+'"';
		shortcodeData+= ' video_loop="'+args[12].value+'"';
		shortcodeData+= ' fade="'+args[13].value+'"';
		shortcodeData+= ' bordersize="'+args[14].value+'"';
		shortcodeData+= ' bordercolor="'+args[15].value+'"';
		shortcodeData+= ' borderstyle="'+args[16].value+'"';
		shortcodeData+= ' paddingtop="'+args[17].value+'px"';
		shortcodeData+= ' paddingbottom="'+args[18].value+'px"';
		shortcodeData+= ' paddingleft="'+args[19].value+'px"';
		shortcodeData+= ' paddingright="'+args[20].value+'px"';
		shortcodeData+= ' menu_anchor="'+args[21].value+'"';
		shortcodeData+= ' equal_height_columns="'+args[22].value+'"';
		shortcodeData+= ' hundred_percent="'+args[23].value+'"';
		shortcodeData+= ' class="'+args[24].value+'"';
		shortcodeData+= ' id="'+args[25].value+'"]';

		return shortcodeData;
	}
	
	/**
	* Returns Gallery shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildGalleryShortcode = function( args ) {
		shortcodeData = '[tdgallery';
		//shortcodeData+= ' slide_type="'+args[0].value+'"';
		shortcodeData+= ' slide_autoplay="'+args[0].value+'"';
		//shortcodeData+= ' slide_reverse="'+args[2].value+'"';
		shortcodeData+= ' slide_speed="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';

		totalElements =  args[6].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[6].elements[i];
			shortcodeData+= '[gimg';
			shortcodeData+= ' image="'+element[0].value+'"]';
			shortcodeData+= '[/gimg]';

		}

		shortcodeData+= '[/tdgallery]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Supersized shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildSupersizedShortcode = function( args ) {
		shortcodeData = '[supersized';
		shortcodeData+= ' purchase_button="'+args[0].value+'"';
		shortcodeData+= ' slide_interval="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';

		totalElements =  args[6].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[6].elements[i];
			shortcodeData+= '[simg';
			shortcodeData+= ' image="'+element[0].value+'"]';
			shortcodeData+= '[/simg]';

		}

		shortcodeData+= '[/supersized]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Kenburns shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildKenburnsShortcode = function( args ) {
		shortcodeData = '[kenburns';
		shortcodeData+= ' purchase_button="'+args[0].value+'"';
		shortcodeData+= ' slide_interval="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';

		totalElements =  args[6].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[6].elements[i];
			shortcodeData+= '[ken';
			shortcodeData+= ' image="'+element[0].value+'"]';
			shortcodeData+= '[/ken]';

		}

		shortcodeData+= '[/kenburns]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Flow Gallery shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildFlowGalleryShortcode = function( args ) {
		shortcodeData = '[flowgallery';
		shortcodeData+= ' purchase_button="'+args[0].value+'"';
		shortcodeData+= ' img_title="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';

		totalElements =  args[6].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[6].elements[i];
			shortcodeData+= '[flowimg';
			shortcodeData+= ' image="'+element[0].value+'"]';
			shortcodeData+= '[/flowimg]';

		}

		shortcodeData+= '[/flowgallery]';

		return shortcodeData;
	}
	
	
	
	/**
	* Returns Google Map shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Google Map doable shortcode
	**/
	frenifyParser.buildGoogleMapShortcode = function( args ) {

		shortcodeData = '[map';
		shortcodeData+= ' address="'+args[16].value+'"';
		shortcodeData+= ' type="'+args[0].value+'"';
		shortcodeData+= ' map_style="'+args[9].value+'"';
		shortcodeData+= ' overlay_color="'+args[10].value+'"';
		shortcodeData+= ' infobox="'+args[11].value+'"';
		shortcodeData+= ' infobox_background_color="'+args[14].value+'"';
		shortcodeData+= ' infobox_text_color="'+args[13].value+'"';
		shortcodeData+= ' infobox_content="'+args[12].value+'"';
		shortcodeData+= ' icon="'+args[15].value+'"';
		shortcodeData+= ' width="'+args[1].value+'"';
		shortcodeData+= ' height="'+args[2].value+'"';
		shortcodeData+= ' zoom="'+args[3].value+'"';
		shortcodeData+= ' scrollwheel="'+args[4].value+'"';
		shortcodeData+= ' scale="'+args[5].value+'"';
		shortcodeData+= ' zoom_pancontrol="'+args[6].value+'"';
		shortcodeData+= ' animation="'+args[7].value+'"';
		shortcodeData+= ' popup="'+args[8].value+'"';
		shortcodeData+= ' class="'+args[17].value+'"';
		shortcodeData+= ' id="'+args[18].value+'"]';
		shortcodeData+= '[/map]';

		return shortcodeData;
	}
	/**
	* Returns Highlight shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Highlight doable shortcode
	**/
	/*frenifyParser.buildHighlightShortcode = function( args ) {

		shortcodeData = '[highlight';
		shortcodeData+=' color="'+args[0].value+'"';
		shortcodeData+=' rounded="'+args[1].value+'"';
		shortcodeData+=' class="'+args[3].value+'"';
		shortcodeData+=' id="'+args[4].value+'"]';
		shortcodeData+=args[2].value;
		shortcodeData+='[/highlight]';

		return shortcodeData;
	}*/
	/**
	* Returns Image Frame shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Image Frame doable shortcode
	**/
	frenifyParser.buildImageFrameShortcode = function( args ) {
		shortcodeData = '[imageframe';
		shortcodeData+= ' lightbox="'+args[7].value+'"';
		shortcodeData+= ' lightbox_image="'+args[8].value+'"';
		shortcodeData+= ' style_type="'+args[0].value+'"';
        shortcodeData+= ' hover_type="'+args[1].value+'"';
		shortcodeData+= ' bordercolor="'+args[2].value+'"';
		shortcodeData+= ' bordersize="'+args[3].value+'"';
		shortcodeData+= ' borderradius="'+args[4].value+'"';
		shortcodeData+= ' stylecolor="'+args[5].value+'"';
		shortcodeData+= ' align="'+args[6].value+'"';
		shortcodeData+= ' link="'+args[11].value+'"';
		shortcodeData+= ' linktarget="'+args[12].value+'"';
		shortcodeData+= ' animation_type="'+args[13].value+'"';
		shortcodeData+= ' animation_direction="'+args[14].value+'"';
		shortcodeData+= ' animation_speed="'+args[15].value+'"';
        shortcodeData+= ' hide_on_mobile="'+args[16].value+'"';
		shortcodeData+= ' class="'+args[17].value+'"';
		shortcodeData+= ' id="'+args[18].value+'"]';
		shortcodeData+= ' <img alt="'+args[10].value+'"';
		shortcodeData+= ' src="'+args[9].value+'" />';
		shortcodeData+= '[/imageframe]';

		return shortcodeData;
	}
	/**
	* Returns Image Carousel shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Image Carousel doable shortcode
	**/
	frenifyParser.buildImageCarouselShortcode = function( args ) {

		shortcodeData = '[images';
		shortcodeData+= ' picture_size="'+args[0].value+'"';
        shortcodeData+= ' hover_type="'+args[1].value+'"';
		shortcodeData+= ' autoplay="'+args[2].value+'"';
		shortcodeData+= ' columns="'+args[3].value+'"';
		shortcodeData+= ' column_spacing="'+args[4].value+'"';
		shortcodeData+= ' scroll_items="'+args[5].value+'"';
		shortcodeData+= ' show_nav="'+args[6].value+'"';
		shortcodeData+= ' mouse_scroll="'+args[7].value+'"';
		shortcodeData+= ' border="'+args[8].value+'"';
		shortcodeData+= ' lightbox="'+args[9].value+'"';
		shortcodeData+= ' class="'+args[10].value+'"';
		shortcodeData+= ' id="'+args[11].value+'"]';

		totalElements = args[12].elements.length;

		for (i = 0; i < totalElements; i++) {
			element = args[12].elements[i];
			shortcodeData+= '[image';
			shortcodeData+= ' link="'+element[0].value+'"';
			shortcodeData+= ' linktarget="'+element[1].value+'"';
			shortcodeData+= ' image="'+element[2].value+'"';
			shortcodeData+= ' alt="'+element[3].value+'"]';

		}

		shortcodeData+= '[/images]';

		return shortcodeData;
	}
	/**
	* Returns Layer Slider shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Layer Slider doable shortcode
	**/
	frenifyParser.buildLayerSliderShortcode = function( args ) {

		shortcodeData = '[layerslider';
		shortcodeData+= ' id="'+args[0].value+'"]';
		return shortcodeData;
	}
	/**
	* Returns Menu Anchor shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Menu Anchor doable shortcode
	**/
	frenifyParser.buildMenuAnchorShortcode = function( args ) {

		return '[menu_anchor name="'+args[0].value+'"]';
	}
	/**
	* Returns Modal shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Modal doable shortcode
	**/
	frenifyParser.buildModalShortcode = function( args ) {

		shortcodeData = '[modal';
		shortcodeData+=' button_text="'+args[0].value+'"';
		shortcodeData+=' button_hover="'+args[1].value+'"';
		shortcodeData+=' button_size="'+args[2].value+'"';
		shortcodeData+=' opening_effect="'+args[3].value+'"';
		shortcodeData+=' title="'+args[4].value+'"';
		shortcodeData+=' margin_top="'+args[6].value+'"';
		shortcodeData+=' margin_bottom="'+args[7].value+'"';
		shortcodeData+=' class="'+args[8].value+'"';
		shortcodeData+=' id="'+args[9].value+'"]';
		shortcodeData+=args[5].value;
		shortcodeData+='[/modal]';

		return shortcodeData;
	}
	/**
	* Returns Modal Link shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Modal Hook doable shortcode
	**/
	/*frenifyParser.buildModalLinkShortcode = function( args ) {

		shortcodeData = '[modal_text_link ';
		shortcodeData+=' name="{{'+args[0].value+'}}" ';
		shortcodeData+=' class="'+args[1].value+'" ';
		shortcodeData+=' id="'+args[2].value+'"] ';
		shortcodeData+= ' \r';
		return shortcodeData;
	}*/
	/**
	* Returns Person shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Person doable shortcode
	**/
	frenifyParser.buildPersonShortcode = function( args ) {

		shortcodeData = '[person';
		shortcodeData+= ' name="'+args[0].value+'"';
		shortcodeData+= ' occ="'+args[1].value+'"';
		shortcodeData+= ' image="'+args[2].value+'"';
		shortcodeData+= ' text_align="'+args[4].value+'"';
		
		// social icons
		shortcodeData+= ' email="'+args[5].value+'"';
		shortcodeData+= ' facebook="'+args[6].value+'"';
		shortcodeData+= ' twitter="'+args[7].value+'"';
		shortcodeData+= ' instagram="'+args[8].value+'"';
		shortcodeData+= ' google="'+args[9].value+'"';
		shortcodeData+= ' linkedin="'+args[10].value+'"';
		shortcodeData+= ' vimeo="'+args[11].value+'"';
		shortcodeData+= ' youtube="'+args[12].value+'"';
		shortcodeData+= ' flickr="'+args[13].value+'"';
		shortcodeData+= ' skype="'+args[14].value+'"';
		shortcodeData+= ' tumblr="'+args[15].value+'"';
		shortcodeData+= ' dribbble="'+args[16].value+'"';
		
		shortcodeData+= ' margin_top="'+args[17].value+'"';
		shortcodeData+= ' margin_bottom="'+args[18].value+'"';
		shortcodeData+= ' class="'+args[19].value+'"';
		shortcodeData+= ' id="'+args[20].value+'"]';
		shortcodeData+=   args[3].value;
		shortcodeData+= '[/person]';

		return shortcodeData;
	}
	/**
	* Returns HalfImage shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Person doable shortcode
	**/
	frenifyParser.buildHalfImageShortcode = function( args ) {

		shortcodeData = '[halfimage';
		shortcodeData+= ' image_position="'+args[0].value+'"';
		shortcodeData+= ' image="'+args[1].value+'"';
		shortcodeData+= ' title="'+args[2].value+'"';
		
		shortcodeData+= ' link_text="'+args[4].value+'"';
		shortcodeData+= ' link_url="'+args[5].value+'"';
		shortcodeData+= ' link_target="'+args[6].value+'"';
		
		shortcodeData+= ' margin_top="'+args[7].value+'"';
		shortcodeData+= ' margin_bottom="'+args[8].value+'"';
		shortcodeData+= ' class="'+args[9].value+'"';
		shortcodeData+= ' id="'+args[10].value+'"]';
		shortcodeData+=   args[3].value;
		shortcodeData+= '[/halfimage]';

		return shortcodeData;
	}
	
	/**
	* Returns Coverbox shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Person doable shortcode
	**/
	frenifyParser.buildCoverboxShortcode = function( args ) {

		shortcodeData = '[coverbox';
		shortcodeData+= ' template="'+args[0].value+'"';
		shortcodeData+= ' skin="'+args[1].value+'"';
		shortcodeData+= ' width="'+args[2].value+'"';
		shortcodeData+= ' position="'+args[3].value+'"';
		shortcodeData+= ' text_align="'+args[4].value+'"';
		shortcodeData+= ' margin_top="'+args[6].value+'"';
		shortcodeData+= ' margin_bottom="'+args[7].value+'"';
		shortcodeData+= ' class="'+args[8].value+'"';
		shortcodeData+= ' id="'+args[9].value+'"]';
		shortcodeData+=   args[5].value;
		shortcodeData+= '[/coverbox]';

		return shortcodeData;
	}
	
	frenifyParser.buildTDContentShortcode = function( args ) {

		shortcodeData = '[tdcontent';
		shortcodeData+= ' text_align="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';
		shortcodeData+=   args[0].value;
		shortcodeData+= '[/tdcontent]';

		return shortcodeData;
	}
	
	/**
	* Returns Person shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Person doable shortcode
	**/
	frenifyParser.buildComparisonShortcode = function( args ) {

		shortcodeData = '[comparison';
		shortcodeData+= ' img1="'+args[0].value+'"';
		shortcodeData+= ' img2="'+args[1].value+'"';
		shortcodeData+= ' image_size="'+args[2].value+'"';
		shortcodeData+= ' orientation="'+args[3].value+'"';
		shortcodeData+= ' before="'+args[4].value+'"';
		shortcodeData+= ' after="'+args[5].value+'"';
		shortcodeData+= ' margin_top="'+args[6].value+'"';
		shortcodeData+= ' margin_bottom="'+args[7].value+'"';
		shortcodeData+= ' class="'+args[8].value+'"';
		shortcodeData+= ' id="'+args[9].value+'"]';

		return shortcodeData;
	}
	
	/**
	* Returns Popover shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Popover doable shortcode
	**/
	frenifyParser.buildHotspotShortcode = function( args ) {
		shortcodeData = '[hotspots';
		shortcodeData+= ' image="'+args[0].value+'"';
		shortcodeData+= ' margin_top="'+args[1].value+'"';
		shortcodeData+= ' margin_bottom="'+args[2].value+'"';
		shortcodeData+= ' class="'+args[3].value+'"';
		shortcodeData+= ' id="'+args[4].value+'"]';

		totalElements =  args[5].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[5].elements[i];
			shortcodeData+= '[hotspot';
			shortcodeData+= ' top="'+element[0].value+'"';
			shortcodeData+= ' left="'+element[1].value+'"';
			shortcodeData+= ' skin="'+element[2].value+'"';
			shortcodeData+= ' rounded="'+element[3].value+'"';
			shortcodeData+= ' tooltip="'+element[4].value+'"';
			shortcodeData+= ' position="'+element[5].value+'"';
			shortcodeData+= ' title="'+element[6].value+'"]';
			shortcodeData+= '[/hotspot]';

		}

		shortcodeData+= '[/hotspots]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Service shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Person doable shortcode
	**/
	frenifyParser.buildWorkStepShortcode = function( args ) {

		shortcodeData = '[workstep';
		shortcodeData+= ' step="'+args[0].value+'"';
		shortcodeData+= ' title="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[3].value+'"';
		shortcodeData+= ' margin_bottom="'+args[4].value+'"';
		shortcodeData+= ' class="'+args[5].value+'"';
		shortcodeData+= ' id="'+args[6].value+'"]';
		shortcodeData+=   args[2].value;
		shortcodeData+= '[/workstep]';

		return shortcodeData;
	}
	
	/**
	* Returns Service shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Person doable shortcode
	**/
	frenifyParser.buildServiceShortcode = function( args ) {

		shortcodeData = '[service';
		shortcodeData+= ' image="'+args[0].value+'"';
		shortcodeData+= ' title="'+args[1].value+'"';
		shortcodeData+= ' subtitle="'+args[2].value+'"';
		shortcodeData+= ' margin_top="'+args[4].value+'"';
		shortcodeData+= ' margin_bottom="'+args[5].value+'"';
		shortcodeData+= ' class="'+args[6].value+'"';
		shortcodeData+= ' id="'+args[7].value+'"]';
		shortcodeData+=   args[3].value;
		shortcodeData+= '[/service]';

		return shortcodeData;
	}
	
	/**
	* Returns Service Pack shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Popover doable shortcode
	**/
	frenifyParser.buildServicepackShortcode = function( args ) {
		shortcodeData = '[servicepack';
		shortcodeData+= ' image="'+args[0].value+'"';
		shortcodeData+= ' title="'+args[1].value+'"';
		shortcodeData+= ' duration="'+args[2].value+'"';
		shortcodeData+= ' totalcost="'+args[3].value+'"';
		shortcodeData+= ' booking="'+args[4].value+'"';
		shortcodeData+= ' margin_top="'+args[5].value+'"';
		shortcodeData+= ' margin_bottom="'+args[6].value+'"';
		shortcodeData+= ' class="'+args[7].value+'"';
		shortcodeData+= ' id="'+args[8].value+'"]';

		totalElements =  args[9].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[9].elements[i];
			shortcodeData+= '[sp';
			shortcodeData+= ' title="'+element[0].value+'"';
			shortcodeData+= ' price="'+element[1].value+'"]';
			shortcodeData+= '[/sp]';

		}

		shortcodeData+= '[/servicepack]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Popover shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Popover doable shortcode
	**/
	/*frenifyParser.buildPopoverShortcode = function( args ) {
		shortcodeData = '[popover ';
		shortcodeData+= ' title="'+args[0].value+'" ';
		shortcodeData+= ' title_bg_color="'+args[1].value+'" ';
		shortcodeData+= ' content="'+args[2].value+'" ';
		shortcodeData+= ' content_bg_color="'+args[3].value+'" ';
		shortcodeData+= ' bordercolor="'+args[4].value+'" ';
		shortcodeData+= ' textcolor="'+args[5].value+'" ';
		shortcodeData+= ' trigger="'+args[6].value+'" ';
		shortcodeData+= ' placement="'+args[7].value+'" ';
		shortcodeData+= ' class="'+args[9].value+'" ';
		shortcodeData+= ' id="'+args[10].value+'"] ';
		shortcodeData+=   args[8].value;
		shortcodeData+= ' [/popover]';
		shortcodeData+= ' \r';

		return shortcodeData;

	}*/
	/**
	* Returns Pricing Table shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Pricing Table doable shortcode
	**/
	frenifyParser.buildPricingTableShortcode = function( args ) {

		return args[7].value;
	}
	/**
	* Returns Progress Bar shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Progress Bar doable shortcode
	**/
	frenifyParser.buildProgressBarShortcode = function( args ) {

		shortcodeData = '[progress';
		shortcodeData += ' value="'+args[0].value+'"';
		shortcodeData += ' filledcolor="'+args[2].value+'"';
		shortcodeData += ' striped="'+args[3].value+'"';
		shortcodeData += ' size="'+args[4].value+'"';
		shortcodeData += ' rounded="'+args[5].value+'"';
		shortcodeData += ' margin_top="'+args[6].value+'"';
		shortcodeData += ' margin_bottom="'+args[7].value+'"';
		shortcodeData += ' class="'+args[8].value+'"';
		shortcodeData += ' id="'+args[9].value+'"]';
		shortcodeData +=   args[1].value;
		shortcodeData += '[/progress]';

		return shortcodeData ;

	}
	/**
	* Returns Recent Posts shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Recent Posts doable shortcode
	**/
	frenifyParser.buildRecentPostsShortcode = function( args ) {

		shortcodeData = '[recent_posts';
		shortcodeData+= ' post_number="'+args[0].value+'"';
		shortcodeData+= ' bg="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';
		shortcodeData+= '[/recent_posts]';

		return shortcodeData;
	}
	/**
	* Returns Gallery Block shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Gallery Block doable shortcode
	**/
	frenifyParser.buildGalleryBlockShortcode = function( args ) {

		shortcodeData = '[gallery_block';
		shortcodeData+= ' layout="'+args[0].value+'"';
		shortcodeData+= ' cat_slug="'+frenifyParser.getUniqueElements(args[1].value).join()+'"';
		shortcodeData+= ' exclude_cats="'+frenifyParser.getUniqueElements(args[2].value).join()+'"';
		shortcodeData+= ' post_count="'+args[3].value+'"';
		shortcodeData+= ' order="'+args[4].value+'"';
		shortcodeData+= ' offset="'+args[5].value+'"';
		shortcodeData+= ' margin_top="'+args[6].value+'"';
		shortcodeData+= ' margin_bottom="'+args[7].value+'"';
		shortcodeData+= ' class="'+args[8].value+'"';
		shortcodeData+= ' id="'+args[9].value+'"]';
		shortcodeData+= '[/gallery_block]';

		return shortcodeData;
	}
	/**
	* Returns Revolution Slider shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Revolution Slider doable shortcode
	**/
	frenifyParser.buildRevSliderShortcode = function( args ) {
		shortcodeData = '[rev_slider';
		shortcodeData+= ' '+args[0].value+']';
		return shortcodeData ;
	}
	/**
	* Returns Section Separator shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Section Separator doable shortcode
	**/
	frenifyParser.buildSectionSeparatorShortcode = function( args ) {

		shortcodeData = '[section_separator';
		shortcodeData+= ' divider_candy="'+args[0].value+'"';
		shortcodeData+= ' icon="'+args[1].value+'"';
		shortcodeData+= ' icon_color="'+args[2].value+'"';
		shortcodeData+= ' bordersize="'+args[3].value+'"';
		shortcodeData+= ' bordercolor="'+args[4].value+'"';
		shortcodeData+= ' backgroundcolor="'+args[5].value+'"';
		shortcodeData+= ' class="'+args[6].value+'"';
		shortcodeData+= ' id="'+args[7].value+'"]';

		return shortcodeData ;
	}
	/**
	* Returns Separator shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Separator doable shortcode
	**/
	frenifyParser.buildSeparatorShortcode = function( args ) {

		shortcodeData = '[separator';
		shortcodeData+= ' style_type="'+args[0].value+'"';
		shortcodeData+= ' top_margin="'+args[1].value+'"';
		shortcodeData+= ' bottom_margin="'+args[2].value+'"';
		shortcodeData+= ' sep_color="'+args[3].value+'"';
        shortcodeData+= ' border_size="'+args[4].value+'"';
		shortcodeData+= ' icon="'+args[5].value+'"';
		shortcodeData+= ' icon_circle="'+args[6].value+'"';
		shortcodeData+= ' icon_circle_color="'+args[7].value+'"';
		shortcodeData+= ' width="'+args[8].value+'"';
		shortcodeData+= ' alignment="'+args[9].value+'"';
		shortcodeData+= ' class="'+args[10].value+'"';
		shortcodeData+= ' id="'+args[11].value+'"]';

		return shortcodeData;

	}
	
	/**
	* Returns Service Tabs shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildServicetabsShortcode = function( args ) {
		shortcodeData = '[servicetabs';
		shortcodeData+= ' margin_top="'+args[0].value+'"';
		shortcodeData+= ' margin_bottom="'+args[1].value+'"';
		shortcodeData+= ' class="'+args[2].value+'"';
		shortcodeData+= ' id="'+args[3].value+'"]';

		totalElements =  args[4].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[4].elements[i];
			shortcodeData+= '[servicetab';
			shortcodeData+= ' title="'+element[0].value+'"';
			shortcodeData+= ' image="'+element[1].value+'"';
			shortcodeData+= ' link="'+element[2].value+'"]';
			shortcodeData+=   element[3].value;
			shortcodeData+= '[/servicetab]';

		}

		shortcodeData+= '[/servicetabs]';

		return shortcodeData;
	}
	/**
	* Returns Sharing Box shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Sharing Box doable shortcode
	**/
	frenifyParser.buildSharingBoxShortcode = function( args ) {

		shortcodeData = '[sharing';
		shortcodeData+= ' tagline="'+args[0].value+'"';
		shortcodeData+= ' tagline_color="'+args[1].value+'"';
		shortcodeData+= ' title="'+args[3].value+'"';
		shortcodeData+= ' link="'+args[4].value+'"';
		shortcodeData+= ' description="'+args[5].value+'"';
		shortcodeData+= ' pinterest_image="'+args[11].value+'"';
		shortcodeData+= ' icons_boxed="'+args[6].value+'"';
		shortcodeData+= ' icons_boxed_radius="'+args[7].value+'"';
		shortcodeData+= ' box_colors="'+args[9].value+'"';
		shortcodeData+= ' icon_colors="'+args[8].value+'"';
		shortcodeData+= ' tooltip_placement="'+args[10].value+'"';
		shortcodeData+= ' backgroundcolor="'+args[2].value+'"';
		shortcodeData+= ' class="'+args[12].value+'"';
		shortcodeData+= ' id="'+args[13].value+'"]';
		shortcodeData+= '[/sharing]';

		return shortcodeData;
	}
	/**
	* Returns Slider shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Slider doable shortcode
	**/
	frenifyParser.buildSliderShortcode = function( args ) {
		shortcodeData = '[slider';
            shortcodeData+= ' hover_type="'+args[0].value+'"';
			shortcodeData+= ' width="'+args[1].value+'"';
			shortcodeData+= ' height="'+args[2].value+'"';
			shortcodeData+= ' class="'+args[3].value+'"';
			shortcodeData+= ' id="'+args[4].value+'"]';

			totalElements = args[5].elements.length;
			for (i = 0; i < totalElements; i++) {
				element 		= args[5].elements[i];
				shortcodeData+= '[slide';
				if( element[0].value == "image" ) {
					shortcodeData+= ' type="'+element[0].value+'"';
					shortcodeData+= ' link="'+element[2].value+'"';
					shortcodeData+= ' linktarget="'+element[3].value+'"';
					shortcodeData+= ' lightbox="'+element[4].value+'"]';
					shortcodeData+=   element[1].value;

				} else if ( element[0].value == "video" )  {
					shortcodeData+= ' type="video"]';
					shortcodeData+= 	element[5].value;
				}

				shortcodeData+= '[/slide]';

			}

			shortcodeData+= '[/slider]';

			return shortcodeData;
	}
	/**
	* Returns Sound Cloud shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Sound Cloud doable shortcode
	**/
	frenifyParser.buildSoundcloudShortcode = function( args ) {

		shortcodeData = '[soundcloud';
		shortcodeData+= ' url="'+args[0].value+'"';
		shortcodeData+= ' layout="'+args[1].value+'"';
		shortcodeData+= ' comments="'+args[2].value+'"';
		shortcodeData+= ' show_related="'+args[3].value+'"';
		shortcodeData+= ' show_user="'+args[4].value+'"';
		shortcodeData+= ' auto_play="'+args[5].value+'"';
		shortcodeData+= ' color="'+args[6].value+'"';
		shortcodeData+= ' width="'+args[7].value+'"';
		shortcodeData+= ' height="'+args[8].value+'"';
		shortcodeData+= ' class="'+args[9].value+'"';
		shortcodeData+= ' id="'+args[10].value+'"]';

		return shortcodeData;
	}
	/**
	* Returns Social Links shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Social Links doable shortcode
	**/
	frenifyParser.buildSocialLinksShortcode = function( args ) {

		shortcodeData = '[social_links';
		shortcodeData+= ' icons_boxed="'+args[0].value+'"';
		shortcodeData+= ' icons_boxed_radius="'+args[1].value+'"';
		shortcodeData+= ' icon_colors="'+args[2].value+'"';
		shortcodeData+= ' box_colors="'+args[3].value+'"';
		shortcodeData+= ' tooltip_placement="'+args[4].value+'"';
		shortcodeData+= ' rss="'+args[19].value+'"';
		shortcodeData+= ' facebook="'+args[5].value+'"';
		shortcodeData+= ' twitter="'+args[6].value+'"';
		shortcodeData+= ' instagram="'+args[7].value+'"';
		shortcodeData+= ' dribbble="'+args[8].value+'"';
		shortcodeData+= ' google="'+args[9].value+'"';
		shortcodeData+= ' linkedin="'+args[10].value+'"';
		shortcodeData+= ' blogger="'+args[11].value+'"';
		shortcodeData+= ' tumblr="'+args[12].value+'"';
		shortcodeData+= ' reddit="'+args[13].value+'"';
		shortcodeData+= ' yahoo="'+args[14].value+'"';
		shortcodeData+= ' deviantart="'+args[15].value+'"';
		shortcodeData+= ' vimeo="'+args[16].value+'"';
		shortcodeData+= ' youtube="'+args[17].value+'"';
		shortcodeData+= ' pinterest="'+args[18].value+'"';
		shortcodeData+= ' digg="'+args[20].value+'"';
		shortcodeData+= ' flickr="'+args[21].value+'"';
		shortcodeData+= ' forrst="'+args[22].value+'"';
		shortcodeData+= ' myspace="'+args[23].value+'"';
		shortcodeData+= ' skype="'+args[24].value+'"';
		shortcodeData+= ' paypal="'+args[25].value+'"';
		shortcodeData+= ' dropbox="'+args[26].value+'"';
		shortcodeData+= ' soundcloud="'+args[27].value+'"';
		shortcodeData+= ' vk="'+args[28].value+'"';
		shortcodeData+= ' email="'+args[29].value+'"';
		shortcodeData+= ' show_custom="'+args[30].value+'"';
		shortcodeData+= ' alignment="'+args[31].value+'"';
		shortcodeData+= ' class="'+args[32].value+'"';
		shortcodeData+= ' id="'+args[33].value+'"]';

		return shortcodeData;
	}
	/**
	* Returns Tabs shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildTabsShortcode = function( args ) {
		shortcodeData = '[frenify_fn_tabs';
		shortcodeData+= ' skin="'+args[0].value+'"';
		shortcodeData+= ' position="'+args[1].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';

		totalElements =  args[6].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[6].elements[i];
			shortcodeData+= '[frenify_fn_tab';
			shortcodeData+= ' title="'+element[0].value+'"]';
			shortcodeData+=   element[1].value;
			shortcodeData+= '[/frenify_fn_tab]';

		}

		shortcodeData+= '[/frenify_fn_tabs]';

		return shortcodeData;
	}
	
	/**
	* Returns Accordion shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildAccordionShortcode = function( args ) {
		shortcodeData = '[accordion';
		shortcodeData+= ' skin="'+args[0].value+'"';
		shortcodeData+= ' margin_top="'+args[1].value+'"';
		shortcodeData+= ' margin_bottom="'+args[2].value+'"';
		shortcodeData+= ' class="'+args[3].value+'"';
		shortcodeData+= ' id="'+args[4].value+'"]';

		totalElements =  args[5].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[5].elements[i];
			shortcodeData+= '[acc';
			shortcodeData+= ' title="'+element[0].value+'"';
			shortcodeData+= ' open="'+element[1].value+'"]';
			shortcodeData+=   element[2].value;
			shortcodeData+= '[/acc]';

		}

		shortcodeData+= '[/accordion]';

		return shortcodeData;
	}
	
	/**
	* Returns Toggles shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tabs doable shortcode
	**/
	frenifyParser.buildToggleShortcode = function( args ) {
		shortcodeData = '[toggle';
		shortcodeData+= ' skin="'+args[0].value+'"';
		shortcodeData+= ' margin_top="'+args[1].value+'"';
		shortcodeData+= ' margin_bottom="'+args[2].value+'"';
		shortcodeData+= ' class="'+args[3].value+'"';
		shortcodeData+= ' id="'+args[4].value+'"]';

		totalElements =  args[5].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[5].elements[i];
			shortcodeData+= '[tog';
			shortcodeData+= ' title="'+element[0].value+'"]';
			shortcodeData+=   element[1].value;
			shortcodeData+= '[/tog]';

		}

		shortcodeData+= '[/toggle]';

		return shortcodeData;
	}
	
	/**
	* Returns shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tagline doable shortcode
	**/
	frenifyParser.buildExpandableShortcode = function( args ) {
		shortcodeData = '[expandable';
		shortcodeData+= ' title="'+args[0].value+'"';
		shortcodeData+= ' margin_top="'+args[2].value+'"';
		shortcodeData+= ' margin_bottom="'+args[3].value+'"';
		shortcodeData+= ' class="'+args[4].value+'"';
		shortcodeData+= ' id="'+args[5].value+'"]';
		shortcodeData+= args[1].value;
		shortcodeData+= '[/expandable]';

		return shortcodeData;
	}
	
	/**
	* Returns shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tagline doable shortcode
	**/
	frenifyParser.buildCountdownShortcode = function( args ) {
		shortcodeData = '[countdown';
		shortcodeData+= ' time="'+args[0].value+'"';
		shortcodeData+= ' date="'+args[1].value+'"';
		shortcodeData+= ' skin="'+args[2].value+'"';
		shortcodeData+= ' size="'+args[3].value+'"';
		shortcodeData+= ' margin_top="'+args[4].value+'"';
		shortcodeData+= ' margin_bottom="'+args[5].value+'"';
		shortcodeData+= ' class="'+args[6].value+'"';
		shortcodeData+= ' id="'+args[7].value+'"]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Table shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Table doable shortcode
	**/
	frenifyParser.buildTableShortcode = function( args ) {
		return args[2].value;
	}
	/**
	* Returns Tagline shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tagline doable shortcode
	**/
	frenifyParser.buildTaglineShortcode = function( args ) {
		shortcodeData = '[tagline_box';
		shortcodeData+= ' backgroundcolor="'+args[0].value+'"';
		shortcodeData+= ' shadow="'+args[1].value+'"';
		shortcodeData+= ' shadowopacity="'+args[2].value+'"';
		shortcodeData+= ' border="'+args[3].value+'"';
		shortcodeData+= ' bordercolor="'+args[4].value+'"';
		shortcodeData+= ' highlightposition="'+args[5].value+'"';
		shortcodeData+= ' content_alignment="'+args[6].value+'"';
		shortcodeData+= ' link="'+args[8].value+'"';
		shortcodeData+= ' linktarget="'+args[9].value+'"';
		shortcodeData+= ' modal="'+args[10].value+'"';
		shortcodeData+= ' button_size="'+args[11].value+'"';
		shortcodeData+= ' button_shape="'+args[13].value+'"';
		shortcodeData+= ' button_type="'+args[12].value+'"';
		shortcodeData+= ' buttoncolor="'+args[14].value+'"';
		shortcodeData+= ' button="'+args[7].value+'"';
		shortcodeData+= ' title="'+args[15].value+'"';
		shortcodeData+= ' description="'+args[16].value+'"';
		shortcodeData+= ' margin_top="'+args[18].value+'"';
		shortcodeData+= ' margin_bottom="'+args[19].value+'"';
		shortcodeData+= ' animation_type="'+args[20].value+'"';
		shortcodeData+= ' animation_direction="'+args[21].value+'"';
		shortcodeData+= ' animation_speed="'+args[22].value+'"';
		shortcodeData+= ' class="'+args[23].value+'"';
		shortcodeData+= ' id="'+args[24].value+'"]';
		shortcodeData+= args[17].value;
		shortcodeData+= '[/tagline_box]';

		return shortcodeData;
	}
	/**
	* Returns Testimonial shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Testimonial doable shortcode
	**/
	frenifyParser.buildTestimonialShortcode = function( args ) {
		shortcodeData = '[testimonials';
		/*shortcodeData+= ' design="'+args[0].value+'"';
		shortcodeData+= ' backgroundcolor="'+args[1].value+'"';
		shortcodeData+= ' textcolor="'+args[2].value+'"';
		shortcodeData+= ' random="'+args[3].value+'"';*/
		shortcodeData+= ' margin_top="'+args[0].value+'"';
		shortcodeData+= ' margin_bottom="'+args[1].value+'"';
		shortcodeData+= ' class="'+args[2].value+'"';
		shortcodeData+= ' id="'+args[3].value+'"]';

		totalElements = args[4].elements.length;

		for (i = 0; i < totalElements; i++) {
			element 		= args[4].elements[i];
			shortcodeData+= '[testimonial';
			shortcodeData+= ' name="'+element[0].value+'"]';
			/*shortcodeData+= ' avatar="'+element[1].value+'"';
			shortcodeData+= ' image="'+element[2].value+'"';
			shortcodeData+= ' image_border_radius="'+element[3].value+'"';
			shortcodeData+= ' company="'+element[4].value+'"';
			shortcodeData+= ' link="'+element[5].value+'"';
			shortcodeData+= ' target="'+element[6].value+'"]';*/
			shortcodeData+=   element[1].value;
			shortcodeData+= '[/testimonial]';

		}
		shortcodeData+= '[/testimonials]';

		return shortcodeData;
	}
	
	
	/**
	* Returns Text Block shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Text Block doable shortcode
	**/
	frenifyParser.buildTextBlockShortcode = function( args ) {

		shortcodeData = '[frenify_fn_text]'+args[0].value+'[/frenify_fn_text]';
		return shortcodeData;
	}
	/**
	* Returns Title shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Title doable shortcode
	**/
	frenifyParser.buildCustomTitleShortcode = function( args ) {
		shortcodeData = '[customtitle';
		shortcodeData+= ' template="'+args[1].value+'"';
		shortcodeData+= ' size="'+args[2].value+'"';
		shortcodeData+= ' text_transform="'+args[3].value+'"';
		shortcodeData+= ' text_align="'+args[4].value+'"';
		shortcodeData+= ' color="'+args[5].value+'"';
		shortcodeData+= ' margin_top="'+args[6].value+'"';
		shortcodeData+= ' margin_bottom="'+args[7].value+'"';
		shortcodeData+= ' class="'+args[8].value+'"';
		shortcodeData+= ' id="'+args[9].value+'"]';
		shortcodeData+= args[0].value;
		shortcodeData+= '[/customtitle]';
		return shortcodeData;
	}
	/**
	* Returns Intro shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Title doable shortcode
	**/
	frenifyParser.buildIntroShortcode = function( args ) {
		shortcodeData = '[intro';
		shortcodeData+= ' main_text="'+args[0].value+'"';
		shortcodeData+= ' image="'+args[1].value+'"';
		shortcodeData+= ' button_text="'+args[2].value+'"';
		shortcodeData+= ' button_href="'+args[3].value+'"';
		shortcodeData+= ' button_hover="'+args[4].value+'"';
		shortcodeData+= ' todown="'+args[5].value+'"';
		shortcodeData+= ' class="'+args[6].value+'"';
		shortcodeData+= ' id="'+args[7].value+'"] ';
		shortcodeData+= '[/intro]';
		return shortcodeData;
	}
	
	/**
	* Returns Tooltip shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Tooltip doable shortcode
	**/
	/*frenifyParser.buildTooltipShortcode = function( args ) {

		shortcodeData = '[tooltip ';
		shortcodeData+= ' title="'+args[0].value+'" ';
		shortcodeData+= ' placement="'+args[1].value+'" ';
		shortcodeData+= ' class="'+args[3].value+'" ';
		shortcodeData+= ' id="'+args[4].value+'"] ';
		shortcodeData+= args[2].value;
		shortcodeData+= ' [/tooltip]';
		shortcodeData+= ' \r';
		return shortcodeData;
	}*/
	/**
	* Returns Vimeo shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Vimeo doable shortcode
	**/
	//frenifyParser.buildVimeoShortcode = function( args ) {
    //
	//	shortcodeData = '[vimeo';
	//	shortcodeData+= ' id="'+args[0].value+'"';
	//	shortcodeData+= ' width="'+args[1].value+'"';
	//	shortcodeData+= ' height="'+args[2].value+'"';
	//	shortcodeData+= ' autoplay="'+args[3].value+'"';
	//	shortcodeData+= ' api_params="'+args[4].value+'"';
	//	shortcodeData+= ' class="'+args[5].value+'"]';
    //
	//	return shortcodeData;
	//}
	/**
	* Returns Woo Featured shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Woo Featured doable shortcode
	**/
	//frenifyParser.buildWooFeaturedShortcode = function( args ) {
    //
	//	shortcodeData = '[featured_products_slider';
	//	shortcodeData+= ' class="'+args[1].value+'"';
	//	shortcodeData+= ' id="'+args[2].value+'"]';
    //
	//	return shortcodeData;
	//}
	/**
	* Returns Woo Slider shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Woo Slider doable shortcode
	**/
	//frenifyParser.buildWooCarouselShortcode = function( args ) {
    //
	//	shortcodeData = '[products_slider';
	//	shortcodeData+= ' picture_size="'+args[0].value+'"';
	//	shortcodeData+= ' cat_slug="'+frenifyParser.getUniqueElements(args[1].value).join()+'"';
	//	shortcodeData+= ' number_posts="'+args[2].value+'"';
	//	shortcodeData+= ' carousel_layout="'+args[3].value+'"';
	//	shortcodeData+= ' autoplay="'+args[4].value+'"';
	//	shortcodeData+= ' columns="'+args[5].value+'"';
	//	shortcodeData+= ' column_spacing="'+args[6].value+'"';
	//	shortcodeData+= ' show_nav="'+args[7].value+'"';
	//	shortcodeData+= ' mouse_scroll="'+args[8].value+'"';
	//	shortcodeData+= ' show_cats="'+args[9].value+'"';
	//	shortcodeData+= ' show_price="'+args[10].value+'"';
	//	shortcodeData+= ' show_buttons="'+args[11].value+'"';
	//	shortcodeData+= ' class="'+args[12].value+'"';
	//	shortcodeData+= ' id="'+args[13].value+'"]';
    //
	//	return shortcodeData;
	//}
	/**
	* Returns Woo Shortcodes shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Woo Shortcodes doable shortcode
	**/
	frenifyParser.buildWooShortcodes = function( args ) {
		return args[1].value;
	}
	/**
	* Returns Youtube shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		Youtube doable shortcode
	**/
	//frenifyParser.buildYoutubeShortcode = function( args ) {
    //
	//	shortcodeData = '[youtube';
	//	shortcodeData+= ' id="'+args[0].value+'"';
	//	shortcodeData+= ' width="'+args[1].value+'"';
	//	shortcodeData+= ' height="'+args[2].value+'"';
	//	shortcodeData+= ' autoplay="'+args[3].value+'"';
	//	shortcodeData+= ' api_params="'+args[4].value+'"';
	//	shortcodeData+= ' class="'+args[5].value+'"]';
    //
	//	return shortcodeData;
	//}
	/**
	* Returns frenify Slider shortcode
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having element data
	*
	* @return 		String		frenify Slider doable shortcode
	**/
	//frenifyParser.buildfrenifySliderShortcode = function( args ) {
    //
	//	shortcodeData = '[frenifyslider';
	//	shortcodeData+= ' name="'+args[0].value+'"';
	//	shortcodeData+= ' class="'+args[1].value+'"';
	//	shortcodeData+= ' id="'+args[2].value+'"]';
    //
	//	return shortcodeData;
	//}
	/**
	* Returns unique elements
	*
	* @since	 	2.0.0
	*
	* @param		OBJECT 		Object having duplicate elements data
	*
	* @return 		OBJECT		Object with removed duplicates
	**/
	frenifyParser.getUniqueElements = function unique( list ) {
		var result = [];
		$.each(list, function(i, e) {
			if ($.inArray(e, result) == -1 && e != '')
				result.push(e);
		});

		return result;
	}
	/**
	* Encode content to base64
	*
	* @since	 	1.6.2
	*
	* @param		STRING 		String containing code and other content
	*
	* @return 		STRING		Base64 encoded content
	**/
	frenifyParser.base64Encode = function(data) {

		var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
		var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
		ac = 0,
		enc = '',
		tmp_arr = [];

		if (!data) {
			return data;
		}

		data = unescape(encodeURIComponent(data));

		do {
				// pack three octets into four hexets
				o1 = data.charCodeAt(i++);
				o2 = data.charCodeAt(i++);
				o3 = data.charCodeAt(i++);

				bits = o1 << 16 | o2 << 8 | o3;

				h1 = bits >> 18 & 0x3f;
				h2 = bits >> 12 & 0x3f;
				h3 = bits >> 6 & 0x3f;
				h4 = bits & 0x3f;

				// use hexets to index into b64, and append result to encoded string
				tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
		} while (i < data.length);

		enc = tmp_arr.join('');

		var r = data.length % 3;

		return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
	}

  })(jQuery);

