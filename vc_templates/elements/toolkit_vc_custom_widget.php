<?php
class toolkit_vc_custom_widget extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, 'create_shortcode' ), 999 );
        add_shortcode( 'custom_widget', array( $this, 'render_shortcode' ) );
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
                $no_widgets['No Widget Available'] = 0;
                return $no_widgets;
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

        vc_map( array(
            'name'          => __('Custom Widget', 'toolkit-vc'),
            'base'          => 'custom_widget',
            'description'  	=> __( '', 'toolkit-vc' ),
            'category'      => __( 'Toolkit Modules', 'toolkit-vc'),
            'icon'          => plugin_dir_url( __FILE__ ) . '../../assets/img/toolkit_vc_custom_widget.svg',
            'params' => array(
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Widget', 'toolkit-vc' ),
                    'param_name'    => 'id',
                    'admin_label'   => true,
                    'value'         => vc_get_widgets(),
                    'description'   => __( '', 'toolkit-vc' ),
                ),               
            ),
        ));

    }
    public function render_shortcode( $atts, $content, $tag ) {
        
        $params = shortcode_atts( array(
            'id' => '',
        ), $atts );

        if (!$params['id']) {
            return;
        }

        $widget_post = get_post($params['id']);
        if (!$widget_post) {
            return;
        }

        $content = $widget_post->post_content;
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        return $content;
    }
}

new toolkit_vc_custom_widget();