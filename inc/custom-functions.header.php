<?php
/**
CUSTOM HEADER FUNCTIONS
*/




/**
Function name: 				cryptic_current_header_template()			
Function description:		Gets the current header variant from theme options. If page has custom options, theme options will be overwritten.
*/
function cryptic_current_header_template(){

	global  $cryptic_redux;


    // PAGE METAS
    $custom_header_activated = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
    $header_v = get_post_meta( get_the_ID(), 'smartowl_header_custom_variant', true );
	$sidebar_headers = array('header6', 'header7', 'header14', 'header15');

	// THEME INIT
    $theme_init = new cryptic_init_class;

	$html = '';

    if (is_page() && $header_v) {
        if ($custom_header_activated && $custom_header_activated == 'yes') {
			if (!in_array($header_v, $sidebar_headers)){
            	$html .= get_template_part( 'templates/template-'.esc_html($header_v) ); ?>

        	<?php }else{ ?>

        	<?php }
        }?>
    <?php }else{
    	if (isset($cryptic_redux['mt_header_layout'])) {
			if (!in_array($header_v, $sidebar_headers)){
    			$html .= get_template_part( 'templates/template-'.esc_html($cryptic_redux['mt_header_layout']) );
        	}
    	}else{
    		$html .= get_template_part( 'templates/template-'.esc_html($theme_init->cryptic_get_header_variant()) );
    	}
    }
    return $html;
}


/**
||-> FUNCTION: GET GOOGLE FONTS FROM THEME OPTIONS PANEL
*/
function cryptic_get_site_fonts(){
    global  $cryptic_redux;
    $fonts_string = '';
    if (isset($cryptic_redux['mt_google_fonts_select'])) {
        $i = 0;
        $len = count($cryptic_redux['mt_google_fonts_select']);
        foreach(array_keys($cryptic_redux['mt_google_fonts_select']) as $key){
            $font_url = str_replace(' ', '+', $cryptic_redux['mt_google_fonts_select'][$key]);
            
            if ($i == $len - 1) {
                // last
                $fonts_string .= $font_url;
            }else{
                $fonts_string .= $font_url . '|';
            }
            $i++;
        }
        // fonts url
        $fonts_url = add_query_arg( 'family', $fonts_string, "//fonts.googleapis.com/css" );
        // enqueue fonts
        wp_enqueue_style( 'cryptic-fonts', $fonts_url, array(), '1.0.0' );
    }
}
add_action('wp_enqueue_scripts', 'cryptic_get_site_fonts');


