<?php
/**
 * BuilderElements implementation
 */
class BuilderElements {
	private $value 		= array();
	private $elements 	= array();
	
	public function __construct() 
	{
		$this->value['id'] 		= "builder_elements_div";
		$this->value['name'] 	= __('Elements', 'frenify-core');
		$this->value['icon'] 	= "icon_pack/tab_icon_4.png";
		$this->value['class']	= "frenify-tab frenifya-TFico";
		
		$this->load_elements();
	}
	
	public function to_array() 
	{
		$this->value['elements'] = $this->elements;
		return $this->value;
	}
	
	/**
	 * Load all the category's elements
	 */
	private function load_elements() 
	{
		
		$about_me 	= new fotofly_fn_AboutMe();
		array_push($this->elements, $about_me->element_to_array());
		
		$about_slider	= new fotofly_fn_AboutSlider();
		array_push($this->elements, $about_slider->element_to_array());
		
		$accordion 		= new fotofly_fn_Accordion();
		array_push($this->elements, $accordion->element_to_array());
		
		$alert_fn 		= new fotofly_fn_Alert();
		array_push($this->elements, $alert_fn->element_to_array());
		
		$fn_blog		= new fotofly_fn_BlogFn();
		array_push($this->elements, $fn_blog->element_to_array());
		
		$brochure		= new fotofly_fn_Brochure();
		array_push($this->elements, $brochure->element_to_array());
		
		$call_to_action	= new fotofly_fn_CallToAction();
		array_push($this->elements, $call_to_action->element_to_array());
		
		$call_to_action_classic	= new fotofly_fn_CallToActionClassic();
		array_push($this->elements, $call_to_action_classic->element_to_array());
		
		$category_column_gallery = new fotofly_fn_CategoryColumnGallery();
		array_push($this->elements, $category_column_gallery->element_to_array());
		
		$category_column_portfolio = new fotofly_fn_CategoryColumnPortfolio();
		array_push($this->elements, $category_column_portfolio->element_to_array());
		
		$contact_info	= new fotofly_fn_ContactInfo();
		array_push($this->elements, $contact_info->element_to_array());
		
		$contentbox 	= new fotofly_fn_TDContent();
		array_push($this->elements, $contentbox->element_to_array());
		
		$cortex_slider = new fotofly_fn_CortexSlider();
		array_push($this->elements, $cortex_slider->element_to_array());
		
		$counter_box	= new fotofly_fn_CounterBox();
		array_push($this->elements, $counter_box->element_to_array());
		
		$coverbox 		= new fotofly_fn_Coverbox();
		array_push($this->elements, $coverbox->element_to_array());
		
		$custompost_carousel = new fotofly_fn_CustompostCarousel();
		array_push($this->elements, $custompost_carousel->element_to_array());
		
		$custompost_carousel_two = new fotofly_fn_CustompostCarouselTwo();
		array_push($this->elements, $custompost_carousel_two->element_to_array());
		
		$custompost_ribbon = new fotofly_fn_CustompostRibbon();
		array_push($this->elements, $custompost_ribbon->element_to_array());
		
		$customlink 	= new fotofly_fn_CustomLink();
		array_push($this->elements, $customlink->element_to_array());
		
		$customtitle 	= new fotofly_fn_CustomTitle();
		array_push($this->elements, $customtitle->element_to_array());
		
		$custompost_category_folder = new fotofly_fn_CustompostCategoryFolder();
		array_push($this->elements, $custompost_category_folder->element_to_array());
		
		$custompost_category_modern = new fotofly_fn_CustompostCategoryModern();
		array_push($this->elements, $custompost_category_modern->element_to_array());
		
		$cuspost_parallax 	= new fotofly_fn_CustompostParallax();
		array_push($this->elements, $cuspost_parallax->element_to_array());
		
		/*$expandable 	= new fotofly_fn_Expandable();
		array_push($this->elements, $expandable->element_to_array());*/
		
		$flexslider		= new fotofly_fn_Flexslider();
		array_push($this->elements, $flexslider->element_to_array());
		
		$flipbox_fn	= new fotofly_fn_FlipboxFn();
		array_push($this->elements, $flipbox_fn->element_to_array());
		
		$flowgallery 	= new fotofly_fn_FlowGallery();
		array_push($this->elements, $flowgallery->element_to_array());
		
		$fullpage_gallery 	= new fotofly_fn_FullPageGallery();
		array_push($this->elements, $fullpage_gallery->element_to_array());
		
		$halfimage 	= new fotofly_fn_HalfImage();
		array_push($this->elements, $halfimage->element_to_array());
		
		$hotspot 		= new fotofly_fn_Hotspot();
		array_push($this->elements, $hotspot->element_to_array());
		
		$hover_width	= new fotofly_fn_HoverWidth();
		array_push($this->elements, $hover_width->element_to_array());
		
		$img_after_before	= new fotofly_fn_ImgAfterBefore();
		array_push($this->elements, $img_after_before->element_to_array());
		
		$instagram_box 	= new fotofly_fn_Instagram();
		array_push($this->elements, $instagram_box->element_to_array());
		
		$kenburns 		= new fotofly_fn_Kenburns();
		array_push($this->elements, $kenburns->element_to_array());
		
		$button_fn		= new fotofly_fn_ButtonFn();
		array_push($this->elements, $button_fn->element_to_array());
		
		$maintitle 	= new fotofly_fn_MainTitle();
		array_push($this->elements, $maintitle->element_to_array());
		
		$multi_scroll = new fotofly_fn_MultiScroll();
		array_push($this->elements, $multi_scroll->element_to_array());
		
		$person_box 	= new fotofly_fn_Person();
		array_push($this->elements, $person_box->element_to_array());
		
		$portfolio_custom = new fotofly_fn_PortfolioCustom();
		array_push($this->elements, $portfolio_custom->element_to_array());
		
		$progress_bar 	= new fotofly_fn_ProgressBar();
		array_push($this->elements, $progress_bar->element_to_array());
		
		$project_slider	= new fotofly_fn_ProjectSlider();
		array_push($this->elements, $project_slider->element_to_array());
		
		/*$service 		= new fotofly_fn_Service();
		array_push($this->elements, $service->element_to_array());*/
		
		$service_carousel = new fotofly_fn_ServiceCarousel();
		array_push($this->elements, $service_carousel->element_to_array());
		
		$service_list	= new fotofly_fn_ServiceList();
		array_push($this->elements, $service_list->element_to_array());
		
		$servicetab_single	= new fotofly_fn_ServiceTabSingle();
		array_push($this->elements, $servicetab_single->element_to_array());
		
		$servicetabs 	= new fotofly_fn_Servicetabs();
		array_push($this->elements, $servicetabs->element_to_array());
		
		$social_list 	= new fotofly_fn_SocialList();
		array_push($this->elements, $social_list->element_to_array());
		
		$tabs 			= new fotofly_fn_Tabs();
		array_push($this->elements, $tabs->element_to_array());
		
		$testimonial 	= new fotofly_fn_Testimonial();
		array_push($this->elements, $testimonial->element_to_array());
		
		$testimonial_single	= new fotofly_fn_TestimonialSingle();
		array_push($this->elements, $testimonial_single->element_to_array());
		
		$unitinfo		= new fotofly_fn_UnitInfo();
		array_push($this->elements, $unitinfo->element_to_array());
		
		$workstep 		= new fotofly_fn_WorkStep();
		array_push($this->elements, $workstep->element_to_array());
		
		$wotoslider		= new fotofly_fn_Wotoslider();
		array_push($this->elements, $wotoslider->element_to_array());
		
		/*$supersized 	= new fotofly_fn_Supersized();
		array_push($this->elements, $supersized->element_to_array());*/
		
		//$countdown 		= new fotofly_fn_Countdown();
		//array_push($this->elements, $countdown->element_to_array());
		
		//$client	= new fotofly_fn_Client();
		//array_push($this->elements, $client->element_to_array());
		
		//$comparison 	= new fotofly_fn_Comparison();
		//array_push($this->elements, $comparison->element_to_array());
		
		//$modal 			= new fotofly_fn_Modal();
		//array_push($this->elements, $modal->element_to_array());
		
		
		//$intro 			= new fotofly_fn_Intro();
		//array_push($this->elements, $intro->element_to_array());
		
		//$gallery 		= new fotofly_fn_Gallery();
		//array_push($this->elements, $gallery->element_to_array());
		
		//$recent_posts 	= new fotofly_fn_RecentPosts();
		//array_push($this->elements, $recent_posts->element_to_array());
		
		
		
		//$servicepack 	= new fotofly_fn_Servicepack();
		//array_push($this->elements, $servicepack->element_to_array());
		
		//$toggle 		= new fotofly_fn_Toggle();
		//array_push($this->elements, $toggle->element_to_array());
		
		//$button_block	= new fotofly_fn_ButtonBlock();
		//array_push($this->elements, $button_block->element_to_array());
		
		//$checklist		= new fotofly_fn_CheckList();
		//array_push($this->elements, $checklist->element_to_array());
		
		//$code_block		= new fotofly_fn_CodeBlock();
		//array_push($this->elements, $code_block->element_to_array());
		
		//$content_boxes	= new fotofly_fn_ContentBoxes();
		//array_push($this->elements, $content_boxes->element_to_array());

		//$counter_circle	= new fotofly_fn_CounterCircle();
		//array_push($this->elements, $counter_circle->element_to_array());
		
		/*$drop_Cap		= new fotofly_fn_DropCap();
		array_push($this->elements, $drop_Cap->element_to_array());*/
		
		//$flip_boxes		= new fotofly_fn_FlipBoxes();
		//array_push($this->elements, $flip_boxes->element_to_array());
		
		//$font_awesmoe 	= new fotofly_fn_FontAwesome();
		//array_push($this->elements, $font_awesmoe->element_to_array());
		
		//$frenifyslider	= new fotofly_fn_frenifySlider();
		//array_push($this->elements, $frenifyslider->element_to_array());
		
		//$google_map 	= new fotofly_fn_GoogleMap();
		//array_push($this->elements, $google_map->element_to_array());
		
		/*$high_light 	= new fotofly_fn_HighLight();
		array_push($this->elements, $high_light->element_to_array());*/

		//$image_carousel = new fotofly_fn_ImageCarousel();
		//array_push($this->elements, $image_carousel->element_to_array());
		
		//$image_frame 	= new fotofly_fn_ImageFrame();
		//array_push($this->elements, $image_frame->element_to_array());

		//$layer_slider 	= new fotofly_fn_LayerSlider();
		//array_push($this->elements, $layer_slider->element_to_array());
		
		/*$light_box 		= new fotofly_fn_LightBox();
		array_push($this->elements, $light_box->element_to_array());*/
		
		//$menu_anchor 	= new fotofly_fn_MenuAnchor();
		//array_push($this->elements, $menu_anchor->element_to_array());
		
		//$post_slider	= new fotofly_fn_PostSlider();
		//array_push($this->elements, $post_slider->element_to_array());
		
		/*$person_box 	= new fotofly_fn_Popover();
		array_push($this->elements, $person_box->element_to_array());*/
		
		//$pricing_table 	= new fotofly_fn_PricingTable();
		//array_push($this->elements, $pricing_table->element_to_array());
		
		
		//$recent_posts 	= new fotofly_fn_RecentPosts();
		//array_push($this->elements, $recent_posts->element_to_array());
		
		
		
		//$revolution	 	= new fotofly_fn_RevolutionSlider();
		//array_push($this->elements, $revolution->element_to_array());
		
		//$section_sep	 = new fotofly_fn_SectionSeparator();
		//array_push($this->elements, $section_sep->element_to_array());
		
		//$separator 		= new fotofly_fn_Separator();
		//array_push($this->elements, $separator->element_to_array());
		
		//$sharing_box 	= new fotofly_fn_SharingBox();
		//array_push($this->elements, $sharing_box->element_to_array());
		
		//$slider 		= new fotofly_fn_Slider();
		//array_push($this->elements, $slider->element_to_array());

		//$social_links 	= new fotofly_fn_SocialLinks();
		//array_push($this->elements, $social_links->element_to_array());
		
		//$sound_cloud 	= new fotofly_fn_SoundCloud();
		//array_push($this->elements, $sound_cloud->element_to_array());

		//$table 			= new fotofly_fn_Table();
		//array_push($this->elements, $table->element_to_array());

		/*$tagline_box 	= new fotofly_fn_TaglineBox();
		array_push($this->elements, $tagline_box->element_to_array());*/
		
		/*$text_block 	= new fotofly_fn_frenifyText();
		array_push($this->elements, $text_block->element_to_array());*/
		
		/*$tooltip 		= new fotofly_fn_Tooltip();
		array_push($this->elements, $tooltip->element_to_array());*/
		
		/*$vimeo 			= new fotofly_fn_Vimeo();
		array_push($this->elements, $vimeo->element_to_array());*/

		/*$woo_carousel 	= new fotofly_fn_WooCarousel();
		array_push($this->elements, $woo_carousel->element_to_array());*/
		
		/*$woo_featured 	= new fotofly_fn_WooFeatured();
		array_push($this->elements, $woo_featured->element_to_array());*/
		
		/*$woo_shortcodes = new fotofly_fn_WooShortcodes();
		array_push($this->elements, $woo_shortcodes->element_to_array());*/
		
		/*$youtube 		= new fotofly_fn_Youtube();
		array_push($this->elements, $youtube->element_to_array());*/
		
	}  
} 
