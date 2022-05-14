<?php
class toolkit_vc_fancybox_media extends WPBakeryShortCode {

    function __construct() {
        add_action( 'init', array( $this, 'create_shortcode' ), 999 );            
        add_shortcode( 'toolkit_vc_fancybox_media', array( $this, 'render_shortcode' ) );

        // wrapping into a function to streamline the loading to prevent php notices
        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_script('fancybox_js', plugin_dir_url( __FILE__ ) . "../../lib/fancybox/fancybox.umd.js", array('jquery'));

            wp_enqueue_style('fancybox_css', plugin_dir_url( __FILE__ ) . "../../lib/fancybox/fancybox.css");        
            wp_enqueue_style('toolkit_vc_fancybox_media_css', plugin_dir_url( __FILE__ ) . "../../inc/css/toolkit-vc-fancybox-media.css");
        });
    }        

    public function create_shortcode() {

        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
        }

        vc_map( array(
            'name'          => __('Fancybox Media', 'toolkit-vc'),
            'base'          => 'toolkit_vc_fancybox_media',
            'description'  	=> __( '', 'toolkit-vc' ),
            'category'      => __( 'Toolkit Modules', 'toolkit-vc'),
            'icon'          => plugin_dir_url( __FILE__ ) . '../../assets/img/toolkit_vc_fancybox_media.svg',
            'params' => array(
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Type of Media', 'toolkit-vc' ),
                    'param_name'    => 'type',
                    'admin_label'   => true,
                    'value'         => array(
                        __( 'Select Media Type', 'toolkit-vc' ) => '',
                        __( 'Image', 'toolkit-vc' ) => 'image',
                        __( 'Gallery', 'toolkit-vc' ) => 'gallery',
                        __( 'Video', 'toolkit-vc' ) => 'video',
                        __( 'Raw HTML', 'toolkit-vc' ) => 'html',
                    ),
                    'description'   => __( '', 'toolkit-vc' ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__('Image', 'toolkit-vc'),
                    'param_name'    => 'image_id',
                    'description'   => esc_html__('', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'image'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Image Size', 'toolkit-vc'),
                    'param_name'    => 'image_size',
                    'value'         => 'large',
                    'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme).', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'image'
                    ),
                ),
                array(
                    'type'          => 'attach_images',
                    'heading'       => esc_html__('Gallery Images', 'toolkit-vc'),
                    'param_name'    => 'gallery_images',
                    'description'   => esc_html__('', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'gallery'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Grid Items Per Row', 'toolkit-vc'),
                    'param_name'    => 'gallery_items_per_row',
                    'value'         => '4',
                    'description'   => esc_html__('', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'gallery'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Gap Size', 'toolkit-vc'),
                    'param_name'    => 'gallery_gap_size',
                    'value'         => '2px',
                    'description'   => __('All CSS Units Allowed. Example: <code>2px</code>', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'gallery'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Gallery ID', 'toolkit-vc'),
                    'param_name'    => 'gallery_id',
                    'description'   => esc_html__('Required If Using Multiple Galleries Per Page', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'gallery'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Video Link', 'toolkit-vc'),
                    'param_name'    => 'video_link',
                    'description'   => esc_html__('Accepts YouTube and Vimeo Links', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'video'
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'Video Link Type', 'toolkit-vc' ),
                    'param_name'    => 'video_link_type',
                    'value'         => array(
                        __( 'Select Link Type', 'toolkit-vc' ) => '',
                        __( 'Image', 'toolkit-vc' ) => 'image',
                        __( 'Link', 'toolkit-vc' ) => 'link',
                    ),
                    'description'   => __( '', 'toolkit-vc' ),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'video'
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__('Video Link Image', 'toolkit-vc'),
                    'param_name'    => 'video_link_image',
                    'description'   => esc_html__('', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'video_link_type',
                        'value'     => 'image'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Video Link Image Size', 'toolkit-vc'),
                    'param_name'    => 'video_link_image_size',
                    'value'         => 'large',
                    'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme).', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'video_link_type',
                        'value'     => 'image'
                    ),
                ),
                array(
                    'type'          => 'textarea_raw_html',
                    'heading'       => __( 'Video Link Content', 'toolkit-vc' ),
                    'param_name'    => 'video_link_content',
                    'value'         => '',
                    'description'   => __( 'Example: <code>&lt;i class="fa fa-play"&gt;&lt;/i&gt; Play video</code>', 'toolkit-vc' ),
                    'dependency'    => array(
                        'element'   => 'video_link_type',
                        'value'     => 'link'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'Video Link Classes', 'toolkit-vc' ),
                    'param_name'    => 'video_link_classes',
                    'value'         => '',
                    'description'   => __( 'For buttons, use: <code>btn btn-primary</code>', 'toolkit-vc' ),
                    'dependency'    => array(
                        'element'   => 'video_link_type',
                        'value'     => 'link'
                    ),
                ),
                array(
                    'type'          => 'dropdown',
                    'heading'       => __( 'HTML Link Type', 'toolkit-vc' ),
                    'param_name'    => 'html_link_type',
                    'value'         => array(
                        __( 'Select Link Type', 'toolkit-vc' ) => '',
                        __( 'Image', 'toolkit-vc' ) => 'image',
                        __( 'Link', 'toolkit-vc' ) => 'link',
                    ),
                    'description'   => __( '', 'toolkit-vc' ),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'html'
                    ),
                ),
                array(
                    'type'          => 'attach_image',
                    'heading'       => esc_html__('HTML Link Image', 'toolkit-vc'),
                    'param_name'    => 'html_link_image',
                    'description'   => esc_html__('', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'html_link_type',
                        'value'     => 'image'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('HTML Link Image Size', 'toolkit-vc'),
                    'param_name'    => 'html_link_image_size',
                    'value'         => 'large',
                    'description'   => esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme).', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'html_link_type',
                        'value'     => 'image'
                    ),
                ),
                array(
                    'type'          => 'textarea_raw_html',
                    'heading'       => __( 'HTML Link Content', 'toolkit-vc' ),
                    'param_name'    => 'html_link_content',
                    'value'         => '',
                    'description'   => __( 'Example: <code>&lt;i class="fa fa-info-circle"&gt;&lt;/i&gt; Learn More</code>', 'toolkit-vc' ),
                    'dependency'    => array(
                        'element'   => 'html_link_type',
                        'value'     => 'link'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => __( 'HTML Link Classes', 'toolkit-vc' ),
                    'param_name'    => 'html_link_classes',
                    'value'         => '',
                    'description'   => __( 'For buttons, use: <code>btn btn-primary</code>', 'toolkit-vc' ),
                    'dependency'    => array(
                        'element'   => 'html_link_type',
                        'value'     => 'link'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('HTML Popup Width', 'toolkit-vc'),
                    'param_name'    => 'html_popup_width',
                    'value'         => '500px',
                    'description'   => __('All CSS Units Allowed. Example: <code>500px</code>', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'html'
                    ),
                ),
                array(
                    'type'          => 'textarea_raw_html',
                    'heading'       => esc_html__('Raw HTML', 'toolkit-vc'),
                    'param_name'    => 'html',
                    'description'   => esc_html__('', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'html'
                    ),
                ),
                array(
                    'type'          => 'textfield',
                    'heading'       => esc_html__('Element ID', 'toolkit-vc'),
                    'param_name'    => 'html_id',
                    'description'   => esc_html__('Required If Using Multiple HTML Elements Per Page', 'toolkit-vc'),
                    'dependency'    => array(
                        'element'   => 'type',
                        'value'     => 'html'
                    ),
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
            'type'                  => '',
            'image_id'              => '',
            'image_size'            => 'large',
            'gallery_images'        => '',
            'gallery_items_per_row' => '4',
            'gallery_gap_size'     => '2px',
            'gallery_id'            => 'fancybox-gallery-1',
            'video_link'            => '',
            'video_link_type'       => '',
            'video_link_image'      => '',
            'video_link_image_size' => 'large',
            'video_link_content'    => '',
            'video_link_classes'    => '',
            'html_link_type'       => '',
            'html_link_image'      => '',
            'html_link_image_size' => 'large',
            'html_link_content'    => '',
            'html_link_classes'    => '',
            'html_popup_width' => '500px',
            'html'                  => '',
            'html_id' => 'fancybox-html-1',
            'css' => '',
        ), $atts );

        $type = $params['type'];
        $image_id = $params['image_id'];
        $image_size = $params['image_size'];
        $gallery_images = $params['gallery_images'];
        $gallery_items_per_row = $params['gallery_items_per_row'];
        $gallery_gap_size = $params['gallery_gap_size'];
        $gallery_id = $params['gallery_id'];
        $video_link_type = $params['video_link_type'];
        $video_link_content = $params['video_link_content'];
        $video_link_image = $params['video_link_image'];
        $video_link_image_size = $params['video_link_image_size'];
        $video_link_classes = $params['video_link_classes'];
        $video_link = $params['video_link'];
        $html_link_type = $params['html_link_type'];
        $html_link_content = $params['html_link_content'];
        $html_link_image = $params['html_link_image'];
        $html_link_image_size = $params['html_link_image_size'];
        $html_link_classes = $params['html_link_classes'];
        $html_popup_width = $params['html_popup_width'];
        $html = $params['html'];
        $html_id = $params['html_id'];
        $css = $params['css'];

        if (!$type) {
            return;
        }

        // $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

        $output = '';

        // $output .= "<div class='toolkit-vc-fancybox-media $css_class'>";
        $output .= "<div class='toolkit-vc-fancybox-media $css'>";

        if ($type == 'image'){
            $original_url = wp_get_attachment_image_url($image_id, 'full');
            $image = wp_get_attachment_image($image_id, $image_size, false, array('data-fancybox' => '', 'data-src' => $original_url));
            $output .= $image;
        }
        if ($type == 'gallery'){
            $image_ids = explode(',', $gallery_images);
            $output .= "<div class='fancybox-gallery' style='grid-template-columns: repeat($gallery_items_per_row, 1fr); gap: $gallery_gap_size'>";
            foreach ($image_ids as $i => $image_id) {
                $original_url = wp_get_attachment_image_url($image_id, 'full');
                $image = wp_get_attachment_image($image_id, 'large', false, array('data-fancybox' => $gallery_id, 'data-src' => $original_url));
                $output .= "<div class='fill-image'>$image</div>";
            }
            $output .= '</div>';
        }
        if ($type == 'video'){
            $link_content = ($video_link_type == 'link') ? urldecode(base64_decode($video_link_content)) : wp_get_attachment_image($video_link_image, $video_link_image_size);
            $output .= "<a data-fancybox class='$video_link_classes' href='$video_link'>$link_content</a>";
        }
        if ($type == 'html'){
            $link_content = ($html_link_type == 'link') ? urldecode(base64_decode($html_link_content)) : wp_get_attachment_image($html_link_image, $html_link_image_size);
            $output .= "<div style='display:none;max-width:$html_popup_width;' id='$html_id'>" . urldecode(base64_decode($html)) . "</div>";
            $output .= "<a data-fancybox class='$html_link_classes' data-fancybox='dialog' data-src='#$html_id' href='#$html_id'>$link_content</a>";
        }

        $output .= '</div>';

        return $output;
    }
}

new toolkit_vc_fancybox_media();