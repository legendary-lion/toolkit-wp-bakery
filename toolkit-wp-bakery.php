<?php
/**
 * Plugin Name: Toolkit for WPBakery
 * Plugin URI: https://legendarylion.com
 * Description: Modifies the options within WPBakery
 * Version: 1.0
 * Author: Josh Watson
 * Author URI: https://legendarylion.com
 */

    require 'plugin-update-checker/plugin-update-checker.php';
    $myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
        'https://github.com/legendary-lion/toolkit-wp-bakery',
        __FILE__,
        'toolkit-wp-bakery'
    );

    //Set the branch that contains the stable release
    $myUpdateChecker->setBranch('main');

    // REMOVE UNWANTED FUNCTIONS FROM WPBAKERY LIST

    function ll_toolkit_remove_vc_elements() {

        // REMOVE DEFAULT ELEMENTS
        vc_remove_element( 'vc_posts_slider' );
        vc_remove_element( 'vc_icon' );
        vc_remove_element( 'vc_zigzag' );
        vc_remove_element( 'vc_text_separator' );
        vc_remove_element( 'vc_message' );
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
    add_action( 'vc_build_admin_page', 'll_toolkit_remove_vc_elements', 11 );

    // HOOK FOR FRONTEND EDITOR
    add_action( 'vc_load_shortcode', 'll_toolkit_remove_vc_elements', 11 );

    // INCLUDE OPTIONS
    // include('options.php');