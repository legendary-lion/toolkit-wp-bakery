<?php

vc_add_shortcode_param( 'toolkit_vc_element_settings_html', 'toolkit_vc_element_settings_html');

function toolkit_vc_element_settings_html( $settings, $value ) {

    $content = __($settings['content'], 'toolkit-vc');

    if (!$content) {
        $content = '';
    }

    $markup = "";
    $markup .= "<div class='toolkit_vc_element_settings_html'>
        $content
    </div>";
    
    return $markup;
}