<?php
/**
 * Plugin Name: Toolkit for WPBakery
 * Plugin URI: https://legendarylion.com
 * Description: Modifies the options within WPBakery
 * Version: 1.0
 * Author: Legendary Lion
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

    // INCLUDE OPTION
    // include('options.php');

    // DISABLE FRONT END EDITOR
    vc_disable_frontend();




// [button foo="foo-value"]
add_shortcode( 'button', 'button_func' );
function button_func( $atts ) {
extract( shortcode_atts( array(
'href' => '',
'link_text' => '',
'position' => '',
'class' => 'btn-primary',
), $atts ) );

// return "foo = {$foo}";
$href = vc_build_link( $href );
// Array ( [url] => http://local.wordpress-toolkit.test/green-red-blue/ [title] => Green Red Blue [target] => [rel] => )



return "
<div class='ll-vc-btn ll-vc-btn-{$position}'>
    <a target='{$href['target']}' href='{$href['url']}' class='btn {$class} ' title='{$href['title']}'>{$link_text}</a>
</div>
";
}

add_action( 'vc_before_init', 'legendary_button_integrate_VC' );
function legendary_button_integrate_VC() {
 vc_map(
    array(
  "name" => __( "Button", "legendary-visual-composer" ),
  "base" => "ll_vc_button",
  "class" => "",
  "icon" => "",
  "show_settings_on_create" => true,
  "category" => __( "Content", "legendary-visual-composer"),
//   'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
//   'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
  "params" => 
        array(
            array(
                "type" => "vc_link",
                //   "holder" => "div",
                "class" => "",
                "heading" => __( "Link", "legendary-visual-composer" ),
                "param_name" => "href",
                "value" => __( "", "legendary-visual-composer" ),
                // "description" => __( "Description for foo param.", "legendary-visual-composer" )
            ),
            array(
                "type" => "textfield",
                "holder" => "div",
                "class" => "",
                "heading" => __( "Link Text", "legendary-visual-composer" ),
                "param_name" => "link_text",
                "value" => __( "", "legendary-visual-composer" ),
                // "description" => __( "Description for foo param.", "legendary-visual-composer" )
            ),
            array(
                'type' => 'dropdown',
                'heading' => __( 'Position', 'js_composer' ),
                'param_name' => 'position',
                'value' => array(
                    'Inline' => 'none',
                    'Left' => 'left',
                    'Center' => 'center',
                    'Right' => 'right',
                    )
            ),
            array(
                "type" => "textfield",
                    // "holder" => "div",
                "class" => "",
                "heading" => __( "CSS Class", "legendary-visual-composer" ),
                "param_name" => "class",
                "value" => __( "", "legendary-visual-composer" ),
                // "description" => __( "Description for foo param.", "legendary-visual-composer" )
            ),
            )
        ) // END: BUTTON
    ); // END: VC CUSTOM MAP
}




// Update order of items
$settings = array (
//   'weight' => __( 'new name', 'legendary-visual-composer' ),
//   'category' => __( 'New category name', 'legendary-visual-composer' )
);

$weight = 0;

// order the widgets here
$vc_widgets_to_update = array(
    'vc_row',
    'vc_column_text',
    'vc_single_image',
    'll_vc_button',
    'vc_separator',
    'vc_tta_tabs',
    'vc_tta_tour',
    'vc_tta_accordion',
    'vc_tta_pageable',
    'vc_raw_html',
    'vc_raw_js',
    'vc_empty_space',


);

$vc_widgets_ordering = array_reverse($vc_widgets_to_update);
foreach($vc_widgets_ordering as $widget){
    vc_map_update( $widget, 
    array(
        'weight' => $weight
        ) 
    );
    $weight++;
}