<?php

add_action( 'vc_before_init', 'legendary_button_integrate_VC' );
function legendary_button_integrate_VC() {
 vc_map(
    array(
  "name" => __( "Button", "legendary-visual-composer" ),
  "base" => "ll_vc_button",
  "class" => "",
  "icon" => plugin_dir_url( __FILE__ ) . "../img/ll_vc_button.svg",
  "show_settings_on_create" => true,
//   "category" => __( "Content", "legendary-visual-composer"),
    // 'admin_enqueue_js' => array(get_template_directory_uri().'/vc_extend/bartag.js'),
    // 'admin_enqueue_css' => array(get_template_directory_uri().'/vc_extend/bartag.css'),
    "description" => __( "Add a call to action button", "legendary-visual-composer" ),
    
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
            vc_map_add_css_animation(),
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



// ADD BUTTON 
// [ll_vc_button foo="foo-value"]

add_shortcode( 'll_vc_button', 'button_func' );
function button_func( $atts ) {
extract( shortcode_atts( array(
'href' => '',
'link_text' => '',
'position' => '',
'class' => 'btn-primary',
'css_animation' => '',
), $atts ) );

// return "foo = {$foo}";
$href = vc_build_link( $href );
// Array ( [url] => http://local.wordpress-toolkit.test/green-red-blue/ [title] => Green Red Blue [target] => [rel] => )

$css_animation_classes = '';
if($css_animation != ''){
    $css_animation_classes = "wpb_animate_when_almost_visible wpb_{$css_animation} {$css_animation} animated";
}

$html_markup = "<div class='ll-vc-btn ll-vc-btn-{$position} {$css_animation_classes}' style='text-align:{$position}'>
            <a target='{$href['target']}' href='{$href['url']}' class='btn {$class} ' title='{$href['title']}'>{$link_text}</a>
        </div>";

return $html_markup;
}