// Add specific CSS class by filter
add_filter( 'body_class', 'cryptic_body_classes' );
function cryptic_body_classes( $classes ) {

	global  $cryptic_redux;
	$theme_init = new cryptic_init_class;

    $plugin_redux_status = '';
    if (!cryptic_plugin_active('redux-framework/redux-framework.php')) {
        $plugin_redux_status = 'missing-redux-framework';
    }
    $plugin_modeltheme_status = '';
    if (!cryptic_plugin_active('modeltheme-framework/modeltheme-framework.php')) {
        $plugin_modeltheme_status = 'missing-modeltheme-framework';
    }

	// POST META FOOTER STATUS
    $row1_status = get_post_meta( get_the_ID(), 'mt_footer_row1_status', true );
    $row2_status = get_post_meta( get_the_ID(), 'mt_footer_row2_status', true );
    $row3_status = get_post_meta( get_the_ID(), 'mt_footer_row3_status', true );
    $footer_bottom_bar = get_post_meta( get_the_ID(), 'mt_footer_bottom_bar', true );
    $mt_page_preloader_status = get_post_meta( get_the_ID(), 'mt_page_preloader_status', true );
    $page_boxed_status = get_post_meta( get_the_ID(), 'mt_page_boxed_status', true );

	$footers_row1_status = '';
	$footers_row2_status = '';
	$footers_row3_status = '';
	$footers_status = '';
	$page_preloader_status = '';
	$mt_page_boxed_status = '';

	if (is_single() || is_page()) {
		# code...
		if ($row1_status == 'on') {
			$footers_row1_status = 'footer_row1_off';
		}
		if ($row2_status == 'on') {
			$footers_row2_status = 'footer_row2_off';
		}
		if ($row3_status == 'on') {
			$footers_row3_status = 'footer_row3_off';
		}
		if ($footer_bottom_bar == 'on') {
			$footers_status = 'footer_bottom_bar_off';
		}
		if ($mt_page_preloader_status == 'on') {
			$page_preloader_status = 'page_preloader_off';
		}
		if ($page_boxed_status == 'on') {
			$mt_page_boxed_status = 'page_boxed_on';
		}
	}
	

    // CHECK IF FEATURED IMAGE IS FALSE(Disabled)
    $post_featured_image = '';
    if (is_singular('post')) {
        if ($cryptic_redux['mt_post_featured_image'] == false) {
            $post_featured_image = 'hide_post_featured_image';
        }else{
            $post_featured_image = '';
        }
    }

    // CHECK IF THE NAV IS STICKY
    $is_nav_sticky = '';
    $custom_header_options_status = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
    $is_nav_sticky_meta = get_post_meta( get_the_ID(), 'smartowl_header_custom_fixed_navigation', true );
    if (isset($custom_header_options_status) && $custom_header_options_status == 'yes' && isset($is_nav_sticky_meta) && $is_nav_sticky_meta == 'enabled') {
        $is_nav_sticky = 'is_nav_sticky is_nav_sticky_metabox';
    }else{
	    if ($cryptic_redux['mt_is_nav_sticky'] == true) {
	        // If is sticky
	        $is_nav_sticky = 'is_nav_sticky';
	    }else{
	        // If is not sticky
	        $is_nav_sticky = '';
	    }
    }


    // CHECK IF HEADER IS SEMITRANSPARENT
    $semitransparent_header_meta = get_post_meta( get_the_ID(), 'mt_header_semitransparent', true );
    $semitransparent_header = '';
    if ($semitransparent_header_meta == 'enabled') {
        // If is semitransparent
        $semitransparent_header = 'is_header_semitransparent';
    }

    // DIFFERENT HEADER LAYOUT TEMPLATES
    $header_status = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
    $header_v = get_post_meta( get_the_ID(), 'smartowl_header_custom_variant', true );

    
    $header_version = $theme_init->cryptic_get_header_variant();
    if (isset($header_status) && $header_status == 'yes') {
    	$header_version = $header_v;
    }else{
	    if ($cryptic_redux['mt_header_layout']) {
	        // Header Layout #1
	        $header_version = $cryptic_redux['mt_header_layout'];
	    }
    }


    // HEADER NAVIGATION HOVER STYLE
	$header_nav_hover = $theme_init->cryptic_navstyle_variant();
	$sidebar_widgets_variant = $theme_init->cryptic_get_sidebar_widgets_variant();

    $classes[] = esc_attr($mt_page_boxed_status) . ' ' . esc_attr($sidebar_widgets_variant) . ' ' . esc_attr($plugin_modeltheme_status) . ' ' . esc_attr($plugin_redux_status) . ' ' . esc_attr($header_nav_hover) . ' ' . esc_attr($page_preloader_status) . ' ' . esc_attr($footers_status) . ' ' . esc_attr($footers_row1_status) . ' ' . esc_attr($footers_row2_status) . ' ' . esc_attr($footers_row3_status) . ' ' . esc_attr($post_featured_image) . ' ' . esc_attr($is_nav_sticky) . ' ' . esc_attr($header_version) . ' ' . esc_attr($semitransparent_header) . ' ';

    return $classes;

}

