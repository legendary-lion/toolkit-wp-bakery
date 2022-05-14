<?php

// update text block parameters
vc_map_update('vc_single_image', array(
	'name' => esc_html__( 'Single Image', 'toolkit-vc' ),
	'icon' => plugin_dir_url( __FILE__ ) . '../../assets/img/toolkit_vc_single_image.svg',
	'category' => esc_html__( 'Content', 'toolkit-vc' ),
	'description' => esc_html__( 'Simple image with CSS animation', 'toolkit-vc' ),
	'params' => array(
		array(
			'type' => 'hidden',
			'heading' => esc_html__( 'Image source', 'toolkit-vc' ),
			'param_name' => 'source',
			'value' => array(
				esc_html__( 'Media library', 'toolkit-vc' ) => 'media_library',
			),
			'std' => 'media_library',
			'description' => esc_html__( 'Select image source.', 'toolkit-vc' ),
		),
		array(
            'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'toolkit-vc' ),
			'param_name' => 'image',
			'value' => '',
			'description' => esc_html__( 'Select image from media library.', 'toolkit-vc' ),
			'dependency' => array(
                'element' => 'source',
				'value' => 'media_library',
			),
			'admin_label' => true,
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Image size', 'toolkit-vc' ),
			'param_name' => 'img_size',
			'value' => 'full',
			'description' => esc_html__( 'Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Example: 200x100 (Width x Height)).', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'source',
				'value' => array(
					'media_library',
					'featured_image',
				),
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Image alignment', 'toolkit-vc' ),
			'param_name' => 'alignment',
			'value' => array(
				esc_html__( 'Left', 'toolkit-vc' ) => 'left',
				esc_html__( 'Right', 'toolkit-vc' ) => 'right',
				esc_html__( 'Center', 'toolkit-vc' ) => 'center',
			),
			'description' => esc_html__( 'Select image alignment.', 'toolkit-vc' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'On click action', 'toolkit-vc' ),
			'param_name' => 'onclick',
			'value' => array(
				esc_html__( 'None', 'toolkit-vc' ) => '',
				esc_html__( 'Open custom link', 'toolkit-vc' ) => 'custom_link',
			),
			'description' => esc_html__( 'Select action for click.', 'toolkit-vc' ),
			'std' => '',
		),
		array(
			'type' => 'href',
			'heading' => esc_html__( 'Image link', 'toolkit-vc' ),
			'param_name' => 'link',
			'description' => esc_html__( 'Enter URL if you want this image to have a link (Note: parameters like "mailto:" are also accepted).', 'toolkit-vc' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => 'custom_link',
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Link Target', 'js_composer' ),
			'param_name' => 'img_link_target',
			'value' => array(
				esc_html__( 'Same window', 'js_composer' ) => '_self',
				esc_html__( 'New window', 'js_composer' ) => '_blank',
			),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array(
					'custom_link',
					'img_link_large',
				),
			),
		),
		vc_map_add_css_animation(),
		array(
			'type' => 'el_id',
			'heading' => esc_html__( 'Element ID', 'toolkit-vc' ),
			'param_name' => 'el_id',
			'description' => sprintf( esc_html__( 'Enter element ID (Note: make sure it is unique and valid according to %sw3c specification%s).', 'toolkit-vc' ), '<a href="https://www.w3schools.com/tags/att_global_id.asp" target="_blank">', '</a>' ),
		),
		array(
			'type' => 'textfield',
			'heading' => esc_html__( 'Extra class name', 'toolkit-vc' ),
			'param_name' => 'el_class',
			'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'toolkit-vc' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => esc_html__( 'CSS box', 'toolkit-vc' ),
			'param_name' => 'css',
			'group' => esc_html__( 'Design Options', 'toolkit-vc' ),
		),
		array(
			'type' => 'hidden',
			'param_name' => 'img_link_large',
		),
	),
));