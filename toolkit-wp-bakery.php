<?php
/**
 * Plugin Name: Toolkit for WPBakery
 * Plugin URI: https://legendarylion.com
 * Description: Modifies the options within WPBakery
 * Version: 1.0.4
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
    $myUpdateChecker->setBranch('main');


    $dir = __DIR__ . '/vc_templates';
    vc_set_shortcodes_templates_dir( $dir );

    function ll_vc_toolkit_styles() {
        wp_enqueue_style( 'style',  plugin_dir_url( __FILE__ ) . "/css/style.css");
    }

    add_action( 'admin_print_styles', 'll_vc_toolkit_styles' );

    // REMOVE UNWANTED FUNCTIONS FROM WPBAKERY LIST
    function ll_toolkit_remove_vc_elements() {

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

        // deprecated tab widgets
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
    // INCLUDE OPTION
    // include('options.php');

    // HOOK FOR ADMIN EDITOR
    add_action( 'vc_build_admin_page', 'll_toolkit_remove_vc_elements', 11 );

    // HOOK FOR FRONTEND EDITOR
    add_action( 'vc_load_shortcode', 'll_toolkit_remove_vc_elements', 11 );

    // DISABLE FRONT END EDITOR
    vc_disable_frontend();

    // ADD WIDGETS
    // include new widgets and remapped widgets
    include_once("inc/ll_vc_button.php");
    include_once("inc/vc_column_text.php");
    include_once("inc/vc_row.php");
    include_once("inc/param_lorem_btn.php");
    include_once("inc/vc_single_image.php");


    // order the widgets here, top widgets listed first
    $vc_widgets_to_update = array(
        'vc_row',
        'vc_column_text',
        'vc_single_image',
        'll_vc_button',
        'vc_empty_space',
        'vc_separator',
        'vc_tta_tabs',
        'vc_tta_tour',
        'vc_tta_accordion',
        'vc_tta_pageable',
        'vc_raw_html',
        'vc_raw_js',
        'vc_acf',
    );

    $weight = 0;
    $vc_widgets_ordering = array_reverse($vc_widgets_to_update);
    foreach($vc_widgets_ordering as $widget){
        vc_map_update( $widget, 
        array(
            'weight' => $weight,
            // 'category' => '',
            ) 
        );
        $weight++;
    }


// add_action( 'init', 'test_admin_init');

// function test_admin_init() {
//     echo "<div style='padding:200px;'>";
// $dir = __DIR__ . '/vc_templates';
// vc_set_shortcodes_templates_dir( $dir );
// var_dump( vc_shortcodes_theme_templates_dir( 'vc_row.php' ) );
//     echo "<pre>";
//     var_dump( vc_shortcodes_theme_templates_dir( 'vc_row.php' ) ); // Outputs full directory path for vc_message.php template
//     echo "</pre>";
//     echo "</div>";
// }