/**
||-> FUNCTION: GET DYNAMIC CSS
*/
add_action('wp_enqueue_scripts', 'cryptic_dynamic_css' );
function cryptic_dynamic_css(){

    $html = '';

    // THEME INIT
    $theme_init = new cryptic_init_class;

	// BEGIN: REVAMP SKIN COLORS ===============================================================================
	$skin_main_bg = $theme_init->cryptic_get_fallback_primary_color(); //Fallback primary background color
	$skin_main_bg_hover = $theme_init->cryptic_get_fallback_primary_color_hover(); //Fallback primary background hover color
	$skin_main_texts = $theme_init->cryptic_get_fallback_main_texts(); //Fallback main text color
	$skin_semitransparent_blocks = $theme_init->cryptic_get_fallback_semitransparent_blocks(); //Fallback semitransparent blocks


	// CUSTOM PAGE METABOXES
	$custom_header_activated = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
    $mt_custom_main_color = get_post_meta( get_the_ID(), 'mt_custom_main_color', true );
    $mt_custom_main_hover_color = get_post_meta( get_the_ID(), 'mt_custom_main_hover_color', true );
    $mt_main_menu_custom_color = get_post_meta( get_the_ID(), 'mt_main_menu_custom_color', true );


    if($custom_header_activated == 'yes' && isset($mt_custom_main_color) && isset($mt_custom_main_hover_color) && !empty($mt_custom_main_color) && !empty($mt_custom_main_hover_color)) {

    	$skin_main_bg = $mt_custom_main_color;
		$skin_main_bg_hover = $mt_custom_main_hover_color;

    } else {
	    if (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_blue') {
			$skin_main_bg = 				'#3498db';
			$skin_main_bg_hover = 			'#2980b9';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(52, 152, 219, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_turquoise'){
			$skin_main_bg = 				'#1abc9c';
			$skin_main_bg_hover = 			'#16a085';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(26, 188, 156, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_green'){
			$skin_main_bg = 				'#2ecc71';
			$skin_main_bg_hover = 			'#27ae60';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(46, 204, 113, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_purple'){
			$skin_main_bg = 				'#9b59b6';
			$skin_main_bg_hover = 			'#8e44ad';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(155, 89, 182, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_yellow'){
			$skin_main_bg = 				'#f1c40f';
			$skin_main_bg_hover = 			'#f39c12';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(241, 196, 15, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_yellow2'){
			$skin_main_bg = 				'#ffd600';
			$skin_main_bg_hover = 			'#e5c000';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(255, 214, 0, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_orange'){
			$skin_main_bg = 				'#e67e22';
			$skin_main_bg_hover = 			'#d35400';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(230, 126, 34, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_red'){
			$skin_main_bg = 				'#e74c3c';
			$skin_main_bg_hover = 			'#c0392b';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(231, 76, 60, 0.7)';
	    }elseif (cryptic_redux('mt_predefined_skin') != '' && cryptic_redux('mt_predefined_skin') == 'skin_gray'){
			$skin_main_bg = 				'#95a5a6';
			$skin_main_bg_hover = 			'#7f8c8d';
			$skin_main_texts = 				'#454646';
			$skin_semitransparent_blocks = 	'rgba(149, 165, 166, 0.7)';
	    }
	}
	// END: REVAMP SKIN COLORS ===============================================================================

    //PAGE PRELOADER BACKGROUND COLOR
    $mt_page_preloader = get_post_meta( get_the_ID(), 'mt_page_preloader', true );
    $mt_page_preloader_bg_color = get_post_meta( get_the_ID(), 'mt_page_preloader_bg_color', true );
    if (isset($mt_page_preloader) && $mt_page_preloader == 'enabled' && isset($mt_page_preloader_bg_color)) {
        $html .= 'body .cryptic_preloader_holder{
					background-color: '.esc_attr($mt_page_preloader_bg_color).';
        		}';
    }elseif (cryptic_redux('mt_preloader_status')) {
        $html .= 'body .cryptic_preloader_holder{
					background-color: '.cryptic_redux('mt_preloader_status').';
        		}';
    }

	// HEADER SEMITRANSPARENT - METABOX
	$custom_header_activated = get_post_meta( get_the_ID(), 'smartowl_custom_header_options_status', true );
	$mt_header_custom_bg_color = get_post_meta( get_the_ID(), 'mt_header_custom_bg_color', true );
	$mt_header_semitransparent = get_post_meta( get_the_ID(), 'mt_header_semitransparent', true );
    if (isset($mt_header_semitransparent) == 'enabled') {
		$mt_header_semitransparentr_rgba_value = get_post_meta( get_the_ID(), 'mt_header_semitransparentr_rgba_value', true );
		$mt_header_semitransparentr_rgba_value_scroll = get_post_meta( get_the_ID(), 'mt_header_semitransparentr_rgba_value_scroll', true );
		
		if (isset($mt_header_custom_bg_color)) {
			list($r, $g, $b) = sscanf($mt_header_custom_bg_color, "#%02x%02x%02x");
		}else{
			$hexa = '#04ABE9'; //Theme Options Color
			list($r, $g, $b) = sscanf($hexa, "#%02x%02x%02x");
		}

		$html .= '
			.is_header_semitransparent .navbar-default {
			    background: rgba('.esc_attr($r).', '.esc_attr($g).', '.esc_attr($b).', '.esc_attr($mt_header_semitransparentr_rgba_value).') none repeat scroll 0 0;
			}
			.is_header_semitransparent .sticky-wrapper.is-sticky .navbar-default {
			    background: rgba('.esc_attr($r).', '.esc_attr($g).', '.esc_attr($b).', '.esc_attr($mt_header_semitransparentr_rgba_value_scroll).') none repeat scroll 0 0;
			}';
    }

    // THEME OPTIONS STYLESHEET

    // BACK TO TOP - CUSTOM STYLING
	if (cryptic_redux('mt_backtotop_status') == true) {
		 $html .= '.back-to-top {
					background: '.cryptic_redux('mt_backtotop_bg_color').';
					color: '.cryptic_redux('mt_backtotop_text_color').';
				}
				.back-to-top:hover {
					background: '.cryptic_redux('mt_backtotop_bg_color_hover').';
					color: '.cryptic_redux('mt_backtotop_text_color_hover').';
				}';
	}

	// SEARCH ICON - CUSTOM STYLING
	if (cryptic_redux('mt_header_is_search_custom_styling') == true) {
		 $html .= 'body header .right-side-social-actions .mt-search-icon i {
					color: '.cryptic_redux('mt_header_search_color').' !important;
				}
				body header .right-side-social-actions .mt-search-icon:hover i {
					color: '.cryptic_redux('mt_header_search_color_hover').' !important;
				}';
	}

	// BURGER SIDEBAR MENU - CUSTOM STYLING
	if (cryptic_redux('mt_header_fixed_sidebar_menu_custom_styling') == true) {
		 $html .= 'body #mt-nav-burger span {
					background: '.cryptic_redux('mt_header_fixed_sidebar_menu_color').' !important;
				}
				body #mt-nav-burger:hover span {
					background: '.cryptic_redux('mt_header_fixed_sidebar_menu_color_hover').' !important;
				}';
	}


	// FALLBACKS for REDUX FRAMEWORK
	$breadcrumbs_delimitator = '/';
	$logo_max_width = '200';
	$text_selection_color = '#ffffff';
	$body_global_bg = '#ffffff';
	// REDUX FRAMEWORK CONDITIONS
	if(cryptic_plugin_active('redux-framework/redux-framework.php')){
		$breadcrumbs_delimitator = cryptic_redux('mt_breadcrumbs_delimitator');
		$logo_max_width = cryptic_redux('mt_logo_max_width');
		$text_selection_color = cryptic_redux('mt_text_selection_color');
		$body_global_bg = cryptic_redux('mt_body_global_bg');
	}


    // THEME OPTIONS STYLESHEET
    $html .= '.breadcrumb a::after {
	        	  content: "'.esc_html($breadcrumbs_delimitator).'";
	    	}
	    	body{
		        background: '.esc_html($body_global_bg).';
	    	}
    		.logo img,
			.navbar-header .logo img {
				max-width: '.esc_html($logo_max_width).'px;
			}
		    ::selection{
		        color: '.esc_html($text_selection_color).';
		        background: '.esc_html($skin_main_bg).';
		    }
		    ::-moz-selection { /* Code for Firefox */
		        color: '.esc_html($text_selection_color).';
		        background: '.esc_html($skin_main_bg).';
		    }

		    a{
		        color: '.esc_html($skin_main_bg).';
		    }
		    a:focus,
		    a:visited,
		    a:hover{
		        color: '.esc_html($skin_main_bg_hover).';
		    }

		    /*------------------------------------------------------------------
		        COLOR
		    ------------------------------------------------------------------*/
		    a, 
		    a:hover, 
		    a:focus,
		    .mt_car--tax-type,
		    span.amount,
		    .widget_popular_recent_tabs .nav-tabs li.active a,
		    .widget_product_categories .cat-item:hover,
		    .widget_product_categories .cat-item a:hover,
		    .widget_archive li:hover,
		    .widget_archive li a:hover,
		    .widget_categories .cat-item:hover,
		    .widget_categories li a:hover,
		    .pricing-table.recomended .button.solid-button, 
		    .pricing-table .table-content:hover .button.solid-button,
		    .pricing-table.Recommended .button.solid-button, 
		    .pricing-table.recommended .button.solid-button, 
		    #sync2 .owl-item.synced .post_slider_title,
		    #sync2 .owl-item:hover .post_slider_title,
		    #sync2 .owl-item:active .post_slider_title,
		    .pricing-table.recomended .button.solid-button, 
		    .pricing-table .table-content:hover .button.solid-button,
		    .testimonial-author,
		    .testimonials-container blockquote::before,
		    .testimonials-container blockquote::after,
		    .post-author > a,
		    h2 span,
		    label.error,
		    .author-name,
		    .prev-next-post a:hover,
		    .prev-text,
		    .wpb_button.btn-filled:hover,
		    .next-text,
		    .social ul li a:hover i,
		    .wpcf7-form span.wpcf7-not-valid-tip,
		    .text-dark .statistics .stats-head *,
		    .wpb_button.btn-filled,
		    footer ul.menu li.menu-item a:hover,
		    .widget_meta a:hover,
		    .widget_pages a:hover,
		    .blogloop-v1 .post-name a:hover,
		    .blogloop-v2 .post-name a:hover,
		    .blogloop-v3 .post-name a:hover,
		    .blogloop-v4 .post-name a:hover,
		    .blogloop-v5 .post-name a:hover,
			.post-category-comment-date span a:hover,
			.post-category-comment-date span:hover,
			.list-view .post-details .post-category-comment-date i:hover,
			.list-view .post-details .post-category-comment-date a:hover,
		    .simple_sermon_content_top h4,
		    .page_404_v1 h1,
		    .mt_cars--single-main-pic .post-name > a,
		    .widget_recent_comments li:hover a,
		    .list-view .post-details .post-name a:hover,
		    .blogloop-v5 .post-details .post-sticky-label i,
		    header.header2 .header-info-group .header_text_title strong,
		    .widget_recent_entries_with_thumbnail li:hover a,
		    .widget_recent_entries li a:hover,
		    .blogloop-v1 .post-details .post-sticky-label i,
		    .blogloop-v2 .post-details .post-sticky-label i,
		    .blogloop-v3 .post-details .post-sticky-label i,
		    .blogloop-v4 .post-details .post-sticky-label i,
		    .blogloop-v5 .post-details .post-sticky-label i,
		    .mt_listing--price-day.mt_listing--price .mt_listing_price,
            .mt_listing--price-day.mt_listing--price .mt_listing_currency,
            .mt_listing--price-day.mt_listing--price .mt_listing_per,
		    .error-404.not-found h1,
		    .header-info-group i,
            .woocommerce form .form-row .required,
            .woocommerce .woocommerce-info::before,
            .woocommerce .woocommerce-message::before,
            .woocommerce div.product p.price, 
            .woocommerce div.product span.price,
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
            .related.products ul.products li.product .button,         
		    .error-404.not-found h1,
		    .header-info-group i,
		    body .lms-course-infos i,
		    .action-expand::after,
		    .list-view .post-details .post-excerpt .more-link:hover,
		    .header4 header .right-side-social-actions .social-links a:hover i,
		    #navbar .menu-item.selected > a, #navbar .menu-item:hover > a,
		    .sidebar-content .widget_nav_menu li a:hover,
		    .blog-posts-shortcode-v2 .post-details .post-category {
		        color: '.esc_html($skin_main_bg).';
		    }
		    .woocommerce a.remove {
		    	color: '.esc_html($skin_main_bg).'!important;
		    }


		    /* NAVIGATION */
		    .navstyle-v8.header3 #navbar .menu > .menu-item.current-menu-item > a, 
		    .navstyle-v8.header3 #navbar .menu > .menu-item:hover > a,
		    .navstyle-v1.header3 #navbar .menu > .menu-item:hover > a,
		    .navstyle-v1.header2 #navbar .menu > .menu-item:hover > a,
		    #navbar ul.sub-menu li a:hover,
		    .navstyle-v4 #navbar .menu > .menu-item.current-menu-item > a,
		    .navstyle-v4 #navbar .menu > .menu-item:hover > a,
		    .navstyle-v3 #navbar .menu > .menu-item.current-menu-item > a, 
		    .navstyle-v3 #navbar .menu > .menu-item:hover > a,
		    .navstyle-v3 #navbar .menu > .menu-item > a::before, 
			.navstyle-v3 #navbar .menu > .menu-item > a::after,
			.navstyle-v2 #navbar .menu > .menu-item.current-menu-item > a,
			.navstyle-v2 #navbar .menu > .menu-item:hover > a,
		    #navbar .menu-item.selected > a, #navbar .menu-item:hover > a{
		        color: '.esc_html($skin_main_bg).';
			}
			.navstyle-v2.header3 #navbar .menu > .menu-item > a::before,
			.navstyle-v2.header3 #navbar .menu > .menu-item > a::after,
			.navstyle-v8 #navbar .menu > .menu-item > a::before,
			.navstyle-v7 #navbar .menu > .menu-item .sub-menu > .menu-item > a:hover,
			.navstyle-v7 #navbar .menu > .menu-item.current_page_item > a,
			.navstyle-v7 #navbar .menu > .menu-item.current-menu-item > a,
			.navstyle-v7 #navbar .menu > .menu-item:hover > a,
			.navstyle-v6 #navbar .menu > .menu-item.current_page_item > a,
			.navstyle-v6 #navbar .menu > .menu-item.current-menu-item > a,
			.navstyle-v6 #navbar .menu > .menu-item:hover > a,
			.navstyle-v5 #navbar .menu > .menu-item.current_page_item > a, 
			.navstyle-v5 #navbar .menu > .menu-item.current-menu-item > a,
			.navstyle-v5 #navbar .menu > .menu-item:hover > a,
			.navstyle-v2 #navbar .menu > .menu-item > a::before, 
			.navstyle-v2 #navbar .menu > .menu-item > a::after{
				background: '.esc_html($skin_main_bg).';
			}


			/* Color Dark / Hovers */
			footer .footer-top .menu li.menu-item:hover a,
			.related-posts .post-name:hover a{
				color: '.esc_html($skin_main_bg_hover).' !important;
			}

		    /*------------------------------------------------------------------
		        BACKGROUND + BACKGROUND-COLOR
		    ------------------------------------------------------------------*/
		    .tagcloud > a:hover,
		    .modeltheme-icon-search,
		    .wpb_button::after,
		    .rotate45,
		    .latest-posts .post-date-day,
		    .latest-posts h3, 
		    .latest-tweets h3, 
		    .latest-videos h3,
		    .button.solid-button, 
		    button.vc_btn,
		    .pricing-table.recomended .table-content, 
		    .pricing-table .table-content:hover,
		    .pricing-table.Recommended .table-content, 
		    .pricing-table.recommended .table-content, 
		    .pricing-table.recomended .table-content, 
		    .pricing-table .table-content:hover,
		    .block-triangle,
		    .owl-theme .owl-controls .owl-page span,
		    body .vc_btn.vc_btn-blue, 
		    body a.vc_btn.vc_btn-blue, 
		    body button.vc_btn.vc_btn-blue,
		    .pagination .page-numbers.current,
		    .pagination .page-numbers:hover,
		    #subscribe > button[type=\'submit\'],
		    .social-sharer > li:hover,
		    .prev-next-post a:hover .rotate45,
		    .masonry_banner.default-skin,
		    .form-submit input,
		    .member-header::before, 
		    .member-header::after,
		    .member-footer .social::before, 
		    .member-footer .social::after,
		    .subscribe > button[type=\'submit\'],
		    .no-results input[type=\'submit\'],
		    h3#reply-title::after,
		    .newspaper-info,
		    header.header1 .header-nav-actions .shop_cart,
		    .categories_shortcode .owl-controls .owl-buttons i:hover,
		    .widget-title:after,
		    h2.heading-bottom:after,
		    .single .content-car-heading:after,
		    .wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header.ui-state-active,
		    #primary .main-content ul li:not(.rotate45)::before,
		    .wpcf7-form .wpcf7-submit,
		    ul.ecs-event-list li span,
		    #contact_form2 .solid-button.button,
		    .navbar-default .navbar-toggle .icon-bar,
		    .modeltheme-search .search-submit,
		    .pricing-table.recommended .table-content .title-pricing,
		    .pricing-table .table-content:hover .title-pricing,
		    .pricing-table.recommended .button.solid-button,
		    .blogloop-v5 .absolute-date-badge span,
		    .post-category-date a[rel="tag"],
		    .cryptic_preloader_holder,
		    #navbar .mt-icon-list-item:hover,
		    .mt_car--single-gallery.mt_car--featured-single-gallery:hover,
		    footer .mc4wp-form-fields input[type="submit"],
		    .modeltheme-pagination.pagination .page-numbers.current,
		    .pricing-table .table-content:hover .button.solid-button,
		    footer .footer-top .menu .menu-item a::before,
		    .mt-car-search .submit .form-control,
		    .blogloop-v4.list-view .post-date,
		    header .top-header,
		    .navbar-toggle .icon-bar,
		    .back-to-top,
		     .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            table.compare-list .add-to-cart td a,
            body.woocommerce ul.products li.product .onsale,
            .woocommerce #respond input#submit.alt, 
            .woocommerce a.button.alt, 
            .woocommerce button.button.alt, 
            .woocommerce input.button.alt,
            .woocommerce a.remove:hover,
            .woocommerce .widget_price_filter .ui-slider .ui-slider-range,
            .woocommerce nav.woocommerce-pagination ul li a:focus, 
            .woocommerce nav.woocommerce-pagination ul li a:hover, 
            .woocommerce nav.woocommerce-pagination ul li span.current,
            .woocommerce.single-product .wishlist-container .yith-wcwl-wishlistaddedbrowse,
            .woocommerce #respond input#submit.alt.disabled, 
            .woocommerce #respond input#submit.alt.disabled:hover, 
            .woocommerce #respond input#submit.alt:disabled, 
            .woocommerce #respond input#submit.alt:disabled:hover, 
            .woocommerce #respond input#submit.alt[disabled]:disabled, 
            .woocommerce #respond input#submit.alt[disabled]:disabled:hover, 
            .woocommerce a.button.alt.disabled, 
            .woocommerce a.button.alt.disabled:hover, 
            .woocommerce a.button.alt:disabled, 
            .woocommerce a.button.alt:disabled:hover, 
            .woocommerce a.button.alt[disabled]:disabled, 
            .woocommerce a.button.alt[disabled]:disabled:hover, 
            .woocommerce button.button.alt.disabled, 
            .woocommerce button.button.alt.disabled:hover, 
            .woocommerce button.button.alt:disabled, 
            .woocommerce button.button.alt:disabled:hover, 
            .woocommerce button.button.alt[disabled]:disabled, 
            .woocommerce button.button.alt[disabled]:disabled:hover, 
            .woocommerce input.button.alt.disabled, 
            .woocommerce input.button.alt.disabled:hover, 
            .woocommerce input.button.alt:disabled, 
            .woocommerce input.button.alt:disabled:hover, 
            .woocommerce input.button.alt[disabled]:disabled, 
            .woocommerce input.button.alt[disabled]:disabled:hover,
            .hover-components .component a:hover,
            .related.products span.onsale,
            table.compare-list .add-to-cart td a,
            .shop_cart,
		    .back-to-top,
		    #listings_metaboxs input[type="submit"],
            .mt_listing--single-price-inner,
            input.wpcf7-form-control.wpcf7-submit,
		    .post-password-form input[type="submit"],
		    .widget.widget_product_search button,
		    .search-form input[type="submit"],
		    .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a,
		    .post-password-form input[type=\'submit\'] {
		        background: '.esc_html($skin_main_bg).';
		    }
		    body .courses-list .featured_image_courses .course_badge i,
		    body .courses-list .shortcode_course_content,
		    .single-product.woocommerce span.onsale,
            .header_mini_cart .button.wc-forward,
            .header_mini_cart .button.checkout,
            .woocommerce ul.products li.product .onsale, 
            body .woocommerce ul.products li.product .onsale, 
            body .woocommerce ul.products li.product .onsale,
            .blog-posts-shortcode .time-n-date {
                    background-color: '.esc_attr($skin_main_bg).' !important;
            }
		    .modeltheme-search.modeltheme-search-open .modeltheme-icon-search, 
		    .no-js .modeltheme-search .modeltheme-icon-search,
		    .modeltheme-icon-search:hover,
		    .latest-posts .post-date-month,
		    .button.solid-button:hover,
		    body .vc_btn.vc_btn-blue:hover, 
		    body a.vc_btn.vc_btn-blue:hover, 
		    .post-category-date a[rel="tag"]:hover,
		    .single-post-tags > a:hover,
		    body button.vc_btn.vc_btn-blue:hover,
		    .blogloop-v5 .absolute-date-badge span:hover,
		    .mt-car-search .submit .form-control:hover,
		    #contact_form2 .solid-button.button:hover,
		    .subscribe > button[type=\'submit\']:hover,
		    footer .mc4wp-form-fields input[type="submit"]:hover,
		    .no-results.not-found .search-submit:hover,
		    #listings_metaboxs input[type="submit"]:hover,
		    .no-results input[type=\'submit\']:hover,
		    ul.ecs-event-list li span:hover,
		    .pricing-table.recommended .table-content .price_circle,
		    .pricing-table .table-content:hover .price_circle,
		    #modal-search-form .modal-content input.search-input,
		    .wpcf7-form .wpcf7-submit:hover,
		    .form-submit input:hover,
		    .blogloop-v4.list-view .post-date a:hover,
		    .pricing-table.recommended .button.solid-button:hover,
		    .search-form input[type="submit"]:hover,
		    .modeltheme-pagination.pagination .page-numbers.current:hover,
		    .error-return-home.text-center > a:hover,
		    .pricing-table .table-content:hover .button.solid-button:hover,
		    .post-password-form input[type="submit"]:hover,
		    .navbar-toggle .navbar-toggle:hover .icon-bar,
		    .back-to-top:hover,
            .woocommerce #respond input#submit:hover, 
            .woocommerce a.button:hover, 
		    .widget.widget_product_search button:hover,
            .woocommerce button.button:hover, 
            .woocommerce input.button:hover,
            table.compare-list .add-to-cart td a:hover,
            .woocommerce #respond input#submit.alt:hover, 
            .woocommerce a.button.alt:hover, 
            .woocommerce button.button.alt:hover, 
            .woocommerce input.button.alt:hover,
		    .post-password-form input[type=\'submit\']:hover {
		        background: '.esc_html($skin_main_bg_hover).';
		    }
		    .tagcloud > a:hover{
		        background: '.esc_html($skin_main_bg_hover).' !important;
		    }

            .hover-components .component a,
            .woocommerce ul.cart_list li a::before, 
            .woocommerce ul.product_list_widget li a::before,
		    .flickr_badge_image a::after,
		    .thumbnail-overlay,
		    .portfolio-hover,
		    .pastor-image-content .details-holder,
		    .item-description .holder-top,
		    blockquote::before {
		        background: '.esc_html($skin_semitransparent_blocks).';
		    }

		    /*------------------------------------------------------------------
		        BORDER-COLOR
		    ------------------------------------------------------------------*/
		    .comment-form input, 
		    .comment-form textarea,
		    .author-bio,
		    blockquote,
		    .widget_popular_recent_tabs .nav-tabs > li.active,
		    body .left-border, 
		    body .right-border,
		    body .member-header,
		    body .member-footer .social,
		    body .button[type=\'submit\'],
		    .navbar ul li ul.sub-menu,
		    .wpb_content_element .wpb_tabs_nav li.ui-tabs-active,
		    #contact-us .form-control:focus,
		    .sale_banner_holder:hover,
		    .testimonial-img,
		    .wpcf7-form input:focus, 
            .woocommerce div.product .woocommerce-tabs ul.tabs li.active,
            .woocommerce .woocommerce-info, 
            .woocommerce .woocommerce-message,
            .header_mini_cart .woocommerce .widget_shopping_cart .total, 
            .header_mini_cart .woocommerce.widget_shopping_cart .total,
            .header_mini_cart,
            .header_mini_cart.visible_cart,
		    .wpcf7-form textarea:focus,
		    .navbar-default .navbar-toggle:hover, 
		    .header_search_form,
		    body .course-review-head, body .course-content > h3:first-child, body .course-curriculum-title,
		    .list-view .post-details .post-excerpt .more-link:hover{
		        border-color: '.esc_html($skin_main_bg).';
		    }
		    header .navbar-toggle,
		    .navbar-default .navbar-toggle{
		        border: 3px solid '.esc_html($skin_main_bg).';
		    }
		    body.is_header_semitransparent #navbar .menu > .menu-item > a {
		    	color: '.esc_html($mt_main_menu_custom_color).' !important;
		    }
		    .to_whitepaper2 a {
		    	border-color: '.esc_html($mt_custom_main_color).' !important;
		    }
		    .to_whitepaper2 a:hover {
		    	border-color: '.esc_html($mt_custom_main_hover_color).' !important;
		    }';

    wp_add_inline_style( 'cryptic-mt-style', $html );
}
?>