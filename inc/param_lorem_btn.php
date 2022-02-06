<?php

$script = plugin_dir_url( __FILE__ ) . "../js/flip.js";

vc_add_shortcode_param( 'll_add_placeholder_text', 'll_add_placeholder_text_settings_field', $script);
function ll_add_placeholder_text_settings_field( $settings, $value ) {
    $script = plugin_dir_url( __FILE__ ) . "../js/flip.js";
 return '<div class="ll_add_placeholder_text_block">'
 .'<input name="' . esc_attr( $settings['param_name'] ) . '" class="wpb_vc_param_value wpb-textinput ' .
 esc_attr( $settings['param_name'] ) . ' ' .
 esc_attr( $settings['type'] ) . '_field" type="hidden" value="' . esc_attr( $value ) . '" />'
 .'</div>'
 .'<button class="add-placeholder-text">Add Placeholder Text</button>'; // New button element
}