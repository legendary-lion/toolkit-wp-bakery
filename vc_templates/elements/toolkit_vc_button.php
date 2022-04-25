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
                vc_map_add_css_animation(),
                array(
                    "type" => "textfield",
                    "class" => "",
                    "heading" => __( "CSS Class", "toolkit-vc" ),
                    "param_name" => "class",
                    "value" => __( "", "toolkit-vc" ),
                ),
            )
        ));
    }

    public function render_shortcode( $atts, $content, $tag ) {

        $params = shortcode_atts( array(
            'href' => '',
            'link_text' => '',
            'position' => '',
            'class' => 'btn-primary',
            'css_animation' => '',
        ), $atts );

        $href = vc_build_link( $params['href'] );

        $css_animation_classes = '';
    
        if ($params['css_animation'] != ''){
            $css_animation_classes = "wpb_animate_when_almost_visible wpb_". $params['css_animation'] ." ". $params['css_animation'] ." animated";
        }

        $target = $href['target'];
        $url = $href['url'];
        $title = $href['title'];
        $position = $params['position'];
        $class = $params['class'];
        $link_text = $params['link_text'];

        $output = '';

        $output .= "<div class='toolkit-vc-btn toolkit-vc-btn-$position $css_animation_classes' style='text-align:$position'>
            <a target='$target' href='$url' class='btn $class' title='$title'>$link_text</a>
        </div>";

        return $output;
    }
}

new toolkit_vc_button();