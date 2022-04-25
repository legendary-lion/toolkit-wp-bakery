<?php

$script = plugin_dir_url( __FILE__ ) . "../../inc/js/lorem.js";
vc_add_shortcode_param( 'toolkit_vc_add_placeholder_text', 'toolkit_vc_add_placeholder_text_settings_field', $script);

function toolkit_vc_add_placeholder_text_settings_field( $settings, $value ) {
    $param_name = esc_attr($settings['param_name']);
    $type = esc_attr($settings['type']) . "_field";

    $markup = "";
    $markup .= "<div class='toolkit_vc_add_placeholder_text_block'>
        <input name='$param_name' class='wpb_vc_param_value wpb-textinput $param_name $type' type='hidden' value='$value' />
    </div>
    <button class='add-placeholder-text'>Add Placeholder Text</button>";
    
    return $markup;
}