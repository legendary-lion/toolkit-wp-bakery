<?php
class toolkit_vc_button extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, 'create_shortcode' ), 999 );            
        add_shortcode( 'toolkit_vc_button', array( $this, 'render_shortcode' ) );
    }        

    public function create_shortcode() {

        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        vc_map( array(
            "name" => __( "Button", "toolkit-vc" ),
            "base" => "toolkit_vc_button",
            "class" => "",
            "icon" => plugin_dir_url( __FILE__ ) . "../../assets/img/toolkit_vc_button.svg",
            "show_settings_on_create" => true,
            "description" => __( "Add a call to action button", "toolkit-vc" ),
            "params" => array(
                array(
                    "type" => "vc_link",
                    "class" => "",
                    "heading" => __( "Link", "toolkit-vc" ),
                    "param_name" => "href",
                    "value" => __( "", "toolkit-vc" ),
                ),
                array(
                    "type" => "textfield",
                    "admin_label" => true,
                    "class" => "",
                    "heading" => __( "Link Text", "toolkit-vc" ),
                    "param_name" => "link_text",
                    "value" => __( "", "toolkit-vc" ),
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
                    'type' => 'dropdown',
                    'heading' => __( 'Button Type', 'js_composer' ),
                    'param_name' => 'button_type',
                    'value' => array(
                        'Primary' => 'primary',
                        'Secondary' => 'secondary',
                        'Outline Light' => 'outline-light',
                        'Outline Dark' => 'outline-dark',
                        'Outline Primary' => 'outline-primary',
                        'Outline Secondary' => 'outline-secondary',
                    )
                ),
                vc_map_add_css_animation(),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "CSS Class", "toolkit-vc" ),
                    "param_name" => "class",
                    "value" => __( "", "toolkit-vc" ),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS', 'toolkit-vc' ),
                    'param_name' => 'css',
                    'group' => __( 'Design Options', 'toolkit-vc' ),
                ),
            )
        ));
    }

    public function render_shortcode( $atts, $content, $tag ) {

        $params = shortcode_atts( array(
            'href' => '',
            'link_text' => '',
            'position' => '',
            'button_type' => '',
            'class' => '',
            'css_animation' => '',
            'css' => '',
        ), $atts );

        $href = vc_build_link( $params['href'] );

        $target = $href['target'];
        $url = $href['url'];
        $title = $href['title'];
        $position = $params['position'];
        $button_type = $params['button_type'];
        $class = $params['class'];
        $link_text = $params['link_text'];
        $css_animation = $params['css_animation'];
        $css = $params['css'];

        switch ($button_type) {
            case 'primary':
                $class .= ' btn-primary';
                break;
            case 'secondary':
                $class .= ' btn-secondary';
                break;
            case 'outline-light':
                $class .= ' btn-outline-light';
                break;
            case 'outline-dark':
                $class .= ' btn-outline-dark';
                break;
            case 'outline-primary':
                $class .= ' btn-outline-primary';
                break;
            case 'outline-secondary':
                $class .= ' btn-outline-secondary';
                break;
            default:
                $class .= ' btn-primary';
                break;
        }

        $position_class = '';

        switch ($position) {
            case '':
                $position_class = ' d-inline-block';
                break;
            case 'left':
                $position_class = ' d-block text-left';
                break;
            case 'center':
                $position_class = ' d-block text-center';
                break;
            case 'right':
                $position_class = 'd-block text-right';
                break;
        }

        $css_animation_classes = '';
    
        if ($css_animation != ''){
            $css_animation_classes = "wpb_animate_when_almost_visible wpb_". $css_animation ." ". $css_animation ." animated";
        }

        // $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        $output = '';

        // $output .= "<div class='toolkit-vc-btn toolkit-vc-btn-$position $css_animation_classes $css_class' style='text-align:$position'>
        $output .= "<div class='toolkit-vc-btn toolkit-vc-btn-$position $css_animation_classes $css $position_class'>
            <a target='$target' href='$url' class='btn $class' title='$title'>$link_text</a>
        </div>";

        return $output;
    }
}

new toolkit_vc_button();