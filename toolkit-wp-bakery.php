<?php
/**
 * Plugin Name: WPBakery Toolkit
 * Plugin URI: https://legendarylion.com
 * Description: Modifies the options within WPBakery
 * Version: 1.0.10
 * Author: Legendary Lion
 * Author URI: https://legendarylion.com
 */

// Docs for editing: https://kb.wpbakery.com/docs/inner-api/vc_map/
// params for each widget can be found in the original plugin at config/content
// templates for each widget can be found in the original plugin at include/templates/shortcodes
    require 'plugin-update-checker/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/legendary-lion/toolkit-wp-bakery',
        __FILE__,
        'toolkit-wp-bakery'
    );

    // Set the branch that contains the stable release
    $myUpdateChecker->setBranch('master');

    $dir = __DIR__ . '/vc_templates/shortcode_templates';
    
    // check to see if visual composer is present and enabled
if(function_exists('vc_set_shortcodes_templates_dir')){
        vc_set_shortcodes_templates_dir( $dir );


    function toolkit_vc_admin_styles() {
        wp_enqueue_style( 'toolkit_vc_admin_styles',  plugin_dir_url( __FILE__ ) . "/inc/css/admin-style.css");
    }
    add_action( 'admin_print_styles', 'toolkit_vc_admin_styles' );
    
    function toolkit_vc_styles() {
        wp_enqueue_style( 'toolkit_vc_styles',  plugin_dir_url( __FILE__ ) . "/inc/css/style.css");
    }
    add_action( 'wp_head', 'toolkit_vc_styles' );
    

    // REMOVE UNWANTED FUNCTIONS FROM WPBAKERY LIST
    function toolkit_vc_remove_vc_elements() {

        vc_remove_element( 'vc_icon' );
        vc_remove_element( 'vc_zigzag' );
        vc_remove_element( 'vc_section' );
        vc_remove_element( 'vc_gallery' );
        vc_remove_element( 'vc_text_separator' );
        vc_remove_element( 'vc_message' );
        vc_remove_element( 'vc_tta_pageable' );
        vc_remove_element( 'vc_posts_slider' );
        vc_remove_element( 'vc_hoverbox' );
        vc_remove_element( 'vc_facebook' );
        vc_remove_element( 'vc_tweetmeme' );
        vc_remove_element( 'vc_pinterest' );
        vc_remove_element( 'vc_toggle' );
        vc_remove_element( 'vc_images_carousel' );
        vc_remove_element( 'vc_custom_heading' );
        vc_remove_element( 'vc_btn' );
        vc_remove_element( 'vc_cta' );
        vc_remove_element( 'vc_widget_sidebar' );
        vc_remove_element( 'vc_video' );
        vc_remove_element( 'vc_gmaps' );
        vc_remove_element( 'vc_flickr' );
        vc_remove_element( 'vc_progress_bar' );
        vc_remove_element( 'vc_pie' );
        vc_remove_element( 'vc_round_chart' );
        vc_remove_element( 'vc_line_chart' );
        vc_remove_element( 'vc_media_grid' );
        vc_remove_element( 'vc_masonry_media_grid' );
        vc_remove_element( 'vc_wp_search' );
        vc_remove_element( 'vc_basic_grid' );
        vc_remove_element( 'vc_masonry_grid' );
        vc_remove_element( 'vc_gutenberg' );
        vc_remove_element( 'vc_wp_meta' );
        vc_remove_element( 'vc_wp_recentcomments' );
        vc_remove_element( 'vc_wp_calendar' );
        vc_remove_element( 'vc_wp_pages' );
        vc_remove_element( 'vc_wp_tagcloud' );
        vc_remove_element( 'vc_wp_text' );
        vc_remove_element( 'vc_wp_posts' );
        vc_remove_element( 'vc_wp_categories' );
        vc_remove_element( 'vc_wp_archives' );
        vc_remove_element( 'vc_wp_rss' );
        vc_remove_element( 'vc_wp_custommenu' );

        // deprecated tab elements
        vc_remove_element( 'vc_accordion' );
        vc_remove_element( 'vc_tour' );
        vc_remove_element( 'vc_tabs' );
        vc_remove_element( 'vc_googleplus' );

        // REMOVE PLUGIN SPECIFIC ELEMENTS
        if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            vc_remove_element( 'woocommerce_cart' );
            vc_remove_element( 'woocommerce_checkout' );
            vc_remove_element( 'woocommerce_order_tracking' );

            // ADD OTHER ELEMENTS THAT SHOULD BE REMOVED HERE
        }
        if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
            vc_remove_element( 'vc_acf' );
        }
        
    }

    // HOOK FOR ADMIN EDITOR
    add_action( 'vc_build_admin_page', 'toolkit_vc_remove_vc_elements', 11 );

    // HOOK FOR FRONTEND EDITOR
    add_action( 'vc_load_shortcode', 'toolkit_vc_remove_vc_elements', 11 );

    // DISABLE FRONT END EDITOR
    vc_disable_frontend();

    // ADD PARAMS
    include_once("vc_templates/params/param_lorem_btn.php");
    include_once("vc_templates/params/param_element_settings_html.php");
    

    // ADD ELEMENTS
    include_once("vc_templates/elements/toolkit_vc_button.php");
    include_once("vc_templates/elements/toolkit_vc_custom_widget.php");
    include_once("vc_templates/elements/toolkit_vc_fancybox_media.php");

    // ADD MAP UPDATES
    include_once("vc_templates/map_updates/vc_column_text.php");
    include_once("vc_templates/map_updates/vc_row.php");
    include_once("vc_templates/map_updates/vc_single_image.php");
    include_once("vc_templates/map_updates/vc_empty_space.php");
    include_once("vc_templates/map_updates/vc_separator.php");
    include_once("vc_templates/map_updates/vc_tta_tabs.php");
    include_once("vc_templates/map_updates/vc_tta_tour.php");
    include_once("vc_templates/map_updates/vc_tta_accordion.php");
    include_once("vc_templates/map_updates/vc_raw_html.php");
    include_once("vc_templates/map_updates/vc_raw_js.php");


    // order the elements here, top elements listed first
    $vc_elements_to_update = array(
        'vc_row',
        'vc_column_text',
        'vc_single_image',
        'vc_empty_space',
        'vc_separator',
        'vc_tta_tabs',
        'vc_tta_tour',
        'vc_tta_accordion',
        'vc_tta_pageable',
        'vc_raw_html',
        'vc_raw_js',
        'vc_acf',
        'toolkit_vc_button',
        'toolkit_vc_custom_widget',
        'toolkit_vc_fancybox_media'
    );

    $weight = 0;
    $vc_elements_ordering = array_reverse($vc_elements_to_update);
    foreach($vc_elements_ordering as $element){
        vc_map_update( $element, array(
            'weight' => $weight,
        ));
        $weight++;
    }

}