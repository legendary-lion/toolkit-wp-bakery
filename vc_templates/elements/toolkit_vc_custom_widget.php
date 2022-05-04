<?php
class toolkit_vc_custom_widget extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, 'create_shortcode' ), 999 );
        add_shortcode( 'toolkit_vc_custom_widget', array( $this, 'render_shortcode' ) );
    }

    public function create_shortcode() {

        if ( !defined( 'WPB_VC_VERSION' ) || !post_type_exists( 'll_widgets' ) ) {
            return;
        }

        function vc_get_widgets() {
            $widgets = [];
            $args = array(
                'post_type' => 'll_widgets',
            );

            $q_sidebars = new wp_query($args);

            if (!$q_sidebars->have_posts()) {
                return false;
            }

            while ($q_sidebars->have_posts()) {
                $q_sidebars->the_post();
                $id = get_the_id();
                $widget_name = get_the_title();
                $widgets[__( $widget_name,  "toolkit-vc"  )] = $id;
            }
            
            wp_reset_postdata();
            return $widgets;
        }        

        $message = '';
        $widget_field = array(
            'type'          => 'dropdown',
            'heading'       => __( 'Widget', 'toolkit-vc' ),
            'param_name'    => 'id',
            'admin_label'   => true,
            'value'         => vc_get_widgets(),
            'description'   => __( '', 'toolkit-vc' ),
        );

        if (!vc_get_widgets()) {
            $message = '<strong>No Sidebars Found</strong><br><a href="/wp-admin/post-new.php?post_type=ll_widgets">Create your first sidebar</a>';
            $widget_field = [];
        }

        vc_map( array(
            'name'          => __('Custom Widget', 'toolkit-vc'),
            'base'          => 'toolkit_vc_custom_widget',
            'description'  	=> __( '', 'toolkit-vc' ),
            'category'      => __( 'Toolkit Modules', 'toolkit-vc'),
            'icon'          => plugin_dir_url( __FILE__ ) . '../../assets/img/toolkit_vc_custom_widget.svg',
            'params' => array(
                $widget_field,
                array(
                    'param_name' => 'toolkit_vc_element_settings_html',
                    'type' => 'toolkit_vc_element_settings_html',
                    'content' => __($message, 'toolkit-vc'),
                ),
                array(
                    'type' => 'css_editor',
                    'heading' => __( 'CSS', 'toolkit-vc' ),
                    'param_name' => 'css',
                    'group' => __( 'Design Options', 'toolkit-vc' ),
                ),
            ),
        ));

    }
    public function render_shortcode( $atts, $content, $tag ) {
        
        $params = shortcode_atts( array(
            'id' => '',
            'css' => '',
        ), $atts );

        $id = $params['id'];
        $css = $params['css'];

        if (!$id) {
            return;
        }

        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        $widget_post = get_post($id);

        if (!$widget_post) {
            return;
        }

        $output = '';

        $output .= "<div class='toolkit-vc-custom-widget $css_class'>";
        $output .= str_replace(']]>', ']]&gt;', apply_filters('the_content', $widget_post->post_content));
        $output .= "</div>";
        return $output;
    }
}

new toolkit_vc_custom_widget();